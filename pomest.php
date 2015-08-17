<?
require_once("inc/module.php");
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";
if ($stat[t_time]>time()) { header("Location: prison.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
//elseif ($stat['room'] != 67) { header("Location: main.php"); exit; }
elseif ($stat['o_time']>time()) { header("Location: juvelir.php"); exit; }
elseif ($stat['r_time']>time()) { header("Location: podzem.php"); exit; }
elseif ($stat['mol_bog_swet']>time()) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>time()) { header("Location: bog_hram.php"); exit; }
else {
	include("inc/html_header.php");

	echo"<body bgcolor='#F5FFDA'>";

	if ( $set == 'ferm' ) {
		include("pomest_ferm.php");
	}
	// elseif ( $set == '' ) {
	//include("pomest_.php");
	//}
	elseif ( $set == 'pomest' ) {
		include("pomest_pomest.php");
	} elseif ( $set == 'repair' ) {
		include("pomest_repair.php");
	} elseif ( $set == 'bank' ) {
		include("pomest_bank_f.php");
	}

	echo"
<input class=input type=button value='Обновить' onclick='window.location.href=\"pomest.php?tmp=\"+Math.random();\"\"'>
<input class=input type=button value='Вернуться' onclick='window.location.href=\"world5.php?room=67&tmp=\"+Math.random();\"\"'>
";
	if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";

	?>

<table border='0' width='100%' cellspacing='0' cellpadding='0'>
	<tr>
		<td width='100%' align='center'>


		<table border='0' width='100%' height='100%' cellspacing='0'
			cellpadding='0'>
			<tr>
				<td width='22' height='100%'>
				<table border='0' width='22' height='100%' cellspacing='0'
					cellpadding='0'>
					<tr>
						<td width='22' height='25'><img src='i/inman_b11.gif' width='22'
							height='25' alt=''></td>
					</tr>
					<tr>
						<td width='22' height='69'><img src='i/inman_b12.gif' width='22'
							height='69' alt=''></td>
					</tr>
					<tr>
						<td width='22' height='100%' background='i/inman_b13.gif'>&nbsp;</td>
					</tr>
					<tr>
						<td width='22' height='69'><img src='i/inman_b14.gif' width='22'
							height='69' alt=''></td>
					</tr>
					<tr>
						<td width='22' height='25'><img src='i/inman_b15.gif' width='22'
							height='25' alt=''></td>
					</tr>
				</table>

				</td>
				<td height='100%'>
				<table border='0' width='100%' height='100%' cellspacing='0'
					cellpadding='0'>
					<tr>
						<td width='100%' height='25'>
						<table border='0' width='100%' height='25' cellspacing='0'
							cellpadding='0'>
							<tr>
								<td width='51' height='25'><img src='i/inman_b211.gif'
									width='51' height='25' alt=''></td>
								<td background='i/inman_b212.gif' valign='middle'>
								<table border='0' height='22' cellspacing='0' cellpadding='0'
									align='center'>
									<tr>
										<td width='43' height='22'><img border='0'
											src='i/inman_rb01.gif' width='43' height='22'></td>
										<td background='i/inman_rb02.gif' height='22' valign='middle'>
										<font color='#FFFFFF' face='Verdana' size='2'><a href='?set='>Статистика</a>
										<a href='?set=pomest'>Поместье</a> <a href='?set=ferm'>Ферма</a>
										<a href='?set=repair'>Мастерская</a> <a href='?set=zeml'>Землянка</a>
										<a href='?set=bank'>Банк</a></font></td>
										<td width='43' height='22'><img border='0'
											src='i/inman_rb03.gif' width='43' height='22'></td>
									</tr>
								</table>


								</td>
								<td width='51' height='25'><img src='i/inman_b213.gif'
									width='51' height='25' alt=''></td>
							</tr>
						</table>

						</td>
					</tr>
					<tr>
						<td width='100%' height='100%' background='i/inman_fon.gif'>
						<table border='0' width='100%' height='100%' cellspacing='0'
							cellpadding='0'>
							<tr>
								<td height='30' align='center'>

								<table border='0' height='22' cellspacing='0' cellpadding='0'
									align='center'>
									<tr>
										<td width='43' height='22'><img border='0'
											src='i/inman_rb01.gif' width='43' height='22'></td>
										<td background='i/inman_rb02.gif' height='22' align='center'>
										<b><font color='#FFFFFF' face='Verdana' size='2'>Информания</font></b></td>
										<td width='43' height='22'><img border='0'
											src='i/inman_rb03.gif' width='43' height='22'></td>
									</tr>
								</table>
								</td>
								<td height='30' align='center'><b><font face='Verdana' size='4'><? if ( $set == '' ) { echo"Статистика"; } elseif ( $set == 'ferm' ) { echo"Ферма"; } elseif ( $set == 'pomest' ) { echo"Поместье"; } elseif ( $set == 'repair' ) { echo"Мастерская"; } elseif ( $set == 'zeml' ) { echo"Землянка"; } elseif ( $set == 'bank' ) { echo"Банк"; } ?></font></b></td>
								<td height='30' align='center'>
								<table border='0' height='22' cellspacing='0' cellpadding='0'
									align='center'>
									<tr>
										<td width='43' height='22'><img border='0'
											src='i/inman_rb01.gif' width='43' height='22'></td>
										<td background='i/inman_rb02.gif' height='22' align='center'>
										<b><font color='#FFFFFF' face='Verdana' size='2'>Действия</font></b></td>
										<td width='43' height='22'><img border='0'
											src='i/inman_rb03.gif' width='43' height='22'></td>
									</tr>
								</table>
								</td>
							</tr>
							<tr>
								<td width='307' height='100%' valign='top'>

								<table border='0' cellpadding='0' cellspacing='0' width='307'>
									<tr>
										<td width='6' height='7'><img src='i/rama_07.gif' width='6'
											height='7' alt=''></td>
										<td width='295' height='7'><img src='i/rama_08.gif'
											width='295' height='7' alt=''></td>
										<td width='6' height='7'><img src='i/rama_09.gif' width='6'
											height='7' alt=''></td>
									</tr>
									<tr>
										<td background='i/rama_12.gif' width='6'>&nbsp;</td>
										<td background='i/inman_fon.gif'>
										<table cellspacing='0' cellpadding='0'
											style='border-collapse: collapse; padding: 10' border='0'
											align='center'>
											<tr>
												<td><? 
												if ( $set == 'ferm' ) {
													if ( $stat['lvl_ferm'] >= 1 ) {
														$kol_eda_den = $stat['kol_ferm']*4;
														echo "
Уровень: <b>".$stat['lvl_ferm']."</b><br>
Кол-во фермеров: <b>".$stat['kol_ferm']."</b>/<b>".$stat['lvl_pomest']."</b> чел.<br>
Кол-во продуктов на складе: <b>".$stat['eda_ferm']."</b> ед.<br>
Изготовление продуктов за сутки:  <b>$kol_eda_den</b> ед.";
													} else echo "Здание не посторенно"; }
													elseif ( $set == 'repair' ) {
														if ( $stat['lvl_repair'] >= 1 ) {
															$skidka = $stat['kol_repair']*5;
															echo "
Уровень: <b>".$stat['lvl_repair']."</b><br>
Кол-во рабочих: <b>".$stat['kol_repair']."</b>/<b>".$stat['lvl_pomest']."</b> чел.<br>
Скидка на ремонт:  <b>$skidka</b> %"; 
														} else echo "Здание не построенно"; }
														elseif ( $set == '' ) {
															if ( $stat['lvl_ferm'] <= 0 )
															echo "Ферма: <b>не построено</b><br>";
															else echo "Ферма: <b>построено</b><br>";
															if ( $stat['lvl_pomest'] <= 0 )
															echo "Поместье: <b>не построено</b><br>";
															else echo "Поместье: <b>построено</b><br>";
															if ( $stat['lvl_repair'] <= 0 )
															echo "Мастерская: <b>не построено</b><br>";
															else echo "Мастерская: <b>построено</b><br>";
															if ( $stat['lvl_bank'] <= 0 )
															echo "Банк: <b>не построено</b><br>";
															else echo "Банк: <b>построено</b><br>";
														} elseif ( $set == 'zeml' ) {
															echo "Статистика отсутствует"; }
															elseif ( $set == 'pomest' ) {
																if ( $stat['lvl_pomest'] >= 1 ) {
																	echo "
Уровень: <b>".$stat['lvl_pomest']."</b><br>
Кол-во работников: <b>".$stat['kol_pomest']."</b>/<b>".$stat['lvl_pomest']."</b> чел."; 
																} else echo "Здание не построенно"; }
																elseif ( $set == 'bank' ) {
																	if ( $stat['lvl_bank'] ) {
																		echo "
Уровень: <b>".$stat['lvl_bank']."</b><br>
Процентая ставка: <b>".$stat['lvl_bank']."</b>%<br>
Дипозиты: <b>".$stat['depoz']."</b>/<b>".$stat['depozit']."</b> ед.<br>
Вложенных: <b>".$stat['bank']."</b> зм.<br>
Доход: <b>$doxod</b> зм."; 
																	} else echo "Здание не построенно"; }
																	?></td>
											</tr>
										</table>
										</td>
										<td background='i/rama_14.gif' width='6'>&nbsp;</td>
									</tr>
									<tr>
										<td width='6' height='8'><img src='i/rama_17.gif' width='6'
											height='8' alt=''></td>
										<td width='295' height='8'><img src='i/rama_18.gif'
											width='295' height='8' alt=''></td>
										<td width='6' height='8'><img src='i/rama_19.gif' width='6'
											height='8' alt=''></td>
									</tr>

								</table>


								</td>
								<td>
								<table cellspacing='0' width='100%' cellpadding='0'
									style='border-collapse: collapse; padding: 10' border='0'>
									<tr>
										<td align='center'><?
										$pomest = mysql_fetch_array(mysql_query("SELECT * FROM `pomest` WHERE `name` = '$set'"));
										if ( $set == 'repair' ) {

											//Ремонт
											if (@$_GET['rem']) {
												if (preg_match("/^[0-9]+$/", $_GET['rem'])){
													$object = mysql_fetch_array(mysql_query("SELECT objects.id, objects.inf FROM objects, slots WHERE objects.user='".$stat['user']."' AND (objects.tip >= 1 AND objects.tip <= 17) AND objects.bank=0 AND objects.lam=0 AND objects.id=".$_GET['rem']." AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19)"));
													if ($object) {
														$inf = explode("|",$object['inf']);
														if ($inf['6']==$inf['7']){
															if($inf['7']>1){
																$inf['6']=0;
																$inf['7']=$inf['7']-1;
																$rem_price = ($obj_inf['2']*0.1)*(100-$skidka)/100;
																$infs = $inf['0']."|".$inf['1']."|".$inf['2']."|".$inf['3']."|".$inf['4']."|".$inf['5']."|".$inf['6']."|".$inf['7'];
																mysql_query("UPDATE objects SET inf='".$infs."' WHERE id=".$object['id']."");
																mysql_query("UPDATE players SET credits=credits-$rem_price WHERE user=".$stat['user']."");
																$msg = "Вы удачно отремонтировали <U>".$inf['1']."</U>, заплатив при этом - ".$rem_price." Зм.";
															}else $msg = "Вещь <U>".$inf['1']."</U> не принадлежит ремонту";
														}else $msg = "Вещь <U>".$inf['1']."</U> не поломана";
													}else $msg = "Что-то тут не так..";
												}else $msg = "Иш ты какой :)";
											}

											//Удаление вещи
											if (@$_GET['del']) {
												if (preg_match("/^[0-9]+$/", $_GET['del'])){
													$object = mysql_fetch_array(mysql_query("SELECT objects.id, objects.inf FROM objects, slots WHERE objects.user='".$stat['user']."' AND (objects.tip >= 1 AND objects.tip <= 17) AND objects.bank=0 AND objects.lam=0 AND objects.id=".$_GET['del']." AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19)"));
													if ($object) {
														$inf = explode("|",$object['inf']);
														if ($inf['6']==$inf['7'] && $inf['7']<=1){
															$dell=mysql_query("DELETE FROM objects WHERE id=".$object['id']."");
															if($dell)
															$msg = "Вы удачно удалили <U>".$inf['1']."</U>";
															else $msg = "Что-то тут не так..";
														}else $msg = "Вещь <U>".$inf['1']."</U> еще пригодна";
													}else $msg = "Что-то тут не так..";
												}else $msg = "Иш ты какой :)";
											}


											$it_sost=mysql_query("SELECT objects.* FROM objects, slots WHERE objects.user='".$stat['user']."' AND (objects.tip >= 1 AND objects.tip <= 17) AND objects.bank=0 AND objects.lam=0 AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) ORDER BY time desc");

											if (mysql_num_rows($it_sost)) {
												echo"<table width=100% cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1>";

												for($i=0; $i<mysql_num_rows($it_sost); $i++) {

													$objects=mysql_fetch_array($it_sost);

													$obj_inf=explode("|",$objects['inf']);
													$obj_min=explode("|",$objects['min']);
													$obj_add=explode("|",$objects['add']);

													include('inc/main/min_tr.php');
													include('inc/main/add.php');
													include('inc/main/classes.php');
													if ($obj_inf['6']>=$obj_inf['7']){
														$rem_price = ($obj_inf['2']*0.1)*(100-$skidka)/100;
														$s="";
														if($obj_inf['7']<=1 && $obj_inf['6']>=$obj_inf['7'])
														$s="<br><a href='pomest.php?set=repair&del=".$objects['id']."'>Удалить</a>";
														elseif($obj_inf['6']>=$obj_inf['7'])
														$s="<br><a href='pomest.php?set=repair&rem=".$objects['id']."'>Ремонт за $rem_price зм.</a>";
														echo"
                <tr><td width=33% align=center valign=center>
                <b>".$obj_inf['1']."</b><br><br>
                <img src='i/money.gif' alt='Цена предмета'> <b>".$obj_inf['2']." зм.</b><br>
                <img src='i/item_iznos.gif' alt='Долговечность предмета'> <b>".$obj_inf['6']."</b>/<b>".$obj_inf['7']."</b><br>
                </td>
                <td width=34% align=center>
                <img src='i/items/".$obj_inf['0'].".gif' alt='".$obj_inf['1']."'>
                ".$s."
                </td>
                <td width=33% valign=top>
                <b><i>Минимальные требования:</i></b><br>
                $min_rase$min_level$min_str$min_dex$min_ag$min_vit<br>
                <b><i>Действие предмета:</i></b><br>
                $hp$energy$uron$strength$dex$agility$vitality$razum$br1$br2$br5$br3$br4$krit$unkrit$uv$unuv";

                if ($objects['about']) echo"<b><i>Дополнительная информация:</i></b><br>$about";

                echo"</td></tr>";
													}
												}
											} else
											echo"У Вас нет предметов, подлежащих ремонту.";

											echo"</table>";

										}
										elseif ( $set == 'zeml' ) {
											include ("pomest_zeml.php"); }
											elseif ( $set == 'bank' ) {
												echo"
<form action='' method='post'>
<table>
<tr><td>
<td width='50%' align='center'><b>Положить на счет</b><br>
<input name='money1' class=input type='text' value='0' size='5' maxlength='10'> / <b>".$stat['credits']."</b> зм.<br><input class=input name='deposit' type='submit' value='Добавить'></td>
<td width='50%' align='center'><b>Снять со счета</b><br>
<input name='money2' class=input type='text' value='0' size='5' maxlength='10'> / <b>".$stat['bank']."</b> зм.<br><input class=input name='withdraw' type='submit' value='Снять'></td>
</tr></td>
</table>
</form>
"; }
												else echo "".$pomest['text']."";
												?></td>
									</tr>
								</table>
								</td>
								<td width='307' height='100%' valign='top'>

								<table border='0' cellpadding='0' cellspacing='0' width='307'>
									<tr>
										<td width='6' height='7'><img src='i/rama_07.gif' width='6'
											height='7' alt=''></td>
										<td width='295' height='7'><img src='i/rama_08.gif'
											width='295' height='7' alt=''></td>
										<td width='6' height='7'><img src='i/rama_09.gif' width='6'
											height='7' alt=''></td>
									</tr>
									<tr>
										<td background='i/rama_12.gif' width='6'>&nbsp;</td>
										<td background='i/inman_fon.gif'>

										<table cellspacing='0' cellpadding='0'
											style='border-collapse: collapse; padding: 10' border='0'
											align='center'>
											<tr>
												<td><?
												if ($set=="ferm") {
													echo "<form action='' method=post>";
													if ( $stat['lvl_ferm'] >= 1 ) { // Если есть ферма, то показываем ее
														echo "<select name=up_lvl_ferm><option value=1>1 ур. - 25 зм<option value=2>2 ур. - 50 зм<option value=3>3 ур. - 75 зм<option value=4>4 ур. - 100 зм<option value=5>5 ур. - 125 зм</select>
<input type=submit class=input value='Улучшить' name=up_ferm><br>";
														echo"<br><select name=up_fermers_kol><option value=1>1 чел. - 100 зм<option value=2>2 чел. - 200 зм<option value=3>3 чел. - 300 зм<option value=4>4 чел. - 400 зм<option value=5>5 чел. - 500 зм</select>
<input type=submit class=input value='Нанять' name=kup_fermers><br>";
														echo"<br><select name=del_fermers_kol><option value=1>1 чел.<option value=2>2 чел.<option value=3>3 чел.<option value=4>4 чел.<option value=5>5 чел.</select>
<input type=submit class=input value='Уволить' name=del_fermers>"; }
														elseif ( $stat['lvl_ferm'] <= 0 ) {
															echo "<center><input type=submit class=input value='Построить Ферму - 100 зм' name=kup_ferm></center>"; }
															echo "</form>";
												}
												elseif ($set=="pomest") {
													echo "<form action='' method=post>";
													if ( $stat['lvl_pomest'] >= 1 ) { // Если есть поместье, то показываем ее
														echo "<select name=up_lvl_pomest><option value=1>1 ур. - 50 зм<option value=2>2 ур. - 100 зм<option value=3>3 ур. - 150 зм<option value=4>4 ур. - 200 зм<option value=5>5 ур. - 250 зм</select>
<input type=submit class=input value='Улучшить' name=up_pomest><br>";
														echo"<br><select name=up_pomests_kol><option value=1>1 чел. - 50 зм<option value=2>2 чел. - 100 зм<option value=3>3 чел. - 150 зм<option value=4>4 чел. - 200 зм<option value=5>5 чел. - 250 зм</select>
<input type=submit class=input value='Нанять' name=kup_pomests><br>";
														echo"<br><select name=del_pomests_kol><option value=1>1 чел.<option value=2>2 чел.<option value=3>3 чел.<option value=4>4 чел.<option value=5>5 чел.</select>
<input type=submit class=input value='Уволить' name=del_pomests>"; }
														elseif ( $stat['lvl_pomest'] <= 0 ) {
															echo "<center><input type=submit class=input value='Построить Поместье - 150 зм' name=kup_pomest></center>"; }
															echo "</form>";
												}
												elseif ($set=="repair") {
													echo "<form action='' method=post>";
													if ( $stat['lvl_repair'] >= 1 ) { // Если есть мастерская, то показываем ее
														echo "<select name=up_lvl_repair><option value=1>1 ур. - 50 зм<option value=2>2 ур. - 100 зм<option value=3>3 ур. - 150 зм<option value=4>4 ур. - 200 зм<option value=5>5 ур. - 250 зм</select>
<input type=submit class=input value='Улучшить' name=up_repair><br>";
														echo"<br><select name=up_repairs_kol><option value=1>1 чел. - 50 зм<option value=2>2 чел. - 100 зм<option value=3>3 чел. - 150 зм<option value=4>4 чел. - 200 зм<option value=5>5 чел. - 250 зм</select>
<input type=submit class=input value='Нанять' name=kup_repairs><br>";
														echo"<br><select name=del_repairs_kol><option value=1>1 чел.<option value=2>2 чел.<option value=3>3 чел.<option value=4>4 чел.<option value=5>5 чел.</select>
<input type=submit class=input value='Уволить' name=del_repairs>"; }
														elseif ( $stat['lvl_repair'] <= 0 ) {
															echo "<center><input type=submit class=input value='Построить Мастерскую - 100 зм' name=kup_repair></center>"; }
															echo "</form>";
												}
												elseif ($set=="bank") {
													echo "<form action='' method=post>";
													if ( $stat['lvl_bank'] >= 1 ) { // Если есть банк, то показываем ее
														echo "<select name=up_lvl_bank><option value=1>1 ур. - 50 зм<option value=2>2 ур. - 100 зм<option value=3>3 ур. - 150 зм<option value=4>4 ур. - 200 зм<option value=5>5 ур. - 250 зм</select>
<input type=submit class=input value='Улучшить' name=up_bank><br>";
														echo"<br><select name=up_depozit_kol><option value=1>1 ед. - 25 зм<option value=2>2 ед. - 50 зм<option value=3>3 ед. - 75 зм<option value=4>4 ед. - 100 зм<option value=5>5 ед. - 125 зм</select>
<input type=submit class=input value='Повысить' name=kup_depozit>"; }
														elseif ( $stat['lvl_bank'] <= 0 ) {
															echo "<center><input type=submit class=input value='Построить Банк - 150 зм' name=kup_bank></center>"; }
															echo "</form>";
												}
												elseif ($set=="zeml") {
													echo "Действия отсутствуют";
												}
												?></td>
											</tr>
										</table>

										</td>
										<td background='i/rama_14.gif' width='6'>&nbsp;</td>
									</tr>
									<tr>
										<td width='6' height='8'><img src='i/rama_17.gif' width='6'
											height='8' alt=''></td>
										<td width='295' height='8'><img src='i/rama_18.gif'
											width='295' height='8' alt=''></td>
										<td width='6' height='8'><img src='i/rama_19.gif' width='6'
											height='8' alt=''></td>
									</tr>

								</table>



								</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td width='100%' height='25'>
						<table border='0' width='100%' height='25' cellspacing='0'
							cellpadding='0'>
							<tr>
								<td width='51' height='25'><img src='i/inman_b231.gif'
									width='51' height='25' alt=''></td>
								<td background='i/inman_b232.gif'>&nbsp;</td>
								<td width='51' height='25'><img src='i/inman_b233.gif'
									width='51' height='25' alt=''></td>
							</tr>
						</table>

						</td>
					</tr>
				</table>
				</td>
				<td width='22' height='100%'>
				<table border='0' width='22' height='100%' cellspacing='0'
					cellpadding='0'>
					<tr>
						<td width='22' height='25'><img src='i/inman_b21.gif' width='22'
							height='25' alt=''></td>
					</tr>
					<tr>
						<td width='22' height='69'><img src='i/inman_b22.gif' width='22'
							height='69' alt=''></td>
					</tr>
					<tr>
						<td width='22' height='100%' background='i/inman_b23.gif'>&nbsp;</td>
					</tr>
					<tr>
						<td width='22' height='69'><img src='i/inman_b24.gif' width='22'
							height='69' alt=''></td>
					</tr>
					<tr>
						<td width='22' height='25'><img src='i/inman_b25.gif' width='22'
							height='25' alt=''></td>
					</tr>
				</table>


				</td>
			</tr>
		</table>



		</td>
	</tr>
</table>

</body>

<?
}
?>