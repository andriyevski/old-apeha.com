<?
if ($iteminfo[name]=="addenergy20") $for_add="20";
elseif ($iteminfo[name]=="addenergy40") $for_add="40";
elseif ($iteminfo[name]=="addenergy60") $for_add="60";
elseif ($iteminfo[name]=="addenergy100") $for_add="100";

$h_energymax=$chl[ustal]+$chl[vitality]*5; // ����� �������

$span=$ctime-$chl[lpv];

if ($chl['lpv'] > 180) $nms="�������� \"".$chl['user']."\" ������������!";
if ($chl[ustal_now]>=$h_energymax) $nms="�������� \"$chl[user]\" �� ��������� � �������������!";
else {

	if ($stat[user]!="$chl[user]") $MesgForAdd = "�������� <b><u>$stat[user]</u></b> ����������� ��� ������� �������: <b><u>+$for_add EP<u></b>";
	else $MesgForAdd = "�� ������ ������������ ��� ������� �������: <b><u>+$for_add EP</u></b>";

	require_once("inc/chat/functions.php");
	insert_msg("$MesgForAdd","","","1",$chl['user'],"",$chl['room']);


	if ($h_energymax-$chl[energy_now]>=$for_add) mysql_query("update players set energy_now=energy_now+$for_add where id='$chl[id]'");
	else mysql_query("update players set ustal_now=$h_energymax where id='$chl[id]'");

	$nms="������ ������������ ������� ������� \"+$for_add\" ��������� \"$chl[user]\"";

	$alldone=1;
}

?>