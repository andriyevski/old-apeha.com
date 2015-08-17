
<noscript></noscript>
<?
include("inc/db_connect.php");
$num = mysql_num_rows(mysql_query("SELECT `id` FROM `players`"));
echo"Зарегестрировано: ".$num."";
?>
