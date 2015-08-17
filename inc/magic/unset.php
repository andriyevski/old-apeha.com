<?
$gol = mysql_fetch_array(mysql_query("select * from slots where slots.1=0 and slots.2=0 and slots.3=0 and slots.4=0 and slots.5=0 and slots.6=0 and slots.7=0 and slots.8=0 and slots.9=0 and slots.10=0 and slots.11=0 and slots.12=0 and slots.13=0 and slots.14=0 and slots.15=0 and slots.16=0 and slots.17=0 and slots.18=0 and slots.19=0 and id='".$chl['id']."'"));
if ($chl['lpv'] > 400) $nms="Персонаж <U>$login</U> отсутствует!";
elseif (!$chl['battle']) $nms="Персонаж не находится в поединке!";
elseif ($chl['hp_now'] == 0 && $chl['battle']) $nms="Зачем вам голый труп?!";
elseif ($chl['user'] == $stat['user'])   $nms="Раздеть себя вы не сможите, т.к. вы сильно заняты поединком!";
elseif ($gol) $nms="Персонаж и так раздетый!";
else {
	$_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp`, SUM(objects.`energy`) as `energy`, SUM(objects.`strength`) as `strength`, SUM(objects.`dex`) as `dex`, SUM(objects.`agility`) as `agility`, SUM(objects.`vitality`) as `vitality`, SUM(objects.`power`) as `power`, SUM(objects.`razum`) as `razum`, SUM(objects.`br1`) as `br1`, SUM(objects.`br2`) as `br2`, SUM(objects.`br3`) as `br3`, SUM(objects.`br4`) as `br4`, SUM(objects.`br5`) as `br5`, SUM(objects.`krit`) as `krit`, SUM(objects.`unkrit`) as `unkrit`, SUM(objects.`uv`) as `uv`, SUM(objects.`unuv`) as `unuv`, SUM(objects.`min_d`) as `min_d`, SUM(objects.`max_d`) as `max_d` FROM slots, objects WHERE slots.id='".$chl['id']."' AND objects.user='".$chl['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));
	mysql_query("UPDATE slots SET slots.1=0, slots.2=0, slots.3=0, slots.4=0, slots.5=0, slots.6=0, slots.7=0, slots.8=0, slots.9=0, slots.10=0, slots.11=0, slots.12=0, slots.13=0, slots.14=0, slots.15=0, slots.16=0, slots.17=0, slots.18=0, slots.19=0 WHERE  id='".$chl['id']."'");

	$prt=mysql_fetch_array(mysql_query("SELECT side AS side, time AS time FROM participants WHERE time=".$chl['battle']." AND id=".$chl['id'].""));

	$b_id_id=mysql_fetch_array(mysql_query("SELECT MAX(id) as id FROM battles WHERE offer=".$prt['time'].""));
	$b_id_id['id']+=1;

	mysql_query("UPDATE players SET hp_now=$chl[hp_now]-".$_obj['hp']." WHERE id='".$chl['id']."'");
	mysql_query("UPDATE participants SET hp=$chl[hp_now]-".$_obj['hp']." WHERE time='".$chl['battle']."' AND id='".$chl['id']."'");

	mysql_query("INSERT INTO battles (offer, time, id, attacker, defender, kick, block, type, damage, comment) values (".$prt['time'].", ".$now.", ".$b_id_id['id'].", '', '', '', '', NULL, '', '<b>$chl[user]</b> Попытался увернуться, но ловкий <b>$stat[user]</b> поймал его и раздел, потом начал атаковать еще сильнее!')");


	require_once("inc/chat/functions.php");
	insert_msg("Взбисившийся <b><u>".$stat['user']."</u></b> раздел вас и начал еще сильнее атаковать Вас!","","","1",$chl['user'],"",$chl['room']);
	$nms="Вы с лёгкостью его раздели!";
	include("inc/magic/drop.php");
	$alldone=1;
}
?>