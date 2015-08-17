<?
if ($stat[battle] and $chl[id]!=$stat[id]) $nms="Вы не можете его мутировать, т.к. Вы находитесь в поединке!";
elseif ($chl[mutation]>$now) $nms="Персонаж уже мутирован!";
elseif ($stat[battle] and $chl[id]==$stat[id]) $nms="Вы не можете мутировать, т.к. Вы находитесь в поединке!";
elseif ($chl[battle] and $chl[id]!=$stat[id]) $nms="Вы не можете его мутировать, т.к. он находится в поединке!";

else {

	$nms="Мутация прошла удачно!";

	if ($stat[razum]>=7 and $stat[razum]<12) $mtp="1";
	elseif ($stat[razum]>=12 and $stat[razum]<17) $mtp="2";
	elseif ($stat[razum]>=17 and $stat[razum]<25) $mtp="3";
	elseif ($stat[razum]>=25) $mtp="4";
	else $mtp="1";

	mysql_query("UPDATE players set mutation=$now+$iteminfo[dotime], m_type=$mtp where id=$chl[id]");

	$alldone=1;
}
?>