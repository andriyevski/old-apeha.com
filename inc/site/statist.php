
<?
include("config/config.php");
include("config/time.php");
$num = mysql_num_rows(mysql_query("SELECT `id` FROM `person`"));
mysql_query("SET CHARSET cp1251");
echo"Всего жителей: <b><font color=993300>".$num."</font></b> &#160";
print "<noBR>Жителей <a style='CURSOR: Hand' onclick='window.open(\"person/whoonline.php\",\"\",\"width=300,height=1000, scrollbars=yes\")'><font size=2><b>OnLine:</a></b></font> <b><font color=993300>".mysql_num_rows(mysql_query("SELECT `id` FROM `person` WHERE `lpv` > '".(time()-180)."'"))."</font></b>";
print "&nbsp; <nobr>Сегодня родились: <font color=993300><b>".mysql_num_rows(mysql_query("select id from person WHERE birthdate LIKE '".$birt_d.".".$birt_m.".".$birt_y."%'"))."</font></b>";
?>


