<?
$now=time();
$hourdiff = "0";
$timeadjust = ($hourdiff * 60 * 60);
$this_time = date("d.m.y.H.i",time() + $timeadjust);
$times = date("H.i",time() + $timeadjust);
$date_seans = date("d.m.y.H",time() + $timeadjust);
$day_seans = date("d",time() + $timeadjust);
$hour_seans = date("H",time() + $timeadjust);
$min_seans = date("i",time() + $timeadjust);
include("inc/db_connect.php");
include("inc/html_header.php");

$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));


$myzay = mysql_fetch_array(mysql_query("select * from tower where user='".addslashes($user)."'"));


if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat['t_time']>time()) { header("Location: prison.php"); exit; }
elseif ($stat['w_time']>time()) { header("Location: works.php"); exit; } // Редиректим в ворку
elseif ($stat['o_time']>time()) { header("Location: repair.php"); exit; }

elseif ($stat['forest_time']>time()) { header("Location: forest2.php"); exit; }
elseif ($stat['battle']>time()) { header("Location: battle.php"); exit; }
//elseif ($stat['room'] != 49) { header("Location: main.php"); exit; }


else {
	if ( $seans == 1 ) { $cena = 100; $timeseans = 1; }
	elseif ( $seans == 2 ) { $cena = 100; $timeseans = 7; }


	//Начало покупки лодки
	if ($kup) {
		if ($hour_seans < '20') {
			if ($stat[credits] >= $cena) { // Проверка денег
				if ($stat[level] >= 8) { // Проверка левела
					if (!$myzay[seans]) {



						//if ($day_seans == '03' and $seans == 1) {
						$msg="Вы подали заявку на турнир. Стоимость заявки составила <u>$cena</u> зм!";

						mysql_query("UPDATE players set credits=credits-$cena where user='".$stat['user']."'");

						mysql_query("INSERT INTO tower values ('".$stat['user']."','".$timeseans."','0','0')");

						echo "<meta http-equiv='refresh' content='3; url=tower.php'>";


						//} else $msg="111!";
					} else $msg="Вы уже подали заявку на 1 турнир, дождитесь его начала!";
				} else $msg="У вас не тот уровень, рекомендованный уровень 8!";
			} else $msg="У вас не хватает Золота!";
		} else $msg="Регистратура закрыта, приходите завтра";
	}







	if ($perexod) {
		if ($myzay[seans]) {
			if ($stat[level] >= 8) { // Проверка левела
				if ($myzay[seans] == 1) {
					if (($hour_seans == 20 and $min_seans > 45) or ($hour_seans == 21 and $min_seans <5)) {

						mysql_query("UPDATE players set room=49, location=790 where user='".$stat['user']."'");
						mysql_query("UPDATE slots set slots.1=0, slots.2=0, slots.3=0, slots.4=0, slots.5=0, slots.6=0, slots.7=0, slots.8=0, slots.9=0, slots.10=0, slots.11=0, slots.12=0, slots.13=0, slots.14=0, slots.15=0, slots.16=0, slots.17=0, slots.18=0, slots.19=0 WHERE id='$stat[id]'");

						$stat['room']=49;
						require_once("inc/chat/functions.php");
						insert_msg("Вы удачно вошли в башню","","","1",$stat[user],"",$stat[room]);
						echo "<meta http-equiv='refresh' content='0; url=tower_map/map.php'>";
					} else $msg="Ворота открыты только в указанное время!";
				}



				elseif ($myzay[seans] ==7) {
					//if ($day_seans==1 or $day_seans==8 or $day_seans==15 or $day_seans==22 or $day_seans==29) {
					if (($hour_seans == 20 and $min_seans > 45) or ($hour_seans == 21 and $min_seans <5)) {
						mysql_query("UPDATE players set room=49, location=790 where user='".$stat['user']."'");
						mysql_query("UPDATE slots set slots.1=0, slots.2=0, slots.3=0, slots.4=0, slots.5=0, slots.6=0, slots.7=0, slots.8=0, slots.9=0, slots.10=0, slots.11=0, slots.12=0, slots.13=0, slots.14=0, slots.15=0, slots.16=0, slots.17=0, slots.18=0, slots.19=0 WHERE id='$stat[id]'");

						$stat['room']=49;
						require_once("inc/chat/functions.php");
						insert_msg("Вы удачно вошли в башню, в 21.00 автоматически будет доступно нападение и турнир начнется!Удачи!","","","1",$stat[user],"",$stat[room]);
						echo "<meta http-equiv='refresh' content='0; url=tower_map/map.php'>";
					}else $msg="Ворота открыты только в указанное время!";
					//}else $msg="Турнир проходит строго по указанным дням!";
				}
			}else $msg="У вас не тот уровень, рекомендованный уровень 8!";
		}else $msg="Ваша заявка не найденна!";
	}
	//Конец перехода в море

	include("inc/html_header.php");

	echo"<body bgcolor=F5FFD9 leftmargin=0 topmargin=0>";

	echo"
<body background='/i/bg.gif' leftmargin=0 topmargin=0>
<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
        <td><b>У вас на счету:</b> <u>".$stat[credits]."</u> <b>зм.</b>
        </td>
<td align=right valign=top>
<input class=input type=button value='Обновить' onclick='window.location.href=\"tower.php\"'>
<input class=input type=button value='Вернуться' onclick='window.location.href=\"world.php?room=0&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";

	if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";


	echo "<form action='' method=post><table border='0' width='100%' cellspacing='0' cellpadding='0'>
 
            <table border='0' width='100%' height='100%' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 3'>
            <tr><td valign='top'>";

	echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center' colspan='2'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Регистратура:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td></tr>

	
  <tr>

    <td width='50%' align='center'><b>Ежедневный турнир</b></td>
    <td width='50%' align='center'><b>Еженедельный турнир</b></td>

  </tr>
  <tr>

    <td width='50%' align='center' ><img src='i/items/propusk.gif'></td>
    <td width='50%' align='center'><img src='i/items/propusk.gif'></td>
  </tr>
  <tr>
    <td width='50%' align='center'>Начало: 21.00<br>Каждый день</td>
    <td width='50%' align='center'>Начало: 21.00<br>Каждое 1,8,15,22,29 числа месяца </td>

  </tr>
  <tr>
    <td width='50%' align='center'><b>100 зм</b></td>
    <td width='50%' align='center'><b>100 зм</b></td>

  </tr>
  <tr>
 <td width='100%' colspan='2' align='center'>
Заявка на <select name=seans><option value=1>ежедневный турнир<option value=2>еженедельный турнир</select> <input type=submit class=input value='подать' name=kup>
</td>
  </tr>
</table>
</div>
";


	echo "</td><td valign='top'>";



	echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>Ваша заявка:</b></td></tr>
  <tr><td>";
	if ($myzay[seans]==1) {
		echo "Начало боя: Сегодня в <b>21.00</b>(по серверу)";
		echo "<br>
Возможности: <b>Разрешается все!!!(использование всех своих предметов(вход в инвентарь открыт), свитков,эликсиров) </b><br>Победитель получает: <b>опыт</b> полученный за успешные бои, несколько <b>драгоценных камней</b> и <b>2 эликсира</b>
<br>Проигравшие получают: только <b>опыт</b> за успешные бои"; 
	}
	elseif ($myzay[seans]==7) {
		echo "Начало боя: 1,8,15,22,29 числа месяца в <b>21.00</b>(по серверу)";
		echo "<br>
Возможности: <b>Запрещенно пользоваться своими предметами.(использование только тех предметов, которые вы нашли в башне) </b><br>Победитель получает: <s><b>опыт</b> полученный за бои, несколько <b>драгоценных камней</b>,<b>2 эликсира и призовой артефакт, до завершения следующего турнира - Шлем победителя</b>
<br>Проигравшие получают: <b>опыт</b> за успешные бои и <b>тяжелую травму</b></s><b>   Временно, пока башня работает в тестовом режиме приз только опыт</b>"; 
	} else {
		echo "У вас заявкок.";



	}

	echo"</td>
  </tr>
</table>
</div>
";

	echo "<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>Старт</b></td></tr>
<tr><td valign='top'>
 <s>- Для старта в турнире должно учавствовать минимум <b>15 человек</b><br></s>
 - Ворота башни открыты <b>с 20.45 по 21.05</b><br>
 - В случае неявки заявка <b>отменяется без возврата денег</b><br><br>
 
 PS: Выход из турнирной башни осуществляется там же где и вход, т.е. локация под номером 790</b>

<center><input type=submit class=input value='Войти в башню' name=perexod></center>
</td></tr></table></div>";



}
?>