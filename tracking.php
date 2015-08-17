<HTML>
<HEAD>
  <TITLE>ИВЦ ОАСУ РПО / Отслеживание РПО</TITLE>
  <META HTTP-EQUIV="CONTENT-TYPE" CONTENT="TEXT/HTML; CHARSET=WINDOWS-1251">
  <META NAME="DESCRIPTION" CONTENT="Отслеживание регистрируемых почтовых отправлений">
  <META NAME="KEYWORDS" CONTENT="Track & Trace, отслеживание почтовых отправлений, доставка, вручение, почтовые отправления, письма, бандероли, посылки, Россия, Российская Федерация, ИВЦ ОАСУ РПО, Почта России">
  <style> 
.body             { font-family: Verdana, Arial; 
                      font-size: 8pt; 
                      text-align: center; 
                      background-color: #F9F9F9;
                      margin-top: 10px;
                    }

  .row_0_light      { font-family: Verdana, Arial; 
                      font-size: 8pt; 
                      background-color: #E6E4F2;
                    }
  .row_0_dark       { font-family: Verdana, Arial; 
                      font-size: 8pt; 
                      background-color: #D4D2E0;
                    }

  .row_1_light      { font-family: Verdana, Arial; 
                      font-size: 8pt; 
                      background-color: #F2F2F2;
                    }
  .row_1_dark       { font-family: Verdana, Arial; 
                      font-size: 8pt; 
                      background-color: #E0E0E0;
                    }

  .row_PINK_light   { font-family: Verdana, Arial; 
                      font-size: 8pt; 
                      background-color: #FFCCCC;
                    }
  .row_PINK_dark    { font-family: Verdana, Arial; 
                      font-size: 8pt; 
                      background-color: #FFBABA;
                    }

  .row_YELLOW_light { font-family: Verdana, Arial; 
                      font-size: 8pt; 
                      background-color: #FFFFCC;
                    }
  .row_YELLOW_dark  { font-family: Verdana, Arial; 
                      font-size: 8pt; 
                      background-color: #FFFFBA;
                    }


  .row_GREEN_light  { font-family: Verdana, Arial; 
                      font-size: 8pt; 
                      background-color: #CCFFCC;
                    }
  .row_GREEN_dark   { font-family: Verdana, Arial; 
                      font-size: 8pt; 
                      background-color: #BAFFBA;
                    }


  .row_BLUE_light   { font-family: Verdana, Arial; 
                      font-size: 8pt; 
                      background-color: #CCCCFF;
                    }
  .row_BLUE_dark    { font-family: Verdana, Arial; 
                      font-size: 8pt; 
                      background-color: #BABAFF;
                    }
  .row_BLUE_bold    { font-family: Verdana, Arial; 
                      font-size: 8pt; 
                      font-weight: bold;
                      background-color: #CCCCFF;
                    }

  .row_HEADER_dark  { font-family: Verdana, Arial; 
                      font-size: 8pt; 
                      font-weight: bold;
                      color: #FFFFFF; 
                      background-color: #003399;
                    }
  .row_HEADER_light { font-family: Verdana, Arial; 
                      font-size: 8pt; 
                      font-weight: bold;
                      color: #FFFFFF; 
                      background-color: #0066CC;
                    }




  .page_TITLE       { font-family: Verdana, Arial; 
                      font-size: 8pt; 
                      font-weight: bold;
                      color: #336699; 
                      margin-top: 0;
                      margin-bottom: 0;
                     }

  .page_ERROR       { font-family: Verdana, Arial; 
                      font-size: 8pt; 
                      font-weight: bold;
                      color: #CC0000; 
                    }

  .page_TEXT        { font-family: Verdana, Arial; 
                      font-size: 8pt; 
                    }

  .page_TEXT_bold   { font-family: Verdana, Arial; 
                      font-size: 8pt; 
                      font-weight: bold;
                    }

  .page_COMMENT     { font-family: Verdana, Arial; 
                      font-size: 8pt; 
                      color: #DDDDDD; 
                    }

  .page_INPUT       { font-family: Verdana, Arial;
                      font-size: 8pt;
                      color: #000000;
                      border: 1 solid #808080 ;
                      height: 17px;
                    }

</style>
</HEAD>
<BODY CLASS="body">


<center>Окно ввода:<br>
<form action='' method='post'>
<textarea rows="10" cols="40" name="income" id='inc'><?php echo $_POST['income']?></textarea><br><br>
<input type="submit" value="Поиск" STYLE="font: bold 8pt Verdana, Arial; color: #555555; "> <input type="button" onclick="document.getElementById('inc').innerHTML='';" value="Очистить" STYLE="font: bold 8pt Verdana, Arial; color: #555555; "><br><br>
</form>
<?php 
if(!empty($_POST['income'])){
	
set_time_limit(0);
$url='http://info.russianpost.ru/servlet/post_item';
$ch = curl_init($url);
$income_res=explode("\n", $_POST['income']);

for($i=0;$i<=count($income_res)-1;$i++){
	if(!empty($income_res[$i])){
$params='barCode='.preg_replace("/\n/", '', $income_res[$i]).'&action=search&searchType=barCode&show_form=yes&page=1';

do{
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 180);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);   
     
    $result = curl_exec($ch); 
    $table_start=explode('</FORM>', $result);
    $table_end=explode('<HR', $table_start[1]);
    
}
while(!preg_match('/Cannot get a connection, pool error Timeout waiting for idle object/',$result));
$show .= $table_end[0].'<br><br><HR WIDTH="550" NOSHADE SIZE="1">';

unset($result, $table_start, $table_end,$params);	
}}
curl_close($ch);}
echo $show;
?>
</center>
</BODY>
</HTML>