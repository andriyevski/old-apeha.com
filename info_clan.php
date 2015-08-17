<?php
include('inc/db_connect.php');
$klan=mysql_fetch_array(mysql_query("SELECT * FROM top where clan='$name'"));
echo"
<div id=hint1 class=hint></div>

<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/time.js\"></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/show_inf.js\"></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/login_form.js\"></SCRIPT>
";
?>
<META
	HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
<link
	type="text/css" rel="StyleSheet" href="i/clan_infa.css">
<body topmargin="0" leftmargin="0" background="i/fon.gif">
<title>Падшие Ангелы - [ Информация о клане <?=$klan[clan]?> ]</title>
<table border="0" width="100%" height="100%" cellspacing="0"
	cellpadding="0">
	<tr>
		<td width="40" height="40" background="i/left_border_fon.gif"><img
			border="0" src="i/left_top_corner.gif" width="40" height="40"></td>
		<td height="40" width="100%" background="i/top_fon.gif">
		<table border="0" width="100%" cellspacing="0" cellpadding="0"
			height="40">
			<tr>
				<td width="26" height="40"><img border="0" src="i/top_left.gif"
					width="26" height="40"></td>
				<td width="100%">
				<p align="center"><img border="0" src="i/top_center1.gif" width="70"
					height="40">
				
				</td>
				<td width="26" height="40"><img border="0" src="i/top_right.gif"
					width="26" height="40"></td>
			</tr>
		</table>
		</td>
		<td width="40" height="40" background="i/right_border_fon.gif"><img
			border="0" src="i/right_top_corner.gif" width="40" height="40"></td>
	</tr>
	<tr>
		<td width="40" height="100%" background="i/left_border_fon.gif">
		<table border="0" width="40" height="100%" cellspacing="0"
			cellpadding="0">
			<tr>
				<td width="40" height="35"><img border="0"
					src="i/left_border_up.gif" width="40" height="35"></td>
			</tr>
			<tr>
				<td width="40" height="100%"></td>
			</tr>
			<tr>
				<td width="40" height="44"><img border="0"
					src="i/left_border_down.gif" width="40" height="44"></td>
			</tr>
		</table>
		</td>
		<td height="100%" width="100%" valign="top" align="center">

		<table border="0" width="488" cellspacing="0" cellpadding="0">
			<tr>
				<td width="488" height="25"></td>
			</tr>
			<tr>
				<td width="488" height="12" background="i/clan_102.gif">
				<table border="0" width="488" height="12" cellspacing="0"
					cellpadding="0">
					<tr>
						<td width="190" height="12"><img border="0" src="i/clan_101.gif"
							width="190" height="12"></td>
						<td width="108" height="12"></td>
						<td width="190" height="12"><img border="0" src="i/clan_103.gif"
							width="190" height="12"></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td width="100%">
				<table border="0" width="488" height="35" cellspacing="0"
					cellpadding="0">
					<tr>
						<td width="190" height="35" background="i/clan_202.gif"><img
							border="0" src="i/clan_201.gif" width="190" height="35"></td>
						<td width="108" height="35" background="i/clan_202.gif">
						<p align="center"><b><font face="Verdana" color="#FFFFFF" size="2"><?=$klan['clan']?></font></b>
						
						</td>
						<td width="190" height="35" background="i/clan_202.gif"><img
							border="0" src="i/clan_203.gif" width="190" height="35"></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td width="488" height="14"><img border="0" src="i/clan_300.gif"
					width="488" height="14"></td>
			</tr>
			<tr>
				<td width="100%">
				<table border="0" width="488" height="17" cellspacing="0"
					cellpadding="0">
					<tr>
						<td width="77" height="17" background="i/clan_202.gif"><img
							border="0" src="i/clan_401.gif" width="77" height="17"></td>
						<td width="334" height="17" background="i/clan_402.gif"
							align="center"><font color="white" size="2" face="Verdana"> <a
							class="link_clan"
							href="info_clan.php?name=<?=$klan['clan']?>&mode=logo">Главная</a>
						| <a class="link_clan"
							href="info_clan.php?name=<?=$klan['clan']?>&mode=info">Информация</a>
						| <a class="link_clan"
							href="info_clan.php?name=<?=$klan['clan']?>&mode=members">Состав</a>
						| <a class="link_clan"
							href="info_clan.php?name=<?=$klan['clan']?>&mode=law">Законы</a>
						</font></td>
						<td width="77" height="17" background="i/clan_202.gif"><img
							border="0" src="i/clan_403.gif" width="77" height="17"></td>
					</tr>
				</table>
				</td>
			</tr>

			<tr>
				<td width="488" height="10"><img border="0" src="i/clan_800_1.gif"
					width="488" height="10"></td>
			</tr>
			<tr>
				<td width="488" height="100%">
				<table border="0" width="488" height="100%" cellspacing="0"
					cellpadding="0">
					<tr>
						<td width="44" height="100%">
						<table border="0" width="44" height="100%" cellspacing="0"
							cellpadding="0">
							<tr>
								<td width="44" height="126" background="i/clan_912.gif"><img
									border="0" src="i/clan_913_1.gif" width="44" height="126"></td>
							</tr>

							<tr>
								<td width="44" height="100%" background="i/clan_912.gif">&nbsp;</td>
							</tr>
							<tr>
								<td width="44" height="129" background="i/clan_912.gif"><img
									border="0" src="i/clan_913.gif" width="44" height="129"></td>
							</tr>
						</table>
						</td>
						<td width="400" height="100%" background="i/clan_902.gif"
							valign=top><?php
							if ($mode=="logo") {
								if (!empty($name)) {
									echo"
<table align=center><tr>
	<td><font face='Verdana' size='1'><b>История клана</b></font></td>
</tr></table>
<table valign='top' height='100%' width='100%'><tr><td valign='top' height='100%' width='100%' style='border-style: solid; border-width: 2; padding: 8' bordercolor='#D8C792'>
<font face='Verdana' size='1'>
$klan[history]
</font>
</td></tr></table>"; }
							}
							if ($mode=="law") {
								if (!empty($name)) {
									echo"			<table align=center><tr>
	<td><font face='Verdana' size='1'><b>Законы клана</b></font></td>
</tr></table>
<table height='100%' width='100%'><tr><td valign='top' height='100%' width='100%' style='border-style: solid; border-width: 2; padding: 8' bordercolor='#D8C792'>
<font face='Verdana' size='1'>
$klan[law]
</font>
</td></tr></table>"; }
							}
							if ($mode=="info") {
								if (!empty($name)) {
									echo"
			<table align=center><tr>
	<td><font face='Verdana' size='1'><b>Уровень клана</b></font></td>
</tr></table>
<table width='100%'><tr><td align='center' height='100%' width='100%' style='border-style: solid; border-width: 2; padding: 8' bordercolor='#D8C792'>
<font face='Verdana' size='1'>";

									if ( $klan[lvl] == 1 ) {
										echo"Первая ступень";}
										elseif ( $klan[lvl] == 2 ) {
											echo"Вторая ступень";}
											elseif ( $klan[lvl] == 3 ) {
												echo"Третья ступень";}

												echo"
</font>
</td></tr></table>";
												echo"
			<table align=center><tr>
	<td><font face='Verdana' size='1'><b>Сайт клана</b></font></td>
</tr></table>
<table width='100%'><tr><td align='center' height='100%' width='100%' style='border-style: solid; border-width: 2; padding: 8' bordercolor='#D8C792'>
<a class='link_clan2' href='$klan[url]' target='_blank'>$klan[url]</a>
</td></tr></table>";
												echo"
			<table align=center><tr>
	<td><font face='Verdana' size='1'><b>Вступление</b></font></td>
</tr></table>
<table width='100%'><tr><td height='100%' width='100%' style='border-style: solid; border-width: 2; padding: 8' bordercolor='#D8C792'>
<font face='Verdana' size='1'>
$klan[vstup]
</font>
</td></tr></table>";
								}
							}
							if ($mode=="members") {
								if (!empty($name)) {
									$SostQuery=mysql_query("SELECT user, id, level, tribe, b_tribe, tribe_rank, rank, lpv FROM players WHERE tribe='$name' ORDER BY user");



									echo"			<table align=center><tr>
	<td><font face='Verdana' size='1'><b>Состав клана</b></font></td>
</tr></table><table cellpadding=3 width=100% cellspacing=1 border=1 bordercolor=#D8C792>";

									echo"<SCRIPT language=JavaScript>
        function s (user,id,level,rank,tribe,status,st) {
        if (status == 0)
                status='<font color=red face=Verdana size=1><b>OffLine</b></font>';
        else
                status='<font color=green face=Verdana size=1><b>OnLine</b></font>';
        document.write('<tr><td align=center valign=center>'+status+'</td><td width=150><img src=\'i/align'+rank+'.gif\'><img src=\'i/klan/'+tribe+'.gif\' width=12 height=12><font face=Verdana size=1><b>'+user+'</b> ['+level+']</font> <a href=\'inf.php?'+id+'\' target=_blank style=\"text-decoration: none\"><img src=\'i/inf.gif\'></a></td><td><font face=Verdana size=1>'+st+'</font></td></tr>'); }
        ";

									for ($j=0; $j<mysql_num_rows($SostQuery); $j++) {
										$sostav=mysql_fetch_array($SostQuery);

										if ($sostav['b_tribe'] == 1)
										$st="<font color=red><b>Глава гильдии</b></font>";
										elseif ($sostav['rank'] == 99)
										$st="<font color=red><b>Верховный Инквизитор</b></font>";
										elseif (!empty($sostav['tribe_rank']))
										$st="$sostav[tribe_rank]";
										else
										$st="&nbsp;";

										if (time() - $sostav['lpv'] > 180)
										$status = 0;
										else
										$status = 1;
										echo"s('".$sostav['user']."','$sostav[id]','$sostav[level]','$sostav[rank]','$sostav[tribe]','$status','$st');";
									}
									echo"
        </script>
        </table>";

								}
							}
							?></td>

						<td width="44" height="100%">

						<table border="0" width="44" height="100%" cellspacing="0"
							cellpadding="0">
							<tr>
								<td width="44" height="126" background="i/clan_932.gif"><img
									border="0" src="i/clan_933_1.gif" width="44" height="126"></td>
							</tr>

							<tr>
								<td width="44" height="100%" background="i/clan_932.gif">&nbsp;</td>
							</tr>
							<tr>
								<td width="44" height="129" background="i/clan_932.gif"><img
									border="0" src="i/clan_933.gif" width="44" height="129"></td>
							</tr>
						</table>



						</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td width="488" height="53" background="i/clan_1002.gif">
				<table border="0" width="488" height="53" cellspacing="0"
					cellpadding="0">
					<tr>
						<td width="157" height="53"><img border="0" src="i/clan_1001.gif"
							width="157" height="53"></td>
						<td width="174" height="53"></td>
						<td width="157" height="53"><img border="0" src="i/clan_1003.gif"
							width="157" height="53"></td>
					</tr>
				</table>
				</td>
			</tr>

		</table>

		</td>
		<td width="40" height="100%" background="i/right_border_fon.gif">
		<table border="0" width="40" height="100%" cellspacing="0"
			cellpadding="0">
			<tr>
				<td width="40" height="35"><img border="0"
					src="i/right_border_up.gif" width="40" height="35"></td>
			</tr>
			<tr>
				<td width="40" height="100%"></td>
			</tr>
			<tr>
				<td width="40" height="44"><img border="0"
					src="i/right_border_down.gif" width="40" height="44"></td>
			</tr>
		</table>


		</td>
	</tr>
	<tr>
		<td width="40" height="42" background="i/left_border_fon.gif"><img
			border="0" src="i/left_down_corner.gif" width="40" height="42"></td>
		<td height="42" width="100%">
		<table border="0" width="100%" cellspacing="0" cellpadding="0"
			height="40">
			<tr>
				<td width="26" height="42"><img border="0" src="i/down_left.gif"
					width="26" height="42"></td>
				<td width="100%">
				<p align="center">
				
				</td>
				<td width="26" height="42"><img border="0" src="i/down_right.gif"
					width="26" height="42"></td>
			</tr>
		</table>
		</td>
		<td width="40" height="42" background="i/right_border_fon.gif"><img
			border="0" src="i/right_down_corner.gif" width="40" height="42"></td>
	</tr>
</table>

</body>

</html>
