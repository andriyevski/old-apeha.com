<?

$partic_color='blue';
$enemy_color='red';
if($partic_step['side']==0){
	$partic_color='blue';
	$enemy_color='red';
}
$cma_a[0]="<b><font color=$partic_color>$partic_stat[user]</font></b> ������ $str, ���� <b><font color=$enemy_color>$enemy_stat[user]</font></b> 	������� ���� �� �����: <b style=\"COLOR: $com_color\">-$damage[0]</b> [$enemy_stat[user]: $comhp_0]";
$cma_a[1]="<b><font color=$partic_color>$partic_stat[user]</font></b> ������� ������ ���� $str, �������� �� ��, ��� ������ <b><font color=$enemy_color>$enemy_stat[user]</font></b> ����� ���� �� �����: <b style=\"COLOR: $com_color\">-$damage[0]</b> [$enemy_stat[user]: $comhp_0]";
$cma_a[2]="<b><font color=$partic_color>$partic_stat[user]</font></b> ������ ������ ���� $str, �������� �� ��� ������ <b><font color=$enemy_color>$enemy_stat[user]</font></b> �������� �����: <b style=\"COLOR: $com_color\">-$damage[0]</b> [$enemy_stat[user]: $comhp_0]";
$cma_a[3]="<b><font color=$enemy_color>$enemy_stat[user]</font></b> ���� ���������� ���� ����������... ��� ���������: <b><font color=$partic_color>$partic_stat[user]</font></b> ���� ���������� ���� $str: <b style=\"COLOR: $com_color\">-$damage[0]</b> [$enemy_stat[user]: $comhp_0]";
$cma_a[4]="������������ ��������������� <b><font color=$enemy_color>$enemy_stat[user]</font></b>, ���������� <b><font color=$partic_color>$partic_stat[user]</font></b> �� ����� ������� ������ $str: <b style=\"COLOR: $com_color\">-$damage[0]</b> [$enemy_stat[user]: $comhp_0]";
$cma_a[5]="<b><font color=$enemy_color>$enemy_stat[user]</font></b> �������� ������� ������, ������� �������� � <b><font color=$partic_color>$partic_stat[user]</font></b>, �� ��� ��� ������� ���������������� ������ $str: <b style=\"COLOR: $com_color\">-$damage[0]</b> [$enemy_stat[user]: $comhp_0]";
$cma_a[6]="<b><font color=$enemy_color>$enemy_stat[user]</font></b> ���������� ��������� ������� ������������� ����, �� ��� � ����������. �������� <b><font color=$partic_color>$partic_stat[user]</font></b> ����� ��������� ���� $str: <b style=\"COLOR: $com_color\">-$damage[0]</b> [$enemy_stat[user]: $comhp_0]";
$cma_a[7]="<b><font color=$partic_color>$partic_stat[user]</font></b>, ������ ����� � ������ ����������, ��������������� ���� �������������� ���� $str <b><font color=$enemy_color>$enemy_stat[user]</font></b>: <b style=\"COLOR: $com_color\">-$damage[0]</b> [$enemy_stat[user]: $comhp_0]";

$cmb_a[0]="<b><font color=$partic_color>$partic_stat[user]</font></b> ����� ������� $str, �� <b><font color=$enemy_color>$enemy_stat[user]</font></b>, �� ����������, ������������ ����";
$cmb_a[1]="<b><font color=$partic_color>$partic_stat[user]</font></b> ��� ���� ��� ������� �������, �� <b><font color=$enemy_color>$enemy_stat[user]</font></b> ���� ���� $str";
$cmb_a[2]="<b><font color=$partic_color>$partic_stat[user]</font></b> ������������, ��������� ���� ��������������� <b><font color=$enemy_color>$enemy_stat[user]</font></b>, ������ �������, ������������ ���� $str";
$cmb_a[3]="���� ����������� <b><font color=$partic_color>$partic_stat[user]</font></b> ��� ����� $str �� �������� ��� ������, � ��� ��������� <b><font color=$enemy_color>$enemy_stat[user]</font></b> ������������ ����";
$cmb_b[4]="<b><font color=$enemy_color>$enemy_stat[user]</font></b> ���� � ������ ������� � ��� ��������� ������������ ���� <b><font color=$partic_color>$partic_stat[user]</font></b> $str";
$cmb_b[5]="������� <b><font color=$partic_color>$partic_stat[user]</font></b> ����� ������� � ����������� <b><font color=$enemy_color>$enemy_stat[user]</font></b> ���� ���� $str";
$cmb_b[6]="���� ���� �����... �� ������������� <b><font color=$enemy_color>$enemy_stat[user]</font></b> �������� ������� ������ � ������� ������������ ���� <b><font color=$partic_color>$partic_stat[user]</font></b> $str";
$cmb_b[7]="��������� <b><font color=$partic_color>$partic_stat[user]</font></b> �����������, �� �� ���� ������� ��������� ��������, ��� <b><font color=$enemy_color>$enemy_stat[user]</font></b> ������������ ���� $str";

?>