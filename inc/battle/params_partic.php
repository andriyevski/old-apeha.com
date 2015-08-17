<?
$_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp`, SUM(objects.`power`) as `power`, SUM(objects.`strength`) as `strength`, SUM(objects.`dex`) as `dex`, SUM(objects.`agility`) as `agility`, SUM(objects.`vitality`) as `vitality`, SUM(objects.`razum`) as `razum`, SUM(objects.`br1`) as `br1`, SUM(objects.`br2`) as `br2`, SUM(objects.`br3`) as `br3`, SUM(objects.`br4`) as `br4`, SUM(objects.`br5`) as `br5`, SUM(objects.`krit`) as `krit`, SUM(objects.`unkrit`) as `unkrit`, SUM(objects.`uv`) as `uv`, SUM(objects.`unuv`) as `unuv`, SUM(objects.`min_d`) as `min_d`, SUM(objects.`max_d`) as `max_d` FROM slots, objects WHERE slots.id='".$partic_stat['id']."' AND objects.user='".$partic_stat['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));echo mysql_error();

$HisSkills = explode("|",$partic_stat['rase_skill']);

$partic_stat['ork']=$HisSkills['0']*5;
$partic_stat['elf']=$HisSkills['1']*5;
$partic_stat['people']=$HisSkills['2']*5;
$partic_stat['gnom']=$HisSkills['3']*5;

// HP, Energy
$partic_stat['hp']+=$_obj['hp'];
$partic_stat['power']+=$_obj['power'];

// Статы
$partic_stat['strength']+=$_obj['strength'];
$partic_stat['dex']+=$_obj['dex'];
$partic_stat['agility']+=$_obj['agility'];
$partic_stat['vitality']+=$_obj['vitality'];
$partic_stat['razum']+=$_obj['razum'];

// МФ
$partic_stat['br1']+=$_obj['br1'];
$partic_stat['br2']+=$_obj['br2'];
$partic_stat['br3']+=$_obj['br3'];
$partic_stat['br4']+=$_obj['br4'];
$partic_stat['br5']+=$_obj['br5'];

$partic_stat['krit']+=$_obj['krit']*(1+($stat['people']/100));
$partic_stat['unkrit']+=$_obj['unkrit'];
$partic_stat['uv']+=$_obj['uv']*(1+($partic_stat['elf']/100));
$partic_stat['unuv']+=$_obj['unuv'];

$partic_stat['min']+=$_obj['min_d'];
$partic_stat['max']+=$_obj['max_d'];

if(!is_numeric($partic_step['kick'])) $partic_step['kick']='NULL';
if(!is_numeric($partic_step['block'])) $partic_step['block']='NULL';
if(!is_numeric($partic_step['x'])) $partic_step['x']='NULL';
if(!is_numeric($partic_step['y'])) $partic_step['y']='NULL';

?>