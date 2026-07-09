#!/usr/bin/env node
/* Tiny zero-dependency static server for local dev + running test/smoke.html.
 * Root is hard-coded (no process.cwd() reliance). Serves smoke.html at "/".
 *   node test/server.mjs        # http://localhost:8123  -> the smoke test
 *
 * It also exposes an in-memory /kv endpoint that mirrors backend/api.php's contract
 * (GET/PUT/DELETE ?key=<k> + X-Pentimento-Token header), so the front-end sync adapter
 * can be exercised over real HTTP without a PHP/MySQL host. Test token: "test-token".
 */
import { createServer } from 'node:http';
import { readFile } from 'node:fs';
import { extname, join, normalize } from 'node:path';
import { fileURLToPath } from 'node:url';
import { dirname } from 'node:path';

const ROOT = normalize(join(dirname(fileURLToPath(import.meta.url)), '..'));
const PORT = Number(process.env.PORT) || 8123;
const TOKEN = 'test-token';
const kv = new Map();
const TYPES = { '.html': 'text/html', '.js': 'text/javascript', '.mjs': 'text/javascript',
  '.json': 'application/json', '.css': 'text/css', '.svg': 'image/svg+xml' };

const cors = (res) => {
  res.setHeader('Access-Control-Allow-Origin', '*');
  res.setHeader('Access-Control-Allow-Methods', 'GET, PUT, POST, DELETE, OPTIONS');
  res.setHeader('Access-Control-Allow-Headers', 'X-Pentimento-Token, Content-Type');
};

createServer((req, res) => {
  const url = new URL(req.url || '/', 'http://localhost');

  // --- /kv mock (mirrors backend/api.php) ---
  if (url.pathname === '/kv') {
    cors(res);
    if (req.method === 'OPTIONS') { res.writeHead(204); return res.end(); }
    if (req.headers['x-pentimento-token'] !== TOKEN) { res.writeHead(401); return res.end('unauthorized'); }
    const key = url.searchParams.get('key') || '';
    if (!key) { res.writeHead(400); return res.end('bad key'); }
    if (req.method === 'GET') {
      if (!kv.has(key)) { res.writeHead(404); return res.end(); }
      res.writeHead(200, { 'content-type': 'application/json' }); return res.end(kv.get(key));
    }
    if (req.method === 'PUT' || req.method === 'POST') {
      let body = ''; req.on('data', (c) => (body += c));
      req.on('end', () => { kv.set(key, body); res.writeHead(200); res.end('ok'); });
      return;
    }
    if (req.method === 'DELETE') { kv.delete(key); res.writeHead(200); return res.end('ok'); }
    res.writeHead(405); return res.end('method');
  }

  // --- static files ---
  let p = decodeURIComponent(url.pathname);
  if (p === '/') p = '/test/smoke.html';
  const file = normalize(join(ROOT, p));
  if (!file.startsWith(ROOT)) { res.writeHead(403); return res.end('forbidden'); }
  readFile(file, (err, buf) => {
    if (err) { res.writeHead(404); return res.end('not found: ' + p); }
    res.writeHead(200, { 'content-type': TYPES[extname(file)] || 'application/octet-stream' });
    res.end(buf);
  });
}).listen(PORT, () => console.log('pentimento static + /kv on http://localhost:' + PORT + '  (root: ' + ROOT + ')'));
