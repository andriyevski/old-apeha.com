<?
require_once("inc/module.php");
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat[t_time]>time()) { header("Location: prison.php"); exit; }
elseif ($stat[battle]>time()) { header("Location: battle.php"); exit; }
//elseif ($stat['room'] != 38) { header("Location: main.php"); exit; }
elseif ($stat['o_time']>time()) { header("Location: juvelir.php"); exit; }
elseif ($stat['mol_bog_swet']>time()) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>time()) { header("Location: bog_hram.php"); exit; }

else {


	//������ �������� � ����
	if ($perexod) {

		$boots = mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=6 AND objects.min='3|0|0|0|0|0|0|0' AND objects.id IN (slots.13)");

		if (mysql_num_rows ($boots)) {




			$korzinka_inf=explode("|",$korzinka['inf']);


			if ($stat[level] >= 3) { // �������� ������

				mysql_query("UPDATE players set room=602 where user='".$stat['user']."'");
				$stat['room']=602;

				require_once("inc/chat/functions.php");
				insert_msg("�� ����������� � ���","","","1",$stat[user],"",$stat[room]);

				echo "<meta http-equiv='refresh' content='0; url=forest.php'>"; }

				else $msg="� ��� �� ��� �������, ��������������� ������� 4!"; }

				else $msg="� ��� ��� �������, ������ ������ ��� ������� �� ���� ��� �������!"; }

				//����� �������� � ����

				include("inc/html_header.php");

				echo"<body background='/i/bg.gif' leftmargin=0 topmargin=0>";

				print"<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td align=left>� ��� �� �����: <b>".$stat[credits]."</b> ��.</td>
<td align=right valign=top>
<input class=input type=button value='��������' onclick='window.location.href=\"goforest.php?tmp=\"+Math.random();\"\"'>
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
    <td width='25%' align='center'><b>��������� ������</b></td>
    <td width='25%' align='center'><b>���������� ������</b></td>
    <td width='25%' align='center'><b>������� ������</b></td>
    <td width='25%' align='center'><b>���������� ������</b></td>
  </tr>
<tr>
    <td width='25%' align='center'><img src='i/items/boots_3_les.gif'></td>
    <td width='25%' align='center'><img src='i/items/boots_3_les2.gif'></td>
    <td width='25%' align='center'><img src='i/items/boots_3_les3.gif'></td>
    <td width='25%' align='center'><img src='i/items/boots_3_les4.gif'></td>
  </tr>
  <tr>
    <td width='25%' align='center'>+1 � �������� ������������</td>
    <td width='25%' align='center'>+2 � �������� ������������</td>
    <td width='25%' align='center'>+3 � �������� ������������</td>
    <td width='25%' align='center'>+4 � �������� ������������</td>
  </tr>
  <tr>
    <td width='25%' align='center'><b>50 ��</b></td>
    <td width='25%' align='center'><b>100 ��</b></td>
    <td width='25%' align='center'><b>150 ��</b></td>
    <td width='25%' align='center'><b>300 ��</b></td>
  </tr>
  <tr>
    <td width='100%' colspan='4' align='center'>
���������� ������ ����� � ���. ��������, � ������� ������
</td>
  </tr>
</table>
</div>
";


				echo"
<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center' colspan='4'><b>������� �������� ���������:</b></td></tr>
  <tr>
    <td width='25%' align='center'><b>��������</b></td>
    <td width='25%' align='center'><b>������</b></td>

  </tr>
<tr>
    <td width='25%' align='center'><img src='i/items/korzinka.gif'></td>
    <td width='25%' align='center'><img src='i/items/lopata.gif'></td>
  </tr>
  <tr>
    <td width='25%' align='center'>������ ��� �������� � �������� ��������, ������� � ����</td>
    <td width='25%' align='center'>������ ��� ����������� ���������</td>
  </tr>
  <tr>
    <td width='25%' align='center'><b>250 ��</b></td>
    <td width='25%' align='center'><b>250 ��</b></td>

  </tr>
  <tr>
    <td width='100%' colspan='4' align='center'>
���������� ��������� ����� � ���. ��������, � ������� �����������
</td>
  </tr>
</table>
</div>
";


				echo "</td><td valign='top'>";



				echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>������ ���������:</b></td></tr>
  <tr><td>";

				$boots=mysql_fetch_array(mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=6 AND objects.min='3|0|0|0|0|0|0|0' AND objects.inf LIKE '%boots%'"));

				$boots_inf=explode("|",$boots['inf']);

				if ($boots) {
					echo "��������: <b>"; echo $boots_inf[1];
					echo "</b><br>
<center><img src='i/items/".$boots_inf['0'].".gif'></center>
�����������: <b>".$boots['about']."</b>"; 
				} else {
					echo "� ��� ��� �����.";
				}

				echo "<br><br>";

				$korzinka=mysql_fetch_array(mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=15 AND objects.min='3|0|0|0|0|0|0|0' AND objects.inf LIKE '%korzinka%'
 "));

				$korzinka_inf=explode("|",$korzinka['inf']);

				if ($korzinka) {
					echo "��������: <b>"; echo $korzinka_inf[1];
					echo "</b><br>
<center><img src='i/items/".$korzinka_inf['0'].".gif'></center>
�����������: <b>".$korzinka['about']."</b>"; 
				} else {
					echo "� ��� ��� ��������.";
				}


				echo "<br><br>";

				$lopata=mysql_fetch_array(mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=15 AND objects.inf LIKE '%lopata%'
 AND objects.min='5|0|0|0|0|0|0|0'"));

				$lopata_inf=explode("|",$lopata['inf']);

				if ($lopata) {
					echo "��������: <b>"; echo $korzinka_inf[1];
					echo "</b><br>
<center><img src='i/items/".$lopata_inf['0'].".gif'></center>
�����������: <b>".$lopata['about']."</b>"; 
				} else {
					echo "� ��� ��� ������.";
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
 - ��� ����������� ��� ����� <b>������</b><br>
 - ��� ������ ��� ����� ��������<br>
 - ��� ��������� � ���� ��� ����� ������ <b>���������</b><br>
 - <font color='red'><b>��������!!!</b></font> �������� ���������� � <b>���. ��������</b> ������ <b>������� ���������</b>, �.�. � ���� ����� ����� ����������.
<center><input type=submit class=input value='����������� � ���' name=perexod></center>
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