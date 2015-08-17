<?

require_once("inc/module.php");
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat['t_time']>$now) { print"<SCRIPT>location.href='prison.php'</SCRIPT>"; exit; }
elseif ($stat['k_time']>$now) { print"<SCRIPT>location.href='academy.php'</SCRIPT>"; exit; }
elseif ($stat['o_time']>$now) { print"<SCRIPT>location.href='juvelir.php'</SCRIPT>"; exit; }
elseif ($stat['r_time']>$now) { print"<SCRIPT>location.href='podzem.php'</SCRIPT>"; exit; } 
elseif ($stat['lov_time']>$now) { print"<SCRIPT>location.href='more.php'</SCRIPT>"; exit; } 
elseif ($stat['mol_bog_swet']>$now) { /*header("Location: bog_hram.php")*/print"<SCRIPT>location.href='bog_hram.php'</SCRIPT>"; exit; }
elseif ($stat['mol_bog_tima']>$now) { /*header("Location: bog_hram.php")*/print"<SCRIPT>location.href='bog_hram.php'</SCRIPT>"; exit; } 
elseif ($stat[battle]) { print"<SCRIPT>location.href='battle.php'</SCRIPT>"; exit; }
else {

if ($stat['room']>=301 && $stat['room']<=317) {
        header("Location: podzem.php");
        exit;
}

###Главная площадь
if ($room=="0") {
mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");

echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"world.php\";
top.frames['online'].location = top.frames['online'].location;

//-->
</SCRIPT>
";
exit();
}
###
###Академия
if ($room=="9") {
mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");
echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"academy.php\";
top.frames['online'].location = top.frames['online'].location;

//-->
</SCRIPT>
";
exit();
}
###

###Банк
if ($room=="10") {
mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");
echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"bank.php\";
top.frames['online'].location = top.frames['online'].location;

//-->
</SCRIPT>
";
exit();
}
###

###Кузница
if ($room=="11") {
mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");
echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"repair.php\";
top.frames['online'].location = top.frames['online'].location;

//-->
</SCRIPT>
";
exit();
}
###

### Магазин артов
if ($room=="14") {
mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");
echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"ashop.php\";
top.frames['online'].location = top.frames['online'].location;

//-->
</SCRIPT>
";
exit();
}
###



### Магазин артов
if ($room=="60") {
mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");
echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"vedma.php\";
top.frames['online'].location = top.frames['online'].location;

//-->
</SCRIPT>
";
exit();
}
###

### Ломбард
if ($room=="46") {
mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");
echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"lambards.php\";
top.frames['online'].location = top.frames['online'].location;

//-->
</SCRIPT>
";
exit();
}
###

### УЛица №4
if ($room=="35") {
mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");
echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"world4.php\";
top.frames['online'].location = top.frames['online'].location;

//-->
</SCRIPT>
";
exit();
}
###

echo "<body bgcolor='#F5FFDA'>";

include('inc/html_header.php');

echo"
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/login_form.js\"></SCRIPT>

<body leftmargin=0 topmargin=0 background='/i/bg.gif'>

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
  alert('Идет строительство!');

}

function hideHelp()
{
document.getElementById('help').style.display = 'none';
return false;
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

#help {
Z-INDEX: 66; WIDTH: 100%; POSITION: absolute
}

TD.Form {
BORDER-RIGHT: black 1px solid; BORDER-TOP: #666666 1px solid;  BORDER-LEFT: #666666 1px solid; BORDER-BOTTOM: black 1px solid; BACKGROUND-COLOR: #f4eade
}
</style>";

echo "
<table border='0' width='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='100%' align='center'>
     <table border='0' width='100%' height='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='22' height='100%'>
    <table border='0' width='22' height='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='22' height='25'>
<img src='i/inman_b11.gif' width='22' height='25' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='69'><img src='i/inman_b12.gif' width='22' height='69' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='100%' background='i/inman_b13.gif'>&nbsp;</td>
  </tr>
  <tr>
    <td width='22' height='69'><img src='i/inman_b14.gif' width='22' height='69' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='25'><img src='i/inman_b15.gif' width='22' height='25' alt=''></td>
  </tr>
</table>
    </td>
    <td height='100%'>
      <table border='0' width='100%' height='100%' cellspacing='0' cellpadding='0'>
        <tr>
          <td width='100%' height='25'>
          <table border='0' width='100%' height='25' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='51' height='25'>
<img src='i/inman_b211.gif' width='51' height='25' alt=''></td>
    <td background='i/inman_b212.gif' valign='middle'>
    <table border='0' height='22' cellspacing='0' cellpadding='0'>
  <tr>
<td width='96' height='22'>&nbsp;</td>

  </tr>
</table>
   
    </td>
    <td width='51' height='25'>
<img src='i/inman_b213.gif' width='51' height='25' alt=''></td>
  </tr>
</table>
          </td>
        </tr>
        <tr>
          <td width='100%' height='100%' background='i/inman_fon.gif'>
            <table border='0' width='100%' height='100%' cellspacing='0' cellpadding='0' style='padding: 5'>
              <tr>
                <td width='50%' align='center'><img src=i/mir2_world/st1/logo.jpg alt='' border=1 galleryimg=no width=500 height=300></td>
<td width='50%' valign='top' align='center'>";

echo "<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='98%'>
    <tr>
      <td width='100%' align='center'>
Вы находитесь на <B>Улице №1</B> города <B>Evil City</B>, на этой улице вы сможете посетить такие здания как <B>Академия</B> - учим профессии, <b>Кузница</b> - чиним вещи, <B>Банк</B> - сохраняем деньги, <B>Ломбард</B> - быстро получаем деньги. Ну и самое интересное здание <B>Магазин Артефактов</B>.
</td>
    </tr>
  </table>
</div><br>";

echo "<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='98%'>
    <tr>
      <td width='100%' colspan='2' align='center'><b>Улица №1:</b></td>
    </tr>
    <tr>
      <td width='50%' align='center'><input type=button class=input value='Академия' onclick='top.frames[\"main\"].location = \"world2.php?room=9\"'></td>
      <td width='50%' align='center'><input type=button class=input value='Кузница' onclick='top.frames[\"main\"].location = \"world2.php?room=11\"'></td>
    </tr>
    <tr>
      <td width='50%' align='center'><input type=button class=input value='Ломбард' onclick='top.frames[\"main\"].location = \"world2.php?room=46\"'></td>
      <td width='50%' align='center'><input type=button class=input value='Банк' onclick='top.frames[\"main\"].location = \"world2.php?room=10\"'></td>
    </tr>
    <tr>
      <td width='50%' align='center'><input type=button class=input value='Магазин Артефактов' onclick='top.frames[\"main\"].location = \"world2.php?room=14\"'></td>
	   <td width='50%' align='center'><input type=button class=input value='Хижина ведьмы' onclick='top.frames[\"main\"].location = \"world2.php?room=60\"'></td>
    </tr>
      <tr>
<td width='50%' align='center'><input type=button class=input value='<- Главная Площадь' onclick='top.frames[\"main\"].location = \"world2.php?room=0\"'></td>
      <td width='50%' align='center'><input type=button class=input value='Улица №4 ->' onclick='top.frames[\"main\"].location = \"world2.php?room=35\"'></td>
      </tr>
  </table>
</div>

</td>


                </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td width='100%' height='25'>
          <table border='0' width='100%' height='25' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='51' height='25'>
<img src='i/inman_b231.gif' width='51' height='25' alt=''></td>
    <td background='i/inman_b232.gif'>&nbsp;</td>
    <td width='51' height='25'>
<img src='i/inman_b233.gif' width='51' height='25' alt=''></td>
  </tr>
</table>

          </td>
        </tr>
      </table>
    </td>
    <td width='22' height='100%'>
    <table border='0' width='22' height='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='22' height='25'>
<img src='i/inman_b21.gif' width='22' height='25' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='69'><img src='i/inman_b22.gif' width='22' height='69' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='100%' background='i/inman_b23.gif'>&nbsp;</td>
  </tr>
  <tr>
    <td width='22' height='69'><img src='i/inman_b24.gif' width='22' height='69' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='25'><img src='i/inman_b25.gif' width='22' height='25' alt=''></td>
  </tr>
</table>
   </td>
  </tr>
</table>
      
      </td>
  </tr>
</table>";





}

?>