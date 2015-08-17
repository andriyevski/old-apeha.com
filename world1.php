<?

include("inc/db_connect.php");
$now=time();

$stat = mysql_fetch_array(mysql_query("select user, bloked, t_time, v_time, k_time, vault_time, vault_move, room, level from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));
  mysql_query("SET CHARSET cp1251");
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat['t_time']) { print"<SCRIPT>location.href='prison.php'</SCRIPT>"; exit; }
elseif ($stat['v_time']) { print"<SCRIPT>location.href='ambulance.php'</SCRIPT>"; exit; }
elseif ($stat['k_time']) {print"<SCRIPT>location.href='academy.php'</SCRIPT>"; exit; }

else {

if (($stat['room']>200 && $stat['room']<=230) || ($stat['vault_time'] > $now && $stat['vault_move'] == 1)) {
        header("Location: vault.php");
        exit;
}

###Магазин
if ($room=="22") {

mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");

echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"reception.php\";
top.frames['online'].location = top.frames['online'].location;
//-->
</SCRIPT>
";

exit();

}

###

###Магазин Берёзка
###

###Больница
if ($room=="8") {


mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");


echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"ambulance.php\";
top.frames['online'].location = top.frames['online'].location;
//-->
</SCRIPT>
";

exit();

}
###


###Академия
###


###Банк
###



###Кузница
###



### Игорный дом
###


### Магазин подарков
###

### Магазин ТТ
###


### Врата подземелья
###





###Глав. Площадь
if ($room == "0" || empty($room)) {

$room = 0;


mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");

echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['online'].location = top.frames['online'].location;
//-->
</SCRIPT>
";

}
###

include('inc/html_header.php');

echo"
<body bgcolor=#EBEDEC leftmargin=0 topmargin=0>
<script language=\"javascript\" type=\"text/javascript\">
function imover(im)
{
  im.filters.Glow.Enabled=true;
}
function imout(im)
{
  im.filters.Glow.Enabled=false;
}
function m1()
{
  alert('Проход закрыт!');
}
</script>
<style type=\"text/css\">
img.aFilter {
  filter:Glow(color=#FFFFFF,Strength=4,Enabled=0);
  cursor:hand
}
hr {
  height: 1px;
                  }
</style>
<table width=100% height=100% border=0 cellpadding=0 cellspacing=0>
 <tr>
     <td width=71%>&nbsp;</td>
     <td align=center valign=middle>
     <div style=\"position:relative; id=\"ione\"><img src=i/world/CP1.jpg alt='' border=1 galleryimg=no width=700 height=320>
     <div style=\"position:absolute; left:200px; top:170px; width:280px; height:290px; z-index:90; filter:progid:DXImageTransform.Microsoft.Alpha( Opacity=100, Style=0);\"><img src=i/world/0.gif width=\"300\" height=\"128\" alt='Робота' class=aFilter onmouseover=\"imover(this);\" onmouseout=\"imout(this)\" onclick='top.frames[\"main\"].location = \"forest.php?set=map&room=45&tmp=\"+Math.random();\"\"'></div>
     

     </div>
     </td>
     <td width=50%></td>
 </tr>
</table>
</body>
";
}

?>
<input type=button onclick='top.frames["main"].location = "world.php?ModalResult2="+Math.random();""' style="position:absolute; left:60px; top:25px; CURSOR: Hand; WIDTH: 200px; HEIGHT: 20px;" value='Центральная Площадь' class=input onmouseover="hint('Перейти на Центральную Площадь);" onmouseout="c();">
