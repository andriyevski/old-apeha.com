<?
$stat = mysql_fetch_array(mysql_query("SELECT * FROM players WHERE user='".addslashes($user)."' AND pass='".addslashes($pass)."' LIMIT 1"));
//print_r( $stat);
if ($stat['rank'] == 100 or $stat['level'] >= 4 ) {
	if (!empty($login)) {
		$login=trim($login);
		$infon=mysql_fetch_array(mysql_query("SELECT * FROM players WHERE user='".addslashes($login)."' LIMIT 1"));
		//print_r( $infon);
		$HisInfo['user'] = $infon['user'];
		include("inc/main/get_inf.php");
		//echo $user_lpv;
		// $infon['lpv'] = $user_lpv;
	}

	include('inc/main/transf.php');
}

include('inc/header.php');
if ($stat['bs'] == 1) {
	$object=mysql_query("SELECT objects.* FROM objects, slots WHERE user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.komis=0 AND objects.bank=0 AND objects.lam=0 AND objects.pochta=0 AND objects.mag=0 AND objects.bs=1 AND objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) order by time desc");
} else {
	$object=mysql_query("SELECT objects.* FROM objects, slots WHERE user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.komis=0 AND objects.bank=0 AND objects.lam=0 AND objects.pochta=0 AND objects.mag=0 AND objects.bs=0 AND objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) order by time desc");
}
print"
<script src='i/login_form.js'></script>
<table cellpadding=3 width=100% cellspacing=1 border=0>
<td align=right><input class=lbut type=button value='Назад' onClick=top.main.location.href=\"main.php?set=&tmp=\"+Math.random();\"\">
</td></table>";


if ($stat['rank'] < 100 and $stat[level]<4 ) { echo"<br><center><font style='COLOR: red; font-weight: bold'>Передачи разрешены только персонажам начиная с 4 уровня!</font></center>"; exit(); }


// Форма
print"<br><div id=form align=center></div>";

if (empty($login) || empty($infon['user'])) echo"<script>ShowForm('Передача', 'main.php?set=transfer','','');</script>";

print"<table width=100% border=1 cellspacing=0 cellpadding=2 bordercolor=#C7C7C7>";


if (!empty($msg)) echo"<tr><td colspan=2 bgcolor=e2e0e0 align=center>$msg</b></td></tr>";

$ctime=time();
$span=$ctime-$infon['lpv'];
//echo $span."".$infon['lpv'];
///print_r( $infon);
if ($infon['user'] == $stat['user'])  echo"<tr><td bgcolor=#FCFAF3 align=center colspan=2 bgcolor=e2e0e0>Вы не можете передать что-либо самому себе!</td></tr>";
elseif (empty($infon['user']) && !empty($login)) echo"<tr><td bgcolor=#FCFAF3 align=center colspan=2 bgcolor=e2e0e0>Персонаж <b>$login</b> не существует!</td></tr>";
elseif (!empty($infon['user']) && $span>400) echo"<tr><td bgcolor=#FCFAF3 align=center colspan=2 bgcolor=e2e0e0>Персонаж сейчас отсутствует! Воспользуйтесь услугами почты!</td></tr>";




#######ФОРМА
if (empty($login) || empty($infon['user'])) $form="";

elseif (!empty($infon['user']))
$form="
</table>
<table width=100% border=1 cellspacing=0 cellpadding=2 bordercolor=#C7C7C7>
<tr><td bgcolor=#FCFAF3 align=center width=80><input type=button value='Сменить' onclick=\"ShowForm('Передача', 'main.php?set=transfer','','');\" class=lbut>
</td>
<td bgcolor=#FCFAF3 align=center>
<script language=JavaScript>show_inf('$infon[user]','$infon[id]','$infon[level]','$infon[rank]','$infon[tribe]');</script>
</td>
</tr>
</table>
<table width=100% border=1 cellspacing=0 cellpadding=2 bordercolor=#C7C7C7>
";
#######



#######ФОРМА
if (!empty($login) && !empty($infon['user']) && $infon['user'] != $stat['user'] && $span<400) $form2="
</table>
<table width=100% border=1 cellspacing=0 cellpadding=2 bordercolor=#C7C7C7>
<form action='main.php?set=transfer&login=$login' method=post>
<tr>
<td bgcolor=#FCFAF3 align=center>
Передать золото: <input name=credits class=input> <input type=submit name=send_credits value='Передать' class=lbut>
</td>
</tr>
</form>
</table>
<table width=100% border=1 cellspacing=0 cellpadding=2 bordercolor=#C7C7C7>
";
#######




echo"$form$form2";








###НАЧАЛО ЦИКЛА

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
	if (empty($login) or $login ==$stat['user']  or  strtoupper($infon['user']) != strtoupper($login) or $span>400) echo"";
	else {

		echo"
<tr bgcolor=#FCFAF3>
<td width=42% align=center valign=center>
<b>$obj_inf[1]</b><br>
<b>Гос. цена: $obj_inf[2] зм</b><br>
Долговечность предмета: $obj_inf[6] [$obj_inf[7]]<br>
Тип предмета: <i>$tip</i><br>
</td>

<td align=center width=16%><img src='i/items/$obj_inf[0].gif' alt='$iteminfo[title]'><br>
<a href='main.php?set=transfer&transf=$objects[id]&login=$login'>Передать</a>
</td>

<td width=42% valign=top>
<b><i>Минимальные требования:</i></b><br>
		$min_rase$min_level$min_str$min_dex$min_ag$min_vit$min_razum<br>";

		if ($hp or $energy or $min or $max or $strength or $dex or $agility or $vitality or $razum or $br1 or $br2 or $br5 or $br3 or $br4 or $krit or $unkrit or $uv or $unuv) echo"<b><i>Действие предмета:</i></b><br>$hp$energy$min$max$strength$dex$agility$vitality$razum$br1$br2$br3$br4$br5$krit$unkrit$uv$unuv
</td></tr>";
	}
}
###КОНЕЦ ЦИКЛА








print"</table>";


?>