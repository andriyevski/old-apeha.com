<?
include(getcwd().'/inc/db_connect.php');
include(getcwd().'/time.php');
mysql_query("SET CHARSET cp1251");
if (strlen($user) >= 45) {

	$title = 'Ошибка!';
	include("inc/html_header.php");
	echo"<body bgcolor=EBEDEC><b><font color=red>Ошибка!</font></b><br>Что-то тут не так...";
	exit;

}


$ctime = time();

$error = '';
$ip = $_SERVER['REMOTE_ADDR'];
$browser = GetEnv(HTTP_USER_AGENT);

// Восстановление забытого пароля
if ($_GET['lostpwd']){ include(getcwd().'/inc/enter/lostpwd.php'); }
else {
	$user = mysql_escape_string($_POST['user']);
	$pass = mysql_escape_string($_POST['pass']);

	$infs = mysql_query("select user, pass, room, active from players where user='$user'");
	$info = mysql_fetch_array($infs);
	$query = mysql_query("select user, bloked, room, id, level, rank, tribe, active from players where user='".$user."' && pass='".md5($pass)."'");

	$inf = mysql_fetch_array($query);

	// Перса нет, ищем в других городах
	if (mysql_num_rows($infs)==0) $error="Логин \"<b>".htmlspecialchars($user)."</b>\" не найден в базе!";
	else {

		if (empty($user) || empty($pass)){
			$error = "Неверный запрос!";
		}
		elseif ($info['pass']!=md5($pass) && !empty($info['user'])) {
			$error = "Неверный пароль для \"<b>".$user."</b>\"";
			mysql_query("INSERT INTO security (id, user, ip, result) values('$ctime', '$user', '$ip', '2')");
			//        insert_msg("Была предпринята неудачная попытка логина с IP: <b>$ip</b>","$info[user]",4,"","$info[room]","1");
		}

		if ($inf['bloked']){
			$error = "Персонаж <b>\"".$inf['user']."\"</b> заблокирован!<br>Причина блокировки: <font color=red><b>".$inf['bloked']."</b></font>";
		}
                if ($inf['active']==0){
            $error .= "Аккаунт <b>\"".$inf['user']."\"</b> не активирован!<br>если вам не пришло не пришло письмо с данными активации посмотрите папку спам";
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



		// Заносим в список онлайн
		if (mysql_num_rows(mysql_query("SELECT * FROM online WHERE id='".$inf['id']."'")) == 1)
		mysql_query("UPDATE online SET level='".$inf['level']."', rank='".$inf['rank']."', tribe='".$inf['tribe']."', room='".$inf['room']."', lpv='".$ctime."' WHERE id='".$inf['id']."'");
		else
		mysql_query("INSERT INTO online values ('".$inf['id']."','".$inf['user']."','".$inf['level']."','".$inf['rank']."','".$inf['tribe']."','".$ctime."','".$inf['room']."')");
		//

		mysql_query("INSERT INTO security (id, user, ip, result) values('".$ctime."', '".$info['user']."','$ip','1')");
		mysql_query("UPDATE `players` SET `lpv`='".time()."' WHERE `id` = '".$inf['id']."'");
		header("Location: game.php");
		require_once('inc/chat/functions.php');

		insert_msg(' <b>Добро пожаловать в игру!</b> ','',''.$inf['user'].'','','','',$stat['room']);


		insert_msg('<b>Уважаемые игроки</b>, зарабатывайте золотые монеты с помошью реферальной системы <a href=main.php?set=work target=main>подробнее</a>','',''.$inf['user'].'','','','',$stat['room']);


		if ($stat[level] < 6) {insert_msg('<b>Наставничество!</b> Уважаемые новички, специально для вас в игре введенно наставничество - более старшие игроки помогают вам. Вы можете воспользоваться этим перейдя <a href=nastavnik.php target=main>сюда</a>','',''.$inf['user'].'','','','',$stat['room']);}



	} else { ?>
<title>Ошибка!</title>
<link
	rel=stylesheet type='text/css'
	href='<? echo $img_server; ?>/i/main.css'>
<body bgcolor=EBEDEC>
<font color=red><b>Ошибка:</b></font>
<br>
	<?=$error?>
	<? }
}
?>