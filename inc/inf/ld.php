<script>
function ld (date, writer, mess) {

document.write('[<a class=sysmessage><b>'+date+'</b></a>] ��������� �� <span style="CURSOR: Hand" onclick=\"inf(\''+writer+'\');\"><b>'+writer+'</b></span>: '+mess+'<br>\n');

}
</script>
<?

###########################
###########################
###########################

$rows=mysql_query("SELECT * FROM ld WHERE user='".$info['user']."' ORDER BY time");

if (mysql_num_rows($rows)) {

	echo"<FIELDSET><LEGEND>��������� �� ������������</LEGEND>
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td><script>";

	for($i=0; $i<mysql_num_rows($rows); $i++) {

		$lds=mysql_fetch_array($rows);

		if ($lds[type]=="1") $mess="������������ �� �������: <b>$lds[reason]</b>";
		elseif ($lds[type]=="3") $mess="��������� � ������ �� �������: <b>$lds[reason]</b>, ������ $lds[srok]";
		elseif ($lds[type]=="4") $mess="$lds[mess]";

		elseif ($lds[type]=="6") $mess="��������� �� ������ �� �������: <b>$lds[reason]</b>";
		elseif ($lds[type]=="7") $mess="������������� �� �������: <b>$lds[reason]</b>";

		elseif ($lds[type]=="2") $mess="������� ������ �� ������� � ���� �� �������: <b>$lds[reason]</b>, ������ $lds[srok]";
		elseif ($lds[type]=="8") $mess="������� ������ �� ������� �� ������ �� �������: <b>$lds[reason]</b>, ������ $lds[srok]";

		elseif ($lds[type]=="5") $mess="���� ������ �� ������� � ���� �� �������: <b>$lds[reason]</b>";
		elseif ($lds[type]=="9") $mess="���� ������ �� ������� �� ������ �� �������: <b>$lds[reason]</b>";

		echo "ld('",date("d.m.y H:i",$lds['time'])."','$lds[writer]','$mess');
"; }

		echo"
</script>
</td>
</tr>
</table>
</FIELDSET>
<br>";

}
##########################
##########################
##########################

?>