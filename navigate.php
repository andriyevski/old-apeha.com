<?
$random=time();
include("inc/db_connect.php");
include("inc/html_header.php");
$stat = mysql_fetch_array(mysql_query("select * from players where user='$user' and pass='$pass'"));
if (empty ($stat[id])) {
	print "Неверный пароль.";
	exit;
}
$ab=mysql_numrows(mysql_query("SELECT * FROM abils where user='$stat[user]'"));
if ($ab>0) $abils="<br><br><img src='".$img_server."/i/navigate/abils.gif' border=0 onclick='parent.main.location=\"main.php?set=abils&tmp=\"+Math.random();\"\"' style=\"CURSOR: Hand\" alt='Абилити' width=30 height=30>";

if ($stat[rank]=="100" or $stat[rank]=="99" or $stat[rank]=="10" or $stat[rank]=="11" or $stat[rank]=="12" or $stat[rank]=="13" or $stat[rank]=="14" or $stat[rank]=="15") $guard="<br><br><img src='".$img_server."i/navigate/guard.gif' border=0 onclick='parent.main.location=\"iow/guard.php?tmp=\"+Math.random();\"\"' style=\"CURSOR: Hand\" alt='Страж' width=30 height=30>";
if ($stat['admin'] == 1) $admin="<br><br><img src='".$img_server."i/navigate/admin.gif' border=0 onclick='parent.main.location = \"iow/admin.php?tmp=\"+Math.random();\"\";' style=\"CURSOR: Hand\" alt='Администратор' width=30 height=30>";
if ($stat['tribe'] != "0" && !empty($stat['tribe'])) $klan="<br><br><img src='i/navigate/clan.gif' border=0 onclick='parent.main.location=\"iow/main.php?set=clan&tmp=\"+Math.random();\"\"' style=\"CURSOR: Hand\" alt='Клан' width=30 height=30>";
if ($stat['level'] > 4) $transfer="<br><br><img src='".$img_server."i/navigate/transfer.gif' border=0 onclick='parent.main.location=\"iow/main.php?set=transfer&tmp=\"+Math.random();\"\"' style=\"CURSOR: Hand\" alt='Передача предметов, золота' width=30 height=30>";
print"
<body leftmargin=0 topmargin=0 bgcolor=e2e0e0>
<table width=100% cellspacing=0 cellpadding=3 height=100% background='i/_main.gif'>
<tr>
<td align=center valign=center><img src='i/navigate/world.gif' border=0 onclick='parent.main.location=\"../main.php?set=building&tmp=\"+Math.random();\"\"' style=\"CURSOR: Hand\" alt='Стройка' width=30 height=30><br><br><img src='i/navigate/exit.gif' border=0 onclick=\"if (confirm('Вы действительно хотите выйти из игры?')) parent.location='../index.php?action=logout'\" style=\"CURSOR: Hand\" alt='Выход' width=30 height=30><br><br><img src='i/navigate/world.gif' border=0 onclick='parent.main.location=\"../main.php?set=map&tmp=\"+Math.random();\"\"'
style=\"CURSOR: Hand\" alt='Карта города' width=30 height=30><br><br><img src='i/navigate/settings.gif' border=0 onclick='parent.main.location=\"iow/main.php?set=edit&tmp=\"+Math.random();\"\"' style=\"CURSOR: Hand\" alt='Настройки' width=30 height=30>$transfer<br><br><img src='i/navigate/fight.gif' border=0 onclick='parent.main.location=\"../battle.php?tmp=\"+Math.random();\"\"' style=\"CURSOR: Hand\" alt='Поединки' width=30 height=30>$abils$guard$klan$admin</td>

</tr>
</table>
";

?>
