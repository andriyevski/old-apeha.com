<?

if ($stat['user'] != "$chl[user]") $nms="Данное заклинание можно наложить только на себя!";
elseif ($stat['invisible'] > $now) $nms="Данное заклинание было использовано ранее и ещё действует на Вас!";
else {
	mysql_query("UPDATE players SET invisible=$now+3600 WHERE id='".$stat['id']."'");
	$nms="Всё прошло удачно...<br>Тень окутала Вас!";
	$alldone=1;
}

?>