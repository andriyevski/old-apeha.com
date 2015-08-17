<?
include("inc/db_connect.php");
include("inc/html_header.php");
$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));
$now=time();
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat['t_time']>$now) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']>$now) { header("Location: academy.php"); exit; }
elseif ($stat['lov_time']>$now) { header("Location: more.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat['room'] != 41) { header("Location: main.php"); exit; }
else {
	$activn = 20;
	$timese = 600;

	if ($stat['o_time'] < $now) {mysql_query("UPDATE players set o_time=0 where id=$stat[id]");}

	if ($ogran) {
		if (!preg_match("/^[0-9]{1,10}$/", $_GET['ogran'])) die("Ошибка");
		$instr = mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=15 AND objects.min='1|0|0|0|0|0|0|3' AND objects.id IN (slots.3)");
		if (mysql_num_rows ($instr)) {
			$instrument = mysql_fetch_array($instr);
			$nowobject = mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE id='$ogran' AND user='".$stat['user']."'"));
			$objinf=explode("|",$nowobject['inf']);
			$objmin=explode("|",$nowobject['min']);
			if ($stat['proff']==3) { // Проверка проффы
				if ($stat[ustal_now]>=20) {
					if ($stat[o_time]<$now) {
						$item=mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$objinf['0']."'"));
						mysql_query("UPDATE objects SET inf='".$objinf['0']."|".$objinf['1']."|20|".$objinf['3']."|".$objinf['4']."|".$objinf['5']."|0|".$objinf['7']."', tip=16, hp='".$item['hp']."',energy='".$item['energy']."',razum='".$item['razum']."',min_d='".$item['min']."',max_d='".$item['max']."',strength='".$item['strength']."',dex='".$item['dex']."',agility='".$item['agility']."',vitality='".$item['vitality']."',krit='".$item['krit']."',unkrit='".$item['unkrit']."',uv='".$item['uv']."',unuv='".$item['unuv']."',time='".time()."',about='Драгоценный камень.Может быть вставлен в предметы для изменения характеристик' WHERE id='".$nowobject['id']."'");
						$izn_instr = mysql_fetch_array(mysql_query("SELECT * FROM objects, slots WHERE min='1|0|0|0|0|0|0|3' AND user='".$stat['user']."'"));
						$instr_inf=explode("|",$izn_instr['inf']);
						$iznos=($instr_inf[6]+1);
						if ($instr_inf[7] > $iznos ) {
							mysql_query("UPDATE objects SET inf='".$instr_inf['0']."|".$instr_inf['1']."|".$instr_inf['2']."|".$instr_inf['3']."|".$instr_inf['4']."|".$instr_inf['5']."|".$iznos."|".$instr_inf['7']."' WHERE id='".$izn_instr['id']."'");
						}
						else
						{
							mysql_query("UPDATE objects SET inf='".$instr_inf['0']."|".$instr_inf['1']."|".$instr_inf['2']."|".$instr_inf['3']."|".$instr_inf['4']."|".$instr_inf['5']."|".$iznos."|".$instr_inf['7']."' WHERE id='".$izn_instr['id']."'");
							mysql_query("UPDATE slots set slots.3=0 WHERE slots.id=".$stat['id']."");
						}
						$msg="Процесс начат!";
						mysql_query("UPDATE players set o_time=$now+$timese, ustal_now=ustal_now-$activn where id=$stat[id]");
					}
				} else $msg="Да вы батенька заработались! Идите-ка посражайтесь.";
			} else $msg="Огранкой может заниматся только Огранщик!";
		} else $msg = "Вы не можете делать огранку спец. инструмента, наденьте его если он у вас имеется!";

	}




	if ($kamen) {
		if ($vstav!="") {
			if (!preg_match("/^[0-9]{1,10}$/", $_POST['vstav'])) die("Ошибка ID камня");
			if (!preg_match("/^[0-9]{1,10}$/", $_POST['weap'])) die("Ошибка ID вещи");
			$instrum = mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=15 AND objects.min='1|0|0|0|0|0|0|2' AND objects.id IN (slots.3)");
			if (mysql_num_rows ($instrum)) {
				$instr = mysql_fetch_array($instrum);
				$obj_inf=explode("|",$instrum['inf']);
				$nowobject = mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE id='$vstav' AND user='".$stat['user']."' AND tip='16' "));
				$objinf=explode("|",$nowobject['inf']);
				$item=mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$objinf['0']."'"));
				$weapon = mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE id='$weap' AND user='".$stat['user']."' AND tip >= 1 AND tip <= 11"));
				$weap_inf=explode("|",$weapon['inf']);
				$new_sale=$weap_inf[2]+20;
				$new_name="$weap_inf[1] [МФ]";
				$new_strength=($weapon[strength]+$nowobject[strength]);
				$new_agility=($weapon[agility]+$nowobject[agility]);
				$new_dex=($weapon[dex]+$nowobject[dex]);
				$new_vitality=($weapon[vitality]+$nowobject[vitality]);
				$new_krit=($weapon[krit]+$nowobject[krit]);
				$new_unkrit=($weapon[unkrit]+$nowobject[unkrit]);
				$new_uv=($weapon[uv]+$nowobject[uv]);
				$new_unuv=($weapon[unuv]+$nowobject[unuv]);
				if ($weap_inf['5'] == 0) {
					if ($weapon['tip'] >= 1 && $weapon['tip'] <= 11) { //проверка вещи
						if ($nowobject['tip'] == 16) { //проверка камня
							if ($stat['proff']==2) { // Проверка проффы
								if ($stat[ustal_now]>=$activn) {
									if ($stat[o_time]<$now) {
										$izn_instr = mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE min='1|0|0|0|0|0|0|2' AND user='".$stat['user']."'"));
										$instr_inf=explode("|",$izn_instr['inf']);
										$iznos=($instr_inf[6]+1);
										if ($instr_inf[7] > $iznos ) {
											mysql_query("UPDATE objects SET inf='".$instr_inf['0']."|".$instr_inf['1']."|".$instr_inf['2']."|".$instr_inf['3']."|".$instr_inf['4']."|".$instr_inf['5']."|".$iznos."|".$instr_inf['7']."' WHERE id='".$izn_instr['id']."'");
										}
										else
										{
											mysql_query("UPDATE objects SET inf='".$instr_inf['0']."|".$instr_inf['1']."|".$instr_inf['2']."|".$instr_inf['3']."|".$instr_inf['4']."|".$instr_inf['5']."|".$iznos."|".$instr_inf['7']."' WHERE id='".$izn_instr['id']."'");
											mysql_query("UPDATE slots set slots.3=0 WHERE slots.id=".$stat['id']."");
										}
										mysql_query("UPDATE players set o_time=$now+$timese, ustal_now=ustal_now-$activn where id=$stat[id]");
										mysql_query("UPDATE objects SET inf='".$weap_inf['0']."|".$new_name."|".$new_sale."|".$weap_inf['3']."|".$weap_inf['4']."|".$weap_inf['5']."|".$weap_inf[6]."|".$weap_inf['7']."', strength='".$new_strength."',dex='".$new_dex."',agility='".$new_agility."',vitality='".$new_vitality."',krit='".$new_krit."',unkrit='".$new_unkrit."',uv='".$new_uv."',unuv='".$new_unuv."',time='".time()."',mf_type=1 WHERE id='".$weapon['id']."'");
										mysql_query("DELETE FROM objects WHERE id=".$nowobject[id]."");

										$msg="Процесс начат!";
									}
								} else $msg="Да вы батенька заработались! Идите-ка посражайтесь.";
							} else $msg="Это работа только для кузнеца!";
						} else $msg="Ошибка с работой камня!";
					} else $msg="Ошибка с работой вещи!";
				} else $msg="Артефакты невозможно модифицировать!";
			} else $msg = "Вы не можете делать вставку камня без спец инструмента, наденьте его если он у вас имеется!";
		}
	}






	function show ($id) {
		global $stat;

		switch ($id) {
			case 1:

				echo"<br>
<div align='center' >
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
<tr><td align='center'>
В этом разделе вы можете <b>Огранять</b> камни, после огранки у них появятся характеристики.
</td></tr></table>
</div>";
				$now=time();


				if ($stat['o_time'] > $now) echo "<SCRIPT LANGUAGE=\"JavaScript\">top.frames['main'].location = \"juvelir.php\";</script>";
				elseif ($stat['proff']!= 3) {
					echo "<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
<tr><td align='center'><b><font color=red>Только Огранщик может заниматься огранкой камней!</font></b></td></tr></table></div>";
				} else {

					$it_sost=mysql_query("SELECT * FROM `objects` WHERE `user` = '".$stat['user']."' AND objects.tip=16 AND about='Неограненный камень'");

					if (mysql_num_rows($it_sost)) {



						for($i=0; $i<mysql_num_rows($it_sost); $i++) {

							echo" <br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>";


							$objects=mysql_fetch_array($it_sost);

							$obj_inf=explode("|",$objects['inf']);
							$obj_min=explode("|",$objects['min']);
							$obj_add=explode("|",$objects['add']);

							include('inc/main/min_tr.php');
							include('inc/main/add.php');
							include('inc/main/classes.php');

							$sale_price=round($obj_inf['2']);
							if ($obj_inf['0']!=ruda) {
								echo"
                <tr><td width=33% align=center valign=center>
                <a href='' target=_blank><b>".$obj_inf['1']."</b></a><br>
                <b>Гос. цена: ".$obj_inf['2']." зм.</b><br>
                
                Тип предмета: <i>".$tip."</i><br>
                </td>
                <td width=34% align=center>
                <img src='i/items/".$obj_inf['0'].".gif' alt='".$obj_inf['1']."'>
                <br>
<b>
                <span onclick=\"if (confirm('Вы действительно хотите огранить &quot;".$obj_inf['1']."&quot;?')) window.location='?otdel=1&ogran=".$objects['id']."'\" style='CURSOR: Hand'>Огранить</a>
</b>
                </td>
                <td width=33% valign=top>
                ";


								if ($objects['about']) echo"<b><i>Дополнительная информация:</i></b><br><br>".$objects[about]."";

								echo"</td></tr></table>
</div>";
							}

						}



					} else

					echo"<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
<tr><td align='center'>У Вас нет камней, подлежащих огранке.</td></tr></table></div>";
				}

				break;


			case 2:

				echo"<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
<tr><td align='center'>
В этом разделе вы можете вставить <b>Ограненный камень</b> в нужную вам <b>вещь</b>, у этой <b>вещи</b> будут увеличены параметры в зависимости от <b>Ограненного камня</b>.
</td></tr></table>
</div>";

				if ($stat['o_time']) echo "<SCRIPT LANGUAGE=\"JavaScript\">top.frames['main'].location = \"juvelir.php\";</script>";
				elseif ($stat['proff']!= 2) {
					echo "<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
<tr><td align='center'><b><font color=red>Только Кузнец может заниматься кузнечным делом!</font></b></td></tr></table></div>";
				} else {

					echo "<table width=100%><tr><td width=50% valign='top'>";

					$it_sost=mysql_query("SELECT * FROM `objects` WHERE `user` = '".$stat['user']."' AND tip=16 and about='Драгоценный камень.Может быть вставлен в предметы для изменения характеристик' and bank='0' and mf_type='0' and lam='0' and komis='0' and mag='0'");

					if (mysql_num_rows($it_sost)) {

						for($i=0; $i<mysql_num_rows($it_sost); $i++) {

							echo" <br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>";

							$objects=mysql_fetch_array($it_sost);

							$obj_inf=explode("|",$objects['inf']);
							$obj_min=explode("|",$objects['min']);
							$obj_add=explode("|",$objects['add']);

							include('inc/main/min_tr.php');
							include('inc/main/add.php');
							include('inc/main/classes.php');

							$sale_price=round($obj_inf['2']);
							echo"
                <tr><td width=33% align=center valign=center>
                <a href='' target=_blank><b>".$obj_inf['1']."</b></a><br>
ID вещи: <b>".$objects['id']."</b><br>
                <b><u>Действие предмета:</u></b><br>$hp$energy$uron$strength$dex$agility$vitality$razum$br1$br2$br3$br4$br5$krit$unkrit$uv$unuv<br>
                </td>
                <td width=34% align=center>
                <img src='i/items/".$obj_inf['0'].".gif' alt='".$obj_inf['1']."'>
                </td></tr>";

							echo "</table>
</div>";

						}



					} else
					echo"<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
<tr><td align='center'>У Вас нет драгоценных камней, подлежащих вставке.</td></tr></table></div>";



					echo "</td><td valign='top' width=50%>";


					$it_sost1=mysql_query("SELECT * FROM `objects` WHERE `user` = '".$stat['user']."' AND tip >= 1 AND tip <= 11 and bank='0' and mf_type='0' and lam='0' and komis='0' and mag='0'");

					if (mysql_num_rows($it_sost1)) {

						for($i=0; $i<mysql_num_rows($it_sost1); $i++) {

							echo" <br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>";

							$objects=mysql_fetch_array($it_sost1);

							$obj_inf=explode("|",$objects['inf']);
							$obj_min=explode("|",$objects['min']);
							$obj_add=explode("|",$objects['add']);

							include('inc/main/min_tr.php');
							include('inc/main/add.php');
							include('inc/main/classes.php');

							$sale_price=round($obj_inf['2']);
							echo"
                <tr><td width=33% align=center valign=center>
                <a href='' target=_blank><b>".$obj_inf['1']."</b></a><br><br>
                <b><u>Действие предмета:</u></b><br>$hp$energy$uron$strength$dex$agility$vitality$razum$br1$br2$br3$br4$br5$krit$unkrit$uv$unuv<br>
                </td>
                <td width=34% align=center>
                <img src='i/items/".$obj_inf['0'].".gif' alt='".$obj_inf['1']."'>
                </td>
                <td width=33% valign=top><form method=post>
Введите ID камня:<br><input type='text' name='vstav' class='input'>
<input type=hidden value=".$objects['id']." name='weap'>
<br><input type='submit' name='kamen' value='Вставить' class='input'></form>

</td></tr>";

							echo "</table>
</div>";

						}



					} else
					echo"<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
<tr><td align='center'>У Вас нет вещей для ковки.</td></tr></table></div>";

				}



				echo "</td></tr>";

				break;


		}}


		echo"
<body background='/i/bg.gif' leftmargin=0 topmargin=0>

<DIV ID=hint1></DIV>

<SCRIPT src='i/show_inf.js'></SCRIPT>
";


		print"<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td>&nbsp;&nbsp;<b>У Вас на счету:</b> <u>".$stat['credits']."</u> <b>зм.</b>
</td>

<td align=right valign=top>

<input class=input type=button value='Обновить' onclick='window.location.href=\"juvelir.php?otdel=$_GET[otdel]&tmp=\"+Math.random();\"\"'>

<input class=input type=button value='Вернуться' onclick='window.location.href=\"world.php?room=26&tmp=\"+Math.random();\"\"'>

</td>
</tr>
</table>";



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
          </td>
        </tr>
        <tr>
          <td width='100%' height='100%' background='i/inman_fon.gif'>
            <table border='0' width='100%' height='100%' cellspacing='0' cellpadding='0' style='border-collapse: collapse; border-style: solid; padding: 3'>
              <tr>
                <td width='100%' align='center' valign='top'>";

		if ($stat['o_time']>$now) {
			echo"<script src='i/time.js'></script>";
			echo"<center><table cellspacing=0 cellpadding=3>
<tr>
<td><font color=red><b>Оставшееся время:</b></font></td>
<td id=know style='COLOR: red; FONT-WEIGHT: Bold; TEXT-DECORATION: Underline'></td>
</tr>
</table>
<script>ShowTime('know',",$stat['o_time']-$now,",1);</script>";
			if ($stat['o_time'] < $now) mysql_query("UPDATE players set o_time=0 where id=$stat[id]");
		}

		if ($msg!="") echo"<center><font color=red><b>$msg</b></font></center><br>";

		echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
    <tr>

<td valign='top' align=center width=32%><A"; if ($otdel == 1) echo" disabled><b>"; else echo" HREF='juvelir.php?otdel=1'>"; echo"Огранка камней</b></A></td>
<td valign='top' align=center width=32%><A"; if ($otdel == 2) echo" disabled><b>"; else echo" HREF='juvelir.php?otdel=2'>"; echo"Кузнечное дело</b></A></td>

</tr>
  </table>
</div>";

		if (!empty($_GET['otdel'])) {

			switch ($_GET['otdel']) {
				case 1: show(1); break;
				case 2: show(2); break;
				default: echo"<B STYLE='COLOR: Red'>Что-то тут не так...</B>"; break;
			}


		} else {

			echo"<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
<tr><td align='center'>В <b>Ювелирной Мастерской</b> могут работать как <b>Огранщики</b> так и <b>Кузнеци</b>. <br>
<b>Огранщики</b> могут обрабатывать ресурсы полученные в работе, которые в дальнейшем могут использоваться для вставки камней в вещи.<br>
<b>Кузнеци</b> могут вставлять обработанные камни, полученные в связи с огранкой их <b>Огранщиками</b>.</td></tr></table></div>";

		}

		echo"                </td>
                </tr>
            </table>
          </td>
        </tr>
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


}
?>