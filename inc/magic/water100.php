<?
if ($iteminfo['name'] == "water10") $for_add = 10;
elseif ($iteminfo['name'] == "water20") $for_add = 20;

$chl_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp` FROM slots, objects WHERE slots.id='".$chl['id']."' AND objects.user='".$chl['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));

$ChlSkills = explode("|",$stat['rase_skill']);
$chl['gnom']=$ChlSkills['3']*5;

$chl['hp']-=$chl_obj['hp'];
$h_hpmax=ceil(($chl['vitality']*5-$chl['hp'])*(1-($chl['gnom']/100)));



if ($chl['hp_now'] <= 0) $nms="Персонаж \"".$chl['user']."\" истощен!";
elseif ($chl['hp_now'] == 0 && $chl['battle']) $nms="Извините но это не ЖИВАЯ ВОДА, мертвому она никчему";
elseif ($stat['energy_now'] < 5) $nms="У вас не хватает маны!";
elseif ($stat['proff'] < 18) $nms="У вас нет профессии Маг!";
elseif ($stat['battle'] != $chl['battle']) $nms="Для чтения заклинания на персонажа Вам необходимо находиться в одном бою с ним!";
// ----- # Рапределяем кому и что можно # ----- //

// ----- # -10 HP && -20 HP # ----- //

elseif (($for_add == 10 || $for_add == 20) && ($stat['proff'] == 18 && $stat['battle'] != $chl['battle'])) $nms="Для чтения заклинания на персонажа Вам необходимо находиться в одном бою с ним!";

else {

	if ($stat[user]!="$chl[user]") $MesgForAdd = "Маг <b><u>$stat[user]</u></b> использовал против вас магию воды... Вода поглотила ваши жизни <b><u>-$for_add НР</u></b>";
	else $MesgForAdd = "Наверное вы недостаточно обучены магии... Вы прочитали книгу магии воды и захлебнулись  на: <b><u>-$for_add НР</u></b>";

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


	$nms="Книга магии воды прочитана ...<br>Персонажа <u>".$chl['user']."</u> ударила волна и он захлебнулся на <u>-$for_add HP</u>";

	$alldone=1;
}

?>