<?
include('inc/header.php');

echo "
<table border='0' width='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='100%' align='center'>
     <table border='0' width='100%' height='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='22' height='100%'>
    	<table border='0' width='22' height='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='22' height='25'>
			<img src='i/inman_b11.gif' width='22' height='25' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='69'><img src='i/inman_b12.gif' width='22' height='69' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='100%' background='i/inman_b13.gif'>&nbsp;</td>
  </tr>
  <tr>
    <td width='22' height='69'><img src='i/inman_b14.gif' width='22' height='69' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='25'><img src='i/inman_b15.gif' width='22' height='25' alt=''></td>
  </tr>
</table>
    </td>
    <td height='100%'>
      <table border='0' width='100%' height='100%' cellspacing='0' cellpadding='0'>
        <tr>
          <td width='100%' height='25'>
          	<table border='0' width='100%' height='25' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='51' height='25'>
			<img src='i/inman_b211.gif' width='51' height='25' alt=''></td>
    <td background='i/inman_b212.gif' valign='middle'>
    	<table border='0' height='22' cellspacing='0' cellpadding='0'>
  <tr>
<td width='96' height='22'>&nbsp;</td>

  </tr>
</table>
   
    </td>
    <td width='51' height='25'>
			<img src='i/inman_b213.gif' width='51' height='25' alt=''></td>
  </tr>
</table>
   ";













?>






<html>
<head>
<title>Old-apeha.ru</title>
<link rel=stylesheet type="text/css" href="i/main.css?18122077">
<meta http-equiv=Content-Type content="text/html; charset=windows-1251">
<META Http-Equiv=Cache-Control Content=no-cache>
<meta http-equiv=PRAGMA content=NO-CACHE>
<META Http-Equiv=Expires Content=0>
</head>





<table border='1' background='i/inman_fon2.gif' cellpadding='0'
	cellspacing='0'
	style='border-collapse: collapse; border-style: solid; padding: 2'
	bordercolor='#D8C792' width='98%'>
	<tr>
		<td width='25%' valign='top'><img src='../i/androgin.jpeg' align='top'></td>
		<td width='75%' align='right'>
		<DIV ID=hint1 class=hint></DIV>
		<SCRIPT LANGUAGE="JavaScript" src='i/show_inf.js'></SCRIPT>
		<DIV ID='MsgSheet'></DIV>
		<SCRIPT LANGUAGE="JavaScript">
		<!--
		var is_writer = 'Старейшина';
		var is_user = '<?echo $stat[user];?>';
		var st_text = new Array();


		st_text[1.1] = 'Приветствую тебя, <?echo $stat[user];?>. Ты что-то хотел?';
		st_text[1.2] = '1. <A HREF=\'#\' OnClick=\'Messaging("2.1","2.2");\'>Кто ты?</A><BR>&nbsp;2. <A HREF=\'#\' OnClick=\'Messaging("4.1","4.2");\'>Расскажи мне о городе</A><BR>&nbsp;3. <A HREF=\'#\' OnClick=\'Messaging("7.1","7.2");\'>Можешь мне помочь?</A><BR>&nbsp;4. <A HREF=\'#\' OnClick=\'Messaging("11.1","11.2");\'>У тебя есть задания для меня?</A>';
		
		
		st_text[2.1] = 'Меня зовут Андрогин, я один из старейших жителей этого города.Я помогу тебе выжить в нашем городе. Расскажу о местных законах и правилах, об основных способах заработка и месте проведения боев.';
		st_text[2.2] = '1. <A HREF=\'#\' OnClick=\'Messaging("3.1","3.2");\'>Откуда ты знаешь мое имя</A><BR>&nbsp;1. <A HREF=\'#\' OnClick=\'Messaging("7.1","7.2");\'>Рассказывай, мне очень интересно</A><BR>&nbsp;2. <A HREF=\'#\' OnClick=\'Messaging("1.1","1.2");\'>Я и без тебя справлюсь, пока!</A>';

		
		st_text[3.1] = 'Я знаю все об этом городе и его жителях. И не советую пытаться скрыть от меня что-либо...';
		st_text[3.2] = '1. <A HREF=\'#\' OnClick=\'Messaging("4.1","4.2");\'>Что можешь рассказать о городе?!</A><BR>&nbsp;2. <A HREF=\'#\' OnClick=\'Messaging("2.1","2.2");\'>Хорошо</A>';
		
		
		st_text[4.1] = 'Стены города были заложенны моими предками! Наш город славится своими отважными воинами. Многие воины приходили в город, чтобы помериться с ними силами. Глядя в твои глаза, полные храбрости, я уверен, ты достигнешь успеха в своих сражениях за честь и славу.Но прежде чем, ты приступишь к ним, я подскажу тебе какие физические качества, следует развивать, чтобы стать непобедимым воином и увековечить свое имя в веках!Ты готов?!';st_text[4.2] = '1. <A HREF=\'#\' OnClick=\'Messaging("5.1","5.2");\'>Да-да, слушаю?</A><BR>&nbsp;2. <A HREF=\'#\' OnClick=\'Messaging("1.1","1.2");\'>Неее, это не для меня!</A>';
		
		
		st_text[5.1] = 'Взгляни на табличку слева от меня, ты видишь свои характеристики - Сила, Ловкость, Удача и Выносливость. Они влияют на то, как ты будешь сражаться на просторах этого мира.<br><br><B>Сила</B> - очень важное качество; чем больше твоя сила, тем больше вещей ты можешь носить в своем рюкзаке, и тем сильнее будут твои удары в бою.<br><br><B>Ловкость</B> - влияет на то, как легко ты сможешь уворачиваться от ударов противника, а также насколько часто ты будешь попадать по нему..<br><br><B>Удача</B> - увеличивает шанс нанести критический удар, наносящий вдвое больше урона, а также увеличивает шанс избежать его со стороны противника.<br><br><B>Выносливость</B> - одна из самых главных характеристик; чем больше Выносливость, тем тем больше у тебя жизненной силы.<br><br>Следующее, что тебе необходимо сделать - это использовать возможные обучения и увеличить свои характеристики. Не спеши, хорошенько подумай, какие характеристики лучше увеличить.<br><br>Хочу сказать тебе что у тебя есть возможность прокачать еще парочку способностей:<br><b>Сила орка</b> - так же как и сила, влияет на силу урона в бою;<br><br><b>Хитрость эльфа</b> - способность, аналогичная твоей ловкости.Влияет на шанс уворота в бою;<br><br><b>Чутьё человека</b> - аналогичная способность твоей удаче. Влияет на шанс критического удара;<br><br><b>Выносливость гнома</b> - увеличивает твое здоровье;';
		st_text[5.2] = '1. <A HREF=\'#\' OnClick=\'Messaging("6.1","6.2");\'>А вдруг я ошибусь в выборе?!</A><BR>&nbsp;2. <A HREF=\'#\' OnClick=\'Messaging("1.1","1.2");\'>Хорошо, спасибо</A>';
		
		
		st_text[6.1] = 'Если тебя не устроит сделанный выбор в будущем, то после достижения первого уровня ты сможешь распределить характеристики иначе в моей хижине. Первые 10 операций проводятся бесплатно, в дальнейшем, чем выше уровень и больше характеристик, тем дороже тебе обойдется перераспределение';
		st_text[6.2] = '1. <A HREF=\'#\' OnClick=\'Messaging("5.1","5.2");\'>Я понял</A>';		
		

		st_text[7.1] = 'Чем я могу тебе помочь?';
		st_text[7.2] = '1. <A HREF=\'#\' OnClick=\'Messaging("5.1","5.2");\'>Можешь рассказать о характеристиках?</A><BR>&nbsp;2. <A HREF=\'#\' OnClick=\'Messaging("10.3","7.2");\'>А как мне посмотреть мой инвентарь?</A><BR>&nbsp;3. <A HREF=\'#\' OnClick=\'Messaging("10.4","7.2");\'>Как посмотреть/распределить умения?</A><BR>&nbsp;4. <A HREF=\'#\' OnClick=\'Messaging("10.5","7.2");\'>Где и с кем начать сражение?</A><BR>&nbsp;4. <A HREF=\'#\' OnClick=\'Messaging("8.1","8.2");\'>Как заработать деньги?</A><BR>&nbsp;5. <A HREF=\'#\' OnClick=\'Messaging("10.1","10.2");\'>Где я могу купить аммуницию?</A><BR>&nbsp;6. <A HREF=\'#\' OnClick=\'Messaging("10.6","7.2");\'>Как выйти в город?</A><BR>&nbsp;7. <A HREF=\'#\' OnClick=\'Messaging("1.1","1.2");\'>Все, спасибо</A>';		
				
				
				

		st_text[8.1] = 'В нашем городе много способов заработать, я расскажу тебе о парочке. Первый способ заработать - это один из кравожадных способов но и эффективных,Участие в боях, второй - ты можешь зарабатывать при помощи мирных навыков, зарабатывая по своей профессии, третий способ о котором я тебе расскажу - это заработок при помощи общения с друзьями. О чем тебе лучше рассказать?';
		st_text[8.2] = '1. <A HREF=\'#\' OnClick=\'Messaging("9.1","8.2");\'>О заработке боями</A><BR>&nbsp;2. <A HREF=\'#\' OnClick=\'Messaging("9.2","8.2");\'>О заработке с помошью профессий</A><BR>&nbsp;3. <A HREF=\'#\' OnClick=\'Messaging("9.3","8.2");\'>О заработке с помошью общения</A><BR>&nbsp;4. <A HREF=\'#\' OnClick=\'Messaging("9.4","8.2");\'>Ну а другие способы заработать?!</A><BR>&nbsp;5. <A HREF=\'#\' OnClick=\'Messaging("1.1","1.2");\'>Спасибо, я попробую!</A>';		
				

		st_text[9.1] = 'Участвуя в боях ты получаешь не только опыт за бои, но и при достижении определенных ступеней ты поулчаешь небольшую сумму денег и умений. Таблицу опыта ты можешь посмотреть в энциклопедии или <A HREF=\'encicl.php?otdel=20\' target=_blank>перейдя по этой ссылке</A> ';
		st_text[9.2] = 'При помощи профессии ты можешь заработать немного денег, выполняя работу других жителей города.';
		st_text[9.3] = 'Ты можешь заработать путем приведения в наш город новых воинов. Подробнее ты можешь узнать <A HREF=\'main.php?set=work\'>тут</A>';
		st_text[9.4] = 'Попробуй сам найти их!';
			
				
		st_text[10.1] = 'В нашем городе функционируют 2 официальных магазина: Государственный и Комиссионный.В 1 продаются новые вещи, а во 2 в отличии от 1 можно встретить вещи других игроков, соответственно цена на них может быть ниже чем в государственном.';
		st_text[10.2] = '1. <A HREF=\'#\' OnClick=\'Messaging("10.6","7.2");\'>А как выйти в город?!</A><BR>&nbsp;2. <A HREF=\'#\' OnClick=\'Messaging("1.1","1.2");\'>Спасибо, я зайду туда</A>';
		st_text[10.3] = 'Просмотреть свой инвентарь, а так же много полезной информации о себе ты можешь нажав по кнопке Настройки/Инвентарь, в верхней панельке навигации, <center><IMG SRC=\'index/inf.gif\'></center>';
		st_text[10.4] = 'Посмотреть умения своего персонажа ты можешь нажав на кнопку Умения, на панеле навигации, что находится ниже';
		st_text[10.5] = 'В нашем городе проходят 2 вида боев: с людьми и с ботами. В свою очередь бои с людьми делятся на физические(1x1), групповые(группа на группу), хаотичные(2 группы в хаотичном порядке делятся и сражаются).Перейти к боями ты можешь  нажав на кнопку Поединки, в верхней панельке навигации, <center><IMG SRC=\'index/poed.gif\'></center>';			
		st_text[10.6] = 'Для выхода в город тебе нужно нажать на кнопку Карта города, в верхней панельке навигации, <center><IMG SRC=\'index/city.gif\'></center>';			

		
		st_text[11.1] = '<? 
		if ($stat[kwest] == 1)  echo 'Мое 1 задание - это проверка на самостоятельность и обучаемость. Я обучил тебя 3 свободным характеристикам и умениям. Тебе нужно самостоятельно распределить их. Ты можешь отказаться от этого задания и приступить к следующему, пропустив это задание.Но ты не сможешь к нему больше вернуться.<br><i>Статус квеста: Не выполнен</i>'; 		 
		if ($stat[kwest] == 2)  echo 'Ты успешно справился с моим 1 заданием, я дал тебе <b>Нож Довольных</b>. Теперь тебе надо одеть его. Это и есть мое следующее задание. Ты можешь отказаться от этого задания и приступить к следующему, пропустив это задание.Но ты не сможешь к нему больше вернуться.<br><i>Статус квеста: Не выполнен</i>'; 
		if ($stat[kwest] == 3)  echo 'Похвально, ты успешно справился и с этим заданием.<br>Теперь самое время приступить к твоей 1 схватке, помни, тебе нужна только победа над противником!!! <br>Надеюсь ты оправдаешь мои надежды...Удачи!  <br>Ты можешь отказаться от этого задания и приступить к следующему, пропустив это задание.Но ты не сможешь к нему больше вернуться.<br><i>Статус квеста: Не выполнен</i>'; 
		if ($stat[kwest] == 4)  echo 'Поздравляю с твоей победой, не зря я в тебя верил.<br>Но пока что этого мало и тебе нужны постоянные тренировки. Теперь твоя цель - набрать 20 едениц опыта. Удачи!  <br>Ты можешь отказаться от этого задания и приступить к следующему, пропустив это задание.Но ты не сможешь к нему больше вернуться.<br><i>Статус квеста: Не выполнен</i>'; 
		if ($stat[kwest] == 5)  echo 'Молодец, Неожидал так скоро увидить тебя, видимо я недооценивал тебя, поздравляю с успешным достижения первой ступени на твоем пути к славе! Кажется, я обещал тебя обучить свободной физической характеристике..Ты ее заслужил!<br>К сожалению мне пора отлучиться и помогать другим новичкам нашего города, а ты в это время добирайся до 1 уровня, в процессе достижения его, я буду обучать тебя свободным характеристики и давать некоторое количество золота.Увидимся когда будешь на 1 уровне...<br><i>Статус квеста: Не выполнен</i>';
		if ($stat[kwest] == 6)  echo 'Ты уже добился некоторых успехов. Обрати внимание на свои характеристики, я обучил тебя +3 к физическим характеристикам и +1 к особенностям<br>Сейчас, ты более опытный боец и ты можешь постоять за себя...<br> Я хочу дать тебе новое задание.Тебе нужно будет купить себе шлем - Кабассет.Купить его ты можешь в нашем магазине, ах, чуть незабыл...купи мне еще 1 свиток восстановления энергии - Восстановление 20 MP, а то я уже использовал все свои свитки<br><i>Статус квеста: Не выполнен</i>';
		if ($stat[kwest] == 7)  echo 'Спасибо что нашел меня, я хочу сказать, что я поселился в моей хижине.Она находится в пригороде. Зайди ко мне, у меня есть для тебя задание';
		?>';
		st_text[11.2] = '1. <A HREF=\'?act=vipolnil\'>Я Выполнил твое задание</A><BR>&nbsp;2. <A HREF=\'#\' OnClick=\'Messaging("1.1","1.2");\'>Я попробую выполнить!</A>';
		
		
		st_text[12.1] = '<? if ($stat[updates]< 1) { echo "усп"; } echo "усп"; ?>';
		st_text[12.2] = '1. <A HREF=\'#\' OnClick=\'Messaging("11.1","11.2");\'> Спасибо, а есть еще задания?</A>';		

		


		
		
		
		st_text[122.1] = 'У моего сына случилась беда, в далеком походе его войско разгромили, а он был тяжело ранен. Сколько целителей не пытались его вылечить, всё бесполезно. Я слышал, что далеко в <B>Горах</B> обидает <B>Колдун</B>, который знает рецепт <B>Чудотворного Зелья</B>, излечивающего глубокие раны. Но знай, что в Горах обитают дикие монстры, которые могут помешать тебе добраться невридимым к Колдуну.';
		st_text[122.2] = '1. <A HREF=\'#\' OnClick=\'top.nav("taverna.php?GQuest4=1");\'>Я берусь</A><BR>&nbsp;2. <A HREF=\'#\' OnClick=\'Messaging("1.1","1.2");\'>Я не возьмусь</A>';
		Messaging(1.1,1.2);
		//-->
		</SCRIPT> <?


		if ($act=="vipolnil") {
			if ($stat[kwest]==1) {
				if ($stat[updates]<1) {
					mysql_query("UPDATE players set kwest=2 where id=$stat[id]");

					$ItTake = "knife1";
					$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));
					$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|Успехов в боях, Андрогин|0|$buyitem[art]|0|$buyitem[iznos]";
					$min="0|3|3|3|3|0|$buyitem[min_rase]|$buyitem[min_proff]";
					mysql_query("INSERT INTO objects (`user`, `inf`, `min`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`,`tip`,`about`) values ('$stat[user]','$inf','$min','$buyitem[br1]','$buyitem[br2]','$buyitem[br3]','$buyitem[br4]','$buyitem[br5]','$buyitem[min]','$buyitem[max]','$buyitem[hp]','$buyitem[energy]','$buyitem[strength]','$buyitem[dex]','$buyitem[agility]','$buyitem[vitality]','$buyitem[razum]','$buyitem[krit]','$buyitem[unkrit]','$buyitem[uv]','$buyitem[unuv]','$now','$buyitem[tip]','$buyitem[about]')");

				};
				echo"<script>location='main.php'</script>";
			};



			if ($stat[kwest]==2) {
				$it3 = mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.id IN (slots.3)");
				if (mysql_num_rows ($it3)) {
					mysql_query("UPDATE players set kwest=3 where id=$stat[id]");
				};
				echo"<script>location='main.php'</script>";
			};

			if ($stat[kwest]==3) {

				if ($stat['wins'] >= 1) {

					mysql_query("UPDATE players set kwest=4 where id=$stat[id]");
				};
				echo"<script>location='main.php'</script>";
			};



			if ($stat[kwest]==4) {

				if ($stat['exp'] >= 20) {

					mysql_query("UPDATE players set kwest=5 where id=$stat[id]");
				};
				echo"<script>location='main.php'</script>";
			};

			if ($stat[kwest]==5) {

				if ($stat['level'] >= 1) {

					mysql_query("UPDATE players set kwest=6 where id=$stat[id]");
				};
				echo"<script>location='main.php'</script>";
			};



			if ($stat[kwest]==6) {
				$shlem = mysql_query("SELECT * FROM objects WHERE objects.user='".$stat['user']."' AND objects.inf='helmet27|Кабассет|7|0|0|0|0|20' AND objects.tip='8'");
				$svitok = mysql_query("SELECT * FROM objects WHERE objects.user='".$stat['user']."' AND objects.tip=12 AND objects.inf='addenergy20|Восстановление 20 MP|2|0|0|0|0|1'");

				if (mysql_num_rows ($shlem)) {
					if (mysql_num_rows ($svitok)) {
						mysql_query("UPDATE players set kwest=7 where id=$stat[id]");
						mysql_query("UPDATE players SET credits=credits + 5 WHERE user='".$stat['user']."'");
						mysql_query("DELETE FROM objects WHERE objects.user='".$stat['user']."' AND objects.tip=12 AND objects.inf='addenergy20|Восстановление 20 MP|2|0|0|0|0|1'");
					};};
					echo"<script>location='main.php'</script>";
			};
		};







		echo"

<br>
<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#cccccc>
               </td>
                </tr>
            </table>
          </td>
        </tr>
</td></tr></table>
        <table cellpadding=0 cellspacing=0 border=0 width=100%>
          <tr>
            <td bgcolor=#3564A5 width=100%>
            <img src=i/1x1.gif width=1 height=1></td>
          </tr>

          <tr>
            <td bgcolor=#FCFAF3 width=100%>
            <table cellpadding=2 cellspacing=0 border=0 width=100% background='/i/bg2.gif'>
              <tr>
                <td width=100%>
<center>
<input class=lbut type=button value='Инвентарь' onClick=top.main.location.href=\"main.php?set=edit&tmp=\"+Math.random();\"\">
<input class=lbut type=button value='Друзья' onClick=top.main.location.href=\"druzja.php?tmp=\"+Math.random();\"\">

<input class=lbut type=button value='Умения' onClick=top.main.location.href=\"main.php?set=updates&tmp=\"+Math.random();\"\">


<input class=lbut type=button value='Анкета' onClick=top.main.location.href=\"main.php?set=anketa&step=1&tmp=\"+Math.random();\"\">

<input class=lbut type=button value='Безопасность' onClick=top.main.location.href=\"main.php?set=security&tmp=\"+Math.random();\"\">
<hr>
<input class=lbut type=button value='Отчеты' onClick=top.main.location.href=\"main.php?set=otchets&tmp=\"+Math.random();\"\">
<input class=lbut type=button value='Способности' onClick=top.main.location.href=\"molitva.php\">
<input class=lbut type=button value='Образ персонажа' onClick=top.main.location.href=\"setimg.php\"><input class=lbut type=button value='Услуги' onClick=top.main.location.href=\"uslugi.php\"></center>
 <table cellpadding=0 cellspacing=0 border=0 width=100%><tr>
              </tr></table>
            </table>";



		echo"
        <tr>
          <td width='100%' height='25'>
          <table border='0' width='100%' height='25' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='51' height='25'>
			<img src='i/inman_b231.gif' width='51' height='25' alt=''></td>
    <td background='i/inman_b232.gif'>&nbsp;</td>
    <td width='51' height='25'>
			<img src='i/inman_b233.gif' width='51' height='25' alt=''></td>
  </tr>
</table>

          </td>
        </tr>
      </table>
    </td>
    <td width='22' height='100%'>
    	<table border='0' width='22' height='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='22' height='25'>
			<img src='i/inman_b21.gif' width='22' height='25' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='69'><img src='i/inman_b22.gif' width='22' height='69' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='100%' background='i/inman_b23.gif'>&nbsp;</td>
  </tr>
  <tr>
    <td width='22' height='69'><img src='i/inman_b24.gif' width='22' height='69' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='25'><img src='i/inman_b25.gif' width='22' height='25' alt=''></td>
  </tr>
</table>
   </td>
  </tr>
</table>
      
      </td>
  </tr>
</table>";
		?>