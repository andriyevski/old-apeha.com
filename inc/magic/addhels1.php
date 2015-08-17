<?

$chl_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp` FROM slots, objects WHERE slots.id='".$chl['id']."' AND objects.user='".$chl['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19,slots.20,slots.21,slots.22) LIMIT 1"));

$hp_max = $stat['vitality']*5;

if ($chl['hp_now'] >= $hp_max) $nms="Персонаж \"".$chl['user']."\" не нуждается в зарядке!";

else {
		
	$helsplus=$hels_max-$chl['hp_now'];

	if ($stat['user'] == $chl['user'] && $stat['battle'] == NULL) $stat['hp_now'] = $hp_max;

	mysql_query("update person set hp_now=".$hp_now."+100 where id='".$chl['id']."'");

	$iteminfo=mysql_fetch_array(mysql_query("SELECT name, title FROM items where name='".$iteminfo['name']."'")); //пришлось еще разок заселектить чтобы можно было выводить title свитка

	if ($stat[user]!="$chl[user]") $MesgForAdd = "Персонаж <b><u>$stat[user]</u></b> восстановил Вам уровень жизни: <b><u>+100</u></b>HP.";
	else $MesgForAdd = "Вы использовали ".$iteminfo['title']."... Удачно восстановлен Ваш уровень жизни: <b><u>+100</u></b>HP.";
	include("includes/magic/drop.php");

	require_once("function/chat_insert.php");
	insert_msg("$MesgForAdd","","","1",$chl[user],"","0");

	$alldone=1;
}

?>