<?

###МИНИМАЛЬНЫЕ ТРЕБОВАНИЯ

// Проверка уровня
if ($obj_min[0]=="0") $min_level=""; else {
	if ($stat[level]<"$obj_min[0]") $min_level="<font color=red>Уровень: <b>$obj_min[0]</b></font><br>"; else $min_level="Уровень: <b>$obj_min[0]</b><br>"; }

	// Проверка силы
	if ($obj_min[1]=="0") $min_str=""; else {
		if ($stat[strength]<"$obj_min[1]") $min_str="<font color=red>Сила: <b>$obj_min[1]</b></font><br>"; else $min_str="Сила: <b>$obj_min[1]</b><br>"; }

		// Проверка удачи
		if ($obj_min[2]=="0") $min_dex=""; else {
			if ($stat[dex]<"$obj_min[2]") $min_dex="<font color=red>Удача: <b>$obj_min[2]</b></font><br>"; else $min_dex="Удача: <b>$obj_min[2]</b><br>"; }

			// Проверка проворства
			if ($obj_min[3]=="0") $min_ag=""; else {
				if ($stat[agility]<"$obj_min[3]") $min_ag="<font color=red>Ловкость: <b>$obj_min[3]</b></font><br>"; else $min_ag="Ловкость: <b>$obj_min[3]</b><br>"; }

				// Проверка живучести
				if ($obj_min[4]=="0") $min_vit=""; else {
					if ($stat[vitality]<"$obj_min[4]") $min_vit="<font color=red>Выносливость: <b>$obj_min[4]</b></font><br>"; else $min_vit="Выносливость: <b>$obj_min[4]</b><br>"; }

					// Проверка разума
					if ($obj_min[5]=="0") $min_razum=""; else {
						if ($stat[razum]<"$obj_min[5]") $min_razum="<font color=red>Разум: <b>$obj_min[5]</b></font><br>"; else $min_razum="Разум: <b>$obj_min[5]</b><br>"; }


						// Проверка професии
						if ($obj_min['7'] == 0) $min_proff=""; else {

							switch ($obj_min['7']) {
								case 1: $prf="Лекарь"; break;
								case 2: $prf="Кузнец"; break;
								case 3: $prf="Огранщик"; break;
								case 4: $prf="Рудокоп"; break;
								case 5: $prf="Наёмник"; break;

								case 8: $prf="Жрец"; break;
								default: $prf="нет"; break;
							}

							if ($stat['proff'] != $obj_min['7']) $min_proff="<font color=red>Профессия: <b>$prf</b></font><br>"; else $min_proff="Профессия: <b>$prf</b><br>"; }



							// Проверка расы
							if ($obj_min[6]=="0") $min_rase=""; else {

								if ($stat[rase]!="$iteminfo[rase]") {

									switch ($obj_min[6]) {
										case 1: $rs="Орк"; break;
										case 2: $rs="Эльф"; break;
										case 3: $rs="Человек"; break;
										case 4: $rs="Гном"; break;
										case 100: $rs="Ангел"; break;
									}

									if ($stat[rase]!="100" and $stat[rase]!="$obj_min[6]") $min_rase="<font color=red>Раса: <b>$rs</b></font><br>"; else $min_rase="Раса: <b>$rs</b><br>"; }}

									####

									?>