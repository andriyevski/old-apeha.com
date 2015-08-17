<?
require_once("inc/module.php");
include("inc/db_connect.php");
$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));
if ($stat[bloked]) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat['t_time']>$now) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']>$now) { header("Location: academy.php"); exit; }
elseif ($stat['o_time']>$now) { header("Location: juvelir.php"); exit; }
elseif ($stat['r_time']>$now) { header("Location: podzem.php"); exit; }
elseif ($stat['lov_time']>$now) { header("Location: more.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat[room]!="46") { header("Location: main.php"); exit; }
else {

	echo"<body background='/i/bg.gif' leftmargin=0 topmargin=0>
<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td align=right valign=top>
<input class=input type=button value='Обновить' onclick='window.location.href=\"lambards.php?tmp=\"+Math.random();\"\"'>
<input class=input type=button value='Вернуться' onclick='window.location.href=\"world.php?room=25&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";


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
<tr>
                <td width='50%' valign='top'>

<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
<td align='center'><b>Ваша статистика:</b></td></tr>
<tr>
        <td>У Вас на счету: <b>".$stat[credits]."</b> зм.
        <br>Сдано вещей: <b>".mysql_num_rows(mysql_query("SELECT id FROM objects WHERE lam=1 and user='".$stat['user']."'"))."</b> шт.
        </td></tr>
</table>
</div>
<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>Информация:</b></td></tr><tr><td>
- Вы можете сдать в <b>Ломбард</b> свою вещь за <b>50%</b> от её стоимости.<br>
- В течении <b>1 недели</b> вы её должны выкупить, в противном случае <b>Ломбард</b> её оставляет себе.<br>
- Цена выкупа вещи из <b>Ломбарда</b> составляет <b>70%</b> от её стоимости.
</td>
</tr>
</table>
</div>";
	$it_sost1=mysql_query("SELECT objects.* FROM objects, slots where objects.user='".$stat['user']."' AND objects.present=0 AND objects.bank=0 AND objects.komis=0 AND objects.lam=1 AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) ORDER BY time desc");
	if (mysql_num_rows($it_sost1)) {
		for($i=0; $i<mysql_num_rows($it_sost1); $i++) {
			$objects=mysql_fetch_array($it_sost1);

			$obj_inf=explode("|",$objects['inf']);
			$obj_min=explode("|",$objects['min']);
			$obj_add=explode("|",$objects['add']);

			include('inc/main/min_tr.php');
			include('inc/main/add.php');
			include('inc/main/classes.php');

			$sale_price=round($obj_inf['2']*0.5);
			$get_price=round($obj_inf['2']*0.7);

			echo"<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
      <td align='center' colspan='2'>
        <b>В хранилище Ломбарда:</b>
      </td>
    </tr>
    <tr><td width='30%' align='center'>
      <img src='i/items/".$obj_inf['0'].".gif' alt='".$obj_inf['1']."'><br>";
			echo"<span onclick=\"if (confirm('Забрать предмет &quot;".$obj_inf['1']."&quot; за &quot;".$get_price."&quot; зм.?')) window.location='lambards.php?get=".$objects['id']."'\" style='CURSOR: Hand'><font color='red'><b>Забрать за ".$get_price." зм.</b></font>";
			echo"</td>
        <td width='70%'>
        <small><b>".$obj_inf['1']."</b><br>
        Гос цена: ".$obj_inf['2']." зм.</small><br>";
			if ($objects['tip'] != 13 || $objects['tip'] != 15  || $objects['tip'] != 20) echo"<font ".($obj_inf[6]>=$obj_inf[7]?'color=red':'color=black')."><SMALL>Долговечность: ".$obj_inf['6']." [".$obj_inf['7']."]</SMALL></font><br>";
			echo "<br><SMALL><b><u>Минимальные требования:</u></b><br>
			$min_rase$min_level$min_str$min_dex$min_ag$min_vit<br>
        <B><U>Действие предмета:</U></B><br>
        $hp$energy$uron$strength$dex$agility$vitality$razum$br1$br2$br5$br3$br4$krit$unkrit$uv$unuv</SMALL>";

        if ($objects['about']) echo"<SMALL><b><u>Дополнительная информация:</u></b><br>$about</SMALL>";
        if ($obj_inf['3']) echo"<b><u><small>Выгравирована надпись:</u></b><BR>".$obj_inf['3'];
        echo "</tr>
  </table>
</div>";
		}
	} else echo"<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
      <td align='center'>
        <b>В хранилище Ломбарда:</b>
      </td>
    </tr>
    <tr>
      <td align='center'>
        <a class=agree>Хранилище Ломбарда пусто!</a>
      </td>
    </tr>
  </table>
</div>";
	echo "</td>
     <td width='50%' valign='top'>";

	if (!empty($sale) && is_numeric($sale)) {
		// здаём
		$sale = addslashes($sale);

		$is_ex=mysql_fetch_array(mysql_query("SELECT objects.`id`,objects.`inf`,objects.`tip` FROM objects, slots WHERE objects.user='".$stat['user']."' AND objects.present=0 && objects.id=".addslashes($sale)." AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19)"));

		$is_ex_inf=explode("|",$is_ex['inf']);

		if (!empty($is_ex_inf['0'])) {
			if ($is_ex['tip'] != 12) {
				$price=round($is_ex_inf['2']*0.5);
				$srok="$now+604800";

				mysql_query("UPDATE objects SET lam=1, dat=$srok WHERE id=".addslashes($sale)."");
				mysql_query("UPDATE players SET credits=credits+".$price." WHERE id=".$stat['id']."");

				$stat['credits']=$stat['credits']+$price;

				$msg="Вы удачно сдали этот предмет <u>".$is_ex_inf['1']."</u> за <u>".$price."</u> зм.<br>Страница обновится через 3 секунды, подождите...";

				echo "<meta http-equiv='refresh' content='3; url=lambards.php'>";

				$is_ex_inf['0'] = "";
			}
			else $msg="Предмет <u>".$is_ex_inf['1']."</u> не подледжит продаже!";
		}
		else echo"Предмет не найден в Вашем рюкзаке!";
	}

	if (!empty($get) && is_numeric($get)) {
		// забераем
		$get = addslashes($get);

		$is_ex=mysql_fetch_array(mysql_query("SELECT objects.`id`,objects.`inf`,objects.`tip` FROM objects, slots WHERE objects.user='".$stat['user']."' AND objects.present=0 && objects.id=".addslashes($get)." AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19)"));

		$is_ex_inf=explode("|",$is_ex['inf']);

		if (!empty($is_ex_inf['0'])) {
			if ($is_ex['tip'] != 12) {

				$price=round($is_ex_inf['2']*0.7);
				if ($stat['credits'] > $price) {
					mysql_query("UPDATE objects SET lam=0, dat=0 WHERE id=".addslashes($get)."");
					mysql_query("UPDATE players SET credits=credits-".$price." WHERE id=".$stat['id']."");

					$stat['credits']=$stat['credits']-$price;

					$msg="Вы удачно забрали этот предмет <u>".$is_ex_inf['1']."</u> за <u>".$price."</u> зм.<br>Страница обновится через 3 секунды, подождите...";

					echo "<meta http-equiv='refresh' content='3; url=lambards.php'>";

					$is_ex_inf['0'] = "";
				}
				else $msg="У вас недостаточно средств для выкупа <u>".$is_ex_inf['1']."</u> !";
			}
			else $msg="Предмет <u>".$is_ex_inf['1']."</u> не подледжит продаже!";
		}
		else echo"Предмет не найден в Вашем рюкзаке!";
	}

	if ($msg!="") echo"<center><font color=red><b>$msg</b></font></center>";

	$it_sost=mysql_query("SELECT objects.* FROM objects, slots where objects.user='".$stat['user']."' AND objects.present=0 AND objects.bank=0 AND objects.komis=0 AND objects.lam=0 AND objects.pochta=0 AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) ORDER BY time desc");
	if (mysql_num_rows($it_sost)) {
		for($i=0; $i<mysql_num_rows($it_sost); $i++) {
			$objects=mysql_fetch_array($it_sost);

			$obj_inf=explode("|",$objects['inf']);
			$obj_min=explode("|",$objects['min']);
			$obj_add=explode("|",$objects['add']);

			include('inc/main/min_tr.php');
			include('inc/main/add.php');
			include('inc/main/classes.php');

			$sale_price=round($obj_inf['2']*0.5);
			$get_price=round($obj_inf['2']*0.7);

			echo"<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
      <td align='center' colspan='2'>
        <b>В вашем рюкзаке:</b>
      </td>
    </tr>
    <tr><td width='30%' align='center'>
      <img src='i/items/".$obj_inf['0'].".gif' alt='".$obj_inf['1']."'><br>";
			echo"<span onclick=\"if (confirm('Сдать предмет &quot;".$obj_inf['1']."&quot; за &quot;".$sale_price."&quot; зм.?')) window.location='lambards.php?sale=".$objects['id']."'\" style='CURSOR: Hand'><font color='green'><b>Сдать за ".$sale_price." зм.</b></font>";
			echo"</td>
        <td width='70%'>
        <small><b>".$obj_inf['1']."</b><br>
        Гос цена: ".$obj_inf['2']." зм.</small><br>";
			if ($objects['tip'] != 13 || $objects['tip'] != 15  || $objects['tip'] != 20) echo"<font ".($obj_inf[6]>=$obj_inf[7]?'color=red':'color=black')."><SMALL>Долговечность: ".$obj_inf['6']." [".$obj_inf['7']."]</SMALL></font><br>";
			echo "<br><SMALL><b><u>Минимальные требования:</u></b><br>
			$min_rase$min_level$min_str$min_dex$min_ag$min_vit<br>
        <B><U>Действие предмета:</U></B><br>
        $hp$energy$uron$strength$dex$agility$vitality$razum$br1$br2$br5$br3$br4$krit$unkrit$uv$unuv</SMALL>";

        if ($objects['about']) echo"<SMALL><b><u>Дополнительная информация:</u></b><br>$about</SMALL>";
        if ($obj_inf['3']) echo"<b><u><small>Выгравирована надпись:</u></b><BR>".$obj_inf['3'];
        echo "</tr>
  </table>
</div>";
		}
	} else echo"<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
      <td align='center'>
         <b>В вашем рюкзаке:</b>
      </td>
    </tr>
    <tr>
      <td align='center'>
        <a class=agree>Отдел рюкзака пуст!</a>
      </td>
    </tr>
  </table>
</div>";
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