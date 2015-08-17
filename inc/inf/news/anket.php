
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
				color="#ffffff" face="Verdana"><b>Анкета</b></font></td>
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
	<td height="100%" background="i/inf_000.gif" align='center'>

	<table width="100%" height="100%">
		<tr>
			<td valign='top' height='100%' width='60%'
				style='border-style: solid; border-width: 1; padding: 3'
				bordercolor='#D8C792'><b>Имя: </b><?=$info['name']?></td>
		</tr>
		<tr>
			<td valign='top' height='100%' width='60%'
				style='border-style: solid; border-width: 1; padding: 3'
				bordercolor='#D8C792'><b>Пол: </b><?
				switch ($info['sex']) {
					case 1: echo"Мужской"; break;
					case 2: echo"Женский"; break;
				}
				?></td>
		</tr>
		<tr>
			<td valign='top' height='100%' width='60%'
				style='border-style: solid; border-width: 1; padding: 3'
				bordercolor='#D8C792'><b>Город: </b><?=$info['real_city']?></td>
		</tr>
		<tr>
			<td valign='top' height='100%' width='60%'
				style='border-style: solid; border-width: 1; padding: 3'
				bordercolor='#D8C792'><b>Девиз: </b><?=$info['deviz']?></td>
		</tr>
		<tr>
			<td valign='top' height='100%' width='60%'
				style='border-style: solid; border-width: 1; padding: 3'
				bordercolor='#D8C792'><b>ICQ: </b><?=$info['icq']?></td>
		</tr>
		<tr>
			<td valign='top' height='100%' width='60%'
				style='border-style: solid; border-width: 1; padding: 3'
				bordercolor='#D8C792'><b>Домашняя страница: </b> <a
				href='<?=$info['url']?>' target=_blank><?=$info['url']?></a></td>
		</tr>
		<tr>
			<td valign='top' height='100%' width='60%'
				style='border-style: solid; border-width: 1; padding: 3'
				bordercolor='#D8C792'><b>О себе: </b><br>
				<?=$info['about']?></td>
		</tr>
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
