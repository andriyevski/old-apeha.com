<?

###МИНИМАЛЬНЫЕ ТРЕБОВАНИЯ

// Проверка уровня
if ($iteminfo['min_level'] == "0") $min_level=""; else {
	if ($stat[level]<"$iteminfo[min_level]") $min_level="<font color=red>Уровень: <b>$iteminfo[min_level]</b></font><br>"; else $min_level="Уровень: <b>$iteminfo[min_level]</b><br>"; }

	// Проверка силы
	if ($iteminfo[min_str]=="0") $min_str=""; else {
		if ($stat[strength]<"$iteminfo[min_str]") $min_str="<font color=red>Сила: <b>$iteminfo[min_str]</b></font><br>"; else $min_str="Сила: <b>$iteminfo[min_str]</b><br>"; }

		// Проверка ловкости
		if ($iteminfo[min_ag]=="0") $min_dex=""; else {
			if ($stat[agility]<"$iteminfo[min_ag]") $min_dex="<font color=red>Ловкость: <b>$iteminfo[min_ag]</b></font><br>"; else $min_dex="Ловкость: <b>$iteminfo[min_ag]</b><br>"; }

			// Проверка удачи
			if ($iteminfo[min_dex]=="0") $min_ag=""; else {
				if ($stat[dex]<"$iteminfo[min_dex]") $min_ag="<font color=red>Удача: <b>$iteminfo[min_dex]</b></font><br>"; else $min_ag="Удача: <b>$iteminfo[min_dex]</b><br>"; }

				// Проверка выносливости
				if ($iteminfo[min_vit]=="0") $min_vit=""; else {
					if ($stat[vitality]<"$iteminfo[min_vit]") $min_vit="<font color=red>Выносливость: <b>$iteminfo[min_vit]</b></font><br>"; else $min_vit="Выносливость: <b>$iteminfo[min_vit]</b><br>"; }

					// Проверка разума
					if ($iteminfo['min_razum'] == 0) $min_razum=""; else {
						if ($stat['razum'] < $iteminfo['min_razum']) $min_razum="<font color=red>Разум: <b>$iteminfo[min_razum]</b></font><br>"; else $min_razum="Разум: <b>$iteminfo[min_razum]</b><br>"; }


						// Проверка расы
						if ($iteminfo['min_rase']) {

							switch ($iteminfo['min_rase']) {
								case 1: $rs="Орк"; break;
								case 2: $rs="Эльф"; break;
								case 3: $rs="Человек"; break;
								case 4: $rs="Гном"; break;
								case 100: $rs="Ангел"; break;
							}

							if ($iteminfo['min_rase'] != $stat['rase']) $min_rase="<font color=red>Раса: <b>$rs</b></font><br>"; else $min_rase="Раса: <b>$rs</b><br>";

						}


						// Проверка професии
						if ($iteminfo['min_proff'] == 0) $min_proff=""; else {

							switch ($iteminfo['min_proff']) {
								case 1: $prf="Лекарь"; break;
								case 1: $prf="Лекарь"; break;
								case 2: $prf="Кузнец"; break;
								case 3: $prf="Огранщик"; break;
								case 4: $prf="Рудокоп"; break;
								case 5: $prf="Наёмник"; break;

								case 8: $prf="Жрец"; break;
								default: $prf="нет"; break;
							}

							if ($stat['proff'] != $iteminfo['min_proff']) $min_proff="<font color=red>Профессия: $prf</font><br>"; else $min_proff="Профессия: <b>$prf</b><br>"; }


							####


							###ДЕЙСТВИЕ

							if ($iteminfo[min]=="0" || $iteminfo[max]=="0") $uron=""; else $uron="Урон: <b>+$iteminfo[min]</b>... <b>+$iteminfo[max]</b><br>";

							if ($iteminfo[br1]=="0") $br1=""; else $br1="Броня головы: <b>+$iteminfo[br1]</b><br>";
							if ($iteminfo[br2]=="0") $br2=""; else $br2="Броня корпуса: <b>+$iteminfo[br2]</b><br>";
							if ($iteminfo[br3]=="0") $br3=""; else $br3="Броня живота: <b>+$iteminfo[br3]</b><br>";
							if ($iteminfo[br4]=="0") $br4=""; else $br4="Броня пояса: <b>+$iteminfo[br4]</b><br>";
							if ($iteminfo[br5]=="0") $br5=""; else $br5="Броня ног: <b>+$iteminfo[br5]</b><br>";

							if ($iteminfo[strength]=="0") $strength=""; else $strength="Сила: <b>+$iteminfo[strength]</b><br>";
							if ($iteminfo[agility]=="0") $dex=""; else $dex="Ловкость: <b>+$iteminfo[agility]</b><br>";
							if ($iteminfo[dex]=="0") $agility=""; else $agility="Удача: <b>+$iteminfo[dex]</b><br>";
							if ($iteminfo[vitality]=="0") $vitality=""; else $vitality="Выносливость: <b>+$iteminfo[vitality]</b><br>";
							if ($iteminfo[razum]=="0") $razum=""; else $razum="Разум: <b>+$iteminfo[razum]</b><br>";

							if ($iteminfo[krit]=="0") $krit=""; else $krit="Крит. удара: <b>+$iteminfo[krit]%</b><br>";
							if ($iteminfo[unkrit]=="0") $unkrit=""; else $unkrit="Антикрит. удара: <b>+$iteminfo[unkrit]%</b><br>";
							if ($iteminfo[uv]=="0") $uv=""; else $uv="Увёрт.: <b>+$iteminfo[uv]%</b><br>";
							if ($iteminfo[unuv]=="0") $unuv=""; else $unuv="Антиувёрт.: <b>+$iteminfo[unuv]%</b><br>";

							if ($iteminfo[hp]=="0") $hp=""; else $hp="Жизни: <b>+$iteminfo[hp]</b><br>";

							###


							?>