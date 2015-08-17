<?
if (@$changepass) {
	if (!empty($old_pass)) {
		if (md5($old_pass) == $stat['pass']) {
			if ($new_pass == $conf_new_pass) {
				if (strlen($new_pass)>=6) {

					$pass=md5(addslashes($new_pass));
					mysql_query("UPDATE players SET pass='".$pass."' WHERE user='".$stat['user']."'");

					SetCookie("pass", "$pass");

					$msg="<center><font color=red><b>Ваш пароль успешно изменён!<b></font></center>";
				}
				else
				$msg = "<center><font color=red><b>Пароль не должен быть короче 6 символов!</b></font></center>";
			}
			else
			$msg = "<center><font color=red><b>Введённые пароли не совпадают! Будте аккуратны!</b></font></center>";
		}
		else
		$msg = "<center><font color=red><b>Вы ошиблись при написании пароля! Будте аккуратны!</b></font></center>";
	}
	else $msg = "<center><font color=red><b>Введите старый пароль!</b></font></center>";
}



if (@$changemail) {
	if ($old_email == $stat['email']) {
		mysql_query("update players set email='$new_email' where user='$stat[user]'");
		$msg="<center><font color=red><b>Ваш e-mail успешно изменён!<b></font></center>";
	}
	elseif ($old_email!="" and $old_email!="$stat[email]") $msg="<center><font color=red><b>Вы ошиблись при написании e-mail!<b></font></center>";
}





include('inc/header.php');


if ($msg!="") echo"<center><font color=red><b>$msg</b></font></center>";

echo "<form action='main.php?set=security' method=post>
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
<td align=center colspan=2><b>Сменить пароля</b></td>
</tr>
<tr><td>Старый пароль:</td><td align=center><input type=password name=old_pass class='input'></td></tr>
<tr><td>Новый пароль:</td><td align=center><input type=password name=new_pass class='input'></td></tr>
<tr><td>Подтверждение:</td><td align=center><input type=password name=conf_new_pass class='input'></td></tr>
<tr><td align=center colspan=2><input type=submit name=changepass value='Изменить' class=input></td></tr>
<br>
<tr>
<td align=center colspan=2><b>Сменить E-mail</b></td>
</tr>
<tr><td>Ваш E-mail:</td><td align=center><b>".$stat['email']."</b></td></tr>
<tr><td>Старый e-mail:</td><td align=center><input name=old_email class='input'></td></tr>
<tr><td>Новый e-mail:</td><td align=center><input name=new_email class='input'></td></tr>
<tr><td align=center colspan=2><input type=submit name=changemail value='Изменить' class=input></td></tr>
</table></div>";




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

?>