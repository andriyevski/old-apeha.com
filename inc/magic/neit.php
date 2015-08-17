<?

if ($stat['user'] != "$chl[user]") $nms="ƒанное заклинание можно наложить только на себ€!";
elseif ($stat['sclon'] == 'neutral') $nms="¬ы и так нейтральны!";
else {
	mysql_query("UPDATE person SET sclon='neutral' WHERE id='".$stat['id']."'");
	$nms="¬сЄ прошло удачно...<br>¬ы стали нейтральным!";

	$iteminfo=mysql_fetch_array(mysql_query("SELECT name, title FROM items where name='".$iteminfo['name']."'")); //пришлось еще разок заселектить чтобы можно было выводить title свитка

	$MesgForAdd = "¬ы использовали ".$iteminfo['title']." и встали на нейтральный путь жизни.</b>";
	include("includes/magic/drop.php");

	require_once("function/chat_insert.php");

	insert_msg("$MesgForAdd","","","1",$chl['user'],"",$chl['room']);
	$alldone=1;
}

?>