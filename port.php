<?
require_once("inc/module.php");
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat[t_time]) { header("Location: prison.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat['room'] != 700) { header("Location: main.php"); exit; }
elseif ($stat['o_time']>time()) { header("Location: juvelir.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }

else {

	if ( $lodka == 1 ) { $cena = 100; }
	elseif ( $lodka == 2 ) { $cena = 150; }
	elseif ( $lodka == 3 ) { $cena = 200; }
	elseif ( $lodka == 4 ) { $cena = 250; }

	//������ ������� �����
	if ($kup) {
		if ($stat[credits] >= $cena) { // �������� �����
			if ($stat[lodka] != $lodka) { //�������� �� �� ��� ���� � �� ����� �� ����� ������� �� ������ ������
				if ($stat[level] >= 4) { // �������� ������

					$msg="�� ������ ������ ���� ����� ������ <u>$lodka</u> �� <u>$cena</u> ��!";

					mysql_query("UPDATE players set lodka=$lodka, credits=credits-$cena where user='".$stat['user']."'");
					$stat[lodka]=$lodka;

					echo "<meta http-equiv='refresh' content='0; url=port.php'>"; }

					else $msg="� ��� �� ��� �������, ��������������� ������� 4!"; }
					else $msg="� ��� ����� �� �����!"; }
					else $msg="� ��� �� ������� ������!"; }
					//����� ������� �����

					//������ �������� � ����
					if ($perexod) {
						if ($stat[lodka] >= 1) { // �������� �� ������ �����
							if ($stat[level] >= 4) { // �������� ������

								mysql_query("UPDATE players set room=702 where user='".$stat['user']."'");
								$stat['room']=702;

								require_once("inc/chat/functions.php");
								insert_msg("�� ������ ����� � ����","","","1",$stat[user],"",$stat[room]);

								echo "<meta http-equiv='refresh' content='0; url=more.php'>"; }

								else $msg="� ��� �� ��� �������, ��������������� ������� 4!"; }
								else $msg="� ��� ��� �����, ������ �� �������!"; }
								//����� �������� � ����

								include("inc/html_header.php");

								echo"<body background='/i/bg.gif' leftmargin=0 topmargin=0>";

								print"<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td align=left>� ��� �� �����: <b>".$stat[credits]."</b> ��.</td>
<td align=right valign=top>
<input class=input type=button value='��������' onclick='window.location.href=\"port.php?tmp=\"+Math.random();\"\"'>
<input class=input type=button value='�����' onclick='window.location.href=\"world2.php?room=35&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";


								if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";


								echo "<form action='' method=post><table border='0' width='100%' cellspacing='0' cellpadding='0'>
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
            <tr><td valign='top'>";


								echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center' colspan='4'><b>������� �����:</b></td></tr>
  <tr>
    <td width='25%' align='center'><b>������ �����</b></td>
    <td width='25%' align='center'><b>������ �����</b></td>
    <td width='25%' align='center'><b>�����</b></td>
    <td width='25%' align='center'><b>���������� �����</b></td>
  </tr>
<tr>
    <td width='25%' align='center'><img src='i/more/lodka1.gif'></td>
    <td width='25%' align='center'><img src='i/more/lodka2.gif'></td>
    <td width='25%' align='center'><img src='i/more/lodka3.gif'></td>
    <td width='25%' align='center'><img src='i/more/lodka4.gif'></td>
  </tr>
  <tr>
    <td width='25%' align='center'>+1 � �������� ������������</td>
    <td width='25%' align='center'>+2 � �������� ������������</td>
    <td width='25%' align='center'>+3 � �������� ������������</td>
    <td width='25%' align='center'>+4 � �������� ������������</td>
  </tr>
  <tr>
    <td width='25%' align='center'><b>100 ��</b></td>
    <td width='25%' align='center'><b>150 ��</b></td>
    <td width='25%' align='center'><b>200 ��</b></td>
    <td width='25%' align='center'><b>250 ��</b></td>
  </tr>
  <tr>
    <td width='100%' colspan='4' align='center'>
���������� <select name=lodka><option value=1>������ ����� +1<option value=2>������ ����� +2<option value=3>����� +3<option value=4>���������� ����� +4</select> <input type=submit class=input value='������' name=kup>
</td>
  </tr>
</table>
</div>
";


								echo "</td><td valign='top'>";



								echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>���� �����:</b></td></tr>
  <tr><td>";
								if ($stat['lodka'] != 0) {
									echo "��������: <b>";
									if ( $stat['lodka'] == 1 ) { echo "������ �����"; }
									elseif ( $stat['lodka'] == 2 ) { echo "������ �����"; }
									elseif ( $stat['lodka'] == 3 ) { echo "�����"; }
									elseif ( $stat['lodka'] == 4 ) { echo "���������� �����"; }
									echo "</b><br>
<center><img src='i/more/lodka".$stat['lodka'].".gif'></center>
�����������: <b>+".$stat['lodka']." � �������� ������������</b>"; 
								} else {
									echo "� ��� ��� �����.";
								}

								echo"</td>
  </tr>
</table>
</div>
";

								echo "<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>��������</b></td></tr>
<tr><td valign='top'>
 - ��� �������� ��� ����� <b>�����</b><br>
 - ��� ������� ��� ����� ������<br>
 - ��� ��������� � ���� ��� ����� ������ <b>���������</b><br>
 - <font color='red'><b>��������!!!</b></font> �������� ���������� � <b>���. ��������</b> ������ <b>�������� ���������</b>, �.�. � ���� ����� ����� ����������.
<center><input type=submit class=input value='����� � ����' name=perexod></center>
</td></tr></table></div>";

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
</table></form>";


}
?>