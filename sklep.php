<?
$now=time();
include("inc/db_connect.php");
$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));

if ($stat['t_time']>$now) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']>$now) { header("Location: academy.php"); exit; }
elseif ($stat['o_time']>$now) { header("Location: juvelir.php"); exit; }
elseif ($stat['r_time']>$now) { header("Location: podzem.php"); exit; }
elseif ($stat['lov_time']>$now) { header("Location: more.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat['room']!=500) { header("Location: main.php"); exit; }

else {

	include("inc/html_header.php");

	echo"<body leftmargin=0 topmargin=0>
<DIV id=hint1></DIV>
<div id=mainform style='position:absolute; left:30px; top:30px'></div>";

	echo "<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/show_inf.js\"></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/time.js\"></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/login_form.js\"></SCRIPT>";


	##############         ���� �� ������ � ������, � ��� ����      ##############
	if ($stat[bs] == 1) {
		include "bs_start.php";
		die();
	}
	##############         ���� �� ������ � ������, � ��� ����      ##############
	##############             ���� ������ ��� �� �������           ##############
	else {

		echo"<body bgcolor=F5FFD9 leftmargin=0 topmargin=0>
<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td align=left>� ��� �� �����: <b>".$stat[credits]."</b> ��.</td>
<td align=right valign=top>
<input class=input type=button value='��������' onclick='window.location.href=\"sklep.php?tmp=\"+Math.random();\"\"'>
<input class=input type=button value='���������' onclick='window.location.href=\"world2.php?room=35&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";


		##############        ������ ������ �� ������� � �������        ##############
		if ($act == "j0in") {
			if ($cash >= 3) {
				if ($stat['credits'] >= 3) {
					$t = 1;
					mysql_query("INSERT INTO bs VALUES('$stat[user]','$t','$cash') ");
					mysql_query("UPDATE players set credits=credits-$cash where user='$stat[user]'");
					require_once("inc/chat/functions.php");
					insert_msg("�� ������ ������ ������ �� ������, ������� <b>$cash</b> ��. � ���� �������.","","","1",$stat[user],"",$stat[room]);
				} else $msg="� ��� �� ������� ��.";
			} else $msg="����������� ������ 3 ��.";
			$t = 0;
		}
		##############        ������ ������ �� ������� � �������        ##############
		##############        ������ ������ �� ������� � �������        ##############
		if ($act == "joins"){
			if ($cash > 0) {
				if ($stat['credits'] >= 3) {
					mysql_query("UPDATE bs set cash=cash+$cash where user='$stat[user]' AND t='$t'");
					mysql_query("UPDATE players set credits=credits-$cash where user='$stat[user]'");

					require_once("inc/chat/functions.php");
					insert_msg("�� ������ �������� � ���� ������� <b>$cash</b> ��.","","","1",$stat[user],"",$stat[room]);

				} else $msg="� ��� �� ������� ��.";
			} else $msg="������� ������������� �����.";
		}
		##############        ������ ������ �� ������� � �������        ##############
		##############        �������� ������ � �������� �������        ##############
		$all_cash_t1 = 0;
		$sel_t1 = mysql_query("SELECT * FROM bs WHERE t='1'");
		$all_t1 = mysql_num_rows($sel_t1);
		if ($all_t1) {
			while ($s_t1 = mysql_fetch_array($sel_t1)) {
				$all_cash_t1 = $all_cash_t1+$s_t1[cash];
			}
		}
		$sel = mysql_query("SELECT * FROM bs WHERE user='$stat[user]'");
		if (mysql_num_rows($sel) > 0) {
			$s = mysql_fetch_array($sel);
			$act = 14124124;
			$t = $s[t];
		}


		$time = date('d.m.y H:i:s',$now);
		$time_d = date('d',$now);
		$time_h = (int)date('H',$now);
		$time_m = (int)date('i',$now);
		$time_s = (int)date('s',$now);
		$sss = (21-$time_h)*60*60 - $time_m*60 - $time_s;

		if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center>";


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
            <tr><td valign='top' width='30%'>";

		echo "<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>������ ������</b></td></tr>
<tr><td valign='top'>";

		##############        �������� ������ � �������� �������        ##############
		$chek=mysql_num_rows(mysql_query("SELECT * FROM players where bs=1"));
		if ($chek >=2) {
			echo "������ ��� �� ��������, ��������� ��� ���������.";
		}
		##############     ����� ������ ������ �� ������� � �������     ##############
		elseif (!$act) {
			echo"
       <form name=add action=sklep.php?act=j0in&t=1 method='POST'>
       ������ �������: <b>21:00</b> <small>(�� �������)</small><br/>";
			if (21 > $time_h) {
				echo "�� ������ �������: <span style='font-size: 8pt;'><b id='bs'></b></span><script>ShowTime('bs',",$sss,");</script><br/>
<META HTTP-EQUIV=\"Refresh\" CONTENT=\"$sss; URL=\">";
			}
			echo "�������� ���� �� ������� ������: <b>$all_cash_t1</b> ��.<br/>
       ����� ������ ������: <b>$all_t1</b> ��.<br/>
       ���� ������: <input type=text size=5 value='' name=cash class=input> ��<br/>
       <input type=submit value='������� �������' class=input>";
		}
		##############     ����� ������ ������ �� ������� � �������     ##############
		############## ���� ������ ��� ������, �� ����� ��� �� �������� ##############
		elseif ($t == "1") {
			echo "
       <form name=add action=sklep.php?act=joins&t=1 method='POST'>
       ������ �������: <b>21:00</b> <small>(�� �������)</small><br/>";
			if (21 > $time_h) {
				echo "�� ������ �������: <span style='font-size: 8pt;'><b id='bs'></b></span><script>ShowTime('bs',",$sss,");</script><br/>
<META HTTP-EQUIV=\"Refresh\" CONTENT=\"$sss; URL=\">";
			}
			echo "�������� ���� �� ������� ������: <b>$all_cash_t1</b> ��.<br/>
       ����� ������ ������: <b>$all_t1</b> ��.<br/>
       ���� ������: <input type=text size=5 value='' name=cash class=input> ��<br/>
       <input type=submit value='������� �������' class=input>";
		}
		############## ���� ������ ��� ������, �� ����� ��� �� �������� ##############
		##############             ���� ������ ��� �� �������           ##############
		##############     ����� ������ ������ �� ������� � �������     ##############
		elseif ($t == "0") {
			echo "������ ��� �� ��������, ��������� ��� ���������.";
		}
		##############     ����� ������ ������ �� ������� � �������     ##############
	}
	echo "</td></tr></table></div></form></td>";

	echo "<td valign='top' width='70%'><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>����������</b></td></tr>
<tr><td valign='top'>";

	echo "<b>\"����������� �����\"</b> � ����������� �������� � ������� ���������� �������.<br>
����������� ������ ���������� <b>3</b> ��. ��� ������� � ������� �� �������� ���������� <b>20</b> ������� �� �������� <b>������������ ������</b>. ������, ���� ���� ������ �� ������ � <b>20 ����� �������</b>, �� � <b>\"����������� �����\"</b> �� �� ��������, � ���� ����� ���� � ��������� ���� ������ <small>(��� ��������� � �������� �����)</small>.<br>
������� ���������� ���������, <b>1 ��� � ����</b> <small>(� <b>21:00</b> �� �������)</small>. � <b>\"����������� �����\"</b> �� ������� � ����� ����, ��������� ����� ������ � �� ����, ������� �� ������� � �������� ����� <small>(���� ��� ������ ���������� � ������, ����������)</small>. ������ ����� ����� ������� � ������� ��������, �� ����� �������� �������� ��������� � �����. ����������� � ��� �������� �������� �� �������.<br>
<b>���� �������</b> � �������� ������������ ����� ����������. ���������� ������� �������� <b>���� �������� ����</b> <small>(�� ������������ �� ����� ������)</small>.";

	echo "</td></tr></table></div>";



	echo " </td>
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