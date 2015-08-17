<?php

require_once("inc/module.php");
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat['t_time']>$now) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']>$now) { header("Location: academy.php"); exit; }
elseif ($stat['o_time']>$now) { header("Location: juvelir.php"); exit; }
elseif ($stat['r_time']>$now) { header("Location: podzem.php"); exit; }
elseif ($stat['lov_time']>$now) { header("Location: more.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat['room'] != 29) { header("Location: main.php"); exit; }
else {

	echo"<body background='/i/bg.gif' leftmargin=0 topmargin=0>
<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td align=left>У Вас на счету: <b>".$stat[credits]."</b> зм.</td>
<td align=right valign=top>
<input class=input type=button value='Обновить' onclick='window.location.href=\"teleport.php?tmp=\"+Math.random();\"\"'>
<input class=input type=button value='Вернуться' onclick='window.location.href=\"world.php?room=26&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";

	echo "<table border='0' width='100%' cellspacing='0' cellpadding='0'>
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
            <table border='0' width='100%' height='100%' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 3'>
            <tr><td valign='top' width='230'>";

	echo "<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='230'>
<FORM action='' METHOD=POST>
<tr>
<td align=center>";
	echo "<SCRIPT LANGUAGE='JavaScript'>
<!--
function CalcPrice (id) {
var cel;
varnum;

cel = Math.floor(id.value/100);
num = id.value - cel * 100;

TeleportPrice.innerHTML = (num+1)*5;

}
//-->
</SCRIPT>";

	$price = ($TeleportTO-300)*5;

	//Начало Телепорта
	if ($teleport) {
		if ($stat['level'] >= 4) {
			if ($stat['credits'] >= $price) {

				mysql_query("UPDATE players set room=$TeleportTO, credits=credits-$price where user='".$stat['user']."'");
				$stat['room']=$TeleportTO;
				echo "<meta http-equiv='refresh' content='0; url=main.php'>";}

				else $msg = "У вас недостаточно золота!"; }
				else $msg = "Извините Телепортация доступна только с 4-го уровня!"; }

				// Конец Телепорта





				echo "<SELECT name='TeleportTO' class=input style='WIDTH: 230px' OnChange='CalcPrice(this);' Multiple SIZE=10>

<OPTGROUP label='---- Подземелье ----'></OPTGROUP>
";
$query=mysql_query("select id, title from vault");
while($ath=mysql_fetch_array($query)){
echo"<OPTION VALUE='$ath[id]'>$ath[title]</OPTION>";

}
echo "<OPTGROUP label='---- Лес ----'>
";
$query=mysql_query("select id, title from forest");
while($ath=mysql_fetch_array($query)){
echo"<OPTION VALUE='$ath[id]'>$ath[title]</OPTION>";

}
echo "<OPTGROUP label='---- Море ----'>
";
$query=mysql_query("select id, title from more");
while($ath=mysql_fetch_array($query)){
echo"<OPTION VALUE='$ath[id]'>$ath[title]</OPTION>";

}
echo"
</TR>
<TR><TD align=center>

<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<TR>
<TD>Стоимость перемещения:&nbsp;</TD>
<TD ID=TeleportPrice style='FONT-WEIGHT: Bold;'>0</TD>
<TD>&nbsp;зм.</TD>
</TR>
</table></div>

</TD>
</TR>
<TR><TD align=center>
<INPUT type=Submit class=input value='Телепортироваться' style='WIDTH: 230px' name='teleport'>
</TD>
</TR>
</FORM>
</table></div>";
				echo "</td><td valign='top' width='100%'>

<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><font size='2'><b>Городской портал</b></font></td></tr>
<tr><td>
В данном телепорте вы сможете телепортироваться в комнаты расположенные в самом городе, либо под городом.<br>
Цена увеличивается в зависимости от отдаленности выбранной вами комнаты.
</td></tr>
</table></div>";
				echo " </td>
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