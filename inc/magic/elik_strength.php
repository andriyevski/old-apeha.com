<?
if ($stat['user'] != "$chl[user]") $nms="����� ����� ���� ������ ������ ����!";
elseif ($stat['elik_sila'] > $now) $nms="������ ����� ��� ��������� �� ���!";
else {
	mysql_query("UPDATE players SET elik_sila=$now+10800,elik_ks=10 WHERE id='".$stat['id']."'");
	require_once("inc/chat/functions.php");
	insert_msg("�� ������ �����! � ���� ���� ����������� �� +10 � ����� ����� ��� 3 ����!","","","1",$stat['user'],"",$stat['room']);
	$nms="�� ������ �����! � ���� ���� ����������� �� +10 � ����� ����� ��� 3 ����!";
	include("inc/magic/drop.php");
	$alldone=1;
}

?>