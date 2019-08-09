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
define( 'DB_NAME', 'blog' );

/** MySQL database username */
define( 'DB_USER', 'gosia' );

/** MySQL database password */
define( 'DB_PASSWORD', 'fAr5RXmnVse4tKZs' );

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
define( 'AUTH_KEY',         'n>ZDPQ+/`}kdYN1QzON*!4O@`b ]gptA+ecF7+B<8]0/wB_KnGu`y<dS7WoJ{nRp' );
define( 'SECURE_AUTH_KEY',  'K)b}.O+A6.|O3?dU:kN&n<LI$J$7Y.^Ay8?tSOo4-owOs<C)>wOlzKD5]vsKNH^@' );
define( 'LOGGED_IN_KEY',    '[p?d[(UYgu5TDPZHNvI>_t,TVSw^&:f.>t=k6JJFc/@R60ufi!lZTe]l:(|{9LM)' );
define( 'NONCE_KEY',        'g32:g3$be8,d*cO14Q+O-hX}?QcfYW04[&:&`1}O!qW#.[:IJ#;-Is91(#OHzIg@' );
define( 'AUTH_SALT',        'sIbNv(dB4=a8yRl@]5yLV??^bl^uP;Hj]G;[YAIL4H|h[{/O,FW1/[so4C|FQIcI' );
define( 'SECURE_AUTH_SALT', 'p5/~iJy;@*S_}<5s-Vq;i-sIt2nL~VL=)s_pn<*i2`^((yCR}u|</+j~xw|Q1eST' );
define( 'LOGGED_IN_SALT',   'f#v2ZC@TC_VQ|yKjCqr^s-ifGx?@sBl7o$~VAd n>_T~GqHeCAd!,F9d@.)OU]QO' );
define( 'NONCE_SALT',       'v@&EzHuo}6)ukSD^ifN(xx>=e_?UM/c-f_du{JA6i.QPE.Q.d6(7xNkj`A6B7i*t' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
