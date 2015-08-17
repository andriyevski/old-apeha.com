
<?
define('INSIDE', true);
$now=time();$time = time();

include("inc/db_connect.php");
require_once("inc/module.php");
$stat = mysql_fetch_array(mysql_query("SELECT * FROM `players` WHERE user='".addslashes($user)."' AND pass='".addslashes($pass)."'"));
mysql_query("SET CHARSET cp1251");
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";
mysql_query("UPDATE players SET room=62, lpv=".$now." WHERE user='".$stat['user']."'");


echo "<body bgcolor='#F5FFDA'>
<div id=hint1 class=hint></div>
<script src='i/inf.js'></script>
<script src='i/show_inf.js'></script>
<script src='i/time.js'></script>
	";
$castles=mysql_query("select * from castles");
echo "<table width='100%' height='100%'  cellspacing=0 cellpadding=0><tr><td width='52' style='background-image:url(/img/bs/land/211.png);background-repeat: repeat-y;'><img onmouseover=\"it('Ворота в город')\" onmouseout=\"c();\" src='/img/bs/land/206.png' onclick='top.frames[\"main\"].location = \"world5.php?room=67\"' onmouseover=\"cursor : hand;\"></td><td valign=top halign=left style='background-image:url(/img/bs/land/194.png);'>";
while($cas=mysql_fetch_array($castles)){
	echo "<img onmouseover=\"it('Замок клана $cas[clan]')\" onmouseout=\"c();\" onclick='top.frames[\"main\"].location = \"world5.php?room=67\"' src=$cas[image].gif>";
}
echo "<td width='52'  style='background-image:url(/img/bs/land/210.png);background-repeat: repeat-y;'></td></td></tr><table>";
?>