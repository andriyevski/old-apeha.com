<?
include('inc/header.php');

$oshib = "У Вас не хватает сп.";
$kup = "Удачно куплено";

$now = time();

/*if (isset($take4)) {
	if ($stat['valute'] >= 5) {
		mysql_query("UPDATE players SET le4=$now+14400, valute=valute-5 WHERE user='".$stat['user']."'");
		$stat['valute']=$stat['valute']-5;
		$msg="$kup 1 час. ускоренного лечения в 2 раза за 5 сп!";
	} else $msg="" . $oshib;
}*/

if (isset($take20)) {
	if ($stat['valute'] >= 90 and $stat['sign']<time()) {
		mysql_query("UPDATE players SET `abonement`=$now+2592000, `valute`=`valute`-90 WHERE `user`='".$stat['user']."'");
		$stat['valute']=$stat['valute']-90;
		$msg="$kup Абонемент на 30 дней за 90 сп!";
	} else $msg="" . $oshib;
}

if (isset($take15)) {
	if ($stat['valute'] >= 5) {
		mysql_query("UPDATE players SET credits=credits+50000, valute=valute-5 WHERE user='".$stat['user']."'");
		$stat['valute']=$stat['valute']-5;
		$msg="$kup 50 000 зм за 5 сп!";
	} else $msg="" . $oshib;
}

if (isset($take5)) {
	if ($stat['valute'] >= 10 and $stat['abonement']<time()) {
		mysql_query("UPDATE players SET sign=$now+14400, valute=valute-10 WHERE user='".$stat['user']."'");
		$stat['valute']=$stat['valute']-5;
		$msg="$kup 4 час. умноженного получения опыта в 3 раз за 10 сп!";
	} else $msg="" . $oshib;
}

if (isset($take6)) {
	if ($stat['valute'] >= 5) {
		mysql_query("UPDATE players SET s_updates=s_updates+1, valute=valute-5 WHERE user='".$stat['user']."'");
		$stat['s_update']=$stat['s_update']+1;
		$stat['valute']=$stat['valute']-5;
		$msg="$kup 1 шт. свободного параметра за 5 сп!";
	} else $msg="" . $oshib;
}

if (isset($take7)) {
	if ($stat['valute'] >= 45) {
		mysql_query("UPDATE players SET s_updates=s_updates+10, valute=valute-45 WHERE user='".$stat['user']."'");
		$stat['s_update']=$stat['s_update']+10;
		$stat['valute']=$stat['valute']-45;
		$msg="$kup 10 шт. свободного параметра за 45 сп!";
	} else $msg="" . $oshib;
}

if (isset($take8)) {
	if ($stat['valute'] >= 30) {
		mysql_query("UPDATE players SET o_updates=o_updates+1, valute=valute-30 WHERE user='".$stat['user']."'");
		$stat['o_update']=$stat['o_update']+1;
		$stat['valute']=$stat['valute']-30;
		$msg="$kup 1 шт. свободной особенности за 30 сп!";
	} else $msg="" . $oshib;
}

if (isset($take12)) {
	if ($stat['valute'] >= 1) {
		mysql_query("UPDATE players SET travma=0 WHERE user='".$stat['user']."'");
		mysql_query("UPDATE players SET valute=valute-1 WHERE user='".$stat['user']."'");
		$stat['travma']=0;
		$stat['valute']=$stat['valute']-1;
		$msg="$kup Изличение травм за 1 сп!";
	} else $msg="" . $oshib;
}

if (isset($take14)) {
	if ($stat['valute'] >= 1) {
		mysql_query("UPDATE players SET attack=attack-1,bite=bite-1 WHERE user='".$stat['user']."'");
		mysql_query("UPDATE players SET valute=valute-1 WHERE user='".$stat['user']."'");
		$stat['valute']=$stat['valute']-1;
		$msg="$kup обновление 1 абилити!";
	} else $msg="" . $oshib;
}


if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";
echo "
<table border='0' width='100%' cellspacing='0' cellpadding='0'>
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
            <table border='0' width='100%' height='100%' cellspacing='0' cellpadding='0'>
              <tr>
                <td width='100%'>";



echo "<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>Информация для Вас</b></td></tr>
<tr><td>
Ваш логин: <b>$stat[user]</b><br>
ID вашего персонажа: <b>$stat[id]</b><br>
У вас на счету: <b>$stat[valute] сп.</b><br>
Курс: <b>1 сп. = 5 грн</b>, <b>5 сп. = 50 000 зм.</b><br>
<center><b>Пополнить свой счет вы можете обратившись в приват к персонажу migon:</u></b></center>
</td></tr></table></div>";

echo "<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center' colspan='3'><b>Список доступных услуг</b></td></tr>
      <tr>
        <td width=20% align=center><b>Покупка</b></td>
        <td width=65% align=center><b>Название</b></td>
        <td width=15% align=center><b>Стоимость</b></td>
      </tr>
      <tr>
       <td width=20% align=center>";


if ($stat['valute']>=90 and $stat['sign']<time()) echo"<input class=input type=button value='Купить' onClick=top.main.location.href='uslugi.php?take20'>"; else echo "<input disabled class=input type=button value='Купить' onClick=top.main.location.href='main.php?set=work'></td></font>";
echo" </td>
        <td width=65%>Купить абонемент который дает игровые привелегии на 30 дней<br>(<font color=red>Увеличение получаемого опыта в <b>3 раз</b> на 30 дней</font>)</td>
        <td width=15% align=center><b>90 сп.</b></td>
      </tr>
      <tr>
        <td width=20% align=center>";


if ($stat['valute']>=5) echo"<input class=input type=button value='Купить' onClick=top.main.location.href='uslugi.php?take15'>"; else echo "<input class=input type=button value='Не хватает сп.' onClick=top.main.location.href='main.php?set=work'></td></font>";
echo" </td>
        <td width=65%>Купить 50 000 зм</td>
        <td width=15% align=center><b>5 сп.</b></td>
      </tr>
      <tr>
        <td width=20% align=center>"; if ($stat['valute']>=1) echo"<input class=input type=button value='Купить' onClick=top.main.location.href='uslugi.php?take12'>"; else echo "<input class=input type=button value='Не хватает сп.' onClick=top.main.location.href='main.php?set=work'></td></font>";
echo" </td>
        <td width=65%>Излечение травм</td>
        <td width=15% align=center><b>1 сп.</b></td>
      </tr>
       <tr>
        <td width=20% align=center>"; if ($stat['valute']>=1) echo"<input class=input type=button value='Купить' onClick=top.main.location.href='uslugi.php?take14'>"; else echo "<input class=input type=button value='Не хватает сп.' onClick=top.main.location.href='main.php?set=work'></td></font>";
echo" </td>
        <td width=65%>-1 к абилкам</td>
        <td width=15% align=center><b>1 сп.</b></td>
      </tr>
      <tr>
        <td width=20% align=center>"; if ($stat['valute']>=5) echo"<input class=input type=button value='Купить' onClick=top.main.location.href='uslugi.php?take6'>"; else echo "<input class=input type=button value='Не хватает сп.' onClick=top.main.location.href='main.php?set=work'></td></font>";
echo" </td>
        <td width=65%>Свободный физический параметр - <b>1 шт.</b></td>
        <td width=15% align=center><b>5 сп.</b></td>
      </tr>
      <tr>
        <td width=20% align=center>"; if ($stat['valute']>=10 and $stat['abonement']<time()) echo"<input class=input type=button value='Купить' onClick=top.main.location.href='uslugi.php?take5'>"; else echo "<input disabled class=input type=button value='Купить' onClick=top.main.location.href='main.php?set=work'></td></font>";
echo" </td>
        <td width=65%><font color=red>Увеличение получаемого опыта в <b>3 раз</b> на 4 часа</font></td>
        <td width=15% align=center><b>10 сп.</b></td>
      </tr>
      <tr>
        <td width=20% align=center>"; if ($stat['valute']>=5) echo"<input disabled class=input type=button value='Купить' onClick=top.main.location.href='uslugi.php?take4'>"; else echo "<input class=input type=button value='Не хватает сп.' onClick=top.main.location.href='main.php?set=work'></td></font>";
echo" </td>
        <td width=65%><font color=red>Ускоренное лечение в <b>2 раз.</b> на 4 часа</font></td>
        <td width=15% align=center><b>5 сп.</b></td>
      </tr>
      <tr>
        <td width=20% align=center>"; if ($stat['valute']>=45) echo"<input class=input type=button value='Купить' onClick=top.main.location.href='uslugi.php?take7'>"; else echo "<input class=input type=button value='Не хватает сп.' onClick=top.main.location.href='main.php?set=work'></td></font>";
echo" </td>
        <td width=65%>Свободный физический параметр - <b>10 шт.</b></td>
        <td width=15% align=center><b>45 сп.</b></td>
      </tr>
      <tr>
        <td width=20% align=center>"; if ($stat['valute']>=30) echo"<input class=input type=button value='Купить' onClick=top.main.location.href='uslugi.php?take8'>"; else echo "<input class=input type=button value='Не хватает сп.' onClick=top.main.location.href='main.php?set=work'></td></font>";
echo" </td>
        <td width=65%>Свободная особенность - <b>1 шт.</b></td>
        <td width=15% align=center><b>30 сп.</b></td>
      </tr></table></div>";


 
echo"                </td>
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
?>