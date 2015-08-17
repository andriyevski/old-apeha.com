<?

if (!empty($otdel)) {

	$shop=mysql_query("SELECT shop.*, items.* FROM shop, items where shop.city='".$stat[city]."' and shop.otdel=".addslashes($otdel)." AND items.name=shop.name ORDER BY items.price");

	echo"<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=A5A5A5>";

	for($i=0; $i<mysql_num_rows($shop); $i++) {
		$iteminfo=mysql_fetch_array($shop);

		include('inc/main/min_tr.php');
		include('inc/main/add.php');
		include('inc/main/classes.php');

		if ($iteminfo['kol']>0) {
			echo"
                        <tr><td width=33% align=center valign=center>
                        <a href='' target=_blank><b>".$iteminfo['title']."</b></a><br><br>
                        <b>Гос. цена: ".$iteminfo['price']." сп.</b><br>
                        Долговечность предмета: 0 [".$iteminfo['iznos']."]<br>
                        Тип предмета: <i>".$tip."</i><br>
                        <br>Количество: <u>".$iteminfo['kol']."</u> шт.<br>
                        </td>
                        <td width=34% align=center>
                        <img src='i/items/".$iteminfo['name'].".gif' alt='".$iteminfo['title']."'>
                        <br>
                        <span onclick=\"if (confirm('Купить предмет &quot;".$iteminfo['title']."&quot;?')) window.location='?otdel=".$otdel."&buy=".$iteminfo['name']."'\" style='CURSOR: Hand'><b>Купить</b></a></td>
                        <td width=33% valign=top>
                        <b><i>Минимальные требования:</i></b><br>
                        $min_rase$min_level$min_str$min_dex$min_ag$min_vit$min_razum$min_proff<br>";

                        if ($hp || $energy || $min || $max || $strength || $dex || $agility || $vitality || $razum || $br1 || $br2 || $br5 || $br3 || $br4 || $krit || $unkrit || $uv || $unuv) echo"<b><i>Действие предмета:</i></b><br>
                        $hp$energy$min$max$strength$dex$agility$vitality$razum$br1$br2$br5$br3$br4$krit$unkrit$uv$unuv<br>";

                        if (!empty($iteminfo['about']))
                        echo"<b><i>Дополнительная информация:</i></b><br>".$iteminfo['about'];

                        echo"
                        </td></tr>";
		}
	}
	echo"</table>";
}

?>