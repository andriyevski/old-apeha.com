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
elseif ($stat['room'] != 11) { header("Location: main.php"); exit; }
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
        document.all('form').innerHTML        = '<TABLE BGCOLOR=e2e0e0 bordercolor=A5A5A5 border=1 cellspacing=0 cellpadding=3 style=\'CURSOR: Default;\'><FORM action=\'repair.php\' method=POST><tr><td style=\'BORDER-RIGHT: 0px; BORDER-BOTTOM: 0px; padding-left:7;\'>����� ����������:</td><td style=\'BORDER-LEFT: 0px; BORDER-BOTTOM: 0px; padding-right:7;\' align=right><input type=text class=input size=32 name=grav_text><input type=hidden name=grav_id value=\''+id+'\'></td></tr><tr><td colspan=2 align=center><input type=submit value=\'�������������\' name=\'grav_submit\' class=input style=\'WIDTH: 308px\'></td></tr></FORM></table>';

}
//-->
</SCRIPT>
";


	// ----- # ��������� # ----- //
	if (@$_POST['grav_submit']) {
		if (!empty($_POST['grav_text'])) {
			if (preg_match("/^[0-9]+$/", $_POST['grav_id'])){
				$object = mysql_fetch_array(mysql_query("SELECT objects.id, objects.inf FROM objects, slots WHERE objects.user='".$stat['user']."' AND objects.tip=1 AND objects.bank=0 AND objects.lam=0 AND objects.mag=0 AND objects.pochta=0 AND objects.id=".$_POST['grav_id']." AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19)"));

				if ($object) {

					if (eregi("^[a-zA-Z�-��-�0-9_\.\,\-\!\?\ ]+$",$_POST['grav_text'])) {
						if (strlen($_POST['grav_text']) <= 20) {
							if ($stat['credits']>=1000){
								$inf = explode("|",$object['inf']);
								$infs = $inf['0']."|".$inf['1']."|".$inf['2']."|".$_POST['grav_text']."|".$inf['4']."|".$inf['5']."|".$inf['6']."|".$inf['7'];

								mysql_query("UPDATE objects SET inf='".$infs."' WHERE id=".$object['id']."");
								mysql_query("UPDATE players SET `credits` = `credits`-1000 WHERE id = '".$stat['id']."'");

								$msg = "�� ������ ������������� ������� <U>".$_POST['grav_text']."</U> �� �������� <U>".$inf['1']."</U>, �������� ��� ���� - 1000 ��.";
							}else $error = "� ��� ��������� ��.";
						}else $error = "����� ���������� �� ������ ���� ������ 20 ��������!";
					}else $error = "� ������ ���������� ����� ��������� ������ ������� ��� ���������� �����!";
				}else $error = "���-�� ��� �� ���..";
			}else $error= "�� �� ����� :)";
		}else $error = "������� ����� ����������!";
	}
	// ----- # ����� ��������� # ----- //

	// ----- # ������ # ----- //
	elseif (@$_GET['rem']) {
		if ( $stat['crdits'] >= $rem_price ) {
			if (preg_match("/^[0-9]+$/", $_GET['rem'])){
				$object = mysql_fetch_array(mysql_query("SELECT objects.id, objects.inf FROM objects, slots WHERE objects.user='".$stat['user']."' AND (objects.tip >= 1 AND objects.tip <= 11 OR objects.tip = 15) AND objects.bank=0 AND objects.lam=0 AND objects.mag=0 AND objects.pochta=0 AND objects.id=".$_GET['rem']." AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19)"));
				if ($object) {
					$inf = explode("|",$object['inf']);
					if ($inf['6']>=$inf['7'] or $inf['6']>=1){
						if($inf['7']>1){
							$inf['6']=0;
							$inf['7']=$inf['7']-1;
							$rem_price=ceil($inf['2']*0.1);
							$infs = $inf['0']."|".$inf['1']."|".$inf['2']."|".$inf['3']."|".$inf['4']."|".$inf['5']."|".$inf['6']."|".$inf['7'];
							mysql_query("UPDATE objects SET inf='".$infs."' WHERE id=".$object['id']."");
							mysql_query("UPDATE players SET `credits` = `credits`-".$rem_price." WHERE id = '".$stat['id']."'");

							$msg = "�� ������ ��������������� <U>".$inf['1']."</U>, �������� ��� ���� - ".$rem_price." ��.";
						}else $error = "���� <U>".$inf['1']."</U> �� ����������� �������";
					}else $error = "���� <U>".$inf['1']."</U> �� ��������";
				}else $error = "���-�� ��� �� ���..";
			}else $error= "�� �� ����� :)";
		}else $error = "� ��� �� ������� ��.";
	}
	// ----- # ����� ������ # ----- //


	// ----- # ������� ���� # ----- //
	elseif (@$_GET['del']) {
		if (preg_match("/^[0-9]+$/", $_GET['del'])){
			$object = mysql_fetch_array(mysql_query("SELECT objects.id, objects.inf FROM objects, slots WHERE objects.user='".$stat['user']."' AND (objects.tip >= 1 AND objects.tip <= 11 OR objects.tip = 15) AND objects.bank=0 AND objects.lam=0 AND objects.mag=0 AND objects.pochta=0 AND objects.id=".$_GET['del']." AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19)"));
			if ($object) {
				$inf = explode("|",$object['inf']);
				if ($inf['6']==$inf['7'] && $inf['7']<=1){
					$dell=mysql_query("DELETE FROM objects WHERE id=".$object['id']."");
					if($dell)
					$msg = "�� ������ ������� <U>".$inf['1']."</U>";
					else $error = "���-�� ��� �� ���..";
				}else $error = "���� <U>".$inf['1']."</U> ��� ��������";
			}else $error = "���-�� ��� �� ���..";
		}else $error= "�� �� ����� :)";
	}
	// ----- # ����� ������� ���� # ----- //


	// ----- # ���������� # ----- //
	elseif (!empty($_GET['upgrade'])) {
		$instr = mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=15 AND objects.min='1|0|0|0|0|0|0|0' AND objects.min_d=1 AND objects.max_d=2 AND objects.id IN (slots.3)");
		if (mysql_num_rows ($instr)) {
			$query_object = mysql_query("SELECT objects.* FROM objects, slots WHERE objects.user='".$stat['user']."' AND (objects.tip >= 1 AND objects.tip <= 11) AND objects.lam=0 AND objects.mag=0 AND objects.pochta=0 AND objects.bank=0 AND objects.upgrade='0' AND slots.id=".$stat['id']." AND objects.id ='".(int)$_GET['upgrade']."' AND objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) ORDER BY time desc");
			// ���� �� ���� � ���������
			if(mysql_num_rows($query_object)) {
				$object = mysql_fetch_array($query_object);

				$obj = explode('|',$object['inf']);
				// ��������� �� ��� �� � ���� ����?
				if ($obj['5']!=1 && !empty($obj['2'])) {
					// ���� �� �������
					unset($price);
					$price = $obj['2']*0.35;
					// ���� ������� �����
					if ($stat['credits'] >= $price) {
						// ���� ������������
						$shans = rand(0,100);
						$sup_fans = $shans+$stat['navik_us'];


						## �� �����
						if ($shans == 111) {
							# ������ ������� �������
							$msg = '������� <b>'.stripslashes($obj['1']).'</b> ��� ������...';

							$obj['1'] = $obj['1'].' [��]';
							$obj['6'] = $obj['7'];
							$new_inf = implode('|', $obj);
							mysql_query("UPDATE `objects` SET `inf` = '".$new_inf."', `upgrade` = '1' WHERE `id` = '".$object['id']."'");
						} else {
							## �� �����



							$arr_params = array ('0' => 'br1','br2','br3','br4','br5','min_d','max_d','hp','energy','strength','dex','agility','vitality','razum','krit','unkrit','uv','unuv');
							$arr_params2 = $arr_params;

							if ($sup_fans >= 50) {
								$add_navik = (0.3*$obj['2'])/200;
								# ��-�� �����������
								$msg = '������� <b>'.stripslashes($obj['1']).'</b> ������ �������...<br>��� ����� ������� ������� �� '.$add_navik.'%';

								$obj['1'] = $obj['1'].' [��]';

								while ($param = each($arr_params)) {
									if (isset($object[$param['value']])) {
										$kef = rand(1,3);
										$s_kef = $kef/10;

										# ��������
										$object[$param['value']] += ceil($object[$param['value']]*$s_kef);
									}
								}
							}
							else {
								# � ����� ���������
								$add_navik = (0.1*$obj['2'])/200;
								$msg = '������� <b>'.stripslashes($obj['1']).'</b> �������� �������...<br>��� ����� ������� ������� �� '.$add_navik.'%';

								$obj['1'] = $obj['1'].' [��]';

								while ($param = each($arr_params)) {
									if (isset($object[$param['value']])) {
										$kef1 = rand(1,3);
										$s_kef1 = $kef1/10;

										# ��������
										$object[$param['value']] -= ceil($object[$param['value']]*$s_kef1);
									}
								}
							}

							// ������ ��� ���� ������� � ���� ��������
							$new_inf = implode('|', $obj);
							$params_update = '';
							while ($param = each($arr_params2)) {
								if (isset($object[$param['value']])) {
									$params_update .= '`'.$param['value'].'` = \''.$object[$param['value']].'\',';
								}
							}
							mysql_query("UPDATE `objects` SET `inf` = '".$new_inf."', ".$params_update." `upgrade` = '1' WHERE `id` = '".$object['id']."'");
						}

						$izn_instr = mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE objects.min='1|0|0|0|0|0|0|0' AND objects.min_d=1 AND objects.max_d=2 AND objects.tip=17 AND user='".$stat['user']."'"));
						$instr_inf=explode("|",$izn_instr['inf']);
						$iznos=($instr_inf[6]+1);

						mysql_query("UPDATE objects SET inf='".$instr_inf['0']."|".$instr_inf['1']."|".$instr_inf['2']."|".$instr_inf['3']."|".$instr_inf['4']."|".$instr_inf['5']."|".$iznos."|".$instr_inf['7']."' WHERE id='".$izn_instr['id']."'");

						// ������� ������ � ����� ������
						mysql_query("UPDATE `players` SET `credits` = `credits`-".$price.", navik_us=navik_us+$add_navik WHERE `id` = '".$stat['id']."'");
					} else $error = '� ��� �� ������� ������!';
				} else $error = '������� �� �������� ���������!';
			} else $error = '������� �� ������!';
		} else $error = '����� ���������� �������� � ���� ����� �������!';
	}
	// ----- # ����� ���������� # ----- //





	// ----- # ���������� ������ # ----- //
	elseif (!empty($_GET['upgrade1'])) {

		$instr = mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=15 AND objects.min='1|0|0|0|0|0|0|0' AND objects.min_d=1 AND objects.max_d=2 AND objects.id IN (slots.3)");
		if (mysql_num_rows ($instr)) {

			$query_object = mysql_query("SELECT objects.* FROM objects, slots WHERE objects.user='".$stat['user']."' AND (objects.tip >= 1 AND objects.tip <= 11) AND objects.bank=0 AND objects.lam=0 AND objects.pochta=0 AND objects.mag=0 AND objects.komis=0 AND objects.upgrade=0 AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) ORDER BY time desc");
			// ���� �� ���� � ���������
			if(mysql_num_rows($query_object)) {
				$object = mysql_fetch_array($query_object);

				$obj = explode('|',$object['inf']);
				// ��������� �� ��� �� � ���� ����?
				if ($obj['5']!=1 && !empty($obj['2'])) {
					// ���� �� �������
					unset($price);
					$price = round(($obj[2]*0.09)/20, 2);
					// ���� ������� �����
					if ($stat['valute'] >= $price) {
						// ���� ������������

						$arr_params = array ('0' => 'br1','br2','br3','br4','br5','min_d','max_d','hp','energy','strength','dex','agility','vitality','razum','krit','unkrit','uv','unuv');
						$arr_params2 = $arr_params;
						$add_navik = (0.5*$obj['2'])/200;
						$add_navik = $add_navik*2;

						# ��-�� ��������
						$msg = '�� ������ ������, ������� <b>'.stripslashes($obj['1']).'</b> ������ �������...<br>��� ����� ������� ������� �� '.$add_navik.'%';

						$obj['1'] = $obj['1'].' [���]';

						while ($param = each($arr_params)) {
							if (isset($object[$param['value']])) {
								$kef = rand(3,5);
								$s_kef = $kef/10;

								# ��������
								$object[$param['value']] += ceil($object[$param['value']]*$s_kef);
							}
						}
						// ������ ��� ���� ������� � ���� ��������
						$new_inf = implode('|', $obj);
						$params_update = '';
						while ($param = each($arr_params2)) {
							if (isset($object[$param['value']])) {
								$params_update .= '`'.$param['value'].'` = \''.$object[$param['value']].'\',';
							}
						}
						mysql_query("UPDATE `objects` SET `inf` = '".$new_inf."', ".$params_update." `upgrade` = '1' WHERE `id` = '".$object['id']."'");

						$izn_instr = mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE objects.min='1|0|0|0|0|0|0|0' AND objects.min_d=1 AND objects.max_d=2 AND objects.tip=15 AND user='".$stat['user']."'"));
						$instr_inf=explode("|",$izn_instr['inf']);
						$iznos=($instr_inf[6]+1);

						mysql_query("UPDATE objects SET inf='".$instr_inf['0']."|".$instr_inf['1']."|".$instr_inf['2']."|".$instr_inf['3']."|".$instr_inf['4']."|".$instr_inf['5']."|".$iznos."|".$instr_inf['7']."' WHERE id='".$izn_instr['id']."'");


						// ������� ������ � ����� ������
						mysql_query("UPDATE `players` SET `valute`=`valute`-".$price.", `navik_us`=`navik_us`+".$add_navik." WHERE `id` = '".$stat['id']."'");
					} else $error = '� ��� �� ������� ��.';
				} else $error = '������� �� �������� �������� ���������!';
			} else $error = '������� �� ������!';
		} else $error = '����� ���������� �������� � ���� ����� �������!';
	}
	// ----- # ����� ���������� # ----- //



	function show ($id) {
		global $stat;

		switch ($id) {
			case 1:

				$it_sost=mysql_query("SELECT objects.* FROM objects, slots WHERE objects.user='".$stat['user']."' AND (objects.tip >= 1 AND objects.tip <= 11 OR objects.tip = 15) AND objects.bank=0 AND objects.lam=0 AND objects.pochta=0 AND objects.mag=0 AND objects.komis=0 AND slots.id=".$stat['id']." AND objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) ORDER BY time desc");

				if (mysql_num_rows($it_sost)) {
					for($i=0; $i<mysql_num_rows($it_sost); $i++) {

						$objects=mysql_fetch_array($it_sost);

						$obj_inf=explode("|",$objects['inf']);
						$obj_min=explode("|",$objects['min']);
						$obj_add=explode("|",$objects['add']);

						include('inc/main/min_tr.php');
						include('inc/main/add.php');
						include('inc/main/classes.php');
						$rem_price=ceil($obj_inf['2']*0.1);
						if ($obj_inf['6']>=$obj_inf['7'] or $obj_inf['6']>=1){
							echo"<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
      <td width='30%' align='center'>
<img src='i/items/".$obj_inf['0'].".gif' alt='".$obj_inf['1']."'><br>";
							if($obj_inf['7']<=1 && $obj_inf['6']>=$obj_inf['7'])
							echo "";
							elseif($obj_inf['6']>=$obj_inf['7']  or $obj_inf['6']>=1)
							echo "<br><a href='repair.php?rem=".$objects['id']."'>������ �� ".$rem_price." ��.</a>";
								
							echo " </td><td width='70%'>
      <small><b>".$obj_inf['1']."</b><br>
      ���. ����: <b>".$obj_inf['2']."</b> ��.<br>
      <font color='red'>�������������: <b>".$obj_inf['6']."</b>/<b>".$obj_inf['7']."</b></font><br></small>
  <br><b><u><small>����������� ����������:</u></b><br>
  $min_rase$min_level$min_str$min_dex$min_ag$min_vit$min_razum$min_proff<br></small>";
  if ($hp or $energy or $uron or $strength or $dex or $agility or $vitality or $razum or $br1 or $br2 or $br5 or $br3 or $br4 or $krit or $unkrit or $uv or $unuv)
  echo"<b><u><small>�������� ��������:</u></b>
<br>$hp$energy$uron$strength$dex$agility$vitality$razum$br1$br2$br3$br4$br5$krit$unkrit$uv$unuv<br></small>";
  if ($about or $dotime)
  echo"<b><u><small>�������������� ����������:</u></b><br>$about$dotime</small>";
  if ($obj_inf['3']) echo"<b><u><small>������������� �������:</u></b><BR>".$obj_inf['3'];

  echo "
      </td>
    </tr>
  </table>
</div>";
						}
					}
				} else

				echo"<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
      <td width='100%' height='100%' align='center'>
        � ��� ��� ���������, ���������� �������.
      </td>
    </tr>
  </table>
</div>";

				break;


			case 2:

				$it_sost=mysql_query("SELECT objects.* FROM objects, slots WHERE objects.user='".$stat['user']."' AND objects.tip = 1 AND objects.bank=0 AND objects.lam=0 AND objects.pochta=0 AND objects.mag=0 AND objects.komis=0 AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) ORDER BY time desc");

				if (mysql_num_rows($it_sost)) {

					for($i=0; $i<mysql_num_rows($it_sost); $i++) {

						$objects=mysql_fetch_array($it_sost);

						$obj_inf=explode("|",$objects['inf']);
						$obj_min=explode("|",$objects['min']);
						$obj_add=explode("|",$objects['add']);

						include('inc/main/min_tr.php');
						include('inc/main/add.php');
						include('inc/main/classes.php');
						if ($objects['tip'] == 1 && !$obj_inf['3']){
							echo"<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
      <td width='30%' align='center'>
<img src='i/items/".$obj_inf['0'].".gif' alt='".$obj_inf['1']."'><br>";
							echo"<a href='javascript:;' onclick=\"present(".$objects['id'].");\" id='f_".$objects['id']."'>������������� ������� �� 1000 ��.</a>";
							echo " </td><td width='70%'>
      <small><b>".$obj_inf['1']."</b><br>
      ���. ����: <b>".$obj_inf['2']."</b> ��.<br>
      �������������: <b>".$obj_inf['6']."</b>/<b>".$obj_inf['7']."</b><br></small>
  <br><b><u><small>����������� ����������:</u></b><br>
  $min_rase$min_level$min_str$min_dex$min_ag$min_vit$min_razum$min_proff<br></small>";
  if ($hp or $energy or $uron or $strength or $dex or $agility or $vitality or $razum or $br1 or $br2 or $br5 or $br3 or $br4 or $krit or $unkrit or $uv or $unuv)
  echo"<b><u><small>�������� ��������:</u></b>
<br>$hp$energy$uron$strength$dex$agility$vitality$razum$br1$br2$br3$br4$br5$krit$unkrit$uv$unuv<br></small>";
  if ($about or $dotime)
  echo"<b><u><small>�������������� ����������:</u></b><br>$about$dotime</small>";
  if ($obj_inf['3']) echo"<b><u><small>������������� �������:</u></b><BR>".$obj_inf['3'];

  echo "
      </td>
    </tr>
  </table>
</div>";
						}
					}
				} else

				echo"<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
      <td width='100%' height='100%' align='center'>
        � ��� ��� ���������, ���������� ����������.
      </td>
    </tr>
  </table>
</div>";

				break;


			case 3:

				echo"<table border=0 width=100%>";
				$it_sost=mysql_query("SELECT objects.* FROM objects, slots WHERE objects.user='".$stat['user']."' AND (objects.tip >= 1 AND objects.tip <= 11) AND objects.bank=0 AND objects.lam=0 AND objects.pochta=0 AND objects.mag=0 AND objects.komis=0 AND objects.upgrade=0 AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) ORDER BY time desc");

				if (mysql_num_rows($it_sost)) {

					for($i=0; $i<mysql_num_rows($it_sost); $i++) {

						$objects=mysql_fetch_array($it_sost);

						$obj_inf=explode("|",$objects['inf']);
						$obj_min=explode("|",$objects['min']);
						$obj_add=explode("|",$objects['add']);

						include('inc/main/min_tr.php');
						include('inc/main/add.php');
						include('inc/main/classes.php');
						$price = $obj_inf['2']*0.35;
						$price2 = round(($obj_inf['2']*0.09)/20, 2);
						if ($objects['tip']>=1 && $objects['tip']<=11){
							echo"<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
      <td width='30%' align='center'>
<img src='i/items/".$obj_inf['0'].".gif' alt='".$obj_inf['1']."'><br>
<a href=\"repair.php?upgrade=".$objects['id']."\">��������� �� <b>".$price."</b> ��.</a>
<br><a href=\"repair.php?upgrade1=".$objects['id']."\">������� ��������� �� <b>".$price2."</b> ��.</a>";
							echo " </td><td width='70%'>
      <small><b>".$obj_inf['1']."</b><br>
      ���. ����: <b>".$obj_inf['2']."</b> ��.<br>
      �������������: <b>".$obj_inf['6']."</b>/<b>".$obj_inf['7']."</b><br></small>
  <br><b><u><small>����������� ����������:</u></b><br>
  $min_rase$min_level$min_str$min_dex$min_ag$min_vit$min_razum$min_proff<br></small>";
  if ($hp or $energy or $uron or $strength or $dex or $agility or $vitality or $razum or $br1 or $br2 or $br5 or $br3 or $br4 or $krit or $unkrit or $uv or $unuv)
  echo"<b><u><small>�������� ��������:</u></b>
<br>$hp$energy$uron$strength$dex$agility$vitality$razum$br1$br2$br3$br4$br5$krit$unkrit$uv$unuv<br></small>";
  if ($about or $dotime)
  echo"<b><u><small>�������������� ����������:</u></b><br>$about$dotime</small>";
  if ($obj_inf['3']) echo"<b><u><small>������������� �������:</u></b><BR>".$obj_inf['3'];

  echo "
      </td>
    </tr>
  </table>
</div>";
						}
					}
				} else

				echo"<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
      <td width='100%' height='100%' align='center'>
        � ��� ��� ���������, ���������� ���������.
      </td>
    </tr>
  </table>
</div>";

				break;



		}}






		echo"
<body background='/i/bg.gif' leftmargin=0 topmargin=0>

<DIV ID=hint1></DIV>

<SCRIPT src='i/show_inf.js'></SCRIPT>
";


		print"<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td>&nbsp;&nbsp;<b>� ��� �� �����:</b> <u>".$stat['credits']."</u> <b>��.</b><br>
&nbsp;&nbsp;<b>� ��� �� �����:</b> <u>".$stat['valute']."</u> <b>��.</b>
</td>

<td align=right valign=top>

<input class=input type=button value='��������' onclick='window.location.href=\"repair.php?otdel=$_GET[otdel]&tmp=\"+Math.random();\"\"'>

<input class=input type=button value='���������' onclick='window.location.href=\"world.php?room=25&tmp=\"+Math.random();\"\"'>

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

		echo "<td align=center width=20%><A"; if ($otdel == 1) echo" disabled><b>"; else echo" HREF='repair.php?otdel=1'>"; echo"������</b></A></td>";
		echo "<td align=center width=20%><A"; if ($otdel == 2) echo" disabled><b>"; else echo" HREF='repair.php?otdel=2'>"; echo"����������</b></A></td>";
		echo "<td align=center width=20%><A"; if ($otdel == 3) echo" disabled><b>"; else echo" HREF='repair.php?otdel=3'>"; echo"���������</b></A></td>";



		echo "</tr>
  </table>
</div>";

		if (!empty($_GET['otdel'])) {


			switch ($_GET['otdel']) {
				case 1: show(1); break;
				case 2: show(2); break;
				case 3: show(3); break;


				default: echo"<B STYLE='COLOR: Red'>���-�� ��� �� ���...</B>"; break;
			}

		} else echo "<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
    <tr><td align='left'><u><b>�������</b></u><br>
����� �� ������ <b>���������������</b> ��������� � ���������� ���� ����� �� <b>10% �� �� ���������</b>, �������� ���� ������ �����-���� <b>�����������</b>, ��������, � ����� ������� ��� ����������, � ����� �������� �������,  ���������� <b>��������</b> ����� �� ��������� � �������� ���������. �� �������, ��� � ���������� ����� ����� �������� �������� ����� � �� ���������� ��� - ���������� ����������� ��������� ��������. ��� <b>����������</b> ���� ��� <b>����� �������</b> ������ � ����������� �� ���������� � ��������� ��������. ��� ���� �����, ��� ������ ����������� ����, ��� �������� �������� ������ ����. ����� �� ��������� � �������� ��������� ����� �������� ������ <b>1 ���</b>, �� �������� �� ����������. �������� ����� �������� ���������� <b>35%</b> �� ��������� <b>����������� ���������</b>.<br> 
���� �� ���������� �� ���������, �� ������ ���������� � <b>�������� ���������</b>. ��� ���� ��������� ����������� ��������� ������� �������� � ���������� ��������� ��������, <b>�� ������ �� ��� ��������� ��� �� � ��, � � ��</b> � ���������� <b>9%</b> �� ��������� ��������, ������������ � ��. �.�. ������ �������� ���� ���������� <b>100 ��</b> ��� ��������� � <b>(100*0.09)/20 = 0.45 ��</b>. <b>����� �������</b> ��� ������� ��������� ���������� ������, ��� ��� �������.
</td>
</tr>
  </table>
</div>";


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