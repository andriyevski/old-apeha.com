var ltime,motion,timeout1;
ltime=0;

function ShowTime(fname,lefttime,typet)
{
// alert(1);
  lefttime--;
  if (lefttime<=0) { document.all(''+fname).innerText=''; window.location.reload(); }
  sec=lefttime%60;

  min=Math.floor(lefttime/60);
  day=Math.floor(lefttime/86400);

  hour=Math.floor((lefttime/3600)-(day*86400/3600));

  if (sec<10) sec="0"+sec;
  if (min>60) min-=(Math.floor(min/60)*60);
  if (min==60) min=0;

  if (typet!=1) { if (min<10) min="0"+min; }

  if (typet==1) { document.all(''+fname).innerText=min+" ���. "+sec+" ���."; }
  else {
  if (day>0) document.all(''+fname).innerText=day+" �. "+hour+" �. "+min+" ���. "+sec+" ���.";
  else { 
  if (hour>0) document.all(''+fname).innerText=hour+" �. "+min+" ���. "+sec+" ���.";
  else document.all(''+fname).innerText=min+" ���. "+sec+" ���.";
  }
  }
  setTimeout("ShowTime('"+fname+"',"+lefttime+","+typet+")",1000);

}

function ShowTimeOut(fname,lefttime,type1,bbid)
{
if(timeout1>0){
lefttime=timeout1;
timeout1=0;
}
if(lefttime<=0){
	//endbattle(bbid);
}
  lefttime--;
  if (lefttime<=0 || lefttime%10==0) { 
// ������ ����� ������ � ���� ���
doLoad('battle.php?page=showbupdate&'+Math.random()*1000000000000);
doLoad('battle.php?ttarget='+tname+'&'+Math.random()*1000000000000);
doLoad('battle.php?ttarget='+mname+'&tab=s&'+Math.random()*1000000000000);
}
if(lefttime<0) lefttime=0;
  sec=lefttime%60;
  min=Math.floor(lefttime/60);
  if (sec<10) sec="0"+sec;
if(document.getElementById('buttons').style.visibility=='visible' && lefttime<=30) motion='<font color=#ff0000>��� ���</font>';
  document.getElementById('timeout').innerHTML='['+min+':'+sec+'] <b>'+motion+'</b>';
  setTimeout("ShowTimeOut('"+fname+"',"+lefttime+","+type1+","+bbid+")",1000);
}
