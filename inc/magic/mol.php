<?

if ($stat['ustal_now'] < 5) $nms="� ��� �� ������� ����!";
elseif ($chl['m_time']> $now) $nms="�� ��������� ��������� ���������� ������!";
elseif ($chl['rank'] >= 10) $nms="���������� �������� ����������� �� �������� ������!";
else
{
	include("inc/magic/drop.php");

	mysql_query("update players set m_time=$now+600 where user='".$chl['user']."'");
	mysql_query("update players set ustal_now=ustal_now-5 where id='".$stat['id']."'");
	$nms="�� �������� ������ �� ������� � ���� �� ��������� <u>".$chl['user']."</u>";

	$alldone=1;
}
?>