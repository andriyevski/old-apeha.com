<?
if ($stat['user'] != "$chl[user]") $nms="Зелья можно пить только самому себе!";
elseif ($stat['elik_time'] > $now) $nms="Вы не можете пить более одного зелья сразу!";
else {
	$el_str=0;
	$el_ag=6;
	$el_dex=0;
	$el_vit=0;
	$el_raz=0;
	$el_bat=0;
	$el_pow=0;
	$el_time=$now+7200;
	$nms="Вы выпили зелье!И ваша ловкость увеличилась на +6 и будет такой еще 2 часа!";
	require_once("function/chat_insert.php");
	insert_msg("Вы выпили зелье!И ваша ловкость увеличилась на +6 и будет такой еще 2 часа!","","","1",$stat['user'],"",$stat['room']);
	include("includes/magic/elik_save.php");
	include("includes/magic/drop.php");
	$alldone=1;
}
?>