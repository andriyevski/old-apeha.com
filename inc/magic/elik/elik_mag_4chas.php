<?
if ($stat['user'] != "$chl[user]") $nms="����� ����� ���� ������ ������ ����!";
elseif ($stat['elik_time'] > $now) $nms="�� �� ������ ���� ����� ������ ����� �����!";
else {
	$el_str=-2;
	$el_ag=-2;
	$el_dex=-2;
	$el_vit=-2;
	$el_raz=4;
	$el_bat=0;
	$el_pow=4;
	$el_time=$now+14400;
	require_once("function/chat_insert.php");
	insert_msg("�� ������ �����!� ��� ����� � ������� ����������� �� +4 �� ���� ������ ���������� � ����� ������ ��� 4 ����!","","","1",$stat['user'],"",$stat['room']);
	$nms="�� ������ �����!� ����� � ������� ����������� �� +4 �� ���� ������ ���������� � ����� ������ ��� 4 ����!";
	include("includes/magic/elik_save.php");
	include("includes/magic/drop.php");
	$alldone=1;
}
?>