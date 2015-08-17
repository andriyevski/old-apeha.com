<?

if (!empty($sale) && is_numeric($sale)) {
	// Продаем
	$sale = addslashes($sale);

	$is_ex=mysql_fetch_array(mysql_query("SELECT objects.`id`,objects.`inf`,objects.`tip` FROM objects, slots WHERE objects.user='".$stat['user']."' AND objects.present=0 && objects.id=".addslashes($sale)." AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19)"));

	$is_ex_inf=explode("|",$is_ex['inf']);

	if (!empty($is_ex_inf['0'])) {
		if ($is_ex['tip'] != 13) {
			$price=round($is_ex_inf['2']*0.7);

			mysql_query("DELETE FROM objects WHERE id=".addslashes($sale)."");
			mysql_query("UPDATE players SET credits=credits+".$price." WHERE id=".$stat['id']."");

			$stat['credits']+=$price;

			$msg="Вы удачно продали предмет <u>".$is_ex_inf['1']."</u> за <u>".$price."</u> зм.";

			$is_ex_inf['0'] = "";
		}
		else $msg="Предмет <u>".$is_ex_inf['1']."</u> не подледжит продаже!";
	}
	else echo"Предмет не найден в Вашем рюкзаке!";
}
?>