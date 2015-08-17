<?
$now=time();

if ($info['obraz']) $obraz=$info['obraz']; else $obraz=$info['rase']."/".$info['sex'];


$get=1;


$hp_max=ceil(($info['vitality']*5+$info['hp'])*(1+($info['gnom']/100)));

$_vt=$info['v_time']-$now;
$_hp=$hp_max-(round($_vt*$hp_max/300));

// Определение текущего колличества HP
if (!$info['v_time'] and $info['hp_now']<$hp_max) $hp=$info['hp_now'];
elseif ($info['v_time'] and $_hp<$hp_max) { $vt=$info['v_time']-$now; $hp=$hp_max-(round($vt*$hp_max/300)); }
else $hp=$hp_max;
//

$widthhp=$hp/$hp_max*172;
if ($widthhp=="0") $widthhp=$widthhp+2;
elseif ($widthhp=="1") $widthhp=$widthhp+1;
elseif ($widthhp>"1") $widthhp=$widthhp-1;


$ustal=$info['ustal_now'];
$ustal_max = $info['power']*5;

$widthustal=$ustal/$ustal_max*172;
if ($widthustal=="0") $widthustal=$widthustal+2;
if ($widthustal=="1") $widthustal=$widthustal+1;
if ($widthustal>"1") $widthustal=$widthustal-1;
?>
<!-- Start table PERS-->
<table width="259" height="406" border="0" cellpadding="0"
	cellspacing="0">
	<tr>
		<td></td>
		<td><img src="i/pers1_02.gif" width="200" height="13" alt=""></td>
		<td></td>
	</tr>
	<tr>
		<td colspan="3" background="i/pers1_name_fon.gif" width="259"
			height="30" align="center" valign="bottom">
		<table border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="32" height="30"><img border="0"
					src="i/pers_name_left.gif" width="32" height="30"></td>
				<td height="30" background="i/pers_name_center.gif" valign="middle"
					align="center"><font face='Verdana' size='1' color='#ffffff'><b> <script
					language=JavaScript>
<?
echo"show_inf('".$info['user']."','".$info['id']."','".$info['level']."','".$info['rank']."','".$info['tribe']."');";
?>
</script></b></font></td>
				<td width="32" height="30"><img border="0"
					src="i/pers_name_right.gif" width="32" height="30"></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td><img src="i/pers1_07.gif" width="29" height="8" alt=""></td>
		<td><img src="i/pers1_08.gif" width="200" height="8" alt=""></td>
		<td><img src="i/pers1_09.gif" width="30" height="8" alt=""></td>
	</tr>
	<tr>
		<td><img src="i/pers1_10.gif" width="29" height="8" alt=""></td>
		<td>
		<table border="0" width="200" height="8" cellspacing="0"
			cellpadding="0" background="i/pers_name_hp02.gif">
			<tr>
				<td width="4" height="8"><img border="0" src="i/pers_name_hp01.gif"
					width="4" height="8"></td>
				<td width='192' height='8' id=info></td>
				<script language=javascript>
setsHP(<?echo "$hp,$hp_max,100"?>);

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
info.innerHTML="<img src='"+imag+"' title='"+rhp+"' width="+sz1+" height='8'><img src='img/icon/grey.gif' alt='Уровень жизни "+rhp+"' width="+sz2+" height='8'>";

}




</script>

<?// echo "<td width='192' height='8'><img src=i/vault/navigation/hp/_helth.gif width='10' height=8 border=0 alt='Уровень жизни: $hp/$hp_max'><img src=i/vault/navigation/hp/helth.gif height='8' width='$widthhp' border=0 alt='Уровень жизни: $hp/$hp_max'><img src=i/vault/navigation/hp/_helth_.gif width='10' height='8' border=0 alt='Уровень жизни: $hp/$hp_max'></td>"; ?>
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
				<td width='190' height='7' id='energ'></td>
				<script language=javascript>
showMN(<?echo "$ustal,$ustal_max"?>);
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

	<?// echo "<td width='192' height='7'><img src=i/vault/navigation/hp/_ustal.gif width='10' height='7' border=0 alt='Уровень активности: $ustal/$ustal_max'><img src=i/vault/navigation/hp/ustal.gif height='7' width='$widthustal' border=0 alt='Уровень активности: $ustal/$ustal_max'><img src=i/vault/navigation/hp/_ustal_.gif width='10' height='7' border=0 alt='Уровень активности: $ustal/$ustal_max'></td>"; ?>
				<td width="4" height="7"><img border="0" src="i/pers_name_ua03.gif"
					width="4" height="7"></td>
			</tr>

		</table>



		</td>
		<td><img src="i/pers1_18.gif" width="30" height="7" alt=""></td>
	</tr>
	<tr>
		<td><img src="i/pers1_19.gif" width="29" height="14" alt=""></td>
		<td><img src="i/pers1_20.gif" width="200" height="14" alt=""></td>
		<td><img src="i/pers1_21.gif" width="30" height="14" alt=""></td>
	</tr>
	<? include('inc/main/alt.php'); ?>
	<tr>
		<td background="i/pers1_22.gif"><img border="0" src="i/pers1_22.gif"
			width="29" height="200"></td>
		<td><?
		if($info['user']=='Femida'){echo"        <table border='0' width='100%' height='100%' cellspacing='0' cellpadding='0'>
          <tr>
<td valign=top>
<script language=JavaScript>
edit_page=2;
view_item('".$w_img['1']."','w1','60','40',\"".$w['1']."\",1);
view_item('".$w_img['3']."','w3','60','60',\"".$w['3']."\",1);
view_item('".$w_img['4']."','w4','60','60',\"".$w['4']."\",1);
view_item('".$w_img['13']."','w13','60','40',\"".$w['13']."\");
</script>
</td>
<td align=center width=80>
<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0\" width=\"80\" height=\"200\"> 
<param name=movie value=\"/i/img/1/1-inet.swf\"> 
<param name=quality value=high> 
<embed src=\"/i/img/1/1-inet.swf\" quality=high pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" width=\"80\" height='200'></embed></object> 
</td>
<td align=center width=62 valign=top>
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
</script>
</td>          </tr>
        </table>
";}
		else{
			echo"        <table border='0' width='100%' height='100%' cellspacing='0' cellpadding='0'>
          <tr>
<td valign=top>
<script language=JavaScript>
edit_page=2;
view_item('".$w_img['1']."','w1','60','40',\"".$w['1']."\",1);
view_item('".$w_img['3']."','w3','60','60',\"".$w['3']."\",1);
view_item('".$w_img['4']."','w4','60','60',\"".$w['4']."\",1);
view_item('".$w_img['13']."','w13','60','40',\"".$w['13']."\");
</script>
</td>
<td align=center width=80>
<img src='i/img/".$obraz.".gif' border=0 width=80 height=200 onmouseover=\"it('".$info['user']."');\" onmouseout=\"c();\">
</td>
<td align=center width=62 valign=top>
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
</script>
</td>          </tr>
        </table>
";
		}
		?></td>
		<td background="i/pers1_24.gif"><img border="0" src="i/pers1_24.gif"
			width="30" height="200"></td>
	</tr>
	<tr>
		<td><img src="i/pers1_25.gif" width="29" height="22" alt=""></td>
		<td><img src="i/pers1_26.gif" width="200" height="22" alt=""></td>
		<td><img src="i/pers1_27.gif" width="30" height="22" alt=""></td>
	</tr>
	<tr>
		<td><img src="i/pers1_28.gif" width="29" height="66" alt=""></td>
		<td background="i/inf_000.gif" align="center"><?
		$cur_rum = $info['room'];
		include ('inc/rooms.php');

		if (time() - $info['lpv'] <= 600 || $info['rank'] == 60)
		echo"<small>Персонаж сейчас находится в клубе.
<BR><b>\"$roomname[$cur_rum]\"</b></small>";
		else
		echo"<small>Персонаж не в клубе, но был тут:<br>
<b>".date('d.m.y H:i:s',$info['lpv'])."</b></small>";

		if ($info['battle']) echo"<br><small>Персонаж в <a href='view_logs.php?log=$info[battle]' target=_blank><small>поединке</small></a></small>";
		if ($info['user']=='Enchanter') echo"<br><font color=red><b>Журналист проэкта</b></font>";
		if ($info['user']=='migon') echo"<br><font color=red><b>Главный администратор</b></font>";
		?></td>
		<td><img src="i/pers1_30.gif" width="30" height="66" alt=""></td>
	</tr>
	<tr>
		<td><img src="i/pers1_31.gif" width="29" height="37" alt=""></td>
		<td><img src="i/pers1_32.gif" width="200" height="37" alt=""></td>
		<td><img src="i/pers1_33.gif" width="30" height="37" alt=""></td>
	</tr>
</table>



<!-- End table PERS -->
