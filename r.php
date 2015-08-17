<?   session_start();
include("inc/db_connect.php");

$id = mysql_escape_string($_SERVER['QUERY_STRING']);

if (!is_numeric($id) || strlen($id) == 0) echo"Error!";
else {
	$login=mysql_fetch_array(mysql_query("SELECT * FROM players WHERE id='".$id."'"));
    $ips=mysql_fetch_array(mysql_query("SELECT * FROM security WHERE user='".$login['user']."' order by id desc limit 1"));
	if (!empty($login['user'])) {

		$ip=GetEnv("REMOTE_ADDR");
		$now=time();

		$res=mysql_fetch_array(mysql_query("SELECT `id` FROM moneys where ip='".$ip."' AND time>$now-86400"));
		$col=mysql_fetch_array(mysql_query("SELECT count(*) as count FROM moneys where id='".$id."' AND time>$now-86400"));

		if ($col['count']<=2000) {
			if (empty($res['id']) and !empty($ip)) {

				mysql_query("INSERT INTO moneys values ('".$login['id']."','$ip','$now')");

				$lvl=$login['level']+1;

				//для конкурса рефералов отсекать общее кол-во кликов
                $_SESSION['ref']=$login['id'];$_SESSION['ip']=$ips['ip'];
				SetCookie("us", $login['id']);





			}
		}

	}

	mysql_close($link);

	$host=GetEnv("HTTP_HOST");
	Header("Location: http://$host/index.php?type=reg");

}
?>