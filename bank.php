<?
$now=time();
include("inc/db_connect.php");
$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));
if ($stat[bloked]) echo"<script>top.location='index.php?action=logout'</script>";
if ($stat[t_time]>$now) { header("Location: prison.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }

elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
else {

 
	// ����� ��.
	if ($pg && $bpass) {
		$num=trim($num);

		if (empty($num)) $msg="������� �����, ������� �� ������ �������� � ������!";
		elseif (!is_numeric($num)) $msg="������� �����, ������� �� ������ �������� � ������!";
		else {

			$acc=mysql_fetch_array(mysql_query("SELECT * FROM bank where user='$stat[user]'"));
			if ($num > $stat['credits']) $msg="� ��� ��� ��������� �����!";
			elseif ($num == "0" || $num<0) $msg="������� �����, ������� �� ������ �������� � ������!";
			elseif ($num < "1" ) $msg="������� ����� ������ 1!";
			else {

				mysql_query("UPDATE players set credits=credits-$num where user='$stat[user]'");
				mysql_query("UPDATE bank set credits=credits+$num where user='$stat[user]'");
				$msg=$num." ��. ������ �������� � ���� ������!";
			}}}
			//

			// ������� ��.
			if ($gg && $bpass) {
				$num=trim($num);

				if (empty($num)) $msg="������� �����, ������� �� ������ ������ �� ������!";
				elseif (!is_numeric($num)) $msg="������� �����, ������� �� ������ ������ �� ������!";
				else {

					$acc=mysql_fetch_array(mysql_query("SELECT * FROM bank where user='$stat[user]'"));
					if ($num>$acc[credits]) $msg="� ��� ��� ��������� �����!";
					elseif ($num=="0" or $num<0) $msg="������� �����, ������� �� ������ ������ �� ������!";
					elseif ($num < "1" ) $msg="������� ����� ������ 1!";
					else {

						mysql_query("UPDATE players set credits=credits+$num where user='$stat[user]'");
						mysql_query("UPDATE bank set credits=credits-$num where user='$stat[user]'");
						SetCookie("bpass","0");

						$msg="$num ��. ������ ������ �� ����� ������! $bpass";

					}}}
					//

					// �������� c�.
					if ($tp && $bpass) {
						$num=trim($num);

						if (empty($num) && empty($to)) $msg="������� ����� ��������� � ������������ �����!";
						elseif (empty($num) && !empty($to)) $msg="������� �����, ������� �� ������ ��������!";
						elseif (!empty($num) && empty($to)) $msg="������� �����!";
						elseif (!is_numeric($num)) $msg="������� �����, ������� �� ������ ��������!";
						else {

							$acc=mysql_fetch_array(mysql_query("SELECT * FROM bank where user='$stat[user]'"));
							$inf=mysql_fetch_array(mysql_query("SELECT * FROM bank where user='$to'"));

							if ($num>$acc[platinum]) $msg="� ��� ��� ������������ �����!";
							elseif ($num=="0" or $num<0) $msg="������� �����, ������� �� ������ ��������!";
							elseif (empty($inf[user])) $msg="�������� �� ������ ��� �� ����� ������ ������!";
							else {

								mysql_query("UPDATE bank set platinum=platinum-$num where user='$stat[user]'");
								mysql_query("UPDATE bank set platinum=platinum+$num where user='$to'");
								$msg="$num ��. ������ ���������� � ���� � $inf[user]!";

							}}}
							//

							if ($set=="edit" && $bpass) {
								if (!empty($in)) include("inc/bank/in.php");
								elseif (!empty($out)) include("inc/bank/out.php");

								echo"<body leftmargin=2 topmargin=2 background='/i/bg.gif'><br>
<table width=100% border=0 cellspacing=0 cellpadding=0>
<tr><td width=16>&nbsp;</td><td align=right>

<table width=100% align=center valign=top border=1 cellspacing=0 cellpadding=3 bordercolor=CCCCCC>
<tr>
<td bgcolor=white>

<table width=100% cellspacing=0 cellpadding=0><tr>
<td width=33% align=center><b>������������</b></td><td width=34% align=center><b>�����������</b></td><td width=33% align=center><b>��������</b></td>
</tr></table>

</td>
</tr>
";
								include("inc/bank/edit.php");
								echo"</table>

</td></tr></table>";
								exit;
							}
							// �������� ������
							if ($set=="new") {
								$acc=mysql_fetch_array(mysql_query("SELECT * FROM bank where user='$stat[user]'"));
								if ($stat['credits'] < 100) { $msg="� ��� ������������ ������� ��� �������� ������!"; }
								elseif (!empty($acc['id'])) { $msg="�������� ����� ����� �� �������� ������ ����� ������!"; }
								else {
									$max=mysql_fetch_array(mysql_query("SELECT MAX(id) as id from bank"));
									$max[id]=$max[id]+1;
									include("inc/bank/pass.php");
									$msg="������ �������. ��� ��������� ���: $b.<br>����� ������� ��������� ������� ��� �� E-Mail!";
								}}
								// �����

								// �����������
								if ($set=="bank") {
									$acc=mysql_fetch_array(mysql_query("SELECT * FROM bank where user='$stat[user]' and pass='$password'"));
									if (empty($acc[id])) { $msg="�������� ������!"; }
									else {
										SetCookie("bpass","$acc[pass]");
										echo"<script>Location: bank.php'</script>";

									}}
									// �����

									// �����
									if ($exit>0) {
										SetCookie("bpass","");
										unset($bpass);
										Header("Location: world.php?room=0&tmp=$now");
									}
									// �����

									echo"<body background='/i/bg.gif' leftmargin=0 topmargin=0>";
									print"<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr><td>&nbsp;&nbsp;<b>� ��� �� �����:</b> <u>".$stat['credits']."</u> <b>��.</b>
        </td>
<td align=right valign=top>
<input class=lbut type=button value='��������' onclick='window.location.href=\"bank.php?tmp=\"+Math.random();\"\"'>
<input class=lbut type=button value='���������' onclick='window.location.href=\"world.php?room=25&tmp=\"+Math.random();\"\"'>&nbsp;
</td>
</tr>
</table>";
									echo"
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td align=right>
<center><font class=title>����</font></center><br>";
									if ($msg!="") echo"<center><font color=red><b>$msg</b></font></center><br>";
									echo"
<fieldset style='WIDTH: 98.6%'><legend>��������</legend>
<table width=100% cellspacing=0 cellpadding=5>
<tr>
<td align=center>
<table width=100% cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1 height=100%>
<tr>";
									$gj=mysql_fetch_array(mysql_query("SELECT * FROM bank where user='$stat[user]'"));
									$SQL=mysql_fetch_array(mysql_query("SELECT pass FROM bank where user='$stat[user]'"));
									$pass=$SQL["pass"];
									if (!$bpass or $bpass='0' or empty($gj[id])) {
										$gj=mysql_fetch_array(mysql_query("SELECT * FROM bank where user='$stat[user]'"));
										if (!empty($gj[id]) && $stat['level']>=0) {
											echo"<form action='?set=bank' method=post><td width=33% align=center>������� ��������� ��� ����� ������: <b>$pass</b></td>
<td width=34% align=center><input type=password class=input size=50 name=password style='TEXT-ALIGN: Center'></td>
<td width=33% align=center valign=bottom><input type=submit class=input value='���������� �����������'></td></form>";}
											elseif (empty($gj[id]) && $stat['level']>=0) {echo"<td align=center valign=bottom><input type=button class=input value='������� ������ �� 100 ��.' style='WIDTH: 300px' onclick='document.location=\"bank.php?set=new&tmp=\"+Math.random();\"\"'></td>";}
											else {echo"<td align=center valign=bottom>������� �������, ����������� ������ ������������ � 0-�� ������...</td>";}
									}
									// ����!

									else {

										$acc=mysql_fetch_array(mysql_query("SELECT * FROM bank where user='$stat[user]'"));

										echo"<td align=center valign=center width=40% height=292>


<table width=100% border=0 cellspacing=0 cellpadding=0 height=100%>
<tr>
<td height=60% align=center valign=center>

<u>������� ������</u><br><br>
� ��� � ������: <b>$acc[credits] ��.</b><br><br>

<table width=100% border=0 cellspacing=0 cellpadding=0>

 <tr>
        <form action='' method=post>
        <td align=center>�����</td>
        <td><input name='num' class='input' style='WIDTH: 50px'></td>
        <td align=center colspan=2>&nbsp;<b>��.</b> � ������ �� ��������</td>
        <td valign=bottom align=center><input type=submit class=input value='�����' style='WIDTH: 70px' name=pg></td>
        </form>
 </tr>
 <tr>
        <form action='' method=post>
        <td align=center>������</td>
        <td><input name=num class=input style='WIDTH: 50px'></td>
        <td align=center colspan=2>&nbsp;<b>��.</b> �� ������</td>
        <td valign=bottom align=center><input type=submit class=input value='������' style='WIDTH: 70px' name=gg></td>
        </form>
 </tr>
</table>

</td><tr>
<tr><td><hr></td><tr>
<tr><td height=38% align=center valign=center>

<u>������ �������</u><br><br>
� ��� � ������: <b>$acc[platinum] ��.</b><br><br>

<table width=100% border=0 cellspacing=0 cellpadding=0>
 <tr>
        <form action='' method=post>
        <td align=center>��������</td>
        <td width=50><input name=num class=input style='WIDTH: 50px'></td>
        <td align=center width=100><b>��.</b> ���������</td>
        <td width=50><input name=to class=input style='WIDTH: 50px'></td>
        <td valign=bottom align=center><input type=submit class=input value='��������' style='WIDTH: 70px' name=tp></td>
        </form>
 </tr></table></td></tr></table></td>";

										echo"<td align=center valign=center>
<table width=100% border=0 cellspacing=0 cellpadding=3>
<tr><td align=center valign=center><b>������ ����� ���������:</b></td></tr>
<tr><td><iframe src='bank.php?set=edit' width=100% height=255 frameborder=1></iframe></td></tr>
</table>
</td>";}
										//
										echo"</tr></table></td></tr></table></fieldset>";}
										?>
<link rel=stylesheet type='text/css' href='i/main.css'>
<meta
	http-equiv=Content-Type content='text/html; charset=windows-1251'>
