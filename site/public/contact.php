<?php
/**
 * West Michigan Art Therapy — contact form handler.
 *
 * Receives the POST from /contact, emails Amy, and redirects to /thanks/.
 * Lives in public/ so the build copies it to the site root as /contact.php.
 * Requires PHP on the server (your old WordPress host had it).
 *
 * Deliverability tip: send "From" an address at YOUR domain (not the visitor's),
 * or shared hosts/Gmail may reject it. If mail() lands in spam or fails, switch
 * to SMTP (see the note at the bottom).
 */

// ---- Settings -------------------------------------------------------------
$TO         = 'amy@westmichiganarttherapy.com';
$FROM       = 'no-reply@westmichiganarttherapy.com'; // must be on your domain
$SUBJECT    = 'New inquiry — westmichiganarttherapy.com';
$THANKS_URL = '/thanks/';
// ---------------------------------------------------------------------------

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed.');
}

// Honeypot: bots fill hidden fields; humans don't. Pretend success.
if (!empty($_POST['bot-field'])) {
    header('Location: ' . $THANKS_URL, true, 303);
    exit;
}

function field($key, $max = 2000) {
    return isset($_POST[$key]) ? trim(mb_substr((string) $_POST[$key], 0, $max)) : '';
}

$name     = field('name', 120);
$email    = field('email', 200);
$interest = field('interest', 120);
$message  = field('message', 2000);
$sliding  = !empty($_POST['sliding-scale']) ? 'Yes' : 'No';

// Validate
$errors = array();
if ($name === '') {
    $errors[] = 'name';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'email';
}
if ($message === '') {
    $errors[] = 'message';
}
if ($errors) {
    http_response_code(400);
    exit('Please complete the required fields, then go back and try again.');
}

// Guard against header injection via the Reply-To address.
$replyTo = preg_replace('/[\r\n]+/', ' ', $email);

$body = "New message from the website contact form:\n\n"
      . "Name: {$name}\n"
      . "Email: {$email}\n"
      . "Interested in: {$interest}\n"
      . "Sliding scale: {$sliding}\n\n"
      . "Message:\n{$message}\n";

$headers = array(
    'From: West Michigan Art Therapy <' . $FROM . '>',
    'Reply-To: ' . $replyTo,
    'Content-Type: text/plain; charset=UTF-8',
    'X-Mailer: PHP/' . phpversion(),
);

$sent = @mail($TO, $SUBJECT . ' — ' . $name, $body, implode("\r\n", $headers));

if ($sent) {
    header('Location: ' . $THANKS_URL, true, 303);
    exit;
}

http_response_code(500);
echo 'Sorry — your message could not be sent right now. '
   . 'Please email <a href="mailto:' . htmlspecialchars($TO) . '">' . htmlspecialchars($TO) . '</a> directly.';

/*
 * Not receiving emails / landing in spam? PHP mail() depends on the server's
 * mail setup. The reliable fix is SMTP (e.g. PHPMailer with your mailbox's SMTP
 * credentials, or the same SMTP your old WordPress used). Tell me your SMTP
 * host/user and I'll swap mail() for an SMTP send.
 */
