<?
$ip = $_SERVER['REMOTE_ADDR'];

if (!empty($transf)){
	if (!empty($infon['user'])) {
		if ($infon['user'] != $stat['user']) {

			$object=mysql_fetch_array(mysql_query("select objects.* from objects, slots where objects.user='".$stat['user']."' AND objects.id='".addslashes($transf)."' AND objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19)"));

			if (!empty($object['id'])) {
				$object_inf=explode("|",$object['inf']);

				if ($object_inf['5'] == 0 OR ($object_inf['5'] == 1 AND $stat['admin'] == 1 || $stat['rank'] == 100 || $stat['rank'] == 30)) {
					if (!$object['present']) {
						if ($object['tb'] != 1) {
							if ($object['art'] != 1) {
								if ($stat['room'] == $infon['room']) {
									if ($now-$infon['lpv'] <= 400) {

										$RunQuery = mysql_query("UPDATE objects SET user='".$infon['user']."' WHERE id='".$object['id']."'");

										if ($RunQuery) {
											mysql_query("INSERT INTO transfers VALUES ('".$now."','".$ip."','".$stat['user']."','".$infon['user']."','','".$object_inf['1']."','".addslashes($transf)."')");

											require_once("inc/chat/functions.php");
											insert_msg("<b><u>".$stat['user']."</u></b> ������� ��� ������� <b><u>".$object_inf['1']."</u></b>","","","1",$infon['user'],"",$infon['room']);

											$msg = "������� <b><u>".$object_inf['1']."</u></b> ������ ������� � <b><u>".$infon['user']."</u></b>";
										}
									}
								} else $msg="<b style='COLOR: Red'>��� �������� ���������� ���������� � 1 �������</b>";
							} else $msg="<b style='COLOR: Red'>�� �� ������ ���������� ���������!</b>";
						} else $msg="<b style='COLOR: Red'>�� �� ������ ���������� ��������� ����!</b>";
					}		 else $msg="<b style='COLOR: Red'>�� �� ������ ���������� �������!</b>";
				}
				else
				$msg="<b style='COLOR: Red'>�� �� ������ ���������� ���������!</b>";
			}
			else $msg="<b style='COLOR: Red'>������� �� ������ � ����� �������!</b>";
		}
	}
}





if ($_POST['credits'] < 0 )
{
	$msg="<b>������� ���������� ����� !</b>";
}
else
if(isset($_POST['credits']) && !empty($_POST['credits']) && is_numeric($_POST['credits'])) {
	if (!empty($infon['user'])) {
		if ($infon['user'] != $stat['user']) {
			$SCredits = abs($_POST['credits']);
			if ($stat['credits'] < $SCredits) {
				$msg="<b>� ��� ������������ ������� ��� ��������!</b>";
			}
			else {
				$stat['credits'] = $stat['credits'] - $SCredits;

				$RunQuery = mysql_query("UPDATE players t1, players t2 SET t1.credits=t1.credits-".$SCredits.", t2.credits=t2.credits+".$SCredits." WHERE t1.user='".$stat['user']."' AND t2.user='".$infon['user']."' AND t1.credits>=".$SCredits."");

				if ($RunQuery) {
					mysql_query("INSERT INTO transfers VALUES ('".$now."','".$ip."','".$stat['user']."','".$infon['user']."','".$SCredits."','','')");

					require_once("inc/chat/functions.php");
					insert_msg("�������� <b><u>".$stat['user']."</u></b> ������� ��� <b><u>".$SCredits."</u></b> ��.","","","1",$infon['user'],"",$infon['room']);

					$msg = "�� ������ �������� \"<b>".$SCredits."</b>\" ������� � ��������� <b><u>".$infon['user']."</u></b>";
				}
			}
		}
	}
}

?>