<?
require_once("inc/module.php");
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

$now = time();

if ($stat['t_time']>$now) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']>$now) { header("Location: academy.php"); exit; }
elseif ($stat['o_time']>$now) { header("Location: juvelir.php"); exit; }
elseif ($stat['r_time']>$now) { header("Location: podzem.php"); exit; }
elseif ($stat['lov_time']>$now) { header("Location: more.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat['room'] != 44) { header("Location: main.php"); exit; }
else {

	echo"
<DIV ID=form style='position:absolute; visibility:hidden'></DIV>

<SCRIPT LANGUAGE=\"JavaScript\">
<!--
function present (id) {

        var x, y, obj;

        obj = document.getElementById('f_'+id);
        for(i=obj, x=0, y=0; i; i = i.offsetParent)
        {
        x += i.offsetLeft;
        y += i.offsetTop;
        }

        form.style.left = x-45;
        form.style.top = y;

        document.all('form').style.visibility = 'visible';
        document.all('form').innerHTML        = '<TABLE BGCOLOR=e2e0e0 bordercolor=A5A5A5 border=1 cellspacing=0 cellpadding=3 style=\'CURSOR: Default;\'><FORM action=\'znahar.php\' method=POST><tr><td style=\'BORDER-RIGHT: 0px; BORDER-BOTTOM: 0px; padding-left:7;\'>Текст гравировки:</td><td style=\'BORDER-LEFT: 0px; BORDER-BOTTOM: 0px; padding-right:7;\' align=right><input type=text class=input size=32 name=grav_text><input type=hidden name=grav_id value=\''+id+'\'></td></tr><tr><td colspan=2 align=center><input type=submit value=\'Выгравировать\' name=\'grav_submit\' class=input style=\'WIDTH: 308px\'></td></tr></FORM></table>';

}
//-->
</SCRIPT>
";









	// ----- # Крафт вещей # ----- //
	if (!empty($sozdanie) && is_numeric($sozdanie)) {
		$sozdanie = addslashes($sozdanie);

		$is_ex=mysql_fetch_array(mysql_query("SELECT objects.`id`,objects.`inf`,objects.`tip` FROM objects, slots WHERE objects.user='".$stat['user']."' AND objects.tip=21 AND objects.bank=0 AND objects.lam=0 AND objects.pochta=0 AND objects.mag=0 AND objects.komis=0 AND objects.upgrade=0 && objects.id=".addslashes($sozdanie)." AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19)"));

		$is_ex_inf=explode("|",$is_ex['inf']);

		$koziki = mysql_fetch_array(mysql_query("SELECT * FROM `recepts` WHERE `name` = '".$is_ex_inf['0']."'"));

		if (!empty($is_ex_inf['0'])) {
			if ($is_ex['tip'] == 21) {
				if ($stat[ing_kor_mand]>=$koziki[ing_kor_mand]
				&& $stat[ing_vet_veres]>=$koziki[ing_vet_veres]
				&& $stat[ing_koga]>=$koziki[ing_koga]
				&& $stat[ing_kosti]>=$koziki[ing_kosti]
				&& $stat[ing_trava]>=$koziki[ing_trava]
				&& $stat[ing_metril]>=$koziki[ing_metril]
				&& $stat[ing_okun]>=$koziki[ing_okun]
				&& $stat[ing_osetr]>=$koziki[ing_osetr]
				&& $stat[ing_stavrida]>=$koziki[ing_stavrida]
				&& $stat[ing_narval]>=$koziki[ing_narval]
				&& $stat[ing_kefal]>=$koziki[ing_kefal]
				&& $stat[ing_4esh_drak]>=$koziki[ing_4esh_drak]
				&& $stat[ing_vamp]>=$koziki[ing_vamp]
				&& $stat[ing_br_slit]>=$koziki[ing_br_slit]
				&& $stat[ing_kri_kv]>=$koziki[ing_kri_kv]
				&& $stat[ing_galo_skorp]>=$koziki[ing_galo_skorp]
				&& $stat[ing_cry]>=$koziki[ing_cry]
				&& $stat[ing_volos]>=$koziki[ing_volos]
				&& $stat[ing_gribok]>=$koziki[ing_gribok]
				&& $stat[ing_zhuk]>=$koziki[ing_zhuk]
				&& $stat[ing_oleni_rog]>=$koziki[ing_oleni_rog]
				&& $stat[ing_dozhdevik]>=$koziki[ing_dozhdevik]
				&& $stat[ing_shishka]>=$koziki[ing_shishka]
				&& $stat[ing_vetka_shipovnika]>=$koziki[ing_vetka_shipovnika]
				&& $stat[ing_podorojnik]>=$koziki[ing_podorojnik]) {

					mysql_query("DELETE FROM objects WHERE id=".addslashes($sozdanie)."");

					$pr=mysql_query("Update players set ing_kor_mand=ing_kor_mand-$koziki[ing_kor_mand], ing_vet_veres=ing_vet_veres-$koziki[ing_vet_veres], ing_koga=ing_koga-$koziki[ing_koga], ing_kosti=ing_kosti-$koziki[ing_kosti], ing_trava=ing_trava-$koziki[ing_trava], ing_metril=ing_metril-$koziki[ing_metril], ing_okun=ing_okun-$koziki[ing_okun], ing_osetr=ing_osetr-$koziki[ing_osetr], ing_stavrida=ing_stavrida-$koziki[ing_stavrida], ing_kefal=ing_kefal-$koziki[ing_kefal], ing_4esh_drak=ing_4esh_drak-$koziki[ing_4esh_drak], ing_vamp=ing_vamp-$koziki[ing_vamp], ing_br_slit=ing_br_slit-$koziki[ing_br_slit], ing_kri_kv=ing_kri_kv-$koziki[ing_kri_kv], ing_galo_skorp=ing_galo_skorp-$koziki[ing_galo_skorp], ing_narval=ing_narval-$koziki[ing_narval], ing_cry=ing_cry-$koziki[ing_cry], ing_volos=ing_volos-$koziki[ing_volos], ing_gribok=ing_gribok-$koziki[ing_gribok], ing_zhuk=ing_zhuk-$koziki[ing_zhuk], ing_oleni_rog=ing_oleni_rog-$koziki[ing_oleni_rog], ing_dozhdevik=ing_dozhdevik-$koziki[ing_dozhdevik], ing_shishka=ing_shishka-$koziki[ing_shishka], ing_vetka_shipovnika=ing_vetka_shipovnika-$koziki[ing_vetka_shipovnika], ing_podorojnik=ing_podorojnik-$koziki[ing_podorojnik] WHERE id=".$stat['id']."");

					$buyitem_res = mysql_query("SELECT * FROM `items` WHERE `name` = '".$koziki['name2']."'");
					$buyitem = mysql_fetch_array($buyitem_res);
					$inf = "".$buyitem['name']."|".$buyitem['title']."|".$buyitem['price']."|0|".$secondary."|".$buyitem['art']."|0|".$buyitem['iznos']."";
					$min = "".$buyitem['min_level']."|".$buyitem['min_str']."|".$buyitem['min_dex']."|".$buyitem['min_ag']."|".$buyitem['min_vit']."|".$buyitem['min_razum']."|".$buyitem['min_rase']."|".$buyitem['min_proff']."";
					$result2 = mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".$stat['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");

					$msg="Вы удачно создали предмет <u>".$buyitem['title']."</u>";
				}
				else $msg="Нехватает ресурсов!";
			}
			else $msg="Это не похоже на рецепт!";
		}
		else echo"Рецепт не найден в Вашем рюкзаке!";
	}
	// ----- # Конец крафта вещей # ----- //






	// ----- # Перекидываем статы # ----- //
	if ( $stat['level'] >= 0 && $stat['level'] <=3 ) { $cena = 10; }
	elseif ( $stat['level'] >= 4 && $stat['level'] <=6 ) { $cena = 15; }
	elseif ( $stat['level'] >= 7 && $stat['level'] <=8 ) { $cena = 20; }
	elseif ( $stat['level'] >= 9 && $stat['level'] <=11 ) { $cena = 25; }
	elseif ( $stat['level'] >= 12 && $stat['level'] <=16 ) { $cena = 50; }
	elseif ( $stat['level'] >= 17 && $stat['level'] <=25 ) { $cena = 150; }

	//Начало перекидки
	if ($obmen) {
		if ($stat[credits] >= $cena) { // Хватает ли денег
			if ($stat[$stati1] >= 4) {
				if ($stati1 != $stati2) {

					require_once("inc/chat/functions.php");
					insert_msg("Все прошло удачно! За смену параметров вы заплатили <b>$cena</b> зм!","","","1",$stat[user],"",$stat[room]);

					mysql_query("UPDATE slots SET slots.1=0, slots.2=0, slots.3=0, slots.4=0, slots.5=0, slots.6=0, slots.7=0, slots.8=0, slots.9=0, slots.10=0, slots.11=0, slots.12=0, slots.13=0, slots.14=0, slots.15=0, slots.16=0, slots.17=0, slots.18=0, slots.19=0 WHERE  id='".$stat['id']."'");
					mysql_query("UPDATE players set $stati1=$stati1-1, $stati2=$stati2+1, credits=credits-$cena where user='".$stat['user']."'");
					mysql_query("UPDATE akcii SET all_money=all_money+$cena, money=money+$cena WHERE id='1'");
					$stat[stati1]=$stat[stati1]-1;
					$stat[stati2]=$stat[stati2]+1;
					$stat[credits]=$stat[credits]-$cena;

					echo "<meta http-equiv='refresh' content='1; url=znahar.php'>"; }

					else $msg="Ошибка, попробуйте еще!"; }
					else $msg="Характеристика не может быть меньше 3!"; }
					else $msg="У вас не хватает зм!"; }
					// ----- # Конец Перекидываем статы # ----- //



					function show ($id) {
						global $stat;

						switch ($id) {
							case 1:
								echo "<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
    <tr><td align='left'><u><b>Хижина старца</b></u><br>
<center>
Вы можете выбрать себе склонность!<br>
<li>Свет: У этой склонности есть возможность нападать на персонажей с противоположной склонностью и здоровье в больнице восстанавливается быстрее.Каждое вмешательство требует 20 энергии.Время действия:9.00-21.00.
<li>Тьма: У этой склонности есть возможность 'укус вампира' персонажа противоположной склонности и восстановить свое здаровье за счет чужого.Каждый укус требует 20 энергии.Время действия:21.00-9.00.

<br><br>
Стоимость склонности на данный момент составляет 250 сп.<br>

</td>
</tr>
  </table>
</div>";
								break;
							case 2:



								if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";


								echo "<form action='' method=post>
   
    </td>

</table>
          </td>
        </tr>
        <tr>
          <td width='100%' height='100%' background='i/inman_fon.gif'>
            <table border='0' width='100%' height='100%' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 3'>
            <tr><td width='30%' valign='top'><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td colspan='2' align='center'><b>Ваши параметры</b></td></tr>
<tr><td valign='top'>
    Сила:</td> <td><b>".$stat[strength]."</b></td></tr>
    <tr><td>Ловкость:</td> <td><b>".$stat[agility]."</b></td></tr>
    <tr><td>Удача:</td> <td> <b>".$stat[dex]."</b></td></tr>
    <tr><td>Выносливость:</td> <td> <b>".$stat[vitality]."</b></td></tr>
    <tr><td>Разум:</td> <td> <b>".$stat[razum]."</b>
</td></tr></table></div>
</td>
<td width='70%' align='center' valign='top'>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'>В данной комнате вы сможете расперделить свой характеристики так как вам надо!<br>
Пользуйтесь нашими услугами и Вам больше ненужно будет подсчитывать свой характеристики чтобы одеть вещь.<br>
Смена любой из характеристик стоит в зависимости от таблицы приведенной ниже за 1 ед.<br><br>
Меняем <select name=stati1><option value=strength>Сила<option value=dex>Удача<option value=agility>Ловкость<option value=vitality>Выносливость<option value=razum>Разум</select> на <select name=stati2><option value=strength>Сила<option value=dex>Удача<option value=agility>Ловкость<option value=vitality>Выносливость<option value=razum>Разум</select>
<input type=submit class=input value='Поменять' style='WIDTH: 70px' name=obmen> </td></tr></table></div>
<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td colspan='11' align='center'><b>Таблица цен</b></td></tr>
  <tr>
    <td width='20' align='center'><b>Уровень</b></td>
    <td align='center'>0-3</td>
    <td align='center'>4-6</td>
    <td align='center'>7-8</td>
    <td align='center'>9-11</td>
	<td align='center'>12-16</td>
	<td align='center'>17-25</td>

			
  </tr>
  <tr>
    <td width='20' align='center'><b>Цена</b></td>
    <td align='center'>10</td>
    <td align='center'>15</td>
    <td align='center'>20</td>
    <td align='center'>25</td>
    <td align='center'>50</td>
	<td align='center'>150</td>
		</tr></table></div></td>
                </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td width='100%' height='25'>
          <table border='0' width='100%' height='25' cellspacing='0' cellpadding='0'>
 </form>";

								break;


							case 3:

								echo"<table border=0 width=100%>";
								$it_sost=mysql_query("SELECT objects.* FROM objects, slots WHERE objects.user='".$stat['user']."' AND objects.tip=21 AND objects.bank=0 AND objects.lam=0 AND objects.pochta=0 AND objects.mag=0 AND objects.komis=0 AND objects.upgrade=0 AND objects.inf NOT LIKE CONVERT( _utf8 '%recept_elik%'
USING cp1251 ) AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) ORDER BY time desc");

								if (mysql_num_rows($it_sost)) {

									for($i=0; $i<mysql_num_rows($it_sost); $i++) {

										$objects=mysql_fetch_array($it_sost);

										$obj_inf=explode("|",$objects['inf']);
										$obj_min=explode("|",$objects['min']);
										$obj_add=explode("|",$objects['add']);

										include('inc/main/min_tr.php');
										include('inc/main/add.php');
										include('inc/main/classes.php');
										echo"<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
      <td width='30%' align='center'>
<img src='i/items/".$obj_inf['0'].".gif' alt='".$obj_inf['1']."'><br>

<span onclick=\"if (confirm('Вы действительно хотите изготовить предмет?')) window.location='znahar.php?sozdanie=".$objects['id']."'\" style='CURSOR: Hand'><b>Создать предмет</b>
";
										echo " </td><td width='70%'>
      <small><b>".$obj_inf['1']."</b><br>
      Гос. цена: <b>".$obj_inf['2']."</b> зм.<br>
      Долговечность: <b>".$obj_inf['6']."</b>/<b>".$obj_inf['7']."</b><br></small>
  <br><b><u><small>Минимальные требования:</u></b><br>
  $min_rase$min_level$min_str$min_dex$min_ag$min_vit$min_razum$min_proff<br></small>";
  if ($hp or $energy or $uron or $strength or $dex or $agility or $vitality or $razum or $br1 or $br2 or $br5 or $br3 or $br4 or $krit or $unkrit or $uv or $unuv)
  echo"<b><u><small>Действие предмета:</u></b>
<br>$hp$energy$uron$strength$dex$agility$vitality$razum$br1$br2$br3$br4$br5$krit$unkrit$uv$unuv<br></small>";
  if (!empty($objects['about']))
  echo"<br><small><b><i>Дополнительная информация:</i></b><br>".$objects['about'];
  if ($obj_inf['3']) echo"<b><u><small>Выгравирована надпись:</u></b><BR>".$obj_inf['3'];

  echo "
      </td>
    </tr>
  </table>
</div>";
									}
								} else

								echo"<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
      <td width='100%' height='100%' align='center'>
        У Вас нет рецептов.
      </td>
    </tr>
  </table>
</div>";

								break;


							case 4:
								echo"<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
      <td width='100%' height='100%' align='center'>
       ...
      </td>
    </tr>
  </table>
</div>";

								break;
						}}






						echo"
<body bgcolor=F5FFD9 leftmargin=0 topmargin=0>

<DIV ID=hint1></DIV>

<SCRIPT src='i/show_inf.js'></SCRIPT>
";


						print"<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td>&nbsp;&nbsp;<b>У Вас на счету:</b> <u>".$stat['credits']."</u> <b>зм.</b><br>
&nbsp;&nbsp;<b>У Вас на счету:</b> <u>".$stat['valute']."</u> <b>сп.</b>
</td>

<td align=right valign=top>

<input class=input type=button value='Обновить' onclick='window.location.href=\"znahar.php?otdel=$_GET[otdel]&tmp=\"+Math.random();\"\"'>

<input class=input type=button value='Вернуться' onclick='window.location.href=\"world3.php?room=1&tmp=\"+Math.random();\"\"'>

</td>
</tr>
</table>";



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
            <table border='0' width='100%' height='100%' cellspacing='0' cellpadding='0' style='border-collapse: collapse; border-style: solid; padding: 3'>
              <tr>
                <td width='100%' align='center'>";

						if ($msg!="") echo"<center><font color=red><b>$msg</b></font></center><br>";
						if ($error!="") echo"<center><font color=red><b>$error</b></font></center><br>";

						echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
    <tr>";

						echo "<td align=center width=20%><A"; if ($otdel == 1) echo" disabled><b>"; else echo" HREF='znahar.php?otdel=1'>"; echo"Старец</b></A></td>";
						echo "<td align=center width=20%><A"; if ($otdel == 2) echo" disabled><b>"; else echo" HREF='znahar.php?otdel=2'>"; echo"Переосмысление</b></A></td>";
						echo "<td align=center width=20%><A"; if ($otdel == 3) echo" disabled><b>"; else echo" HREF='znahar.php?otdel=3'>"; echo"Магическая мастерская</b></A></td>";
						echo "<td align=center width=20%><A"; if ($otdel == 4) echo" disabled><b>"; else echo" HREF='znahar.php?otdel=4'>"; echo"Квесты</b></A></td>";


						echo "</tr>
  </table>
</div>";

						if (!empty($_GET['otdel'])) {


							switch ($_GET['otdel']) {
								case 1: show(1); break;
								case 2: show(2); break;
								case 3: show(3); break;
								case 4: show(4); break;

								default: echo"<B STYLE='COLOR: Red'>Что-то тут не так...</B>"; break;
							}

						} else echo "<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
    <tr><td align='left'><u><b>Хижина старца</b></u><br>

</td>
</tr>
  </table>
</div>";include ("starec.php");


						echo"                </td>
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