<?
$now=time();

include("inc/db_connect.php");

$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."' LIMIT 1"));
mysql_query("SET CHARSET cp1251");
if ($stat['battle']) { header("Location: battle.php"); exit; }

include('inc/header.php');

print"<script language=JavaScript>var rank='$stat[rank]';</script>";
print"<script src='i/forms.js'></script>";

print"
<table width=100% cellspacing=0 cellpadding=0 border=0>
<tr>
<td>
<center><u><i>����</i></u></center>
</td>
<td align=right>
<img src='i/refresh.gif' style='CURSOR: Hand' alt='��������' onclick='window.location.href=\"white.php?tmp=\"+Math.random();\"\"'>
<img src='i/back.gif' style='CURSOR: Hand' alt='���������' onclick='window.location.href=\"main.php?tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";

if ($stat['rank']==21 || $stat['rank']==100) {


	$CurrentTime = date("H");

	if ($CurrentTime >= 6 || $CurrentTime <22) {

		echo"<BR><CENTER><FONT STYLE='FONT-SIZE: 10 pt; COLOR: BC681D'><B>� ����� ������ ����...<BR>������ �� ����� ���, ��������� ����� <BR><IMG SRC='i/align21.gif' WIDTH=12 HEIGHT=12>";

		if ($stat['tribe']) echo"<img src='i/klan/".$stat['tribe'].".gif'>";

		echo $stat['user']."</B>&nbsp;[".$stat['level']."]&nbsp;<A HREF='inf.php?".$stat['id']."' target=_blank><img src='i/inf.gif'></a></FONT></CENTER>";



		if (isset($bite)) {
			if (empty($UserName) || $UserName == "�����")
			$ShowMessage = "������� �����!";
			else {
				$HisInfo = mysql_fetch_array(mysql_query("SELECT id, user, hp_now, rank, room, battle FROM players WHERE user='".addslashes($UserName)."'"));
				if (!empty($HisInfo['user'])) {
					if ($HisInfo['user'] != $stat['user']) {
						if ($HisInfo['rank'] != 10 && $HisInfo['rank'] != 11 && $HisInfo['rank'] != 12 && $HisInfo['rank'] != 13 && $HisInfo['rank'] != 14 && $HisInfo['rank'] != 15 && $HisInfo['rank'] != 21 && $HisInfo['rank'] != 22  && $HisInfo['rank'] != 0 && $HisInfo['rank'] != 100  && $HisInfo['rank'] != 30  && $HisInfo['rank'] != 60) {
							if (!$HisInfo['battle']) {
								include("inc/main/get_inf.php");
								if ($stat['hp_now'] != $stat['hp_max']) {
									if ($HisInfo['hp_now'] >= 15) {
										mysql_query("UPDATE players SET hp_now=if($stat[hp_now]+ceil($HisInfo[hp_now]/2),$stat[hp_max],ceil($HisInfo[hp_now]/2)) WHERE user='".$stat['user']."'");

										mysql_query("UPDATE players SET hp_now=0 WHERE user='".$HisInfo['user']."'");

										require_once("inc/chat/functions.php");
										insert_msg("��������� ����� ���� ��� � ������-�� �������...","","","1",$HisUser['user'],"",$HisUser['room']);

										$ShowMessage = "�� ������ ������!";
									}
									else $ShowMessage = "�������� ������� ��������...";
								}
								else $ShowMessage = "�� �� ������ �������, �.�. ����� �������...";
							}
							else $ShowMessage = "�� �� ������ ����� ���, �.�. �������� � ��������!";
						}
						else $ShowMessage = "���������� ��������� �� ��������� ����� ��� � ����!";
					}
					else $ShowMessage = "�� �� ������ ����� ��� � ������ ����!";
				}
				else $ShowMessage = "�������� <u>$UserName</u> �� ������!";
			}
		}








		if (!empty($ShowMessage)) echo"<BR><CENTER><B><FONT COLOR=Red>$ShowMessage</FONT></B></CENTER>";


		echo"

        <BR>

        <FIELDSET><LEGEND>��������� �����������</LEGEND>

        <CENTER>

        <TABLE CELLSPACING=0 CELLPADDING=3 WIDTH=98% border=0>
        <TR>
        <TD>
        <a href='javascript: {}' onclick=\"ShowForm('�������� �����','?bite','�����','UserName');\">�������� �������!</a><BR>
        </TD>
        </TR>
        </TABLE>

        </CENTER>

        </FIELDSET>


        <CENTER><BR><DIV id=form></div></CENTER>



";
	}

	#         <a href='javascript: {}' onclick=\"ShowForm('������ �������','?attack','�����','UserName');\">������ �������</a><BR>

	else echo"<BR><CENTER><B><FONT COLOR=Red>� ������ ����� ����� ���� ��������...</FONT></B></CENTER>";
}

else
echo"<center><b><font color=red>�� �� ��������� �����!</font></b></center>";

include("inc/f_display.php");
?>