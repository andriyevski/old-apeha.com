<?

if ($stat['ustal_now'] < 10) $nms="� ��� �� ������� ����!";
elseif ($chl['immun'] > $now) $nms="�� ��������� ��� ����� ������ �� ���������!";
else
{

	mysql_query("update players set immun=$now+10800 where user='".$chl['user']."'");
	mysql_query("update players set ustal_now=ustal_now-10 where id='".$stat['id']."'");

	$nms="�� �������� ������ �� ��������� �� ��������� <u>".$chl['user']."</u>";
	$iteminfo=mysql_fetch_array(mysql_query("SELECT name, title FROM items where name='".$iteminfo['name']."'")); //�������� ��� ����� ����������� ����� ����� ���� �������� title ������
	if ($stat[user]!="$chl[user]") $MesgForAdd = "�������� <b><u>$stat[user]</u></b> ������� �� ��� ������ �� ���������</b>";
	else $MesgForAdd = "�� ������ ������������ ".$iteminfo['title']."... ";
	include("inc/magic/drop.php");

	require_once("inc/chat/functions.php");

	insert_msg("$MesgForAdd","","","1",$chl['user'],"",$chl['room']);

	$alldone=1;
}
?>