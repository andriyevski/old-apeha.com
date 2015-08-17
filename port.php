<?
require_once("inc/module.php");
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat[t_time]) { header("Location: prison.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat['room'] != 700) { header("Location: main.php"); exit; }
elseif ($stat['o_time']>time()) { header("Location: juvelir.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }

else {

	if ( $lodka == 1 ) { $cena = 100; }
	elseif ( $lodka == 2 ) { $cena = 150; }
	elseif ( $lodka == 3 ) { $cena = 200; }
	elseif ( $lodka == 4 ) { $cena = 250; }

	//Начало покупки лодки
	if ($kup) {
		if ($stat[credits] >= $cena) { // Проверка денег
			if ($stat[lodka] != $lodka) { //Проверка на то что если у тя такая же лодка которую ты хочешь купить
				if ($stat[level] >= 4) { // Проверка левела

					$msg="Вы удачно купили себе лодку уровня <u>$lodka</u> за <u>$cena</u> зм!";

					mysql_query("UPDATE players set lodka=$lodka, credits=credits-$cena where user='".$stat['user']."'");
					$stat[lodka]=$lodka;

					echo "<meta http-equiv='refresh' content='0; url=port.php'>"; }

					else $msg="У вас не тот уровень, рекомендованный уровень 4!"; }
					else $msg="У вас такая же лодка!"; }
					else $msg="У вас не хватает Золота!"; }
					//Конец покупки лодки

					//Начало перехода в море
					if ($perexod) {
						if ($stat[lodka] >= 1) { // Проверка на имение лодки
							if ($stat[level] >= 4) { // Проверка левела

								mysql_query("UPDATE players set room=702 where user='".$stat['user']."'");
								$stat['room']=702;

								require_once("inc/chat/functions.php");
								insert_msg("Вы удачно вышли в море","","","1",$stat[user],"",$stat[room]);

								echo "<meta http-equiv='refresh' content='0; url=more.php'>"; }

								else $msg="У вас не тот уровень, рекомендованный уровень 4!"; }
								else $msg="У вас нет лодки, купите ее сначала!"; }
								//Конец перехода в море

								include("inc/html_header.php");

								echo"<body background='/i/bg.gif' leftmargin=0 topmargin=0>";

								print"<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td align=left>У Вас на счету: <b>".$stat[credits]."</b> зм.</td>
<td align=right valign=top>
<input class=input type=button value='Обновить' onclick='window.location.href=\"port.php?tmp=\"+Math.random();\"\"'>
<input class=input type=button value='Назад' onclick='window.location.href=\"world2.php?room=35&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";


								if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";


								echo "<form action='' method=post><table border='0' width='100%' cellspacing='0' cellpadding='0'>
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
            <tr><td valign='top'>";


								echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center' colspan='4'><b>Покупка лодки:</b></td></tr>
  <tr>
    <td width='25%' align='center'><b>Старая лодка</b></td>
    <td width='25%' align='center'><b>Легкая лодка</b></td>
    <td width='25%' align='center'><b>Лодка</b></td>
    <td width='25%' align='center'><b>Улучшенная лодка</b></td>
  </tr>
<tr>
    <td width='25%' align='center'><img src='i/more/lodka1.gif'></td>
    <td width='25%' align='center'><img src='i/more/lodka2.gif'></td>
    <td width='25%' align='center'><img src='i/more/lodka3.gif'></td>
    <td width='25%' align='center'><img src='i/more/lodka4.gif'></td>
  </tr>
  <tr>
    <td width='25%' align='center'>+1 к скорости передвижения</td>
    <td width='25%' align='center'>+2 к скорости передвижения</td>
    <td width='25%' align='center'>+3 к скорости передвижения</td>
    <td width='25%' align='center'>+4 к скорости передвижения</td>
  </tr>
  <tr>
    <td width='25%' align='center'><b>100 зм</b></td>
    <td width='25%' align='center'><b>150 зм</b></td>
    <td width='25%' align='center'><b>200 зм</b></td>
    <td width='25%' align='center'><b>250 зм</b></td>
  </tr>
  <tr>
    <td width='100%' colspan='4' align='center'>
Приобрести <select name=lodka><option value=1>Старая лодка +1<option value=2>Легкая лодка +2<option value=3>Лодка +3<option value=4>Улучшенная лодка +4</select> <input type=submit class=input value='Купить' name=kup>
</td>
  </tr>
</table>
</div>
";


								echo "</td><td valign='top'>";



								echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>Ваша лодка:</b></td></tr>
  <tr><td>";
								if ($stat['lodka'] != 0) {
									echo "Название: <b>";
									if ( $stat['lodka'] == 1 ) { echo "Старая лодка"; }
									elseif ( $stat['lodka'] == 2 ) { echo "Легкая лодка"; }
									elseif ( $stat['lodka'] == 3 ) { echo "Лодка"; }
									elseif ( $stat['lodka'] == 4 ) { echo "Улучшенная лодка"; }
									echo "</b><br>
<center><img src='i/more/lodka".$stat['lodka'].".gif'></center>
Возможности: <b>+".$stat['lodka']." к скорости передвижения</b>"; 
								} else {
									echo "У вас нет лодки.";
								}

								echo"</td>
  </tr>
</table>
</div>
";

								echo "<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>Плавание</b></td></tr>
<tr><td valign='top'>
 - Для плавания вам нужна <b>Лодка</b><br>
 - Для рыбалки вам нужна удочка<br>
 - Для нападения в море вам нужен свиток <b>Пиратство</b><br>
 - <font color='red'><b>Внимание!!!</b></font> Советуем приобрести в <b>Гос. Магазине</b> свиток <b>Морского Телепорта</b>, т.к. в море легко можно заблудится.
<center><input type=submit class=input value='Выйти в море' name=perexod></center>
</td></tr></table></div>";

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
</table></form>";


}
?>