<?
if ($iteminfo['name'] == "water10") $for_add = 10;
elseif ($iteminfo['name'] == "water20") $for_add = 20;

$chl_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp` FROM slots, objects WHERE slots.id='".$chl['id']."' AND objects.user='".$chl['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));

$ChlSkills = explode("|",$stat['rase_skill']);
$chl['gnom']=$ChlSkills['3']*5;

$chl['hp']-=$chl_obj['hp'];
$h_hpmax=ceil(($chl['vitality']*5-$chl['hp'])*(1-($chl['gnom']/100)));



if ($chl['hp_now'] <= 0) $nms="�������� \"".$chl['user']."\" �������!";
elseif ($chl['hp_now'] == 0 && $chl['battle']) $nms="�������� �� ��� �� ����� ����, �������� ��� �������";
elseif ($stat['energy_now'] < 5) $nms="� ��� �� ������� ����!";
elseif ($stat['proff'] < 18) $nms="� ��� ��� ��������� ���!";
elseif ($stat['battle'] != $chl['battle']) $nms="��� ������ ���������� �� ��������� ��� ���������� ���������� � ����� ��� � ���!";
// ----- # ����������� ���� � ��� ����� # ----- //

// ----- # -10 HP && -20 HP # ----- //

elseif (($for_add == 10 || $for_add == 20) && ($stat['proff'] == 18 && $stat['battle'] != $chl['battle'])) $nms="��� ������ ���������� �� ��������� ��� ���������� ���������� � ����� ��� � ���!";

else {

	if ($stat[user]!="$chl[user]") $MesgForAdd = "��� <b><u>$stat[user]</u></b> ����������� ������ ��� ����� ����... ���� ��������� ���� ����� <b><u>-$for_add ��</u></b>";
	else $MesgForAdd = "�������� �� ������������ ������� �����... �� ��������� ����� ����� ���� � ������������  ��: <b><u>-$for_add ��</u></b>";

	include("inc/magic/drop.php");

	require_once("inc/chat/functions.php");
	insert_msg("$MesgForAdd","","","1",$chl['user'],"",$chl['room']);

	if ($chl['hp_now'] - $for_add >= $h_hpmax) $hp_query=$h_hpmax;
	else $hp_query=$chl['hp_now']-$for_add;

	if ($stat['user'] == $chl['user'] && $stat['battle'] == NULL) $stat['hp_now'] = $hp_query;

	mysql_query("update players set hp_now=".$hp_query." where id='".$chl['id']."'");
	mysql_query("update players set energy_now=energy_now-5 where id='".$stat['id']."'");

	if ($chl['battle'])
	mysql_query("update participants set hp=".$hp_query." where id='".$chl['id']."'");


	$nms="����� ����� ���� ��������� ...<br>��������� <u>".$chl['user']."</u> ������� ����� � �� ����������� �� <u>-$for_add HP</u>";

	$alldone=1;
}

?>