<?

###����������� ����������

// �������� ������
if ($obj_min[0]=="0") $min_level=""; else {
	if ($stat[level]<"$obj_min[0]") $min_level="<font color=red>�������: <b>$obj_min[0]</b></font><br>"; else $min_level="�������: <b>$obj_min[0]</b><br>"; }

	// �������� ����
	if ($obj_min[1]=="0") $min_str=""; else {
		if ($stat[strength]<"$obj_min[1]") $min_str="<font color=red>����: <b>$obj_min[1]</b></font><br>"; else $min_str="����: <b>$obj_min[1]</b><br>"; }

		// �������� �����
		if ($obj_min[2]=="0") $min_dex=""; else {
			if ($stat[dex]<"$obj_min[2]") $min_dex="<font color=red>�����: <b>$obj_min[2]</b></font><br>"; else $min_dex="�����: <b>$obj_min[2]</b><br>"; }

			// �������� ����������
			if ($obj_min[3]=="0") $min_ag=""; else {
				if ($stat[agility]<"$obj_min[3]") $min_ag="<font color=red>��������: <b>$obj_min[3]</b></font><br>"; else $min_ag="��������: <b>$obj_min[3]</b><br>"; }

				// �������� ���������
				if ($obj_min[4]=="0") $min_vit=""; else {
					if ($stat[vitality]<"$obj_min[4]") $min_vit="<font color=red>������������: <b>$obj_min[4]</b></font><br>"; else $min_vit="������������: <b>$obj_min[4]</b><br>"; }

					// �������� ������
					if ($obj_min[5]=="0") $min_razum=""; else {
						if ($stat[razum]<"$obj_min[5]") $min_razum="<font color=red>�����: <b>$obj_min[5]</b></font><br>"; else $min_razum="�����: <b>$obj_min[5]</b><br>"; }


						// �������� ��������
						if ($obj_min['7'] == 0) $min_proff=""; else {

							switch ($obj_min['7']) {
								case 1: $prf="������"; break;
								case 2: $prf="������"; break;
								case 3: $prf="��������"; break;
								case 4: $prf="�������"; break;
								case 5: $prf="������"; break;

								case 8: $prf="����"; break;
								default: $prf="���"; break;
							}

							if ($stat['proff'] != $obj_min['7']) $min_proff="<font color=red>���������: <b>$prf</b></font><br>"; else $min_proff="���������: <b>$prf</b><br>"; }



							// �������� ����
							if ($obj_min[6]=="0") $min_rase=""; else {

								if ($stat[rase]!="$iteminfo[rase]") {

									switch ($obj_min[6]) {
										case 1: $rs="���"; break;
										case 2: $rs="����"; break;
										case 3: $rs="�������"; break;
										case 4: $rs="����"; break;
										case 100: $rs="�����"; break;
									}

									if ($stat[rase]!="100" and $stat[rase]!="$obj_min[6]") $min_rase="<font color=red>����: <b>$rs</b></font><br>"; else $min_rase="����: <b>$rs</b><br>"; }}

									####

									?>