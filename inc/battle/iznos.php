// ----- # Износ вищей # ----- // function iznos(){ global $stat;
$zap=''; $masseg=''; $i=0; $chl_obj=mysql_query("SELECT slots.*,
objects.id FROM slots, objects WHERE slots.id='".$stat['id']."' AND
objects.user='".$stat['user']."' AND objects.id IN
(slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.19)");
while ($vesh=mysql_fetch_array($chl_obj)){ $id_vesh[$i]=$vesh['id'];
$s_vesh[$i]['1']=$vesh['1']; $s_vesh[$i]['2']=$vesh['2'];
$s_vesh[$i]['3']=$vesh['3']; $s_vesh[$i]['4']=$vesh['4'];
$s_vesh[$i]['5']=$vesh['5']; $s_vesh[$i]['6']=$vesh['6'];
$s_vesh[$i]['7']=$vesh['7']; $s_vesh[$i]['8']=$vesh['8'];
$s_vesh[$i]['9']=$vesh['9']; $s_vesh[$i]['10']=$vesh['10'];
$s_vesh[$i]['11']=$vesh['11']; $s_vesh[$i]['12']=$vesh['12'];
$s_vesh[$i]['13']=$vesh['13']; $s_vesh[$i]['14']=$vesh['14'];
$s_vesh[$i]['15']=$vesh['15']; $s_vesh[$i]['16']=$vesh['16'];
$s_vesh[$i]['19']=$vesh['19']; $i++; } if (count($id_vesh)>0){ $rand =
mt_rand(1, count($id_vesh)); srand ((float) microtime() * 10000000);
$rand_keys = array_rand ($id_vesh, $rand); for ($i=0;
$i<=count($rand_keys)-1; $i++){ $rand_key =
(count($rand_keys)==1?$rand_keys:$rand_keys[$i]); if
($chl_obj=mysql_fetch_array(mysql_query("SELECT id, inf FROM objects
WHERE user='".$stat['user']."' AND id = ".$id_vesh[$rand_key].""))){
$obj_inf=explode("|",$chl_obj['inf']); $masseg.=$zap."
<b>".$obj_inf[1]."</b>
"; $zap=", "; $obj_inf['6']+=1; // --- # Добавление износа # --- //
mysql_query("UPDATE objects SET
inf='".$obj_inf['0']."|".$obj_inf['1']."|".$obj_inf['2']."|".$obj_inf['3']."|".$obj_inf['4']."|".$obj_inf['5']."|".$obj_inf['6']."|".$obj_inf['7']."'
WHERE id='".$id_vesh[$rand_key]."'"); if ($obj_inf['7'] ==
$obj_inf['6']) { // ----- # Удаляем свиток # ----- //
//mysql_query("DELETE FROM objects WHERE id='".$id_vesh[$rand_key]."'");
switch ($id_vesh[$rand_key]) { case $s_vesh[$rand_key]['1']: $slots =
'1'; break; case $s_vesh[$rand_key]['2']: $slots = '2'; break; case
$s_vesh[$rand_key]['3']: $slots = '3'; break; case
$s_vesh[$rand_key]['4']: $slots = '4'; break; case
$s_vesh[$rand_key]['5']: $slots = '5'; break; case
$s_vesh[$rand_key]['6']: $slots = '6'; break; case
$s_vesh[$rand_key]['7']: $slots = '7'; break; case
$s_vesh[$rand_key]['8']: $slots = '8'; break; case
$s_vesh[$rand_key]['9']: $slots = '9'; break; case
$s_vesh[$rand_key]['10']: $slots = '10'; break; case
$s_vesh[$rand_key]['11']: $slots = '11'; break; case
$s_vesh[$rand_key]['12']: $slots = '12'; break; case
$s_vesh[$rand_key]['13']: $slots = '13'; break; case
$s_vesh[$rand_key]['14']: $slots = '14'; break; case
$s_vesh[$rand_key]['15']: $slots = '15'; break; case
$s_vesh[$rand_key]['16']: $slots = '16'; break; case
$s_vesh[$rand_key]['19']: $slots = '19'; break; } mysql_query("UPDATE
slots SET slots.".$slots."=0 WHERE slots.id='".$stat['id']."'");
$obj_inf['3'] = 0; } } } } if ($masseg!=''){ $masseg = "Ваши Вещи
приобрели единицу износа: ".$masseg; return $masseg; } } // ----- Конец
----- //
