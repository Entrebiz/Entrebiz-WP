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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'entrebiz_wp' );

/** Database username */
define( 'DB_USER', 'entrebiz_wp' );

/** Database password */
define( 'DB_PASSWORD', 'T99AckNP*Y6ePBW8&%^$8qHmQ!Fs5n' );

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
define( 'AUTH_KEY',         '`Utr|OTw{ty-Vn[,@{Vx867p*6xi>)M3Bm7BduVtfv3SB%V@|<dh._ifsx/ncp~2' );
define( 'SECURE_AUTH_KEY',  'YVS4]4tiAwaye-`*l*}rX4i]+RBvtRj&6DFADd?fXXaI5cRcd3l2+=2#+2a&[=Gk' );
define( 'LOGGED_IN_KEY',    ':53?4%K$nm8[!K$v}>DqU=j}*YQEx+a|:iHPV&H6pvS[o+cj0dGSBP:1fg#aGX/<' );
define( 'NONCE_KEY',        'WD7-$jW,lJwi}5o2YKHLI~4R3}k)cv-z^Tj]yOJvmy)Qs03mqIbDY0kLI(b1{{/:' );
define( 'AUTH_SALT',        '>FduJ%AE j}eWu&hYQo}ii7U{a%H+{d.ev.|XI[XoOj?(r@(XcTXdE)gXo)#c/1y' );
define( 'SECURE_AUTH_SALT', 'v?6El5_ %N89jgY|>i6p;fqxt/Cwq$yay#1bY8Toa~/pu)oUEp@MAMCG Ym-F@{O' );
define( 'LOGGED_IN_SALT',   'USyq+FN|o^UJ3lH_ ZUsq&y}?|T2)LP/iOh`3XdE xBC[zs9|@1&7}b;XKn_|5h5' );
define( 'NONCE_SALT',       'msMRWS*[P9 S3w~Jw*3i9rvdA*{YTq2UW1/Ii)^27QQsJ$<rX9U1CA9!jTZ&/PS=' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
