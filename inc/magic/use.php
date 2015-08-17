<?

$_ur=GetEnv("REQUEST_URI");
$uri=explode("?",$_ur);

if (!empty($usemagic)) {
	if (!empty($login) && $login != "Логин") {
		if ((empty($set) || $set == "edit" || $set == "map") && ($uri['0'] == "/main.php" || $uri['0'] == "/battle.php")) {

			if ($uri['0'] == "/battle.php")
			$a_where="(slots.17=$useid OR slots.18=$useid) AND";

			$_ex=mysql_query("SELECT objects.id, objects.inf, objects.tip, objects.min FROM objects, slots where ".addslashes($a_where)." (objects.id='".addslashes($useid)."' AND user='".$stat['user']."')");

			if (mysql_num_rows($_ex) > 0) {
				$object=mysql_fetch_array($_ex);

				$obj_inf=explode("|",$object['inf']);
				$obj_min=explode("|",$object['min']);

				$iteminfo['name']=$obj_inf['0'];

				if ($object['tip'] == 12 || $object['tip'] == 16 || $object['tip'] == 18) {

					$chl=mysql_fetch_array(mysql_query("SELECT * FROM players where user='".addslashes($login)."'"));
					$HisInfo['user'] = $chl['user'];
					include("inc/main/get_inf.php");
					$chl['lpv'] = $user_lpv;

					if (!empty($chl['id'])) {
						if ($chl['v_time'] < $now) {
							if ($chl['k_time'] < $now) {
								if ($obj_min['5'] >= $iteminfo['min_razum']) {
									if (($obj_min['7'] != 0 && $obj_min['7'] == $stat['proff']) || $obj_min['7'] == 0) {

										// ----- # Читаем свиток # ----- //
										include('inc/magic/magics.php');

									}
									else
									$nms="Для чтения данного свитка необходимо владеть определенными навыками!";
								}
								else
								$nms="Недостаточна развита характеристика: <u>Разум</u>";
							}
							else
							$nms="Персонаж <u>$login</u> находится на обучении!";
						} else
						$nms="Персонаж <u>$login</u> находится на лечении!";
					} else
					$nms="Персонаж <u>$login</u> не найден!";
				} else
				$nms="Что-то тут не так...";
			} else
			$nms="Свиток не найден!";
		} else
		$nms="Что-то тут не так...";
	} else
	$nms="Укажите логин!";
}

?>