<?
//������ �������
if (@$kupit) {
	$summ=$koll*20;
	$koll = HtmlSpecialChars($koll);
	if ($koll!=0) {
		AddSlashes($koll);
		if (eregi("^[0-9]+$",$koll)) {
			if ($stat[valute]>=$koll) { // ������� �����
				mysql_query("UPDATE players set valute=valute-$koll where id=$stat[id]");
				mysql_query("UPDATE players set credits=credits+$summ where id=$stat[id]");
				$stat[valute]=$stat[valute]-$koll;
				$stat[credits]=$stat[credits]+$summ;
				$msgs="�� ������� <i>$koll</i> ��. � �������� <i>$summ</i> ��.!"; }
				else $msgs="� ��� ���� ������� ������!"; }
				else $msgs="���������� ����� ����������� �������!"; }
				else $msgs="������� ����� �������� 1 ��.!"; }
				// ����� �������
				echo"
<form method=POST>
<i>� ��� ������� �����:</i><b> ".$stat['credits']." ��. </b><br>
<i>� ��� ������: </i><b> ".$stat['valute']." ��. </b> <br>
<i>���� ������: </i> <b>1 ��. = 20 ��. </b>
</td>
<td>";
				if (!empty($msgs)) echo"<center><FONT COLOR=RED><b>$msgs</b></font></center>";
				echo"
<center>
<input type=text name=koll size=13 class=input value=0> <input type=submit class=input value='��������' name='kupit'>
</center></td></form>";
				?>