<?php
/**
 * WordPress router for Vercel serverless PHP runtime.
 * All requests are rewritten here; this file resolves the correct WP file to load.
 */

$root = dirname(__DIR__);
chdir($root);

$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);

// Serve static files directly (CSS, JS, images, fonts)
if (preg_match('/\.(css|js|png|jpg|jpeg|gif|svg|ico|woff|woff2|ttf|eot|pdf|txt|xml|map)$/i', $path)) {
    $file = $root . $path;
    if (is_file($file)) {
        return false; // Let Vercel serve it
    }
}

// Route to specific WP entry points
$wp_files = [
    '/wp-login.php',
    '/wp-cron.php',
    '/wp-comments-post.php',
    '/wp-trackback.php',
    '/wp-signup.php',
    '/wp-activate.php',
    '/xmlrpc.php',
    '/wp-mail.php',
];

if (in_array($path, $wp_files) && is_file($root . $path)) {
    require_once $root . $path;
    return;
}

// wp-admin routing
if (strpos($path, '/wp-admin') === 0) {
    $admin_path = $root . $path;
    if (is_file($admin_path) && pathinfo($admin_path, PATHINFO_EXTENSION) === 'php') {
        require_once $admin_path;
        return;
    }
    if (is_dir($admin_path)) {
        require_once rtrim($admin_path, '/') . '/index.php';
        return;
    }
}

// Everything else goes through WordPress index
require_once $root . '/index.php';
