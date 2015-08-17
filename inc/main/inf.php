<div id="hint1" class="hint1" style="visibility: hidden;"></div>

<?
$name = HtmlSpecialChars($name);

if ($set=="edit") {
	if ($do == "wear") {
		if ($a == "del") {
			mysql_query("DELETE FROM complects WHERE id=$id");
		}
		else {
			$COMP_SEL = mysql_query("SELECT * from complects WHERE id='$id'");
			$c = mysql_fetch_array($COMP_SEL);
			$i = 0;
			while  ($i <= 19) {
				$i++;
				#echo "$c[$i] | ";
				if ($stat['bs'] == 1) {
					$sel = mysql_query("SELECT * FROM objects WHERE id = $c[$i] AND komis=0 AND bank=0 AND lam=0 AND pochta=0 AND mag=0 AND bs=1");
				} else {
					$sel = mysql_query("SELECT * FROM objects WHERE id = $c[$i] AND komis=0 AND bank=0 AND lam=0 AND pochta=0 AND mag=0 AND bs=0");
				}
				if (mysql_num_rows($sel) == 0) {
					$c[$i] = 0;
					#echo "$c[$i]  <hr>";
				}
				else {
					$objects=mysql_fetch_array($sel);
					$obj_inf=explode("|",$objects['inf']);
					$obj_min=explode("|",$objects['min']);
					if (($stat['level'] < $obj_min['0'] || $stat['strength'] < $obj_min['1'] || $stat['dex'] < $obj_min['2'] || $stat['agility'] < $obj_min['3'] || $stat['vitality'] < $obj_min['4'] || $stat['razum'] < $obj_min['5'] || ($stat['rase'] != $obj_min['6'] && $obj_min['6'] != 0 AND $stat['rase'] != 100) || ($obj_min['7'] != 0 && $stat['proff'] != $obj_min['7'])) || $obj['tip'] == 13 || $obj_inf[6]>=$obj_inf[7]){
						$c[$i] = 0;
					}
				}
			}
			mysql_query("UPDATE slots set slots.1=$c[1], slots.2=$c[2], slots.3=$c[3], slots.4=$c[4], slots.5=$c[5], slots.6=$c[6], slots.7=$c[7], slots.8=$c[8], slots.9=$c[9], slots.10=$c[10], slots.11=$c[11], slots.12=$c[12], slots.13=$c[13], slots.14=$c[14], slots.15=$c[15], slots.16=$c[16], slots.17=$c[17], slots.18=$c[18], slots.19=$c[19] WHERE id = $stat[id]");
		}
	}
}
?>
<script src="/i/chat.js"></script>
<script type="text/javascript">
function refreshHP(){ 
    doLoad('/Info_server.php');
    
    setTimeout('refreshHP()',800);    
    }
</script>
<table width="259" height="393" border="0" cellpadding="0"
	cellspacing="0">
	<tr>
		<td colspan="3" background="i/pri_01.gif" align="center">

		<table border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="32" height="30"><img border="0"
					src="i/pers_name_left.gif" width="32" height="30"></td>
				<td height="30" background="i/pers_name_center.gif" valign="middle"
					align="center"><font face='Verdana' size='1' color='#ffffff'><b> <?
					echo "<script language=JavaScript>";
					if ($set=="edit") echo"var edit_page=1;"; else echo"var edit_page=0;";
					echo "show_inf('$stat[user]','$stat[id]','$stat[level]','$stat[rank]','$stat[tribe]');
</script>";
					if ($stat['obraz']) $obraz=$stat['obraz']; else $obraz=$stat['rase']."/".$stat['sex'];

					include('inc/main/alt.php');
					?> </b></font></td>
				<td width="32" height="30"><img border="0"
					src="i/pers_name_right.gif" width="32" height="30"></td>
			</tr>
		</table>


		</td>
	</tr>
	<tr>
		<td><img src="i/pri_07.gif" width="29" height="8" alt=""></td>
		<td><img src="i/pri_08.gif" width="200" height="8" alt=""></td>
		<td><img src="i/pri_09.gif" width="30" height="8" alt=""></td>
	</tr>
	<tr>
		<td><img src="i/pri_10.gif" width="29" height="8" alt=""></td>
		<td>

		<table border="0" width="200" height="8" cellspacing="0"
			cellpadding="0">
			<tr>
				<td width="4" height="8"><img border="0" src="i/pers_name_hp01.gif"
					width="4" height="8"></td>
				<td width='192' height='8' id=info ></td>

<?// echo "<td width='192' height='8'><img src=i/vault/navigation/hp/_helth.gif width='10' height=8 border=0 alt='Уровень жизни: $hp/$hp_max'><img src=i/vault/navigation/hp/helth.gif height='8' width='$widthhp' border=0 alt='Уровень жизни: $hp/$hp_max'><img src=i/vault/navigation/hp/_helth_.gif width='10' height='8' border=0 alt='Уровень жизни: $hp/$hp_max'></td>"; ?>
				<td width="4" height="8"><img border="0" src="i/pers_name_hp03.gif"
					width="4" height="8"></td>
			</tr>

		</table>
		</td>
		<td><img src="i/pers1_12.gif" width="30" height="8" alt=""></td>
	</tr>
	<tr>
		<td><img src="i/pers1_13.gif" width="29" height="1" alt=""></td>
		<td><img src="i/pers1_14.gif" width="200" height="1" alt=""></td>
		<td><img src="i/pers1_15.gif" width="30" height="1" alt=""></td>
	</tr>
	<tr>
		<td><img src="i/pers1_16.gif" width="29" height="7" alt=""></td>
		<td>

		<table border="0" width="200" height="7" cellspacing="0"
			cellpadding="0" background="i/pers_name_ua02.gif">
			<tr>
				<td width="4" height="7"><img border="0" src="i/pers_name_ua01.gif"
					width="4" height="7"></td>
				<td width='192' height='7' id='energ' ></td>
				<td width="4" height="7"><img border="0" src="i/pers_name_ua03.gif"
					width="4" height="7"></td>
			</tr>
			<tr>
			<td colspan=3 id=exp></td>
			</tr>
			
			
		</table>



		</td>
		<td><img src="i/pri_18.gif" width="30" height="7" alt=""></td>
	</tr>
	<tr>
		<td><img src="i/pri_19.gif" width="29" height="14" alt=""></td>
		<td><img src="i/pri_20.gif" width="200" height="14" alt=""></td>
		<td><img src="i/pri_21.gif" width="30" height="14" alt=""></td>
	</tr>
	<tr>
		<td background="i/pri_22.gif" width="29" height="200"><img
			src="i/pri_22.gif" width="29" height="200" alt=""></td>
		<td><?
		echo"        <table width='100%' height='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
<td valign=top>
<script language=JavaScript>
view_item('".$w_img['1']."','w1','60','40',\"".$w['1']."\",1);
view_item('".$w_img['3']."','w3','60','60',\"".$w['3']."\",1);
view_item('".$w_img['4']."','w4','60','60',\"".$w['4']."\",1);
view_item('".$w_img['13']."','w13','60','40',\"".$w['13']."\");
</script>
</td>
<td align=center width=80><img src='i/img/".$obraz.".gif' border=0 width=80 height=200 onmouseover=\"it('".$stat['user']."');\" onmouseout=\"c();\"></td>
<td valign=top>
<script language=JavaScript>
view_item('".$w_img['2']."','w2','60','20',\"".$w['2']."\",1);
view_item('".$w_img['14']."','w14','60','30',\"".$w['14']."\",1);
view_item('".$w_img['6']."','w6','20','20',\"".$w['6']."\");
view_item('".$w_img['7']."','w7','20','20',\"".$w['7']."\");
view_item('".$w_img['8']."','w8','20','20',\"".$w['8']."\",1);
view_item('".$w_img['10']."','w10','20','20',\"".$w['10']."\");
view_item('".$w_img['11']."','w11','20','20',\"".$w['11']."\");
view_item('".$w_img['12']."','w12','20','20',\"".$w['12']."\",1);
view_item('".$w_img['5']."','w5','60','50',\"".$w['5']."\",1);
view_item('".$w_img['9']."','w9','60','30',\"".$w['9']."\",1);
view_item('".$w_img['15']."','w15','60','30',\"".$w['15']."\",1);
</script>    </td>          </tr>
        </table>
";

		?></td>
		<td background="i/pri_24.gif" width="30" height="200"><img
			src="i/pri_24.gif" width="30" height="200" alt=""></td>
	</tr>
	<tr>
		<td><img src="i/pri_25.gif" width="29" height="22" alt=""></td>
		<td><img src="i/pri_26.gif" width="200" height="22" alt=""></td>
		<td><img src="i/pri_27.gif" width="30" height="22" alt=""></td>
	</tr>
	<tr>
		<td><img src="i/pri_28.gif" width="29" height="66" alt=""></td>
		<td><?

		echo"        <table width='100%' height='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
<td align='center'>
        <script language=JavaScript>
view_item('".$w_img['17']."','w17','44','30',\"".$w['17']."\",0,'".$w_title['17']."','".$w_id['17']."');
</script>
</td>
<td align=center id='sdoll'><table width=40><tr><td><table><tr height=10><td width=10></td><td width=20 bgcolor=green></td><td width=10></td></tr><tr height=20><td width=10 bgcolor=green></td><td width=20 bgcolor=green></td><td width=10 bgcolor=green></td></tr><tr height=20><td width=10></td><td width=20 bgcolor=green></td><td width=10></td></tr></table></td></tr></table></td>
<td align='center'>
        <script language=JavaScript>
view_item('".$w_img['18']."','w18','44','30',\"".$w['18']."\",0,'".$w_title['18']."','".$w_id['18']."');
</script>
    </td>          </tr>
        </table>
";
		?></td>
		<td><img src="i/pri_30.gif" width="30" height="66" alt=""></td>
	</tr>
	<tr>
		<td><img src="i/pri_31.gif" width="29" height="37" alt=""></td>
		<td><img src="i/pri_32.gif" width="200" height="37" alt=""></td>
		<td><img src="i/pri_33.gif" width="30" height="37" alt=""></td>
	</tr>
</table>
		<?
		if ($set=="edit") {
			?>
<table width='259'>
	<tr>
		<td valign='top'>



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
										<td width='100%'>



										<div align='center'>
										<form method='POST' action='main.php?set=edit&do=compl'
											name='reg'>
										<table border='1' background='i/inman_fon2.gif'
											cellpadding='0' cellspacing='0'
											style='border-collapse: collapse; border-style: solid; padding: 2'
											bordercolor='#D8C792' height='98%' width='98%'>
											<tr>
												<td width='100%' align='center' colspan='2'><b>Комплекты</b></td>
											</tr>
											<tr>
												<td width='100%' height='100%' valign='top' align='left'
													colspan='2'><?
													if ($do == "compl") {
														$new = HtmlSpecialChars($new);
														$SEL = mysql_query("SELECT * from slots WHERE id=$stat[id]");
														$S = mysql_fetch_array($SEL);
														$name = $new;
														mysql_query("INSERT INTO complects (user_id, name, complects.1, complects.2, complects.3, complects.4, complects.5, complects.6, complects.7, complects.8, complects.9, complects.10, complects.11, complects.12, complects.13, complects.14, complects.15, complects.16, complects.17, complects.18, complects.19) values('$stat[id]', '$name', '$S[1]', '$S[2]', '$S[3]', '$S[4]', '$S[5]', '$S[6]', '$S[7]', '$S[8]', '$S[9]', '$S[10]', '$S[11]', '$S[12]', '$S[13]', '$S[14]', '$S[15]', '$S[16]', '$S[17]', '$S[18]', '$S[19]')");
													}
													$COMP_SEL = mysql_query("SELECT * from complects WHERE user_id='".$stat[id]."'");
													while ($c = mysql_fetch_array($COMP_SEL)) {
														echo "-> <a href=main.php?set=edit&do=wear&id=$c[id]>$c[name]</a> <a href=main.php?set=edit&do=wear&a=del&id=$c[id]><img src=i/drop.gif></a><br>";
													}
													?></td>
											</tr>
											<tr>
												<td width='100%' align='center' colspan='2'>Запомнить: <input
													type='text' name='new' style='width: 50;' class='input'
													maxLength=20 value=''> <input type=submit value='>>'
													class='input'></td>
											</tr>
										</table>
										
										</div>

										</td>
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



		</td>
	</tr>
</table>
</form>
<?
}
?>
<body onload="refreshHP()"></body>