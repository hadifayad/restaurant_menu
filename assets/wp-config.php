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
define( 'DB_NAME', 'thecodeit' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'R00ter@2020' );

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
define( 'AUTH_KEY',         '#(e<5&Nt]xcyI2g-p]38/?4K[gfw(%tX*^;_,80&Nh!UF++g?PPCCvG8| J)8dhg' );
define( 'SECURE_AUTH_KEY',  'X)])mj*6ZKJet=l0}5b-[%4T!Po6_>%}p2{zgQ58LM%MBHd_S2[):^1 |EMH.CSx' );
define( 'LOGGED_IN_KEY',    'uRWNBetE/Ld]~NxF4sZx9m-9a5nsV3q-ZI89lnKB;%arK*kX1g`~.|%QdWvqa3f=' );
define( 'NONCE_KEY',        'BE]p>Dk|vzdC=aagJm@Y`1=m5=,xJqR|Sim)*]`BOtV3Q>}RX*}Xo9-MlWCTOw?2' );
define( 'AUTH_SALT',        'wz@:]3`m3;a~1T`C+@g]Eme.0A&{4R(vhZ?}bx8Zdb}.Zj&26XMNY^@goEDp@_aC' );
define( 'SECURE_AUTH_SALT', 'Y`au`%D7z=0cY=d2pztr#--=A?|[RZB8v8:l(n!ZELqW6hG.O>]UZ0EgE3bgOMPR' );
define( 'LOGGED_IN_SALT',   'lvk=6kBW5uTiGy5_6Dbv b+A-_}E=F$cF@efeTsVQ{)344*cE)OozeVDHFP7?DiC' );
define( 'NONCE_SALT',       '}Vl[z-))Uqt*Q!{DX)wk52*h-!bS`|0.[cAkYKxSH1$`-@f`~vcr@Q^#.C`m^|b%' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'restly_';

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
