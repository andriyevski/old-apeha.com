<?

###МИНИМАЛЬНЫЕ ТРЕБОВАНИЯ

// Проверка уровня
if ($iteminfo[min_level]=="0") $min_level=""; else {
	$min_level="Уровень: $iteminfo[min_level]<br>"; }

	// Проверка силы
	if ($iteminfo[min_str]=="0") $min_str=""; else {
		$min_str="Сила: $iteminfo[min_str]<br>"; }

		// Проверка удачи
		if ($iteminfo[min_dex]=="0") $min_dex=""; else {
			$min_dex="Удача: $iteminfo[min_dex]<br>"; }

			// Проверка проворства
			if ($iteminfo[min_ag]=="0") $min_ag=""; else {
				$min_ag="Проворство: $iteminfo[min_ag]<br>"; }

				// Проверка живучести
				if ($iteminfo[min_vit]=="0") $min_vit=""; else {
					$min_vit="Выносливость: $iteminfo[min_vit]<br>"; }


					// Проверка расы
					if ($iteminfo[min_rase]=="0") $min_rase=""; else {

						if ($iteminfo[min_rase]=="1") $rs="Орк";
						elseif ($iteminfo[min_rase]=="2") $rs="Эльф";
						elseif ($iteminfo[min_rase]=="3") $rs="Человек";
						elseif ($iteminfo[min_rase]=="4") $rs="Гном";
						elseif ($iteminfo[min_rase]=="100") $rs="Ангел";

						$min_rase="Раса: <b>$rs</b><br>"; }

						####


						?>