<?
// ������ ������� ��������� ����������
if ( $kup_repair ) {
	if ( $stat['lvl_repair'] >= 0  ) { // � ���� ���� ��� ����������
		if ( $stat['lvl_pomest'] >= 1 ) { // � ���� ��� ��������
			if ( $stat['credits'] >= 100 ) { // ������� �� �����

				mysql_query("UPDATE players set lvl_repair=1, credits=credits-100 where user='".$stat['user']."'");
				$stat['lvl_repair']=1;
				$stat['credits']=$stat['credits']-100;
				$msg="�� ������ ��������� ��������� ����������"; }
				else $msg="� ��� �� ������� �����!"; }
				else $msg="������� �������� ��������!"; }
				else $msg="������! �� ��� ��������� ��������� ����������!"; }
				// ����� ������� ��������

				// ������ ������ � ��������� ���������
				if ( $up_repair ) {
					$cena_up_repair = $up_lvl_repair*30; // ���� ��������
					if ( $stat['lvl_repair'] <= $up_lvl_repair ) { // ������ �� �� ������� ���������? � �� �� 2 ����� ��� ������ ��������
						if ( $stat['lvl_pomest'] >= $up_lvl_repair ) { // �� ������ ������ ������� ��� ������ ����������
							if ( $stat['lvl_repair'] > 0 ) { // � ���� ��� ��������� ���������
								if ( $stat['lvl_repair'] != $up_lvl_repair ) { // ����� �� ������� �������� ����� � ���
									if ( $stat['credits'] >= $cena_up_repair ) { // ������� �� �����

										mysql_query("UPDATE players set lvl_repair=$up_lvl_repair, credits=credits-$cena_up_repair where user='".$stat['user']."'");
										$stat['lvl_repair']=$up_lvl_repair;
										$stat['credits']=$stat['credits']-$cena_up_repair;

										$msg="�� ������� �������� �������� �� ������ $up_lvl_repair!"; }

										else $msg="� ��� �� ������� �����!"; }
										else $msg="� ��� � ��� ������� ��������� ��������� ����� $up_lvl_repair!"; }
										else $msg="������, � ��� ��� ��������� ���������!"; }
										else $msg="��� �� ��������� �������� ������, ������� ������ ��������!"; }
										else $msg="�� �� ������ ��������� ������� ������!"; }
										// ����� ������ � ��������� ���������

										// ������ ������� ���������� ��������� ���������
										if ( $kup_repairs ) {
											$cena_repairs = $up_repairs_kol*125;
											$all_repairs = $stat['kol_repair']+$up_repairs_kol;
											if ( $stat['lvl_repair'] >= $all_repairs ) { // ������ �� � ��� ���������� ��������� ��������� ��� ������� ��������?
												if ( $stat['credits'] >= $cena_repairs ) { // ������� �� �����

													mysql_query("UPDATE players set kol_repair=kol_repair+$up_repairs_kol, credits=credits-$cena_repairs where user='".$stat['user']."'");
													$stat['kol_repair']=$stat['kol_repair']+$up_repairs_kol;
													$stat['credits']=$stat['credits']-$cena_repairs;

													$msg="�� ������ ������ $up_pomests_kol ���. ����������"; }

													else $msg="� ��� �� ������� �����!"; }
													else $msg="�� �� ������ ������ ������ ����������, ��������� ������� ����������!"; }
													// ����� ������� ���������� ��������� ���������

													// ������ ���������� ���������� ��������� ���������
													if ( $del_repairs ) {
														if ( $stat['kol_repair'] >= $del_repairs_kol ) { // ������ �� � ��� ���������� ��������� ��������� ��� ������� ��������?

															mysql_query("UPDATE players set kol_repair=kol_repair-$del_repairs_kol where user='".$stat['user']."'");
															$stat['kol_repair']=$stat['kol_repair']-$del_repairs_kol;

															$msg="�� ������ ������� $del_repairs_kol ���. ���������� ��������� ���������"; }

															else $msg="������, �� ������� �������� ���-�� ���������� �� ����������!"; }
															// ����� ���������� ���������� ��������� ���������

															?>