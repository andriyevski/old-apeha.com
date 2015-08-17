<?
$stat_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp` FROM slots, objects WHERE slots.id='".$stat['id']."' AND objects.user='".$stat['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19,slots.20,slots.21,slots.22) LIMIT 1"));
$stat['hp']+=$stat_obj['hp'];
$h_hpmax=$stat['vitality']*5+$stat['hp'];

if ($stat['user'] == $chl['user']) $nms="Вы не можете атаковать сами себя!";
elseif ($chl['hp_now'] <= 5) $nms="Вы не можете высосать жизненую силу. Персонаж \"".$chl['user']."\" на грани смерти!";
elseif ($stat['energy_now'] < 15) $nms="У вас не хватает маны!";
elseif ($chl['rank'] == 60) $nms="На ботов не действует!";
elseif ($chl['hp_now'] == 0 && $chl['battle']) $nms="Мёртвому поможет только больница...";
elseif ($stat['battle'] != $chl['battle']) $nms="Для использования боевой магии надо находиться в одном бою с персонажем!";
else {

	$hp = $chl['hp_now'];
	$for_add = intval($hp/2);

	if ($stat['hp_now'] + $for_add >= $h_hpmax) 	// Дабавлено новое условие при котором выводится
	{						// сколько именно хп востановил персонаж
		$hp_query=$h_hpmax;			// и какой свиток именно заюзал
		$hpplus=$h_hpmax-$stat['hp_now'];	//
	}						//
	else 						//
	{						//
		$hp_query=$stat['hp_now']+$for_add;	//
		$hpplus=$for_add;
	}

	mysql_query("update person set hp_now=".$hp_query." where id='".$stat['id']."'");
	mysql_query("update person set energy_now=energy_now-15 where id='".$stat['id']."'");
	mysql_query("update person set hp_now=$for_add where id='".$chl['id']."'");

	if ($stat['battle']) mysql_query("update participants set hp=$for_add where id='".$chl['id']."'");
	if ($chl['battle']) mysql_query("update participants set hp=".$hp_query." where id='".$stat['id']."'");

	$iteminfo=mysql_fetch_array(mysql_query("SELECT name, title FROM items where name='".$iteminfo['name']."'")); //пришлось еще разок заселектить чтобы можно было выводить title свитка

	$nms="Вы использовали ".$iteminfo['title']."...<br>Вы высосали <u>$for_add HP</u> жизненной энергии из персонажа <u>".$chl['user']."</u> и пополнили свою жизненную энергию на <u>$hpplus HP</u>";

	$MesgForAdd = "Персонаж <b><u>$stat[user]</u></b> забрал жизненную энергию из персонажа: <u>".$chl['user']."</u>";

	include("includes/magic/drop.php");

	require_once("function/chat_insert.php");

	insert_msg("$MesgForAdd","","","1",$chl['user'],"",$chl['room']);

	$alldone=1;
}

?>