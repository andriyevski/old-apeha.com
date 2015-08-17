<?
$now=time();

include("inc/db_connect.php");

$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));
mysql_query("SET CHARSET cp1251");
if ($stat[bloked]=="1") echo"<script>top.location='index.php?action=logout'</script>";

$reload=$stat['lpv']+10-$now;

if ($reload<5)
{

	mysql_query("UPDATE `players` SET `lpv` = '".time()."' WHERE `id` ='".$stat['id']."' LIMIT 1");


	?>
<html>
<head>
<script language='javascript'>
    parent.main.location.reload();
    parent.chat.location.reload();
    parent.online.location.reload();
  </script>
</head>
</html>
	<?
}
?>
<html>
<head>
<meta http-equiv="Refresh" content="<?=$reload?>">
</head>
</html>
