<?
$for_add1 = 10;
$energy = 4;

$chl_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp` FROM slots, objects WHERE slots.id='".$chl['id']."' AND objects.user='".$chl['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));

$chl['hp']+=$chl_obj['hp'];
$h_hpmax=$chl['vitality']*5+$chl['hp'];

if ($stat['user'] == $chl['user']) $nms="�� �� ������ ��������� ���� ����!";
elseif ($chl['hp_now'] == 0 && $chl['battle']) $nms="�������� �� ��� �� ����� ����, �������� ��� �������";
elseif ($stat['energy_now'] <= $energy) $nms="� ��� �� ������� ����!";

else {
	$damage = rand(0,10);
	$for_add = $for_add1 + $damage;
	if ($chl['hp_now'] - $for_add <= 0){
		$hp_query=0;
		$hpplus=$chl['hp_now'];}
		else{
			$hp_query=$chl['hp_now']-$for_add;
			$hpplus=$for_add;}

			if ($stat[user]!="$chl[user]") $MesgForAdd = "��� <b><u>$stat[user]</u></b> ��������� ��� ��������... ����  ��������� ���� ����������� �� <b><u>-$hpplus ��<u></b>";
			else $MesgForAdd = "�������� ��  ������������  ������� �����... �� ���������� �� ... : <b><u>-$hpplus ��</u></b>";

			include("includes/magic/drop.php");

			require_once("function/chat_insert.php");
			insert_msg("$MesgForAdd","","","1",$chl[user],"","0");


			if ($stat['user'] == $chl['user'] && $stat['battle'] == NULL) $stat['hp_now'] = $hp_query;

			mysql_query("update person set hp_now=".$hp_query." where id='".$chl['id']."'");
			mysql_query("update person set energy_now=energy_now-$energy where id='".$stat['id']."'");

			if ($chl['battle'])
			mysql_query("update participants set hp=".$hp_query." where id='".$chl['id']."'");


			$nms="������ ����� �������� ...<br>�������� <u>".$chl['user']."</u> ��������� � ��� ����� ��������� ��� ���������� �� <u>-$hpplus HP</u>";

			$alldone=1;
}

?>
