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

if ($resurs == ing_kor_mand) $vesh = "������ ����������";
elseif ($resurs == ing_vet_veres) $vesh = "����� �������";
elseif ($resurs == ing_koga) $vesh = "����� ����";
elseif ($resurs == ing_kosti) $vesh = "���� ���������";
elseif ($resurs == ing_trava) $vesh = "�����";
elseif ($resurs == ing_metril) $vesh = "������";
elseif ($resurs == ing_okun) $vesh = "�����";
elseif ($resurs == ing_osetr) $vesh = "����";
elseif ($resurs == ing_stavrida) $vesh = "��������";
elseif ($resurs == ing_narval) $vesh = "������";
elseif ($resurs == ing_kefal) $vesh = "������";
elseif ($resurs == ing_4esh_drak) $vesh = "����� �������";
elseif ($resurs == ing_vamp) $vesh = "���� �������";
elseif ($resurs == ing_br_slit) $vesh = "��������� ������";
elseif ($resurs == ing_kri_kv) $vesh = "�������� ������";
elseif ($resurs == ing_galo_skorp) $vesh = "���� ���������";
elseif ($resurs == ing_cry) $vesh = "��������";
elseif ($resurs == ing_volos) $vesh = "������";
elseif ($resurs == ing_gribok) $vesh = "������";
elseif ($resurs == ing_zhuk) $vesh = "��� ��������";
elseif ($resurs == ing_oleni_rog) $vesh = "���� �����";
elseif ($resurs == ing_dozhdevik) $vesh = "�������� �����";
elseif ($resurs == ing_shishka) $vesh = "�����";
elseif ($resurs == ing_vetka_shipovnika) $vesh = "����� ���������";
elseif ($resurs == ing_podorojnik) $vesh = "����������";



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
				insert_msg("�������� <b><u>".$stat['user']."</u></b> ������� ��� ���������� <b><u>".$vesh."</u></b> � ������� <b><u>".$kol_vo."</u></b> ��.","","","1",$pers['user'],"",$pers['room']);

				$msg_ok = "������ ������� ��������� <u>".$pers['user']."</u> ���������� <u>".$vesh."</u> � ������� <u>".$kol_vo."</u> ��.";

			} else $msg = "�� �� ������ �������� ������ ���� �������.";
		} else $msg = "������ ��������� �� ����������.";
	} else $msg = "� ��� ��� �������� ��������.";
}

if (!empty($msg)) echo"<br><center><FONT COLOR=RED><b>$msg</b></font></center><br>";
if (!empty($msg_ok)) echo"<br><center><FONT COLOR=green><b>$msg_ok</b></font></center><br>";

echo"<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
    <tr><td align='center' colspan='2'><b>�������� ������������</b></td></tr>
<tr><td align='center'>���������:</td><td align='center'><input type='text' name='users' class='input'></td></tr>
<tr><td align='center'>���-��:</td><td align='center'><input type='text' name='kol_vo' class='input' onkeypress='key();'></td></tr>
<tr><td align='center'>������:</td><td align='center'><select name='resurs'>";


if ($stat['ing_kor_mand'] > 0) echo "<option value='ing_kor_mand'>������ ����������</option>";
if ($stat['ing_vet_veres'] > 0) echo "<option value='ing_vet_veres'>����� �������</option>";
if ($stat['ing_koga'] > 0) echo "<option value='ing_koga'>����� ����</option>";
if ($stat['ing_kosti'] > 0) echo "<option value='ing_kosti'>����� ���������</option>";
if ($stat['ing_trava'] > 0) echo "<option value='ing_trava'>�����</option>";
if ($stat['ing_metril'] > 0) echo "<option value='ing_metril'>������</option>";
if ($stat['ing_okun'] > 0) echo "<option value='ing_okun'>�����</option>";
if ($stat['ing_osetr'] > 0) echo "<option value='ing_osetr'>����</option>";
if ($stat['ing_stavrida'] > 0) echo "<option value='ing_stavrida'>��������</option>";
if ($stat['ing_narval'] > 0) echo "<option value='ing_narval'>������</option>";
if ($stat['ing_kefal'] > 0) echo "<option value='ing_kefal'>������</option>";
if ($stat['ing_4esh_drak'] > 0) echo "<option value='ing_4esh_drak'>����� �������</option>";
if ($stat['ing_vamp'] > 0) echo "<option value='ing_vamp'>���� �������</option>";
if ($stat['ing_br_slit'] > 0) echo "<option value='ing_br_slit'>��������� ������</option>";
if ($stat['ing_kri_kv'] > 0) echo "<option value='ing_kri_kv'>�������� ������</option>";
if ($stat['ing_galo_skorp'] > 0) echo "<option value='ing_kri_kv'>���� ���������</option>";
if ($stat['ing_cry'] > 0) echo "<option value='ing_cry'>��������</option>";
if ($stat['ing_volos'] > 0) echo "<option value='ing_volos'>������</option>";
if ($stat['ing_gribok'] > 0) echo "<option value='ing_gribok'>������</option>";
if ($stat['ing_zhuk'] > 0) echo "<option value='ing_zhuk'>��� ��������</option>";
if ($stat['ing_oleni_rog'] > 0) echo "<option value='ing_dozhdevik'>���� �����</option>";
if ($stat['ing_dozhdevik'] > 0) echo "<option value='ing_dozhdevik'>�������� �����</option>";
if ($stat['ing_shishka'] > 0) echo "<option value='ing_zhuk'>�����</option>";
if ($stat['ing_vetka_shipovnika'] > 0) echo "<option value='ing_dozhdevik'>����� ���������</option>";
if ($stat['ing_podorojnik'] > 0) echo "<option value='ing_dozhdevik'>����������</option>";



echo "</select></td></tr>
<tr><td align='center'>��������:</td><td align='center'><input type='submit' name='peredat' value='��������' class='input'></td></tr></table>
</div>";












echo " <br><table border='1'  cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='98%'>
  

<tr>
	<td width='5%' align='right' ></td>
      <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_kor_mand.gif' alt='������ ����������'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_kor_mand']." ��.</b></small></td>
      <td width='5%' align='right' ></td>
	  <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_vet_veres.gif' alt='����� �������'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_vet_veres']." ��.</b></small></td>
      <td width='5%' align='right' ></td>
	  	   <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_trava.gif' alt='�����'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_trava']." ��.</b></small></td>
      <td width='5%' align='right' ></td>
</tr>

<tr>
	<td width='5%' align='right' ></td>
      <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_shishka.gif' alt='�����'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_shishka']." ��.</b></small></td>
      <td width='5%' align='right' ></td>
	  <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_vetka_shipovnika.gif' alt='����� ���������'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_vetka_shipovnika']." ��.</b></small></td>
      <td width='5%' align='right' ></td>
	  	   <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_podorojnik.gif' alt='����������'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_podorojnik']." ��.</b></small></td>
      <td width='5%' align='right' ></td>
</tr>

<tr>
	<td width='5%' align='right' ></td>
      <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_okun.gif' alt='�����'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_okun']." ��.</b></small></td>
      <td width='5%' align='right' ></td>
	  <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_osetr.gif' alt='����'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_osetr']." ��.</b></small></td>
      <td width='5%' align='right' ></td>
	  	   <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_stavrida.gif' alt='��������'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_stavrida']." ��.</b></small></td>
      <td width='5%' align='right' ></td>
</tr>

<tr>
	<td width='5%' align='right' ></td>
      <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_narval.gif' alt='������'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_narval']." ��.</b></small></td>
      <td width='5%' align='right' ></td>
	  <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_kefal.gif' alt='������'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_kefal']." ��.</b></small></td>
      <td width='5%' align='right' ></td>
	  	   <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_koga.gif' alt='����� ����'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_koga']." ��.</b></small></td>
      <td width='5%' align='right' ></td>
</tr>

<tr>
	<td width='5%' align='right' ></td>
      <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_kosti.gif' alt='����� ���������'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_kosti']." ��.</b></small></td>
      <td width='5%' align='right' ></td>
	  <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_4esh_drak.gif' alt='����� �������'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_4esh_drak']." ��.</b></small></td>
      <td width='5%' align='right' ></td>
	  	   <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_galo_skorp.gif' alt='���� ���������'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_galo_skorp']." ��.</b></small></td>
      <td width='5%' align='right' ></td>
</tr>

<tr>
	<td width='5%' align='right' ></td>
      <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_oleni_rog.gif' alt='���� �����'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_oleni_rog']." ��.</b></small></td>
      <td width='5%' align='right' ></td>
	  <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_volos.gif' alt='������'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_volos']." ��.</b></small></td>
      <td width='5%' align='right' ></td>
	        <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_vamp.gif' alt='���� �������'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_vamp']." ��.</b></small></td>
      <td width='5%' align='right' ></td>
	  
</tr>

<tr>
	<td width='5%' align='right' ></td>
	  <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_br_slit.gif' alt='��������� ������'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_br_slit']." ��.</b></small></td>
      <td width='5%' align='right' ></td>
	  	   <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_kri_kv.gif' alt='�������� ������'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_kri_kv']." ��.</b></small></td>
      <td width='5%' align='right' >
	  <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_cry.gif' alt='��������'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_cry']." ��.</b></small></td>
      <td width='5%' align='right' ></td></td>
	  
</tr>

<tr>
	<td width='5%' align='right' ></td>
<td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_metril.gif' alt='������'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_metril']." ��.</b></small></td>
      <td width='5%' align='right' ></td>
	  <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_gribok.gif' alt='������'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_gribok']." ��.</b></small></td>
      <td width='5%' align='right' ></td>
	  	   <td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_zhuk.gif' alt='��� ��������'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_zhuk']." ��.</b></small></td>
      <td width='5%' align='right' ></td>
</tr>



  
	  
	  
	  


<tr>
	<td width='5%' align='right' ></td>
		<td width='10%'  align='center' background='i/inman_fon2.gif'><small><img src='i/res/ing_dozhdevik.gif' alt='�������� �����'></small></td>
      <td width='10%' align='right' background='i/inman_fon2.gif'><b><small>".$stat['ing_dozhdevik']." ��.</b></small></td>
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