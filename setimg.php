<?
include("inc/db_connect.php");

$stat = mysql_fetch_array(mysql_query("SELECT * FROM players WHERE user='".addslashes($user)."' AND pass='".addslashes($pass)."'"));

if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

$now = time();


if ($stat['battle']) { header("Location: battle.php"); exit; }
//

else {


	if ($setimg!="") {

		if ($stat['credits'] >= 300) { // Хватает бабок
			mysql_query("UPDATE players set obraz='$setimg' where id=$stat[id]");
			mysql_query("UPDATE players set credits=credits-300 where id=$stat[id]");
			$msg="Образ куплен!";

		} else $msg="Недостаточно золота!";

	}



	echo"<center>Добро пожаловать в отдел выбора образа! Стоимость образа - <b>300 зм</b>.</center><BR><table width=100% cellspacing=0 cellpadding=0 border=0 bgcolor=F5FFD9>";
	for ($g=1; $g<25; $g++) {
		if (!($g%5))echo "<tr>";
		echo"
<td >$g<img src='i/img/$g.gif' onclick=\"if (confirm('Купить это образ?')) window.location='setimg.php?otdel=3&setimg=$g'\" style='CURSOR: Hand'></a></td>

";
	}


	for ($g=25; $g<50; $g++) {
		if (!($g%5))echo "<tr>";
		echo"
<td >$g<img src='i/img/$g.gif' onclick=\"if (confirm('Купить это образ?')) window.location='setimg.php?otdel=3&setimg=$g'\" style='CURSOR: Hand'></a></td>

";
	}



	for ($g=50; $g<75; $g++) {
		if (!($g%5))echo "<tr>";
		echo"
<td >$g<img src='i/img/$g.gif' onclick=\"if (confirm('Купить это образ?')) window.location='setimg.php?otdel=3&setimg=$g'\" style='CURSOR: Hand'></a></td>

";
	}

	for ($g=75; $g<88; $g++) {
		if (!($g%5))echo "<tr>";
		echo"
<td >$g<img src='i/img/$g.gif' onclick=\"if (confirm('Купить это образ?')) window.location='setimg.php?otdel=3&setimg=$g'\" style='CURSOR: Hand'></a></td>

";
	}



}
?>
<BODY
	bgcolor=EBEDEC leftmargin=0 topmargin=0
	background='i/backgrounds/reception.jpg'
	style='background-attachment: fixed;'>