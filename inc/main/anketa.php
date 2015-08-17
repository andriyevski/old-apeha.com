<?
if ($step=="2")
{

	$realname = HtmlSpecialChars($realname);
	$real_city = HtmlSpecialChars($real_city);
	$new_icq = HtmlSpecialChars($new_icq);
	$new_deviz = HtmlSpecialChars($new_deviz);
	$new_url = HtmlSpecialChars($new_url);
	$about = HtmlSpecialChars($about);

	$about = str_replace('\n','<br>',$about);
	$about = str_replace('
','<br>',$about);

	if ($new_url!="") {
		// Форматируем URL
		$url="$new_url";
		$new_url=explode("http://",$new_url);
		if ($new_url[1]=="") $new_url="http://$url";
		else $new_url="$url";
		//
	}



	mysql_query("update players set name='".addslashes($realname)."', real_city='".addslashes($real_city)."', icq='".addslashes($new_icq)."', deviz='".addslashes($new_deviz)."', url='".addslashes($new_url)."', about='".addslashes($about)."' where id='$stat[id]'");

	if ($chat_color=="black" or $chat_color=="navy" or $chat_color=="blue" or $chat_color=="0046D5" or $chat_color=="teal" or $chat_color=="purple" or $chat_color=="fuchsia" or $chat_color=="gray" or $chat_color=="green" or $chat_color=="maroon" or $chat_color=="orange" or $chat_color=="chocolate" or $chat_color=="darkkhaki") {
		mysql_query("update players set color='".addslashes($chat_color)."' where id='$stat[id]'"); }

		@header("Location: main.php");
};

include('inc/header.php');

include('time.php');


if ($step=="1") {
	$stat[about] = str_replace('<br>','
',$stat[about]);

	if ($stat[icq]==0) $stat[icq]="";

	echo "<form method=post action=main.php?set=anketa&step=2>
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
<tr>
<td align=center colspan=2><b>Имя:</b></td>
<td align=center colspan=2><input name=realname value='$stat[name]' class='input'></td>
</tr>
<tr>
<td align=center colspan=2><b>Город:</b></td>
<td align=center colspan=2><input name=real_city value='$stat[real_city]' class='input'></td>
</tr>
<tr>
<td align=center colspan=2><b>ICQ:</b></td>
<td align=center colspan=2><input name='new_icq' value='$stat[icq]' class='input'></td>
</tr>
<tr>
<td align=center colspan=2><b>Цвет сообщений в чате:</b></td>
<td align=center colspan=2>";

	include('inc/main/chc.php');

	echo "</tr>
</td><tr>
<td align=center colspan=2><b>Девиз:</b></td>
<td align=center colspan=2><input name='new_deviz' value='$stat[deviz]' size=53 class='input'></td></tr>
<tr>
<td align=center colspan=2><b>Домашняя страница:</b></td>
<td align=center colspan=2><input name='new_url' value='$stat[url]' size=53 class='input'></td></tr>";

	echo "
<tr>
<td align=center colspan=2><b>Немного о себе:</b></td>
<td align=center colspan=2 align=center>
<textarea name=about rows=7 cols=51>".stripslashes($stat[about])."</textarea></td>
</tr>
<tr><td align=center colspan=2 align=center><b>Применить:</b></td>
<td align=center colspan=2 align=center><input type='submit' value='Сохранить изменения'  class='input'></td>
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
</table></form>";

}

?>