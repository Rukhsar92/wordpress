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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'woocom' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'uUy=.,`P=[Ko&D76ALJ-eLZg{#%5cGCr}cui?J}5-%tw.D=I;N#K;gF7vq,%_;ux' );
define( 'SECURE_AUTH_KEY',  '0b1x5Y2i8U<|i)*?Ve, lM0d9^g4eU1`i>ig*bWb!;/W$$LKp-vcN}IcalmtY;d>' );
define( 'LOGGED_IN_KEY',    'z!XZ1Rf~TRQ.iw43/$XvjvW+]1iqul,Us<mHTq^)u]-6mt_ph+>!iyD=;RYtvV/o' );
define( 'NONCE_KEY',        '=y6wp-t}2SPT)_Q/v-Oi=3WFCfU*]!/L?OD[YN`uKEiB;1[x%T0TU,h`VxR0(SLS' );
define( 'AUTH_SALT',        'CBK~nKS+U,<fkp6,MWZBk.r,~0!_dqX?Bd+b=6`Q@{PlH]=[!gA*{kR,J4aI0.~h' );
define( 'SECURE_AUTH_SALT', '}r}}j#-!ao+L `F#W%b%rX=33t[KU3,$|<1~%OG^ce_,cqttPw3jve2wx.SqMRjp' );
define( 'LOGGED_IN_SALT',   'EmRy}Xe~Iz4s`mNF@O@xEb@OTpz~=|BS)Nz@t5Cmr.B:gf]-44Q`i}LjUFa$2Pz1' );
define( 'NONCE_SALT',       '0&bw{F&6js>YIf[)H!{,%-jK]md>PeJ zk&XNbw6BUs`<(lg&AB~n`>xUg}A%+e^' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
