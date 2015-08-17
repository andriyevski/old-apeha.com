<?
$s_form="

<script>

s='<br><table width=100% cellspcaing=0 cellpadding=3 bordercolor=CCCCCC border=1 bgcolor=e2e0e0><form action=\"?page=newbattle&battle_type=1\" method=post><tr><td valign=top align=center><table width=100% cellspacing=0 cellpadding=0 border=0><tr><td align=center><a class=ch>Подать заявку</a></td></tr></table><hr color=CCCCCC><table border=0 width=100% cellpadding=0 cellspacing=0><tr><td width=20% align=center><b>Таймаут:</b></td><td width=29% align=center><select style=\"WIDTH: 140px\" name=timeout><option value=3>3 мин.<option value=5>5 мин.<option value=10>10 мин.</select></td><td width=2% align=center><b style=\"color: CCCCCC\">|<br>|</b></td><td width=20% align=center><b>Комментарий:</b></td><td width=29% align=center><input class=input name=comment style=\"WIDTH: 140px\" value=\"\" maxlength=15></td></tr></table><hr color=CCCCCC><input type=submit class=standbut value=\"Подать заявку\" style=\"WIDTH: 187px\"></td></tr></form></table>';

battle_forms.innerHTML=s;

</script>

";




$s_c_form="

<script>

s='<br><table width=100% cellspcaing=0 cellpadding=3 bordercolor=CCCCCC border=1 bgcolor=e2e0e0><tr><td align=center><input type=button value=\'Отозвать заявку\' OnClick=\'location=\"battle.php?page=take_back&tmp=\"+Math.random();\"\"\' class=standbut></td></tr></table>';

battle_forms.innerHTML=s;

</script>

";


$s_b_form="

<script>

s='<br><table width=100% cellspcaing=0 cellpadding=3 bordercolor=CCCCCC border=1 bgcolor=e2e0e0><tr><td align=center><input type=button value=\'Отозвать вызов\' // onClick=\'location=\"battle.php?page=take_back&tmp=\"+Math.random();\"\"\' class=standbut></td></tr></table>';

battle_forms.innerHTML=s;

</script>

";



// Групповые


$g_form="

<script>

s='<br><table width=100% cellspcaing=0 cellpadding=3 bordercolor=CCCCCC border=1 bgcolor=e2e0e0><form action=\"?page=newbattle&battle_type=2\" method=post><tr><td valign=top align=center><table width=100% cellspacing=0 cellpadding=0 border=0><tr><td align=center><a class=ch>Подать заявку</a></td></tr></table><hr color=CCCCCC><table border=0 width=100% cellpadding=0 cellspacing=0><tr><td width=20% align=center><b>Таймаут:</b></td><td width=29% align=center><select style=\"WIDTH: 140px\" name=timeout><option value=3>3 мин.<option value=5>5 мин.<option value=10>10 мин.</select></td><td width=2% align=center><b style=\"color: CCCCCC\">|<br>|</b></td><td width=20% align=center><b>Комментарий:</b></td><td width=29% align=center><input class=input name=comment style=\"WIDTH: 140px\" value=\"\" maxlength=15></td></tr></table><hr color=CCCCCC><table border=0 width=100% cellpadding=0 cellspacing=0><tr><td width=20% align=center><b>За меня:</b></td><td width=29% align=center><select style=\"WIDTH: 140px\" name=offer_level_1><option value=1>Любого уровня<option value=2>Только моего уровня<option value=3>Моего уровня и ниже<option value=4>Только ниже уровнем</select></td><td width=2% align=center><b style=\"color: CCCCCC\">|<br>|</b></td><td width=20% align=center><b>Против:</b></td><td width=29% align=center><select style=\"WIDTH: 140px\" name=offer_level_2><option value=1>Любого уровня<option value=2>Только моего уровня<option value=3>Моего уровня и ниже<option value=4>Только ниже уровнем</select></td></tr></table><hr color=CCCCCC><table border=0 width=100% cellpadding=0 cellspacing=0><tr><td width=20% align=center><b>Бойцов #1:</b></td><td width=29% align=center><input class=input name=size_left style=\"WIDTH: 140px; TEXT-ALIGN: Center\" value=\"2\"  maxlength=2></td><td width=2% align=center><b style=\"color: CCCCCC\">|<br>|</b></td><td width=20% align=center><b>Бойцов #2:</b></td><td width=29% align=center><input class=input name=size_right style=\"WIDTH: 140px; TEXT-ALIGN: Center\" value=\"2\" maxlength=2></td></tr></table><hr color=CCCCCC><table border=0 width=100% cellpadding=0 cellspacing=0><tr><td width=49% align=center><b>Начало боя через:</b></td><td width=2% align=center><b style=\"color: CCCCCC\">|<br>|</b></td><td width=49% align=center><select style=\"WIDTH: 140px\" name=time_battle_start><option value=180>Через 3 минуты<option value=300>Через 5 минут<option value=600>Через 10 минут</td></tr></table><hr color=CCCCCC><input type=submit class=standbut value=\"Подать заявку\" style=\"WIDTH: 187px\"></td></tr></form></table>';

battle_forms.innerHTML=s;

</script>

";


?>
