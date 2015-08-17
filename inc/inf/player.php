<?
function new_letter($login,$text) {
	$psel = mysql_query("SELECT * FROM `players` WHERE `user` = '$login' ");
	$pl = mysql_fetch_array($psel);
	$sql ="INSERT INTO pochta(user,whom,text,subject) VALUES ('Инстинкты воина','$login','$text','Системное сообщение')";
	$result = mysql_query($sql);
	insert_msg("<b>Получено новое сообщение!</b>","","","1",$login,"",$pl['room']);

}

function show_player($login) {

	include ('inc/sclon.php');

	$psel = mysql_query("SELECT * FROM `players` WHERE `user` = '$login' ");
	$pl = mysql_fetch_array($psel);
	$login=$pl["user"];
	$sclon=$pl["sclon"];
	$klan=$pl["tribe"];
	$level=$pl["level"];
	$ras=$pl["rase"];
	$battle=$pl["battle"];
	$side=$pl["side"];
	$guild=$pl["guild"];
	$vip=$pl["vips"];
	$align_alt=$sclonn[$sclon];

	if ($vip == "1") {$viper = "<img src=i/pic/vip.gif width=24 height=12 alt='VIP персона ИВ'>";}
	if ($guild != "") {$guildia = "<img src=i/ico/$guild.gif width=15 height=15 border=0 alt='Журналист'>";}
	else {$guildia = "";}
	if ($pl['battle']) {
		if ($pl[side] == 0 ) {$fight="<img src=i/ico/battle.gif width=12 height=12 border=0>";}
		else {$fight="<img src=i/ico/battle1.gif width=12 height=12 border=0>";}
	}
	else {$fight="";}

	if ($klan != "" ) {
		$clan="<A HREF='clan_inf.php?clan=$klan' target=_blank><IMG SRC='i/klan/$klan.gif' WIDTH=24 HEIGHT=15 BORDER=0 ALT='Клан $klan'></A>"; }
		else {$clan="";};

		print"
<IMG SRC='i/align$sclon.gif' BORDER=0  width=15 height=15 alt='$align_alt'>$clan $guildia $viper<b> $login </b>[$level] <img src='i/klan/$ras.gif' width=12 height=12 border=0> <a href='inf.php?login=$login' target=_blank><IMG SRC='i/inf.gif' BORDER=0 ALT='Информация о $login' width=12 height=12></a> $fight <br>
";

}

//***************************************************//

function show_player_p($login) {

	include ('inc/sclon.php');

	$psel = mysql_query("SELECT * FROM `players` WHERE `user` = '$login' ");
	$pl = mysql_fetch_array($psel);
	$login=$pl["user"];
	$sclon=$pl["sclon"];
	$klan=$pl["tribe"];
	$level=$pl["level"];
	$ras=$pl["rase"];
	$battle=$pl["battle"];
	$side=$pl["side"];
	$guild=$pl["guild"];
	$vip=$pl["vip"];
	$align_alt=$sclonn[$sclon];

	if ($vip == "1") {$viper = "<img src=i/pic/vip.gif width=24 height=12 alt='VIP персона ИВ'>";}
	if ($guild != "") {$guildia = "<img src=i/ico/$guild.gif width=15 height=15 border=0 alt='Журналист'>";}
	else {$guildia = "";}
	if ($pl['battle']) {
		if ($pl[side] == 0 ) {$fight="<img src=i/ico/battle.gif width=12 height=12 border=0>";}
		else {$fight="<img src=i/ico/battle1.gif width=12 height=12 border=0>";}
	}
	else {$fight="";}

	if ($klan != "" ) {
		$clan="<A HREF='clan_inf.php?clan=$klan' target=_blank><IMG SRC='i/klan/$klan.gif' WIDTH=24 HEIGHT=15 BORDER=0 ALT='Клан $klan'></A>"; }
		else {$clan="";};

		print"
<a href='javascript:top.pp(\"$login\")'>
<IMG SRC='i/private.gif' BORDER=0 ALT='Приватно' width=12 height=15>
</a>
<IMG SRC='i/align$sclon.gif' BORDER=0  width=15 height=15 alt='$align_alt'>$clan $guildia $viper<b><a href='javascript:top.to(\"$login\")'>$login</a> </b>[$level] <img src='i/klan/$ras.gif' width=12 height=12 border=0> <a href='inf.php?login=$login' target=_blank><IMG SRC='i/inf.gif' BORDER=0 ALT='Информация о $login' width=12 height=12></a> $fight <br>
";

}

function show_player_f($login) {

	include ('inc/sclon.php');

	$psel = mysql_query("SELECT * FROM `players` WHERE `user` = '$login' ");
	$pl = mysql_fetch_array($psel);
	$login=$pl["user"];
	$sclon=$pl["sclon"];
	$klan=$pl["tribe"];
	$level=$pl["level"];
	$ras=$pl["rase"];
	$battle=$pl["battle"];
	$side=$pl["side"];
	$guild=$pl["guild"];
	$vip=$pl["vip"];
	$align_alt=$sclonn[$sclon];

	if ($vip == "1") {$viper = "<img src=i/pic/vip.gif width=24 height=12 alt='VIP персона ИВ'>";}
	if ($guild != "") {$guildia = "<img src=i/ico/$guild.gif width=15 height=15 border=0 alt='Журналист'>";}
	else {$guildia = "";}
	if ($pl['battle']) {
		if ($pl[side] == 0 ) {$fight="<img src=i/ico/battle.gif width=12 height=12 border=0>";}
		else {$fight="<img src=i/ico/battle1.gif width=12 height=12 border=0>";}
	}
	else {$fight="";}

	if ($klan != "" ) {
		$clan="<A HREF='clan_inf.php?clan=$klan' target=_blank><IMG SRC='i/klan/$klan.gif' WIDTH=24 HEIGHT=15 BORDER=0 ALT='Клан $klan'></A>"; }
		else {$clan="";};

		print"
<IMG SRC='i/align$sclon.gif' BORDER=0  width=15 height=15 alt='$align_alt'>$clan $guildia $viper<b> $login </b>[$level] <img src='i/klan/$ras.gif' width=12 height=12 border=0> <a href='inf.php?login=$login' target=_blank><IMG SRC='i/inf.gif' BORDER=0 ALT='Информация о $login' width=12 height=12></a> $fight 
";

}
?>