<?
include("inc/db_connect.php");
include("inc/html_header.php");
$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));
$now=time();
if ($stat[bloked]) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat['t_time']>$now) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']>$now) { header("Location: academy.php"); exit; }
elseif ($stat['o_time']>$now) { header("Location: juvelir.php"); exit; }

elseif ($stat['lov_time']>$now) { header("Location: more.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat[room]!="36") { header("Location: main.php"); exit; }
else {

	//----�������� ����� (������)----//
	$clan_name = mysql_escape_string(HtmlSpecialChars($_POST['clan_name']));
	$clan_url = mysql_escape_string(htmlspecialchars($_POST['clan_url']));
	$clan_history = HtmlSpecialChars($_POST['clan_history']);
	$clan_vxod = HtmlSpecialChars($_POST['clan_vxod']);
	$clan_law = HtmlSpecialChars($_POST['clan_law']);

	$clan_history = str_replace('\n','<br>',$clan_history);
	$clan_history = str_replace('
','<br>',$clan_history);
	$clan_vxod = str_replace('\n','<br>',$clan_vxod);
	$clan_vxod = str_replace('
','<br>',$clan_vxod);
	$clan_law = str_replace('\n','<br>',$clan_law);
	$clan_law = str_replace('
','<br>',$clan_law);

	$prov = mysql_num_rows(mysql_query("SELECT `clan_id` FROM `top` WHERE `clan` = '".$clan_name."'"));

	if ($create_clan) {
		if ($prov == 0) {
			if (!$stat['tribe']) {
				if ($stat['level']>6) {
					if (!empty($clan_name)) {
						$kol_name = strlen($clan_name);
						if ($kol_name <= 16 ) {
							if (preg_match("/^[a-z]*$/i", $clan_name)) {
								$kol_url = strlen($clan_url);
								if ($kol_url <= 160) {
									if (!empty($clan_url)) {
										if (!empty($clan_history)) {
											$kol_history = strlen($clan_history);
											if ($kol_history <= 1200) {
												if (!empty($clan_vxod)) {
													$kol_vxod = strlen($clan_vxod);
													if ($kol_vxod <= 1200) {
														if (!empty($clan_law)) {
															$kol_law = strlen($clan_law);
															if ($kol_law <= 1200) {
																if ($stat['credits'] >= 20000) {


																	mysql_query("INSERT INTO `top` (`clan_id`,`clan`,`url`,`history`,`law`,`vstup`) VALUES (NULL,'".addslashes($clan_name)."','http://".addslashes($clan_url)."','".addslashes($clan_history)."','".addslashes($clan_law)."','".addslashes($clan_vxod)."')");
																	mysql_query("UPDATE `players` SET `credits` = `credits` - '20000', `tribe` = '".addslashes($clan_name)."', `b_tribe` = '1' WHERE `user` = '".$stat['user']."'");
																	copy('i/klan/1x1.gif', 'i/klan/'.$clan_name.'.gif');

																	$msg_ok = "�� ������� ������� ���� ��� ���������: \"$clan_name\", ������� �����: \"1\", ����� �����: \"".$stat['user']."\". ��� ���� ��������: \"50000 ��.\"";

																} else $msg = "� ��� �� ������� ��, ��� �������� ����� ���������: \"20000 ��.\"";
															} else $msg = "���-�� ��������� ������ � ���� \"������\" ��������� ��������� 1200 ������.";
														} else $msg = "���� \"������\" ������.";
													} else $msg = "���-�� ��������� ������ � ���� \"��� ����������\" ��������� ��������� 1200 ������.";
												} else $msg = "���� \"��� ����������\" ������.";
											} else $msg = "���-�� ��������� ������ � ���� \"�������\" ��������� ��������� 1200 ������.";
										} else $msg = "���� \"�������\" ������.";
									} else $msg = "���� \"��������\" ������.";
								} else $msg = "���-�� ��������� ������ � ���� \"��������\" ��������� ��������� 160 ������.";
							} else $msg = "������� � ���� \"��������\" ��������� �����.";
						} else $msg = "���-�� ��������� ������ � ���� \"��������\" ��������� ��������� 16 ������.";
					} else $msg = "���� \"��������\" ������.";
				} else $msg = "��� ������� ������ ���� �� ���� 7!";
			} else $msg = "�� ��� ���������� � �����: \"".$stat['tribe']."\"";
		} else $msg = "���� � ����� ��������� ��� ����������.";
	}
	//----�������� ����� (�����)----//

	//----��������� ������� ����� (������)----//
	$res = mysql_fetch_array(mysql_query("Select * from top where clan = '".$stat['tribe']."'"));
	//----��������� �� 2-�� ������� (������)----//
	if ($up2) {
		if ($stat['tribe']) {
			if ($res['lvl'] == 1) {
				if ($stat['b_tribe'] == 1) {
					if ($stat['credits'] >= 10000) {
						if ($stat['level'] >= 7) {
							if ($res['rfs'] >= 15) {

								mysql_query("UPDATE `top` SET `rfs` = `rfs`-'15' WHERE `clan` = '".$stat['tribe']."'");
								mysql_query("UPDATE `top` SET `lvl` = '2' WHERE `clan` = '".$stat['tribe']."'");
								mysql_query("UPDATE `players` SET `credits` = `credits` - '10000' WHERE `user` = '".$stat['user']."'");

								$msg_ok = "��� ���� ������ ������� �� ������� ����, ������ ������� ������ ����� \"2\"";
							} else $msg = "������������ Clp.���������� 15 Clp";
						} else $msg = "��� ������� ���, ������ ���� �� ����� 7.";
					} else $msg = "� ��� �� ������� ��. ��� �������� �� 2 ������� ����� ��� ����� 10000 ��.";
				} else $msg = "�� �� ��������� ������ ������ �����.";
			} else $msg = "������, ������� ������ ����� ������ ���� 1.";
		} else $msg = "�� �� �������� � �����";
	}
	//----��������� �� 2-�� ������� (�����)----//

	//----��������� �� 3-�� ������� (������)----//
	if ($up3) {
		if ($stat['tribe']) {
			if ($res['lvl'] == 2) {
				if ($stat['b_tribe'] == 1) {
					if ($stat['credits'] >= 15000) {
						if ($stat['level'] >= 7) {
							if ($res['rfs'] >= 30) {
								//$item = mysql_num_rows(mysql_query("SELECT * FROM `objects` WHERE `user` = '".$stat['user']."' AND `tip` = '15' AND `min` = '0|0|0|0|0|0|0|0' AND `inf` = 'penagr|������������|0.00|0|0|0|0|1' LIMIT 1"));
								$item=true;
								if ($item) {
									mysql_query("UPDATE `top` SET `rfs` = `rfs`-'30' WHERE `clan` = '".$stat['tribe']."'");
									mysql_query("UPDATE `top` SET `lvl` = '3' WHERE `clan` = '".$stat['tribe']."'");
									mysql_query("UPDATE `players` SET `credits` = `credits` - '15000' WHERE `user` = '".$stat['user']."'");
									mysql_query("DELETE FROM `objects` WHERE `user` = '".$stat['user']."' AND `tip` = '15' AND `min` = '0|0|0|0|0|0|0|0' AND `inf` = 'pentagr|�����������|0.00|0|0|0|0|1' LIMIT 1");

									$msg_ok = "��� ���� ������ ������� �� ������� ����, ������ ������� ������ ����� \"3\"";


								} else $msg = "� ��� ��� ��������� ����.";
							} else $msg = "������������ Clp.���������� 30 Clp";
						} else $msg = "��� ������� ���, ������ ���� �� ����� 7.";
					} else $msg = "� ��� �� ������� ��. ��� �������� �� 3 ������� ����� ��� ����� 15000 ��.";
				} else $msg = "�� �� ��������� ������ ������ �����.";
			} else $msg = "������, ������� ������ ����� ������ ���� 2.";
		} else $msg = "�� �� �������� � �����";
	}
	//----��������� �� 3-�� ������� (������)----//

	//----��������� �� 4-�� ������� (������)----//
	if ($up4) {
		if ($stat['tribe']) {
			if ($res['lvl'] == 3) {
				if ($stat['b_tribe'] == 1) {
					if ($stat['credits'] >= 25000) {
						if ($stat['level'] >= 7) {
							if ($res['rfs'] >= 60) {
								//$item = mysql_num_rows(mysql_query("SELECT * FROM `objects` WHERE `user` = '".$stat['user']."' AND `tip` = '15' AND `min` = 'rog_demona|��� ������|0.00|0|0|0|0|1' AND `min` = '0|0|0|0|0|0|0|0' LIMIT 1"));
								$item=true;
								if ($item) {
									//$item2 = mysql_num_rows(mysql_query("SELECT * FROM `objects` WHERE `user` = '".$stat['user']."' AND `tip` = '15' AND `min` = 'gertv_chasha|���������� ����|0.00|0|0|0|0|1' AND `min` = '0|0|0|0|0|0|0|0' LIMIT 1"));
									$item2=true;
									if ($item2) {
										mysql_query("UPDATE `top` SET `rfs` = `rfs`-'60' WHERE `clan` = '".$stat['tribe']."'");
										mysql_query("UPDATE `top` SET `lvl` = '4' WHERE `clan` = '".$stat['tribe']."'");
										mysql_query("UPDATE `players` SET `credits` = `credits` - '25000' WHERE `user` = '".$stat['user']."'");
										mysql_query("DELETE FROM `objects` WHERE `user` = '".$stat['user']."' AND `tip` = '15' AND `min` = '0|0|0|0|0|0|0|0' AND `inf` = 'rog_demona|��� ������|0.00|0|0|0|0|1' LIMIT 1");
										mysql_query("DELETE FROM `objects` WHERE `user` = '".$stat['user']."' AND `tip` = '15' AND `min` = '0|0|0|0|0|0|0|0' AND `inf` = 'gertv_chasha|���������� ����|0.00|0|0|0|0|1' LIMIT 1");

										$msg_ok = "��� ���� ������ ������� �� ������� ����, ������ ������� ������ ����� \"4\"";
										 
									} else $msg = "��� ��������� ���� �2";
								} else $msg = "��� ��������� ���� �1";

							} else $msg = "������������ Clp.���������� 60 Clp";
						} else $msg = "��� ������� ���, ������ ���� �� ����� 7.";
					} else $msg = "� ��� �� ������� ��. ��� �������� �� 4 ������� ����� ��� ����� 25000 ��.";
				} else $msg = "�� �� ��������� ������ ������ �����.";
			} else $msg = "������, ������� ������ ����� ������ ���� 3.";
		} else $msg = "�� �� �������� � �����";
	}
	//----��������� �� 4-�� ������� (������)----//

	//----��������� �� 5-�� ������� (������)----//
	if ($up5) {
		if ($stat['tribe']) {
			if ($res['lvl'] == 4) {
				if ($stat['b_tribe'] == 1) {
					if ($stat['credits'] >= 50000) {
						if ($stat['level'] >= 8) {
							if ($res['rfs'] >= 120) {
								//$item = mysql_num_rows(mysql_query("SELECT * FROM `objects` WHERE `user` = '".$stat['user']."' AND `tip` = '15' AND `inf` = 'kniga_mertvix|����� �������|0.00|0|0|0|0|1' AND `min` = '0|0|0|0|0|0|0|0' LIMIT 1"));
								$item=true;
								if ($item) {
									//$item2 = mysql_num_rows(mysql_query("SELECT * FROM `objects` WHERE `user` = '".$stat['user']."' AND `tip` = '15' AND `inf` = 'amulet_vizova|������ ������|0.00|0|0|0|0|1' AND `min` = '0|0|0|0|0|0|0|0' LIMIT 1"));
									$item2=true;
									if ($item2) {

										$item3=true;	//$item3 = mysql_num_rows(mysql_query("SELECT * FROM `objects` WHERE `user` = '".$stat['user']."' AND `tip` = '15' AND `inf` = 'korona_lenga|������ �����|0.00|0|0|0|0|1' AND `min` = '0|0|0|0|0|0|0|0' LIMIT 1"));
										if ($item3) {

											mysql_query("UPDATE `top` SET `lvl` = '5' WHERE `clan` = '".$stat['tribe']."'");
											mysql_query("UPDATE `players` SET `credits` = `credits` - '50000' WHERE `user` = '".$stat['user']."'");
											mysql_query("DELETE FROM `objects` WHERE `user` = '".$stat['user']."' AND `tip` = '15' AND `min` = '0|0|0|0|0|0|0|0' AND `inf` = 'kniga_mertvix|����� �������|0.00|0|0|0|0|1' LIMIT 1");
											mysql_query("DELETE FROM `objects` WHERE `user` = '".$stat['user']."' AND `tip` = '15' AND `min` = '0|0|0|0|0|0|0|0' AND `inf` = 'amulet_vizova|������ ������|0.00|0|0|0|0|1' LIMIT 1");
											mysql_query("DELETE FROM `objects` WHERE `user` = '".$stat['user']."' AND `tip` = '15' AND `min` = '0|0|0|0|0|0|0|0' AND `inf` = 'korona_lenga|������ �����|0.00|0|0|0|0|1' LIMIT 1");

											$msg_ok = "��� ���� ������ ������� �� ������� ����, ������ ������� ������ ����� \"5\"";


										} else $msg = "��� ��������� ���� �3";
									} else $msg = "��� ��������� ���� �2";
								} else $msg = "��� ��������� ���� �1";

							} else $msg = "������������ Clp.���������� 120 Clp";
						} else $msg = "��� ������� ���, ������ ���� �� ����� 8.";
					} else $msg = "� ��� �� ������� ��. ��� �������� �� 5 ������� ����� ��� ����� 50000 ��.";
				} else $msg = "�� �� ��������� ������ ������ �����.";
			} else $msg = "������, ������� ������ ����� ������ ���� 4.";
		} else $msg = "�� �� �������� � �����";
	}
	//----��������� �� 5-�� ������� (������)----//

	//----��������� ������� ����� (�����)----//

	//----������� �������� ����� (������)----//
	if (isset($_FILES["upfile"]))
	{
		$dir = './i/klan/';

		$upfile= $_FILES["upfile"]["tmp_name"];
		$upfile_name= $_FILES["upfile"]["name"];
		$upfile_size= $_FILES["upfile"]["size"];
		$upfile_type= $_FILES["upfile"]["type"];
		$upfile_code= $_FILES["upfile"]["error"];
		list($width, $height, $type, $attr) = getimagesize($upfile);
$mm=getimagesize($upfile);
		$res = mysql_fetch_array(mysql_query("Select * from top where clan = '".$stat['tribe']."'"));
		if ($res['lvl'] >= 2) {
			if ($upfile_size <= 5000) {
				if ($error_code == 0) {
					if ($mm['mime'] == 'image/gif') {
						if ($width == 16 && $height == 16) {

						$blacklist = array(".php", ".phtml", ".php3", ".php4");
 foreach ($blacklist as $item) {
  if(preg_match("/$item\$/i", $_FILES['upfile']['name'])) {
   echo "We do not allow uploading PHP files\n";
   exit;
   }
  }						$dir = './i/klan/';
							$name2 = $stat['tribe'];

							$upfile_name = $dir . $name2;

							copy("".$upfile."","".$upfile_name.".gif");

							$msg_ok = "��� ������ ������ ��� �������.";

						} else $msg = "������� �������� ������ ���� 16�16.";
					} else $msg = "���������� ����� ������ ���� .gif";
				}
			} else $msg = "������ ����� ������ ���� �� ����� 5 ��.";
		} else $msg = "���� ������� ����� �� ��������� ������������ ������ ������.";
	}
	//----������� �������� ����� (������)----//

	//----�������� ���� (������)----//
	if ($bank) {
		$kool_zm = str_replace(',', '.', $kol_zm);
		$comments = HtmlSpecialChars($comments);
		$res = mysql_fetch_array(mysql_query("Select * from top where clan = '".$stat['tribe']."'"));
		if ($stat['tribe']) {
			if ($stat['credits'] >= $kool_zm) {
				if ($res[lvl] >= 3) {
					if ($kool_zm) {
						if ($comments) {
							mysql_query("INSERT INTO `clan_money` (`user`,`money`,`comments`,`clan`,`go`,`time`) VALUES ('".$stat['user']."','$kool_zm','".addslashes($comments)."','".$stat['tribe']."','1','$now')");

							mysql_query("UPDATE `top` SET `money` = `money` + '$kool_zm' WHERE `clan` = '".$stat['tribe']."'");
							mysql_query("UPDATE `players` SET `credits` = `credits` - '$kool_zm' WHERE `user` = '".$stat['user']."'");
							$stat['credits']=$stat['credits']-$kool_zm;
							$res['money']=$res['money']+$kool_zm;
							$msg_ok = "�� ������ ������� � ���� �����: \"$kool_zm\" ��.";

						} else $msg = "������� ����������� � ��������.";
					} else $msg = "������� �����";
				} else $msg = "���� ������� ����� �� ��������� ������������ �������� ������.";
			} else $msg = "� ��� ��� ����� �����.";
		} else $msg = "�� �� �������� �� � ����� �����.";
	}
	//----�������� ���� (�����)----//
	//----�������� ���� (������)----//
	if ($bank2) {
		$kool_zm = str_replace(',', '.', $kol_zm);
		$comments = HtmlSpecialChars($comments);
		$res = mysql_fetch_array(mysql_query("Select * from top where clan = '".$stat['tribe']."'"));
		if ($stat['tribe']) {
			if ($stat['b_tribe']) {
				if ($res['money'] >= $kool_zm) {
					if ($res[lvl] >= 3) {
						if ($kool_zm) {
							if ($comments) {

								mysql_query("INSERT INTO `clan_money` (`user`,`money`,`comments`,`clan`,`go`,`time`) VALUES ('".$stat['user']."','$kool_zm','".addslashes($comments)."','".$stat['tribe']."','2','$now')");
								$dengimin=$res['money']-$kool_zm;
								mysql_query("UPDATE `top` SET `money` = '".$dengimin."' WHERE `clan` = '".$stat['tribe']."'");
								mysql_query("UPDATE `players` SET `credits` = `credits` + '$kool_zm' WHERE `user` = '".$stat['user']."'");
								$stat['credits']=$stat['credits']+$kool_zm;
								$res['money']=$res['money']-$kool_zm;
								$msg_ok = "�� ������ ������� �� ����� �����: \"$kool_zm\" ��.";

							} else $msg = "������� ����������� � ��������.";
						} else $msg = "������� �����";
					} else $msg = "���� ������� ����� �� ��������� ������������ �������� ������.";
				} else $msg = "� ����� �������� ����� ��� ����� �����.";
			} else $msg = "�� �� ��������� ������ ������ �����.";
		} else $msg = "�� �� �������� �� � ����� �����.";
	}
	//----�������� ���� (�����)----//

	//----���� ������ �� ������ (������)----//

	if ($add_abil) {
		$dat_abil = HtmlSpecialChars($dat_abil);
		$user_abil = mysql_fetch_array(mysql_query("select * from players where user='$dat_abil'"));
		if ($stat['tribe']) {
			if ($stat['b_tribe']) {
				if ($res['lvl'] >= 5) {
					if ($user_abil['tribe_a'] == 1) {
						if ($user_abil['user']) {
							if ($user_abil['tribe'] == $stat['tribe']) {

								mysql_query("UPDATE `players` SET `tribe_a` = '1' WHERE `user` = '".$dat_abil."'");
								$msg_ok = "����� �� ������������� ������� ����� �������� ��������� $dat_abil";

							} else $msg = "�������� $dat_abil �� ������� � ����� �����.";
						} else $msg = "�������� $dat_abil �� ����������.";
					} else $msg = "��������� $dat_abil � ��� �������� ������� �����.";
				} else $msg = "���� ������� ����� �� ��������� ������������ ���� ��������.";
			} else $msg = "�� �� ����� �����.";
		} else $msg = "�� �� �������� � �����.";
	}
	//----���� ������ �� ������ (�����)----//


	//----������ ������ (������)----//
	if ($buyabil) {

		if ($stat['tribe']) {
			if ($stat['b_tribe']) {
				if ($res['lvl'] >= 4) {
					if ($res['rfs'] > 0) {
						if ($buyabil=='addhp100' || $buyabil=='attack' || $buyabil=='addhp300') {
							$check_abil=mysql_fetch_array(mysql_query("select * from abils where `tribe`='".$stat['tribe']."' and `name`='$buyabil'"));
							$check_id=$check_abil['id'];
							 
							if(empty($check_id)){ mysql_query("insert into `abils` (`name`,`tribe`,`c_iznos`,`m_iznos`) values('".addslashes($buyabil)."','".$stat['tribe']."','200','200')");$msg = "�� ������ ������ ������.";}
							else{
								mysql_query("UPDATE top set rfs=rfs-1 where `clan` = '".$stat['tribe']."'");
								mysql_query("UPDATE abils set c_iznos=c_iznos-3 where name='".$buyabil."'");
								$msg = "�� ������ ������ ������.";}
						}
					} else $msg = "������������ Clp.";
				} else $msg = "���� ������� ����� �� ��������� ������������ ���� ��������.";
			} else $msg = "�� �� ����� �����.";
		} else $msg = "�� �� �������� � �����.";
	}


	//----������ ������ (�����)----//







	//----��������� ����� (������)----//
	if ($edit_clan) {
		$history = HtmlSpecialChars($_POST['history']);
		$vxod = HtmlSpecialChars($_POST['vxod']);
		$clan_url = mysql_escape_string(htmlspecialchars($_POST['clan_url']));
		$law = HtmlSpecialChars($_POST['law']);
		$history = str_replace('\n','<br>',$history);
		$history = str_replace('
','<br>',$history);
		$vxod = str_replace('\n','<br>',$vxod);
		$vxod = str_replace('
','<br>',$vxod);
		$law = str_replace('\n','<br>',$law);
		$law = str_replace('
','<br>',$law);
		if ($stat['tribe']) {
			if ($stat['b_tribe']) {
				$vxodd = strlen($vxod);
				if ($vxodd <= 1200) {
					$laww = strlen($law);
					if ($laww <= 1200) {
						$historyy = strlen($history);
						if ($historyy <= 1200) {
							$kol_url = strlen($clan_url);
							if ($kol_url <= 160) {
								if (!empty($clan_url)) {

									mysql_query("UPDATE `top` SET `law` = '".addslashes($law)."',`url` = '".addslashes($clan_url)."', `history` = '".addslashes($history)."', `vstup` = '".addslashes($vxod)."' WHERE `clan` = '".$stat['tribe']."'");
									$msg_ok = "������ ����� ������� ��������.";

								} else $msg = "���� \"��������\" ������.";
							} else $msg = "���-�� ��������� ������ � ���� \"��������\" ��������� ��������� 160 ������.";
						} else $msg = "���� ������� ��������� ����� (1200 ������).";
					} else $msg = "���� ������ ��������� ����� (1200 ������).";
				} else $msg = "���� ��� ���������� ��������� ����� (1200 ������).";
			} else $msg = "�� �� ����� �����";
		} else $msg = "�� �� �������� � �����.";
	}
	//----��������� ����� (�����)----//



	function show ($id) {
		global $stat;

		switch ($id) {
			case 1:

				if (!$stat['tribe']) {
					echo "<form method='post'>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr><td align='center' colspan='3'><b>�������� �����</b></td></tr>
<tr><td align='center'>��������:</td><td><INPUT size='16' class='input' name='clan_name'></td><td align='center'><small>�������� ������ �� ���������, �� ����� 16 ������</small></td></tr>
<tr><td align='center'>��������:</td><td>http://<INPUT size='16' class='input' name='clan_url'></td><td align='center'><small>�������� ������ �� ���������, �� ����� 16 ������</small></td></tr>
<tr><td align='center' valign='top'>�������:</td><td><textarea name='clan_history' rows='5' cols='50'></textarea></td><td valign='top' align='center'><small>�� ����� 1200 ������</small></td></tr>
<tr><td align='center' valign='top'>��� ����������:</td><td><textarea name='clan_vxod' rows='5' cols='50'></textarea></td><td valign='top' align='center'><small>�� ����� 1200 ������</small></td></tr>
<tr><td align='center' valign='top'>������:</td><td><textarea name='clan_law' rows='5' cols='50'></textarea></td><td valign='top' align='center'><small>�� ����� 1200 ������</small></td></tr>
<tr><td></td><td align='center'><input type='submit' name='create_clan' value='������� ����' class='input'></td><td></td></tr>
</table>
</div>
</form>";
				} else echo "<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr><td align='center'><b>�������� �����</b></td></tr>
<tr><td align='center'>
������ ������.<br>
�� ��� �������� � �����.
</td>
</tr>
</table>
</div>
";

				break;
			case 2:
				$res = mysql_fetch_array(mysql_query("Select * from top where clan = '".$stat['tribe']."'"));
				if ($stat['tribe']) {
					if ($stat['b_tribe']) {
						echo "<form method='post'>";
						echo "<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr><td align='center' colspan='6'><b>����������</b></td></tr>
<tr><td align='center'>�������</td><td align='center'>���� ������</td><td align='center'>��</td><td align='center'>����� ����</td><td align='center'>�������</td><td align='center'>��������</td></tr>";
						if ($res['lvl'] == 1) {
							echo "
<tr><td align='center'>7 ���</td><td align='center'>15 Clp</td><td align='center'>10000 ��.</td><td align='center'>���</td><td align='center'>1</td><td align='center'><input type='submit' name='up2' value='������� �� 2' class='input'></td></tr>
";
						} elseif ($res['lvl'] == 2) {
							echo "
<tr><td align='center'>7 ���</td><td align='center'>30 Clp</td><td align='center'>15000 ��.</td><td align='center'>�����������</td><td align='center'>2</td><td align='center'><input type='submit' name='up3' value='������� �� 3' class='input'></td></tr>
";
						} elseif ($res['lvl'] == 3) {
							echo "
<tr><td align='center'>7 ���</td><td align='center'>60 Clp</td><td align='center'>25000 ��.</td><td align='center'>��� ������, ���������� ����</td><td align='center'>3</td><td align='center'><input type='submit' name='up4' value='������� �� 4' class='input'></td></tr>
";
						} elseif ($res['lvl'] == 4) {
							echo "
<tr><td align='center'>8 ���</td><td align='center'>120 Clp</td><td align='center'>50000 ��.</td><td align='center'>����� �������, ������ ������, ������ �����</td><td align='center'>4</td><td align='center'><input type='submit' name='up5' value='������� �� 5' class='input'></td></tr>
";
						} elseif ($res['lvl'] == 5) {
							echo "
<tr><td align='center' colspan='5'>������� ������ ����� �������� ���������.</td></tr>
";
						}
						echo "
</table>
</div>
</form>";
					} else echo "�� �������� � �����, �� �� �� ����� �����.";
				} else echo "�� �� �������� � �����.";

				break;
			case 3:

				$res = mysql_fetch_array(mysql_query("Select * from top where clan = '".$stat['tribe']."'"));
				if ($stat['tribe']) {
					if ($res['lvl'] >= 2) {
						echo "<form enctype='multipart/form-data' method='post'>";
						echo "<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr><td align='center'><b>������� �������� �����</b></td></tr>
<tr><td><br>
�������� �������� ��� ������ �����: <input name='upfile' type='file' class='input'><input type='submit' value='���������' class='input'><br>

<small>��������� ��������:<br>
����������: <b>.gif</b><br>
������: <b>16x16</b><br>
������ � ������: <b>3 ��</b></small>
</td></tr>
</table>
</div></form>"; }
						else echo "<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr><td align='center'><b>������� �������� �����</b></td></tr>
<tr><td align='center'>
������ ������.<br>
������� ������ ����� ������ ���� �� ����� 2.
</td></tr>
</table>
</div>
";

						if ($res['lvl'] >= 3) {
							$s1=""; $s2=""; $s3="";
							print "

<form method='post' action=''>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr><td align='center'><b>������� ������� �����</b></td></tr>
<tr><td>
���������� ������ ��� ����� �� Clp: <select name='buyabil' class=input>
<option value='addhp100' $buyabil>+100��</option>
<option value='attack' $buyabil>���������</option>
<option value='addhp300' $buyabil>+300��</option>
</select><input type='submit' value='�������' class=input></form>
<small>Clp - Clan points - ������ ����� �� ����������� � ���� ����������, � ������� 1Clp �� 1 ������ ��� �� ������ ��������.��������� ����� � ���� �����,����� ��������� ������ ��� �������������� � ���� ��������.1 Clp = 3 ������.<br>����� ���� �������� ������ ������ �� ��������� ������ ����� � ����</small>
</td></tr>
</table>
</div>
</form>";

						} else echo "<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr><td align='center'><b>������� ������� �����</b></td></tr>
<tr><td align='center'>
������ ������.<br>
������� ������ ����� ������ ���� �� ����� 3.
</td></tr>
</table>
</div>
";




						if ($res['lvl'] >= 4) {
							echo "<form method='post'>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr><td align='center'><b>������ �� ������� �����</b></td></tr>
<tr><td>
���� ������ �� ������� ����� ���������: <input type='text' name='dat_abil' class='input'> <input type ='submit' name='add_abil' value='���� ������' class='input'><br>
<small>���� ��������� �� ����� ������� ���� ��������� ������ � ������������� ��������/������� �����, ��������� ���������� ����������.</small>
</td></tr>
</table>
</div>
</form>"; 
						}



						else echo "<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr><td align='center'><b>������ �� ������� �����</b></td></tr>
<tr><td align='center'>
������ ������.<br>
������� ������ ����� ������ ���� �� ����� 4.
</td></tr>
</table>
</div>
";
				} else echo "�� �� �������� � �����.";

				break;
			case 4:
				if ($stat['tribe']) {
					$res = mysql_fetch_array(mysql_query("Select * from top where clan = '".$stat['tribe']."'"));



					if ($stat['tribe'] && $res['lvl'] >= 3) {
						echo "<form method='post'>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center' colspan='2'><b>�������� ����</b></td></tr>
<tr><td>� ����� �����:</td><td><b>".$res['money']."</b> ��.</td></tr>
<tr><td>���-�� ��:</td><td><input type='text' name='kol_zm' class='input'></td></tr>
<tr><td>�����������:</td><td><input type='text' name='comments' class='input' maxlength='100'></td></tr>
<tr><td>��������:</td><td><input type='submit' name='bank' value='�������' class='input'>"; 

						if ($stat['tribe'] && $stat['b_tribe'] && $res['lvl'] >= 3) {
							echo " <input type='submit' name='bank2' value='�������' class='input'>";
						}
						echo "</td></tr>
</table>
</div>
</form>";
					}
					else echo "<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr><td align='center'><b>�������� ����</b></td></tr>
<tr><td align='center'>
������ ������.<br>
������� ������ ����� ������ ���� �� ����� 3.
</td></tr>
</table>
</div>
";
					if ($stat['tribe'] && $stat['b_tribe'] && $res['lvl'] >= 3) {
						echo "<center><iframe src='clan_holl_otchet.php?set=otchet' width=98% height=150 frameborder=1></iframe></center>";
					}
				} else echo "�� �� �������� � �����.";
				break;
			case 5:
				if ($stat['tribe']) {
					$res = mysql_fetch_array(mysql_query("Select * from top where clan = '".$stat['tribe']."'"));
					$res['law'] = str_replace('<br>','
',$res['law']);
					$res['clan_url'] = str_replace('<br>','
',$res['url']);
					$res['rfs'] = str_replace('<br>','
',$res['rfs']);
					$res['history'] = str_replace('<br>','
',$res['history']);
					$res['vstup'] = str_replace('<br>','
',$res['vstup']);
					$r_id=$res['clan_id'];
					$rc=(string)'<b>http://langels.ru/rc.php?'.$r_id.'<b>';
					echo "<form method='post'>
<div align='center'>
<table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr><td align='center' colspan='3'><b>��������� �����</b></td></tr>
<tr><td align='center' valign='top'>���. ������ �����:</td><td align='center'>".addslashes($rc)."</td><td align='center' valign='top'><small>�� ������� ����������� �� ���� ������ ���� �������� 1 Clp</small></td></tr>
<tr><td align='center' valign='top'>Clp(����-������):</td><td align='center'>".addslashes($res['rfs'])."</td><td align='center' valign='top'><small>Clp ���������� ��� �������� �� ������� ������ �����</small></td></tr>

<tr><td align='center' valign='top'>��������:</td><td align='center'><INPUT size='16' class='input' name='clan_url' value=".addslashes($res['url'])."></td><td align='center' valign='top'><small>�� ����� 1200 ������</small></td></tr>


<tr><td align='center' valign='top'>�������:</td><td align='center'><textarea name='history' rows='5' cols='50'>".addslashes($res['history'])."</textarea></td><td align='center' valign='top'><small>�� ����� 1200 ������</small></td></tr>
<tr><td align='center' valign='top'>������:</td><td align='center'><textarea name='law' rows='5' cols='50'>".addslashes($res['law'])."</textarea></td><td align='center' valign='top'><small>�� ����� 1200 ������</small></td></tr>
<tr><td align='center' valign='top'>����������:</td><td align='center'><textarea name='vxod' rows='5' cols='50'>".addslashes($res['vstup'])."</textarea></td><td align='center' valign='top'><small>�� ����� 1200 ������</small></td></tr>
<tr><td></td><td align='center'><input type='submit' name='edit_clan' value='��������' class='input'></td><td></td></tr>
</table>
</div>
</form>";
				} else echo "�� �� �������� � �����.";
				break;


		}
	}
	echo"
<body background='/i/bg.gif' leftmargin=0 topmargin=0>
<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
        <td><b>� ��� �� �����:</b> <u>".$stat[credits]."</u> <b>��.</b>
        </td>
<td align=right valign=top>
<input class=input type=button value='��������' onclick='window.location.href=\"clan_holl.php?otdel=".$otdel."&tmp=\"+Math.random();\"\"'>
<input class=input type=button value='���������' onclick='window.location.href=\"world.php?room=0&tmp=\"+Math.random();\"\"'>
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
<tr>
                <td width='100%' valign='top'>";


	echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
    <tr>";

	echo "<td align=center width=20%><A"; if ($otdel == 1 || $stat['tribe']) echo" disabled><b>"; else echo" HREF='clan_holl.php?otdel=1'>"; echo"��������</b></A></td>";
	echo "<td align=center width=20%><A"; if ($otdel == 2) echo" disabled><b>"; else echo" HREF='clan_holl.php?otdel=2'>"; echo"�������</b></A></td>";
	echo "<td align=center width=20%><A"; if ($otdel == 3) echo" disabled><b>"; else echo" HREF='clan_holl.php?otdel=3'>"; echo"����������</b></A></td>";
	echo "<td align=center width=20%><A"; if ($otdel == 5) echo" disabled><b>"; else echo" HREF='clan_holl.php?otdel=5'>"; echo"���������</b></A></td>";
	echo "<td align=center width=20%><A"; if ($otdel == 4) echo" disabled><b>"; else echo" HREF='clan_holl.php?otdel=4'>"; echo"����</b></A></td>";


	echo "</tr>
  </table>
</div>";

	if (!empty($msg)) echo"<br><center><FONT COLOR=RED><b>$msg</b></font></center>";
	if (!empty($msg_ok)) echo"<br><center><FONT COLOR=green><b>$msg_ok</b></font></center>";

	if (!empty($_GET['otdel'])) {


		switch ($_GET['otdel']) {
			case 1: show(1); break;
			case 2: show(2); break;
			case 3: show(3); break;
			case 4: show(4); break;
			case 5: show(5); break;
			default: echo"<B STYLE='COLOR: Red'>����� ��� �� ��� :)</B>"; break;
		}

	} else echo "<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
    <tr><td align='left'><u><b>����������</b></u><br>
����� ������� ����, ��� ���������� ������� 10 000 ��, ����� �������� ����� �� ������ ��������� ��� �������, ������ ������� ���� ���� ����������, ������ ��� ����� �� ������� ��������� ������ �����, ����� ��� ���� ����� ����� 2 �������
</td>
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
</table>";

}
?>