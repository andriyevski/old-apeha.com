<?php
include("inc/db_connect.php");
$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));
$now = time();
$_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp`, SUM(objects.`vitality`) as `vitality` FROM slots, objects WHERE slots.id='".$stat['id']."' AND objects.user='".$stat['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));
$MySkills = explode("|",$stat['rase_skill']);
$stat['gnom']=$MySkills['3']*5;
$stat['vitality']=$stat['vitality']+$_obj['vitality'];
$stat['hp_max']=ceil(($stat['vitality']*5)*(1+($stat['gnom']/100))+$_obj['hp']);
$hp_max=$stat['hp_max'];///
$mp_max= 5*$stat['power'];
$stat['mp_max']=$mp_max;
$mp=$stat["ustal_now"];
$hp=$stat["hp_now"];
function update_hp ($id, $hp_now, $hp_max, $cure_time) 
{ 
    if ($hp_now < $hp_max) 
    { 
        // задаем время восстановления всех хп 
        $all_heal_time = 600; 
        // высчитуем сколько хп необходимо восстановить 
        $need_hp = $hp_max - $hp_now; 
        // высчитуем время восстановления 1го хп 
        $one_hp_time = $all_heal_time / $hp_max; 
        // высчитываем время, которое будет затрачено на восстановление недостающих хп 
        $need_hp_time = $one_hp_time * $need_hp; 
        // добавляем к текущему времени полученое значение 
        $time_hp = floor(time() + $need_hp_time); 
        // если необходимо лечение 
        if ($cure_time == 0) 
        { 
            // если не задано время восстановления - задаем его, что приводик к началу отсчета времени на восстановление 
            // обновляем в базе время восстановления хп 
            mysql_query("UPDATE players SET cure_hp = ".$time_hp." WHERE id = ".$id." "); 
        } 
        else  
        { 
            if (time() > $cure_time) 
            { 
                // если время на восстановление хп уже прошло - восстанавливаем все хп 
                mysql_query("UPDATE players SET cure_hp = 0, hp_now = ".$hp_max." WHERE id = ".$id." "); 
                $hp_now = $hp_max; 
            } 
            else  
            { 
                // высчитываем разницу во времени 
                $need_time_to_cure = $cure_time - time(); 
                // узнаем сколько хп нам необходимо восстановить за прошедшее время 
                $need_hp_to_cure = ceil($need_time_to_cure / $one_hp_time); 
                // обновляем базу данных :) 
                mysql_query("UPDATE players SET hp_now = ".($hp_max - $need_hp_to_cure)." WHERE id = ".$id." "); 
                $hp_now = $hp_max - $need_hp_to_cure; 
            } 
        } 
         
    } 
    return $hp_now; 
} 

function update_mp ($id, $hp_now, $hp_max, $cure_time) 
{ 
    if ($hp_now < $hp_max) 
    { 
        // задаем время восстановления всех хп 
        $all_heal_time = 600; 
        // высчитуем сколько хп необходимо восстановить 
        $need_hp = $hp_max - $hp_now; 
        // высчитуем время восстановления 1го хп 
        $one_hp_time = $all_heal_time / $hp_max; 
        // высчитываем время, которое будет затрачено на восстановление недостающих хп 
        $need_hp_time = $one_hp_time * $need_hp; 
        // добавляем к текущему времени полученое значение 
        $time_hp = floor(time() + $need_hp_time); 
        // если необходимо лечение 
        if ($cure_time == 0) 
        { 
            // если не задано время восстановления - задаем его, что приводик к началу отсчета времени на восстановление 
            // обновляем в базе время восстановления хп 
            mysql_query("UPDATE players SET cure_mp = ".$time_hp." WHERE id = ".$id." "); 
        } 
        else  
        { 
            if (time() > $cure_time) 
            { 
                // если время на восстановление хп уже прошло - восстанавливаем все хп 
                mysql_query("UPDATE players SET cure_mp = 0, energy_now = ".$hp_max." WHERE id = ".$id." "); 
                $hp_now = $hp_max; 
            } 
            else  
            { 
                // высчитываем разницу во времени 
                $need_time_to_cure = $cure_time - time(); 
                // узнаем сколько хп нам необходимо восстановить за прошедшее время 
                $need_hp_to_cure = ceil($need_time_to_cure / $one_hp_time); 
                // обновляем базу данных :) 
                mysql_query("UPDATE players SET energy_now = ".($hp_max - $need_hp_to_cure)." WHERE id = ".$id." "); 
                $hp_now = $hp_max - $need_hp_to_cure; 
            } 
        } 
         
    } 
    $energy_max = $hp_now; 
    return $energy_max; 
}
if(empty($stat['battle'])){
        $hp = update_hp($stat['id'], $stat['hp_now'], $hp_max, $stat['cure_hp']); 
        
     
        $mp = update_mp($stat['id'], $stat['ustal_now'], $mp_max, $stat['cure_mp']); 
} 
$login=$stat["user"];




$ath=mysql_fetch_array(mysql_query("select `exp` from `levels` where `exp` < '".$stat["next_exp"]."' order by exp desc LIMIT 1;"));

$expMax=$stat['next_exp']-$ath['exp'];
$exp=$stat['exp']-$ath['exp'];



$lvl=$stat["level"];

if($hp==0)$hp=1;
$print_xml.="
var min=$mp;
var max=$mp_max;
var perc=max/99;
var n=max-min;
var m2=Math.floor(min/perc);
var m1=Math.floor(99-m2);
if(m2==100){m2=95;}
var color='img/icon/blue.gif';
document.getElementById('energ').innerHTML='<div style=\'position:absolute; width:195px;margin:-8px 0px 1px 0px;\'><img src='+color+' title='+min+'/'+max+' height=8 width='+m2+'%><img src=img/icon/grey.gif title='+min+'/'+max+' height=8 width='+m1+'%></div>';
var min=$hp;
var max=$hp_max;
var perc=max/99;
var n=max-min;
var m2=Math.floor(min/perc);
var m1=Math.floor(99-m2);
if(m2==100){m2=95;}
var color='img/icon/green.gif';
document.getElementById('info').innerHTML='<div style=\'position:absolute; width:195px;margin:-8px 0px 2px 0px;\'><img src='+color+' title='+min+'/'+max+' height=8 width='+m2+'%><img src=img/icon/grey.gif title='+min+'/'+max+' height=8 width='+m1+'%></div>';
var min=$exp;
var max=$expMax;
var perc=max/99;
var n=max-min;
var m2=Math.floor(min/perc);
var m1=Math.floor(99-m2);
if(m2==100){m2=95;}
var color='img/icon/yellow.gif';
document.getElementById('exp').innerHTML='<div style=\'position:absolute; width:195px;margin:-3px 0px 1px 5px;z-index:1;\'><img src='+color+' title='+(min*100/max).toFixed(2)+'% height=7 width='+m2+'%><img src=img/icon/grey.gif title='+min+'/'+max+' height=7 width='+m1+'%></div>';

";
//$print_xml=$login."|".$lvl."|".$hp."|".$mp."|".$exp."|".$expMax;

print "$print_xml";

?>