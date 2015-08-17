<?

$p_e = explode("|",$stat['proff_exp']);

if ($m_s == 0) $p_e['10']+=1; //Магия жизни
if ($m_s == 1) $p_e['7']+=1; //Атакующая магия


$exp = "".$p_e['0']."|".$p_e['1']."|".$p_e['2']."|".$p_e['3']."|".$p_e['4']."|".$p_e['5']."|".$p_e['6']."|".$p_e['7']."|".$p_e['8']."|".$p_e['9']."|".$p_e['10']."";
mysql_query("update person set proff_exp='".$exp."' where id=".$stat['id']."");

?>