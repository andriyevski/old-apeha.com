<?

###����������� ����������

// �������� ������
if ($iteminfo['min_level'] == "0") $min_level=""; else {
	if ($stat[level]<"$iteminfo[min_level]") $min_level="<font color=red>�������: <b>$iteminfo[min_level]</b></font><br>"; else $min_level="�������: <b>$iteminfo[min_level]</b><br>"; }

	// �������� ����
	if ($iteminfo[min_str]=="0") $min_str=""; else {
		if ($stat[strength]<"$iteminfo[min_str]") $min_str="<font color=red>����: <b>$iteminfo[min_str]</b></font><br>"; else $min_str="����: <b>$iteminfo[min_str]</b><br>"; }

		// �������� ��������
		if ($iteminfo[min_ag]=="0") $min_dex=""; else {
			if ($stat[agility]<"$iteminfo[min_ag]") $min_dex="<font color=red>��������: <b>$iteminfo[min_ag]</b></font><br>"; else $min_dex="��������: <b>$iteminfo[min_ag]</b><br>"; }

			// �������� �����
			if ($iteminfo[min_dex]=="0") $min_ag=""; else {
				if ($stat[dex]<"$iteminfo[min_dex]") $min_ag="<font color=red>�����: <b>$iteminfo[min_dex]</b></font><br>"; else $min_ag="�����: <b>$iteminfo[min_dex]</b><br>"; }

				// �������� ������������
				if ($iteminfo[min_vit]=="0") $min_vit=""; else {
					if ($stat[vitality]<"$iteminfo[min_vit]") $min_vit="<font color=red>������������: <b>$iteminfo[min_vit]</b></font><br>"; else $min_vit="������������: <b>$iteminfo[min_vit]</b><br>"; }

					// �������� ������
					if ($iteminfo['min_razum'] == 0) $min_razum=""; else {
						if ($stat['razum'] < $iteminfo['min_razum']) $min_razum="<font color=red>�����: <b>$iteminfo[min_razum]</b></font><br>"; else $min_razum="�����: <b>$iteminfo[min_razum]</b><br>"; }


						// �������� ����
						if ($iteminfo['min_rase']) {

							switch ($iteminfo['min_rase']) {
								case 1: $rs="���"; break;
								case 2: $rs="����"; break;
								case 3: $rs="�������"; break;
								case 4: $rs="����"; break;
								case 100: $rs="�����"; break;
							}

							if ($iteminfo['min_rase'] != $stat['rase']) $min_rase="<font color=red>����: <b>$rs</b></font><br>"; else $min_rase="����: <b>$rs</b><br>";

						}


						// �������� ��������
						if ($iteminfo['min_proff'] == 0) $min_proff=""; else {

							switch ($iteminfo['min_proff']) {
								case 1: $prf="������"; break;
								case 1: $prf="������"; break;
								case 2: $prf="������"; break;
								case 3: $prf="��������"; break;
								case 4: $prf="�������"; break;
								case 5: $prf="������"; break;

								case 8: $prf="����"; break;
								default: $prf="���"; break;
							}

							if ($stat['proff'] != $iteminfo['min_proff']) $min_proff="<font color=red>���������: $prf</font><br>"; else $min_proff="���������: <b>$prf</b><br>"; }


							####


							###��������

							if ($iteminfo[min]=="0" || $iteminfo[max]=="0") $uron=""; else $uron="����: <b>+$iteminfo[min]</b>... <b>+$iteminfo[max]</b><br>";

							if ($iteminfo[br1]=="0") $br1=""; else $br1="����� ������: <b>+$iteminfo[br1]</b><br>";
							if ($iteminfo[br2]=="0") $br2=""; else $br2="����� �������: <b>+$iteminfo[br2]</b><br>";
							if ($iteminfo[br3]=="0") $br3=""; else $br3="����� ������: <b>+$iteminfo[br3]</b><br>";
							if ($iteminfo[br4]=="0") $br4=""; else $br4="����� �����: <b>+$iteminfo[br4]</b><br>";
							if ($iteminfo[br5]=="0") $br5=""; else $br5="����� ���: <b>+$iteminfo[br5]</b><br>";

							if ($iteminfo[strength]=="0") $strength=""; else $strength="����: <b>+$iteminfo[strength]</b><br>";
							if ($iteminfo[agility]=="0") $dex=""; else $dex="��������: <b>+$iteminfo[agility]</b><br>";
							if ($iteminfo[dex]=="0") $agility=""; else $agility="�����: <b>+$iteminfo[dex]</b><br>";
							if ($iteminfo[vitality]=="0") $vitality=""; else $vitality="������������: <b>+$iteminfo[vitality]</b><br>";
							if ($iteminfo[razum]=="0") $razum=""; else $razum="�����: <b>+$iteminfo[razum]</b><br>";

							if ($iteminfo[krit]=="0") $krit=""; else $krit="����. �����: <b>+$iteminfo[krit]%</b><br>";
							if ($iteminfo[unkrit]=="0") $unkrit=""; else $unkrit="��������. �����: <b>+$iteminfo[unkrit]%</b><br>";
							if ($iteminfo[uv]=="0") $uv=""; else $uv="����.: <b>+$iteminfo[uv]%</b><br>";
							if ($iteminfo[unuv]=="0") $unuv=""; else $unuv="��������.: <b>+$iteminfo[unuv]%</b><br>";

							if ($iteminfo[hp]=="0") $hp=""; else $hp="�����: <b>+$iteminfo[hp]</b><br>";

							###


							?>