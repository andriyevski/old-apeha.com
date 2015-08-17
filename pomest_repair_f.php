<?
//Ремонт
if (@$_GET['rem']) {
	if (preg_match("/^[0-9]+$/", $_GET['rem'])){
		$object = mysql_fetch_array(mysql_query("SELECT objects.id, objects.inf FROM objects, slots WHERE objects.user='".$stat['user']."' AND (objects.tip >= 1 AND objects.tip <= 17) AND objects.bank=0 AND objects.lam=0 AND objects.id=".$_GET['rem']." AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19)"));
		if ($object) {
			$inf = explode("|",$object['inf']);
			if ($inf['6']==$inf['7']){
				if($inf['7']>1){
					$inf['6']=0;
					$inf['7']=$inf['7']-1;
					$skidka = $stat['kol_repair']*5;
					$rem_price = ($obj_inf['2']*0.1)*(100-$skidka)/100;
					$infs = $inf['0']."|".$inf['1']."|".$inf['2']."|".$inf['3']."|".$inf['4']."|".$inf['5']."|".$inf['6']."|".$inf['7'];
					mysql_query("UPDATE objects SET inf='".$infs."' WHERE id=".$object['id']."");
					mysql_query("UPDATE players SET credits=credits-".$rem_price." WHERE user=".$stat['user']."");
					$msg = "Вы удачно отремонтировали <U>".$inf['1']."</U>, заплатив при этом - ".$rem_price." Зм.";
				}else $msg = "Вещь <U>".$inf['1']."</U> не принадлежит ремонту";
			}else $msg = "Вещь <U>".$inf['1']."</U> не поломана";
		}else $msg = "Что-то тут не так..";
	}else $msg = "Иш ты какой :)";
}

//Удаление вещи
if (@$_GET['del']) {
	if (preg_match("/^[0-9]+$/", $_GET['del'])){
		$object = mysql_fetch_array(mysql_query("SELECT objects.id, objects.inf FROM objects, slots WHERE objects.user='".$stat['user']."' AND (objects.tip >= 1 AND objects.tip <= 17) AND objects.bank=0 AND objects.lam=0 AND objects.id=".$_GET['del']." AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19)"));
		if ($object) {
			$inf = explode("|",$object['inf']);
			if ($inf['6']==$inf['7'] && $inf['7']<=1){
				$dell=mysql_query("DELETE FROM objects WHERE id=".$object['id']."");
				if($dell)
				$msg = "Вы удачно удалили <U>".$inf['1']."</U>";
				else $msg = "Что-то тут не так..";
			}else $msg = "Вещь <U>".$inf['1']."</U> еще пригодна";
		}else $msg = "Что-то тут не так..";
	}else $msg = "Иш ты какой :)";
}

$it_sost=mysql_query("SELECT objects.* FROM objects, slots WHERE objects.user='".$stat['user']."' AND (objects.tip >= 1 AND objects.tip <= 17) AND objects.bank=0 AND objects.lam=0 AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) ORDER BY time desc");

if (mysql_num_rows($it_sost)) {
	echo"<table width=100% cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1>";

	for($i=0; $i<mysql_num_rows($it_sost); $i++) {

		$objects=mysql_fetch_array($it_sost);

		$obj_inf=explode("|",$objects['inf']);
		$obj_min=explode("|",$objects['min']);
		$obj_add=explode("|",$objects['add']);

		include('inc/main/min_tr.php');
		include('inc/main/add.php');
		include('inc/main/classes.php');
		if ($obj_inf['6']>=$obj_inf['7']){
			$rem_price = ($obj_inf['2']*0.1)*(100-$skidka)/100;
			$s="";
			if($obj_inf['7']<=1 && $obj_inf['6']>=$obj_inf['7'])
			$s="<br><a href='pomest.php?set=repair&del=".$objects['id']."'>Удалить</a>";
			elseif($obj_inf['6']>=$obj_inf['7'])
			$s="<br><a href='pomest.php?set=repair&rem=".$objects['id']."'>Ремонт за ".$rem_price." зм.</a>";
			echo"
                <tr><td width=33% align=center valign=center>
                <b>".$obj_inf['1']."</b><br><br>
                <img src='i/money.gif' alt='Цена предмета'> <b>".$obj_inf['2']." зм.</b><br>
                <img src='i/item_iznos.gif' alt='Долговечность предмета'> <b>".$obj_inf['6']."</b>/<b>".$obj_inf['7']."</b><br>
                </td>
                <td width=34% align=center>
                <img src='i/items/".$obj_inf['0'].".gif' alt='".$obj_inf['1']."'>
                ".$s."
                </td>
                <td width=33% valign=top>
                <b><i>Минимальные требования:</i></b><br>
                $min_rase$min_level$min_str$min_dex$min_ag$min_vit<br>
                <b><i>Действие предмета:</i></b><br>
                $hp$energy$uron$strength$dex$agility$vitality$razum$br1$br2$br5$br3$br4$krit$unkrit$uv$unuv";

                if ($objects['about']) echo"<b><i>Дополнительная информация:</i></b><br>$about";

                echo"</td></tr><br>";
                echo "UPDATE players SET credits=credits-".$rem_price." WHERE user=".$stat['user']."";
		}
	}
} else
echo"У Вас нет предметов, подлежащих ремонту.";

echo"</table>";
?>