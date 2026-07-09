<?php
/* Copy this file to config.php (which is git-ignored — never commit it) and fill in.
 *   cp config.sample.php config.php
 * Reuse the legacy WordPress database credentials (see that site's wp-config.php:
 * DB_NAME, DB_USER, DB_PASSWORD, DB_HOST). */

define('DB_DSN',  'mysql:host=localhost;dbname=YOUR_WP_DB_NAME;charset=utf8mb4');
define('DB_USER', 'YOUR_DB_USER');
define('DB_PASS', 'YOUR_DB_PASSWORD');

/* Shared token the app must send. Make it long + random, e.g. `openssl rand -hex 24`.
 * It appears in the app's page source, so it is a soft gate only — Phase A, no PHI. */
define('AUTH_TOKEN', 'change-me-to-a-long-random-string');
