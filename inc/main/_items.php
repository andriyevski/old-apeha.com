<?


###МИНИМАЛЬНЫЕ ТРЕБОВАНИЯ

// Проверка уровня
if ($iteminfo[min_level]=="0") $min_level=""; else {
	if ($stat[level]<"$iteminfo[min_level]") $min_level="<font color=red>Уровень: $iteminfo[min_level]</font><br>"; else $min_level="Уровень: $iteminfo[min_level]<br>"; }

	// Проверка силы
	if ($iteminfo[min_str]=="0") $min_str=""; else {
		if ($stat[strength]<"$iteminfo[min_str]") $min_str="<font color=red>Сила: $iteminfo[min_str]</font><br>"; else $min_str="Сила: $iteminfo[min_str]<br>"; }

		// Проверка удачи
		if ($iteminfo[min_dex]=="0") $min_dex=""; else {
			if ($stat[dex]<"$iteminfo[min_dex]") $min_dex="<font color=red>Ловкость: $iteminfo[min_dex]</font><br>"; else $min_dex="Ловкость: $iteminfo[min_dex]<br>"; }

			// Проверка проворства
			if ($iteminfo[min_ag]=="0") $min_ag=""; else {
				if ($stat[agility]<"$iteminfo[min_ag]") $min_ag="<font color=red>Удача: $iteminfo[min_ag]</font><br>"; else $min_ag="Удача: $iteminfo[min_ag]<br>"; }

				// Проверка живучести
				if ($iteminfo[min_vit]=="0") $min_vit=""; else {
					if ($stat[vitality]<"$iteminfo[min_vit]") $min_vit="<font color=red>Выносливость: $iteminfo[min_vit]</font><br>"; else $min_vit="Выносливость: $iteminfo[min_vit]<br>"; }





					// Проверка расы
					if ($iteminfo[min_rase]=="0") $min_rase=""; else {

						if ($stat[rase]!="$iteminfo[rase]") {

							if ($iteminfo[min_rase]=="1") $rs="Орк";
							elseif ($iteminfo[min_rase]=="2") $rs="Эльф";
							elseif ($iteminfo[min_rase]=="3") $rs="Человек";
							elseif ($iteminfo[min_rase]=="4") $rs="Гном";
							elseif ($iteminfo[min_rase]=="100") $rs="Ангел";

							if ($stat[rase]!="100") $min_rase="<font color=red>Раса: <b>$rs</b></font><br>"; else $min_rase="Раса: <b>$rs</b><br>"; }}

							####


							###ДЕЙСТВИЕ

							if ($iteminfo[min]=="0") $min=""; else $min="Минимальный урон: +$iteminfo[min]<br>";
							if ($iteminfo[max]=="0") $max=""; else $max="Максимальный урон: +$iteminfo[max]<br>";

							if ($iteminfo[br1]=="0") $br1=""; else $br1="Броня головы: +$iteminfo[br1]<br>";
							if ($iteminfo[br2]=="0") $br2=""; else $br2="Броня копуса: +$iteminfo[br2]<br>";
							if ($iteminfo[br3]=="0") $br3=""; else $br3="Броня рук: +$iteminfo[br3]<br>";
							if ($iteminfo[br4]=="0") $br4=""; else $br4="Броня пояса: +$iteminfo[br4]<br>";
							if ($iteminfo[br5]=="0") $br5=""; else $br5="Броня ног: +$iteminfo[br5]<br>";

							if ($iteminfo[strength]=="0") $strength=""; else $strength="Сила: +$iteminfo[strength]<br>";
							if ($iteminfo[dex]=="0") $dex=""; else $dex="Ловкость: +$iteminfo[dex]<br>";
							if ($iteminfo[agility]=="0") $agility=""; else $agility="Удача: +$iteminfo[agility]<br>";
							if ($iteminfo[vitality]=="0") $vitality=""; else $vitality="Выносливость: +$iteminfo[vitality]<br>";
							if ($iteminfo[razum]=="0") $razum=""; else $razum="Разум: +$iteminfo[razum]<br>";

							if ($iteminfo[krit]=="0") $krit=""; else $krit="Критического удара: +$iteminfo[krit]%<br>";
							if ($iteminfo[unkrit]=="0") $unkrit=""; else $unkrit="Против критического удара: +$iteminfo[unkrit]%<br>";
							if ($iteminfo[uv]=="0") $uv=""; else $uv="Увёртливости: +$iteminfo[uv]%<br>";
							if ($iteminfo[unuv]=="0") $unuv=""; else $unuv="Против увёртливости: +$iteminfo[unuv]%<br>";

							if ($iteminfo[hp]=="0") $hp=""; else $hp="Уровень жизни: +$iteminfo[hp]<br>";
							if ($iteminfo[energy]=="0") $energy=""; else $energy="Уровень энергии: +$iteminfo[energy]<br>";

							###


							?>