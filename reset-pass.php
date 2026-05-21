<?php
// One-time password reset script. Auto-deletes after running.
define('ABSPATH', __DIR__ . '/');
require_once __DIR__ . '/wp-load.php';

$new_password = 'ITLand@2026!';
$user_id      = 1; // manojcompte

wp_set_password($new_password, $user_id);

echo '<b>Password reset successfully!</b><br>';
echo 'Username: <b>manojcompte</b><br>';
echo 'Password: <b>' . $new_password . '</b><br>';
echo '<a href="/wp-admin">Login now</a>';

// Self-delete
@unlink(__FILE__);
