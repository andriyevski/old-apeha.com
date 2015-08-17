<?
require_once("inc/module.php");
$cr=0;
$test = mysql_query("SELECT * FROM bs where t=1 and user NOT LIKE ''");
if (mysql_num_rows($test) == 1) {
  $sel = mysql_query("SELECT * from bs where t=1");
  while ($sels = mysql_fetch_array($sel)) {
    $cr = $cr + $sels[cash];
  }
  mysql_query("UPDATE players SET credits = $cr, bs='0', room=500 where user='$stat[user]'");
  echo"<script>parent.main.location=\"bs_smert.php\"</script>";
}

if ($Attack) {
  echo "asdasdasd";
                if (empty($login)) $msg = "Укажите логин!";
                else {
                        $chl=mysql_fetch_array(mysql_query("SELECT * FROM players where user='".addslashes($login)."'"));

                        if ($chl['user'] == "$stat[user]") {$msg="Нападение на самого себя - это уже мазохизм..."; }
                        elseif ($ctime-$chl['lpv'] > 180 && $chl['rank'] != 60) $nms="Персонаж <u>$login</u> отстутствует!";
                        elseif ($chl['room'] != $stat['room']) $nms="Для нападния Вам необходимо находится в одной комнате!";
                        else {

                                require_once("inc/chat/functions.php");
                                insert_msg("Разъярённый <b><u>$stat[user]</u></b> собрался с силами и напал на Вас!","","","1",$chl['user'],"",$chl['room']);

                        $battime="$now";

                        if ($chl['rank']==60 && ($chl['battle'] == $chl['last_battle'] || !$chl['battle'])) {

                        $_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp`, SUM(objects.`vitality`) as `vitality` FROM slots, objects WHERE slots.id='".$chl['id']."' AND objects.user='".$chl['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));
                        $MySkills = explode("|",$chl['rase_skill']);
                        $chl['gnom']=$MySkills['3']*5;
                        $chl['vitality']+=$_obj['vitality'];
                        $chl['hp_max']=ceil(($chl['vitality']*5+$_obj['hp'])*(1+($chl['gnom']/100)));
                        $chl['hp_now']=$chl['hp_max'];
                        mysql_query ("UPDATE `players` SET `hp_now` = '".$chl['hp_now']."', `battle` = NULL, `lpv`='".time()."' WHERE `id` = '".$chl['id']."'");
                        $chl['battle'] = NULL;
                        }

                        if ($chl['battle']) {

                        $prt=mysql_fetch_array(mysql_query("SELECT side as side,time as time from participants where time=$chl[battle] and id=$chl[id]"));

                        switch ($prt['side']) {
                        case 0: $side=1; break;
                        case 1: $side=0; break;
                        }

                        $levels=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level=$stat[level]"));

                        mysql_query("INSERT INTO participants (`time`, `id`, `side`, `base`,`hp`) values('$prt[time]', '$stat[id]', '$side', '$levels[base]', $stat[hp_now])");

                        $b_id_id=mysql_fetch_array(mysql_query("SELECT MAX(id) as id from battles where offer=$prt[time]"));
                        $b_id_id['id']+=1;

                        mysql_query("insert into battles (offer, time, id, attacker, defender, kick, block, type, damage, comment) values ($prt[time], '$battime', '$b_id_id[id]', '', '', '', '', NULL, '', '<script language=JavaScript>show_inf(\"$stat[user]\",\"$stat[id]\",\"$stat[level]\",\"$stat[rank]\",\"$stat[tribe]\");</script> вмешался в поединок!')");
                        $b_id=$prt[time];


                        mysql_query("UPDATE players, offers SET players.battle=".$prt['time'].", players.side=".$side.", offers.type=2 where players.id=$stat[id] && offers.time=$prt[time]");

                        } else {

                        $bdate=date("d.m.y H:i",$battime);

                        mysql_query("INSERT INTO offers (time, type, size_left, size_right, done, timeout) values($battime+600,1,1,'1','1','180')");

                        $levels_my = mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level=$stat[level]"));
                        $levels_opp = mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level=$chl[level]"));

                        mysql_query("INSERT INTO participants (time, id, side, hp, base) values($battime+600, '$stat[id]', '0', '".$stat['hp_now']."', '".$levels_my['base']."')");
                        mysql_query("INSERT INTO participants (time, id, side, hp, base) values($battime+600, '$chl[id]', '1', '".$chl['hp_now']."', '".$levels_opp['base']."')");

                        mysql_query("insert into battles (offer, time, id, attacker, defender, kick, block, type, damage, comment) values ($battime, $battime, '0', '', '', '', '', NULL, '', '<i>Часы показывали <u>$bdate</u> когда бой между </i><font color=CFA87A><b>$stat[user]</b></font> и <font color=679958><b>$chl[user]</b></font> <i>начался!</i>')");

                        mysql_query("update players set battle=$battime+600, side=0 where id='$stat[id]'");
                        mysql_query("update players set battle=$battime+600, side=1 where id='$chl[id]'");
                        $b_id=$battime;

                        }

                        echo"<script>parent.main.location=\"battle.php?tmp=\"+Math.random();\"\"</script>";

                        }
                }
              }
$now = time();
include("inc/html_header.php");
echo"<body bgcolor=#EBEDEC leftmargin=0 topmargin=0>
<DIV id=hint1></DIV>
<div id=mainform style='position:absolute; left:30px; top:30px'></div>";
echo"<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/time.js\"></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/show_inf.js\"></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/login_form.js\"></SCRIPT>";

print"<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td align=right valign=top>
$msg
<img src='i/refresh.gif' style='CURSOR: Hand' alt='Обновить' onclick='window.location.href=\"world.php?room=$stat[room]&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";

echo"
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td align=right>
";

echo"

<fieldset style='WIDTH: 98.6%'><legend>Башня смерди</legend>
<table width=100% cellspacing=0 cellpadding=5>
<tr>
<td valign=top width=200 nowrap>

<center>В комнате разбросаны вещи:<br/>
";
$room = $stat[room];
if ($do == "get") {
  $bs_obj_s = mysql_query("SELECT * FROM bs_objects where id = $id");
  $bs_obj = mysql_fetch_array($bs_obj_s);

  mysql_query("
               INSERT into objects(user,
inf,
min,
tip,
br1,
br2,
br3,
br4,
br5,
min_d,
max_d,
hp,
energy,
strength,
dex,
agility,
vitality,
razum,
krit,
unkrit,
uv,
unuv,
time,
life,
present,
bank,
onset,
about,
mf_type,
bs)

VALUES ('".$stat[user]."',
'".$bs_obj[inf]."',
'".$bs_obj[min]."',
'".$bs_obj[tip]."',
'".$bs_obj[br1]."',
'".$bs_obj[br2]."',
'".$bs_obj[br3]."',
'".$bs_obj[br4]."',
'".$bs_obj[br5]."',
'".$bs_obj[min_d]."',
'".$bs_obj[max_d]."',
'".$bs_obj[hp]."',
'".$bs_obj[energy]."',
'".$bs_obj[strength]."',
'".$bs_obj[dex]."',
'".$bs_obj[agility]."',
'".$bs_obj[vitality]."',
'".$bs_obj[razum]."',
'".$bs_obj[krit]."',
'".$bs_obj[unkrit]."',
'".$bs_obj[uv]."',
'".$bs_obj[unuv]."',
'".$bs_obj[time]."',
'".$bs_obj[life]."',
'".$bs_obj[present]."',
'".$bs_obj[bank]."',
'".$bs_obj[onset]."',
'".$bs_obj[about]."',
'".$bs_obj[mf_type]."',
'1') ");
echo "ok :)";
}



$rand = rand(0,1); #выбираеш диапазон рандома
if ($rand == 1) {
  $bs_obj_sel = mysql_query("SELECT * FROM bs_objects");
  $max = mysql_num_rows($bs_obj_sel);
  $obj_rand = rand(1,$max);
  if ($obj_rand == 1) {
    $bs_obj_s = mysql_query("SELECT * FROM bs_objects where id = $obj_rand");
    $bs_obj = mysql_fetch_array($bs_obj_s);
    $pr_inf=explode("|",$bs_obj[inf]);
    echo "<img src=i/items/$pr_inf[0].gif><br>
    <b>$pr_inf[1]</b><br>
    <a href=?do=get&id=$obj_rand>Забрать</a>";
  }
}


echo"

</td>
<td align=center valign=top width=100%>
";

$i1 = $room-4; $l1 = "<a href=world.php?room=$i1&tmp=$now>";
$i2 = $room-3; $l2 = "<a href=world.php?room=$i2&tmp=$now>";
$i3 = $room-2; $l3 = "<a href=world.php?room=$i3&tmp=$now>";
$i4 = $room-1; $l4 = "<a href=world.php?room=$i4&tmp=$now>";
$i6 = $room+1; $l6 = "<a href=world.php?room=$i6&tmp=$now>";
$i7 = $room+2; $l7 = "<a href=world.php?room=$i7&tmp=$now>";
$i8 = $room+3; $l8 = "<a href=world.php?room=$i8&tmp=$now>";
$i9 = $room+4; $l9 = "<a href=world.php?room=$i9&tmp=$now>";
echo "$l1<img src=bs/i/room$i1.gif width=50 height=50 border=0></a>$l2<img src=bs/i/room$i2.gif width=50 height=50 border=0></a>$l3<img src=bs/i/room$i3.gif width=50 height=50 border=0></a><br>
$l4<img src=bs/i/room$i4.gif width=50 height=50 border=0></a><img src=bs/i/room$room.gif width=50 height=50 border=0>$l6<img src=bs/i/room$i6.gif width=50 height=50 border=0><br>
$l7<img src=bs/i/room$i7.gif width=50 height=50 border=0></a>$l8<img src=bs/i/room$i8.gif width=50 height=50 border=0></a>$l9<img src=bs/i/room$i9.gif width=50 height=50 border=0>";


echo"</td>
<td width=200 valign=top nowrap>
<center>
<input type=button class=input value='Нападение' style='WIDTH: 120px' onclick=\"javascript:ShowForm('Нападение','bs_smert.php?Attack=$now&asd=1&do=124124124','','','1','attack','1','0');\">
";




echo"
</td>
</tr>
</table>
</fieldset>
";
?>
