<?
$MySkills = explode("|",$stat['rase_skill']);

$stat['ork']=$MySkills['0'];
$stat['elf']=$MySkills['1'];
$stat['people']=$MySkills['2'];
$stat['gnom']=$MySkills['3'];


// ----- # �������� ���������� �������� # ----- //
if (!empty($update)) {
	if ($stat['s_updates'] > 0) {

		switch ($update) {
			case str: $st_name="strength"; $st_title="����"; break;
			case dex: $st_name="agility"; $st_title="��������"; break;
			case agility: $st_name="dex"; $st_title="�����"; break;
			case vitality: $st_name="vitality"; $st_title="������������"; break;
			case power: $st_name="power"; $st_title="�������"; break;
			case razum: if ($stat['level'] >= 4) { $st_name="razum"; $st_title="�����"; } break;
		}

		if (!empty($st_name)) {
			$stat['s_updates']-=1;
			$stat[$st_name] = $stat[$st_name] + 1;
			mysql_query("UPDATE players SET s_updates=s_updates-1, ".$st_name."=".$st_name."+1 WHERE id=".$stat['id']." AND s_updates>0");
			$msg="������ ��������� ���������� �������� \"$st_title\"!";
		}
	}
	else $msg="� ��� ��� ��������� ����������!"; }
	###

	// ----- # �������� ����������� # ----- //
	if (!empty($oupdate)) {
		if ($stat['o_updates'] > 0) {

			switch ($oupdate) {
				case ork: $stat['ork']+=1; $st_title="���� ����"; break;
				case elf: $stat['elf']+=1; $st_title="�������� �����"; break;
				case people: $stat['people']+=1; $st_title="����� ��������"; break;
				case gnom: $stat['gnom']+=1; $st_title="������������ �����"; break;
			}

			if (!empty($st_title)) {
				$stat['o_updates']-=1;
				$st_write = $stat['ork']."|".$stat['elf']."|".$stat['people']."|".$stat['gnom'];
				mysql_query("update players set o_updates=o_updates-1, rase_skill='".$st_write."' where id=".$stat['id']." AND o_updates>0");
				$msg="������ ��������� ����������� \"$st_title\"!";
			}
		}
		else $msg="� ��� ��� ��������� ����������!"; }
		###

		$title="������";
		include("inc/html_header.php");
		echo"<body>
<DIV ID=hint1></DIV>
<SCRIPT language=JavaScript SRC='i/show_inf.js'></SCRIPT>";


		print "<table cellpadding=3 width=100% cellspacing=1 border=0>
<td align=right><input class=lbut type=button value='�����' onClick=top.main.location.href=\"main.php?set=&tmp=\"+Math.random();\"\">
</td></table>";

		if (!empty($msg)) echo"<br><center><font color=red><b>$msg</b></font><br></center>";




		echo"<br><table width=100% cellspacing=1 border=0>
<tr>
<td width=33% valign=top>";

		// ----- # ������� ���. ���������� # ----- //

		echo"
<table cellpadding=3 width=100% cellspacing=1 border=0 height=155>
<tr>
<td bgcolor=#eaeaea align=center colspan=2><b>���������� ��������� [ <u>".$stat['s_updates']."</u> ]</b>
</td>
</tr>
<tr>

<td bgcolor=#FCFAF3>";


		echo"
<SCRIPT language=JavaScript>
var a = ".$stat['s_updates'].";

function vs (name, title,int) {
        document.write('<LI>'+title+': <b>'+int+'</b>');
        if (a > 0) document.write(' <a style=\'CURSOR: hand\' title=\'���������\' onclick=\"if (confirm(\'��������� ���������� �������� '+title+'?\')) window.location=\'main.php?set=updates&update='+name+'\'\"><b style=\'COLOR: Red\'>�</b></a>');
        }

vs('str','����','".$stat['strength']."');
vs('dex','��������','".$stat['agility']."');
vs('agility','�����','".$stat['dex']."');
vs('vitality','������������','".$stat['vitality']."');
vs('power','�������','".$stat['power']."');
";

		if ($stat['level'] >= 4) echo"vs('razum','�����','".$stat['razum']."');";

		echo"</SCRIPT>
</td>
</tr>
</table>";

		echo"</td><td width=34% valign=top>";

		// ----- # ������� ������������ # ----- //

		echo"
<table cellpadding=3 width=100% cellspacing=1 border=0 bordercolor=#EAEAEA height=155> 
<tr>
<td bgcolor=#eaeaea align=center><b>����������� [ <u>".$stat['o_updates']."</u> ]</b>
</td>
</tr>
<tr>
<td bgcolor=#FCFAF3 valign=center>";

		echo"
<SCRIPT language=JavaScript>
var o = ".$stat['o_updates'].";

function os (name, title, int, title2) {
        document.write('<LI><b onmouseover=\"hint(\'<b>'+title+'</b><LI>'+title2+'\',\'FFFFE1\',\'black\');\" onmouseout=\"c();\" style=\'CURSOR: Help\'>'+title+'</b><br>&nbsp;&nbsp;&nbsp;<small>��� �������: '+int+'</small>');

        if (o > 0) document.write(' <a style=\'CURSOR: hand\' title=\'���������\' onclick=\"if (confirm(\'��������� ����������� '+title+'?\')) window.location=\'main.php?set=updates&oupdate='+name+'\'\"><b style=\'COLOR: Red\'>�</b></a>');
        }

os('ork','���� ����','".$stat['ork']."','������ ������� ����������� �������� ���������� ���� ����� �� <b>+5%</b><LI>��� ������� �������: <b>'+".$stat['ork']."*5+'%</b>');
os('elf','�������� �����','".$stat['elf']."','������ ������� ����������� ��� ���� ���������� �� ���������� �� <b>+5%</b><LI>��� ������� �������: <b>'+".$stat['elf']."*5+'%</b>');
os('people','����� ��������','".$stat['people']."','������ ������� �������� ����������� ������������ ������� �� <b>+5%</b><LI>��� ������� �������: <b>'+".$stat['people']."*5+'%</b>');
os('gnom','������������ �����','".$stat['gnom']."','������ ������� �������� ����������� ����� �� �� <b>+5%</b><LI>��� ������� �������: <b>'+".$stat['gnom']."*5+'%</b>');

</SCRIPT>

";

		echo"</td>
</tr>
</table>";


		echo"</td><td>";

		// ----- # ������� ���������� # ----- //

		echo"
<table cellpadding=3 width=100% cellspacing=1 border=0 bordercolor=#EAEAEA height=155>
<tr>
<td bgcolor=eaeaea align=center><b>�������� ������</b>
</td>
</tr>
<tr>
<td bgcolor=#FCFAF3>

<b>���������� ��������</b>:

        <LI>������ / ���������: <b>$stat[m_k]</B>
        <LI>������: <B>$stat[m_m]</B>
        <LI>�������� / ����������: <B>$stat[m_t]</B>
        <LI>�������� / ��������: <B>$stat[m_d]</B>

</td>
</tr>
</table>";


		echo"</td></tr></table>";




		?>