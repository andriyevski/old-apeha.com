<?


###����������� ����������

// �������� ������
if ($obj_infi['0'] == "0") $min_level=""; else {
	if ($stat[level]<"$obj_infi[0]") $min_level="<font color=red>�������: <b>$obj_infi[0]</b></font><br>"; else $min_level="�������: <b>$obj_infi[0]</b><br>"; }

	// �������� ����
	if ($obj_infi[1]=="0") $min_str=""; else {
		if ($stat[strength]<"$obj_infi[1]") $min_str="<font color=red>����: <b>$obj_infi[1]</b></font><br>"; else $min_str="����: <b>$obj_infi[1]</b><br>"; }

		// �������� ��������
		if ($obj_infi[2]=="0") $min_dex=""; else {
			if ($stat[dex]<"$obj_infi[2]") $min_dex="<font color=red>��������: <b>$obj_infi[2]</b></font><br>"; else $min_dex="��������: <b>$obj_infi[2]</b><br>"; }

			// �������� �����
			if ($obj_infi[3]=="0") $min_ag=""; else {
				if ($stat[agility]<"$obj_infi[3]") $min_ag="<font color=red>�����: <b>$obj_infi[3]</b></font><br>"; else $min_ag="�����: <b>$obj_infi[3]</b><br>"; }

				// �������� ������������
				if ($obj_infi[4]=="0") $min_vit=""; else {
					if ($stat[vitality]<"$obj_infi[4]") $min_vit="<font color=red>������������: <b>$obj_infi[4]</b></font><br>"; else $min_vit="������������: <b>$obj_infi[4]</b><br>"; }

					// �������� ������
					if ($obj_infi[5] == 0) $min_razum=""; else {
						if ($stat['razum'] < $obj_infi[5]) $min_razum="<font color=red>�����: <b>$obj_infi[5]</b></font><br>"; else $min_razum="�����: <b>$obj_infi[5]</b><br>"; }



						// �������� ��������
						if ($obj_infi['7'] == 0) $min_proff=""; else {

							switch ($obj_infi[7]) {
								case 1: $prf="������"; break;
								case 2: $prf="����������"; break;
								case 3: $prf="������"; break;
								case 4: $prf="����"; break;
								case 5: $prf="������"; break;
								case 8: $prf="�������"; break;
							}

							if ($stat['proff'] != $obj_infi['7']) $min_proff="<font color=red>���������: $prf</b></font><br>"; else $min_proff="���������: $prf</b><br>"; }

							// �������� ����
							if ($obj_infi[6]=="0") $min_rase=""; else {

								if ($stat[rase]!="$iteminfo[rase]") {

									switch ($obj_infi[6]) {
										case 1: $rs="���"; break;
										case 2: $rs="����"; break;
										case 3: $rs="�������"; break;
										case 4: $rs="����"; break;
										case 100: $rs="�����"; break;
									}

									if ($stat[rase]!="100" and $stat[rase]!="$obj_infi[6]") $min_rase="<font color=red>����: <b>$rs</b></font><br>"; else $min_rase="����: <b>$rs</b><br>"; }}


									####


									###��������

									if ($iteminfo['min_d']=="0" || $iteminfo['max_d']=="0") $uron=""; else $uron="����: <b>+$iteminfo[min_d]</b>... <b>+$iteminfo[max_d]</b><br>";

									if ($iteminfo['br1']=="0") $br1=""; else $br1="����� ������: <b>+$iteminfo[br1]</b><br>";
									if ($iteminfo['br2']=="0") $br2=""; else $br2="����� ������: <b>+$iteminfo[br2]</b><br>";
									if ($iteminfo['br3']=="0") $br3=""; else $br3="����� ������: <b>+$iteminfo[br3]</b><br>";
									if ($iteminfo['br4']=="0") $br4=""; else $br4="����� �����: <b>+$iteminfo[br4]</b><br>";
									if ($iteminfo['br5']=="0") $br5=""; else $br5="����� ���: <b>+$iteminfo[br5]</b><br>";

									if ($iteminfo['strength']=="0") $strength=""; else $strength="����: <b>+$iteminfo[strength]</b><br>";
									if ($iteminfo['agility']=="0") $agility=""; else $agility="��������: <b>+$iteminfo[agility]</b><br>";
									if ($iteminfo['dex']=="0") $dex=""; else $dex="�����: <b>+$iteminfo[dex]</b><br>";

									if ($iteminfo['vitality']=="0") $vitality=""; else $vitality="������������: <b>+$iteminfo[vitality]</b><br>";
									if ($iteminfo['razum']=="0") $razum=""; else $razum="�����: <b>+$iteminfo[razum]</b><br>";

									if ($iteminfo['krit']=="0") $krit=""; else $krit="������������ �����: <b>+$iteminfo[krit]%</b><br>";
									if ($iteminfo['unkrit']=="0") $unkrit=""; else $unkrit="������ ������������ �����: <b>+$iteminfo[unkrit]%</b><br>";
									if ($iteminfo['uv']=="0") $uv=""; else $uv="�����������: <b>+$iteminfo[uv]%</b><br>";
									if ($iteminfo['unuv']=="0") $unuv=""; else $unuv="������ �����������: <b>+$iteminfo[unuv]%</b><br>";

									if ($iteminfo['hp']=="0") $hp=""; else $hp="������� �����: <b>+$iteminfo[hp]</b><br>";
									if ($iteminfo['energy']=="0") $energy=""; else $energy="������� �������: <b>+$iteminfo[energy]</b><br>";

									###


									?>