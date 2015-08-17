function ShowForm(title, script, fval, fname, mainform, usemagic, useid, onset, user) {

if (fval != 'undefined' && fval != '') fval=fval; else fval='';
if (fname != 'undefined' && fname != '') fname=fname; else fname='login';
if (usemagic != 'undefined' && usemagic != '') usemagic=usemagic; else usemagic='none';
if (onset != 'undefined' && onset != '') onset=onset; else onset='';
if (mainform==1) formname='mainform'; else formname='form';

document.all(""+formname+"").style.display = 'block';
document.all(""+formname+"").innerHTML = '<br><br><br><table border=10 width=227 cellspacing=0 cellpadding=2 bordercolor=ECD19D><tr><td bgcolor=e2e0e0 colspan=2 align=center width=100%><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center><b>'+title+'</b></td><td><B style="CURSOR: Hand" onclick="closeform();">X</B></td></tr></table></td></tr><tr><td bgcolor=#EDEBEC valign=center height=33 width=50% align=center><form method="post" action="'+script+'"><input size=40 type=text name="'+fname+'" class=input><input name=usemagic type=hidden value=\''+usemagic+'\'><input name=useid type=hidden value=\''+useid+'\'><input name=onset type=hidden value=\''+onset+'\'><br><input type="submit" value="Âïåð¸ä" style="WIDTH: 210px" class=standbut></form></td></tr></table><br>';

        if (user) { document.all(""+fname+"").value=''+user; document.all(""+fname+"").focus(); } else {
	document.all(""+fname+"").focus(); document.all(""+fname+"").value=''+fval; }
	fhint = ''+fname+'';
}

function closeform(){
	document.all(""+formname+"").innerHTML = '';
	document.all(""+formname+"").style.display = 'none';
	fhint = '';
}