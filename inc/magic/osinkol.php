<?
$energy = 20;

if ($stat['user'] == $chl['user']) $nms="�� �� ������ ��������� ���� ����!";
elseif ($chl['battle']) $nms="�������� ��������� � ���";
elseif ($chl['hp_now'] == 0) $nms="�������� �� ��� �� ����� ����, �������� ��� �������";
elseif ($stat['energy_now'] <= $energy) $nms="� ��� �� ������� ����!";
elseif ($chl['sclon'] != 'dark') $nms="�� ������ ��������� ������ �������!";
else{

	$MesgForAdd = "�������� <b><u>$stat[user]</u></b> ������ � ��� �������� ���... �� �������� ��� ���� �����...";

	include("includes/magic/drop.php");

	require_once("function/chat_insert.php");
	insert_msg("$MesgForAdd","","","1",$chl['user'],"",$chl['room']);

	mysql_query("update person set hp_now=0 where id='".$chl['id']."'");
	mysql_query("update person set energy_now=energy_now-$energy where id='".$stat['id']."'");

	if ($chl['battle'])
	mysql_query("update participants set hp=".$hp_query." where id='".$chl['id']."'");


	$nms="������ �������� ...<br>������� <u>".$chl['user']."</u> ������� �������� ��� � �� ����.";

	$alldone=1;
}

?>
