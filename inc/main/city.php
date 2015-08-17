<?
$now=time();


if ($set=="map") {

	###ГОРОД
	if ($room == "0") {

		$user_offer=mysql_fetch_array(
		mysql_query(
    "select offers.time,offers.type,participants.side from offers, participants
       where offers.time>$now
         and offers.done=0
         and participants.time=offers.time
         and participants.id=$stat[id]"));

		if (empty($user_offer['time'])) {

			mysql_query("UPDATE online SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");

			echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"world.php?tmp=$now\";
top.frames['online'].location = top.frames['online'].location;
//-->
</SCRIPT>
";

			exit();

		} else { $nms="Вы подали заявку и пытаетесь убежать с поля битвы! Нехорошо..."; }
	}
	###


	elseif ($room=="1" || $room=="2") {


		mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");


		echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['online'].location = top.frames['online'].location;
//-->
</SCRIPT>
";

		###ТОорговый зал
	} else if ($room=="111") {
		if ($stat[level]>="4") {


			mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");


			echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"mylots.php\";
top.frames['online'].location = top.frames['online'].location;
//-->
</SCRIPT>
";
		}

		else
		echo"
  <SCRIPT LANGUAGE='JavaScript'>
<!--
alert('Войти в эту комнату Вы сможете только с 4 уровня');
//-->
        </SCRIPT>
";
		###

		###ЗАЛ войнов 1
	} else if ($room=="3") {
		if ($stat[level]>="2") {


			mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");


			echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['online'].location = top.frames['online'].location;
//-->
</SCRIPT>
";
		}
		else

		echo"
  <SCRIPT LANGUAGE='JavaScript'>
<!--
alert('Войти в эту комнату Вы сможете только с 2 уровня');
//-->
        </SCRIPT>
";
		###




		###ЗАЛ войнов 2
	} else if ($room=="4") {
		if ($stat[level]>="2") {

			mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");


			echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['online'].location = top.frames['online'].location;
//-->
</SCRIPT>
";
		}

		else
		echo"
  <SCRIPT LANGUAGE='JavaScript'>
<!--
alert('Войти в эту комнату Вы сможете только с 2 уровня');
//-->
        </SCRIPT>
";
		###


	}
}

include('inc/header.php');

$stat = mysql_fetch_array(mysql_query("SELECT * FROM `players` WHERE `user` = '".$_COOKIE['user']."' AND `pass` = '".$_COOKIE['pass']."' LIMIT 1"));


if($stat[exp]<20) {include('inc/main/helper.html');}
if($stat[level]>=0 & $stat[referer_r]>0 & $stat[referer]>0) {
	$us = mysql_fetch_array(mysql_query("SELECT * FROM players WHERE id=$stat[referer] LIMIT 1"));

	mysql_query("UPDATE players set friends=friends+1 where id=$stat[referer]");
	mysql_query("UPDATE `top` SET `rfs` = `rfs`+'1' WHERE `clan` = '".$us['tribe']."'");
	mysql_query("UPDATE players set referer_r=referer_r-1 where id=$stat[id]");
}
?>


<script language="javascript" type="text/javascript">
function imover(im)
{
  im.filters.Glow.Enabled=true;
}
function imout(im)
{
  im.filters.Glow.Enabled=false;
}
</script>

<style type="text/css">
img.aFilter {
	filter: Glow(color = #FFFFFF, Strength = 4, Enabled = 0);
	cursor: hand
}
</style>
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
						<table border='0' width='100%' height='100%' cellspacing='0'
							cellpadding='0'>
							<tr>
								<td width='100%' align='center'>
								<p><span style="position: relative;"ione"> <img border="0"
									galleryimg=no src="i/komnati/komnata.jpg" width="300"
									height="247"> <span
									style="position: absolute; left: 133; top: 22; z-index: 1; filter: progid : DXImageTransform.Microsoft.Alpha (   Opacity = 100, Style = 0 );">
								<img border="0" src="i/komnati/exit.gif" width="41" height="57"
									alt='Выход в Город' class=aFilter onmouseover="imover(this);"
									onmouseout="imout(this)"
									onclick="window.location='main.php?set=map&room=0<?echo"&tmp=$now";?>'"></span>
								<span
									style="position: absolute; left: 208; top: 47; z-index: 1; filter: progid : DXImageTransform.Microsoft.Alpha (   Opacity = 100, Style = 0 );">
								<img border="0" src="i/komnati/novi_zal_1.gif" width="44"
									height="41" alt='Комната Новичков 1' class=aFilter
									onmouseover="imover(this);" onmouseout="imout(this)"
									onclick="window.location='main.php?set=map&room=1<?echo"&tmp=$now";?>'"></span>
								<span
									style="position: absolute; left: 231; top: 110; z-index: 1; filter: progid : DXImageTransform.Microsoft.Alpha (   Opacity = 100, Style = 0 );">
								<img border="0" src="i/komnati/novi_zal_2.gif" width="42"
									height="40" alt='Комната Новичков 2' class=aFilter
									onmouseover="imover(this);" onmouseout="imout(this)"
									onclick="window.location='main.php?set=map&room=2<?echo"&tmp=$now";?>'"></span>
								<span
									style="position: absolute; left: 43; top: 51; z-index: 1; filter: progid : DXImageTransform.Microsoft.Alpha (   Opacity = 100, Style = 0 );">
								<img border="0" src="i/komnati/torg_zal.gif" width="57"
									height="17" alt='Торговый Зал' class=aFilter
									onmouseover="imover(this);" onmouseout="imout(this)"
									onclick="window.location='main.php?set=map&room=111<?echo"&tmp=$now";?>'"></span>
								<span
									style="position: absolute; left: 47; top: 190; z-index: 1; filter: progid : DXImageTransform.Microsoft.Alpha (   Opacity = 100, Style = 0 );">
								<img border="0" src="i/komnati/voin_zal_1.gif" width="57"
									height="15" alt='Зал Войнов 1' class=aFilter
									onmouseover="imover(this);" onmouseout="imout(this)"
									onclick="window.location='main.php?set=map&room=3<?echo"&tmp=$now";?>'"></span>
								<span
									style="position: absolute; left: 196; top: 190; z-index: 1; filter: progid : DXImageTransform.Microsoft.Alpha (   Opacity = 100, Style = 0 );">
								<img border="0" src="i/komnati/voin_zal_2.gif" width="56"
									height="15" alt='Зал Войнов 2' class=aFilter
									onmouseover="imover(this);" onmouseout="imout(this)"
									onclick="window.location='main.php?set=map&room=4<?echo"&tmp=$now";?>'"></span></p>
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
