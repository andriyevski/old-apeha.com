<?

###����������� ����������

// �������� ������
if ($iteminfo[min_level]=="0") $min_level=""; else {
	$min_level="�������: $iteminfo[min_level]<br>"; }

	// �������� ����
	if ($iteminfo[min_str]=="0") $min_str=""; else {
		$min_str="����: $iteminfo[min_str]<br>"; }

		// �������� �����
		if ($iteminfo[min_dex]=="0") $min_dex=""; else {
			$min_dex="�����: $iteminfo[min_dex]<br>"; }

			// �������� ����������
			if ($iteminfo[min_ag]=="0") $min_ag=""; else {
				$min_ag="����������: $iteminfo[min_ag]<br>"; }

				// �������� ���������
				if ($iteminfo[min_vit]=="0") $min_vit=""; else {
					$min_vit="������������: $iteminfo[min_vit]<br>"; }


					// �������� ����
					if ($iteminfo[min_rase]=="0") $min_rase=""; else {

						if ($iteminfo[min_rase]=="1") $rs="���";
						elseif ($iteminfo[min_rase]=="2") $rs="����";
						elseif ($iteminfo[min_rase]=="3") $rs="�������";
						elseif ($iteminfo[min_rase]=="4") $rs="����";
						elseif ($iteminfo[min_rase]=="100") $rs="�����";

						$min_rase="����: <b>$rs</b><br>"; }

						####


						?>