<?php

$now=time();

include("inc/db_connect.php");

$stat = mysql_fetch_array(mysql_query("SELECT * FROM `players` WHERE user='".addslashes($user)."' AND pass='".addslashes($pass)."'"));

$inf_nast = mysql_fetch_array(mysql_query("SELECT * FROM `players` WHERE id='".$stat['nastavnik']."'"));
mysql_query("SET CHARSET cp1251");

mysql_query("UPDATE players SET lpv=$now WHERE user='".$stat['user']."'");

$user_offer=mysql_fetch_array(mysql_query("select offers.time,offers.type,participants.side from offers, participants where offers.time>$now and offers.done=0 and participants.time=offers.time and participants.id=$stat[id]"));
if ($Attack) {

	if (empty($login)) $msg = "������� ����� ������ ����������!";
	else {
		$chl=mysql_fetch_array(mysql_query("SELECT id, v_time, k_time, user, room, level, hp_now, battle, last_battle, vitality, travma, rank, lpv, rase_skill FROM players where user='".addslashes($login)."'"));

		if ($chl['user'] == $stat['user']) $msg="���� �� ������ ��������� � ������ ����?";
		elseif ($stat['level'] > 5) $msg="������� �� ����� �������, ���� ��������� � �����������������";
		elseif ((time()-$chl['lpv'])>120) $msg="� ��������� �������� <u>".$chl['user']."</u> ����������� � ����, �� �� ����� ��� ������!";
		//						elseif (($chl['level']-$stat['level'])>3) $msg="���� ��� ������ ���!��������� �� ������� ����!";

		else {

			require_once("inc/chat/functions.php");
			insert_msg("�������� <b><u>$stat[user]</u></b> ������ ��� � ���� ����������, ��������� ��� � ���� ����� ����� ��������������!","","","1",$chl['user'],"",$chl['room']);

			 
			mysql_query("UPDATE players SET nastavnik=".$chl['id']." where id=$stat[id]");
			$msg="<font style='FONT-SIZE: 13pt'>��������!</font><BR><BR>�� ������ ��� ������� � ����������, ��������� <u>".$inf_nast['user']."</u>.";


		}
	}
}




if ($nast) {

	if (empty($login)) $msg = "������� ����� ������ �������!";
	else {
		$chl=mysql_fetch_array(mysql_query("SELECT id, v_time, k_time, user, room, level, hp_now, battle, last_battle, vitality, travma, rank, lpv, rase_skill FROM players where user='".addslashes($login)."'"));

		if ($chl['nastavnik'] > 0) $msg="� ��������� ��� ������� ��������� :)";
		elseif ($chl['level'] > 5) $msg="�������� ��� �� ��������� � ����� ������!";
		elseif ($stat['level'] < 6) $msg="��� ������� ������ ���� �� ���� 6";
		elseif ((time()-$chl['lpv'])>120) $msg="� ��������� �������� <u>".$chl['user']."</u> ����������� � ����, �� �� ������ :(";
		//						elseif (($chl['level']-$stat['level'])>3) $msg="���� ��� ������ ���!��������� �� ������� ����!";

		else {

			require_once("inc/chat/functions.php");
			insert_msg("��������� <b><u>$stat[user]</u></b> ��������� ��� ���� ������, ���� �� �����������, �� ����� �������� ��� �������� � �������� �� ���� �������� �� ����!����� ������� ����������� ���������� ������ �� ������� -������ ����������- ","","","1",$chl['user'],"",$chl['room']);
			 

			$msg="<font style='FONT-SIZE: 13pt'>��������!</font><BR><BR>�� ������ ��� ��������� ����������� ������� ��� � ����������, ��������� <u>".$chl['user']."</u>.";

		}
	}
}



if (isset($take2)) {
	if ($stat[nastavniksps]<1) $msg="�� ��� ������������� ����������!";
	else {
		mysql_query("UPDATE players SET nastavniksps=0 WHERE user='".$stat['user']."'");
		$stat['nastavniksps'] = 0;

		$resurs=array();
		$resurs[0]="alexandrit";
		$resurs[1]="almaz";
		$resurs[2]="amazonit";
		$resurs[3]="biruza";
		$resurs[4]="pirit";
		$resurs[5]="opal";
		$resurs[6]="rubin";
		$resurs[7]="sapfir";
		$res_type=$resurs[rand(0,7)];


		$ItTake = $res_type;

		$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));

		$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|������� �� ������ ������� - ".$stat[user]."|0|$buyitem[art]|0|1";
		$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";

		mysql_query("INSERT INTO objects (`user`, `inf`, `min`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`,`tip`,`about`) values ('$inf_nast[user]','$inf','$min','$buyitem[br1]','$buyitem[br2]','$buyitem[br3]','$buyitem[br4]','$buyitem[br5]','$buyitem[min]','$buyitem[max]','$buyitem[hp]','$buyitem[energy]','$buyitem[strength]','$buyitem[dex]','$buyitem[agility]','$buyitem[vitality]','$buyitem[razum]','$buyitem[krit]','$buyitem[unkrit]','$buyitem[uv]','$buyitem[unuv]','$now','$buyitem[tip]','$buyitem[about]')");

			
		$msg="<font style='FONT-SIZE: 13pt'>�������!</font><BR><BR>�� ������ ��� ������������� ������ ����������, ������� ��� <u>".$buyitem['title']."</u>. <br>��� ����� �� ���������� �� ����� ����������� � ���� ������ ���� ����������� � ����� ������� �������";


	}
}




include("inc/html_header.php");
echo"
<body bgcolor=F5FFD9 leftmargin=0 topmargin=0>
<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td align=right valign=top>
<img src='i/refresh.gif' style='CURSOR: Hand' alt='��������' onclick='window.location.href=\"nastavnik.php?tmp=\"+Math.random();\"\"'>
<img src='i/back.gif' style='CURSOR: Hand' alt='���������' onclick='window.location.href=\"main.php?tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";


echo"<body bgcolor=#EBEDEC leftmargin=0 topmargin=0>
<DIV id=hint1></DIV>
<div id=mainform style='position:absolute; left:30px; top:30px'></div>";
echo"<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/time.js\"></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/show_inf.js\"></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/login_form.js\"></SCRIPT>";

echo"</td>
</tr>
</table>";






echo"
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td align=right>
";



echo"
<fieldset style='WIDTH: 98.6%'><legend>����� ����������</legend>
<table width=100% cellspacing=0 cellpadding=5>
<tr>
<td align=center> <center><font class=title>���������� � �������</font></center><br>
";
if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";





echo"


<!-- ��������� -->



<b>����������</b><HR color=silver><b>���������</b> - ��� �������, ������� �������� �������� ������ ���� �������� � �������� �� �������� ���� ��� �� ������� �����������������.<br>
�� ���� ����� ��������� �������� �������� �� ������� � �������������, � ��� �� ����������� ������ �� ����.<br> ������ ����� ��������� ����������� ������� �� ������� �������� ����.

";



if ($stat[nastavnik]>0 && $stat[level]<=5) echo'<br><center><font color=red><b>��� ���������
</b><li>'.$inf_nast[user].'</li>  ['.$inf_nast['level'].']<a href=\'inf.php?'.$inf_nast['id'].'\' target=_blank><IMG SRC=\'i/inf.gif\' BORDER=0 ALT=\'���������� � '.$inf_nast['user'].'\' width=11 height=11></a></font></center>���� ��� ��������� �� �������� ��� ��������, ��������, �� ������ ������� ���.<br>���� �� �� �������� ����� �����������, �� ������� ��� �������������, �� ������ ����� ����, ��� ���������� �����. � ��� ���� ������� ���� �����������!';







echo"
<td align=center>
<table cellspacing=0 cellpadding=0 border=0 width=100%>
<tr>
<td width=170 align=right valign=top>
<!-- ����������� -->
<table cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1 width=150>
<tr>
<td align=center >
<b>���������</b><HR color=silver>


";
if ($stat[level]<=4 && $stat[nastavniksps]>0) echo"
<input type=button class=input value='������� ����������' style='WIDTH: 120px' onclick=\"javascript:ShowForm('������� ����� ���������� ','nastavnik.php?Attack=$now','','','1','attack','1','0');\">
<br>";

if ($stat[level]>4) echo"
<input type=button class=input value='���������� ������' style='WIDTH: 120px' onclick=\"javascript:ShowForm('������� ����� ���������� ','nastavnik.php?nast=$now','','','1','nast','1','0');\">
<br>";



if ($stat[level]>4 && $stat[nastavniksps]>0 && $stat[nastavnik]>0) echo"
<input type='button' value='������������� ����������!' class=input onclick=\"if (confirm('�� ������������� ������ ������������� ������ ���������� ������ ������?')) window.location='nastavnik.php?take2='+Math.random();\"\" >";

echo"</td>
</tr>
</table>
<!-- ����� ������������ --> 
</table>

</td>
</tr>
</table>
";

?>