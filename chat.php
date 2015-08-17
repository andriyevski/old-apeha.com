<?
 include("inc/db_connect.php");
 // header("charset=UTF-8;\nCache-Control: no-cache;"); 
$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));
if ($stat[bloked]) echo"<script>top.location='index.php?action=logout'</script>";

if($act=='ref' and !empty($stat['user'])){      
    //апдейт trade
    $query = mysql_query("select * from chat where system='0' and private='' and (msg like '[продам]%' or msg like '[куплю]%' or msg like '[торг]%')  and `date`>='".(time()-8760)."' order by id asc limit 100");
    $system = "document.getElementById('3').innerHTML='";
    while($result=mysql_fetch_array($query)){
        
        $system.="[".date( 'H:i:s', $result['date'])."] <b>$result[login]</b> <font style=\'color:blue;\'>[торг]</font>: $result[msg]<br>";
    $msg="[".date( 'H:i:s', $result['date'])."] <b>$result[login]</b> <font style=\'color:blue;\'>[торг]</font>: $result[msg]<br>";
    }
    $system.="';var fi_t=\"".$_SESSION['msg_t']."\";var se_t=\"$msg\";if(fi_t!=se_t && fi_t!=''){document.getElementById('h3').style.background='orange';}";
   $_SESSION['msg_t']=$msg;  unset($msg);
    echo $system; 
    
    
    //апдейт системок
    $query = mysql_query("select * from chat where system='1' and system_to='$stat[user]' and `date`>='".(time()-8760)."' order by id asc limit 100");
  
    $system = "document.getElementById('2').innerHTML='";
    while($result=mysql_fetch_array($query)){
       $system.="[".date( 'H:i:s', $result['date'])."] <b>Голос</b>: $result[msg]<br>";
    $msg= "[".date( 'H:i:s', $result['date'])."] <b>Голос</b>: $result[msg]<br>";
    
    }
    $system.="';var fi=\"".$_SESSION['msg']."\";var se=\"$msg\";if(fi!=se && fi!=''){document.getElementById('h2').style.background='orange';}";
  $_SESSION['msg']=$msg;  unset($msg);
    echo $system;
     //апдейт приват
    $query = mysql_query("select * from chat where (private='$stat[user]' or (login='$stat[user]' and private not like '')) and `date`>='".(time()-8760)."' order by id asc limit 100");
    $system = "document.getElementById('4').innerHTML='";
    while($result=mysql_fetch_array($query)){
        if(empty($result[login]))$result[login]="Голос"; 
        $system.="[".date( 'H:i:s', $result['date'])."] <b>$result[login]</b> <font style=\'color:red;\'><em>приватно</em> <b>$result[private]</b></font>: $result[msg]<br>";
        $msg="[".date( 'H:i:s', $result['date'])."] <b>$result[login]</b> <font style=\'color:red;\'><em>приватно</em> <b>$result[private]</b></font>: $result[msg]<br>";
    }
    $system.="';var fi_p=\"".$_SESSION['msg_p']."\";var se_p=\"$msg\";if(fi_p!=se_p && fi_p!=''){document.getElementById('h4').style.background='orange';}";
   $_SESSION['msg_p']=$msg;  unset($msg);
    echo $system;  
    
         //апдейт клан
    $query = mysql_query("select * from chat where clan='$stat[tribe]' and clan not like '' and private='' and `date`>='".(time()-8760)."' order by id asc limit 100");
    $system = "document.getElementById('5').innerHTML='";
    while($result=mysql_fetch_array($query)){

        $system.="[".date( 'H:i:s', $result['date'])."] <b>$result[login]</b> <font style=\'color:#333300;\'><em>клану</em> <b>$result[private]</b></font>: $result[msg]<br>";
    $msg="[".date( 'H:i:s', $result['date'])."] <b>$result[login]</b> <font style=\'color:#333300;\'><em>клану</em></font>: $result[msg]<br>";
    }
    $system.="';var fi_c=\"".$_SESSION['msg_c']."\";var se_c=\"$msg\";if(fi_c!=se_c && fi_c!=''){document.getElementById('h5').style.background='orange';}";
   $_SESSION['msg_c']=$msg;  unset($msg);
    echo $system; 
   
        //апдейт all
    $query = mysql_query("select * from chat where ((clan='$stat[tribe]' and clan not like '' and private like '') or private='$stat[user]' or (login='$stat[user]' and private not like '') or ((clan='' or system=0) and room='$stat[room]' and private like '') and (msg not like '[продам]%' and msg not like '[куплю]%' and msg not like '[торг]%')) and `date`>='".(time()-8760)."' order by id asc limit 100");
    $all = "document.getElementById('1').innerHTML='";
    while($result=mysql_fetch_array($query)){
        if(empty($result['login']))$result['login']="Голос";
        if(!empty($result['system_to']))$to=" <font style=\'color:green;\'><em>говорит</em> с <b>$result[system_to]</b></font>";
        if(!empty($result['private']))$to=" <font style=\'color:red;\'><em>приватно</em> <b>$result[private]</b></font>";
        if(!empty($result['clan']))$to=" <font style=\'color:#333300;\'><em>клану</em></font>";
        $all.="[".date( 'H:i:s', $result['date'])."] <img style=\'cursor:hand\' onclick=\'parent.bottom.document.getElementById(\"msg\").value=\"@$result[login] \";\' src=\'/i/private.gif\'>  <b style=\'cursor:hand\' onclick=\'parent.bottom.document.getElementById(\"msg\").value=\"#$result[login] \";\'>$result[login]</b>$to: $result[msg]<br>";
        unset($to);
    }
    $all.="';scrollBy(0, 65000);";
    echo $all;
     exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xml:lang="en" lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<script>
 function S(name) 
{

        parent.bottom.document.getElementById("msg").value= parent.bottom.document.getElementById("msg").value+' :'+name+':';
}
var idd;
var nname;
function cll(idd, nname){
    document.getElementById(idd).style.visibility='hidden';
    document.getElementById(idd).style.position='absolute';
    document.getElementById(idd).style.display='none';
    document.getElementById('h'+idd).style.background='#666666'; 
} 
function opp(idd, nname){

    document.getElementById(idd).style.visibility='visible';
    document.getElementById(idd).style.position='relative'; 
    document.getElementById(idd).style.display='block';  
    document.getElementById('h'+idd).style.background='aqua';
    for(i=1;i<=6;i++){
        if(i!=idd) cll(i);
        
    
    }
     scrollBy(0, 65000); 
  /*  if(parent.bottom.document.getElementById("msg").value!="[торг] " && parent.bottom.document.getElementById("msg").value!="@" && parent.bottom.document.getElementById("msg").value!="! ") var ad = parent.bottom.document.getElementById("msg").value;
    else var ad='';

    
    if(idd==1 || idd==2) parent.bottom.document.getElementById("msg").value=""+ad;
    if(idd==3) parent.bottom.document.getElementById("msg").value="[торг] "+ad;
    if(idd==4) parent.bottom.document.getElementById("msg").value="@"+ad;
    if(idd==5) parent.bottom.document.getElementById("msg").value="! "+ad; */
}
 
</script>
<script language='JavaScript' src='i/chat.js?12022010'></script> 
<SCRIPT LANGUAGE="JavaScript" SRC="i/smiles.js"></SCRIPT>
<script>
function refresh(idd){ 
    doLoad('/chat.php?act=ref');
   
setTimeout('refresh()',5000);    
}

</script>     
</head>
<body bgcolor="#feeab9" onload="refresh();" style="font-size: 14px; font-family: Times New Roman;">
<table cellpadding="0" cellspacing="0" width="100%" style="position: fixed;  height: 10px;left: 0px; top: 0px; z-index: 100;opacity: 0.9;filter: alpha(Opacity=90);">
<tr  height="15" align="center" valign="middle" style="font-weight: bold; font-size: 12px; color: #000;">                                                                                                                                                
<td width="100" onclick="opp(1);" style="cursor: hand;border-right:solid 1px #ccc;"><div id='h1' style="background: aqua;">Общий</div></td><td width="100" onclick="opp(2);" style="cursor: hand;border-right:solid 1px #ccc;"><div id='h2' style="background: #666666;">Системный</div></td><td width="100" onclick="opp(3);" style="cursor: hand;border-right:solid 1px #ccc;"><div id='h3' style="background: #666666;">Торговый</div></td><td width="100" onclick="opp(4);" style="cursor: hand;border-right:solid 1px #ccc;"><div id='h4' style="background: #666666;">Приват</div></td><td width="100" onclick="opp(5);" style="cursor: hand;border-right:solid 1px #ccc;"><div id='h5' style="background: #666666;">Клан</div></td><td width="100" onclick="opp(6);" style="cursor: hand;border-right:solid 1px #ccc;"><div id='h6' style="background: #666666;">Смайлы</div></td><td width="100"><div id='refresh' style="background: green; cursor: hand" onclick="refresh();">обновить</div></td>      
</tr>
</table>  
<table cellpadding="0" cellspacing="0" width="100%" style=" position: relative; margin: 0px 0px 0px 0px ; background: #feeab9; bottom: 0px; width:100%">
<tr>
<td colspan="20"  valign="bottom" align="left" style="padding: 20px 10px 0px 10px; position: relative;">
<div id=1 style='visibility:visible;position:relative;display: block;'></div>        
<div id=2 style='visibility:hidden;position:absolute;display: none;'></div>
<div id=3 style='visibility:hidden;position:absolute;display: none;'></div>
<div id=4 style='visibility:hidden;position:absolute;display: none;'></div>
<div id=5 style='visibility:hidden;position:absolute;display: none;'></div>
<div id=6 style='visibility:hidden;position:absolute;display: none;'><SCRIPT>
var i=0;
while(i<sm.length) {
        var s = sm[i++];
        document.write('<IMG SRC=i/smile/'+s+'.gif WIDTH='+sm[i++]+' HEIGHT='+sm[i++]+' BORDER=0 ALT="'+s+'" onclick="S(\''+s+'\');" style="cursor:hand"> ');
}
</SCRIPT></div></td>
</tr>
</table>
</body>
</html>
