<?

if ($stat['user'] != "$chl[user]") $nms="������ ���������� ����� �������� ������ �� ����!";
elseif ($stat['invisible'] > $now) $nms="������ ���������� ���� ������������ ����� � ��� ��������� �� ���!";
else {
	mysql_query("UPDATE players SET invisible=$now+3600 WHERE id='".$stat['id']."'");
	$nms="�� ������ ������...<br>���� ������� ���!";
	$alldone=1;
}

?>