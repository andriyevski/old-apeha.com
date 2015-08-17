//if(!event)var event=onmousemove(self);
hint1=document.getElementById('hint1');
function show_inf (login,id,level,rank,klan,form) {
var hint_rank;

if (rank == 0) hint_rank='Смертные';
else if ((rank >=10 && rank <= 14) || rank == 99) hint_rank='Орден Инквизиции';
else if (rank == 20) hint_rank='Тьма';
else if (rank == 30) hint_rank='Дилер';
else if (rank == 60) hint_rank='Бот';
else if (rank == 100) hint_rank='Админ';
else if (rank == 101) hint_rank='Тень';
if (klan != '' && klan != '0') klan='<img src=\'i/klan/'+klan+'.gif\' width=12 height=12 alt=\'Клан '+klan+'\'>'; else klan='';
if (id != '') id=' <a href=\'inf.php?'+id+'\' target=_blank><img src=\'i/inf.gif\' width=11 height=11 alt=\'Информация о персонаже '+login+'\'></a>';
if (form==1) s+='<img src=\'i/align/align'+rank+'.gif\' alt=\''+hint_rank+'\' width=12 height=12>'+klan+'<b>'+login+'</b> ['+level+']'+id+'';
else document.write('<img src=\'i/align/align'+rank+'.gif\' width=12 height=12 alt=\''+hint_rank+'\'>'+klan+'<b>'+login+'</font></b> ['+level+']'+id+''); 
}
// Всплывающая подсказка
function MoveHint(){
if(hint1 === undefined) return false;
 if(hint1.style.visibility=='visible') SetPosition();
 return(true);
}
document.onmousemove=MoveHint;

function SetPosition(){
 var x,y;
 if(event.clientX+document.body.scrollLeft+hint1.clientWidth+20>=document.body.clientWidth) x=event.clientX-hint1.clientWidth-10;
  else x=event.clientX+document.body.scrollLeft+10;

/*
 if(event.clientY+document.body.scrollTop+hint1.clientHeight+20>=document.body.clientHeight) y=document.body.clientHeight-hint1.clientHeight-1;
  else y=event.clientY+document.body.scrollTop+20;
*/
 
 y=event.clientY+document.body.scrollTop+20;
 
 hint1.style.left=x;
 hint1.style.top=y;
}





function hint(text){

var s;

s='<table cellpadding=0 cellspacing=0 bgcolor="FFFFE1">';

s+='<tr><td align=left><FONT STYLE="FONT-SIZE: 8pt;">'+text+'</FONT></td></tr>';

s+='</table>';
hint1.innerHTML=s;
SetPosition();
hint1.style.visibility='visible';
}






function it(title,iznos,tip,min,max,hp,energy,grav){
var s;

s='<table cellpadding=0 cellspacing=0 bgcolor="FFFFE1" class=it>';

if (title && title != 'Снять ') {
s+='<tr><td align=center class=it><b>'+title+'</b></td></tr>';

if (grav && grav.length>0 && grav!=0)		s+='<tr><td class=it>&bull; Выгравирована надпись: <b>'+grav+'</b></td></tr>';

if (iznos && iznos.length>0)		s+='<tr><td class=it>&bull; Долговечность: <b>'+iznos+'</b></td></tr>';
if (tip && tip.length>0)		s+='<tr><td class=it>&bull; Класс: <b>'+tip+'</b></td></tr>';
if (min && max && min>0 || max>0)	s+='<tr><td class=it>&bull; Удар: <b>'+min+' - '+max+'</b></td></tr>';
if (hp && hp>0)				s+='<tr><td class=it>&bull; Уровень жизни: +<b>'+hp+' HP</b></td></tr>';
if (energy && energy>0)			s+='<tr><td class=it>&bull; Уровень энергии: +<b>'+energy+' EP</b></td></tr>';
}

else s+='<tr><td align=center class=it><b>Пустой слот</b></td></tr>';

s+='</table>';
hint1.innerHTML=s;
SetPosition();
hint1.style.visibility='visible';
}

function c(){ hint1.style.visibility='hidden'; }



function view_item (name,slot,w,h,hint,br,title,id) {

document.write('<img id='+slot+' src=\'i/items/'+name+'.gif\' border=0 width='+w+' height='+h+'  onmouseover=\"'+hint+'\" onmouseout=\"c();\"');

if (edit_page == 1) document.write(' style=\'CURSOR: Hand\' onclick="window.location=\'main.php?set=edit&unset='+slot+'\';"');

if ((slot == 'w17' || slot == 'w18') && id != '' && id != undefined) document.write(' style=\'CURSOR: Hand\' onclick="ShowForm(\''+title+'\',\'\',\'\',\'\',\'1\',\''+name+'\',\''+id+'\',\''+slot+'\',\'\');"');

document.write('>');

if (br == 1) document.write('<br>'); }




function Messaging (text1,text2) {
	var temp;
	temp = '<TABLE CELLSPACING=0 CELLPADDING=0 BORDER=0 WIDTH=255><TR HEIGHT=22><TD><TABLE WIDTH=100% CELLSPACING=0 CELLPADDING=0><TR><TD WIDTH=33><IMG SRC="i/andr/top_left.png" WIDTH=33 HEIGHT=22 CLASS="pngs"></TD><TD WIDTH=100% BACKGROUND="i/andr/top_center.png" CLASS="pngs"><SPAN></SPAN></TD><TD WIDTH=6><IMG SRC="i/andr/top_right.png" WIDTH=6 HEIGHT=22 CLASS="pngs"></TD>		</TR></TABLE></TD></TR><TR><TD><TABLE WIDTH=100% CELLSPACING=0 CELLPADDING=0><TR><TD WIDTH=6 BACKGROUND="i/andr/left.png"><SPAN></SPAN></TD><TD BGCOLOR="#FFFFDE"><B><I>'+is_writer+'</I></B>:<BR>&nbsp;'+st_text[text1]+'<BR><BR><B><I>'+is_user+'</I></B>:<BR>&nbsp;'+st_text[text2]+'</TD><TD WIDTH=6 BACKGROUND="i/andr/right.png" CLASS="pngs"><SPAN></SPAN></TD></TR></TABLE></TD></TR><TR HEIGHT=5><TD><TABLE WIDTH=100% CELLSPACING=0 CELLPADDING=0><TR><TD WIDTH=6><IMG SRC="i/andr/bottom_left.png" WIDTH=6 HEIGHT=5 CLASS="pngs"></TD><TD WIDTH=100%  BACKGROUND="i/andr/bottom_center.png"><SPAN></SPAN></TD><TD WIDTH=6><IMG SRC="i/andr/bottom_right.png" WIDTH=6 HEIGHT=5 CLASS="pngs"></TD></TR></TABLE></TD></TR></TABLE>';
	document.all("MsgSheet").innerHTML = temp;
}