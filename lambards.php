<?
require_once("inc/module.php");
include("inc/db_connect.php");
$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));
if ($stat[bloked]) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat['t_time']>$now) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']>$now) { header("Location: academy.php"); exit; }
elseif ($stat['o_time']>$now) { header("Location: juvelir.php"); exit; }
elseif ($stat['r_time']>$now) { header("Location: podzem.php"); exit; }
elseif ($stat['lov_time']>$now) { header("Location: more.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat[room]!="46") { header("Location: main.php"); exit; }
else {

	echo"<body background='/i/bg.gif' leftmargin=0 topmargin=0>
<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td align=right valign=top>
<input class=input type=button value='��������' onclick='window.location.href=\"lambards.php?tmp=\"+Math.random();\"\"'>
<input class=input type=button value='���������' onclick='window.location.href=\"world.php?room=25&tmp=\"+Math.random();\"\"'>
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
<tr>
                <td width='50%' valign='top'>

<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
<td align='center'><b>���� ����������:</b></td></tr>
<tr>
        <td>� ��� �� �����: <b>".$stat[credits]."</b> ��.
        <br>����� �����: <b>".mysql_num_rows(mysql_query("SELECT id FROM objects WHERE lam=1 and user='".$stat['user']."'"))."</b> ��.
        </td></tr>
</table>
</div>
<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>����������:</b></td></tr><tr><td>
- �� ������ ����� � <b>�������</b> ���� ���� �� <b>50%</b> �� � ���������.<br>
- � ������� <b>1 ������</b> �� � ������ ��������, � ��������� ������ <b>�������</b> � ��������� ����.<br>
- ���� ������ ���� �� <b>��������</b> ���������� <b>70%</b> �� � ���������.
</td>
</tr>
</table>
</div>";
	$it_sost1=mysql_query("SELECT objects.* FROM objects, slots where objects.user='".$stat['user']."' AND objects.present=0 AND objects.bank=0 AND objects.komis=0 AND objects.lam=1 AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) ORDER BY time desc");
	if (mysql_num_rows($it_sost1)) {
		for($i=0; $i<mysql_num_rows($it_sost1); $i++) {
			$objects=mysql_fetch_array($it_sost1);

			$obj_inf=explode("|",$objects['inf']);
			$obj_min=explode("|",$objects['min']);
			$obj_add=explode("|",$objects['add']);

			include('inc/main/min_tr.php');
			include('inc/main/add.php');
			include('inc/main/classes.php');

			$sale_price=round($obj_inf['2']*0.5);
			$get_price=round($obj_inf['2']*0.7);

			echo"<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
      <td align='center' colspan='2'>
        <b>� ��������� ��������:</b>
      </td>
    </tr>
    <tr><td width='30%' align='center'>
      <img src='i/items/".$obj_inf['0'].".gif' alt='".$obj_inf['1']."'><br>";
			echo"<span onclick=\"if (confirm('������� ������� &quot;".$obj_inf['1']."&quot; �� &quot;".$get_price."&quot; ��.?')) window.location='lambards.php?get=".$objects['id']."'\" style='CURSOR: Hand'><font color='red'><b>������� �� ".$get_price." ��.</b></font>";
			echo"</td>
        <td width='70%'>
        <small><b>".$obj_inf['1']."</b><br>
        ��� ����: ".$obj_inf['2']." ��.</small><br>";
			if ($objects['tip'] != 13 || $objects['tip'] != 15  || $objects['tip'] != 20) echo"<font ".($obj_inf[6]>=$obj_inf[7]?'color=red':'color=black')."><SMALL>�������������: ".$obj_inf['6']." [".$obj_inf['7']."]</SMALL></font><br>";
			echo "<br><SMALL><b><u>����������� ����������:</u></b><br>
			$min_rase$min_level$min_str$min_dex$min_ag$min_vit<br>
        <B><U>�������� ��������:</U></B><br>
        $hp$energy$uron$strength$dex$agility$vitality$razum$br1$br2$br5$br3$br4$krit$unkrit$uv$unuv</SMALL>";

        if ($objects['about']) echo"<SMALL><b><u>�������������� ����������:</u></b><br>$about</SMALL>";
        if ($obj_inf['3']) echo"<b><u><small>������������� �������:</u></b><BR>".$obj_inf['3'];
        echo "</tr>
  </table>
</div>";
		}
	} else echo"<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
      <td align='center'>
        <b>� ��������� ��������:</b>
      </td>
    </tr>
    <tr>
      <td align='center'>
        <a class=agree>��������� �������� �����!</a>
      </td>
    </tr>
  </table>
</div>";
	echo "</td>
     <td width='50%' valign='top'>";

	if (!empty($sale) && is_numeric($sale)) {
		// ����
		$sale = addslashes($sale);

		$is_ex=mysql_fetch_array(mysql_query("SELECT objects.`id`,objects.`inf`,objects.`tip` FROM objects, slots WHERE objects.user='".$stat['user']."' AND objects.present=0 && objects.id=".addslashes($sale)." AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19)"));

		$is_ex_inf=explode("|",$is_ex['inf']);

		if (!empty($is_ex_inf['0'])) {
			if ($is_ex['tip'] != 12) {
				$price=round($is_ex_inf['2']*0.5);
				$srok="$now+604800";

				mysql_query("UPDATE objects SET lam=1, dat=$srok WHERE id=".addslashes($sale)."");
				mysql_query("UPDATE players SET credits=credits+".$price." WHERE id=".$stat['id']."");

				$stat['credits']=$stat['credits']+$price;

				$msg="�� ������ ����� ���� ������� <u>".$is_ex_inf['1']."</u> �� <u>".$price."</u> ��.<br>�������� ��������� ����� 3 �������, ���������...";

				echo "<meta http-equiv='refresh' content='3; url=lambards.php'>";

				$is_ex_inf['0'] = "";
			}
			else $msg="������� <u>".$is_ex_inf['1']."</u> �� ��������� �������!";
		}
		else echo"������� �� ������ � ����� �������!";
	}

	if (!empty($get) && is_numeric($get)) {
		// ��������
		$get = addslashes($get);

		$is_ex=mysql_fetch_array(mysql_query("SELECT objects.`id`,objects.`inf`,objects.`tip` FROM objects, slots WHERE objects.user='".$stat['user']."' AND objects.present=0 && objects.id=".addslashes($get)." AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19)"));

		$is_ex_inf=explode("|",$is_ex['inf']);

		if (!empty($is_ex_inf['0'])) {
			if ($is_ex['tip'] != 12) {

				$price=round($is_ex_inf['2']*0.7);
				if ($stat['credits'] > $price) {
					mysql_query("UPDATE objects SET lam=0, dat=0 WHERE id=".addslashes($get)."");
					mysql_query("UPDATE players SET credits=credits-".$price." WHERE id=".$stat['id']."");

					$stat['credits']=$stat['credits']-$price;

					$msg="�� ������ ������� ���� ������� <u>".$is_ex_inf['1']."</u> �� <u>".$price."</u> ��.<br>�������� ��������� ����� 3 �������, ���������...";

					echo "<meta http-equiv='refresh' content='3; url=lambards.php'>";

					$is_ex_inf['0'] = "";
				}
				else $msg="� ��� ������������ ������� ��� ������ <u>".$is_ex_inf['1']."</u> !";
			}
			else $msg="������� <u>".$is_ex_inf['1']."</u> �� ��������� �������!";
		}
		else echo"������� �� ������ � ����� �������!";
	}

	if ($msg!="") echo"<center><font color=red><b>$msg</b></font></center>";

	$it_sost=mysql_query("SELECT objects.* FROM objects, slots where objects.user='".$stat['user']."' AND objects.present=0 AND objects.bank=0 AND objects.komis=0 AND objects.lam=0 AND objects.pochta=0 AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) ORDER BY time desc");
	if (mysql_num_rows($it_sost)) {
		for($i=0; $i<mysql_num_rows($it_sost); $i++) {
			$objects=mysql_fetch_array($it_sost);

			$obj_inf=explode("|",$objects['inf']);
			$obj_min=explode("|",$objects['min']);
			$obj_add=explode("|",$objects['add']);

			include('inc/main/min_tr.php');
			include('inc/main/add.php');
			include('inc/main/classes.php');

			$sale_price=round($obj_inf['2']*0.5);
			$get_price=round($obj_inf['2']*0.7);

			echo"<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
      <td align='center' colspan='2'>
        <b>� ����� �������:</b>
      </td>
    </tr>
    <tr><td width='30%' align='center'>
      <img src='i/items/".$obj_inf['0'].".gif' alt='".$obj_inf['1']."'><br>";
			echo"<span onclick=\"if (confirm('����� ������� &quot;".$obj_inf['1']."&quot; �� &quot;".$sale_price."&quot; ��.?')) window.location='lambards.php?sale=".$objects['id']."'\" style='CURSOR: Hand'><font color='green'><b>����� �� ".$sale_price." ��.</b></font>";
			echo"</td>
        <td width='70%'>
        <small><b>".$obj_inf['1']."</b><br>
        ��� ����: ".$obj_inf['2']." ��.</small><br>";
			if ($objects['tip'] != 13 || $objects['tip'] != 15  || $objects['tip'] != 20) echo"<font ".($obj_inf[6]>=$obj_inf[7]?'color=red':'color=black')."><SMALL>�������������: ".$obj_inf['6']." [".$obj_inf['7']."]</SMALL></font><br>";
			echo "<br><SMALL><b><u>����������� ����������:</u></b><br>
			$min_rase$min_level$min_str$min_dex$min_ag$min_vit<br>
        <B><U>�������� ��������:</U></B><br>
        $hp$energy$uron$strength$dex$agility$vitality$razum$br1$br2$br5$br3$br4$krit$unkrit$uv$unuv</SMALL>";

        if ($objects['about']) echo"<SMALL><b><u>�������������� ����������:</u></b><br>$about</SMALL>";
        if ($obj_inf['3']) echo"<b><u><small>������������� �������:</u></b><BR>".$obj_inf['3'];
        echo "</tr>
  </table>
</div>";
		}
	} else echo"<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
      <td align='center'>
         <b>� ����� �������:</b>
      </td>
    </tr>
    <tr>
      <td align='center'>
        <a class=agree>����� ������� ����!</a>
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