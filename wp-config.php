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
define('DB_NAME', 'timduongtat');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '123');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
 */
define('AUTH_KEY',         '5QtA^#(MBuxUVE`rF)o/]x;?EA) ibE{@]VXhX 5GV+6JJ;<s:~(a{ge$L265B.1');
define('SECURE_AUTH_KEY',  'pKdg9]4^#]VX=j#MOg{A3DJN`3.?7pf*i65BbAejw )J=5%Ew,`8vU@CcH,Z@|j3');
define('LOGGED_IN_KEY',    '~54%K5,JV^:nVrtv*~tx$MN``d7cJCmT5J9s-v|j9!7<y@#-cjMrH-x2*=zOL3E>');
define('NONCE_KEY',        'maqZQ_TQxdFdrlLB_A==uP/Q|bBbdxr6n]Y*DVuP~5zIt,~BzDqx}==o4RkP!_9+');
define('AUTH_SALT',        '$l>CA>dJMp)AhbNp`jXp?LwWAy$y3-2que90ve~qKGf;I0]o?zM7jBg+J(HL>dC_');
define('SECURE_AUTH_SALT', 'Wsk0Jw>_>d@7GlxSNHlU&7gJ/71C7[?2c!IM~(E<81Q~A00o<9sbtjDf=pd:huq(');
define('LOGGED_IN_SALT',   'J1N6&=`#Jb3Eg<`{del]y8>lyJ~p}I%NEE1{4]v-K(=0;Y+r!jk}EJaG#H/WPw}y');
define('NONCE_SALT',       '-3`}?mp=aCT8S^n)r!*1kpXJ`>23V!XF>$3ASFHo[R*=vzF@0Y312)yhR@e%:4mI');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'tt_';

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
