<?
include("inc/db_connect.php");
$time=date("H:i");

if ($time=="00:00") { mysql_query("UPDATE abils set c_iznos=0");
}
echo "test";
?>