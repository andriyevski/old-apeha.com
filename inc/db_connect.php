<?php
session_start();
$kkk=(string) 'gvhgxssds$$3efE##rfezfeA#6$Z65a565^$5sz5rdfyu';
//ini_set('display_errors',0);
$img_server="http://langels.ru";
if(!empty($_SESSION)){foreach($_SESSION as $k=>$v) if (!ereg("[<>\\/-]",$v)){$$k=$v;}
;}

$gamedate = date( "d-m-Y (H:i:s)" );

///if(!empty($_COOKIE)){foreach($_COOKIE as $k=>$v) if (!ereg("[<>\\/-]",$v)){$$k=$v;}
//else{die("Аничит рулит");};}

$now = time();

$link=@mysql_connect("127.0.0.1","root","");
@mysql_select_db("aoth",$link) or die ("<center>Технические работы!!</center>");
@mysql_query("set character_set_client='cp1251'");
@mysql_query("set character_set_results='cp1251'");
@mysql_query("set collation_connection='cp1251_general_ci'");
define('CONFINCLUDED', 'HFCVHFvGFr5ff55F56F65F65F65De443D3rRDTe4d');
##################### Класс борьбы с SQL атаками ################
include_once("sql.php");

$stop_injection = new InitVars();
$stop_injection->checkVars();
##################### Класс борьбы с SQL атаками ################
if($kkk!='gvhgxssds$$3efE##rfezfeA#6$Z65a565^$5sz5rdfyu') die();
if(!empty($_REQUEST)){foreach($_REQUEST as $k=>$v) $$k=htmlspecialchars(stripslashes($v), ENT_QUOTES);}
?>
