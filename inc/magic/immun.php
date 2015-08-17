<?

if ($stat['ustal_now'] < 10) $nms="” вас не хватает маны!";
elseif ($chl['immun'] > $now) $nms="Ќа персонаже уже стоит защита от нападени€!";
else
{

	mysql_query("update players set immun=$now+10800 where user='".$chl['user']."'");
	mysql_query("update players set ustal_now=ustal_now-10 where id='".$stat['id']."'");

	$nms="¬ы наложили защиту от нападени€ на персонажа <u>".$chl['user']."</u>";
	$iteminfo=mysql_fetch_array(mysql_query("SELECT name, title FROM items where name='".$iteminfo['name']."'")); //пришлось еще разок заселектить чтобы можно было выводить title свитка
	if ($stat[user]!="$chl[user]") $MesgForAdd = "ѕерсонаж <b><u>$stat[user]</u></b> наложил на вас защиту от нападени€</b>";
	else $MesgForAdd = "¬ы удачно использовали ".$iteminfo['title']."... ";
	include("inc/magic/drop.php");

	require_once("inc/chat/functions.php");

	insert_msg("$MesgForAdd","","","1",$chl['user'],"",$chl['room']);

	$alldone=1;
}
?>