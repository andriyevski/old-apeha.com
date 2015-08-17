<?
echo"<table width=100% border=0 cellspacing=0 cellpadding=3>
<tr>";

// First Reiting
echo"<table align=center cellspacing=0 cellpadding=3 bordercolor=CCCCCC border=1 width=400 bgcolor=e2e2e2>
<tr bgcolor=F2F2F2>
   <td width='5'>Место</td>
   <td align=center>Название клана</td>
   <td align=center>Число бойцов</td>
   <td align=center>Онлайн</td>
   <td align=center>Ранг клана</td>
   <td align=center>Очки</td>
</tr>";

$rt=mysql_query("SELECT * FROM top order by `rfs` desc") or die("Ошибка запроса1");
$n=0;
while ($reit = mysql_fetch_array($rt)) { $n+=1;
$result = mysql_query("SELECT id FROM players WHERE tribe='$reit[clan]' ") or die("Ошибка запроса2");
$result1 = mysql_num_rows($result);

echo"<tr"; if ($als) echo" bgcolor=F2F2F2"; echo">
<TD align=\"center\">".$n."</TD>
<TD><img src='i/klan/".$reit[clan].".gif' >&nbsp;<A href=\"info_clan.php?name=$reit[clan]&mode=logo\" target=\"_blank\"><B>".$reit[clan]."</B></A></TD>
<TD align=center>".$result1."</TD>
<TD align=\"center\">".mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `lpv` > '".(time()-180)."' and  rank!=60 AND `tribe`='$reit[clan]'"))."</TD>
<TD align=\"center\">".$reit[hosts]."</TD>
<TD align=\"center\">".$reit[rfs]."</TD>
</TR>
<TR>"; 
if (!$als) $als=1; else $als=0;
}

unset($rt,$reit,$n);
echo"
</TR>
</TABLE>";
?>