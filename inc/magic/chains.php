<?

if ($stat['user'] == "$chl[user]") $nms="Данное заклинание нельзя наложить на себя!";
elseif ($chl['battle']) $nms="Персонаж находиться в бою!";
elseif ($chl['t_time'] > $now) $nms="Персонаж и так в тюрьме!";
else {
	mysql_query("UPDATE person SET t_time=$now+900, reason='Донос на персонажа', battle=NULL, v_time=NULL, k_time=NULL, room='666' WHERE id='".$chl['id']."'");
	$nms="Всё прошло удачно...<br>Вы донесли на робота властям!";

	$iteminfo=mysql_fetch_array(mysql_query("SELECT name, title FROM items where name='".$iteminfo['name']."'")); //пришлось еще разок заселектить чтобы можно было выводить title свитка

	$MesgForAdd = "На вас поступил донос, и вы отправляетесь в тюрьму до выяснения всех обстоятелств.</b>";
	include("includes/magic/drop.php");

	require_once("function/chat_insert.php");

	insert_msg("$MesgForAdd","","","1",$chl['user'],"",$chl['room']);
	$alldone=1;
}

?>