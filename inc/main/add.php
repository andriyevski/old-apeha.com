<?

###��������

if ($objects['min_d']=="0" || $objects['max_d']=="0") $uron=""; else $uron="����: <b>+$objects[min_d]</b>... <b>+$objects[max_d]</b><br>";

if ($objects['br1']=="0") $br1=""; else $br1="����� ������: <b>+$objects[br1]</b><br>";
if ($objects['br2']=="0") $br2=""; else $br2="����� ������: <b>+$objects[br2]</b><br>";
if ($objects['br3']=="0") $br3=""; else $br3="����� ������: <b>+$objects[br3]</b><br>";
if ($objects['br4']=="0") $br4=""; else $br4="����� �����: <b>+$objects[br4]</b><br>";
if ($objects['br5']=="0") $br5=""; else $br5="����� ���: <b>+$objects[br5]</b><br>";

if ($objects['strength']=="0") $strength=""; else $strength="����: <b>+$objects[strength]</b><br>";
if ($objects['agility']=="0") $agility=""; else $agility="��������: <b>+$objects[agility]</b><br>";
if ($objects['dex']=="0") $dex=""; else $dex="�����: <b>+$objects[dex]</b><br>";
if ($objects['vitality']=="0") $vitality=""; else $vitality="������������: <b>+$objects[vitality]</b><br>";
if ($objects['razum']=="0") $razum=""; else $razum="�����: <b>+$objects[razum]</b><br>";

if ($objects['krit']=="0") $krit=""; else $krit="������������ �����: <b>+$objects[krit]%</b><br>";
if ($objects['unkrit']=="0") $unkrit=""; else $unkrit="������ ������������ �����: <b>+$objects[unkrit]%</b><br>";
if ($objects['uv']=="0") $uv=""; else $uv="�����������: <b>+$objects[uv]%</b><br>";
if ($objects['unuv']=="0") $unuv=""; else $unuv="������ �����������: <b>+$objects[unuv]%</b><br>";

if ($objects['hp']=="0") $hp=""; else $hp="������� �����: <b>+$objects[hp]</b><br>";
if ($objects['energy']=="0") $energy=""; else $energy="������� �������: <b>+$objects[energy]</b><br>";

?>