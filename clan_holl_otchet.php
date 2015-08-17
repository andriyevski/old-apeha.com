<?
include("inc/db_connect.php");
include("inc/html_header.php");
$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));
$now=time();

echo "<body bgcolor=F5FFD9 leftmargin=5 topmargin=5>";

if ($set == "otchet") {
	echo "<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr>
    <td width='15%' align='ceter'><b>Ник</b></td>
    <td width='10%' align='ceter'><b>Кол-во</b></td>
    <td width='45%' align='ceter'><b>Комментарии</b></td>
    <td width='20%' align='ceter'><b>Дата</b></td>
    <td width='10%' align='ceter'><b>Действие</b></td>
  </tr>";

	$otchet=mysql_query("SELECT * FROM clan_money WHERE clan='".$stat['tribe']."' order by time desc LIMIT 30");
	$otkr = mysql_num_rows($otchet);
	if ($otkr > 0) {

		for ($i=0; $i<mysql_num_rows($otchet); $i++) {
			$otchets=mysql_fetch_array($otchet);
			if ($otchets['go'] == 1) $result = "Вложил";
			elseif ($otchets['go'] == 2) $result = "Забрал";
			echo "
  <tr>
    <td width='15%'><small>".$otchets['user']."</small></td>
    <td width='10%'><small>".$otchets['money']." зм.</small></td>
    <td width='45%'><small>".$otchets['comments']."</small></td>
    <td width='20%'><small>".date("d.m.y H:i",$otchets['time'])."</small></td>
    <td width='10%'><small>$result</small></td>
  </tr>";

		}

	} else echo "
<tr>
<td colspan='5' align='center'>Записи отсутствуют.</td>
</tr>
";
	echo "</table>";
}

echo "</body>";

?>