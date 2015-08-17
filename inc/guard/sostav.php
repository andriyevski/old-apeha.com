<?

// Состав стражей
print"
<br>
<table width=100% cellspacing=0 cellpadding=3 border=1 bordercolor=A5A5A5 bgcolor=e2e0e0>
<tr><td align=center colspan=3><i>Стражи города</i></td></tr>";

$s=mysql_query("SELECT * FROM players WHERE (rank>=10 && rank<=14) || rank='98' || rank='99' ORDER BY rank DESC");

for ($i=0; $i<mysql_numrows($s); $i++) {
	$sostav=mysql_fetch_array($s);


	echo"<tr><td width=20 align=center>",$i+1,"</td><td width=250><a href=\"javascript:top.pp('$sostav[user]')\"><img src='i/private.gif'></a>
<script language=JavaScript>
show_inf('$sostav[user]','$sostav[id]','$sostav[level]','$sostav[rank]','$sostav[tribe]');
</script>
</td><td>$sostav[tribe_rank]";
	if (!$sostav[tribe_rank]) echo"&nbsp;";
	echo"</td></tr>";

}
print"</table>";
//

print"<br>";

?>