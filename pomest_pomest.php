<?

// ������ ������� ��������
if ( $kup_pomest ) {
	if ( $stat['lvl_pomest'] >= 0  ) { // � ���� ���� ��� ��������
		if ( $stat['credits'] >= 150 ) { // ������� �� �����

			mysql_query("UPDATE players set lvl_pomest=1, credits=credits-150 where user='".$stat['user']."'");
			$stat['lvl_pomest']=1;
			$stat['credits']=$stat['credits']-150;

			$msg="�� ������ ��������� ��������"; }

			else $msg="� ��� �� ������� �����!"; }
			else $msg="������! �� ��� ��������� ��������!"; }
			// ����� ������� ��������

			// ������ ������ � ���������
			if ( $up_pomest ) {
				$cena_up_pomest = $up_lvl_pomest*50; // ���� ��������
				if ( $stat['lvl_pomest'] <= $up_lvl_pomest  ) { // ������ �� �� ������� ���������? � �� �� 2 ����� ��� ������ ��������
					if ( $stat['lvl_pomest'] > 0 ) { // � ���� ��� �����
						if ( $stat['lvl_pomest'] != $up_lvl_pomest ) { // ����� �� ������� �������� ����� � ���
							if ( $stat['credits'] >= $cena_up_pomest ) { // ������� �� �����

								mysql_query("UPDATE players set lvl_pomest=$up_lvl_pomest, credits=credits-$cena_up_pomest where user='".$stat['user']."'");
								$stat['lvl_pomest']=$up_lvl_pomest;
								$stat['credits']=$stat['credits']-$cena_up_pomest;

								$msg="�� ������� �������� �������� �� ������ $up_lvl_pomest!"; }

								else $msg="� ��� �� ������� �����!"; }
								else $msg="� ��� � ��� ������� �������� ����� $up_lvl_pomest!"; }
								else $msg="������, � ��� ��� ��������!"; }
								else $msg="�� �� ������ ��������� ������� ������!"; }
								// ����� ������ � ���������

								// ������ ������� ���������� ��������
								if ( $kup_pomests ) {
									$cena_pomests = $up_pomests_kol*50;
									$all_pomests = $stat['kol_pomest']+$up_pomests_kol;
									if ( $stat['lvl_pomest'] >= $all_pomests ) { // ������ �� � ��� ���������� �������� ��� ������� ��������?
										if ( $stat['credits'] >= $cena_pomests ) { // ������� �� �����

											mysql_query("UPDATE players set kol_pomest=kol_pomest+$up_pomests_kol, credits=credits-$cena_pomests where user='".$stat['user']."'");
											$stat['kol_pomest']=$stat['kol_pomest']+$up_pomests_kol;
											$stat['credits']=$stat['credits']-$cena_pomests;

											$msg="�� ������ ������ $up_pomests_kol ���. ���������� ��������"; }

											else $msg="� ��� �� ������� �����!"; }
											else $msg="�� �� ������ ������ ������ ����������, ��������� ������� ��������!"; }
											// ����� ������� ���������� ��������

											// ������ ���������� ���������� ��������
											if ( $del_pomests ) {
												if ( $stat['kol_pomest'] >= $del_pomests_kol ) { // ������ �� � ��� ���������� �������� ��� ������� ��������?

													mysql_query("UPDATE players set kol_pomest=kol_pomest-$del_pomests_kol where user='".$stat['user']."'");
													$stat['kol_pomest']=$stat['kol_pomest']-$del_pomests_kol;

													$msg="�� ������ ������� $del_pomests_kol ���. ���������� ��������"; }

													else $msg="������, �� ������� �������� ���-�� ���������� �� ����������!"; }
													// ����� ���������� ���������� ��������



													?>