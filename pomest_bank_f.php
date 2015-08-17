<?
$doxod = ($stat['bank']/100)*$stat['lvl_bank'];
// Начало покупки банка
if ( $kup_bank ) {
	if ( $stat['lvl_bank'] >= 0  ) { // у тебя есть уже банк
		if ( $stat['lvl_pomest'] >= 1 ) { // у тебя нет поместья
			if ( $stat['credits'] >= 100 ) { // хватает ли денег

				mysql_query("UPDATE players set lvl_bank=1, credits=credits-150, depozit=1, depoz=1 where user='".$stat['user']."'");
				mysql_query("INSERT INTO `pomest_bank` (`login` ,`money`) VALUES ('".addslashes($user)."', '0')");
				$bank['money']=0;
				$stat['lvl_bank']=1;
				$stat['depozit']=1;
				$stat['depoz']=1;
				$stat['credits']=$stat['credits']-150;

				$msg="Вы удачно построили Банк"; }

				else $msg="У вас не хватает денег!"; }
				else $msg="Сначала постойте Поместье!"; }
				else $msg="Ошибка! Вы уже купили Банк!"; }
				// Конец покупки фермы





				// Начало покупки депозтов
				if ( $kup_depozit ) {
					$cena_depozit = $up_depozit_kol*25;
					$all_depozit = $stat['depozit']+$up_depozit_kol;
					if ( $stat['lvl_bank'] >= $all_depozit ) { // больше ли у вас фереров чем уровень поместья?
						if ( $stat['credits'] >= $cena_depozit ) { // хватает ли денег

							mysql_query("UPDATE players set depozit=depozit+$up_depozit_kol, credits=credits-$cena_depozit where user='".$stat['user']."'");
							$stat['depozit']=$stat['depozit']+$up_depozit_kol;
							$stat['credits']=$stat['credits']-$cena_depozit;

							$msg="Вы удачно Повысили депозиты на $up_depozit_kol ед."; }

							else $msg="У вас не хватает денег!"; }
							else $msg="Вы не можете повысить депозиты, поднемите уровень Банка!"; }
							// Конец покупки депозитов




							// Начало работы с банком
							if ( $up_bank ) {
								$cena_up_bank = $up_lvl_bank*50; // цена апгрейда банка
								if ( $stat['lvl_bank'] <= $up_lvl_bank  ) { // Выбрал ли ты уровень нормально? а не на 2 более чем можешь улучшить
									if ( $stat['lvl_pomest'] >= $up_lvl_bank ) { // Ты выбрал больше уровень чем можешь апгрейдить
										if ( $stat['lvl_bank'] > 0 ) { // У тебя нет банка
											if ( $stat['lvl_bank'] != $up_lvl_bank ) { // такой же уровень банка какой и был
												if ( $stat['credits'] >= $cena_up_bank ) { // хватает ли денег

													mysql_query("UPDATE players set lvl_bank=$up_lvl_bank, credits=credits-$cena_up_bank where user='".$stat['user']."'");
													$stat['lvl_bank']=$up_lvl_bank;
													$stat['credits']=$stat['credits']-$cena_up_bank;

													$msg="Вы успешно Улучшили Банк до уровня $up_lvl_bank!"; }

													else $msg="У вас не хватает денег!"; }
													else $msg="У вас и так уровень банка равен $up_lvl_bank!"; }
													else $msg="Ошибка, у вас нет банка!"; }
													else $msg="Вам не позволяет улучшить здание, уровень вашего поместья!"; }
													else $msg="Вы не можете уменьшить уровень здания!"; }
													// Конец работы с Банком








													if ( $deposit ) {
														$moneys = round( str_replace( "-", "", $money1 ) );
														if ( $moneys <= $stat['credits'] ) {
															if ( $moneys >= 1 ) {
																if ( $stat['depoz'] != 0 ) {

																	mysql_query("UPDATE players SET credits=credits-$moneys, bank=bank+$moneys, depoz=depoz-1 WHERE user='".$stat['user']."' ");
																	$stat['depoz']=$stat['depoz']-1;
																	$stat['credits']=$stat['credits']-$moneys;
																	$stat['bank']=$stat['bank']+$moneys;

																	$msg="Вы добавили на счёт $moneys золота!"; }

																	else $msg="Сегодня, вы больше не сможете добавить на счёт!"; }
																	else $msg="Введённая сумма не верна!"; }
																	else $msg="У вас недостаточно золота!"; }




																	if ( $withdraw ) {
																		$moneys = round( str_replace( "-", "", $money2 ) );
																		if ( $moneys <= $stat['bank'] ) {
																			if ( $moneys >= 1 ) {

																				mysql_query("UPDATE players SET credits=credits+$moneys, bank=bank-$moneys WHERE user='".$stat['user']."' ");
																				$stat['credits']=$stat['credits']+$moneys;
																				$stat['bank']=$stat['bank']-$moneys;

																				$msg="Вы сняли со счёта $moneys золота!"; }

																				else $msg="Введённая сумма не верна!"; }
																				else $msg="У вас недостаточно золота!"; }

																				?>
