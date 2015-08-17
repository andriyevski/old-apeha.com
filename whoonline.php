<?php

$title="[Список OnLine]";
$num=0;
$ctime=time();
include("inc/db_connect.php");
include("inc/html_header.php");




$stat = mysql_fetch_array(mysql_query("SELECT `id`, `user`, `room`, `chat_mode` FROM `players` WHERE `user` = '".$_SESSION['user']."' AND `pass` = '".$_SESSION['pass']."' LIMIT 1"));



include ('inc/rooms.php');
include ('inc/aligns.php');


if ((empty($stat['room']) || !isset($stat['room'])) && $bstat['room'] <> 0) $stat['room']=1;
$psel = mysql_query("SELECT p.*, if (c.user is null,0,1) ignore_him FROM players p left join chatignore c on (c.login='".addslashes($stat['user'])."' and (c.user=p.user)) where p.room >= '1' AND p.room <= '10000' AND (p.lpv > ".(time()-180)." OR p.rank = '60') ORDER BY p.rank");
print "<br></center>
<table cellspacing=0 cellpadding=3 border=1 bordercolor=CCCCCC WIDTH=100%>
<tr><td bgcolor=\"e2e0e0\" align=center><b>всего OnLine:</b></font> <b>".mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `lpv` > '".(time()-60)."' "))."</a></b></FONT></td></tr>
<tr><td>";




while ($pl = mysql_fetch_array($psel)) {
	if ($pl['invisible'] > $ctime) {
		echo"<IMG SRC=".$chatmodepics[1]." width=15> <IMG SRC='i/private_0.gif' BORDER=0 ALT='' width=22 height=15> <IMG SRC='i/align/align0.gif' BORDER=0 ALT='".$alignstr[0]."' width=15 height=15><a href=\"javascript:top.to('Тень')\"><font color=gray><i>Тень</i></font></a> [99] <a href=\"inf.php?99\" target=_blank><IMG SRC=\"i/inf.gif\" BORDER=0 ALT=\"Информация о Тени\" width=11 height=11></a><BR>";
	} else {
		if (($pl['rank']==60) || ($pl['user']==$stat['user'])) $pl['ignore_him']=0; // Can't ignore BOTS or myself
		if ($pl['tribe']!="0" && $pl['tribe']!="") $klan="<A HREF='encicl.php?view=tribes&name=".$pl['tribe']."' target=_blank><IMG SRC='i/klan/".$pl['tribe'].".gif' WIDTH=15 HEIGHT=15 BORDER=0 ALT='Клан ".$pl['tribe']."'></A>"; else $klan="";

		echo"
                
	
	<IMG SRC='i/align/align".$pl['rank'].".gif' BORDER=0 ALT='".$alignstr[$pl['rank']]."' width=15 height=15>".$klan."<a href=\"javascript:top.to('".$pl['user']."')\">";
		if ($pl['ignore_him']==1) $userbuf="<FONT COLOR=#B0B0B0>".$pl['user']."</FONT>"; else $userbuf=$pl['user'];
		if ($pl['battle'] && $pl['rank']!=60) echo"<S>".$userbuf."</S>"; else echo $userbuf;
		echo"</a> [".$pl['level']."] <a href=\"inf.php?".$pl['id']."\" target=_blank><IMG SRC=\"i/inf.gif\" BORDER=0 ALT=\"Информация о ".$pl['user']."\" width=11 height=11></a>".$roomname[$pl['room']]."";
		if (($pl['rank']==60) || ($pl['user']==$stat['user'])) {
			echo"<BR>";
		} else {
			if ($pl['ignore_him']==0) {
				echo"<BR>";
			} else {
				echo"<BR>";
			}
		}
	}
	$num++;
}

print "
</table>";

?>