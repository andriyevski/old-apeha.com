<?php
if ( ( $stat['rank'] >= 10 && $stat['rank'] <= 14 ) || ( $stat['rank'] >= 98 && $stat['rank'] <= 100 ) ) {
	include "guard.php"; // �������� ���� ��������� ������
} elseif ( $stat['skl'] == 2 ) {
	include "dark.php"; // �������� ���� ������ ����
} elseif ( $stat['skl'] == 3 ) {
	include "svet.php"; // �������� ���� ������ �����
} elseif ( $stat['skl'] == 1 ) {
	include "vor.php"; // �������� ������ �����
} else echo "� ��� ��� ���������! :)";
?>