<?
include("inc/db_connect.php");

$id = mysql_escape_string($_SERVER['QUERY_STRING']);

if (!is_numeric($id) || strlen($id) == 0) echo"Error!";
else {
	$login=mysql_fetch_array(mysql_query("SELECT * FROM top WHERE clan_id='".$id."'"));

	if (!empty($login['clan'])) {

		$ip=GetEnv("REMOTE_ADDR");
		$now=time();

		$res=mysql_fetch_array(mysql_query("SELECT `id` FROM moneys where ip='".$ip."' AND time>$now-86400"));
		$col=mysql_fetch_array(mysql_query("SELECT count(*) as count FROM moneys where id='".$id."'"));

		if ($col['count']<=2000) {
			if (empty($res['id'])) {

				mysql_query("INSERT INTO moneys values ('".$login['clan_id']."','$ip','$now')");
				if(!empty($ip)){
					$lvl=$login['level']+1;
					mysql_query("UPDATE top set rfs=rfs+1 where clan_id='".$login['clan_id']."'");
					//mysql_query("UPDATE players set rfskonk=rfskonk+1 where id='".$login['id']."'");//для конкурса рефералов отсекать общее кол-во кликов
				}




			}
		}

	}

	mysql_close($link);

	$host=GetEnv("HTTP_HOST");
	Header("Location: http://$host/index.php?type=reg");

}
?>