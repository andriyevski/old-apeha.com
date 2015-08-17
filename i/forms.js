function turm7day(){
document.all("form").style.display = 'block';
s= '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="guard.php?view=turm7day"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Отправка в тюрьму</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 width=50% align=center><input type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td><td bgcolor=#B6B6B6 align=center><SELECT name=addtime style="WIDTH: 111"><option value=86400>Одни сутки<option value=172800>Двое суток<option value=604800>Одна неделя</SELECT></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=text name=reason value="Причина отправки в тюрьму" onBlur="if (value == \'\') {value=\'Причина отправки в тюрьму\'}" onFocus="if (value == \'Причина отправки в тюрьму\') {value =\'\'}" size=45 class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=submit value="Отправить в тюрьму" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';
document.all("form").innerHTML = s;
	fhint = 'id';
}

function turm1mes(){
document.all("form").style.display = 'block';
s= '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="guard.php?view=turm1mes"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Отправка в тюрьму</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 width=50% align=center><input type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td><td bgcolor=#B6B6B6 align=center><SELECT name=addtime style="WIDTH: 111"><option value=86400>Одни сутки<option value=172800>Двое суток<option value=604800>Одна неделя<option value=1209600>Две недели<option value=2678400>Один месяц</SELECT></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=text name=reason value="Причина отправки в тюрьму" onBlur="if (value == \'\') {value=\'Причина отправки в тюрьму\'}" onFocus="if (value == \'Причина отправки в тюрьму\') {value =\'\'}" size=45 class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=submit value="Отправить в тюрьму" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';
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
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="guard.php?view=unturm"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Освобождение из тюрьмы</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 width=50% align=center><input size=44 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=text name=reason value="Причина освобождения" onBlur="if (value == \'\') {value=\'Причина освобождения\'}" onFocus="if (value == \'Причина освобождения\') {value =\'\'}" size=45 class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=submit value="Освободить из тюрьмы" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';
	fhint = 'id';
}





function ch_val1sut () {
v=document.all.u_type.value;
if (v == 1) { // Чат
sr= '<SELECT name=addtime style="WIDTH: 111"><option value=900>15 минут<option value=1800>30 минут<option value=3600>1 час<option value=10800>3 часа<option value=21600>6 часов<option value=43200>12 часов<option value=86400>Одни сутки</SELECT>';
sel.innerHTML=sr;
} else if (v == 2) { // Форум
sr= '<SELECT name=addtime style="WIDTH: 111"><option value=3600>1 час<option value=10800>3 часа<option value=21600>6 часов<option value=86400>Одни сутки';
sr+= '</SELECT>';
sel.innerHTML=sr;
}}
function ch_val1ned () {
v=document.all.u_type.value;
if (v == 1) { // Чат
sr= '<SELECT name=addtime style="WIDTH: 111"><option value=900>15 минут<option value=1800>30 минут<option value=3600>1 час<option value=10800>3 часа<option value=21600>6 часов<option value=43200>12 часов<option value=86400>Одни сутки<option value=172800>Двое суток<option value=259200>Трое суток<option value=432000>Пятеро суток<option value=604800>Одна неделя</SELECT>';
sel.innerHTML=sr;
} else if (v == 2) { // Форум
sr= '<SELECT name=addtime style="WIDTH: 111"><option value=3600>1 час<option value=10800>3 часа<option value=21600>6 часов<option value=86400>Одни сутки<option value=172800>Двое суток<option value=259200>Трое суток<option value=432000>Пятеро суток<option value=604800>Одна неделя';
sr+= '</SELECT>';
sel.innerHTML=sr;
}}
function ch_val15min30min () {
v=document.all.u_type.value;
 // Чат
sr= '<SELECT name=addtime style="WIDTH: 111"><option value=900>15 минут<option value=1800>30 минут</SELECT>';
sel.innerHTML=sr;
}
function for_val1den () {
v=document.all.u_type.value;
 // Чат
sr= '<SELECT name=addtime style="WIDTH: 111"><option value=3600>1 час<option value=10800>3 часа<option value=21600>6 часов<option value=86400>Одни сутки';
sr+= '</SELECT>';
sel.innerHTML=sr;
}

function unchat1sut(){
document.all("form").style.display = 'block';
s='<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="guard.php?view=unchat1sut"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Запрет на общение</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 width=50% align=center><input type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td><td bgcolor=#B6B6B6 align=center><div id=sel></div></td></tr><tr><td bgcolor=#B6B6B6 align=center colspan=2><SELECT name=u_type style="WIDTH: 236px" onchange="ch_val1sut();"><option value=1 SELECTED>Запрет на общение в чате<option value=2>Запрет на общение на форуме';
s+='</SELECT></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=text name=reason value="Причина запрета на общение" onBlur="if (value == \'\') {value=\'Причина запрета на общение\'}" onFocus="if (value == \'Причина запрета на общение\') {value =\'\'}" size=45 class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=submit value="Запретить" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';
document.all("form").innerHTML = s;
ch_val1sut();
	fhint = 'id';
}
function unchat1ned(){
document.all("form").style.display = 'block';
s='<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="guard.php?view=unchat1ned"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Запрет на общение</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 width=50% align=center><input type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td><td bgcolor=#B6B6B6 align=center><div id=sel></div></td></tr><tr><td bgcolor=#B6B6B6 align=center colspan=2><SELECT name=u_type style="WIDTH: 236px" onchange="ch_val1ned();"><option value=1 SELECTED>Запрет на общение в чате<option value=2>Запрет на общение на форуме';
s+='</SELECT></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=text name=reason value="Причина запрета на общение" onBlur="if (value == \'\') {value=\'Причина запрета на общение\'}" onFocus="if (value == \'Причина запрета на общение\') {value =\'\'}" size=45 class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=submit value="Запретить" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';
document.all("form").innerHTML = s;
ch_val1ned();
	fhint = 'id';
}
function unchat15min30min(){
document.all("form").style.display = 'block';
s='<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="guard.php?view=unchat15min30min"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Запрет на общение</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 width=50% align=center><input type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td><td bgcolor=#B6B6B6 align=center><div id=sel></div></td></tr><tr><td bgcolor=#B6B6B6 align=center colspan=2><SELECT name=u_type style="WIDTH: 236px" onchange="ch_val15min30min();"><option value=1 SELECTED>Запрет на общение в чате';
s+='</SELECT></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=text name=reason value="Причина запрета на общение" onBlur="if (value == \'\') {value=\'Причина запрета на общение\'}" onFocus="if (value == \'Причина запрета на общение\') {value =\'\'}" size=45 class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=submit value="Запретить" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';
document.all("form").innerHTML = s;
ch_val15min30min();
	fhint = 'id';
}
function unforum1ned(){
document.all("form").style.display = 'block';
s='<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="guard.php?view=unforum1ned"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Запрет на общение</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 width=50% align=center><input type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td><td bgcolor=#B6B6B6 align=center><div id=sel></div></td></tr><tr><td bgcolor=#B6B6B6 align=center colspan=2><SELECT name=u_type style="WIDTH: 236px" onchange="for_val1den();"><option value=2>Запрет на общение на форуме';
s+='</SELECT></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=text name=reason value="Причина запрета на общение" onBlur="if (value == \'\') {value=\'Причина запрета на общение\'}" onFocus="if (value == \'Причина запрета на общение\') {value =\'\'}" size=45 class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=submit value="Запретить" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';
document.all("form").innerHTML = s;
for_val1den();
	fhint = 'id';
}











function chat(){
document.all("form").style.display = 'block';
s='<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="guard.php?view=chat"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Снятие запрета на общение</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 width=50% align=center><input size=44 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><SELECT name=u_type style="WIDTH: 236px"><option value=1 SELECTED>Запрет на общение в чате<option value=2>Запрет на общение на форуме</SELECT></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=text name=reason value="Причина снятия запрета" onBlur="if (value == \'\') {value=\'Причина снятия запрета\'}" onFocus="if (value == \'Причина снятия запрета\') {value =\'\'}" size=45 class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=submit value="Снять запрет" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';
document.all("form").innerHTML = s;
	fhint = 'id';
}


function blok(){
document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="guard.php?view=blok"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Блокировка</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 width=50% align=center><input size=45 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=text name=reason value="Причина блокировки" onBlur="if (value == \'\') {value=\'Причина блокировки\'}" onFocus="if (value == \'Причина блокировки\') {value =\'\'}" size=45 class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=submit value="Заблокировать" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';
	fhint = 'id';
}


function unblok(){
document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="guard.php?view=unblok"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Разблокировка</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 width=50% align=center><input size=45 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=text name=reason value="Причина разблокировки" onBlur="if (value == \'\') {value=\'Причина разблокировки\'}" onFocus="if (value == \'Причина разблокировки\') {value =\'\'}" size=45 class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=submit value="Разблокировать" style="WIDTH: 233px" class=standbut></td></tr></table><BR>';
	fhint = 'id';
}


function ldpost(){
document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="guard.php?view=ldpost"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Добавить запись в личное дело</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 width=50% align=center><input size=44 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 width=50% align=center><input size=44 type=text name=mess value=\'Текст записи в личное дело\' onBlur="if (value == \'\') {value=\'Текст записи в личное дело\'}" onFocus="if (value == \'Текст записи в личное дело\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=submit value="Добавить" class=standbut  style="WIDTH: 233px"></td></tr></table><BR>';
	fhint = 'id';
}


function ic(){
document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="guard.php?view=ic"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Пометить о чистоте</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 width=50% align=center><input size=44 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=submit value="Пометить" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';
	fhint = 'id';
}


function chview(){
document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="guard.php?view=chview"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Просмотр сообщений персонажа</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 width=50% align=center><input size=44 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=submit value="Просмотр" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';
	fhint = 'id';
}


function new_enq(){
document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="guard.php?view=new_enq"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Назначение нового инквизитора</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 width=50% align=center><input size=44 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><SELECT name=rank style="WIDTH: 233px" class=input><option value="10">Новобранец<option value="11">Работник ОМ<option value="12">Работник ОР<option value="13">Начальник ОМ<option value="14">Начальник ОР</select></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=submit value="Назначить" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';
	fhint = 'id';
}



function del_enq(){
document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="guard.php?view=del_enq"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Исключение инквизитора</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 width=50% align=center><input size=44 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=submit value="Исключить" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';
	fhint = 'id';
}


function new_pass(){
document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="guard.php?view=new_pass"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Обнулить пароль</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 width=50% align=center><input size=44 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=submit value="Обнулить" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';
	fhint = 'id';
}


function ch_enq(){
document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="guard.php?view=ch_enq"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Изменение ранга инквизитора</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 width=50% align=center><input size=44 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><SELECT name=rank style="WIDTH: 233px" class=input><option value="10">Новобранец<option value="11">Работник ОМ<option value="12">Работник ОР<option value="13">Начальник ОМ<option value="14">Начальник ОР</select></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=submit value="Изменить" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';
	fhint = 'id';
}


function shtraf(){
document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="guard.php?view=shtraf"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Штраф</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 width=50% align=center><input size=45 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=text name=SCredits value="Сумма штраФа" onBlur="if (value == \'\') {value=\'Сумма штрафа\'}" onFocus="if (value == \'Cумма штрафа\') {value =\'\'}" size=45 class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=submit value="Заблокировать" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';
	fhint = 'id';
}


function transfer(){
document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="guard.php?view=transfer"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Просмотр отчёта переводов</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=44 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="Просмотр" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';
	fhint = 'id';
}


function sequrity(){
document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="guard.php?view=sequrity"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Просмотр отчёта безопасности</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=44 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="Просмотр" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';
	fhint = 'id';
}


function dr(){
document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="guard.php?view=dr"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>Изменение даты рождения</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 width=50% align=center><input size=44 type=text name=id value=Логин onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><select name=day><option value=1>1<option value=2>2<option value=3>3<option value=4>4<option value=5>5<option value=6>6<option value=7>7<option value=8>8<option value=9>9<option value=10>10<option value=11>11<option value=12>12<option value=13>13<option value=14>14<option value=15>15<option value=16>16<option value=17>17<option value=18>18<option value=19>19<option value=20>20<option value=21>21<option value=22>22<option value=23>23<option value=24>24<option value=25>25<option value=26>26<option value=27>27<option value=28>28<option value=29>29<option value=30>30<option value=31>31</select><select name=month><option value=1>1<option value=2>2<option value=3>3<option value=4>4<option value=5>5<option value=6>6<option value=7>7<option value=8>8<option value=9>9<option value=10>10<option value=11>11<option value=12>12</select><select name=year><option value=1950>1950<option value=1951>1951<option value=1952>1952<option value=1953>1953<option value=1954>1954<option value=1955>1955<option value=1956>1956<option value=1957>1957<option value=1958>1958<option value=1959>1959<option value=1960>1960<option value=1961>1961<option value=1962>1962<option value=1963>1963<option value=1964>1964<option value=1965>1965<option value=1966>1966<option value=1967>1967<option value=1968>1968<option value=1969>1969<option value=1970>1970<option value=1971>1971<option value=1972>1972<option value=1973>1973<option value=1974>1974<option value=1975>1975<option value=1976>1976<option value=1977>1977<option value=1978>1978<option value=1979>1979<option value=1980>1980<option value=1981>1981<option value=1982>1982<option value=1983>1983<option value=1984>1984<option value=1985>1985<option value=1986>1986<option value=1987>1987<option value=1988>1988<option value=1989>1989<option value=1990>1990<option value=1991>1991<option value=1992>1992<option value=1993>1993<option value=1994>1994<option value=1995>1995<option value=1996>1996<option value=1997>1997<option value=1998>1998<option value=1999>1999</select></td></tr><tr><td bgcolor=#B6B6B6 valign=center height=33 colspan=2 align=center><input type=submit value="Изменить" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';
	fhint = 'id';
}