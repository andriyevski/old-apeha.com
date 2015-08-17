<?
if(empty($victims[$random]) && empty($ttarget)) die('</div></td></tr></table>');
$second=mysql_fetch_array(mysql_query("SELECT * FROM players WHERE user='".(($ttarget>$victims[$random])?(mysql_escape_string($ttarget)):$victims[$random])."'"));

include("inc/battle/changed_2.php");

$hp=$second['hp_now'];
$hp_max = ceil(($second['vitality']*5+$second['hp'])*(1+($second['gnom']/100)));

$widthhp=$hp/$hp_max*193;
if ($widthhp=="0") $widthhp=$widthhp+2;
if ($widthhp=="1") $widthhp=$widthhp+1;
if ($widthhp>"1") $widthhp=$widthhp-1;

if ($second['invisible'] > $ctime) { $hp="??"; $hp_max="??"; }

$ustal=$second['ustal_now'];
$ustal_max = $second['power']*5;

$widthustal=$ustal/$ustal_max*193;
if ($widthustal=="0") $widthustal=$widthustal+2;
if ($widthustal=="1") $widthustal=$widthustal+1;
if ($widthustal>"1") $widthustal=$widthustal-1;

if(empty($ttarget)) echo "<table width=100% cellspacing=0 border=0 cellpadding=0 bordercolor=red><tr><td width=230 valign=top>";
include('inc/battle/inf/r_inf.php'); 
if(empty($ttarget)) echo "</tr></table>";
?>
