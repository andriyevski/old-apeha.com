<?
$for_add = 200;

if ($chl['user'] != $stat['user']) $nms="������ �� ������ ���� ������ �����.";
if ($chl['energy_now'] >= $stat['energy_max']) $nms="�� �� ���������� � ����!";
else {

	if ($chl['energy_now'] + $for_add >= $stat['energy_max']) 	// ��������� ����� ������� ��� ������� ���������
	{						// ������� ������ �� ���������� ��������
		$energy_query=$stat['energy_max'];			// � ����� ������ ������ ������
		$energyplus=$stat['energy_max']-$chl['energy_now'];	//
	}						//
	else 						//
	{						//
		$energy_query=$chl['energy_now']+$for_add;	//
		$energyplus=$for_add;
	}

	$stat['energy_now'] = $energy_query;

	mysql_query("update person set energy_now=".$energy_query." where id='".$chl['id']."'");

	$iteminfo=mysql_fetch_array(mysql_query("SELECT name, title FROM items where name='".$iteminfo['name']."'")); //�������� ��� ����� ����������� ����� ����� ���� �������� title ������

	$nms="�� ������������ ".$iteminfo['title']."...<br>������� ������� ��������� <u>".$chl['user']."</u> ������������ �� <u>+$energyplus ��.</u>";

	$MesgForAdd = "�� ������������ ".$iteminfo['title']."... ������ ������������ ��� ������� ����: <b><u>+$energyplus ��.</u></b>";

	include("includes/magic/drop.php");

	require_once("function/chat_insert.php");

	insert_msg("$MesgForAdd","","","1",$chl['user'],"","0");

	$alldone=1;
}

?>