<?
if ($iteminfo['name'] == "addhp100") $for_add = 100;
elseif ($iteminfo['name'] == "addhp200") $for_add = 200;
elseif ($iteminfo['name'] == "addhp300") $for_add = 300;
elseif ($iteminfo['name'] == "addhp400") $for_add = 400;
elseif ($iteminfo['name'] == "addhp500") $for_add = 500;

$chl_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp`, SUM(objects.`energy`) as `energy`, SUM(objects.`strength`) as `strength`, SUM(objects.`dex`) as `dex`, SUM(objects.`agility`) as `agility`, SUM(objects.`vitality`) as `vitality`, SUM(objects.`razum`) as `razum`, SUM(objects.`br1`) as `br1`, SUM(objects.`br2`) as `br2`, SUM(objects.`br3`) as `br3`, SUM(objects.`br4`) as `br4`, SUM(objects.`br5`) as `br5`, SUM(objects.`krit`) as `krit`, SUM(objects.`unkrit`) as `unkrit`, SUM(objects.`uv`) as `uv`, SUM(objects.`unuv`) as `unuv`, SUM(objects.`min_d`) as `min_d`, SUM(objects.`max_d`) as `max_d` FROM slots, objects WHERE slots.id='".$stat['id']."' AND objects.user='".$stat['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));

$ChlSkills = explode("|",$chl['rase_skill']);
$chl['gnom']=$ChlSkills['3']*5;

$chl['hp']+=$chl_obj['hp'];
$h_hpmax=ceil(($chl['vitality']*5+$chl['hp'])*(1+($chl['gnom']/100)));



if ($chl['lpv'] > 600) $nms="Персонаж \"".$chl['user']."\" отстутствует!";
elseif ($chl['hp_now'] >= $h_hpmax) $nms="Персонаж \"".$chl['user']."\" не нуждается в лечении!";
elseif ($chl['hp_now'] == 0 && $chl['battle']) $nms="Мёртвому поможет только больница...";

// ----- # Рапределяем кому и что можно # ----- //

// ----- # +100 HP && +200 HP # ----- //
elseif (($for_add == 100 || $for_add == 200 || $for_add == 300 || $for_add == 400 || $for_add == 500) && ($stat['user'] != $chl['user'] && $stat['proff'] != 1)) $nms="Восстановление уровня жизни другим персонажам под силу только <u>лекарям</u>!";
elseif (($for_add == 100 || $for_add == 200 || $for_add == 300 || $for_add == 400 || $for_add == 500) && ($stat['proff'] == 1 && $stat['battle'] != $chl['battle'])) $nms="Для восстановление жизни персонажу Вам необходимо находиться в одном бою ним!";

else {

	if ($stat[user]!="$chl[user]") $MesgForAdd = "Персонаж <b><u>$stat[user]</u></b> восстановил Вам уровень жизни: <b><u>+$for_add НР</u></b>";
	else $MesgForAdd = "Вы удачно восстановили Ваш уровень жизни: <b><u>+$for_add НР</u></b>";

	include("inc/magic/drop.php");

	require_once("inc/chat/functions.php");
	insert_msg("$MesgForAdd","","","1",$chl['user'],"",$chl['room']);

	if ($chl['hp_now'] + $for_add >= $h_hpmax) $hp_query=$h_hpmax;
	else $hp_query=$chl['hp_now']+$for_add;

	if ($stat['user'] == $chl['user'] && $stat['battle'] == NULL) $stat['hp_now'] = $hp_query;

	mysql_query("update players set cure_hp='0', hp_now=".$hp_query." where id='".$chl['id']."'");

	if ($chl['battle']) mysql_query("update participants set hp=".$hp_query." where id='".$chl['id']."'");

	$nms="Всё прошло удачно...<br>Уровень жизни бойца <u>".$chl['user']."</u> восстановлен на <u>+$for_add HP</u>";

	$alldone=1;
}

?>