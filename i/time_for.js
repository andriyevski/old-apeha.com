function ShowTime(fname,lefttime,type)
{
  lefttime--;
  if (lefttime<=0) { document.all(''+fname).innerText=''; window.location="forest.php"; }
  sec=lefttime%60;

  min=Math.floor(lefttime/60);
  day=Math.floor(lefttime/86400);

  hour=Math.floor((lefttime/3600)-(day*86400/3600));

  if (sec<10) sec="0"+sec;
  if (min>60) min-=(Math.floor(min/60)*60);
  if (min==60) min=0;

  if (type!=1) { if (min<10) min="0"+min; }

  if (type==1) { document.all(''+fname).innerText=min+" мин. "+sec+" сек."; }
  else {
  if (day>0) document.all(''+fname).innerText=day+" д. "+hour+" ч. "+min+" мин.";
  else document.all(''+fname).innerText=hour+" ч. "+min+" мин.";
  }

  setTimeout("ShowTime('"+fname+"',"+lefttime+","+type+")",1000);

}