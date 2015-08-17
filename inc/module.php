<?php
$now=time();
include("inc/db_connect.php");
include("inc/html_header.php");

$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));
?>