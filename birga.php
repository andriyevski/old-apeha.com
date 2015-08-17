<?php
require_once("inc/module.php");
if ($stat[bloked]) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat['t_time']>$now) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']>$now) { header("Location: academy.php"); exit; }
elseif ($stat['o_time']>$now) { header("Location: juvelir.php"); exit; }
elseif ($stat['r_time']>$now) { header("Location: podzem.php"); exit; }
elseif ($stat['lov_time']>$now) { header("Location: more.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat[room]!="30") { header("Location: main.php"); exit; }
else {


	$igrok=mysql_fetch_array(mysql_query("SELECT user FROM players where user='$pers'"));

	$inf_acc=mysql_fetch_array(mysql_query("SELECT * FROM akcii where name1='$acc_id'"));
	$inf_acc1=mysql_fetch_array(mysql_query("SELECT * FROM akcii where id='1'"));
	$inf_acc2=mysql_fetch_array(mysql_query("SELECT * FROM akcii where id='2'"));


	echo"<body background='/i/bg.gif' leftmargin=0 topmargin=0>";
	echo"        <table width=100% cellspacing=0 cellpadding=5 border=0>
        <tr>
        <td>&nbsp;&nbsp;<b>У вас на счету:</b> <u>".$stat['valute']."</u> <b>сп.</b>
        </td>
        <td align=right valign=top>
<input class=input type=button value='Обновить' onclick='window.location.href=\"birga.php?tmp=\"+Math.random();\"\"'>
<input class=input type=button value='Вернуться' onclick='window.location.href=\"world.php?room=26&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";

	//Начало передачи
	if ($pered_ac) {
		$kol = trim($kol);
		$pers = HtmlSpecialChars($pers);
		$kol = abs($_POST['kol']);
		AddSlashes($pers);
		if ($kol>=0) {
			AddSlashes($kol);
			$kool = str_replace(',', '.', $kol);
			if ($stat[$ac]>=$kool) { // Хватает единиц акций чтоб передать акции
				if (!empty($pers)) { // Написан ли логин в поле pres
					if (!empty($igrok[user])) { // Существует ли игрок

						mysql_query("UPDATE players set $ac=$ac-$kool where user='".$stat['user']."'");
						mysql_query("UPDATE players set $ac=$ac+$kool where user='".$igrok['user']."'");
						$stat[ac_telep]=$stat[ac_telep]-$kool;
						$stat[ac_magaz]=$stat[ac_magaz]-$kool;

						$msgs="Вы передали $kool% акций персонажу \"$pers\" удачно!"; }

						else $msgs="Персонаж \"$pers\" не существует!"; }
						else $msgs="Укажите логин персонажа которому передать акции!"; }
						else $msgs="У вас нету столько акций!"; }
						else $msgs="Укажите кол-во акций!"; }
						// Конец передачи


						//Начало покупки
						if ($pokup_ac) {
							$acc_kol = trim($acc_kol);
							$acc_kool = str_replace(',', '.', $acc_kol);
							$minu = $inf_acc[stoimost];
							$minus_v = $acc_kool*$minu;
							$acc_kool = HtmlSpecialChars($acc_kool);
							if ($acc_kool>=0) {
								AddSlashes($acc_kool);
								if ($acc_kool<=$inf_acc[procent]) {
									if ($stat['valute']>=$minus_v) { // Хватает сп чтоб купить акции

										mysql_query("UPDATE akcii set procent=procent-$acc_kool where name1='$acc_id'");
										mysql_query("UPDATE players set $acc_id=$acc_id+$acc_kool, valute=valute-$minus_v where user='".$stat['user']."'");
										$stat[$acc_id]=$stat[$acc_id]+$acc_kool;
										$stat[valute]=$stat[valute]-$minus_v;

										$msgs="Вы купили $acc_kool% акций здания \"".$inf_acc[name]."\" удачно!"; }

										else $msgs="У вас нету столько сп!"; }
										else $msgs="На бирже нет столько акций нужного вам здания!"; }
										else $msgs="Укажите кол-во акций!"; }
										// Конец покупки

										if (!empty($msgs)) echo"<center><FONT COLOR=RED><b>$msgs</b></font></center>";

										echo "<form action='' method=post><table border='0' width='100%' cellspacing='0' cellpadding='0'>
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
<tr><td>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr><td width='100%' valign='top' align='center'>
<small>Выплаты производятся каждую неделю, в понедельник в 00:00 по серверу...</small>
</td></tr>
</table>
</div>";


										echo"<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr><td colspan=5 align='center'><b>Здания продающие акции</b></td></tr>
<tr>
<td>Название</td>
<td>Кол-во %</td>
<td>Цена %</td>
<td>Общ. заработок</td>
<td>Заработок за 1 нед.</td>
</tr>
<tr>
<td><b>".$inf_acc1[name]."</b></td>
<td><b>".$inf_acc1[procent]."</b>%</td>
<td><b>".$inf_acc1[stoimost]."</b> сп.</td>
<td><b>".$inf_acc1[all_money]."</b> зм.</td>
<td><b>".$inf_acc1[money]."</b> зм.</td>
</tr>
<tr>
<td><b>".$inf_acc2[name]."</b></td>
<td><b>".$inf_acc2[procent]."</b>%</td>
<td><b>".$inf_acc2[stoimost]."</b> сп.</td>
<td><b>".$inf_acc2[all_money]."</b> зм.</td>
<td><b>".$inf_acc2[money]."</b> зм.</td>
</tr>
</table>
</div>";


										echo"<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr><td colspan=2 align='center'><b>Ваши акции</b></td></tr>
<tr>
<td>Название</td>
<td>Кол-во %</td>
</tr>
<tr>
<td><b>".$inf_acc1[name]."</b></td>
<td><b>".$stat[ac_telep]."</b>%</td>
</tr>
<tr>
<td><b>".$inf_acc2[name]."</td>
<td><b>".$stat[ac_magaz]."</b>%</td>
</tr>
</table>
</div>";

										echo"<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr><td colspan=3 align='center'><b>Покупка акций</b></td></tr>
<tr>
<td>Название</td>
<td>Кол-во %</td>
<td>Действие</td>
</tr>
<tr>
<td><select name=acc_id><option value=ac_telep>здание \"Комната Знахаря\"<option value=ac_magaz>здание \"Гос. Магазин\"</select></td>
<td><input name=acc_kol class=input style='WIDTH: 50px'></td>
<td><input type=submit class=input value='Купить' style='WIDTH: 70px' name=pokup_ac></td>
</tr>
</table>
</div>";

										echo"<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr><td colspan=3 align='center'><b>Передача акций</b></td></tr>
<tr>
<td>Название</td>
<td>Кому</td>
<td>Кол-во %</td>
<td>Действие</td>
</tr>
<tr>
<td><select name=ac><option value=ac_telep>здание \"Комната Знахаря\"<option value=ac_magaz>здание \"Гос. Магазин\"</select></td>
<td><input name=pers class=input style='WIDTH: 100px'></td>
<td><input name=kol class=input style='WIDTH: 100px'></td>
<td><input type=submit class=input value='Передать' style='WIDTH: 70px' name=pered_ac></td>
</tr>
</table>
</div>";

										echo"
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
</table></form>";

}
require_once("inc/html_header.php");
?>