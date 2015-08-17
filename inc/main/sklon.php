<?php
if ( ( $stat['rank'] >= 10 && $stat['rank'] <= 14 ) || ( $stat['rank'] >= 98 && $stat['rank'] <= 100 ) ) {
	include "guard.php"; // инклудим файл инковской панели
} elseif ( $stat['skl'] == 2 ) {
	include "dark.php"; // инклудим файл панели тьмы
} elseif ( $stat['skl'] == 3 ) {
	include "svet.php"; // инклудим файл панели света
} elseif ( $stat['skl'] == 1 ) {
	include "vor.php"; // инклудим панель воров
} else echo "У вас нет склоности! :)";
?>