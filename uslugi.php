<?
include('inc/header.php');

$oshib = "� ��� �� ������� ��.";
$kup = "������ �������";

$now = time();

/*if (isset($take4)) {
	if ($stat['valute'] >= 5) {
		mysql_query("UPDATE players SET le4=$now+14400, valute=valute-5 WHERE user='".$stat['user']."'");
		$stat['valute']=$stat['valute']-5;
		$msg="$kup 1 ���. ����������� ������� � 2 ���� �� 5 ��!";
	} else $msg="" . $oshib;
}*/

if (isset($take20)) {
	if ($stat['valute'] >= 90 and $stat['sign']<time()) {
		mysql_query("UPDATE players SET `abonement`=$now+2592000, `valute`=`valute`-90 WHERE `user`='".$stat['user']."'");
		$stat['valute']=$stat['valute']-90;
		$msg="$kup ��������� �� 30 ���� �� 90 ��!";
	} else $msg="" . $oshib;
}

if (isset($take15)) {
	if ($stat['valute'] >= 5) {
		mysql_query("UPDATE players SET credits=credits+50000, valute=valute-5 WHERE user='".$stat['user']."'");
		$stat['valute']=$stat['valute']-5;
		$msg="$kup 50 000 �� �� 5 ��!";
	} else $msg="" . $oshib;
}

if (isset($take5)) {
	if ($stat['valute'] >= 10 and $stat['abonement']<time()) {
		mysql_query("UPDATE players SET sign=$now+14400, valute=valute-10 WHERE user='".$stat['user']."'");
		$stat['valute']=$stat['valute']-5;
		$msg="$kup 4 ���. ����������� ��������� ����� � 3 ��� �� 10 ��!";
	} else $msg="" . $oshib;
}

if (isset($take6)) {
	if ($stat['valute'] >= 5) {
		mysql_query("UPDATE players SET s_updates=s_updates+1, valute=valute-5 WHERE user='".$stat['user']."'");
		$stat['s_update']=$stat['s_update']+1;
		$stat['valute']=$stat['valute']-5;
		$msg="$kup 1 ��. ���������� ��������� �� 5 ��!";
	} else $msg="" . $oshib;
}

if (isset($take7)) {
	if ($stat['valute'] >= 45) {
		mysql_query("UPDATE players SET s_updates=s_updates+10, valute=valute-45 WHERE user='".$stat['user']."'");
		$stat['s_update']=$stat['s_update']+10;
		$stat['valute']=$stat['valute']-45;
		$msg="$kup 10 ��. ���������� ��������� �� 45 ��!";
	} else $msg="" . $oshib;
}

if (isset($take8)) {
	if ($stat['valute'] >= 30) {
		mysql_query("UPDATE players SET o_updates=o_updates+1, valute=valute-30 WHERE user='".$stat['user']."'");
		$stat['o_update']=$stat['o_update']+1;
		$stat['valute']=$stat['valute']-30;
		$msg="$kup 1 ��. ��������� ����������� �� 30 ��!";
	} else $msg="" . $oshib;
}

if (isset($take12)) {
	if ($stat['valute'] >= 1) {
		mysql_query("UPDATE players SET travma=0 WHERE user='".$stat['user']."'");
		mysql_query("UPDATE players SET valute=valute-1 WHERE user='".$stat['user']."'");
		$stat['travma']=0;
		$stat['valute']=$stat['valute']-1;
		$msg="$kup ��������� ����� �� 1 ��!";
	} else $msg="" . $oshib;
}

if (isset($take14)) {
	if ($stat['valute'] >= 1) {
		mysql_query("UPDATE players SET attack=attack-1,bite=bite-1 WHERE user='".$stat['user']."'");
		mysql_query("UPDATE players SET valute=valute-1 WHERE user='".$stat['user']."'");
		$stat['valute']=$stat['valute']-1;
		$msg="$kup ���������� 1 �������!";
	} else $msg="" . $oshib;
}


if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";
echo "
<table border='0' width='100%' cellspacing='0' cellpadding='0'>
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
            <table border='0' width='100%' height='100%' cellspacing='0' cellpadding='0'>
              <tr>
                <td width='100%'>";



echo "<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>���������� ��� ���</b></td></tr>
<tr><td>
��� �����: <b>$stat[user]</b><br>
ID ������ ���������: <b>$stat[id]</b><br>
� ��� �� �����: <b>$stat[valute] ��.</b><br>
����: <b>1 ��. = 5 ���</b>, <b>5 ��. = 50 000 ��.</b><br>
<center><b>��������� ���� ���� �� ������ ����������� � ������ � ��������� migon:</u></b></center>
</td></tr></table></div>";

echo "<br><div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center' colspan='3'><b>������ ��������� �����</b></td></tr>
      <tr>
        <td width=20% align=center><b>�������</b></td>
        <td width=65% align=center><b>��������</b></td>
        <td width=15% align=center><b>���������</b></td>
      </tr>
      <tr>
       <td width=20% align=center>";


if ($stat['valute']>=90 and $stat['sign']<time()) echo"<input class=input type=button value='������' onClick=top.main.location.href='uslugi.php?take20'>"; else echo "<input disabled class=input type=button value='������' onClick=top.main.location.href='main.php?set=work'></td></font>";
echo" </td>
        <td width=65%>������ ��������� ������� ���� ������� ���������� �� 30 ����<br>(<font color=red>���������� ����������� ����� � <b>3 ���</b> �� 30 ����</font>)</td>
        <td width=15% align=center><b>90 ��.</b></td>
      </tr>
      <tr>
        <td width=20% align=center>";


if ($stat['valute']>=5) echo"<input class=input type=button value='������' onClick=top.main.location.href='uslugi.php?take15'>"; else echo "<input class=input type=button value='�� ������� ��.' onClick=top.main.location.href='main.php?set=work'></td></font>";
echo" </td>
        <td width=65%>������ 50 000 ��</td>
        <td width=15% align=center><b>5 ��.</b></td>
      </tr>
      <tr>
        <td width=20% align=center>"; if ($stat['valute']>=1) echo"<input class=input type=button value='������' onClick=top.main.location.href='uslugi.php?take12'>"; else echo "<input class=input type=button value='�� ������� ��.' onClick=top.main.location.href='main.php?set=work'></td></font>";
echo" </td>
        <td width=65%>��������� �����</td>
        <td width=15% align=center><b>1 ��.</b></td>
      </tr>
       <tr>
        <td width=20% align=center>"; if ($stat['valute']>=1) echo"<input class=input type=button value='������' onClick=top.main.location.href='uslugi.php?take14'>"; else echo "<input class=input type=button value='�� ������� ��.' onClick=top.main.location.href='main.php?set=work'></td></font>";
echo" </td>
        <td width=65%>-1 � �������</td>
        <td width=15% align=center><b>1 ��.</b></td>
      </tr>
      <tr>
        <td width=20% align=center>"; if ($stat['valute']>=5) echo"<input class=input type=button value='������' onClick=top.main.location.href='uslugi.php?take6'>"; else echo "<input class=input type=button value='�� ������� ��.' onClick=top.main.location.href='main.php?set=work'></td></font>";
echo" </td>
        <td width=65%>��������� ���������� �������� - <b>1 ��.</b></td>
        <td width=15% align=center><b>5 ��.</b></td>
      </tr>
      <tr>
        <td width=20% align=center>"; if ($stat['valute']>=10 and $stat['abonement']<time()) echo"<input class=input type=button value='������' onClick=top.main.location.href='uslugi.php?take5'>"; else echo "<input disabled class=input type=button value='������' onClick=top.main.location.href='main.php?set=work'></td></font>";
echo" </td>
        <td width=65%><font color=red>���������� ����������� ����� � <b>3 ���</b> �� 4 ����</font></td>
        <td width=15% align=center><b>10 ��.</b></td>
      </tr>
      <tr>
        <td width=20% align=center>"; if ($stat['valute']>=5) echo"<input disabled class=input type=button value='������' onClick=top.main.location.href='uslugi.php?take4'>"; else echo "<input class=input type=button value='�� ������� ��.' onClick=top.main.location.href='main.php?set=work'></td></font>";
echo" </td>
        <td width=65%><font color=red>���������� ������� � <b>2 ���.</b> �� 4 ����</font></td>
        <td width=15% align=center><b>5 ��.</b></td>
      </tr>
      <tr>
        <td width=20% align=center>"; if ($stat['valute']>=45) echo"<input class=input type=button value='������' onClick=top.main.location.href='uslugi.php?take7'>"; else echo "<input class=input type=button value='�� ������� ��.' onClick=top.main.location.href='main.php?set=work'></td></font>";
echo" </td>
        <td width=65%>��������� ���������� �������� - <b>10 ��.</b></td>
        <td width=15% align=center><b>45 ��.</b></td>
      </tr>
      <tr>
        <td width=20% align=center>"; if ($stat['valute']>=30) echo"<input class=input type=button value='������' onClick=top.main.location.href='uslugi.php?take8'>"; else echo "<input class=input type=button value='�� ������� ��.' onClick=top.main.location.href='main.php?set=work'></td></font>";
echo" </td>
        <td width=65%>��������� ����������� - <b>1 ��.</b></td>
        <td width=15% align=center><b>30 ��.</b></td>
      </tr></table></div>";


 
echo"                </td>
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
?>