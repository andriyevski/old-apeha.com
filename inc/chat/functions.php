<?php
function insert_msg($msg,$to_login,$private,$system = 0, $system_to = "", $redirect = "", $rooms = "") {
	global $stat;
	if ($rooms=="") { $rooms = $stat['room'];
	if ($private!="") { $rooms = ""; } }


	mysql_query("INSERT INTO `chat` (`room`,`login`,`date`,`msg`,`system`,`system_to`,`redirect`,`to_login`,`private`) VALUES ('".$rooms."', '".$stat['user']."', '".time()."', '".$msg."','".$system."','".$system_to."','".$redirect."','".$to_login."','".$private."')");

}
?>