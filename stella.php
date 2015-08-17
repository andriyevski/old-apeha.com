<?

require_once("inc/module.php");
if ($stat[bloked]) echo"<script>top.location='index.php?action=logout'</script>";
if ($stat[t_time]) { header("Location: prison.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat[room]!="32") { header("Location: main.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
else {
	include("inc/html_header.php");

	echo"<body bgcolor=#F5FFDA leftmargin=0 topmargin=0>";

	echo"<DIV id=hint1></DIV>";


	echo"
<body bgcolor=F5FFD9 leftmargin=0 topmargin=0>
<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
        <td><b>У вас на счету:</b> <u>".$stat[credits]."</u> <b>зм.</b>
        </td>
<td align=right valign=top>
<input class=input type=button value='Обновить' onclick='window.location.href=\"stella.php\"'>
<input class=input type=button value='Вернуться' onclick='window.location.href=\"world.php?room=0&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";

	echo"
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td align=left>
<center><font class=title>Голосование</font></center><br>";

	if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";



	echo"
<FIELDSET style='WIDTH: 98.6%'><legend>Алтарь голосования</legend>
<table width=100% cellspacing=0 cellpadding=5>
<tr>";

	$login=$stat["user"];
	print "<FORM NAME=\"golos\" METHOD=\"POST\" action=\"?act=golos\">";
	?>
<table>
	<tr>
		<td><?
		$id=1;

		$golos = mysql_fetch_array(mysql_query("select * from stella_users where user='".addslashes($user)."'"));

		if ($id!=1) {
			//if (!$golos) {

			$select=mysql_query("SELECT * FROM stella_main WHERE id=$id");
			$dat = mysql_fetch_array($select);
			$question = $dat["question"];
			print "<center><font class=title>$question</font></center>";
			?></td>
	</tr>
	<tr>
		<td><?
		$questions=mysql_query("SELECT * FROM stella_question WHERE question=$id order by id");
		while($data = mysql_fetch_array($questions)){
			$idi=$data["id"];
			$quest=$data["quest"];
			print "<INPUT TYPE=radio NAME=\"stella\" VALUE=\"D$idi\" ID=D$idi><B><LABEL FOR=D$idi>$idi $quest</LABEL><br>
";
		}
		?> <input type="submit" value="Голосовать"
			onClick="javascript:submit();" size=30 class=new style="width: 100">
		</FORM>
		</td>
	</tr>
</table>
		<?}
		else{print "На данный момент нет голосований";
		//else{print "Для вас данный опрос закрыт. Спасибо за то, что оставили свой голос.";
		}

}
?>
</td>

</tr>
</table>
<?




if ($act == "golos") {
	if ($stat[level] >= 7) {

		if($stella=="D1"){$idi=1;}
		if($stella=="D2"){$idi=2;}
		if($stella=="D3"){$idi=3;}
		if($stella=="D4"){$idi=4;}
		if($stella=="D5"){$idi=5;}
		if($stella=="D6"){$idi=6;}
		if($stella=="D7"){$idi=7;}
		if($stella=="D8"){$idi=8;}
		if($stella=="D9"){$idi=9;}
		if($stella=="D10"){$idi=10;}
		if($stella=="D11"){$idi=11;}
		if($stella=="D12"){$idi=12;}
		if($stella=="D13"){$idi=13;}
		if($stella=="D14"){$idi=14;}
		if($stella=="D15"){$idi=15;}
		if($stella=="D16"){$idi=16;}
		if($stella=="D17"){$idi=17;}
		if($stella=="D18"){$idi=18;}
		if($stella=="D19"){$idi=19;}
		if($stella=="D20"){$idi=20;}

		$QUERY=mysql_query("SELECT * FROM stella_question WHERE id='$idi'");
		$data=mysql_fetch_array($QUERY);
		$quest=$data["quest"];
		$unswers=$data["unswers"]+1;


		$s2=mysql_query("Update stella_question Set unswers='$unswers' where id='$idi'");
		$s3 = mysql_query("INSERT INTO stella_users(user,golos) VALUES ('$login','$idi')");
		print"$login, Вы проголосовали за $idi";
		print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"5; URL=stella.php\">";
	} else echo "В голосовании принимают участие персонажи старше 7 лвл";}
?>