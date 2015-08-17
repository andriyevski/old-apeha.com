<?


$s_t_form="

<script>

s='<br><table width=80% align=center cellspcaing=0 cellpadding=3 bordercolor=CCCCCC border=1 bgcolor=e2e0e0><tr><td align=center>Вашу заявку принял ';

show_inf(\"$op_inf[user]\",\"$op_inf[id]\",\"$op_inf[level]\",\"$op_inf[rank]\",\"$op_inf[tribe]\",1);


s+=' <input type=button value=\"Отказать\" onClick=\'location=\"battle.php?page=dismiss&tmp=\"+Math.random();\"\"\' class=standbut>&nbsp;<input type=button value=\'Битва!\' onClick=\'location=\"battle.php?page=start&tmp=\"+Math.random();\"\"\' class=standbut><br>';


s+='</td></tr></table>';

battle_forms.innerHTML=s;

</script>

";


?>