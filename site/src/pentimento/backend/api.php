<?php
/* Pentimento Phase A backend — a tiny key/value store over the existing MySQL DB.
 *
 * The app treats storage as key -> JSON string (keys: 'pentimento-index' and
 * 'pentimento-session-<id>'), so this is deliberately a generic KV endpoint:
 *   GET    api.php?key=K   -> 200 + the stored JSON, or 404 if absent
 *   PUT    api.php?key=K   -> upsert; request body is the JSON value
 *   DELETE api.php?key=K   -> delete
 * Auth is a single shared token in the X-Pentimento-Token header.
 *
 * ⚠ PHASE A ONLY (Josh + Amy's own test sessions). The token is visible in the app's
 * page source, so it is a soft gate, not real security. Do NOT store real client PHI
 * here — that needs per-user accounts, consent, audit logging, encryption, and a signed
 * BAA first (HANDOFF §8). See README.md.
 */

require __DIR__ . '/config.php';  // defines DB_DSN, DB_USER, DB_PASS, AUTH_TOKEN

// --- CORS (custom header only, no cookies, so wildcard origin is fine) ---
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: X-Pentimento-Token, Content-Type');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(204); exit; }

// --- auth (constant-time compare) ---
$token = $_SERVER['HTTP_X_PENTIMENTO_TOKEN'] ?? '';
if (!is_string($token) || !hash_equals(AUTH_TOKEN, $token)) {
  http_response_code(401); header('Content-Type: text/plain'); echo 'unauthorized'; exit;
}

// --- key ---
$key = isset($_GET['key']) ? (string) $_GET['key'] : '';
if ($key === '' || strlen($key) > 191) {
  http_response_code(400); header('Content-Type: text/plain'); echo 'bad key'; exit;
}

try {
  $pdo = new PDO(DB_DSN, DB_USER, DB_PASS, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);
} catch (Throwable $e) {
  http_response_code(500); header('Content-Type: text/plain'); echo 'db connection failed'; exit;
}

$method = $_SERVER['REQUEST_METHOD'];
try {
  if ($method === 'GET') {
    $st = $pdo->prepare('SELECT v FROM pentimento_kv WHERE k = ?');
    $st->execute([$key]);
    $row = $st->fetch();
    if (!$row) { http_response_code(404); exit; }
    header('Content-Type: application/json');
    echo $row['v'];

  } elseif ($method === 'PUT' || $method === 'POST') {
    $body = file_get_contents('php://input');
    if ($body === false) { $body = ''; }
    if (strlen($body) > 6000000) {  // ~6 MB guard (matches the app's per-session ceiling)
      http_response_code(413); header('Content-Type: text/plain'); echo 'value too large'; exit;
    }
    $st = $pdo->prepare(
      'INSERT INTO pentimento_kv (k, v) VALUES (?, ?)
       ON DUPLICATE KEY UPDATE v = VALUES(v), updated_at = CURRENT_TIMESTAMP'
    );
    $st->execute([$key, $body]);
    header('Content-Type: text/plain'); echo 'ok';

  } elseif ($method === 'DELETE') {
    $st = $pdo->prepare('DELETE FROM pentimento_kv WHERE k = ?');
    $st->execute([$key]);
    header('Content-Type: text/plain'); echo 'ok';

  } else {
    http_response_code(405); header('Content-Type: text/plain'); echo 'method not allowed';
  }
} catch (Throwable $e) {
  http_response_code(500); header('Content-Type: text/plain'); echo 'server error';
}
