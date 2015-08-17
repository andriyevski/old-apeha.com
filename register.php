<?
$ok=0;

#include('inc/noflood.php');

include('inc/db_connect.php');
include('time.php');

$now=time();
$ip=GetEnv("REMOTE_ADDR");
$browser=GetEnv("HTTP_USER_AGENT");

SetCookie("user","");
SetCookie("pass","");

unset($user);
unset($pass);

if (@$register) {

	// Блокировка таблицы

	mysql_query("LOCK TABLES `players` WRITE, `slots` WRITE");
	echo mysql_error();
	//$login=$_POST['login'];
	//$password=$_POST['password'];
	//$password2=$_POST['password2'];
	//$u_name=$_POST['u_name'];
	//$sex=$_post['sex'];
	//$rase=$_POST['rase'];

	$login=trim($login);
	$login=addslashes($login);

	if ($login=="" or $password2=="" or $u_name=="" or $sex=="" or $rase=="") $nms.="Вы не заполнили обязательные поля!"; else {

		$hinfo=mysql_fetch_array(mysql_query("SELECT id FROM players where user='".$login."'"));
		echo mysql_error();


		if (!empty($hinfo['id'])) $finded=1; else $finded=0;

		if ($finded == 0) {

			if (strlen($login)<3) { $nms.="Логин не должен быть короче 3-з символов!\\n"; } else $ok+=1;

			$arr[] = chr(32);
			for($i = 48; $i != 57; $i++) {
				$arr[] = chr($i);
			}

			for($i = 65; $i != 91; $i++) {
				$arr[] = chr($i);
			}

			for($i = 97; $i != 123; $i++) {
				$arr[] = chr($i);
			}

			for($i = 192; $i != 256; $i++) {
				$arr[] = chr($i);
			}

			for ($i=0; $i<strlen($login); $i++) {
				if (!in_array($login[$i],$arr)) { $fb=1; break; }
			}

			if ($fb == 1) { $nms.="Логин содержит недопустимые символы!\\n"; } else $ok+=1;


			if (preg_match("#[A-Za-z]#", $login) && preg_match("#[А-Яа-я]#", $login)) { $nms.="Логин должен быть только из русских или английскх букв!\\n"; } else $ok+=1;

			if (is_numeric($login)) { $nms.="Логин не может быть только из цифр!\\n"; } else $ok+=1;

			/* допиши текст про ошибку если мыло совпадает с тем что уже есть в базе */
			$email_sql = mysql_query("SELECT email FROM players WHERE email='".addslashes(htmlspecialchars($email))."' LIMIT 1") or die(mysql_error());
			if (!strpos($email,"@") || mysql_num_rows($email_sql)) { $nms .= "E-Mail в неправельном формате!\\n"; } else $ok+=1;
			/* ===================================================================== */

			if ($password!=$password2) { $nms.="Введеные Вами пароли не совпадают!\\n"; } else $ok+=1;
			if ($password==$password2 && strlen($password)<6) { $nms.="Пароль не должен быть короче 6-ти символов!\\n"; } else $ok+=1;
			if ($sex!=1 && $sex!=2) { $nms.="Неверно указан пол!\\n"; }  else $ok+=1;
			if ($rase!=1 && $rase!=2 && $rase!=3 && $rase!=4) { $nms.="Неверно указана раса!\\n"; }  else $ok+=1;

			if (is_numeric($day) && is_numeric($month) && is_numeric($year)) {
				if (($day>0 && $day<32) and ($month>0 && $month<13) and ($year>1949 && $year<2000)) { $ok+=1; }
				else $nms.="Неверно указана дата рождения!\\n";
			} else $nms.="Неверно указана дата рождения!\\n";

			if ($law!=1) { $nms.="Принятие наших законов является обязательным условием!\\n"; } else $ok+=1;

		} else $nms.="Персонаж с таким логином уже существует!\\n";

	}

	// Вставляем в базу
	if(empty($ip))
	{
		if (getenv('HTTP_X_FORWARDED_FOR'))
		{
			$ip=getenv('HTTP_X_FORWARDED_FOR');
		}
		else
		{
			$ip=getenv('REMOTE_ADDR');
		}

	}
	if ($ok>10) {

		$max = mysql_fetch_array(mysql_query("SELECT MAX(id) as id FROM players"));
		$NEW_USER_ID = $max['id'] + 1;
		$referer = $_COOKIE['us'];
		mysql_query("INSERT INTO slots (id, slots.1) values('".$NEW_USER_ID."','0')");
		mysql_query("INSERT INTO players (id, user, pass, rase, credits, name,email, birth, birthdate, real_city, sex, browser, deviz, ip, referer) values('".$NEW_USER_ID."','".addslashes($login)."',md5('$password'),'".addslashes($rase)."','5','".addslashes($u_name)."','".addslashes(htmlspecialchars($email))."','$day.$month.$year','$this_time','".addslashes($city)."','".addslashes($sex)."','".addslashes($browser)."','".addslashes($deviz)."','$ip','".addslashes($referer)."')");

		// Приветствуем нового игрока !!!
		require_once("inc/chat/functions.php");
		insert_msg("В игре зарегистрировался новый игрок под ником: <b>".addslashes($login)."</b>! ","","","1","","",$stat['room']);
		$finded = 1;

		mysql_query("unlock tables");
		// Разблокировка таблицы

		header("Location: register.php?page=end&login=$login");
		exit;
	}
	//
	mysql_query("unlock tables");
	// Разблокировка таблицы

}




if ($page!="end") {


	$title='Инстинкты воина';
	include('inc/html_header.php');
	echo"<body bgcolor=EBEDEC>";



	echo"<table width=790 border=1 bordercolor=CCCCCC cellspacing=0 cellpadding=3>
<tr>
<td align=center><b style='COLOR: Green'>Инстинкты воина - [Регистрация]</b></td>
</tr>
</table><br>
<script language=JavaScript src='inc/reg.js'></script>
<form method='POST' onsubmit='return validate()' action='' name='reg'>";

	if ($nms!="") echo"<script>alert('Найдены ошибки:\\n$nms');</script>";

	echo"<table width=790 border=0 bordercolor=CCCCCC cellspacing=0 cellpadding=3>


<tr>
<td width=\"135\">Имя персонажа: (<b style='COLOR: Red'>*</b>)</td>
<td width=\"180\"><input name='login' class=input size=\"30\" maxlength=20 value=\"$login\" onblur=check_correct('login',1) onkeyup=check_correct('login',0) maxLength=10 onchange=check_correct('login',0)></td>
		<td width=\"16\"><img id=login_i name=login_i src=\"i/markfalse.gif\"></td>
		<td width=\"455\">Может состоять только из <font style='color: red'><b>русских и английских</b></font> букв, цифр, и следующие знаки:<b> пробел, _, !, ~, -, .,@</b> и содержать <b>от 3 до 10 символов</b>. </td>
</tr>
	<tr>
		<td colspan=4 id=login_err name=login_err><font color=#dd3333></font></td>
	</tr>

	<tr>
		<td nowrap width=\"118\">Пароль <b style='COLOR: Red'>*</b><IMG style=\"CURSOR: hand\" onclick=genpass() alt=\"Создать случайный пароль\" src=\"i\dice.gif\"></td>
		<td width=\"180\"><input name=\"password\" size=\"30\" class=\"input\" value=\"$password\" onblur=check_correct('password',1) onkeyup=check_correct('password',0) type=password maxLength=32 onchange=check_correct('password',1)></td>
		<td width=\"16\"><img id=\"password_i\" name=\"password_i\" src=\"i/markfalse.gif\"></td>
		<td>Может состоять тока из англ. букв и цифр и содержать от 6 до 25 символов</td>
	</tr>
	<tr>
		<td nowrap colspan=\"4\" id=\"password_err\" name=\"password_err\"><font color=#dd3333></font></td>
	</tr>
	<tr>
		<td nowrap width=\"118\">Повторите пароль <b style='COLOR: Red'>*</b></td>
		<td width=\"180\"><input name=\"password2\" size=\"30\" class=\"input\" value=\"$password2\" onblur=check_correct('password2',1) onkeyup=check_correct('password2',0) type=password maxLength=32 onchange=check_correct('password2',1)></td>
		<td width=\"16\"><img id=\"password2_i\" name=\"password2_i\" src=\"i/markfalse.gif\"></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td nowrap colspan=\"4\" id=\"password2_err\" name=\"password2_err\"><font color=#dd3333></font></td>
	</tr>
	<tr>
		<td nowrap width=\"118\">Ваш e-mail <b style='COLOR: Red'>*</b></td>
		<td width=\"180\"><input type=\"text\" name=\"email\" size=\"30\" class=\"input\" value=\"$email\" onblur=check_correct('email',1) onkeyup=check_correct('email',0) maxLength=40 onchange=check_correct('email',0)></td>
		<td width=\"16\"><img id=\"email_i\" name=\"email_i\" src=\"i/markfalse.gif\"></td>
		<td>Используется для завершения регистрации. На этот адрес будет выслан пароль, если вы его забудете. От 8 до 40 символов</td>
	</tr>
	<tr>
		<td nowrap colspan=\"4\" id=\"email_err\" name=\"email_err\"><font color=#dd3333></font></td>
	</tr>

	<tr>
		<td nowrap width=\"118\">Реальное имя <b style='COLOR: Red'>*</b></td>
		<td width=\"180\"><input type=\"text\" name=\"u_name\" size=\"30\" class=\"input\" value=\"$u_name\" onblur=check_correct('u_name',1) onkeyup=check_correct('u_name',0) maxLength=15 onchange=check_correct('u_name',0)></td>
		<td width=\"16\"><img id=\"u_name_i\" name=\"u_name_i\" src=\"i/markfalse.gif\"></td>
		<td>Может состоять тока из рус. или англ. букв. От 2 до 15 символов</td>
	</tr>
	<tr>
		<td nowrap colspan=\"4\" id=\"u_name_err\" name=\"u_name_err\"><font color=#dd3333></font></td>
	</tr>

	<tr>
		<td nowrap width=\"118\">Дата рождения <b style='COLOR: Red'>*</b></td>
		<td width=\"180\">
    <SELECT class=input name=day onkeyup=check_correct('day',0) onchange=check_correct('day',1) onblue=\"check_correct('day',1)\">";
	//for ($i=1; $i<32; $i++) { echo"<option value=$i"; if ($i==$day) echo" selected"; echo">$i"; }
	//unset($i);
	//echo"</select> <select name=month onkeyup=check_correct('month',0) onchange=check_correct('month',1) onblue=\"check_correct('month',1)\">";
	//for ($i=1; $i<13; $i++) { echo"<option value=$i"; if ($i==$month) echo" selected"; echo">$i"; }
	//unset($i);
	//echo"</select> <select name=year onkeyup=check_correct('year',0)  onchange=check_correct('year',1) onblue=\"check_correct('year',1)\">";
	//for ($i=1950; $i<2000; $i++) { echo"<option value=$i"; if ($i==$year) echo" selected"; echo">$i"; }
	//unset($i);
	//echo"</select>
	echo"
 <OPTION value=0 selected>-</OPTION>
 <OPTION value=1 >01</OPTION>
 <OPTION value=2 >02</OPTION>
 <OPTION value=3 >03</OPTION>
 <OPTION value=4 >04</OPTION>
 <OPTION value=5 >05</OPTION>
 <OPTION value=6 >06</OPTION>
 <OPTION value=7 >07</OPTION>
 <OPTION value=8 >08</OPTION>
 <OPTION value=9 >09</OPTION>
 <OPTION value=10 >10</OPTION>
 <OPTION value=11 >11</OPTION>
 <OPTION value=12 >12</OPTION>
 <OPTION value=13 >13</OPTION>
 <OPTION value=14 >14</OPTION><
 OPTION value=15 >15</OPTION>
 <OPTION value=16 >16</OPTION>
 <OPTION value=17 >17</OPTION>
 <OPTION value=18 >18</OPTION>
 <OPTION value=19 >19</OPTION>
 <OPTION value=20 >20</OPTION>
 <OPTION value=21 >21</OPTION>
 <OPTION value=22 >22</OPTION>
 <OPTION value=23 >23</OPTION>
 <OPTION value=24 >24</OPTION>
 <OPTION value=25 >25</OPTION>
 <OPTION value=26 >26</OPTION>
 <OPTION value=27 >27</OPTION>
 <OPTION value=28 >28</OPTION>
 <OPTION value=29 >29</OPTION>
 <OPTION value=30 >30</OPTION>
 <OPTION value=31 >31</OPTION>
    </SELECT>
    <SELECT name=month onkeyup=check_correct('month',0) onchange=check_correct('month',1) onblue=\"check_correct('month',1)\">
 <OPTION value=0 selected>-</OPTION>
 <OPTION value=1 >Январь</OPTION>
 <OPTION value=2 >Февраль</OPTION>
 <OPTION value=3 >Март</OPTION>
 <OPTION value=4 >Апреля</OPTION>
 <OPTION value=5 >Мая</OPTION>
 <OPTION value=6 >Июня</OPTION>
 <OPTION value=7 >Июля</OPTION>
 <OPTION value=8 >Августа</OPTION>
 <OPTION value=9 >Сентября</OPTION>
 <OPTION value=10 >Октября</OPTION>
 <OPTION value=11 >Ноября</OPTION>
 <OPTION value=12 >Декабря</OPTION>
    </SELECT>
 <SELECT name=year onkeyup=check_correct('year',0)  onchange=check_correct('year',1) onblue=\"check_correct('year',1)\">
 <OPTION value=0 selected>-</OPTION>
 <option value=\"2000\" >2000</option>
 <option value=\"1999\" >1999</option>
 <option value=\"1998\" >1998</option>
 <option value=\"1997\" >1997</option>
 <option value=\"1996\" >1996</option>
 <option value=\"1995\" >1995</option>
 <option value=\"1994\" >1994</option>
 <option value=\"1993\" >1993</option>
 <option value=\"1992\" >1992</option>
 <option value=\"1991\" >1991</option>
 <option value=\"1990\" >1990</option>
 <option value=\"1989\" >1989</option>
 <option value=\"1988\" >1988</option>
 <option value=\"1987\" >1987</option>
 <option value=\"1986\" >1986</option>
 <option value=\"1985\" >1985</option>
 <option value=\"1984\" >1984</option>
 <option value=\"1983\" >1983</option>
 <option value=\"1982\" >1982</option>
 <option value=\"1981\" >1981</option>
 <option value=\"1980\" >1980</option>
 <option value=\"1979\" >1979</option>
 <option value=\"1978\" >1978</option>
 <option value=\"1977\" >1977</option>
 <option value=\"1976\" >1976</option>
 <option value=\"1975\" >1975</option>
 <option value=\"1974\" >1974</option>
 <option value=\"1973\" >1973</option>
 <option value=\"1972\" >1972</option>
 <option value=\"1971\" >1971</option>
 <option value=\"1970\" >1970</option>
 <option value=\"1969\" >1969</option>
 <option value=\"1968\" >1968</option>
 <option value=\"1967\" >1967</option>
 <option value=\"1966\" >1966</option>
 <option value=\"1965\" >1965</option>
 <option value=\"1964\" >1964</option>
 <option value=\"1963\" >1963</option>
 <option value=\"1962\" >1962</option>
 <option value=\"1961\" >1961</option>
 <option value=\"1960\" >1960</option>
 <option value=\"1959\" >1959</option>
 <option value=\"1958\" >1958</option>
 <option value=\"1957\" >1957</option>
 <option value=\"1956\" >1956</option>
 <option value=\"1955\" >1955</option>
 <option value=\"1954\" >1954</option>
 <option value=\"1953\" >1953</option>
 <option value=\"1952\" >1952</option>
 <option value=\"1951\" >1951</option>
 <option value=\"1950\" >1950</option>
 </SELECT>
		</td>
		<td width=\"16\"><img id=\"d_ro_i\" name=\"d_ro_i\" src=\"i/markfalse.gif\"></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td nowrap colspan=\"4\" id=\"d_ro_err\" name=\"d_ro_err\"><font color=#dd3333></font></td>
	</tr>

	<tr>
		<td nowrap width=\"118\">Ваш пол  <b style='COLOR: Red'>*</b></td>
		<td width=\"180\">
		<SELECT name=sex style=\"width: 160;\" onkeyup=check_correct('sex',0) onchange=check_correct('sex',1) onblue=\"check_correct('sex',1)\">
		<OPTION value=n selected>Выберите</OPTION>
		<OPTION value=1 >- Мужской</OPTION>
		<OPTION value=2 >- Женский</OPTION>
		</SELECT></td>
		<td width=\"16\"><img id=\"sex_i\" name=\"sex_i\" src=\"i/markfalse.gif\"></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td nowrap colspan=\"4\" id=\"sex_err\" name=\"sex_err\"><font color=#dd3333></font></td>
	</tr>
	
<tr>
<td>&nbsp;Раса: (<b style='COLOR: Red'>*</b>)</td><td align=center>
<select name=rase style='WIDTH: 85px'>
<option>
<option value=1"; if ($rase==1) echo" selected"; echo">Орк
<option value=2"; if ($rase==2) echo" selected"; echo">Эльф
<option value=3"; if ($rase==3) echo" selected"; echo">Человек
<option value=4"; if ($rase==4) echo" selected"; echo">Гном
</select></td>
</tr>
	
	";

	echo "

	

  
  


	<tr>
		<td nowrap width=\"118\">Девиз</td>
		<td colspan=\"2\">
		<input name='deviz' class=input value=\"$deviz\" style='WIDTH: 188' onblur=check_correct('deviz',1) onkeyup=check_correct('deviz',0) maxLength=100 onchange=check_correct('deviz',0)></td>
		<td>От 5 до 100 символов</td>
	</tr>
	<tr>
		<td nowrap colspan=\"4\" id=\"deviz_err\" name=\"deviz_err\"><font color=#dd3333></font></td>
	</tr>
	<tr>
		<td nowrap width=\"118\">Город</td>
		<td colspan=\"2\"><input name='city' class=input  value=\"$city\" style='WIDTH: 188' onblur=check_correct('city',1) onkeyup=check_correct('city',0) maxLength=42 onchange=check_correct('city',0)></td>
		<td>Может состоять тока из рус. или англ. букв от 2 до 42 символов</td>
	</tr>
	<tr>
		<td nowrap colspan=\"4\" id=\"city_err\" name=\"city_err\"><font color=#dd3333></font></td>
	</tr>
	
	<tr>
<td>&nbsp;Вас привел:</td> <td align=center>{$referer}</td>
</tr>


<tr>
<td colspan=4 align=center><br><input type=hidden name=law value=0><input type=checkbox name=law value=1"; if ($law == 1) echo " checked"; echo"> Я обязываюсь придерживаться <a href='law.php' target=_blank>законов</a> «Инстинктов воина»
<br><br></td>
</tr>


<tr>
<td nowrap  colspan=\"3\" align=\"center\"><input type=submit name=register class=input value='Регистрировать' style='WIDTH: 150px'></td>
<td align=center><input type=button class=input value='Закрыть' style='WIDTH: 150px' onclick='window.close();'></td>

</tr>


</table>
</form>
";

}

elseif ($page=="end") {

	$inf=mysql_fetch_array(mysql_query("SELECT * FROM players where user='".addslashes($login)."'"));

	if ($inf[user]!="") {
		if ($inf[active]==0) {

			$title='Название Вашей игры';
			include('inc/html_header.php');

			echo"<body bgcolor=EBEDEC>";

			echo"<table width=350 border=1 bordercolor=CCCCCC cellspacing=0 cellpadding=3>
<tr>
<td align=center><b style='COLOR: Green'>Название Вашей игры - [Регистрация]</b></td>
</tr>
</table><br>
";

			echo"<table width=330 border=1 bordercolor=CCCCCC cellspacing=0 cellpadding=3 height=329><tr><td align=center valign=center>";


			echo"Спасибо за регистрацию <b>$inf[user]</b>!<br>
<br>
<br>

Заходите в игру с главной страницы!
";


			mysql_query("update players set active=1 where id=$inf[id]");

		} else { $title='Название Вашей игры - [Регистрация]';
		include('inc/html_header.php');
		echo"<body bgcolor=EBEDEC>";



		echo"<table width=350 border=1 bordercolor=CCCCCC cellspacing=0 cellpadding=3>
<tr>
<td align=center><b style='COLOR: Green'>Название Вашей игры - [Регистрация]</b></td>
</tr>
</table><br>
";

		echo"<center>Аккаунт был активирован раньше!</center>"; }
	}

	echo"</td></tr></table>";
}


?>
