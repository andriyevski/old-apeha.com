<?
$now=time();
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
elseif ($stat[room]!="33") { header("Location: main.php"); exit; }
else {
	$otdel=$_GET['otdel'];
	if (!isset($otdel)) $otdel=1;



	if (@$prodat) {
		AddSlashes($num);
		if (preg_match("/[^(0-9)]/",$num)) { echo '<script>alert("Ошибка")</script>';
		exit;
		}
		if ($num==0) { $msg="Тупо! Я думаю все понимают что нельзя продать 0 ед. ресурсов!"; } else {
			if ($stat[$n]>=$num) {
				$pr=ceil($p*$num);
				$re=mysql_query("UPDATE lavka set kol_vo=kol_vo+$num where id=$id");
				if ($re){
					$re1=mysql_query("UPDATE players set credits=credits+$pr where id=$stat[id]");
					$stat['credits']=$stat['credits']+$pr;
				} else $msg="Ошибка";
				if ($re1){
					$re2=mysql_query("UPDATE players set $n=$n-$num where id=$stat[id]");
					$stat[$n]=$stat[$n]-$num;
				} else $msg="Ошибка 1";
				if ($re2){
					$msg="Обмен прошел удачно!";
				} else $msg="Ошибка 2";
			} else $msg="У вас нет столько ед. ресурсов $t!";
		}
		echo $num;
	}

	if (@$kup) {
		AddSlashes($num);
		if (preg_match("/[^(0-9)]/",$num)) { echo '<script>alert("Ошибка")</script>';
		exit;
		}
		if ($num==0) {$msg="Тупо! Я думаю все понимают что нельзя купить 0 ед. ресурсов!"; } else {
			$pr=ceil($p*$num);
			if ($pr<=$stat['credits']) {
				$kol=mysql_fetch_array(mysql_query("SELECT kol_vo FROM lavka WHERE id=$id"));
				if ($kol[kol_vo]>=$num) {
					$re=mysql_query("UPDATE lavka set kol_vo=kol_vo-$num where id=$id");
					if ($re){
						$re1=mysql_query("UPDATE players set credits=credits-$pr where id=$stat[id]");
						$stat['credits']=$stat['credits']-$pr;
					} else $msg="Ошибка";
					if ($re1){
						$re2=mysql_query("UPDATE players set $n=$n+$num where id=$stat[id]");
						$stat[$n]=$stat[$n]+$num;
					} else $msg="Ошибка 1";
					if ($re2){
						$msg="Обмен прошел удачно!";
					} else $msg="Ошибка 222";
				} else $msg="Лавка не обладает такими запасами ресурса $t!";
			} else $msg="У вас нехватает денег что бы купить $t!";
		}
	}
	if (@$vikup) {
		AddSlashes($num);
		if (preg_match("/[^(0-9)]/",$num)) { echo '<script>alert("Ошибка")</script>';
		exit;
		}
		if ($num==0) {$msg="Тупо! Я думаю все понимают что нельзя купить 0 ед. ресурсов!"; } else {
			$pr=ceil($p*$num);
			if ($pr<=$stat['credits']) {
				$re=mysql_query("UPDATE players set credits=credits-$pr where id=$stat[id]");
				$stat['credits']=$stat['credits']-$pr;
				if ($re){
					$re2=mysql_query("UPDATE players set $n=$n+$num where id=$stat[id]");
					$stat[$n]=$stat[$n]+$num;
				} else $msg="Ошибка";
				if ($re2){
					$msg="Обмен прошел удачно!";
				} else $msg="Ошибка 2";
			} else $msg="Нехватает денег для покупки $t!";
		}
	}

	include("inc/html_header.php");

	echo"
<SCRIPT LANGUAGE=JavaScript>
<!--

function key() {
if (event.keyCode < 48 || event.keyCode > 57) {
event.keyCode = 0;
return false;
}
}

//-->
</SCRIPT>
";

	echo"<body background='/i/bg.gif' leftmargin=0 topmargin=0>
<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td align=left>У Вас на счету: <b>".$stat[credits]."</b> зм.</td>
<td align=right valign=top>
<input class=input type=button value='Обновить' onclick='window.location.href=\"lavka.php?otdel=".$otdel."&tmp=\"+Math.random();\"\"'>
<input class=input type=button value='Вернуться' onclick='window.location.href=\"world2.php?room=35&tmp=\"+Math.random();\"\"'>
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
                <td width='100%' valign='top' align='center'>";

	echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>";

	echo"<td align=center width=33%><a ";  if ($otdel==1 || !isset($otdel) || empty($otdel)) echo" disabled"; else echo"href='?otdel=1'"; echo"><b>Продажа ресурсов</b></td>";
	echo"<td align=center width=33%><a ";  if ($otdel==2) echo" disabled"; else echo"href='?otdel=2'"; echo"><b>Покупка ресурсов</b></td>";
	echo"<td align=center width=33%><a ";  if ($otdel==3) echo" disabled"; else echo"href='?otdel=3'"; echo"><b>VIP Отдел</b></td>";
	echo"</tr>
</table>
</div><br>";

	if ($msg!="") echo"<center><font color=red><b>$msg</b></font></center><br>";


	if (!empty($otdel)) {





		echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'>";
		if ($otdel==1) echo"<b>В данном разделе вы можете продать добытые вами ресурсы за <u>зм</u>.</b><br>Список приведен ниже...";
		elseif ($otdel==2) echo"<b>В данном разделе вы можете купить ресурсы находящиеся на складе.</b><br>Список приведен ниже...";
		elseif ($otdel==3) echo"<b>В данном разделе вы можете купить любое кол-во ресурсов.</b><br>Список приведен ниже...";
		else echo"<b>Входной Текст</b>";

		echo"</td></tr>
</table>
</div><br>";





		$res=mysql_query("SELECT title, kol_vo, name, price, id FROM lavka");
		if (mysql_num_rows($res)) {

			echo"<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr><td align='center'><b>#</b></td>
<td align='center'><b>Кол-во</b></td>
<td align='center'><b>Курс</b></td>
<td align='center'><b>Обозначение</b></td>
<td align='center'><b>Действие</b></td>
</tr>";

			for($num=0; $num<mysql_num_rows($res); $num++) {
				$re=mysql_fetch_array($res);

				if ($otdel==1) $price="$re[price]";
				elseif ($otdel==2) $price=round($re[price]*2);
				elseif ($otdel==3) $price=round($re[price]*3);
				else $price="1000000";



				echo"
<FORM action='lavka.php?otdel=".$otdel."' method=post>
<TR>
<input type=hidden name=id value='".$re[id]."'>
<input type=hidden name=p value='".$price."'>
<input type=hidden name=n value='".$re[name]."'>
<input type=hidden name=t value='".$re[title]."'>

<td align='center'><IMG SRC='i/res/$re[name].gif'></td>
<td align='center'><INPUT Type=text size=3 class=input name=num value='0' onkeypress=\"key();\"> / ";
				if ($otdel==1) echo"<B>".$stat[$re[name]]."</B> ед.";
				if ($otdel==2) echo"<B>".$re[kol_vo]."</B> ед.";
				if ($otdel==3) echo"<B>???</B> ед.";
				echo "</td>
<td align='center'><B>1 к $price</td>
<td align='center'><B>$re[title]</B></td>
<td align='center'>";
				if ($otdel==1) echo"<input type=submit value='Заказать обмен' name=prodat class=input>";
				if ($otdel==2) echo"<input type=submit value='Купить ресурсы' name=kup class=input>";
				if ($otdel==3) echo"<input type=submit value='Купить ресурсы' name=vikup class=input>";

				else echo"";

				echo"
</TD></TR>
</form>
";
			}
		} else echo"<center>Пустой Отдел, ждите пополнения!</center>";

		echo"</table>
</div><br>";

	} else echo"<center><b>Добро пожаловать нах :)</b></center>";





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