<?
require_once("inc/module.php");

if ($stat[bloked]) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat['t_time']>$now) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']>$now) { header("Location: academy.php"); exit; }
elseif ($stat['o_time']>$now) { header("Location: juvelir.php"); exit; }
elseif ($stat['r_time']>$now) { header("Location: podzem.php"); exit; }
elseif ($stat['lov_time']>$now) { header("Location: more.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat[room]!="111") { header("Location: main.php"); exit; }
else {

	echo"<body bgcolor=F5FFD9 leftmargin=0 topmargin=0>
<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td align=left>У Вас на счету: <b>".$stat[credits]."</b> зм.</td>
<td align=right valign=top>
<input class=input type=button value='Обновить' onclick='window.location.href=\"mylots.php?otdel=".$otdel."&tmp=\"+Math.random();\"\"'>
<input class=input type=button value='Вернуться' onclick='window.location.href=\"main.php?set=map&room=1&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";


	if (!empty($in)) {
		AddSlashes($tmp);
		if (preg_match("/[^(0-9)]/",$tmp)) { echo '<script>alert("Ошибка")</script>';
		exit;
		}
		if (is_numeric($tmp) && $tmp>0) {

			$ob=mysql_fetch_array(mysql_query("SELECT objects.* FROM objects, slots where objects.user='".$stat[user]."' and objects.bank='0' AND objects.komis='0' AND objects.lam='0' and objects.id='".addslashes($tmp)."' AND slots.id=".$stat['id']." AND objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19)"));


			if ($ob['tip']==1) $otdel=1; #оружие
			if ($ob['tip']==2 || ($ob['tip']>=5 && $ob['tip']<=10)) $otdel=2; # шмотки
			if ($ob['tip']==3 || $ob['tip']==4 || $ob['tip']==11) $otdel=3; # ювелирка
			if ($ob['tip']==12 || $ob['tip']==16) $otdel=4; # магия
			if ($ob['tip']>=17 && $ob['tip']<=19) $otdel=5; # подарки (прочее)
			$obj_inf=explode("|",$ob['inf']);
			if (!empty($ob['id'])) {
				AddSlashes($price);
				if (preg_match("/^[0-9]+$/", $price)){
					if ($price>=($obj_inf['2']*50)/100) {
						if ($price<=($obj_inf['2']*150)/100) {
							require_once("inc/chat/functions.php");
							insert_msg("Вы удачно выложили <b>\"".$obj_inf[1]."\"</b> на прилавок, по цене <b>\"".$price."\"</b> зм.!","","","1",$stat[user],"",$stat[room]);
							mysql_query("UPDATE objects set mag=1, cena=".addslashes($price).", tmp=$now+600, prod=".$stat[id].", otdel=$otdel where id=$ob[id]");
						} else echo"<br><center><font color=red><b>Максимальная цена должна состовлять не более 150% от гос. цены товара</b></font></center>";
					} else echo"<br><center><font color=red><b>Минимальная цена должная состовлять не менее 50% от гос. цены товара</b></font></center>";
				} else echo"<br><center><font color=red><b>Вещь не добавлена, т.к. произошла непредвиденая ошибка или вы не заполнилу форму!</b></font></center>";
			} else echo"<br><center><font color=red><b>Предмет не найден в Вашем рюкзаке!</b></font></center>";

		}
	}
	elseif (!empty($out)) {
		AddSlashes($tmp);
		if (preg_match("/[^(0-9)]/",$tmp)) { echo '<script>alert("Ошибка")</script>';
		exit;
		}
		if (is_numeric($tmp) && $tmp>0) {


			$ob=mysql_fetch_array(mysql_query("SELECT objects.* FROM objects, slots where objects.user='".$stat[user]."' and objects.bank='0' AND objects.komis='0' AND objects.lam='0' AND objects.pochta='0' and objects.id='".addslashes($tmp)."' AND slots.id=".$stat['id']." AND objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19)"));

			if (!empty($ob['id'])) {
				$obj_inf=explode("|",$ob['inf']);
				require_once("inc/chat/functions.php");
				insert_msg("Вы удачно сняли с прилавка <b>\"".$obj_inf[1]."\"</b>!","","","1",$stat[user],"",$stat[room]);
				mysql_query("UPDATE objects set mag=0, cena=0, tmp=0 where id=$ob[id]");
			}
			else echo"<br><center><font color=red><b>Предмет не найден в Вашей ячейке!</b></font></center>";
		}
	}
	elseif (!empty($buy)) {
		AddSlashes($tmp);
		if (preg_match("/[^(0-9)]/",$tmp)) { echo '<script>alert("Ошибка")</script>';
		exit;
		}
		if (is_numeric($tmp) && $tmp>0) {


			$ob=mysql_fetch_array(mysql_query("SELECT * FROM objects where id='".addslashes($tmp)."'"));
			$obp=mysql_fetch_array(mysql_query("SELECT room, user FROM players where id='".$ob[prod]."'"));
			$obj_inf=explode("|",$ob['inf']);
			if (!empty($ob['id'])) {
				if ($ob['cena']<=$stat['credits']) {

					echo"<br><center><font color=red><b>Вы удачно купили предмет <b>\"".$obj_inf[1]."\"</b> по цене <b>\"".$ob[cena]."\"</b> зм.</b></font></center>";

					mysql_query("UPDATE players set credits=credits+$ob[cena] where id=$ob[prod]");
					mysql_query("UPDATE players set credits=credits-$ob[cena] where id=$stat[id]");
					mysql_query("UPDATE objects set user='".$stat[user]."', mag=0, tmp=0 where id=$ob[id]");
					require_once("inc/chat/functions.php");
					insert_msg("У вас удачно купили предмет <b>\"".$obj_inf[1]."\"</b> за <b>\"".$ob[cena]."\"</b> зм.","","","1",$obp[user],"",$obp[room]);
				} else echo"<br><center><font color=red><b>У Вас недостаточно денег для покупки предмета <u>".$obj_inf['1']."</u></b></font></center>";

			}
			else echo"<br><center><font color=red><b>Предмет не найден!</b></font></center>";
		}
	}



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
            <tr><td colspan='2'>
            <div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr>";

	echo"<td align=center width=20%><a ";  if ($otdel==1) echo" disabled";
	else echo"href='?otdel=1'"; echo"><b>Оружие</b></td>";

	echo"<td align=center width=20%><a ";  if ($otdel==2) echo" disabled";
	else echo"href='?otdel=2'"; echo"><b>Амуниция</b></td>";

	echo"<td align=center width=20%><a ";  if ($otdel==3) echo" disabled";
	else echo"href='?otdel=3'"; echo"><b>Ювелирные изделия</b></td>";

	echo"<td align=center width=20%><a ";  if ($otdel==4) echo" disabled";
	else echo"href='?otdel=4'"; echo"><b>Магические предметы</b></td>";

	echo"<td align=center width=20%><a ";  if ($otdel==5) echo" disabled";
	else echo"href='?otdel=5'"; echo"><b>Прочее</b></td>";

	echo"</tr>
</table>
</div>
            </td></tr>
<tr>
                <td width='50%' valign='top'>";

	echo "<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
    <td width='25%'><b>Название</b></td> 
    <td width='25%'><b>Гос. цена</b></td> 
    <td width='25%'><b>Цена</b></td>
    <td width='25%'><b>Действие</b></td>
    </tr>";

	$object=mysql_query("SELECT objects.* FROM objects, slots WHERE objects.user='".$stat['user']."' and objects.bank='0' AND objects.komis='0' AND objects.lam='0' AND objects.pochta='0' AND slots.id=".$stat['id']." AND objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) ORDER BY time");

	for($i=0; $i<mysql_num_rows($object); $i++) {
		$objects=mysql_fetch_array($object);
		$obj_inf=explode("|",$objects['inf']);

		## убираем из торговки

		if ($objects[mag]==1 && $objects[tmp]>=$now) {
			echo"
<tr>
<td width='25%'>".$obj_inf['1']."</td>
<td width='25%'><b>".$obj_inf['2']."</b> зм.</td>
<td width='25%'><b>".$objects['cena']."</b> зм.</td>
<td width='25%'><input class=input type=button value='Удалить' onclick='window.location.href=\"?out=".$obj_inf['0']."&tmp=$objects[id]\"'></td>
</tr>
";
		}
		#######

		## Ставим на торговлю
		else { echo "";
		echo"<form method=post action=mylots.php>
<input type=hidden name=in value='".$obj_inf['0']."'>
<input type=hidden name=tmp value='".$objects[id]."'>
<tr>
<td width='25%'>".$obj_inf['1']."</td>
<td width='25%'><b>".$obj_inf['2']."</b> зм.</td>
<td width='25%'><input class='input' type=text name=price></td>
<td width='25%'><input type=submit class='input' name=in  value='Выставить'></td>
</tr></form>
";
		}
		#######
	}

	echo"</tr></table></div>";
	echo "</td>
     <td width='50%' valign='top'>";


	if (!empty($otdel)) {

		$prodat=mysql_query("SELECT * FROM objects where tmp>$now AND mag=1 and otdel=".addslashes($otdel)." ORDER BY cena");
		if (mysql_num_rows($prodat)) {
			for($i=0; $i<mysql_num_rows($prodat); $i++) {
				$iteminfo=mysql_fetch_array($prodat);
				$obj_inf=explode("|",$iteminfo['inf']);
				$obj_infi=explode("|",$iteminfo['min']);

				include('inc/main/classes.php');
				include('inc/main/myitm.php');

				if ($iteminfo['tmp']>=$now) {
					echo"<br>
                        <div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
      <td width='30%' align='center'>
                        <img src='i/items/".$obj_inf['0'].".gif' alt='".$obj_inf['1']."'><br>
                        <span onclick=\"if (confirm('Купить предмет &quot;".$obj_inf['1']."&quot;?')) window.location='?buy=".$obj_inf['0']."&tmp=$iteminfo[id]'\" style='CURSOR: Hand'><b>Купить</b></a>
      </td>
      <td width='70%'>
      <small><b>".$obj_inf['1']."</b><br>
      Выставленная цена: <b>".$iteminfo['cena']."</b> зм.<br>
      Гос. Цена: <b>".$obj_inf['2']."</b> зм.<br>
        Долговечность предмета: <b>".$obj_inf['6']."</b>/<b>".$obj_inf['7']."</b><br><br>
        
        Хозяин предмета: <a href='inf.php?login=".$iteminfo['user']."' target=_blank><b>".$iteminfo['user']."</b></a><br><br>
                       
        <b><i>Минимальные требования:</i></b><br>
        $min_rase$min_level$min_str$min_dex$min_ag$min_vit$min_razum$min_proff<br></small>";

        if ($hp || $energy || $uron || $strength || $dex || $agility || $vitality || $razum || $br1 || $br2 || $br5 || $br3 || $br4 || $krit || $unkrit || $uv || $unuv) echo"<b><i>Действие предмета:</i></b><br>
        $hp$energy$uron$strength$dex$agility$vitality$razum$br1$br2$br5$br3$br4$krit$unkrit$uv$unuv<br>";
        echo"
       </td>";
				}
			}        echo"</tr></table></div>";
		}  else echo "<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'>В этом отделе нет вещей на продажу</td></tr></table></div>";


	} else echo"<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>Информация:</b></td></tr><tr><td>
- Сдесь вы можете выставить любую вещь на продажу<br>
- Вещь в списке будет находиться <b>10 минут</b>, после его заявка на продажу удаляется<br>
- Цена вещи выставленная на продажу <b>не должна</b> привышать <b>150%</b> от гос. цены<br>
- Цена вещи выставленная на продажу <b>не может</b> быть меньше <b>50%</b> от гос. цены<br>
</td>
</tr>
</table>
</div>";





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