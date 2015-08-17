<?
$e_action = "".$el_str."|".$el_ag."|".$el_dex."|".$el_vit."|".$el_raz."|".$el_bat."|".$el_pow."";
mysql_query("UPDATE person SET elik_time='".$el_time."', elik_action='".$e_action."' WHERE id='".$stat['id']."'");
?>