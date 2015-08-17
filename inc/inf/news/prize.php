

<?

echo"
  <tr>
    <td width='18' height='58'><img border='0' src='i/inf_101.gif' width='18' height='58'></td>
    <td height='58' background='i/inf_102.gif' align='center'>
    
    	<table width='168' height='58' border='0' cellpadding='0' cellspacing='0'>
	<tr>
		<td>
			<img src='i/inf_top_01.gif' width='36' height='31' alt=''></td>
		<td>
			<img src='i/inf_top_02.gif' width='96' height='31' alt=''></td>
		<td>
			<img src='i/inf_top_03.gif' width='36' height='31' alt=''></td>
	</tr>
	<tr>
		<td>
			<img src='i/inf_top_04.gif' width='36' height='16' alt=''></td>
		<td background='i/inf_top_05.gif' align='center'>
			<font size='1' color='#ffffff' face='Verdana'><b>Подарки</b></font></td>
		<td>
			<img src='i/inf_top_06.gif' width='36' height='16' alt=''></td>
	</tr>
	<tr>
		<td>
			<img src='i/inf_top_07.gif' width='36' height='11' alt=''></td>
		<td>
			<img src='i/inf_top_08.gif' width='96' height='11' alt=''></td>
		<td>
			<img src='i/inf_top_09.gif' width='36' height='11' alt=''></td>
	</tr>
</table>
    
    
    
    </td>
    <td width='18' height='58'>
    <img border='0' src='i/inf_103.gif' width='18' height='58'></td>
  </tr>
  <tr>
    <td width='18' height='100%' background='i/inf_201.gif'>&nbsp;</td>
    <td height='100%' background='i/inf_000.gif' align='center'>
";

$pr=mysql_query("SELECT objects.inf, prizes.poster, prizes.text, prizes.who, prizes.tribe FROM objects, prizes WHERE prizes.user='".$info['user']."' AND objects.id=prizes.id order by prizes.id desc");

for ($i=0; $i<mysql_num_rows($pr); $i++) {
	$prize=mysql_fetch_array($pr);




	$prize['inf']=explode("|",$prize['inf']);

	echo "<IMG SRC='i/items/".$prize['inf']['0'].".gif' WIDTH=65 HEIGHT=65 onmouseover=\"hint('".$prize['text']."<BR>От: <b>";

	switch ($prize['who']) {
		case user:         $poster=$prize['poster']; break;
		case tribe:         $poster="</b>Клан <IMG SRC=\'i/klan/".$prize['tribe'].".gif\' WIDTH=12 HEIGHT=12><B>".$prize['tribe']."</B><B>"; break;
		case anonim: $poster="<i>Аноним</i>"; break;
	}

	echo $poster;

	echo"</b>');\" onmouseout=\"c();\">";

	if ($i+1 != $pr_c) echo" ";




}

echo"
    </td>
    <td width='18' height='100%' background='i/inf_203.gif'>&nbsp;</td>
  </tr>
  <tr>
    <td width='18' height='19'>
    <img border='0' src='i/inf_301.gif' width='18' height='19'></td>
    <td height='19' background='i/inf_302.gif'>&nbsp;</td>
    <td width='18' height='19'>
    <img border='0' src='i/inf_303.gif' width='18' height='19'></td></tr>
";
?>

