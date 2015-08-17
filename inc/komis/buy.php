<?

if (isset($_GET['buy'])) {

	$shop_sost_res = mysql_query("SELECT * FROM `komis` WHERE `otdel` = '".(int)$_GET['otdel']."' AND `id` = '".addslashes($_GET['buy'])."'");
	if (mysql_num_rows($shop_sost_res)) {

		$buyitem_res = mysql_query("SELECT * FROM `objects` WHERE `id` = '".addslashes($_GET['buy'])."'");

		if (mysql_num_rows($buyitem_res)) {

			$buyitem = mysql_fetch_array($buyitem_res);
			$shop_sost = mysql_fetch_array($shop_sost_res);
			$procent = ($shop_sost['price']*0.1);
			if ($shop_sost['price']<=$stat['credits']) {


				mysql_query("UPDATE players SET players.credits = players.credits - ".$shop_sost['price']." WHERE players.user = '".$stat['user']."' AND players.credits>=".$shop_sost['price']."");
				mysql_query("UPDATE objects SET user='".$stat['user']."', komis = '0' WHERE objects.id = '".$shop_sost['id']."'");
				mysql_query("UPDATE players SET players.credits = players.credits + ".$shop_sost['price']." WHERE players.user = '".$shop_sost['saller']."'");
				mysql_query("DELETE FROM komis WHERE id='".$shop_sost['id']."'");
				mysql_query("UPDATE players SET players.credits = players.credits - ".$procent." WHERE players.user = '".$shop_sost['saller']."'");

				$msg="Вы купили предмет <u>".$shop_sost['title']."</u> за <u>".$shop_sost['price']."</u> зм.";
			}
			else
			$msg="У Вас недостаточно денег для покупки предмета <u>".$shop_sost['title']."</u>";
		}
		else
		$msg="Предмет не найден!";
	}
	else
	$msg="Предмет не найден на Рынке!";
}

?>