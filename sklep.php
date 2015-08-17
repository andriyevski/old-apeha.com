<?
$now=time();
include("inc/db_connect.php");
$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));

if ($stat['t_time']>$now) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']>$now) { header("Location: academy.php"); exit; }
elseif ($stat['o_time']>$now) { header("Location: juvelir.php"); exit; }
elseif ($stat['r_time']>$now) { header("Location: podzem.php"); exit; }
elseif ($stat['lov_time']>$now) { header("Location: more.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat['room']!=500) { header("Location: main.php"); exit; }

else {

	include("inc/html_header.php");

	echo"<body leftmargin=0 topmargin=0>
<DIV id=hint1></DIV>
<div id=mainform style='position:absolute; left:30px; top:30px'></div>";

	echo "<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/show_inf.js\"></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/time.js\"></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/login_form.js\"></SCRIPT>";


	##############         Если мы попали в турнир, и еще живы      ##############
	if ($stat[bs] == 1) {
		include "bs_start.php";
		die();
	}
	##############         Если мы попали в турнир, и еще живы      ##############
	##############             Если турнир еще не начался           ##############
	else {

		echo"<body bgcolor=F5FFD9 leftmargin=0 topmargin=0>
<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td align=left>У Вас на счету: <b>".$stat[credits]."</b> зм.</td>
<td align=right valign=top>
<input class=input type=button value='Обновить' onclick='window.location.href=\"sklep.php?tmp=\"+Math.random();\"\"'>
<input class=input type=button value='Вернуться' onclick='window.location.href=\"world2.php?room=35&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";


		##############        Подачи заявки на участие в турнире        ##############
		if ($act == "j0in") {
			if ($cash >= 3) {
				if ($stat['credits'] >= 3) {
					$t = 1;
					mysql_query("INSERT INTO bs VALUES('$stat[user]','$t','$cash') ");
					mysql_query("UPDATE players set credits=credits-$cash where user='$stat[user]'");
					require_once("inc/chat/functions.php");
					insert_msg("Вы удачно подали заявку на турнир, добавив <b>$cash</b> зм. в банк турнира.","","","1",$stat[user],"",$stat[room]);
				} else $msg="У вас не хватает зм.";
			} else $msg="Минимальная ставка 3 зм.";
			$t = 0;
		}
		##############        Подачи заявки на участие в турнире        ##############
		##############        Подачи заявки на участие в турнире        ##############
		if ($act == "joins"){
			if ($cash > 0) {
				if ($stat['credits'] >= 3) {
					mysql_query("UPDATE bs set cash=cash+$cash where user='$stat[user]' AND t='$t'");
					mysql_query("UPDATE players set credits=credits-$cash where user='$stat[user]'");

					require_once("inc/chat/functions.php");
					insert_msg("Вы удачно добавили в банк турнира <b>$cash</b> зм.","","","1",$stat[user],"",$stat[room]);

				} else $msg="У вас не хватает зм.";
			} else $msg="Введите положительную сумму.";
		}
		##############        Подачи заявки на участие в турнире        ##############
		##############        Собираем данные о будующем турнире        ##############
		$all_cash_t1 = 0;
		$sel_t1 = mysql_query("SELECT * FROM bs WHERE t='1'");
		$all_t1 = mysql_num_rows($sel_t1);
		if ($all_t1) {
			while ($s_t1 = mysql_fetch_array($sel_t1)) {
				$all_cash_t1 = $all_cash_t1+$s_t1[cash];
			}
		}
		$sel = mysql_query("SELECT * FROM bs WHERE user='$stat[user]'");
		if (mysql_num_rows($sel) > 0) {
			$s = mysql_fetch_array($sel);
			$act = 14124124;
			$t = $s[t];
		}


		$time = date('d.m.y H:i:s',$now);
		$time_d = date('d',$now);
		$time_h = (int)date('H',$now);
		$time_m = (int)date('i',$now);
		$time_s = (int)date('s',$now);
		$sss = (21-$time_h)*60*60 - $time_m*60 - $time_s;

		if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center>";


		echo "<table border='0' width='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='100%' align='center'>
     <table border='0' width='100%' height='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='22' height='100%'>
    <table border='0' width='22' height='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='22' height='25'>
<img src='i/inman_b11.gif' width='22' height='25' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='69'><img src='i/inman_b12.gif' width='22' height='69' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='100%' background='i/inman_b13.gif'>&nbsp;</td>
  </tr>
  <tr>
    <td width='22' height='69'><img src='i/inman_b14.gif' width='22' height='69' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='25'><img src='i/inman_b15.gif' width='22' height='25' alt=''></td>
  </tr>
</table>
    </td>
    <td height='100%'>
      <table border='0' width='100%' height='100%' cellspacing='0' cellpadding='0'>
        <tr>
          <td width='100%' height='25'>
          <table border='0' width='100%' height='25' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='51' height='25'>
<img src='i/inman_b211.gif' width='51' height='25' alt=''></td>
    <td background='i/inman_b212.gif' valign='middle'>
    <table border='0' height='22' cellspacing='0' cellpadding='0'>
  <tr>
<td width='96' height='22'>&nbsp;</td>

  </tr>
</table>
   
    </td>
    <td width='51' height='25'>
<img src='i/inman_b213.gif' width='51' height='25' alt=''></td>
  </tr>
</table>
          </td>
        </tr>
        <tr>
          <td width='100%' height='100%' background='i/inman_fon.gif'>
            <table border='0' width='100%' height='100%' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 3'>
            <tr><td valign='top' width='30%'>";

		echo "<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>Подача заявки</b></td></tr>
<tr><td valign='top'>";

		##############        Собираем данные о будующем турнире        ##############
		$chek=mysql_num_rows(mysql_query("SELECT * FROM players where bs=1"));
		if ($chek >=2) {
			echo "Турнир еще не кончился, дождитесь его окончания.";
		}
		##############     Форма подачи заявки на участие в турнире     ##############
		elseif (!$act) {
			echo"
       <form name=add action=sklep.php?act=j0in&t=1 method='POST'>
       Начало турнира: <b>21:00</b> <small>(по серверу)</small><br/>";
			if (21 > $time_h) {
				echo "До начала турнира: <span style='font-size: 8pt;'><b id='bs'></b></span><script>ShowTime('bs',",$sss,");</script><br/>
<META HTTP-EQUIV=\"Refresh\" CONTENT=\"$sss; URL=\">";
			}
			echo "Призовой фонд на текущий момент: <b>$all_cash_t1</b> зм.<br/>
       Всего подано заявок: <b>$all_t1</b> шт.<br/>
       Ваша ставка: <input type=text size=5 value='' name=cash class=input> зм<br/>
       <input type=submit value='Принять участие' class=input>";
		}
		##############     Форма подачи заявки на участие в турнире     ##############
		############## Если заявка уже подана, но время еще не началось ##############
		elseif ($t == "1") {
			echo "
       <form name=add action=sklep.php?act=joins&t=1 method='POST'>
       Начало турнира: <b>21:00</b> <small>(по серверу)</small><br/>";
			if (21 > $time_h) {
				echo "До начала турнира: <span style='font-size: 8pt;'><b id='bs'></b></span><script>ShowTime('bs',",$sss,");</script><br/>
<META HTTP-EQUIV=\"Refresh\" CONTENT=\"$sss; URL=\">";
			}
			echo "Призовой фонд на текущий момент: <b>$all_cash_t1</b> зм.<br/>
       Всего подано заявок: <b>$all_t1</b> шт.<br/>
       Ваша ставка: <input type=text size=5 value='' name=cash class=input> зм<br/>
       <input type=submit value='Принять участие' class=input>";
		}
		############## Если заявка уже подана, но время еще не началось ##############
		##############             Если турнир еще не начался           ##############
		##############     Форма подачи заявки на участие в турнире     ##############
		elseif ($t == "0") {
			echo "Турнир еще не кончился, дождитесь его окончания.";
		}
		##############     Форма подачи заявки на участие в турнире     ##############
	}
	echo "</td></tr></table></div></form></td>";

	echo "<td valign='top' width='70%'><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>Информация</b></td></tr>
<tr><td valign='top'>";

	echo "<b>\"Смертельная Башня\"</b> – специальное сторение в котором проводятся турниры.<br>
Минимальная ставка составляет <b>3</b> зм. Для участия в турнире из желающих отбирается <b>20</b> человек по принципу <b>максимальной ставки</b>. Учтите, если ваша ставка не попала в <b>20 самых высоких</b>, то в <b>\"Смертельная Башня\"</b> вы не попадете, и даже более того – потеряете свои деньги <small>(они останутся в призовом фонде)</small>.<br>
Турниры проводятся регулярно, <b>1 раз в день</b> <small>(в <b>21:00</b> по серверу)</small>. В <b>\"Смертельная Башня\"</b> вы входите в голом виде, одеваться можно только в те вещи, которые вы найдете в комнатах Башни <small>(если вам хватит параметров и умений, разумеется)</small>. Внутри башни можно драться с другими игроками, им можно передать предметы найденные в башне. Проигравший в бою персонаж выбывает из турнира.<br>
<b>Цель турнира</b> – остаться единственным живым участником. Победитель турнира получает <b>весь призовой фонд</b> <small>(он складывается из суммы ставок)</small>.";

	echo "</td></tr></table></div>";



	echo " </td>
                </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td width='100%' height='25'>
          <table border='0' width='100%' height='25' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='51' height='25'>
<img src='i/inman_b231.gif' width='51' height='25' alt=''></td>
    <td background='i/inman_b232.gif'>&nbsp;</td>
    <td width='51' height='25'>
<img src='i/inman_b233.gif' width='51' height='25' alt=''></td>
  </tr>
</table>

          </td>
        </tr>
      </table>
    </td>
    <td width='22' height='100%'>
    <table border='0' width='22' height='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='22' height='25'>
<img src='i/inman_b21.gif' width='22' height='25' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='69'><img src='i/inman_b22.gif' width='22' height='69' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='100%' background='i/inman_b23.gif'>&nbsp;</td>
  </tr>
  <tr>
    <td width='22' height='69'><img src='i/inman_b24.gif' width='22' height='69' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='25'><img src='i/inman_b25.gif' width='22' height='25' alt=''></td>
  </tr>
</table>
   </td>
  </tr>
</table>
      
      </td>
  </tr>
</table>";
}
?>