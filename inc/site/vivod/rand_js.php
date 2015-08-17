<?
# DesignTheory RT v.1.0 (JS)
####################################
# Автор: Фёдоров Ал-др aka DecibeL    #
# E-mail: fedorov@newmsk.tula.net          #
# Страница: http://decibel.dtn.ru              #
# Требования: PHP4                                 #
# Дата создания: 22 августа 2002 год    #
###################################
include("inc/site/vivod/config.inc.php");
###################################

$input = file($filename);
if (count($input) != 0) {

	if (empty($r) || $r == "1") {
		$input = file($filename);
		srand ((double) microtime() * 10000000);
		$a = rand(0, sizeof($input) - 1);
		$header = str_replace("\"","\\\"",$header);
		$header = str_replace("\n","",$header);
		$header = str_replace("\r","",$header);
		$footer = str_replace("\"","\\\"",$footer);
		$footer = str_replace("\n","",$footer);
		$footer = str_replace("\r","",$footer);
		$input[$a] = str_replace("\"","\\\"",$input[$a]);
		$input[$a] = str_replace("\n","",$input[$a]);
		$input[$a] = str_replace("\r","",$input[$a]);
		echo "document.write(\"".$header.$input[$a].$footer."\");"; }
		else {
			$input = file($filename);
			$max=count($input);
			srand ((float) microtime() * 10000000);
			$rand_keys = array_rand ($input, $max);
			if ($r < 0) {
				for ($i=0; $i<$max;$i++) {
					$input[$rand_keys[$i]] = str_replace("\"","\\\"",$input[$rand_keys[$i]]);
					$input[$rand_keys[$i]] = str_replace("\n","",$input[$rand_keys[$i]]);
					$input[$rand_keys[$i]] = str_replace("\r","",$input[$rand_keys[$i]]);
					echo "document.write(\"".$header.$input[$rand_keys[$i]].$footer."\");";
				}
			}
			elseif ($r <= $max) {
				for ($i=0; $i<$r;$i++) {
					$input[$rand_keys[$i]] = str_replace("\"","\\\"",$input[$rand_keys[$i]]);
					$input[$rand_keys[$i]] = str_replace("\n","",$input[$rand_keys[$i]]);
					$input[$rand_keys[$i]] = str_replace("\r","",$input[$rand_keys[$i]]);
					echo "document.write(\"".$header.$input[$rand_keys[$i]].$footer."\");";
				}
			}
			else {
				$r = $max;
				for ($i=0; $i<$r;$i++) {
					$input[$rand_keys[$i]] = str_replace("\"","\\\"",$input[$rand_keys[$i]]);
					$input[$rand_keys[$i]] = str_replace("\n","",$input[$rand_keys[$i]]);
					$input[$rand_keys[$i]] = str_replace("\r","",$input[$rand_keys[$i]]);
					echo "document.write(\"".$header.$input[$rand_keys[$i]].$footer."\");";
				}
			}
		}
}
else {
	echo "document.write(\"Добавьте хоть одну фразу.\");";
}
?>