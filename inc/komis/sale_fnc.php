<?

if (!empty($sale) && is_numeric($sale)) {
	// �������
	$sale = addslashes($sale);
	$is_ex=mysql_fetch_array(mysql_query("SELECT objects.`id`,objects.`inf`,objects.`tip` FROM objects, slots WHERE objects.user='".$stat['user']."' AND objects.present=0 && objects.id=".addslashes($sale)." AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19)"));
	$stats = mysql_fetch_array(mysql_query("select user, credits from players where user='".addslashes($user)."' and pass='".addslashes($pass)."' LIMIT 1"));
	$is_ex_inf=explode("|",$is_ex['inf']);
	$prise_up = ($is_ex_inf['2']*50)/100;
	$prise_up2 = ($is_ex_inf['2']*100)/100;

	if (!empty($is_ex_inf['0'])) {

		if ($is_ex['tip'] != 15) {
			$SCredits = abs($_POST['credits']);

			if (($is_ex_inf['2']- $prise_up) < $SCredits) {

				if ($SCredits < ($is_ex_inf['2']+ $prise_up2)) {
					mysql_query("UPDATE objects SET komis = '1' WHERE id=".addslashes($sale)."");
					mysql_query("UPDATE players SET credits=credits-1 WHERE user='".$stats['user']."'");
					mysql_query("INSERT INTO komis (`otdel`, `id`, `saller`, `price`) values('$is_ex[tip]', '$is_ex[id]', '$stat[user]', '$SCredits')");

					$msg="������� <u>".$is_ex_inf['1']."</u> ���� �� ��������";

					$is_ex_inf['0'] = "";

				}
				else $msg="������������ ���� ������ ���������� �� ����� 100% �� ���. ���� ������";


			}
			else $msg="����������� ���� ������� ���������� �� ����� 50% �� ���. ���� ������";

		}
		else $msg="������� <u>".$is_ex_inf['1']."</u> �� ��������� �������!";


	}
	else echo"������� �� ������ � ����� �������!";
}
?>