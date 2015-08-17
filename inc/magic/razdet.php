<?
$energy = 20;

if ($stat['energy_now'] < $energy) $nms="У вас не хватает маны!";
else{

	mysql_query("UPDATE slots SET slots.1=0, slots.2=0, slots.3=0, slots.4=0, slots.5=0, slots.6=0, slots.7=0, slots.8=0, slots.9=0, slots.10=0, slots.11=0, slots.12=0, slots.13=0, slots.14=0, slots.15=0, slots.16=0, slots.17=0, slots.18=0, slots.19=0, slots.20=0, slots.21=0, slots.22=0  WHERE  id='".$chl['id']."'");
	mysql_query("update person set energy_now=energy_now-$energy where id='".$stat['id']."'");

	if ($stat[user]!="$chl[user]") $MesgForAdd = "Вас раздел маг <b><u>$stat[user]</u></b>";
	else $MesgForAdd = "Вы раздели сами себя. Теперь сражайтесь голым!!!";

	include("includes/magic/drop.php");

	require_once("function/chat_insert.php");
	insert_msg("$MesgForAdd","","","1",$chl[user],"","0");

	$nms="Свиток магии прочитан. Персонаж <b><u>$chl[user]</u></b> теперь голый!";

	$alldone=1;
}

?>
