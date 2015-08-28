<?

include('inc/db_connect.php');

// Разбиваем на страницы
$np=5; // Число новостей на странице
$numo = mysql_numrows(mysql_query("SELECT * FROM news"));
$pages_count = @ceil($numo/$np);
if (is_numeric($p)) {
	if ($p>$pages_count) $p=1;
	if ($p=="" or $p=="0") { $p="1"; }
	elseif ($p!="1") { $min=$np; }} else $p=1;
	$l1=$p*$np-$np;
	$l2=$np;
	$pages = "";
	for($i=1; $i<=$pages_count; $i++){
		if ($p != $i) $pages .= " <a href=?p=".$i.">[".$i."]</a>";
		else $pages .= " <b>[$i]</b>"; }
		//
		$new=mysql_query("SELECT * FROM news ORDER BY id DESC limit ".$l1.",".$l2."");
		while($data = mysql_fetch_array($new)){
			$text=$data["text"];
			$text=stripslashes($text);
			$tema=$data["tema"];
			$date=$data["data"];
			$avtor=$data["user"];
			$id=$data["id"];
			$avt = mysql_fetch_array(mysql_query("select * from players where user='".$avtor."'"));
			echo"

<tr><td style='padding:3px;'>
<div class='eTitle' style='text-align:left;margin: 10px 0 0px 11px;'>$tema</div>
<div class='eMessage' style='text-align:left;clear:both;padding-top:2px;padding-bottom:2px;margin-left: 11px;'>$text</div>
<div class='eDetails' style='clear:both;'>Добавил: <b><a href='inf.php?login=$avtor' target='_blank'>$avtor</a></b> | Дата: <b>$date</b></div>
</td></tr></table><br>";
		}
		if (!empty($pages)) echo "<div align='center'>Страницы: ".$pages."</div>";
		?>