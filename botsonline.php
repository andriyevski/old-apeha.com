<?php

$num=0;
$ctime=time();
include("inc/db_connect.php");
include("inc/html_header.php");

$stat = mysql_fetch_array(mysql_query("SELECT `id`, `user`, `tribe`, `room`, `chat_mode`,`bloked` FROM `players` WHERE `user` = '".$user."' AND `pass` = '".$pass."' LIMIT 1"));
if (empty($stat['id']) || $stat['bloked']) {
	echo"<script>top.window.location = 'index.php?action=logout';</script>";
	exit;
}




include ('inc/aligns.php');


if ((empty($stat['room']) || !isset($stat['room'])) && $bstat['room'] <> 0) $stat['room']=1;
$psel = mysql_query("SELECT p.*, if (c.user is null,0,1) ignore_him FROM players p left join chatignore c on (c.login='".addslashes($stat['user'])."' and (c.user=p.user)) where p.room = '".$stat['room']."' AND (p.rank = '60') ORDER BY p.level");
print "<br></center>
<table cellspacing=0 cellpadding=3 border=1 bordercolor=CCCCCC WIDTH=100%>

<tr><td nowrap>";

$chatmodepics = array (
1  => "i/online1.gif",
2  => "i/online2.gif",
4  => "i/online3.gif",
8  => "i/online4.gif");

while ($pl = mysql_fetch_array($psel)) {
	if ($pl['invisible'] > $ctime) {
		echo"<IMG SRC=".$chatmodepics[1]." width=15> <IMG SRC='i/private_0.gif' BORDER=0 ALT='' width=22 height=15> <IMG SRC='i/align/align0.gif' BORDER=0 ALT='".$alignstr[0]."' width=15 height=15><a href=\"javascript:top.to('Тень')\"><font color=gray><i>Тень</i></font></a> [99] <a href=\"inf.php?99\" target=_blank><IMG SRC=\"i/inf.gif\" BORDER=0 ALT=\"Информация о Тени\" width=11 height=11></a><BR>";
	} else {
		if (($pl['rank']==60) || ($pl['user']==$stat['user'])) $pl['ignore_him']=0; // Can't ignore BOTS or myself
		if ($pl['tribe']!="0" && $pl['tribe']!="") $klan="<A HREF='clan_inf.php?clan=".$pl['tribe']."' target=_blank><IMG SRC='i/klan/".$pl['tribe'].".gif' WIDTH=12 HEIGHT=12 BORDER=0 ALT='Клан ".$pl['tribe']."'></A>"; else $klan="";

		echo"<IMG SRC=".$chatmodepics[$pl['chat_mode']]." width=15> ".$private." <IMG SRC='i/align/align".$pl['rank'].".gif' BORDER=0 ALT='".$alignstr[$pl['rank']]."' width=15 height=15>".$klan."<a href=\"javascript:top.to('".$pl['user']."')\">";
		if ($pl['ignore_him']==1) $userbuf="<FONT COLOR=#B0B0B0>".$pl['user']."</FONT>"; else $userbuf=$pl['user'];
		if ($pl['battle'] && $pl['rank']!=60) echo"<S>".$userbuf."</S>"; else echo $userbuf;
		echo"</a> [".$pl['level']."] <a href=\"inf.php?".$pl['id']."\" target=_blank><IMG SRC=\"i/inf.gif\" BORDER=0 ALT=\"Информация о ".$pl['user']."\" width=11 height=11></a>";
		if (($pl['rank']==60) || ($pl['user']==$stat['user'])) {
			echo"<BR>";
		} else {
			if ($pl['ignore_him']==0) {
				echo" <A href='?hash=".md5($pl['user'])."&add_ignore=".$pl['user']."' ><IMG SRC='i/add_ignore.gif' alt='Добавить в список игнорируемых' border=0 width=11 height=11></A><BR>";
			} else {
				echo" <A href='?hash=".md5($pl['user'])."&remove_ignore=".$pl['user']."' ><IMG SRC='i/remove_ignore.gif' alt='Удалить из списка игнорируемых' border=0 width=11 height=11></A><BR>";
			}
		}
	}
	$num++;
}

$s1=""; $s2=""; $s3="";$s4="";
if ($stat['chat_mode']==1) $s1=" selected";
elseif ($stat['chat_mode']==2) $s2=" selected";
elseif ($stat['chat_mode']==4) $s3=" selected";
elseif ($stat['chat_mode']==8) $s4=" selected";

print "</td></tr>

</select></td></tr>
</table>";
?>
