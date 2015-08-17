<?
include(getcwd().'/inc/db_connect.php');
include(getcwd().'/time.php');
include(getcwd().'/inc/chat/functions.php');

$error = '';
$ctime = time();
$ip = $_SERVER['REMOTE_ADDR'];
$browser = GetEnv(HTTP_USER_AGENT);

// Восстановление забытого пароля
if ($_GET['lostpwd']){
	include(getcwd().'/inc/enter/lostpwd.php'); }
	else {
		$user = mysql_escape_string($_POST['user']);
		$pass = mysql_escape_string($_POST['pass']);

		$info = mysql_fetch_array(mysql_query("select * from players where user='$user'"));
		$query = mysql_query("select * from players where user='".$user."' and pass='".md5($pass)."'");

		$logres = mysql_num_rows($query);
		$inf = mysql_fetch_array($query);

		if (empty($user) and empty($pass)){
			$error = "Неверный запрос!";
		}
		if (!empty($user) and empty($pass)) {
			$error = "Укажите пароль!";
		}
		if (empty($user) and !empty($pass)) {
			$error = "Укажите логин!";
		}
		if (empty($info['user'])) {
			$error = "Логин \"<b>".$user."</b>\" не найден в базе!";
		}
		if ($info['pass']!=md5($pass)) {
			$error = "Неверный пароль для \"<b>".$info[user]."</b>\"";
			mysql_query("INSERT INTO security (id, user, ip, result) values('$ctime', '$info[user]', '$ip', '2')");
			//	insert_msg("Была предпринята неудачная попытка логина с IP: <b>$ip</b>","$info[user]",4,"","$info[room]","1");
		}
		if ($inf['bloked']==1){
			$error = "Персонаж <b>\"".$inf['user']."\"</b> заблокирован!<br>Причина блокировки: <font color=red><b>".$inf['blok_reason']."</b></font>";
		}

		if(empty($error)) {
			SetCookie("user", $inf['user']);
			SetCookie("pass", md5($pass));
			//                 SetCookie("room", $inf['room']);

			mysql_query("INSERT INTO security (id, user, ip, result) values('".$ctime."', '".$info['user']."', '$ip','1')");
			// Отправляем мессагу в чат, если поменялся IP
			if ($inf['ip']!=$ip) { insert_msg("В прошлый раз этим персонажем заходили с другого <u>IP</u>","$inf[user]",4,"","$inf[room]","0");
			}
			header("Location: game.php");
		} else { ?>
<title>Ошибка!</title>
<link
	rel=stylesheet type='text/css' href='i/main.css'>
<body bgcolor=EBEDEC>
<font color=red><b>Ошибка:</b></font>
<br>
		<?=$error?>
		<? }
	}
	?>