<?
$now=time();

include("inc/db_connect.php");

$stat = mysql_fetch_array(mysql_query("select * from players where user='$user' and pass='$pass'"));
mysql_query("SET CHARSET cp1251");
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat['t_time']>$now) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']>$now) { header("Location: academy.php"); exit; }
elseif ($stat['o_time']>$now) { header("Location: juvelir.php"); exit; }
elseif ($stat['r_time']>$now) { header("Location: podzem.php"); exit; }
elseif ($stat['lov_time']>$now) { header("Location: more.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat['room'] != 27) { header("Location: main.php"); exit; }
else {

	include("inc/html_header.php");

	echo"<body bgcolor=#EBEDEC leftmargin=0 topmargin=0>";

	print"<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr><td align=right valign=top>
<input class=lbut type=button value='Обновить' onclick='window.location.href=\"kwest.php?tmp=\"+Math.random();\"\"'>
<input class=lbut type=button value='Назад' onclick='window.location.href=\"world.php?room=0&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";

	echo"
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td align=right>
<center><font class=title>Квестовый Домик</font></center><br>";

	if ($stat[city]==1) {

		if (isset($take1)) {
			if ($stat['kwest0'] != 0) $msg="Ошибка, не пытайтесь взломать игру :)!";
			else {
				mysql_query("UPDATE players SET kwest0=1 WHERE user='".$stat['user']."'");
				$stat['kwest0']=1;
			}
		}

		if (isset($take2)) {
			if ($stat['kwest0'] != 2) $msg="Ошибка, не пытайтесь взломать игру :)!";
			else {
				mysql_query("UPDATE players SET kwest0=3, credits=credits+5 WHERE user='".$stat['user']."'");
				$stat['kwest0']=1;
				$stat['credits']=$stat['credits']+5;
			}
		}

		if (isset($take3)) {
			if ($stat['kwest0'] != 3) $msg="Ошибка, не пытайтесь взломать игру :)!";
			else {
				mysql_query("UPDATE players SET kwest0=4 WHERE user='".$stat['user']."'");
				$stat['kwest0']=4;
			}
		}

		if (isset($take4)) {
			if ($stat['kwest0'] != 5) $msg="Ошибка, не пытайтесь взломать игру :)!";
			if ($stat['credits'] < 75) $msg="У вас нет 75 зм, чтобы закончить Квест №2!";
			else {
				mysql_query("UPDATE players SET kwest0=6, credits=credits-75, exp=exp+200 WHERE user='".$stat['user']."'");
				$stat['kwest0']=6;
				$stat['credits']=$stat['credits']-75;
				$stat['exp']=$stat['exp']+200;
			}
		}


		if (isset($take5)) {
			if ($stat['kwest0'] != 6) $msg="Ошибка, не пытайтесь взломать игру :)!";
			else {
				mysql_query("UPDATE players SET kwest0=7 WHERE user='".$stat['user']."'");
				$stat['kwest0'] = 7;
				$ItTake = "kwest0_old_ring";
				$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));
				if ($buyitem['tip'] == 1 && $buyitem['slot2'] == "w5") $secondary=1; else $secondary=0;
				$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|0|$secondary|$buyitem[art]|0|$buyitem[iznos]";
				$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";
				mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".$stat['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");
				$msg="Вы получили <u>\"Испорченное Кольцо Мага\"</u><br>";
			}
		}

		if (isset($take6)) {
			if ($stat['kwest0'] != 10) $msg="Ошибка, не пытайтесь взломать игру :)!";
			else {
				mysql_query("DELETE FROM objects WHERE tip='15' && user='".$stat['user']."'");
				mysql_query("UPDATE players SET kwest0=11 WHERE user='".$stat['user']."'");
				$stat['kwest0'] = 11;
				$ItTake = "kwest0_new_ring";
				$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));
				if ($buyitem['tip'] == 1 && $buyitem['slot2'] == "w5") $secondary=1; else $secondary=0;
				$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|0|$secondary|$buyitem[art]|0|$buyitem[iznos]";
				$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";
				mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".$stat['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");
				$msg="Вы получили <u>\"Кольцо Мага\"</u><br>";
			}
		}

		if (isset($take7)) {
			if ($stat['kwest0'] != 11) $msg="Ошибка, не пытайтесь взломать игру :)!";
			else {
				mysql_query("UPDATE players SET kwest0=12 WHERE user='".$stat['user']."'");
				$stat['kwest0']=12;
			}
		}

		if (isset($take8)) {
			if ($stat['kwest0'] != 15) $msg="Ошибка, не пытайтесь взломать игру :)!";
			else {
				mysql_query("DELETE FROM objects WHERE tip='15' && user='".$stat['user']."'");
				mysql_query("UPDATE players SET kwest0=16 WHERE user='".$stat['user']."'");
				mysql_query("UPDATE players SET credits=credits+30 WHERE user='".$stat['user']."'");
				mysql_query("UPDATE players SET o_updates=o_updates+1 WHERE user='".$stat['user']."'");
				$stat['kwest0']=16;
				$stat['credits']=$stat['credits']+30;
				$stat['o_updates']=$stat['o_updates']+1;
			}
		}

		if (isset($take9)) {
			if ($stat['kwest0'] != 16) $msg="Ошибка, не пытайтесь взломать игру :)!";
			else {
				mysql_query("UPDATE players SET kwest0=17 WHERE user='".$stat['user']."'");
				$stat['kwest0']=17;
			}
		}

		if (isset($take10)) {
			if ($stat['kwest0'] != 18) $msg="Ошибка, не пытайтесь взломать игру :)!";
			else {
				mysql_query("DELETE FROM objects WHERE tip='15' && user='".$stat['user']."'");
				mysql_query("UPDATE players SET kwest0=19 WHERE user='".$stat['user']."'");
				$stat['kwest0'] = 19;
				$ItTake = "elik_sila10_24chas";
				$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));
				if ($buyitem['tip'] == 1 && $buyitem['slot2'] == "w5") $secondary=1; else $secondary=0;
				$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|0|$secondary|$buyitem[art]|0|$buyitem[iznos]";
				$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";
				mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".$stat['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");
				$msg="Вы получили <u>\"Элексир\"</u><br>";
			}
		}

		if (isset($take11)) {
			if ($stat['kwest0'] != 19) $msg="Ошибка, не пытайтесь взломать игру :)!";
			else {
				mysql_query("UPDATE players SET kwest0=20 WHERE user='".$stat['user']."'");
				$stat['kwest0']=20;
			}
		}

		if (isset($take12)) {
			if ($stat['kwest0'] != 24) $msg="Ошибка, не пытайтесь взломать игру :)!";
			else {
				mysql_query("DELETE FROM objects WHERE tip='15' && user='".$stat['user']."'");
				mysql_query("UPDATE players SET kwest0=25 WHERE user='".$stat['user']."'");
				mysql_query("UPDATE players SET credits=credits+25 WHERE user='".$stat['user']."'");
				mysql_query("UPDATE players SET o_updates=o_updates+1 WHERE user='".$stat['user']."'");
				mysql_query("UPDATE players SET s_updates=s_updates+1 WHERE user='".$stat['user']."'");
				$stat['kwest0']=25;
				$stat['credits']=$stat['credits']+25;
				$stat['o_updates']=$stat['o_updates']+1;
				$stat['s_updates']=$stat['s_updates']+1;
			}
		}

		if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";


		echo"

<fieldset style='WIDTH: 98.6%'><legend>Получить Квест</legend>
<table width=100% cellspacing=0 cellpadding=5>
<tr>
<td align=center>
В этом <b>Квестовом Домике</b> вы сможете получать интересные/захватывающие квесты, следуйте правилам...<br><br>

<table width=100% cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1>
<tr>
<td align=center>";

		if ($stat['kwest0'] == 0) {
			echo"<input class=lbut type=button value='Получить Квест №1!' onclick='window.location.href=\"kwest.php?take1\"'>"; }
			elseif ($stat['kwest0'] == 1) {
				echo"Вы получили <b>Квест №1</b>.<br>Для его выполнения вам предстоит добраться, через кровожадных монстров в подземелье, до <b>Зыбучих песков</b> и найти там <b>Подземный пояс</b>.<br>После этого придите сюда для получения бонуса."; }
				elseif ($stat['kwest0'] == 2) {
					echo"Поздравляю вы выполнили <b>Квест №1</b>, в честь этого вы получите бонус в размере <b>5 зм</b>.<br><input class=lbut type=button value='Получить бонус за Квест №1' onclick='window.location.href=\"kwest.php?take2\"'>"; }
					elseif ($stat['kwest0'] == 3) {
						echo"<center><b>Квест №1</b> выполнен.<br><input class=lbut type=button value='Получить Квест №2' onclick='window.location.href=\"kwest.php?take3\"'>"; }
						elseif ($stat['kwest0'] == 4) {
							echo"Вы получили <b>Квест №2</b>.<br>Для его выполнения вам предстоит добраться, до <b>Псарни</b> в подземелье, и найти там сундук, в нем вы найдете <b>50 зм</b>, но для окончания квеста вам нужно будет прибавить еще <b>25 зм</b>, в итоге нужно <b>75 зм</b>.<br>После этого прийде сюда для получения бонуса."; }
							elseif ($stat['kwest0'] == 5) {
								echo"Поздравляю вы выполнили <b>Квест №2</b>, в честь этого вы получите бонус в размере <b>200 опыта</b>.<br><input class=lbut type=button value='Получить бонус за Квест №2' onclick='window.location.href=\"kwest.php?take4\"'></center>"; }
								elseif ($stat['kwest0'] == 6) {
									echo"<b>Квест №1</b> выполнен.<br><b>Квест №2</b> выполнен.<br><input class=lbut type=button value='Получить Квест №3' onclick='window.location.href=\"kwest.php?take5\"'>"; }
									elseif ($stat['kwest0'] == 7 || $stat['kwest0'] == 8 || $stat['kwest0'] == 9) {
										echo"Это <b>\"Испорченное Кольцо Мага\"</b> оно потеряло свои свойства, для того чтобы его востановить в прежнее состояние, вам необходимо отыскать ингридиенты:<br> - <b>Рубин</b> (находится в <b>Алтаре</b>, в Подземелье)<br> - <b>Йод</b> (находится в <b>Старой Арене</b>, в Подземелье)<br> - <b>Змеиный Плод</b> (находится в <b>Зале Коронации</b>, в Подземелье)<br> После того как вы все эти ингридиенты найдете, необходимо будет вернусть назад, для того чтобы наш алхимик зачаровал <b>\"Кольцо Мага\"</b>, это кольцо и будет вам бонусом за выполнение <b>Квеста №3</b>."; }
										elseif ($stat['kwest0'] == 10) {
											echo"Поздравляю вы выполнили <b>Квест №3</b>, в честь этого вы получите бонус <b>\"Кольцо Мага\"</b>.<br><input class=lbut type=button value='Получить бонус за Квест №3' onclick='window.location.href=\"kwest.php?take6\"'>"; }
											elseif ($stat['kwest0'] == 11) {
												echo"<b>Квест №1</b> выполнен.<br><b>Квест №2</b> выполнен.<br><b>Квест №3</b> выполнен.<br><input class=lbut type=button value='Получить Квест №4' onclick='window.location.href=\"kwest.php?take7\"'>"; }
												elseif ($stat['kwest0'] == 12 || $stat['kwest0'] == 13 || $stat['kwest0'] == 14) {
													echo"Вы получили <b>Квест №4</b>.<br>Ооо... Ты снова пришел ко мне, вот у меня для тебя новое задание:<br>Найди <b>3 части меча</b>:<br><b>Солнечный камень</b> что выпал из рукояди, саму <b>Рукоядь</b>, <b>Лезвие</b> от меча...<br>Ты наверное подумаешь, свехнулся старик, где же я их найду! А я тебе подскажу...<br><b>Солнечный камень</b> будет лежать в <b>Комнате королей</b>, <b>Рукоядь</b> в <b>Оранжереи</b>, <b>Лезвие</b> будет торчать в <b>Дереве жизни</b>.<br>Принеси мне эти части, я тебе отблагадарю сполна...<br>Удачи боец..."; }
													elseif ($stat['kwest0'] == 15) {
														echo"Поздравляю вы выполнили <b>Квест №4</b>, в честь этого вы получите бонус <b>30 зм, + 1 к особенностям</b>.<br><input class=lbut type=button value='Получить бонус за Квест №4' onclick='window.location.href=\"kwest.php?take8\"'>"; }
														elseif ($stat['kwest0'] == 16) {
															echo"<b>Квест №1</b> выполнен<br><b>Квест №2</b> выполнен<br><b>Квест №3</b> выполнен<br><b>Квест №4</b> выполнен<br><input class=lbut type=button value='Получить Квест №5' onclick='window.location.href=\"kwest.php?take9\"'>"; }
															elseif ($stat['kwest0'] == 17) {
																echo"Вы получили <b>Квест №5</b>.<br>Один из моих знакомых Войнов, когда шел ко мне в гости, потерял в одном из зданий свою <b>Рубаху</b>, которую он выйграл на арене, тебе задание:<br>Найди эту <b>Рубаху Война</b> и принеси мне..."; }
																elseif ($stat['kwest0'] == 18) {
																	echo"Поздравляю вы выполнили <b>Квест №5</b>, в честь этого вы получите бонус <b>Элексир +10 к силе на 24 часа</b>.<br><input class=lbut type=button value='Получить бонус за Квест №5' onclick='window.location.href=\"kwest.php?take10\"'>"; }
																	elseif ($stat['kwest0'] == 19) {
																		echo"<b>Квест №1</b> выполнен<br><b>Квест №2</b> выполнен<br><b>Квест №3</b> выполнен<br><b>Квест №4</b> выполнен<br><b>Квест №5</b> выполнен<br><input class=lbut type=button value='Получить Квест №6' onclick='window.location.href=\"kwest.php?take11\"'>"; }
																		elseif ($stat['kwest0'] == 20 || $stat['kwest0'] == 21 || $stat['kwest0'] == 22 || $stat['kwest0'] == 23) {
																			echo"Вы получили <b>Квест №6</b>.<br>Привет еще раз, у меня беда! Я потерял своего любимого <b>котенка</b>, т.е. он убежал за ограду моего участка и не вернулся, я уже не знаю что и думать, может его украли, может надоело ему со мной жить, просто не знаю....<br><u>Если тебе не трудно отыщи моего любимого котенка, я тебя награжу сполна...</u>"; }
																			elseif ($stat['kwest0'] == 24) {
																				echo"Поздравляю вы выполнили <b>Квест №6</b>, в честь этого вы получите бонус <b>+1 к свободным характеристикам</b>, <b>+1 к свободным особеностям</b> и <b>+ 25 зм.</b>.<br><input class=lbut type=button value='Получить бонус за Квест №6' onclick='window.location.href=\"kwest.php?take12\"'>"; }
																				elseif ($stat['kwest0'] == 25) {
																					echo"<b>Квест №1</b> выполнен<br><b>Квест №2</b> выполнен<br><b>Квест №3</b> выполнен<br><b>Квест №4</b> выполнен<br><b>Квест №5</b> выполнен<br><b>Квест №6</b> выполнен<br><i>Продолжение следует...</i>"; }

																					echo"</td>
</tr>
</table>


</td>
</tr>
</table>
</fieldset>
<BR><BR>
";
	} else {




		if (isset($take1)) {
			if ($stat['kwest1'] == 0) {
				mysql_query("UPDATE players SET kwest1=1 WHERE user='".$stat['user']."'");
				$stat['kwest1']=1;
			} else $msg="Ошибка, не пытайтесь взломать игру :)!";
		}

		if (isset($take2)) {
			$shlem = mysql_query("SELECT * FROM objects WHERE objects.user='".$stat['user']."' AND objects.inf='helmet27|Кабассет|15|0|0|0|0|100' AND objects.tip='8'");
			if (mysql_num_rows ($shlem)) {
				$svitok = mysql_query("SELECT * FROM objects WHERE objects.user='".$stat['user']."' AND objects.tip=12 AND objects.inf='addenergy20|Восстановление 20 MP|2|0|0|0|0|1'");
				if (mysql_num_rows ($svitok)) {
					if ($stat['kwest1'] == 1) {
						mysql_query("UPDATE players SET kwest1=2, credits=credits+25 WHERE user='".$stat['user']."'");
						$stat['kwest1']=2;
						$stat['credits']=$stat['credits']+25;
						mysql_query("DELETE FROM objects WHERE objects.user='".$stat['user']."' AND objects.tip=12 AND objects.min='4|0|0|0|0|3|0|0'");
						$msg="Теперь, когда доспехи у вас есть, вы сможете постоять за себя в случае чего. За свиток спасибо, вы мне очень помогли. Вот, возьмите эти 25 зм в качестве компенсации за понесенные убытки.";
					} else $msg="Тут что то не так";
				} else $msg="У вас нет вещи \"Восстановление 20 MP\"!";
			} else $msg="У вас нет вещи \"Кабассет\"!";
		}

		if (isset($take3)) {
			if ($stat['kwest1'] == 2) {
				mysql_query("UPDATE players SET kwest1=3 WHERE user='".$stat['user']."'");
				$stat['kwest1']=3;
			} else $msg="Ошибка, не пытайтесь взломать игру :)!";
		}

		if (isset($take4)) {
			if ($stat['kwest1'] == 3) {
				if ($stat['wins'] >= 1) {
					if ($stat['exp'] >= 1) {
						mysql_query("UPDATE players SET kwest1=4, s_updates=s_updates+1 WHERE user='".$stat['user']."'");
						$stat['kwest1']=4;
						$stat['s_updates']=$stat['s_updates']+1;
						$msg="Вам удалось одолеть противника! Я уже вижу в ваших глазах уверенность в себе и решительность! Хвала тому, кто готов учиться и не брезгует советами старейших. За это я вас немного обучу - +1 к свободным характеристикам.";
					} else $msg="Вы так и не провели выйгрышный бой!";
				} else $msg="Вы так и не провели выйгрышный бой!";
			} else $msg="Ошибка, не пытайтесь взломать игру :)!";
		}

		if (isset($take5)) {
			if ($stat['kwest1'] == 4) {
				mysql_query("UPDATE players SET kwest1=5 WHERE user='".$stat['user']."'");
				$stat['kwest1']=5;
			} else $msg="Ошибка, не пытайтесь взломать игру :)!";
		}

		if (isset($take6)) {
			if ($stat['kwest1'] == 5 || $stat['kwest1'] == 6) {
				$svitok_mol = mysql_query("SELECT * FROM objects WHERE objects.user='".$stat['user']."' AND objects.inf='knife1|Когти|1|0|1|0|6|10' AND objects.tip='1'");
				if (mysql_num_rows ($svitok_mol)) {
					$kamen = mysql_query("SELECT * FROM objects WHERE objects.user='".$stat['user']."' AND objects.tip=17 AND objects.min='0|0|0|0|0|0|0|0'");
					if (mysql_num_rows ($kamen)) {
						mysql_query("UPDATE players SET kwest1=7, credits=credits+20, o_updates=o_updates+1 WHERE user='".$stat['user']."'");
						$stat['kwest1']=7;
						$stat['credits']=$stat['credits']+20;
						$stat['o_updates']=$stat['o_updates']+1;
						mysql_query("DELETE FROM objects WHERE objects.user='".$stat['user']."' AND objects.tip=15 AND objects.min='0|0|0|0|3|0|0|0'");
						mysql_query("DELETE FROM objects WHERE objects.user='".$stat['user']."' AND objects.min='0|0|0|0|0|0|0|0' AND objects.tip='17'");
						$msg="Вам удалось отъискать ингредиенты, спасибо вам за это, вот ваша награда: +20 зм, +1 очкой к особенностям";
					} else $msg="У вас нет вещи \"Солнечный камень\"!";
				} else $msg="У вас нет вещи \"Когти\"!";
			} else $msg="Ошибка, не пытайтесь взломать игру :)!";
		}

		if (isset($take7)) {
			if ($stat['kwest1'] == 7) {
				mysql_query("UPDATE players SET kwest1=8 WHERE user='".$stat['user']."'");
				$stat['kwest1']=8;

				$ItTake = "sol";
				$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));
				if ($buyitem['tip'] == 1 && $buyitem['slot2'] == "w5") $secondary=1; else $secondary=0;
				$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|0|$secondary|$buyitem[art]|0|$buyitem[iznos]";
				$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";
				mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".$stat['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");
				$msg="Вы получили <u>\"Соль\"</u>";
			} else $msg="Ошибка, не пытайтесь взломать игру :)!";
		}

		if (isset($take8)) {
			if ($stat['kwest1'] == 8 || $stat['kwest1'] == 9) {
				$uxa = mysql_query("SELECT * FROM objects WHERE objects.user='".$stat['user']."' AND objects.min='1|2|2|3|4|0|0|0' AND objects.tip='15'");
				if (mysql_num_rows ($uxa)) {
					mysql_query("UPDATE players SET kwest1=11, credits=credits+30 WHERE user='".$stat['user']."'");
					$stat['kwest1']=11;
					$stat['credits']=$stat['credits']+30;
					mysql_query("DELETE FROM objects WHERE objects.user='".$stat['user']."' AND objects.tip=15 AND objects.min='1|2|2|3|4|0|0|0' LIMIT 1");
					$msg="Спасибо друг что выполнил мое поручение. Вот держи награду: +30 зм";
				} else {
					mysql_query("UPDATE players SET kwest1=11 WHERE user='".$stat['user']."'");
					$stat['kwest1']=11;
					$msg="Ты меня решил обмануть, ну ладно! Никакой ты награды не получишь!!!";
				}
			} else $msg="Ошибка, не пытайтесь взломать игру :)!";
		}
		if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";


		echo"
<fieldset style='WIDTH: 98.6%'><legend>Получить Квест</legend>
<table width=100% cellspacing=0 cellpadding=5>
<tr>
<td align=center>
В этом <b>Квестовом Домике</b> вы сможете получать интересные/захватывающие квесты, следуйте правилам...<br><br>

<table width=100% cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1>
<tr>
<td align=center>";
		if ($stat['level'] < 1 and $stat['s_updates'] >= 1) {
			echo"<table cellspacing=0 cellpadding=5 width=100%><tr><td>
<table cellspacing=2 cellpadding=2 width=100%>
<tr>
                            <td width=100%>
                                <TABLE align=left>
                                <TR>
                                        <TD align=center><SCRIPT>w2('Андрогин','15','0','','','','','M')</SCRIPT></TD>
                                </TR>
                                <TR>
                                        <TD>&nbsp;&nbsp;<img src='http://img.carnage.ru/i/obraz/androgin.jpg' width=146 height=179>&nbsp;&nbsp;</TD>
                                </TR>
                                </TABLE>
                                <font class=td2>
                                Приветствую тебя,  <b> $stat[name]</b>, в нашем городе!<br><br>
Меня зовут Андрогин, я один из старейших жителей этого города. Стены города были заложенны моими предками! Наш город славится своими отважными воинами. Многие воины приходили в город, чтобы помериться с ними силами. Глядя в твои глаза, полные храбрости, я уверен, ты достигнешь успеха в своих сражениях  за честь и славу. Но прежде чем, ты приступишь к ним, я подскажу тебе какие физические качества,  следует развивать, чтобы стать непобедимым воином и увековечить свое имя в веках!
								<br>
Взгляни на табличку слева от меня, ты видишь свои характеристики - Сила, Ловкость, Удача и Выносливость. Они влияют на то, как ты будешь сражаться на просторах этого мира.<br><br>
<B>Сила</B> - очень важное качество; чем больше твоя сила, тем больше вещей ты можешь носить в своем рюкзаке, и тем сильнее будут твои удары в бою.<br><br>
<B>Ловкость</B> - влияет на то, как легко ты сможешь уворачиваться от ударов противника, а также насколько часто ты будешь попадать по нему..<br><br>
<B>Удача</B> - увеличивает шанс нанести критический удар, наносящий вдвое больше урона, а также увеличивает шанс избежать его со стороны противника.<br><br>
<B>Выносливость</B> - одна из самых главных характеристик; чем больше Выносливость, тем тем больше у тебя жизненной силы.<br><br>
Следующее, что тебе необходимо сделать - это использовать возможные обучения и увеличить свои характеристики. Не спеши, хорошенько подумай, какие характеристики лучше увеличить.<br><br>
Если тебя не устроит сделанный выбор, то после достижения первого уровня ты сможешь распределить характеристики иначе в моей хижине. Первые 10 операций проводятся бесплатно, в дальнейшем, чем выше уровень и больше характеристик, тем дороже тебе обойдется перераспределение<br><br>
<b><FONT COLOR='#CC0066'>ЗАДАНИЕ:</FONT></b> Распредели свободные характеристики и возвращайся ко мне.<br><br>
<I>Подсказка: для того чтобы распределить характеристики, нажми на надпись '+ Способности'.</I>
</font>
                                </font>
                            </td>
</tr>
</table>
</td></tr></table>"; }
			if ($stat['kwest1'] == 0) {

				echo"<input class=lbut type=button value='Получить Квест №1!' onclick='window.location.href=\"kwest.php?take1\"'>"; }
				elseif ($stat['kwest1'] == 1) {
					echo"Вы получили <b>Квест №1</b>.<br>Здравствуйте, путник. Я так понимаю, что в Melin'е вы недавно, так как раньше я вас не видел. Надеюсь, вам понравился наш великий город и вы останетесь здесь надолго. Город у нас большой: есть площадь, арена для тренировок, храм и магазин, в котором можно приобрести боевую амуницию, оружие, разнообразные свитки и эликсиры.
Кстати, о магазине... Вам необходимо купить доспехи, если вы их еще не купили, без них находится в нашем городе крайне опасно! Так что направляйтесь в магазин и в разделе «Шлемы» купите <b>Кабассет</b>. Кстати, захватите в магазине для меня еще свиток <b>Восстановление 20 MP</b>, а то они у меня закончились.<br>
<input class=lbut type=button value='Получить бонус за Квест №1' onclick='window.location.href=\"kwest.php?take2\"'>"; }
					elseif ($stat['kwest1'] == 2) {
						echo"<input class=lbut type=button value='Получить Квест №2' onclick='window.location.href=\"kwest.php?take3\"'>"; }
						elseif ($stat['kwest1'] == 3) {
							echo"Вы получили <b>Квест №2</b>.<br>Здравствуйте! Я смотрю, вы полны сил и решимости!! В ваших глазах я вижу желание участвовать в битвах и побеждать! Это похвально! Но для настоящего бойца одного желания мало. Еще необходим опыт и мастерство. Для того чтобы их обрести, вы должны пройти несколько испытаний.
Отправляйтесь на Арену, которая находится на Главной площади, и проведите бой! Но вы должны в этом бою выйграть и получить опыт.<br>
<input class=lbut type=button value='Получить бонус за Квест №2' onclick='window.location.href=\"kwest.php?take4\"'>"; }
							elseif ($stat['kwest1'] == 4) {
								echo"<input class=lbut type=button value='Получить Квест №3' onclick='window.location.href=\"kwest.php?take5\"'>"; }
								elseif ($stat['kwest1'] == 5 || $stat['kwest1'] == 6) {
									echo"Вы получили <b>Квест №3</b>.<br>Говорят давным давно в подземелье пошел отважный воин отмахнувшись от команды и решив все золото которое он там найдет не делить а оставить себе. Прошло несколько лет но он так из него и не вернулся, как ты уже догадался я был когдато с ним в команде. У него всегда был при себе талисман \"Солнечный камень\" я бы хотел чтобы ты отправился в подземелье и нашел его! Но перед тем как туда идти сходи ка к Андрогину и попроси его дать тебе пару заданий. Принесешь мне \"Когти\" которые он тебе даст<br>
<input class=lbut type=button value='Получить бонус за Квест №3' onclick='window.location.href=\"kwest.php?take6\"'>"; }
									elseif ($stat['kwest1'] == 7) {
										echo"<input class=lbut type=button value='Получить Квест №4' onclick='window.location.href=\"kwest.php?take7\"'>"; }
										elseif ($stat['kwest1'] == 8 || $stat['kwest1'] == 9 || $stat['kwest1'] == 10) {
											echo"Вы полуили <b>Квест №4</b>.<br>Здравствуй, старый друг! Сегодня я получил записку от моего брата. Он наловил рыбы, варит уху и приглашает меня в гости. Но как назло у него кончилась соль и он просил принести мешочек. К сожалению, я не смогу кнему сходить, но хотел бы попробовать ухи. Вот тебе соль, отнеси ее моему брату и попроси его передать для меня ухи. Только не просыпь ее - она очень дорога в этом году.<br>
<input class=lbut type=button value='Получить бонус за Квест №4' onclick='window.location.href=\"kwest.php?take8\"'>"; }
											elseif ($stat['kwest1'] == 11) {
												echo"Увы странник у меня для тебя нет заданий!!!"; }

												echo"</td>
</tr>
</table>


</td>
</tr>
</table>
</fieldset>
<BR><BR>
";

	}
	echo"</td>
</tr>
</table>
";
}
?>