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

    <meta charset="utf-8">
    <link href="css/site_index.css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<meta name="description" content="Old-apeha.com">
<title>Old-apeha.com - MMORPG <?=$title?></title>
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

</script>
</head>
<body>
<div class="site">
    <div class="header">
        <H>Old-apeha.ru</H>
    </div>
    <div class="header_botom_fon">
        <div class="forms">
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
        </FORM></div>
    </div>
    <div class="center">
            <div class="left_footer">
                 <div id="name_block">
                        <div id="name_block_info"<b style="font-size: larger;
    color: #7f4f03;">Здравствуйте<br>Гость</b><br><a href="register.php">Регистрация</a></div>
                 </div>
        <div class="bottom">
            <div class="bottom_ul">
                <div class="knopka"><a href="#" style="text-decoration: none;
    font-size: medium;
    color: #815105;">Войти в игру</a></div>
                </div>

            <div class="bottom_ul2">
                <div class="knopka"><a href="#" style="text-decoration: none;
    font-size: medium;
    color: #815105;">Выйти из игры</a></div>
            </div>
        </div>
            </div>

        <div class="content">
            <div class="news_header">
                <h>Новости</h>
            </div>
            <div class="news_content">

            <? include_once('inc_news.php') ?>

            </div>
            <div class="news_footer"></div>
            </div>

         <div class="right_footer">
             <br><A href="index.php?type=exp">Таблица опыта</A>
         </div>

    </div>
    <div class="footer"><p style="
align-content: center;
margin: 9px 0 0 0;
font-size: large;
">Все права защищены © 2015 Old-apeha.com</p></div>
</div>
</body>

</html>

