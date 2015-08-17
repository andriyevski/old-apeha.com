<?
if(!empty($lvl_itm)){if(!intval($lvl_itm)){$lvl_itm='%';};

}
if (!empty($otdel)) {
	if(empty($lvl_itm)){$lvl_itm='%';}

	if($lvl_itm<0 or $lvl_itm>99){$lvl_itm=$stat['level'];}
	$shop=mysql_query("SELECT shop.*, items.* FROM shop, items where shop.city='".$stat[city]."' and shop.otdel=".addslashes($otdel)." AND items.name=shop.name AND items.min_level like '".addslashes($lvl_itm)."' ORDER BY items.price");
	if(empty($lvl_itm) or !intval($lvl_itm)){$lvl_itm='all';}
	echo"<table width=98% border=1 cellspacing=0 cellpadding=5 bordercolor=A5A5A5>";

	for($i=0; $i<mysql_num_rows($shop); $i++) {
		$iteminfo=mysql_fetch_array($shop);

		include('inc/main/classes.php');
		include('inc/main/items.php');

		if ($iteminfo['kol']>0) {
			echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
      <td width='30%' align='center'>
<img src='i/items/".$iteminfo['name'].".gif' alt='".$iteminfo['title']."'>
<br>
                        <span onclick=\"if (confirm('Купить предмет &quot;".$iteminfo['title']."&quot;?')) window.location='?otdel=".$otdel."&buy=".$iteminfo['name']."'\" style='CURSOR: Hand'><b>Купить</b></a>
</td><td width='70%'>
<small><b>".$iteminfo['title']."</b><br>
Гос. цена: <b>".$iteminfo['price']."</b> зм.<br>
Долговечность предмета: <b>0</b>/<b>".$iteminfo['iznos']."</b></small><br>";

			if ($min_rase || $min_level || $min_str || $min_dex || $min_ag || $min_vit || $min_razum || $min_proff)
			echo"<br><small><b><i>Минимальные требования:</i></b><br>
			$min_rase$min_level$min_str$min_dex$min_ag$min_vit$min_razum$min_proff</small>";

			if ($hp || $energy || $uron || $strength || $dex || $agility || $vitality || $razum || $br1 || $br2 || $br5 || $br3 || $br4 || $krit || $unkrit || $uv || $unuv)
			echo"<br><small><b><i>Действие предмета:</i></b><br>
			$hp$energy$uron$strength$dex$agility$vitality$razum$br1$br2$br5$br3$br4$krit$unkrit$uv$unuv</small>";

			if (!empty($iteminfo['about']))
			echo"<br><small><b><i>Дополнительная информация:</i></b><br>".$iteminfo['about'];

			echo"</small></td></tr></table></div><br>";
		}
	}
}

?>