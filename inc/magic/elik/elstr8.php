<?
if ($stat['user'] != "$chl[user]") $nms="����� ����� ���� ������ ������ ����!";
elseif ($stat['elik_time'] > $now) $nms="�� �� ������ ���� ����� ������ ����� �����!";
else {
	$el_str=8;
	$el_ag=0;
	$el_dex=0;
	$el_vit=0;
	$el_raz=0;
	$el_bat=0;
	$el_pow=0;
	$el_time=$now+3600;
	$nms="�� ������ �����!� ���� ���� ����������� �� +8 � ����� ����� ��� 1 ���!";
	require_once("function/chat_insert.php");
	insert_msg("�� ������ �����!� ���� ���� ����������� �� +8 � ����� ����� ��� 1 ���!","","","1",$stat['user'],"",$stat['room']);
	include("includes/magic/elik_save.php");
	include("includes/magic/drop.php");
	$alldone=1;
}
?>