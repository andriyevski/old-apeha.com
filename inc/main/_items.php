<?


###����������� ����������

// �������� ������
if ($iteminfo[min_level]=="0") $min_level=""; else {
	if ($stat[level]<"$iteminfo[min_level]") $min_level="<font color=red>�������: $iteminfo[min_level]</font><br>"; else $min_level="�������: $iteminfo[min_level]<br>"; }

	// �������� ����
	if ($iteminfo[min_str]=="0") $min_str=""; else {
		if ($stat[strength]<"$iteminfo[min_str]") $min_str="<font color=red>����: $iteminfo[min_str]</font><br>"; else $min_str="����: $iteminfo[min_str]<br>"; }

		// �������� �����
		if ($iteminfo[min_dex]=="0") $min_dex=""; else {
			if ($stat[dex]<"$iteminfo[min_dex]") $min_dex="<font color=red>��������: $iteminfo[min_dex]</font><br>"; else $min_dex="��������: $iteminfo[min_dex]<br>"; }

			// �������� ����������
			if ($iteminfo[min_ag]=="0") $min_ag=""; else {
				if ($stat[agility]<"$iteminfo[min_ag]") $min_ag="<font color=red>�����: $iteminfo[min_ag]</font><br>"; else $min_ag="�����: $iteminfo[min_ag]<br>"; }

				// �������� ���������
				if ($iteminfo[min_vit]=="0") $min_vit=""; else {
					if ($stat[vitality]<"$iteminfo[min_vit]") $min_vit="<font color=red>������������: $iteminfo[min_vit]</font><br>"; else $min_vit="������������: $iteminfo[min_vit]<br>"; }





					// �������� ����
					if ($iteminfo[min_rase]=="0") $min_rase=""; else {

						if ($stat[rase]!="$iteminfo[rase]") {

							if ($iteminfo[min_rase]=="1") $rs="���";
							elseif ($iteminfo[min_rase]=="2") $rs="����";
							elseif ($iteminfo[min_rase]=="3") $rs="�������";
							elseif ($iteminfo[min_rase]=="4") $rs="����";
							elseif ($iteminfo[min_rase]=="100") $rs="�����";

							if ($stat[rase]!="100") $min_rase="<font color=red>����: <b>$rs</b></font><br>"; else $min_rase="����: <b>$rs</b><br>"; }}

							####


							###��������

							if ($iteminfo[min]=="0") $min=""; else $min="����������� ����: +$iteminfo[min]<br>";
							if ($iteminfo[max]=="0") $max=""; else $max="������������ ����: +$iteminfo[max]<br>";

							if ($iteminfo[br1]=="0") $br1=""; else $br1="����� ������: +$iteminfo[br1]<br>";
							if ($iteminfo[br2]=="0") $br2=""; else $br2="����� ������: +$iteminfo[br2]<br>";
							if ($iteminfo[br3]=="0") $br3=""; else $br3="����� ���: +$iteminfo[br3]<br>";
							if ($iteminfo[br4]=="0") $br4=""; else $br4="����� �����: +$iteminfo[br4]<br>";
							if ($iteminfo[br5]=="0") $br5=""; else $br5="����� ���: +$iteminfo[br5]<br>";

							if ($iteminfo[strength]=="0") $strength=""; else $strength="����: +$iteminfo[strength]<br>";
							if ($iteminfo[dex]=="0") $dex=""; else $dex="��������: +$iteminfo[dex]<br>";
							if ($iteminfo[agility]=="0") $agility=""; else $agility="�����: +$iteminfo[agility]<br>";
							if ($iteminfo[vitality]=="0") $vitality=""; else $vitality="������������: +$iteminfo[vitality]<br>";
							if ($iteminfo[razum]=="0") $razum=""; else $razum="�����: +$iteminfo[razum]<br>";

							if ($iteminfo[krit]=="0") $krit=""; else $krit="������������ �����: +$iteminfo[krit]%<br>";
							if ($iteminfo[unkrit]=="0") $unkrit=""; else $unkrit="������ ������������ �����: +$iteminfo[unkrit]%<br>";
							if ($iteminfo[uv]=="0") $uv=""; else $uv="�����������: +$iteminfo[uv]%<br>";
							if ($iteminfo[unuv]=="0") $unuv=""; else $unuv="������ �����������: +$iteminfo[unuv]%<br>";

							if ($iteminfo[hp]=="0") $hp=""; else $hp="������� �����: +$iteminfo[hp]<br>";
							if ($iteminfo[energy]=="0") $energy=""; else $energy="������� �������: +$iteminfo[energy]<br>";

							###


							?>