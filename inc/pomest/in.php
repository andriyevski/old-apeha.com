<?
if (is_numeric($tmp) && $tmp>0) {

	$ob=mysql_fetch_array(mysql_query("SELECT objects.* FROM objects, slots where objects.user='".$stat[user]."' and objects.bank='0' and objects.id='".addslashes($tmp)."' and slots.id=".$stat['id']." AND objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19)"));

	if (!empty($ob['id'])) { mysql_query("UPDATE objects set bank=1 where id=$ob[id]"); print"<script>Location.href='pomest_zeml.php?set1=edit&".time()."'</script>"; }
	else echo"<br><center><font color=red><b>Предмет не найден в Вашем рюкзаке!</b></font></center>";

}
?>