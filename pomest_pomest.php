<?

// Начало покупки поместья
if ( $kup_pomest ) {
	if ( $stat['lvl_pomest'] >= 0  ) { // у тебя есть уже поместье
		if ( $stat['credits'] >= 150 ) { // хватает ли денег

			mysql_query("UPDATE players set lvl_pomest=1, credits=credits-150 where user='".$stat['user']."'");
			$stat['lvl_pomest']=1;
			$stat['credits']=$stat['credits']-150;

			$msg="Вы удачно построили Поместье"; }

			else $msg="У вас не хватает денег!"; }
			else $msg="Ошибка! Вы уже построили Поместье!"; }
			// Конец покупки поместья

			// Начало работы с поместьем
			if ( $up_pomest ) {
				$cena_up_pomest = $up_lvl_pomest*50; // цена апгрейда
				if ( $stat['lvl_pomest'] <= $up_lvl_pomest  ) { // Выбрал ли ты уровень нормально? а не на 2 более чем можешь улучшить
					if ( $stat['lvl_pomest'] > 0 ) { // У тебя нет фермы
						if ( $stat['lvl_pomest'] != $up_lvl_pomest ) { // такой же уровень поместья какой и был
							if ( $stat['credits'] >= $cena_up_pomest ) { // хватает ли денег

								mysql_query("UPDATE players set lvl_pomest=$up_lvl_pomest, credits=credits-$cena_up_pomest where user='".$stat['user']."'");
								$stat['lvl_pomest']=$up_lvl_pomest;
								$stat['credits']=$stat['credits']-$cena_up_pomest;

								$msg="Вы успешно Улучшили Поместье до уровня $up_lvl_pomest!"; }

								else $msg="У вас не хватает денег!"; }
								else $msg="У вас и так уровень поместья равен $up_lvl_pomest!"; }
								else $msg="Ошибка, у вас нет поместья!"; }
								else $msg="Вы не можете уменьшить уровень здания!"; }
								// Конец работы с поместьем

								// Начало покупки работников поместья
								if ( $kup_pomests ) {
									$cena_pomests = $up_pomests_kol*50;
									$all_pomests = $stat['kol_pomest']+$up_pomests_kol;
									if ( $stat['lvl_pomest'] >= $all_pomests ) { // больше ли у вас работников поместья чем уровень поместья?
										if ( $stat['credits'] >= $cena_pomests ) { // хватает ли денег

											mysql_query("UPDATE players set kol_pomest=kol_pomest+$up_pomests_kol, credits=credits-$cena_pomests where user='".$stat['user']."'");
											$stat['kol_pomest']=$stat['kol_pomest']+$up_pomests_kol;
											$stat['credits']=$stat['credits']-$cena_pomests;

											$msg="Вы удачно наняли $up_pomests_kol чел. работников поместья"; }

											else $msg="У вас не хватает денег!"; }
											else $msg="Вы не можете нанять больше работников, поднемите уровень поместья!"; }
											// Конец покупки работников поместья

											// Начало увольнения работников поместья
											if ( $del_pomests ) {
												if ( $stat['kol_pomest'] >= $del_pomests_kol ) { // больше ли у вас работников поместья чем уровень поместья?

													mysql_query("UPDATE players set kol_pomest=kol_pomest-$del_pomests_kol where user='".$stat['user']."'");
													$stat['kol_pomest']=$stat['kol_pomest']-$del_pomests_kol;

													$msg="Вы удачно уволили $del_pomests_kol чел. работников Поместья"; }

													else $msg="Ошибка, вы выбрали неверное кол-во работников на увольнение!"; }
													// Конец увольнения работников поместья



													?>