
<meta
	http-equiv="Content-Type" content="text/html; charset=windows-1251">
<?
include('inc/db_connect.php');
include('time.php');
$ip=GetEnv("REMOTE_ADDR");
$browser=GetEnv("HTTP_USER_AGENT");
$now=time();
$reg_ip=mysql_num_rows(mysql_query("SELECT id FROM players where ip='".$ip."' AND register_date>'".($now - 360000)."'"));
$hinfo=mysql_fetch_array(mysql_query("SELECT id FROM players where user='".$login."'"));

$number = rand('111111','999999');

// ������ �������� �����
if ( $register ) {

	$login = HtmlSpecialChars($login);
	$name = HtmlSpecialChars($name);
	$deviz = HtmlSpecialChars($deviz);
	$city = HtmlSpecialChars($city);

	if ( empty($hinfo['id']) ) {
		if ( strlen($login) >= 3 || strlen($login) <= 10) {
			if ( !is_numeric($login) ) {
				if ( $psw == $conf_pass ) {
					if ( strlen($psw) >= 6 ) {
						if ( $sex == 1 || $sex == 2 ) {
							if ( ($day > 0 && $day < 32) and ( $month > 0 && $month < 13) and ( $year > 1949 && $year < 2000 ) ) {
								if ( $law == 1 ) {
									if ( $_POST['right_code'] == $_POST['number'] ) {
										if ( $reg_ip == 0 ) {

											$max = mysql_fetch_array(mysql_query("SELECT MAX(id) as id FROM players"));
											$NEW_USER_ID = $max['id'] + 1;
											$referer = $_COOKIE['us'];
											$wins=rand(350,800);
											$losses =rand(50,150);
											$drawn =rand(1,50);

											mysql_query("INSERT INTO slots (id, slots.1) values('".$NEW_USER_ID."','0')");
											mysql_query("INSERT INTO players (id, user, pass, name, birth, birthdate, real_city, sex, browser, deviz,rase, ip, register_date, referer,credits,exp,slovo,wins,losses,drawn,level,s_updates,o_updates, next_exp) values('".$NEW_USER_ID."','".addslashes($login)."',md5('$psw'),'".addslashes($name)."','$day.$month.$year','$this_time','".addslashes($city)."','".addslashes($sex)."','".addslashes($browser)."','".addslashes($deviz)."','1', '".$ip."', '".$now."','".addslashes($referer)."', '8000', '110000', '���� � 7 ���', '".$wins."', '".$losses."', '".$drawn."', '7', '74', '3', '150000')");



											$ItTake = "knife63";
											$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));
											if ($buyitem['tip'] == 1 && $buyitem['slot2'] == "w5") $secondary=1; else $secondary=0;
											$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|0|$secondary|$buyitem[art]|0|$buyitem[iznos]";
											$min="0|3|3|3|3|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";
											mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".addslashes($login)."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");
											mysql_query("INSERT INTO `battles_stat` VALUES ('', 0, 0, 0, 0)");
											$norm="�� ������ ������������������ ��� �������: ".addslashes($login)."<br>��� ������ �� ��������: $psw <br> ������ ������� ��� ������, � ������� ����������... http://mil.yard.ru/  � ��������� ��������� �������� �� ����������";

										}

										else $msg="������! ����������� �������� 1 ��� � ����!"; }
										else $msg="������! �������� ���!"; }
										else $msg="������! �� �� ������� ������!"; }
										else $msg="������! ������� ������� ���� ��������!"; }
										else $msg="������! ������� ������ ���!"; }
										else $msg="������! ������ ������� ���!"; }
										else $msg="������! ������ �� ���������!"; }
										else $msg="������! ����� �������� ������������ �������!"; }
										else $msg="������! ����� ����� 3� �������� ��� ����� 10 ��������!"; }
										else $msg="������! ����� ����� ��� ����������!"; }
										// ����� �������� �����

										if ($msg!="") echo"<table width='100%' align='center'><tr><td align='center'><b style='COLOR: Red'>$msg</b></td></tr></table>";
										if ($norm!="") echo"<table width='100%' align='center'><tr><td align='center'><b style='COLOR: Green'>$norm</b></td></tr></table>";

										echo "<style>
.input{ border: solid 1pt #B0B0B0; font-family: Verdana; font-size: 10px; color: #191970; MARGIN-BOTTOM: 2px; MARGIN-TOP: 1px;}
</style>";

										echo "<table width='100%' border=1 bordercolor=#F2D16F cellspacing=0 cellpadding=3 style='border-collapse: collapse'>
<form action='' method=post>
<tr>
<td width=50%>����� ���������: (<b style='COLOR: Red'>*</b>)</td><td align=center>
<input name='login' class=input maxlength=10 value='$login' size='20'></td>
</tr>
<tr>
<td>������: (<b style='COLOR: Red'>*</b>)</td><td align=center>
<input name='psw' type=password class=input maxlength=30 value='$psw' size='20'></td>
</tr>

<tr>
<td>������ ��������: (<b style='COLOR: Red'>*</b>)</td><td align=center>
<input name='conf_pass' type=password class=input value='$conf_pass' size='20'></td>
</tr>

<tr>
<td>�������� ���: (<b style='COLOR: Red'>*</b>)</td><td align=center>
<input name='name' class=input maxlength=11 value='$name' size='20'></td>
</tr>

<tr>
<td>���� ��������: (<b style='COLOR: Red'>*</b>)</td>
<td align=center>
<select name=day>";
										for ($i=1; $i<32; $i++) { echo"<option value=$i"; if ($i==$day) echo" selected"; echo">$i"; }
										unset($i);
										echo"</select>
<select name=month>";
										for ($i=1; $i<13; $i++) { echo"<option value=$i"; if ($i==$month) echo" selected"; echo">$i"; }
										unset($i);
										echo"</select>
<select name=year>";
										for ($i=1950; $i<2000; $i++) { echo"<option value=$i"; if ($i==$year) echo" selected"; echo">$i"; }
										unset($i);
										echo"</select>
</td>
</tr>

<tr>
<td>���: (<b style='COLOR: Red'>*</b>)</td>
<td align=center><select name=sex>
<option value=1"; if ($sex==1) echo" selected"; echo">�������
<option value=2"; if ($sex==2) echo" selected"; echo">�������
</select></td>
</tr>

<tr>
<td>�����: </td><td align=center>
<input name='deviz' class=input style='WIDTH: 150px' value='$deviz' size='20'></td>
</tr>

<tr>
<td>�����: </td><td align=center>
<input name='city' class=input style='WIDTH: 150px' maxlength=11 value='$city' size='20'></td>
</tr>

<tr>
<td>���: <b>".$number."</b></td><td align=center>
<input name='number' class=input style='WIDTH: 150px' maxlength=11 type='text' size='20'>
<input type='hidden' name='right_code' value='".$number."'></td>
</tr>

<tr>
<td colspan=2><input type=hidden name=law value=0><input type=checkbox name=law value=1"; if ($law == 1) echo " checked"; echo"> � �������� ��������� <a href='law.php' target=_blank>������</a> </td>
</tr>


<tr>
<td align=center colspan='2'><input type=submit name=register class=input value='�����������'></td>

</tr>

</form>
</table>";
										?>