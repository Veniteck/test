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
define( 'DB_NAME', 'edewp' );

/** MySQL database username */
define( 'DB_USER', '' );

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
define( 'AUTH_KEY',         '945AL3S=|6?$?{QBVWzZQgC!xUI#{1rPZFiRfb%`o1q0@4}}W!.P 5y&3kl*v+U1' );
define( 'SECURE_AUTH_KEY',  't;!59rlI#Ij Kb6?54xjnXDD)Yq><&9_XU)pg.Nlox!%U_/Q3v<AAN~,nf5e+ag9' );
define( 'LOGGED_IN_KEY',    ',`J{*hoN1xAw/u1v `H{wo3HCd,T0h+fo:WBF6XERNoRh6%ux]Uw8IFr/-g02ccv' );
define( 'NONCE_KEY',        '$(IT[YVv](jRjudw}If@,YF>1DV?7)qIy:~+[w7el%G@u:%Ea}#r)E2&ZW=%.sk:' );
define( 'AUTH_SALT',        '+^N8!DE?y^enU>ZW.W7i/HM}ZF)D41CO>;-HqK?Q^8V0?O(p~IbH[ /rv83Lv29i' );
define( 'SECURE_AUTH_SALT', 'l|FHT zko^DlN!${F-4uT6k(A|1Q&j]7@:bh#iCm27M&Md}0$K*5vu*]r-2]ub&Y' );
define( 'LOGGED_IN_SALT',   '=tG*(tF)MYj9`D[,$M6Cew$k2J&n$5x+8b?uza+/@|szq<HFl48bfAIu>AJL]+/ ' );
define( 'NONCE_SALT',       '/H)$G?&/C[EeDL_UU(;ZSY6-RIl,``hvf9UiqTrdW/Lb^(k,yvhnwNM]{+8_%h.&' );

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
