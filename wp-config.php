<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'eZUIUL55uukzaV9qUAxCTWG+92imEnUldTF6ma0gHmKCE5sGEcApoE/yAJL67poc8h6cMtnlsyi5pxYKXPzBxw==');
define('SECURE_AUTH_KEY',  'kHtBt4v3i9ApGHIjslInBVDK2TqVh81KtMGDoBM3cCLJTxuzU6PXh5/XjgTEKeZFFRTEyUzTrq8lb8svmkfszQ==');
define('LOGGED_IN_KEY',    'bx5JjkEyTeStCKT71WfxyrWVfSEnWkPFSScLkGbhjGsvCwDx/6bGV2SApJSdBSBFC8nLKyplpUNIEIhe8RKxrQ==');
define('NONCE_KEY',        'ZJWUuXwHbzs1ju6Sk3q3cBHOfGWdUA8bg7MyaIJsNHMKuoZGu2z1VWF7S6v0KrYx5E4zikKk4oN5Rze9/aD8tA==');
define('AUTH_SALT',        '7o+r2TaBEn/yBdlPXazzrzjAK2F6+HF8aD0dLde7dYfOdjAjEgAxOOEDC+7/DnmqfFdLLyn791duCgpPIOdTIQ==');
define('SECURE_AUTH_SALT', 'ABf6zJFik3R5k9IZOfEvFoBFGcH4mEdtkxY6JNNmlLm7kdEUwaYLReC18Vgbjnj4BeAp3OnUH6U47o2y7xmICA==');
define('LOGGED_IN_SALT',   'xWg2WCTCmeJuUfYRexFPt5m/X0F/5+HJLUtmp3Z+49t+bW9WR+ikjA9giWufvkYGhXIDggashTas4ClKiuv2WA==');
define('NONCE_SALT',       'jJT/aHGqZwtwZ1+0XWypn7l0yvj41oh6vx5+7bXgBqxk66gyZv1DGAfpgp8AZNK8+1gBBRwpw0aOBtVx2ab4RQ==');
define( 'JETPACK_DEV_DEBUG', true );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

define( 'WP_DEBUG', true );

if ( WP_DEBUG ) {
	define( 'WP_DEBUG_DISPLAY', false );
	define( 'WP_DEBUG_LOG', true );
	define( 'SAVEQUERIES', true );
	define( 'SCRIPT_DEBUG', true );
}

/* Inserted by Local by Flywheel. See: http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy */
if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
	$_SERVER['HTTPS'] = 'on';
}

/* Inserted by Local by Flywheel. Fixes $is_nginx global for rewrites. */
if ( ! empty( $_SERVER['SERVER_SOFTWARE'] ) && strpos( $_SERVER['SERVER_SOFTWARE'], 'Flywheel/' ) !== false ) {
	$_SERVER['SERVER_SOFTWARE'] = 'nginx/1.10.1';
}
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
