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
<INPUT class=input type=button value='������' onclick='window.open(\"help/brak.php\",\"\",\"\");'>
<input class=lbut type=button value='��������' onclick='window.location.href=\"bog_hram2.php?tmp=\"+Math.random();\"\"'>
<input class=lbut type=button value='�����' onclick='window.location.href=\"world5.php?room=35&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";

	//���������
	if ($_POST['obvin']){
		if ($stat['proff'] !=8)
		$error = "� ��� ��� ����, ��������� ����� ������ ����!";
		elseif (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)|(\<>)|(\|(\<)|(\>)|(\%3B)|(\")|]/",$_POST['muj']))
		$error = "����� ���� ����� ����������� �������.";
		elseif (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)|(\<>)|(\|(\<)|(\>)|(\%3B)|(\")|]/",$_POST['jena']))
		$error = "����� ���� ����� ����������� �������.";
		elseif (trim($_POST['muj'])=="" || trim($_POST['jena'])=="")
		$error = "������ ����.";
		elseif ($_POST['muj']==$_POST['jena'])
		$error = "���������� �����";
		else {
			$muj = mysql_fetch_array(mysql_query("select user, sex, semija, credits from players where user='".addslashes($_POST['muj'])."'"));
			$jena = mysql_fetch_array(mysql_query("select user, sex, semija from players where user='".addslashes($_POST['jena'])."'"));

			if (!$muj['user'])
			$error= '����� "'.$_POST['muj'].'" �� ������.';
			elseif (!$jena['user'])
			$error= '����� "'.$_POST['jena'].'" �� ������.';
			elseif ($muj['sex']!=1)
			$error = "� ���� ������ ���� ������� ���";
			elseif ($jena['sex']!=2)
			$error = "� ���� ������ ���� ������� ���";
			elseif ($muj['semija'])
			$error= '����� "'.$_POST['muj'].'" ��� �����';
			elseif ($jena['semija'])
			$error= '����� "'.$_POST['jena'].'" ��� �������';
			elseif ($muj['credits']<10)
			$error = "��������� �����";
			else{
				$mu = mysql_query("UPDATE `players` SET credits=credits-10,semija='".$jena['user']."' WHERE user='".$muj['user']."'");
				$jen = mysql_query("UPDATE `players` SET semija='".$muj['user']."' WHERE user='".$jena['user']."'");
				if($mu && $jen){
					$msg = "���� ������� ���������.";
				}else{
					$error = "���� �� ���������.";
				}
			}
		}

	}
	// END


	//������
	if ($_POST['razv']){
		if ($stat['proff']!=8)
		$error = "� ��� ��� ����, ��������� ����� ������ ����!";
		elseif (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)|(\<>)|(\|(\<)|(\>)|(\%3B)|(\")|]/",$_POST['login']))
		$error = "����� ����� ����������� �������.";
		elseif (trim($_POST['login'])=="")
		$error = "������ ����.";
		else {
			$razv = mysql_fetch_array(mysql_query("select user, semija, credits from players where user='".addslashes($_POST['login'])."'"));

			if (!$razv['user'])
			$error= '����� "'.$_POST['login'].'" �� ������.';
			elseif(!$razv['semija'])
			$error= '����� "'.$_POST['login'].'" �� ������� � �����.';
			elseif ($razv['credits']<10)
			$error = "��������� �����";
			else{
				$raz = mysql_query("UPDATE `players` SET credits=credits-10,semija='' WHERE user='".$razv['user']."'");
				$raz2 = mysql_query("UPDATE `players` SET semija='' WHERE user='".$razv['semija']."'");
				if($raz && $raz2){
					$msg = "������ ���������.";
				}else{
					$error = "������ �� ���������.";
				}
			}
		}

	}
	// END

	include("inc/html_header.php");



	echo"<table width=100% cellspacing=0 cellpadding=3 border=0>
        <tr>
        <td align=right style='padding-left: 20px'>
        <center><font class=title>������ ��������������</font></center><br>";

	if (!empty($error)) echo"<center><FONT COLOR=RED><b>$error</b></font></center><BR>";
	if (!empty($msg)) echo"<center><font color=green><b>$msg</b></font></center><br>";

	if ($stat['proff']!=8)
	echo "<fieldset style='WIDTH: 100%; margin-right:20; float:left'><br><center><FONT COLOR=RED><b>�������������� ���� ����� ���� \"����\"</b></font></center><br></fieldset><br><br>";
	else {
		echo "<fieldset style='WIDTH: 45%; margin-right:20; float:left'><legend>���������</legend>
        	<table width=100% cellspacing=0 cellpadding=5>
			 <tr>
			 <td align=center>
        	<form method='POST' action='' method=post style='margin:0; padding:0;'>
				<table cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1>
				<tr>
					<td align='center'>��� <input type='text' class=input name='muj' size='20'> ���� <input type='text' class=input name='jena' size='20'> <input type='submit' class=input value='���������' name='obvin'></td>
				</tr>
				<tr>
					<td align='center'>��������� ����� <b>10 ��.</b> (������� � ����)</td>
				</tr>
				</table>
			</form>
			</td>
			 </tr>
			 </table>
        	</fieldset>";
		echo "<fieldset style='WIDTH: 45%; margin-right:20; float:left'><legend>��������</legend><br>
        	<table width=100% cellspacing=0 cellpadding=5>
			 <tr>
			 <td align=center>
        	<form method='POST' action='' method=post style='margin:0; padding:0;'>
				<table cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1>
				<tr>
					<td align='center'>����� <input type='text' class=input name='login' size='20'> <input type='submit' class=input value='��������' name='razv'></td>
				</tr>
				<tr>
					<td align='center'>��������� ������� <b>10 ��.</b></td>
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