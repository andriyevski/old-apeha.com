<?


echo"
<DIV ID=form style='position:absolute; visibility:hidden'></DIV>

<SCRIPT LANGUAGE=\"JavaScript\">
<!--
function present (id, title) {

        var x, y, obj;

        obj = document.getElementById('f_'+id);
        for(i=obj, x=0, y=0; i; i = i.offsetParent)
        {
        x += i.offsetLeft;
        y += i.offsetTop;
        }

        form.style.left = x-123;
        form.style.top = y;

        document.all('form').style.visibility        = 'visible';
        document.all('form').innerHTML                        = '<TABLE BGCOLOR=e2e0e0 bordercolor=A5A5A5 border=1 cellspacing=0 cellpadding=3 style=\'CURSOR: Default;\'><FORM action=\'gshop.php?otdel=".$_GET['otdel']."\' method=POST><tr><td style=\'BORDER-RIGHT: 0px; BORDER-BOTTOM: 0px; padding-left:7;\'>Подарить персонажу</td><td style=\'BORDER-LEFT: 0px; BORDER-BOTTOM: 0px; padding-right:7;\' align=right><input type=text class=input size=32 name=present_user></td></tr><tr><td style=\'BORDER-RIGHT: 0px; BORDER-BOTTOM: 0px; BORDER-TOP: 0px; padding-left:7;\'>с пожеланием</td><td style=\'BORDER-LEFT: 0px; BORDER-BOTTOM: 0px; BORDER-TOP: 0px; padding-right:7;\' align=right><input type=text class=input size=32 name=present_text></td></tr><tr><td colspan=2 style=\'BORDER-TOP: 0px; padding-left:7;\'><table width=100% cellspacing=0 cellpadding=0 border=0><TR><TD width=70>от имени:</TD><TD><INPUT TYPE=HIDDEN name=present_id value=\''+id+'\'><input type=radio checked name=present_who value=1><b>".$stat['user']."</b><BR>";

if ($stat['tribe']) echo"<input type=radio name=present_who value=2>Клан <b><img src=\'i/klan/".$stat['tribe'].".gif\'>".$stat['tribe']."</b><BR>";

echo"<input type=radio name=present_who value=3><i>аноним</i><BR></TD></TR></TABLE></td></tr><tr><td colspan=2 align=center><input type=submit value=\'Подарить\' name=\'present_submit\' class=input style=\'WIDTH: 308px\'></td></tr></FORM></table>';

}
//-->
</SCRIPT>
";


$it_sost=mysql_query("SELECT objects.* FROM objects, slots where objects.user='".$stat['user']."' AND (objects.inf like ('byket%') OR objects.inf like ('otkr%') OR objects.inf like ('podarok%')) AND slots.id=".$stat['id']." AND objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) AND objects.present=0 order by time desc");

echo"<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=A5A5A5>";

for($i=0; $i<mysql_num_rows($it_sost); $i++) {
	$objects=mysql_fetch_array($it_sost);

	$obj_inf=explode("|",$objects['inf']);
	$obj_min=explode("|",$objects['min']);
	$obj_add=explode("|",$objects['add']);

	###ПОКАЗЫВАЕМ ИНФУ О ПРЕДМЕТЕ
	include('inc/main/min_tr.php');
	include('inc/main/add.php');
	include('inc/main/classes.php');
	###

	echo"
<tr><td width=33% align=center valign=center>
<a href='' target=_blank><b>$obj_inf[1]</b></a><br><br>
<b>Гос. цена: $obj_inf[2] золотых</b><br>";

	if ($objects['tip'] == 14) echo"Долговечность предмета: $obj_inf[6] [$obj_inf[7]]<br>";

	echo"
Тип предмета: <i>$tip</i><br>
</td>
<td width=34% align=center>
<img src='".$img_server."/i/items/$obj_inf[0].gif' alt='$obj_inf[1]'>
<br>";

	if ($obj_inf['3'] == 12) echo"<font color=red><b>Этот предмет <u>не подлежит</u> продаже!</b></font>";
	else echo"<span onclick=\"present(".$objects['id'].",'".$obj_inf['1']."');\" style='CURSOR: Hand' id='f_".$objects['id']."'><b>Подарить</b></span>";

	echo"</td>
<td width=33% valign=top>";

	if ($min_rase || $min_level || $min_str || $min_dex || $min_ag || $min_vit) echo"<b><i>Минимальные требования:</i></b><br>
	$min_rase$min_level$min_str$min_dex$min_ag$min_vit<br>"; else echo"&nbsp;";

	if ($hp || $energy || $min || $max || $strength || $dex || $agility || $vitality || $razum || $br1 || $br2 || $br5 || $br3 || $br4 || $krit || $unkrit || $uv || $unuv) echo"<b><i>Действие предмета:</i></b><br>
	$hp$energy$min$max$strength$dex$agility$vitality$razum$br1$br2$br5$br3$br4$krit$unkrit$uv$unuv";

	if ($about or $dotime) echo"<b><i>Дополнительная информация:</i></b><br>$about$dotime";

	echo"</td></tr>";
}


echo"</table>";

?>