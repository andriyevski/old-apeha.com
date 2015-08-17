<?
require_once("inc/module.php");
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat[t_time]) { header("Location: prison.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat['room'] != 60) { header("Location: main.php"); exit; }
elseif ($stat['o_time']>time()) { header("Location: juvelir.php"); exit; }
elseif ($stat['r_time']>time()) { header("Location: podzem.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }

else {

	include("inc/html_header.php");

	echo"<body background='/i/bg.gif' leftmargin=0 topmargin=0>";
	echo"<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/time.js\"></SCRIPT>
";
	print"<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td align=left>У Вас на счету: <b>".$stat[credits]."</b> зм.</td>
<td align=right valign=top>
<input class=input type=button value='Обновить' onclick='window.location.href=\"vedma.php?tmp=\"+Math.random();\"\"'>";
	if ($stat[elikmake_time] < $now) echo "
<input class=input type=button value='Вернуться' onclick='window.location.href=\"world2.php?room=1&tmp=\"+Math.random();\"\"'>";
	echo "</td>
</tr>
</table>";


	if ($stat['elikmake_time'] > $now) {

		echo"<center><font color=red><b>Убираемся в хижине ведьмы, ещё:&nbsp;<div id=know></div></small></b><script>ShowTime('know',",$stat['elikmake_time']-$now,",1);</script></b></font></center><br>";

		echo"";
	}

	// ----- # Крафт вещей # ----- //
	if (!empty($sozdanie) && is_numeric($sozdanie)) {
		$sozdanie = addslashes($sozdanie);
		if ($stat[elikmake_time] < $now) {
			if ($stat[room] == 60) {
				if ($stat[ustal_now]>=20) {


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

								mysql_query("Update players set elikmake_time=$now+300 WHERE id=".$stat['id']."");

								$buyitem_res = mysql_query("SELECT * FROM `items` WHERE `name` = '".$koziki['name2']."'");
								$buyitem = mysql_fetch_array($buyitem_res);
								$inf = "".$buyitem['name']."|".$buyitem['title']."|".$buyitem['price']."|0|".$secondary."|".$buyitem['art']."|0|".$buyitem['iznos']."";
								$min = "".$buyitem['min_level']."|".$buyitem['min_str']."|".$buyitem['min_dex']."|".$buyitem['min_ag']."|".$buyitem['min_vit']."|".$buyitem['min_razum']."|".$buyitem['min_rase']."|".$buyitem['min_proff']."";
								$result2 = mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".$stat['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");

								require_once("inc/chat/functions.php");
								insert_msg("Ведьма отправилась варить вам зелье <u>".$buyitem['title']."</u>, а вы начали выполнять ее поручение!","","","1",$stat[user],"",$stat[room]);
								echo "<meta http-equiv='refresh' content='0; url=vedma.php'>";
							}
							else $msg="Нехватает ресурсов!";
						}
						else $msg="Это не похоже на рецепт!";
					}
					else echo"Рецепт не найден в Вашем рюкзаке!";
				} else $msg="Да вы батенька заработались! Идите-ка посражайтесь.";
			} else $msg="Вы находитесь не в той комнате в какой нужно...";
		} else $msg="Вы еще не убрались за предидущее зелье...";
	}
	// ----- # Конец крафта вещей # ----- //







	if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";


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
            <tr>
<td width='65%' align='center' valign='top'>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'>
Старая ведьма, которая согласись выглядит великолепно, приветствует тебя воин!
Меня зовут Азелия, и я знаю зачем ты пришел. Если у тебя нет с собой рецепта и нужных ингридиентов, 
можеш и не надеяться на эликсир. Если же принес все что нужно, то ты получиш его.
Денег мне не надо, а вот пол помыть и пыль протереть, это и есть плата за мою доброту.
Ты еще молодой и сильный, я уевренна ты справишся за 5 минут, а я за это время приготовлю тебе эликсир.   </td></tr></table></div>
<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>";













	$it_sost=mysql_query("SELECT objects.* FROM objects, slots WHERE objects.user='".$stat['user']."' AND objects.tip=21 AND objects.bank=0 AND objects.lam=0 AND objects.pochta=0 AND objects.mag=0 AND objects.komis=0 AND objects.upgrade=0 AND objects.inf LIKE CONVERT( _utf8 '%recept_elik%'
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

    <tr>
      <td width='30%' align='center'>
<img src='i/items/".$obj_inf['0'].".gif' alt='".$obj_inf['1']."'><br>

<span onclick=\"if (confirm('Вы действительно хотите изготовить предмет?')) window.location='vedma.php?sozdanie=".$objects['id']."'\" style='CURSOR: Hand'><b>Создать предмет</b>
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

		}
	} else

	echo"<br><div align='center'>
 
    <tr>
      <td width='100%' height='100%' align='center'>
        У Вас нет рецептов.
      </td>
    </tr>

</div>";












	echo "</table></div>
 <td width='35%' valign='top'><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td colspan='3' align='center'><b><img src='i/location/vedma.gif' alt=''></b></td></tr>
	
	<tr><td colspan='1' align='center'><b>Название</b></td><td colspan='1' align='center'><b>Параметры</b></td><td colspan='1' align='center'><b>Время</b></td></tr>
	<tr><td valign='top'>Эликсир силы:</td> <td><b>Сила +10</b></td><td><b>на 3 часа</b></td></tr>
    <tr><td >Эликсир ловкости:</td> <td><b>Ловкость +10</b></td><td><b>на 3 часа</b></td></tr>
    <tr><td>Эликсир удачи:</td> <td><b>Удача +10</b></td><td><b>на 3 часа</b></td></tr>
    <tr><td>Эликсир защиты:</td> <td><b>Броня +20</b></td><td><b>на 3 часа</b></td></tr>

</td></tr></table></div>
</td>
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
?>