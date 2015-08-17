<?

if (!empty($otdel)) {

	$shop=mysql_query("SELECT komis.*, objects.* FROM komis, objects where komis.otdel=".addslashes($otdel)." AND komis.id=objects.id AND objects.komis=1 ORDER BY komis.price");

	echo"<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=A5A5A5>";
	$chislo = mysql_num_rows($shop);
	if ($chislo > 0) {

		for($i=0; $i<mysql_num_rows($shop); $i++) {
			$objects=mysql_fetch_array($shop);

			$obj_inf=explode("|",$objects['inf']);
			$obj_min=explode("|",$objects['min']);
			$obj_add=explode("|",$objects['add']);
			include('inc/main/min_tr.php');
			include('inc/main/add.php');
			include('inc/main/classes.php');


			echo"
<div align='center' >
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
      <td width='30%' align='center'>
<img src='i/items/".$obj_inf['0'].".gif' alt='".$obj_inf['1']."'>
<br>";
			if ($stat['user'] == $objects['saller']) {
				echo"<span onclick=\"if (confirm('Снять с комиссии предмет &quot;".$obj_inf['1']."&quot;?')) window.location='?otdel=".$otdel."&unsale=".$objects['id']."'\" style='CURSOR: Hand'><b>Снять с комиссии</b></a>";
			} else {
				echo "<span onclick=\"if (confirm('Купить предмет &quot;".$obj_inf['1']."&quot;?')) window.location='?otdel=".$otdel."&buy=".$objects['id']."'\" style='CURSOR: Hand'><b>Купить</b></a></td>";
			}
			echo"</td><td width='70%'><small>
<b>".$obj_inf['1']."</b><br>
<u>Цена продавца: <b>".$objects['price']."</b> зм.</u><br>
Гос. цена: <b>".$obj_inf['2']."</b> зм.<br>
Долговечность предмета: <b>".$obj_inf['6']."</b>/<b>".$obj_inf['7']."</b><br>";

			if ($min_rase || $min_level || $min_str || $min_dex || $min_ag || $min_vit || $min_razum || $min_proff)
			echo"<br><b><i>Минимальные требования:</i></b><br>
			$min_rase$min_level$min_str$min_dex$min_ag$min_vit$min_razum$min_proff<br>";

			if ($hp || $energy || $uron || $strength || $dex || $agility || $vitality || $razum || $br1 || $br2 || $br5 || $br3 || $br4 || $krit || $unkrit || $uv || $unuv)
			echo"<br><b><i>Действие предмета:</i></b><br>
			$hp$energy$uron$strength$dex$agility$vitality$razum$br1$br2$br5$br3$br4$krit$unkrit$uv$unuv</small>";

			if ($iteminfo['about']) echo"<br><small><b><i>Дополнительная информация:</i></b><br>$about</small>";

			echo"</small></td></tr></table></div><br>";

		}

	} else {
		echo "<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
      <td align='center'>
Вещей в разделе нет.
</td></tr></table></div>";
	}

}

?>