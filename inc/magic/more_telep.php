<?
if ($chl['room'] != $stat['room'])
$nms="�������� �� �������� �� ������ �������� ���������� ��������� �� � ����� �������.";

else {

	include("inc/magic/drop.php");

	mysql_query("update players set room=1 where user='".$chl['user']."'");

	require_once("inc/chat/functions.php");
	insert_msg("�� ������ ����������������� � <b>����</b>!","","","1",$chl['user'],"",$chl['room']);
}

?>