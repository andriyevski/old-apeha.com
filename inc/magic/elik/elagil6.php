<?
if ($stat['user'] != "$chl[user]") $nms="����� ����� ���� ������ ������ ����!";
elseif ($stat['elik_time'] > $now) $nms="�� �� ������ ���� ����� ������ ����� �����!";
else {
	$el_str=0;
	$el_ag=6;
	$el_dex=0;
	$el_vit=0;
	$el_raz=0;
	$el_bat=0;
	$el_pow=0;
	$el_time=$now+7200;
	$nms="�� ������ �����!� ���� �������� ����������� �� +6 � ����� ����� ��� 2 ����!";
	require_once("function/chat_insert.php");
	insert_msg("�� ������ �����!� ���� �������� ����������� �� +6 � ����� ����� ��� 2 ����!","","","1",$stat['user'],"",$stat['room']);
	include("includes/magic/elik_save.php");
	include("includes/magic/drop.php");
	$alldone=1;
}
?>