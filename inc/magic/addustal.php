<?

$chl_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp` FROM slots, objects WHERE slots.id='".$chl['id']."' AND objects.user='".$chl['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19,slots.20) LIMIT 1"));

$ustal_max = $stat['battery']*20;

if ($chl['ustal_now'] >= $ustal_max) $nms="�������� \"".$chl['user']."\" �� ��������� � �������!";

else {
		
	$ustalplus=$ustal_max-$chl['ustal_now'];

	if ($stat['user'] == $chl['user'] && $stat['battle'] == NULL) $stat['ustal_now'] = $ustal_max;

	mysql_query("update person set ustal_now=".$ustal_max." where id='".$chl['id']."'");

	$iteminfo=mysql_fetch_array(mysql_query("SELECT name, title FROM items where name='".$iteminfo['name']."'")); //�������� ��� ����� ����������� ����� ����� ���� �������� title ������

	if ($stat[user]!="$chl[user]") $MesgForAdd = "�������� <b><u>$stat[user]</u></b> ����������� ��� ������� ����������: <b><u>+$ustalplus<u></b> ��.";
	else $MesgForAdd = "�� ������������ ".$iteminfo['title']."... ������ ������������ ��� ������� ����������: <b><u>+$ustalplus</u></b> ��.";
	include("includes/magic/drop.php");

	require_once("function/chat_insert.php");
	insert_msg("$MesgForAdd","","","1",$chl[user],"","0");

	$alldone=1;
}

?>