<table width='100%' border='0' cellspacing='0' cellpadding='0'
	align=center>
	<tr height='22'>
		<td width='20' align='right' valign='bottom'><img
			src='i/town/tbl-shp_sml-corner-top-left.gif' width='20' height='22' /></td>
		<td class='tbl-shp_sml-top' valign='top' align='center'>
		<table border='0' cellspacing='0' cellpadding='0'>
			<tr height='22'>
				<td width='27'><img src='i/town/tbl-usi_label-left.gif' width='27'
					height='22' /></td>
				<td align='center' class='tbl-usi_label-center'>Инстинкты воина -
				Кланы</td>
				<td width='27'><img src='i/town/tbl-usi_label-right.gif' width='27'
					height='22' /></td>
			</tr>
		</table>
		</td>
		<td width='20' align='left' valign='bottom'><img
			src='i/town/tbl-shp_sml-corner-top-right.gif' width='20' height='22' /></td>
	</tr>
	<tr>
		<td class='tbl-usi_left'>&nbsp;</td>
		<td class='tbl-usi_bg' valign='top' style='padding: 6 4 6 4'>



		<meta http-equiv="Content-Type"
			content="text/html; charset=windows-1251">
		<meta http-equiv="Content-Language" content="ru">
		<LINK REL=StyleSheet HREF='style.css' TYPE='text/css'>
		<LINK REL=StyleSheet HREF='city.css' TYPE='text/css'>


		<?
		if (ereg("[<>\\/-]",$log) or ereg("[<>\\/-]",$clan)) {print "?!"; exit();}
		$log=htmlspecialchars($log);
		$clan=htmlspecialchars($clan);
		if(empty($clan)){
			print "Error!!!<BR>";
			print "Неверный запрос.";
			die();
		}
		else{
			include('inc/db_connect.php');
			mysql_query("SET CHARSET cp1251");
			$sql = "SELECT * FROM clan_zayavka WHERE name='$clan'";
			$result = mysql_query($sql);
			$db = mysql_fetch_array($result);



			$name = $db["name"];

			$about = $db["history"];
			$url = $db["site"];
			$i = 0;
			$SEEK = mysql_query("SELECT id FROM players WHERE tribe='$clan'");
			while($D_S = mysql_fetch_array($SEEK))
			{
				$i++;
			}

			$glava = mysql_fetch_array(mysql_query("SELECT * FROM players WHERE tribe='$clan' AND b_tribe='1'"));
			?>

		<html>
		<title>Инстинкты Воина [Информация о клане <?echo $name?>]</title>

		<body topMargin=0 rightMargin=0 bottomMargin=0 bgcolor=#EBEDEC>
		<table width=100%>
			<tr>
				<td align=center width=30% valign=top><br>
				<b>Клан:&nbsp;&nbsp;</b> <img src='i/klan/<?echo $clan?>.gif'> <B><?echo "$clan"?></B><br>
				<br>
				<b>Глава клана:&nbsp;&nbsp;</b><img src='i/klan/<?echo $clan?>.gif'>&nbsp;<?echo "<b>$glava[user]</b> [$glava[level]]<a href='inf.php?$glava[id]' target=new2><img src='i/inf.gif' border=0></a>"?><BR>
				<BR>
				</td>
			</tr>
			<tr>
				<td valign=top align=center><i> <? echo $about ?> </i></td>
			</tr>
			<tr>
				<td valign=top align=center><? print "<br><input type=button class=but value='Сайт клана' onClick=\"window.open('$url') \" style=\"width=150\"  ><BR><BR>" ?>

				<b>В Клане: <font color=green><?echo $i?></font> человек</b><br>
				<br>
				</td>
			</tr>
		</table>
		<?
		}

		?>
		
		</td>
		<td class='tbl-usi_right' align=left>&nbsp;</td>
	</tr>

	<tr height='18'>
		<td width='20' align='right' valign='top'><img
			src='i/town/tbl-shp_sml-corner-bottom-left.gif' width='20'
			height='18' /></td>
		<td class='tbl-shp_sml-bottom' valign='top' align='center'>&nbsp;</td>
		<td width='20' align='left' valign='top'><img
			src='i/town/tbl-shp_sml-corner-bottom-right.gif' width='20'
			height='18' /></td>
	</tr>
</table>
</td>
<TD valign=top align=left>