<?php
include("inc/db_connect.php");
$online=mysql_num_rows(mysql_query("select `id` from `online`"));
$type=$_GET['type'];
if(empty($type)){$type = "news"; }
else if($type=="news"){$title="Новости";}
else if($type=="top_user"){$title="Топ игроков";}
else if($type=="top_klans"){$title="Топ кланов";}
else if($type=="forum"){$title="Форум";}
else if($type=="lib"){$title="Библиотека";}
else if($type=="comments"){$title="Обсуждение";}
else if($type=="reg"){$title="Регистрация";}
else if($type=="about"){$title="О игре";}
else if($type=="law"){$title="Законы";}
else if($type=="faq"){$title="FAQ";}
else if($type=="start"){$title="Быстрый старт";}
else if($type=="termin"){$title="Термины";}
else if($type=="lib_monsters"){$title="Монстры";}
else if($type=="lib_kvest"){$title="Квесты";}
else if($type=="exp"){$title="Таблица опыта";}
else {die();}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<meta name="description" content="Падшие Ангелы MMORPG - увлекательный мир созданный Богом, и оживлен Люцифером от вечного сна.">
<title>Old-apeha.ru - MMORPG <?=$title?></title>
<script language="JavaScript">
function setCookie (name, value, expires, path, domain, secure) {
      document.cookie = name + "=" + escape(value) +
        ((expires) ? "; expires=" + expires : "") +
        ((path) ? "; path=" + path : "") +
        ((domain) ? "; domain=" + domain : "") +
        ((secure) ? "; secure" : "");
}
function getCookie(name) {
    var cookie = " " + document.cookie;
    var search = " " + name + "=";
    var setStr = null;
    var offset = 0;
    var end = 0;
    if (cookie.length > 0) {
        offset = cookie.indexOf(search);
        if (offset != -1) {
            offset += search.length;
            end = cookie.indexOf(";", offset)
            if (end == -1) {
                end = cookie.length;
            }
            setStr = unescape(cookie.substring(offset, end));
        }
    }
    return(setStr);
}
numimg=0
imgslide=new Array()
imgslide[0]=new Image()
imgslide[1]=new Image()
imgslide[2]=new Image()
imgslide[3]=new Image()
imgslide[4]=new Image()
imgslide[5]=new Image()
imgslide[6]=new Image()
imgslide[7]=new Image()
imgslide[8]=new Image()
imgslide[9]=new Image()
imgslide[10]=new Image()
imgslide[11]=new Image()


imgslide[0].src="backgrounds/12.jpg"
imgslide[1].src="backgrounds/1.jpg"
imgslide[2].src="backgrounds/3.jpg"
imgslide[3].src="backgrounds/4.jpg"
imgslide[4].src="backgrounds/5.jpg"
imgslide[5].src="backgrounds/6.jpg"
imgslide[6].src="backgrounds/7.jpg"
imgslide[7].src="backgrounds/8.jpg"
imgslide[8].src="backgrounds/9.jpg"
imgslide[9].src="backgrounds/10.jpg"
imgslide[10].src="backgrounds/11.jpg"
imgslide[11].src="backgrounds/2.jpg"

function change()
{document.images[0].src=imgslide[numimg].src;
 setCookie("bg", imgslide[numimg].src, "Mon, 01-Jan-2020 00:00:00 GMT", "/");
numimg++
if(numimg==12)
numimg=0;

}
</script>
</head>
<body style="text-align: center; font-size: 14px; font-family: Segoe Script;">

<img <?if(!empty($_COOKIE['bg'])) echo "src='".htmlspecialchars($_COOKIE['bg'], ENT_QUOTES)."'"; else echo "src='backgrounds/2.jpg'";?> style="position: fixed; height: 100%; width: 100%; z-index: -1; left: 0px; top: 0px;">

<div style="width: 70%;  background: #fff; background-repeat: repeat; margin: 10px auto; opacity: 0.7;filter: alpha(Opacity=70); border: solid 5px #ccc; position: relative;">
 <div style="margin: auto; color: #000; font-size: 36px; font-weight: bold;">Падшие ангелы</div>
     <div style="font-weight: bold; position: relative; margin: auto;"><a href="/">Главная</a> / <a href="/?type=reg">Регистрация</a> / <A href="index.php?type=exp">Таблица опыта</A></div>
         <FORM method=post action=enter.php>

        <TABLE align="center">

            <TBODY>

                <TR style="HEIGHT: 14px">

                    <TD></TD>

                    <TD></TD>
                </TR>

                <TR>

                    <TD><INPUT  name=user style="background-color: #000; color: #fff; border: none;"></TD>

                    <TD><INPUT  type=password style="background-color: #000; color: #fff;border: none;" name=pass></TD>

                    <TD><INPUT  type=submit style="background-color: #000; color: #fff;border: none;" name=go value="Войти в игру"></TD>

                    <TD></TD>
                </TR>
            </TBODY>
        </TABLE>
        </FORM>
<div style="margin: 10px auto; color: #000; cursor: hand; position: relative; font-size: 15px;"> 
         <? include "inc/site/$type.php";?></td>
</div>
<div style="margin: auto; color: blue; cursor: hand; position: relative" onclick="change();">сменить фон</div>
</body>
 </div>

</html>

