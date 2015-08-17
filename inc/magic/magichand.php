<?
$chl_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp` FROM slots, objects WHERE slots.id='".$chl['id']."' AND objects.user='".$chl['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));

$chl['hp']+=$chl_obj['hp'];
$h_hpmax=$chl['vitality']*5+$chl['hp'];

$damage = $stat['energy_now'] * 2;

if ($stat['user'] == $chl['user']) $nms="Магия не может быть обращена против мага";
elseif ($chl['hp_now'] == 0 && $chl['battle']) $nms="Извините но это не ЖИВАЯ ВОДА, мертвому она никчему";
elseif ($stat['energy_now'] == 0) $nms="У вас нет маны!";

else {

	if ($chl['hp_now'] - $damage <= 0){
		$hp_query=0;
		$hpplus=$chl['hp_now'];}
		else{
			$hp_query=$chl['hp_now']-$damage;
			$hpplus=$damage;}

			$MesgForAdd = "Маг <b><u>$stat[user]</u></b> использовал против вас свою ману... Нанесён урон <b><u>-$hpplus НР</u></b>";

			include("includes/magic/drop.php");

			require_once("function/chat_insert.php");
			insert_msg("$MesgForAdd","","","1",$chl['user'],"",$chl['room']);


			if ($stat['user'] == $chl['user'] && $stat['battle'] == NULL) $stat['hp_now'] = $hp_query;

			mysql_query("update person set hp_now=".$hp_query." where id='".$chl['id']."'");
			mysql_query("update person set energy_now=0 where id='".$stat['id']."'");

			if ($chl['battle'])
			mysql_query("update participants set hp=".$hp_query." where id='".$chl['id']."'");


			$nms="Свиток магии прочитан ...<br>В персонажа <u>".$chl['user']."</u> ударила энергия мага и он получил повреждение <u>-$hpplus HP</u>";

			$alldone=1;
}

?>
