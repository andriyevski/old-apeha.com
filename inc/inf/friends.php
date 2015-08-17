<?

include("inc/inf/player.php");
print"Друзья:&nbsp;";
$S = mysql_query("SELECT * FROM `friends` WHERE `user`='$info[user]'");
while($DAT = mysql_fetch_array($S)){
	$friend=$DAT['friend'];

	show_player_f($friend,$img_server);
}
echo"<br><BR>";
print"В друзьях у:&nbsp;";
$S1 = mysql_query("SELECT * FROM `friends` WHERE `friend`='$info[user]'");
while($DAT1 = mysql_fetch_array($S1)){
	$friend1=$DAT1['user'];

	show_player_f($friend1,$img_server);
}
echo"</TD>

</TR>

</TABLE>";
?>