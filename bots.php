<?
$now=time();$time = time();
include("inc/db_connect.php");
///$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));
//$now=time();
//if($stat['user']!='migon' and $stat['user']!='pablo pika' and $stat['level']>8){header("Location: battle.php?battle_type=3"); exit;}

include("inc/html_header.php");

$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));
$now=time();
$_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp`, SUM(objects.`vitality`) as `vitality` FROM slots, objects WHERE slots.id='".$stat['id']."' AND objects.user='".$stat['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));
$MySkills = explode("|",$stat['rase_skill']);
$stat['gnom']=$MySkills['3']*5;
$stat['vitality']=$stat['vitality']+$_obj['vitality'];
$stat['hp_max']=ceil(($stat['vitality']*5)*(1+($stat['gnom']/100))+$_obj['hp']);
$hp_max=$stat['hp_max'];

###########################################################################################
if ($stat['room'] != 49) {
	$time_hp = $stat['cure_hp'];
	if ($stat['hp_max']>$stat['hp_now']){
		if ($stat['cure_hp'] == 0) {
			$time_hp = floor($now + ($stat['hp_max']-$stat['hp_now'])*(300/$stat[hp_max]));
			$q=mysql_query("UPDATE players SET cure_hp='$time_hp' WHERE id='$stat[id]'");
		}
		else {
			if ($stat['hp_max']<$stat['hp_now']){$stat['hp_now']=$stat['hp_max'];}
			if (time() >= $stat['cure_hp']) {
				$q=mysql_query("UPDATE players SET hp_now='$stat[hp_max]', cure_hp='0'  WHERE id='$stat[id]'");
			}
			$t = floor($stat[hp_max]-$stat[hp_now])*(300/$stat[hp_max]);
			$hp_need = $stat[hp_max]-$stat[hp_now];
			$x = $t / $hp_need;
			$t1 = $time_hp-$t;
			$t_need = $t-floor($time_hp-$now);
			$hp = floor($t_need / $x);
			$q=mysql_query("UPDATE players SET hp_now=hp_now+'$hp' WHERE id='$stat[id]'");
			###########################################################################################
		}
	}
	else{
		$SS = mysql_query("UPDATE players SET cure_hp='0', hp_now='$hp_max' WHERE id='$stat[id]'");
	}}

	$widthhp=$stat['hp_now']/$hp_max*172;
	if ($widthhp==0) $widthhp+=2;
	if ($widthhp==1) $widthhp+=1;
	if ($widthhp>1) $widthhp-=1;

	$ustal_max = $stat['vitality']*5+$stat['ustal'];

	$widthustal=$stat[ustal_now]/($stat['vitality']*5)*172;
	if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";



	$user_offer=mysql_fetch_array(
	mysql_query(
    "select offers.time,offers.type,participants.side from offers, participants
       where offers.time>$now
         and offers.done=0
         and participants.time=offers.time
         and participants.id=$stat[id]"));


	if ($stat['t_time']>$now) { header("Location: prison.php"); exit; }
	elseif ($stat['k_time']>$now) { header("Location: academy.php"); exit; }

	elseif ($stat['o_time']>$now) { header("Location: juvelir.php"); exit; }
	elseif ($stat['r_time']>$now) { header("Location: podzem.php"); exit; }
	elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
	elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
	else {





		if (!isset($StartBattle)) $msg = "";
		else {
			$chl=mysql_fetch_array(mysql_query("SELECT * FROM players where id='".addslashes($StartBattle)."'"));
			$instr = mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.about='С Новым 2009 Годом!!!' AND objects.id IN (slots.3)");
			$instr2 = mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.about='С Новым 2009 Годом!!!' AND objects.id IN (slots.4)");
			$instr3 = mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.about='С рождеством!!!' AND objects.id IN (slots.5)");

			if ($chl['rank']>=60 && $chl['battle'] <= $now-1200 && $chl['battle'] != 0) {
				$msg="11111111111";
				mysql_query ("UPDATE players SET battle = NULL WHERE id = '".$chl['id']."'");
			}
			if ($chl['user'] == $stat['user']) $msg="Вы не можете нападать на самого себя!";
			elseif ($ctime-$chl['lpv'] > 2 && $chl['rank'] != 60) $msg="Персонаж <u>$login</u> отстутствует!";
			elseif ($chl['room'] != $stat['room']) $msg="Для нападния Вам необходимо находится в одной комнате!";
			elseif (($stat['bs_x'] != $chl['bs_x']) && ($stat['bs_y'] != $chl['bs_y'])) $msg="Для нападния Вам необходимо находится в одной координате!";
			elseif ($stat['hp_now'] <= 11 ) $msg="Вы слишком ослаблены для боя!";

			elseif ($chl['travma'] > $now) $msg="Персонаж <u>$login</u> травмирован!";
			elseif ($chl['rank'] != 60) $msg="Ошибка!";

			elseif ($stat['travma'] > $now) $msg="Вы травмированы!";
			elseif ($stat['battle']!=0) $msg="Вы уже находитесь в поединке!";
			// elseif ($stat['level']>=0 and $stat['level']<16) $msg="Деритесь с реальными игроками!";
			elseif ($chl['battle']!=0)  $msg="Бот уже находится в поединке!";

			elseif ($stat['level']+3<$chl['level'] and $chl['user']!='Cera') $msg="Ваш уровень слишком мал для наподения на <u>\"$chl[user]\"</u>";
			elseif ($stat['level']>$chl['level']+3) $msg="Ваш уровень слишком большой для наподения на <u>\"$login\"</u>";

			elseif ( (((time()-$chl['lpv'])<10) &&($chl['battle'] == $chl['last_battle'] || !$chl['battle']) && $chl['rank']==60 && $chl['user']=='Cera') or (((time()-$chl['lpv'])<100) &&($chl['battle'] == $chl['last_battle'] || !$chl['battle']) && $chl['rank']==60 && $chl['user']=='Cera')) $msg="Бот <u>".$chl['user']."</u> еще не восстановил свой уровень жизни!";
			elseif (mysql_num_rows ($instr)) $msg="Нападать на ботов с посохом Деда Мороза нельзя! Бейте им людей!";
			elseif (mysql_num_rows ($instr2)) $msg="Нападать на ботов в тулупе Деда Мороза нельзя! Бейтесь в нем с людьми!";
			elseif (mysql_num_rows ($instr3)) $msg="Нападать на ботов с мешком Деда Мороза нельзя! Бейтесь им с людьми!";
			else {

				$battime=time();

				if ($chl['rank']==60 && ($chl['battle'] == $chl['last_battle'] || !$chl['battle'])) {



					$_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp`, SUM(objects.`vitality`) as `vitality` FROM slots, objects WHERE slots.id='".$chl['id']."' AND objects.user='".$chl['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));
					$MySkills = explode("|",$chl['rase_skill']);
					$chl['gnom']=$MySkills['3']*5;
					$chl['vitality']=$chl['vitality']+$_obj['vitality'];
					$chl['hp_max']=ceil(($chl['vitality']*5)*(1+($chl['gnom']/100))+$_obj['hp']);
					$chl['hp_now']=$chl['hp_max'];
					///////////////////



					mysql_query ("UPDATE `players` SET `hp_now` = '".$chl['hp_max']."', `battle` = NULL WHERE `id` = '".$chl['id']."'");
					$chl['battle'] = NULL;
				}


				mysql_query ("UPDATE players SET hp_now = '".$chl['hp_max']."' WHERE id = '".$chl['id']."'");
				$bdate=date("d.m.y H:i",$battime);
				if ($chl[next_exp]!=0)
				$chl_base=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level=".$chl['level']." AND exp<=$chl[next_exp] ORDER BY exp DESC"));
				else
				$chl_base=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level='".$chl['level']."'AND exp<=$chl[exp] ORDER BY exp DESC"));
				$bdate=date("d.m.y H:i",$time);
				if ($stat[next_exp]!=0)
				$levels=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level='".$stat['level']."' AND exp<=$stat[next_exp] ORDER BY exp DESC"));
				else
				$levels=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level='".$stat['level']."'AND exp<=$stat[exp] ORDER BY exp DESC"));

				while (mysql_fetch_array(mysql_query("SELECT * FROM offers WHERE time=".$time."")))
				$time++;
				$prt2 = mysql_num_rows(mysql_query("select * FROM participants WHERE `time` = '".$chl['battle']."'"));
				mysql_query("INSERT INTO offers (time, type, size_left, size_right, done, timeout, zone_width, zone_height, city) values('".$time."','1','1','1','1','180','6', '".($prt2/2+3)."', '1')");

				$query="INSERT INTO participants (`time`,`id`,`side`,`base`,`hp`, `x`, `y`, `frozen`) VALUES ('".$time."','".$stat['id']."','0','".$levels['base']."','".$stat['hp_now']."' ,'".($prt['x']+1)."', '".($prt['y']+1)."', '0')";

				mysql_query($query);

				mysql_query("INSERT INTO participants (`time`,`id`,`side`,`base`,`hp`, `x`, `y`, `frozen`) VALUES ('".$time."','".$chl['id']."','1','".$chl_base['base']."','".$chl['hp_now']."','".($prt['x']+4)."', '".($prt['y']+1)."', '0')");

				mysql_query("INSERT INTO battles (`offer`, `time`, `id`, `type`, `damage`, `comment1`) values ('".$time."', '".$time."', '1', 2, '', '<i>Часы показывали <u>".$bdate."</u> когда бой начался!')");

				mysql_query("UPDATE players SET battle='".$time."', bside='0' WHERE id='".$stat['id']."'");
				mysql_query("UPDATE players SET battle='".$time."', bside='1' WHERE id='".$chl['id']."'");
				$b_id=$battime;



				echo"<script>parent.main.location=\"battle.php?tmp=\"+Math.random();\"\"</script>";

			}
		}


		include("inc/html_header.php");

		echo"<SCRIPT LANGUAGE=\"JavaScript\">
function ShowBots (login,id,level) {
var user_id;
if (id != '') user_id=' <a href=\'inf.php?'+id+'\' target=_blank><img src=i/inf.gif width=11 height=11 alt=\'Информация о персонаже '+login+'\'></a>';

document.write('<TABLE><TR><TD width=20><A HREF=\"main.php?set=bots&StartBattle='+id+'\"><IMG SRC=i/join.gif></A> </TD><TD><b>'+login+'</b> ['+level+']'+user_id+'</TD></TR></TABLE>');
}
</SCRIPT>";

		include ('inc/rooms.php');


		echo"<body background='/i/bg.gif' leftmargin=0 topmargin=0>
<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td align=left> </td>
<td align=right valign=top>
<input class=input type=button value='Обновить' onclick='window.location.href=\"main.php?set=bots&tmp=\"+Math.random();\"\"'>
<input class=input type=button value='Вернуться' onclick='window.location.href=\"main.php?tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";


		echo "<table border='0' width='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='100%' align='center'>
     <table border='0' width='100%' height='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='22' height='100%'>
    <table border='0' width='22' height='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='22' height='25'>
<img src='i/inman_b11.gif' width='22' height='25' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='69'><img src='i/inman_b12.gif' width='22' height='69' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='100%' background='i/inman_b13.gif'>&nbsp;</td>
  </tr>
  <tr>
    <td width='22' height='69'><img src='i/inman_b14.gif' width='22' height='69' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='25'><img src='i/inman_b15.gif' width='22' height='25' alt=''></td>
  </tr>
</table>
    </td>
    <td height='100%'>
      <table border='0' width='100%' height='100%' cellspacing='0' cellpadding='0'>
        <tr>
          <td width='100%' height='25'>
          <table border='0' width='100%' height='25' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='51' height='25'>
<img src='i/inman_b211.gif' width='51' height='25' alt=''></td>
    <td background='i/inman_b212.gif' valign='middle'>
    <table border='0' height='22' cellspacing='0' cellpadding='0'>
  <tr>
<td width='96' height='22'>&nbsp;</td>

  </tr>
</table>
   
    </td>
    <td width='51' height='25'>
<img src='i/inman_b213.gif' width='51' height='25' alt=''></td>
  </tr>
</table>
          </td>
        </tr>
        <tr>
          <td width='100%' height='100%' background='i/inman_fon.gif'>
            <table border='0' width='100%' height='100%' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 3'>
            <tr><td width='50%' valign='top'>";
		echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'>
Выберите подходящий для себя уровень и сразитесь с ним.</td></TR>
</table>
</div><br>";

		echo "<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr><td align='center'>";
		$bots = mysql_query("SELECT * FROM players where `room` = '".$stat[room]."' and `rank` = '60' order by level");
		if ($msg!="") echo"<center><font color=red><b>$msg</b></font></center><br>";





		if (empty($user_offer['time'])) {
			if (mysql_num_rows($bots)) {
				for($i=0; $i<mysql_num_rows($bots); $i++) {
					$bot=mysql_fetch_array($bots);
					echo"<SCRIPT language=JavaScript>";
					echo" ShowBots('".$bot[user]."','".$bot[id]."','".$bot[level]."'); ";
					echo"</SCRIPT>";



					if ($bot['battle'] !=0  or ((time()-$bot['lpv'])< 10 && $bot['user']!='Cera') or ($bot['user']=='Cera' && (time()-$bot['lpv'])< 100)) {

						echo "<font color='red'>Монстр не готов к поединку</font>";} else echo "<font color='green'>Монстр  готов к поединку</font>";


				}
			} else { echo"<center>Монстров не найдено!</center>"; }
		} else { echo"<center>Вы подали заявку на бой, дождитесь начала боя!</center>"; }
		echo "</td></tr></table></div>";


		echo "</td><td width='50%' valign='top'>";

		echo" <div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>Информация</b></td></TR>
</table>
</div><br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
    <tr><td align='left'>
- Название местности: <b>".$roomname[$stat[room]]."</b><br>
- Кол-во Монстров в данной местности <b>".mysql_num_rows(mysql_query("SELECT id FROM players where `room` = '".$stat[room]."' and `rank` = '60' "))."</b> шт.<br>
- Монстры - это существа живущие в неволе, они намного слабее обычного игрока<br>
- С Монстров могут выпасть вещи, ингридиенты, золото и т.п.<br>
- На Монстра можно напасть 1 раз в 3 мин. после предыдущего боя, т.к. он востанавливает свои жизни
</td></TR>
</table>
</div>";

		echo "                </td></tr>
            </table>
          </td>
        </tr>
        <tr>
          <td width='100%' height='25'>
          <table border='0' width='100%' height='25' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='51' height='25'>
<img src='i/inman_b231.gif' width='51' height='25' alt=''></td>
    <td background='i/inman_b232.gif'>&nbsp;</td>
    <td width='51' height='25'>
<img src='i/inman_b233.gif' width='51' height='25' alt=''></td>
  </tr>
</table>

          </td>
        </tr>
      </table>
    </td>
    <td width='22' height='100%'>
    <table border='0' width='22' height='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='22' height='25'>
<img src='i/inman_b21.gif' width='22' height='25' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='69'><img src='i/inman_b22.gif' width='22' height='69' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='100%' background='i/inman_b23.gif'>&nbsp;</td>
  </tr>
  <tr>
    <td width='22' height='69'><img src='i/inman_b24.gif' width='22' height='69' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='25'><img src='i/inman_b25.gif' width='22' height='25' alt=''></td>
  </tr>
</table>
   </td>
  </tr>
</table>
      
      </td>
  </tr>
</table>";
	}
	?>