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
		echo $header.$input[$a].$footer; }
		else {
			$input = file($filename);
			$max=count($input);
			srand ((float) microtime() * 10000000);
			$rand_keys = array_rand ($input, $max);
			if ($r < 0) {
				for ($i=0; $i<$max;$i++)
				echo $header.$input[$rand_keys[$i]].$footer;
			}
			elseif ($r <= $max) {
				for ($i=0; $i<$r;$i++)
				echo $header.$input[$rand_keys[$i]].$footer;
			}
			else {
				$r = $max;
				for ($i=0; $i<$r;$i++)
				echo $header.$input[$rand_keys[$i]].$footer;
			}
		}
}
else {
	echo "Тут выводятся подсказки";
}
?>