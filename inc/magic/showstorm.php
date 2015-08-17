<?

$magic_Skills = explode("|",$stat['proff_exp']);
$addd=$magic_Skills['7']/2000;

if ($iteminfo['name'] == "showstorm20") {$for_add1 = 20+intval(20*$addd); $energy = 5;}
elseif ($iteminfo['name'] == "showstorm30") {$for_add1 = 30+intval(30*$addd); $energy = 10;}
elseif ($iteminfo['name'] == "showstorm40") {$for_add1 = 40+intval(40*$addd); $energy = 15;}

$chl_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp` FROM slots, objects WHERE slots.id='".$chl['id']."' AND objects.user='".$chl['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19,slots.20,slots.21,slots.22) LIMIT 1"));
$chl['hp']+=$chl_obj['hp'];
$h_hpmax=$chl['vitality']*5+$chl['hp'];



if ($stat['user'] == $chl['user']) $nms="Вы не можете атаковать сами себя!";
elseif ($chl['hp_now'] == 0 && $chl['battle']) $nms="Извините но это не ЖИВАЯ ВОДА, мертвому она никчему";
elseif ($stat['energy_now'] <= $energy) $nms="У вас не хватает маны!";

else {
	$damage_ruzum = rand(round($stat['razum']/1.5),round(1+$stat['razum']));
	$damage = rand(0,5);
	$for_add = $for_add1 + $damage + $damage_ruzum;
	if ($chl['hp_now'] - $for_add <= 0){
		$hp_query=0;
		$hpplus=$chl['hp_now'];}
		else{
			$hp_query=$chl['hp_now']-$for_add;
			$hpplus=$for_add;}

			if ($stat[user]!="$chl[user]") $MesgForAdd = "Маг <b><u>$stat[user]</u></b> использовал против вас ледяной шторм... Холод поглотил ваши жизни <b><u>-$hpplus НР<u></b>";
			else $MesgForAdd = "Наверное вы  недостаточно  обучены магии... Вы прочитали свиток и замёрзли  на ... : <b><u>-$hpplus НР</u></b>";

			include("includes/magic/drop.php");

			require_once("function/chat_insert.php");
			insert_msg("$MesgForAdd","","","1",$chl['user'],"",$chl['room']);


			if ($stat['user'] == $chl['user'] && $stat['battle'] == NULL) $stat['hp_now'] = $hp_query;

			mysql_query("update person set hp_now=".$hp_query." where id='".$chl['id']."'");
			mysql_query("update person set energy_now=energy_now-$energy where id='".$stat['id']."'");

			$nms="Свиток ледяного шторма прочитан ...<br>Персонажа <u>".$chl['user']."</u> ударила волна холода и он замёрз на <u>-$hpplus HP</u>";
			include("includes/magic/battle_functions.php");

			$m_s = 1;
			include("includes/magic/magicupdate.php");

			if ($chl['battle'])
			mysql_query("update participants set hp=".$hp_query." where id='".$chl['id']."'");

			$alldone=1;
}

?>
