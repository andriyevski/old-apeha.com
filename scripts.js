var hidden1Name = '';
function findlogin(title, script, name, msg){
	document.all("hidden1").innerHTML = '<table width=306 cellspacing=1 cellpadding=0 bgcolor=333333><tr><td width=100%><b style=color:ffffff>&nbsp;'+title+'</b></td><td width=5 style="cursor: hand" onclick="closehidden1();"><b style=color:ffffff>x&nbsp;</b></td></tr><tr><td colspan=2>'+
	'<table width=100% cellspacing=0 cellpadding=2 bgcolor=cccccc><tr><form name=form action="'+script+'" method=post><td colspan=2>'+msg+'</td></tr><tr><td width=50% align=right><input class=input2 TYPE=text name="'+name+'" size=40 maxlength=45></td><td align=right><input type=image src="../../images/ok.gif" alt="ok!" width=30 height=18></td></tr></form></table></td></tr></table>';
	document.all("hidden1").style.visibility = "visible";
	document.all("hidden1").style.left = 100;
	document.all("hidden1").style.top = 100;
	document.all(name).focus();
	hidden1Name = name;
}
function closehidden1(){
	document.all("hidden1").style.visibility="hidden";
    hidden1Name='';
}

function movehint(){
 if(document.getElementById('alt')){
  if(alt.style.visibility=='visible') setpos();
 }
}
document.onmousemove=movehint;

function setpos(){
 var x,y;
 if(event.clientX+document.body.scrollLeft+alt.clientWidth+20>=document.body.clientWidth) x=event.clientX-alt.clientWidth-10;
  else x=event.clientX+document.body.scrollLeft+10;
 if(event.clientY+document.body.scrollTop+alt.clientHeight+20>=document.body.clientHeight) y=document.body.clientHeight-alt.clientHeight-20;
  else y=event.clientY+document.body.scrollTop+20;
 alt.style.left=x;
 alt.style.top=y;
}

function altshow(t,d,u,p,g){
 var s='<table bgcolor=ffffff class=main_borders style="font-size:10" cellpadding=0 cellspacing=1><tr><td align=center><b>'+t+'</b></td></tr>';
 if(u!='0-0' && u!='') s+='<tr><td><small>Удар: '+u+'</small></td></tr>';
 if(p.length!=''){
  st=p.split(',');
  if(p.indexOf('•')>0) s+='<tr><td><small><b>Действие предмета:</b>';
   else s+='<tr><td><small>';
  for(i=1;i<st.length;i++) s+='<br>&nbsp;'+st[i]+'';
  s+='</small></td></tr>';
 }
 if(d!='') s+='<tr><td><small>Долговечность: '+d+'</small></td></tr>';
 if(g!='') s+='<tr><td><small>Гравировка: <font color=red>'+g+'</font></small></td></tr>';
 s+='</table>';

 alt.innerHTML=s;
 setpos();
 alt.style.visibility='visible';
}

function althidden(){alt.style.visibility='hidden';}


var rnd = Math.random();
var delay = 15;
var redHP = 0.33;
var yellowHP = 0.67;
var TimerOn = -1;
var tkHP, maxHP;
var speed=100;
var mspeed=100;

function setHP(value, max, newspeed) {
	tkHP=value; maxHP=max;
	if (TimerOn>=0) { clearTimeout(TimerOn); TimerOn=-1; }
	speed=newspeed;
	setHPlocal();
}
function setHPlocal() {
	if (tkHP>maxHP) { tkHP=maxHP; }
	var le=Math.round(tkHP)+"/"+maxHP;
	le=170;
	var sz1 = Math.round(((le-1)/maxHP)*tkHP);
	var sz2 = le - sz1;
	if (document.all("HP")) {
		document.HP1.width=sz1;
		document.HP2.width=sz2;
		if (tkHP/maxHP < redHP) { document.HP1.src='../../images/red_hp.gif'; }
		else {
			if (tkHP/maxHP < yellowHP) { document.HP1.src='../../images/yellow_hp.gif'; }
			else { document.HP1.src='../../images/green.gif'; }
		}
		var s = document.all("HP").innerHTML;
		document.all("HP").innerHTML = Math.round(tkHP)+"/"+maxHP;
	}
	tkHP = (tkHP+(maxHP/100)*speed/1000);
	if (tkHP<maxHP) { TimerOn=setTimeout('setHPlocal()', delay*100); }
	else { TimerOn=-1; }
}

var Mdelay = 10;
var MTimerOn = -1;
var tkMana, maxMana;

function setMana(value, max, newspeed) {
	tkMana=value; maxMana=max;
	if (MTimerOn>=0) { clearTimeout(MTimerOn); MTimerOn=-1; }
	if (newspeed < 1) newspeed=1;
	mspeed=newspeed;
	setManalocal();
}
function setManalocal() {
	if (maxMana==0) return(0);
	if (tkMana>maxMana) { tkMana=maxMana; }
	var le=Math.round(tkMana)+"/"+maxMana;
	le=170;
	var sz1 = Math.round(((le-1)/maxMana)*tkMana);
	var sz2 = le - sz1;
	if (document.all("Mana")) {
		document.Mana1.width=sz1;
		document.Mana2.width=sz2;
		document.Mana1.src='../../images/blue.gif';
		var s = document.all("Mana").innerHTML;
		document.all("Mana").innerHTML = s.substring(0, s.lastIndexOf(':')+1) + Math.round(tkMana)+"/"+maxMana;
	}
	tkMana = (tkMana+(maxMana/1000)*mspeed/100);
	if (tkMana<maxMana) { MTimerOn=setTimeout('setManalocal()', Mdelay*1000); }
	else { MTimerOn=-1; }
}