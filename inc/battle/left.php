<?
$hp=$stat['hp_now'];
$hp_max = ceil(($stat[vitality]*5+$stat[hp])*(1+($stat['gnom']/100)));

$widthhp=$hp/$hp_max*172;
if ($widthhp=="0") $widthhp=$widthhp+2;
if ($widthhp=="1") $widthhp=$widthhp+1;
if ($widthhp>"1") $widthhp=$widthhp-1;


$ustal=$stat['ustal_now'];
$ustal_max = $stat['power']*5;

$widthustal=$stat['ustal_now']/($stat['power']*5)*172;
if ($widthustal=="0") $widthustal=$widthustal+2;
if ($widthustal=="1") $widthustal=$widthustal+1;
if ($widthustal>"1") $widthustal=$widthustal-1;

?>



<table  width=100% cellspacing=10 border=0 cellpadding=5 bordercolor=red>
	<tr>
		<td width=230 valign=top><div id='me'><?
		include('inc/battle/inf/l_inf.php');
		?></div></td>
		<td  valign=top width=100% valign=top>
