<?
// ----- # Свиток нападения # ----- //
if ($iteminfo['name'] == "attack") {
	if (!$stat['battle']) include("inc/magic/attack.php");
	else $nms="Вы не можете использовать заклинание, т.к. Вы находитесь в поединке!";
}

// ----- # Свиток нападения в море # ----- //
if ($iteminfo['name'] == "more_attack") {
	if (!$stat['battle']) include("inc/magic/more_attack.php");
	else $nms="Вы не можете использовать заклинание, т.к. Вы находитесь в поединке!";
}

// ----- # Свиток морского телепорта # ----- //
if ($iteminfo['name'] == "more_telep") {
	include("inc/magic/more_telep.php");
}


// ----- # Комплееты # ----- //
if ($iteminfo['name'] == "complect_nebesnihsvetil") {include("inc/magic/complect.php");}


// ----- # Свиток сброса статов # ----- //
if ($iteminfo['name'] == "reset") {
	if (!$stat['battle']) include("inc/magic/reset.php");
	else $nms="Вы не можете использовать заклинание, т.к. Вы находитесь в поединке!";
}

// ----- # Свиток сброса особенностей # ----- //
if ($iteminfo['name'] == "resetx") {
	if (!$stat['battle']) include("inc/magic/resetx.php");
	else $nms="Вы не можете использовать заклинание, т.к. Вы находитесь в поединке!";
}

// ----- # Свиток запрета на общение # ----- //
if ($iteminfo['name'] == "elik_strength") {
	include("inc/magic/elik_strength.php");
}
// ----- # Свиток запрета на общение # ----- //
if ($iteminfo['name'] == "elik_agility") {
	include("inc/magic/elik_agility.php");
}
// ----- # Свиток запрета на общение # ----- //
if ($iteminfo['name'] == "elik_dex") {
	include("inc/magic/elik_dex.php");
}
// ----- # Свиток запрета на общение # ----- //
if ($iteminfo['name'] == "elik_vitality") {
	include("inc/magic/elik_vitality.php");
}
// ----- # Эликсир брони # ----- //
if ($iteminfo['name'] == "elik_br20") {
	include("inc/magic/elik_br20.php");
}


// ----- # Свиток раздеть противника 1 # ----- //
if ($iteminfo['name'] == "unset") {
	include("inc/magic/unset.php");
}

// ----- # Свиток раздеть противника 10 # ----- //
if ($iteminfo['name'] == "unset10") {
	include("inc/magic/unset10.php");
}

// ----- # Свиток нападения # ----- //
if ($iteminfo['name'] == "blood_attack") {
	if (!$stat['battle']) include("inc/magic/blood_attack.php");
	else $nms="Вы не можете использовать заклинание, т.к. Вы находитесь в поединке!";
}

// ----- # Свитки восстановления HP # ----- //
if ($iteminfo['name'] == "addhp100" || $iteminfo['name'] == "addhp200" || $iteminfo['name'] == "addhp300" || $iteminfo['name'] == "addhp400" || $iteminfo['name'] == "addhp500") {
	include("inc/magic/addhp.php");
}

// ----- # Свитки восстановления энергии # ----- //
if ($iteminfo['name'] == "addenergy20" || $iteminfo['name'] == "addenergy40" || $iteminfo['name'] == "addenergy60" || $iteminfo['name'] == "addenergy100") {
	include("inc/magic/addenergy.php");
}

// ----- # Свитки удара водой # ----- //
if ($iteminfo['name'] == "water10" || $iteminfo['name'] == "water20") {
	include("inc/magic/water.php");
}

// ----- # Свиток сброса статов # ----- //
if ($iteminfo['name'] == "reset") {
	if (!$stat['battle']) include("inc/magic/reset.php");
	else $nms="Вы не можете использовать заклинание, т.к. Вы находитесь в поединке!";
}

// ----- # Свиток невидимости # ----- //
if ($iteminfo['name'] == "invisible") {
	include("inc/magic/invisible.php");
}
// ----- # Свиток иммунитета # ----- //
if ($iteminfo['name'] == "immun") {
	include("inc/magic/immun.php");
}

// ----- # Свиток мутации # ----- //
if ($iteminfo['name'] == "mutation") {
	include("inc/magic/mutation.php");
}

// ----- # Свиток исцеления от травм # ----- //
if ($iteminfo['name'] == "healing1") {
	include("inc/magic/healing.php");
}

// ----- # Свиток запрета на общение # ----- //
if ($iteminfo['name'] == "mol") {
	include("inc/magic/mol.php");
}

// ----- # снежок # ----- //
if ($iteminfo['name'] == "snegok") {
	include("inc/magic/snegok.php");
}




?>