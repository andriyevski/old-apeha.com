<?

if (!empty($usemagic1)) {
	if (!empty($login) AND $login != "�����") {

			
		$_ex=mysql_query("SELECT * FROM magic WHERE id='".addslashes($useid1)."' AND name='".addslashes($usemagic1)."' AND user='".$stat[user]."'");

		if (mysql_num_rows($_ex) > 0) {
			$object = mysql_fetch_array($_ex);
				
			$iteminfo=mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$object['name']."'"));
				
			if ($iteminfo['tip'] >= 12 AND $iteminfo['tip'] <= 14) {

				$chl=mysql_fetch_array(mysql_query("SELECT id, v_time, k_time, user, room, level, hp_now, battle, vitality, travma FROM person where user='".addslashes($login)."'"));

				$HisInfo['user'] = $chl['user'];
				$chl['lpv'] = $user_lpv;

				if (!empty($chl['id'])) {
					if ($now > $chl['ma_time']) {
						if ($now > $chl['v_time']) {
							if (!$chl['k_time']) {
								if ($object['iznos'] >= 1) {

									// ----- # ������ ������ # ----- //
									include('includes/magic/magics.php');
									mysql_query("UPDATE magic SET iznos=iznos-1 WHERE id='".addslashes($useid1)."'");

								} else
								$msg = "������ ������ �� ��������!";
							} else
							$msg = "�������� <U>".$login."</U> ��������� �� ��������!";
						} else
						$msg = "�������� <U>".$login."</U> ��������� �� �������!";
					} else
					$nms="�������� <u>$login</u> ��������� ��� ������� �� ���������� ����!";
				} else
				$msg = "�������� <U>".$login."</U> �� ������!";
			} else
			$msg = "������ �� ������!";
		} else
		$msg = "������ �� ������!";
	} else
	$msg = "������� �����!";
}

if ($nms) $msg = $nms;

unset($object);
unset($onset);
unset($iteminfo);

?>