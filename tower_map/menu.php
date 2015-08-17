<?php
include "config.php";
include_once 'include_lang.php';
?>
<html>
<head>

<link href="styles/phaos.css" rel="stylesheet" type="text/css">

</head>
<body>
<table border=1 cellpadding=0 cellspacing=0 width="100%"
	style="border-top: solid 2px #006600; border-bottom: solid 2px #006600; border-right: solid 2px #006600; border-left: solid 2px #006600;">
	<tr>
		<td align=center width="15%"><a href="home.php" target="content"><? echo $lang_menu["home"]; ?></a>
		<br>
		<a href="message.php" target="content"><? echo $lang_menu["msg_"]; ?></a>
		</td>
		<td align=center width="15%"><?
		// $result=mysql_query("SELECT * FROM phaos_users where username = '$PHP_PHAOS_USER'");
		// while ($row = mysql_fetch_array($result)) {
		// $id = $row["id"];
		// }

		// echo "<a href='prefs.php?char_id=$id' target='content'>Prefs</a>";
		echo "<a href='prefs.php?username=$PHP_PHAOS_USER' target='content'>Prefs</a>";
		?> <br>
		<a href="character.php" target="content"><? echo $lang_menu["char"]; ?></a>
		</td>
		<td align=center width="15%"><a href="map.php" target="content"><? echo $lang_menu["trav"]; ?></a>
		<br>
		<a href="town.php" target="content"><? echo $lang_menu["expl"]; ?></a>
		</td>
		<td align=center width="15%"><a href="logout.php" target="_parent"><? echo $lang_menu["logo"]; ?></a>
		</td>
	</tr>
</table>

<!-- <div align=center> -->
		<?
		if(!@$play_music) {$play_music = 'NO';}
		if($play_music == "YES"){

			if($song_select == "") {$song_select = rand(1,4);}

			if($song_select == 1) {
				?>
<embed SRC="music/homeland_farmland.mid" hidden="true" LOOP="true">
				<?
			} elseif($song_select == 2) {
				?>


<embed SRC="music/under_the_bards_tree.mid" hidden="true" LOOP="true">
				<?
			} elseif($song_select == 3) {
				?>


<embed SRC="music/stranger_on_a_hill.mid" hidden="true" LOOP="true">
				<?
			} elseif($song_select == 4) {
				?>


<embed SRC="music/the_town_of_witchwoode.mid" hidden="true" LOOP="true">
<?
}

}
?>
<!-- </div> -->

</body>
</html>
