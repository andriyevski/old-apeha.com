<?
include('inc/db_connect.php');
$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($_SESSION['user'])."' and pass='".addslashes($_SESSION['pass'])."'"));
$now = time();
$_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp`, SUM(objects.`vitality`) as `vitality` FROM slots, objects WHERE slots.id='".$stat['id']."' AND objects.user='".$stat['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));
$MySkills = explode("|",$stat['rase_skill']);
$stat['gnom']=$MySkills['3']*5;
$stat['vitality']=$stat['vitality']+$_obj['vitality'];
$stat['hp_max']=ceil(($stat['vitality']*5)*(1+($stat['gnom']/100))+$_obj['hp']);



	if ($stat['t_time']<$now) { mysql_query("UPDATE players set t_time=NULL where id=$stat[id]");}
	elseif ($stat['k_time']<$now) {  mysql_query("UPDATE players set k_time=NULL where id=$stat[id]");}
	elseif ($stat['o_time']<$now) { mysql_query("UPDATE players set o_time=NULL where id=$stat[id]");}
	elseif ($stat['r_time']<$now) { mysql_query("UPDATE players set r_time=NULL where id=$stat[id]");}
	elseif ($stat['lov_time']<$now) { mysql_query("UPDATE players set lov_time=NULL where id=$stat[id]");}
	elseif ($stat['mol_bog_swet']<$now) { mysql_query("UPDATE players set mol_bog_swet=NULL where id=$stat[id]");}
	elseif ($stat['mol_bog_tima']<$now) { mysql_query("UPDATE players set mol_bog_tima=NULL where id=$stat[id]");}



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
	elseif ($stat['battle'] && $set!="sklon") { header("Location: battle.php"); exit; }
	else {
		if (empty($set)) {
			if ($stat['room']==0) header("Location: world.php");
			if ($stat['room']==25) header("Location: world2.php");
			if ($stat['room']==26) header("Location: world3.php");
			if ($stat['room']==35) header("Location: world4.php");
			if ($stat['room']==67) header("Location: world5.php");
			if ($stat['room']==62) header("Location: outlow.php");
			if ($stat['room']==7) header("Location: shop.php");
			if ($stat['room']==8) header("Location: ambulance.php");
			if ($stat['room']==9) header("Location: academy.php");
			if ($stat['room']==10) header("Location: bank.php");
			if ($stat['room']==13) header("Location: gshop.php");
			if ($stat['room']==11) header("Location: repair.php");
			if ($stat['room']==14) header("Location: ashop.php");
			if ($stat['room']==15) header("Location: newyear.php");
			if ($stat['room']==18) header("Location: inc/uprava/klandom.php");
			if ($stat['room']==19) header("Location: pochta.php");
			if ($stat['room']==22) header("Location: les.php");
			if ($stat['room']==23) header("Location: waxta.php");
			if ($stat['room']==24) header("Location: brak.php");
			if ($stat['room']==27) header("Location: kwest.php");
			if ($stat['room']==28) header("Location: bog_hram.php");
			if ($stat['room']==29) header("Location: teleport.php");
			if ($stat['room']==30) header("Location: birga.php");
			if ($stat['room']==33) header("Location: lavka.php");
			if ($stat['room']==34) header("Location: priemka.php");
			if ($stat['room']==36) header("Location: clan_holl.php");
			if ($stat['room']==37) header("Location: ng.php");
			if ($stat['room']==38) header("Location: goforest.php");
			if ($stat['room']==40) header("Location: komis.php");
			if ($stat['room']==41) header("Location: juvelir.php");
			if ($stat['room']==42) header("Location: ambar.php");
			if ($stat['room']==43) header("Location: admin_dom.php");
			if ($stat['room']==44) header("Location: znahar.php");
			if ($stat['room']==45) header("Location: pomest.php");
			if ($stat['room']==46) header("Location: lambards.php");
			if ($stat['room']==47) header("Location: vqkup.php");
			if ($stat['room']==48) header("Location: tower.php");
			if ($stat['room']==49) header("Location: tower_map/map.php");

			if ($stat['room']==60) header("Location: vedma.php");

			if ($stat['room']==700) header("Location: port.php");

			if ($stat['room']==500) header("Location: sklep.php");


			if ($stat['room']==111) header("Location: mylots.php");

			if ($stat['room']==50) header("Location: pomest.php");

			if ($stat['room']==56) header("Location: pomest_pomest.php");

			if ($stat['room']>=200 && $stat['room']<=230) header("Location: podzem.php");
			if ($stat['room']>=300 && $stat['room']<=318) header("Location: podzem.php");
			if ($stat['room']>=601 && $stat['room']<=645) header("Location: forest.php");
			if ($stat['room']>=701 && $stat['room']<=745) header("Location: more.php");
			    if ($stat['room']==500) header("Location: bs_smert.php");

    if ($stat['room']==501) header("Location: bs_room_501.php");

    if ($stat['room']==502) header("Location: bs_room_502.php");

    if ($stat['room']==503) header("Location: bs_room_503.php");

    if ($stat['room']==504) header("Location: bs_room_504.php");

    if ($stat['room']==499) header("Location: bs_room_499.php");

    if ($stat['room']==498) header("Location: bs_room_498.php");

    if ($stat['room']==497) header("Location: bs_room_497.php");

    if ($stat['room']==496) header("Location: bs_room_496.php");
        if ($stat['room']==1111) header("Location: doska.php");
			else include('inc/main/main.php');
		}
		elseif ($set=="pers") { include('inc/main/main.php'); }
		elseif ($set=="img") { include('inc/main/img.php'); }
		elseif ($set=="edit") { include('inc/main/edit.php'); }
		elseif ($set=="anketa") { include('inc/main/anketa.php'); }
		elseif ($set=="security") { include('inc/main/security.php'); }
		elseif ($set=="transfer") { include('inc/main/transfer.php'); }
		elseif ($set=="setimg") { include('inc/main/img.php'); }
		elseif ($set=="access") { include('inc/main/access.php'); }
		elseif ($set=="updates") { include('inc/main/updates.php'); }
		elseif ($set=="nastavnik") { include('nastavnik.php'); }
		elseif ($set=="clan") { include('inc/main/clan.php'); }
		elseif ($set=="sklon") { include('inc/main/sklon.php'); }
		elseif ($set=="otchets") { include('inc/main/otchets.php'); }
		elseif ($set=="work") { include('inc/main/work.php'); }
		elseif ($set=="friends") { include('inc/main/friends.php'); }
		elseif ($set=="uslugi") { include('inc/main/uslugi.php'); }
		elseif ($set=="pers") { include('inc/main/pers.php'); }
		elseif ($set=="status") { include('inc/main/status.php'); }
		elseif ($set=="bots") { include('bots.php'); }
		elseif ($set=="ing") { include('inc/main/ing.php'); }
		elseif ($set=="sms") { include('inc/main/sms.php'); }
		elseif ($set=="vlog") { include('inc/main/vlog.php'); }
		elseif ($set=="map" && $_GET['room']==1) { include('inc/main/city.php'); }
		elseif ($set=="map") {
			
			if ($stat['room']==0) header("Location: world.php");
			elseif ($stat['room']==25) header("Location: world2.php");
			elseif ($stat['room']==26) header("Location: world3.php");
			elseif ($stat['room']==35) header("Location: world4.php");
			elseif ($stat['room']==67) header("Location: world5.php");
			elseif ($stat['room']==62) header("Location: outlow.php");
			elseif ($stat['room']==7) header("Location: shop.php");
			elseif ($stat['room']==8) header("Location: ambulance.php");
			elseif ($stat['room']==9) header("Location: academy.php");
			elseif ($stat['room']==10) header("Location: bank.php");
			elseif ($stat['room']==13) header("Location: gshop.php");
			elseif ($stat['room']==11) header("Location: repair.php");
			elseif ($stat['room']==14) header("Location: ashop.php");
			elseif ($stat['room']==15) header("Location: newyear.php");
			elseif ($stat['room']==19) header("Location: pochta.php");
			elseif ($stat['room']==22) header("Location: les.php");
			elseif ($stat['room']==23) header("Location: waxta.php");
			elseif ($stat['room']==24) header("Location: brak.php");
			elseif ($stat['room']==27) header("Location: kwest.php");
			elseif ($stat['room']==28) header("Location: bog_hram.php");
			elseif ($stat['room']==29) header("Location: teleport.php");
			elseif ($stat['room']==30) header("Location: birga.php");
			elseif ($stat['room']==33) header("Location: lavka.php");
			elseif ($stat['room']==34) header("Location: priemka.php");
			elseif ($stat['room']==36) header("Location: clan_holl.php");
			elseif ($stat['room']==37) header("Location: ng.php");
			elseif ($stat['room']==38) header("Location: goforest.php");
			elseif ($stat['room']==40) header("Location: komis.php");
			elseif ($stat['room']==41) header("Location: juvelir.php");
			elseif ($stat['room']==42) header("Location: ambar.php");
			elseif ($stat['room']==43) header("Location: admin_dom.php");
			elseif ($stat['room']==44) header("Location: znahar.php");
			elseif ($stat['room']==50) header("Location: pomest.php");
			elseif ($stat['room']==46) header("Location: lambards.php");
			elseif ($stat['room']==47) header("Location: vqkup.php");
			elseif ($stat['room']==700) header("Location: port.php");
			elseif ($stat['room']==48) header("Location: tower.php");
			elseif ($stat['room']==49) header("Location: tower_map/map.php");

			elseif ($stat['room']==60) header("Location: vedma.php");

			elseif ($stat['room']==500) header("Location: sklep.php");


			elseif ($stat['room']==111) header("Location: mylots.php");



			elseif ($stat['room']==56) header("Location: pomest_pomest.php");

			elseif ($stat['room']>=200 && $stat['room']<=230) header("Location: podzem.php");
			elseif ($stat['room']>=300 && $stat['room']<=318) header("Location: podzem.php");
			elseif ($stat['room']>=601 && $stat['room']<=645) header("Location: forest.php");
			elseif ($stat['room']>=701 && $stat['room']<=745) header("Location: more.php");
			 elseif ($stat['room']==500) header("Location: bs_smert.php");

    elseif ($stat['room']==501) header("Location: bs_room_501.php");

    elseif ($stat['room']==502) header("Location: bs_room_502.php");

    elseif ($stat['room']==503) header("Location: bs_room_503.php");

    elseif ($stat['room']==504) header("Location: bs_room_504.php");

    elseif ($stat['room']==499) header("Location: bs_room_499.php");

    elseif ($stat['room']==498) header("Location: bs_room_498.php");

    elseif ($stat['room']==497) header("Location: bs_room_497.php");

    elseif ($stat['room']==496) header("Location: bs_room_496.php");
    elseif ($stat['room']==1111) header("Location: doska.php");
			else include('inc/main/city.php');
		}
		include('inc/f_display.php');
	}
	?>
	