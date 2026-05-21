<?php
/**
 * WordPress config for Vercel / production.
 * Copy this to wp-config.php and set the Vercel environment variables:
 *   DB_NAME, DB_USER, DB_PASSWORD, DB_HOST
 *
 * Rename wp-config-local.php.example to wp-config-local.php for local dev.
 */

// Load local overrides if present (not committed to git)
if ( file_exists( __DIR__ . '/wp-config-local.php' ) ) {
	require_once __DIR__ . '/wp-config-local.php';
}

// Database — reads from Vercel env vars; falls back to constants defined in wp-config-local.php
if ( ! defined( 'DB_NAME' ) )     define( 'DB_NAME',     getenv( 'DB_NAME' )     ?: '' );
if ( ! defined( 'DB_USER' ) )     define( 'DB_USER',     getenv( 'DB_USER' )     ?: '' );
if ( ! defined( 'DB_PASSWORD' ) ) define( 'DB_PASSWORD', getenv( 'DB_PASSWORD' ) ?: '' );
if ( ! defined( 'DB_HOST' ) )     define( 'DB_HOST',     getenv( 'DB_HOST' )     ?: 'localhost' );
if ( ! defined( 'DB_CHARSET' ) )  define( 'DB_CHARSET',  'utf8mb4' );
if ( ! defined( 'DB_COLLATE' ) )  define( 'DB_COLLATE',  '' );

/**#@+
 * Authentication unique keys and salts.
 * Generate fresh ones at: https://api.wordpress.org/secret-key/1.1/salt/
 */
define( 'AUTH_KEY',         getenv('WP_AUTH_KEY')         ?: 'eU+k.IR@SFaz{7??CqZ2UFY0&OxDXCqnK8721okRF+s:}jjf@l4i?h1iFdq?m&}L' );
define( 'SECURE_AUTH_KEY',  getenv('WP_SECURE_AUTH_KEY')  ?: 'L#PV9LD9MWV*qy+c~8#28&1sh%/ Ne<J#IcM[yS<N+$)c2o4bO=QX;AN|=lRV;3:' );
define( 'LOGGED_IN_KEY',    getenv('WP_LOGGED_IN_KEY')    ?: '+N[-er1WAt9}:?ADUduG!Qgh$#:QHQ7s59I!=f(&p8WP*d~trHWyLxM}E2nm]zTJ' );
define( 'NONCE_KEY',        getenv('WP_NONCE_KEY')        ?: '^f|IW|<Lg`pj?R-xh7Rsu#M+J+tQa|;@4Q#5$WEuqPc4iSh?W`xiAOPH^jq4wKuq' );
define( 'AUTH_SALT',        getenv('WP_AUTH_SALT')        ?: '%QUF?6dV$w*6l`{/?k<+6Xz7}Yd`v0 |%4G0kjK:F=Vs*Cq`.;N.]s0wT|H{DjC6' );
define( 'SECURE_AUTH_SALT', getenv('WP_SECURE_AUTH_SALT') ?: 'oQ%-XpGU{YW@k4%/n<#gJWh5^siMQB`_m_ee>MQ~d7,3hbc?fA|2t:5{tG85p^q_' );
define( 'LOGGED_IN_SALT',   getenv('WP_LOGGED_IN_SALT')   ?: '3rCgWL7Lnmji:8xWJ:j=_xd]5tx|q{h8}`s`=.e.)1MSvuyo%NP,92Y#IF8g#:oG' );
define( 'NONCE_SALT',       getenv('WP_NONCE_SALT')       ?: ')+Tc{F9,KC]viepLm`,~0AeM-nu7!}c +auAM0q~&l?ACL( )V*1(}J`8n1!HAUm' );

$table_prefix = 'wp_';

define( 'FS_METHOD',       'direct' );
define( 'WP_MEMORY_LIMIT', '512M' );
define( 'WP_DEBUG',        false );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
require_once ABSPATH . 'wp-settings.php';
