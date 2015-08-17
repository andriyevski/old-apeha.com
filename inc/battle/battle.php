<?php
mysql_escape_string($enemy);
$now=time();

//header("Content-Type: application/xml;\ncharset=windows-1251;\nCache-Control: no-cache;");
include("inc/battle/changed_1.php");
include "inc/battle/priemy/index.php";
include 'inc/main/functions.php';

 //echo"<script language='JavaScript' src='i/show_inf_b.js'></script>";
echo"<script language='JavaScript' src='i/login_form.js'></script>";
echo"<script language='JavaScript' src='i/show_inf.js'></script>";
echo"<script language='JavaScript' src='i/time.js?12022010'></script>";
echo"<script language='JavaScript' src='i/xmlhttprequest.js?12022010'></script>";
echo"<script language='JavaScript' src='i/b.js?".time()."'></script>";
echo"<meta http-equiv='Content-Type' content='application/xml' charset='windows-1251'>";
echo"<div id='mainform' style='position:absolute; left:11px; top:30px'></div>";
echo"<div id='hint1' class='hint'></div>";


$_RESERVER['battle'] = $stat['battle'];

// ----- # Узнаем, в какой команде, и сколько HP нанесли # ----- //
$participant=mysql_fetch_array(mysql_query("SELECT `hp`, `damage`, `side`, `damaged_h`, `damaged_t`, `damaged_l`, `damaged_r`, `damaged_le`,`x`,`y` FROM participants WHERE time='".$stat['battle']."' AND id='".$stat['id']."' and participants.hp>'0' LIMIT 1"));

if ($participant['side'] == "") $participant['side'] = $stat['bside'];

$opp_side=1-$participant['side']; // получаем сторону опонента

$maxxi=mysql_fetch_array(mysql_query('select id as id from battles WHERE offer='.$stat['battle'].' order by id desc limit 1'));
// ----- # Информация о бое (Из таблицы заявок) # ----- //
$offer=mysql_fetch_array(mysql_query("SELECT `timeout`, `type`, `blood`, `kulak`, `stavka`, `zone_width`, `zone_height`,`zone_type` FROM offers WHERE time='".$stat['battle']."' LIMIT 1"));



if ($stat['hp_now']>0 && $participant['hp']>0) { // если есть живые

$op_partic_count = mysql_num_rows(mysql_query("select players.id from players,participants where players.battle={$stat['battle']} AND players.rank<>60 AND players.hp_now>0 AND players.id=participants.id AND participants.time={$stat['battle']} AND participants.frozen=0 and participants.hp>0"));// считаем кол-во человек находящихся в бою
$battles_sql = mysql_query("select * from battles where offer={$stat['battle']} AND type = 0 ORDER BY id DESC LIMIT 0,$op_partic_count");
$op_bat_count = mysql_num_rows($battles_sql); // считаем кол-во записей на ход

//echo 'Участников (тепленьких): '.$op_partic_count.'<BR>';

for($i=1;$i<6;$i++){
	if(${'lblock'.$i} > 0)$lblock[] = ${'lblock'.$i};
	if(${'rblock'.$i} > 0)$rblock[] = ${'rblock'.$i};
}  
//echo '$lkick = '.$lkick.';$rkick = '.$rkick.';$lblock[0] = '.$lblock[0].';$lblock[1] = '.$lblock[1].';$rblock[0] = '.$rblock[0].';$rblock[1] = '.$rblock[1].';$opponent= '.$opponent.'<BR>';
if (!empty($opponent) && (is_numeric($lkick)+is_numeric($rkick)==2||is_numeric($nx) && is_numeric($ny)||is_numeric($lkick)+count($rblock)==3||is_numeric($rkick)+count($lblock)==3||count($lblock)+count($rblock)==4)){
    $user_turn=mysql_fetch_array(mysql_query("select * from `battles` where `offer`=".$stat['battle']." and `attacker`='".$stat['user']."' and `type` = 0"));
  if (!$user_turn) { // если этот персонаж еще не ходил

$opponent = addslashes($opponent);
$opp_stat=mysql_fetch_array(mysql_query("select players.*,participants.x,participants.y, participants.hp FROM players,participants where players.user='$opponent' and participants.x='".mysql_real_escape_string($_POST['hx'])."' and participants.y='".mysql_real_escape_string($_POST['hy'])."' and participants.hp>0 and players.hp_now>0 AND participants.id=players.id AND participants.time='".$stat['battle']."' limit 1"));
if($opp_stat['side']==$participant['side'] ) $motion = 'domotion_fail();'; // проверка на разные команды
// ---- # некоторая предосторожность от маньяков # ---- //
// эпические удары
$lkick=(!is_numeric($lkick))?'NULL':round($lkick);
$rkick=(!is_numeric($rkick))?'NULL':round($rkick);
for($i=0;$i<2;$i++){ // и блоки
	$lblock[$i]=(!is_numeric($lblock[$i]))?'NULL':round($lblock[$i]);
	$rblock[$i]=(!is_numeric($rblock[$i]))?'NULL':round($rblock[$i]);
}

$nx=(!is_numeric($nx))?'NULL':abs(round($nx));
$ny=(!is_numeric($ny))?'NULL':abs(round($ny));
// ------------------------------------------------------------------- //

if(is_numeric($nx) && is_numeric($ny) && (dist($participant['x'],$participant['y'],$nx,$ny)!=1 || $participant['y']%2==0 && $nx==$participant['x']+1 && ($ny==$participant['y']+1||$ny==$participant['y']-1) || $participant['y']%2!=0 && $nx==$participant['x']-1 && ($ny==$participant['y']+1||$ny==$participant['y']-1) || $offer['zone_width']<$nx || $offer['zone_height']<$ny))$motion = 'domotion_fail();';  
if(!is_numeric($nx) && !is_numeric($ny) && (($rkick>=0 && $rkick<=5 && $lkick>=0 && $rkick<=5 || $rkick>=0 && $rkick<=5 && count($lblock)==2 || $lkick>=0 && $lkick<=5 && count($rblock)==2 || count($rblock)+count($lblock)==4) && dist($participant['x'],$participant['y'],$opp_stat['x'],$opp_stat['y'])==1 && ($participant['y']%2==0 && $opp_stat['x']==$participant['x']+1 && ($opp_stat['y']==$participant['y']+1 || $opp_stat['y']==$participant['y']-1)) || ($participant['y']%2!=0 && $participant['x']-1==$opp_stat['x'] && ($opp_stat['y']==$participant['y']+1||$opp_stat['y']==$participant['y']-1))||dist($participant['x'],$participant['y'],$opp_stat['x'],$opp_stat['y'])>1)) {echo dist($participant['x'],$participant['y'],$opp_stat['x'],$opp_stat['y']); $motion = 'domotion_fail();';}        
if(is_numeric($nx) && is_numeric($ny) && mysql_num_rows(mysql_query('SELECT `img` FROM `obstacles` WHERE `c_x`='.$nx.' AND `c_y`='.$ny.' AND `offer_id`='.$stat['battle']))>0) {$pr=1; $motion='domotion_obst();';}//die('Препятствие!');

// ------------------------------------------------------------------- //

if(is_numeric($nx)){
	$zones4block=array(1,2,3,4,5);
	$zones4block[rand(0,4)]='';
	sort($zones4block);
	array_shift($zones4block);
}
//die($pr.' '.$op_bat_count);
if ($op_bat_count==0 and !$pr) { // если наносим удар первым
        $max=mysql_fetch_array(mysql_query("select id from battles where offer='".$stat['battle']."' order by id desc limit 1"));

        if (!$max)
          $new_id=1;
        else
          $new_id=$max['id']+1;

	if (is_numeric($nx) && is_numeric($ny)){
if(mysql_num_rows(mysql_query('select participants.id FROM participants where participants.time='.$stat['battle'].' AND participants.x='.$nx.' and participants.hp > 0 AND participants.y='.$ny))>0) exit('warning #mv1'); // контроллер перемещений
              mysql_query("insert into `battles` (`offer`, `time`, `id`, `attacker`, `defender`, `side`, `x`, `y`,`lblock1`,`lblock2`,`rblock1`,`rblock2`)
             values ($stat[battle],".$now.",$new_id,'$stat[user]','".addslashes($opponent)."',".$participant['side'].", ".addslashes($nx).", ".addslashes($ny).",".$zones4block[0].','.$zones4block[1].','.$zones4block[2].','.$zones4block[3].")");
	}else{
                mysql_query(
          "insert into `battles` (`offer`, `time`, `id`, `attacker`, `defender`, `lkick`,`rkick`,`lblock1`,`lblock2`,`rblock1`, `rblock2`, `side`)
             values ($stat[battle],".$now.",$new_id,'$stat[user]','".addslashes($opponent)."',$lkick,$rkick,$lblock[0],$lblock[1],$rblock[0],$rblock[1], ".$participant['side'].")");

	}
}else{ // если этот удар промежуточный или последний - записываем
	$opponent_turn=mysql_fetch_array($battles_sql);
 	//checkmove($nx,$ny,$stat['battle'],$opponent_turn['id']);
if(mysql_num_rows(mysql_query('select battles.id from battles where battles.offer='.$stat['battle'].' and battles.type=0 and battles.x='.$nx.' and battles.y='.$ny))>0) exit('warning #mv2');
elseif(mysql_num_rows(mysql_query('select participants.id from participants where participants.time='.$stat['battle'].' AND participants.hp>0 AND participants.x='.$nx.' AND participants.y='.$ny))>0) exit('warning #mv3');

if(is_numeric($nx)){
	$zones4block=array_chunk($zones4block,2);
$lblock=$zones4block[0];
$rblock=$zones4block[1];
unset($zones4block);
}

	mysql_query("insert into battles (`offer`, `time`, `id`, `attacker`, `defender`, `lkick`, `rkick`,`lblock1`, `lblock2`, `rblock1`, `rblock2`, `type`, `damage`, `side`, `x`, `y`) values ($stat[battle], ".time().", $opponent_turn[id], '$stat[user]', '$opponent', $lkick,$rkick,$lblock[0],$lblock[1],$rblock[0],$rblock[1], 0, NULL, ".$participant['side'].", $nx, $ny)");
}

include ('inc/battle/m_counting.php');

    }
  }

}

function checkmove($tx,$ty,$bid,$mid){
// if (mysql_num_rows(mysql_query("SELECT participants.id FROM players,battles,participants WHERE battles.offer=$bid AND participants.time=battles.offer AND players.user=battles.attacker AND participants.id=players.id AND ((participants.x=$tx AND participants.y=$ty AND battles.id=$mid AND battles.x IS NULL AND battles.y IS NULL) OR (battles.x=$tx AND battles.y=$ty AND battles.id=$mid AND battles.type=1))"))>0) exit('Занято<br>'."SELECT participants.id FROM players,battles,participants WHERE battles.offer=$bid AND participants.time=battles.offer AND players.user=battles.attacker AND participants.id=players.id AND ((participants.x=$tx AND participants.y=$ty AND battles.id=$mid AND battles.x IS NULL AND battles.y IS NULL) OR (battles.x=$tx AND battles.y=$ty AND battles.id=$mid AND battles.type=1))");

// if (mysql_num_rows(mysql_query("SELECT participants.id FROM participants,players,battles WHERE participants.time=$bid AND players.id=participants.id AND battles.id=$mid AND battles.offer=$bid AND ((participants.x=$tx AND participants.y=$ty AND battles.type=1) OR (battles.x=$tx AND battles.y=$ty AND battles.type=0)) LIMIT 1"))>0) exit('Занято<br>'."SELECT participants.id FROM participants,players,battles WHERE participants.time=$bid AND players.id=participants.id AND battles.id=$mid AND battles.offer=$bid AND ((participants.x=$tx AND participants.y=$ty AND battles.type=1) OR (battles.x=$tx AND battles.y=$ty AND battles.type=0)) LIMIT 1");

if(mysql_num_rows(mysql_query('select battles.id from battles WHERE battles.offer='.$bid.' AND battles.type=0 AND battles.x='.$tx.' AND battles.y='.$ty))>0) exit();
else{
mysql_query('select battles.id from battles where battles.offer='.$bid.' AND battles.type=0 AND battles.x IS NULL AND battles.y IS NULL');
}

// else
// echo 'clear'."<br>SELECT participants.id FROM participants,players,battles WHERE participants.time=$bid AND players.id=participants.id AND battles.id=$mid AND battles.offer=$bid AND ((participants.x=$tx AND participants.y=$ty AND battles.type=1) OR (battles.x=$tx AND battles.y=$ty AND battles.type=0)) LIMIT 1";
}

function dist($mx,$my,$tx,$ty){
return round(sqrt(pow(($my-$ty),2)+pow(($mx-$tx),2)));
}

include('inc/main/alt.php');

include('inc/battle/check_ends.php');

include("inc/magic/use.php");
include("inc/battle/left.php");

if(!$ajax && !$endbattle) echo "<SCRIPT LANGUAGE='JavaScript'>motion='<i>Инициализация...</i>';</SCRIPT><table><tr><td><input type='button' value='Обновить' id='update' onclick='forceupd()' class=standbut></td><td id=timeout></td></tr></table><div id='gamep'><div style=\"width:".($offer['zone_width']*34+18)."px;height:".($offer['zone_height']*30+11)."px;background-image:url(img/cells.gif);position:relative;\" id='map' onclick=\"target(event.clientX, event.clientY)\"></div></div><script language='javascript'>zx=".$offer['zone_width'].";zy=".$offer['zone_height'].";</script><div id='buttons' style='visibility:visible;'><input type=button value='Идти' onclick=\"moveto()\" id='bmove' class=standbut> <input id='striker' type=button value='Удар' onclick=\"strikec();\" class=standbut></div>";

echo ((!empty($nms))?"<center><font color=red><b>$nms</b></font></center>":'').$echo.$form.((!empty($receptions))?"<script language=javascript>recs = '$receptions';</script>":'');

if (!$endbattle) {

// Построение комманд
$_comm=mysql_query("select
        participants.side, participants.hp as hp, participants.x, participants.y, players.user as `user`,players.id as `id`,participants.frozen from participants, players where
        players.id=participants.id
    and participants.hp>0
    and players.hp_now>0
        and participants.time=".$stat['battle']);
for ($i=0; $i<mysql_numrows($_comm); $i++) {
$comm=mysql_fetch_array($_comm);

switch ($comm[side]) {
case 0: $command[left][]="$comm[user]";$command[left_x][]="$comm[x]";$command[left_y][]="$comm[y]";$command[left_hp][]="$comm[hp]";$command[left_id][]="$comm[id]";$command['left_fr'][]="$comm[frozen]"; break;
case 1: $command[right][]="$comm[user]";$command[right_x][]="$comm[x]";$command[right_y][]="$comm[y]"; $command[right_hp][]="$comm[hp]";$command[right_id][]="$comm[id]";$command['right_fr'][]="$comm[frozen]"; break;
}}
//
$js_dist=150;
$js_tid=-1;
$js_tname='';
echo"<HR COLOR=e2e0e0><div id='part_list'>";
$js_info = "document.getElementById('map').innerHTML='';
w=$offer[zone_width];
h=$offer[zone_height];";
// Список команд
for ($i=0; $i<count($command['left']); $i++) {
$sql_left=mysql_query("SELECT `type`,`x`,`y` FROM battles WHERE attacker='".$command['left'][$i]."' AND offer=".$stat['battle']." ORDER by `time` DESC LIMIT 1");
$jjjs=mysql_fetch_array($sql_left);
if (mysql_num_rows($sql_left) == 0) $jjjs = array('type'=>1);
if($participant['side']==1 && dist($participant['x'],$participant['y'],$command['left_x'][$i],$command['left_y'][$i])<$js_dist){
  $js_dist=dist($participant['x'],$participant['y'],$command['left_x'][$i],$command['left_y'][$i]);
  $js_tid=$command['left_id'][$i];
  $js_tname=$command['left'][$i];
  $js_tx=((is_numeric($jjjs['x']) && $jjjs['type']==0)?$jjjs['x']:$command['left_x'][$i]);
  $js_ty=((is_numeric($jjjs['y']) && $jjjs['type']==0)?$jjjs['y']:$command['left_y'][$i]);
}
// $type = mysql_fetch_array(mysql_query("SELECT `type` FROM battles WHERE attacker='".$command['left'][$i]."'"));
echo "<a href=\"javascript:top.to('".$command['left'][$i]."')\" oncontextmenu=\"top.pp('".$command['left'][$i]."'); return false;\"><font color='blue'>".$command['left'][$i]."</font></a> <SMALL>[ ".$command['left_hp'][$i]." ]</SMALL>";
if ($i+1<count($command['left'])) echo", "; 
$js_info.=(($command['left'][$i]!=$stat['user'])?"create":"my")."per(".((is_numeric($jjjs['x']) && $jjjs['type']==0)?$jjjs['x']:$command['left_x'][$i]).",".((is_numeric($jjjs['y']) && $jjjs['type']==0)?$jjjs['y']:$command['left_y'][$i]).",'".($command['left'][$i])."',".$command['left_id'][$i].",'1',".$jjjs['type'].",{$command['left_fr'][$i]});";}

echo" <b>против</b> ";

for ($i=0; $i<count($command['right']); $i++) {
if($participant['side']==0 && dist($participant['x'],$participant['y'],$command['right_x'][$i],$command['right_y'][$i])<$js_dist){ 
  $js_dist=dist($participant['x'],$participant['y'],$command['right_x'][$i],$command['right_y'][$i]);
  $js_tid=$command['right_id'][$i];
  $js_tname=$command['right'][$i];
  $js_tx=((is_numeric($jjjs['x']) && $jjjs['type']==0)?$jjjs['x']:$command['right_x'][$i]);
  $js_ty=((is_numeric($jjjs['y']) && $jjjs['type']==0)?$jjjs['y']:$command['right_y'][$i]);
}
echo "<a href=\"javascript:top.to('".$command['right'][$i]."')\" oncontextmenu=\"top.pp('".$command['right'][$i]."'); return false;\"><font color='red'>".$command['right'][$i]."</font></a> <SMALL>[ ".$command['right_hp'][$i]." ]</SMALL>";
if ($i+1<count($command['right'])) echo", "; 
$sql_right=mysql_query("SELECT `type`,`x`,`y` FROM battles WHERE attacker='".$command['right'][$i]."' AND offer=".$stat['battle']." ORDER by `time` DESC LIMIT 1");
$jjjs=mysql_fetch_array($sql_right);
if (mysql_num_rows($sql_right) == 0) $jjjs = array('type'=>1);
$js_info.=(($command['right'][$i]!=$stat['user'])?"create":"my")."per(".((is_numeric($jjjs['x']) && $jjjs['type']==0)?$jjjs['x']:$command['right_x'][$i]).",".((is_numeric($jjjs['y']) && $jjjs['type']==0)?$jjjs['y']:$command['right_y'][$i]).",'".$command['right'][$i]."',".$command['right_id'][$i].",'2',".$jjjs['type'].",{$command['right_fr'][$i]});";}
//
$js_info.="tname='$js_tname';tcid=$js_tid;tdist=$js_dist;";
if(empty($victims[$random])){ $ttarget=$js_tname;}// $js_info.="boom($js_tx,$js_ty);";}
echo"</div><script language=\"JavaScript\">$js_info</script>";
echo"<HR COLOR=e2e0e0>";

# echo"<br>";
}

// START.obst Вставляем препятствия 
$all_obst = '';
$obstacles = mysql_query('SELECT `c_x`,`c_y`,`img` FROM `obstacles` WHERE `offer_id`=\''.$stat['battle'].'\'');
while ($obst = mysql_fetch_array($obstacles)) $all_obst.='createobst('.$obst['c_x'].','.$obst['c_y'].','.$obst['img'].');';
echo '<SCRIPT language="JavaScript">'.$all_obst.'</SCRIPT>';
// END.obst

$efail=mysql_fetch_array(mysql_query('select id as id FROM battles WHERE type=1 AND (comment1 IS NOT NULL OR comment2 IS NOT NULL) AND offer='.$_RESERVER['battle'].' order by id desc limit 1'));
// echo $efail['id'];
$last_turns=mysql_query('select id, time, attacker, defender, comment1,comment2, type,x,y from battles where offer='.$_RESERVER['battle'].' AND (comment1 IS NOT NULL OR comment2 IS NOT NULL) AND id>'.($efail['id']-2).' ORDER BY id DESC, time DESC');
if ($last_turns)
// $l_id=1;
for ($i=0; $i<mysql_num_rows($last_turns); $i++) {

        $turn=mysql_fetch_array($last_turns);
       if ($i==0) {
      
                echo "<TABLE CELLSPACING=0 CELLPADDING=1 WIDTH=100%><TR><TD";

                if (!$endbattle) echo" WIDTH=35%>Нанесенный урон: <u>".$participant['damage']." HP</u>";
                else {echo" WIDTH=100% ALIGN=CENTER><B>Бой закончен.</B><BR>Нанесено урона: <u>".$participant['damage']." HP</u>. Получено опыта: <u>".$addexp."</u>";
                echo "<script language='javascript'>window.location.href = '/bfinal.php?log=$battle_id';</script>";die(xz);
                }

                echo"</TD>";
                if ($timeout<0) $timeout=0;
                if (!$endbattle) {
                echo"<TD>Тайм-аутом: <u>",$offer['timeout']/60," мин.</u></TD>";
                }

                echo"</TR></TABLE><HR color=e2e0e0><script language='javascript'>last_id=".$turn['id'].";</script><div id='comments'>";
        }

        if ($turn['id']!=$l_id && $turn['id']>0) echo'<div name=\'round\'>&nbsp;&nbsp;<b>Раунд № '.$turn['id'].'</b><BR>';

        if($turn['id']>0){ if ($turn['attacker']==$stat['user'] || ($turn['defender']==$stat['user'] && is_null($turn['y']))) $ctime="<a style='color: #007000; background-color: #00FFAA'>".date("H:i:s",$turn[time])."</a>";
        else $ctime=date("H:i:s",$turn[time]);}else $ctime='';
        if(strlen($turn['comment1'])>0) echo '<b>'.$ctime.'</b> '.$turn['comment1'].'<br>';
        if(strlen($turn['comment2'])>0) echo '<b>'.$ctime.'</b> '.$turn['comment2'].'<br>';

         $l_id = $turn['id'];
if($_comm && mysql_numrows($_comm)>0 && ($i+1)%mysql_numrows($_comm)==0) echo '</div>';
}

// вывод инфы противника, выводим в любом случае

echo "</div></td><td valign=top align=right><div id='doll'>";
// $ttarget='test';
// echo $last_turns['defender'];
include ('inc/battle/right.php');
echo '</div></td></tr></table>';

// слишком толсто!
// if (time()-$max['time']>$offer['timeout'] and $stat['hp_now']>0 and !$endbattle) include('inc/battle/right.php');
// 
// else {
//      $rand = mt_rand(1, 19);
//      echo"</td><td valign=top align=right>$now - ".$max['time']." > ".$offer['timeout']."<img src='i/battle/".$rand.".jpg' width=210 height=230></td></tr></table>";
// }
// Вердикт: закоментить и поглотить
//$x1=$js_tx;$y1=$js_ty;
//if(isset($_COOKIE['txx']) and isset($_COOKIE['tyy'])){$js_tx=$_COOKIE['txx'];$js_ty=$_COOKIE['tyy'];}
echo "<script language=\"javascript\">var nx='$js_tx'; var ny='$js_ty'; var tname='$js_tname';zone('".$offer['zone_type']."');boom($js_tx,$js_ty);ShowTimeOut('timeout',".$timeout.",2,".$stat['battle'].");sdll('sdoll',{$participant['damaged_h']},{$participant['damaged_t']},{$participant['damaged_l']},{$participant['damaged_r']},{$participant['damaged_le']});$motion</script>";

?>
