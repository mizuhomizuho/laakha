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


define('DISALLOW_FILE_MODS', true); // закроем установку плагинов


define('WP_CACHE', true);
define( 'WPCACHEHOME', '/usr/www/users/catweb/laakha.com/www/wp-content/plugins/wp-super-cache/' );
//$files=$_FILES;
//$_FILES=[];
//if(is_array($files) && $files){
//    foreach($files as $filesK=>$filesV){
//        
//        if(
//            isset($filesV['name'])
//            && preg_match('/\.(jpe?g|png|gif)$/iu',$filesV['name'])
//        ){
//            $isImage=@getimagesize($filesV['tmp_name']);
//
//            if(
//                is_array($isImage)
//                && isset($isImage[2])
//                && in_array($isImage[2],array(1,2,3)) // jpg, png, gif
//            ){
//                $_FILES[$filesK]=$filesV;
//            }
//        }
//    }
//}
//unset($files);
//
//define('DISALLOW_FILE_MODS', true);



// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'laakha' );

/** MySQL database username */
define( 'DB_USER', 'laakha' );

/** MySQL database password */
define( 'DB_PASSWORD', 'uZxX1za2YH8qfTP5' );

/** MySQL hostname */
define( 'DB_HOST', 'sql464.your-server.de' );

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
define( 'AUTH_KEY',         'vq>PHh:+*?F~.A9JT1gkPXZ$u8q=UXc;O+XI_r-;s|Z2.i4O>In!?$g^U=$z49$`' );
define( 'SECURE_AUTH_KEY',  '^Tz1?M%!OLgE-D?Bot#CaDYsY_>[+40R=8 +RDyjjHZZj*z9N&<F0=c8rP?O|pgU' );
define( 'LOGGED_IN_KEY',    '73z[&bf?p6NZ47|X>Y,D<ck8(JI1#/%1uL?uv!?&P{H(.;{u_ (#D5g{(35Uc_6@' );
define( 'NONCE_KEY',        'RU#R dV!7oPN3e<UA~IU8@=KrxVloQ-uIUa~|=4w z8F64L7!To~N-<2e3uMOO*+' );
define( 'AUTH_SALT',        '!d/la0r*J{g)*djZL5p*A0/J? @_*1VJ~SN#AAHH@jF<DD9!ngETm`<Tukz1@v|a' );
define( 'SECURE_AUTH_SALT', 'N/J35I2#:s<AI_tg&%L~&=F;`Oj^%eT(V_%0Y[Dg/{vZIaaf%ZbC={HcooS{zY<N' );
define( 'LOGGED_IN_SALT',   '9(y`~_{X~X+n>IT@IoZfH4${@4Bs^3DM Ul{^b8jH)V_7QdQW_Oo_e}N6--;(1$p' );
define( 'NONCE_SALT',       'B[*k_-&lI;9V.?CO.R-Mv3`025?C.tST.sw>Vwdy;9fv-_Dk?*`_O8<SF#l.I&ue' );

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
define('WP_DEBUG',TRUE);
define('WP_DEBUG_DISPLAY',FALSE);
define('WP_DEBUG_LOG',FALSE);
// Внимание!!! Еще нужно создать .htaccess в /wp-content с # Защита debug.log 
//<Files debug.log>
//    Order Deny,Allow
//    Deny from all
//</Files>

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
