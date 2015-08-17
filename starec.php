


<?php
$num=0;
$ctime=time();
include("inc/db_connect.php");
include("inc/html_header.php");

$stat = mysql_fetch_array(mysql_query("SELECT * FROM `players` WHERE `user` = '".$user."' LIMIT 1"));
if (empty($stat['id'])) {
	//  echo"<script>top.window.location = 'index.php?action=logout';</script>";
	exit;
}

if (@$_GET['update_status']) {
	$update_status=$_GET['update_status'];
	if ($update_status==1 || $update_status==2 || $update_status==3) {
		mysql_query("UPDATE players set skl='".$update_status."' where id='".$stat['id']."'");
		mysql_query("UPDATE players set valute=valute-250 where id=$stat[id]");
		echo "<center>Склонность получена!</center>";
		unset($stat);

		$stat = mysql_fetch_array(mysql_query("SELECT * FROM `players` WHERE `user` = '".$user."'  LIMIT 1"));
	}
}





if ($stat[valute] >= 250) {

	$s1=""; $s2=""; $s3="";
	if ($stat['skl']==1) $s1=" selected";
	elseif ($stat['skl']==2) $s2=" selected";
	elseif ($stat['skl']==3) $s3=" selected";
	elseif (empty($stat[skl]))
	print "</td></tr>
<form method='get' action=''><tr><td align='center' bgcolor=e2e0e0>
<select name='update_status' class=input>
<option value=1$s1>Тьма</option>
<option value=3$s3>Свет</option>
</select>
<input type='submit' value='Выбрать' class=input></td></tr></form>
";}
	else echo"<b><i><br>У вас нет необходимых средств!</i></b><br><br>";

	?>
</center>



