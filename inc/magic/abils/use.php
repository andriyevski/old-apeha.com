<?
$now = time();
if (!empty($usemagic)) {
	if (!empty($login) AND $login != "Логин") {

		if (!$stat['battle']) {
			if ($set  == "clan" AND $uri == "/main.php") {

				$_ex=mysql_query("SELECT * FROM abils WHERE id='".addslashes($useid)."' AND name='".addslashes($usemagic)."' AND tribe='".$stat['tribe']."'");

				if (mysql_num_rows($_ex) > 0) {
					$object = mysql_fetch_array($_ex);

					$iteminfo=mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$object['name']."'"));

					if ($iteminfo['tip'] == 12) {

						$chl=mysql_fetch_array(mysql_query("SELECT * FROM players where user='".addslashes($login)."'"));

						$HisInfo['user'] = $chl['user'];
						include("inc/main/get_inf.php");
						$chl['lpv'] = $user_lpv;

						if (!empty($chl['id'])) {
							if ($now > $chl['v_time']) {
								if ($chl['k_time']<$now) {
									if ($object['m_iznos']-$object['c_iznos'] > 0) {

										// ----- # Читаем свиток # ----- //
										include('inc/magic/magics.php');

									} else
									$msg = "Данный реликт на сегодня исчерпан!";

								} else
								$msg = "Персонаж <U>".$login."</U> находится на обучении!";
							} else
							$msg = "Персонаж <U>".$login."</U> находится на лечении!";
						} else
						$msg = "Персонаж <U>".$login."</U> не найден!";
					} else
					$msg = "Свиток не найден!";
				} else
				$msg = "Свиток не найден!";
			} else
			$msg = "Что-то тут не так..";
		} else
		$msg = "В бою использовать реликты запрещено!";
	} else
	$msg = "Укажите логин!";
}

if ($nms) $msg = $nms;

unset($object);
unset($onset);
unset($iteminfo);

?>