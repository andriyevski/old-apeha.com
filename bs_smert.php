<?
$now=time();

include("inc/db_connect.php");

$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));

#  echo "$stat[room] | $do | $login";
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";


elseif ($stat['bs'] == 1) { include "bs_main.php";}

else {
#if ($stat[bs] == 0) mysql_query("UPDATE bs set user='' where user='$stat[user]'");
include("inc/html_header.php");

echo"<body bgcolor=#EBEDEC leftmargin=0 topmargin=0>
<DIV id=hint1></DIV>
<div id=mainform style='position:absolute; left:30px; top:30px'></div>";
echo"<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/time.js\"></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/show_inf.js\"></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/login_form.js\"></SCRIPT>";

print"<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr><td align=right valign=top>
<img src='i/refresh.gif' style='CURSOR: Hand' alt='Обновить' onclick='window.location.href=\"bs_smert.php?gameroom=$gameroom&tmp=\"+Math.random();\"\"'>
<img src='i/back.gif' style='CURSOR: Hand' alt='Вернуться' onclick='window.location.href=\"world.php?room=0&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td align=top>
";
if ($act == "start") {
  $sel = mysql_query("SELECT * from bs where t=1 ORDER BY `cash` DESC LIMIT 0 , 20 ");
  while ($ch = mysql_fetch_array($sel)) {
    if ($ch[user] == $stat[user]) {$done = 1;}
  }
  if ($done == 1) {
     mysql_query("update players set bs='1' where user='$stat[user]'");
     include ("bs_main.php");
  }
  else {
    echo "Не прошли";
    die();
  }
}
$all_cash_t1 = 0;
$all_cash_t2 = 0;
$sel_t1 = mysql_query("SELECT * FROM bs WHERE t='1'");
$all_t1 = mysql_num_rows($sel_t1);
if ($all_t1) {
while ($s_t1 = mysql_fetch_array($sel_t1))  {
  $all_cash_t1 += $s_t1['cash'];
}
}

$sel_t2 = mysql_query("SELECT * FROM bs WHERE t='2'");
$all_t2 = mysql_num_rows($sel_t2);
if ($all_t2) {
while ($s_t2 = mysql_fetch_array($sel_t2))  {
  $all_cash_t2 = $all_cash_t2+$s_t2[cash];
}
}

if ($act == "j0in"){
  if ($cash < 3) {
    echo "Минимум 3 кр";
  }
  else {
    mysql_query("insert into bs values('$stat[user]','$t','$cash') ");
  }
}
if ($act == "joins"){
  mysql_query("UPDATE bs set cash=cash+$cash where user='$stat[user]' AND t='$t'");
}

$sel = mysql_query("SELECT * FROM bs WHERE user='$stat[user]'");
if (mysql_num_rows($sel) > 0) {
   $s = mysql_fetch_array($sel);
   $act = 14124124;
   $t = $s[t];
}



if (empty($act) and empty($stat['bs'])) {
echo"
<form name=add action=?act=j0in&t=1 method='POST'>
<b>14:00 Дневной турнир.</b><br/>
В турнире принимают участие  $all_t1 человек.<br/>
Ваша ставка: <input type=text size=5 value='' name=cash class=input> зм<br/>
<input type=submit value='Принять участие' class=input>
</form>
<hr>
<form name=add action=?act=j0in&t=2 method='POST'>
<b>23:00 Вечерний турнир. Принять участие.</b><br/>
В турнире принимают участие  $all_t2 человек.
Ваша ставка: <input type=text size=5 value='' name=cash class=input> зм<br/>
<input type=submit value='Принять участие' class=input>
</form>
";
}
if ($act == "14124124") {
  if ($t == "1") {
$time = date('d.m.y H:i:s',$now);
$time_d = date('d',$now);
$time_h = (int)date('H',$now);
$time_m = (int)date('i',$now);
$time_s = (int)date('s',$now);
$time_start = 1;
if ($time_h < 14) {
$sss = (14-$time_h)*60*60 - $time_m*60 - $time_s;
$time_start = $now + $sss;
$time_star = date('d.m.y H:i:s',$time_start);
#  print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"$sss; URL=?act=start\">";
  echo "
<form name=add action=?act=joins&t=1 method='POST'>
<b>14:00 Дневной турнир.</b><br/>
<span style='font-size: 8pt;'><b id='timeout'></b></span><script>ShowTime('timeout',".$sss.",1);</script><br/>
В турнире принимают участие  $all_t1 человек. <br/>
Банк $all_cash_t1 зм.<br/>
Ваша ставка: $s[cash] зм.<br/>
Добавить денег: <input type=text size=5 value='' name=cash class=input> зм<br/>
<input type=submit value='Принять участие' class=input>
</form>
<hr>
<b>01:00 Вечерний турнир. Принять участие.</b><br/>
Турнир для вас закрыт<br/>
В турнире принимают участие  $all_t2 человек.
  ";
}

}
  elseif ($t == "2") {
$time = date('d.m.y H:i:s',$now);
$time_d = date('d',$now);
$time_h = (int)date('H',$now);
$time_m = (int)date('i',$now);
$time_s = (int)date('s',$now);
$time_start = 1;
if ($time_h < 01) {
$sss = (01-$time_h)*60*60 - $time_m*60 - $time_s;
$time_start = $now + $sss;
$time_star = date('d.m.y H:i:s',$time_start);
#  print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"$sss; URL=?act=start\">";
  echo "
<b>14:00 Дневной турнир.</b><br/>
Турнир для вас закрыт<br/>
В турнире принимают участие  $all_t1 человек.
<hr>
<form name=add action=?act=joins&t=2 method='POST'>
<b>01:00 Вечерний турнир. Принять участие.</b><br/>
<span style='font-size: 8pt;'><b id='timeout'></b></span><script>ShowTime('timeout',".$sss.",1);</script><br/>
В турнире принимают участие  $all_t2 человек. <br/>
Банк $all_cash_t2 зм.<br/>
Ваша ставка: $s[cash] зм.<br/>
Добавить денег: <input type=text size=5 value='' name=cash class=input> зм<br/>
<input type=submit value='Принять участие' class=input>
</form>

  ";
}

}
}

}
?>