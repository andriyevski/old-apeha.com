<?
$link = @mysql_connect("localhost","langels_u","eVYGC8EL");
$db=@mysql_select_db("langels_root_base",$link);
  mysql_query("UPDATE `players` set `bite`='0', `attack`='0'");
?>