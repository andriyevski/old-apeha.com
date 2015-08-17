<?
require_once("inc/module.php");
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat['t_time']>$now) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']>$now) { header("Location: academy.php"); exit; }
elseif ($stat['o_time']>$now) { header("Location: juvelir.php"); exit; }
elseif ($stat['r_time']>$now) { header("Location: podzem.php"); exit; }
elseif ($stat['lov_time']>$now) { header("Location: more.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }

else {

	echo"<body background='/i/bg.gif' leftmargin=0 topmargin=0>";

	print"<table width=100% cellspacing=0 cellpadding=5 border=0 background='/i/bg2.gif'>
<tr><td align=right valign=top>
<INPUT class=input type=button value='Помощь' onclick='window.open(\"help/brak.php\",\"\",\"\");'>
<input class=lbut type=button value='Обновить' onclick='window.location.href=\"bog_hram2.php?tmp=\"+Math.random();\"\"'>
<input class=lbut type=button value='Назад' onclick='window.location.href=\"world5.php?room=35&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";

	//Обвенчать
	if ($_POST['obvin']){
		if ($stat['proff'] !=8)
		$error = "У вас нет прав, обвинчать может только жрец!";
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
			elseif ($muj['credits']<10)
			$error = "Нахватает денег";
			else{
				$mu = mysql_query("UPDATE `players` SET credits=credits-10,semija='".$jena['user']."' WHERE user='".$muj['user']."'");
				$jen = mysql_query("UPDATE `players` SET semija='".$muj['user']."' WHERE user='".$jena['user']."'");
				if($mu && $jen){
					$msg = "Брак успешна состоялся.";
				}else{
					$error = "Брак не состоялся.";
				}
			}
		}

	}
	// END


	//Развод
	if ($_POST['razv']){
		if ($stat['proff']!=8)
		$error = "У вас нет прав, разводить может только жрец!";
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
			elseif ($razv['credits']<10)
			$error = "Нахватает денег";
			else{
				$raz = mysql_query("UPDATE `players` SET credits=credits-10,semija='' WHERE user='".$razv['user']."'");
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

	include("inc/html_header.php");



	echo"<table width=100% cellspacing=0 cellpadding=3 border=0>
        <tr>
        <td align=right style='padding-left: 20px'>
        <center><font class=title>Дворец Бракосочетания</font></center><br>";

	if (!empty($error)) echo"<center><FONT COLOR=RED><b>$error</b></font></center><BR>";
	if (!empty($msg)) echo"<center><font color=green><b>$msg</b></font></center><br>";

	if ($stat['proff']!=8)
	echo "<fieldset style='WIDTH: 100%; margin-right:20; float:left'><br><center><FONT COLOR=RED><b>Регестрировать брак может тока \"Жрец\"</b></font></center><br></fieldset><br><br>";
	else {
		echo "<fieldset style='WIDTH: 45%; margin-right:20; float:left'><legend>Обвенчать</legend>
        	<table width=100% cellspacing=0 cellpadding=5>
			 <tr>
			 <td align=center>
        	<form method='POST' action='' method=post style='margin:0; padding:0;'>
				<table cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1>
				<tr>
					<td align='center'>Муж <input type='text' class=input name='muj' size='20'> Жена <input type='text' class=input name='jena' size='20'> <input type='submit' class=input value='Обвенчать' name='obvin'></td>
				</tr>
				<tr>
					<td align='center'>Стоимость брака <b>10 зм.</b> (Берутся с Мужа)</td>
				</tr>
				</table>
			</form>
			</td>
			 </tr>
			 </table>
        	</fieldset>";
		echo "<fieldset style='WIDTH: 45%; margin-right:20; float:left'><legend>Развести</legend><br>
        	<table width=100% cellspacing=0 cellpadding=5>
			 <tr>
			 <td align=center>
        	<form method='POST' action='' method=post style='margin:0; padding:0;'>
				<table cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1>
				<tr>
					<td align='center'>Логин <input type='text' class=input name='login' size='20'> <input type='submit' class=input value='Развести' name='razv'></td>
				</tr>
				<tr>
					<td align='center'>Стоимость развода <b>10 зм.</b></td>
				</tr>
				</table>
			</form>
			</td>
			 </tr>
			 </table>
        	</fieldset>";
	}



	echo"
        </td>
        </tr>
        </table>";

}

?>