<?
include("inc/db_connect.php");

$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."' LIMIT 1"));
$now = time();

if ($stat['t_time']>$now) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']>$now) { header("Location: academy.php"); exit; }
elseif ($stat['o_time']>$now) { header("Location: juvelir.php"); exit; }
elseif ($stat['r_time']>$now) { header("Location: podzem.php"); exit; }
elseif ($stat['lov_time']>$now) { header("Location: more.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat['room']!=34) { header("Location: main.php"); exit; }

else {
	include("inc/html_header.php");
	echo"<script language=JavaScript src=i/show_inf.js></script>
<script language=JavaScript src=i/time.js></script>";

	echo "<body background='/i/bg.gif' leftmargin=0 topmargin=0>
<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td align=left>У Вас на счету: <b>".$stat[credits]."</b> зм.</td>
<td align=right valign=top>
<input class=input type=button value='Обновить' onclick='window.location.href=\"priemka.php?tmp=\"+Math.random();\"\"'>
<input class=input type=button value='Вернуться' onclick='window.location.href=\"world2.php?room=35&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";

	###//Действия

	// Проверка
	function ld_m ($t,$u,$w,$r,$m,$s) {
		global $now;
		mysql_query("INSERT INTO ld (user, writer, mess, time, reason, type, srok) values('".addslashes($u)."', '".addslashes($w)."', '".addslashes($m)."', '".$now."', '".addslashes($r)."', '".addslashes($t)."', '".addslashes($s)."')");
	}
	if (@$ic) {
		if ($stat['rank'] == 14 || $stat['rank'] >= 99 || $stat[admin]==1) {
			$hinfo = mysql_fetch_array(mysql_query("SELECT user, bloked, ic, room, id FROM players WHERE id='".addslashes($id)."'"));

			if (empty($hinfo['user']))
			$msg = "Пресонаж <u>".$hinfo['user']."</u> не найден в базе!";
			elseif ($hinfo['bloked'])
			$msg = "Пресонаж <u>".$hinfo['user']."</u> заблокирован!";
			elseif ($hinfo['ic'] > $now)
			$msg = "У персонажа ещё действительна предыдущая проверка!";
			else {

				if (mysql_query("UPDATE players SET ic=".(time()+259200)." WHERE user='".$hinfo['user']."'")) {
					ld_m (4,$hinfo['user'],$stat['user'],'',"Помечено, что <U>".$hinfo['user']."</U> чист перед законом.",'');
					mysql_query("delete from priemka where pl_id='".$hinfo['id']."'");
					$stat[ic]=$now+259200;
					require_once("inc/chat/functions.php");
					insert_msg("Проверка у <U>Инквизиторов</U> пройдена удачно. У Вас есть 3 суток для вступления в клан.","","","1",$hinfo['user'],"",$hinfo['room']);
					$msg = "Вы пометили, что персонаж <u>".$hinfo['user']."</u> чист перед законом.";
				}}}}
				//

				if (@$podat) {
					if ($stat['credits']>=100) {
						if ($stat['level']>=4) {
							if ($stat[ic]<=$now) {
								$mes=mysql_fetch_array(mysql_query("SELECT * FROM priemka where pl_id='".$stat['id']."' and status=1"));
								if ($mes) $msg="Вы уже подали заявку, ждите её рассмотрения!";
								$max = mysql_fetch_array(mysql_query("SELECT MAX(id) as id FROM priemka"));
								$NEW_ID = $max['id'] + 1;
								$result =  mysql_query("UPDATE players set credits=credits-100 where id='".$stat['id']."'");
								$stat['credits']=$stat['credits']-100;
								if ($result) {
									$result2 = mysql_query("INSERT INTO `priemka` (`id`,`pl_id`,`status`) VALUES ('".$NEW_ID."','".$stat['id']."','1')");
									if ($result2) {
										$msg="Вы удачно подали заявку, ждите её рассмотрения!";
									}}
							} else $msg="Вы уже прошли проверку, ожидайте ее окончания!";
						} else $msg="У вас не тот уровень, рекомендованный уровень 4!";
					} else $msg="Для проверки необходимо 100 зм, а у вас их нету!";
				}

				###//Конец Действия


				if ($msg!="") echo"<center><font color=red><b>$msg</b></font></center><br>";

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
<tr><td width='100%' valign='top' align='center' colspan='2'>";

				//Инфа
				echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr><td align='center'><b>Информация</b></td></tr>
<tr><td align='center'>Вы находитесь в здании <b>Инквизиции</b>, в этом здании вы сможете подать заявку на чистоту...<br>
В среднем ожидание проверки будет длиться окло <b>24 часа</b>...<br>
Наберитесь терпения, если вы в момент проверки будете в режиме <font color='green'><b>on-line</b></font> то вам будет прислано сообщение о подтверждении ващей заявки.</td>";

				echo"</tr>
</table>
</div>";
				//Конец инфы

				echo "</td></tr>
<tr>
                <td width='50%' valign='top' align='center'>";
				//Подача заявки
				echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr><td align='center'><b>Подача заявки на проверку</b></td></tr>
<tr>";
				$me=mysql_fetch_array(mysql_query("SELECT status FROM priemka where pl_id='".$stat['id']."'"));
				if ($stat[ic]>=$now) echo"<td align=center><I>Вы уже прошли проверку на чистоту. Будит еще длиться: <b id=ic></b><script>ShowTime('ic',",$stat['ic']-$now,");</script></I></td>";
				elseif ($me[status]==1) echo"<td align=center><I>Ваша заявка находится на рассмотрении.</I></td>";
				else echo"<td>Для подачи заявки вам нужно иметь:<br>
- Иметь при себе <b>100</b> зм.<br>
- Ваш уровень должен быть равен или более <b>4-го</b>
<center><input type='button' value='Подать заявку на проверку' class=input style='WIDTH: 256px' onclick='this.disabled=true;window.location.href=\"priemka.php?podat=$now\"'></center></td>";

				echo"</tr>
</table>
</div>";
				//Конец подачи





				echo "</td><td width='50%' valign='top' align='center'>";



				//Вывод 15 Последних заявок!
				echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr><td align='center' colspan='4'><b>Последние 15 заявок</b></td></tr>
<TR>";
				if ($stat['rank'] == 14 || $stat['rank'] >= 99 || $stat[admin]==1) echo"<TD align=center width=5%>#</TD>";
				echo"<TD width=10% align=center><U>#</U></TD><TD align=center><U>Логин</TD><TD align=center><U>Состояние</U></TD></TR>
";

				$zay_ka=mysql_query("SELECT * FROM priemka where status=1 order by id DESC LIMIT 0,15");
				if (mysql_num_rows($zay_ka)) {
					for($num=0; $num<mysql_num_rows($zay_ka); $num++) {  $n+=1;
					$zayavka=mysql_fetch_array($zay_ka);
					$avt = mysql_fetch_array(mysql_query("select user, id, level, rank, tribe from players where id='".$zayavka['pl_id']."'"));

					echo"
<tr>";
					if ($stat['rank'] == 14 || $stat['rank'] >= 99 || $stat[admin]==1) echo"<TD align='center'><A HREF=\"priemka.php?ic=$now&id=$avt[id]\"><IMG SRC=i/join.gif align=left title='Сделать проверку'></A></TD>";
					echo"<TD align=center>$n</TD>
<TD align=center>
<SCRIPT language=JavaScript>
show_inf('$avt[user]','$avt[id]','$avt[level]','$avt[rank]','$avt[tribe]');
</SCRIPT>
</TD>
<TD align=center>На рассмотрении</TD></tr>";
					}
				} else echo"<tr><td colspan=4><center>Новых Заявок Не Подано!</center></td></tr>";

				echo"</table></div>";
				//Конец вывода




				echo"
  </td>
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