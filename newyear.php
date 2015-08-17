<?
$now=time();

include("inc/db_connect.php");

$stat = mysql_fetch_array(mysql_query("select user, bloked, t_time, battle, room, ny, forest, credits from players where user='$user' and pass='$pass'"));
mysql_query("SET CHARSET cp1251");
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";
elseif ($stat['room'] != 15) { header("Location: main.php"); exit; }

include("inc/html_header.php");

echo"<body bgcolor=#F5FFD9 leftmargin=0 topmargin=0>";
echo"
<body bgcolor=e2e0e0 leftmargin=0 topmargin=0>
<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
        <td><b>У вас на счету:</b> <u>".$stat[credits]."</u> <b>зм.</b>
        </td>
<td align=right valign=top>
<input class=input type=button value='Обновить' onclick='window.location.href=\"newyear.php?tmp=\"+Math.random();\"\"'>
<input class=input type=button value='Вернуться' onclick='window.location.href=\"world.php?room=0&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";

echo"
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td align=right>
<center><font class=title>С Новым  Годом и Рождеством!!!</font></center><br>";








if (isset($take2)) {
	if ($stat['ny'] >0) $msg="Вы уже получали свой подарки!";
	else {
		mysql_query("UPDATE players SET ny=1 WHERE user='".$stat['user']."'");
		$stat['ny'] = 1;

		$ItTake = "ny_forest";


		$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));

		$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|С Новым 2010 Годом!!!|0|$buyitem[art]|0|$buyitem[iznos]";
		$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";

		mysql_query("INSERT INTO objects (`user`, `inf`, `min`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`,`tip`,`about`) values ('$stat[user]','$inf','$min','$buyitem[br1]','$buyitem[br2]','$buyitem[br3]','$buyitem[br4]','$buyitem[br5]','$buyitem[min]','$buyitem[max]','$buyitem[hp]','$buyitem[energy]','$buyitem[strength]','$buyitem[dex]','$buyitem[agility]','$buyitem[vitality]','$buyitem[razum]','$buyitem[krit]','$buyitem[unkrit]','$buyitem[uv]','$buyitem[unuv]','$now','$buyitem[tip]','$buyitem[about]')");

			

		$msg="<font style='FONT-SIZE: 13pt'><br>Новый Год!</font><BR><BR>Поздравляем с новым 2010 годом и дарим <u>".$buyitem['title']."</u>";



		$ItTake2 = "ny_brona";
		$buyitem2 = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake2."'"));

		$inf="$buyitem2[name]|$buyitem2[title]|$buyitem2[price]|С Новым 2010 Годом!!!|0|$buyitem2[art]|0|$buyitem2[iznos]";
		$min="$buyitem2[min_level]|$buyitem2[min_str]|$buyitem2[min_dex]|$buyitem2[min_ag]|$buyitem2[min_vit]|$buyitem2[min_razum]|$buyitem2[min_rase]|$buyitem2[min_proff]";

		mysql_query("INSERT INTO objects (`user`, `inf`, `min`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`,`tip`,`about`) values ('$stat[user]','$inf','$min','$buyitem2[br1]','$buyitem2[br2]','$buyitem2[br3]','$buyitem2[br4]','$buyitem2[br5]','$buyitem2[min]','$buyitem2[max]','$buyitem2[hp]','$buyitem2[energy]','$buyitem2[strength]','$buyitem2[dex]','$buyitem2[agility]','$buyitem2[vitality]','$buyitem2[razum]','$buyitem2[krit]','$buyitem2[unkrit]','$buyitem2[uv]','$buyitem2[unuv]','$now','$buyitem2[tip]','$buyitem2[about]')");

		$msg.="<br> и <u>".$buyitem2['title']."</u>";

	}
}



if (isset($take3)) {
	if ($stat['forest'] >0) $msg="Вы уже получали свой подарок!";
	else {
		mysql_query("UPDATE players SET forest=1 WHERE user='".$stat['user']."'");
		$stat['forest'] = 1;

		$ItTake = "ny_meshok";


		$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));

		$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|С рождеством!!!|0|$buyitem[art]|0|$buyitem[iznos]";
		$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";

		mysql_query("INSERT INTO objects (`user`, `inf`, `min`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`,`tip`,`about`) values ('$stat[user]','$inf','$min','$buyitem[br1]','$buyitem[br2]','$buyitem[br3]','$buyitem[br4]','$buyitem[br5]','$buyitem[min]','$buyitem[max]','$buyitem[hp]','$buyitem[energy]','$buyitem[strength]','$buyitem[dex]','$buyitem[agility]','$buyitem[vitality]','$buyitem[razum]','$buyitem[krit]','$buyitem[unkrit]','$buyitem[uv]','$buyitem[unuv]','$now','$buyitem[tip]','$buyitem[about]')");
			
		$msg="<font style='FONT-SIZE: 13pt'><br>Рождество!!!</font><BR><BR>Поздравляем с рождеством и дарим <u>".$buyitem['title']."</u>";
	}
}





if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";


echo"
<fieldset style='WIDTH: 98.6%'><legend>Получить подарок</legend>
<table width=100% cellspacing=0 cellpadding=5>
<tr>
<td align=center>

<b>По-традиции, в Новый Год <img src='i/align100.gif'>Дед Мороз </b>[2010]<b> <a href='inf.php?login=Дед Мороз' target=_blank><img src='i/inf.gif'></a> под ёлку кладет подарки. Так возьмите же свой подарок :)</b><br><br>

<table width=100% cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1>
<tr>
<td align=center>";

if ($stat['forest'] == 0) {
	echo"
<BR>
<img src='i/align100.gif'><b>Дед Мороз</b> [2010] <a href='inf.php?login=Дед Мороз' target=_blank><img src='i/inf.gif'></a> <i>в честь рождества приготовил Вам несколько подарков.</i><BR>
<BR>
<center><img src='i/location/smdedmoroz.gif'></center>
<input type='button' value='Получить подарок!' class=input onclick=\"if (confirm('Вы действительно хотите получить подарок сейчас?')) window.location='newyear.php?take3='+Math.random();\"\">
";
}



if ($stat['ny'] == 0) {
	echo"
<BR>
<img src='i/align100.gif'><b>Дед Мороз</b> [2010] <a href='inf.php?login=Дед Мороз' target=_blank><img src='i/inf.gif'></a> <i>приготовил Вам несколько подарков.</i><BR>
<BR>
<center><img src='i/location/smdedmoroz.gif'></center>
<input type='button' value='Получить подарок!' class=input onclick=\"if (confirm('Вы действительно хотите получить подарок сейчас?')) window.location='newyear.php?take2='+Math.random();\"\">
";
}
else echo"<center><font color=red><b><img src='i/location/dedmorozkukish.gif'><br>Вы уже получили свои подарки</b></font></center>";

echo"</td>
</tr>
</table>


</td>
</tr>
</table>
</fieldset>
<BR><BR>
";








echo"</td>
</tr>
</table>
";


?>
