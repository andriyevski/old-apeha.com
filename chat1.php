<?// exit("чат временно остановлен для оптимизации, работоспособность чата будет восстановлена в течении 2х часов");
include("inc/db_connect.php");
$stat = mysql_fetch_array(mysql_query("SELECT `id`,`user`,`bloked`,`m_time`,`room`,`rank`,`color`,`tribe` FROM `players` WHERE `user` = '".$_SESSION['user']."' AND `pass` = '".$_SESSION['pass']."'"));
mysql_query("SET CHARSET cp1251");
if (empty($stat['id']) || $stat['bloked']==1) {
	print "<script>top.location='index.php?action=logout'</script>";
	exit;
}

mysql_query("UPDATE `players` SET `lpv` = '".time()."' WHERE `user` = '".$stat['user']."' LIMIT 1");

include("inc/chat/functions.php");

$mess_id=$_GET['message_id'];

if ($_GET['action']=="send") {
	$_POST['text'] = AddSlashes(HtmlSpecialChars($_POST['text']));
	if ($_POST['text']=="//exit" or $_POST['text']=="// exit") { $_POST['text']=""; }
	if ($_POST['text']=="//refresh" or $_POST['text']=="// refresh") { $_POST['text']=""; }
	if ($_POST['text']=="//admin" or $_POST['text']=="// admin") { $_POST['text']=""; }
	if ($stat['m_time']>time()) $_POST['text']="";
	if ($_POST['text']=="") { $clear_text = 0; } else {
		if (!empty($stat['color'])) $_POST['text']="<font color=".$stat['color'].">".$_POST['text']."</font>";
		if ($stat['user']=='migon') $_POST['text']="<font color=red><b>".$_POST['text']."</b></font>";
		
		$clear_text = 1;
		$to_login = "";
		$private = "";
		if (preg_match("/приватно \[(.*?)\]/", $_POST['text'], $private_temp)) {
			$private = $private_temp['1'];
			$_POST['text'] = str_replace('приватно ['.$private.']',' ',$_POST['text']);
		}
		elseif (preg_match("/для \[(.*?)\]/", $_POST['text'], $to_login_temp)) {
			$to_login = $to_login_temp['1'];
			$_POST['text'] = str_replace('для ['.$to_login.']',' ',$_POST['text']);
		}
		include("inc/chat/smiles.php");
		insert_msg(trim($_POST['text']),$to_login,$private);
	}
	$mess_id=$_POST['message_id'];
}
include("inc/html_header.php");
print "<SCRIPT LANGUAGE=\"JavaScript\">";
if ($mess_id!="") {
	$chat = mysql_query("SELECT * FROM chat WHERE date >'".(time()-60)."' and id > '".$mess_id."' AND (room = '".$stat['room']."' OR room = '0' OR room = '' ".$c_where.") AND (NOT EXISTS (select user from chatignore where login='".$stat['user']."' and user=chat.login)) ORDER BY `id`");
	while($chats = mysql_fetch_array($chat)) {
		if ($chats['id']>$mess_id) {
			$mess_id=$chats['id'];
			if ($chats['date']+60 > time()) {
				if ($chats['system']==1) {
					if ($chats['system_to']=="") {
						if ($chats['msg']<>"") {
							echo "top.ChatMsg('".date('H:i',$chats['date'])."','','<LABEL STYLE=\'COLOR: Red\' title=\'Уровень важности: Высокий\'><U><B>Внимание!</B></U></LABEL> ".$chats['msg']."','1','0');";
							echo "\n";
						}
					} else {
						if ($chats['system_to']==$stat['user']) {
							if ($chats['msg']<>"") {
								echo "top.ChatMsg('".date('H:i',$chats['date'])."','','<LABEL STYLE=\'COLOR: Green\' title=\'Уровень важности: Низкий\'><U><B>Внимание!</B></U></LABEL> ".$chats['msg']."','1','0');";
								echo "\n";
							}
						}
					}
					if ($chats['redirect']) $redirect=$chats['redirect'];
				} elseif ($chats['private']<>"" && ($chats['login']==$stat['user'] || $chats['private']==$stat['user'])) {
					if ($chats['login']==$stat['user']) { $my=1; $me=0; } else { $my=0; $me=1; }
					if ($my==1) { $pp=$chats['private']; } else { $pp=$chats['login']; }
					echo "top.ChatMsg('".date('H:i',$chats['date'])."','".$chats['login']."','<FONT class=private onclick=\'top.pp(\"".$pp."\");\'>приватно [".$chats['private']."]</FONT> ".$chats['msg']."','".$me."','".$my."');";
					echo "\n";
				} elseif ($chats['to_login']<>""){
					unset ($stick);
					if ($chats['to_login']==$stat['user']) { $my=0; $me=1; $stick=1; }
					if ($chats['login']==$stat['user']) { $my=1; $me=0; $stick=1; }
					if ($my==1) { $to=$chats['to_login']; } else { $to=$chats['login']; }
					echo "top.ChatMsg('".date('H:i',$chats['date'])."','".$chats['login']."','";
					if (isset($stick) && !empty($stick)) { echo "<FONT class=player onclick=\'top.to(\"".$to."\");\'>"; }
					echo "для [".$chats['to_login']."]</FONT> ".$chats['msg']."','".$me."','".$my."');";
					echo "\n";
				} elseif ($chats['private']=="" && $chats['to_login']=="" && $chats['system']<>1) {
					if ($chats['login']==$stat['user']) $my=1; else $my=0;
					echo "top.ChatMsg('".date('H:i',$chats['date'])."','".$chats['login']."','".$chats['msg']."','0','".$my."');";
					echo "\n";
				}
			}
		}
	}
} else { $mess_id=-1; }

print"\ntop.MsgSent('".$mess_id."'";
if (isset($clear_text)) print ",'1'";
print ");\n";
if ($redirect) echo"top.main.location=\"$redirect?\"+Math.random();\"\"\n";
print "</SCRIPT>";
?>