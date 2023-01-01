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
define('DB_NAME', 'ڈیٹا بیس کا نام');

/** MySQL database username */
define('DB_USER', 'یوزر کا نام');

/** MySQL database password */
define('DB_PASSWORD', 'ڈیٹا بیس کا پاسورڈ ۔ لوکل ہوسٹ پر یہ جگہ خالی ہوتی ہے بالعموم');

/** MySQL hostname */
define('DB_HOST', 'جو بھی ہوسٹ ہے۔ اکثر یہاں بس لوکل ہوسٹ لکھا ہوتا ہے');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
 * آپ درج بالا لنک کو براؤزر میں کھولیں اور وہاں سے کاپی کر لیں سالٹ کیز
 */
define('AUTH_KEY',         'lp7Jbb$7$%=MP<O.dWVv}o4$b}01n}xbB0c2Lr5]A/tC3!0GnM95ngXCoU9+`gD5');
define('SECURE_AUTH_KEY',  'E:]IZ[ Sns{|B-Z|%!H;zV`r(@x+HL*h+C-lBVrh`ABK{,eLcP-LK}H;}AgY)Wy ');
define('LOGGED_IN_KEY',    '{uk,VM|fTc2a0w1g|~YqkWuX$`Y8{i+^I0IUEX~|%gy/2N[ =j3:tqR|HQ-2T/1p');
define('NONCE_KEY',        '<uB%ko|s!bQxwy[Elx@a.Bx8G_C?|+y~uhme-8b56xe[5|D*v|Uo6_5M !x:MZm+');
define('AUTH_SALT',        'HEO-%}wcEasf^+I>%8hh>7ZQv@KbT~R;zzHQF^iEYJ;-L,Yfb+3CAK1u)!9%N&hK');
define('SECURE_AUTH_SALT', 'h+z3JhnG7U#?0TV-G3H|CG~${A)=3?]#C-oR+)F}>o!X! xHg-Xk,5$Bu<ID.YhI');
define('LOGGED_IN_SALT',   '%a;!kBM4(]:CvO7}ta4[[=wuy(a?[p&@/^fqWI+QaN|Cz|/q%f;:^+I;AVA<W`<!');
define('NONCE_SALT',       '(:4)qVc@+^G<ff$ND8[G6]p<$_sd{SPvWg<L*$%@}QlW(>uf9BcOpifoky(3&9Or');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'یہاں ڈیٹا بیس کا پر فکس جو آپ دینا چاہیں';

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
 * یہاں آپ ٹرو لکھ سکتے ہیں جب تک ڈویلپمنٹ جاری ہے۔ جب سائٹ مکمل ہو جائے تو پھر فالس لازمی لکھیں
 */
define('WP_DEBUG', true);

/**اگر آپ چاہتے ہیں کہ فرنٹ اینڈ پر ایرر دکھائی نہ دیں تو یہ استعمال کریں **/

define('WP_DEBUG_DISPLAY', false);

/**ورڈ پریس کو آٹو اپڈیٹ کرنے کے لئے**/

define('WP_AUTO_UPDATE_CORE', true);

/**پلگنس کو اپ ڈیٹ کرنے کے لئے ۔**/

add_filter( 'auto_update_plugin', '__return_true' );

/**تھیمز کو اپ ڈیٹ کرنے کے لئے**/

add_filter( 'auto_update_theme', '__return_true' );

/**میمری یعنی کوٹہ بڑھانے کے لئے**/

define( 'WP_MEMORY_LIMIT', '256M' );

/**اگر آپ چاہتے ہیں کہ کوئی فائلوں کو ایڈٹ نہ کر سکیں یعنی کوڈ وغیرہ تو یہ گُر استعمال کریں**/

define('DISALLOW_FILE_EDIT', true);

/* That's all, stop editing! Happy blogging. */
/* ان کو ایسے ہی رہنے دیں ڈیفالٹ حالت میں۔ 
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');