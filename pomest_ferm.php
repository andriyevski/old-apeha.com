<?
// ������ ������� �����
if ( $kup_ferm ) {
	if ( $stat['lvl_ferm'] >= 0  ) { // � ���� ���� ��� �����
		if ( $stat['lvl_pomest'] >= 1 ) { // � ���� ��� ��������
			if ( $stat['credits'] >= 100 ) { // ������� �� �����

				mysql_query("UPDATE players set lvl_ferm=1, credits=credits-100 where user='".$stat['user']."'");
				$stat['lvl_ferm']=1;
				$stat['credits']=$stat['credits']-100;
				$msg="�� ������ ��������� �����"; }

				else $msg="� ��� �� ������� �����!"; }
				else $msg="������� �������� ��������!"; }
				else $msg="������! �� ��� ������ �����!"; }
				// ����� ������� �����

				// ������ ������� ��������
				if ( $kup_fermers ) {
					$cena_fermers = $up_fermers_kol*100;
					$all_fermers = $stat['kol_ferm']+$up_fermers_kol;
					if ( $stat['lvl_ferm'] >= $all_fermers ) { // ������ �� � ��� ������� ��� ������� ��������?
						if ( $stat['credits'] >= $cena_fermers ) { // ������� �� �����

							mysql_query("UPDATE players set kol_ferm=kol_ferm+$up_fermers_kol, credits=credits-$cena_fermers where user='".$stat['user']."'");
							$stat['kol_ferm']=$stat['kol_ferm']+$up_fermers_kol;
							$stat['credits']=$stat['credits']-$cena_fermers;

							$msg="�� ������ ������ $up_fermers_kol ���. ��������"; }

							else $msg="� ��� �� ������� �����!"; }
							else $msg="�� �� ������ ������ ������ ��������, ��������� ������� �����!"; }
							// ����� ������� ��������

							// ������ ������ � ������
							if ( $up_ferm ) {
								$cena_up_ferma = $up_lvl_ferm*25; // ���� �������� �����
								if ( $stat['lvl_ferm'] <= $up_lvl_ferm  ) { // ������ �� �� ������� ���������? � �� �� 2 ����� ��� ������ ��������
									if ( $stat['lvl_pomest'] >= $up_lvl_ferm ) { // �� ������ ������ ������� ��� ������ ����������
										if ( $stat['lvl_ferm'] > 0 ) { // � ���� ��� �����
											if ( $stat['lvl_ferm'] != $up_lvl_ferm ) { // ����� �� ������� ����� ����� � ���
												if ( $stat['credits'] >= $cena_up_ferma ) { // ������� �� �����

													mysql_query("UPDATE players set lvl_ferm=$up_lvl_ferm, credits=credits-$cena_up_ferma where user='".$stat['user']."'");
													$stat['lvl_ferm']=$up_lvl_ferm;
													$stat['credits']=$stat['credits']-$cena_up_ferma;

													$msg="�� ������� �������� ����� �� ������ $up_lvl_ferm!"; }

													else $msg="� ��� �� ������� �����!"; }
													else $msg="� ��� � ��� ������� ����� ����� $up_lvl_ferm!"; }
													else $msg="������, � ��� ��� �����!"; }
													else $msg="��� �� ��������� �������� ������, ������� ������ ��������!"; }
													else $msg="�� �� ������ ��������� ������� ������!"; }
													// ����� ������ � ������

													// ������ ���������� ��������
													if ( $del_fermers ) {
														if ( $stat['kol_ferm'] >= $del_fermers_kol ) { // ������ �� � ��� ���������� �������� ��� ������� ��������?

															mysql_query("UPDATE players set kol_ferm=kol_ferm-$del_fermers_kol where user='".$stat['user']."'");
															$stat['kol_ferm']=$stat['kol_ferm']-$del_fermers_kol;

															$msg="�� ������ ������� $del_fermers_kol ���. ��������"; }

															else $msg="������, �� ������� �������� ���-�� �������� �� ����������!"; }
															// ����� ���������� ��������
															?>