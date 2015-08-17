<?
if (is_numeric($tmp) && $tmp>0) {

	$ob=mysql_fetch_array(mysql_query("SELECT * FROM objects where onset='0' and player='$stat[user]' and bank='1' and id='".addslashes($tmp)."'"));

	if (!empty($ob['name'])) { mysql_query("UPDATE objects set bank=0 where id=$ob[id]"); Header("Location: bank.php?set=edit&$now"); }
	else echo"<br><center><font color=red><b>Предмет не найден в Вашей ячейке!</b></font></center>";

}
?>