<?

$partic_color='blue';
$enemy_color='red';
if($partic_step['side']==0){
	$partic_color='blue';
	$enemy_color='red';
}
$cma_a[0]="<b><font color=$partic_color>$partic_stat[user]</font></b> ударил $str, хотя <b><font color=$enemy_color>$enemy_stat[user]</font></b> 	пытался уйти от удара: <b style=\"COLOR: $com_color\">-$damage[0]</b> [$enemy_stat[user]: $comhp_0]";
$cma_a[1]="<b><font color=$partic_color>$partic_stat[user]</font></b> саданул точный удар $str, несмотря на то, что наглый <b><font color=$enemy_color>$enemy_stat[user]</font></b> хотел уйти от удара: <b style=\"COLOR: $com_color\">-$damage[0]</b> [$enemy_stat[user]: $comhp_0]";
$cma_a[2]="<b><font color=$partic_color>$partic_stat[user]</font></b> влепил мощный удар $str, несмотря на все усилия <b><font color=$enemy_color>$enemy_stat[user]</font></b> избежать этого: <b style=\"COLOR: $com_color\">-$damage[0]</b> [$enemy_stat[user]: $comhp_0]";
$cma_a[3]="<b><font color=$enemy_color>$enemy_stat[user]</font></b> явно неодоценил силы противника... Как результат: <b><font color=$partic_color>$partic_stat[user]</font></b> нанёс тяжелейший удар $str: <b style=\"COLOR: $com_color\">-$damage[0]</b> [$enemy_stat[user]: $comhp_0]";
$cma_a[4]="Почувствовав нерешительность <b><font color=$enemy_color>$enemy_stat[user]</font></b>, разъярённый <b><font color=$partic_color>$partic_stat[user]</font></b> со всего размаху ударил $str: <b style=\"COLOR: $com_color\">-$damage[0]</b> [$enemy_stat[user]: $comhp_0]";
$cma_a[5]="<b><font color=$enemy_color>$enemy_stat[user]</font></b> совершил роковую ошибку, подойдя вплотную к <b><font color=$partic_color>$partic_stat[user]</font></b>, на что тот ответил незамедлительным ударом $str: <b style=\"COLOR: $com_color\">-$damage[0]</b> [$enemy_stat[user]: $comhp_0]";
$cma_a[6]="<b><font color=$enemy_color>$enemy_stat[user]</font></b> предпринял неудачную попытку заблокировать удар, за что и поплатился. Яростный <b><font color=$partic_color>$partic_stat[user]</font></b> нанес точнейший удар $str: <b style=\"COLOR: $com_color\">-$damage[0]</b> [$enemy_stat[user]: $comhp_0]";
$cma_a[7]="<b><font color=$partic_color>$partic_stat[user]</font></b>, увидев страх в глазах противника, незамедлительно нанёс сокрушительный удар $str <b><font color=$enemy_color>$enemy_stat[user]</font></b>: <b style=\"COLOR: $com_color\">-$damage[0]</b> [$enemy_stat[user]: $comhp_0]";

$cmb_a[0]="<b><font color=$partic_color>$partic_stat[user]</font></b> хотел вломить $str, но <b><font color=$enemy_color>$enemy_stat[user]</font></b>, не напрягаясь, заблокировал удар";
$cmb_a[1]="<b><font color=$partic_color>$partic_stat[user]</font></b> изо всех сил пытался вломить, но <b><font color=$enemy_color>$enemy_stat[user]</font></b> увел удар $str";
$cmb_a[2]="<b><font color=$partic_color>$partic_stat[user]</font></b> призадумался, благодаря чему сообразительный <b><font color=$enemy_color>$enemy_stat[user]</font></b>, сменив тактику, заблокировал удар $str";
$cmb_a[3]="Силы потраченные <b><font color=$partic_color>$partic_stat[user]</font></b> для удара $str не принесли ему успеха, и как следствие <b><font color=$enemy_color>$enemy_stat[user]</font></b> заблокировал удар";
$cmb_b[4]="<b><font color=$enemy_color>$enemy_stat[user]</font></b> ушел в глухую оборону и как следствие заблокировал удар <b><font color=$partic_color>$partic_stat[user]</font></b> $str";
$cmb_b[5]="Замысел <b><font color=$partic_color>$partic_stat[user]</font></b> легко читался и прозорливый <b><font color=$enemy_color>$enemy_stat[user]</font></b> увел удар $str";
$cmb_b[6]="Силы были равны... Но обороняющийся <b><font color=$enemy_color>$enemy_stat[user]</font></b> оказался немного хитрее и поэтому заблокировал удар <b><font color=$partic_color>$partic_stat[user]</font></b> $str";
$cmb_b[7]="Атакующий <b><font color=$partic_color>$partic_stat[user]</font></b> размахнулся, но всё было сделано настолько медленно, что <b><font color=$enemy_color>$enemy_stat[user]</font></b> заблокировал удар $str";

?>