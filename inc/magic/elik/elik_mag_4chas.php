<?
if ($stat['user'] != "$chl[user]") $nms="Зелья можно пить только самому себе!";
elseif ($stat['elik_time'] > $now) $nms="Вы не можете пить более одного зелья сразу!";
else {
	$el_str=-2;
	$el_ag=-2;
	$el_dex=-2;
	$el_vit=-2;
	$el_raz=4;
	$el_bat=0;
	$el_pow=4;
	$el_time=$now+14400;
	require_once("function/chat_insert.php");
	insert_msg("Вы выпили зелье!И ваш разум и энергия увеличились на +4 за счет других параметров и будут такими еще 4 часа!","","","1",$stat['user'],"",$stat['room']);
	$nms="Вы выпили зелье!И разум и энергия увеличились на +4 за счет других параметров и будут такими еще 4 часа!";
	include("includes/magic/elik_save.php");
	include("includes/magic/drop.php");
	$alldone=1;
}
?>