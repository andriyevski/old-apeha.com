<?

if ($stat['energy_now'] < 10) $nms="” вас не хватает маны!";
elseif ($chl['ma_time'] > $now) $nms="Ќа персонаже уже стоит защита от магического нападени€!";
else
{

	mysql_query("update person set ma_time=$now+3600 where user='".$chl['user']."'");
	mysql_query("update person set energy_now=energy_now-10 where id='".$stat['id']."'");

	$nms="¬ы наложили защиту от магического нападени€ на персонажа <u>".$chl['user']."</u>";
	$iteminfo=mysql_fetch_array(mysql_query("SELECT name, title FROM items where name='".$iteminfo['name']."'")); //пришлось еще разок заселектить чтобы можно было выводить title свитка
	if ($stat[user]!="$chl[user]") $MesgForAdd = "ѕерсонаж <b><u>$stat[user]</u></b> наложил на вас защиту от магического нападени€</b>";
	else $MesgForAdd = "¬ы использовали ".$iteminfo['title']."... ¬ы наложили на себ€ защиу от магического нападени€";
	include("includes/magic/drop.php");

	require_once("function/chat_insert.php");
	insert_msg("$MesgForAdd","","","1",$chl[user],"","0");

	$alldone=1;
}
?>