<?php
mysql_query("update players set

	strength=strength+$onset_item[strength],
	dex=dex+$onset_item[dex],
        agility=agility+$onset_item[agility],
        vitality=vitality+$onset_item[vitality],
        razum=razum+$onset_item[razum],
        hp=hp+$onset_item[hp],
        hp_now=hp_now+$onset_item[hp],
        energy=energy+$onset_item[energy],
        energy_now=energy_now+$onset_item[energy],
        min=min+$onset_item[min],
        max=max+$onset_item[max]
        
where user='$stat[user]'");
?>