<?
$_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp`, SUM(objects.`power`) as `power`, SUM(objects.`strength`) as `strength`, SUM(objects.`dex`) as `dex`, SUM(objects.`agility`) as `agility`, SUM(objects.`vitality`) as `vitality`, SUM(objects.`razum`) as `razum`, SUM(objects.`br1`) as `br1`, SUM(objects.`br2`) as `br2`, SUM(objects.`br3`) as `br3`, SUM(objects.`br4`) as `br4`, SUM(objects.`br5`) as `br5`, SUM(objects.`krit`) as `krit`, SUM(objects.`unkrit`) as `unkrit`, SUM(objects.`uv`) as `uv`, SUM(objects.`unuv`) as `unuv`, SUM(objects.`min_d`) as `min_d`, SUM(objects.`max_d`) as `max_d` FROM slots, objects WHERE slots.id='".$enemy_stat['id']."' AND objects.user='".$enemy_stat['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));

$HisSkills = explode("|",$enemy_stat['rase_skill']);

$enemy_stat['ork']=$HisSkills['0']*5;
$enemy_stat['elf']=$HisSkills['1']*5;
$enemy_stat['people']=$HisSkills['2']*5;
$enemy_stat['gnom']=$HisSkills['3']*5;

// HP, Energy
$enemy_stat['hp']+=$_obj['hp'];
$enemy_stat['power']+=$_obj['power'];

// Статы
$enemy_stat['strength']+=$_obj['strength'];
$enemy_stat['dex']+=$_obj['dex'];
$enemy_stat['agility']+=$_obj['agility'];
$enemy_stat['vitality']+=$_obj['vitality'];
$enemy_stat['razum']+=$_obj['razum'];

// МФ
$enemy_stat['br1']+=$_obj['br1'];
$enemy_stat['br2']+=$_obj['br2'];
//$enemy_stat['br3']+=$_obj['br3'];
$enemy_stat['br4']+=$_obj['br4'];
$enemy_stat['br5']+=$_obj['br5'];

$enemy_stat['krit']+=$_obj['krit']*(1+($stat['people']/100));
$enemy_stat['unkrit']+=$_obj['unkrit'];
$enemy_stat['uv']+=$_obj['uv']*(1+($enemy_stat['elf']/100));
$enemy_stat['unuv']+=$_obj['unuv'];

$enemy_stat['min']+=$_obj['min_d'];
$enemy_stat['max']+=$_obj['max_d'];

if(!is_numeric($enemy_stat['kick'])) $enemy_stat['kick']='NULL';
if(!is_numeric($enemy_stat['block'])) $enemy_stat['block']='NULL';
if(!is_numeric($enemy_stat['x'])) $enemy_stat['x']='NULL';
if(!is_numeric($enemy_stat['y'])) $enemy_stat['y']='NULL';

?>