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
define( 'DB_NAME', 'platzigift' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         '&&`bm0|&Y22^a_:]fkI<LBPYHVRJ|FSgWtZ+IE-6~]grmb&E%i%rE7_z#{r+KHI+');
define('SECURE_AUTH_KEY',  'ddXoE5$8TXmiEtG>=I1TmI-_6>4-6K_nU^iWa-{S8q pu0>-[z1|W,[u|+L@.Yis');
define('LOGGED_IN_KEY',    'qg2^Hk8xK=1P44sGksC|ZTYid5`Z5H-KTzSbgABS8=(ELv!]zRWlLpZKg^yR+rJ$');
define('NONCE_KEY',        'vIZL ~A?sc/3TxXzYR/: 9UqRNz-]6AjPC=_b[x(=Bp<nlMRF!_GiLe`C{m_q3?T');
define('AUTH_SALT',        'y~@^UD#VzM-4Lj.+[oND)ym[U(!~[LPEO{Nx!JGHpzmcJ~7S7S.eXj+uI,&;^[|G');
define('SECURE_AUTH_SALT', '~.l;USQ{xxxi1CX.>?.ycMTSMg}|2:y{.dH!Q*=l{d]iD$]^(Apxk0p+^HFFSG[-');
define('LOGGED_IN_SALT',   'F+Tau=-yEywkhdB5=%x[[&:Z SXG=>R|&-P,Q=[#@q?Y9+%QVwLA3f.]O!ws4T<X');
define('NONCE_SALT',       ':`4UG?gI#KF)m!-JSANzXDS7D=<A-S=0gZqDiw@:e9h^`w(4in-o+ToO/HH@}#!c');

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
define( 'FS_METHOD', 'direct' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
