<?


###МИНИМАЛЬНЫЕ ТРЕБОВАНИЯ

// Проверка уровня
if ($obj_infi['0'] == "0") $min_level=""; else {
	if ($stat[level]<"$obj_infi[0]") $min_level="<font color=red>Уровень: <b>$obj_infi[0]</b></font><br>"; else $min_level="Уровень: <b>$obj_infi[0]</b><br>"; }

	// Проверка силы
	if ($obj_infi[1]=="0") $min_str=""; else {
		if ($stat[strength]<"$obj_infi[1]") $min_str="<font color=red>Сила: <b>$obj_infi[1]</b></font><br>"; else $min_str="Сила: <b>$obj_infi[1]</b><br>"; }

		// Проверка ловкости
		if ($obj_infi[2]=="0") $min_dex=""; else {
			if ($stat[dex]<"$obj_infi[2]") $min_dex="<font color=red>Ловкость: <b>$obj_infi[2]</b></font><br>"; else $min_dex="Ловкость: <b>$obj_infi[2]</b><br>"; }

			// Проверка удачи
			if ($obj_infi[3]=="0") $min_ag=""; else {
				if ($stat[agility]<"$obj_infi[3]") $min_ag="<font color=red>Удача: <b>$obj_infi[3]</b></font><br>"; else $min_ag="Удача: <b>$obj_infi[3]</b><br>"; }

				// Проверка выносливости
				if ($obj_infi[4]=="0") $min_vit=""; else {
					if ($stat[vitality]<"$obj_infi[4]") $min_vit="<font color=red>Выносливость: <b>$obj_infi[4]</b></font><br>"; else $min_vit="Выносливость: <b>$obj_infi[4]</b><br>"; }

					// Проверка разума
					if ($obj_infi[5] == 0) $min_razum=""; else {
						if ($stat['razum'] < $obj_infi[5]) $min_razum="<font color=red>Разум: <b>$obj_infi[5]</b></font><br>"; else $min_razum="Разум: <b>$obj_infi[5]</b><br>"; }



						// Проверка професии
						if ($obj_infi['7'] == 0) $min_proff=""; else {

							switch ($obj_infi[7]) {
								case 1: $prf="Лекарь"; break;
								case 2: $prf="Провожатый"; break;
								case 3: $prf="Кузнец"; break;
								case 4: $prf="Жрец"; break;
								case 5: $prf="Наёмник"; break;
								case 8: $prf="Архимаг"; break;
							}

							if ($stat['proff'] != $obj_infi['7']) $min_proff="<font color=red>Профессия: $prf</b></font><br>"; else $min_proff="Профессия: $prf</b><br>"; }

							// Проверка расы
							if ($obj_infi[6]=="0") $min_rase=""; else {

								if ($stat[rase]!="$iteminfo[rase]") {

									switch ($obj_infi[6]) {
										case 1: $rs="Орк"; break;
										case 2: $rs="Эльф"; break;
										case 3: $rs="Человек"; break;
										case 4: $rs="Гном"; break;
										case 100: $rs="Ангел"; break;
									}

									if ($stat[rase]!="100" and $stat[rase]!="$obj_infi[6]") $min_rase="<font color=red>Раса: <b>$rs</b></font><br>"; else $min_rase="Раса: <b>$rs</b><br>"; }}


									####


									###ДЕЙСТВИЕ

									if ($iteminfo['min_d']=="0" || $iteminfo['max_d']=="0") $uron=""; else $uron="Урон: <b>+$iteminfo[min_d]</b>... <b>+$iteminfo[max_d]</b><br>";

									if ($iteminfo['br1']=="0") $br1=""; else $br1="Броня головы: <b>+$iteminfo[br1]</b><br>";
									if ($iteminfo['br2']=="0") $br2=""; else $br2="Броня копуса: <b>+$iteminfo[br2]</b><br>";
									if ($iteminfo['br3']=="0") $br3=""; else $br3="Броня живота: <b>+$iteminfo[br3]</b><br>";
									if ($iteminfo['br4']=="0") $br4=""; else $br4="Броня пояса: <b>+$iteminfo[br4]</b><br>";
									if ($iteminfo['br5']=="0") $br5=""; else $br5="Броня ног: <b>+$iteminfo[br5]</b><br>";

									if ($iteminfo['strength']=="0") $strength=""; else $strength="Сила: <b>+$iteminfo[strength]</b><br>";
									if ($iteminfo['agility']=="0") $agility=""; else $agility="Ловкость: <b>+$iteminfo[agility]</b><br>";
									if ($iteminfo['dex']=="0") $dex=""; else $dex="Удача: <b>+$iteminfo[dex]</b><br>";

									if ($iteminfo['vitality']=="0") $vitality=""; else $vitality="Выносливость: <b>+$iteminfo[vitality]</b><br>";
									if ($iteminfo['razum']=="0") $razum=""; else $razum="Разум: <b>+$iteminfo[razum]</b><br>";

									if ($iteminfo['krit']=="0") $krit=""; else $krit="Критического удара: <b>+$iteminfo[krit]%</b><br>";
									if ($iteminfo['unkrit']=="0") $unkrit=""; else $unkrit="Против критического удара: <b>+$iteminfo[unkrit]%</b><br>";
									if ($iteminfo['uv']=="0") $uv=""; else $uv="Увёртливости: <b>+$iteminfo[uv]%</b><br>";
									if ($iteminfo['unuv']=="0") $unuv=""; else $unuv="Против увёртливости: <b>+$iteminfo[unuv]%</b><br>";

									if ($iteminfo['hp']=="0") $hp=""; else $hp="Уровень жизни: <b>+$iteminfo[hp]</b><br>";
									if ($iteminfo['energy']=="0") $energy=""; else $energy="Уровень энергии: <b>+$iteminfo[energy]</b><br>";

									###


									?>