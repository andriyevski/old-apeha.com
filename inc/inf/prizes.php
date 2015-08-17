<?

$pr=mysql_query("SELECT objects.inf, prizes.poster, prizes.text, prizes.who, prizes.tribe FROM objects, prizes WHERE prizes.user='".$info['user']."' AND objects.id=prizes.id order by prizes.id desc");

$pr_c=mysql_num_rows($pr);

for ($i=0; $i<$pr_c; $i++) {
	$prize=mysql_fetch_array($pr);

	$prize['inf']=explode("|",$prize['inf']);

	echo "<IMG SRC='i/items/".$prize['inf']['0'].".gif' onmouseover=\"hint('".$prize['text']."<BR>От: <b>";

	switch ($prize['who']) {
		case user:         $poster=$prize['poster']; break;
		case tribe:         $poster="</b>Клан <IMG SRC=\'i/klan/".$prize['tribe'].".gif\' WIDTH=12 HEIGHT=12><B>".$prize['tribe']."</B><B>"; break;
		case anonim: $poster="<i>Аноним</i>"; break;
	}

	echo $poster;

	echo"</b>');\" onmouseout=\"c();\">";

	if ($i+1 != $pr_c) echo" ";

}
?>