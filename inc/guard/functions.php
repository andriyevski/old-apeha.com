<?php
include('time.php');
$now=time();

// Вывод кнопок
function menu ($title, $fnc, $hr) {
	echo "&nbsp;<input type=button value='".$title."' class=input style='WIDTH: 190px; CURSOR: Hand' onclick=\"".$fnc."();\" onmouseover=\"hint('".$title."');\" onmouseout=\"c();\">&nbsp;";

	if ($hr == 1) echo"<HR color=Silver width=180>";
}

#<HR color=Silver width=159>

/*
 // Вывод таблиц для кнопок
 function e_m ($n1, $fnc1, $n2, $fnc2, $n3, $fnc3, $f_title) {
 echo"<td width=32% align=center valign=top"; if ($n1==10 && $n2==11) echo" colspan=3"; echo">
 <FIELDSET><LEGEND align=center>$f_title</LEGEND>
 <table border=0 cellspacing=0 cellpadding=6 width=100% bordercolor=A5A5A5>
 <tr>
 <td align=center>";
 menu($n1,$fnc1);
 echo"</td>";

 if ($n2 && !empty($fnc2)) { echo"<td align=center>";
 menu($n2,$fnc2);
 echo"</td>";}

 if ($n3 && !empty($fnc3)) { echo"<td align=center>";
 menu($n3,$fnc3);
 echo"</td>";}

 echo"</tr>
 </table>
 </FIELDSET>
 </td>";
 }
 */

// Запись сообщения в ЛД
function ld_m ($t,$u,$w,$r,$m,$s) {
	global $now;
	mysql_query("INSERT INTO ld (user, writer, mess, time, reason, type, srok) values('".addslashes($u)."', '".addslashes($w)."', '".addslashes($m)."', '".$now."', '".addslashes($r)."', '".addslashes($t)."', '".addslashes($s)."')");
}
//




// Функции

// Если задана какая либо операция, то...
if (!empty($view)) {
	// Определение ранга
	if ($stat['rank']>=10 && $stat['rank']<=14) $ranks="Инквизитор";
	elseif ($stat['rank']==98) $ranks="Заместитель Верховного инквизитора";
	elseif ($stat['rank']==99) $ranks="Верховный инквизитор";
	elseif ($stat['rank']==100) $ranks="Ангел";
	//





	// Блок
	if ($view == "blok") {
		if (($stat['rank']>=11 && $stat['rank']<=14) || $stat['rank']>=98) {

			$hinfo = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($id)."'"));

			$reason=trim($reason);

			if (empty($hinfo['user'])) $msg="Пресонаж <u>$id</u> не найден в базе!";
			elseif ($hinfo['user']==$stat['user']) $msg="Вы не можете заблокировать сами себя!";
			elseif ($hinfo['bloked']) $msg="Персонаж <u>$id</u> заблокирован!";
			elseif ($hinfo['rank']==100 && $stat['rank']!=100) $msg="Вы не можете заблокировать Ангела!";
			elseif ($hinfo['rank']==99) $msg="Вы не можете заблокировать Верховного Инквизитора!";

			elseif (($stat['rank']==11 && $hinfo['level']>20) || ($stat['rank']==12 && $hinfo['level']>50)) $msg="Вы не можете заблокировать данного персонажа!";

			elseif (empty($reason) || $reason=="Причина блокировки") $msg="Укажите причину блокировки!";
			else {

				mysql_query("update players set bloked='$this_time $reason' where user='".addslashes($id)."'"); // Блочим

				// Работаем с чатом
				require_once("inc/chat/functions.php");
				insert_msg("$ranks <u><b>".$stat['user']."</b></u> заблокировал персонажа <u><b>".$hinfo[user]."</b></u>","","","1","","",$stat['room']);
				//

				ld_m (1,$hinfo['user'],$stat['user'],$reason,'','');

				$msg="Вы заблокировали <u>$id</u> по причине: $reason";
			}
			#$msgs="<script>blok();</script>";
		}}
		//



		// Разблок
		if ($view == "unblok") {
			if ($stat['rank']==14 || $stat['rank']>=98) {

				$hinfo = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($id)."'"));

				$reason=trim($reason);

				if (empty($hinfo['user'])) $msg="Пресонаж <u>$id</u> не найден в базе!";
				elseif (!$hinfo['bloked']) $msg="Персонаж <u>$id</u> не заблокирован!";

				elseif (empty($reason) || $reason=="Причина разблокировки") $msg="Укажите причину разблокировки!";
				else {
					mysql_query("update players set bloked='' where user='".addslashes($id)."'"); // Разблокируем

					// Работаем с чатом
					require_once("inc/chat/functions.php");
					insert_msg("$ranks <u><b>".$stat['user']."</b></u> разблокировал персонажа <u><b>".$hinfo[user]."</b></u>","","","1","","",$stat['room']);
					//

					ld_m (7,$hinfo[user],$stat[user],$reason,'','');

					$msg="Вы разблокировали <u>$id</u> по причине: $reason";
				}
				#$msgs="<script>unblok();</script>";
			}}
			//



			// Отправка в тюрьму
			if ($view == "turm1mes" || $view == "turm7day") {

				if (($stat['rank']>=11 && $stat['rank']<=14) || $stat['rank']>=98) {

					$hinfo = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($id)."'"));

					$reason=trim($reason);

					if (empty($hinfo['user'])) $msg="Пресонаж <u>$id</u> не найден в базе!";
					elseif ($hinfo['t_time']>$now) $msg="Персонаж уже отбывает срок в тюрьме!";
					elseif ($hinfo['user']==$stat['user'] && $stat[rank]!=100) $msg="Вы не можете отправить в тюрьму сами себя!";
					elseif ($hinfo['rank']==100 && $hinfo['user']!=$stat['user']) $msg="Вы не можете отправить в тюрьму Ангела!";
					elseif (empty($reason) || $reason=="Причина отправки в тюрьму") $msg="Укажите причину отправки в тюрьму!";
					elseif (($stat['rank']==11 && $hinfo['level']>20) || ($stat['rank']==12 && $hinfo['level']>50)) $msg="Вы не можете отправить в тюрьму данного персонажа!";

					else {

						if ($addtime==86400) { $sroks="одни сутки"; }
						elseif ($addtime==172800) { $sroks="двое суток"; }
						elseif ($addtime==604800) { $sroks="одна неделя"; }
						elseif ($addtime==1209600) { $sroks="две недели"; }
						elseif ($addtime==2678400) { $sroks="один месяц"; }

						else $addtime=0;

						if ($addtime>0) {

							mysql_query("update players set t_time=$now+$addtime, reason='$reason', battle=NULL, v_time=NULL, k_time=NULL, room='666' where user='".addslashes($id)."'");

							// Работаем с чатом
							require_once("inc/chat/functions.php");
							insert_msg("$ranks <b><u>".$stat['user']."</u></b> отправил в тюрьму персонажа <b><u>".$hinfo['user']."</u></b>, сроком $sroks","","","1","","",$stat['room']);
							//

							ld_m (3,$hinfo[user],$stat[user],$reason,'',$sroks);

							$msg="Вы отправили в тюрьму персонажа <u>$hinfo[user]</u>";
						} else $msg="Что-то тут не так..."; }
						$msgs="<script>turm();</script>";
				}

			}
			//




			// Освобождение из тюрьмы
			if ($view == "unturm") {
				if ($stat['rank']>=13 || $stat['rank']>=98) {

					$hinfo = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($id)."'"));

					$reason=trim($reason);

					if (empty($hinfo['user'])) $msg="Пресонаж <u>$id</u> не найден в базе!";
					elseif ($hinfo[t_time]<$now) $msg="Персонаж <u>$id</u> не отбывает срок в тюрьме!";

					elseif (empty($reason) || $reason=="Причина освобождения") $msg="Укажите причину освобождения из тюрьмы!";
					else {

						mysql_query("update players set t_time=NULL, reason='', room='0' where user='".addslashes($id)."'");

						// Работаем с чатом
						require_once("inc/chat/functions.php");
						insert_msg("$ranks <b><u>".$stat['user']."</u></b> освободил из тюрьмы персонажа <b><u>".$hinfo['user']."</u></b>","","","1","","",$stat['room']);
						//

						ld_m (6,$hinfo[user],$stat[user],$reason,'','');

						$msg="Вы освободили <u>$hinfo[user]</u> из тюрьмы"; }
						# $msgs="<script>unturm();</script>";
				}}
				//









				// Молчанка
				if ($view == "unchat1ned" || $view == "unchat1sut" || $view == "unchat15min30min" || $view == "unforum1ned") {
					if (($stat['rank']>=10 && $stat['rank']<=14) || $stat['rank']>=98) {

						$hinfo = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($id)."'"));

						$reason=trim($reason);

						if (empty($hinfo['user'])) $msg="Пресонаж <u>$id</u> не найден в базе!";
						else {

							if ($u_type==1) { $ggt="m_time"; $wh="в чате"; $ttp=2; }
							elseif ($u_type==2) { $ggt="f_time"; $wh="на форуме"; $ttp=8; }

							if ($u_type>0 && $u_type<3) {

								if ($hinfo[$ggt]>$now) $msg="На персонажа уже наложен запрет на общение $wh!";
								elseif (empty($reason) || $reason=="Причина запрета на общение") $msg="Укажите причину запрета общения персонажу <u>$id</u>!";
								else {

									if ($u_type==1) {
										if ($addtime=="900") { $sroks="15 минут"; }
										elseif ($addtime=="1800") { $sroks="30 минут"; }
										elseif ($addtime=="3600") { $sroks="1 час"; }
										elseif ($addtime=="10800") { $sroks="3 часа"; }
										elseif ($addtime=="21600") { $sroks="6 часов"; }
										elseif ($addtime=="43200") { $sroks="12 часов"; }
										elseif ($addtime=="86400") { $sroks="одни сутки"; }
										elseif ($addtime=="172800" && (($stat['rank']>=12 && $stat['rank']<=14) || $stat['rank']>=98)) { $sroks="двое суток"; }
										elseif ($addtime=="259200" && (($stat['rank']>=12 && $stat['rank']<=14) || $stat['rank']>=98)) { $sroks="трое суток"; }
										elseif ($addtime=="432000" && ($stat['rank']==14 || $stat['rank']>=98)) { $sroks="пятеро суток"; }
										elseif ($addtime=="604800" && $stat['rank']>=98) { $sroks="одна неделя"; }

										else { $addtime=0; $sroks=""; }
									}

									if ($u_type==2 && (($stat['rank']>=11 && $stat['rank']<=14) || $stat['rank']>=98)) {
										if ($addtime=="3600") { $sroks="1 час"; }
										elseif ($addtime=="10800") { $sroks="3 часа"; }
										elseif ($addtime=="21600") { $sroks="6 часов"; }
										elseif ($addtime=="86400") { $sroks="одни сутки"; }
										elseif ($addtime=="172800" && (($stat['rank']>=12 && $stat['rank']<=14) || $stat['rank']>=98)) { $sroks="двое суток"; }
										elseif ($addtime=="259200" && (($stat['rank']>=12 && $stat['rank']<=14) || $stat['rank']>=98)) { $sroks="трое суток"; }
										elseif ($addtime=="432000" && (($stat['rank']>=13 && $stat['rank']<=14) || $stat['rank']>=98)) { $sroks="пятеро суток"; }
										elseif ($addtime=="604800" && (($stat['rank']>=13 && $stat['rank']<=14) || $stat['rank']>=98)) { $sroks="одна неделя"; }
										elseif ($addtime=="2678400" && ($stat['rank']==14 || $stat['rank']>=98)) { $sroks="один месяц"; }
										elseif ($addtime=="5356800" && $stat['rank']>=98) { $sroks="два месяца"; }

										else { $addtime=0; $sroks=""; }
									}


									if ($addtime>0 && !empty($sroks)) {

										mysql_query("update players set $ggt=$now+$addtime where user='".addslashes($id)."'");

										// Работаем с чатом
										require_once("inc/chat/functions.php");
										insert_msg("$ranks <u><b>".$stat['user']."</b></u> запретил общение $wh персонажу <u><b>".$hinfo[user]."</b></u>, сроком $sroks","","","1","","",$stat['room']);
										//

										ld_m ($ttp,$hinfo[user],$stat[user],$reason,'',$sroks);

										$msg="Вы наложили запрет на общение $wh на персонажа <u>$hinfo[user]</u>";


									} else $msg="Что-то тут не так...";
								}} else $msg="Что-то тут не так...";
						}
						#$msgs="<script>unchat();</script>";
					} else $msg="Что-то тут не так...";
				}
				//






				// Снятие молчанки

				if ($view == "chat") {
					if (($stat['rank']>=10 && $stat['rank']<=14) || $stat['rank']>=98) {

						$hinfo = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($id)."'"));

						$reason=trim($reason);

						if ($u_type==1) { $wh="в чате"; $wht="m_time"; $ttp=5; }
						elseif ($u_type==2 && ($stat['rank']>=11 && $stat['rank']<=14) || $stat['rank']>=98) { $wh="на форуме"; $wht="f_time"; $ttp=9;}

						if ($u_type==1 || ($u_type==2 && ($stat['rank']>=11 && $stat['rank']<=14) || $stat['rank']>=98)) {

							if (empty($hinfo['user'])) $msg="Пресонаж <u>$id</u> не найден в базе!";
							elseif ($hinfo[$wht]<$now) $msg="Персонажу <u>$id</u> не запрещено общение $wh!";
							elseif (empty($reason) || $reason=="Причина снятия запрета") $msg="Укажите причину снятия запрета!";
							else {

								mysql_query("update players set $wht='0' where user='".addslashes($id)."'");


								// Работаем с чатом
								require_once("inc/chat/functions.php");
								insert_msg("$ranks <b><u>".$stat['user']."</u></b> снял запрет на общение $wh с персонажа <b><u>".$hinfo['user']."</u></b>","","","1","","",$stat['room']);
								//




								ld_m ($ttp,$hinfo[user],$stat[user],$reason,'','');
								$msg="Вы сняли запрет на общение $wh с <u>$hinfo[user]</u>"; }

						}

						else $msg="Что-то тут не так...";

						# $msgs="<script>chat();</script>";
					}}
					//


					// Просмотр отчета переводов
					if ($_GET['view'] == "transfer") {
						if (($stat['rank']>=10 && $stat['rank']<=14) || $stat['rank']==40 ||($stat['rank']>=98 && $stat['rank']<=103)) {

							if (!preg_match("/^[-a-zA-Zа-яА-Я0-9_:.,|\[\]{}!*\$\s]+$/",$_POST['id']))
							$msg='Запрещеные символы в "Логин"';
							else{
								$hinfo = mysql_fetch_array(mysql_query("select user, rank from players where user='".addslashes($_POST['id'])."'"));

								if (empty($hinfo['user'])) $msg="Пресонаж <u>".$_POST['id']."</u> не найден в базе!";
								elseif ($hinfo['rank']==100) $msg="Вы не можете просматривать отчет переводов Администратора!";
								else {

									$msg.="<br><center><b>Отчёт переводов персонажа <u>$hinfo[user]</u></b></center><br>";

									$otchet=mysql_query("SELECT * FROM transfers where user='$hinfo[user]' or fr='$hinfo[user]' order by time");

									if ($otchet){
										$msg.="<table width=100% cellspacing=0 cellpadding=3 border=1 bordercolor=cccccc>";
										while ($otchets=mysql_fetch_array($otchet)){
											if ($otchets['credits']>0) $result="Переданы кредиты <u><b>".$otchets['credits']."</b></u> от <b><a href='inf.php?login=".$otchets[fr]."' target=_blank border=0>".($otchets[fr]==$hinfo['user']?"<u>$otchets[fr]</u>":$otchets[fr])."</a></b> к <b><a href='inf.php?login=".$otchets['user']."' target=_blank border=0>".($otchets[user]==$hinfo['user']?"<u>$otchets[user]</u>":$otchets[user])."</a></b>.    Причина <b>$otchets[comment]</b>";
											elseif ($otchets['item']!='') $result="Передан предмет <u><b style='CURSOR: Hand' onclick='iteminfo(\"".$otchets['id']."\");' title='Информация о предмете'>".$otchets['item']."</b></u> (ID: ".$otchets['id'].") от <b><a href='inf.php?login=".$otchets[fr]."' target=_blank border=0>".($otchets[fr]==$hinfo['user']?"<u>$otchets[fr]</u>":$otchets[fr])."</a></b> к <b><a href='inf.php?login=".$otchets['user']."' target=_blank border=0>".($otchets[user]==$hinfo['user']?"<u>$otchets[user]</u>":$otchets[user])."</a></b>.    Причина <b>$otchets[comment]</b>";
											$msg.="
<tr>
<td>
<u>";
											$msg.= date("d.m.y H:i",$otchets[time])."</u>|";
											$msg.=" $result
</td>
</tr>";
										}
										$msg.="</table>";
									}else $msg.="<table width=100% bgcolor=b6b6b6 cellspacing=0 cellpadding=3 border=1 bordercolor=cccccc>
                <tr>
                    <td>
                        <center><b>Переводов не найдено</b></center>
                    </td>
                </tr>
             </table>";

								}
							}
						}
					}
					//

					//
					// Просмотр отчета безопасности
					if ($view == "sequrity") {
						if (($stat['rank']>=10 && $stat['rank']<=14) || $stat['rank']>=98) {

							$hinfo = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($id)."'"));

							if (empty($hinfo['user'])) $msg="Пресонаж <u>$id</u> не найден в базе!";
							elseif ($hinfo['rank']==100) $msg="Вы не можете просматривать отчет безопасности Ангела!";
							elseif ($hinfo['bloked']) $msg="Пресонаж <u>$id</u> заблокирован!";
							else {

								$msq.="<br><center><b>Отчёт безопасности персонажа <u>$hinfo[user]</u></b></center><br>";

								$otchet=mysql_query("SELECT * FROM security WHERE user='".addslashes($id)."' order by id desc");

								$msq.="<table width=100% bgcolor=e2e0e0 cellspacing=0 cellpadding=3 border=1 bordercolor=cccccc>";
								for ($i=0; $i<mysql_num_rows($otchet); $i++) {
									$otchets=mysql_fetch_array($otchet);
									if ($otchets['result']==0) $result="";
									elseif ($otchets['result']==1) $result="Вход в систему успешный<br>";
									elseif ($otchets['result']==2) $result="<b><font color=red>Неверный пароль!</font></b><br>";
									$msq.="
<tr>
<td>
<u>";
									$msg.= date("d.m.y H:i",$otchets[id]);
									$msg.="</u> | IP: <b>$otchets[ip]</b> | $result
</td>
</tr>";
								}
								$msg.="</table>";

							}
							#$msgs.="<script>sequrity();</script>";
						}}
						//

						// Выписать штраф
						if ($view == "shtraf") {
							if ($stat['rank']>=10) {

								$hinfo = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($id)."'"));

								if (empty($hinfo['user'])) $msg="Пресонаж <u>$id</u> не найден в базе!";
								elseif ($hinfo['bloked']) $msg="Персонаж <u>$id</u> заблокирован!";
								elseif ($hinfo['user']==$stat['user']) $msg="Вы не можете штрафовать сами себя!";
								elseif ($hinfo['rank']==100 && $stat['rank']!=100) $msg="Вы не можете оштрафовать Ангела!";
								elseif ($hinfo['rank']==99) $msg="Вы не можете оштрафовать Верховного инквизитора!";
								elseif ($hinfo['rank']==98) $msg="Вы не можете оштрафовать заместителя Верховного инквизитора!";
								elseif ($hinfo['rank']==101) $msg="<u>$id</u> не подлежит штрафу!";
								elseif ($hinfo['credits']<=$SCredits) $msg="Вы неможете отнять у бедного <u>$id</u> последние копейки!";

								else
								{
									mysql_query("update players set credits=credits-$SCredits where user='$hinfo[user]'");
									// Работаем с чатом
									require_once("inc/chat/functions.php");
									insert_msg("$ranks <b><u>".$stat['user']."</u></b> Выписал  штраф на сумму <b>$SCredits зм.</b> персонажу <b><u>".$hinfo['user']."</u></b>","","","1","","",$stat['room']);
									//

									$msg=" Выписан штраф в размере <b><u>$SCredits зм.</u></b>!";
									$msgld="Инквизитор <b>$stat[user]</b> выписал штраф в размере <b><u>$SCredits зм.";

									ld_m (4,$hinfo[user],$stat[user],'',$msgld,'');

									#$msgs="<script>shtraf();</script>";
								}} }
								//


								// Запись в лд
								if ($view == "ldpost") {
									if (($stat['rank']>=10 && $stat['rank']<=14) || $stat['rank']>=98) {

										$hinfo = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($id)."'"));

										if (empty($hinfo['user'])) $msg="Пресонаж <u>$id</u> не найден в базе!";
										elseif ($hinfo['rank']==100) $msg="Вы не можете добавлять записи с личне дело Ангела!";
										elseif ($hinfo['bloked']) $msg="Пресонаж <u>$id</u> заблокирован!";
										else {

											ld_m (4,$hinfo[user],$stat[user],$reason,$mess,'');

											$msg="Вы сделали пометку в личном деле персонажа <u>$id</u>";
										}
										#$msgs="<script>ldpost();</script>";
									}}
									//






									// Проверка
									if ($view == "ic") {
										if ($stat['rank'] == 14 || $stat['rank'] >= 98) {
											$hinfo = mysql_fetch_array(mysql_query("SELECT user, bloked, ic, room, id FROM players WHERE user='".addslashes($id)."'"));

											if (empty($hinfo['user']))
											$msg = "Пресонаж <u>".$id."</u> не найден в базе!";
											elseif ($hinfo['bloked'])
											$msg = "Пресонаж <u>".$id."</u> заблокирован!";
											elseif ($hinfo['ic'] > $now)
											$msg = "У персонажа ещё действительна предыдущая проверка!";
											else {

												if (mysql_query("UPDATE players SET ic=".(time()+259200)." WHERE user='".$hinfo['user']."'")) {
													ld_m (4,$hinfo['user'],$stat['user'],'',"Помечено, что <U>".$hinfo['user']."</U> чист перед законом.",'');

													require_once("inc/chat/functions.php");
													insert_msg("Проверка у <U>Инквизиторов</U> пройдена удачно. У Вас есть 3 суток для вступления в клан.","","","1",$hinfo['user'],"",$hinfo['room']);

													$msg = "Вы пометили, что персонаж <u>".$id."</u> чист перед законом.";
												}
											}
										}
									}
									//




									// Новый инквизитор
									if ($view == "new_enq") {
										if ($stat['rank']>=13 || $stat['rank']>=98) {

											$hinfo = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($id)."'"));

											if (empty($hinfo['user'])) $msg="Пресонаж <u>$id</u> не найден в базе!";
											elseif ($hinfo['bloked']) $msg="Персонаж <u>$id</u> заблокирован!";
											elseif (($hinfo['rank']>=10 && $hinfo['rank']<=14) && $hinfo['rank']>=98) $msg="Персонаж уже состоит в ордене Инквизиции, для изменения статуса воспользуйтесь функцией \"Изменить ранг\"!";
											elseif ($rank!=10 && $rank!=11 && $rank!=12 && $rank!=13 && $rank!=14) $msg="Что-то тут не так...";
											elseif ($stat['rank']< $rank) $msg="Вы не можете принять в инквизицию персонажа с таким статусом";

											else {

												mysql_query("UPDATE players set rank=$rank where user='$hinfo[user]'");

												$msg="Вы приняли <u>$hinfo[user]</u> в орден Инквизиции в ранге $rank!";
												$msgld="Инквизитор <b>$stat[user]</b> принял <u>$hinfo[user]</u> в орден Инквизиции в ранге $rank!";

												ld_m (4,$hinfo[user],$stat[user],'',$msgld,'');
											}
											#$msgs="<script>new_enq();</script>";
										}}
										//



										// Исключение инквизитора
										if ($view == "del_enq") {
											if ($stat['rank']>=13 || $stat['rank']>=98) {

												$hinfo = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($id)."'"));

												if (empty($hinfo['user'])) $msg="Пресонаж <u>$id</u> не найден в базе!";
												elseif ($hinfo['rank']!=10 && $hinfo['rank']!=11 && $hinfo['rank']!=12 && $hinfo['rank']!=13 && $hinfo['rank']!=14) $msg="Персонаж не состоит в ордене Инквизиции!";
												elseif ($stat['rank']<= $hinfo['rank']) $msg="Вы не можете исключить из инквизиции персонажа с статусом выше вашего";

												else {

													mysql_query("UPDATE players set rank=0 where user='".$hinfo['user']."' LIMIT 1");

													$msg="Вы исключили <u>$hinfo[user]</u> из ордена Инквизиции!";
													$msgld="Инквизитор <b>$stat[user]</b> исключил <u>$hinfo[user]</u> из ордена Инквизиции!";

													ld_m (4,$hinfo[user],$stat[user],'',$msgld,'');
												}
												#$msgs="<script>del_enq();</script>";
											}}
											//





											// Изменение ранга инквизитора
											if ($view == "ch_enq") {
												if ($stat['rank']>=13 || $stat['rank']>=98) {

													$hinfo = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($id)."'"));

													if (empty($hinfo['user'])) $msg="Пресонаж <u>$id</u> не найден в базе!";
													elseif ($hinfo['rank']!=10 && $hinfo['rank']!=11 && $hinfo['rank']!=12 && $hinfo['rank']!=13 && $hinfo['rank']!=14) $msg="Персонаж не состоит в ордене Инквизиции!";
													elseif ($rank!=10 && $rank!=11 && $rank!=12 && $rank!=13 && $rank!=14) $msg="Что-то тут не так...";
													elseif ($stat['rank']<= $rank || $stat['rank']== 14 && $rank ==13) $msg="Вы не можете принять в инквизицию персонажа с таким статусом";
													elseif ($stat['rank']<= $hinfo['rank']) $msg="Вы не можете принять в инквизицию персонажа с статусом выше вашего";
													elseif ($stat['rank']<= $hinfo['rank']) $msg="Вы не можете изменить ранг персонажа с статусом выше вашего";
													else {

														mysql_query("UPDATE players set rank=$rank where user='".$hinfo['user']."'");

														$msg="Вы изменили ранг инквизитора <u>$hinfo[user]</u>!";
														$msgld="Инквизитор <b>$stat[user]</b> изменил ранг инквизитора <u>$hinfo[user]</u>!";

														ld_m (4,$hinfo[user],$stat[user],'',$msgld,'');
													}
													#$msgs="<script>ch_enq();</script>";
												}}
												//





}


// Конец всех операций
?>

