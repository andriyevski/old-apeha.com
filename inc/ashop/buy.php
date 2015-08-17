<?
if (isset($_GET['buy'])) {

	$ashop_sost_res = mysql_query("SELECT * FROM `ashop` WHERE `otdel` = '".(int)$_GET['otdel']."' AND `name` = '".addslashes($_GET['buy'])." '");

	if (mysql_num_rows($ashop_sost_res)) {

		$buyitem_res = mysql_query("SELECT * FROM `items` WHERE `name` = '".addslashes($_GET['buy'])."' AND art='1'");

		if (mysql_num_rows($buyitem_res)) {

			$buyitem = mysql_fetch_array($buyitem_res);
			$ashop_sost = mysql_fetch_array($ashop_sost_res);

			if ($buyitem['price']<=$stat['valute']) {

				if ($ashop_sost['kol']>0) {

					if ($buyitem['tip'] == 1 && $buyitem['slot2'] == "w5")
					$secondary=1;
					else
					$secondary=0;

					$result = mysql_query("UPDATE `ashop`,`players` SET ashop.kol=ashop.kol-1, players.valute = players.valute - ".$buyitem['price']." WHERE ashop.name = '".addslashes($_GET['buy'])."' && players.user = '".$stat['user']."' AND players.valute>=".$buyitem['price']."");

					if ($result) {

						$inf = "".$buyitem['name']."|".$buyitem['title']."|".$buyitem['price']."|0|".$secondary."|".$buyitem['art']."|0|".$buyitem['iznos']."";

						$min = "".$buyitem['min_level']."|".$buyitem['min_str']."|".$buyitem['min_dex']."|".$buyitem['min_ag']."|".$buyitem['min_vit']."|".$buyitem['min_razum']."|".$buyitem['min_rase']."|".$buyitem['min_proff']."";

						$result2 = mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".$stat['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");

						if ($result2) {

							$msg="Вы купили предмет <u>".$buyitem['title']."</u> за <u>".$buyitem['price']."</u> зм.";
						}
					}
				}
			}
			else
			$msg="У Вас недостаточно денег для покупки предмета <u>".$buyitem['title']."</u>";
		}
		else
		$msg="Предмет не найден!";
	}
	else
	$msg="Предмет не найден в магазине!";
}

?>