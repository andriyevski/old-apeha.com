<?php

class InitVars {
	# Недопустимые слова в запросах
	var $deny_words = array("union","char","select","update","group","order","benchmark","copy","fopen","open","echo","print","eval","0x","'","insert","delete");

	function InitVars() {
	}

	# Метод конвентирует суперглобальные массивы $_POST, $_GET в перемнные
	# Например : $_GET['psw'] будет переобразовано в $psw с тем же значением
	function convertArray2Vars () {

		foreach($_GET as $_ind => $_val) {
			global $$_ind;
			if(is_array($$_ind)) $$_ind = htmlspecialchars(stripslashes($_val));
		}

		foreach($_POST as $_ind => $_val) {
			global $$_ind;
			if(is_array($$_ind)) $$_ind = htmlspecialchars(stripslashes($_val));

		}
	}

	# Метод проверяет $_GET и $_POST переменные на наличие опасных данных и SQL инъекций
	function checkVars() {
		//Проверка опасных данных.
		foreach($_GET as $_ind => $_val) {
			$_GET[$_ind] = htmlspecialchars(stripslashes($_val));

			$exp = explode(" ",$_GET[$_ind]);
			foreach($exp as $ind => $val) {
				if(in_array($val,$this->deny_words)) $this->antihack("Послушайте, мои маленькие кул хацкеры... Несанкционированный доступ в БД карается лишением свободы на срок от 3-х до 5-ти лет. <br> Ваш ip адресс помечен. Вам ведь не нужны проблемы, правда?. ");
			}
		}

		foreach($_POST as $_ind => $_val) {
			$_POST[$_ind] = htmlspecialchars(stripslashes($_val));

			$exp = explode(" ",$_POST[$_ind]);
			foreach($exp as $ind => $val) {
				if(in_array($val,$this->deny_words)) $this->antihack("Послушайте, мои маленькие кул хацкеры... Несанкционированный доступ в БД карается лишением свободы на срок от 3-х до 5-ти лет. <br> Ваш ip адресс помечен. Вам ведь не нужны проблемы, правда?.");
			}
		}

	}

	function antihack($msg) {
		echo "<font color='red'><b>Antihack error: </b></font>$msg<br>\n";
		die();
	}

}



?>