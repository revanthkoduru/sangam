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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wordpressuser');

/** MySQL database password */
define('DB_PASSWORD', 'password');
define('FS_METHOD', 'direct');
/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'a9?#0IrE2s4-MJib%p{6|.j1&uGXGm|Qi+;dikEK4g&|ywi?XHqnLy`rI?V4$L%t');define('SECURE_AUTH_KEY',  '=.[d5Mb[LzN|Hd_snOOu.M)!-9*^aU~w|J5V-)**<P<To[k[JrIv-1CUC*#w#1em');define('LOGGED_IN_KEY',    '_6BZh?4P(0>Y]#q-~:^:{S2P)wt(E7-og-4-4{wb[#s %(-(CJ3lYszAWpo7S2iy');define('NONCE_KEY',        '(M|*aG|=4Sf~6HHn#^Ic6d~fofwpvY:vRWq `y,P[hj=k}OOZeWhXqx{yQqq<Gos');define('AUTH_SALT',        'Fa1RIM4$;|@1L]#M7qBX1jckRJG_Er-H!F70iAwF^[^HLR/%PGmrM>6-ZL<%yrHm');define('SECURE_AUTH_SALT', 'lc+G,}6g}/lH.J![lr|K6Ep.)yi0~yq=gZed3OT.*$.`FnT(7+I;j@KA`0thI<$y');define('LOGGED_IN_SALT',   '?s%@j`W^f!_|E^QK`rXe2_X|$3Uc =%YB5FDL}=6XG|LvsAXUvdq<|t ( Do0}f2');define('NONCE_SALT',       'jXYao`$&s2:()L=<]I#[#hk+Qe1^Ph|?G+p3t0p2d.Sxj6o9AIWy&RR$Q0$)9o4n');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
