
<META
	content='text/html; charset=windows-1251' http-equiv=Content-Type>
<?

$now = time();

include_once "class_character.php";

require_once "config.php";
include_once "functions.php";


global $lang;
include_once 'include_lang.php';
$character= new character($PHP_PHAOS_CHARID);
if  ($character->room != "49") {
	exit;
}
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";






if ($vix) {
	echo"<script>location='../main.php'</script>";

	mysql_query("UPDATE players set room=48, location=0 where user='".$stat['user']."'");
	mysql_query("delete from objects where tb=1 and user ='".$stat['user']."'");
	require_once("inc/chat/functions.php");
	insert_msg("Вы вышли из башни","","","1",$stat[user],"",$stat[room]);
}




if ($win) {
	if ($stat[room]==49) {

		mysql_query("UPDATE players set room = 48, location = 0 where room = 49");
		mysql_query("UPDATE tower set seans=0,healtime='50' where user='tstart'");
		mysql_query("delete from tower where user!='tstart'");

		print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"5; URL=../main.php\">";

		$ItTake = "almaz";
		$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));
		$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|Победителю турнирной башни|0|$buyitem[art]|0|$buyitem[iznos]";
		$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";
		mysql_query("INSERT INTO objects (`user`, `inf`,`min`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`,`tip`,`about`) values ('$stat[user]','$inf','$min','$buyitem[br1]','$buyitem[br2]','$buyitem[br3]','$buyitem[br4]','$buyitem[br5]','$buyitem[min]','$buyitem[max]','$buyitem[hp]','$buyitem[energy]','$buyitem[strength]','$buyitem[dex]','$buyitem[agility]','$buyitem[vitality]','$buyitem[razum]','$buyitem[krit]','$buyitem[unkrit]','$buyitem[uv]','$buyitem[unuv]','$now','$buyitem[tip]','$buyitem[about]')");




		$ItTake = "opal";
		$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));
		$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|Победителю турнирной башни|0|$buyitem[art]|0|$buyitem[iznos]";
		$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";
		mysql_query("INSERT INTO objects (`user`, `inf`,`min`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`,`tip`,`about`) values ('$stat[user]','$inf','$min','$buyitem[br1]','$buyitem[br2]','$buyitem[br3]','$buyitem[br4]','$buyitem[br5]','$buyitem[min]','$buyitem[max]','$buyitem[hp]','$buyitem[energy]','$buyitem[strength]','$buyitem[dex]','$buyitem[agility]','$buyitem[vitality]','$buyitem[razum]','$buyitem[krit]','$buyitem[unkrit]','$buyitem[uv]','$buyitem[unuv]','$now','$buyitem[tip]','$buyitem[about]')");


		$ItTake = "biruza";
		$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));
		$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|Победителю турнирной башни|0|$buyitem[art]|0|$buyitem[iznos]";
		$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";
		mysql_query("INSERT INTO objects (`user`, `inf`,`min`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`,`tip`,`about`) values ('$stat[user]','$inf','$min','$buyitem[br1]','$buyitem[br2]','$buyitem[br3]','$buyitem[br4]','$buyitem[br5]','$buyitem[min]','$buyitem[max]','$buyitem[hp]','$buyitem[energy]','$buyitem[strength]','$buyitem[dex]','$buyitem[agility]','$buyitem[vitality]','$buyitem[razum]','$buyitem[krit]','$buyitem[unkrit]','$buyitem[uv]','$buyitem[unuv]','$now','$buyitem[tip]','$buyitem[about]')");

		$ItTake = "alexandrit";
		$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));
		$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|Победителю турнирной башни|0|$buyitem[art]|0|$buyitem[iznos]";
		$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";
		mysql_query("INSERT INTO objects (`user`, `inf`,`min`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`,`tip`,`about`) values ('$stat[user]','$inf','$min','$buyitem[br1]','$buyitem[br2]','$buyitem[br3]','$buyitem[br4]','$buyitem[br5]','$buyitem[min]','$buyitem[max]','$buyitem[hp]','$buyitem[energy]','$buyitem[strength]','$buyitem[dex]','$buyitem[agility]','$buyitem[vitality]','$buyitem[razum]','$buyitem[krit]','$buyitem[unkrit]','$buyitem[uv]','$buyitem[unuv]','$now','$buyitem[tip]','$buyitem[about]')");

		$ItTake = "amazonit";
		$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));
		$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|Победителю турнирной башни|0|$buyitem[art]|0|$buyitem[iznos]";
		$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";
		mysql_query("INSERT INTO objects (`user`, `inf`,`min`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`,`tip`,`about`) values ('$stat[user]','$inf','$min','$buyitem[br1]','$buyitem[br2]','$buyitem[br3]','$buyitem[br4]','$buyitem[br5]','$buyitem[min]','$buyitem[max]','$buyitem[hp]','$buyitem[energy]','$buyitem[strength]','$buyitem[dex]','$buyitem[agility]','$buyitem[vitality]','$buyitem[razum]','$buyitem[krit]','$buyitem[unkrit]','$buyitem[uv]','$buyitem[unuv]','$now','$buyitem[tip]','$buyitem[about]')");

		$ItTake = "pirit";
		$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));
		$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|Победителю турнирной башни|0|$buyitem[art]|0|$buyitem[iznos]";
		$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";
		mysql_query("INSERT INTO objects (`user`, `inf`,`min`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`,`tip`,`about`) values ('$stat[user]','$inf','$min','$buyitem[br1]','$buyitem[br2]','$buyitem[br3]','$buyitem[br4]','$buyitem[br5]','$buyitem[min]','$buyitem[max]','$buyitem[hp]','$buyitem[energy]','$buyitem[strength]','$buyitem[dex]','$buyitem[agility]','$buyitem[vitality]','$buyitem[razum]','$buyitem[krit]','$buyitem[unkrit]','$buyitem[uv]','$buyitem[unuv]','$now','$buyitem[tip]','$buyitem[about]')");

		$ItTake = "rubin";
		$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));
		$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|Победителю турнирной башни|0|$buyitem[art]|0|$buyitem[iznos]";
		$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";
		mysql_query("INSERT INTO objects (`user`, `inf`,`min`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`,`tip`,`about`) values ('$stat[user]','$inf','$min','$buyitem[br1]','$buyitem[br2]','$buyitem[br3]','$buyitem[br4]','$buyitem[br5]','$buyitem[min]','$buyitem[max]','$buyitem[hp]','$buyitem[energy]','$buyitem[strength]','$buyitem[dex]','$buyitem[agility]','$buyitem[vitality]','$buyitem[razum]','$buyitem[krit]','$buyitem[unkrit]','$buyitem[uv]','$buyitem[unuv]','$now','$buyitem[tip]','$buyitem[about]')");

		$ItTake = "sapfir";
		$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));
		$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|Победителю турнирной башни|0|$buyitem[art]|0|$buyitem[iznos]";
		$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";
		mysql_query("INSERT INTO objects (`user`, `inf`,`min`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`,`tip`,`about`) values ('$stat[user]','$inf','$min','$buyitem[br1]','$buyitem[br2]','$buyitem[br3]','$buyitem[br4]','$buyitem[br5]','$buyitem[min]','$buyitem[max]','$buyitem[hp]','$buyitem[energy]','$buyitem[strength]','$buyitem[dex]','$buyitem[agility]','$buyitem[vitality]','$buyitem[razum]','$buyitem[krit]','$buyitem[unkrit]','$buyitem[uv]','$buyitem[unuv]','$now','$buyitem[tip]','$buyitem[about]')");
			

		$msg="<font style='FONT-SIZE: 13pt'>Поздравляем с победой!</font><BR><BR>Вы получаете <u>алмаз, амазонит, александрит, бирюза, опал, пирит, рубин, сапфир!!!</u>";

	}}








	if ($vzyat) {
		$lin = mysql_fetch_array(mysql_query("SELECT * FROM tower_locations WHERE id='".$stat[location]."'"));
		$ItTake = $lin[it];

		$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));

		$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|Предмет турнирной башни|0|$buyitem[art]|0|$buyitem[iznos]";
		$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";

		mysql_query("INSERT INTO objects (`user`, `inf`, `min`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`,`tip`,`about`,`tb`) values ('$stat[user]','$inf','$min','$buyitem[br1]','$buyitem[br2]','$buyitem[br3]','$buyitem[br4]','$buyitem[br5]','$buyitem[min]','$buyitem[max]','$buyitem[hp]','$buyitem[energy]','$buyitem[strength]','$buyitem[dex]','$buyitem[agility]','$buyitem[vitality]','$buyitem[razum]','$buyitem[krit]','$buyitem[unkrit]','$buyitem[uv]','$buyitem[unuv]','$now','$buyitem[tip]','$buyitem[about]','1')");

		mysql_query("UPDATE tower_locations set it='0' where id='".$stat[location]."'");



		echo "<center>Вы подобрали предмет <u>".$buyitem['title']."</u></center>";


		require_once("../inc/chat/functions.php");
		insert_msg("Вы подобрали предмет <b>".$buyitem['title']."</b>","","","1",$stat[user],"",$stat[room]);

	}











	beginTiming();

	## Variables
	$params = array();
	$DEBUG	= 0;	// 0 means turn off debugging;   1 means turn on debugging

	// population control
	//$where= "rank='60'";
	//$result = mysql_query("select count(id) from players where $where");
	//list($count) = mysql_fetch_row($result);

	//number of
	//$lowerlimit= 3000;

	//$upperlimit= $lowerlimit+200;
	//if ($count > $upperlimit ) {
	//   $delta= 3+(int)(($count-$upperlimit)/100);
	//   $result = mysql_query("select id,location,user,name from players where $where order by rand() LIMIT $delta");

	//	while( $row = mysql_fetch_assoc($result) ){
	//   	$mob = new character($row['id']);
	//   	$mob->kill_characterid();
	//   }
	//}

	//@$_COOKIE['_speed'] is just a HACK to speed up testing on my PC, which is very slow

	if ($count < $lowerlimit ) {
		$n= ceil(sqrt( $lowerlimit-$count )*0.20*(@$_COOKIE['_speed']?0.5:1.0));
		$n>6 and $n= 6;
		for($i=0;$i<$n;++$i){
			npcgen();
		}
	}

	if(@$_COOKIE['_timing']) { echo "time end pop control=".endTiming()."<br>\n"; };



	// move some NPC first

	$npctomov= (@$_COOKIE['_speed'])?3:9;

	for($i=0;$i<$npctomov;$i++){
		movenpc();
	}

	if(@$_COOKIE['_timing']) { echo "time end pop movement=".endTiming()."<br>\n"; };

	updateshops();

	if(@$_COOKIE['_timing']) { echo "time end shop updates=".endTiming()."<br>\n"; };

	// CHARACTER INFORMATION
	$character= new character($PHP_PHAOS_CHARID);

	// Make sure character is strong enough to travel
	if ($stat['battle']) echo"<script>location='../battle.php'</script>";
	if ($character->room != "49") {
		$destination = "";
	} else {
		//FIXME: this allows an instant gate travel hack, uhm, I mean, spell
		if (is_numeric(@$_POST['destination']) and $_POST['destination'] > 0) {
			$destination = $_POST['destination'];
		} else {
			$destination = "";
		}
	}

	if(@$_COOKIE['_timing']) { echo "time 1=".endTiming(); };

	if($destination != "")
	{
		//new stamina reduction formula:
		$inv_count=$character->invent_count();
		$degrade=($inv_count-($character->constitution+$character->strength*4));
		if ($inv_count>$character->max_inventory){$degrade=$degrade*2;}
		if ($degrade<0) {$degrade=1;}
		//end stamina reduction update table:

		$character->reduce_stamina($degrade);
		$result = mysql_query('SELECT * FROM  tower_locations WHERE id = \'' . $character->location . '\'');
		$row = mysql_fetch_assoc($result);
		foreach ($row as $item)
		{
			//FIXME: uses untrusted input by the user
			if ($item == $destination OR @$_POST['rune_gate'] == "yes" OR @$_POST['explorable'] == "yes")
			{
				$query = ("UPDATE players SET location = '$destination', stamina=stamina+1 WHERE id = '$PHP_PHAOS_CHARID'");
				$req = mysql_query($query);
				if (!$req) {echo "<B>Error ".mysql_errno()." :</B> ".mysql_error().""; exit;}
				$result = mysql_query ("SELECT * FROM tower_locations WHERE id = '$destination'");
				$character->location=$destination;
				if ($row = mysql_fetch_array($result)) {$location_name = $row["name"];}
			}
		}
	}

	// define mob separators for php and escaped for javascript
	$info_eol= "\r";
	$js_info_eol= "\\r";

	if($character->name == "") {
		$message =  ("<font size=4><b>".$lang_area["must_create_a_char"]."</b></font><p>".$lang_area["create_a_char"]);
	} else {
		$message= '';

		if  ($character->room != "49") {
			$message =  $lang_trav["zero_hp"]."<br>";
		}

		if  ($destination == "") {
			$message .= "<b>".$lang_trav["dest"]."</b>";
			draw_html($message);
		}

		if  ($destination != "") {
			$list = whos_here($character->location,'phaos_npc');
			if (count($list)) {
				$result = mysql_query("SELECT * FROM tower_locations WHERE id = '".$character->location."'");
				list($buildings,$special) = mysql_fetch_array($result);
				//			if ($buildings == "n" AND $special == 0) {
				//			header ("Location: combat.php?opp_type=roammonst");
				//			exit;
				//		}
			}
			draw_html(@$message);
		}
	}


	session_destroy();

	##---Functions--##
	function draw_html($message = '')
	{
		global $character;
		global $params;
		global $DEBUG;
		global $lang_area;
		global $js_info_eol;

		if ($DEBUG >= 1) { $message.= "<p>** DEBUG - Location: ".$character->location."<br>"; }
		//if ($DEBUG >= 1) { $message.= "<p>** DEBUG - whos_here: ".print_r($list,true); }
		// FFIXME:  had to change this to NONE.css or link/input squares have css background !
		?>
<script language="JavaScript" type="text/JavaScript"><!--
function displayInfo(info){
    var infoDiv= document.getElementById("info");
    var re = /<?=$js_info_eol?>/g;
    info = info.replace(re,"<br>");
    infoDiv.innerHTML= info;
}
//-->
</script>
<html>
<head>
<link href="styles/NONE.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
A,A:visited,A:link,A:active {
	color: white;
	font-family: Arial, Gothic;
	font-size: 12px;
	font-weight: bold;
	text-decoration: none;
}

A:hover {
	color: white;
	font-family: Arial, Gothic;
	font-size: 12px;
	font-weight: bold;
	text-decoration: underline;
}

form {
	margin: 0px;
}
//
-->
</style>
</head>
		<?php
		print '<body bgcolor=#EBEDEC text=black>
			   <table border="0" cellspacing="0" cellpadding="0" width="100%">
				  <tr>
					 <td align="center" valign="top">
						<table border="0" cellspacing="0" cellpadding="0">
						   <tr>
							  <td align="center" colspan="2">
								'.$message . '<br>';
		//print '<div style="z-Index:30;position:absolute;top:20px;left:20px;">';
		// build and print map
		list($out_loc,$marker_loc) = data_collect();
		draw_all($out_loc);
		//print '</div>'."\n";
		//print '<div style="z-Index:40;position:absolute;top:20px;left:20px;">';
		//    draw_all($marker_loc);
		//print '</div>'."\n";

		print			  '<br></td>
						   </tr><tr>
						   <td>';
		if(!isset($params['name'])){
			$params['name']='';
		}
		if ($params["buildings"] == "y" AND $params["one_building"] > "1")
		{
			echo "<a href='town.php' target='content'>
					<img src='images/icons/enter.gif' alt='$lang_area[enter]' border=0 align=left> $lang_area[enter]<br> $params[name]</a><br>";
		}
		if ($params["buildings"] == "y" AND $params["one_building"] == "1")
		{
			echo "<a href='town.php' target='content'>
					<img src='images/icons/enter.gif' alt='$lang_area[enter]' border=0 align=left> $lang_area[enter]<br> $params[name]</a><br>";
		}
		if ($params["explore"] != "")
		{
			echo "<form action='' method=post>
			    <center><input type=submit class=input value='Выйти из башни' name=vix><br> Внимание, если вы выйдете из башни, то сегодня не сможете сюда вернуться</center>";
		}
		if ($params["it"] != "0")
		{
			echo "<form action='' method=post>
			    <center><input type=submit class=input value='Подобрать предмет' name=vzyat></center>";
		}
			
		if ($params["special_id"] > 0){
			echo "<a href=\"area.php\" target=\"content\">";
			echo "<img src=\"images/icons/invest.gif\" alt=\"".$lang_trav["invest"]."\" border=\"0\"></a>";
		}
		if (@$params['rune_gate'] == "yes"){
			echo "<table border=0 cellspacing=0 cellpadding=0>
			<tr><td align=left><b>Gate Travel:</b></td></tr>";

			$result = mysql_query ("SELECT * FROM tower_locations WHERE name LIKE 'Rune Gate%' AND id != '$character->location' ORDER BY name ASC");
			while ($row = mysql_fetch_array($result)) {
				echo "<form action='map.php' method='post'>
		        <tr>
			    <td align=left>
			    <input type='hidden' name='destination' value='$row[id]'>
			    <input type='hidden' name='rune_gate' value='yes'>
			    <input type='submit' style='text-align:left;background:#000000;color:#FFFFFF;border:none;' value='$row[name]'>
			    </td>
			    </tr>
			    </form>";
			}
		 echo "</table>";
		}
		if(@$_COOKIE['_timing']) { echo "time F=".endTiming(); };

		print '
								  </td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
        ';
		?>
<center><?
include ('../inc/aligns.php');
$psel = mysql_query ("SELECT * FROM players WHERE location = '$character->location' and user != '$character->user' and room = '49' and lpv > ".(time()-60)." order by level DESC ");



while ($pl = mysql_fetch_array($psel)) {
	if ($pl['invisible'] > $ctime) {
		echo"<IMG SRC='../i/align/align0.gif' BORDER=0 ALT='".$alignstr[0]."' width=15 height=15><a href=\"javascript:top.to('Тень')\"><font color=gray><i>Тень</i></font></a> [99] <a href=\"inf.php?99\" target=_blank><IMG SRC=\"../i/inf.gif\" BORDER=0 ALT=\"Информация о Тени\" width=11 height=11></a><BR>";
	} else {
		if (($pl['rank']==60) || ($pl['user']==$stat['user'])) $pl['ignore_him']=0; // Can't ignore BOTS or myself

		echo"
	<IMG SRC='../i/skl".$pl['skl'].".gif' BORDER=0 ALT='".$alignstr[$pl['skl']]."' width=15 height=15>                   
	
	<IMG SRC='../i/align/align".$pl['rank'].".gif' BORDER=0 ALT='".$alignstr[$pl['rank']]."' width=15 height=15>".$klan."<a href=\"javascript:top.to('".$pl['user']."')\">";
		$userbuf="<FONT COLOR=black>".$pl['user']."</FONT>";
		if ($pl['battle'] && $pl['rank']!=60) echo"<S>".$userbuf."</S>"; else echo $userbuf;
		echo"</a> [".$pl['level']."] <a href=\"/inf.php?".$pl['id']."\" target=_blank><IMG SRC=\"../i/inf.gif\" BORDER=0 ALT=\"Информация о ".$pl['user']."\" width=11 height=11></a>";
		echo"<BR>";
	}
	$num++;
}?></center>


<?php

print '
			</body>
			</html>';

	}

	function draw_all($out_loc) {
		// locations of sight from center(25) starting north, going clockwise
		$locs = array(
		23 , 24 ,  2 ,  4 ,  5,
		22 , 21 ,  1 ,  3 ,  6,
		20 , 19 , 25 ,  7 ,  8,
		18 , 15 , 13 ,  9 , 10,
		17 , 16 , 14 , 12 , 11
		);

		$x=1;
		echo "<table border=0 cellpadding=0 cellspacing=1 style='background:#FFFFFF;'><tr>";
		foreach ( $locs as $block) {
			echo $out_loc[$block]['html'];
			$x++ == 5 && $block!=11 and print '</tr><tr>' and $x=1;
		}
		echo '</tr></table>';
	}

	function draw_square($link = false, $picture, $id='', $ch_img='images/clear.gif', $locname='', $mobs= array('text'=>''), $markers= array(), $dir='') {

		if($mobs && $mobs['text']){
			$pl = mysql_query ("SELECT * FROM players WHERE location = '".$character->location."' ");
			if($pl){
				$ch_img= "images/mobs/map_mob.gif";
			}else{
				$ch_img= $pl['name'][0]['image_path'];
			}
		}else{
			$mobs= array('text'=>'');
		}










		(!$ch_img && count($markers)>0 ) and $ch_img = 'images/'.$markers[0];
		$ch_img or $ch_img="images/clear.gif";

		DEBUG or $dir='';

		if($link){
			$image= '<input type=image src="'.$ch_img.'" title="'.$locname.' ('.$id.")$dir\n".$mobs['text'].'" onMouseOver="displayInfo(this.title);" onMouseOut="displayInfo(\'\');" name="destination_button" value="'.$id.'">';
		}else{
			if($picture){
				$image= '<img src="'.$ch_img.'" alt="'.$mobs['text'].'" title="'.$locname.' ('.$id.")$dir\n".$mobs['text'].'" onMouseOver="displayInfo(this.title);" onMouseOut="displayInfo(\'\');" >';
			}else{
				$image= '<img src="images/land/49.png" alt="seas" title="Water">';
				$picture= "images/land/49.png";
			}
		}

		if ($link) {
			$s = '<td align=center valign=middle style="background:url('.$picture.')"><form action="map.php" method="post"><input type="hidden" name="destination" value="'.$id.'">'.$image.'</form></td>';
		} else {
			$s = '<td width=52 height=52 align=center valign=middle style="background:url('.$picture.');">'.$image.'</td>';
		}
		return $s;
	}

	function data_collect() {
		global $character;
		global $params;

		$fchance= $character->finding();

		if(@$_COOKIE['_timing']) { echo "time begin DC=".endTiming(); };


		$result = mysql_query ("SELECT * FROM tower_locations WHERE id = '".$character->location."'");
		if ($row = mysql_fetch_array($result)) {
			$out_loc[25]['id'] = $character->location;
			$character_locname = $row['name'];

			$markers= array();
			//            $ground_items= fetch_items_for_location($character->location, $fchance );
			if(count($ground_items)>0){
				$markers[] = 'icons/gold.gif';
			}

			$out_loc[25]['html'] = draw_square(false, $row["image_path"], '', $character->image , $row["name"], array('text'=>''), $markers, 25);
			$params['name'] = $row['name'];
			if(strstr($row['name'],"Rune Gate")) {$params['rune_gate'] = "yes";}
			$params['special_id'] = $row["special"];
			$params['buildings'] = $row['buildings'];
			$params['explore'] = $row['explore'];
			$params['it'] = $row['it'];

			$build_check = mysql_query ("SELECT type FROM phaos_buildings WHERE location = '".$character->location."'");
			$numrows = mysql_num_rows($build_check);
			$params['one_building'] = $numrows;
			if ($bui = mysql_fetch_array($build_check)) {
				$params['building_type'] = $bui['type'];
			} else {
				$params['building_type'] = "";
			}

			$out_loc[ 1]['id'] = $row["above"];		$out_loc[ 1]['link'] = true; $out_loc[ 1]['block']=0;
			$out_loc[ 3]['id'] = $row["above_right"];	$out_loc[ 3]['link'] = true; $out_loc[ 3]['block']=0;
			$out_loc[ 7]['id'] = $row["rightside"];		$out_loc[ 7]['link'] = true; $out_loc[ 7]['block']=0;
			$out_loc[ 9]['id'] = $row["below_right"];	$out_loc[ 9]['link'] = true; $out_loc[ 9]['block']=0;
			$out_loc[13]['id'] = $row["below"];		$out_loc[13]['link'] = true; $out_loc[13]['block']=0;
			$out_loc[15]['id'] = $row["below_left"];	$out_loc[15]['link'] = true; $out_loc[15]['block']=0;
			$out_loc[19]['id'] = $row["leftside"];		$out_loc[19]['link'] = true; $out_loc[19]['block']=0;
			$out_loc[21]['id'] = $row["above_left"];	$out_loc[21]['link'] = true; $out_loc[21]['block']=0;

			// We try to collect the data from mysql in one go to speed up things
			$set= "('".$out_loc[3]['id']."','".$out_loc[9]['id']."','".$out_loc[15]['id']."','".$out_loc[21]['id']."')";
			$data_locations = fetch_all("SELECT * FROM tower_locations WHERE id IN ".$set);
			foreach($data_locations as $data_location){
				$cache_row[$data_location['id']]= $data_location;
			}

			// We do some of these twice because they might not be accessible from one angle
			if ($out_loc[3]['id']) {
				//$result = mysql_query ("SELECT * FROM tower_locations WHERE id = ".$out_loc[3]['id']);
				//$row = mysql_fetch_array($result);
				$row= @$cache_row[$out_loc[3]['id']];
				$out_loc[ 2]['id'] = $row["above_left"];	$out_loc[ 2]['block']=0;
				$out_loc[ 4]['id'] = $row["above"];		$out_loc[ 4]['block']=0;
				$out_loc[ 5]['id'] = $row["above_right"];	$out_loc[ 5]['block']=0;
				$out_loc[ 6]['id'] = $row["rightside"];		$out_loc[ 6]['block']=0;
				$out_loc[ 8]['id'] = $row["below_right"];	$out_loc[ 8]['block']=0;
			}

			if ($out_loc[9]['id']) {
				//$result = mysql_query ("SELECT * FROM tower_locations WHERE id = ".$out_loc[9]['id']);
				//$row = mysql_fetch_array($result);
				$row= @$cache_row[$out_loc[9]['id']];
				$out_loc[ 8]['id'] = $row["above_right"];	$out_loc[ 8]['block']=0;
				$out_loc[10]['id'] = $row["rightside"];		$out_loc[10]['block']=0;
				$out_loc[11]['id'] = $row["below_right"];	$out_loc[11]['block']=0;
				$out_loc[12]['id'] = $row["below"];		$out_loc[12]['block']=0;
				$out_loc[14]['id'] = $row["below_left"];	$out_loc[14]['block']=0;
			}

			if ($out_loc[15]['id']) {
				//$result = mysql_query ("SELECT * FROM tower_locations WHERE id = ".$out_loc[15]['id']);
				//$row = mysql_fetch_array($result);
				$row= @$cache_row[$out_loc[15]['id']];
				$out_loc[14]['id'] = $row["below_right"];	$out_loc[14]['block']=0;
				$out_loc[16]['id'] = $row["below"];		$out_loc[16]['block']=0;
				$out_loc[17]['id'] = $row["below_left"];	$out_loc[17]['block']=0;
				$out_loc[18]['id'] = $row["leftside"];		$out_loc[18]['block']=0;
				$out_loc[20]['id'] = $row["above_left"];	$out_loc[20]['block']=0;
			}

			if ($out_loc[21]['id']) {
				//$result = mysql_query ("SELECT * FROM tower_locations WHERE id = ".$out_loc[21]['id']);
				//$row = mysql_fetch_array($result);
				$row= @$cache_row[$out_loc[21]['id']];
				$out_loc[20]['id'] = $row["below_left"];	$out_loc[20]['block']=0;
				$out_loc[22]['id'] = $row["leftside"];		$out_loc[22]['block']=0;
				$out_loc[23]['id'] = $row["above_left"];	$out_loc[23]['block']=0;
				$out_loc[24]['id'] = $row["above"];		$out_loc[24]['block']=0;
				$out_loc[ 2]['id'] = $row["above_right"];	$out_loc[ 2]['block']=0;
			}
		}

		// some views might be blocked
		if ($out_loc[ 1]['block']) {
			$out_loc[24]['block']=1;
			$out_loc[ 2]['block']=1;
			$out_loc[ 4]['block']=1;
		}
		if ($out_loc[ 3]['block']) {
			$out_loc[ 4]['block']=1;
			$out_loc[ 5]['block']=1;
			$out_loc[ 6]['block']=1;
		}
		if ($out_loc[ 7]['block']) {
			$out_loc[ 6]['block']=1;
			$out_loc[ 8]['block']=1;
			$out_loc[10]['block']=1;
		}
		if ($out_loc[ 9]['block']) {
			$out_loc[10]['block']=1;
			$out_loc[11]['block']=1;
			$out_loc[12]['block']=1;
		}
		if ($out_loc[13]['block']) {
			$out_loc[12]['block']=1;
			$out_loc[14]['block']=1;
			$out_loc[16]['block']=1;
		}
		if ($out_loc[15]['block']) {
			$out_loc[16]['block']=1;
			$out_loc[17]['block']=1;
			$out_loc[18]['block']=1;
		}
		if ($out_loc[19]['block']) {
			$out_loc[18]['block']=1;
			$out_loc[20]['block']=1;
			$out_loc[22]['block']=1;
		}
		if ($out_loc[21]['block']) {
			$out_loc[22]['block']=1;
			$out_loc[23]['block']=1;
			$out_loc[24]['block']=1;
		}

		$marker_loc = array();

		$close_locs= array(1,3,7,9,13,15,19,21,25);

		$locs = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24);
		foreach ( $locs as $i) {
			if (@$out_loc[$i]['html'] == '') {
				if (@$out_loc[$i]['block'] == 0 and @$out_loc[$i]['id'] != 0) {
					$mobs="";
					$mobs = getmobs($out_loc[$i]['id']);
					$result = mysql_query('SELECT * FROM tower_locations WHERE id= \''. $out_loc[$i]['id'].'\'');
					$row = mysql_fetch_assoc($result);

					$markers= array();
					if(in_array($i,$close_locs) || $character->finding()>=100 ){
						//                   $ground_items= fetch_items_for_location($out_loc[$i]['id'], $fchance );
						if(count($ground_items)>0){
							$markers[] = 'icons/gold.gif';
						}
					}

					if($row['it'] != '0') {
						$markers[] = 'icons/gold.gif';
					} else {

					}



					if($row['pass'] == 'n') {
						$out_loc[$i]['html'] = draw_square(false, $row['image_path'], $out_loc[$i]['id'],'',$row['name'],$mobs, $markers, $i);
					} else {
						$out_loc[$i]['html'] = draw_square(@$out_loc[$i]['link'], $row['image_path'], $out_loc[$i]['id'],'',$row['name'],$mobs, $markers, $i);
					}



				} else {
					//HACK: is a hack because it will break if a location is inside but is not named like %Dungeon%
					if( stristr($character_locname,'Dungeon')!== false){
						$out_loc[$i]['html'] = draw_square(false, "images/land/195.png", 0,'',"Dungeon");
					}else{
						$out_loc[$i]['html'] = draw_square(false, "images/land/195.png", 0,'',"Water");
					}
				}


			}
		}

		if(@$_COOKIE['_timing']) { echo "<br>time end DC=".endTiming(); };

		return array($out_loc,$marker_loc);
	}

	//@see also: whos_here() in global.php
	function getmobs ($loc) {
		global $info_eol;
		// return monsters that are at this location
		// REALLY long monster names cause problems with mouse-overs
		$mobs['char']= array();
		$mobs['text']= '';

		$res = mysql_query ("SELECT * FROM players WHERE location = $loc and lpv > ".(time()-60)." and room = '49' order by level DESC ");
		if (!$res) {showError(__FILE__,__LINE__,__FUNCTION__); exit;}

		$i=0;
		while ($row = mysql_fetch_array($res)) {
			$mobs['char'][$i++]= $row;
			$mobs['text'].= $info_eol."$row[user]\n$row[race]\nLevel $row[level]\n";


		}
		return $mobs;
	}



















	include("inc/battle/offers/forms.php");

	echo"<div id=battle_forms></div>";


	$now=time();

	include("inc/db_connect.php");

	$stat = mysql_fetch_array(mysql_query("SELECT * FROM `players` WHERE user='".addslashes($user)."' AND pass='".addslashes($pass)."'"));
	mysql_query("SET CHARSET cp1251");


	mysql_query("UPDATE players SET lpv=$now WHERE user='".$stat['user']."'");
	include("inc/main/changed.php");



	$user_offer=mysql_fetch_array(mysql_query("select offers.time,offers.type,participants.side from offers, participants where offers.time>$now and offers.done=0 and participants.time=offers.time and participants.id=$stat[id]"));
	if ($Attack) {

		if (empty($login)) $msg = "Укажите логин!";
		else {
			$chl=mysql_fetch_array(mysql_query("SELECT * FROM players where user='".addslashes($login)."'"));

			if ($chl['user'] == $stat['user']) $msg="Нападение на самого себя - это уже мазохизм...";

			elseif (time()-$chl['lpv']>179) $msg="Персонаж <u>".$chl['user']."</u> не подает признаков жизни!";
			elseif ($stat['travma']>$now) $msg="С травмой в бой нельзя!";
			//						elseif ($stat['level'] != $chl['level']) $msg="Выбери равного противника!";
			elseif ($chl['room']!=49) $msg="Для нападния Вам необходимо находится в одной комнате!";
			elseif ($stat['hp_now'] < (($stat['hp']+$stat['vitality']*5)*0.33)) $msg="Вы слишком ослаблены для боя!";
			elseif ($chl['hp_now'] <= 0  && $chl['rank']<>60) $msg="Персонаж <u>$login</u> слишком слаб для поединка!";



			elseif (($chl['level']-$stat['level'])>3) $msg="Этот бот побьет Вас!Нападайте на другого бота!";

			elseif ($user_offer['time']!=0) $msg="Вы подали заявку! Отзовите сначала вашу заявку, а после нападайте на бота!";



			else {




				require_once("../inc/chat/functions.php");
				insert_msg("Разъярённый <b><u>$stat[user]</u></b> собрался с силами и напал на Вас!","","","1",$chl['user'],"",$chl['room']);

				$battime=$now;
				echo $battime;
				if (($chl['battle'] == $chl['last_battle'] || !$chl['battle'])) {


					$_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp`, SUM(objects.`vitality`) as `vitality` FROM slots, objects WHERE slots.id='".$chl['id']."' AND objects.user='".$chl['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));
					$MySkills = explode("|",$chl['rase_skill']);
					$chl['gnom']=$MySkills['3']*5;
					$chl['vitality']+=$_obj['vitality'];
					$chl['hp_max']=ceil(($chl['vitality']*5+$_obj['hp'])*(1+($chl['gnom']/100)));
					$chl['hp_now']=$chl['hp_max'];
					mysql_query ("UPDATE `players` SET `battle` = NULL, `lpv`='".time()."' WHERE `id` = '".$chl['id']."'");
					$chl['battle'] = NULL;
				}

				if ($chl['battle']) {

					$prt=mysql_fetch_array(mysql_query("SELECT side as side,time as time from participants where time=$chl[battle] and id=$chl[id]"));

					switch ($prt['side']) {
						case 0: $side=1; break;
						case 1: $side=0; break;
					}

					$levels=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level=$stat[level] AND up=$stat[up]"));

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

				echo"<script>parent.main.location=\"../battle.php?tmp=\"+Math.random();\"\"</script>";

			}
		}
	}

	if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";


	if (empty($img_server)) $img_server="http://aoth.msk.ru/i/";
	print '<html>
<head>
<title>'.$title.'</title>
<link rel=stylesheet type="text/css" href="../i/main.css">
<meta http-equiv=Content-Type content="text/html; charset=windows-1251">
<META Http-Equiv=Cache-Control Content=no-cache>
<meta http-equiv=PRAGMA content=NO-CACHE>
<META Http-Equiv=Expires Content=0>
</head>
';



	echo"
<DIV id=hint1></DIV>
<div id=mainform style='position:absolute; left:30px; top:30px'></div>";
	echo"
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"../i/login_form.js\"></SCRIPT>";




	$min_seans = date("i",time() + $timeadjust);
	$tstart = mysql_fetch_array(mysql_query("SELECT * FROM tower WHERE user='tstart'"));
	$myz = mysql_fetch_array(mysql_query("SELECT * FROM tower WHERE user='".$stat[user]."'"));


	$CurrentTime = date("H");
	//if ($CurrentTime == 20 || $CurrentTime == 21 || $CurrentTime == 22 || $CurrentTime == 23 || $CurrentTime == 24 || $CurrentTime == 0 || $CurrentTime == 1 || $CurrentTime == 2 || $CurrentTime == 3 || $CurrentTime == 4 || $CurrentTime == 5  || $CurrentTime == 6) {
	//echo"
	//<center><input type=button class=input value='Нападение' style='WIDTH: 120px' onclick=\"javascript:ShowForm('Нападение','map.php?Attack=$now','','','1','attack','1','0');\"></center>
	//";
	//}

	$ponline = mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE room = 49 and `lpv` > '".(time()-180)."'"));

	if ($ponline < 2 and $stat[hp_now] > 0 and $CurrentTime != 20 and $CurrentTime != 21 and $tstart[seans]==7) echo"
<form action='' method=post>
			    <center><input type=submit class=input value='Я ПОБЕДИТЕЛЬ!!!' name=win></center>";


	if ($CurrentTime == 21 || $CurrentTime == 22 || $CurrentTime == 23 || $CurrentTime == 24 || $CurrentTime == 0 || $CurrentTime == 1 || $CurrentTime == 2 || $CurrentTime == 3 || $CurrentTime == 4 || $CurrentTime == 5  || $CurrentTime == 6) {
		echo"
<center><input type=button class=input value='Нападение' style='WIDTH: 120px' onclick=\"javascript:ShowForm('Нападение','map.php?Attack=$now','','','1','attack','1','0');\">
<input type=button class=input value='Обновить' style='WIDTH: 120px' onclick='window.location.href=\"map.php?tmp=\"+Math.random();\"\"'></center>
";


	}


	if ($stat[hp_now] <= 0 and $myz[heal] == 0) {
		mysql_query("UPDATE tower set heal = 1, healtime = $now + 600 where user='".$stat[user]."'");
	}

	if ($stat[hp_now] > 0 and $myz[heal] != 0) {
		mysql_query("UPDATE tower set heal = 0, healtime = 0 where user='".$stat[user]."'");
	}


	if ($stat[hp_now] <= 0 and $myz[heal] > 0 and $myz[healtime] < $now) {
		mysql_query("UPDATE tower set heal = 0, healtime = 0 where user='".$stat[user]."'");
		echo"<script>location='../tower.php'</script>";
		mysql_query("UPDATE players set room = 48, location = 0 where user='".$stat[user]."'");

	}
	if ($myz[heal] > 0) {
		echo "<center><font color=red><b>Внимание!!! Нельзя находиться в турнирной башне с 0 хп , подлечитесь или вы будете изгнаны стражей</b></font></center><br>";
	}
	$timestart = $tstart[healtime] + 10;
	if ($timestart >= 60) $timestart=$timestart-60;

	if ($timestart<= $min_seans and $tstart[seans] <= 6) {


		//предметы
		$it = mysql_query("SELECT name FROM items WHERE art!=1 and name != '' and tip >=1 and tip <=11 ORDER BY price");
		for ($i=0; $i<mysql_num_rows($it); $i++) {
			$ItInfo = mysql_fetch_array($it);
			$ItNames[$i] = $ItInfo['name'];
		}
		for ($i=0; $i<20; $i++) {
			$ItTake = $ItNames[rand(0,count($ItNames))];
			$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));
			$locid = (rand(400,800));
			if ($buyitem != '') {mysql_query("UPDATE tower_locations set it='".$buyitem['name']."' where id='".$locid."' and pass !='n'");}
		}
		//хп
		$its = mysql_query("SELECT name FROM items WHERE art=0 and tip=12 and name LIKE '%addhp%' ORDER BY price");
		for ($i=0; $i<mysql_num_rows($its); $i++) {
			$ItInfos = mysql_fetch_array($its);
			$ItNamess[$i] = $ItInfos['name'];
		}
		for ($i=0; $i<5; $i++) {
			$ItTakes = $ItNamess[$i];
			$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTakes."'"));
			$locid = (rand(400,800));
			if ($buyitem['name']) {mysql_query("UPDATE tower_locations set it='".$buyitem['name']."' where id='".$locid."' and pass !='n'");}

		}
		//энергия
		$itse = mysql_query("SELECT name FROM items WHERE art=0 and tip=12 and name LIKE '%adden%' ORDER BY price");
		for ($i=0; $i<mysql_num_rows($itse); $i++) {
			$ItInfose = mysql_fetch_array($itse);
			$ItNamesse[$i] = $ItInfose['name'];
		}
		for ($i=0; $i<4; $i++) {
			$ItTakese = $ItNamesse[$i];
			$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTakese."'"));
			$locid = (rand(400,800));
			if ($buyitem['name']) {mysql_query("UPDATE tower_locations set it='".$buyitem['name']."' where id='".$locid."' and pass !='n'");}
		}

		mysql_query("UPDATE tower set seans=seans+1,healtime='".$min_seans."' where user='tstart'");

	}



	?>


<center>
<div id="info"
	style="overflow: auto; height: 90px; width: 220px; z-Index: 20;"></div>
</center>