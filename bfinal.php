<?php
session_start();
include("inc/db_connect.php");
include("inc/html_header.php");

if (!preg_match("/^[0-9]{2,10}$/", $_GET['log'])) die("Ошибка");

$stat = mysql_fetch_array(mysql_query("SELECT user from players where user='".addslashes($_SESSION['user'])."' and pass='".addslashes($_SESSION['pass'])."'"));



echo"<body background='/i/bg2.gif' topmargin=5>
<div id=hint1></div>
<script language=JavaScript src='i/show_inf.js'></script>";

if ($log!="") {

	$max=mysql_fetch_array(mysql_query('select id from battles where offer='.addslashes($log).' order by id desc limit 1'));

	//echo 'maxid = '.$max['id'].'<br>';

	$last_turns=mysql_query("select id, time, attacker, defender, comment1,comment2, type from battles where offer='".addslashes($log)."' AND (comment1 IS NOT NULL OR comment2 IS NOT NULL) AND id>".($max['id']-2)." ORDER BY id ASC, time ASC");

	//echo"<CENTER><font style='FONT-SIZE: 11pt; FONT-WEIGHT: Bold'>Время начала поединка: <u>".date("d.m.y H:i",$log-600)."</u></font> </CENTER><HR COLOR=e2e0e0>";

	echo '<center><input type=button value=\'Вернуться\' onclick=\'disabled = true; window.location.href="main.php?tmp='.rand(0,10000000).'"\' class=input></center><table width=700 align=center border=0 cellspasing=5 cellpadding=5 >';
	if ($last_turns)

	for ($i=0; $i<mysql_num_rows($last_turns); $i++) {

		$turn=mysql_fetch_array($last_turns);
if($r!=$turn[id])echo "<tr background='/i/bg2.gif'><td><b>Раунд $turn[id]</b></td></tr>";
$r=$turn[id];
		if($turn['type']!=2){echo $d="<b>";
		if ($turn['attacker']=="$stat[user]" || $turn['defender']=="$stat[user]") $d.="<a style='color: #007000; background-color: #00FFAA'>".date("H:i",$turn[time])."</a>";
		else $d.=date("H:i",$turn[time]);
		$d.='</b></b> ';}else $d=' ';
		if($turn[id]%2)$bg='bg3';else$bg='bg4';
		
		if(strlen($turn['comment2'])>0)echo '<tr><td background=\'/i/'.$bg.'.gif\'>'.$d.$turn['comment2']."</td></tr>";
		if(strlen($turn['comment1'])>0)echo '<tr><td background=\'/i/'.$bg.'.gif\'>'.$d.$turn['comment1']."</td></tr>";
		
		
		if ($turn['id'] == $l_id || !$turn['type']) echo"";

		$l_id = $turn['id'];

	}

	echo"";

	// Построение комманд
	$_comm=mysql_query("select
        participants.side, participants.hp as hp, players.user as `user` from participants, players where
        players.id=participants.id and participants.time=".addslashes($log)."");

	for ($i=0; $i<mysql_numrows($_comm); $i++) {
		$comm=mysql_fetch_array($_comm);

		switch ($comm[side]) {
			case 0: $command[left][]="$comm[user]"; $command[left_hp][]="$comm[hp]"; break;
			case 1: $command[right][]="$comm[user]"; $command[right_hp][]="$comm[hp]"; break;
		}}
		//

		if (!$command[left][0] || !$command[right][0]) echo"";
		else {
			echo "<tr><td background='/i/bg.gif'>";
			// Список команд
			for ($i=0; $i<count($command[left]); $i++) {
				mysql_query("update players set battle=0, last_battle='".addslashes($log)."' where user='".$command[left][$i]."'");
				echo "<font color=".(($command['left_hp'][$i]==0)?'red':'CFA87A')."><b>".$command[left][$i]."</b></font> <SMALL>[ ".(($command[left_hp][$i]<0)?0:$command[left_hp][$i])." ]</SMALL>";
				if ($i+1<count($command[left])) echo", "; }

				echo" <b>против</b> ";

				for ($i=0; $i<count($command[right]); $i++) {
				mysql_query("update players set battle=0, last_battle='".addslashes($log)."' where user='".$command[right][$i]."'");
					echo "<font color=".(($command['right_hp'][$i]==0)?'red':'0000CD')."><b>".$command[right][$i]."</b></font> <SMALL>[ ".(($command[right_hp][$i]<0)?0:$command[right_hp][$i])." ]</SMALL>";
					if ($i+1<count($command[right])) echo", "; }
					//

					echo"</td></tr></table>";
		}







		//  echo"<center><input type=button class=input value='Обновить' onclick=\"window.location='bfinal.php?log=$log'\"></center>";


} else if ($login!="") {
	echo "Список боёв персонажа $login:";
	$logs=mysql_query("SELECT distinct(offer) FROM battles where (attacker=\"".addslashes($login)."\") or (defender=\"".addslashes($login)."\")");
	if ($logs)
	while ($inf=mysql_fetch_array($logs)) {
		echo "<a href=\"bfinal.php?log=$inf[offer]\">".date("d.m.Y H:i",$inf[offer])."</a><br>";
	}
} else {
	echo"<form method=post action=bfinal.php>";
	echo"<input type=\"text\" name=\"login\" onBlur=\"if (value == '') {value='Логин'}\" onFocus=\"if (value == 'Логин') {value =''}\" value=\"Логин\" style='BACKGROUND-COLOR: CCCCCC'>";
	echo"</form>";
}

echo"</body>";
?>
