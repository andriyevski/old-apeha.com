<?
if ($stat['user'] != "$chl[user]") $nms="Зелья можно пить только самому себе!";
elseif ($stat['elik_lovkost'] > $now) $nms="Данное зелье ещё действует на Вас!";
else {
	mysql_query("UPDATE players SET elik_lovkost=$now+10800,elik_kl=10 WHERE id='".$stat['id']."'");
	require_once("inc/chat/functions.php");
	insert_msg("Вы выпили зелье! И ваша ловкость увеличилась на +10 и будет такой еще 3 часа!","","","1",$stat['user'],"",$stat['room']);
	$nms="Вы выпили зелье! И ваша ловкость увеличилась на +10 и будет такой еще 3 часа!";
	include("inc/magic/drop.php");
	$alldone=1;
}

?>