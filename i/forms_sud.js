function turm(){

document.all("form").style.display = 'block';

s= '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=turm"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>�������� � ������</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input type=text name=id value=����� onBlur="if (value == \'\') {value=\'�����\'}" onFocus="if (value == \'�����\') {value =\'\'}" class=input></td><td bgcolor=#EDEBEC align=center><SELECT name=addtime style="WIDTH: 111"><option value=86400>���� �����<option value=172800>���� �����<option value=604800>���� ������';

if (rank==72) s+= '<option value=1209600>��� ������<option value=2678400>���� �����';
if (rank==72) s+= '<option value=5356800>��� ������';

s+= '</SELECT></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=text name=reason value="������� �������� � ������" onBlur="if (value == \'\') {value=\'������� �������� � ������\'}" onFocus="if (value == \'������� �������� � ������\') {value =\'\'}" size=45 class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="��������� � ������" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';

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
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=unturm"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>������������ �� ������</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=44 type=text name=id value=����� onBlur="if (value == \'\') {value=\'�����\'}" onFocus="if (value == \'�����\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=text name=reason value="������� ������������" onBlur="if (value == \'\') {value=\'������� ������������\'}" onFocus="if (value == \'������� ������������\') {value =\'\'}" size=45 class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="���������� �� ������" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';

	fhint = 'id';
}






function ch_val () {
v=document.all.u_type.value;
if (v == 1) { // ���

sr= '<SELECT name=addtime style="WIDTH: 111"><option value=900>15 �����<option value=1800>30 �����<option value=3600>1 ���<option value=10800>3 ����<option value=21600>6 �����<option value=43200>12 �����<option value=86400>���� �����';

if (rank==72) sr+= '<option value=172800>���� �����<option value=259200>���� �����';
if (rank==72) sr+= '<option value=432000>������ �����';
if (rank==72) sr+= '<option value=604800>���� ������';

sr+= '</SELECT>';
sel.innerHTML=sr;

} else if (v == 2) { // �����

sr= '<SELECT name=addtime style="WIDTH: 111">';

if (rank==72) sr+= '<option value=3600>1 ���<option value=10800>3 ����<option value=21600>6 �����<option value=86400>���� �����';
if (rank==72) sr+= '<option value=172800>���� �����<option value=259200>���� �����';
if (rank==72) sr+= '<option value=432000>������ �����<option value=604800>���� ������';
if (rank==72) sr+= '<option value=2678400>���� �����';
if (rank==72) sr+= '<option value=5356800>��� ������';

sr+= '</SELECT>';
sel.innerHTML=sr;

}}


function unchat(){

document.all("form").style.display = 'block';

s='<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=unchat"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>������ �� �������</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input type=text name=id value=����� onBlur="if (value == \'\') {value=\'�����\'}" onFocus="if (value == \'�����\') {value =\'\'}" class=input></td><td bgcolor=#EDEBEC align=center><div id=sel></div></td></tr><tr><td bgcolor=#EDEBEC align=center colspan=2><SELECT name=u_type style="WIDTH: 236px" onchange="ch_val();"><option value=1 SELECTED>������ �� ������� � ����';

if (rank==72) s+='<option value=2>������ �� ������� �� ������';

s+='</SELECT></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=text name=reason value="������� ������� �� �������" onBlur="if (value == \'\') {value=\'������� ������� �� �������\'}" onFocus="if (value == \'������� ������� �� �������\') {value =\'\'}" size=45 class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="���������" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';

document.all("form").innerHTML = s;
ch_val();

	fhint = 'id';
}



function chat(){

document.all("form").style.display = 'block';

s='<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=chat"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>������ ������� �� �������</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=44 type=text name=id value=����� onBlur="if (value == \'\') {value=\'�����\'}" onFocus="if (value == \'�����\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><SELECT name=u_type style="WIDTH: 236px"><option value=1 SELECTED>������ �� ������� � ����';

if (rank==72) s+= '<option value=2>������ �� ������� �� ������';

s+='</SELECT></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=text name=reason value="������� ������ �������" onBlur="if (value == \'\') {value=\'������� ������ �������\'}" onFocus="if (value == \'������� ������ �������\') {value =\'\'}" size=45 class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="����� ������" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';

document.all("form").innerHTML = s;

	fhint = 'id';
}




function blok(){

document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=blok"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>����������</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=45 type=text name=id value=����� onBlur="if (value == \'\') {value=\'�����\'}" onFocus="if (value == \'�����\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=text name=reason value="������� ����������" onBlur="if (value == \'\') {value=\'������� ����������\'}" onFocus="if (value == \'������� ����������\') {value =\'\'}" size=45 class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="�������������" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';

	fhint = 'id';
}


function unblok(){

document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=unblok"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>�������������</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=45 type=text name=id value=����� onBlur="if (value == \'\') {value=\'�����\'}" onFocus="if (value == \'�����\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=text name=reason value="������� �������������" onBlur="if (value == \'\') {value=\'������� �������������\'}" onFocus="if (value == \'������� �������������\') {value =\'\'}" size=45 class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="��������������" style="WIDTH: 233px" class=standbut></td></tr></table><BR>';

	fhint = 'id';
}





function ldpost(){

document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=ldpost"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>�������� ������ � ������ ����</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=44 type=text name=id value=����� onBlur="if (value == \'\') {value=\'�����\'}" onFocus="if (value == \'�����\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=44 type=text name=mess value=\'����� ������ � ������ ����\' onBlur="if (value == \'\') {value=\'����� ������ � ������ ����\'}" onFocus="if (value == \'����� ������ � ������ ����\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="��������" class=standbut  style="WIDTH: 233px"></td></tr></table><BR>';

	fhint = 'id';
}


function ic(){

document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=ic"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>�������� � �������</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=44 type=text name=id value=����� onBlur="if (value == \'\') {value=\'�����\'}" onFocus="if (value == \'�����\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="��������" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';

	fhint = 'id';
}


function chview(){

document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=chview"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>�������� ��������� ���������</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=44 type=text name=id value=����� onBlur="if (value == \'\') {value=\'�����\'}" onFocus="if (value == \'�����\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="��������" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';

	fhint = 'id';
}




function sequrity(){

document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=sequrity"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>�������� ������ ������������</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=44 type=text name=id value=����� onBlur="if (value == \'\') {value=\'�����\'}" onFocus="if (value == \'�����\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="��������" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';

	fhint = 'id';
}



function new_enq(){

document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=new_enq"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>���������� ������ ������������</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=44 type=text name=id value=����� onBlur="if (value == \'\') {value=\'�����\'}" onFocus="if (value == \'�����\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><SELECT name=rank style="WIDTH: 233px" class=input><option value="70">70</select></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="���������" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';

	fhint = 'id';
}



function del_enq(){

document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=del_enq"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>���������� ������������</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=44 type=text name=id value=����� onBlur="if (value == \'\') {value=\'�����\'}" onFocus="if (value == \'�����\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="���������" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';

	fhint = 'id';
}




function ch_enq(){

document.all("form").style.display = 'block';
document.all("form").innerHTML = '<br><table border=1 width=250 cellspacing=0 cellpadding=2 bordercolor=A5A5A5><form method=post action="sud.php?view=ch_enq"><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>��������� ����� ������������</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><input size=44 type=text name=id value=����� onBlur="if (value == \'\') {value=\'�����\'}" onFocus="if (value == \'�����\') {value =\'\'}" class=input></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><SELECT name=rank style="WIDTH: 233px" class=input><option value="70">70</select></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 colspan=2 align=center><input type=submit value="��������" class=standbut style="WIDTH: 233px"></td></tr></table><BR>';

	fhint = 'id';
}