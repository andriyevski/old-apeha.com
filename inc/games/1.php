<table width=100% cellspacing=0 cellpadding=3 border=0>	<td width=30%><img src='i/bone/bone.jpg' alt='�����'></td>	<td width=70% valign=top>	<FIELDSET><LEGEND>������� ����</LEGEND> ������� ���� ��������� ������,	�� ��� ��������� ������ ������� ������ � ������ ������.<br>	�����, �������� �� ������� ������ ����� �������, ������������ � ������	����������. ����������� ��������� ���, � ���� ��� ������.<br>	������� ������������ �� ����� ������.</FIELDSET>	<?
	function new_game () {
		?>	<form action='?gameroom=1&set=game' method=post>	<P>			<FIELDSET><LEGEND>����� ����</LEGEND>	<center>������: <SELECT class=standbut name=type>		<OPTION value='1' selected>10 ��.						<OPTION value='2'>25 ��.						<OPTION value='3'>50 ��.						<OPTION value='4'>100 ��.						<OPTION value='5'>200 ��.</OPTION>	</SELECT>	<p><input type=submit value='������ ����' class=standbut>		</center>	</FIELDSET>	</form>	</td>	</tr></table>		<?
	}
	if (!$_GET[set])
	{
		new_game();
	}
	if ($_GET[set]==game) {
		if ($_POST[type]==1 or $_POST[type]==2 or $_POST[type]==3 or $_POST[type]==4 or $_POST[type]==5) {
			if ($_POST[type]==1) $st=10;
			if ($_POST[type]==2) $st=25;
			if ($_POST[type]==3) $st=50;
			if ($_POST[type]==4) $st=100;
			if ($_POST[type]==5) $st=200;
			if ($stat[credits]>=$st) {
				if ($_POST[play]==1) {
					$player_1 = rand(1,6);
					$player_2 = rand(1,6);
					$comp_1 = rand(2,6);
					$comp_2 = rand(2,6);
				}
				?><table width=100%>	<tr>		<td width=50%>		<FIELDSET><LEGEND>����� �1</LEGEND>		<center><script language=JavaScript>show_inf('<?=$stat[user]?>','<?=$stat[id]?>','<?=$stat[level]?>','<?=$stat[rank]?>','<?=$stat[tribe]?>');</script>		</center>		<br>		������: <b><?=$stat[credits]?> ��.</b> <br>		������: <b><?=$st?> ��.</b> <?
		if ($_POST[play]==1) {
			?> <br>		������:		<center><img src='i/bone/<?=$player_1?>.gif' alt='<?=$player_1?>'>		<p><img src='i/bone/<?=$player_2?>.gif' alt='<?=$player_2?>'>				</center>		<?
		}
		?></FIELDSET>		</td>		<td width=50%>		<FIELDSET><LEGEND>����� �2</LEGEND>		<center><script language=JavaScript>show_inf('<i>����</i>','100','100','100','');</script>		</center>		<br>		������: <b>??? ��.</b> <br>		������: <b><?=$st?> ��.</b> <?
		if ($_POST['play']==1) {
			?> <br>		������:		<center><img src='i/bone/<?=$comp_1?>.gif' alt='<?=$comp_1?>'>		<p><img src='i/bone/<?=$comp_2?>.gif' alt='<?=$comp_2?>'>				</center>		<?
		}
		?></FIELDSET>		</td>	</tr></table><form action='?gameroom=1&set=game' method=post><input type="hidden"	name="type" value="<?=$_POST[type]?>"> <input type="hidden" name="play"	value="1"><FIELDSET><LEGEND>��������</LEGEND><center><? if ($_POST[play]==1) {
	$summa_player = $player_1+$player_2;
	$summa_comp = $comp_1+$comp_2;
	if ($summa_player>$summa_comp) {
		mysql_query("UPDATE players SET credits=credits+".$st." WHERE user='".$stat['user']."'");

		$stat[credits] = $stat[credits]+$st;
		echo "<p><center><font class=sysmessage>�����������! �� �������� � ��������� <b>$st ��.</b>!</font></center><p>";
	}
	if ($summa_player<$summa_comp) {
		mysql_query("UPDATE players SET credits=credits-".$st." WHERE user='".$stat['user']."'");

		$stat[credits] = $stat[credits]-$st;
		echo "<p><center><font class=sysmessage>�� ���������! � ��� ���������  <b>$st ��.</b>!</font></center><p>";
	}
	if ($summa_player==$summa_comp) {
		echo "<p><center><font class=sysmessage>�����! ������� ����� ��� ���!</font></center><p>";
	}
	echo "<input type=submit value='������� ��� ���' class=standbut>";
}
else {
	echo "<input type=submit value='������ �����' class=standbut>";
}
?> <input type=button value='����� ����' class=standbut	onclick='window.location.href="gamblinghouse.php?gameroom=1&tmp="+Math.random();""'></center></FIELDSET></form></td></tr></table><?
			}
			else {
				echo "<p><center><font class=bloked>� ��� ������������ �����!</font></center><p>";
				new_game();
			}
		}
		else {
			echo "<p><center><font class=bloked>�� ������� ������!</font></center><p>";
			new_game();
		}
	}
	?>