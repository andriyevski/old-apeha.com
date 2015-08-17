<?
$now=time();
$title='Способности';
include("inc/db_connect.php");
include('inc/header.php');

print "<table cellpadding=3 width=100% cellspacing=1 border=0>
<td align=right><input class=lbut type=button value='Обновить' onClick=top.main.location.href=\"molitva.php\"> <input class=lbut type=button value='Назад' onClick=top.main.location.href=\"main.php?set=&tmp=\"+Math.random();\"\">
</td></table>";

$stat_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp` FROM slots, objects WHERE slots.id='".$stat['id']."' AND objects.user='".$stat['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));


$ChlSkills = explode("|",$stat['rase_skill']);
$stat['gnom']=$ChlSkills['3']*5;

$stat['hp']+=$stat_obj['hp'];
$h_hpmax=ceil(($stat['vitality']*5+$stat['hp'])*(1+($stat['gnom']/100)));



if (isset($take1)) {
	if ($stat['ed_bog_swet'] < 4) $msg="У Вас не хватает очков от молитвы бога Света.";
	if ($stat['hp_now'] >= $h_hpmax) $nms="Вы не нуждаетесь в лечении!";
	else {
		mysql_query("UPDATE players SET ed_bog_swet=ed_bog_swet-4, hp_now=hp_now+50 WHERE user='".$stat['user']."'");
		$stat['ed_bog_swet']=$stat['ed_bog_swet']-4;
		$stat['hp_now']=$stat['hp_now']+50;
		$msg="Вы удачно поменяли 4 очка от молитвы, на пополнение ХП +50";
	}
}

if (isset($take2)) {
	if ($stat['travma'] < $now) $msg="Вы не травмированы!";
	if ($stat['ed_bog_swet'] < 10) $msg="У Вас не хватает очков от молитвы бога Света.";
	else {
		mysql_query("UPDATE players SET ed_bog_swet=ed_bog_swet-10 WHERE user='".$stat['user']."'");
		mysql_query("UPDATE players SET travma=NULL WHERE user='".$stat['user']."'");
		$stat['ed_bog_swet']=$stat['ed_bog_swet']-10;
		$stat['travma']=NULL;
		$msg="Вы удачно поменяли 10 очков от молитвы, на излечения травмы";
	}
}

if (isset($take3)) {
	if ($stat['ed_bog_time'] < 10) $msg="У Вас не хватает очков от молитвы бога Тьмы.";
	else {
		mysql_query("UPDATE players SET ed_bog_time=ed_bog_time-10 WHERE user='".$stat['user']."'");
		mysql_query("UPDATE players SET credits=credits+10 WHERE user='".$stat['user']."'");
		$stat['ed_bog_time']=$stat['ed_bog_time']-10;
		$stat['credits']=$stat['credits']+10;
		$msg="Вы удачно поменяли 1 очко от молитвы, на пополнение игрового баланса +2 зм";
	}
}

if (isset($take4)) {
	if ($stat['m_time'] < $now) $msg="На вас неналожено заклятие молчания!";
	if ($stat['ed_bog_time'] < 15) $msg="У Вас не хватает очков от молитвы бога Тьмы.";
	else {
		mysql_query("UPDATE players SET ed_bog_time=ed_bog_time-15 WHERE user='".$stat['user']."'");
		mysql_query("UPDATE players SET m_time=NULL WHERE user='".$stat['user']."'");
		$stat['ed_bog_time']=$stat['ed_bog_time']-15;
		$stat['m_time']=NULL;
		$msg="Вы удачно поменяли 15 очков от молитвы, на снятие заклятия молчания";
	}
}

if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";

echo"

<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#cccccc>
<table cellpadding=5 cellspacing=1 border=0 width=100%><tr><td bgcolor=#f5f5f5>
Ваш логин: <b>$stat[user]</b><br>
Очков от молитвы бога Света: <b>$stat[ed_bog_swet] ед.</b><br>
Очков от молитвы бога Тьмы: <b>$stat[ed_bog_time] ед.</b>
</td></tr></table>
</td></tr></table>

<br>

<table cellpadding=0 cellspacing=0 border=0 width=100%>
  <tr>
    <td bgcolor=#cccccc>
    <table cellpadding=5 cellspacing=1 border=0 width=100%>
      <tr>
        <td bgcolor=#f5f5f5 width=20% align=center><b>Покупка</b></td>
        <td bgcolor=#f5f5f5 width=65% align=center><b>Название</b></td>
        <td bgcolor=#f5f5f5 width=15% align=center><b>Стоимость</b></td>
      </tr>
      <tr>
        <td bgcolor=#f5f5f5 width=20% align=center>"; if ($stat['ed_bog_swet']>=4) echo"<input class=lbut type=button value='Обменять' onClick=top.main.location.href='molitva.php?take1'>"; else echo "<input class=lbut type=button value='Не хватает ед.'></td></font>";
echo" </td>
        <td bgcolor=#f5f5f5 width=65%>Пополнение ХП +50</td>
        <td bgcolor=#f5f5f5 width=15% align=center><b>4 ед.</b> / Бог света</td>
      </tr>
      <tr>
        <td bgcolor=#F0F0F0 width=20% align=center>"; if ($stat['ed_bog_swet']>=10) echo"<input class=lbut type=button value='Обменять' onClick=top.main.location.href='molitva.php?take2'>"; else echo "<input class=lbut type=button value='Не хватает ед.'></td></font>";
echo"</td>
        <td bgcolor=#F0F0F0 width=65%>Излечение от травм</td>
        <td bgcolor=#F0F0F0 width=15% align=center><b>10 ед.</b> / Бог света</td>
      </tr>
      <tr>
        <td bgcolor=#f5f5f5 width=20% align=center>"; if ($stat['ed_bog_time']>=10) echo"<input class=lbut type=button value='Обменять' onClick=top.main.location.href='molitva.php?take3'>"; else echo "<input class=lbut type=button value='Не хватает ед.'></td></font>";
echo" </td>
        <td bgcolor=#f5f5f5 width=65%>Пополнение игровой валюты +10 зм.</td>
        <td bgcolor=#f5f5f5 width=15% align=center><b>10 ед.</b> / Бог тьмы</td>
      </tr>
      <tr>
        <td bgcolor=#F0F0F0 width=20% align=center>"; if ($stat['ed_bog_time']>=15) echo"<input class=lbut type=button value='Обменять' onClick=top.main.location.href='molitva.php?take4'>"; else echo "<input class=lbut type=button value='Не хватает ед.'></td></font>";
echo" </td>
        <td bgcolor=#F0F0F0 width=65%>Снятие заклятия молчания</td>
        <td bgcolor=#F0F0F0 width=15% align=center><b>15 ед.</b> / Бог тьмы</td>
      </tr>
   </table>
    </td>
  </tr>
</table>


";




echo"</body>
</html>";

?>