<script>
function trans (date, user, fr, tp, num, id, inf) {
var inf = '<? echo"$info[user]"; ?>';
var msg;
if (tp == 1) msg='Переданы кредиты <u><b>'+num+'</b></u>';
else if (tp == 2) msg='Передан предмет <u><b style="CURSOR: Hand" onclick="top.iteminfo(\''+id+'\');" title="Информация о предмете">'+num+'</b></u> (ID: '+id+')';
else msg='';

if (user == inf) user='<u>'+user+'</u>';
else if (fr == inf) fr='<u>'+fr+'</u>';

document.write('[<a class=sysmessage><b>'+date+'</b></a>] '+msg+' от <span style="CURSOR: Hand" onclick=\"inf(\''+fr+'\');\"><b>'+fr+'</b></span> к <span style="CURSOR: Hand" onclick=\"inf(\''+user+'\');\"><b>'+user+'</b></span><br>\n');

}
</script>

<?
$transf=mysql_query("SELECT * FROM transfers where user='$info[user]' or fr='$info[user]' order by time");


$tf=mysql_fetch_array(mysql_query("SELECT * FROM transfers where user='$info[user]' or fr='$info[user]'"));

if (!empty($tf[user])) {
	echo"<FIELDSET><LEGEND style='COLOR: Red'><b>Подозрительные передачи</b></LEGEND>
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td><script>";


	for ($i=0; $i<mysql_numrows($transf); $i++) {
		$tr=mysql_fetch_array($transf);

		$m1=mysql_fetch_array(mysql_query("SELECT ip as ip FROM security where (user='$tr[fr]' or user='$tr[user]') and user!='$info[user]'"));

		$m2=mysql_fetch_array(mysql_query("SELECT user as user FROM security where ip='$m1[ip]' and user='$info[user]'"));

		if (!empty($m2['user'])) {
			if ($tr['credits']>0) { $g_tp=1; $g_it=$tr['credits']; $g_id=''; }
			elseif (!empty($tr['item'])) { $g_tp=2; $g_it=$tr['item']; $g_id=$tr['id']; }
			else { $g_tp=''; $g_it=''; $g_id=''; }

			echo"trans('".date("d.m.y H:i",$tr[time])."','$tr[user]','$tr[fr]','$g_tp','$g_it', '$g_id');";
		}
	}
	echo"
</script>
</td>
</tr>
</table>
</FIELDSET>
<br>";


}

?>