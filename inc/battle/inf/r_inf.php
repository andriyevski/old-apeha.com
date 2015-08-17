<?

if($tab=='t') $t_inf=($second['invisible'] > $ctime)?"show_inf_b('<i>Тень</i>','','99','0','');":"show_inf_b('$second[user]','$second[id]','$second[level]','$second[rank]','$second[tribe]');";
$ppart=@mysql_fetch_array(mysql_query("SELECT damaged_h,damaged_t,damaged_l,damaged_r,damaged_le,hp FROM participants WHERE id={$second['id']} AND time=".$stat['battle']));


// необходимо для вывода таблицы чисел брони зон, из-за учета шмота
$enemy_stat = $second;
include_once "inc/battle/params_enemy.php";

if ($second['invisible'] > $now) {
	$get="";
	$obraz=$second['obraz'];
	$show_user="Тень";
	$second_strength="??";
	$second_dex="??";
	$second_agility="??";
	$second_vitality="??";
	$second_power="??";
	$second_razum="??";
}else {
	$get=2;

	if ($second['obraz']) $obraz=$second['obraz']; else $obraz=$second['rase']."/".$second['sex'];

	$show_user=$second['user'];
	$second_strength=$second['strength'];
	$second_dex=$second['dex'];
	$second_agility=$second['agility'];
	$second_vitality=$second['vitality'];
	$second_power=$second['power'];
	$second_razum=$second['razum'];}


	$get=2;

	include('inc/main/alt.php');
	// echo $ttarget;
	if($ajax){ // для ajax'a
		echo $t_inf."view_item_b('".$tab."','".$w_img['1']."','w1','60','40',\"".$w['1']."\",1);
view_item_b('".$tab."','".$w_img['3']."','w3','60','60',\"".$w['3']."\",1);
view_item_b('".$tab."','".$w_img['4']."','w4','60','60',\"".$w['4']."\",1);
view_item_b('".$tab."','".$w_img['13']."','w13','60','40',\"".$w['13']."\");
view_item_b('".$tab."','".$w_img['2']."','w2','60','20',\"".$w['2']."\",1);
view_item_b('".$tab."','".$w_img['14']."','w14','60','30',\"".$w['14']."\",1);

view_item_b('".$tab."','".$w_img['6']."','w6','20','20',\"".$w['6']."\");
view_item_b('".$tab."','".$w_img['7']."','w7','20','20',\"".$w['7']."\");
view_item_b('".$tab."','".$w_img['8']."','w8','20','20',\"".$w['8']."\",1);
view_item_b('".$tab."','".$w_img['10']."','w10','20','20',\"".$w['10']."\");
view_item_b('".$tab."','".$w_img['11']."','w11','20','20',\"".$w['11']."\");
view_item_b('".$tab."','".$w_img['12']."','w12','20','20',\"".$w['12']."\",1);
view_item_b('".$tab."','".$w_img['5']."','w5','60','50',\"".$w['5']."\",1);
view_item_b('".$tab."','".$w_img['9']."','w9','60','30',\"".$w['9']."\",1);
view_item_b('".$tab."','".$w_img['17']."','w17','44','30',\"".$w['17']."\",0,'".$w_title['17']."','".$w_id['17']."',1);
view_item_b('".$tab."','".$w_img['18']."','w18','44','30',\"".$w['18']."\",0,'".$w_title['18']."','".$w_id['18']."',1);
view_item_b('".$tab."','".$w_img['15']."','w15','60','30',\"".$w['15']."\",1);
update_cdz('".$tab."','head','".$enemy_stat['br1']."');
update_cdz('".$tab."','torso','".$enemy_stat['br2']."');
update_cdz('".$tab."','hands','".$enemy_stat['br4']."');
update_cdz('".$tab."','legs','".$enemy_stat['br5']."');";
if($tab=='t'){ echo "document.getElementById('".$tab."avatar').innerHTML='<img src=\'i/img/".$obraz.".gif\' border=0 width=80 height=200 onmouseover=\"hint(\'<BR><CENTER><B>".$second['user']."</B></CENTER><BR><U>Физические параметры:</U><BR>Сила: <B>".$second['strength']."</B><BR>Ловкость: <B>".$second['agility']."</B><BR>Удача: <B>".$second['dex']."</B><BR>Выносливость: <B>".$second['vitality']."</B><BR><BR><U>Особенности:</U><BR>Сила орка: <B>".$second['ork']."%</B><BR>Хитрость эльфа: <B>".$second['elf']."%</B><BR>Разум человека: <B>".$second['people']."%</B><BR>Выносливость гнома: <B>".$second['gnom']."%</B>\');\" onmouseout=\"c();\">';
//for (i=0; i<2; i++){
document.getElementById('".$tab."health1').alt='Уровень жизни: $hp/$hp_max';
document.getElementById('".$tab."ustal1').alt='Уровень активности: $enemy_stat[ustal_now]/".($enemy_stat['power']*5)."';
//}
document.getElementById('".$tab."health1').width='$widthhp';
document.getElementById('".$tab."ustal1').width='$widthustal';";
}else{ // выводим на себя
	echo "setsHP(".$stat['hp_now'].",$hp_max,100);showMN(".$enemy_stat['ustal_now'].",".($enemy_stat['power']*5).");";
}

echo "sdll('".$tab."doll','".$ppart['damaged_h']."','".$ppart['damaged_t']."','".$ppart['damaged_l']."','".$ppart['damaged_r']."','".$ppart['damaged_le']."');
";
	}else{ // статика
		?>
<table  width="259" height="393" border="0" cellpadding="0"
	cellspacing="0">
	<tr>
		<td colspan="3" background="i/pri_01.gif" align="center">
		<table border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="32" height="30"><img border="0"
					src="i/pers_name_left.gif" width="32" height="30"></td>
				<td height="30" background="i/pers_name_center.gif" valign="middle"
					align="center"><font face='Verdana' size='1' color='#ffffff'><b
					id='charname'> <script language=JavaScript>
<?=$t_inf;?>
</script> </b></font></td>
				<td width="32" height="30"><img border="0"
					src="i/pers_name_right.gif" width="32" height="30"></td>
			</tr>
		</table>


		</td>
	</tr>
	<tr>
		<td><img src="i/pri_07.gif" width="29" height="8" alt=""></td>
		<td><img src="i/pri_08.gif" width="200" height="8" alt=""></td>
		<td><img src="i/pri_09.gif" width="30" height="8" alt=""></td>
	</tr>
	<tr>
		<td><img src="i/pri_10.gif" width="29" height="8" alt=""></td>
		<td>

		<table border="0" width="200" height="8" cellspacing="0"
			cellpadding="0">
			<tr>
				<td width="4" height="8"><img border="0" src="i/pers_name_hp01.gif"
					width="4" height="8"></td>
					<?  echo"   <td width='192' height='8' background='img/icon/grey.gif'><img src='img/icon/green.gif' height='8' width='".($widthhp+20)."' border=0 alt='Уровень жизни: $hp/$hp_max' id='thealth1'></td>"; ?>
				<td width="4" height="8"><img border="0" src="i/pers_name_hp03.gif"
					width="4" height="8"></td>
			</tr>

		</table>


		</td>
		<td><img src="i/pri_12.gif" width="30" height="8" alt=""></td>
	</tr>
	<tr>
		<td><img src="i/pri_13.gif" width="29" height="1" alt=""></td>
		<td><img src="i/pri_14.gif" width="200" height="1" alt=""></td>
		<td><img src="i/pri_15.gif" width="30" height="1" alt=""></td>
	</tr>
	<tr>
		<td><img src="i/pri_16.gif" width="29" height="7" alt=""></td>
		<td>


		<table border="0" width="200" height="7" cellspacing="0"
			cellpadding="0">
			<tr>
				<td width="4" height="7"><img border="0" src="i/pers_name_ua01.gif"
					width="4" height="7"></td>
					<? echo"            <td width='192' height='7' background='img/icon/grey.gif'><img src='img/icon/blue.gif' height='7' width='".($widthustal+20)."' border=0 alt='Уровень активности: $ustal/$ustal_max' id='tustal1'></td>"; ?>
				<td width="4" height="7"><img border="0" src="i/pers_name_ua03.gif"
					width="4" height="7"></td>
			</tr>

		</table>



		</td>
		<td><img src="i/pri_18.gif" width="30" height="7" alt=""></td>
	</tr>
	<tr>
		<td><img src="i/pri_19.gif" width="29" height="14" alt=""></td>
		<td><img src="i/pri_20.gif" width="200" height="14" alt=""></td>
		<td><img src="i/pri_21.gif" width="30" height="14" alt=""></td>
	</tr>
	<tr>
		<td background="i/pri_22.gif" width="29" height="200"><img
			src="i/pri_22.gif" width="29" height="200" alt=""></td>
		<td><?
		echo"        <table width='100%' height='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
<td valign=top id='twleft'>
<script language=JavaScript>
  view_item('".$w_img['1']."','w1','60','40',\"".$w['1']."\",1);
view_item('".$w_img['3']."','w3','60','60',\"".$w['3']."\",1);
view_item('".$w_img['4']."','w4','60','60',\"".$w['4']."\",1);
view_item('".$w_img['13']."','w13','60','40',\"".$w['13']."\");
</script>
</td>
<td align=center width=80 id='tavatar'><img src='i/img/".$obraz.".gif' border=0 width=80 height=200 onmouseover=\"hint('<BR><CENTER><B>".$second['user']."</B></CENTER><BR><U>Физические параметры:</U><BR>Сила: <B>".$second['strength']."</B><BR>Ловкость: <B>".$second['agility']."</B><BR>Удача: <B>".$second['dex']."</B><BR>Выносливость: <B>".$second['vitality']."</B><BR><BR><U>Особенности:</U><BR>Сила орка: <B>".$second['ork']."%</B><BR>Хитрость эльфа: <B>".$second['elf']."%</B><BR>Разум человека: <B>".$second['people']."%</B><BR>Выносливость гнома: <B>".$second['gnom']."%</B>');\" onmouseout=\"c();\"></td>
<td valign=top id='twright'>
<script language=JavaScript>
  view_item('".$w_img['2']."','w2','60','20',\"".$w['2']."\",1);
view_item('".$w_img['14']."','w14','60','30',\"".$w['14']."\",1);

 view_item('".$w_img['6']."','w6','20','20',\"".$w['6']."\");
view_item('".$w_img['7']."','w7','20','20',\"".$w['7']."\");
view_item('".$w_img['8']."','w8','20','20',\"".$w['8']."\",1);
view_item('".$w_img['10']."','w10','20','20',\"".$w['10']."\");
view_item('".$w_img['11']."','w11','20','20',\"".$w['11']."\");
view_item('".$w_img['12']."','w12','20','20',\"".$w['12']."\",1);
view_item('".$w_img['5']."','w5','60','50',\"".$w['5']."\",1);
view_item('".$w_img['9']."','w9','60','30',\"".$w['9']."\",1);
view_item('".$w_img['15']."','w15','60','30',\"".$w['15']."\",1);
</script>    </td>          </tr>
        </table>
";

		?></td>
		<td background="i/pri_24.gif" width="30" height="200"><img
			src="i/pri_24.gif" width="30" height="200" alt=""></td>
	</tr>
	<tr>
		<td><img src="i/pri_25.gif" width="29" height="22" alt=""></td>
		<td><img src="i/pri_26.gif" width="200" height="22" alt=""></td>
		<td><img src="i/pri_27.gif" width="30" height="22" alt=""></td>
	</tr>
	<tr>
		<td><img src="i/pri_28.gif" width="29" height="66" alt=""></td>
		<td><?
		echo"        <table width='100%' height='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
<td align='center' id='tlpacket'>
        <script language=JavaScript>
view_item('".$w_img['17']."','w17','44','30',\"".$w['17']."\",0,'".$w_title['17']."','".$w_id['17']."');
</script>
</td>
<td colspan=3 align=center id='tdoll'></td>
<td align='center' id='trpacket'>
        <script language=JavaScript>
view_item('".$w_img['18']."','w18','44','30',\"".$w['18']."\",0,'".$w_title['18']."','".$w_id['18']."');
</script>
    </td>          </tr>
        </table>
";

		?></td>
		<td><img src="i/pri_30.gif" width="30" height="66" alt=""></td>
	</tr>
	<tr>
		<td><img src="i/pri_31.gif" width="29" height="37" alt=""></td>
		<td><img src="i/pri_32.gif" width="200" height="37" alt=""></td>
		<td><img src="i/pri_33.gif" width="30" height="37" alt=""></td>
	</tr>
<tr>
<td colspan=3>
Броня головы: <span id='tnmhead'><?=$enemy_stat['br1'];?></span><br>
Броня рук: <span id='tnmhands'><?=$enemy_stat['br4'];?></span><br>
Броня торса: <span id='tnmtorso'><?=$enemy_stat['br2'];?></span><br>
Броня ног: <span id='tnmlegs'><?=$enemy_stat['br5'];?></span><br>
</td>
</tr>
</table>
		<?
		echo "<script language=\"JavaScript\">sdll('tdoll','".$ppart['damaged_h']."','".$ppart['damaged_t']."','".$ppart['damaged_l']."','".$ppart['damaged_r']."','".$ppart['damaged_le']."');</script>";
	}
	?>
