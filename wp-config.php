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
define( 'DB_NAME', 'sbiteogo_wp95' );

/** MySQL database username */
define( 'DB_USER', 'sbiteogo_wp95' );

/** MySQL database password */
define( 'DB_PASSWORD', '8pl]8)mSX5b.2(' );

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
define( 'AUTH_KEY',         'wru1xtmhjiyg0hqrs1fjqakbxlazuwontitpyoxkcszpy3f6pqmnspb3nlcadiqf' );
define( 'SECURE_AUTH_KEY',  '32xubup5rnetjlaucauiz73euwxrxczsthyy9h5pornsfxgd9o2dpdmqxnvtfoyw' );
define( 'LOGGED_IN_KEY',    'oq0ijnouiho7j3oaejns7gqdxwqn7wp5ptqsvapvn8oyredtoewqckkubiqlgiis' );
define( 'NONCE_KEY',        'cyum7ncmlw8hqwimg50lrbsemsvuelj6c6okvoki1bbtemo8ij1skjbdmpqljzp4' );
define( 'AUTH_SALT',        '41cpzjwufwiboo3dsoredgnuqzojwbkpriczwlqtkqsdjzqoxllp5bqmueincj4d' );
define( 'SECURE_AUTH_SALT', 'qeb0qwhycdi0m813rtpppl1qeydsxxzacjegi4hkfht7cn1b0i8w4sqanxgg3qym' );
define( 'LOGGED_IN_SALT',   'vibn5cmt6tqgsks9ysommh1uknppmxlywgg9hhb55yhb4neiche23gziwuo6dnny' );
define( 'NONCE_SALT',       'mwosxffzx0d6fmndwbrjhaldo3edinffm1fllmdpbkkv8a9k4nh875txpxp5zicr' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpx8_';

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
