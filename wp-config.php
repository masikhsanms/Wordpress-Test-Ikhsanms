<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'test_cakap' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         ',ySYz=n}a}ck:BJ#eJls03o~l7bNNPwB(6?kjhYd}5tw<u?Ty&!}*1Nv2kSBg}lA' );
define( 'SECURE_AUTH_KEY',  '|X3h_nOfAI6C$#5[9BQiqbYu1@:z1djMA90~G(Ky(@:$JhG=uFm=>j3T=?l<AmU-' );
define( 'LOGGED_IN_KEY',    'I9ZlJfo}YxZoST<TO[<(XM=Yk]Df$dC^]y:r+3$awfT{ho(:{u96USOW8#eiGI+/' );
define( 'NONCE_KEY',        '9!y!AO>8f#&1UzAT,sh<1]>]8s)q91JC46fKX(uA)W8%X#1)eLo-CUayuJy#GY3~' );
define( 'AUTH_SALT',        '1r~7a>@*;~pUql<M@R|U2S8-[rR9}F+)o#P{7!L]$wC2&36urBpoNI@Y_EF4+ Bc' );
define( 'SECURE_AUTH_SALT', ',;E#WDf&RD}c:6QN5iOC2]h>].aZGj4Dy<H<P&p?R(&aB}jLo!aF:W+xQ_G-SWtD' );
define( 'LOGGED_IN_SALT',   '^_*,,8Im.HE&SF/i!y{?FD(|uo0 {NmGhO1RXAE;xB`-qxLqw9+3hVH)/r1$z-D:' );
define( 'NONCE_SALT',       '5R}?S<D80H*8d_88@_4Ke9)T4*ON:]=i*_rT:?C)%L@?0[rZ-P/[y|K+p#3x:lU>' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
