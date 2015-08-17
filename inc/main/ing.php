<?
echo"
<SCRIPT LANGUAGE=JavaScript>
<!--

function key() {
if (event.keyCode < 48 || event.keyCode > 57) {
event.keyCode = 0;
return false;
}
}

//-->
</SCRIPT>
";
echo "<form method='post'>";

if ($resurs == ing_kor_mand) $vesh = "Корень Мандрагоры";
elseif ($resurs == ing_vet_veres) $vesh = "Ветка Вереска";
elseif ($resurs == ing_koga) $vesh = "Кусок кожи";
elseif ($resurs == ing_kosti) $vesh = "Коси животного";
elseif ($resurs == ing_trava) $vesh = "Трава";
elseif ($resurs == ing_metril) $vesh = "Метрил";
elseif ($resurs == ing_okun) $vesh = "Окунь";
elseif ($resurs == ing_osetr) $vesh = "Осётр";
elseif ($resurs == ing_stavrida) $vesh = "Ставрида";
elseif ($resurs == ing_narval) $vesh = "Нарвал";
elseif ($resurs == ing_kefal) $vesh = "Кефаль";
elseif ($resurs == ing_4esh_drak) $vesh = "Чешуя дракона";
elseif ($resurs == ing_vamp) $vesh = "Клык вампира";
elseif ($resurs == ing_br_slit) $vesh = "Бронзовый слиток";
elseif ($resurs == ing_kri_kv) $vesh = "Кристалл кварца";
elseif ($resurs == ing_galo_skorp) $vesh = "Жало скорпиона";
elseif ($resurs == ing_cry) $vesh = "Кристалы";
elseif ($resurs == ing_volos) $vesh = "Волосы";
elseif ($resurs == ing_gribok) $vesh = "Грибок";
elseif ($resurs == ing_zhuk) $vesh = "Жук навозный";
elseif ($resurs == ing_oleni_rog) $vesh = "Рога оленя";
elseif ($resurs == ing_dozhdevik) $vesh = "Дождевой червь";
elseif ($resurs == ing_shishka) $vesh = "Шишка";
elseif ($resurs == ing_vetka_shipovnika) $vesh = "Ветка шиповника";
elseif ($resurs == ing_podorojnik) $vesh = "Подорожник";



if ($peredat) {
	$kol_vo = ceil($kol_vo);
	$pers = mysql_fetch_array(mysql_query("Select * from players where user = '".$users."'"));
	if ($stat[$resurs] >= $kol_vo) {
		if ($pers['user']) {
			if ($pers['user'] != $stat['user']) {

				mysql_query("UPDATE `players` SET `$resurs` = `$resurs` + '$kol_vo' WHERE `user` = '".$pers['user']."'");
				mysql_query("UPDATE `players` SET `$resurs` = `$resurs` - '$kol_vo' WHERE `user` = '".$stat['user']."'");
				$pers[$resurs]=$pers[$resurs]+$kol_vo;
				$stat[$resurs]=$stat[$resurs]-$kol_vo;

				require_once("inc/chat/functions.php");
				insert_msg("Персонаж <b><u>".$stat['user']."</u></b> передал вам ингридиент <b><u>".$vesh."</u></b> в размере <b><u>".$kol_vo."</u></b> шт.","","","1",$pers['user'],"",$pers['room']);

				$msg_ok = "Удачно передан персонажу <u>".$pers['user']."</u> ингридиент <u>".$vesh."</u> в размере <u>".$kol_vo."</u> шт.";

			} else $msg = "Вы не можете передать самому себе ресурсы.";
		} else $msg = "Такого персонажа не существует.";
	} else $msg = "У вас нет стоилько ресурсов.";
}

if (!empty($msg)) echo"<br><center><FONT COLOR=RED><b>$msg</b></font></center><br>";
if (!empty($msg_ok)) echo"<br><center><FONT COLOR=green><b>$msg_ok</b></font></center><br>";

echo"<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
    <tr><td align='center' colspan='2'><b>Передача Ингридиентов</b></td></tr>
<tr><td align='center'>Персонажу:</td><td align='center'><input type='text' name='users' class='input'></td></tr>
<tr><td align='center'>Кол-во:</td><td align='center'><input type='text' name='kol_vo' class='input' onkeypress='key();'></td></tr>
<tr><td align='center'>Ресурс:</td><td align='center'><select name='resurs'>";


if ($stat['ing_kor_mand'] > 0) echo "<option value='ing_kor_mand'>Корень Мандрагоры</option>";
if ($stat['ing_vet_veres'] > 0) echo "<option value='ing_vet_veres'>Ветка Вереска</option>";
if ($stat['ing_koga'] > 0) echo "<option value='ing_koga'>Кусок кожи</option>";
if ($stat['ing_kosti'] > 0) echo "<option value='ing_kosti'>Кости животного</option>";
if ($stat['ing_trava'] > 0) echo "<option value='ing_trava'>Трава</option>";
if ($stat['ing_metril'] > 0) echo "<option value='ing_metril'>Метрил</option>";
if ($stat['ing_okun'] > 0) echo "<option value='ing_okun'>Окунь</option>";
if ($stat['ing_osetr'] > 0) echo "<option value='ing_osetr'>Осётр</option>";
if ($stat['ing_stavrida'] > 0) echo "<option value='ing_stavrida'>Ставрида</option>";
if ($stat['ing_narval'] > 0) echo "<option value='ing_narval'>Нарвал</option>";
if ($stat['ing_kefal'] > 0) echo "<option value='ing_kefal'>Кефаль</option>";
if ($stat['ing_4esh_drak'] > 0) echo "<option value='ing_4esh_drak'>Чешуя дракона</option>";
if ($stat['ing_vamp'] > 0) echo "<option value='ing_vamp'>Клык вампира</option>";
if ($stat['ing_br_slit'] > 0) echo "<option value='ing_br_slit'>Бронзовый слиток</option>";
if ($stat['ing_kri_kv'] > 0) echo "<option value='ing_kri_kv'>Кристалл кварца</option>";
if ($stat['ing_galo_skorp'] > 0) echo "<option value='ing_kri_kv'>Жало скорпиона</option>";
if ($stat['ing_cry'] > 0) echo "<option value='ing_cry'>Кристалы</option>";
if ($stat['ing_volos'] > 0) echo "<option value='ing_volos'>Волосы</option>";
if ($stat['ing_gribok'] > 0) echo "<option value='ing_gribok'>Грибок</option>";
if ($stat['ing_zhuk'] > 0) echo "<option value='ing_zhuk'>Жук навозный</option>";
if ($stat['ing_oleni_rog'] > 0) echo "<option value='ing_dozhdevik'>Рога оленя</option>";
if ($stat['ing_dozhdevik'] > 0) echo "<option value='ing_dozhdevik'>Дождевой червь</option>";
if ($stat['ing_shishka'] > 0) echo "<option value='ing_zhuk'>Шишка</option>";
if ($stat['ing_vetka_shipovnika'] > 0) echo "<option value='ing_dozhdevik'>Ветка шиповника</option>";
if ($stat['ing_podorojnik'] > 0) echo "<option value='ing_dozhdevik'>Подорожник</option>";



echo "</select></td></tr>
<tr><td align='center'>Действие:</td><td align='center'><input type='submit' name='peredat' value='Передать' class='input'></td></tr></table>
</div>";












echo " <br><table border='1'  cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='98%'>
  

<tr>
	<td width='5%' align='right' ></td>
      <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_kor_mand.gif' alt='Корень Мандрагоры'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_kor_mand']." шт.</b></small></td>
      <td width='5%' align='right' ></td>
	  <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_vet_veres.gif' alt='Ветка Вереска'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_vet_veres']." шт.</b></small></td>
      <td width='5%' align='right' ></td>
	  	   <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_trava.gif' alt='Трава'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_trava']." шт.</b></small></td>
      <td width='5%' align='right' ></td>
</tr>

<tr>
	<td width='5%' align='right' ></td>
      <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_shishka.gif' alt='Шишка'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_shishka']." шт.</b></small></td>
      <td width='5%' align='right' ></td>
	  <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_vetka_shipovnika.gif' alt='Ветка шиповника'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_vetka_shipovnika']." шт.</b></small></td>
      <td width='5%' align='right' ></td>
	  	   <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_podorojnik.gif' alt='Подорожник'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_podorojnik']." шт.</b></small></td>
      <td width='5%' align='right' ></td>
</tr>

<tr>
	<td width='5%' align='right' ></td>
      <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_okun.gif' alt='Окунь'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_okun']." шт.</b></small></td>
      <td width='5%' align='right' ></td>
	  <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_osetr.gif' alt='Осётр'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_osetr']." шт.</b></small></td>
      <td width='5%' align='right' ></td>
	  	   <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_stavrida.gif' alt='Ставрида'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_stavrida']." шт.</b></small></td>
      <td width='5%' align='right' ></td>
</tr>

<tr>
	<td width='5%' align='right' ></td>
      <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_narval.gif' alt='Нарвал'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_narval']." шт.</b></small></td>
      <td width='5%' align='right' ></td>
	  <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_kefal.gif' alt='Кефаль'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_kefal']." шт.</b></small></td>
      <td width='5%' align='right' ></td>
	  	   <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_koga.gif' alt='Кусок кожи'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_koga']." шт.</b></small></td>
      <td width='5%' align='right' ></td>
</tr>

<tr>
	<td width='5%' align='right' ></td>
      <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_kosti.gif' alt='Кости животного'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_kosti']." шт.</b></small></td>
      <td width='5%' align='right' ></td>
	  <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_4esh_drak.gif' alt='Чешуя дракона'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_4esh_drak']." шт.</b></small></td>
      <td width='5%' align='right' ></td>
	  	   <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_galo_skorp.gif' alt='Жало скорпиона'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_galo_skorp']." шт.</b></small></td>
      <td width='5%' align='right' ></td>
</tr>

<tr>
	<td width='5%' align='right' ></td>
      <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_oleni_rog.gif' alt='Рога оленя'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_oleni_rog']." шт.</b></small></td>
      <td width='5%' align='right' ></td>
	  <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_volos.gif' alt='Волосы'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_volos']." шт.</b></small></td>
      <td width='5%' align='right' ></td>
	        <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_vamp.gif' alt='Клык вампира'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_vamp']." шт.</b></small></td>
      <td width='5%' align='right' ></td>
	  
</tr>

<tr>
	<td width='5%' align='right' ></td>
	  <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_br_slit.gif' alt='Бронзовый слиток'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_br_slit']." шт.</b></small></td>
      <td width='5%' align='right' ></td>
	  	   <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_kri_kv.gif' alt='Кристалл кварца'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_kri_kv']." шт.</b></small></td>
      <td width='5%' align='right' >
	  <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_cry.gif' alt='Кристалы'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_cry']." шт.</b></small></td>
      <td width='5%' align='right' ></td></td>
	  
</tr>

<tr>
	<td width='5%' align='right' ></td>
<td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_metril.gif' alt='Метрил'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_metril']." шт.</b></small></td>
      <td width='5%' align='right' ></td>
	  <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_gribok.gif' alt='Грибок'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_gribok']." шт.</b></small></td>
      <td width='5%' align='right' ></td>
	  	   <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_zhuk.gif' alt='Жук навозный'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_zhuk']." шт.</b></small></td>
      <td width='5%' align='right' ></td>
</tr>



  
	  
	  
	  


<tr>
	<td width='5%' align='right' ></td>
		<td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_dozhdevik.gif' alt='Дождевой червь'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_dozhdevik']." шт.</b></small></td>
      <td width='5%' align='right' ></td>
	  <td width='10%'  align='center' background='i/inman_fon2.gif'><small>---</small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>---</b></small></td>
      <td width='5%' align='right' ></td>
	  	   <td width='10%'  align='center' background='i/inman_fon2.gif'><small>---</small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>---</b></small></td>
      <td width='5%' align='right' ></td>
</tr>
  


  </table>";





echo "
</div></form>";
 
?>