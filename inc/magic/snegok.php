<?
$damp=rand(1,50);
$chl_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp` FROM slots, objects WHERE slots.id='".$chl['id']."' AND objects.user='".$chl['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));
$ChlSkills = explode("|",$stat['rase_skill']);
$chl['gnom']=$ChlSkills['3']*5;
$chl['hp']-=$chl_obj['hp'];
$h_hpmax=ceil(($chl['vitality']*5-$chl['hp'])*(1-($chl['gnom']/100)));

if ($stat['ustal_now'] < 10) $nms="� ��� �� ������� ����������!";
elseif ($chl['level'] < 3) $nms="������ ������� ���������� ���� 3�� ������!";
elseif ($chl['hp_now'] == 0) $nms="�� ���� ��� ����!";
elseif ($chl['rank'] == 60) $nms="������!";
elseif ($chl['room'] != $stat['room']) $nms="�������� ��������� ������ �� ���!";
elseif ($chl['battle'] > $now) $nms="�������� ��������� � ���!";
else {
	if ($stat[user]!="$chl[user]") $MesgForAdd = "�������� <b><u>$stat[user]</u></b>, � ������� � ������ ������, ����� � <b><u>$chl[user]</u></b> ������. � ����� <b><u>-$damp ��</u></b> �����";
	else $MesgForAdd = "�������� <b><u>$stat[user]</u></b> �������� ��������� ���������, ��� ��������� ������ ����� � ������ � ��������� ��: <b><u>-$damp ��</u></b>";
	include("inc/magic/drop.php");
	require_once("inc/chat/functions.php");

	insert_msg('<img src=i/items/snegok.gif> '.$MesgForAdd.'','',''.$inf['user'].'','','','',$stat['room']);
	if ($chl['hp_now'] - $damp < 0) $hp_query=0;
	else $hp_query=$chl['hp_now']-$damp;

	$ust_query = $damp/5;
	mysql_query("update players set hp_now=".$hp_query." where id='".$chl['id']."'");
	mysql_query("update players set ustal_now=ustal_now - ".$ust_query." where id='".$stat['id']."'");
	$nms="�� ������� ������ � ��������� <u>".$chl['user']."</u> � ������� ��� <u>-$damp HP</u> �����";

	$alldone=1; 
}

?>
