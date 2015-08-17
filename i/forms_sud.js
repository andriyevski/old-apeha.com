function turm(){

document.all("form").style.display = 'block';

s= '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=turm"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Отправка в тюрьму</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td><td bgcolor=#EDEBEC align=center><SELECT name=addtime style="WIDTH: 111"><option value=86400>Одни сутки<option value=172800>Двое суток<option value=604800>Одна неделя';

if (rank==72) s+= '<option value=1209600>Две недели<option value=2678400>Один месяц';
if (rank==72) s+= '<option value=5356800>Два месяца';

s+= '</SELECT></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=text name=reason value="Причина отправки в тюрьму" onBlur="if (value == \'\') {value=\'Причина отправки в тюрьму\'}" onFocus="if (value == \'Причина отправки в тюрьму\') {value =\'\'}" size=45 class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="Отправить в тюрьму" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';

document.all("form").innerHTML = s;

	fhint = 'id';
}

function closeform(){
	document.all("form").innerHTML = '';
	document.all("form").style.display = 'none';
	fhint = '';
}



function unturm(){

document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=unturm"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Освобождение из тюрьмы</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=44 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=text name=reason value="Причина освобождения" onBlur="if (value == \'\') {value=\'Причина освобождения\'}" onFocus="if (value == \'Причина освобождения\') {value =\'\'}" size=45 class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="Освободить из тюрьмы" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';

	fhint = 'id';
}






function ch_val () {
v=document.all.u_type.value;
if (v == 1) { // Чат

sr= '<SELECT name=addtime style="WIDTH: 111"><option value=900>15 минут<option value=1800>30 минут<option value=3600>1 час<option value=10800>3 часа<option value=21600>6 часов<option value=43200>12 часов<option value=86400>Одни сутки';

if (rank==72) sr+= '<option value=172800>Двое суток<option value=259200>Трое суток';
if (rank==72) sr+= '<option value=432000>Пятеро суток';
if (rank==72) sr+= '<option value=604800>Одна неделя';

sr+= '</SELECT>';
sel.innerHTML=sr;

} else if (v == 2) { // Форум

sr= '<SELECT name=addtime style="WIDTH: 111">';

if (rank==72) sr+= '<option value=3600>1 час<option value=10800>3 часа<option value=21600>6 часов<option value=86400>Одни сутки';
if (rank==72) sr+= '<option value=172800>Двое суток<option value=259200>Трое суток';
if (rank==72) sr+= '<option value=432000>Пятеро суток<option value=604800>Одна неделя';
if (rank==72) sr+= '<option value=2678400>Один месяц';
if (rank==72) sr+= '<option value=5356800>Два месяца';

sr+= '</SELECT>';
sel.innerHTML=sr;

}}


function unchat(){

document.all("form").style.display = 'block';

s='<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=unchat"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Запрет на общение</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td><td bgcolor=#EDEBEC align=center><div id=sel></div></td></tr><tr><td bgcolor=#EDEBEC align=center colspan=2><SELECT name=u_type style="WIDTH: 236px" onchange="ch_val();"><option value=1 SELECTED>Запрет на общение в чате';

if (rank==72) s+='<option value=2>Запрет на общение на форуме';

s+='</SELECT></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=text name=reason value="Причина запрета на общение" onBlur="if (value == \'\') {value=\'Причина запрета на общение\'}" onFocus="if (value == \'Причина запрета на общение\') {value =\'\'}" size=45 class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="Запретить" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';

document.all("form").innerHTML = s;
ch_val();

	fhint = 'id';
}



function chat(){

document.all("form").style.display = 'block';

s='<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=chat"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Снятие запрета на общение</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=44 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><SELECT name=u_type style="WIDTH: 236px"><option value=1 SELECTED>Запрет на общение в чате';

if (rank==72) s+= '<option value=2>Запрет на общение на форуме';

s+='</SELECT></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=text name=reason value="Причина снятия запрета" onBlur="if (value == \'\') {value=\'Причина снятия запрета\'}" onFocus="if (value == \'Причина снятия запрета\') {value =\'\'}" size=45 class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="Снять запрет" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';

document.all("form").innerHTML = s;

	fhint = 'id';
}




function blok(){

document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=blok"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Блокировка</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=45 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=text name=reason value="Причина блокировки" onBlur="if (value == \'\') {value=\'Причина блокировки\'}" onFocus="if (value == \'Причина блокировки\') {value =\'\'}" size=45 class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="Заблокировать" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';

	fhint = 'id';
}


function unblok(){

document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=unblok"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Разблокировка</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=45 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=text name=reason value="Причина разблокировки" onBlur="if (value == \'\') {value=\'Причина разблокировки\'}" onFocus="if (value == \'Причина разблокировки\') {value =\'\'}" size=45 class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="Разблокировать" style="WIDTH: 233px" class=standbut></td></tr></table><BR>';

	fhint = 'id';
}





function ldpost(){

document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=ldpost"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Добавить запись в личное дело</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=44 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=44 type=text name=mess value=\'Текст записи в личное дело\' onBlur="if (value == \'\') {value=\'Текст записи в личное дело\'}" onFocus="if (value == \'Текст записи в личное дело\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="Добавить" class=standbut  style="WIDTH: 233px"></td></tr></table><BR>';

	fhint = 'id';
}


function ic(){

document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=ic"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Пометить о чистоте</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=44 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="Пометить" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';

	fhint = 'id';
}


function chview(){

document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=chview"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Просмотр сообщений персонажа</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=44 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="Просмотр" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';

	fhint = 'id';
}




function sequrity(){

document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=sequrity"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Просмотр отчёта безопасности</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=44 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="Просмотр" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';

	fhint = 'id';
}



function new_enq(){

document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=new_enq"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Назначение нового инкивизитора</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=44 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><SELECT name=rank style="WIDTH: 233px" class=input><option value="70">70</select></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="Назначить" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';

	fhint = 'id';
}



function del_enq(){

document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=del_enq"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Исключение инкивизитора</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=44 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="Исключить" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';

	fhint = 'id';
}




function ch_enq(){

document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=ch_enq"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Изменение ранга инкивизитора</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=44 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><SELECT name=rank style="WIDTH: 233px" class=input><option value="70">70</select></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="Изменить" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';

	fhint = 'id';
}