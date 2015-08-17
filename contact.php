<html><head><meta http-equiv="Content-Type"	content="text/html; charset = windows-1251"><title></title><body oncontextmenu="return false;"></head><script language=Javascript>

var tl = new Array (
"|                          .:.[ Lost Angels Admins ].:.                     |\r\n",
"| Команда Падших Ангелов :   Администрация                                                       |\r\n",
"|= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =|\r\n",
"| .:.[ MIGON ].:.  E-mail :  migon@anantastudio.ru  | ICQ#:  472578574    |\r\n",
"|                                                                             |\r\n",
"|= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =|\r\n",
"| About us :                                                                  |\r\n",
"|= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =|\r\n",
"|  Sites :  http://langels.ru/                                              |\r\n",
"| Некоторые ссылки по игре :                                                  |\r\n",                                                   
"| Законы   :  http://langels.ru/index.php?type=law                         |\r\n",
"| Таблица опыта   :  http://langels.ru/index.php?type=exp                  |\r\n",
"|                                                                             |\r\n",
"|                                                                             |\r\n",
"| Связатся с нами вы можете через E-mail или ICQ, и конечно вы всегда найдёте |\r\n",
"|                           нас на http://langels.ru/                       |\r\n",
"|                                                                             |\r\n",
"|   ============================= Fallen Angels  =========================    |\r\n",
"|                                                                             |\r\n",
"|. . . . . . . . . .  Мы всегда рады видеть Вас в нашей игре !. . . . . . . . |\r\n",
"|                            Падшие ангелы  © 2009 - 2010                     |\r\n");

var speed = 5;
var index = 0;
var text_pos = 0;
var str_length = tl[0].length;
var contents, row;

function type_text ( )
{

	contents = '';
	row = Math.max ( 0, index-26 );
	while ( row < index )
	{

		contents += tl[row++];
		
	}//while
	
	document.forms[0].elements[0].value = contents + tl[index].substring ( 0, text_pos ) + "|";
	if ( text_pos++ == str_length )
	{

		text_pos = 0;
		index++;
		if ( index != tl.length )
		{

			str_length = tl[index].length;
			setTimeout ( "type_text()", speed );
			
		}//if
		
	}//if
	else
	{

		setTimeout( "type_text()", speed );
		
	}//else

}//function

</script><style>body {	SCROLLBAR-FACE-COLOR: #000000;	SCROLLBAR-HIGHLIGHT-COLOR: #000000;	SCROLLBAR-SHADOW-COLOR: #000000;	SCROLLBAR-BASE-COLOR: #000000;	background-color: #000000;	OverFlow: hidden;	vertical-align: middle;}textarea {	border: 1px dashed #00FF00;	background-color: #000000;	font: 12px Courier New;	color: #00FF00;	OverFlow: hidden;	text-align: center;}</style><body onload="type_text()"><center><form><textarea rows="25" cols="79" readonly></textarea></form></center></doby></html>