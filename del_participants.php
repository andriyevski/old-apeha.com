<?
include "inc/db_connect.php";
include("inc/html_header.php");
?>

<?
$S = mysql_query("SELECT * FROM participants where (`time` < ".(time()-259200)." ) ORDER by ID ASC");
while ($news = mysql_fetch_array($S)){
	$i++;
	$ID = $news["id"];
	$lpv = $news["participants"];
	$time=floor(time() - $info['time']);
	print "$i $ID $time <br>";
	$qq=mysql_query("DELETE FROM participants WHERE id='$ID' ");
}
?>