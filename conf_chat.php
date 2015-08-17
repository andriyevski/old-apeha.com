<?
require_once("inc/module.php");

$slovos = mysql_escape_string(HtmlSpecialChars($slovos));

$stat = mysql_fetch_array(mysql_query("SELECT * FROM `players` WHERE `user` = '".mysql_real_escape_string($_COOKIE['user'])."' AND `pass` = '".mysql_real_escape_string($_COOKIE['pass'])."' LIMIT 1"));print "<SCRIPT language=JavaScript src='i/ch-online.js'></script>";

if ($mystat) {

	mysql_query("UPDATE players set status=$status, slovo='".addslashes($slovos)."' where user='".$stat['user']."'");

	$msg="Все прошло успешно ваш статус<br>\"$slovos\"";

}

echo "<body  bgcolor='#F5FFD9' leftmargin=1 rightmargin=0 topmargin=0><form action='' method=post>";

if ($msg!="") echo"<table width='100%' align='center'><tr><td align='center'><b style='COLOR: Red'>$msg</b></td></tr></table>";

echo "
<br>
<div align='center'>
  <center>
  <table border='1' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#F2D16F' width='300'>
    <tr>
      <td width='100%' colspan='2' align='center'><b>Настройки чата</b></td>
    </tr>
    <tr>
      <td width='50%' align='left'><b>Ваш статус</b></td>
      <td width='50%' align='right'><select name=status><option selected value=1>Подерусь</option><option value=2>Занят</option><option value=3>Отошел</option><option value=4>Поболтаю</option></select></td>
    </tr>
    <tr>
      <td width='50%' align='left'><b>Текст статуса</b></td>
      <td width='50%' align='right'><input name='slovos' class='input' size='15' maxlength='20' value='$stat[slovo]'></td>
    </tr>
    <tr>
      <td width='100%' colspan='2' align='center'><input type=submit class=input value='Применить' name=mystat> <input type=button class=input value='Обновить' onclick='window.location=\"conf_chat.php\"'></td>
    </tr>
  </table>
  </center>
</div></body></form>";

?>