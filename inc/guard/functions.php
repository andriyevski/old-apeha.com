<?php
include('time.php');
$now=time();

// ����� ������
function menu ($title, $fnc, $hr) {
	echo "&nbsp;<input type=button value='".$title."' class=input style='WIDTH: 190px; CURSOR: Hand' onclick=\"".$fnc."();\" onmouseover=\"hint('".$title."');\" onmouseout=\"c();\">&nbsp;";

	if ($hr == 1) echo"<HR color=Silver width=180>";
}

#<HR color=Silver width=159>

/*
 // ����� ������ ��� ������
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

// ������ ��������� � ��
function ld_m ($t,$u,$w,$r,$m,$s) {
	global $now;
	mysql_query("INSERT INTO ld (user, writer, mess, time, reason, type, srok) values('".addslashes($u)."', '".addslashes($w)."', '".addslashes($m)."', '".$now."', '".addslashes($r)."', '".addslashes($t)."', '".addslashes($s)."')");
}
//




// �������

// ���� ������ ����� ���� ��������, ��...
if (!empty($view)) {
	// ����������� �����
	if ($stat['rank']>=10 && $stat['rank']<=14) $ranks="����������";
	elseif ($stat['rank']==98) $ranks="����������� ���������� �����������";
	elseif ($stat['rank']==99) $ranks="��������� ����������";
	elseif ($stat['rank']==100) $ranks="�����";
	//





	// ����
	if ($view == "blok") {
		if (($stat['rank']>=11 && $stat['rank']<=14) || $stat['rank']>=98) {

			$hinfo = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($id)."'"));

			$reason=trim($reason);

			if (empty($hinfo['user'])) $msg="�������� <u>$id</u> �� ������ � ����!";
			elseif ($hinfo['user']==$stat['user']) $msg="�� �� ������ ������������� ���� ����!";
			elseif ($hinfo['bloked']) $msg="�������� <u>$id</u> ������������!";
			elseif ($hinfo['rank']==100 && $stat['rank']!=100) $msg="�� �� ������ ������������� ������!";
			elseif ($hinfo['rank']==99) $msg="�� �� ������ ������������� ���������� �����������!";

			elseif (($stat['rank']==11 && $hinfo['level']>20) || ($stat['rank']==12 && $hinfo['level']>50)) $msg="�� �� ������ ������������� ������� ���������!";

			elseif (empty($reason) || $reason=="������� ����������") $msg="������� ������� ����������!";
			else {

				mysql_query("update players set bloked='$this_time $reason' where user='".addslashes($id)."'"); // ������

				// �������� � �����
				require_once("inc/chat/functions.php");
				insert_msg("$ranks <u><b>".$stat['user']."</b></u> ������������ ��������� <u><b>".$hinfo[user]."</b></u>","","","1","","",$stat['room']);
				//

				ld_m (1,$hinfo['user'],$stat['user'],$reason,'','');

				$msg="�� ������������� <u>$id</u> �� �������: $reason";
			}
			#$msgs="<script>blok();</script>";
		}}
		//



		// �������
		if ($view == "unblok") {
			if ($stat['rank']==14 || $stat['rank']>=98) {

				$hinfo = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($id)."'"));

				$reason=trim($reason);

				if (empty($hinfo['user'])) $msg="�������� <u>$id</u> �� ������ � ����!";
				elseif (!$hinfo['bloked']) $msg="�������� <u>$id</u> �� ������������!";

				elseif (empty($reason) || $reason=="������� �������������") $msg="������� ������� �������������!";
				else {
					mysql_query("update players set bloked='' where user='".addslashes($id)."'"); // ������������

					// �������� � �����
					require_once("inc/chat/functions.php");
					insert_msg("$ranks <u><b>".$stat['user']."</b></u> ������������� ��������� <u><b>".$hinfo[user]."</b></u>","","","1","","",$stat['room']);
					//

					ld_m (7,$hinfo[user],$stat[user],$reason,'','');

					$msg="�� �������������� <u>$id</u> �� �������: $reason";
				}
				#$msgs="<script>unblok();</script>";
			}}
			//



			// �������� � ������
			if ($view == "turm1mes" || $view == "turm7day") {

				if (($stat['rank']>=11 && $stat['rank']<=14) || $stat['rank']>=98) {

					$hinfo = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($id)."'"));

					$reason=trim($reason);

					if (empty($hinfo['user'])) $msg="�������� <u>$id</u> �� ������ � ����!";
					elseif ($hinfo['t_time']>$now) $msg="�������� ��� �������� ���� � ������!";
					elseif ($hinfo['user']==$stat['user'] && $stat[rank]!=100) $msg="�� �� ������ ��������� � ������ ���� ����!";
					elseif ($hinfo['rank']==100 && $hinfo['user']!=$stat['user']) $msg="�� �� ������ ��������� � ������ ������!";
					elseif (empty($reason) || $reason=="������� �������� � ������") $msg="������� ������� �������� � ������!";
					elseif (($stat['rank']==11 && $hinfo['level']>20) || ($stat['rank']==12 && $hinfo['level']>50)) $msg="�� �� ������ ��������� � ������ ������� ���������!";

					else {

						if ($addtime==86400) { $sroks="���� �����"; }
						elseif ($addtime==172800) { $sroks="���� �����"; }
						elseif ($addtime==604800) { $sroks="���� ������"; }
						elseif ($addtime==1209600) { $sroks="��� ������"; }
						elseif ($addtime==2678400) { $sroks="���� �����"; }

						else $addtime=0;

						if ($addtime>0) {

							mysql_query("update players set t_time=$now+$addtime, reason='$reason', battle=NULL, v_time=NULL, k_time=NULL, room='666' where user='".addslashes($id)."'");

							// �������� � �����
							require_once("inc/chat/functions.php");
							insert_msg("$ranks <b><u>".$stat['user']."</u></b> �������� � ������ ��������� <b><u>".$hinfo['user']."</u></b>, ������ $sroks","","","1","","",$stat['room']);
							//

							ld_m (3,$hinfo[user],$stat[user],$reason,'',$sroks);

							$msg="�� ��������� � ������ ��������� <u>$hinfo[user]</u>";
						} else $msg="���-�� ��� �� ���..."; }
						$msgs="<script>turm();</script>";
				}

			}
			//




			// ������������ �� ������
			if ($view == "unturm") {
				if ($stat['rank']>=13 || $stat['rank']>=98) {

					$hinfo = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($id)."'"));

					$reason=trim($reason);

					if (empty($hinfo['user'])) $msg="�������� <u>$id</u> �� ������ � ����!";
					elseif ($hinfo[t_time]<$now) $msg="�������� <u>$id</u> �� �������� ���� � ������!";

					elseif (empty($reason) || $reason=="������� ������������") $msg="������� ������� ������������ �� ������!";
					else {

						mysql_query("update players set t_time=NULL, reason='', room='0' where user='".addslashes($id)."'");

						// �������� � �����
						require_once("inc/chat/functions.php");
						insert_msg("$ranks <b><u>".$stat['user']."</u></b> ��������� �� ������ ��������� <b><u>".$hinfo['user']."</u></b>","","","1","","",$stat['room']);
						//

						ld_m (6,$hinfo[user],$stat[user],$reason,'','');

						$msg="�� ���������� <u>$hinfo[user]</u> �� ������"; }
						# $msgs="<script>unturm();</script>";
				}}
				//









				// ��������
				if ($view == "unchat1ned" || $view == "unchat1sut" || $view == "unchat15min30min" || $view == "unforum1ned") {
					if (($stat['rank']>=10 && $stat['rank']<=14) || $stat['rank']>=98) {

						$hinfo = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($id)."'"));

						$reason=trim($reason);

						if (empty($hinfo['user'])) $msg="�������� <u>$id</u> �� ������ � ����!";
						else {

							if ($u_type==1) { $ggt="m_time"; $wh="� ����"; $ttp=2; }
							elseif ($u_type==2) { $ggt="f_time"; $wh="�� ������"; $ttp=8; }

							if ($u_type>0 && $u_type<3) {

								if ($hinfo[$ggt]>$now) $msg="�� ��������� ��� ������� ������ �� ������� $wh!";
								elseif (empty($reason) || $reason=="������� ������� �� �������") $msg="������� ������� ������� ������� ��������� <u>$id</u>!";
								else {

									if ($u_type==1) {
										if ($addtime=="900") { $sroks="15 �����"; }
										elseif ($addtime=="1800") { $sroks="30 �����"; }
										elseif ($addtime=="3600") { $sroks="1 ���"; }
										elseif ($addtime=="10800") { $sroks="3 ����"; }
										elseif ($addtime=="21600") { $sroks="6 �����"; }
										elseif ($addtime=="43200") { $sroks="12 �����"; }
										elseif ($addtime=="86400") { $sroks="���� �����"; }
										elseif ($addtime=="172800" && (($stat['rank']>=12 && $stat['rank']<=14) || $stat['rank']>=98)) { $sroks="���� �����"; }
										elseif ($addtime=="259200" && (($stat['rank']>=12 && $stat['rank']<=14) || $stat['rank']>=98)) { $sroks="���� �����"; }
										elseif ($addtime=="432000" && ($stat['rank']==14 || $stat['rank']>=98)) { $sroks="������ �����"; }
										elseif ($addtime=="604800" && $stat['rank']>=98) { $sroks="���� ������"; }

										else { $addtime=0; $sroks=""; }
									}

									if ($u_type==2 && (($stat['rank']>=11 && $stat['rank']<=14) || $stat['rank']>=98)) {
										if ($addtime=="3600") { $sroks="1 ���"; }
										elseif ($addtime=="10800") { $sroks="3 ����"; }
										elseif ($addtime=="21600") { $sroks="6 �����"; }
										elseif ($addtime=="86400") { $sroks="���� �����"; }
										elseif ($addtime=="172800" && (($stat['rank']>=12 && $stat['rank']<=14) || $stat['rank']>=98)) { $sroks="���� �����"; }
										elseif ($addtime=="259200" && (($stat['rank']>=12 && $stat['rank']<=14) || $stat['rank']>=98)) { $sroks="���� �����"; }
										elseif ($addtime=="432000" && (($stat['rank']>=13 && $stat['rank']<=14) || $stat['rank']>=98)) { $sroks="������ �����"; }
										elseif ($addtime=="604800" && (($stat['rank']>=13 && $stat['rank']<=14) || $stat['rank']>=98)) { $sroks="���� ������"; }
										elseif ($addtime=="2678400" && ($stat['rank']==14 || $stat['rank']>=98)) { $sroks="���� �����"; }
										elseif ($addtime=="5356800" && $stat['rank']>=98) { $sroks="��� ������"; }

										else { $addtime=0; $sroks=""; }
									}


									if ($addtime>0 && !empty($sroks)) {

										mysql_query("update players set $ggt=$now+$addtime where user='".addslashes($id)."'");

										// �������� � �����
										require_once("inc/chat/functions.php");
										insert_msg("$ranks <u><b>".$stat['user']."</b></u> �������� ������� $wh ��������� <u><b>".$hinfo[user]."</b></u>, ������ $sroks","","","1","","",$stat['room']);
										//

										ld_m ($ttp,$hinfo[user],$stat[user],$reason,'',$sroks);

										$msg="�� �������� ������ �� ������� $wh �� ��������� <u>$hinfo[user]</u>";


									} else $msg="���-�� ��� �� ���...";
								}} else $msg="���-�� ��� �� ���...";
						}
						#$msgs="<script>unchat();</script>";
					} else $msg="���-�� ��� �� ���...";
				}
				//






				// ������ ��������

				if ($view == "chat") {
					if (($stat['rank']>=10 && $stat['rank']<=14) || $stat['rank']>=98) {

						$hinfo = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($id)."'"));

						$reason=trim($reason);

						if ($u_type==1) { $wh="� ����"; $wht="m_time"; $ttp=5; }
						elseif ($u_type==2 && ($stat['rank']>=11 && $stat['rank']<=14) || $stat['rank']>=98) { $wh="�� ������"; $wht="f_time"; $ttp=9;}

						if ($u_type==1 || ($u_type==2 && ($stat['rank']>=11 && $stat['rank']<=14) || $stat['rank']>=98)) {

							if (empty($hinfo['user'])) $msg="�������� <u>$id</u> �� ������ � ����!";
							elseif ($hinfo[$wht]<$now) $msg="��������� <u>$id</u> �� ��������� ������� $wh!";
							elseif (empty($reason) || $reason=="������� ������ �������") $msg="������� ������� ������ �������!";
							else {

								mysql_query("update players set $wht='0' where user='".addslashes($id)."'");


								// �������� � �����
								require_once("inc/chat/functions.php");
								insert_msg("$ranks <b><u>".$stat['user']."</u></b> ���� ������ �� ������� $wh � ��������� <b><u>".$hinfo['user']."</u></b>","","","1","","",$stat['room']);
								//




								ld_m ($ttp,$hinfo[user],$stat[user],$reason,'','');
								$msg="�� ����� ������ �� ������� $wh � <u>$hinfo[user]</u>"; }

						}

						else $msg="���-�� ��� �� ���...";

						# $msgs="<script>chat();</script>";
					}}
					//


					// �������� ������ ���������
					if ($_GET['view'] == "transfer") {
						if (($stat['rank']>=10 && $stat['rank']<=14) || $stat['rank']==40 ||($stat['rank']>=98 && $stat['rank']<=103)) {

							if (!preg_match("/^[-a-zA-Z�-��-�0-9_:.,|\[\]{}!*\$\s]+$/",$_POST['id']))
							$msg='���������� ������� � "�����"';
							else{
								$hinfo = mysql_fetch_array(mysql_query("select user, rank from players where user='".addslashes($_POST['id'])."'"));

								if (empty($hinfo['user'])) $msg="�������� <u>".$_POST['id']."</u> �� ������ � ����!";
								elseif ($hinfo['rank']==100) $msg="�� �� ������ ������������� ����� ��������� ��������������!";
								else {

									$msg.="<br><center><b>����� ��������� ��������� <u>$hinfo[user]</u></b></center><br>";

									$otchet=mysql_query("SELECT * FROM transfers where user='$hinfo[user]' or fr='$hinfo[user]' order by time");

									if ($otchet){
										$msg.="<table width=100% cellspacing=0 cellpadding=3 border=1 bordercolor=cccccc>";
										while ($otchets=mysql_fetch_array($otchet)){
											if ($otchets['credits']>0) $result="�������� ������� <u><b>".$otchets['credits']."</b></u> �� <b><a href='inf.php?login=".$otchets[fr]."' target=_blank border=0>".($otchets[fr]==$hinfo['user']?"<u>$otchets[fr]</u>":$otchets[fr])."</a></b> � <b><a href='inf.php?login=".$otchets['user']."' target=_blank border=0>".($otchets[user]==$hinfo['user']?"<u>$otchets[user]</u>":$otchets[user])."</a></b>.    ������� <b>$otchets[comment]</b>";
											elseif ($otchets['item']!='') $result="������� ������� <u><b style='CURSOR: Hand' onclick='iteminfo(\"".$otchets['id']."\");' title='���������� � ��������'>".$otchets['item']."</b></u> (ID: ".$otchets['id'].") �� <b><a href='inf.php?login=".$otchets[fr]."' target=_blank border=0>".($otchets[fr]==$hinfo['user']?"<u>$otchets[fr]</u>":$otchets[fr])."</a></b> � <b><a href='inf.php?login=".$otchets['user']."' target=_blank border=0>".($otchets[user]==$hinfo['user']?"<u>$otchets[user]</u>":$otchets[user])."</a></b>.    ������� <b>$otchets[comment]</b>";
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
                        <center><b>��������� �� �������</b></center>
                    </td>
                </tr>
             </table>";

								}
							}
						}
					}
					//

					//
					// �������� ������ ������������
					if ($view == "sequrity") {
						if (($stat['rank']>=10 && $stat['rank']<=14) || $stat['rank']>=98) {

							$hinfo = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($id)."'"));

							if (empty($hinfo['user'])) $msg="�������� <u>$id</u> �� ������ � ����!";
							elseif ($hinfo['rank']==100) $msg="�� �� ������ ������������� ����� ������������ ������!";
							elseif ($hinfo['bloked']) $msg="�������� <u>$id</u> ������������!";
							else {

								$msq.="<br><center><b>����� ������������ ��������� <u>$hinfo[user]</u></b></center><br>";

								$otchet=mysql_query("SELECT * FROM security WHERE user='".addslashes($id)."' order by id desc");

								$msq.="<table width=100% bgcolor=e2e0e0 cellspacing=0 cellpadding=3 border=1 bordercolor=cccccc>";
								for ($i=0; $i<mysql_num_rows($otchet); $i++) {
									$otchets=mysql_fetch_array($otchet);
									if ($otchets['result']==0) $result="";
									elseif ($otchets['result']==1) $result="���� � ������� ��������<br>";
									elseif ($otchets['result']==2) $result="<b><font color=red>�������� ������!</font></b><br>";
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

						// �������� �����
						if ($view == "shtraf") {
							if ($stat['rank']>=10) {

								$hinfo = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($id)."'"));

								if (empty($hinfo['user'])) $msg="�������� <u>$id</u> �� ������ � ����!";
								elseif ($hinfo['bloked']) $msg="�������� <u>$id</u> ������������!";
								elseif ($hinfo['user']==$stat['user']) $msg="�� �� ������ ���������� ���� ����!";
								elseif ($hinfo['rank']==100 && $stat['rank']!=100) $msg="�� �� ������ ����������� ������!";
								elseif ($hinfo['rank']==99) $msg="�� �� ������ ����������� ���������� �����������!";
								elseif ($hinfo['rank']==98) $msg="�� �� ������ ����������� ����������� ���������� �����������!";
								elseif ($hinfo['rank']==101) $msg="<u>$id</u> �� �������� ������!";
								elseif ($hinfo['credits']<=$SCredits) $msg="�� �������� ������ � ������� <u>$id</u> ��������� �������!";

								else
								{
									mysql_query("update players set credits=credits-$SCredits where user='$hinfo[user]'");
									// �������� � �����
									require_once("inc/chat/functions.php");
									insert_msg("$ranks <b><u>".$stat['user']."</u></b> �������  ����� �� ����� <b>$SCredits ��.</b> ��������� <b><u>".$hinfo['user']."</u></b>","","","1","","",$stat['room']);
									//

									$msg=" ������� ����� � ������� <b><u>$SCredits ��.</u></b>!";
									$msgld="���������� <b>$stat[user]</b> ������� ����� � ������� <b><u>$SCredits ��.";

									ld_m (4,$hinfo[user],$stat[user],'',$msgld,'');

									#$msgs="<script>shtraf();</script>";
								}} }
								//


								// ������ � ��
								if ($view == "ldpost") {
									if (($stat['rank']>=10 && $stat['rank']<=14) || $stat['rank']>=98) {

										$hinfo = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($id)."'"));

										if (empty($hinfo['user'])) $msg="�������� <u>$id</u> �� ������ � ����!";
										elseif ($hinfo['rank']==100) $msg="�� �� ������ ��������� ������ � ����� ���� ������!";
										elseif ($hinfo['bloked']) $msg="�������� <u>$id</u> ������������!";
										else {

											ld_m (4,$hinfo[user],$stat[user],$reason,$mess,'');

											$msg="�� ������� ������� � ������ ���� ��������� <u>$id</u>";
										}
										#$msgs="<script>ldpost();</script>";
									}}
									//






									// ��������
									if ($view == "ic") {
										if ($stat['rank'] == 14 || $stat['rank'] >= 98) {
											$hinfo = mysql_fetch_array(mysql_query("SELECT user, bloked, ic, room, id FROM players WHERE user='".addslashes($id)."'"));

											if (empty($hinfo['user']))
											$msg = "�������� <u>".$id."</u> �� ������ � ����!";
											elseif ($hinfo['bloked'])
											$msg = "�������� <u>".$id."</u> ������������!";
											elseif ($hinfo['ic'] > $now)
											$msg = "� ��������� ��� ������������� ���������� ��������!";
											else {

												if (mysql_query("UPDATE players SET ic=".(time()+259200)." WHERE user='".$hinfo['user']."'")) {
													ld_m (4,$hinfo['user'],$stat['user'],'',"��������, ��� <U>".$hinfo['user']."</U> ���� ����� �������.",'');

													require_once("inc/chat/functions.php");
													insert_msg("�������� � <U>������������</U> �������� ������. � ��� ���� 3 ����� ��� ���������� � ����.","","","1",$hinfo['user'],"",$hinfo['room']);

													$msg = "�� ��������, ��� �������� <u>".$id."</u> ���� ����� �������.";
												}
											}
										}
									}
									//




									// ����� ����������
									if ($view == "new_enq") {
										if ($stat['rank']>=13 || $stat['rank']>=98) {

											$hinfo = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($id)."'"));

											if (empty($hinfo['user'])) $msg="�������� <u>$id</u> �� ������ � ����!";
											elseif ($hinfo['bloked']) $msg="�������� <u>$id</u> ������������!";
											elseif (($hinfo['rank']>=10 && $hinfo['rank']<=14) && $hinfo['rank']>=98) $msg="�������� ��� ������� � ������ ����������, ��� ��������� ������� �������������� �������� \"�������� ����\"!";
											elseif ($rank!=10 && $rank!=11 && $rank!=12 && $rank!=13 && $rank!=14) $msg="���-�� ��� �� ���...";
											elseif ($stat['rank']< $rank) $msg="�� �� ������ ������� � ���������� ��������� � ����� ��������";

											else {

												mysql_query("UPDATE players set rank=$rank where user='$hinfo[user]'");

												$msg="�� ������� <u>$hinfo[user]</u> � ����� ���������� � ����� $rank!";
												$msgld="���������� <b>$stat[user]</b> ������ <u>$hinfo[user]</u> � ����� ���������� � ����� $rank!";

												ld_m (4,$hinfo[user],$stat[user],'',$msgld,'');
											}
											#$msgs="<script>new_enq();</script>";
										}}
										//



										// ���������� �����������
										if ($view == "del_enq") {
											if ($stat['rank']>=13 || $stat['rank']>=98) {

												$hinfo = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($id)."'"));

												if (empty($hinfo['user'])) $msg="�������� <u>$id</u> �� ������ � ����!";
												elseif ($hinfo['rank']!=10 && $hinfo['rank']!=11 && $hinfo['rank']!=12 && $hinfo['rank']!=13 && $hinfo['rank']!=14) $msg="�������� �� ������� � ������ ����������!";
												elseif ($stat['rank']<= $hinfo['rank']) $msg="�� �� ������ ��������� �� ���������� ��������� � �������� ���� ������";

												else {

													mysql_query("UPDATE players set rank=0 where user='".$hinfo['user']."' LIMIT 1");

													$msg="�� ��������� <u>$hinfo[user]</u> �� ������ ����������!";
													$msgld="���������� <b>$stat[user]</b> �������� <u>$hinfo[user]</u> �� ������ ����������!";

													ld_m (4,$hinfo[user],$stat[user],'',$msgld,'');
												}
												#$msgs="<script>del_enq();</script>";
											}}
											//





											// ��������� ����� �����������
											if ($view == "ch_enq") {
												if ($stat['rank']>=13 || $stat['rank']>=98) {

													$hinfo = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($id)."'"));

													if (empty($hinfo['user'])) $msg="�������� <u>$id</u> �� ������ � ����!";
													elseif ($hinfo['rank']!=10 && $hinfo['rank']!=11 && $hinfo['rank']!=12 && $hinfo['rank']!=13 && $hinfo['rank']!=14) $msg="�������� �� ������� � ������ ����������!";
													elseif ($rank!=10 && $rank!=11 && $rank!=12 && $rank!=13 && $rank!=14) $msg="���-�� ��� �� ���...";
													elseif ($stat['rank']<= $rank || $stat['rank']== 14 && $rank ==13) $msg="�� �� ������ ������� � ���������� ��������� � ����� ��������";
													elseif ($stat['rank']<= $hinfo['rank']) $msg="�� �� ������ ������� � ���������� ��������� � �������� ���� ������";
													elseif ($stat['rank']<= $hinfo['rank']) $msg="�� �� ������ �������� ���� ��������� � �������� ���� ������";
													else {

														mysql_query("UPDATE players set rank=$rank where user='".$hinfo['user']."'");

														$msg="�� �������� ���� ����������� <u>$hinfo[user]</u>!";
														$msgld="���������� <b>$stat[user]</b> ������� ���� ����������� <u>$hinfo[user]</u>!";

														ld_m (4,$hinfo[user],$stat[user],'',$msgld,'');
													}
													#$msgs="<script>ch_enq();</script>";
												}}
												//





}


// ����� ���� ��������
?>

