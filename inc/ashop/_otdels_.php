<?

if (!empty($otdel)) {

	$ashop=mysql_query("SELECT ashop.*, items.* FROM ashop, items where ashop.otdel=".addslashes($otdel)." AND items.name=ashop.name AND items.art=1 ORDER BY items.price");

	echo"<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=A5A5A5>";

	for($i=0; $i<mysql_num_rows($ashop); $i++) {
		$iteminfo=mysql_fetch_array($ashop);

		include('inc/main/classes.php');
		include('inc/main/items.php');

		if ($iteminfo['kol']>0) {
			echo"
                        <tr><td width=33% align=center valign=center>
                        <a href='' target=_blank><b>".$iteminfo['title']."</b></a><br><br>
                        <b>���. ����: ".$iteminfo['price']." ��.</b><br>
                        ������������� ��������: 0 [".$iteminfo['iznos']."]<br>
                        ��� ��������: <i>".$tip."</i><br>
                        <br>����������: <u>".$iteminfo['kol']."</u> ��.<br>
                        </td>
                        <td width=34% align=center>
                        <img src='i/items/".$iteminfo['name'].".gif' alt='".$iteminfo['title']."'>
                        <br>
                        <span onclick=\"if (confirm('������ ������� &quot;".$iteminfo['title']."&quot;?')) window.location='?otdel=".$otdel."&buy=".$iteminfo['name']."'\" style='CURSOR: Hand'><b>������</b></a></td>
                        <td width=33% valign=top>
                        <b><i>����������� ����������:</i></b><br>
                        $min_rase$min_level$min_str$min_dex$min_ag$min_vit$min_razum$min_proff<br>";

                        if ($hp || $energy || $uron || $strength || $dex || $agility || $vitality || $razum || $br1 || $br2 || $br5 || $br3 || $br4 || $krit || $unkrit || $uv || $unuv) echo"<b><i>�������� ��������:</i></b><br>
                        $hp$energy$uron$strength$dex$agility$vitality$razum$br1$br2$br5$br3$br4$krit$unkrit$uv$unuv<br>";

                        if (!empty($iteminfo['about']))
                        echo"<b><i>�������������� ����������:</i></b><br>".$iteminfo['about'];

                        echo"
                        </td></tr>";
		}
	}
	echo"</table>";
}

?>