<?
include("inc/db_connect.php");
?>
<link rel="stylesheet" type="text/css" href="css/chat.css">
<?

$stat = mysql_fetch_array(mysql_query("SELECT * FROM `players` WHERE `user` = '".addslashes($_SESSION['user'])."' AND `pass` = '".addslashes($_SESSION['pass'])."' LIMIT 1"));
mysql_query("SET CHARSET cp1251");
if (empty($stat['id']) || $stat['bloked']) {
	print "<script>top.location='index.php?action=logout'</script>";
	exit;
}?>
<?
//$text=$_POST['text'];
    if($act=='send' && !empty($text) && !empty($stat['user']) and !$stat['blocked'] and $stat['m_time']<time()){
        if(!empty($_POST['pre']))$text=$_POST['pre'].' '.$text;
        $check=explode(" ",$text);

        if(strpos($check[0], "@")===0) {$private=str_replace("@","",$check[0]); $text=str_replace("@$private ","", $text);}
        if(strpos($check[0], "#")===0) {$to=str_replace("#","",$check[0]); $text=str_replace("#$to ","", $text);}
        if(strpos($check[0], "!")===0 and !empty($stat['tribe'])) {$clan=$stat[tribe]; $text=str_replace("! ","", $text);}
 $text=htmlspecialchars($text, ENT_QUOTES);
  include("inc/chat/smiles.php");
    mysql_query("insert into chat set msg='$text', login='$stat[user]', date='".time()."', private='$private', system_to='$to', clan='$clan', room='$stat[room]'");

    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xml:lang="en" lang="en" xmlns="http://www.w3.org/1999/xhtml">
<script>
// Часы
var ServerDate=new Date(<?=time()*1000?>);
var CurDate=new Date();
Delta=ServerDate-CurDate

function showTime() {
  var CurTime=new Date();
  CurTime.setMilliseconds(Delta);
  var h=CurTime.getHours();
  var m=CurTime.getMinutes();
  var s=CurTime.getSeconds();
  var STime=""+h;
  STime+=((m<10)? ":0" : ":") + m;
  STime+=((s<10)? ":0" : ":") + s;
  document.getElementById("clock").innerHTML = STime;
  timerId=setTimeout("showTime()",1000); }


</script>
        <div class="chat">
            <form action="?act=send" method="post">
                <select class="pre" name="pre">
                    <option value="<?=htmlspecialchars($_POST['pre'])?>"><? if($_POST['pre']=='!')echo 'клану';elseif($_POST['pre']=='[куплю]')echo 'куплю';elseif($_POST['pre']=='[куплю]')echo 'куплю';else echo 'вслух';?></option>
                    <? if($_POST['pre']!='') {?><option value="">вслух</option><?}?>
                    <? if($_POST['pre']!='!') {?><option value="!">клану</option><?}?>
                    <? if($_POST['pre']!='[куплю]') {?><option value="[куплю]">куплю</option><?}?>
                    <? if($_POST['pre']!='[продам]') {?><option value="[продам]">продам</option><?}?>
                </select>
            <img src="img/chat/Chat_gramophone.png" style="float: left;">
            <input  type="text" name="text" id='msg' value="" height="30" style="width: 900px; margin: 7px 0 0 0; padding: 0 0 0 0; float: left;">
                <input type="submit" value=""   title="Добавить текст в чат" onclick="AddToChat()"
                        style="cursor: hand;
                        width: 24px;
                        height: 22px;
                        float: left;
                        margin:6px 0 0 5px;
                        background:url(img/chat/chat_ok.png); ">


            <input type="submit" value="" title="Смайлы"  onclick="open('/smiles.html','SM','width=380,height=350');return false"
            style="cursor: hand;
                   width: 24px;
                   height: 22px;
                   float: left;
                   margin:6px 0 0 5px;
                   background:url(img/chat/chat_smile.png); ">


                <img src="img/chat/chat_clear.png" width="21" height="21" title="Очистить строку ввода/чат" style="cursor: hand;
    float: left;margin:6px 0 0 5px;">
            <img src="img/chat/chat_mute.png" width="21" height="21" title="Скорость обновления чата" style="cursor: hand;
    float: left; margin: 6px 0 0 5px;">
                <?
                if ($stat['tribe'])
            echo "<input  type='button' class='klan' value=''  border='0'  style='cursor: pointer' title='Клан' onclick=\"parent.main.location='main.php?set=clan';\"> ";
        if (($stat['rank'] >= 10 && $stat['rank'] < 15) || $stat['rank'] >= 98)
            echo "<input type='button' value='' class='inkviz'  border='0' style='cursor: pointer' title='Инквизиция' onclick=\"parent.main.location='guard.php?';\">";
        if ($stat['skl'] == '2')
            echo "<input type=button class='abilka'  value=''   border=0 style='cursor: pointer' title='ТЬма' onclick=\"parent.main.location='dark.php';\">";
        if ($stat['skl'] != '2')
            echo "<input type='button' class='abilka' value=''   border=0 style='cursor: pointer' title='Свет' onclick=\"parent.main.location='svet.php';\">";

        ?>
                <img src="img/chat/chat_out.png" width="21" height="21" title="Выход" style="cursor: hand;
    float: left; margin: 6px 0 0 5px;" onclick="if (confirm('Выйти из игры?')) top.location='index.php?action=logout'">
                <button onload="showTime();>

</div>
