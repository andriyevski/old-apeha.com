<?

if ($stat['user'] == "$chl[user]") $nms="������ ���������� ������ �������� �� ����!";
elseif ($chl['battle']) $nms="�������� ���������� � ���!";
elseif ($chl['t_time'] > $now) $nms="�������� � ��� � ������!";
else {
	mysql_query("UPDATE person SET t_time=$now+900, reason='����� �� ���������', battle=NULL, v_time=NULL, k_time=NULL, room='666' WHERE id='".$chl['id']."'");
	$nms="�� ������ ������...<br>�� ������� �� ������ �������!";

	$iteminfo=mysql_fetch_array(mysql_query("SELECT name, title FROM items where name='".$iteminfo['name']."'")); //�������� ��� ����� ����������� ����� ����� ���� �������� title ������

	$MesgForAdd = "�� ��� �������� �����, � �� ������������� � ������ �� ��������� ���� ������������.</b>";
	include("includes/magic/drop.php");

	require_once("function/chat_insert.php");

	insert_msg("$MesgForAdd","","","1",$chl['user'],"",$chl['room']);
	$alldone=1;
}

?>