<?


$title='Заработок';
include('inc/header.php');
echo"<center><input type=button value='Назад' onclick='window.location = \"main.php?\"+Math.random();' class=search style='WIDTH: 250px'></center>";
echo"<br><br>
<center><b>Эликсиры:</b></center><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;В игре на данный момент всего 4 эликсира:<br>
1)Эликсир силы;<br>
2)Эликсир ловкости;<br>
3)Эликсир удачи;<br>
4)Эликсир выносливости.<br>
Каждый эликсир дает по +5 к параметрам вашего персонажа на протяжении 5 часов.<br>
Приобрести их пока можно только через СМС оплату.ЗЫ: то что они платные - это временное и необходимое игре явление.<br>
Стоимость одного сообщения - $1.3 без НДС.<br>
Приобрести эликсир можно перейдя по к оплате через кнопочку ниже.После чего откроется новое окошко с номером и текстом сообщения которое нужно отправить.<br>
Пример текста сообщения:EXP+70461(пробел)ваш текст -поле ваш текст нужно заменить на ник персонажа в игре который покупает эликсир, после него написать сила, ловкость, удача, выносливость (в зависимости от того какой параметр нужен).<br>
пример: EXP+70461 root сила <br>
";

?>
<a href="http://www.smsexpress.ru/sendsms.html?acc=2028&value=130"
	target="_blank"><img src="http://www.smsexpress.ru/buttons/3.gif"
	width=119 height=23 border=0></a>


<br>
<br>
<br>
<br>
<iframe
	width=400 height=100
	src="http://www.smsexpress.ru/list.html?id=2028&lim=5" frameborder=1></iframe>
