<?

switch ($stat['item_type']) {
	case 1: $OBJECTS_SELECT_QUERY = "objects.tip >= 1 AND objects.tip <= 11"; break;
	case 2: $OBJECTS_SELECT_QUERY = "objects.tip = 12"; break;
	case 3: $OBJECTS_SELECT_QUERY = "objects.tip = 17"; break;
	case 4: $OBJECTS_SELECT_QUERY = "objects.tip = 15"; break;
	case 5: $OBJECTS_SELECT_QUERY = "objects.tip = 16"; break;
	case 6: $OBJECTS_SELECT_QUERY = "objects.tip >= 13 AND objects.tip <= 14"; break;
	case 8: $OBJECTS_SELECT_QUERY = "objects.tip = 18"; break;
	case 9: $OBJECTS_SELECT_QUERY = "objects.tip = 20"; break;
	case 10: $OBJECTS_SELECT_QUERY = "objects.tip = 21"; break;
	default: $OBJECTS_SELECT_QUERY = "objects.tip >= 1 AND objects.tip <= 11"; break;
}
$object=mysql_query("SELECT objects.* FROM objects, slots WHERE objects.user='".$stat['user']."' and objects.bank='0' AND slots.id=".$stat['id']." AND objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) ORDER BY time DESC");
$vsegoveshei=mysql_num_rows($object);
$maxveshei=($stat[strength]*5+$stat[gnom]*$stat[strength]);
if ($vsegoveshei>$maxveshei) { echo"<font color=RED><b>У вас слишком много вещей. Освободите инвентарь.</b></font>"; }


$object=mysql_query("SELECT objects.* FROM objects, slots WHERE objects.user='".$stat['user']."' AND ".$OBJECTS_SELECT_QUERY." AND slots.id=".$stat['id']." AND objects.bank=0 AND objects.bs=0 AND objects.komis=0 AND objects.lam=0 AND objects.mag=0 AND objects.pochta=0 AND objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) ORDER BY time DESC");



if (mysql_num_rows($object)) {
	for ($i=0; $i<mysql_num_rows($object); $i++) {
		$objects=mysql_fetch_array($object);

		$obj_inf=explode("|",$objects['inf']);
		$obj_min=explode("|",$objects['min']);

		include('inc/main/min_tr.php');
		include('inc/main/add.php');
		include('inc/main/classes.php');


		echo "<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
      <td width='30%' align='center'>
      <img src='i/items/".$obj_inf['0'].".gif' alt='".$obj_inf['1']."'><br>";
		if (($stat['level'] < $obj_min['0'] || $stat['strength'] < $obj_min['1'] || $stat['dex'] < $obj_min['2'] || $stat['agility'] < $obj_min['3'] || $stat['vitality'] < $obj_min['4'] || $stat['razum'] < $obj_min['5'] || ($stat['rase'] != $obj_min['6'] && $obj_min['6'] != 0 AND $stat['rase'] != 100) || ($obj_min['7'] != 0 && $stat['proff'] != $obj_min['7'])) || $objects['tip'] == 13 || $objects['tip'] == 21 || $objects['tip'] == 18 || $objects['tip'] == 16 || $objects['tip'] == 19 || $obj_inf[6]>=$obj_inf[7])
		echo"";
		else {
			if ($stat['room'] != 49) echo"<a href='main.php?set=edit&onset=".$objects['id']."'>надеть</a>";
			if ($objects['tip']==12) {
				if ($stat['room'] != 49) echo"<br><a href=\"javascript:ShowForm('".$obj_inf['1']."','','','','1','".$obj_inf['0']."','".$objects['id']."','0');\">использовать</a>";
			}

			if ($stat['room'] == 49 and $objects['tb'] == 1) echo"<a href='main.php?set=edit&onset=".$objects['id']."'>надеть</a>";
			if ($objects['tip']==12) {
				if ($stat['room'] == 49 and $objects['tb'] == 1) echo"<br><a href=\"javascript:ShowForm('".$obj_inf['1']."','','','','1','".$obj_inf['0']."','".$objects['id']."','0');\">использовать</a>";

			}}

			if ($objects['tip']==18) echo"<br><a href=\"javascript:ShowForm('".$obj_inf['1']."','','','','1','".$obj_inf['0']."','".$objects['id']."','0');\">использовать</a>";

			if ($stat['room'] != 49 ) echo "<br><a href='#' style='CURSOR: Hand' onclick=\"drop('".$obj_inf['1']."', '".$objects['id']."');\">выбросить</a>";
			echo "</td>
      <td width='70%'>
      <small><b>".$obj_inf['1']."</b><br>
      Гос. цена: <b>".$obj_inf['2']."</b> зм.</small><br>";
			if ($objects['tip'] != 13 || $objects['tip'] != 15  || $objects['tip'] != 20) echo"<font ".($obj_inf[6]>=$obj_inf[7]?'color=red':'color=black')."><SMALL>Долговечность: <b>".$obj_inf['6']."</b>/<b>".$obj_inf['7']."</b></SMALL></font><br>";

			echo "<br><b><u><small>Минимальные требования:</u></b><br>
			$min_rase$min_level$min_str$min_dex$min_ag$min_vit$min_razum$min_proff<br></small>";
			if ($hp or $energy or $uron or $strength or $dex or $agility or $vitality or $razum or $br1 or $br2 or $br5 or $br3 or $br4 or $krit or $unkrit or $uv or $unuv)
			echo"<b><u><small>Действие предмета:</u></b>
<br>$hp$energy$uron$strength$dex$agility$vitality$razum$br1$br2$br3$br4$br5$krit$unkrit$uv$unuv<br></small>";
			if (!empty($objects['about']))
			echo"<b><u><small>Дополнительная информация:</u></b><br>".$objects['about']."<br>";
			if ($obj_inf['3']) echo"<br><b><u><small>Выгравирована надпись:</u></b><BR>".$obj_inf['3'];

			echo "</small>
      </td>
    </tr>
  </table>
</div>";

	}


}
else
echo"<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%' height='80%'>
    <tr>
      <td width='100%' height='100%' valign='top' align='center'>
        <a class=agree>Отдел рюкзака пуст!</a>
      </td>
    </tr>
  </table>
</div>";
echo"<b><i>Всего вещей: $vsegoveshei [$maxveshei]</i><b>";
?>