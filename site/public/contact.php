<?php
/**
 * West Michigan Art Therapy — contact form handler.
 *
 * Emails Amy when someone submits /contact, then redirects to /thanks/.
 * Lives in public/ so the build copies it to the site root as /contact.php.
 *
 * Sending: if SMTP is configured below it sends via SMTP (reliable). Otherwise
 * it falls back to PHP mail(). Fill in the SMTP block with the mailbox's
 * credentials for dependable delivery.
 */

// ===========================================================================
//  SETTINGS — edit these
// ===========================================================================
$TO         = 'amy@westmichiganarttherapy.com'; // forwards to Amy's Google inbox
$FROM       = 'joshua@hamman.org';              // MUST equal the IONOS mailbox below
$FROM_NAME  = 'West Michigan Art Therapy (website)';
$SUBJECT    = 'New inquiry — westmichiganarttherapy.com';
$THANKS_URL = '/thanks/';

// SMTP (IONOS). Outgoing server requires authentication. The mailbox can only
// send "From" its own address, so $FROM above is joshua@hamman.org. The
// visitor's address is set as Reply-To, so replying goes to them.
// Put the real password here ON THE SERVER ONLY — do not commit it.
// Setup note (not published): site/SMTP-SETUP.md
$SMTP = array(
    'host'   => 'smtp.ionos.com',
    'port'   => 587,                  // 587 = STARTTLS ('tls'); use 465 for 'ssl'
    'user'   => 'joshua@hamman.org',  // full email address = IONOS username
    'pass'   => '',                   // <-- set on the server only
    'secure' => 'tls',
);
// ===========================================================================

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

$replyTo = preg_replace('/[\r\n]+/', ' ', $email); // guard header injection

$body = "New message from the website contact form:\n\n"
      . "Name: {$name}\n"
      . "Email: {$email}\n"
      . "Interested in: {$interest}\n"
      . "Sliding scale: {$sliding}\n\n"
      . "Message:\n{$message}\n";
$subject = $SUBJECT . ' — ' . $name;

$sent = false;

if ($SMTP['host'] !== '') {
    // ---- SMTP via PHPMailer ----
    require __DIR__ . '/lib/PHPMailer/Exception.php';
    require __DIR__ . '/lib/PHPMailer/PHPMailer.php';
    require __DIR__ . '/lib/PHPMailer/SMTP.php';

    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = $SMTP['host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $SMTP['user'];
        $mail->Password   = $SMTP['pass'];
        $mail->SMTPSecure = $SMTP['secure']; // 'tls' or 'ssl'
        $mail->Port       = (int) $SMTP['port'];
        $mail->CharSet    = 'UTF-8';

        $mail->setFrom($FROM, $FROM_NAME);
        $mail->addAddress($TO);
        $mail->addReplyTo($replyTo, $name);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        $sent = true;
    } catch (\Throwable $e) {
        $sent = false;
    }
} else {
    // ---- PHP mail() fallback (with envelope sender for deliverability) ----
    $headers = array(
        'From: ' . $FROM_NAME . ' <' . $FROM . '>',
        'Reply-To: ' . $replyTo,
        'Content-Type: text/plain; charset=UTF-8',
        'X-Mailer: PHP/' . phpversion(),
    );
    $sent = @mail($TO, $subject, $body, implode("\r\n", $headers), '-f' . $FROM);
}

if ($sent) {
    header('Location: ' . $THANKS_URL, true, 303);
    exit;
}

http_response_code(500);
echo 'Sorry — your message could not be sent right now. '
   . 'Please email <a href="mailto:' . htmlspecialchars($TO) . '">' . htmlspecialchars($TO) . '</a> directly.';
