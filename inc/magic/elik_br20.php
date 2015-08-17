<?
if ($stat['user'] != "$chl[user]") $nms="Зелья можно пить только самому себе!";
elseif ($stat['elik_br'] > $now) $nms="Данное зелье ещё действует на Вас!";
else {
	mysql_query("UPDATE players SET elik_br=$now+10800,elik_kb=20 WHERE id='".$stat['id']."'");
	require_once("inc/chat/functions.php");
	insert_msg("Вы выпили зелье! И ваша броня увеличилась на +20 и будет такой еще 3 часа!","","","1",$stat['user'],"",$stat['room']);
	$nms="Вы выпили зелье! И ваша броня увеличилась на +20 и будет такой еще 3 часа!";
	include("inc/magic/drop.php");
	$alldone=1;
}

?>