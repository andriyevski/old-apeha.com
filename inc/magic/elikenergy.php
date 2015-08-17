<?
$for_add = 200;

if ($chl['user'] != $stat['user']) $nms="Только вы можете пить данное зелье.";
if ($chl['energy_now'] >= $stat['energy_max']) $nms="Вы не нуждаетесь в мане!";
else {

	if ($chl['energy_now'] + $for_add >= $stat['energy_max']) 	// Дабавлено новое условие при котором выводится
	{						// сколько именно хп востановил персонаж
		$energy_query=$stat['energy_max'];			// и какой свиток именно заюзал
		$energyplus=$stat['energy_max']-$chl['energy_now'];	//
	}						//
	else 						//
	{						//
		$energy_query=$chl['energy_now']+$for_add;	//
		$energyplus=$for_add;
	}

	$stat['energy_now'] = $energy_query;

	mysql_query("update person set energy_now=".$energy_query." where id='".$chl['id']."'");

	$iteminfo=mysql_fetch_array(mysql_query("SELECT name, title FROM items where name='".$iteminfo['name']."'")); //пришлось еще разок заселектить чтобы можно было выводить title свитка

	$nms="Вы использовали ".$iteminfo['title']."...<br>Уровень энергии персонажа <u>".$chl['user']."</u> восстановлен на <u>+$energyplus ед.</u>";

	$MesgForAdd = "Вы использовали ".$iteminfo['title']."... Удачно восстановлен Ваш уровень маны: <b><u>+$energyplus ед.</u></b>";

	include("includes/magic/drop.php");

	require_once("function/chat_insert.php");

	insert_msg("$MesgForAdd","","","1",$chl['user'],"","0");

	$alldone=1;
}

?>