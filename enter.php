<?
include(getcwd().'/inc/db_connect.php');
include(getcwd().'/time.php');
mysql_query("SET CHARSET cp1251");
if (strlen($user) >= 45) {

	$title = '������!';
	include("inc/html_header.php");
	echo"<body bgcolor=EBEDEC><b><font color=red>������!</font></b><br>���-�� ��� �� ���...";
	exit;

}


$ctime = time();

$error = '';
$ip = $_SERVER['REMOTE_ADDR'];
$browser = GetEnv(HTTP_USER_AGENT);

// �������������� �������� ������
if ($_GET['lostpwd']){ include(getcwd().'/inc/enter/lostpwd.php'); }
else {
	$user = mysql_escape_string($_POST['user']);
	$pass = mysql_escape_string($_POST['pass']);

	$infs = mysql_query("select user, pass, room, active from players where user='$user'");
	$info = mysql_fetch_array($infs);
	$query = mysql_query("select user, bloked, room, id, level, rank, tribe, active from players where user='".$user."' && pass='".md5($pass)."'");

	$inf = mysql_fetch_array($query);

	// ����� ���, ���� � ������ �������
	if (mysql_num_rows($infs)==0) $error="����� \"<b>".htmlspecialchars($user)."</b>\" �� ������ � ����!";
	else {

		if (empty($user) || empty($pass)){
			$error = "�������� ������!";
		}
		elseif ($info['pass']!=md5($pass) && !empty($info['user'])) {
			$error = "�������� ������ ��� \"<b>".$user."</b>\"";
			mysql_query("INSERT INTO security (id, user, ip, result) values('$ctime', '$user', '$ip', '2')");
			//        insert_msg("���� ����������� ��������� ������� ������ � IP: <b>$ip</b>","$info[user]",4,"","$info[room]","1");
		}

		if ($inf['bloked']){
			$error = "�������� <b>\"".$inf['user']."\"</b> ������������!<br>������� ����������: <font color=red><b>".$inf['bloked']."</b></font>";
		}
                if ($inf['active']==0){
            $error .= "������� <b>\"".$inf['user']."\"</b> �� �����������!<br>���� ��� �� ������ �� ������ ������ � ������� ��������� ���������� ����� ����";
        }

	}


	if(empty($error)) {

		$auth_code=md5($ctime-rand(1,1000));


		SetCookie("db_auth", $auth_code);
		SetCookie("db_user_id", $inf['id']);
		$_SESSION['user']=$inf['user'];
		$_SESSION['pass']=md5($pass);

		mysql_query("DELETE FROM `authorization` WHERE id='".$inf['id']."'");
		mysql_query("INSERT INTO `authorization` VALUES('".$inf['id']."','".$auth_code."')");



		// ������� � ������ ������
		if (mysql_num_rows(mysql_query("SELECT * FROM online WHERE id='".$inf['id']."'")) == 1)
		mysql_query("UPDATE online SET level='".$inf['level']."', rank='".$inf['rank']."', tribe='".$inf['tribe']."', room='".$inf['room']."', lpv='".$ctime."' WHERE id='".$inf['id']."'");
		else
		mysql_query("INSERT INTO online values ('".$inf['id']."','".$inf['user']."','".$inf['level']."','".$inf['rank']."','".$inf['tribe']."','".$ctime."','".$inf['room']."')");
		//

		mysql_query("INSERT INTO security (id, user, ip, result) values('".$ctime."', '".$info['user']."','$ip','1')");
		mysql_query("UPDATE `players` SET `lpv`='".time()."' WHERE `id` = '".$inf['id']."'");
		header("Location: game.php");
		require_once('inc/chat/functions.php');

		insert_msg(' <b>����� ���������� � ����!</b> ','',''.$inf['user'].'','','','',$stat['room']);


		insert_msg('<b>��������� ������</b>, ������������� ������� ������ � ������� ����������� ������� <a href=main.php?set=work target=main>���������</a>','',''.$inf['user'].'','','','',$stat['room']);


		if ($stat[level] < 6) {insert_msg('<b>��������������!</b> ��������� �������, ���������� ��� ��� � ���� �������� �������������� - ����� ������� ������ �������� ���. �� ������ ��������������� ���� ������� <a href=nastavnik.php target=main>����</a>','',''.$inf['user'].'','','','',$stat['room']);}



	} else { ?>
<title>������!</title>
<link
	rel=stylesheet type='text/css'
	href='<? echo $img_server; ?>/i/main.css'>
<body bgcolor=EBEDEC>
<font color=red><b>������:</b></font>
<br>
	<?=$error?>
	<? }
}
?>