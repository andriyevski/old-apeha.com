<?
include('inc/header.php');



print "<table cellpadding=3 width=100% cellspacing=1 border=0>
<td align=right><input class=lbut type=button value='�����' onClick=top.main.location.href=\"main.php?set=&tmp=\"+Math.random();\"\">
</td></table>";



echo"<table cellpadding=3 width=100% cellspacing=1 border=0>
<tr>
<td bgcolor=#eaeaea align=center colspan=2><b>���� �������</b></td>
</tr>";
echo"<tr>
<td bgcolor=#FCFAF3 align=center><b><a "; if ($mode=="security") echo"disabled"; else echo"href='main.php?set=otchets&mode=security'"; echo">����� ������������</a></b></td>
<td bgcolor=#FCFAF3 align=center><b><a "; if ($mode=="transfers") echo"disabled"; else echo"href='main.php?set=otchets&mode=transfers'"; echo">����� � ���������</a></b></td></tr>";


if ($mode=="security") {

	$otchet=mysql_query("SELECT * FROM security WHERE user='$stat[user]' order by id desc");

	for ($i=0; $i<mysql_num_rows($otchet); $i++) {
		$otchets=mysql_fetch_array($otchet);

		if ($otchets['result']==0) $result="";
		elseif ($otchets['result']==1) $result="���� � ������� ��������";
		elseif ($otchets['result']==2) $result="<b><font color=red>�������� ������!</font></b>";

		echo"<tr><td bgcolor=#FCFAF3 colspan=2><u>".date("d.m.y H:i",$otchets[id])."</u> | IP: <b>$otchets[ip]</b> | $result</td></tr>";
	}}



	if ($mode=="transfers") {
		if ($transf==1) {
			echo"<tr><td bgcolor=#FCFAF3 colspan=2 align=center><b>����� � ��������� ������� ������ � ��������� � ��� � ���������!</b></b></td></tr>"; }

			echo"<tr><td bgcolor=#FCFAF3 colspan=2 align=center><b><font color=red>��������!</font></b> �� ������ �������� ����� � ���������!<br><b>������ �������: <u>5 ��.</u></b></td></tr>
<tr><td bgcolor=#FCFAF3 colspan=2 align=center>
<input type=button value='�������� ����� � ���������' class=lbut onclick=\"if(confirm('�� ������������� ������ �������� ����� � ���������?')) window.location.href='main.php?set=otchets&mode=transfers&transf=1&tmp=$ctime';\">
</td></tr>";
	}


	echo"</table>
</table>";

	?>