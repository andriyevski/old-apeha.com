<?


$sila=$info['strength'];
$lovkost=$info['agility'];
$inta=$info['dex'];
$vinoslivost=$info['vitality'];
$energy=$info['power'];
$razum=$info['razum'];

?>
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
						color="#ffffff" face="Verdana"><b>Характеристика</b></font></td>
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
						bordercolor='#D8C792'><font face='Verdana' size='1'> <b>Сила:</b>
					</font></td>
					<td align='center' valign='top' height='100%' width='20%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <b><?=$sila?></b>
					</font></td>
					<td align='center' valign='top' height='100%' width='20%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <?$strengthh=$_obj['strength']+$info['elik_ks']; 
						if ($_obj['strength']>0 or $info['elik_sila']>$now) echo "<SMALL><U>".($info['strength']-$_obj['strength']-$info['elik_ks'])."</U> + ".$strengthh."</SMALL>"; else echo "<small>0</small>"; ?>
					</font></td>
				</tr>

				<tr>
					<td valign='top' height='100%' width='60%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <b>Ловкость:</b>
					</font></td>
					<td align='center' valign='top' height='100%' width='20%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <b><?=$lovkost?></b>
					</font></td>
					<td align='center' valign='top' height='100%' width='20%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <?$agilityy=$_obj['agility']+$info['elik_kl']; 
						if ($_obj['agility']>0 or $info['elik_lovkost'] > $now) echo "<SMALL><U>".($info['agility']-$_obj['agility']-$info['elik_kl'])."</U> + ".$agilityy."</SMALL>"; else echo "<small>0</small>"; ?>
					</font></td>
				</tr>

				<tr>
					<td valign='top' height='100%' width='60%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <b>Удача:</b>
					</font></td>
					<td align='center' valign='top' height='100%' width='20%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <b><?=$inta?></b>
					</font></td>
					<td align='center' valign='top' height='100%' width='20%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <?$dexx=$_obj['dex']+$info['elik_ki']; 
						if ($_obj['dex']>0 or $info['elik_inta'] > $now) echo "<SMALL><U>".($info['dex']-$_obj['dex']-$info['elik_ki'])."</U> + ".$dexx."</SMALL>"; else echo "<small>0</small>"; ?>
					</font></td>
				</tr>

				<tr>
					<td valign='top' height='100%' width='60%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <b>Выносливость:</b>
					</font></td>
					<td align='center' valign='top' height='100%' width='20%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <b><?=$vinoslivost?></b>
					</font></td>
					<td align='center' valign='top' height='100%' width='20%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <?$vitalityy=$_obj['vitality']+$info['elik_kv']; 
						if ($_obj['vitality']>0 or $info['elik_vinosl'] > $now) echo "<SMALL><U>".($info['vitality']-$_obj['vitality']-$info['elik_kv'])."</U> + ".$vitalityy."</SMALL>"; else echo "<small>0</small>"; ?>
					</font></td>
				</tr>


				<tr>
					<td valign='top' height='100%' width='60%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <b>Энергия:</b>
					</font></td>
					<td align='center' valign='top' height='100%' width='20%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <b><?=$energy?></b>
					</font></td>
					<td align='center' valign='top' height='100%' width='20%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <? if ($_obj['energy']>0) echo "<SMALL><U>".($info['energy']-$_obj['energy'])."</U> + ".$_obj['energy']."</SMALL>"; else echo "<small>0</small>"; ?>

					</font></td>
				</tr>


				<tr>
					<td valign='top' height='100%' width='60%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <b>Разум:</b>
					</font></td>
					<td align='center' valign='top' height='100%' width='20%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <b><?=$razum?></b>
					</font></td>
					<td align='center' valign='top' height='100%' width='20%'
						style='border-style: solid; border-width: 1; padding: 3'
						bordercolor='#D8C792'><font face='Verdana' size='1'> <?$razumm=$_obj['razum']+$info['elik_kr']; 
						if ($_obj['razum']>0 or $info['elik_razum'] > $now) echo "<SMALL><U>".($info['razum']-$_obj['razum']-$info['elik_kr'])."</U> + ".$razumm."</SMALL>"; else echo "<small>0</small>"; ?>
					</font></td>
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
	</table>






	</td>
</tr>
