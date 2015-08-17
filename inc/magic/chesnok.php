<?

if ($iteminfo['name'] == "chesnok") {$for_add = 10800; $energy = 0;}
elseif ($iteminfo['name'] == "chesnok2") {$for_add = 43200; $energy = 0;}

if ($stat['energy_now'] < $energy) $nms="У вас не хватает маны!";
elseif ($chl['ch_time'] > $now) $nms="На персонаже уже стоит защита от вампиров!";
else
{

	mysql_query("update person set ch_time=$now+$for_add where user='".$chl['user']."'");
	mysql_query("update person set energy_now=energy_now-$energy where id='".$stat['id']."'");

	$nms="Вы наложили защиту от вампиров на персонажа <u>".$chl['user']."</u>";
	$iteminfo=mysql_fetch_array(mysql_query("SELECT name, title FROM items where name='".$iteminfo['name']."'")); //пришлось еще разок заселектить чтобы можно было выводить title свитка
	if ($stat[user]!="$chl[user]") $MesgForAdd = "Персонаж <b><u>$stat[user]</u></b> наложил на вас защиту от вампиров</b>";
	else $MesgForAdd = "Вы использовали ".$iteminfo['title']."... Вы наложили на себя защиу от вампиров";
	include("includes/magic/drop.php");

	require_once("function/chat_insert.php");
	insert_msg("$MesgForAdd","","","1",$chl[user],"","0");

	$alldone=1;
}
?>