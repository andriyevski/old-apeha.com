<?php
$now=time();

include("inc/db_connect.php");

$battle = mysql_query("select user, battle from players where battle IS NOT NULL");

while($battle_=mysql_fetch_array($battle)){
	$offer=mysql_fetch_array(mysql_query("SELECT `timeout` FROM offers WHERE time='".$battle_['battle']."' LIMIT 1"));
	$max=mysql_fetch_array(mysql_query("SELECT attacker, defender, time FROM battles WHERE offer='".$battle_['battle']."' ORDER BY time DESC LIMIT 1"));
	$timeout=($offer['timeout']+600)-($now-$max['time']);
	if ($timeout<=0){
		if($battle_['user']==$max['defender'])
		$st="losses=losses+1";
		elseif($battle_['user']==$max['attacker'])
		$st="wins=wins+1";
		else
		$st="drawn=drawn+1";
		mysql_query("update players set ".$st.", battle=NULL, last_battle='".$battle_['user']."' WHERE user='".$battle_['user']."'");
		//mysql_query("DELETE FROM offers WHERE time='".$battle_['battle']."'");
		//echo $battle_['user']." - $st<br>";
	}
}
?>