<?
// Начало покупки фермы
if ( $kup_ferm ) {
	if ( $stat['lvl_ferm'] >= 0  ) { // у тебя есть уже ферма
		if ( $stat['lvl_pomest'] >= 1 ) { // у тебя нет поместья
			if ( $stat['credits'] >= 100 ) { // хватает ли денег

				mysql_query("UPDATE players set lvl_ferm=1, credits=credits-100 where user='".$stat['user']."'");
				$stat['lvl_ferm']=1;
				$stat['credits']=$stat['credits']-100;
				$msg="Вы удачно построили ферму"; }

				else $msg="У вас не хватает денег!"; }
				else $msg="Сначала постойте Поместье!"; }
				else $msg="Ошибка! Вы уже купили ферму!"; }
				// Конец покупки фермы

				// Начало покупки фермеров
				if ( $kup_fermers ) {
					$cena_fermers = $up_fermers_kol*100;
					$all_fermers = $stat['kol_ferm']+$up_fermers_kol;
					if ( $stat['lvl_ferm'] >= $all_fermers ) { // больше ли у вас фереров чем уровень поместья?
						if ( $stat['credits'] >= $cena_fermers ) { // хватает ли денег

							mysql_query("UPDATE players set kol_ferm=kol_ferm+$up_fermers_kol, credits=credits-$cena_fermers where user='".$stat['user']."'");
							$stat['kol_ferm']=$stat['kol_ferm']+$up_fermers_kol;
							$stat['credits']=$stat['credits']-$cena_fermers;

							$msg="Вы удачно наняли $up_fermers_kol чел. фермеров"; }

							else $msg="У вас не хватает денег!"; }
							else $msg="Вы не можете нанять больше фермеров, поднемите уровень фермы!"; }
							// Конец покупки фермеров

							// Начало работы с фермой
							if ( $up_ferm ) {
								$cena_up_ferma = $up_lvl_ferm*25; // цена апгрейда фермы
								if ( $stat['lvl_ferm'] <= $up_lvl_ferm  ) { // Выбрал ли ты уровень нормально? а не на 2 более чем можешь улучшить
									if ( $stat['lvl_pomest'] >= $up_lvl_ferm ) { // Ты выбрал больше уровень чем можешь апгрейдить
										if ( $stat['lvl_ferm'] > 0 ) { // У тебя нет фермы
											if ( $stat['lvl_ferm'] != $up_lvl_ferm ) { // такой же уровень фермы какой и был
												if ( $stat['credits'] >= $cena_up_ferma ) { // хватает ли денег

													mysql_query("UPDATE players set lvl_ferm=$up_lvl_ferm, credits=credits-$cena_up_ferma where user='".$stat['user']."'");
													$stat['lvl_ferm']=$up_lvl_ferm;
													$stat['credits']=$stat['credits']-$cena_up_ferma;

													$msg="Вы успешно Улучшили Ферму до уровня $up_lvl_ferm!"; }

													else $msg="У вас не хватает денег!"; }
													else $msg="У вас и так уровень фермы равен $up_lvl_ferm!"; }
													else $msg="Ошибка, у вас нет фермы!"; }
													else $msg="Вам не позволяет улучшить здание, уровень вашего поместья!"; }
													else $msg="Вы не можете уменьшить уровень здания!"; }
													// Конец работы с фермой

													// Начало увольнения фермеров
													if ( $del_fermers ) {
														if ( $stat['kol_ferm'] >= $del_fermers_kol ) { // больше ли у вас работников поместья чем уровень поместья?

															mysql_query("UPDATE players set kol_ferm=kol_ferm-$del_fermers_kol where user='".$stat['user']."'");
															$stat['kol_ferm']=$stat['kol_ferm']-$del_fermers_kol;

															$msg="Вы удачно уволили $del_fermers_kol чел. фермеров"; }

															else $msg="Ошибка, вы выбрали неверное кол-во фермеров на увольнение!"; }
															// Конец увольнения фермеров
															?>