<?
if ($chl['user'] == $stat['user'])
$nms="��������� �� ������ ���� - ��� ��� ��������...";
elseif ($chl['immun'] > time())
$nms="�� ��������� ��� ����� ������ �� ���������!";
elseif ($chl['lpv'] > 600)
$nms="�������� <u>$login</u> ������������!";
elseif ($stat['travma'] > $now) $nms="� ��� ������� ������, �������� ��!";
elseif ($chl['room'] != $stat['room'])
$nms="��� �������� ��� ���������� ��������� � ����� �������!";
elseif ($chl['room'] == 300 || $chl['room'] == 41 || $chl['room'] == 23 || $chl['room'] == 22 || $chl['room'] == 28)
$nms="��� �������� ������!";
elseif (($chl['room'] >=701 && $chl['room'] <= 745) || ($stat['room'] >=701 && $stat['room'] <= 745))
$nms="������ ������� ���������� ������������ � ����!";
elseif ($stat['hp_now'] < (($stat['hp']+$stat['vitality']*5)*0.33))
$nms="�� ������� ��������� ��� ���!";
elseif ($chl['rank'] == 60)
$nms="�� ����� ������ ��������, ����� ���� ��� ������� �� ���!";
elseif ($chl['hp_now'] <= 5)
$nms="�������� <u>$login</u> ������� ���� ��� ��������!";
elseif ($chl['travma'] > $now)
$nms="�������� <u>$login</u> �����������!";
elseif ($stat['travma'] > $now)
$nms="�� �� ������ �������, � ��� ������!";
elseif ($chl['level']-$stat['level'] >= 4)
$nms="�� �� ������ �������... � ��� ��� ���������!";
else {

	include("inc/magic/drop.php");

	if ($stat[next_exp]!=0)
	$levels=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level='".$stat['level']."' AND exp<=$stat[next_exp] ORDER BY exp DESC"));
	else
	$levels=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level='".$stat['level']."'AND exp<=$stat[exp] ORDER BY exp DESC"));

	if ($chl['battle']) {



		$prt=mysql_fetch_array(mysql_query("SELECT side AS side, time AS time FROM participants WHERE time=".$chl['battle']." AND id=".$chl['id'].""));

		switch ($prt['side']) {
			case 0: $side=1; break;
			case 1: $side=0; break;
		}

		mysql_query("INSERT INTO participants (`time`, `id`, `side`, `base`,`hp`) values('".$prt['time']."', '".$stat['id']."', '".$side."', '".$levels['base']."', ".$stat['hp_now'].")");

		$b_id_id=mysql_fetch_array(mysql_query("SELECT MAX(id) as id FROM battles WHERE offer=".$prt['time'].""));
		$b_id_id['id']+=1;

		mysql_query("INSERT INTO battles (offer, time, id, attacker, defender, kick, block, type, damage, comment) values (".$prt['time'].", ".$now.", ".$b_id_id['id'].", '', '', '', '', NULL, '', '<script language=JavaScript>show_inf(\"".$stat['user']."\",\"".$stat['id']."\",\"".$stat['level']."\",\"".$stat['rank']."\",\"".$stat['tribe']."\");</script> �������� � ��������!')");



		mysql_query("UPDATE players, offers SET players.battle=".$prt['time'].", players.side=".$side.", offers.type=2 WHERE players.id=".$stat['id']." && offers.time=".$prt['time']."");
	}
	else {

		$time = $now + 300;
		if ($chl[next_exp]!=0)
		$chl_base=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level=".$chl['level']." AND exp<=$chl[next_exp] ORDER BY exp DESC"));
		else
		$chl_base=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level='".$chl['level']."'AND exp<=$chl[exp] ORDER BY exp DESC"));
		$bdate=date("d.m.y H:i",$time);


		while (mysql_fetch_array(mysql_query("SELECT * FROM offers WHERE time=".$time."")))
		$time++;

		mysql_query("INSERT INTO offers (time, type, size_left, size_right, done, timeout) values(".$time.",1,1,'1','1','180')");


		mysql_query("INSERT INTO participants (`time`,`id`,`side`,`base`,`hp`) VALUES (".$time.",".$stat['id'].",0,".$levels['base'].",".$stat['hp_now'].")");

		mysql_query("INSERT INTO participants (`time`,`id`,`side`,`base`,`hp`) VALUES (".$time.",".$chl['id'].",1,".$chl_base['base'].",".$chl['hp_now'].")");

		mysql_query("INSERT INTO battles (offer, time, id, attacker, defender, kick, block, type, damage, comment) values (".$time.", ".$time.", '0', '', '', '', '', NULL, '', '<i>���� ���������� <u>".$bdate."</u> ����� ��� �������!')");

		mysql_query("UPDATE players SET battle=".$time.", side=0 WHERE id='".$stat['id']."'");
		mysql_query("UPDATE players SET battle=".$time.", side=1 WHERE id='".$chl['id']."'");
	}

	require_once("inc/chat/functions.php");
	insert_msg("���������� <b><u>".$stat['user']."</u></b> �������� � ������ � ����� �� ���!","","","1",$chl['user'],"",$chl['room']);

	echo"<script>parent.main.location=\"battle.php?tmp=\"+Math.random();\"\"</script>";
}

?>