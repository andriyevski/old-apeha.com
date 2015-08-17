<?php /*$stat=mysql_fetch_array(mysql_query("select * from players where user='".htmlspecialchars(addslashes($_SESSION['user']), ENT_QUOTES)."' and pass='".htmlspecialchars(addslashes($_SESSION['pass']), ENT_QUOTES)."'"));*/?>
<table width="259" height="393" border="0" cellpadding="0"
	cellspacing="0">
	<tr>
		<td colspan="3" background="i/pri_01.gif" align="center">

		<table border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="32" height="30"><img border="0"
					src="i/pers_name_left.gif" width="32" height="30"></td>
				<td height="30" background="i/pers_name_center.gif" valign="middle"
					align="center"><font face='Verdana' size='1' color='#ffffff'><b> <?
					echo "<script language=JavaScript>";
					if ($set=="edit") echo"var edit_page=1;"; else echo"var edit_page=0;";
					echo "show_inf('$stat[user]','$stat[id]','$stat[level]','$stat[rank]','$stat[tribe]');
</script>";
					if ($stat['obraz']) $obraz=$stat['obraz']; else $obraz=$stat['rase']."/".$stat['sex'];

					include('inc/main/alt.php');
					?> </b></font></td>
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
				<td width='192' height='8' id=info></td>
				<script language=javascript>
setsHP(<?$hp=$stat['hp_now'];echo "$hp,$hp_max,100"?>);

var rnd = Math.random();
//-- Смена хитпоинтов
	// Каждые 123сек. увеличение HP на 1%
var delay = 41;
var redHP = 0.33;	// меньше 30% красный цвет
var yellowHP = 0.66;    // меньше 60% желтый цвет, иначе зеленый
var TimerOn = -1;	// id таймера
var tkHP, maxHP;
var speed=1000;
var mspeed=100;

function setsHP(value, max, newspeed) {
	tkHP=value; maxHP=max;
	if (TimerOn>=0) { clearTimeout(TimerOn); TimerOn=-1; }
	speed=newspeed;
	setHPlocal();
}
function setHPlocal() {
	if (tkHP>maxHP) { tkHP=maxHP; }
	var le=Math.round(tkHP)+"/"+maxHP;
	le=192;
	var sz1 = Math.round(((le-1)/maxHP)*tkHP);
	var sz2 = le - sz1;
		if (tkHP/maxHP < redHP) { imag="img/icon/red.gif"; }
		else {
			if (tkHP/maxHP < yellowHP) { imag="img/icon/yellow.gif"; }
			else { imag="img/icon/green.gif"; }
		}
        rhp=Math.round(tkHP)+"/"+maxHP;
	
	
	TimerOn=-1; 

info.innerHTML="<img src='"+imag+"' title='"+rhp+"' width="+sz1+" height='8'><img src='img/icon/grey.gif' alt='Уровень жизни "+rhp+"' width="+sz2+" height='8'>";

}


function showMN(min, max){
	perc=max/99;
	n=max-min;
	m2=Math.floor(min/perc);
	m1=Math.floor(99-m2);
	if(m2==100){m2=95;}
	color='img/icon/blue.gif'
		energ.innerHTML="<img src="+color+" title='"+min+"/"+max+"' height=7 width="+m2+"%><img src='img/icon/grey.gif' title='"+min+"/"+max+"' height=7 width="+m1+"%>";
	}

</script>

				<td width="4" height="8"><img border="0" src="i/pers_name_hp03.gif"
					width="4" height="8"></td>
			</tr>

		</table>
		</td>
		<td><img src="i/pers1_12.gif" width="30" height="8" alt=""></td>
	</tr>
	<tr>
		<td><img src="i/pers1_13.gif" width="29" height="1" alt=""></td>
		<td><img src="i/pers1_14.gif" width="200" height="1" alt=""></td>
		<td><img src="i/pers1_15.gif" width="30" height="1" alt=""></td>
	</tr>
	<tr>
		<td><img src="i/pers1_16.gif" width="29" height="7" alt=""></td>
		<td>

		<table border="0" width="200" height="7" cellspacing="0"
			cellpadding="0" background="i/pers_name_ua02.gif">
			<tr>
				<td width="4" height="7"><img border="0" src="i/pers_name_ua01.gif"
					width="4" height="7"></td>
				<td width='192' height='7' id='energ'></td>
				<script language=javascript>
showMN(<?$ustal=$stat['ustal_now'];echo "$ustal,$ustal_max"?>);
	</script>
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
<td valign=top id='swleft'>
<script language=JavaScript>
view_item('".$w_img['1']."','w1','60','40',\"".$w['1']."\",1);
view_item('".$w_img['3']."','w3','60','60',\"".$w['3']."\",1);
view_item('".$w_img['4']."','w4','60','60',\"".$w['4']."\",1);
view_item('".$w_img['13']."','w13','60','40',\"".$w['13']."\");
</script>
</td>
<td align=center width=80><img src='i/img/".$obraz.".gif' border=0 width=80 height=200 onmouseover=\"it('".$stat['user']."');\" onmouseout=\"c();\"></td>
<td valign=top id='swright'>
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
<td align='center' id='slpacket'>
        <script language=JavaScript>
view_item('".$w_img['17']."','w17','44','30',\"".$w['17']."\",0,'".$w_title['17']."','".$w_id['17']."');
</script>
</td>
<td align=center id='sdoll'></td>
<td align='center' id='srpacket'>
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
Броня головы: <span id='snmhead'><?=$stat['br1'];?></span><br>
Броня рук: <span id='snmhands'><?=$stat['br4'];?></span><br>
Броня торса: <span id='snmtorso'><?=$stat['br2'];?></span><br>
Броня ног: <span id='snmlegs'><?=$stat['br5'];?></span><br>
</td>
</tr>
</table>
