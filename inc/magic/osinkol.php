<?
$energy = 20;

if ($stat['user'] == $chl['user']) $nms="Вы не можете атаковать сами себя!";
elseif ($chl['battle']) $nms="Персонаж находится в бою";
elseif ($chl['hp_now'] == 0) $nms="Извините но это не ЖИВАЯ ВОДА, мертвому она никчему";
elseif ($stat['energy_now'] <= $energy) $nms="У вас не хватает маны!";
elseif ($chl['sclon'] != 'dark') $nms="Вы можете атаковать только вампира!";
else{

	$MesgForAdd = "Персонаж <b><u>$stat[user]</u></b> вонзил в вас осиновый кол... Вы потеряли все свои жизни...";

	include("includes/magic/drop.php");

	require_once("function/chat_insert.php");
	insert_msg("$MesgForAdd","","","1",$chl['user'],"",$chl['room']);

	mysql_query("update person set hp_now=0 where id='".$chl['id']."'");
	mysql_query("update person set energy_now=energy_now-$energy where id='".$stat['id']."'");

	if ($chl['battle'])
	mysql_query("update participants set hp=".$hp_query." where id='".$chl['id']."'");


	$nms="Свиток прочитан ...<br>Вампира <u>".$chl['user']."</u> пронзил осиновый кол и он умер.";

	$alldone=1;
}

?>
