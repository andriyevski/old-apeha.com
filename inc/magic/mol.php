<?

if ($stat['ustal_now'] < 5) $nms="У вас не хватает маны!";
elseif ($chl['m_time']> $now) $nms="На персонажа наложенно заклинание тишины!";
elseif ($chl['rank'] >= 10) $nms="Инквизиция обладает иммунитетом от заклятия тишины!";
else
{
	include("inc/magic/drop.php");

	mysql_query("update players set m_time=$now+600 where user='".$chl['user']."'");
	mysql_query("update players set ustal_now=ustal_now-5 where id='".$stat['id']."'");
	$nms="Вы наложили запрет на общение в чате на персонажа <u>".$chl['user']."</u>";

	$alldone=1;
}
?>