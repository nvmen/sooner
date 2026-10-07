<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'sooner' );

/** Database username */
define( 'DB_USER', 'sooner_sktek_io' );

/** Database password */
define( 'DB_PASSWORD', 'yeph5Z5d7t' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'zKNC.|iYfiJsh]X6aa)VoHkG`>(5^}oC%XR1uQir3uz9VPHV8Mm[5[[[<51<#KdB' );
define( 'SECURE_AUTH_KEY',  '2EGI.g~ZIvKV$J`x,KdkcXAYGHPGtIYH*wz^TxYqM,VcB2 S;G>A;kwYF>|]i~P`' );
define( 'LOGGED_IN_KEY',    'K%5WLuG8_Q.{^,@>7N&lK1TK!1X(L#}.0|dhY-2Q$7T4T-%dp;{tQtJOXrJuW-,$' );
define( 'NONCE_KEY',        '^KuU5#Q#nQ$.?^2!]LvzB6]f;SLqsmAj,S[mw[G1qy2RL{%A@`g,MGP&csfqu!VB' );
define( 'AUTH_SALT',        'y~M^))P;|5J!v@i-?M63/zx0~cDE}IJT>xF4_|pfp=_UKny}b9 Nu:se5}K$Qu`T' );
define( 'SECURE_AUTH_SALT', 'v;9k7$5^Qy10`d`{T;{=q1<.V^Xu ]ZWG5gRxf;94X;0(*E[n>yOF.^eB#U^F5tX' );
define( 'LOGGED_IN_SALT',   '(WC>X,?@ZxoW>v*bC=Bgl3;xJ[H-1}JBr3Ky(NachE]$X8-tO#*bt6!8(fb4Smmo' );
define( 'NONCE_SALT',       'E5Jw S(:6=BdsLKciC5OZ #8EJm8LdTQ#41$ZLVYJDdAEPvI8h9<IDF:F~T,JkwB' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
