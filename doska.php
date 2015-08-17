<? 
include("inc/db_connect.php"); 
include("inc/html_header.php"); 
?>

<BODY leftmargin=0 topmargin=0 marginwidth=0 marginheight=0 background='/i/bg.gif'>
<?php 
$stat = mysql_fetch_array(mysql_query("SELECT *  FROM `players` WHERE `user` = '".$user."' AND `pass` = '".$pass."' LIMIT 1")); 

if (isset($_POST['text'])) 
{ 
    if ($_POST['k'] != 0) $_POST['k'] = 1; 
    mysql_query(" 
        INSERT INTO  
            intim 
        SET 
            p_id = '".$stat['id']."', 
            text = '".$_POST['text']."', 
            type = '".$_POST['k']."', 
            time = '".time()."' 
    "); 
} 

echo "<center><table class=table>
<tr>

<input type=button class=input value='Обновить' style='CURSOR: Hand' alt='Обновить' onclick='window.location.href=\"doska.php?tmp=\"+Math.random();\"\"'>

	<input type=button class=input value='На улицу'  style='CURSOR: Hand' alt='Вернуться' onclick='window.location.href=\"world3.php?room=0&tmp=\"+Math.random();\"\"'>
</tr>
<tr>
<td><FORM METHOD=POST ACTION=''> 
Текст: <input class=input type=text name=text value=\"Введите текст\"><br> 
Тип:  <SELECT NAME=k class=input><OPTION value=0>купить<OPTION value=1>продать</SELECT> <input class=input type=submit value=подать>
</FORM></td> </center>
</tr>
</table>
"; 


echo ' 
<table align=center width=800 class=table border=1> 
  <tr> 
    <td><center><b>Номер</b></center></td> 
    <td><center><b>Ник</b></center></td> 
    <td><center><b>Текст</b></center></td> 
    <td><center><b>Тип</b></center></td> 
    <td><center><b>Статус</b></center></td> 
  </tr> 
'; 

$getData = mysql_query(" 
    SELECT  
* from intim limit 30
"); 

while ($data = mysql_fetch_assoc($getData)) 
{ 
	
	if(($_GET['act']=='del' && isset($_GET['n']) && $data['id']==$_GET['n'] && $data['p_id']==$stat['id'])){	
mysql_query("delete from intim where id='$n'");
$data = mysql_fetch_assoc($getData)	;	
	}
	
	$participant=mysql_fetch_array(mysql_query("select * from players where id='$data[p_id]' limit 1"));
    if ($data['type'] == 1)  
    { 
        $data['type'] = '<b><font color=blue>Продам</font></b>'; 
    } 
    else  
    { 
        $data['type'] = '<b><font color=red>Куплю</font></b>'; 
    } 
    if ($participant['lpv'] < (time()-300)) 
    { 
        $participant['lpv'] = '<b><font color=red>Оффлайн</font></b>'; 
    } 
    else  
    { 
        $participant['lpv'] = '<b><font color=green>Онлайн</font></b>'; 
    } 
 if(time()-$data['time']<3600)  { echo ' 
      <tr> 
        <td><center>'; 
    if($data['p_id']==$participant['id'])echo "<a href='?act=del&n=$data[id]'><img src='i/drop.gif'></a> ";
    echo $data['id'].'</center></td> 
        <td><center><script language=JavaScript>show_inf("'.$participant[user].'","'.$participant[id].'","'.$participant[level].'","'.$participant[rank].'","'.$participant[tribe].'");</script></td> 
        <td><center>'.$data['text'].'</center></td> 
        <td><center>'.$data['type'].'</center></td> 
        <td><center>'.$participant['lpv'].'</center> 
     
  </td></tr>';
 }
 else{mysql_query("delete from intim where id='$data[id]'");}  
} 

echo ' 
</table> 
'; 
?> 