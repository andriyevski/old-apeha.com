<?
if(!defined($no_obst)) $no_obst=false;
switch ($locality)
{
	case 'catacombs':
	 $def_x1 = 1;               // кординаты оси X для левой команды
	 $def_x2 = 4;               // ... правой ...
	 $max_players = 20;          // макс. кол-во игроков для данной местности
	 $y_size=12;                // размер по вертикали
	 $x_size=5;                 // размер по горизонтали
	 	 if($no_obst !== true){
			 if(!is_int($time)) $time=time();
			// $obst_query = 'INSERT INTO `obstacles` (`offer_id`,`c_x`,`c_y`,`img`) VALUES ('.$time.', 2, 0,'.(rand(1,4)).'),('.$time.', 0, 2,'.(rand(1,4)).'),('.$time.', 2, 2,'.(rand(1,4)).'),('.$time.', 3, 2,'.(rand(1,4)).'),('.$time.', 2, 3,'.(rand(1,4)).'),('.$time.', 2, 4,'.(rand(1,4)).'),('.$time.', 0, 5,'.(rand(1,4)).'),('.$time.', 2, 5,'.(rand(1,4)).'),('.$time.', 3, 5,'.(rand(1,4)).'),('.$time.', 2, 6,'.(rand(1,4)).'),('.$time.', 2, 7,'.(rand(1,4)).'),('.$time.', 0, 8,'.(rand(1,4)).'),('.$time.', 2, 8,'.(rand(1,4)).'),('.$time.', 3, 8,'.(rand(1,4)).'),('.$time.', 2, 9,'.(rand(1,4)).')';
	 	 mysql_query('INSERT INTO `obstacles` (`offer_id`,`c_x`,`c_y`,`img`) VALUES ('.$time.', 2, 0,'.(rand(1,4)).'),('.$time.', 0, 2,'.(rand(1,4)).'),('.$time.', 2, 2,'.(rand(1,4)).'),('.$time.', 3, 2,'.(rand(1,4)).'),('.$time.', 2, 3,'.(rand(1,4)).'),('.$time.', 2, 4,'.(rand(1,4)).'),('.$time.', 0, 5,'.(rand(1,4)).'),('.$time.', 2, 5,'.(rand(1,4)).'),('.$time.', 3, 5,'.(rand(1,4)).'),('.$time.', 2, 6,'.(rand(1,4)).'),('.$time.', 2, 7,'.(rand(1,4)).'),('.$time.', 0, 8,'.(rand(1,4)).'),('.$time.', 2, 8,'.(rand(1,4)).'),('.$time.', 3, 8,'.(rand(1,4)).'),('.$time.', 2, 9,'.(rand(1,4)).')') || die(mysql_error());
	 	 
	 	 } // вставляем препятствия
	 	 //die($obst_query);
	 	 $zone_type='catacombs';                          // тип местности латиницей, для вставки его в таблицы заявок
	break;
//-------------//
    /*
     case 'another type':
     * 
     break;
     */
     
     default:
      $def_x1 = 1;
      $def_x2 = 4;
      $zone_type='none';
}
?>
