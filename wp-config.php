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
define('DB_NAME', 'sweetuni_devit');

/** MySQL database username */
define('DB_USER', 'sweetuni_devit');

/** MySQL database password */
define('DB_PASSWORD', '19inh;RR5)');

/** MySQL hostname */
define('DB_HOST', 'sweetuni.mysql.tools');

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
define('AUTH_KEY',         'XloONVC3qgKSs7HE)PF5@@np4tojq7*V5#qPiK!8KmbbrERywhWKMgJDfx^2jJI4');
define('SECURE_AUTH_KEY',  'JFr2RFjGDM9*CnRCsi&@N%VDleejSZwB6Ftx7woinAtK@O1jBi698##wJ#4v*1Yt');
define('LOGGED_IN_KEY',    ')lyT0*mCbgDx0MpM@)cQPM1%LXf7aouRMT6q3wXYigOWTnKfTnshOC6sbW!ZO8yV');
define('NONCE_KEY',        'a4d0!vUX)!qOltZpkKaFisKpaKKifspb!!f38kL68KlBnQlN&mg3VM1N%CJDotz^');
define('AUTH_SALT',        '9P8vTWIXMDuqaVcAxQbde%6el0#h@(Emvy^fMy%sQRvpiZI!75NJZKfhBwBoJd7k');
define('SECURE_AUTH_SALT', 'BaGozSy*)qyu#xRSsd8E8vpoj%Tg6*dL@FJsfz1SX)Xr)hi8x1@1B3Acs4mk^^TG');
define('LOGGED_IN_SALT',   '0xb22Ui64PRvN8oI0rIAg0P3ieasaywo7YjgfB79e76T!os#m!CE(SBct%WiwCIk');
define('NONCE_SALT',       'gOHX4AXTmy0SY(h9Q^ZDrrbKDJ17J(6xY0Q5j@PUBklHtAq4O74xX*@(cL1H!KW@');
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

define( 'WP_ALLOW_MULTISITE', true );

define ('FS_METHOD', 'direct');
