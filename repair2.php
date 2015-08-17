<?
define('INSIDE', true);
include("inc/db_connect.php");

$stat = mysql_fetch_array(mysql_query("SELECT * FROM players WHERE user='".addslashes($user)."' AND pass='".addslashes($pass)."'"));

if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

$now = time();


if ($stat['t_time']) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']) { header("Location: academy.php"); exit; }
elseif ($stat['w_time']) { header("Location: works.php"); exit; }
elseif ($stat['battle']) { header("Location: battle.php"); exit; }
elseif ($stat['room'] != 11) { header("Location: main.php"); exit; }

else {

	echo"
<DIV ID=form style='position:absolute; visibility:hidden'></DIV>

<SCRIPT LANGUAGE=\"JavaScript\">
<!--
function present (id) {

        var x, y, obj;

        obj = document.getElementById('f_'+id);
        for(i=obj, x=0, y=0; i; i = i.offsetParent)
        {
        x += i.offsetLeft;
        y += i.offsetTop;
        }

        form.style.left = x-45;
        form.style.top = y;

        document.all('form').style.visibility = 'visible';
        document.all('form').innerHTML        = '<TABLE BGCOLOR=e2e0e0 bordercolor=A5A5A5 border=1 cellspacing=0 cellpadding=3 style=\'CURSOR: Default;\'><FORM action=\'repair2.php\' method=POST><tr><td style=\'BORDER-RIGHT: 0px; BORDER-BOTTOM: 0px; padding-left:7;\'>Текст гравировки:</td><td style=\'BORDER-LEFT: 0px; BORDER-BOTTOM: 0px; padding-right:7;\' align=right><input type=text class=input size=32 name=grav_text><input type=hidden name=grav_id value=\''+id+'\'></td></tr><tr><td colspan=2 align=center><input type=submit value=\'Выгравировать\' name=\'grav_submit\' class=input style=\'WIDTH: 308px\'></td></tr></FORM></table>';

}
//-->
</SCRIPT>
";




	if (@$grav_submit) {
		if (!empty($grav_text)) {
			$object = mysql_fetch_array(mysql_query("SELECT objects.id, objects.inf FROM objects, slots WHERE objects.user='".$stat['user']."' AND objects.id=".$grav_id." AND objects.tip <12 AND slots.id=".$stat['id']." && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19)"));

			if ($object) {

				if (eregi("^[a-zA-Zа-яА-Я0-9_\.\,\-\!\?\ ]+$",$grav_text)) {
					if (strlen($grav_text) <= 25) {
						$inf = explode("|",$object['inf']);
						if($inf[3]=='0'){
							$infs = $inf['0']."|".$inf['1']."|".$inf['2']."|".$grav_text."|".$inf['4']."|".$inf['5']."|".$inf['6']."|".$inf['7'];

							mysql_query("UPDATE objects SET inf='".$infs."' WHERE id=".$object['id']."");
							mysql_query("UPDATE players SET `credits` = `credits`-500 WHERE id = '".$stat['id']."'");

							$msg = "Вы удачно выгравировали надпись <U>".$grav_text."</U> на предмете <U>".$inf['1']."</U>, заплатив при этом - 500 Зм.";
						} else $msg= "На этом предмете уже есть гравировка!";
					}
					else $msg = "Текст гравировки не должен быть длинее 25 символов!";
				}
				else
				$msg = "В тексте гравировки можно указывать только русские или английские буквы!";
			}
			else
			$msg = "Что-то тут не так..";
		}
		else
		$msg = "Введите текст гравировки!";
	}


	if ($act=="upgrade") {
		if($stat[proff]==2){
			$S = mysql_query("SELECT * FROM `objects` WHERE id='".$id."' ");
			while($dat = mysql_fetch_array($S)){
				$id=$dat["id"];
				$user=$dat["user"];
				$obj_inf=explode("|",$dat['inf']);
				$min_demg=$dat["min_d"];
				$max_demg=$dat["max_d"];
				$min_upg=rand(1,5);
				$max_upg=rand(3,7);
				$prok=$dat["mf"];
			}
			if ($stat["user"]!="$user") {$msg = "Вещь не найдена в вашем рюкзаке";

			}
			else if ($stat["credits"]<500) {$msg = "У вас недостаточно денег";
			}
			else if ( $prok >= 5) {$msg = "Ваше оружие достаточно заточенно!";
			}
			else {

				mysql_query("UPDATE `players` SET `credits` = `credits`-500 WHERE `user` = '$stat[user]' ");
				mysql_query("UPDATE `objects` SET `min_d` = min_d+'$min_upg', `max_d` = max_d+'$max_upg' WHERE id='".$id."' ");
				mysql_query("UPDATE `objects` SET mf = mf+1 WHERE id='".$id."' ");
				$msg = "Модернизация прошла успешно";
				require_once("inc/chat/functions.php");
				//		insert_msg("Модернизация <b>".$obj_inf['1']."</b>  прошла успешно. Минимальный урон увеличился на +$min_upg, а максимальный на +$max_upg 		","","","1",$stat['user'],"",$stat['room']);

				$mind=$min_demg+$min_upg;
				$maxd=$max_demg+$max_upg;
				insert_msg("$prok <b>".$obj_inf['1']."</b> Мин урон +$min_upg ($mind), а макс +$max_upg ($maxd)		","","","1",$stat['user'],"",$stat['room']);
				echo"<script>window.location='repair2.php?otdel=5'</script>";

			}
		}else $msg = "Перековать может только кузнец!";
	}




	if ($stat['r_action'] == 1) {

		if ($stat['o_time']-2 < $now) {

			mysql_query("UPDATE `players` SET o_time=0, r_action=0 WHERE user='".$stat['user']."'");

			$stat['o_time'] = 0;
			$stat['r_action'] = 0;

		}
		 
		 
	}





	function show ($id) {
		global $stat;

		switch ($id) {



			case 5:

				echo"

<table width=100% cellspacing=0 cellpadding=5>
<tr>
<td align=center>
";
				$it_sost=mysql_query("SELECT objects.* FROM objects, slots WHERE objects.user='".$stat['user']."'  AND slots.id=".$stat['id']." AND objects.tip<12 AND objects.bank=0 AND objects.komis=0 && objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) ORDER BY time desc");

				if (mysql_num_rows($it_sost)) {
					echo"<table width=100% cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1>";

					for($i=0; $i<mysql_num_rows($it_sost); $i++) {

						$objects=mysql_fetch_array($it_sost);

						$obj_inf=explode("|",$objects['inf']);
						$obj_min=explode("|",$objects['min']);
						$obj_add=explode("|",$objects['add']);

						include('inc/main/min_tr.php');
						include('inc/main/add.php');
						include('inc/main/classes.php');

						echo"
                <tr><td width=33% align=center valign=center>
                <a href='' target=_blank><b>".$obj_inf['1']."</b></a><br><br>
                <b>Гос. цена: ".$obj_inf['2']." зм.</b><br>
                Долговечность предмета: ".$obj_inf['6']." [".$obj_inf['7']."]<br>
                Тип предмета: <i>".$tip."</i><br>
                </td>
                <td width=34% align=center>
                <img src='../instinkt/i/items/".$obj_inf['0'].".gif' alt='".$obj_inf['1']."'>
                <br><br>";
						if($stat[credits]>=500 AND $stat[proff]==2){echo"<a href='javascript:;' onclick=\"present(".$objects['id'].");\" id='f_".$objects['id']."'>Выгравировать надпись за 500 зм.</a><br><br>";}
						else{echo"<font color=red>Только кузнец может гравировать.<br><br></font>";}
						if($stat[proff]==2 AND $objects['tip']==1){echo"<a href=?act=upgrade&id=".$objects['id'].">Перековать предмет за 500 зм.</a>";}
						else{echo"<font color=red>Только кузнец может перековать оружие.</font>";}
						 

						echo"</td>
                <td width=33% valign=top>
                <b><i>Минимальные требования:</i></b><br>
                $min_rase$min_level$min_str$min_dex$min_ag$min_vit<br>
                <b><i>Действие предмета:</i></b><br>
                $hp$energy$min$max$strength$dex$agility$vitality$razum$br1$br2$br5$br3$br4$krit$unkrit$uv$unuv<br>";

                if ($objects['about']) echo"<b><i>Дополнительная информация:</i></b><br>$objects[about]";

                echo"</td></tr>";
					}
				} else
				echo"У Вас нет предметов, подлежащих гравировке.";

				//echo"</table>";



				echo"
</td>
</tr>
</table>
";

				break;


		}}


		if (!empty($buy))
		include("inc/shop/craft.php");

		$title = 'Кузница - 2 этаж';
		include("inc/html_header.php");

		echo"
<body bgcolor=#EBEDEC leftmargin=0 topmargin=0>

<DIV ID=hint1></DIV>

<SCRIPT src='i/show_inf.js'></SCRIPT>
";


		print"<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td>&nbsp;&nbsp;<b>У Вас на счету:</b> <u>".$stat['credits']."</u> <b>зм.</b>
</td>

<td align=right valign=top>

<img src='../instinkt/i/refresh.gif' style='CURSOR: Hand' alt='Обновить' onclick='window.location.href=\"repair2.php?otdel=$_GET[otdel]&tmp=\"+Math.random();\"\"'>

<img src='../instinkt/i/back.gif' style='CURSOR: Hand' alt='1 этаж' onclick='window.location.href=\"repair.php?tmp=\"+Math.random();\"\"'>&nbsp;

</td>
</tr>

<tr>
<td>&nbsp;&nbsp;<b>У Вас на счету:</b> <u>".$stat['valute']."</u> <b>см.</b>
</td>
</tr>
</table>";



		echo"
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td align=center>
<font class=title>Кузница - 2 этаж</font><br><br>";

		if ($stat['o_time']>$now) {
			echo"<script src='i/time.js'></script>";
			echo"<center><table cellspacing=0 cellpadding=3>
<tr>
<td><font color=red><b>Оставшееся время:</b></font></td>
<td id=know style='COLOR: red; FONT-WEIGHT: Bold; TEXT-DECORATION: Underline'></td>
</tr>
</table>
<script>ShowTime('know',",$stat['o_time']-$now,",1);</script>";
		}

		if ($msg!="") echo"<center><font color=red><b>$msg</b></font></center><br>";

		echo"
<FIELDSET style='WIDTH: 98.6%'><legend>Отделы</legend>
<table width=100% cellspacing=0 cellpadding=5>
<tr>


<td align=center width=20%><A"; if ($otdel == 4) echo" disabled><b>"; else echo" HREF='repair2.php?otdel=4'>"; echo"Создание предметов</b></A></td><td width=1% align=center><b>|</b></td>
<td align=center width=20%><A"; if ($otdel == 5) echo" disabled><b>"; else echo" HREF='repair2.php?otdel=5'>"; echo"Гравировка и модернизация</b></A></td><td width=1% align=center><b></b></td>

</tr>";

		if (!empty($_GET['otdel'])) {
			echo"<TR><TD COLSPAN=9 ALIGN=CENTER><HR COLOR='#CCCCCC'>";

			switch ($_GET['otdel']) {
				case 1: show(1); break;
				case 2: show(2); break;
				case 3: show(3); break;
				case 4: include('inc/shop/_otdels_repair.php'); break;
				case 5: show(5); break;
				default: echo"<B STYLE='COLOR: Red'>Что-то тут не так...</B>"; break;
			}

			echo"</TD></TR>";
		}


		echo"
</table>
</FIELDSET>";






		echo"</td>
</tr>
</table>";

}
?>
<BODY
	bgcolor=EBEDEC leftmargin=0 topmargin=0
	background='<? print"$stat[img_path]"; ?>/i/backgrounds/kuznec.jpg'
	style='background-attachment: fixed;'>