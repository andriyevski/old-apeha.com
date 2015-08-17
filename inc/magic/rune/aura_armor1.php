<?
if ($chl['aura_t'] > $now) $nms="ѕерсонаж может находитс€ под действием только одной ауры!";
if ($stat['energy_now'] < 20) $nms="Ќедостаточно маны, необходимо 20 MP";
else {

	$aura_time=$now+ceil(14400*(1+$chl['sp_12']/100));

	mysql_query("UPDATE `person` SET `aura`='1', `aura_t`='$aura_time' WHERE `user`='".$chl['user']."'");
	mysql_query("update person set energy_now=energy_now-20 where id='".$stat['id']."'");

	require_once("function/chat_insert.php");
	insert_msg("Ќа вас была наложена аура магической брони 1 уровн€!","","","1",$chl['user'],"",$chl['room']);
	$nms="¬ы наложили на персонажа ауру магической брони!";

	include("includes/magic/drop.php");
	$alldone=1;
}
?>