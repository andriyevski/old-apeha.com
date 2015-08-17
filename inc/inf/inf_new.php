
<?//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////КОНЕЦ БЛОКА С ПЕРСОМ

$now=time();

if ($info['obraz']) $obraz=$info['obraz']; else $obraz=$info['rase']."/".$info['sex'];


$get=1;


$hp_max=ceil(($info['vitality']*5+$info['hp'])*(1+($info['gnom']/100)));

$_vt=$info['v_time']-$now;
$_hp=$hp_max-(round($_vt*$hp_max/300));

// Определение текущего колличества HP
if (!$info['v_time'] and $info['hp_now']<$hp_max) $hp=$info['hp_now'];
elseif ($info['v_time'] and $_hp<$hp_max) { $vt=$info['v_time']-$now; $hp=$hp_max-(round($vt*$hp_max/300)); }
else $hp=$hp_max;
//

$widthhp=$hp/$hp_max*181;
if ($widthhp=="0") $widthhp=$widthhp+2;
elseif ($widthhp=="1") $widthhp=$widthhp+1;
elseif ($widthhp>"1") $widthhp=$widthhp-1;





$energy=$info['energy_now'];
$energy_max = $info['power']*5+$info['energy'];



$widthenergy=$energy/$energy_max*181;
if ($widthenergy=="0") $widthenergy=$widthenergy+2;
if ($widthenergy=="1") $widthenergy=$widthenergy+1;
if ($widthenergy>"1") $widthenergy=$widthenergy-1;

$ustal=$info['ustal_now'];
$ustal_max = $info['vitality']*5+$info['ustal'];

$widthustal=$ustal/$ustal_max*181;
if ($widthustal=="0") $widthustal=$widthustal+2;
if ($widthustal=="1") $widthustal=$widthustal+1;
if ($widthustal>"1") $widthustal=$widthustal-1;
?>

<TABLE border=0 width=300 cellspacing=0 cellpadding=0>
	<TR height=5>

	</TR>

	<TR>
		<TD>

		<TABLE border=0 width=100% cellspacing=0 cellpadding=0>
			<TR>



				<TD align=center><?

				if ($info['bloked']) echo"<BR><SPAN class=bloked onmouseover=\"hint('<b>Причина блокировки:</b><BR><FONT CLASS=bloked>".$info['bloked']."</FONT>');\" onmouseout=\"c();\">Персонаж заблокирован!</SPAN>";

				?>

				<TABLE border=0 width=100% cellspacing=0 cellpadding=10>
					<TR>
						<TD align=center valign=center>


						<table width=210 cellspacing=0 cellpadding=0 border=0>
							<tr>
								<td valign=top align=center colspan=3><script
									language=JavaScript>
<?
echo"show_inf('".$info['user']."','".$info['id']."','".$info['level']."','".$info['rank']."','".$info['tribe']."');";
?>
</script> <br>
								<br>

								</td>
							</tr>
							<tr>

							<? include('inc/main/alt.php'); ?>

								<td align=center width=100%><?echo"


<table width=200 border=0 cellspacing=0 cellpadding=0 bordercolor=A5A5A5 height=263>
<tr>
<td valign=top width=20>

<table cellspacing=0 cellpadding=0 border=0 align=center width=12>
<tr><td height=60>&nbsp;</td></tr>
<tr>
<td width=10 title='Уровень жизни: $hp/$hp_max' align=center valign=bottom height=200><img src=i/_helth.gif width='10' height=10 border=0 alt='Уровень жизни: $hp/$hp_max'><img src=i/helth.gif width='10' height='$widthhp' border=0 alt='Уровень жизни: $hp/$hp_max'><img src=i/_helth_.gif width='10' height=10 border=0 alt='Уровень жизни: $hp/$hp_max'></td>
<td>&nbsp;</td>
</tr>
</table>
</td>


<td valign=top>

<table width=100% border=0 cellspacing=0 cellpadding=0 bordercolor=A5A5A5 height=60><tr><td align=center valign=center><small style='COLOR: Red; font-weight: bold'>$hp/$hp_max</small></td></tr></table>

<script language=JavaScript>
edit_page=2;
view_item('".$w_img['2']."','w2','60','20',\"".$w['2']."\",1);
view_item('".$w_img['3']."','w3','60','60',\"".$w['3']."\",1);
view_item('".$w_img['4']."','w4','60','80',\"".$w['4']."\",1);
view_item('".$w_img['6']."','w6','20','20',\"".$w['6']."\");
view_item('".$w_img['7']."','w7','20','20',\"".$w['7']."\");
view_item('".$w_img['8']."','w8','20','20',\"".$w['8']."\",1);
</script>



</td>

<td align=center width=100>

<script language=JavaScript>
view_item('".$w_img['1']."','w1','60','60',\"".$w['1']."\",1);
</script>
<img src='i/img/".$obraz.".gif' border=0 width=100 height=225 onmouseover=\"it('".$info['user']."');\" onmouseout=\"c();\">

<script language=JavaScript>
view_item('".$w_img['13']."','w13','60','40',\"".$w['13']."\",1);
</script>

</td>


<td align=center width=62 valign=top>

<table width=100% border=0 cellspacing=0 cellpadding=0 bordercolor=A5A5A5 height=60><tr><td align=center valign=center><small style='COLOR: Blue; font-weight: bold'>$energy/$energy_max</small></td></tr></table>

<script language=JavaScript>
view_item('".$w_img['14']."','w14','60','40',\"".$w['14']."\",1);
view_item('".$w_img['15']."','w15','60','40',\"".$w['15']."\",1);
view_item('".$w_img['5']."','w5','60','60',\"".$w['5']."\",1);
view_item('".$w_img['9']."','w9','60','40',\"".$w['9']."\",1);
</script>



</td>



<td valign=top algin=center>

<table cellspacing=0 cellpadding=0 border=0 align=center width=10>
<tr><td height=60>&nbsp;</td></tr>
<tr><td>&nbsp;</td>
<td width=10 title='Уровень энергии: $energy/$energy_max' align=center valign=bottom height=200><img src=i/_energy.gif width='10' height=10 border=0 alt='Уровень энергии: $energy/$energy_max'><img src=i/energy.gif width='10' height='$widthenergy' border=0 alt='Уровень энергии: $energy/$energy_max'><img src=i/_energy_.gif width='10' height=10 border=0 alt='Уровень энергии: $energy/$energy_max'></td>
<td>&nbsp;</td>
</table>



</td>

<td valign=top algin=center>

<table cellspacing=0 cellpadding=0 border=0 align=center width=10>
<tr><td height=60>&nbsp;</td></tr>
<tr><td>&nbsp;</td>
<td width=10 title='Уровень активности: $ustal/$ustal_max' align=center valign=bottom height=200><img src=i/_ustal.gif width='10' height=10 border=0 alt='Уровень активности: $ustal/$ustal_max'><img src=i/ustal.gif width='10' height='$widthustal' border=0 alt='Уровень активности: $ustal/$ustal_max'><img src=i/_ustal_.gif width='10' height=10 border=0 alt='Уровень активности: $ustal/$ustal_max'></td>
<td>&nbsp;</td>
</table>


</td>



</tr>
</table>";

							?></td>
							</tr>
							<tr>
								<td align=center><BR>
								<HR color=965640>

								<table cellspacing=0 cellpadding=0>
									<FORM action='' method=GET>
									
									
									<TR height=20>
										<td><img src='i/index/ldi.gif'
											onmouseover="hint('Для поиска персонажа, Вам необходимо:<BR>&bull; ввести его логин в текстовом поле<BR>&bull; нажать клавишу Enter');"
											onmouseout="c();"></td>
										<td bgcolor=#D2A280><INPUT type=text class=auth name=login
											style='TEXT-ALIGN: Center'
											onBlur="if (value == '') {value='<?=$info['user']?>'}"
											onFocus="if (value == '<?=$info['user']?>') {value =''}"
											value="<?=$info['user']?>"></td>
										<td><img src='i/index/rda.gif'></td>
									</TR>
									</FORM>
								</TABLE>

								<HR color=965640>


								<?
								$cur_rum = $info['room'];
								include ('inc/rooms.php');

								if (time() - $info['lpv'] <= 180 || $info['rank'] == 60)
								echo"<font color=green>Персонаж сейчас <b>OnLine</b></font><BR><FONT style='FONT-SIZE: 9pt; COLOR: 965640;'><b>$roomname[$cur_rum]</b></font>";
								else
								echo"<font color=red>Персонаж сейчас <b>не в игре</b></font>";

								if ($info['battle']) echo"<br><small>Персонаж в поединке</small>";
								if ($info['w_time']) echo"<br><small>Персонаж на работе</small>";




								?></td>
							</tr>
						</table>

						</TD>
					</TR>
				</TABLE>

				</TD>


			</TR>
		</TABLE>

		</TD>
	</TR>

	<TR height=5>

	</TR>
</TABLE>

								<?
								$_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp`, SUM(objects.`energy`) as `energy`, SUM(objects.`strength`) as `strength`, SUM(objects.`dex`) as `dex`, SUM(objects.`agility`) as `agility`, SUM(objects.`vitality`) as `vitality`, SUM(objects.`razum`) as `razum`, SUM(objects.`br1`) as `br1`, SUM(objects.`br2`) as `br2`, SUM(objects.`br3`) as `br3`, SUM(objects.`br4`) as `br4`, SUM(objects.`br5`) as `br5`, SUM(objects.`krit`) as `krit`, SUM(objects.`unkrit`) as `unkrit`, SUM(objects.`uv`) as `uv`, SUM(objects.`unuv`) as `unuv`, SUM(objects.`min_d`) as `min_d`, SUM(objects.`max_d`) as `max_d` FROM slots, objects WHERE slots.id='".$info['id']."'  AND objects.user='".$info[user]."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));




								$adderet_tvoi=(($info['krit']+$info['unkrit']+$info['uv']+$info['unuv'])*0.1)+(($info['strength']+$info['dex']+$info['agility']+$info['vitality']+$info['power']+$info['razum'])*0.2)+(($info['max']+$info['min'])*0.1);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////КОНЕЦ БЛОКА С ПЕРСОМ
?>