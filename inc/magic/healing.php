<?

if ($chl['travma'] < $now) $nms="�������� �� �����������!";
elseif ($chl['room'] != $stat['room']) $nms="��� ��������� ��������� �� ����� ��� ���������� ��������� � ����� �������!";
else {

	include("inc/magic/drop.php");

	mysql_query("UPDATE players SET travma=NULL where id='".$chl['id']."'");

	if ($chl['user'] == $stat['user']) {
		$MesgForAdd = "�� ������� �������� ���� �� �����!";
		$stat['travma'] = NULL;
	}
	else $MesgForAdd = "�� �������� �� ����� ������� <b><u>".$stat['user']."</u></b>";

	require_once("inc/chat/functions.php");
	insert_msg("$MesgForAdd","","","1",$chl['user'],"",$chl['room']);

	$nms="�� ������ ������...<br>�������� <u>".$chl['user']."</u> ������� ������ �� �����!";
	$alldone=1;
}

?>