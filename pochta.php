<?
include("inc/db_connect.php");

$stat = mysql_fetch_array(mysql_query("SELECT * FROM players WHERE user='".addslashes($user)."' AND pass='".addslashes($pass)."'"));

if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

$now = time();


if ($stat['t_time']) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']) { header("Location: academy.php"); exit; }
elseif ($stat['w_time']) { header("Location: works.php"); exit; }
elseif ($stat['battle']) { header("Location: battle.php"); exit; }
elseif ($stat['room'] != 19) { header("Location: main.php"); exit; }

else {
	include("inc/html_header.php");
	$unread = mysql_query("SELECT * FROM `pochta` WHERE `whom` LIKE '".$stat[user]."' AND `read` = 0 " );
	$poch = mysql_query("select * from pochta where whom='".$stat[user]."' ORDER by ID DESC");
	$send = mysql_query("select * from pochta where user='".$stat[user]."' and whom_temp = '' and zm=0 ORDER by ID DESC");

	echo"<body bgcolor=#EBEDEC leftmargin=0 topmargin=0>";

	echo"<DIV id=hint1></DIV>";

	echo"
<script language=JavaScript src='i/show_inf.js'></script>
<script language=JavaScript src='i/time.js'></script>
";

	print"<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td valign=top width=200 nowrap>
<FIELDSET style='WIDTH: 100%'><legend><font class=player>Папки</font></legend>
<a href=?act=new>Написать </a><br>
<a href=?act=new2>Передача денег </a><br>
<a href=?act=new3>Передача вещей </a><br>
<a href=?act=read>Входящие (".mysql_num_rows($unread)." / ".mysql_num_rows($poch)." )</a><br>
<a href='?act=write'>Исходяшие</a><br>

</td>

<td width=100% valign=top><center><FIELDSET style='WIDTH: 98.6%'><legend><font class=player>Письма</font></legend></center>";



	if ($act=="read") {
		echo "
<table width=100% cellspacing=0 cellpadding=7 border=1 bordercolor=CCCCCC>
<tr><td><b>№</td><td><b>Отправитель</td><td width=100%><b>Тема</td></tr>
";
		while ($pochta = mysql_fetch_array($poch) ) {
			$i++;
			$user=$pochta["user"];
			$text=$pochta["subject"];
			$id=$pochta["id"];
			$zm=$pochta["zm"];
			$closes=$pochta["closes"];
			$whom_temp=$pochta["whom_temp"];

			if ($pochta[read]==0) {$read="<b>";}
			else {$read="";}
			$img ='';
			if ($whom_temp != '') {$img = "<img src=item.gif>";}
			if ($zm != 0) {$img = "<img src=gold.gif>";}
			if ($closes != '') {$img = "$img <img src=gold.gif>";}
			print "<tr style='CURSOR: Hand' onclick='window.location.href=\"?act=let&id=$id\"'><td nowrap>$read$i</td><td nowrap>$read$user</td><td>$read$text $img</td></tr>";
		}
		echo "</table>";
	}
	$mny=$stat["user"];
	if ($act=="let") {

		$pochas = mysql_query("select * from pochta where id='$id' ORDER by ID DESC");
		$let = mysql_fetch_array($pochas);

		$text=$let["text"];
		$subj=$let["subject"];
		$user=$let["user"];
		$who=$let["whom"];
		$closes=$let["closes"];


		if ($d0 == "get") {
			mysql_query("UPDATE players SET credits=credits+$let[zm] where user='$stat[user]'");
			mysql_query("DELETE FROM pochta WHERE id=$id");
			print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=?act=let&id=$id\">";
		}
		if ($d0 == "dissmis") {
			mysql_query("UPDATE players SET credits=credits+$let[zm] where user='$user'");
			mysql_query("UPDATE pochta SET zm=0");
			print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=?act=let&id=$id\">";
		}



		if ($d0 == "gett") {
			$cl = $let[closes];
			mysql_query("UPDATE players SET credits=credits-$cl where user='$stat[user]'");
			mysql_query("UPDATE players SET credits=credits+$cl where user='$user'");
			mysql_query("UPDATE objects SET user='$stat[user]', pochta=0 where pochta='$id'");
			mysql_query("DELETE FROM pochta WHERE id=$id");
			print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=?act=let&id=$id\">";
		}


		if ($d0 == "dissmiss") {
			mysql_query("UPDATE objects SET pochta='0' where user='$user'");
			mysql_query("DELETE FROM pochta WHERE id=$id");
			echo "Посылка отправлена отправителю";
			print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3; URL=?act=let&id=$id\">";
		}



		echo "<b>От:</b> $user";  echo "<br>
<b>Тема:</b> $subj<br>
<b>Текст:</b><br>$text<br>";

		if ($let[whom_temp] != '') {
			echo "Прикреплены вещи:<br>";
			$get_obj = mysql_query("SELECT * FROM objects WHERE pochta=$id");
			if (mysql_num_rows($get_obj)>0){
				while ($pr_obj = mysql_fetch_array($get_obj)) {
					$pr_inf=explode("|",$pr_obj[inf]);
					echo " $pr_inf[1],";
				}
			}
			echo "<br><br>";
		}

		if ($let[zm] != '0') {
			echo "К письму прикреплены <b>$let[zm]</b><img src=gold.gif><br/>
    <input type=button value='Принять' class=new onclick='window.location.href=\"?act=let&id=$id&d0=get\"'>
    <input type=button value='Отклонить' class=new onclick='window.location.href=\"?act=let&id=$id&d0=dissmis\"'>
    ";
			echo "<br><br>";
		}

		if ($let['whom_temp'] != '') {
			if ($let[closes] != 0) {
				echo "Для получения письма необходимо заплатить $let[closes]<img src=gold.gif><br/>";
			}
			echo "
    <input type=button value='Принять' class=new onclick='window.location.href=\"?act=let&id=$id&d0=gett\"'>
    <input type=button value='Отклонить' class=new onclick='window.location.href=\"?act=let&id=$id&d0=dissmiss\"'>

  ";}

			if ($mny=="$who") {
				mysql_query("UPDATE `pochta` SET `read` = '1' WHERE `id` = '$id' ");
			}
	}

	if ($act=="write") {
		echo "
<table width=100% cellspacing=0 cellpadding=7 border=1 bordercolor=CCCCCC>
<tr><td><b>№</td><td><b>Кому</td><td width=100%><b>Тема</td></tr>
";
		while ($pochta = mysql_fetch_array($send) ) {
			$i++;
			$user=$pochta["whom"];
			$text=$pochta["subject"];
			$id=$pochta["id"];
			if ($pochta[read]==0) {$read="<b>";}
			else {$read="";}
			print "<tr style='CURSOR: Hand' onclick='window.location.href=\"?act=let&id=$id\"'><td>$read$i</td><td nowrap>$read$user</td><td>$read$text </td></tr>";
		}
		echo "</table>";
	}


	if ($act=="new") {
		?>
<form name=add action=?act=new&do=3 method="POST">Написать письмо: <br>
Тема<br>
<input type=text name=subj class=new size=30><br>
Кому<br>
<input type=text name=target class=new size=30><br>
Текст письма<br>
<textarea name=text rows=7 cols=51></textarea><br>

<input type=submit value="Создать" class=new></form>

		<?
		if ($do=="3") {
			$cost=25;
			mysql_query("INSERT INTO pochta(user,whom,text,subject,time) VALUES ('".$stat[user]."','$target','$text','$subj','$now')");
			$cr=$stat[credits]-$cost;
			mysql_query("UPDATE `players` SET `credits` = '$cr' WHERE `user` = '$stat[user]' ");
			print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=?act=new\">";
		}
	}


	if ($act=="new2") {
		?>
<form name=add action=?act=new2&do=4 method="POST">Написать письмо и
передать деньги: <br>
Тема<br>
<input type=text name=subj class=new size=30> <br>
Кому<br>
<input type=text name=target class=new size=30> <br>
Количество денег<br>
<input type=text name=zm class=new size=30> <br>
Текст письма<br>
<textarea name=text rows=7 cols=51></textarea><br>

<input type=submit value="Создать" class=new></form>

		<?
		if ($do=="4") {
			$cost=25;  #цена отправки письма
			$nalog=0.1; #налог, который снимут за переводимую сумму
			mysql_query("INSERT INTO pochta(user,whom,text,subject,zm,time) VALUES ('".$stat[user]."','$target','$text','$subj','$zm','$now')");
			$cr=$stat[credits]-$cost-$zm-$zm*$nalog;
			mysql_query("UPDATE `players` SET `credits` = '$cr' WHERE `user` = '$stat[user]' ");
			#print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=?act=new\">";
		}
	}

	if ($act=="new3") {

		if ($d0 == 4) {
			$pr_get = mysql_query("SELECT * FROM pochta WHERE whom='system' and user='$stat[user]'");
			$pr = mysql_fetch_array($pr_get);
			mysql_query("UPDATE pochta SET whom = '$pr[whom_temp]'");
			$cost=25;  #цена отправки письма
			$nalog=0.1; #налог, который снимут за переводимую сумму
			$cr=$stat[credits]-$cost-$zm-$zm*$nalog;
			mysql_query("UPDATE `players` SET `credits` = '$cr' WHERE `user` = '$stat[user]' ");
			echo "Посылка успешно отправлена.";
			print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=?act=new\">";
		}

		if (!$d0) {
			?>
<form name=add action=?act=new3&d0=1 method="POST">Введите текст письма,
получателя и выберите тип передачи: <br>
Тема<br>
<input type=text name=subj class=new size=30> <br>
Кому<br>
<input type=text name=target class=new size=30> <br>
Тип передачи (введите сумму налога, или оставьте пустым, если вы хотите
передать без налога)<br>
<input type=text name=nalog class=new size=30> <br>
Текст письма<br>
<textarea name=text rows=7 cols=51></textarea><br>

<input type=submit value="Создать" class=new></form>
			<?
		}

		elseif ($d0 == 1) {
			mysql_query("INSERT INTO pochta(user,whom,whom_temp,text,subject,closes,time) VALUES ('".$stat[user]."','system','".$_POST[target]."','$text','$subj','$nalog','$now')");
			print "<script>top.frames[\"main\"].location = \"?act=new3&d0=2\"</script>";
		}
		elseif ($d0 == 2) {

			$pr_get = mysql_query("SELECT * FROM pochta WHERE whom='system' and user='$stat[user]'");
			$pr = mysql_fetch_array($pr_get);
			$pr_id = $pr[id];
			if (!$pr[whom_temp]){$user = '$pr[whom_temp]';}
			else {$user = '$_POST[target]';}
			echo "
Передача игроку $pr[whom_temp]<br/>
Прикрепленные предметы:";


			if ($a=="add") {
				mysql_query("UPDATE objects SET pochta=$pr_id where id=$id");
			}

			$get_obj = mysql_query("SELECT * FROM objects WHERE pochta=$pr_id");
			if (mysql_num_rows($get_obj)>0){
				while ($pr_obj = mysql_fetch_array($get_obj)) {
					$pr_inf=explode("|",$pr_obj[inf]);
					echo " $pr_inf[1],";
				}
			}
			echo "<hr>";


			// Форма
			print"<br><div id=form align=center></div>";
			print"<table width=100% border=1 cellspacing=0 cellpadding=2 bordercolor=#C7C7C7>";
			###НАЧАЛО ЦИКЛА
			$object=mysql_query("SELECT objects.* FROM objects, slots WHERE user='".$stat['user']."' AND objects.pochta=0 AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) order by time desc");
			for($i=0; $i<mysql_num_rows($object); $i++) {
				$objects=mysql_fetch_array($object);

				$obj_inf=explode("|",$objects[inf]);
				$obj_min=explode("|",$objects[min]);
				# $obj_add=explode("|",$objects[add]);

				###ПОКАЗЫВАЕМ ИНФУ О ПРЕДМЕТЕ
				include('inc/main/min_tr.php');
				include('inc/main/add.php');
				include('inc/main/classes.php');
				###
				//print($infon['user']);

				echo"
<tr bgcolor=e2e0e0>
<td width=42% align=center valign=center>
<b>$obj_inf[1]</b><br>
<b>Гос. цена: $obj_inf[2] зм</b><br>
Долговечность предмета: $obj_inf[6] [$obj_inf[7]]<br>
Тип предмета: <i>$tip</i><br>
</td>

<td align=center width=80><img src='i/items/$obj_inf[0].gif' alt='$iteminfo[title]'><br>
<a href='?act=new3&d0=2&a=add&id=$objects[id]'>Передать</a>
</td>

<td width=42% valign=top>
<b><i>Минимальные требования:</i></b><br>
				$min_rase$min_level$min_str$min_dex$min_ag$min_vit$min_razum<br>";

				if ($hp or $energy or $min or $max or $strength or $dex or $agility or $vitality or $razum or $br1 or $br2 or $br5 or $br3 or $br4 or $krit or $unkrit or $uv or $unuv) echo"<b><i>Действие предмета:</i></b><br>$hp$energy$min$max$strength$dex$agility$vitality$razum$br1$br2$br3$br4$br5$krit$unkrit$uv$unuv
</td></tr>";

			}
			###КОНЕЦ ЦИКЛА
			echo " </table>
<form name=add action=?act=new3&d0=4 method=\"POST\">
<input type=submit value=\"Отправить\" class=new>
</form>
";
		}
	}


	echo"

</td>
<td width=200 nowrap  valign=top> <FIELDSET style='WIDTH: 100%'><legend><font class=player>Главное отделение почты</font></legend>
- <a href=\"main.php?room=5&tmp=\"+Math.random();\"\"'>Главная Площадь </a><br>Территория находиться под контролем клана <img src=i/klan/$db[clan].gif> <b>$db[clan]</b>";


echo"

</td>
</tr>
</table>


<BR><BR>
";

}
?>