<?
////////////////////////////////////////////////////////////////////////////////

$upd_krit = 0;    //��������� ��� �����
$upd_uv = 0;      //��������� ��� �������
$upd_block = 0;   //��������� ��� ������������
$upd_udar = 0;    //��������� ��� ���������

$add_hp_3 = 3;    //��������� ��� ������ +3 HP
$add_dmg_3 = 3;   //��������� ��� ������ +3 �����
$add_armor_3 = 3; //��������� ��� ������ +3 ������
$add_dmg_20 = 20; //��������� ��� ������ +20 �����
$add_dmg_20_a = 5;//��������� ��� ������ +20 ����� ������������ �����
$add_armor = 1;   //��������� ��� ������ �������
$add_armor_a = 5; //��������� ��� ������ ������� ������������ ������
$add_a_rivok = 3; //��������� ��� ������ ����� ������������ ���������� �����
$add_dmg_lvl = 6; //��������� ��� ������ ������� ����
$add_dmg_lvl2 = 5;//��������� ��� ������ ������ ����
$add_dmg_lvl3 = 3;//��������� ��� ������ ������ ����
$add_dmg_lvl4 = 2;//��������� ��� ������ ������ ����


$sel = mysql_query("SELECT * FROM priemy");
while ($pr_s = mysql_fetch_array($sel)){
	$p_id = $pr_s[p_id];
	$min_a[$p_id] = $pr_s[p_a];    //��������� ������������ ���������� ���������
	$min_d[$p_id] = $pr_s[p_d];    //��������� ������������ ���������� ������������
	$min_u[$p_id] = $pr_s[p_u];    //��������� ������������ ���������� ��������
	$min_k[$p_id] = $pr_s[p_k];    //��������� ������������ ���������� ������
	$min_r[$p_id] = $pr_s[p_r];    //��������� ������������ ���������� ������� ��������
	$min_l[$p_id] = $pr_s[p_l];    //��������� ������������ ���������� ������� ��������
	$name[$p_id] = $pr_s[name];    //��������� ������������ ���������� ������� ��������
}
////////////////////////////////////////////////////////////////////////////////

if ($p) {

	$access[$p] = 1;
	#echo "$p <hr>";
	$test_p = mysql_query("SELECT * FROM battles WHERE attacker = '$stat[user]' AND (priem = 0 OR priem = $p) ORDER BY `time` DESC LIMIT $min_r[$p]");
	while ($check = mysql_fetch_array($test_p)) {
		if ($check[priem] == $p) {$access[$p] = 0;}
	}
	$p_c = mysql_fetch_array(mysql_query("SELECT a,d,u,k FROM battles_stat WHERE u_id = $stat[id]"));
	if ($access[$p] == 1) {
		if ($p_c[a] >= $min_a[$p] AND $p_c[d] >= $min_d[$p] AND $p_c[u] >= $min_u[$p] AND $p_c[k] >= $min_k[$p] AND $stat['level'] >= $min_l[$p_id]) {
			$access[$p] = 1;
		}
		else {
			$access[$p] = 0;
		}
	}
	if ($access[$p] == 0 ) {}
	else {
		include "inc/battle/priemy/$p.php";
		$ch_again = 1;
	}



}

if (!$p or $ch_again == 1) {
	$max = mysql_num_rows(mysql_query("SELECT p_id from priemy"));
	$i = 1;
	while ($i <= $max) {
		$access[$i] = 1;
		#echo "$i <hr>";
		$test_p = mysql_query("SELECT * FROM battles WHERE attacker = '$stat[user]' AND (priem = 0 OR priem = $i) ORDER BY `time` DESC LIMIT $min_r[$i]");
		while ($check = mysql_fetch_array($test_p)) {
			if ($check[priem] == $i) {$access[$i] = 0;}
		}
		$p_c = mysql_fetch_array(mysql_query("SELECT a,d,u,k FROM battles_stat WHERE u_id = $stat[id]"));
		if ($access[$i] == 1) {
			if ($p_c[a] >= $min_a[$i] AND $p_c[d] >= $min_d[$i] AND $p_c[u] >= $min_u[$i] AND $p_c[k] >= $min_k[$i]) {
				$access[$i] = 1;
			}
			else {
				$access[$i] = 0;
			}
		}
		#echo "$i $access[$i]<hr>";
		$i++;
	}
}

if ($stat[hp_now] > (int)($stat[hp_max]/3)) {
	$access[13] = 0;
}
#echo "$stat[hp_now] > ($stat[hp_max]/3) $access[13]<hr>";

?>