<?

if ($set == "clan" AND $uri == "/main.php") {
	mysql_query("UPDATE abils SET c_iznos=c_iznos+1 WHERE id='".$object['id']."' AND c_iznos<m_iznos");
}
else {
	$obj_inf['6']+=1;
	mysql_query("UPDATE objects SET inf='".$obj_inf['0']."|".$obj_inf['1']."|".$obj_inf['2']."|".$obj_inf['3']."|".$obj_inf['4']."|".$obj_inf['5']."|".$obj_inf['6']."|".$obj_inf['7']."' WHERE id='".$object['id']."'");

	if ($obj_inf['7'] == $obj_inf['6']) {
		// ----- # Удаляем свиток # ----- //
		mysql_query("DELETE FROM objects WHERE id='".$object['id']."'");

		if (mysql_num_rows(mysql_query("SELECT * FROM slots WHERE id='".$stat['id']."' AND slots.17=".$object['id']."")) == 1)
		$emp_slot=17;
		else
		$emp_slot=18;
		mysql_query("UPDATE slots SET slots.".$emp_slot."=0 WHERE slots.id='".$stat['id']."'");
		$obj_inf['3'] = 0;
	}
}

?>