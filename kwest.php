<?
$now=time();

include("inc/db_connect.php");

$stat = mysql_fetch_array(mysql_query("select * from players where user='$user' and pass='$pass'"));
mysql_query("SET CHARSET cp1251");
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat['t_time']>$now) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']>$now) { header("Location: academy.php"); exit; }
elseif ($stat['o_time']>$now) { header("Location: juvelir.php"); exit; }
elseif ($stat['r_time']>$now) { header("Location: podzem.php"); exit; }
elseif ($stat['lov_time']>$now) { header("Location: more.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat['room'] != 27) { header("Location: main.php"); exit; }
else {

	include("inc/html_header.php");

	echo"<body bgcolor=#EBEDEC leftmargin=0 topmargin=0>";

	print"<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr><td align=right valign=top>
<input class=lbut type=button value='��������' onclick='window.location.href=\"kwest.php?tmp=\"+Math.random();\"\"'>
<input class=lbut type=button value='�����' onclick='window.location.href=\"world.php?room=0&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";

	echo"
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td align=right>
<center><font class=title>��������� �����</font></center><br>";

	if ($stat[city]==1) {

		if (isset($take1)) {
			if ($stat['kwest0'] != 0) $msg="������, �� ��������� �������� ���� :)!";
			else {
				mysql_query("UPDATE players SET kwest0=1 WHERE user='".$stat['user']."'");
				$stat['kwest0']=1;
			}
		}

		if (isset($take2)) {
			if ($stat['kwest0'] != 2) $msg="������, �� ��������� �������� ���� :)!";
			else {
				mysql_query("UPDATE players SET kwest0=3, credits=credits+5 WHERE user='".$stat['user']."'");
				$stat['kwest0']=1;
				$stat['credits']=$stat['credits']+5;
			}
		}

		if (isset($take3)) {
			if ($stat['kwest0'] != 3) $msg="������, �� ��������� �������� ���� :)!";
			else {
				mysql_query("UPDATE players SET kwest0=4 WHERE user='".$stat['user']."'");
				$stat['kwest0']=4;
			}
		}

		if (isset($take4)) {
			if ($stat['kwest0'] != 5) $msg="������, �� ��������� �������� ���� :)!";
			if ($stat['credits'] < 75) $msg="� ��� ��� 75 ��, ����� ��������� ����� �2!";
			else {
				mysql_query("UPDATE players SET kwest0=6, credits=credits-75, exp=exp+200 WHERE user='".$stat['user']."'");
				$stat['kwest0']=6;
				$stat['credits']=$stat['credits']-75;
				$stat['exp']=$stat['exp']+200;
			}
		}


		if (isset($take5)) {
			if ($stat['kwest0'] != 6) $msg="������, �� ��������� �������� ���� :)!";
			else {
				mysql_query("UPDATE players SET kwest0=7 WHERE user='".$stat['user']."'");
				$stat['kwest0'] = 7;
				$ItTake = "kwest0_old_ring";
				$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));
				if ($buyitem['tip'] == 1 && $buyitem['slot2'] == "w5") $secondary=1; else $secondary=0;
				$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|0|$secondary|$buyitem[art]|0|$buyitem[iznos]";
				$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";
				mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".$stat['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");
				$msg="�� �������� <u>\"����������� ������ ����\"</u><br>";
			}
		}

		if (isset($take6)) {
			if ($stat['kwest0'] != 10) $msg="������, �� ��������� �������� ���� :)!";
			else {
				mysql_query("DELETE FROM objects WHERE tip='15' && user='".$stat['user']."'");
				mysql_query("UPDATE players SET kwest0=11 WHERE user='".$stat['user']."'");
				$stat['kwest0'] = 11;
				$ItTake = "kwest0_new_ring";
				$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));
				if ($buyitem['tip'] == 1 && $buyitem['slot2'] == "w5") $secondary=1; else $secondary=0;
				$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|0|$secondary|$buyitem[art]|0|$buyitem[iznos]";
				$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";
				mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".$stat['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");
				$msg="�� �������� <u>\"������ ����\"</u><br>";
			}
		}

		if (isset($take7)) {
			if ($stat['kwest0'] != 11) $msg="������, �� ��������� �������� ���� :)!";
			else {
				mysql_query("UPDATE players SET kwest0=12 WHERE user='".$stat['user']."'");
				$stat['kwest0']=12;
			}
		}

		if (isset($take8)) {
			if ($stat['kwest0'] != 15) $msg="������, �� ��������� �������� ���� :)!";
			else {
				mysql_query("DELETE FROM objects WHERE tip='15' && user='".$stat['user']."'");
				mysql_query("UPDATE players SET kwest0=16 WHERE user='".$stat['user']."'");
				mysql_query("UPDATE players SET credits=credits+30 WHERE user='".$stat['user']."'");
				mysql_query("UPDATE players SET o_updates=o_updates+1 WHERE user='".$stat['user']."'");
				$stat['kwest0']=16;
				$stat['credits']=$stat['credits']+30;
				$stat['o_updates']=$stat['o_updates']+1;
			}
		}

		if (isset($take9)) {
			if ($stat['kwest0'] != 16) $msg="������, �� ��������� �������� ���� :)!";
			else {
				mysql_query("UPDATE players SET kwest0=17 WHERE user='".$stat['user']."'");
				$stat['kwest0']=17;
			}
		}

		if (isset($take10)) {
			if ($stat['kwest0'] != 18) $msg="������, �� ��������� �������� ���� :)!";
			else {
				mysql_query("DELETE FROM objects WHERE tip='15' && user='".$stat['user']."'");
				mysql_query("UPDATE players SET kwest0=19 WHERE user='".$stat['user']."'");
				$stat['kwest0'] = 19;
				$ItTake = "elik_sila10_24chas";
				$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));
				if ($buyitem['tip'] == 1 && $buyitem['slot2'] == "w5") $secondary=1; else $secondary=0;
				$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|0|$secondary|$buyitem[art]|0|$buyitem[iznos]";
				$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";
				mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".$stat['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");
				$msg="�� �������� <u>\"�������\"</u><br>";
			}
		}

		if (isset($take11)) {
			if ($stat['kwest0'] != 19) $msg="������, �� ��������� �������� ���� :)!";
			else {
				mysql_query("UPDATE players SET kwest0=20 WHERE user='".$stat['user']."'");
				$stat['kwest0']=20;
			}
		}

		if (isset($take12)) {
			if ($stat['kwest0'] != 24) $msg="������, �� ��������� �������� ���� :)!";
			else {
				mysql_query("DELETE FROM objects WHERE tip='15' && user='".$stat['user']."'");
				mysql_query("UPDATE players SET kwest0=25 WHERE user='".$stat['user']."'");
				mysql_query("UPDATE players SET credits=credits+25 WHERE user='".$stat['user']."'");
				mysql_query("UPDATE players SET o_updates=o_updates+1 WHERE user='".$stat['user']."'");
				mysql_query("UPDATE players SET s_updates=s_updates+1 WHERE user='".$stat['user']."'");
				$stat['kwest0']=25;
				$stat['credits']=$stat['credits']+25;
				$stat['o_updates']=$stat['o_updates']+1;
				$stat['s_updates']=$stat['s_updates']+1;
			}
		}

		if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";


		echo"

<fieldset style='WIDTH: 98.6%'><legend>�������� �����</legend>
<table width=100% cellspacing=0 cellpadding=5>
<tr>
<td align=center>
� ���� <b>��������� ������</b> �� ������� �������� ����������/������������� ������, �������� ��������...<br><br>

<table width=100% cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1>
<tr>
<td align=center>";

		if ($stat['kwest0'] == 0) {
			echo"<input class=lbut type=button value='�������� ����� �1!' onclick='window.location.href=\"kwest.php?take1\"'>"; }
			elseif ($stat['kwest0'] == 1) {
				echo"�� �������� <b>����� �1</b>.<br>��� ��� ���������� ��� ��������� ���������, ����� ����������� �������� � ����������, �� <b>������� ������</b> � ����� ��� <b>��������� ����</b>.<br>����� ����� ������� ���� ��� ��������� ������."; }
				elseif ($stat['kwest0'] == 2) {
					echo"���������� �� ��������� <b>����� �1</b>, � ����� ����� �� �������� ����� � ������� <b>5 ��</b>.<br><input class=lbut type=button value='�������� ����� �� ����� �1' onclick='window.location.href=\"kwest.php?take2\"'>"; }
					elseif ($stat['kwest0'] == 3) {
						echo"<center><b>����� �1</b> ��������.<br><input class=lbut type=button value='�������� ����� �2' onclick='window.location.href=\"kwest.php?take3\"'>"; }
						elseif ($stat['kwest0'] == 4) {
							echo"�� �������� <b>����� �2</b>.<br>��� ��� ���������� ��� ��������� ���������, �� <b>������</b> � ����������, � ����� ��� ������, � ��� �� ������� <b>50 ��</b>, �� ��� ��������� ������ ��� ����� ����� ��������� ��� <b>25 ��</b>, � ����� ����� <b>75 ��</b>.<br>����� ����� ������ ���� ��� ��������� ������."; }
							elseif ($stat['kwest0'] == 5) {
								echo"���������� �� ��������� <b>����� �2</b>, � ����� ����� �� �������� ����� � ������� <b>200 �����</b>.<br><input class=lbut type=button value='�������� ����� �� ����� �2' onclick='window.location.href=\"kwest.php?take4\"'></center>"; }
								elseif ($stat['kwest0'] == 6) {
									echo"<b>����� �1</b> ��������.<br><b>����� �2</b> ��������.<br><input class=lbut type=button value='�������� ����� �3' onclick='window.location.href=\"kwest.php?take5\"'>"; }
									elseif ($stat['kwest0'] == 7 || $stat['kwest0'] == 8 || $stat['kwest0'] == 9) {
										echo"��� <b>\"����������� ������ ����\"</b> ��� �������� ���� ��������, ��� ���� ����� ��� ����������� � ������� ���������, ��� ���������� �������� �����������:<br> - <b>�����</b> (��������� � <b>������</b>, � ����������)<br> - <b>���</b> (��������� � <b>������ �����</b>, � ����������)<br> - <b>������� ����</b> (��������� � <b>���� ���������</b>, � ����������)<br> ����� ���� ��� �� ��� ��� ����������� �������, ���������� ����� �������� �����, ��� ���� ����� ��� ������� ��������� <b>\"������ ����\"</b>, ��� ������ � ����� ��� ������� �� ���������� <b>������ �3</b>."; }
										elseif ($stat['kwest0'] == 10) {
											echo"���������� �� ��������� <b>����� �3</b>, � ����� ����� �� �������� ����� <b>\"������ ����\"</b>.<br><input class=lbut type=button value='�������� ����� �� ����� �3' onclick='window.location.href=\"kwest.php?take6\"'>"; }
											elseif ($stat['kwest0'] == 11) {
												echo"<b>����� �1</b> ��������.<br><b>����� �2</b> ��������.<br><b>����� �3</b> ��������.<br><input class=lbut type=button value='�������� ����� �4' onclick='window.location.href=\"kwest.php?take7\"'>"; }
												elseif ($stat['kwest0'] == 12 || $stat['kwest0'] == 13 || $stat['kwest0'] == 14) {
													echo"�� �������� <b>����� �4</b>.<br>���... �� ����� ������ �� ���, ��� � ���� ��� ���� ����� �������:<br>����� <b>3 ����� ����</b>:<br><b>��������� ������</b> ��� ����� �� �������, ���� <b>�������</b>, <b>������</b> �� ����...<br>�� �������� ���������, ��������� ������, ��� �� � �� �����! � � ���� ��������...<br><b>��������� ������</b> ����� ������ � <b>������� �������</b>, <b>�������</b> � <b>���������</b>, <b>������</b> ����� ������� � <b>������ �����</b>.<br>������� ��� ��� �����, � ���� ����������� ������...<br>����� ����..."; }
													elseif ($stat['kwest0'] == 15) {
														echo"���������� �� ��������� <b>����� �4</b>, � ����� ����� �� �������� ����� <b>30 ��, + 1 � ������������</b>.<br><input class=lbut type=button value='�������� ����� �� ����� �4' onclick='window.location.href=\"kwest.php?take8\"'>"; }
														elseif ($stat['kwest0'] == 16) {
															echo"<b>����� �1</b> ��������<br><b>����� �2</b> ��������<br><b>����� �3</b> ��������<br><b>����� �4</b> ��������<br><input class=lbut type=button value='�������� ����� �5' onclick='window.location.href=\"kwest.php?take9\"'>"; }
															elseif ($stat['kwest0'] == 17) {
																echo"�� �������� <b>����� �5</b>.<br>���� �� ���� �������� ������, ����� ��� �� ��� � �����, ������� � ����� �� ������ ���� <b>������</b>, ������� �� ������� �� �����, ���� �������:<br>����� ��� <b>������ �����</b> � ������� ���..."; }
																elseif ($stat['kwest0'] == 18) {
																	echo"���������� �� ��������� <b>����� �5</b>, � ����� ����� �� �������� ����� <b>������� +10 � ���� �� 24 ����</b>.<br><input class=lbut type=button value='�������� ����� �� ����� �5' onclick='window.location.href=\"kwest.php?take10\"'>"; }
																	elseif ($stat['kwest0'] == 19) {
																		echo"<b>����� �1</b> ��������<br><b>����� �2</b> ��������<br><b>����� �3</b> ��������<br><b>����� �4</b> ��������<br><b>����� �5</b> ��������<br><input class=lbut type=button value='�������� ����� �6' onclick='window.location.href=\"kwest.php?take11\"'>"; }
																		elseif ($stat['kwest0'] == 20 || $stat['kwest0'] == 21 || $stat['kwest0'] == 22 || $stat['kwest0'] == 23) {
																			echo"�� �������� <b>����� �6</b>.<br>������ ��� ���, � ���� ����! � ������� ������ �������� <b>�������</b>, �.�. �� ������ �� ������ ����� ������� � �� ��������, � ��� �� ���� ��� � ������, ����� ��� ������, ����� ������� ��� �� ���� ����, ������ �� ����....<br><u>���� ���� �� ������ ����� ����� �������� �������, � ���� ������� ������...</u>"; }
																			elseif ($stat['kwest0'] == 24) {
																				echo"���������� �� ��������� <b>����� �6</b>, � ����� ����� �� �������� ����� <b>+1 � ��������� ���������������</b>, <b>+1 � ��������� �����������</b> � <b>+ 25 ��.</b>.<br><input class=lbut type=button value='�������� ����� �� ����� �6' onclick='window.location.href=\"kwest.php?take12\"'>"; }
																				elseif ($stat['kwest0'] == 25) {
																					echo"<b>����� �1</b> ��������<br><b>����� �2</b> ��������<br><b>����� �3</b> ��������<br><b>����� �4</b> ��������<br><b>����� �5</b> ��������<br><b>����� �6</b> ��������<br><i>����������� �������...</i>"; }

																					echo"</td>
</tr>
</table>


</td>
</tr>
</table>
</fieldset>
<BR><BR>
";
	} else {




		if (isset($take1)) {
			if ($stat['kwest1'] == 0) {
				mysql_query("UPDATE players SET kwest1=1 WHERE user='".$stat['user']."'");
				$stat['kwest1']=1;
			} else $msg="������, �� ��������� �������� ���� :)!";
		}

		if (isset($take2)) {
			$shlem = mysql_query("SELECT * FROM objects WHERE objects.user='".$stat['user']."' AND objects.inf='helmet27|��������|15|0|0|0|0|100' AND objects.tip='8'");
			if (mysql_num_rows ($shlem)) {
				$svitok = mysql_query("SELECT * FROM objects WHERE objects.user='".$stat['user']."' AND objects.tip=12 AND objects.inf='addenergy20|�������������� 20 MP|2|0|0|0|0|1'");
				if (mysql_num_rows ($svitok)) {
					if ($stat['kwest1'] == 1) {
						mysql_query("UPDATE players SET kwest1=2, credits=credits+25 WHERE user='".$stat['user']."'");
						$stat['kwest1']=2;
						$stat['credits']=$stat['credits']+25;
						mysql_query("DELETE FROM objects WHERE objects.user='".$stat['user']."' AND objects.tip=12 AND objects.min='4|0|0|0|0|3|0|0'");
						$msg="������, ����� ������� � ��� ����, �� ������� �������� �� ���� � ������ ����. �� ������ �������, �� ��� ����� �������. ���, �������� ��� 25 �� � �������� ����������� �� ���������� ������.";
					} else $msg="��� ��� �� �� ���";
				} else $msg="� ��� ��� ���� \"�������������� 20 MP\"!";
			} else $msg="� ��� ��� ���� \"��������\"!";
		}

		if (isset($take3)) {
			if ($stat['kwest1'] == 2) {
				mysql_query("UPDATE players SET kwest1=3 WHERE user='".$stat['user']."'");
				$stat['kwest1']=3;
			} else $msg="������, �� ��������� �������� ���� :)!";
		}

		if (isset($take4)) {
			if ($stat['kwest1'] == 3) {
				if ($stat['wins'] >= 1) {
					if ($stat['exp'] >= 1) {
						mysql_query("UPDATE players SET kwest1=4, s_updates=s_updates+1 WHERE user='".$stat['user']."'");
						$stat['kwest1']=4;
						$stat['s_updates']=$stat['s_updates']+1;
						$msg="��� ������� ������� ����������! � ��� ���� � ����� ������ ����������� � ���� � �������������! ����� ����, ��� ����� ������� � �� �������� �������� ���������. �� ��� � ��� ������� ����� - +1 � ��������� ���������������.";
					} else $msg="�� ��� � �� ������� ���������� ���!";
				} else $msg="�� ��� � �� ������� ���������� ���!";
			} else $msg="������, �� ��������� �������� ���� :)!";
		}

		if (isset($take5)) {
			if ($stat['kwest1'] == 4) {
				mysql_query("UPDATE players SET kwest1=5 WHERE user='".$stat['user']."'");
				$stat['kwest1']=5;
			} else $msg="������, �� ��������� �������� ���� :)!";
		}

		if (isset($take6)) {
			if ($stat['kwest1'] == 5 || $stat['kwest1'] == 6) {
				$svitok_mol = mysql_query("SELECT * FROM objects WHERE objects.user='".$stat['user']."' AND objects.inf='knife1|�����|1|0|1|0|6|10' AND objects.tip='1'");
				if (mysql_num_rows ($svitok_mol)) {
					$kamen = mysql_query("SELECT * FROM objects WHERE objects.user='".$stat['user']."' AND objects.tip=17 AND objects.min='0|0|0|0|0|0|0|0'");
					if (mysql_num_rows ($kamen)) {
						mysql_query("UPDATE players SET kwest1=7, credits=credits+20, o_updates=o_updates+1 WHERE user='".$stat['user']."'");
						$stat['kwest1']=7;
						$stat['credits']=$stat['credits']+20;
						$stat['o_updates']=$stat['o_updates']+1;
						mysql_query("DELETE FROM objects WHERE objects.user='".$stat['user']."' AND objects.tip=15 AND objects.min='0|0|0|0|3|0|0|0'");
						mysql_query("DELETE FROM objects WHERE objects.user='".$stat['user']."' AND objects.min='0|0|0|0|0|0|0|0' AND objects.tip='17'");
						$msg="��� ������� ��������� �����������, ������� ��� �� ���, ��� ���� �������: +20 ��, +1 ����� � ������������";
					} else $msg="� ��� ��� ���� \"��������� ������\"!";
				} else $msg="� ��� ��� ���� \"�����\"!";
			} else $msg="������, �� ��������� �������� ���� :)!";
		}

		if (isset($take7)) {
			if ($stat['kwest1'] == 7) {
				mysql_query("UPDATE players SET kwest1=8 WHERE user='".$stat['user']."'");
				$stat['kwest1']=8;

				$ItTake = "sol";
				$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));
				if ($buyitem['tip'] == 1 && $buyitem['slot2'] == "w5") $secondary=1; else $secondary=0;
				$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|0|$secondary|$buyitem[art]|0|$buyitem[iznos]";
				$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";
				mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".$stat['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");
				$msg="�� �������� <u>\"����\"</u>";
			} else $msg="������, �� ��������� �������� ���� :)!";
		}

		if (isset($take8)) {
			if ($stat['kwest1'] == 8 || $stat['kwest1'] == 9) {
				$uxa = mysql_query("SELECT * FROM objects WHERE objects.user='".$stat['user']."' AND objects.min='1|2|2|3|4|0|0|0' AND objects.tip='15'");
				if (mysql_num_rows ($uxa)) {
					mysql_query("UPDATE players SET kwest1=11, credits=credits+30 WHERE user='".$stat['user']."'");
					$stat['kwest1']=11;
					$stat['credits']=$stat['credits']+30;
					mysql_query("DELETE FROM objects WHERE objects.user='".$stat['user']."' AND objects.tip=15 AND objects.min='1|2|2|3|4|0|0|0' LIMIT 1");
					$msg="������� ���� ��� �������� ��� ���������. ��� ����� �������: +30 ��";
				} else {
					mysql_query("UPDATE players SET kwest1=11 WHERE user='".$stat['user']."'");
					$stat['kwest1']=11;
					$msg="�� ���� ����� ��������, �� �����! ������� �� ������� �� ��������!!!";
				}
			} else $msg="������, �� ��������� �������� ���� :)!";
		}
		if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";


		echo"
<fieldset style='WIDTH: 98.6%'><legend>�������� �����</legend>
<table width=100% cellspacing=0 cellpadding=5>
<tr>
<td align=center>
� ���� <b>��������� ������</b> �� ������� �������� ����������/������������� ������, �������� ��������...<br><br>

<table width=100% cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1>
<tr>
<td align=center>";
		if ($stat['level'] < 1 and $stat['s_updates'] >= 1) {
			echo"<table cellspacing=0 cellpadding=5 width=100%><tr><td>
<table cellspacing=2 cellpadding=2 width=100%>
<tr>
                            <td width=100%>
                                <TABLE align=left>
                                <TR>
                                        <TD align=center><SCRIPT>w2('��������','15','0','','','','','M')</SCRIPT></TD>
                                </TR>
                                <TR>
                                        <TD>&nbsp;&nbsp;<img src='http://img.carnage.ru/i/obraz/androgin.jpg' width=146 height=179>&nbsp;&nbsp;</TD>
                                </TR>
                                </TABLE>
                                <font class=td2>
                                ����������� ����,  <b> $stat[name]</b>, � ����� ������!<br><br>
���� ����� ��������, � ���� �� ��������� ������� ����� ������. ����� ������ ���� ��������� ����� ��������! ��� ����� �������� ������ ��������� �������. ������ ����� ��������� � �����, ����� ���������� � ���� ������. ����� � ���� �����, ������ ���������, � ������, �� ���������� ������ � ����� ���������  �� ����� � �����. �� ������ ���, �� ���������� � ���, � �������� ���� ����� ���������� ��������,  ������� ���������, ����� ����� ����������� ������ � ����������� ���� ��� � �����!
								<br>
������� �� �������� ����� �� ����, �� ������ ���� �������������� - ����, ��������, ����� � ������������. ��� ������ �� ��, ��� �� ������ ��������� �� ��������� ����� ����.<br><br>
<B>����</B> - ����� ������ ��������; ��� ������ ���� ����, ��� ������ ����� �� ������ ������ � ����� �������, � ��� ������� ����� ���� ����� � ���.<br><br>
<B>��������</B> - ������ �� ��, ��� ����� �� ������� ������������� �� ������ ����������, � ����� ��������� ����� �� ������ �������� �� ����..<br><br>
<B>�����</B> - ����������� ���� ������� ����������� ����, ��������� ����� ������ �����, � ����� ����������� ���� �������� ��� �� ������� ����������.<br><br>
<B>������������</B> - ���� �� ����� ������� �������������; ��� ������ ������������, ��� ��� ������ � ���� ��������� ����.<br><br>
���������, ��� ���� ���������� ������� - ��� ������������ ��������� �������� � ��������� ���� ��������������. �� �����, ���������� �������, ����� �������������� ����� ���������.<br><br>
���� ���� �� ������� ��������� �����, �� ����� ���������� ������� ������ �� ������� ������������ �������������� ����� � ���� ������. ������ 10 �������� ���������� ���������, � ����������, ��� ���� ������� � ������ �������������, ��� ������ ���� ��������� �����������������<br><br>
<b><FONT COLOR='#CC0066'>�������:</FONT></b> ���������� ��������� �������������� � ����������� �� ���.<br><br>
<I>���������: ��� ���� ����� ������������ ��������������, ����� �� ������� '+ �����������'.</I>
</font>
                                </font>
                            </td>
</tr>
</table>
</td></tr></table>"; }
			if ($stat['kwest1'] == 0) {

				echo"<input class=lbut type=button value='�������� ����� �1!' onclick='window.location.href=\"kwest.php?take1\"'>"; }
				elseif ($stat['kwest1'] == 1) {
					echo"�� �������� <b>����� �1</b>.<br>������������, ������. � ��� �������, ��� � Melin'� �� �������, ��� ��� ������ � ��� �� �����. �������, ��� ���������� ��� ������� ����� � �� ���������� ����� �������. ����� � ��� �������: ���� �������, ����� ��� ����������, ���� � �������, � ������� ����� ���������� ������ ��������, ������, ������������� ������ � ��������.
������, � ��������... ��� ���������� ������ �������, ���� �� �� ��� �� ������, ��� ��� ��������� � ����� ������ ������ ������! ��� ��� ������������� � ������� � � ������� ������� ������ <b>��������</b>. ������, ��������� � �������� ��� ���� ��� ������ <b>�������������� 20 MP</b>, � �� ��� � ���� �����������.<br>
<input class=lbut type=button value='�������� ����� �� ����� �1' onclick='window.location.href=\"kwest.php?take2\"'>"; }
					elseif ($stat['kwest1'] == 2) {
						echo"<input class=lbut type=button value='�������� ����� �2' onclick='window.location.href=\"kwest.php?take3\"'>"; }
						elseif ($stat['kwest1'] == 3) {
							echo"�� �������� <b>����� �2</b>.<br>������������! � ������, �� ����� ��� � ���������!! � ����� ������ � ���� ������� ����������� � ������ � ���������! ��� ���������! �� ��� ���������� ����� ������ ������� ����. ��� ��������� ���� � ����������. ��� ���� ����� �� �������, �� ������ ������ ��������� ���������.
������������� �� �����, ������� ��������� �� ������� �������, � ��������� ���! �� �� ������ � ���� ��� �������� � �������� ����.<br>
<input class=lbut type=button value='�������� ����� �� ����� �2' onclick='window.location.href=\"kwest.php?take4\"'>"; }
							elseif ($stat['kwest1'] == 4) {
								echo"<input class=lbut type=button value='�������� ����� �3' onclick='window.location.href=\"kwest.php?take5\"'>"; }
								elseif ($stat['kwest1'] == 5 || $stat['kwest1'] == 6) {
									echo"�� �������� <b>����� �3</b>.<br>������� ������ ����� � ���������� ����� �������� ���� ������������ �� ������� � ����� ��� ������ ������� �� ��� ������ �� ������ � �������� ����. ������ ��������� ��� �� �� ��� �� ���� � �� ��������, ��� �� ��� ��������� � ��� ������� � ��� � �������. � ���� ������ ��� ��� ���� �������� \"��������� ������\" � �� ����� ����� �� ���������� � ���������� � ����� ���! �� ����� ��� ��� ���� ���� ����� �� � ��������� � ������� ��� ���� ���� ���� �������. ��������� ��� \"�����\" ������� �� ���� ����<br>
<input class=lbut type=button value='�������� ����� �� ����� �3' onclick='window.location.href=\"kwest.php?take6\"'>"; }
									elseif ($stat['kwest1'] == 7) {
										echo"<input class=lbut type=button value='�������� ����� �4' onclick='window.location.href=\"kwest.php?take7\"'>"; }
										elseif ($stat['kwest1'] == 8 || $stat['kwest1'] == 9 || $stat['kwest1'] == 10) {
											echo"�� ������� <b>����� �4</b>.<br>����������, ������ ����! ������� � ������� ������� �� ����� �����. �� ������� ����, ����� ��� � ���������� ���� � �����. �� ��� ����� � ���� ��������� ���� � �� ������ �������� �������. � ���������, � �� ����� ����� �������, �� ����� �� ����������� ���. ��� ���� ����, ������ �� ����� ����� � ������� ��� �������� ��� ���� ���. ������ �� ������� �� - ��� ����� ������ � ���� ����.<br>
<input class=lbut type=button value='�������� ����� �� ����� �4' onclick='window.location.href=\"kwest.php?take8\"'>"; }
											elseif ($stat['kwest1'] == 11) {
												echo"��� �������� � ���� ��� ���� ��� �������!!!"; }

												echo"</td>
</tr>
</table>


</td>
</tr>
</table>
</fieldset>
<BR><BR>
";

	}
	echo"</td>
</tr>
</table>
";
}
?>