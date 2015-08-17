<?

if (!isset($get)) { $getinfo=$stat['id']; $getuser=$stat['user']; }
elseif ($get == 1) { $getinfo=$info['id']; $getuser=$info['user']; }
elseif ($get == 2) { $getinfo=$second['id']; $getuser=$second['user']; }

// Всплывающее описание предметов
$tip=array(1 => 'Оружие', 2 => 'Доспех', 3 => 'Кольцо', 4 => 'Ожерелье', 5 => 'Щит', 6 => 'Обувь', 7 => 'Пояс', 8 => 'Шлем', 9 => 'Перчатки', 10 => 'Нарукавники', 11 => 'Браслет', 12 => 'Магия');

for ($i=1; $i<30; $i++) {

	$w['$i']=mysql_fetch_array(mysql_query("select objects.`id`,objects.`inf`,objects.`tip`,objects.`min_d`,objects.`max_d`,objects.`hp`,objects.`energy`,objects.`br1`,objects.`br2`,objects.`br3`,objects.`br4`,objects.`br5`,objects.`strength`,objects.`dex`,objects.`agility`,objects.`vitality`,objects.`razum`,objects.`krit`,objects.`unkrit`,objects.`uv`,objects.`unuv` from slots, objects where slots.id='".addslashes($getinfo)."' AND slots.$i <> 0 AND objects.user='".$getuser."' AND objects.id=slots.$i LIMIT 1"));

	$it_inf=explode("|",$w['$i']['inf']);

	$it=array(
'id'=> $w['$i'][id],
'name'=> $it_inf[0],
'title'=> $it_inf[1],
'grav'=> $it_inf[3],
'c_iznos'=> $it_inf[6],
'm_iznos'=> $it_inf[7],
'tip'=> $w['$i']['tip'],
'min'=> $w['$i']['min_d'],
'max'=> $w['$i']['max_d'],
'hp'=> $w['$i']['hp'],
'energy'=> $w['$i']['energy'],
'br1'=> $w['$i']['br1'],
'br2'=> $w['$i']['br2'],
'br3'=> $w['$i']['br3'],
'br4'=> $w['$i']['br4'],
'br5'=> $w['$i']['br5'],
'strength'=> $w['$i']['strength'],
'dex'=> $w['$i']['dex'],
'agility'=> $w['$i']['agility'],
'vitality'=> $w['$i']['vitality'],
'razum'=> $w['$i']['razum'],
'krit'=> $w['$i']['krit'],
'unkrit'=> $w['$i']['unkrit'],
'uv'=> $w['$i']['uv'],
'unuv'=> $w['$i']['unuv'],
	);


	if ($set == "edit") $it['title']="Снять ".$it['title'];

	if (!empty($it['name'])) {
		$w_img[$i]=$it['name'];
		$w_title[$i]=$it['title'];
		$w_id[$i]=$it['id'];
	} else {
		$w_img[$i]="w".$i;
		$w_title[$i]="";
		$w_id[$i]="";
	}

	$w[$i]="it('$it[title]','$it[c_iznos] [$it[m_iznos]]','".$tip[$it['tip']]."','$it[min]','$it[max]','$it[hp]','$it[energy]','$it[br1]','$it[br2]','$it[br3]','$it[br4]','$it[br5]','$it[strength]','$it[dex]','$it[agility]','$it[vitality]','$it[razum]','$it[krit]','$it[unkrit]','$it[uv]','$it[unuv]','$it[grav]');";

}
//

?>