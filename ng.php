<?
include('inc/db_connect.php');
include("inc/html_header.php");
$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));
$now = time();
if ($stat['t_time']>$now) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']>$now) { header("Location: academy.php"); exit; }
elseif ($stat['o_time']>$now) { header("Location: juvelir.php"); exit; }
elseif ($stat[r_time]>$now) { header("Location: podzem.php"); exit; }
elseif ($stat['lov_time']>$now) { header("Location: more.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['battle']) { header("Location: battle.php"); exit; }
elseif ($stat['room'] != 37) { header("Location: main.php"); exit; }
else {


	function show ($id) {
		global $stat;

		switch ($id) {
			case 1:

				$acc_ng = mysql_fetch_array(mysql_query("SELECT * FROM `ng` WHERE `id` = '1' "));

				if ($acc_ng['vkl'] == 1) {

					echo "<br>
<table><tr>
<td valign='top'>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>

<tr><td align='center'>��� �����</td></tr>
<tr><td>
���������� ������ <b>������ �������</b>, � <b><i>��� �����</b></i>, ������ ������ ��� ��������� <b>����� ���</b>. �� ��� �����, ��� ������ ���� <b><i>Santa Claus</b></i> �������� ����, ���� ��������� ��� ��������. <br>
�� � ��� ��������������� �������� ���� � �������� ���� ������, ����� ��� �������, ������, �������� � ����� ������ <b><i>Santa Claus</b></i> �������� �� ������� ������ � ����� <b>����������</b> (������). <br>
��� �� ������ ����� � ����, ��� ���� ����� ���������...<br>
���... �� ������� ��� ������, ������ ��� ����� �� ����������� ������, � ������� �� ���, � � ������ ���� ����������, ������ ����������, ������� �� <b>������ ����</b> �������� ������ ����.
</td>
</tr>

</table>
</div>

</td>

<td width='30%' valign='top'>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
<tr><td align='center' colspan='3'>������ �����������</td></tr>
<tr><td>������:</td><td align='center'>".$acc_ng['ng_zveda']." / 1</td><td align='center'><input class='input' type='text'></td></tr>
<tr><td>������:</td><td align='center'>".$acc_ng['nd_shar']." / 30</td><td align='center'><input class='input' type='text'></td></tr>
<tr><td>��������:</td><td align='center'>".$acc_ng['ng_gerland']." / 3</td><td align='center'><input class='input' type='text'></td></tr>
<tr><td>�������:</td><td align='center'>".$acc_ng['ng_igrush']." / 30</td><td align='center'><input class='input' type='text'></td></tr>
<tr><td align='center' colspan='3'><input class='input' type='submit' value='     �������     '></td></tr>
</table>
</div>

</td>
</tr>
</table>
";
				}



				echo "";
				break;

		}}

		echo"
<body bgcolor=F5FFD9 leftmargin=0 topmargin=0>
<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
        <td><b>� ��� �� �����:</b> <u>".$stat[credits]."</u> <b>��.</b>
        </td>
<td align=right valign=top>
<input class=input type=button value='��������' onclick='window.location.href=\"ng.php\"'>
<input class=input type=button value='���������' onclick='window.location.href=\"world2.php?room=0\"'>
</td>
</tr>
</table>";

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
<tr><td width='100%' valign='top'>";

		echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
    <tr>";

		echo "<td align=center width=33%><A"; if ($otdel == 1) echo" disabled><b>"; else echo" HREF='ng.php?otdel=1'>"; echo"��� �����</b></A></td>";
		echo "<td align=center width=33%><A"; if ($otdel == 2) echo" disabled><b>"; else echo" HREF='ng.php?otdel=2'>"; echo"���������� ����</b></A></td>";
		echo "<td align=center width=33%><A"; if ($otdel == 3) echo" disabled><b>"; else echo" HREF='ng.php?otdel=3'>"; echo"�������� �������</b></A></td>";

		echo "</tr>
  </table>
</div>";


		if (!empty($msg)) echo"<br><center><FONT COLOR=RED><b>$msg</b></font></center>";
		if (!empty($msg_ok)) echo"<br><center><FONT COLOR=green><b>$msg_ok</b></font></center>";

		if (!empty($_GET['otdel'])) {


			switch ($_GET['otdel']) {
				case 1: show(1); break;
				case 2: show(2); break;
				case 3: show(3); break;
				default: echo"<B STYLE='COLOR: Red'>����� ��� �� ��� :)</B>"; break;
			}

		} else echo "<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'>�� ���������� ����� <b>���������� ����</b>, ��� �� ����� ������� �������, ������, ��� ���� �� �������, �� �� ��������� ���-�� ��������, ���� ���� � �������, �� ��� ��� �������, ��� ��������, � ���-�� ������� ��� ����������� (������)... <br>
����������� �� �������� �� ������� �������� <b>���� ������</b> �������� � �������, ��� �� ����� ���� ����� ����� �� �������� �������, �� �������� �������������, ������ ����������... <br>
��� ����� ���������� ����� ��� ����� �� ����: <i>- �������� � <b>������� ������</b>, ������ ���, ���� <b>Santa Claus</b> ����� ��������� ��� ��������.�</i>
</td>
</tr>
  </table>
</div>";



		echo"
  </td>
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