<?
$user=addslashes($user);
include("inc/html_header.php");
include("inc/db_connect.php");
?>
<HTML>
<HEAD>
<meta content='text/html; charset=windows-1251' http-equiv=Content-type>
</HEAD>
<BODY topmargin=0 marginheight=0 leftmargin=0 rightmargin=0
	bottomMargin=0>
<table border="0" width="100%" height="69">
	<tr>
		<td height="63" width="100%">
		<center><b><font size="5" color="#800000">Ваши сообшения</font></b></center>
		</td>
	</tr>
</table>
<?
$result2=mysql_query("Select text, otkogo, date, metka, id from `telegraf` where komu='".addslashes($user)."' order by `id` DESC LIMIT 0,25");
while($data = mysql_fetch_array($result2)){
	$total+=1;
	$text=$data["text"];
	$otkogo=$data["otkogo"];
	$date=$data["date"];
	$metka=$data["metka"];
	if($data["id"]==""){
		print "Сообщение не найдено в Архиве.";
		die();
	}
	if($data["metka"]=="0"){
		$sas = "UPDATE telegraf SET metka='1' WHERE komu='".addslashes($user)."'";
		$gugu = mysql_query($sas);
		print"<table border=0 cellspacing=0 style='border-collapse: collapse' width=70% align=center>
  <tr>
    <td width=100%>
    <fieldset style='WIDTH: 100%'><legend>Сообщение</legend>
От кого: <b>$otkogo</b><br>
Дата: <b>$date</b><br>
Сообщение:<br>
<b>$text</b>
</fieldset>
</td>
  </tr>
</table>
";
	}else{
	}
	?>
<?
}
?>