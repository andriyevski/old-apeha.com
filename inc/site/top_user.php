<?
$n=0;
$inf=mysql_query("SELECT user,wins FROM players where rank!=60 AND rank!=61 AND admin=0 order by wins desc limit 0,30");
echo"
<body bgcolor=FCFAF3 >
<table align=center cellspacing=0 cellpadding=3  border=1  bgcolor=F6F6F6 width=300>
<tr bgcolor=504F4C>
     <td width=25><b><font color=white>Место</font></b></td>
     <td width=100><b><font color=white>Логин</font></b></td>
     <td width=25><b><font color=white>Победы</font></b></td>
</tr>";


for ($i=0; $i<mysql_num_rows($inf); $i++) {
	$l=mysql_fetch_array($inf);
	$n+=1;
	echo"<tr"; if ($als) echo" bgcolor=F2F0F0"; echo">
     <td width=25><b>".$n."</b></td>
     <td width=100><b><A href=\"inf.php?login=$l[user]\" target=\"_blank\"><B>".$l[user]."</B></A></b></td>
     <td width=25><b>".$l[wins]."</b></td>
</tr>";

	if (!$als) $als=1; else $als=0;
}
echo"</table>";

?>