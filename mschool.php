<?
$now=time();

include("inc/db_connect.php");

$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));
mysql_query("SET CHARSET cp1251");
if ($stat[bloked]=="1") echo"<script>top.location='index.php?action=logout'</script>";

if ($stat[t_time]) { header("Location: prison.php"); exit; }
elseif ($stat['v_time']) { header("Location: ambulance.php"); exit; } // ���������� � ��������
elseif ($stat['w_time']) { header("Location: works.php"); exit; } // ���������� � �����
elseif ($stat['o_time']) { header("Location: repair.php"); exit; }
elseif ($stat['r_time']) { header("Location: vault.php"); exit; }
elseif ($stat['forest_time']) { header("Location: forest.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat[room]=="18") { header("Location: main.php"); exit; }
else {




	if ($getproff!="" && $getm=="") {
		$ch=mysql_fetch_array(mysql_query("SELECT * FROM academy where id=".intval($getproff)." and type=0"));

		if (!empty($ch[id])) { // ����������
			if ($stat[k_time]<$now) { // ��������
				if ($stat[credits]>=$ch[price]) { // ������� �����
					if ($stat[level]>=$ch[level]) { // ������� ������

						mysql_query("UPDATE players set proff=$ch[id] where id=$stat[id]");
						mysql_query("UPDATE players set k_time=$now+$ch[srok] where id=$stat[id]");
						mysql_query("UPDATE players set credits=credits-$ch[price] where id=$stat[id]");
						$msg="������� �������� �����! �� ��������� �������� �� ������� ����������������������� ������������!";

					} else $msg="�� �� ������ �������� ��� ���������, ������� �������!";
				} else $msg="������������ ������!";
			} else $msg="�� �� ������ ���������� ����� ����� ������!";
		} else $msg="�������� �� ������������� ����� �����!";
	}



	unset($stat);
	$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));




	include("inc/html_header.php");

	echo"
<body bgcolor=#EBEDEC leftmargin=0 topmargin=0>
<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td align=right valign=top>
<img src='i/refresh.gif' style='CURSOR: Hand' alt='��������' onclick='window.location.href=\"mschool.php?tmp=\"+Math.random();\"\"'>
<img src='i/back.gif' style='CURSOR: Hand' alt='���������' onclick='window.location.href=\"street3.php?room=102&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";


	echo"
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td align=right>
<center><font class=title>����� �����</font></center><br>";






	if ($stat['k_time']>$now) {
		echo"<script src='i/time.js'></script>";
		echo"<center><table cellspacing=0 cellpadding=3>
<tr>
<td><font color=red><b>���������� ����� ��������:</b></font></td>
<td id=know style='COLOR: red; FONT-WEIGHT: Bold; TEXT-DECORATION: Underline'></td>
</tr>
</table>
<script>ShowTime('know',",$stat['k_time']-$now,");</script>";
	}
	else { mysql_query("UPDATE players set k_time=0 where id=$stat[id]"); }


	if ($msg!="") echo"<center><font color=red><b>$msg</b></font></center><br>";






	// �������������

	echo"
<fieldset style='WIDTH: 98.6%'><legend>��������� �������������</legend>
<table width=100% cellspacing=0 cellpadding=5>
<tr>
<td align=center>

<b>� ����� ����� �� ������ �������� ��������� �����</b><br><br>

<table width=100% cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1>
<tr>

<td width=18 align=center><b>�</b></td>
<td><b>������������</b></td>
<td width=150 align=center><b>�������</b></td>
<td width=150 align=center><b>���� ��������</b></td>
<td width=160 align=center><b>��������� ��������</b></td>
<td align=center width=120><b>�������</b></td>

</tr>";


	$ac=mysql_query("SELECT * FROM academy where type=2 order by srok");


	for ($i=0; $i<mysql_numrows($ac); $i++) {
		$acs=mysql_fetch_array($ac);

		echo"
<tr>
<td align=center><b>".($i+1)."</b></td>
<td><b>$acs[title]</b></td>
<td align=center><b>$acs[level]</b></td>
<td align=center><b>".(round($acs[srok]/60,1))." ���.</b></td>
<td align=center><b>$acs[price] ��</b></td>
<td align=center><input type=button class=input value='���������'";

		if ($stat[k_time]<$now) echo" onclick=\"if (confirm('�� ������������� ������ �������� ������ ���������?')) window.location='academy.php?getproff=$acs[id]&'+Math.random();''\""; else echo" disabled";

		echo"></td></tr>";

	}


	echo"
</table>


</td>
</tr>
</table>

</fieldset><br><br><br>";

	// ����� ��������� ����.


	unset($ac, $acs);







	echo"</td>
</tr>
</table>
</td>
</tr>
</table>";
}
?>
<BODY
	bgcolor=EBEDEC leftmargin=0 topmargin=0
	background='i/backgrounds/mschool.jpg'
	style='background-attachment: fixed;'>