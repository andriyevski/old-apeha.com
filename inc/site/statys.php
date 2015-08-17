<center><SPAN class=onni> <?

include("inc/db_connect.php");

include("time.php");

$num = mysql_num_rows(mysql_query("SELECT `id` FROM `players`"));

mysql_query("SET CHARSET cp1251");

echo"Всего Население: <b>".$num."</b> &#160";

print "<BR>Население <a style='CURSOR: Hand' onclick='window.open(\"whoonline.php\",\"\",\"width=300,height=1000, scrollbars=yes\")'><font color=blue><b>OnLine:</a></b></font> <b>".mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `lpv` > '".(time()-1200)."' OR `rank` = '60'"))."</b>";

?> </SPAN><br>
<br>
</center>



