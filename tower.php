<?
$now=time();
$hourdiff = "0";
$timeadjust = ($hourdiff * 60 * 60);
$this_time = date("d.m.y.H.i",time() + $timeadjust);
$times = date("H.i",time() + $timeadjust);
$date_seans = date("d.m.y.H",time() + $timeadjust);
$day_seans = date("d",time() + $timeadjust);
$hour_seans = date("H",time() + $timeadjust);
$min_seans = date("i",time() + $timeadjust);
include("inc/db_connect.php");
include("inc/html_header.php");

$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));


$myzay = mysql_fetch_array(mysql_query("select * from tower where user='".addslashes($user)."'"));


if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat['t_time']>time()) { header("Location: prison.php"); exit; }
elseif ($stat['w_time']>time()) { header("Location: works.php"); exit; } // ���������� � �����
elseif ($stat['o_time']>time()) { header("Location: repair.php"); exit; }

elseif ($stat['forest_time']>time()) { header("Location: forest2.php"); exit; }
elseif ($stat['battle']>time()) { header("Location: battle.php"); exit; }
//elseif ($stat['room'] != 49) { header("Location: main.php"); exit; }


else {
	if ( $seans == 1 ) { $cena = 100; $timeseans = 1; }
	elseif ( $seans == 2 ) { $cena = 100; $timeseans = 7; }


	//������ ������� �����
	if ($kup) {
		if ($hour_seans < '20') {
			if ($stat[credits] >= $cena) { // �������� �����
				if ($stat[level] >= 8) { // �������� ������
					if (!$myzay[seans]) {



						//if ($day_seans == '03' and $seans == 1) {
						$msg="�� ������ ������ �� ������. ��������� ������ ��������� <u>$cena</u> ��!";

						mysql_query("UPDATE players set credits=credits-$cena where user='".$stat['user']."'");

						mysql_query("INSERT INTO tower values ('".$stat['user']."','".$timeseans."','0','0')");

						echo "<meta http-equiv='refresh' content='3; url=tower.php'>";


						//} else $msg="111!";
					} else $msg="�� ��� ������ ������ �� 1 ������, ��������� ��� ������!";
				} else $msg="� ��� �� ��� �������, ��������������� ������� 8!";
			} else $msg="� ��� �� ������� ������!";
		} else $msg="������������ �������, ��������� ������";
	}







	if ($perexod) {
		if ($myzay[seans]) {
			if ($stat[level] >= 8) { // �������� ������
				if ($myzay[seans] == 1) {
					if (($hour_seans == 20 and $min_seans > 45) or ($hour_seans == 21 and $min_seans <5)) {

						mysql_query("UPDATE players set room=49, location=790 where user='".$stat['user']."'");
						mysql_query("UPDATE slots set slots.1=0, slots.2=0, slots.3=0, slots.4=0, slots.5=0, slots.6=0, slots.7=0, slots.8=0, slots.9=0, slots.10=0, slots.11=0, slots.12=0, slots.13=0, slots.14=0, slots.15=0, slots.16=0, slots.17=0, slots.18=0, slots.19=0 WHERE id='$stat[id]'");

						$stat['room']=49;
						require_once("inc/chat/functions.php");
						insert_msg("�� ������ ����� � �����","","","1",$stat[user],"",$stat[room]);
						echo "<meta http-equiv='refresh' content='0; url=tower_map/map.php'>";
					} else $msg="������ ������� ������ � ��������� �����!";
				}



				elseif ($myzay[seans] ==7) {
					//if ($day_seans==1 or $day_seans==8 or $day_seans==15 or $day_seans==22 or $day_seans==29) {
					if (($hour_seans == 20 and $min_seans > 45) or ($hour_seans == 21 and $min_seans <5)) {
						mysql_query("UPDATE players set room=49, location=790 where user='".$stat['user']."'");
						mysql_query("UPDATE slots set slots.1=0, slots.2=0, slots.3=0, slots.4=0, slots.5=0, slots.6=0, slots.7=0, slots.8=0, slots.9=0, slots.10=0, slots.11=0, slots.12=0, slots.13=0, slots.14=0, slots.15=0, slots.16=0, slots.17=0, slots.18=0, slots.19=0 WHERE id='$stat[id]'");

						$stat['room']=49;
						require_once("inc/chat/functions.php");
						insert_msg("�� ������ ����� � �����, � 21.00 ������������� ����� �������� ��������� � ������ ��������!�����!","","","1",$stat[user],"",$stat[room]);
						echo "<meta http-equiv='refresh' content='0; url=tower_map/map.php'>";
					}else $msg="������ ������� ������ � ��������� �����!";
					//}else $msg="������ �������� ������ �� ��������� ����!";
				}
			}else $msg="� ��� �� ��� �������, ��������������� ������� 8!";
		}else $msg="���� ������ �� ��������!";
	}
	//����� �������� � ����

	include("inc/html_header.php");

	echo"<body bgcolor=F5FFD9 leftmargin=0 topmargin=0>";

	echo"
<body background='/i/bg.gif' leftmargin=0 topmargin=0>
<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
        <td><b>� ��� �� �����:</b> <u>".$stat[credits]."</u> <b>��.</b>
        </td>
<td align=right valign=top>
<input class=input type=button value='��������' onclick='window.location.href=\"tower.php\"'>
<input class=input type=button value='���������' onclick='window.location.href=\"world.php?room=0&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";

	if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";


	echo "<form action='' method=post><table border='0' width='100%' cellspacing='0' cellpadding='0'>
 
            <table border='0' width='100%' height='100%' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 3'>
            <tr><td valign='top'>";

	echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center' colspan='2'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������������:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td></tr>

	
  <tr>

    <td width='50%' align='center'><b>���������� ������</b></td>
    <td width='50%' align='center'><b>������������ ������</b></td>

  </tr>
  <tr>

    <td width='50%' align='center' ><img src='i/items/propusk.gif'></td>
    <td width='50%' align='center'><img src='i/items/propusk.gif'></td>
  </tr>
  <tr>
    <td width='50%' align='center'>������: 21.00<br>������ ����</td>
    <td width='50%' align='center'>������: 21.00<br>������ 1,8,15,22,29 ����� ������ </td>

  </tr>
  <tr>
    <td width='50%' align='center'><b>100 ��</b></td>
    <td width='50%' align='center'><b>100 ��</b></td>

  </tr>
  <tr>
 <td width='100%' colspan='2' align='center'>
������ �� <select name=seans><option value=1>���������� ������<option value=2>������������ ������</select> <input type=submit class=input value='������' name=kup>
</td>
  </tr>
</table>
</div>
";


	echo "</td><td valign='top'>";



	echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>���� ������:</b></td></tr>
  <tr><td>";
	if ($myzay[seans]==1) {
		echo "������ ���: ������� � <b>21.00</b>(�� �������)";
		echo "<br>
�����������: <b>����������� ���!!!(������������� ���� ����� ���������(���� � ��������� ������), �������,���������) </b><br>���������� ��������: <b>����</b> ���������� �� �������� ���, ��������� <b>����������� ������</b> � <b>2 ��������</b>
<br>����������� ��������: ������ <b>����</b> �� �������� ���"; 
	}
	elseif ($myzay[seans]==7) {
		echo "������ ���: 1,8,15,22,29 ����� ������ � <b>21.00</b>(�� �������)";
		echo "<br>
�����������: <b>���������� ������������ ������ ����������.(������������� ������ ��� ���������, ������� �� ����� � �����) </b><br>���������� ��������: <s><b>����</b> ���������� �� ���, ��������� <b>����������� ������</b>,<b>2 �������� � �������� ��������, �� ���������� ���������� ������� - ���� ����������</b>
<br>����������� ��������: <b>����</b> �� �������� ��� � <b>������� ������</b></s><b>   ��������, ���� ����� �������� � �������� ������ ���� ������ ����</b>"; 
	} else {
		echo "� ��� �������.";



	}

	echo"</td>
  </tr>
</table>
</div>
";

	echo "<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>�����</b></td></tr>
<tr><td valign='top'>
 <s>- ��� ������ � ������� ������ ������������ ������� <b>15 �������</b><br></s>
 - ������ ����� ������� <b>� 20.45 �� 21.05</b><br>
 - � ������ ������ ������ <b>���������� ��� �������� �����</b><br><br>
 
 PS: ����� �� ��������� ����� �������������� ��� �� ��� � ����, �.�. ������� ��� ������� 790</b>

<center><input type=submit class=input value='����� � �����' name=perexod></center>
</td></tr></table></div>";



}
?>