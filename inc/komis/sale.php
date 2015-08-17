<?

$it_sost=mysql_query("SELECT objects.* FROM objects, slots where objects.user='".$stat['user']."' AND objects.present=0 AND objects.komis=0 AND objects.bank=0 AND objects.lam=0 AND objects.mag=0 AND objects.pochta=0 AND objects.bs=0 AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) ORDER BY time desc");
$shislo = mysql_num_rows($it_sost);
if ($shislo > 0) {
	for($i=0; $i<mysql_num_rows($it_sost); $i++) {

		$objects=mysql_fetch_array($it_sost);

		$obj_inf=explode("|",$objects['inf']);
		$obj_min=explode("|",$objects['min']);
		$obj_add=explode("|",$objects['add']);

		include('inc/main/min_tr.php');
		include('inc/main/add.php');
		include('inc/main/classes.php');

		$sale_price=round($obj_inf['2']*0.5);

		echo"<form action='komis.php?otdel=100&sale=".$objects['id']."' method=post>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
      <td width='30%' align='center'><small>
<img src='i/items/".$obj_inf['0'].".gif' alt='".$obj_inf['1']."'><br></small>";
		if ($objects['tip'] == 15)
		echo"<font color=red><b>Этот предмет <u>не подлежит</u> продаже!</b></font>";
		else
		echo"Укажите цену:<br><input name=credits class=input><br><input type=submit name=send_credits value='Сдать на коммиссию' class=input>
";
		echo"<small></td><td width='70%'>
<b>".$obj_inf['1']."</b><br>
Гос. цена: <b>".$obj_inf['2']."</b> зм.<br>
Долговечность предмета: <b>".$obj_inf['6']."</b>/<b>".$obj_inf['7']."</b><br><br></small>";

		if ($min_rase || $min_level || $min_str || $min_dex || $min_ag || $min_vit || $min_razum || $min_proff)
		echo"<small><b><i>Минимальные требования:</i></b><br>
		$min_rase$min_level$min_str$min_dex$min_ag$min_vit<br></small>";
		if ($hp || $energy || $uron || $strength || $dex || $agility || $vitality || $razum || $br1 || $br2 || $br5 || $br3 || $br4 || $krit || $unkrit || $uv || $unuv)
		echo"<small><b><i>Действие предмета:</i></b><br>
		$hp$energy$uron$strength$dex$agility$vitality$razum$br1$br2$br5$br3$br4$krit$unkrit$uv$unuv</small>";
		if ($objects['about']) echo"<small><br><b><i>Дополнительная информация:</i></b><br>$about</small>";

		echo"</td></tr></table></div><br></form>";

	}

} else {
	echo "<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
      <td align='center'>
Вещей на продажу в рюкзаке нет.
</td></tr></table></div>";
}

?>