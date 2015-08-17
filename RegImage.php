
<noscript></noscript>
<?

$im = imageCreate(120,40);

$black = imageColorAllocate($im, 235, 237, 236);
$orange = imageColorAllocate($im, 0, 0, 0);

imageFill($im, 0, 0, $black);

imagettftext($im, 20, 0, 15, 27, $orange, getcwd()."/inc/times.ttf",$reg_code);

Header("Content-type: image/png");

imagePng($im);

?>