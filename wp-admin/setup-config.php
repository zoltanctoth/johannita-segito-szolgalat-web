<?php
/**
 * Retrieves and creates the wp-config.php file.
 *
 * The permissions for the base directory must allow for writing files in order
 * for the wp-config.php to be created using this page.
 *
 * @internal This file must be parsable by PHP4.
 *
 * @package WordPress
 * @subpackage Administration
 */

/**
 * We are installing.
 *
 * @package WordPress
 */
define('WP_INSTALLING', true);

/**
 * We are blissfully unaware of anything.
 */
define('WP_SETUP_CONFIG', true);

/**
 * Disable error reporting
 *
 * Set this to error_reporting( E_ALL ) or error_reporting( E_ALL | E_STRICT ) for debugging
 */
error_reporting(0);
/**#@+
 * These three defines are required to allow us to use require_wp_db() to load
 * the database class while being wp-content/db.php aware.
 * @ignore
 */
define('ABSPATH', dirname(dirname(__FILE__)).'/');
define('WPINC', 'wp-includes');
define('WP_CONTENT_DIR', ABSPATH . 'wp-content');
define('WP_DEBUG', false);
/**#@-*/

require_once(ABSPATH . WPINC . '/load.php');
require_once(ABSPATH . WPINC . '/version.php');
wp_check_php_mysql_versions();

require_once(ABSPATH . WPINC . '/compat.php');
require_once(ABSPATH . WPINC . '/functions.php');
require_once(ABSPATH . WPINC . '/class-wp-error.php');

if (!file_exists(ABSPATH . 'wp-config-sample.php'))
	wp_die('Sajnálom, de a működéshez szükség van a wp-config-sample.php fájlra. Kérem újra feltölteni a telepítő csomagból.');

$configFile = file(ABSPATH . 'wp-config-sample.php');

// Check if wp-config.php has been created
if (file_exists(ABSPATH . 'wp-config.php'))
	wp_die("<p>A 'wp-config.php' fájl létezik. Ha szükség van bármilyen beállítási lehetőség újra állításához a fájlban, akkor először le kell törölni. Ezután meg kell próbálni <a href='install.php'> fájlt telepíteni</a>.</p>");

// Check if wp-config.php exists above the root directory
if (file_exists(ABSPATH . '../wp-config.php') && ! file_exists(ABSPATH . '../wp-settings.php'))
	wp_die("<p>A 'wp-config.php' már létezik egy könyvtárral a WordPress telepítési könyvtára felett. Ha bármilyen beállítást újra be szeretnénk állítani, előbb törölni kell a fájlt. Ezután <a href='install.php'>elkezdhetö a telepítés</a>.</p>");
	

if (isset($_GET['step']))
	$step = $_GET['step'];
else
	$step = 0;

/**
 * Display setup wp-config.php file header.
 *
 * @ignore
 * @since 2.3.0
 * @package WordPress
 * @subpackage Installer_WP_Config
 */
function display_header() {
	header( 'Content-Type: text/html; charset=utf-8' );
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WordPress &rsaquo; telepítési beállítások</title>
<link rel="stylesheet" href="css/install.css" type="text/css" />

</head>
<body>
<h1 id="logo"><img alt="WordPress" src="images/wordpress-logo.png" /></h1>
<?php
}//end function display_header();

switch($step) {
	case 0:
		display_header();
?>

<p>Üdvözöl a WordPress! A telepítés előtt szükségünk van némi információra az adatbázissal kapcsolatban. A folytatáshoz ismerni kell a következő paramétereket:</p>
<ol>
	<li>Adatbázis neve</li>
	<li>Adatbázis felhasználónév</li>
	<li>Adatbázis jelszó</li>
	<li>Adatbázis szerver címe</li>
	<li>Tábla előtag (ha egynél több WordPress-t szeretnénk egy adatbázisba telepíteni) </li>
</ol>
<p><strong>Ha bármilyen okból nem működik az automatikus fájl-létrehozás, nem kell aggódni. Csak annyi történik, hogy az adatbázis információkat kitölti a konfigurációs fájlban. Egy szövegszerkesztővel (nem Word!) meg kell nyitni a <code>wp-config-sample.php</code> fájlt és kitölteni az információkat, majd elmenteni <code>wp-config.php</code> néven. </strong></p>
<p>Nagy valószínűséggel az internet szolgáltató megadta ezeket az információkat. Ha mégsem állnak rendelkezésre ezek az adatok, akkor a folytatás előtt fel kell venni a kapcsolatot velük. Ha, készen vagyunk&hellip;</p>

<p class="step"><a href="setup-config.php?step=1<?php if ( isset( $_GET['noapi'] ) ) echo '&amp;noapi'; ?>" class="button">Lássunk neki!</a></p>
<?php
	break;

	case 1:
		display_header();
	?>
<form method="post" action="setup-config.php?step=2">
	<p>Lejjebb meg kell adni az adatbázis kapcsolat tulajdonságait. Ha nem vagyunk biztosak bennük, fel kell venni a kapcsolatot a szolgáltatóval. </p>
	<table class="form-table">
		<tr>
			<th scope="row">Adatbázis név</th>
			<td><input name="dbname" id="dbname" type="text" size="25" value="wordpress" /></td>
			<td>Az adatbázis neve, amelyben a WP használatba kerül. </td>
		</tr>
		<tr>
			<th scope="row">Felhasználónév</th>
			<td><input name="uname" id="uname" type="text" size="25" value="adatbázis felhasználó név" /></td>
			<td>MySQL felhasználónév</td>
		</tr>
		<tr>
			<th scope="row">Jelszó</th>
			<td><input name="pwd" id="pwd" type="text" size="25" value="adatbázis jelszó" /></td>
			<td>...és a MySQL jelszó.</td>
		</tr>
		<tr>
			<th scope="row">Adatbázis kiszolgáló címe</th>
			<td><input name="dbhost" id="dbhost" type="text" size="25" value="localhost" /></td>
			<td>99%-ig biztos, hogy ezen nem kell változtatni.</td>
		</tr>
		<tr>
			<th scope="row">Tábla előtag</th>
			<td><input name="prefix" id="prefix" type="text" id="prefix" value="wp_" size="25" /></td>
			<td>Ha több WordPress-t szeretnénk telepíteni egy adatbázisra, akkor ezt meg kell változtatni.</td>
		</tr>
	</table>
	<?php if ( isset( $_GET['noapi'] ) ) { ?><input name="noapi" type="hidden" value="true" /><?php } ?>
	<p class="step"><input name="submit" type="submit" value="Mehet!" class="button" /></p>
</form>
<?php
	break;

	case 2:
	$dbname  = trim($_POST['dbname']);
	$uname   = trim($_POST['uname']);
	$passwrd = trim($_POST['pwd']);
	$dbhost  = trim($_POST['dbhost']);
	$prefix  = trim($_POST['prefix']);
	if ( empty($prefix) )
		$prefix = 'wp_';

	// Validate $prefix: it can only contain letters, numbers and underscores
	if ( preg_match( '|[^a-z0-9_]|i', $prefix ) )
		wp_die( /*WP_I18N_BAD_PREFIX*/'<strong>HIBA</strong>: "Tábla előtag" csak számokat, betűket és alulvonást tartalmazhat.'/*/WP_I18N_BAD_PREFIX*/ );

	// Test the db connection.
	/**#@+
	 * @ignore
	 */
	define('DB_NAME', $dbname);
	define('DB_USER', $uname);
	define('DB_PASSWORD', $passwrd);
	define('DB_HOST', $dbhost);
	/**#@-*/

	// We'll fail here if the values are no good.
	require_wp_db();
	if ( ! empty( $wpdb->error ) ) {
		$back = '<p class="step"><a href="setup-config.php?step=1" onclick="javascript:history.go(-1);return false;" class="button">Próbáljuk újra!</a></p>';
		wp_die( $wpdb->error->get_error_message() . $back );
	}

	// Fetch or generate keys and salts.
	$no_api = isset( $_POST['noapi'] );
	require_once( ABSPATH . WPINC . '/plugin.php' );
	require_once( ABSPATH . WPINC . '/l10n.php' );
	require_once( ABSPATH . WPINC . '/pomo/translations.php' );
	if ( ! $no_api ) {
		require_once( ABSPATH . WPINC . '/class-http.php' );
		require_once( ABSPATH . WPINC . '/http.php' );
		wp_fix_server_vars();
		/**#@+
		 * @ignore
		 */
		function get_bloginfo() {
			return ( ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . str_replace( $_SERVER['PHP_SELF'], '/wp-admin/setup-config.php', '' ) );
		}
		/**#@-*/
		$secret_keys = wp_remote_get( 'https://api.wordpress.org/secret-key/1.1/salt/' );
	}

	if ( $no_api || is_wp_error( $secret_keys ) ) {
		$secret_keys = array();
		require_once( ABSPATH . WPINC . '/pluggable.php' );
		for ( $i = 0; $i < 8; $i++ ) {
			$secret_keys[] = wp_generate_password( 64, true, true );
		}
	} else {
		$secret_keys = explode( "\n", wp_remote_retrieve_body( $secret_keys ) );
		foreach ( $secret_keys as $k => $v ) {
			$secret_keys[$k] = substr( $v, 28, 64 );
		}
	}
	$key = 0;

	foreach ($configFile as $line_num => $line) {
		switch (substr($line,0,16)) {
			case "define('DB_NAME'":
				$configFile[$line_num] = str_replace("adatbázisodneve", $dbname, $line);
				break;
			case "define('DB_USER'":
				$configFile[$line_num] = str_replace("'felhasználóneved'", "'$uname'", $line);
				break;
			case "define('DB_PASSW":
				$configFile[$line_num] = str_replace("'jelszavad'", "'$passwrd'", $line);
				break;
			case "define('DB_HOST'":
				$configFile[$line_num] = str_replace("localhost", $dbhost, $line);
				break;
			case '$table_prefix  =':
				$configFile[$line_num] = str_replace('wp_', $prefix, $line);
				break;
			case "define('AUTH_KEY":
			case "define('SECURE_A":
			case "define('LOGGED_I":
			case "define('NONCE_KE":
			case "define('AUTH_SAL":
			case "define('SECURE_A":
			case "define('LOGGED_I":
			case "define('NONCE_SA":
				$configFile[$line_num] = str_replace('írj ide valami nagyon bonyolultat', $secret_keys[$key++], $line );
				break;
		}
	}
	if ( ! is_writable(ABSPATH) ) :
		display_header();
?>
<p>Sajnálom, nem írható a <code>wp-config.php</code> fájl.</p>
<p>Létre lehet hozni a <code>wp-config.php</code> fájlt kézzel is, a következő sorok beillesztésével.</p>
<textarea cols="98" rows="15" class="code"><?php
		foreach( $configFile as $line ) {
			echo htmlentities($line, ENT_COMPAT, 'UTF-8');
		}
?></textarea>
<p>Miután kész, folytatáshoz nyomjuk meg a "Telepítés elkezdése" gombot.</p>
<p class="step"><a href="install.php" class="button">Telepítés elkezdése</a></p>
<?php
	else :
		$handle = fopen(ABSPATH . 'wp-config.php', 'w');
		foreach( $configFile as $line ) {
			fwrite($handle, $line);
		}
		fclose($handle);
		chmod(ABSPATH . 'wp-config.php', 0666);
		display_header();
?>
<p>Eddig jó! A telepítésnek ezzel a részével meg is lennénk. A WordPress most már képes kommunikálni az adatbázissal. Ha készen állunk, itt az ideje&hellip;</p>

<p class="step"><a href="install.php" class="button">Elkezdeni a telepítést</a></p>
<?php
        endif;
	break;
}
?>
</body>
</html>
