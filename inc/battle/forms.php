<?
$s_form="

<script>

s='<br><table width=100% cellspcaing=0 cellpadding=3 bordercolor=CCCCCC border=1 bgcolor=e2e0e0><form action=\"?page=newbattle&battle_type=1\" method=post><tr><td valign=top align=center><table width=100% cellspacing=0 cellpadding=0 border=0><tr><td align=center><a class=ch>������ ������</a></td></tr></table><hr color=CCCCCC><table border=0 width=100% cellpadding=0 cellspacing=0><tr><td width=20% align=center><b>�������:</b></td><td width=29% align=center><select style=\"WIDTH: 140px\" name=timeout><option value=3>3 ���.<option value=5>5 ���.<option value=10>10 ���.</select></td><td width=2% align=center><b style=\"color: CCCCCC\">|<br>|</b></td><td width=20% align=center><b>�����������:</b></td><td width=29% align=center><input class=input name=comment style=\"WIDTH: 140px\" value=\"\" maxlength=15></td></tr></table><hr color=CCCCCC><input type=submit class=standbut value=\"������ ������\" style=\"WIDTH: 187px\"></td></tr></form></table>';

battle_forms.innerHTML=s;

</script>

";




$s_c_form="

<script>

s='<br><table width=100% cellspcaing=0 cellpadding=3 bordercolor=CCCCCC border=1 bgcolor=e2e0e0><tr><td align=center><input type=button value=\'�������� ������\' OnClick=\'location=\"battle.php?page=take_back&tmp=\"+Math.random();\"\"\' class=standbut></td></tr></table>';

battle_forms.innerHTML=s;

</script>

";


$s_b_form="

<script>

s='<br><table width=100% cellspcaing=0 cellpadding=3 bordercolor=CCCCCC border=1 bgcolor=e2e0e0><tr><td align=center><input type=button value=\'�������� �����\' // onClick=\'location=\"battle.php?page=take_back&tmp=\"+Math.random();\"\"\' class=standbut></td></tr></table>';

battle_forms.innerHTML=s;

</script>

";



// ���������


$g_form="

<script>

s='<br><table width=100% cellspcaing=0 cellpadding=3 bordercolor=CCCCCC border=1 bgcolor=e2e0e0><form action=\"?page=newbattle&battle_type=2\" method=post><tr><td valign=top align=center><table width=100% cellspacing=0 cellpadding=0 border=0><tr><td align=center><a class=ch>������ ������</a></td></tr></table><hr color=CCCCCC><table border=0 width=100% cellpadding=0 cellspacing=0><tr><td width=20% align=center><b>�������:</b></td><td width=29% align=center><select style=\"WIDTH: 140px\" name=timeout><option value=3>3 ���.<option value=5>5 ���.<option value=10>10 ���.</select></td><td width=2% align=center><b style=\"color: CCCCCC\">|<br>|</b></td><td width=20% align=center><b>�����������:</b></td><td width=29% align=center><input class=input name=comment style=\"WIDTH: 140px\" value=\"\" maxlength=15></td></tr></table><hr color=CCCCCC><table border=0 width=100% cellpadding=0 cellspacing=0><tr><td width=20% align=center><b>�� ����:</b></td><td width=29% align=center><select style=\"WIDTH: 140px\" name=offer_level_1><option value=1>������ ������<option value=2>������ ����� ������<option value=3>����� ������ � ����<option value=4>������ ���� �������</select></td><td width=2% align=center><b style=\"color: CCCCCC\">|<br>|</b></td><td width=20% align=center><b>������:</b></td><td width=29% align=center><select style=\"WIDTH: 140px\" name=offer_level_2><option value=1>������ ������<option value=2>������ ����� ������<option value=3>����� ������ � ����<option value=4>������ ���� �������</select></td></tr></table><hr color=CCCCCC><table border=0 width=100% cellpadding=0 cellspacing=0><tr><td width=20% align=center><b>������ #1:</b></td><td width=29% align=center><input class=input name=size_left style=\"WIDTH: 140px; TEXT-ALIGN: Center\" value=\"2\"  maxlength=2></td><td width=2% align=center><b style=\"color: CCCCCC\">|<br>|</b></td><td width=20% align=center><b>������ #2:</b></td><td width=29% align=center><input class=input name=size_right style=\"WIDTH: 140px; TEXT-ALIGN: Center\" value=\"2\" maxlength=2></td></tr></table><hr color=CCCCCC><table border=0 width=100% cellpadding=0 cellspacing=0><tr><td width=49% align=center><b>������ ��� �����:</b></td><td width=2% align=center><b style=\"color: CCCCCC\">|<br>|</b></td><td width=49% align=center><select style=\"WIDTH: 140px\" name=time_battle_start><option value=180>����� 3 ������<option value=300>����� 5 �����<option value=600>����� 10 �����</td></tr></table><hr color=CCCCCC><input type=submit class=standbut value=\"������ ������\" style=\"WIDTH: 187px\"></td></tr></form></table>';

battle_forms.innerHTML=s;

</script>

";


?>
