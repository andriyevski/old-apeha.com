<?
// Enter your MySQL settings below
$mysql_server = "localhost";
$mysql_user = "langels_db";
$mysql_pass = "";
$mysql_database = "langels_database";
$SITETITLE = "IV";
mysql_query("SET CHARSET cp1251");
if(!empty($_SESSION)){extract($_SESSION);}
if(!empty($_COOKIE)){extract($_COOKIE);}
if(!empty($_REQUEST)){extract($_REQUEST);}
?>