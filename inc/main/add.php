<?

###ДЕЙСТВИЕ

if ($objects['min_d']=="0" || $objects['max_d']=="0") $uron=""; else $uron="Урон: <b>+$objects[min_d]</b>... <b>+$objects[max_d]</b><br>";

if ($objects['br1']=="0") $br1=""; else $br1="Броня головы: <b>+$objects[br1]</b><br>";
if ($objects['br2']=="0") $br2=""; else $br2="Броня копуса: <b>+$objects[br2]</b><br>";
if ($objects['br3']=="0") $br3=""; else $br3="Броня живота: <b>+$objects[br3]</b><br>";
if ($objects['br4']=="0") $br4=""; else $br4="Броня пояса: <b>+$objects[br4]</b><br>";
if ($objects['br5']=="0") $br5=""; else $br5="Броня ног: <b>+$objects[br5]</b><br>";

if ($objects['strength']=="0") $strength=""; else $strength="Сила: <b>+$objects[strength]</b><br>";
if ($objects['agility']=="0") $agility=""; else $agility="Ловкость: <b>+$objects[agility]</b><br>";
if ($objects['dex']=="0") $dex=""; else $dex="Удача: <b>+$objects[dex]</b><br>";
if ($objects['vitality']=="0") $vitality=""; else $vitality="Выносливость: <b>+$objects[vitality]</b><br>";
if ($objects['razum']=="0") $razum=""; else $razum="Разум: <b>+$objects[razum]</b><br>";

if ($objects['krit']=="0") $krit=""; else $krit="Критического удара: <b>+$objects[krit]%</b><br>";
if ($objects['unkrit']=="0") $unkrit=""; else $unkrit="Против критического удара: <b>+$objects[unkrit]%</b><br>";
if ($objects['uv']=="0") $uv=""; else $uv="Увёртливости: <b>+$objects[uv]%</b><br>";
if ($objects['unuv']=="0") $unuv=""; else $unuv="Против увёртливости: <b>+$objects[unuv]%</b><br>";

if ($objects['hp']=="0") $hp=""; else $hp="Уровень жизни: <b>+$objects[hp]</b><br>";
if ($objects['energy']=="0") $energy=""; else $energy="Уровень энергии: <b>+$objects[energy]</b><br>";

?>