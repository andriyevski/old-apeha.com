<?
require_once("inc/module.php");
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";
if ($stat[t_time]>time()) { header("Location: prison.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
//elseif ($stat['room'] != 67) { header("Location: main.php"); exit; }
elseif ($stat['o_time']>time()) { header("Location: juvelir.php"); exit; }
elseif ($stat['r_time']>time()) { header("Location: podzem.php"); exit; }
elseif ($stat['mol_bog_swet']>time()) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>time()) { header("Location: bog_hram.php"); exit; }
else {
	include("inc/html_header.php");

	echo"<body bgcolor='#F5FFDA'>";

	if ( $set == 'ferm' ) {
		include("pomest_ferm.php");
	}
	// elseif ( $set == '' ) {
	//include("pomest_.php");
	//}
	elseif ( $set == 'pomest' ) {
		include("pomest_pomest.php");
	} elseif ( $set == 'repair' ) {
		include("pomest_repair.php");
	} elseif ( $set == 'bank' ) {
		include("pomest_bank_f.php");
	}

	echo"
<input class=input type=button value='��������' onclick='window.location.href=\"pomest.php?tmp=\"+Math.random();\"\"'>
<input class=input type=button value='���������' onclick='window.location.href=\"world5.php?room=67&tmp=\"+Math.random();\"\"'>
";
	if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";

	?>

<table border='0' width='100%' cellspacing='0' cellpadding='0'>
	<tr>
		<td width='100%' align='center'>


		<table border='0' width='100%' height='100%' cellspacing='0'
			cellpadding='0'>
			<tr>
				<td width='22' height='100%'>
				<table border='0' width='22' height='100%' cellspacing='0'
					cellpadding='0'>
					<tr>
						<td width='22' height='25'><img src='i/inman_b11.gif' width='22'
							height='25' alt=''></td>
					</tr>
					<tr>
						<td width='22' height='69'><img src='i/inman_b12.gif' width='22'
							height='69' alt=''></td>
					</tr>
					<tr>
						<td width='22' height='100%' background='i/inman_b13.gif'>&nbsp;</td>
					</tr>
					<tr>
						<td width='22' height='69'><img src='i/inman_b14.gif' width='22'
							height='69' alt=''></td>
					</tr>
					<tr>
						<td width='22' height='25'><img src='i/inman_b15.gif' width='22'
							height='25' alt=''></td>
					</tr>
				</table>

				</td>
				<td height='100%'>
				<table border='0' width='100%' height='100%' cellspacing='0'
					cellpadding='0'>
					<tr>
						<td width='100%' height='25'>
						<table border='0' width='100%' height='25' cellspacing='0'
							cellpadding='0'>
							<tr>
								<td width='51' height='25'><img src='i/inman_b211.gif'
									width='51' height='25' alt=''></td>
								<td background='i/inman_b212.gif' valign='middle'>
								<table border='0' height='22' cellspacing='0' cellpadding='0'
									align='center'>
									<tr>
										<td width='43' height='22'><img border='0'
											src='i/inman_rb01.gif' width='43' height='22'></td>
										<td background='i/inman_rb02.gif' height='22' valign='middle'>
										<font color='#FFFFFF' face='Verdana' size='2'><a href='?set='>����������</a>
										<a href='?set=pomest'>��������</a> <a href='?set=ferm'>�����</a>
										<a href='?set=repair'>����������</a> <a href='?set=zeml'>��������</a>
										<a href='?set=bank'>����</a></font></td>
										<td width='43' height='22'><img border='0'
											src='i/inman_rb03.gif' width='43' height='22'></td>
									</tr>
								</table>


								</td>
								<td width='51' height='25'><img src='i/inman_b213.gif'
									width='51' height='25' alt=''></td>
							</tr>
						</table>

						</td>
					</tr>
					<tr>
						<td width='100%' height='100%' background='i/inman_fon.gif'>
						<table border='0' width='100%' height='100%' cellspacing='0'
							cellpadding='0'>
							<tr>
								<td height='30' align='center'>

								<table border='0' height='22' cellspacing='0' cellpadding='0'
									align='center'>
									<tr>
										<td width='43' height='22'><img border='0'
											src='i/inman_rb01.gif' width='43' height='22'></td>
										<td background='i/inman_rb02.gif' height='22' align='center'>
										<b><font color='#FFFFFF' face='Verdana' size='2'>����������</font></b></td>
										<td width='43' height='22'><img border='0'
											src='i/inman_rb03.gif' width='43' height='22'></td>
									</tr>
								</table>
								</td>
								<td height='30' align='center'><b><font face='Verdana' size='4'><? if ( $set == '' ) { echo"����������"; } elseif ( $set == 'ferm' ) { echo"�����"; } elseif ( $set == 'pomest' ) { echo"��������"; } elseif ( $set == 'repair' ) { echo"����������"; } elseif ( $set == 'zeml' ) { echo"��������"; } elseif ( $set == 'bank' ) { echo"����"; } ?></font></b></td>
								<td height='30' align='center'>
								<table border='0' height='22' cellspacing='0' cellpadding='0'
									align='center'>
									<tr>
										<td width='43' height='22'><img border='0'
											src='i/inman_rb01.gif' width='43' height='22'></td>
										<td background='i/inman_rb02.gif' height='22' align='center'>
										<b><font color='#FFFFFF' face='Verdana' size='2'>��������</font></b></td>
										<td width='43' height='22'><img border='0'
											src='i/inman_rb03.gif' width='43' height='22'></td>
									</tr>
								</table>
								</td>
							</tr>
							<tr>
								<td width='307' height='100%' valign='top'>

								<table border='0' cellpadding='0' cellspacing='0' width='307'>
									<tr>
										<td width='6' height='7'><img src='i/rama_07.gif' width='6'
											height='7' alt=''></td>
										<td width='295' height='7'><img src='i/rama_08.gif'
											width='295' height='7' alt=''></td>
										<td width='6' height='7'><img src='i/rama_09.gif' width='6'
											height='7' alt=''></td>
									</tr>
									<tr>
										<td background='i/rama_12.gif' width='6'>&nbsp;</td>
										<td background='i/inman_fon.gif'>
										<table cellspacing='0' cellpadding='0'
											style='border-collapse: collapse; padding: 10' border='0'
											align='center'>
											<tr>
												<td><? 
												if ( $set == 'ferm' ) {
													if ( $stat['lvl_ferm'] >= 1 ) {
														$kol_eda_den = $stat['kol_ferm']*4;
														echo "
�������: <b>".$stat['lvl_ferm']."</b><br>
���-�� ��������: <b>".$stat['kol_ferm']."</b>/<b>".$stat['lvl_pomest']."</b> ���.<br>
���-�� ��������� �� ������: <b>".$stat['eda_ferm']."</b> ��.<br>
������������ ��������� �� �����:  <b>$kol_eda_den</b> ��.";
													} else echo "������ �� ����������"; }
													elseif ( $set == 'repair' ) {
														if ( $stat['lvl_repair'] >= 1 ) {
															$skidka = $stat['kol_repair']*5;
															echo "
�������: <b>".$stat['lvl_repair']."</b><br>
���-�� �������: <b>".$stat['kol_repair']."</b>/<b>".$stat['lvl_pomest']."</b> ���.<br>
������ �� ������:  <b>$skidka</b> %"; 
														} else echo "������ �� ����������"; }
														elseif ( $set == '' ) {
															if ( $stat['lvl_ferm'] <= 0 )
															echo "�����: <b>�� ���������</b><br>";
															else echo "�����: <b>���������</b><br>";
															if ( $stat['lvl_pomest'] <= 0 )
															echo "��������: <b>�� ���������</b><br>";
															else echo "��������: <b>���������</b><br>";
															if ( $stat['lvl_repair'] <= 0 )
															echo "����������: <b>�� ���������</b><br>";
															else echo "����������: <b>���������</b><br>";
															if ( $stat['lvl_bank'] <= 0 )
															echo "����: <b>�� ���������</b><br>";
															else echo "����: <b>���������</b><br>";
														} elseif ( $set == 'zeml' ) {
															echo "���������� �����������"; }
															elseif ( $set == 'pomest' ) {
																if ( $stat['lvl_pomest'] >= 1 ) {
																	echo "
�������: <b>".$stat['lvl_pomest']."</b><br>
���-�� ����������: <b>".$stat['kol_pomest']."</b>/<b>".$stat['lvl_pomest']."</b> ���."; 
																} else echo "������ �� ����������"; }
																elseif ( $set == 'bank' ) {
																	if ( $stat['lvl_bank'] ) {
																		echo "
�������: <b>".$stat['lvl_bank']."</b><br>
��������� ������: <b>".$stat['lvl_bank']."</b>%<br>
��������: <b>".$stat['depoz']."</b>/<b>".$stat['depozit']."</b> ��.<br>
���������: <b>".$stat['bank']."</b> ��.<br>
�����: <b>$doxod</b> ��."; 
																	} else echo "������ �� ����������"; }
																	?></td>
											</tr>
										</table>
										</td>
										<td background='i/rama_14.gif' width='6'>&nbsp;</td>
									</tr>
									<tr>
										<td width='6' height='8'><img src='i/rama_17.gif' width='6'
											height='8' alt=''></td>
										<td width='295' height='8'><img src='i/rama_18.gif'
											width='295' height='8' alt=''></td>
										<td width='6' height='8'><img src='i/rama_19.gif' width='6'
											height='8' alt=''></td>
									</tr>

								</table>


								</td>
								<td>
								<table cellspacing='0' width='100%' cellpadding='0'
									style='border-collapse: collapse; padding: 10' border='0'>
									<tr>
										<td align='center'><?
										$pomest = mysql_fetch_array(mysql_query("SELECT * FROM `pomest` WHERE `name` = '$set'"));
										if ( $set == 'repair' ) {

											//������
											if (@$_GET['rem']) {
												if (preg_match("/^[0-9]+$/", $_GET['rem'])){
													$object = mysql_fetch_array(mysql_query("SELECT objects.id, objects.inf FROM objects, slots WHERE objects.user='".$stat['user']."' AND (objects.tip >= 1 AND objects.tip <= 17) AND objects.bank=0 AND objects.lam=0 AND objects.id=".$_GET['rem']." AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19)"));
													if ($object) {
														$inf = explode("|",$object['inf']);
														if ($inf['6']==$inf['7']){
															if($inf['7']>1){
																$inf['6']=0;
																$inf['7']=$inf['7']-1;
																$rem_price = ($obj_inf['2']*0.1)*(100-$skidka)/100;
																$infs = $inf['0']."|".$inf['1']."|".$inf['2']."|".$inf['3']."|".$inf['4']."|".$inf['5']."|".$inf['6']."|".$inf['7'];
																mysql_query("UPDATE objects SET inf='".$infs."' WHERE id=".$object['id']."");
																mysql_query("UPDATE players SET credits=credits-$rem_price WHERE user=".$stat['user']."");
																$msg = "�� ������ ��������������� <U>".$inf['1']."</U>, �������� ��� ���� - ".$rem_price." ��.";
															}else $msg = "���� <U>".$inf['1']."</U> �� ����������� �������";
														}else $msg = "���� <U>".$inf['1']."</U> �� ��������";
													}else $msg = "���-�� ��� �� ���..";
												}else $msg = "�� �� ����� :)";
											}

											//�������� ����
											if (@$_GET['del']) {
												if (preg_match("/^[0-9]+$/", $_GET['del'])){
													$object = mysql_fetch_array(mysql_query("SELECT objects.id, objects.inf FROM objects, slots WHERE objects.user='".$stat['user']."' AND (objects.tip >= 1 AND objects.tip <= 17) AND objects.bank=0 AND objects.lam=0 AND objects.id=".$_GET['del']." AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19)"));
													if ($object) {
														$inf = explode("|",$object['inf']);
														if ($inf['6']==$inf['7'] && $inf['7']<=1){
															$dell=mysql_query("DELETE FROM objects WHERE id=".$object['id']."");
															if($dell)
															$msg = "�� ������ ������� <U>".$inf['1']."</U>";
															else $msg = "���-�� ��� �� ���..";
														}else $msg = "���� <U>".$inf['1']."</U> ��� ��������";
													}else $msg = "���-�� ��� �� ���..";
												}else $msg = "�� �� ����� :)";
											}


											$it_sost=mysql_query("SELECT objects.* FROM objects, slots WHERE objects.user='".$stat['user']."' AND (objects.tip >= 1 AND objects.tip <= 17) AND objects.bank=0 AND objects.lam=0 AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) ORDER BY time desc");

											if (mysql_num_rows($it_sost)) {
												echo"<table width=100% cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1>";

												for($i=0; $i<mysql_num_rows($it_sost); $i++) {

													$objects=mysql_fetch_array($it_sost);

													$obj_inf=explode("|",$objects['inf']);
													$obj_min=explode("|",$objects['min']);
													$obj_add=explode("|",$objects['add']);

													include('inc/main/min_tr.php');
													include('inc/main/add.php');
													include('inc/main/classes.php');
													if ($obj_inf['6']>=$obj_inf['7']){
														$rem_price = ($obj_inf['2']*0.1)*(100-$skidka)/100;
														$s="";
														if($obj_inf['7']<=1 && $obj_inf['6']>=$obj_inf['7'])
														$s="<br><a href='pomest.php?set=repair&del=".$objects['id']."'>�������</a>";
														elseif($obj_inf['6']>=$obj_inf['7'])
														$s="<br><a href='pomest.php?set=repair&rem=".$objects['id']."'>������ �� $rem_price ��.</a>";
														echo"
                <tr><td width=33% align=center valign=center>
                <b>".$obj_inf['1']."</b><br><br>
                <img src='i/money.gif' alt='���� ��������'> <b>".$obj_inf['2']." ��.</b><br>
                <img src='i/item_iznos.gif' alt='������������� ��������'> <b>".$obj_inf['6']."</b>/<b>".$obj_inf['7']."</b><br>
                </td>
                <td width=34% align=center>
                <img src='i/items/".$obj_inf['0'].".gif' alt='".$obj_inf['1']."'>
                ".$s."
                </td>
                <td width=33% valign=top>
                <b><i>����������� ����������:</i></b><br>
                $min_rase$min_level$min_str$min_dex$min_ag$min_vit<br>
                <b><i>�������� ��������:</i></b><br>
                $hp$energy$uron$strength$dex$agility$vitality$razum$br1$br2$br5$br3$br4$krit$unkrit$uv$unuv";

                if ($objects['about']) echo"<b><i>�������������� ����������:</i></b><br>$about";

                echo"</td></tr>";
													}
												}
											} else
											echo"� ��� ��� ���������, ���������� �������.";

											echo"</table>";

										}
										elseif ( $set == 'zeml' ) {
											include ("pomest_zeml.php"); }
											elseif ( $set == 'bank' ) {
												echo"
<form action='' method='post'>
<table>
<tr><td>
<td width='50%' align='center'><b>�������� �� ����</b><br>
<input name='money1' class=input type='text' value='0' size='5' maxlength='10'> / <b>".$stat['credits']."</b> ��.<br><input class=input name='deposit' type='submit' value='��������'></td>
<td width='50%' align='center'><b>����� �� �����</b><br>
<input name='money2' class=input type='text' value='0' size='5' maxlength='10'> / <b>".$stat['bank']."</b> ��.<br><input class=input name='withdraw' type='submit' value='�����'></td>
</tr></td>
</table>
</form>
"; }
												else echo "".$pomest['text']."";
												?></td>
									</tr>
								</table>
								</td>
								<td width='307' height='100%' valign='top'>

								<table border='0' cellpadding='0' cellspacing='0' width='307'>
									<tr>
										<td width='6' height='7'><img src='i/rama_07.gif' width='6'
											height='7' alt=''></td>
										<td width='295' height='7'><img src='i/rama_08.gif'
											width='295' height='7' alt=''></td>
										<td width='6' height='7'><img src='i/rama_09.gif' width='6'
											height='7' alt=''></td>
									</tr>
									<tr>
										<td background='i/rama_12.gif' width='6'>&nbsp;</td>
										<td background='i/inman_fon.gif'>

										<table cellspacing='0' cellpadding='0'
											style='border-collapse: collapse; padding: 10' border='0'
											align='center'>
											<tr>
												<td><?
												if ($set=="ferm") {
													echo "<form action='' method=post>";
													if ( $stat['lvl_ferm'] >= 1 ) { // ���� ���� �����, �� ���������� ��
														echo "<select name=up_lvl_ferm><option value=1>1 ��. - 25 ��<option value=2>2 ��. - 50 ��<option value=3>3 ��. - 75 ��<option value=4>4 ��. - 100 ��<option value=5>5 ��. - 125 ��</select>
<input type=submit class=input value='��������' name=up_ferm><br>";
														echo"<br><select name=up_fermers_kol><option value=1>1 ���. - 100 ��<option value=2>2 ���. - 200 ��<option value=3>3 ���. - 300 ��<option value=4>4 ���. - 400 ��<option value=5>5 ���. - 500 ��</select>
<input type=submit class=input value='������' name=kup_fermers><br>";
														echo"<br><select name=del_fermers_kol><option value=1>1 ���.<option value=2>2 ���.<option value=3>3 ���.<option value=4>4 ���.<option value=5>5 ���.</select>
<input type=submit class=input value='�������' name=del_fermers>"; }
														elseif ( $stat['lvl_ferm'] <= 0 ) {
															echo "<center><input type=submit class=input value='��������� ����� - 100 ��' name=kup_ferm></center>"; }
															echo "</form>";
												}
												elseif ($set=="pomest") {
													echo "<form action='' method=post>";
													if ( $stat['lvl_pomest'] >= 1 ) { // ���� ���� ��������, �� ���������� ��
														echo "<select name=up_lvl_pomest><option value=1>1 ��. - 50 ��<option value=2>2 ��. - 100 ��<option value=3>3 ��. - 150 ��<option value=4>4 ��. - 200 ��<option value=5>5 ��. - 250 ��</select>
<input type=submit class=input value='��������' name=up_pomest><br>";
														echo"<br><select name=up_pomests_kol><option value=1>1 ���. - 50 ��<option value=2>2 ���. - 100 ��<option value=3>3 ���. - 150 ��<option value=4>4 ���. - 200 ��<option value=5>5 ���. - 250 ��</select>
<input type=submit class=input value='������' name=kup_pomests><br>";
														echo"<br><select name=del_pomests_kol><option value=1>1 ���.<option value=2>2 ���.<option value=3>3 ���.<option value=4>4 ���.<option value=5>5 ���.</select>
<input type=submit class=input value='�������' name=del_pomests>"; }
														elseif ( $stat['lvl_pomest'] <= 0 ) {
															echo "<center><input type=submit class=input value='��������� �������� - 150 ��' name=kup_pomest></center>"; }
															echo "</form>";
												}
												elseif ($set=="repair") {
													echo "<form action='' method=post>";
													if ( $stat['lvl_repair'] >= 1 ) { // ���� ���� ����������, �� ���������� ��
														echo "<select name=up_lvl_repair><option value=1>1 ��. - 50 ��<option value=2>2 ��. - 100 ��<option value=3>3 ��. - 150 ��<option value=4>4 ��. - 200 ��<option value=5>5 ��. - 250 ��</select>
<input type=submit class=input value='��������' name=up_repair><br>";
														echo"<br><select name=up_repairs_kol><option value=1>1 ���. - 50 ��<option value=2>2 ���. - 100 ��<option value=3>3 ���. - 150 ��<option value=4>4 ���. - 200 ��<option value=5>5 ���. - 250 ��</select>
<input type=submit class=input value='������' name=kup_repairs><br>";
														echo"<br><select name=del_repairs_kol><option value=1>1 ���.<option value=2>2 ���.<option value=3>3 ���.<option value=4>4 ���.<option value=5>5 ���.</select>
<input type=submit class=input value='�������' name=del_repairs>"; }
														elseif ( $stat['lvl_repair'] <= 0 ) {
															echo "<center><input type=submit class=input value='��������� ���������� - 100 ��' name=kup_repair></center>"; }
															echo "</form>";
												}
												elseif ($set=="bank") {
													echo "<form action='' method=post>";
													if ( $stat['lvl_bank'] >= 1 ) { // ���� ���� ����, �� ���������� ��
														echo "<select name=up_lvl_bank><option value=1>1 ��. - 50 ��<option value=2>2 ��. - 100 ��<option value=3>3 ��. - 150 ��<option value=4>4 ��. - 200 ��<option value=5>5 ��. - 250 ��</select>
<input type=submit class=input value='��������' name=up_bank><br>";
														echo"<br><select name=up_depozit_kol><option value=1>1 ��. - 25 ��<option value=2>2 ��. - 50 ��<option value=3>3 ��. - 75 ��<option value=4>4 ��. - 100 ��<option value=5>5 ��. - 125 ��</select>
<input type=submit class=input value='��������' name=kup_depozit>"; }
														elseif ( $stat['lvl_bank'] <= 0 ) {
															echo "<center><input type=submit class=input value='��������� ���� - 150 ��' name=kup_bank></center>"; }
															echo "</form>";
												}
												elseif ($set=="zeml") {
													echo "�������� �����������";
												}
												?></td>
											</tr>
										</table>

										</td>
										<td background='i/rama_14.gif' width='6'>&nbsp;</td>
									</tr>
									<tr>
										<td width='6' height='8'><img src='i/rama_17.gif' width='6'
											height='8' alt=''></td>
										<td width='295' height='8'><img src='i/rama_18.gif'
											width='295' height='8' alt=''></td>
										<td width='6' height='8'><img src='i/rama_19.gif' width='6'
											height='8' alt=''></td>
									</tr>

								</table>



								</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td width='100%' height='25'>
						<table border='0' width='100%' height='25' cellspacing='0'
							cellpadding='0'>
							<tr>
								<td width='51' height='25'><img src='i/inman_b231.gif'
									width='51' height='25' alt=''></td>
								<td background='i/inman_b232.gif'>&nbsp;</td>
								<td width='51' height='25'><img src='i/inman_b233.gif'
									width='51' height='25' alt=''></td>
							</tr>
						</table>

						</td>
					</tr>
				</table>
				</td>
				<td width='22' height='100%'>
				<table border='0' width='22' height='100%' cellspacing='0'
					cellpadding='0'>
					<tr>
						<td width='22' height='25'><img src='i/inman_b21.gif' width='22'
							height='25' alt=''></td>
					</tr>
					<tr>
						<td width='22' height='69'><img src='i/inman_b22.gif' width='22'
							height='69' alt=''></td>
					</tr>
					<tr>
						<td width='22' height='100%' background='i/inman_b23.gif'>&nbsp;</td>
					</tr>
					<tr>
						<td width='22' height='69'><img src='i/inman_b24.gif' width='22'
							height='69' alt=''></td>
					</tr>
					<tr>
						<td width='22' height='25'><img src='i/inman_b25.gif' width='22'
							height='25' alt=''></td>
					</tr>
				</table>


				</td>
			</tr>
		</table>



		</td>
	</tr>
</table>

</body>

<?
}
?>