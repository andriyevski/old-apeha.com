<?php
$link = @mysql_connect("localhost","root","mix10009174794");
$db=@mysql_select_db("forsaken",$link);

$ac = mysql_query("SELECT money, name1 FROM akcii");

while ($ac_t=mysql_fetch_assoc($ac)){

	mysql_query("UPDATE players SET credits=credits+".($ac_t['money']/100)."*".$ac_t['name1']." WHERE ".$ac_t['name1'].">0");

	mysql_query("UPDATE akcii SET money=0.00 WHERE name1='".$ac_t['name1']."'");
}
?>