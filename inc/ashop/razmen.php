<?
//Начало Продажи
if (@$kupit) {
	$summ=$koll*20;
	$koll = HtmlSpecialChars($koll);
	if ($koll!=0) {
		AddSlashes($koll);
		if (eregi("^[0-9]+$",$koll)) {
			if ($stat[valute]>=$koll) { // Хватает бабок
				mysql_query("UPDATE players set valute=valute-$koll where id=$stat[id]");
				mysql_query("UPDATE players set credits=credits+$summ where id=$stat[id]");
				$stat[valute]=$stat[valute]-$koll;
				$stat[credits]=$stat[credits]+$summ;
				$msgs="Вы продали <i>$koll</i> сп. и получили <i>$summ</i> зм.!"; }
				else $msgs="У вас нету столько валюты!"; }
				else $msgs="Количество имеет запрещенные символы!"; }
				else $msgs="Минимум можно обменять 1 сп.!"; }
				// Конец продажи
				echo"
<form method=POST>
<i>У вас золотых монет:</i><b> ".$stat['credits']." зм. </b><br>
<i>У вас валюты: </i><b> ".$stat['valute']." сп. </b> <br>
<i>Курс обмена: </i> <b>1 сп. = 20 зм. </b>
</td>
<td>";
				if (!empty($msgs)) echo"<center><FONT COLOR=RED><b>$msgs</b></font></center>";
				echo"
<center>
<input type=text name=koll size=13 class=input value=0> <input type=submit class=input value='Обменять' name='kupit'>
</center></td></form>";
				?>