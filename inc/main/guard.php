<?
require_once("inc/module.php");
if (empty($stat['id']) || $stat['bloked']) {
	echo"<script>top.window.location = 'index.php?action=logout';</script>";
	exit;
}

echo"
<body bgcolor=#EBEDEC leftmargin=0 topmargin=0>
<div id=hint1 class=hint></div>

<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/time.js\"></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/show_inf.js\"></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/login_form.js\"></SCRIPT>
";

include("inc/main/changed.php");
$widthhp=$stat['hp_now']/$stat['hp_max']*181;
if ($widthhp==0) $widthhp+=2;
if ($widthhp==1) $widthhp+=1;
if ($widthhp>1) $widthhp-=1;

print"<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<TD width=1>&nbsp;</TD>
<td width=600 valign=top>


<TABLE cellspacing=0 cellpadding=0>
<tr>

<TD valign=top>
<SCRIPT language=JavaScript>
show_inf('$stat[user]','$stat[id]','$stat[level]','$stat[rank]','$stat[tribe]');
</SCRIPT>
</TD>

<TD WIDTH=10>&nbsp;</TD>

<TD valign=top>
<table cellspacing=0 cellpadding=0 border=0 align=center height=12>
<tr>
<td width=200 title='Уровень жизни: $stat[hp_now]/$stat[hp_max]' align=left valign=bottom width=200><img src=i/vault/navigation/hp/_helth.gif width='10' height=10 border=0 alt='Уровень жизни: $stat[hp_now]/$stat[hp_max]'><img src=i/vault/navigation/hp/helth.gif height='10' width='$widthhp' border=0 alt='Уровень жизни: $stat[hp_now]/$stat[hp_max]'><img src=i/vault/navigation/hp/_helth_.gif width='10' height=10 border=0 alt='Уровень жизни: $stat[hp_now]/$stat[hp_max]'></td>
</tr>
</table>
</TD>

<TD WIDTH=5>&nbsp;</TD>

<TD valign=top><FONT COLOR=RED><B>$stat[hp_now] / $stat[hp_max]</B></FONT></TD>

</TR>
</TABLE>

</td>

<td align=right valign=top>
<input class=lbut type=button value='Обновить' onclick='window.location.href=\"guard.php?tmp=\"+Math.random();\"\"'>
<input class=lbut type=button value='Вернуться' onclick='window.location.href=\"main.php?tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";


if (($stat['rank']>=10 && $stat['rank']<=14) || $stat['rank']>=98) {

	include('inc/guard/functions.php');

	print"<script language=JavaScript>var rank='".$stat['rank']."';</script>";
	print"<script src='i/forms.js'></script>";

	echo"

        <table width=100% cellspacing=0 cellpadding=3 border=0>
        <tr>
        <td align=right>
        <center><font class=title><U>Орден Инквизиции</U></font></center><br>

        <fieldset style='WIDTH: 98.6%'><legend>Орден Инквизиции</legend>
        <table width=100% cellspacing=0 cellpadding=5>
        <tr>
        <td align=center>";

	if (!empty($msg)) echo"<center><font color=red><b>".$msg."</b></font></center><br>";

	echo"<table cellspacing=0 cellpadding=0 border=0 width=100%>
        <tr>";

	echo"
        <TD width=50% align=center valign=top>

        <div id=form>".$msgs."</div>

        <table cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1 width=100%>
        <tr>
        <td align=center>

        <b>Управление</b><HR color=silver>";

	include("inc/guard/".$stat['rank'].".php");

	echo"</td>
        </tr>
        </table>
        </td>";


	echo"<td align=center valign=top>";

	//Берем состав
	$SostQuery=mysql_query("SELECT user, id, level, rank, lpv FROM players WHERE (rank>=10 && rank<=14) || rank>=99 ORDER BY rank DESC");

	echo"<table cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1 width=98%>";

	echo"<SCRIPT language=JavaScript>
        function s (user,id,level,rank,status) {
        if (status == 0)
                status='<img src=\'i/offline.gif\' alt=\'OffLine\' width=15>';
        else
                status='<img src=\'i/online.gif\' alt=\'OnLine\' width=15>';

        document.write('<TR><TD width=20 align=center>'+status+'</TD><td><a href=\"javascript:top.pp(\''+user+'\')\"><img src=\'i/private.gif\' border=0 alt=\'Приватное сообщение\'></a> <img src=\'i/align'+rank+'.gif\'><a href=\"javascript:top.to(\''+user+'\')\"><b>'+user+'</b></a> ['+level+'] <a href=\'inf.php?'+id+'\' target=_blank border=0><img src=\'i/inf.gif\'></a></TD></TR>');

        }
        ";

	for ($j=0; $j<mysql_num_rows($SostQuery); $j++) {
		$sostav=mysql_fetch_array($SostQuery);

		if (time() - $sostav['lpv'] > 180)
		$status = 0;
		else
		$status = 1;
		echo"s('".$sostav['user']."','".$sostav['id']."','".$sostav['level']."','".$sostav['rank']."','".$status."');";
	}

	echo"
        </script>
        </table>";


	echo"</td>


</tr>
</table>

</td>
</tr>
</table>
</fieldset>
<BR><BR>

</td>
</tr>
</table>
";


}
else
echo"<center><b><font color=red>Вы не состоите в Ордене Инквизиции!</font></b></center>";

include('inc/f_display.php');
?>