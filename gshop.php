<?
session_start();
require_once("inc/module.php");
$error=="";
$msg=="";

if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";


else { if (!isset($_GET['otdel'])) $_GET['otdel']=1;
if (!preg_match("/^[0-9]+$/", $_GET['otdel']))
$error='������: ����������� ������';

if (@$_POST['present_submit']) {

	if ($_POST['present_who'] != 1 && $_POST['present_who'] != 2 && $_POST['present_who'] != 3) $_POST['present_who'] = 1;
	if (!$stat['tribe'] && $_POST['present_who'] == 2) $_POST['present_who'] = 1;

	if (empty($_POST['present_user']) || preg_match("/[^(\w)|(\x7F-\xFF)|(\s)|(\<>)|(\|(\<)|(\>)|(\%3B)|(\")|]/",$_POST['present_user'])) $error="������� ����� ���������, �������� �� ������ ������� �������!";
	else {
		$CharInfo = mysql_fetch_array(mysql_query("SELECT user FROM players WHERE user='".addslashes($_POST['present_user'])."'"));
		if (empty($CharInfo['user'])) $error="�������� <u>$present_user</u> �� ������!";
		elseif ($CharInfo['user'] == $stat['user']) $error="������ �������� ���-���� ������ ����!";
		elseif ($stat['level']<4) $error="� ��� ������� ��������� ������� ����� ������ �������, ����������� �������: 4";
		else {
			if (!preg_match("/^[0-9]+$/", $_POST['present_id']))
			$error='������: ����������� ������';
			else{
				if (mysql_num_rows(mysql_query("SELECT id FROM objects WHERE id=".addslashes($_POST['present_id'])." AND user='".$stat['user']."'"))) {

					$ObjInfo = mysql_fetch_array(mysql_query("SELECT inf FROM objects WHERE id=".addslashes($_POST['present_id'])." AND user='".$stat['user']."'"));

					$ObjInfo = explode("|",$ObjInfo['inf']);

					if (mysql_num_rows(mysql_query("SELECT * FROM prizes WHERE id=".addslashes($_POST['present_id']).""))) $error="���� ������� ��� ��� ������� �����!";
					elseif ($ObjInfo['5']) $error="�� �� ������ ������ ���������!";
					else {

						switch ($_POST['present_who']) {
							case 1: $present_who = "user"; break;
							case 2: $present_who = "tribe"; break;
							case 3: $present_who = "anonim"; break;
						}

						$present_text = HtmlSpecialChars($_POST['present_text']);


						$prez=mysql_query("INSERT INTO prizes values('".$CharInfo['user']."','".$stat['tribe']."','".addslashes($present_who)."','".addslashes($_POST['present_id'])."','".$stat['user']."','".addslashes($present_text)."')");
						$ob=mysql_query("UPDATE objects SET user='".$CharInfo['user']."' WHERE id=".addslashes($_POST['present_id'])." AND user='".$stat['user']."'");
						if ($prez && $ob)
						$msg="������� ������� � <u>".$CharInfo['user']."</u>!";
						else
						$error="������� �� �������";
					}
				}
			}
		}
	}
}




if (!empty($_GET["buy"]) && preg_match("/^[-a-zA-Z0-9_\s]+$/",$_GET["buy"])) {

	switch ($_GET['otdel']) {
		case 1: $cat = 100; break;
		case 2: $cat = 101; break;
	}


	$buyitem=mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".addslashes($_GET["buy"])."'"));
	$shop_sost=mysql_fetch_array(mysql_query("SELECT * FROM shop WHERE city='".$stat[city]."' and otdel='".addslashes($cat)."' and name='".addslashes($_GET["buy"])."'"));

	if (empty($shop_sost['name'])) $error="������� �� ������ � ��������!";
	elseif ($buyitem[price]>$stat[credits]) $error="� ��� ������������ ����� ��� ������� �������� <u>".$buyitem['title']."</u>";



	else {

		if ($shop_sost['kol'] > 0) {

			$stat['credits']-=$buyitem['price'];

			if ($buyitem['tip'] == 14 && $buyitem['slot2'] == "w5") $secondary=1; else $secondary=0;
			###����� � ���������
			$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|0|$secondary|$buyitem[art]|0|$buyitem[iznos]";
			$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";

			$lifetime=$now+$buyitem['life'];

			mysql_query("INSERT INTO objects (`user`, `inf`, `min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`,`life`) values ('$stat[user]','$inf','$min','$buyitem[tip]','$buyitem[br1]','$buyitem[br2]','$buyitem[br3]','$buyitem[br4]','$buyitem[br5]','$buyitem[min]','$buyitem[max]','$buyitem[hp]','$buyitem[energy]','$buyitem[strength]','$buyitem[dex]','$buyitem[agility]','$buyitem[vitality]','$buyitem[razum]','$buyitem[krit]','$buyitem[unkrit]','$buyitem[uv]','$buyitem[unuv]','$now','$lifetime')");

			mysql_query("update shop, players set shop.kol=shop.kol-1, players.credits=players.credits-$buyitem[price] where shop.name='".addslashes($_GET["buy"])."' && players.user='".$stat['user']."'");

			$msg="�� ������ ������� <u>".$buyitem['title']."</u> �� <u>".$buyitem['price']."</u> ��.";

		}}



}




function show ($id) {
	global $stat;

	switch ($id) {
		case 1: $cat = 100; break;
		case 2: $cat = 101; break;
	}


	$item=mysql_query("SELECT items.*, shop.kol FROM items, shop WHERE shop.city='".$stat[city]."' and shop.otdel=".addslashes($cat)." AND shop.kol>0 AND items.name=shop.name");

	echo "<TABLE border=1 width=100% cellspacing=0 cellpadding=5 bordercolor=A5A5A5>";

	while ($iteminfo = mysql_fetch_array($item)) {

		if ($id == 2) include("inc/main/items.php");

		echo"<tr><td width=33% align=center valign=center>
<a href='' target=_blank><b>".$iteminfo['title']."</b></a><br><br>
<b>���. ����: ".$iteminfo['price']." �������</b><br><br>";

		if ($id == 2) echo"������������� ��������: 0 [".$iteminfo['iznos']."]<br>";

		echo"<b><small style='COLOR: Red'>������� �� �������� �������</small></b><BR>";

		echo"<BR>���� �����: <b STYLE='COLOR: Red'>",$iteminfo['life']/86400," ��.</b><BR>";



		echo"
<br>����������: <u>".$iteminfo['kol']."</u> ��.<br>
</td>
<td width=34% align=center>
<img src='i/items/".$iteminfo['name'].".gif' alt='$iteminfo[title]'>
<br>
<span onclick=\"if (confirm('������ ������� &quot;$iteminfo[title]&quot;?')) window.location='gshop.php?otdel=$_GET[otdel]&buy=$iteminfo[name]'\" style='CURSOR: Hand'><b>������</b></a></td>
<td width=33% valign=top align=left>";


		if ($min_rase || $min_level || $min_str || $min_dex || $min_ag || $min_vit || $min_razum || $min_proff) echo"
<b><i>����������� ����������:</i></b><br>
		$min_rase$min_level$min_str$min_dex$min_ag$min_vit$min_razum$min_proff<br>"; else echo"&nbsp;";

		if ($hp || $energy || $min || $max || $strength || $dex || $agility || $vitality || $razum || $br1 || $br2 || $br5 || $br3 || $br4 || $krit || $unkrit || $uv || $unuv) echo"<b><i>�������� ��������:</i></b><br>
		$hp$energy$min$max$strength$dex$agility$vitality$razum$br1$br2$br5$br3$br4$krit$unkrit$uv$unuv<br>";

		echo"</td></tr>";

	}

	echo"</TABLE>";


}

echo"
<body background='/i/bg.gif' leftmargin=0 topmargin=0>

<DIV ID=hint1></DIV>

<SCRIPT src='i/show_inf.js'></SCRIPT>
";


print"<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td>&nbsp;&nbsp;<b>� ��� �� �����:</b> <u>".$stat['credits']."</u> <b>��.</b>
</td>
<td align=right valign=top>

<input class=lbut type=button value='��������' onclick='window.location.href=\"gshop.php?otdel=$_GET[otdel]&tmp=\"+Math.random();\"\"'>

<input class=lbut type=button value='���������' onclick='window.location.href=\"world.php?room=0&tmp=\"+Math.random();\"\"'>&nbsp;

</td>
</tr>
</table>";


echo"
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td align=center>
<font class=title>������� ��������</font><br><br>";

if ($error!="") echo"<center><font color=red><b>$error</b></font></center><br>";
if ($msg!="") echo"<center><font color=green><b>$msg</b></font></center><br>";


echo"
<FIELDSET style='WIDTH: 98.6%'><legend>������ ��������</legend>
<table width=100% cellspacing=0 cellpadding=5>
<tr>

<td align=center width=32%><A"; if ($_GET['otdel'] == 1) echo" disabled><b>"; else echo" HREF='gshop.php?otdel=1'>"; echo"�������� / �������</b></A></td><td width=1% align=center><b>|</b></td>
<td align=center width=34%><A"; if ($_GET['otdel'] == 2) echo" disabled><b>"; else echo" HREF='gshop.php?otdel=2'>"; echo"������</b></A></td><td width=1% align=center><b>|</b></td>
<td align=center width=32%><A"; if ($_GET['otdel'] == 3) echo" disabled><b>"; else echo" HREF='gshop.php?otdel=3'>"; echo"�������� �������</b></A></td>

</tr>";


if (!empty($_GET['otdel'])) {
	echo"<TR><TD COLSPAN=5 ALIGN=CENTER><HR COLOR='#CCCCCC'>";

	switch ($_GET['otdel']) {
		case 1: show(1); break;
		case 2: show(2); break;
		case 3: include('inc/shop/gshop.php'); break;
		default: echo"<B STYLE='COLOR: Red'>���-�� ��� �� ���...</B>"; break;
	}

	echo"</TD></TR>";
}


echo"
</table>
</FIELDSET>";






echo"</td>
</tr>
</table>";

}
?>