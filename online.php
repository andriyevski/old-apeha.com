<?php


$title="Падшие Ангелы - [Список OnLine]";

$num=0;

$ctime=time();

include("inc/db_connect.php");

include("inc/html_header.php");
?><script>
 var who;
 function pr(who){
 parent.bottom.document.getElementById('msg').value='@'+who;
 }
 function fo(who){
 parent.bottom.document.getElementById('msg').value='#'+who;
 }
</script><?


$stat = mysql_fetch_array(mysql_query("SELECT `id`, `user`, `tribe`, `room`, `chat_mode`,`bloked` FROM `players` WHERE `user` = '".$user."' AND `pass` = '".$pass."' LIMIT 1"));



mysql_query("UPDATE `players` SET `lpv`='".time()."' WHERE `id` = '".$stat['id']."'");





if (empty($stat['id']) || $stat['bloked']) {

	echo"<script>top.window.location = 'index.php?action=logout';</script>";

	exit;

}



print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"300; URL=online.php?refresh=".$_GET['refresh']."&tmp=".time()."\">";





print "<body  style='background:#feeab9;' leftmargin=1 rightmargin=0 topmargin=0>";










//print"<br>

//<img src='i/chat/butt_3.gif' style='CURSOR: Hand' onclick='window.location=\"online.php?refresh=1";



//if ($_GET['refresh']>0) { $tit="Вкл"; print "0&tmp=".time().""; } else { print "\"+Math.random();\""; $tit="Выкл"; }



if (@$_POST['update_status']) {

	$update_status=$_POST['update_status'];

	if ($update_status==1 || $update_status==2 || $update_status==4 || $update_status==8) {

		mysql_query("UPDATE players set chat_mode='".$update_status."' where id='".$stat['id']."'");

		unset($stat);

		$stat = mysql_fetch_array(mysql_query("SELECT `id`, `user`, `room`, `chat_mode` FROM `players` WHERE `user` = '".$_SESSION['user']."' AND `pass` = '".$_SESSION['pass']."' LIMIT 1"));

	}

}



if (@$_GET['add_ignore']) {

	mysql_query("DELETE FROM chatignore where login='".addslashes($stat['user'])."' and user='".$_GET['add_ignore']."'");

	mysql_query("INSERT INTO chatignore (login,user) values ('".addslashes($stat['user'])."','".$_GET['add_ignore']."')");

}



if (@$_GET['remove_ignore']) {

	mysql_query("DELETE FROM chatignore where login='".addslashes($stat['user'])."' and user='".$_GET['remove_ignore']."'");

}



include ('inc/rooms.php');

include ('inc/aligns.php');

//print "\"' alt='Обновлять автоматически [".$tit."]'>";



if ((empty($stat['room']) || !isset($stat['room'])) && $bstat['room'] <> 0) $stat['room']=1;

$psel = mysql_query("SELECT p.*, if (c.user is null,0,1) ignore_him FROM players p left join chatignore c on (c.login='".addslashes($stat['user'])."' and (c.user=p.user)) where p.room = '".$stat['room']."' and p.rank != '60' AND (p.lpv > ".(time()-600).") ORDER BY p.user");

print "
<table width=100% cellpadding=0 cellspacing=0 style='position: fixed;  height: 10px;left: 0px; top: 0px; z-index: 100;opacity: 0.9;filter: alpha(Opacity=90);'><tr  height=\"15\" align=\"center\" valign=\"middle\" style=\"font-weight: bold; font-size: 12px;background:#666666; cursor:hand;\"><td style='border-right:solid 1px #ccc;' width=50% onclick='window.location=\"online.php?tmp=\"'>обновить</td><td width=50%  onClick=\"top.main.location.href='main.php?set=bots'\">боты</td></tr></table>
<table align=center cellspacing=0 cellpadding=0 border=0   WIDTH=100% height=90% style='padding: 15px 0px 0px 5px; background: #feeab9;'>

<tr><td style=' background: #feeab9;height:27px;' align=center valign=top>




<u>".$roomname[$stat['room']]."</u> <FONT COLOR=Green><b>[".mysql_num_rows($psel)."]</b></FONT></td></tr>

<tr><td valign=top nowrap style=' background: #feeab9; padding-top:5px'>";



$chatmodepics = array (

1  => "i/online1.gif",

2  => "i/online2.gif",

4  => "i/online3.gif",

8  => "i/online4.gif");



while ($pl = mysql_fetch_array($psel)) {

	if ($pl['invisible'] > $ctime) {

		echo"<IMG SRC=".$chatmodepics[1]." width=15> <IMG SRC='i/private_0.gif' BORDER=0 ALT='Приватно' width='10' height='10'><IMG SRC='i/align/align0.gif' BORDER=0 ALT='".$alignstr[0]."' width=15 height=15><a href=\"javascript:to('Тень')\"><font color=gray><i>Тень</i></font></a> [99] <a href=\"inf.php?99\" target=_blank><IMG SRC=\"i/inf.gif\" BORDER=0 ALT=\"Информация о Тени\" width=11 height=11></a><BR>";

	} else {

		if (($pl['rank']==60) || ($pl['user']==$stat['user'])) $pl['ignore_him']=0; // Can't ignore BOTS or myself

		if ($pl['tribe']!="0" && $pl['tribe']!="") $klan="<A HREF='info_clan.php?name=".$pl['tribe']."&mode=logo' target=_blank><IMG SRC='i/klan/".$pl['tribe'].".gif' BORDER=0 ALT='Клан ".$pl['tribe']."'></A>"; else $klan="";

		if ($pl['user']==$stat['user']) $private="<IMG SRC='i/private_0.gif' BORDER=0 ALT='' width=22 height=15>"; else $private="<a href=\"javascript:pr('".$pl['user']."')\"><IMG SRC=\"i/private.gif\" BORDER=0 ALT=\"Приватно\" ></a>";

		if($pl['skl']==2){$alt="Рыцарь тьмы";}else{$alt="Рыцарь света";}

		echo"<IMG SRC=".$chatmodepics[$pl['chat_mode']]." width=15> ".$private." <IMG SRC='i/kways".$pl['skl'].".gif' title='$alt' BORDER=0><IMG SRC='i/align/align".$pl['rank'].".gif' BORDER=0 ALT='".$alignstr[$pl['rank']]."' width=15 height=15>".$klan."<a href=\"#\" onclick=\"fo('".$pl['user']."');\">";



		if ($pl['ignore_him']==1) $userbuf="<FONT COLOR=#B0B0B0>".$pl['user']."</FONT>"; else $userbuf=$pl['user'];

		if ($pl['battle'] && $pl['rank']!=60) echo"<S>".$userbuf."</S>"; else echo $userbuf;

		echo"</a> [".$pl['level']."] <a href=\"inf.php?".$pl['id']."\" target=_blank><IMG SRC=\"i/inf.gif\" BORDER=0 ALT=\"Информация о ".$pl['user']."\" ></a>";

		if($pl['m_time']>time()){echo " <img src='i/sleep2.gif' title='Молчание: ".round(($pl['m_time']-time())/60)." минут'> ";}

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

<form method='post' action=''><tr><td align='center'  style=' background: #feeab9; height:30px'>

<select name='update_status' class=input>

<option value=1$s1>Онлайн</option>

<option value=2$s2>Ушел</option>

<option value=4$s3>N/A</option>

<option value=8$s4>Не беспокоить!</option>

</select><input type='submit' value='>>' class=input></td></tr></form>

<tr><td  style=' background: #feeab9;height:20px' align=center>Всего <font color=blue><a style='CURSOR: Hand' onclick='window.open(\"whoonline.php\",\"\",\"width=300,height=550, scrollbars=yes\")'><b>OnLine:</b></font> <b>".mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `lpv` > '".(time()-1200)."' OR `rank` = '60'"))."</a></b></td></tr>

</table>";

?>

