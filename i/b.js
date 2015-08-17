var by,bx,bcid,tcid,nx,ny,sx,sy,tname,last_id,wait,mteam,mname,zx,zy,tx,ty,bl=[],redirect,obst_x=[],obst_y=[],fx,fy,cx,cy;
by,bx=-1,-1;

function target(x,y){
var a;
x=x-document.getElementById('map').offsetLeft;
y=y-document.getElementById('map').offsetTop;
nx=(parseInt((x-26*(parseInt(y/30)%2!=0))/34)>(w-1))?(w-1):(parseInt((x-26*(parseInt(y/30)%2!=0))/34));
ny=(parseInt((y-3)/30)>(h-1))?(h-1):(parseInt((y-3)/30));
if((nx == bx) && (ny == by)) return;
//idElem = document.getElementById("targeti");
//if(idElem)idElem.parentNode.removeChild(idElem); 
while(idElem = document.getElementById("targeti")) idElem.parentNode.removeChild(idElem);
document.getElementById('map').innerHTML+='<img id=targeti src=img/marker.gif style=\"border=0;position:absolute;left:'+(nx*34+17*(ny%2!=0))+'px;top:'+(ny*30)+'px;\">';
if(parseInt(dist(sx,sy,nx,ny))>1||document.getElementById('buttons').style.visibility=='hidden'||(tx!=nx||ty!=ny)) document.getElementById('striker').style.visibility='hidden'; else document.getElementById('striker').style.visibility='visible';
tx=nx;
ty=ny;
doLoad('battle.php?ttarget='+tname+'&'+Math.random()*1000000000000);
}

function dist(x1,y1,x2,y2){
var ddd;
ddd=Math.pow((Math.pow((x1-x2),2)+Math.pow((y1-y2),2)),0.5);
if (y1%2==0 && x2==(x1+1) && (y2==y1+1 || y2==y1-1)) ddd=ddd+1;
else
 if (y1%2==1 && x2==(x1-1) && (y2==y1+1 || y2==y1-1)) ddd=ddd+1;
return ddd;
}

function boom(nx,ny){
if(sx===nx && sy===ny && cx!==undefined && cy!==undefined){ 
	nx=cx;
	ny=cy;
}
if((nx!=tx || ty!=ny) && tx!==undefined && ty!==undefined){
nx=tx;
ny=ty;
}else if(tx===undefined && ty===undefined){
tx=nx;
ty=ny;
}
document.getElementById('map').innerHTML+='<img id=targeti src=img/marker.gif style=\"border=0;position:absolute;left:'+(tx*34+17*(ty%2!=0))+'px;top:'+(ty*30)+'px;\">';
//if(document.getElementById('buttons').style.visibility=='hidden') document.getElementById('striker').style.visibility='hidden'; else document.getElementById('striker').style.visibility='visible';
doLoad('battle.php?ttarget='+tname+'&'+Math.random()*1000000000000);
}

function createper(x,y,name,cid,team,dis,c){
if((x!=tx || y!=ty) && cid==tcid){boom(x,y);}
i=w*(y+1)-(w-x);
img='pb';
	obst_x.push(x);
	obst_y.push(y);
if(((x+1)>(w/2) && team==0) || (team>1)) img+='1'; else img+='0';
if(dis==0) img+='d';
if(c==1) img+='c';
document.getElementById('map').innerHTML+='<img id=\''+cid+'\' title=\''+name+'\' alt=\''+name+'\' src=\"img/persb/'+img+'.gif\" style=\"border:0;position:absolute;left:'+((1+(1+(parseInt(i/w)%2!=0)*16))+((i-parseInt(i/w)*w)*34))+'px;top:'+(1+parseInt(i/w)*30)+'px;\" onclick=\'charselect("'+cid+'","'+name+'",'+x+','+y+')\'>';
}

function strikec(){
document.getElementById('gamep').innerHTML='<form method=POST action=\'battle.php?page=battle\'><input type=hidden name=opponent value=\''+tname+'\'><input type=hidden name=hx value=\''+nx+'\'><input type=hidden name=hy value=\''+ny+'\'><table width=178 height=111 bgcolor=#e5e2d4><tr><td background="img/doll.gif" valign=top width=79><div style="position:relative;left:1px;"><input type=checkbox name=rkick value=1 style="position:absolute; top:-1px; left:20px;" onclick=\'epic(this);\' id=\'bc\'><input type=checkbox name=lkick value=1 style="position:absolute; top:-1px; left:32px;" onclick=\'epic(this);\' id=\'bc\'><input type=checkbox name=rkick value=2 style="position:absolute; top:22px; left:20px;" onclick=\'epic(this);\' id=\'bc\'><input type=checkbox name=lkick value=2 style="position:absolute; top:22px; left:32px;" onclick=\'epic(this);\' id=\'bc\'><input type=checkbox name=rkick value=3 style="position:absolute; top:42px; left:-5px;" onclick=\'epic(this);\' id=\'bc\'><input type=checkbox name=lkick value=3 style="position:absolute; top:42px; left:7px;" onclick=\'epic(this);\' id=\'bc\'><input type=checkbox name=rkick value=4 style="position:absolute; top:42px; left:46px;" onclick=\'epic(this);\' id=\'bc\'><input type=checkbox name=lkick value=4 style="position:absolute; top:42px; left:58px;" onclick=\'epic(this);\' id=\'bc\'><input type=checkbox name=rkick value=5 style="position:absolute; top:72px; left:20px;" onclick=\'epic(this);\' id=\'bc\'><input type=checkbox name=lkick value=5 style="position:absolute; top:72px; left:32px;" onclick=\'epic(this);\' id=\'bc\'></div></td><td width=20></td><td background="img/doll.gif" valign=top width=79><div style="position:relative;left:1px;"><input type=checkbox name=rblock1 value=1 style="position:absolute; top:-1px; left:20px;" onclick=\'epic(this);\' id=\'bc\'><input type=checkbox name=lblock1 value=1 style="position:absolute; top:-1px; left:32px;" onclick=\'epic(this);\' id=\'bc\'><input type=checkbox name=rblock2 value=2 style="position:absolute; top:22px; left:20px;" onclick=\'epic(this);\' id=\'bc\'><input type=checkbox name=lblock2 value=2 style="position:absolute; top:22px; left:32px;" onclick=\'epic(this);\' id=\'bc\'><input type=checkbox name=rblock3 value=3 style="position:absolute; top:42px; left:-5px;" onclick=\'epic(this);\' id=\'bc\'><input type=checkbox name=lblock3 value=3 style="position:absolute; top:42px; left:7px;" onclick=\'epic(this);\' id=\'bc\'><input type=checkbox name=rblock4 value=4 style="position:absolute; top:42px; left:46px;" onclick=\'epic(this);\' id=\'bc\'><input type=checkbox name=lblock4 value=4 style="position:absolute; top:42px; left:58px;" onclick=\'epic(this);\' id=\'bc\'><input type=checkbox name=rblock5 value=5 style="position:absolute; top:72px; left:20px;" onclick=\'epic(this);\' id=\'bc\'><input type=checkbox name=lblock5 value=5 style="position:absolute; top:72px; left:32px;" onclick=\'epic(this);\' id=\'bc\'></div></td></tr></table></center><input type=\'button\' value=\'Вернутся\' onclick=\'forceupdate()\' class=standbut><input type=submit value=\'Удар\' class=standbut name=fight onClick="fight.disabled = true; document.forms[0].submit();"></form></center>';
document.getElementById('buttons').style.visibility='hidden';
document.getElementById('striker').style.visibility='hidden';
}

function myper(x,y,name,cid,team,dis,c){
if(dis==0 || c==1) wait4motion();
else domotion();
mname=name;
mteam=team;
bcid=cid;
bx=x;
sx=x;
by=y;
sy=y;
i=w*(y+1)-(w-x);
if(((x+1)>(w/2) && team==0) || (team>1)) img='pbm1'; else img='pbm0';
idElem = document.getElementById(cid);
if(idElem)idElem.parentNode.removeChild(idElem);
document.getElementById('map').innerHTML+='<img id=\''+cid+'\' title=\''+name+'\' alt=\''+name+'\' src=\"img/persb/'+img+'.gif\" style=\"border:0;position:absolute;left:'+((1+(1+(parseInt(i/w)%2!=0)*16))+((i-parseInt(i/w)*w)*34))+'px;top:'+(1+parseInt(i/w)*30)+'px;\">';
if(x===tx && y===ty)boom(cx,cy);
}

function forceupd(){
doLoad('battle.php?ttarget='+tname+'&'+Math.random()*1000000000000);
doLoad('battle.php?ttarget='+mname+'&tab=s&'+Math.random()*1000000000000);
}
function forceupdate(){
	document.getElementById('gamep').innerHTML='<div style="width:'+(zx*34+18)+'px;height:'+(zy*30+11)+'px;background-image:url(\'img/cells.gif\');position:relative;" id=map onclick="target(event.clientX, event.clientY)"></div>';
	doLoad('battle.php?page=showbupdate&'+Math.random()*1000000000000);
	doLoad('battle.php?ttarget='+tname+'&'+Math.random()*1000000000000);
	 show_target();
	}
function charselect(sid,namet,tex,tey){
	if(bcid==sid) return;
	tname=namet;
	tx=tex;
	ty=tey;
	cx=tex;
	cy=tey;
	
	doLoad('battle.php?ttarget='+tname+'&'+Math.random()*1000000000000);
	}

function update_hp(targ_obj,size){
	document.getElementById(targ_obj).width=size;
	//alert(targ_obj+' = '+size);
}

function show_target(){
doLoad('battle.php?ttarget='+tname+'&'+Math.random()*1000000000000);
}

function createobst(x,y,img){
	obst_x.push(x);
	obst_y.push(y);
document.getElementById('map').innerHTML+='<img src=\"img/obst/'+img+'.gif\" style=\"border=0;position:absolute;left:'+(x*34+17*(y%2!=0))+'px;top:'+(y*30)+'px;\">';
}

function moveto(){
var obst_flag=false;
  if(obst_x.length!=obst_y.length) alert('Программная ошибка, попробуйте обновить страницу.');
  for (var key in obst_x)if(nx==obst_x[key] && ny==obst_y[key]) obst_flag=true;
  if(obst_flag===false) if((Math.abs(nx-sx)+Math.abs(ny-sy)<2)||(sy%2==0 && nx==sx-1 && Math.abs(sy-ny)==1)||(sy%2!=0 && nx==sx+1 && Math.abs(sy-ny)==1)){
    doLoad('battle.php?opponent='+tname+'&nx='+nx+'&ny='+ny+'&'+Math.random()*1000000000000,1);
    idElem = document.getElementById("targeti");
    if(idElem)idElem.parentNode.removeChild(idElem); 
//     doLoad('battle.php?page=showbupdate&last='+last_id);
    myper(nx,ny,mname,bcid,mteam);document.getElementById('buttons').style.visibility='hidden';
    motion='<i>Загрузка данных...</i>';
  }else{
    alert('Вы не можете перейти в указанную местность: '+nx+' '+ny+' из '+sx+' '+sy);
  }
  setTimeout('forceupd()',300);
}

function wait4motion(){
document.getElementById('buttons').style.visibility='hidden';
document.getElementById('striker').style.visibility='hidden';
motion='Ход других игроков';
}


function domotion(){
document.getElementById('buttons').style.visibility='visible';
motion='<font color=#0ca432>Ваш ход</font>';
}
function domotion_fail(msg){
	document.getElementById('buttons').style.visibility='visible';
	motion='<font color=red>Вы ошиблись!Ход не защитан!</font>';
	setTimeout('forceupd()',6000);
	}
function domotion_obst(){
	document.getElementById('buttons').style.visibility='visible';
	motion='<font color=red>Вы попали на препятствие, походите заново!</font>';
	setTimeout('forceupd()',6000);
}
function domotion_no(){
	document.getElementById('buttons').style.visibility='visible';
	motion='<font color=red>Противника нет</font>';
	setTimeout('forceupd()',2000);
	}
function domotion_bl(){
	document.getElementById('buttons').style.visibility='visible';
	motion='<font color=red>Вы не поставили достаточно ударов или блоков</font>';
	setTimeout('forceupd()',6000);
	}
function show_inf_b (login,id,level,rank,klan,form) {
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

document.getElementById('charname').innerHTML='<img src=\'i/align/align'+rank+'.gif\' width=12 height=12 alt=\''+hint_rank+'\'>'+klan+'<b>'+login+'</font></b> ['+level+']'+id; 
}

function view_item_b (tab,name,slot,w,h,hint,br,title,id) {
// alert(slot);
var elid;
if(slot=='w1' || slot=='w3' || slot=='w4' || slot=='w13') elid=tab+'wleft'; else if(slot!='w18' && slot!='w17') elid=tab+'wright'; else if(slot=='w17') elid=tab+'lpacket'; else elid=tab+'rpacket';
str=('<img src=\'i/items/'+name+'.gif\' border=0 width='+w+' height='+h+' onmouseover=\"'+hint+'\" onmouseout=\"c();\"');
if (edit_page == 1) str+=(' style=\'CURSOR: Hand\' onclick="window.location=\'main.php?set=edit&unset='+slot+'\';"');
if ((slot == 'w17' || slot == 'w18') && id != '' && id != undefined) str+=(' style=\'CURSOR: Hand\' onclick="ShowForm(\''+title+'\',\'\',\'\',\'\',\'1\',\''+name+'\',\''+id+'\',\''+slot+'\',\'\');"');
str+=('>');
if (br == 1) str+=('<br>'); 
if(slot=='w1' || slot=='w2' || slot=='w17' || slot=='w18') 
document.getElementById(elid).innerHTML=str; 
else 
document.getElementById(elid).innerHTML+=str;
}

function epic(num){
   r=document.all(num.id);
   bl['l']=0;
   bl['r']=0;
   for(i=0;i<r.length;i++)if(r[i].name.indexOf('lblock')!=-1 && r[i].checked) bl['l']++; else if(r[i].name.indexOf('rblock')!=-1 && r[i].checked) bl['r']++;
   for(i=0;i<r.length;i++){
 if(num.name.charAt(1)=='k' && r[i].name.charAt(0)==num.name.charAt(0)) if(r[i]!=num && num.checked){
   r[i].checked=false;
   r[i].disabled=true;
  }else r[i].disabled=false;
 if(num.name.charAt(1)=='b' && r[i].name.charAt(0)==num.name.charAt(0)) if((r[i]!=num&&((r[i].name.charAt(1)=='k'&&bl[r[i].name.charAt(0)]>0)||num.checked&&bl[r[i].name.charAt(0)]>1&&!r[i].checked))) r[i].disabled=true; else r[i].disabled=false;
 }
}

function colors(numc){
	numc=parseInt(numc);
	switch (numc){
                case 3: return 'orange'; break;
                case 4: return 'yellow'; break;
                case 5: return 'green'; break;
		default: return 'red';
	}
}

function sdll(targdoll,head,torso,right,left,legs,nhead,ntorso,nhands,nlegs){

	var zonesarray = ['nhead','ntorso','nhands','nlegs'];
	for (var charzone in zonesarray)
		eval('if('+zonesarray[charzone]+'===undefined) '+zonesarray[charzone]+'=\'неизвестно\';');
		
	//document.getElementById(targdoll).innerHTML='<table width=40><tr><td><table><tr height=10><td width=10></td><td width=20 bgcolor='+colors(head)+'></td><td width=10></td></tr><tr height=20><td width=10 bgcolor='+colors(right)+'></td><td width=20 bgcolor='+colors(torso)+'></td><td width=10 bgcolor='+colors(left)+'></td></tr><tr height=20><td width=10></td><td width=20 bgcolor='+colors(legs)+'></td><td width=10></td></tr></table></td></tr></table>';
	document.getElementById(targdoll).innerHTML='<table width=40><tr><td><table><tr height=10><td width=10></td><td width=20 bgcolor='+colors(head)+' title=\'Броня головы: '+nhead+'\'></td><td width=10></td></tr><tr height=20><td width=10 bgcolor='+colors(right)+' title=\'Броня рук: '+nhands+'\'></td><td width=20 bgcolor='+colors(torso)+' title=\'Броня торса: '+ntorso+'\'></td><td width=10 bgcolor='+colors(left)+' title=\'Броня рук: '+nhands+'\'></td></tr><tr height=20><td width=10></td><td width=20 bgcolor='+colors(legs)+' title=\'Броня ног: '+nlegs+'\'></td><td width=10></td></tr></table></td></tr></table>';
}

function zone(ztype){
//   switch (ztype){
//     case 'catacombs':
//   }
}

function endbattle(bid){
	if(bid===undefined)
		window.location.href = '/main.php';
	else
		window.location.href = '/bfinal.php?log='+bid;
}

function update_cdz(wtu,cdz,dvalue){
	//alert(wtu+'nm'+cdz)
	document.getElementById(wtu+'nm'+cdz).innerHTML=dvalue;
	//alert(cdz+' = '+dvalue);
}
