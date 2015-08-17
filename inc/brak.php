<?

include("inc/db_connect.php");
$now=time();

$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));
mysql_query("SET CHARSET cp1251");
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat['t_time']) { header("Location: prison.php"); exit; }
elseif ($stat['v_time']) { header("Location: ambulance.php"); exit; } // Редиректим в больницу
elseif ($stat['k_time']) { header("Location: academy.php"); exit; } // Редиректим в академию
elseif ($stat['o_time']) { header("Location: juvelir.php"); exit; }
elseif ($stat['r_time']) { header("Location: podzem.php"); exit; }
elseif ($stat['mol_bog_swet']) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']) { header("Location: bog_hram.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat['room']!=16) { header("Location: main.php"); exit; }
else {

	$title = 'Дворец Бракосочетания';
	include("inc/html_header.php");

	echo"
<script LANGUAGE='JavaScript'>
document.ondragstart = test;
//запрет на перетаскивание
document.onselectstart = test;
//запрет на выделение элементов страницы
document.oncontextmenu = test;
//запрет на выведение контекстного меню

function test() {
 return false
}
</SCRIPT>";

	echo"<body background='i/town/bgg2.gif'><link href='city.css' rel='stylesheet' type='text/css'>
<div id=hint1 class=hint></div>

<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td align=left>У Вас на счету: <b>".$stat[credits]."</b> зм.</td>
<td align=right valign=top>
<img src='i/help.gif' style='CURSOR: Hand' alt='Помощь - Священники Онлайн' onclick='window.open(\"help/brak.php\",\"\",\"\");'>
<img src='i/refresh.gif' style='CURSOR: Hand' alt='Обновить' onclick='window.location.href=\"brak.php?tmp=\"+Math.random();\"\"'>
<img src='i/back.gif' style='CURSOR: Hand' alt='Вернуться' onclick='window.location.href=\"world5.php?room=&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";

	// Обвенчать
	if ($_POST['obvin']){
		if ($stat['admin']!=1 && $stat['proff']!=3)
		$error = "У вас нет прав!";
		elseif (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)|(\<>)|(\|(\<)|(\>)|(\%3B)|(\")|]/",$_POST['muj']))
		$error = "Логин Мужа имеет запрещенные символы.";
		elseif (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)|(\<>)|(\|(\<)|(\>)|(\%3B)|(\")|]/",$_POST['jena']))
		$error = "Логин Жены имеет запрещенные символы.";
		elseif (trim($_POST['muj'])=="" || trim($_POST['jena'])=="")
		$error = "Пустое поле.";
		elseif ($_POST['muj']==$_POST['jena'])
		$error = "Одинаковые Имена";
		else {
			$muj = mysql_fetch_array(mysql_query("select user, sex, semija, credits from players where user='".addslashes($_POST['muj'])."'"));
			$jena = mysql_fetch_array(mysql_query("select user, sex, semija from players where user='".addslashes($_POST['jena'])."'"));

			if (!$muj['user'])
			$error= 'Игрок "'.$_POST['muj'].'" не найден.';
			elseif (!$jena['user'])
			$error= 'Игрок "'.$_POST['jena'].'" не найден.';
			elseif ($muj['sex']!=1)
			$error = "У Мужа должен быть мужской пол";
			elseif ($jena['sex']!=2)
			$error = "У Жены должен быть женский пол";
			elseif ($muj['semija'])
			$error= 'Игрок "'.$_POST['muj'].'" уже женат';
			elseif ($jena['semija'])
			$error= 'Игрок "'.$_POST['jena'].'" уже замужем';
			elseif ($muj['credits']<100)
			$error = "Нахватает денег";
			else{        	$mu = mysql_query("UPDATE `players` SET credits=credits-100,semija='".$jena['user']."' WHERE user='".$muj['user']."'");
			$jen = mysql_query("UPDATE `players` SET semija='".$muj['user']."' WHERE user='".$jena['user']."'");
			if($mu && $jen){
				$msg = "Брак успешна состоялся.";
			}else{
				$error = "Брак не состоялся.";
			}        }
		}

	}
	// END


	// Развод
	if ($_POST['razv']){
		if ($stat['admin']!=1 && $stat['proff']!=3)
		$error = "У вас нет прав!";
		elseif (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)|(\<>)|(\|(\<)|(\>)|(\%3B)|(\")|]/",$_POST['login']))
		$error = "Логин имеет запрещенные символы.";
		elseif (trim($_POST['login'])=="")
		$error = "Пустое поле.";
		else {
			$razv = mysql_fetch_array(mysql_query("select user, semija, credits from players where user='".addslashes($_POST['login'])."'"));

			if (!$razv['user'])
			$error= 'Игрок "'.$_POST['login'].'" не найден.';
			elseif(!$razv['semija'])
			$error= 'Игрок "'.$_POST['login'].'" не состоит в браке.';
			elseif ($razv['credits']<100)
			$error = "Нахватает денег";
			else{
				$raz = mysql_query("UPDATE `players` SET credits=credits-100,semija='' WHERE user='".$razv['user']."'");
				$raz2 = mysql_query("UPDATE `players` SET semija='' WHERE user='".$razv['semija']."'");
				if($raz && $raz2){
					$msg = "Развод состоялся.";
				}else{
					$error = "Развод не состоялся.";
				}
			}
		}

	}
	// END


	echo"<body background='i/town/bgg2.gif'><link rel=stylesheet type='text/css' href='city.css'>

<table width='100%' border='0' cellspacing='0' cellpadding='0' align=center >
							<tr height='22'>
							<td width='20' align='right' valign='bottom'><img src='i/town/tbl-shp_sml-corner-top-left.gif' width='20' height='22' /></td>
							<td class='tbl-shp_sml-top' valign='top' align='center'>
								<table border='0' cellspacing='0' cellpadding='0' >
										<tr height='22'>
											<td width='27'><img src='i/town/tbl-usi_label-left.gif' width='27' height='22'/></td>
											<td align='center' class='tbl-usi_label-center'>Дворец Бракосочетания</td>
											<td width='27'><img src='i/town/tbl-usi_label-right.gif' width='27' height='22'/></td>
										</tr>
								</table>
							</td>
							<td width='20' align='left' valign='bottom'><img src='i/town/tbl-shp_sml-corner-top-right.gif' width='20' height='22'/></td>
							</tr>
							<tr>
									<td class='tbl-usi_left'>&nbsp;</td>
									<td class='tbl-usi_bg' valign='top' style='padding: 6 4 6 4'>

<table width=100% height=100% border=0 cellpadding=0 cellspacing=0>
<tr>
              <td valign=top align=center colspan=3 width=100%>";

	if ($msg!="") echo"<center><font color=red><b>$msg</b></font></center><br>";

	if ($stat['admin']!=1 && $stat['proff']!=3)
	echo "<br><center><FONT COLOR=RED><b>Регистрировать брак может только \"Священник\"</b></font></center><br>
                  <center><img src='i/backgrounds/cerkov.jpg' width='925' height='227' alt='Церковь'></center>";
	else {
		echo "
        	<table width=100% cellspacing=0 cellpadding=5>
			 <tr>
			 <td align=center>
        	<form method='POST' action='' method=post style='margin:0; padding:0;'>
				<table cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1>
				<tr>
					<td align='center'>Муж <input type='text' class=input name='muj' size='20'> Жена <input type='text' class=input name='jena' size='20'> <input type='submit' class=input value='Обвенчать' name='obvin'></td>
				</tr>
				<tr>
					<td align='center'>Стоимость брака <b>100 зм.</b> (Берутся с Мужа)</td>
				</tr>
				</table>
			</form>
			</td>
			 </tr>
			 </table>";
		echo "
        	<table width=100% cellspacing=0 cellpadding=5>
			 <tr>
			 <td align=center>
        	<form method='POST' action='' method=post style='margin:0; padding:0;'>
				<table cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1>
				<tr>
					<td align='center'>Логин <input type='text' class=input name='login' size='20'> <input type='submit' class=input value='Развести' name='razv'></td>
				</tr>
				<tr>
					<td align='center'>Стоимость развода <b>100 зм.</b></td>
				</tr>
				</table>
			</form>
			</td>
			 </tr>
			 </table>";
		echo "<center><img src='i/backgrounds/cerkov.jpg' width='925' height='250' alt='Церковь'></center>";
	}





	echo"
</td>
</tr>
</table>
</td><td class='tbl-usi_right' align=left>&nbsp;</td>
							</tr>

														<tr height='18'>
							<td width='20' align='right' valign='top'><img src='i/town/tbl-shp_sml-corner-bottom-left.gif' width='20' height='18' /></td>
							<td class='tbl-shp_sml-bottom' valign='top' align='center'>&nbsp;   </td>
							<td width='20' align='left' valign='top'><img src='i/town/tbl-shp_sml-corner-bottom-right.gif' width='20' height='18'/></td>
							</tr></table>";



}

?>