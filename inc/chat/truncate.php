<?
$now=time();

$fp=fopen("ch.txt","a+");
flock($fp,LOCK_EX);

while (!feof($fp)) { $msg=fgets($fp, 1024); $ch=explode("|:-:|",$msg); if ($ch[9]+60>$now) $mass.="$msg"; $s[]="$msg"; }

$s=array_reverse($s); $s=explode("|:-:|",$s[0]); $s=$s[0]+1;

flock($fp,LOCK_UN);
fclose($fp);

unset($fp);

$fp=fopen("ch.txt","w");
flock($fp,LOCK_EX);

fwrite($fp,"$mass");
if ($mass=="") fwrite($fp,"$s|:-:|");

flock($fp,LOCK_UN);
fclose($fp);


?>
