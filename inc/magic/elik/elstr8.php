<?
if ($stat['user'] != "$chl[user]") $nms="Зелья можно пить только самому себе!";
elseif ($stat['elik_time'] > $now) $nms="Вы не можете пить более одного зелья сразу!";
else {
	$el_str=8;
	$el_ag=0;
	$el_dex=0;
	$el_vit=0;
	$el_raz=0;
	$el_bat=0;
	$el_pow=0;
	$el_time=$now+3600;
	$nms="Вы выпили зелье!И ваша сила увеличилась на +8 и будет такой еще 1 час!";
	require_once("function/chat_insert.php");
	insert_msg("Вы выпили зелье!И ваша сила увеличилась на +8 и будет такой еще 1 час!","","","1",$stat['user'],"",$stat['room']);
	include("includes/magic/elik_save.php");
	include("includes/magic/drop.php");
	$alldone=1;
}
?>