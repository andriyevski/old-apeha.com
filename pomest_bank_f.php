<?
$doxod = ($stat['bank']/100)*$stat['lvl_bank'];
// ������ ������� �����
if ( $kup_bank ) {
	if ( $stat['lvl_bank'] >= 0  ) { // � ���� ���� ��� ����
		if ( $stat['lvl_pomest'] >= 1 ) { // � ���� ��� ��������
			if ( $stat['credits'] >= 100 ) { // ������� �� �����

				mysql_query("UPDATE players set lvl_bank=1, credits=credits-150, depozit=1, depoz=1 where user='".$stat['user']."'");
				mysql_query("INSERT INTO `pomest_bank` (`login` ,`money`) VALUES ('".addslashes($user)."', '0')");
				$bank['money']=0;
				$stat['lvl_bank']=1;
				$stat['depozit']=1;
				$stat['depoz']=1;
				$stat['credits']=$stat['credits']-150;

				$msg="�� ������ ��������� ����"; }

				else $msg="� ��� �� ������� �����!"; }
				else $msg="������� �������� ��������!"; }
				else $msg="������! �� ��� ������ ����!"; }
				// ����� ������� �����





				// ������ ������� ��������
				if ( $kup_depozit ) {
					$cena_depozit = $up_depozit_kol*25;
					$all_depozit = $stat['depozit']+$up_depozit_kol;
					if ( $stat['lvl_bank'] >= $all_depozit ) { // ������ �� � ��� ������� ��� ������� ��������?
						if ( $stat['credits'] >= $cena_depozit ) { // ������� �� �����

							mysql_query("UPDATE players set depozit=depozit+$up_depozit_kol, credits=credits-$cena_depozit where user='".$stat['user']."'");
							$stat['depozit']=$stat['depozit']+$up_depozit_kol;
							$stat['credits']=$stat['credits']-$cena_depozit;

							$msg="�� ������ �������� �������� �� $up_depozit_kol ��."; }

							else $msg="� ��� �� ������� �����!"; }
							else $msg="�� �� ������ �������� ��������, ��������� ������� �����!"; }
							// ����� ������� ���������




							// ������ ������ � ������
							if ( $up_bank ) {
								$cena_up_bank = $up_lvl_bank*50; // ���� �������� �����
								if ( $stat['lvl_bank'] <= $up_lvl_bank  ) { // ������ �� �� ������� ���������? � �� �� 2 ����� ��� ������ ��������
									if ( $stat['lvl_pomest'] >= $up_lvl_bank ) { // �� ������ ������ ������� ��� ������ ����������
										if ( $stat['lvl_bank'] > 0 ) { // � ���� ��� �����
											if ( $stat['lvl_bank'] != $up_lvl_bank ) { // ����� �� ������� ����� ����� � ���
												if ( $stat['credits'] >= $cena_up_bank ) { // ������� �� �����

													mysql_query("UPDATE players set lvl_bank=$up_lvl_bank, credits=credits-$cena_up_bank where user='".$stat['user']."'");
													$stat['lvl_bank']=$up_lvl_bank;
													$stat['credits']=$stat['credits']-$cena_up_bank;

													$msg="�� ������� �������� ���� �� ������ $up_lvl_bank!"; }

													else $msg="� ��� �� ������� �����!"; }
													else $msg="� ��� � ��� ������� ����� ����� $up_lvl_bank!"; }
													else $msg="������, � ��� ��� �����!"; }
													else $msg="��� �� ��������� �������� ������, ������� ������ ��������!"; }
													else $msg="�� �� ������ ��������� ������� ������!"; }
													// ����� ������ � ������








													if ( $deposit ) {
														$moneys = round( str_replace( "-", "", $money1 ) );
														if ( $moneys <= $stat['credits'] ) {
															if ( $moneys >= 1 ) {
																if ( $stat['depoz'] != 0 ) {

																	mysql_query("UPDATE players SET credits=credits-$moneys, bank=bank+$moneys, depoz=depoz-1 WHERE user='".$stat['user']."' ");
																	$stat['depoz']=$stat['depoz']-1;
																	$stat['credits']=$stat['credits']-$moneys;
																	$stat['bank']=$stat['bank']+$moneys;

																	$msg="�� �������� �� ���� $moneys ������!"; }

																	else $msg="�������, �� ������ �� ������� �������� �� ����!"; }
																	else $msg="�������� ����� �� �����!"; }
																	else $msg="� ��� ������������ ������!"; }




																	if ( $withdraw ) {
																		$moneys = round( str_replace( "-", "", $money2 ) );
																		if ( $moneys <= $stat['bank'] ) {
																			if ( $moneys >= 1 ) {

																				mysql_query("UPDATE players SET credits=credits+$moneys, bank=bank-$moneys WHERE user='".$stat['user']."' ");
																				$stat['credits']=$stat['credits']+$moneys;
																				$stat['bank']=$stat['bank']-$moneys;

																				$msg="�� ����� �� ����� $moneys ������!"; }

																				else $msg="�������� ����� �� �����!"; }
																				else $msg="� ��� ������������ ������!"; }

																				?>
