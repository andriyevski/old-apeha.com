<?

if ($stat['energy_now'] < 10) $nms="� ��� �� ������� ����!";
elseif ($chl['ma_time'] > $now) $nms="�� ��������� ��� ����� ������ �� ����������� ���������!";
else
{

	mysql_query("update person set ma_time=$now+3600 where user='".$chl['user']."'");
	mysql_query("update person set energy_now=energy_now-10 where id='".$stat['id']."'");

	$nms="�� �������� ������ �� ����������� ��������� �� ��������� <u>".$chl['user']."</u>";
	$iteminfo=mysql_fetch_array(mysql_query("SELECT name, title FROM items where name='".$iteminfo['name']."'")); //�������� ��� ����� ����������� ����� ����� ���� �������� title ������
	if ($stat[user]!="$chl[user]") $MesgForAdd = "�������� <b><u>$stat[user]</u></b> ������� �� ��� ������ �� ����������� ���������</b>";
	else $MesgForAdd = "�� ������������ ".$iteminfo['title']."... �� �������� �� ���� ����� �� ����������� ���������";
	include("includes/magic/drop.php");

	require_once("function/chat_insert.php");
	insert_msg("$MesgForAdd","","","1",$chl[user],"","0");

	$alldone=1;
}
?>