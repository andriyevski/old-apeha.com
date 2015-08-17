<script>
function ld (date, writer, mess) {

document.write('[<a class=sysmessage><b>'+date+'</b></a>] Сообщение от <span style="CURSOR: Hand" onclick=\"inf(\''+writer+'\');\"><b>'+writer+'</b></span>: '+mess+'<br>\n');

}
</script>
<?

###########################
###########################
###########################

$rows=mysql_query("SELECT * FROM ld WHERE user='".$info['user']."' ORDER BY time");

if (mysql_num_rows($rows)) {

	echo"<FIELDSET><LEGEND>Сообщения от инквизиторов</LEGEND>
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td><script>";

	for($i=0; $i<mysql_num_rows($rows); $i++) {

		$lds=mysql_fetch_array($rows);

		if ($lds[type]=="1") $mess="Заблокирован по причине: <b>$lds[reason]</b>";
		elseif ($lds[type]=="3") $mess="Отправлен в тюрьму по причине: <b>$lds[reason]</b>, сроком $lds[srok]";
		elseif ($lds[type]=="4") $mess="$lds[mess]";

		elseif ($lds[type]=="6") $mess="Освобождён из тюрьмы по причине: <b>$lds[reason]</b>";
		elseif ($lds[type]=="7") $mess="Разблокирован по причине: <b>$lds[reason]</b>";

		elseif ($lds[type]=="2") $mess="Наложен запрет на общение в чате по причине: <b>$lds[reason]</b>, сроком $lds[srok]";
		elseif ($lds[type]=="8") $mess="Наложен запрет на общение на форуме по причине: <b>$lds[reason]</b>, сроком $lds[srok]";

		elseif ($lds[type]=="5") $mess="Снят запрет на общение в чате по причине: <b>$lds[reason]</b>";
		elseif ($lds[type]=="9") $mess="Снят запрет на общение на форуме по причине: <b>$lds[reason]</b>";

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