<?
if ($stat['battle']) $nms="� ��� ������� ����� ����������!";
elseif ($chl['travma'] < $now) $nms="�������� �� �����������!";
elseif ($chl['t_level'] > 2) $nms="����� ������� ������ ������ �� ��������!";
elseif ($stat['energy_now'] < 15) $nms="� ��� �� ������� ����!";
elseif ($chl['room'] != $stat['room']) $nms="��� ��������� ��������� �� ����� ��� ���������� ��������� � ����� �������!";
else {

	include("includes/magic/drop.php");

	mysql_query("UPDATE person SET travma=NULL, t_level=0, t_type=0 where id='".$chl['id']."'");
	mysql_query("update person set energy_now=energy_now-15 where id='".$stat['id']."'");
	if ($chl['user'] == $stat['user']) {
		$MesgForAdd = "�� ������� �������� ���� �� �����!";
		$stat['travma'] = NULL;
	}
	else $MesgForAdd = "�� �������� �� ����� ������� <b><u>".$stat['user']."</u></b>";

	require_once("function/chat_insert.php");
	insert_msg("$MesgForAdd","","","1",$chl[user],"","0");

	$nms="�� ������ ������...<br>�������� <u>".$chl['user']."</u> ������� ������ �� �����!";
	$alldone=1;
}
?>