<?
// Enter your MySQL settings below
$mysql_server = "localhost";
$mysql_user = "";
$mysql_pass = "";
$mysql_database = "langels_database";
if(!empty($_SESSION)){extract($_SESSION);}
if(!empty($_COOKIE)){extract($_COOKIE);}
if(!empty($_REQUEST)){extract($_REQUEST);}


// Enter your language (see the avaliables in the /lang directory):

$lang = "ru"; // default to "en" for English -- but later select lang from users table

if(@$_COOKIE['lang']){
	$lang= $_COOKIE['lang'];
}

$SITETITLE = "Phaos - 3E Productions";

// Enter your MySQL settings and $SITETITLE in this file
@include 'config_settings.php';

//removing 1st class security risk
if(file_exists('phaos.cfg')){
	unlink('phaos.cfg');
}

$connection = mysql_connect("localhost","langels_db","QEY1ejY8aJzM") or die ("Unable to connect to MySQL server.");
$db = mysql_select_db("langels_database") or die ("Unable to select requested database.");
mysql_query("SET CHARSET cp1251");
//Sanity check
$query = "SELECT 1 FROM players LIMIT 1";
$result = mysql_query($query);
if (!mysql_fetch_array($result)){
	die('Missing tables in the database - please import the structure and the data.');
}

// INITIAL SETUP
define('DEBUG',intval(@$_COOKIE['_debug']));
if(DEBUG){
	error_reporting(E_ALL);
}else{
	error_reporting(E_ERROR | E_PARSE);
}
$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));
$name=$stat['user'];
$pass=$stat['pass'];

$PHP_PHAOS_USER = $name;
$PHP_PHAOS_PW = $pass;// for compatibility with old accounts
$PHP_PHAOS_MD5PW = $pass;

$PHP_ADMIN_USER = @$_COOKIE["PHP_ADMIN_USER"];
$PHP_ADMIN_PW = @$_COOKIE["PHP_ADMIN_PW"];// for compatibility with old accounts
$PHP_ADMIN_MD5PW = @$_COOKIE["PHP_ADMIN_MD5PW"];

// FIXME: security hole
foreach($_GET as $key=>$value) {
	$$key = get_magic_quotes_gpc() ? $value : addslashes($value);
}
foreach($_POST as $key=>$value) {
	$$key = get_magic_quotes_gpc() ? $value : addslashes($value);
}

// Additional Security Check
unset($PHP_PHAOS_CHARID);
unset($PHP_PHAOS_CHAR);

$auth = false;
if(@$PHP_PHAOS_USER && ((@$PHP_PHAOS_MD5PW)||(@$PHP_PHAOS_PW)) ) {

	if(@$PHP_PHAOS_MD5PW){
		$query = "SELECT * FROM players WHERE user = '$PHP_PHAOS_USER' AND pass = '$PHP_PHAOS_MD5PW'";
		$result = mysql_query($query);
		$row= mysql_fetch_array($result);
	}

	if(!@$row){
		$PHP_PHAOS_MD5PW= md5(@$PHP_PHAOS_PW);
		$query = "SELECT * FROM players WHERE user = '$PHP_PHAOS_USER' AND pass = '$PHP_PHAOS_MD5PW'";
		$result = mysql_query($query);
		$row= mysql_fetch_array($result);
	}

	if ($row) {
		$auth = true;
		$lang = $row['lang'];
		$result = mysql_query("SELECT * FROM players WHERE user = '$PHP_PHAOS_USER'");
		if ($row = mysql_fetch_array($result)) {
			$PHP_PHAOS_CHARID	= $row['id'];
			$PHP_PHAOS_CHAR		= $row['user'];
		} else {
			$PHP_PHAOS_CHARID=0;
		}

		if(defined('AUTH')){
			setcookie("PHP_PHAOS_USER",$PHP_PHAOS_USER,time()+17280000); // ( REMEMBERS USER NAME FOR 200 DAYS )
			setcookie("PHP_PHAOS_MD5PW",$PHP_PHAOS_MD5PW,time()+172800); // ( REMEMBERS USER pass FOR 2 DAYS )
			setcookie('lang',$lang,time()+17280000); // ( REMEMBERS LANGUAGE FOR 200 DAYS )
			setcookie("PHP_PHAOS_PW",0,time()-3600); // remove cookie used in version 0.88
		}
	} else {
		echo("<p style=\"background:black\"><hr width=10%><p><center><font size=+1 color=red>Bad User Name or pass</font></p>
            <hr width=10%>
            <p>If you do not already have a character, please Register first!</p>");
		if(!defined('AUTH')){
			exit;
		}
	}
}
?>
