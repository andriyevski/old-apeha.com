<?

if ($stat['user'] != "$chl[user]") $nms="������ ���������� ����� �������� ������ �� ����!";
elseif ($stat['sclon'] == 'neutral') $nms="�� � ��� ����������!";
else {
	mysql_query("UPDATE person SET sclon='neutral' WHERE id='".$stat['id']."'");
	$nms="�� ������ ������...<br>�� ����� �����������!";

	$iteminfo=mysql_fetch_array(mysql_query("SELECT name, title FROM items where name='".$iteminfo['name']."'")); //�������� ��� ����� ����������� ����� ����� ���� �������� title ������

	$MesgForAdd = "�� ������������ ".$iteminfo['title']." � ������ �� ����������� ���� �����.</b>";
	include("includes/magic/drop.php");

	require_once("function/chat_insert.php");

	insert_msg("$MesgForAdd","","","1",$chl['user'],"",$chl['room']);
	$alldone=1;
}

?>