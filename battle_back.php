<?
include("inc/db_connect.php");

$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."' LIMIT 1"));
$now=time();
$ctime=time();
if(!empty($ttarget)){
	$ajax=true;
	if(empty($tab)) $tab = 't';

$qqq=mysql_query("SELECT * FROM players WHERE user='".(($ttarget>$victims[$random])?(mysql_escape_string($ttarget)):$victims[$random])."'");
if(mysql_num_rows($qqq)>0)$second=mysql_fetch_array($qqq);	
else{
$ttarget=iconv("UTF-8","windows-1251",$ttarget);
$qqq=mysql_query("SELECT * FROM players WHERE user='".(($ttarget>$victims[$random])?(mysql_escape_string($ttarget)):$victims[$random])."'");	
$second=mysql_fetch_array($qqq);
}
$targ=mysql_fetch_array(mysql_query("SELECT * FROM players WHERE user='$ttarget'"));
//$t_max=$targ['vitality']*5;
//$s_max=$stat['vitality']*5;
$targ=mysql_fetch_array(mysql_query("select hp,damaged_h,damaged_t,damaged_l,damaged_r,damaged_le from participants where time=".$stat['battle'].' AND id='.$targ['id']));
include ('inc/battle/right.php');
$self=mysql_fetch_array(mysql_query("select hp,damaged_h,damaged_t,damaged_l,damaged_r,damaged_le from participants where time=".$stat['battle'].' AND id='.$stat['id']));

//echo 'sdll(\''.$tab.'doll\','.$targ['damaged_h'].','.$targ['damaged_t'].','.$targ['damaged_l'].','.$targ['damaged_r'].','.$targ['damaged_le'].');';
//echo 'sdll(\'sdoll\','.$self['damaged_h'].','.$self['damaged_t'].','.$self['damaged_l'].','.$self['damaged_r'].','.$self['damaged_le'].');';

	unset($self,$ajax);
	exit;
}elseif($page=='showbupdate'){
	header("charset=UTF-8;\nCache-Control: no-cache;");
//echo "doLoad('battle.php?ttarget=".$target."&".rand()."');
//echo "doLoad('battle.php?ttarget=".$stat['user']."&tab=s&".rand()."');";
	function dist($mx,$my,$tx,$ty){
		$d=round(sqrt(pow(($my-$ty),2)+pow(($mx-$tx),2)));
		if((($my%2==0 && $tx==$mx+1)||($my%2==1 && $tx==$mx-1)) && ($ty==$my+1||$ty==$my-1))$d++;
		//if($my%2==1 && $tx==$mx-1 && ($ty==$ty+1||$ty==$ty-1))$d++;
		return $d;
	}

	// header("Content-Type: application/xml;\ncharset=windows-1251;\nCache-Control: no-cache;");
	// echo '123';
	// echo 'SELECT time,id FROM battles WHERE offer='.$stat['battle'].' AND type=1 OR type=2 ORDER BY time DESC LIMIT 1';
	// echo '----'.$max['id'].'----';

	include ('inc/battle/check_ends.php');
	// переменные необходимые при подсчете ходов
	$offer=mysql_fetch_array(mysql_query("SELECT `timeout`, `type`, `blood`, `kulak`, `stavka`, `zone_width`, `zone_height` FROM offers WHERE time='".$stat['battle']."' LIMIT 1"));
	$max1=@mysql_fetch_array(mysql_query('SELECT time,id FROM battles WHERE offer='.$stat['battle'].' AND type=1 OR type=2 ORDER BY time DESC LIMIT 1'));
	// ttarget
	$op_partic_count = @mysql_num_rows(mysql_query("select players.id from players,participants where players.battle={$stat['battle']} AND players.rank<>60 AND players.hp_now>0 AND players.id=participants.id AND participants.time={$stat['battle']} AND participants.frozen=0"));// считаем кол-во человек находящихся в бою
	$battles_sql = mysql_query("select id from battles where offer={$stat['battle']} AND type = 0 ORDER BY id DESC LIMIT 0,$op_partic_count");
	$op_bat_count = @mysql_num_rows($battles_sql); // считаем кол-во записей на ход

	include ('inc/battle/m_counting.php'); // файл с алгоритмом подсчета
	//
	echo 'timeout1='.(($offer['timeout']-(time()-$max1['time']))).';';
	
	
	echo "document.getElementById('map').innerHTML='';"; // удаляем игроков с карты
	echo "obst_x.length=0;obst_y.length=0;"; // чистим массивы с препятствиями
	// запрашиваем список игроков
	// Построение комманд
	$players=mysql_query("select
        participants.side, participants.hp as hp, participants.x, participants.y, players.user as `user`,players.id as `id`,participants.frozen from participants, players where
        players.id=participants.id
    and players.hp_now>0
        and participants.time=".$stat['battle']);
	while($player=@mysql_fetch_array($players)){
		$player1=mysql_fetch_array(mysql_query("SELECT `type`,`x`,`y` FROM battles WHERE attacker='".$player['user']."' AND offer=".$stat['battle']." ORDER by `time` DESC LIMIT 1"));
		if(!is_numeric($player1['type'])) $player1['type']=1;
		echo (($player['id']==$stat['id'])?'my':'create').'per('.((is_numeric($player1['x']) && is_numeric($player1['y']) && $player1['type']==0)?$player1['x'].','.$player1['y']:$player['x'].','.$player['y']).',\''.$player['user'].'\','.$player['id'].',\''.($player['side']+1).'\','.$player1['type'].','.$player['frozen'].');';
		if($player['side']==0){
			$left.="<a href=\"javascript:top.to(\'{$player['user']}\')\" oncontextmenu=\"top.pp(\'{$player['user']}\'); return false;\"><font color=\"blue\">{$player['user']}</font></a> <small>[ {$player['hp']} ]</small>, ";
		}else{
			$right.="<a href=\"javascript:top.to(\'{$player['user']}\')\" oncontextmenu=\"top.pp(\'{$player['user']}\'); return false;\"><font color=\"red\">{$player['user']}</font></a> <small>[ {$player['hp']} ]</small>, ";
		}
	}
	$part_list=(substr($left,0,-2).' <b>против</b> '.substr($right,0,-2));
	//$part_list=$part_list);
	echo 'document.getElementById(\'part_list\').innerHTML=\''.$part_list.'\';';
	$query=mysql_query("SELECT * FROM `battles` WHERE offer=".$stat['battle']." AND id>=".abs($max1['id']-1)." AND (comment1 IS NOT NULL OR comment2 IS NOT NULL) ORDER BY time DESC, damage DESC");
	if($query && mysql_num_rows($query)){ // обновление комментов
		// echo'alert(\'1\');';
		$bb=-1;
		echo 'document.getElementById(\'comments\').innerHTML=\'\';';
		//$cmnts_upd='';
	/*	while($comm=mysql_fetch_array($query)){
			if($bb!=$comm['id'] && $comm['id']>0){$bb=$comm['id'];echo 'document.getElementById(\'comments\').innerHTML=document.getElementById(\'comments\').innerHTML+\'&nbsp;&nbsp<b>Раунд № '.$comm['id'].'</b><br>\';';}
			if($comm['id']>0)$ctime=($comm['defender']==$stat['user'] && !is_numeric($comm['x']) && !is_numeric($comm['y']) || $comm['attacker']==$stat['user'])?"<a style=\'color: #007000; background-color: #00FFAA\'><b>".date("H:i:s",$comm['time'])."</b></a>":'<b>'.date("H:i:s",$comm['time']).'</b>';else $ctime='';
			if(strlen($comm['comment1'])>0)echo 'document.getElementById(\'comments\').innerHTML=document.getElementById(\'comments\').innerHTML+\''.$ctime.' '.$comm['comment1'].'<br>\';';
			if(strlen($comm['comment2'])>0)echo 'document.getElementById(\'comments\').innerHTML=document.getElementById(\'comments\').innerHTML+\''.$ctime.' '.$comm['comment2'].'<br>\';';
		}*/
		
		
		while($comm=mysql_fetch_array($query)){
			if($bb!=$comm['id'] && $comm['id']>0){$bb=$comm['id'];echo 'document.getElementById(\'comments\').innerHTML=document.getElementById(\'comments\').innerHTML+\'&nbsp;&nbsp<b>Раунд № '.$comm['id'].'</b><br>\';';}
			if($comm['id']>0)$ctime=($comm['defender']==$stat['user'] && !is_numeric($comm['x']) && !is_numeric($comm['y']) || $comm['attacker']==$stat['user'])?"<a style=\'color: #007000; background-color: #00FFAA\'><b>".date("H:i:s",$comm['time'])."</b></a>":'<b>'.date("H:i:s",$comm['time']).'</b>';else $ctime='';
			if(strlen($comm['comment1'])>0)echo 'document.getElementById(\'comments\').innerHTML=document.getElementById(\'comments\').innerHTML+\''.$ctime.' '.$comm['comment1'].'<br>\';';
			if(strlen($comm['comment2'])>0)echo 'document.getElementById(\'comments\').innerHTML=document.getElementById(\'comments\').innerHTML+\''.$ctime.' '.$comm['comment2'].'<br>\';';
		}
		
		//echo "alert($cmnts_upd);";
		//$cmnts_upd=iconv('utf-8','windows-1251',$cmnts_upd);
		//echo $cmnts_upd;
/*		while($comm=mysql_fetch_array($query)){
			if($bb!=$comm['id'] && $comm['id']>0){$bb=$comm['id'];echo 'document.getElementById(\'comments\').innerHTML=document.getElementById(\'comments\').innerHTML+\'&nbsp;&nbsp<b>Раунд № '.$comm['id'].'</b><br>\';';}
			if($comm['id']>0)$ctime=($comm['defender']==$stat['user'] && !is_numeric($comm['x']) && !is_numeric($comm['y']) || $comm['attacker']==$stat['user'])?"<a style=\'color: #007000; background-color: #00FFAA\'><b>".date("H:i:s",$comm['time'])."</b></a>":'<b>'.date("H:i:s",$comm['time']).'</b>';else $ctime='';
			if(strlen($comm['comment1'])>0)echo 'document.getElementById(\'comments\').innerHTML=document.getElementById(\'comments\').innerHTML+\''.$ctime.' '.$comm['comment1'].'<br>\';';
			if(strlen($comm['comment2'])>0)echo 'document.getElementById(\'comments\').innerHTML=document.getElementById(\'comments\').innerHTML+\''.$ctime.' '.$comm['comment2'].'<br>\';';
		}*/
	}
	// START.obst Вставляем препятствия, т.к. карта генерится поновой
$all_obst = '';
$obstacles = mysql_query('SELECT `c_x`,`c_y`,`img` FROM `obstacles` WHERE `offer_id`=\''.$stat['battle'].'\'');
while ($obst = mysql_fetch_array($obstacles)) echo 'createobst('.$obst['c_x'].','.$obst['c_y'].','.$obst['img'].');';
// END.obst
	echo 'boom(tx,ty);';
	exit;
}

if ($stat['t_time']>$now) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']>$now) { header("Location: academy.php"); exit; }
elseif ($stat['o_time']>$now) { header("Location: juvelir.php"); exit; }
elseif ($stat['r_time']>$now) { header("Location: podzem.php"); exit; }
elseif ($stat['lov_time']>$now) { header("Location: more.php"); exit; }
elseif ($stat['rub_time']>$now) { header("Location: forest.php"); exit; }
elseif ($stat['forest_time']>$now) { header("Location: forest.php"); exit; }
elseif ($stat['more_time']>$now) { header("Location: more.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['elikmake_time']>$now) { header("Location: vedma.php"); exit; }
else {
	// echo "ID вида боя: ".$battle_type;
	if ($stat['battle']) {
		include("inc/html_header.php");

		echo "<BODY leftmargin=0 topmargin=0 marginwidth=0 marginheight=0 background='/i/bg.gif'>";

		include("inc/battle/battle.php");
	}
	else {

		if ($battle_type==1 || !isset($battle_type) || empty($battle_type)) include("inc/battle/offers/offers_1.php");
		elseif ($battle_type==2)
		{
			if ($stat['level'] < 0 ) echo("<script>alert('Извините, групповые бои с 1-ого уровня');window.location=\"battle.php\"</script>");
			else include("inc/battle/offers/offers_2.php");
		}
		elseif ($battle_type==3)
		{
			if ($stat['level']<0) echo("<script>alert('Извините, хаотиные бои с 1-ого уровня!');window.location=\"battle.php\"</script>");
			else include("inc/battle/offers/offers_3.php");
		}
		include("inc/html_header.php");
		echo "<BODY leftmargin=0 topmargin=0 marginwidth=0 marginheight=0 background='/i/bg.gif'>";

		echo"<div id=hint1 class=hint></div>";

		echo"<script language=JavaScript src='i/show_inf.js'></script>";
		echo"<script language=JavaScript src='i/time.js'></script>";

		print"<table cellpadding=3 width=100% cellspacing=1 border=0 bakground='/i/bg2.gif'>
<td align=right>
<input class=input type=button value='Обновить' onclick='window.location.href=\"battle.php?battle_type=$battle_type";

		if ($battle_type==2) echo"&page=start";

		echo"&tmp=\"+Math.random();\"\"'>
<input class=input type=button value='Назад' onclick='window.location.href=\"main.php\"'>
</td>
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
<tr><td width='100%' valign='top'>";



		if ($stat['room']==666 || ($stat['room']>=5 && $stat['room']<=56) || $stat['room']==0 || ($stat['room']>=300 && $stat['room']<=318) || ($stat['room']>=700 && $stat['room']<=745) || ($stat['room']>=600 && $stat['room']<=645) || ($stat['room']>=496 && $stat['room']<=500)) {
			echo"<br><center><b style='COLOR: Red'>Вы выбрали не совсем удачное место для проведения поединка!<br>Пройдите в <u>Здание Игрового Зала</u>!</b></center>";
			exit;
		}

		elseif ($stat['travma']>$now) {
			echo"<br><center><b style='COLOR: Red'>Вы не можете драться, т.к. тяжело травмированы!<br>Вам необходим отдых!</b></center>";
			exit;
		}
		echo"<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr>
<td width=33% align=center><b><a ";

		if ($battle_type==1 || !isset($battle_type) || empty($battle_type)) echo" disabled";
		else
		echo"href='battle.php?battle_type=1'"; echo">Дуэли</a></b></td>
<td width=33% align=center><b><a "; if ($battle_type==2) echo" disabled";
		else echo"href='battle.php?battle_type=2'"; echo">Групповые</a></b></td>
<td width=33% align=center><b><a "; if ($battle_type==3) echo" disabled";
		else
		echo"href='battle.php?battle_type=3'"; echo">Хаотические</a></b></td>
</tr>
</table></div>";



		if ($battle_type==1 || !isset($battle_type) || empty($battle_type)) include("inc/battle/offers/show_offers_1.php");
		elseif ($battle_type==2) include("inc/battle/offers/show_offers_2.php");
		elseif ($battle_type==3) include("inc/battle/offers/show_offers_3.php");

		echo"
  </td>
                </tr>
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


}
?>
