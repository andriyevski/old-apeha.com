<?
// ----- # ������ ��������� # ----- //
if ($iteminfo['name'] == "attack") {
	if (!$stat['battle']) include("inc/magic/attack.php");
	else $nms="�� �� ������ ������������ ����������, �.�. �� ���������� � ��������!";
}

// ----- # ������ ��������� � ���� # ----- //
if ($iteminfo['name'] == "more_attack") {
	if (!$stat['battle']) include("inc/magic/more_attack.php");
	else $nms="�� �� ������ ������������ ����������, �.�. �� ���������� � ��������!";
}

// ----- # ������ �������� ��������� # ----- //
if ($iteminfo['name'] == "more_telep") {
	include("inc/magic/more_telep.php");
}


// ----- # ��������� # ----- //
if ($iteminfo['name'] == "complect_nebesnihsvetil") {include("inc/magic/complect.php");}


// ----- # ������ ������ ������ # ----- //
if ($iteminfo['name'] == "reset") {
	if (!$stat['battle']) include("inc/magic/reset.php");
	else $nms="�� �� ������ ������������ ����������, �.�. �� ���������� � ��������!";
}

// ----- # ������ ������ ������������ # ----- //
if ($iteminfo['name'] == "resetx") {
	if (!$stat['battle']) include("inc/magic/resetx.php");
	else $nms="�� �� ������ ������������ ����������, �.�. �� ���������� � ��������!";
}

// ----- # ������ ������� �� ������� # ----- //
if ($iteminfo['name'] == "elik_strength") {
	include("inc/magic/elik_strength.php");
}
// ----- # ������ ������� �� ������� # ----- //
if ($iteminfo['name'] == "elik_agility") {
	include("inc/magic/elik_agility.php");
}
// ----- # ������ ������� �� ������� # ----- //
if ($iteminfo['name'] == "elik_dex") {
	include("inc/magic/elik_dex.php");
}
// ----- # ������ ������� �� ������� # ----- //
if ($iteminfo['name'] == "elik_vitality") {
	include("inc/magic/elik_vitality.php");
}
// ----- # ������� ����� # ----- //
if ($iteminfo['name'] == "elik_br20") {
	include("inc/magic/elik_br20.php");
}


// ----- # ������ ������� ���������� 1 # ----- //
if ($iteminfo['name'] == "unset") {
	include("inc/magic/unset.php");
}

// ----- # ������ ������� ���������� 10 # ----- //
if ($iteminfo['name'] == "unset10") {
	include("inc/magic/unset10.php");
}

// ----- # ������ ��������� # ----- //
if ($iteminfo['name'] == "blood_attack") {
	if (!$stat['battle']) include("inc/magic/blood_attack.php");
	else $nms="�� �� ������ ������������ ����������, �.�. �� ���������� � ��������!";
}

// ----- # ������ �������������� HP # ----- //
if ($iteminfo['name'] == "addhp100" || $iteminfo['name'] == "addhp200" || $iteminfo['name'] == "addhp300" || $iteminfo['name'] == "addhp400" || $iteminfo['name'] == "addhp500") {
	include("inc/magic/addhp.php");
}

// ----- # ������ �������������� ������� # ----- //
if ($iteminfo['name'] == "addenergy20" || $iteminfo['name'] == "addenergy40" || $iteminfo['name'] == "addenergy60" || $iteminfo['name'] == "addenergy100") {
	include("inc/magic/addenergy.php");
}

// ----- # ������ ����� ����� # ----- //
if ($iteminfo['name'] == "water10" || $iteminfo['name'] == "water20") {
	include("inc/magic/water.php");
}

// ----- # ������ ������ ������ # ----- //
if ($iteminfo['name'] == "reset") {
	if (!$stat['battle']) include("inc/magic/reset.php");
	else $nms="�� �� ������ ������������ ����������, �.�. �� ���������� � ��������!";
}

// ----- # ������ ����������� # ----- //
if ($iteminfo['name'] == "invisible") {
	include("inc/magic/invisible.php");
}
// ----- # ������ ���������� # ----- //
if ($iteminfo['name'] == "immun") {
	include("inc/magic/immun.php");
}

// ----- # ������ ������� # ----- //
if ($iteminfo['name'] == "mutation") {
	include("inc/magic/mutation.php");
}

// ----- # ������ ��������� �� ����� # ----- //
if ($iteminfo['name'] == "healing1") {
	include("inc/magic/healing.php");
}

// ----- # ������ ������� �� ������� # ----- //
if ($iteminfo['name'] == "mol") {
	include("inc/magic/mol.php");
}

// ----- # ������ # ----- //
if ($iteminfo['name'] == "snegok") {
	include("inc/magic/snegok.php");
}




?>