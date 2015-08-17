<?
$MySkills = explode("|",$stat['rase_skill']);

$stat['ork']=$MySkills['0'];
$stat['elf']=$MySkills['1'];
$stat['people']=$MySkills['2'];
$stat['gnom']=$MySkills['3'];


// ----- # Повышаем физический параметр # ----- //
if (!empty($update)) {
	if ($stat['s_updates'] > 0) {

		switch ($update) {
			case str: $st_name="strength"; $st_title="Сила"; break;
			case dex: $st_name="agility"; $st_title="Ловкость"; break;
			case agility: $st_name="dex"; $st_title="Удача"; break;
			case vitality: $st_name="vitality"; $st_title="Выносливость"; break;
			case power: $st_name="power"; $st_title="Энергия"; break;
			case razum: if ($stat['level'] >= 4) { $st_name="razum"; $st_title="Разум"; } break;
		}

		if (!empty($st_name)) {
			$stat['s_updates']-=1;
			$stat[$st_name] = $stat[$st_name] + 1;
			mysql_query("UPDATE players SET s_updates=s_updates-1, ".$st_name."=".$st_name."+1 WHERE id=".$stat['id']." AND s_updates>0");
			$msg="Удачно увеличили физический параметр \"$st_title\"!";
		}
	}
	else $msg="У Вас нет свободных увеличений!"; }
	###

	// ----- # Повышаем особенность # ----- //
	if (!empty($oupdate)) {
		if ($stat['o_updates'] > 0) {

			switch ($oupdate) {
				case ork: $stat['ork']+=1; $st_title="Сила орка"; break;
				case elf: $stat['elf']+=1; $st_title="Хитрость эльфа"; break;
				case people: $stat['people']+=1; $st_title="Разум человека"; break;
				case gnom: $stat['gnom']+=1; $st_title="Выносливость гнома"; break;
			}

			if (!empty($st_title)) {
				$stat['o_updates']-=1;
				$st_write = $stat['ork']."|".$stat['elf']."|".$stat['people']."|".$stat['gnom'];
				mysql_query("update players set o_updates=o_updates-1, rase_skill='".$st_write."' where id=".$stat['id']." AND o_updates>0");
				$msg="Удачно увеличили особенность \"$st_title\"!";
			}
		}
		else $msg="У Вас нет свободных увеличений!"; }
		###

		$title="Умения";
		include("inc/html_header.php");
		echo"<body>
<DIV ID=hint1></DIV>
<SCRIPT language=JavaScript SRC='i/show_inf.js'></SCRIPT>";


		print "<table cellpadding=3 width=100% cellspacing=1 border=0>
<td align=right><input class=lbut type=button value='Назад' onClick=top.main.location.href=\"main.php?set=&tmp=\"+Math.random();\"\">
</td></table>";

		if (!empty($msg)) echo"<br><center><font color=red><b>$msg</b></font><br></center>";




		echo"<br><table width=100% cellspacing=1 border=0>
<tr>
<td width=33% valign=top>";

		// ----- # Таблица физ. параметров # ----- //

		echo"
<table cellpadding=3 width=100% cellspacing=1 border=0 height=155>
<tr>
<td bgcolor=#eaeaea align=center colspan=2><b>Физические параметры [ <u>".$stat['s_updates']."</u> ]</b>
</td>
</tr>
<tr>

<td bgcolor=#FCFAF3>";


		echo"
<SCRIPT language=JavaScript>
var a = ".$stat['s_updates'].";

function vs (name, title,int) {
        document.write('<LI>'+title+': <b>'+int+'</b>');
        if (a > 0) document.write(' <a style=\'CURSOR: hand\' title=\'Увеличить\' onclick=\"if (confirm(\'Увеличить физический параметр '+title+'?\')) window.location=\'main.php?set=updates&update='+name+'\'\"><b style=\'COLOR: Red\'>»</b></a>');
        }

vs('str','Сила','".$stat['strength']."');
vs('dex','Ловкость','".$stat['agility']."');
vs('agility','Удача','".$stat['dex']."');
vs('vitality','Выносливость','".$stat['vitality']."');
vs('power','Энергия','".$stat['power']."');
";

		if ($stat['level'] >= 4) echo"vs('razum','Разум','".$stat['razum']."');";

		echo"</SCRIPT>
</td>
</tr>
</table>";

		echo"</td><td width=34% valign=top>";

		// ----- # Таблица особенностей # ----- //

		echo"
<table cellpadding=3 width=100% cellspacing=1 border=0 bordercolor=#EAEAEA height=155> 
<tr>
<td bgcolor=#eaeaea align=center><b>Особенности [ <u>".$stat['o_updates']."</u> ]</b>
</td>
</tr>
<tr>
<td bgcolor=#FCFAF3 valign=center>";

		echo"
<SCRIPT language=JavaScript>
var o = ".$stat['o_updates'].";

function os (name, title, int, title2) {
        document.write('<LI><b onmouseover=\"hint(\'<b>'+title+'</b><LI>'+title2+'\',\'FFFFE1\',\'black\');\" onmouseout=\"c();\" style=\'CURSOR: Help\'>'+title+'</b><br>&nbsp;&nbsp;&nbsp;<small>Ваш уровень: '+int+'</small>');

        if (o > 0) document.write(' <a style=\'CURSOR: hand\' title=\'Увеличить\' onclick=\"if (confirm(\'Увеличить особенность '+title+'?\')) window.location=\'main.php?set=updates&oupdate='+name+'\'\"><b style=\'COLOR: Red\'>»</b></a>');
        }

os('ork','Сила орка','".$stat['ork']."','Каждый уровень увеличивает мощность наносимого Вами урона на <b>+5%</b><LI>Ваш текущий процент: <b>'+".$stat['ork']."*5+'%</b>');
os('elf','Хитрость эльфа','".$stat['elf']."','Каждый уровень увеличивает Ваш шанс увернуться от противника на <b>+5%</b><LI>Ваш текущий процент: <b>'+".$stat['elf']."*5+'%</b>');
os('people','Разум человека','".$stat['people']."','Каждый уровень повышает вероятность срабатывания свитков на <b>+5%</b><LI>Ваш текущий процент: <b>'+".$stat['people']."*5+'%</b>');
os('gnom','Выносливость гнома','".$stat['gnom']."','Каждый уровень повышает колличество Ваших НР на <b>+5%</b><LI>Ваш текущий процент: <b>'+".$stat['gnom']."*5+'%</b>');

</SCRIPT>

";

		echo"</td>
</tr>
</table>";


		echo"</td><td>";

		// ----- # Таблица мастерства # ----- //

		echo"
<table cellpadding=3 width=100% cellspacing=1 border=0 bordercolor=#EAEAEA height=155>
<tr>
<td bgcolor=eaeaea align=center><b>Холодное оружие</b>
</td>
</tr>
<tr>
<td bgcolor=#FCFAF3>

<b>Мастерство владения</b>:

        <LI>ножами / кинжалами: <b>$stat[m_k]</B>
        <LI>мечами: <B>$stat[m_m]</B>
        <LI>топорами / алебардами: <B>$stat[m_t]</B>
        <LI>дубинами / молотами: <B>$stat[m_d]</B>

</td>
</tr>
</table>";


		echo"</td></tr></table>";




		?>