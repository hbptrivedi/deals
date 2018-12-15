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
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/ubuntu/applications/deals/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'deals');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'WLzB3P2vBNV7');

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
define('AUTH_KEY',         'Lweczo#I00h>i(Je++CH=`jlOilx_|yJ?!vu|%nx-6bdzz<(s81BX@pP?CFljzSU');
define('SECURE_AUTH_KEY',  ')X>*080DNDe9ucLMe@MKIoqH2z248Z,3BmeE7-qUdi|_^n6r=TR0obrfk~b2RQ{L');
define('LOGGED_IN_KEY',    'wo{53+-]:,TEN77^)sh?hxtb?|sp-q=^#y`,(tg!)d?yWs,69lbDx2_^Sm2FF8=g');
define('NONCE_KEY',        '8h^w%=LENz<GCv=D3g_[^0KUUnELdg1()J[j8b0E8g&0l3wAw,Ls},qlGqR4:5DL');
define('AUTH_SALT',        '=CZn/!7eve7?S;os>A9lQzDha|ExL8ZCryE^#huUidST$,duT/Da{N#+v^>z+&}p');
define('SECURE_AUTH_SALT', '60#qdRMaz@s`Z}0*=?)gfZ-UQ -L<jwkc1|%!,|wN<#%&Fbo18D&XwMvN.Je; rj');
define('LOGGED_IN_SALT',   'O,qgCZ^>B_,ecLs^Y08x9TM!bt.mge<hs+ho)</8yCSt0JLz/zZwC}`B,@DjAz(F');
define('NONCE_SALT',       '5D0ml5!0+B4)3C~D|]WkKQVU}>j``n @FjtfxWi9?GGoR+o?8W5ShN.L7H1=_(o_');
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
