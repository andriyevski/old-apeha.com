
<tr>
	<td width="100%" align="center">

	<table border="0" width="100%" height="100%" cellspacing="0"
		cellpadding="0">
		<tr>
			<td width="18" height="58"><img border="0" src="i/inf_101.gif"
				width="18" height="58"></td>
			<td height="58" background="i/inf_102.gif" align="center">

			<table width="168" height="58" border="0" cellpadding="0"
				cellspacing="0">
				<tr>
					<td><img src="i/inf_top_01.gif" width="36" height="31" alt=""></td>
					<td><img src="i/inf_top_02.gif" width="96" height="31" alt=""></td>
					<td><img src="i/inf_top_03.gif" width="36" height="31" alt=""></td>
				</tr>
				<tr>
					<td><img src="i/inf_top_04.gif" width="36" height="16" alt=""></td>
					<td background="i/inf_top_05.gif" align="center"><font size="1"
						color="#ffffff" face="Verdana"><b>Информация</b></font></td>
					<td><img src="i/inf_top_06.gif" width="36" height="16" alt=""></td>
				</tr>
				<tr>
					<td><img src="i/inf_top_07.gif" width="36" height="11" alt=""></td>
					<td><img src="i/inf_top_08.gif" width="96" height="11" alt=""></td>
					<td><img src="i/inf_top_09.gif" width="36" height="11" alt=""></td>
				</tr>
			</table>



			</td>
			<td width="18" height="58"><img border="0" src="i/inf_103.gif"
				width="18" height="58"></td>
		</tr>
		<tr>
			<td width="18" height="100%" background="i/inf_201.gif">&nbsp;</td>
			<td height="100%" background="i/inf_000.gif">

			<table valign='top' height='100%' width='100%'>

				<tr>
					<td valign='top' height='100%' width='60%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <b>Уровень:</b>
					</font></td>
					<td align='right' valign='top' height='100%' width='40%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <b><?=$info['level']?></b>
					</font></td>
				</tr>

				<tr>
					<td valign='top' height='100%' width='60%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <b>Бои:</b> </font>
					</td>
					<td align='right' valign='top' height='100%' width='40%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <b><?=$info['wins']?>/<?=$info['losses']?>/<?=$info['drawn']?></b>
					</font></td>
				</tr>

				<tr>
					<td valign='top' height='100%' width='60%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <b>Раса:</b>
					</font></td>
					<td align='right' valign='top' height='100%' width='30%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <b><?=$rase?></b>
					</font></td>
				</tr>

				<tr>
					<td valign='top' height='100%' width='60%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <b>Дата
					рождения:</b> </font></td>
					<td align='right' valign='top' height='100%' width='40%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <b><?=$info['birthdate']?></b>
					</font></td>
				</tr>

				<tr>
					<td valign='top' height='100%' width='60%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <b>Профессия:</b>
					</font></td>
					<td align='right' valign='top' height='100%' width='40%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <b> <?
						switch ($info['proff']) {
							case 1: echo"Лекарь"; break;
							case 2: echo"Кузнец"; break;
							case 3: echo"Огранщик"; break;
							case 4: echo"Рудокоп"; break;
							case 5: echo"Наёмник"; break;

							case 8: echo"Жрец"; break;
							default: echo"нет"; break;
						}
						?> </b> </font></td>
				</tr>

				<tr>
					<td valign='top' height='100%' width='60%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <b>Статус:</b>
					</font></td>
					<td align='right' valign='top' height='100%' width='40%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <b> <?
						include ('inc/aligns.php');


						echo $alignstr[$info['rank']];
						?> </b> </font></td>
				</tr>

				<? if ($info['tribe']) {
					echo"<tr>
    <td valign='top' height='100%' width='60%' style='border-style: solid; border-width: 1; padding: 3' bordercolor='#D8C792'>
<font face='Verdana' size='1'>
<b>Клан:</b>
</font>
</td>
    <td align='right' valign='top' height='100%' width='40%' style='border-style: solid; border-width: 1; padding: 3' bordercolor='#D8C792'>
<font face='Verdana' size='1'>
<b><IMG SRC='i/klan/".$info['tribe'].".gif' width=12 height=12> <font color=red><B style='CURSOR: Default;'";
					if ($info['b_tribe'] == 1) echo" onmouseover=\"hint('<b>Глава клана</b></b>');\" onmouseout=\"c();\"";
					elseif ($info['tribe_rank']) echo" onmouseover=\"hint('".$info['tribe_rank']."');\" onmouseout=\"c();\"";
					echo"><a target='_blank' href='info_clan.php?name=".$info['tribe']."&mode=logo'>".$info['tribe']."</a></B></font></b>
</font>
</td>
</tr>
";
				} ?>



				<? if ($info['semija'] != "" or $info['elik_sila']> $now or $info['elik_lovkost']> $now or $info['elik_inta']> $now or $info['elik_vinosl']> $now or $info['elik_razum']> $now or $info['m_time']> $now or $info['sign']> $now or $info['abonement']> $now) {

					echo"<tr>
    <td valign='top' height='100%' width='60%' style='border-style: solid; border-width: 1; padding: 3' bordercolor='#D8C792'>
<font face='Verdana' size='1'>
<b>Статус:</b>
</font>
</td>
    <td align='right' valign='top' height='100%' width='40%' style='border-style: solid; border-width: 1; padding: 3' bordercolor='#D8C792'>
<font face='Verdana' size='1'>
<b> <font color=red><B style='CURSOR: Default;'";

					if ($info['semija'] != "") {echo" onmouseover=\"hint('Обручен(а) на <b>".$info['semija']."</b>');\" onmouseout=\"c();\"";echo"><IMG SRC='i/items/obruchal.gif' width=25 height=18></B></font></b> ";}

					echo"
<font face='Verdana' size='1'>
<b> <font color=red><B style='CURSOR: Default;'>";


					if ($info['elik_sila'] > $now or $info['elik_lovkost'] > $now or $info['elik_inta'] > $now or $info['elik_vinosl']> $now or $info['elik_razum']> $now) {echo"<IMG SRC='i/items/elik_dex.gif' width=19 height=30></B></font></b> ";}
					if ($info['m_time'] > $now) {echo"<IMG SRC='i/sleep2.gif' title='Молчание: ".round(($info['m_time']-$now)/60)." минут'></B></font></b> ";}
					if ($info['sign'] > $now) {echo"<IMG SRC='i/sign.gif' title='Грамота: ".round(($info['sign']-$now)/60)." минут'></B></font></b> ";}
					if ($info['abonement'] > $now) {echo"<IMG SRC='i/abonement.gif' title='Абонемент: ".round(($info['abonement']-$now)/86400)." дней'></B></font></b> ";}
					if ($info['immun'] > $now) {echo"<IMG SRC='i/items/immun.gif' title='Иммунитет к нападениям: ".round(($info['immun']-$now)/60)." часов'></B></font></b> ";}
					echo" </font>
</tr>
";
				} ?>


			</table>


			</td>
			<td width="18" height="100%" background="i/inf_203.gif">&nbsp;</td>
		</tr>
		<tr>
			<td width="18" height="19"><img border="0" src="i/inf_301.gif"
				width="18" height="19"></td>
			<td height="19" background="i/inf_302.gif">&nbsp;</td>
			<td width="18" height="19"><img border="0" src="i/inf_303.gif"
				width="18" height="19"></td>
		</tr>
	</table>




	</td>
</tr>
