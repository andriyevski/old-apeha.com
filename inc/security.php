<?
if (@$changepass) {
	if (!empty($old_pass)) {
		if (md5($old_pass) == $stat['pass']) {
			if ($new_pass == $conf_new_pass) {
				if (strlen($new_pass)>=6) {

					mysql_query("UPDATE players SET pass=".md5(addslashes($new_pass))." WHERE user='".$stat['user']."'");
					$pass=md5($new_pass);
					SetCookie("user", "$user");
					SetCookie("pass", "$pass");
					$msg="<br><center><font color=red><b>��� ������ ������� ������!<b></font></center>";
				}
				else
				$msg = "<br><center><font color=red><b>������ �� ������ ���� ������ 6 ��������!</b></font></center>";
			}
			else
			$msg = "<br><center><font color=red><b>�������� ������ �� ���������! ����� ���������!</b></font></center>";
		}
		else
		$msg = "<br><center><font color=red><b>�� �������� ��� ��������� ������! ����� ���������!</b></font></center>";
	}
	else $msg = "<br><center><font color=red><b>������� ������ ������!</b></font></center>";
}



if (@$changemail) {
	if ($old_email == $stat['email']) {
		mysql_query("update players set email='$new_email' where user='$stat[user]'");
		$msg="<br><center><font color=red><b>��� e-mail ������� ������!<b></font></center>";
	} elseif ($old_email!="" and $old_email!="$stat[email]") $msg="<br><center><font color=red><b>�� �������� ��� ��������� e-mail! ����� ���������!<b></font></center>";
	else $msg="";
}





include('inc/header.php');

print"<table width=100% cellspacing=0 cellpadding=0 border=0>
<tr>
<td>
<center><u><i>����� ������ � e-mail � ��������� <b>$stat[user]</b></i></u></center>
</td>
<td align=right>
<img src='i/refresh.gif' style='CURSOR: Hand' alt='��������' onclick='window.location.href=\"main.php?set=security&tmp=\"+Math.random();\"\"'>
<img src='i/back.gif' style='CURSOR: Hand' alt='���������' onclick='window.location.href=\"main.php?set=edit&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";

echo"$msg";

?>



<br>
<FIELDSET><LEGEND>������� ������</LEGEND>
<table width=100% cellspacing=0 cellpadding=0 border=0>
	<form action='main.php?set=security' method=post>
	
	
	<tr>
		<td width=130>&nbsp;������ ������:</td>
		<td align=center><input type=password name=old_pass class='input'></td>
	</tr>
	<tr>
		<td width=130>&nbsp;����� ������:</td>
		<td align=center><input type=password name=new_pass class='input'></td>
	</tr>
	<tr>
		<td width=130>&nbsp;�������������:</td>
		<td align=center><input type=password name=conf_new_pass class='input'></td>
	</tr>
	<tr>
		<td width=130>&nbsp;</td>
		<td align=center><input type=submit name=changepass
			value='   ��������   ' class=standbut></td>
	</tr>
</table>
</FIELDSET>
<br>
<FIELDSET><LEGEND>������� e-mail</LEGEND>
<table width=100% cellspacing=0 cellpadding=0 border=0>
	<tr>
		<td width=130>&nbsp;������ e-mail:</td>
		<td align=center><input name=old_email class='input'></td>
	</tr>
	<tr>
		<td width=130>&nbsp;����� e-mail:</td>
		<td align=center><input name=new_email class='input'></td>
	</tr>
	<tr>
		<td width=130>&nbsp;</td>
		<td align=center><input type=submit name=changemail
			value='   ��������   ' class=standbut></td>
	</tr>
	</form>
</table>
</FIELDSET>


<?
include('inc/f_display.php');
?>