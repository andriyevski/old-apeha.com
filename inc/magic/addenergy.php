<?
if ($iteminfo[name]=="addenergy20") $for_add="20";
elseif ($iteminfo[name]=="addenergy40") $for_add="40";
elseif ($iteminfo[name]=="addenergy60") $for_add="60";
elseif ($iteminfo[name]=="addenergy100") $for_add="100";

$h_energymax=$chl[ustal]+$chl[vitality]*5; // Всего энергии

$span=$ctime-$chl[lpv];

if ($chl['lpv'] > 180) $nms="Персонаж \"".$chl['user']."\" отстутствует!";
if ($chl[ustal_now]>=$h_energymax) $nms="Персонаж \"$chl[user]\" не нуждается в востановлении!";
else {

	if ($stat[user]!="$chl[user]") $MesgForAdd = "Персонаж <b><u>$stat[user]</u></b> восстановил Вам уровень энергии: <b><u>+$for_add EP<u></b>";
	else $MesgForAdd = "Вы удачно восстановили Ваш уровень энергии: <b><u>+$for_add EP</u></b>";

	require_once("inc/chat/functions.php");
	insert_msg("$MesgForAdd","","","1",$chl['user'],"",$chl['room']);


	if ($h_energymax-$chl[energy_now]>=$for_add) mysql_query("update players set energy_now=energy_now+$for_add where id='$chl[id]'");
	else mysql_query("update players set ustal_now=$h_energymax where id='$chl[id]'");

	$nms="Удачно восстановили уровень энергии \"+$for_add\" персонажу \"$chl[user]\"";

	$alldone=1;
}

?>