<?
// Начало покупки ремонтной мастерской
if ( $kup_repair ) {
	if ( $stat['lvl_repair'] >= 0  ) { // у тебя есть уже мастерская
		if ( $stat['lvl_pomest'] >= 1 ) { // у тебя нет поместья
			if ( $stat['credits'] >= 100 ) { // хватает ли денег

				mysql_query("UPDATE players set lvl_repair=1, credits=credits-100 where user='".$stat['user']."'");
				$stat['lvl_repair']=1;
				$stat['credits']=$stat['credits']-100;
				$msg="Вы удачно построили Ремонтную Мастерскую"; }
				else $msg="У вас не хватает денег!"; }
				else $msg="Сначала постойте Поместье!"; }
				else $msg="Ошибка! Вы уже построили Ремонтную Мастерскую!"; }
				// Конец покупки поместья

				// Начало работы с Ремонтной Мастерсой
				if ( $up_repair ) {
					$cena_up_repair = $up_lvl_repair*30; // цена апгрейда
					if ( $stat['lvl_repair'] <= $up_lvl_repair ) { // Выбрал ли ты уровень нормально? а не на 2 более чем можешь улучшить
						if ( $stat['lvl_pomest'] >= $up_lvl_repair ) { // Ты выбрал больше уровень чем можешь апгрейдить
							if ( $stat['lvl_repair'] > 0 ) { // У тебя нет Ремонтной Мастерсой
								if ( $stat['lvl_repair'] != $up_lvl_repair ) { // такой же уровень поместья какой и был
									if ( $stat['credits'] >= $cena_up_repair ) { // хватает ли денег

										mysql_query("UPDATE players set lvl_repair=$up_lvl_repair, credits=credits-$cena_up_repair where user='".$stat['user']."'");
										$stat['lvl_repair']=$up_lvl_repair;
										$stat['credits']=$stat['credits']-$cena_up_repair;

										$msg="Вы успешно Улучшили Поместье до уровня $up_lvl_repair!"; }

										else $msg="У вас не хватает денег!"; }
										else $msg="У вас и так уровень Ремонтной Мастерсой равен $up_lvl_repair!"; }
										else $msg="Ошибка, у вас нет Ремонтной Мастерсой!"; }
										else $msg="Вам не позволяет улучшить здание, уровень вашего поместья!"; }
										else $msg="Вы не можете уменьшить уровень здания!"; }
										// Конец работы с Ремонтной Мастерсой

										// Начало покупки работников Ремонтной Мастерсой
										if ( $kup_repairs ) {
											$cena_repairs = $up_repairs_kol*125;
											$all_repairs = $stat['kol_repair']+$up_repairs_kol;
											if ( $stat['lvl_repair'] >= $all_repairs ) { // больше ли у вас работников Ремонтной Мастерсой чем уровень поместья?
												if ( $stat['credits'] >= $cena_repairs ) { // хватает ли денег

													mysql_query("UPDATE players set kol_repair=kol_repair+$up_repairs_kol, credits=credits-$cena_repairs where user='".$stat['user']."'");
													$stat['kol_repair']=$stat['kol_repair']+$up_repairs_kol;
													$stat['credits']=$stat['credits']-$cena_repairs;

													$msg="Вы удачно наняли $up_pomests_kol чел. работников"; }

													else $msg="У вас не хватает денег!"; }
													else $msg="Вы не можете нанять больше работников, поднемите уровень Мастерской!"; }
													// Конец покупки работников Ремонтной Мастерсой

													// Начало увольнения работников Ремонтной Мастерсой
													if ( $del_repairs ) {
														if ( $stat['kol_repair'] >= $del_repairs_kol ) { // больше ли у вас работников Ремонтной Мастерсой чем уровень поместья?

															mysql_query("UPDATE players set kol_repair=kol_repair-$del_repairs_kol where user='".$stat['user']."'");
															$stat['kol_repair']=$stat['kol_repair']-$del_repairs_kol;

															$msg="Вы удачно уволили $del_repairs_kol чел. работников Ремонтной Мастерсой"; }

															else $msg="Ошибка, вы выбрали неверное кол-во работников на увольнение!"; }
															// Конец увольнения работников Ремонтной Мастерсой

															?>