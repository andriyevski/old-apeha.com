<?
if ($chl['user'] == $stat['user'])
$nms="��������� �� ������ ���� - ��� ��� ��������...";
elseif ($chl['lpv'] > 600)
$nms="�������� <u>$login</u> ������������!";
elseif ($chl['room'] != $stat['room'])
$nms="��� �������� ��� ���������� ��������� � ����� �������!";
elseif (($chl['room'] < 701 && $chl['room'] > 745) || ($stat['room'] < 701 && $stat['room'] > 745))
$nms="������ ������� ����� ������������ ������ � ����!";
elseif ($stat['hp_now'] < (($stat['hp']+$stat['vitality']*5)*0.33))
$nms="�� ������� ��������� ��� ���!";
elseif ($chl['rank'] == 60)
$nms="�� ����� ������ ��������, ����� ���� ��� ������� �� ���!";
elseif ($chl['lov_time'] > $now)
$nms="��������� ����������, �.�. �������� ����� ����!";
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
	}
	?>