<?
if ($chl['aura_t'] > $now) $nms="�������� ����� ��������� ��� ��������� ������ ����� ����!";
if ($stat['energy_now'] < 20) $nms="������������ ����, ���������� 20 MP";
else {

	$aura_time=$now+ceil(14400*(1+$chl['sp_12']/100));

	mysql_query("UPDATE `person` SET `aura`='1', `aura_t`='$aura_time' WHERE `user`='".$chl['user']."'");
	mysql_query("update person set energy_now=energy_now-20 where id='".$stat['id']."'");

	require_once("function/chat_insert.php");
	insert_msg("�� ��� ���� �������� ���� ���������� ����� 1 ������!","","","1",$chl['user'],"",$chl['room']);
	$nms="�� �������� �� ��������� ���� ���������� �����!";

	include("includes/magic/drop.php");
	$alldone=1;
}
?>