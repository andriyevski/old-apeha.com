<?
if ($iteminfo['name'] == "fireball30" || $iteminfo['name'] == "fireball40" || $iteminfo['name'] == "fireball50" || $iteminfo['name'] == "fireball65" || $iteminfo['name'] == "showstorm20" || $iteminfo['name'] == "showstorm30" || $iteminfo['name'] == "showstorm40" || $iteminfo['name'] == "lighting_bolt40" || $iteminfo['name'] == "lighting_bolt50" || $iteminfo['name'] == "lighting_bolt60" || $iteminfo['name'] == "lighting_bolt70"){
	mysql_query("UPDATE `participants` SET `damage`=damage+$hpplus WHERE time='".$stat['battle']."' AND id='".$stat['id']."'");
}
?>