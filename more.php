<?
include("inc/db_connect.php");
include("inc/html_header.php");
$now=time();
$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));

if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat['t_time']>$now) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']>$now) { header("Location: academy.php"); exit; }
elseif ($stat['o_time']>$now) { header("Location: juvelir.php"); exit; }
elseif ($stat[r_time]>$now) { header("Location: podzem.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat['room']<=701 && $stat['room']>=745) { header("Location: main.php"); exit; }
else {

	mysql_query("UPDATE players SET lpv=$now WHERE user='".$stat['user']."'");
	include("inc/main/changed.php");



	//������ ������
	$widthhp=$stat['hp_now']/$stat['hp_max']*172;
	if ($widthhp==0) $widthhp+=2;
	if ($widthhp==1) $widthhp+=1;
	if ($widthhp>1) $widthhp-=1;

	//������ ���������
	$ustal=$stat['ustal_now'];
	$ustal_max = $stat['vitality']*5+$stat['ustal'];

	$widthustal=$ustal/$ustal_max*172;
	if ($widthustal=="0") $widthustal=$widthustal+2;
	if ($widthustal=="1") $widthustal=$widthustal+1;
	if ($widthustal>"1") $widthustal=$widthustal-1;
	//����� ��������

	//������� ��������� �� ��� ��������� � ���������
	$minus_hp = $stat[hp_now]*50/100;
	//������� �����������
if($stat['lov_time']<$now) {

	$bots_num=mysql_query("select * from players where room='".$stat['room']."' and rank='60'");

	while($bots=mysql_fetch_array($bots_num)){

		$chance=5;$i=0;
		$side1_hp=mysql_fetch_array(mysql_query("select sum(hp) as hp from participants where time='".$bots['battle']."' and side='1'"));
		$side2_hp=mysql_fetch_array(mysql_query("select sum(hp) as hp from participants where time='".$bots['battle']."' and side='2'"));
		$last_comment_time=mysql_fetch_array(mysql_query("select time from battles where offer='".$bots['battle']."'"));
		if(empty($side1_hp['hp']) or empty($side2_hp['hp']) or ($last_comment_time['time']-$bots['battle'])>=180){$boy_end=1;}

		if(rand(1, 100)<=$chance && $boy_end=='1'){
			$stat = mysql_fetch_array(mysql_query("SELECT * FROM `players` WHERE id='".$stat['id']."'"));
			$i++;

			$_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp`, SUM(objects.`vitality`) as `vitality` FROM slots, objects WHERE slots.id='".$bots['id']."' AND objects.user='".$bots['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));
			$MySkills = explode("|",$bots['rase_skill']);
			$chl['gnom']=$MySkills['3']*5;
			$bots['vitality']=$bots['vitality']+$_obj['vitality'];
			$bots['hp_max']=ceil(($bots['vitality']*5)*(1+($bots['gnom']/100))+$_obj['hp']);
			$bots['hp_now']=$bots['hp_max'];

			mysql_query("update players set hp_now='".$bots['hp_max']."', `battle` = NULL where id='".$bots['id']."'");

			if($i>1 or !empty($stat['battle']) && $stat['lov_time']<$now){
				//vmesh
				if ($bots[next_exp]!=0)
				$levels=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level='".$bots['level']."' AND exp<=$bots[next_exp] ORDER BY exp DESC"));
				else
				$levels=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level='".$bots['level']."'AND exp<=$bots[exp] ORDER BY exp DESC"));
				$prt=mysql_fetch_array(mysql_query("SELECT side AS side, x, y, time AS time FROM participants WHERE time='".$stat['battle']."' AND id='".$stat['id']."'"));

				switch ($prt['side']) {
					case 0: $side=1; break;
					case 1: $side=0; break;
				}
				$query=mysql_query("select x, y from participants where time='".$prt['time']."' and side='$side' order by `y` desc limit 1");
				$randes=mysql_fetch_array($query);

				$y=$randes['y']+1;



				mysql_query("UPDATE players, offers SET players.battle='".$prt['time']."', players.bside='".$side."', offers.type='2', offers.timeout='180', offers.zone_height=offers.zone_height+1 WHERE players.id='".$stat['id']."' && offers.time='".$prt['time']."'");
				mysql_query("INSERT INTO participants (`time`, `id`, `side`, `base`,`hp`,x,y, frozen) values('".$prt['time']."', '".$bots['id']."', '".$side."', '".$levels['base']."', '".$bots['hp_now']."','1', '$y', '0')");

				$b_id_id=mysql_fetch_array(mysql_query("SELECT MAX(id) as id FROM battles WHERE offer='".$prt['time']."'"));
				$b_id_id['id']+=1;

				mysql_query("INSERT INTO battles (offer, time, id, type, comment1) values ('".$prt['time']."', '".$now."', '".($b_id_id['id']-1)."', '2', '<b>".$bots['user']."</b> [".$bots['level']."] �������� � ��������!')");
				$bat=1;
			}
			else{//napadaem
				//$time=time();
				if ($stat[next_exp]!=0)
				$chl_base=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level=".$bots['level']." AND exp<=$stat[next_exp] ORDER BY exp DESC"));
				else
				$chl_base=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level='".$bots['level']."'AND exp<=$stat[exp] ORDER BY exp DESC"));
				$bdate=date("d.m.y H:i",$time);


				while (mysql_fetch_array(mysql_query("SELECT * FROM offers WHERE time='".$time."'")))
				$time++;
				$prt2=mysql_num_rows(mysql_query("select id FROM participants WHERE time='".$stat['battle']."'"));
				mysql_query("INSERT INTO offers (time, type, size_left, size_right, done, timeout, zone_width, zone_height, city) values(".$time.",1,1,'1','1','180', 6, '".($prt2/2+3)."', 1)");


				mysql_query("INSERT INTO participants (`time`,`id`,`side`,`base`,`hp`, x, y, frozen) VALUES ('".$time."','".$bots['id']."','0','".$levels['base']."','".$bots['hp_now']."' ,'".($prt['x']+1)."', '".($prt['y']+1)."', '0')");

				mysql_query("INSERT INTO participants (`time`,`id`,`side`,`base`,`hp`, x, y, frozen) VALUES ('".$time."','".$stat['id']."','1','".$chl_base['base']."','".$stat['hp_now']."','".($prt['x']+4)."', '".($prt['y']+1)."', '0')");

				mysql_query("INSERT INTO battles (offer, time, id, type, damage, comment1) values (".$time.", ".$time.", '1', 2, '', '<i>���� ���������� <u>".$bdate."</u> ����� ��� �������!')");

				mysql_query("UPDATE players SET battle='".$time."', bside='0' WHERE id='".$bots['id']."'");
				mysql_query("UPDATE players SET battle='".$time."', bside='1' WHERE id='".$stat['id']."'");


				require_once("inc/chat/functions.php");
				insert_msg("���������� <b><u>".$bots['user']."</u></b> �������� � ������ � ����� �� ���!","","","1",$stat['user'],"",$stat['room']);


				$bat=1;
			}

		}

	}
}
	if(!empty($bat)){echo"<script>parent.main.location=\"battle.php?tmp=\"+Math.random();\"\"</script>";}
	$bat=0;
	//�������� � ���������
	if ($stat['room'] == 719) {
		mysql_query("UPDATE players SET room=721, hp_now=hp_now-$minus_hp WHERE user='".$stat['user']."'");
		echo"<SCRIPT LANGUAGE='JavaScript'>
<!--
alert('���������� ���������� ����� ������� ���� ����� � ������� ��������� ����������. �� �������� ��������� � �������, �� ��������� ��������� ������� ��� ���������� �� ���� ������... ����� �� ��������, �� ������, ��� ��� ���� � ���������� � ���������� ����������� �����.');
//-->
</SCRIPT>";
		echo"<SCRIPT LANGUAGE=\"JavaScript\">top.frames['main'].location = \"more.php\";</SCRIPT>";
	} elseif ($stat['room'] == 724) {
		mysql_query("UPDATE players SET room=704, hp_now=hp_now-$minus_hp WHERE user='".$stat['user']."'");
		echo"<SCRIPT LANGUAGE='JavaScript'>
<!--
alert('���������� ���������� ����� ������� ���� ����� � ������� ��������� ����������. �� �������� ��������� � �������, �� ��������� ��������� ������� ��� ���������� �� ���� ������... ����� �� ��������, �� ������, ��� ��� ���� � ���������� � ���������� ����������� �����.');
//-->
</SCRIPT>";
		echo"<SCRIPT LANGUAGE=\"JavaScript\">top.frames['main'].location = \"more.php\";</SCRIPT>";
	} elseif ($stat['room'] == 735) {
		mysql_query("UPDATE players SET room=717, hp_now=hp_now-$minus_hp WHERE user='".$stat['user']."'");
		echo"<SCRIPT LANGUAGE='JavaScript'>
<!--
alert('���������� ���������� ����� ������� ���� ����� � ������� ��������� ����������. �� �������� ��������� � �������, �� ��������� ��������� ������� ��� ���������� �� ���� ������... ����� �� ��������, �� ������, ��� ��� ���� � ���������� � ���������� ����������� �����.');
//-->
</SCRIPT>";
		echo"<SCRIPT LANGUAGE=\"JavaScript\">top.frames['main'].location = \"more.php\";</SCRIPT>";
	}
	//����� ��������� � ���������

	$VaultInfo = mysql_fetch_array(mysql_query("SELECT * FROM `more` WHERE id='".$stat['room']."'"));


	if ($work) {
		if ( $_POST['right_code'] == $_POST['number'] ) {
			if ($stat['room'] == 701 || $stat['room'] == 711 || $stat['room'] == 713 || $stat['room'] == 720 || $stat['room'] == 728 || $stat['room'] == 734 || $stat['room'] == 741 || $stat['room'] == 745) {
				//��� ��������� ������ �� ����
				$instr = mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=15 AND objects.min='4|0|0|0|0|0|0|0' AND objects.id IN (slots.3)");

				if (mysql_num_rows ($instr)) {
					//��������� ����������
					if ($stat[ustal_now]>=5) {
						//�������� �� ������������ �� ��
						if ($stat['more_move'] == 0) {
							//�������� �� ����� �� �� �����
							if ($stat['lov_action'] == 0) {
								//��� �� �� ������� ���� ������
								$izn_instr = mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=15 AND objects.min='1|0|0|0|0|0|0|4' AND objects.id IN (slots.3)");
								$izn_instr = mysql_fetch_array(mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=15 AND objects.min='4|0|0|0|0|0|0|0' AND objects.id IN (slots.3)"));
								$instr_inf=explode("|",$izn_instr['inf']);
								$iznos=($instr_inf[6]+1);
								//��������� ���� ������� ��������� ������ �� ����� �� � �����

								if ($instr_inf[7] > $iznos ) {
									mysql_query("UPDATE objects SET inf='".$instr_inf['0']."|".$instr_inf['1']."|".$instr_inf['2']."|".$instr_inf['3']."|".$instr_inf['4']."|".$instr_inf['5']."|".$iznos."|".$instr_inf['7']."' WHERE id='".$izn_instr['id']."'");
								}
								else
								{
									//����� � �����
									mysql_query("UPDATE objects SET inf='".$instr_inf['0']."|".$instr_inf['1']."|".$instr_inf['2']."|".$instr_inf['3']."|".$instr_inf['4']."|".$instr_inf['5']."|".$iznos."|".$instr_inf['7']."' WHERE id='".$izn_instr['id']."'");
									mysql_query("UPDATE slots set slots.3=0 WHERE slots.id=".$stat['id']."");
								}

								$time_r = 420*$stat['navik_rb']/2/100;
								$times_r = 420-$time_r;
								$times_r2 = ceil($times_r);

								//������ ����� ����� ���� (20 ���) + �������� 5 ����������
								mysql_query("UPDATE players set lov_lov_actionw+$times_r2, lov_action=1, ustal_now=ustal_now-5 where id=$stat[id]");
								echo"<SCRIPT LANGUAGE=\"JavaScript\">top.frames['main'].location = \"more.php\";</SCRIPT>";

							} else $msg = "�� ��� ������ ����!";
						} else $msg = "�� �� ������ ������ ������ ����, �.�. �� �������!";
					} else $msg="�� �� �������� ������������! �����-�� ������������.";
				} else $msg="��� ������ ������ ���� ������!";
			} else $msg="�� ���������� �� � ��� ������� � ����� �����...";
		} else $msg="�������� ���";
	}


	if ($work2) {
		if ( $_POST['right_code'] == $_POST['number'] ) {
			if ($stat['room'] == 701 || $stat['room'] == 711 || $stat['room'] == 713 || $stat['room'] == 720 || $stat['room'] == 728 || $stat['room'] == 734 || $stat['room'] == 741 || $stat['room'] == 745) {
				//��� ��������� ������ �� ����
				$instr = mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=15 AND objects.min='4|0|0|0|0|0|0|0' AND objects.id IN (slots.3)");
				if (mysql_num_rows ($instr)) {
					if ($stat[ing_dozhdevik] or $stat[ing_zhuk] > 0) {

						//��������� ����������
						if ($stat[ustal_now]>=5) {
							//�������� �� ������������ �� ��
							if ($stat['more_move'] == 0) {
								//�������� �� ����� �� �� �����
								if ($stat['lov_action'] == 0) {
									//��� �� �� ������� ���� ������
									$izn_instr = mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=15 AND objects.min='1|0|0|0|0|0|0|4' AND objects.id IN (slots.3)");
									$izn_instr = mysql_fetch_array(mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=15 AND objects.min='4|0|0|0|0|0|0|0' AND objects.id IN (slots.3)"));
									$instr_inf=explode("|",$izn_instr['inf']);
									$iznos=($instr_inf[6]+1);
									//��������� ���� ������� ��������� ������ �� ����� �� � �����

									if ($instr_inf[7] > $iznos ) {
										mysql_query("UPDATE objects SET inf='".$instr_inf['0']."|".$instr_inf['1']."|".$instr_inf['2']."|".$instr_inf['3']."|".$instr_inf['4']."|".$instr_inf['5']."|".$iznos."|".$instr_inf['7']."' WHERE id='".$izn_instr['id']."'");
									}
									else
									{
										//����� � �����
										mysql_query("UPDATE objects SET inf='".$instr_inf['0']."|".$instr_inf['1']."|".$instr_inf['2']."|".$instr_inf['3']."|".$instr_inf['4']."|".$instr_inf['5']."|".$iznos."|".$instr_inf['7']."' WHERE id='".$izn_instr['id']."'");
										mysql_query("UPDATE slots set slots.3=0 WHERE slots.id=".$stat['id']."");
									}

									$time_r = 420*$stat['navik_rb']/2/100;
									$times_r = 420-$time_r;
									$times_r2 = ceil($times_r);

									//������ ����� ����� ���� (20 ���) + �������� 5 ����������


									if ($stat[ing_dozhdevik] > 0) {$ulovka="ing_dozhdevik";}
									if ($stat[ing_zhuk] > 0) {$ulovka="ing_zhuk";}
									if ($stat[ing_dozhdevik] > 0 and $stat[ing_zhuk] > 0) {$ulovkaid = rand(1,2);}
									if ($ulovkaid = 1) $ulovka = ing_zhuk;
									else $ulovka = ing_dozhdevik;


									mysql_query("UPDATE players set lov_time=$now+$times_r2, lov_action=3, ustal_now=ustal_now-5, $ulovka=$ulovka-1 where id=$stat[id]");


									echo"<SCRIPT LANGUAGE=\"JavaScript\">top.frames['main'].location = \"more.php\";</SCRIPT>";

								} else $msg = "�� ��� ������ ����!";
							} else $msg = "�� �� ������ ������ ������ ����, �.�. �� �������!";
						} else $msg="�� �� �������� ������������! �����-�� ������������.";
					} else $msg="� ��� ��� ������� ��� ����� ����!";
	   } else $msg="��� ������ ������ ���� ������!";
			} else $msg="�� ���������� �� � ��� ������� � ����� �����...";
		} else $msg="�������� ���";
	}



	if ($work3) {
		if ( $_POST['right_code'] == $_POST['number'] ) {
			if ($stat['room'] == 737 || $stat['room'] == 723 || $stat['room'] == 744) {

				//��������� ����������
				if ($stat[ustal_now]>=5) {
					//�������� �� ������������ �� ��
					if ($stat['more_move'] == 0) {
						//�������� �� ����� �� �� �����
						if ($stat['lov_action'] == 0) {

							$time_r = 420*$stat['navik_rb']/2/100;
							$times_r = 900-$time_r;
							$times_r2 = ceil($times_r);

							//������ ����� ����� ���� (20 ���) + �������� 5 ����������
							mysql_query("UPDATE players set lov_time=$now+$times_r2, lov_action=4, ustal_now=ustal_now-5 where id=$stat[id]");
							echo"<SCRIPT LANGUAGE=\"JavaScript\">top.frames['main'].location = \"more.php\";</SCRIPT>";

						} else $msg = "�� ��� ����� ������!";
					} else $msg = "�� �� ������ ������ ����� �������, �.�. �� �������!";
				} else $msg="�� �� �������� ������������! �����-�� ������������.";
			} else $msg="�� ���������� �� � ��� ������� � ����� �����...";
		} else $msg="�������� ���";
	}



	if ($stat['lov_action'] == 1) {
		//���� � ���� ����� ����� ����� �����, �� ���� ���� �����, ��� �� ���� :))
		if ($stat['lov_time']-2 < $now) {
			//������� � �� �����, � �������� ����� ����
			mysql_query("UPDATE `players` SET lov_time=0, lov_action=0 WHERE user='".$stat['user']."'");
			$stat['lov_action'] = 0;
			$stat['lov_time'] = 0;



			$resurs=array();
			$resurs[1]="ing_kefal|������";
			$resurs[2]="ing_narval|������";
			$resurs[3]="ing_stavrida|��������";
			$resurs[4]="ing_osetr|����";
			$resurs[5]="ing_okun|�����";
			$res_type=$resurs[rand(1,5)];
			$r_name=explode("|",$res_type);

			$iznos=($instr_inf[6]+1);

			$navik = $stat['navik_rb'];


			$min = $chance*$navik/100;

			$ch = rand(0,8);
			$ing = 1;
			$kol_ing = rand(1,$ing);

			if ( $ch <= 3) {

				$ass = $kol_ing+2;
				$dobav_nav = $ass/1000;

				require_once("inc/chat/functions.php");
				insert_msg("�� �������� <b>\"$r_name[1]\" $ing ��.</b> � ����� ��������� ���� � �����! ��� ����� <b>\"������\"</b> ��������� �� <b>$dobav_nav</b>%","","","1",$stat[user],"",$stat[room]);
				mysql_query("UPDATE players SET navik_rb=navik_rb+$dobav_nav WHERE id='".$stat['id']."'");
				mysql_query("UPDATE players SET $r_name[0]=$r_name[0]+1 WHERE id='".$stat['id']."'");
			}
			else {
				$ubr_nav = $kol_ing/1000;
				require_once("inc/chat/functions.php");
				insert_msg("�� ������ �� �������! ��� ����� <b>\"������\"</b> ��������� �� <b>$ubr_nav</b>%","","","1",$stat[user],"",$stat[room]);
				mysql_query("UPDATE players SET navik_rb=navik_rb+$ubr_nav WHERE id='".$stat['id']."'");

			}

		}
	}


	if ($stat['lov_action'] == 3) {
		//���� � ���� ����� ����� ����� �����, �� ���� ���� �����, ��� �� ���� :))
		if ($stat['lov_time']-2 < $now) {
			//������� � �� �����, � �������� ����� ����
			mysql_query("UPDATE `players` SET lov_time=0, lov_action=0 WHERE user='".$stat['user']."'");
			$stat['lov_action'] = 0;
			$stat['lov_time'] = 0;



			$resurs=array();
			$resurs[1]="ing_kefal|������";
			$resurs[2]="ing_narval|������";
			$resurs[3]="ing_stavrida|��������";
			$resurs[4]="ing_osetr|����";
			$resurs[5]="ing_okun|�����";
			$res_type=$resurs[rand(1,5)];
			$r_name=explode("|",$res_type);

			$iznos=($instr_inf[6]+1);

			$navik = $stat['navik_rb'];


			$min = $chance*$navik/100;

			$ch = rand(0,8);
			$ing = 1;
			$kol_ing = rand(1,$ing);

			if ( $ch <= 5 ) {

				$ass = $kol_ing+2;
				$dobav_nav = $ass/1000;

				require_once("inc/chat/functions.php");
				insert_msg("�� �������� <b>\"$r_name[1]\" $ing ��.</b> � ����� ��������� ���� � �����! ��� ����� <b>\"������\"</b> ��������� �� <b>$dobav_nav</b>%","","","1",$stat[user],"",$stat[room]);
				mysql_query("UPDATE players SET navik_rb=navik_rb+$dobav_nav WHERE id='".$stat['id']."'");
				mysql_query("UPDATE players SET $r_name[0]=$r_name[0]+1 WHERE id='".$stat['id']."'");


			}
			else {
				$ubr_nav = $kol_ing/1000;
				require_once("inc/chat/functions.php");
				insert_msg("�� ������ �� �������! ��� ����� <b>\"������\"</b> ��������� �� <b>$ubr_nav</b>%","","","1",$stat[user],"",$stat[room]);
				mysql_query("UPDATE players SET navik_rb=navik_rb+$ubr_nav WHERE id='".$stat['id']."'");
			}
		}
	}



	if ($stat['lov_action'] == 4) {
		//���� � ���� ����� ����� ����� �����, �� ���� ���� �����, ��� �� ���� :))
		if ($stat['lov_time']-2 < $now) {
			//������� � �� �����, � �������� ����� ����
			mysql_query("UPDATE `players` SET lov_time=0, lov_action=0 WHERE user='".$stat['user']."'");
			$stat['lov_action'] = 0;
			$stat['lov_time'] = 0;



			$resurs=array();
			$resurs[0]="koral|�����";
			$resurs[1]="koral|�����";
			$resurs[2]="koral|�����";
			$resurs[3]="koral|�����";
			$resurs[4]="koral|�����";
			$res_type=$resurs[rand(0,4)];
			$r_name=explode("|",$res_type);

			$iznos=($instr_inf[6]+1);

			$navik = $stat['navik_rb'];


			$min = $chance*$navik/100;

			$ch = rand(0,7);
			$ing = 1;
			$kol_ing = rand(1,$ing);

			if ( $ch <= 4 ) {

				$ass = $kol_ing+2;
				$dobav_nav = $ass/1000;

				require_once("inc/chat/functions.php");
				insert_msg("�� ����� <b>\"$r_name[1]\" $ing ��.</b>! ��� ����� <b>\"������\"</b> ��������� �� <b>$dobav_nav</b>%","","","1",$stat[user],"",$stat[room]);
				mysql_query("UPDATE players SET navik_rb=navik_rb+$dobav_nav WHERE id='".$stat['id']."'");
				mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`time`, `about`) VALUES ('".$stat['user']."','".$res_type."|20|0|0|0|0|0','0|0|0|0|0|0|0|0','16','".time()."', '�����������')");
			}
			else {
				$ubr_nav = $kol_ing/1000;
				require_once("inc/chat/functions.php");
				insert_msg("�� ������ �� �����! ��� ����� <b>\"������\"</b> ��������� �� <b>$ubr_nav</b>%","","","1",$stat[user],"",$stat[room]);
				mysql_query("UPDATE players SET navik_rb=navik_rb+$ubr_nav WHERE id='".$stat['id']."'");
			}
		}
	}



	// �������
	if ($GoIn && ($GoIn == "top" || $GoIn == "bottom" || $GoIn == "left" || $GoIn == "right")) {

		if ($stat['more_move'] == 1) $msg = "�� ��� �������!";
		elseif ($stat['lov_time'] > $now) $msg = "�� �� ������ �����, �.�. �� ������ ����!";
		else {

			$GoInfo = mysql_fetch_array(mysql_query("SELECT * FROM `more` WHERE id='".$VaultInfo[$GoIn.'_id']."'"));

			if ($GoInfo['id']) {
				$times = $GoInfo['time']*5/$stat['lodka'];

				if ($stat['user'] == 'diepo' || $stat['user'] == '_SERG_') {$stat['more_time'] = $now+'1';} else {
					$stat['more_time'] = $now + $times;}
					$stat['more_room'] = $GoInfo['id'];
					$stat['vaul_move'] = 1;


					mysql_query("UPDATE `players` SET more_room='".$GoInfo['id']."', more_time='".$stat['more_time']."', more_move=1 WHERE user='".$stat['user']."'");

					$GoToText = "������ � <b><u>".$GoInfo['title']."</u></b>";
			}
		}
	}

	if ($stat['more_move'] == 1) {

		if ($stat['more_time']-2 < $now) {

			mysql_query("UPDATE `players` SET room=more_room, more_room=0, more_time=0, more_move=0 WHERE user='".$stat['user']."'");

			$_ROOM['TO_CHANGE'] = $stat['more_room'];
			$stat['more_time'] = 0;
			$stat['more_room'] = 0;
			$stat['vaul_move'] = 0;

			echo"
                <SCRIPT LANGUAGE=\"JavaScript\">
                <!--
top.frames['main'].location = \"more.php\";
top.frames['online'].location = top.frames['online'].location;

                //-->
                </SCRIPT>
                ";
			exit;
		}
	}

	$VaultRoom['701'] = "���� x5 y1";
	$VaultRoom['702'] = "���� x5 y2";
	$VaultRoom['703'] = "���� x5 y3";
	$VaultRoom['704'] = "���� x5 y4";
	$VaultRoom['705'] = "���� x4 y1";
	$VaultRoom['706'] = "���� x4 y2";
	$VaultRoom['707'] = "���� x4 y3";
	$VaultRoom['708'] = "���� x4 y4";
	$VaultRoom['709'] = "���� x3 y1";
	$VaultRoom['710'] = "���� x3 y2";
	$VaultRoom['711'] = "���� x3 y3";
	$VaultRoom['712'] = "���� x3 y4";
	$VaultRoom['713'] = "���� x2 y1";
	$VaultRoom['714'] = "���� x2 y2";
	$VaultRoom['715'] = "���� x2 y3";
	$VaultRoom['716'] = "���� x2 y4";
	$VaultRoom['717'] = "���� x1 y1";
	$VaultRoom['718'] = "���� x1 y2";
	$VaultRoom['719'] = "���� x1 y3";
	$VaultRoom['720'] = "���� x1 y4";
	$VaultRoom['721'] = "���� x-1 y2";
	$VaultRoom['722'] = "���� x-1 y3";
	$VaultRoom['728'] = "���� x-2 y1";
	$VaultRoom['723'] = "���� x-2 y3";
	$VaultRoom['724'] = "���� x-2 y4";
	$VaultRoom['727'] = "���� x-3 y1";
	$VaultRoom['726'] = "���� x-3 y2";
	$VaultRoom['725'] = "���� x-3 y3";
	$VaultRoom['729'] = "���� x-4 y1";
	$VaultRoom['730'] = "���� x-4 y-1";
	$VaultRoom['731'] = "���� x-5 y-1";
	$VaultRoom['732'] = "���� x-3 y-1";
	$VaultRoom['733'] = "���� x-3 y-2";
	$VaultRoom['734'] = "���� x-2 y-2";
	$VaultRoom['735'] = "���� x-3 y-3";
	$VaultRoom['736'] = "���� x-1 y-2";
	$VaultRoom['737'] = "���� x-2 y-3";
	$VaultRoom['738'] = "���� x1 y-2";
	$VaultRoom['739'] = "���� x1 y-3";
	$VaultRoom['740'] = "���� x1 y-1";
	$VaultRoom['741'] = "���� x2 y-2";
	$VaultRoom['742'] = "���� x3 y-2";
	$VaultRoom['743'] = "���� x3 y-1";
	$VaultRoom['744'] = "���� x3 y-3";
	$VaultRoom['745'] = "���� x4 y-3";



	include("inc/html_header.php");

	echo"<body background='/i/bg.gif' leftmargin=0 topmargin=0>

<DIV id=hint1></DIV>
<div id=mainform style='position:absolute; left:30px; top:30px'></div>";
	echo"<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/time.js\"></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/show_inf.js\"></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/login_form.js\"></SCRIPT>";

	//������ �������� � ����
	if ($perexod) {
		if ($stat['more_move'] == 0) {
			if ($stat[room] == 702) { // �������� �� �������

				mysql_query("UPDATE players set room=700 where user='".$stat['user']."'");
				$stat['room']=700;

				require_once("inc/chat/functions.php");
				insert_msg("�� ������ ����� � ����","","","1",$stat[user],"",$stat[room]);

				echo "<meta http-equiv='refresh' content='0; url=port.php'>"; }

				else $msg="������, �� ���������� ������� ������ �� �����!"; } else $msg = "�� ��� �������!";
	}
	//����� �������� � ����


	print"<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<TD width=1>&nbsp;</TD>
<td width=600 valign=top>


<TABLE cellspacing=0 cellpadding=0>
<tr>

<TD valign=top>
<SCRIPT language=JavaScript>
show_inf('$stat[user]','$stat[id]','$stat[level]','$stat[rank]','$stat[tribe]');
</SCRIPT>
</TD>

<TD WIDTH=10>&nbsp;</TD>
<form action='' method=post>
<TD valign=top>
<table cellspacing=0 cellpadding=0 border=0 align=center height=12>
<tr>
<td width=200 title='������� �����: $stat[hp_now]/$stat[hp_max]' align=left valign=bottom width=200><img src=i/vault/navigation/hp/_helth.gif width='10' height=10 border=0 alt='������� �����: $stat[hp_now]/$stat[hp_max]'><img src=i/vault/navigation/hp/helth.gif height='10' width='$widthhp' border=0 alt='������� �����: $stat[hp_now]/$stat[hp_max]'><img src=i/vault/navigation/hp/_helth_.gif width='10' height=10 border=0 alt='������� �����: $stat[hp_now]/$stat[hp_max]'></td>
<TD valign=top><FONT COLOR=RED><B>$stat[hp_now] / $stat[hp_max]</B></FONT></TD>
</tr>
<tr>
<td width=200 title='������� ����������: $ustal/$ustal_max' align=left valign=bottom width=200><img src=i/vault/navigation/hp/_ustal.gif width='10' height=10 border=0 alt='������� ����������: $ustal/$ustal_max'><img src=i/vault/navigation/hp/ustal.gif height='10' width='$widthustal' border=0 alt='������� ����������: $ustal/$ustal_max'><img src=i/vault/navigation/hp/_ustal_.gif width='10' height=10 border=0 alt='������� ����������: $ustal/$ustal_max'></td>
<TD valign=top><FONT COLOR=GREEN><B>$ustal / $ustal_max</B></FONT></TD>
</tr>
</table>
</TD>



</TR>
</TABLE>

</td>

<td align=right valign=top>
<input class=input type=button value='��������' onclick='window.location.href=\"more.php?tmp=\"+Math.random();\"\"'>";

	if ($stat['room'] == 702) echo"
<input type=submit class=input value='����� � ����' name=perexod>";

	echo"</td>
</tr>
</table></form>";



	if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center>";


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
            <tr><td valign='top' width='135'>";

	echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center' colspan='3'><b>���������:</b></td></tr>
<tr height=45>
<td width=45>&nbsp;</td><td width=45 align=center valign=center><IMG SRC='i/vault/navigation/";
	if ($VaultInfo['top_id']) echo"active/top.gif' onclick='top.frames[\"main\"].location = \"more.php?GoIn=top&\"+Math.random();' alt='������� � ".$VaultRoom[$VaultInfo['top_id']]."' style='CURSOR: Hand'"; else echo"n_active/top.gif' alt='��� �������'";
	echo"></td><td width=45>&nbsp;</td>
</tr>

<tr height=45>
<td width=45 align=center valign=center><IMG SRC='i/vault/navigation/";
	if ($VaultInfo['left_id']) echo"active/left.gif' onclick='top.frames[\"main\"].location = \"more.php?GoIn=left&\"+Math.random();' alt='������� � ".$VaultRoom[$VaultInfo['left_id']]."' style='CURSOR: Hand'"; else echo"n_active/left.gif' alt='��� �������'";
	echo"></td><td width=45 align=center valign=center><IMG SRC='i/vault/navigation/center.gif'></td><td width=45 align=center valign=center><IMG SRC='i/vault/navigation/";
	if ($VaultInfo['right_id']) echo"active/right.gif' onclick='top.frames[\"main\"].location = \"more.php?GoIn=right&\"+Math.random();' alt='������� � ".$VaultRoom[$VaultInfo['right_id']]."' style='CURSOR: Hand'"; else echo"n_active/right.gif' alt='��� �������'";
	echo"></td>
</tr>

<tr height=45>
<td width=45>&nbsp;</td><td width=45 align=center valign=center><IMG SRC='i/vault/navigation/";
	if ($VaultInfo['bottom_id']) echo"active/bottom.gif' onclick='top.frames[\"main\"].location = \"more.php?GoIn=bottom&\"+Math.random();' alt='������� � ".$VaultRoom[$VaultInfo['bottom_id']]."' style='CURSOR: Hand'"; else echo"n_active/bottom.gif' alt='��� �������'";
	echo"></td><td width=45>&nbsp;</td>
</tr>";

	echo"</table>
</div>
";

	echo "</td><td valign='top'>";

	echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>���� �����:</b></td></tr><tr><td>";

	if ($stat['lodka'] != 0) {
		echo "��������: <b>";
		if ( $stat['lodka'] == 1 ) { echo "������ �����"; }
		elseif ( $stat['lodka'] == 2 ) { echo "������ �����"; }
		elseif ( $stat['lodka'] == 3 ) { echo "�����"; }
		elseif ( $stat['lodka'] == 4 ) { echo "���������� �����"; }
		echo "</b><br>
<center><img src='i/more/lodka".$stat['lodka'].".gif'></center>
�����������: <b>+".$stat['lodka']." � �������� ������������</b>"; 
	} else {
		echo "� ��� ��� �����.";
	}
	echo "                </td>
  </tr>
</table>
</div>
";

	echo "</td><td valign='top'>";

	echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>���� ��������:</b></td></tr>";

	if ($stat['more_time'] > $now) {

		echo"<tr><td align='center'>�� � �������: <b>".$VaultInfo['title']."</b><br><br>�������:&nbsp;<b><small><div id=move></div></small></b><script>ShowTime('move',",$stat['more_time']-$now+rand(1,3),",1);</script>
<br>� �������: <b>".$VaultRoom[$stat[more_room]]."</b></td></tr>";
	}

	elseif ($stat['lov_time'] > $now) {

		echo"<tr><td align='center'>�� � �������: <b>".$VaultInfo['title']."</b><br><br>������ ����: &nbsp;<b><small><div id=know></div></small></b><script>ShowTime('know',",$stat['lov_time']-$now,",1);</script></td></tr>";
	}
	else { echo"<tr><td align='center'>�� � �������: <b>".$VaultInfo['title']."</b><br>���� ��������: �������� ��������</td></tr>"; }

	echo"
</table>
</div>
";

	echo "</td><td valign='top' width='135'>";

	echo"<form action='' method=post>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>��������:</b></td></tr><tr><td align='center'>";
	$number = rand('111111','999999');

	if ($stat['room'] == 701 || $stat['room'] == 711 || $stat['room'] == 713 || $stat['room'] == 720 || $stat['room'] == 728 || $stat['room'] == 734 || $stat['room'] == 741 || $stat['room'] == 745) echo"
������� ���: <b>".$number."</b>
<input name='number' class=input style='WIDTH: 120px' maxlength=11 type='text' size='20'>
<input type='hidden' name='right_code' value='".$number."'>
<input type='submit' disabled class='input' name='work' value='������ ����' style='WIDTH: 120px'>
<input type='submit' class='input' name='work' value='��� �������' style='WIDTH: 120px'>


<input type='submit' class='input' name='work2' value='�� �������' style='WIDTH: 120px'>";



	elseif ($stat['room'] == 723) echo" �� �������� � �������, �� ������ ������
<input type='submit' class='input' name='work3' value='����� �������' style='WIDTH: 120px'>";

	elseif ($stat['room'] == 737) echo" �� �������� � �������, �� ������ ������
<input type='submit' class='input' name='work3' value='����� �������' style='WIDTH: 120px'>";

	elseif ($stat['room'] == 744) echo" �� �������� � �������, �� ������ ������
<input type='submit' class='input' name='work3' value='����� �������' style='WIDTH: 120px'>";

	else echo "����� ��� ������� �������� ��� ���.";


	echo "                </td>
  </tr>
</table>
</div>
";

	echo "</form> </td>
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