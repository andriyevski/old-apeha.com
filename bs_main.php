<?
  $sel = mysql_query("SELECT * from bs where t=1 ORDER BY `cash` DESC LIMIT 0 , 20 ");
  while ($ch = mysql_fetch_array($sel)) {
    if ($ch[user] == $stat[user]) {$done = 1;}
  }
  if ($done == 1) {
$rand = rand(496,504); 
     mysql_query("update players set bs='1' where user='$stat[user]'");
     include ("bs_room_$rand.php");
     die();
  }
  else {
    mysql_query("update players set bs='0' where user='$stat[user]'");
    mysql_query("DELETE from bs where user='$stat[user]'");
  }
?>