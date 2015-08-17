<?
$ctime = time();
include("inc/db_connect.php");
include("inc/html_header.php");
$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));
$now=time();

if (empty($stat['id'])) { header("Location: ".$img_server.""); exit; }
if ($stat['bloked']) { echo"<script>top.location='index.php?action=logout'</script>"; exit; }

if ($stat['last_battle']) mysql_query("UPDATE players SET last_battle=NULL WHERE user='".$stat['user']."'");

include("inc/html_header.php");

echo"<script language=JavaScript src='i/login_form.js'></script>";
echo"<script language=JavaScript src='i/show_inf.js'></script>";
echo"<script language=JavaScript src='i/time.js'></script>";

echo"<div id=mainform style='position:absolute; left:11px; top:30px'></div>
<div id=hint1 class=hint></div>";
?>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0"
	background="/i/bg.gif">
<style>
.hided {
	display: none;
}

.showed {
	display: block;
}
</style>
<table width=100% cellspacing=0 border=0 cellpadding=0 bordercolor=red>
	<tr>
		<td valign=top width=200><?
		include("inc/main/changed.php");
		$uri=GetEnv("REQUEST_URI");
		$uri=explode("?",$uri);
		$uri=$uri['0'];
		if (empty($set) && $uri=="/main.php" || $set=="edit" && $uri=="/main.php" || $set=="map" && $uri=="/main.php" || $uri=="/battle.php") include("inc/magic/use.php");
		elseif ($set=="abils" && $uri=="/main.php") include("inc/magic/abils/use.php");

		$hp_max=$stat['hp_max'];

		

			$widthhp=$stat['hp_now']/$hp_max*172;
			if ($widthhp==0) $widthhp+=2;
			if ($widthhp==1) $widthhp+=1;
			if ($widthhp>1) $widthhp-=1;

			$ustal_max = $stat['vitality']*5+$stat['ustal'];

			$widthustal=$stat[ustal_now]/($stat['vitality']*5)*172;
			if ($widthustal=="0") $widthustal=$widthustal+2;
			if ($widthustal=="1") $widthustal=$widthustal+1;
			if ($widthustal>"1") $widthustal=$widthustal-1;

			include("inc/main/inf.php");






			$ustal_max = $stat['power']*5;
			if ($stat['ustal_now'] > $ustal_max) {
				mysql_query("update players set ustal_now=".$ustal_max." WHERE id='".$stat['id']."'");
			}
			?></td>
		<td valign='top' width='250'>

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
										<table border='0' height='22' cellspacing='0' cellpadding='0'>
											<tr>
												<td width='96' height='22'>&nbsp;</td>

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
								<table border='0' width='100%' height='100%' cellpadding='0'
									cellspacing='0'
									style='border-collapse: collapse; border-style: solid; padding: 3'>
									<tr>
										<td width='100%'><?
										echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='98%'>
    <tr>
      <td width='50%' align='left'><small>Сила</small></td>
      <td width='50%' align='right'><b><small>$stat[strength]</small></b></td>
    </tr>
    <tr>
      <td width='50%' align='left'><small>Ловкость</small></td>
      <td width='50%' align='right'><b><small>$stat[agility]</b></small></td>
    </tr>
    <tr>
      <td width='50%' align='left'><small>Удача</small></td>
      <td width='50%' align='right'><b><small>$stat[dex]</b></small></td>
    </tr>
    <tr>
      <td width='50%' align='left'><small>Выносливость</small></td>
      <td width='50%' align='right'><b><small>$stat[vitality]</b></small></td>
    </tr>
    <tr>
      <td width='50%' align='left'><small>Энергия</small></td>
      <td width='50%' align='right'><b><small>$stat[power]</b></small></td>
    </tr>
	<tr>
      <td width='50%' align='left'><small>Разум</small></td>
      <td width='50%' align='right'><b><small>$stat[razum]</b></small></td>
    </tr>";





										if ($stat['level'] <= 5) echo"
    <tr>
      <td width='100%' align='center' colspan='2'><small><b><a href='main.php?set=nastavnik'>Помошь наставника</a></b></small></td>
    </tr>
	";



										if ($stat['level'] > 5) echo"
    <tr>
      <td width='100%' align='center' colspan='2'><small><b><a href='main.php?set=nastavnik'>Выбрать ученика</a></b></small></td>
    </tr>
	";


										if ($stat['s_updates'] || $stat['o_updates']) echo"
    <tr>
      <td width='100%' align='center' colspan='2'><small><b><a href='main.php?set=updates'>+ Способности</a></b></small></td>
    </tr>";


										if ($stat['m_time']>$now) echo "<tr><td align='center' colspan='2'><a href='main.php?set=status'>Действует статус</a></td></tr>";
										if ($stat['f_time']>$now) echo "<tr><td align='center' colspan='2'><a href='main.php?set=status'>Действует статус</a></td></tr>";
										if ($stat['k_time']>$now) echo "<tr><td align='center' colspan='2'><a href='main.php?set=status'>Действует статус</a></td></tr>";
										if ($stat['sign']>$now) echo "<tr><td align='center' colspan='2'><a href='main.php?set=status'>Действует статус</a></td></tr>";
										if ($stat['abonement']>$now) echo "<tr><td align='center' colspan='2'><a href='main.php?set=status'>Действует статус</a></td></tr>";
										if ($stat['travma']>$now) echo "<tr><td align='center' colspan='2'><a href='main.php?set=status'>Действует статус</a></td></tr>";
										if ($stat['elik_sila']>$now || $stat['elik_lovkost']>$now || $stat['elik_inta']>$now || $stat['elik_vinosl']>$now || $stat['elik_razum']>$now || $stat['elik_br']>$now) echo "<tr><td align='center' colspan='2'><a href='main.php?set=status'>Действует статус</a></td></tr>";






										echo"
  </table>
</div>
<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='98%'>
    <tr>
      <td width='50%' align='left'><small>Опыт</small></td>
      <td width='50%' align='right'><b><small>$stat[exp]</b></small></td>
    </tr>
    <tr>
      <td width='50%' align='left'><small>Улучшения</small></td>
      <td width='50%' align='right'><b><small>$stat[next_exp]</b></small></td>
    </tr>
    <tr>
      <td width='50%' align='left'><small>Уровень</small></td>
      <td width='50%' align='right'><b><small>$stat[level]</b></small></td>
    </tr>
    <tr>
      <td width='50%' align='left'><small>Бои</small></td>
      <td width='50%' align='right'><b><small>$stat[wins]</b>/<b>$stat[losses]</b>/<b>$stat[drawn]</b></small></td>
    </tr>
		<tr>
      <td width='50%' align='left'><small><b>Приведенно</b></small></td>
      <td width='50%' align='right'><font color=red><b><small>$stat[friends] чел.</b></small></font></td>
    </tr>
    <tr>
      <td width='50%' align='left'><small>Золото</small></td>
      <td width='50%' align='right'><b><small>$stat[credits]</b></small></td>
    </tr>
    <tr>
      <td width='50%' align='left'><small>Валюта</small></td>
      <td width='50%' align='right'><b><small>$stat[valute]</b></small></td>
    </tr>

  </table>
</div>";
										switch ($stat['rase']) {
											case 1: $rase="Человек"; break; }
											if ( $set == edit ) {
												echo"
<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='98%'>
    <tr>
      <td width='50%' align='left'><small>Расса</small></td>
      <td width='50%' align='right'><b><small>$rase</b></small></td>
    </tr>
    <tr>
      <td width='50%' align='left'><small>Профессия</small></td>
      <td width='50%' align='right'><b><small>";
												switch ($stat['proff']) {
													case 1: echo"Лекарь"; break;
													case 2: echo"Кузнец"; break;
													case 3: echo"Огранщик"; break;
													case 4: echo"Рудокоп"; break;
													case 5: echo"Наёмник"; break;

													case 8: echo"Жрец"; break;
													default: echo"нет"; break;
												}
												echo"</b></small></td>
    </tr>
    <tr>
      <td width='50%' align='left'><small>Навык Мастера</small></td>
      <td width='50%' align='right'><b><small>".$stat['navik_us']."</b>%</small></td>
    </tr>
    <tr>
      <td width='50%' align='left'><small>Навык Рыбака</small></td>
      <td width='50%' align='right'><b><small>".$stat['navik_rb']."</b>%</small></td>
    </tr>
	<tr>
      <td width='50%' align='left'><small>Навык Лесника</small></td>
      <td width='50%' align='right'><b><small>".$stat['navik_lsn']."</b>%</small></td>
    </tr>
  </table>
</div>";
												echo"
<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='98%'>
    <tr>
      <td width='50%' align='left'><small>Крит. удар</small></td>
      <td width='50%' align='right'><b><small>$stat[krit]</b>%</small></td>
    </tr>
    <tr>
      <td width='50%' align='left'><small>Анти крит.</small></td>
      <td width='50%' align='right'><b><small>$stat[unkrit]</b>%</small></td>
    </tr>
    <tr>
      <td width='50%' align='left'><small>Уворот.</small></td>
      <td width='50%' align='right'><b><small>$stat[uv]</b>%</small></td>
    </tr>
    <tr>
      <td width='50%' align='left'><small>Анти уворот.</small></td>
      <td width='50%' align='right'><b><small>$stat[unuv]</b>%</small></td>
    </tr>
    <tr>
      <td width='50%' align='left'><small>Удар</small></td>
      <td width='50%' align='right'><b><small>+",round(($stat[strength]/3+$stat[min])*(1+($stat['ork']/100))),"</b>... <b>+",round((1+$stat[strength]/1.5+$stat[max])*(1+($stat['ork']/100))),"</b></small></td>
    </tr>
    <tr>
      <td width='50%' align='left'><small>Защ. Головы</small></td>
      <td width='50%' align='right'><b><small>$stat[br1]</b></small></td>
    </tr>
    <tr>
      <td width='50%' align='left'><small>Защ. Корпуса</small></td>
      <td width='50%' align='right'><b><small>$stat[br2]</b></small></td>
    </tr>
    <tr>
      <td width='50%' align='left'><small>Защ. Живота</small></td>
      <td width='50%' align='right'><b><small>$stat[br3]</b></small></td>
    </tr>
    <tr>
      <td width='50%' align='left'><small>Защ. Пояса</small></td>
      <td width='50%' align='right'><b><small>$stat[br4]</b></small></td>
    </tr>
    <tr>
      <td width='50%' align='left'><small>Защ. Ног</small></td>
      <td width='50%' align='right'><b><small>$stat[br5]</b></small></td>
    </tr>
  </table>
</div>";
											}
											?></td>
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
		</td>
		<td valign='top'><?
if (!empty($nms)) echo"<br><center><font color=red><b>$nms</b></font></center><br>";
?>