<?
$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."' LIMIT 1"));


?>

<TD valign=top align=left><br>
<TABLE WIDTH=100% cellspacing=0 cellpadding=3>
	<TR>
		<TD width=50% valign=top>
		<TABLE cellspacing=0 cellpadding=5 STYLE='BORDER-COLOR: Silver;'
			width=100%>
			<TR>
				<TD bgcolor=e2e0e0 align=center
					style='BORDER-LEFT: 1px solid; BORDER-TOP: 1px solid; BORDER-RIGHT: 1px solid; BORDER-BOTTOM: 1px solid;'><B><SMALL>Характеристики</SMALL></B></TD>
			</TR>
			<TR>
				<TD
					style='BORDER-LEFT: 1px solid; BORDER-RIGHT: 1px solid; PADDING-LEFT: 10px; PADDING-RIGHT: 10px;'>
				Сила: <B><?=$info['strength']?></B><SMALL><? if ($_obj['strength']>0) echo "<SMALL> [ <B><U>".($info['strength']-$_obj['strength'])."</U></B> + ".$_obj['strength']." ]</SMALL>"; ?></SMALL><br>
				Ловкость: <B><?=$info['agility']?></B><SMALL><? if ($_obj['agility']>0) echo "<SMALL> [ <B><U>".($info['agility']-$_obj['agility'])."</U></B> + ".$_obj['agility']." ]</SMALL>"; ?></SMALL><br>
				Удача: <B><?=$info['dex']?></B><SMALL><? if ($_obj['dex']>0) echo "<SMALL> [ <B><U>".($info['dex']-$_obj['dex'])."</U></B> + ".$_obj['dex']." ]</SMALL>"; ?></SMALL><br>
				Выносливость: <B><?=$info['vitality']?></B><SMALL><? if ($_obj['vitality']>0) echo "<SMALL> [ <B><U>".($info['vitality']-$_obj['vitality'])."</U></B> + ".$_obj['vitality']." ]</SMALL>"; ?></SMALL><br>
				Усталость: <B><?=$info['ustal']?></B><SMALL><? if ($_obj['ustal']>0) echo "<SMALL> [ <B><U>".($info['ustal']-$_obj['ustal'])."</U></B> + ".$_obj['ustal']." ]</SMALL>"; ?></SMALL><br>
				Разум: <B><?=$info['razum']?></B><SMALL><? if ($_obj['razum']>0) echo "<SMALL> [ <B><U>".($info['razum']-$_obj['razum'])."</U></B> + ".$_obj['razum']." ]</SMALL>"; ?></SMALL><br>
				</TD>
			</TR>
			<TR>
				<TD bgcolor=e2e0e0 align=center
					style='BORDER-LEFT: 1px solid; BORDER-TOP: 1px solid; BORDER-RIGHT: 1px solid; BORDER-BOTTOM: 1px solid;'><B><SMALL>Статистика</SMALL></B></TD>
			</TR>
			<TR>
				<TD
					style='BORDER-LEFT: 1px solid; BORDER-RIGHT: 1px solid; PADDING-LEFT: 10px; PADDING-RIGHT: 10px;''>
				Уровень: <B><?=$info['level']?></B><BR>
				Побед: <B><?=$info['wins']?></B><BR>
				Поражений: <B><?=$info['losses']?></B><BR>
				Ничьих: <B><?=$info['drawn']?></B><BR>

				Дата рождения: <B><?=$info['birthdate']?></B><BR>
				Профессия: <B><?
				switch ($info['proff']) {
					case 1: echo"Лекарь"; break;
					case 2: echo"Кузнец"; break;
					case 3: echo"Огранщик"; break;
					case 4: echo"Жрец"; break;
					case 5: echo"Наёмник"; break;
					case 8: echo"Священик"; break;
					default: echo"нет"; break;
				}

				?> </b></br>
				<?
				if ($info['tribe']) {
					echo"

	Клан: <IMG SRC='i/klan/".$info['tribe'].".gif' width=12 height=12> <B style='CURSOR: Default;'>".$info['tribe']."</B>";

					if ($info['b_tribe'] == 1) echo"&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;<b><font color=red>Глава Гильдии</font></b>";
					elseif ($info['tribe_rank']) echo"&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;".$info['tribe_rank']."";

				}
				?><br>
				Статус: <B><?
				if ($info['rank']==60) echo"Бот";
				elseif ($info['rank']==98) echo"Бандит";
				elseif (($info['rank']>=10 && $info['rank']<=14) || $info['rank']==99) echo"Модератор";
				elseif ($info['rank']==100) echo"Ангел";
				elseif ($info['rank']==101) echo"ВаМпИрЕнОк";
				else echo"Игрок";
				?></B><BR>
				</B><BR>
				</TD>
			</TR>

			<TR>
				<TD
					style='BORDER-LEFT: 1px solid; BORDER-RIGHT: 1px solid; PADDING-LEFT: 10px; PADDING-RIGHT: 10px;''>
				РФС: <B><?=$info['friends']?></B><BR>
			
			
			<TR>
				<TD bgcolor=e2e0e0 align=center
					style='BORDER-LEFT: 1px solid; BORDER-TOP: 1px solid; BORDER-RIGHT: 1px solid; BORDER-BOTTOM: 1px solid;'><B><SMALL>Личные
				данные</SMALL></B></TD>
			</TR>
			<TR>
				<TD
					style='BORDER-LEFT: 1px solid; BORDER-BOTTOM: 1px solid; BORDER-RIGHT: 1px solid; PADDING-LEFT: 10px; PADDING-RIGHT: 10px;''>
				Имя: <B><?=$info['name']?></B><BR>
				Пол: <B><?
				switch ($info['sex']) {
					case 1: echo"Мужской"; break;
					case 2: echo"Женский"; break;
				}
				?></B><BR>
				Город: <B><?=$info['real_city']?></B><BR>
				</TD>
			</TR>
		</TABLE>
		</TD>
		<TD valign=top>

		<TABLE cellspacing=0 cellpadding=5 STYLE='BORDER-COLOR: Silver;'
			WIDTH=100%>
			<TR>
				<TD bgcolor=e2e0e0 align=center
					style='BORDER-LEFT: 1px solid; BORDER-TOP: 1px solid; BORDER-RIGHT: 1px solid; BORDER-BOTTOM: 1px solid;'><B><SMALL>Грамоты,
				подарки, цветы...</SMALL></B></TD>
			</TR>
			<TR>
				<TD
					style='BORDER-LEFT: 1px solid; BORDER-RIGHT: 1px solid; BORDER-BOTTOM: 1px solid; PADDING-LEFT: 10px; PADDING-RIGHT: 10px;'
					align=center><?
					if ($info['m_time'] > $now) echo "<img src='i/sleep.gif'>&nbsp;Наложен запрет на общение чате.<br>";
					if ($info['sign'] > $now) echo "<img src='i/gramota.gif'>&nbsp;Персонажу вручена грамота за вклад в игру.<br>";
					if ($info['invisible'] > $now) echo "<img src=''>&nbsp;Персонажа настигла тень.<br>";
					if ($info['travma'] > $now) echo "<img src='i/travma.gif'>&nbsp;Персонажа травмирован.<br>";


					if ($info['viptime'] > $now) echo "<img src='i/status/vip.gif'><br>&nbsp;VIP персона клуба ИВ.<br>";


					if ($info['semija'] AND $info['razvod']==0) echo "<img src='i/items/obruchal.gif'>&nbsp;Обручен(а) на <b><a href=\"javascript:inf('".$info['semija']."');\">".$info['semija']."</a></b>.";
					if ($info['exsemija'] AND $info['razvod']==1) echo "<img src=''>&nbsp;Разведен(а) с <b><a href=\"javascript:inf('".$info['exsemija']."');\">".$info['exsemija']."</a></b>.";
					if ($info['elik_strength_time'] > $now) echo "<img src='i/elik.gif'>&nbsp;Персонаж находится под действием эликсира силы.<br>";
					if ($info['elik_agility_time'] > $now) echo "<img src='i/elik.gif'>&nbsp;Персонаж находится под действием эликсира ловкости.<br>";
					if ($info['elik_dex_time'] > $now) echo "<img src='i/elik.gif'>&nbsp;Персонаж находится под действием эликсира удачи.<br>";
					if ($info['elik_vitality_time'] > $now) echo "<img src='i/elik.gif'>&nbsp;Персонаж находится под действием эликсира выносливости.<br>";

					?> <br>
					<? include("inc/inf/prizes.php"); ?></TD>
			</TR>
		</TABLE>
		<BR>
		</TD>

</TABLE>




</TD>
</TR>
</TABLE>
