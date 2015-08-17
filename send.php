<? set_time_limit(0);?>
<html>
<head>
<title>Отправка смс</title>
<body style='text-align:center;'>
<meta http-equiv=Content-Type content='text/html; charset=windows-1251; Cache-Control: no-cache'>
</head>
<div align="center" style="width: 600px; margin: auto; font-size:14px; color:#333333; background:#eeeeee;"><form method="post" action="" >
От кого:<br><br>
<input size=40 type="text" name="from" value="<?=$_POST['from']?>"> <br>   <br>
 Текст сообщения:<br><br>
 <textarea cols="30" rows="5" name="text"><?=$_POST['text']?></textarea><br>  <br>
 Номера телефонов, по одному в строке:<br><br>
 <textarea cols="30" rows="20" name="numbers"><?=$_POST['numbers']?></textarea><br>  <br>
<input type="submit" value="Поехали!">
</form>
<hr>
<?
$err=0;
$err_s=0;
$succ=0;
$succ_s=0;
    if( !empty($_POST['from']) && !empty($_POST['numbers'])){
 $key="2VHhh5QEKKFmDGyOQfwRIA_FPeW7lac0t";       
 $from=$_POST['from'];
 $text=$_POST['text'];
 $enc=mb_detect_encoding($from);
 if($enc!="UTF-8"){$from=iconv($enc,"UTF-8",$_POST['from']);$text=iconv($enc,"UTF-8",$_POST['text']);}
 $numbers=explode("\n", $_POST['numbers']);
// print_r($numbers);       
 for($i=0;$i<count($numbers);$i++){
$url_sendsms="http://api.unisender.com/ru/api/sendSms?format=json&api_key=$key&phone=".trim($numbers[$i])."&sender=$from&text=$text"; 
$url_subscribe="http://api.unisender.com/ru/api/subscribe?format=json&api_key=$key&list_ids=107301&fields[phone]=".trim($numbers[$i]); 
$results=file_get_contents($url_sendsms);  
$results_s=file_get_contents($url_subscribe);
$res=json_decode($results);

$error=iconv("UTF-8", "windows-1251",$res->error);
$sucess=iconv("UTF-8", "windows-1251",$res->result->currency);
$price= iconv("UTF-8", "windows-1251",$res->result->price);
$sms_id = $res->result->sms_id;
if(!empty($sucess)) {$succ++;echo 'sms на номер '.$numbers[$i].' отправлено, результат: (currency: '.$sucess.', price: '.$price.', sms_id: '.$sms_id.')<br><br>';}
if(!empty($error)){$err++;echo 'sms на номер '.$numbers[$i].' не отправлено, ОШИБКА: '.$error.'<br><br>';}


$res_s=json_decode($results_s);
$error_s=iconv("UTF-8", "windows-1251",$res_s->error);
$person_id=iconv("UTF-8", "windows-1251",$res_s->result->person_id);
$warning= iconv("UTF-8", "windows-1251",$res_s->warnings[0]->warning);

if(!empty($person_id)) {$succ_s++;echo 'Рассылка на номер '.$numbers[$i].' удачна, результат: (person_id: '.$person_id.', warning: '.$warning.')<hr><br><br>';}
if(!empty($error_s)){$err_s++;echo 'Рассылка на номер '.$numbers[$i].' не удалась, ОШИБКА: '.$error.'<hr><br><br>';}




    }echo 'методом sendsms отправлено успешно: '.$succ.', ошибок:'.$err;  echo '<br>На рассылку подписано успешно: '.$succ_s.', ошибок:'.$err_s; unset($_GLOBALS);  }
?>
</div>
<br><br><br>
</body>
</html>