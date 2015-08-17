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

if ($stat['room']>=301 && $stat['room']<=370) {
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

###Подземка
if ($room=="300") {
if($stat["level"]<0){
     echo "<script>alert('Ваш уровень слишком маловат для входа... Допустимый уровень 0!');</script>" ;
} else {
mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");

echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"podzem.php\";
top.frames['online'].location = top.frames['online'].location;

//-->
</SCRIPT>
";
exit();
}
}
###

###Знахарь
if ($room=="44") {
if($stat["level"]<2){
     echo "<script>alert('Ваш уровень слишком маловат для входа... Допустимый уровень 2!');</script>" ;
} else {
mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");
echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"znahar.php\";
top.frames['online'].location = top.frames['online'].location;

//-->
</SCRIPT>
";
exit();
}
}
###

###Ювелирная мастерская
if ($room=="41") {
mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");
echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"juvelir.php\";
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

### Храм
if ($room=="28") {
mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");
echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"bog_hram.php\";
top.frames['online'].location = top.frames['online'].location;

//-->
</SCRIPT>
";
exit();
}
###

### биржа
if ($room=="30") {
mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");
echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"birga.php\";
top.frames['online'].location = top.frames['online'].location;

//-->
</SCRIPT>
";
exit();
}
###

### Портал
if ($room=="29") {
if($stat["level"]<4){
     echo "<script>alert('Ваш уровень слишком маловат для входа... Допустимый уровень 4!');</script>" ;
} else {
mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");
echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"teleport.php\";
top.frames['online'].location = top.frames['online'].location;

//-->
</SCRIPT>
";
exit();
}}
###

echo "<body background='/i/bg.gif'>";

include('inc/html_header.php');

echo"
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/login_form.js\"></SCRIPT>

<body leftmargin=0 topmargin=0>

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
                <td width='50%' align='center'><img src=i/mir2_world/st2/logo.jpg alt='' border=1 galleryimg=no width=500 height=300></td>
<td width='50%' valign='top' align='center'>";

echo "<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='98%'>
    <tr>
      <td width='100%' align='center'>
Вы находитесь на <B>Улице №2</B> города <B>Evil City</B>, на этой улице вы сможете посетить такие здания как <B>Ювелирная Мастерская</B> - здесь вам доступна огранка камней и дальнейшая их вставка в вещи, <b>Биржа</b> - место продажи ценных бумаг доходных зданий, <B>Комната Знахаря</B> - перебросить свои характеристики, <B>Храм</B> - вы сможете помолиться богам. Ну и наконец, наверное самое интересное, страшное место в городе <B>Подземелье</B>. Заходите в <b>Алтарь Голосования</b> - вас голос решающий.
</td>
    </tr>
  </table>
</div><br>";

echo "<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='98%'>
    <tr>
      <td width='100%' colspan='2' align='center'><b>Улица №2:</b></td>
    </tr>
    <tr>
      <td width='50%' align='center'><input type=button class=input value='Комната Знахаря' onclick='top.frames[\"main\"].location = \"world3.php?room=44\"'></td>
      <td width='50%' align='center'><input type=button class=input value='Храм' onclick='top.frames[\"main\"].location = \"world3.php?room=28\"'></td>
    </tr>
    <tr>
      <td width='50%' align='center'><input type=button class=input value='Юв. Мастерская' onclick='top.frames[\"main\"].location = \"world3.php?room=41\"'></td>
      <td width='50%' align='center'><input type=button class=input value='Подземелье' onclick='top.frames[\"main\"].location = \"world3.php?room=300\"'></td>
    </tr>
    <tr>
      <td width='50%' align='center'><input type=button class=input value='Биржа' onclick='top.frames[\"main\"].location = \"world3.php?room=30\"'></td>
      <td width='50%' align='center'><input type=button class=input value='Портал' onclick='top.frames[\"main\"].location = \"world3.php?room=29\"'></td>
    </tr>
      <tr>
<td width='50%' align='center'><input disabled type=button class=input value='<- Проход закрыт'></td>
      <td width='50%' align='center'><input type=button class=input value='Главная площадь ->' onclick='top.frames[\"main\"].location = \"world3.php?room=0\"'></td>
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