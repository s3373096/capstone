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
define('DB_NAME', 'u696428699_cap');

/** MySQL database username */
define('DB_USER', 'u696428699_cap');

/** MySQL database password */
define('DB_PASSWORD', 'dkmhack');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         ')myAtT+i8&[2||X,4p]/cW^w((Cwv9o=X.{Ejk$*W!B:6#bf|L}{L[@X`j50LHoJ');
define('SECURE_AUTH_KEY',  'QZ^RP8=;@:i.jb|/D+Ok+C=%ENu<bN/B?Hr@D%p!HUL|q ;rTXCrZ|O!e,{~b&l,');
define('LOGGED_IN_KEY',    '/^TkUGX,+XL*WHvu[K}vtahip9`yEy-n5K.5m#9Rwq=G5eUxIDnKwHS61+b:bud[');
define('NONCE_KEY',        'dJ7/n^q#`kv=+D#cCre9~A%2s[g+7T+J[i]OL%k4KIt96cLi$r&HzRST@+)wbr:8');
define('AUTH_SALT',        'FV:_rw3]qXEUfFrzbtr4!=68+wCI-S+OKLrl2IzV|?|>G`rz+V5Z .|tc~h]=4 5');
define('SECURE_AUTH_SALT', '+}KZv4-ZiM{hj^ Ddu%@%<W;r}QFl(?QtFMK^C-gvxY-T9UZi;>@+WS[Nz,iSk6g');
define('LOGGED_IN_SALT',   'E`$r UEB}~-^Jl,^A]p4DQ$A48LYrs.N9=$)U9pDg2XagRse#_hr8S;<oA+lC;@/');
define('NONCE_SALT',       'L6*[qx)70;VsGNO%|bDVY/ih K#ECr/V:_+xvWB.hy?pYY^<QQk)s:*f(j-0<&zV');

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
