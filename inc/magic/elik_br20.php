<?
if ($stat['user'] != "$chl[user]") $nms="����� ����� ���� ������ ������ ����!";
elseif ($stat['elik_br'] > $now) $nms="������ ����� ��� ��������� �� ���!";
else {
	mysql_query("UPDATE players SET elik_br=$now+10800,elik_kb=20 WHERE id='".$stat['id']."'");
	require_once("inc/chat/functions.php");
	insert_msg("�� ������ �����! � ���� ����� ����������� �� +20 � ����� ����� ��� 3 ����!","","","1",$stat['user'],"",$stat['room']);
	$nms="�� ������ �����! � ���� ����� ����������� �� +20 � ����� ����� ��� 3 ����!";
	include("inc/magic/drop.php");
	$alldone=1;
}

?>