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
		var is_writer = '����������';
		var is_user = '<?echo $stat[user];?>';
		var st_text = new Array();


		st_text[1.1] = '����������� ����, <?echo $stat[user];?>. �� ���-�� �����?';
		st_text[1.2] = '1. <A HREF=\'#\' OnClick=\'Messaging("2.1","2.2");\'>��� ��?</A><BR>&nbsp;2. <A HREF=\'#\' OnClick=\'Messaging("4.1","4.2");\'>�������� ��� � ������</A><BR>&nbsp;3. <A HREF=\'#\' OnClick=\'Messaging("7.1","7.2");\'>������ ��� ������?</A><BR>&nbsp;4. <A HREF=\'#\' OnClick=\'Messaging("11.1","11.2");\'>� ���� ���� ������� ��� ����?</A>';
		
		
		st_text[2.1] = '���� ����� ��������, � ���� �� ��������� ������� ����� ������.� ������ ���� ������ � ����� ������. �������� � ������� ������� � ��������, �� �������� �������� ��������� � ����� ���������� ����.';
		st_text[2.2] = '1. <A HREF=\'#\' OnClick=\'Messaging("3.1","3.2");\'>������ �� ������ ��� ���</A><BR>&nbsp;1. <A HREF=\'#\' OnClick=\'Messaging("7.1","7.2");\'>�����������, ��� ����� ���������</A><BR>&nbsp;2. <A HREF=\'#\' OnClick=\'Messaging("1.1","1.2");\'>� � ��� ���� ���������, ����!</A>';

		
		st_text[3.1] = '� ���� ��� �� ���� ������ � ��� �������. � �� ������� �������� ������ �� ���� ���-����...';
		st_text[3.2] = '1. <A HREF=\'#\' OnClick=\'Messaging("4.1","4.2");\'>��� ������ ���������� � ������?!</A><BR>&nbsp;2. <A HREF=\'#\' OnClick=\'Messaging("2.1","2.2");\'>������</A>';
		
		
		st_text[4.1] = '����� ������ ���� ��������� ����� ��������! ��� ����� �������� ������ ��������� �������. ������ ����� ��������� � �����, ����� ���������� � ���� ������. ����� � ���� �����, ������ ���������, � ������, �� ���������� ������ � ����� ��������� �� ����� � �����.�� ������ ���, �� ���������� � ���, � �������� ���� ����� ���������� ��������, ������� ���������, ����� ����� ����������� ������ � ����������� ���� ��� � �����!�� �����?!';st_text[4.2] = '1. <A HREF=\'#\' OnClick=\'Messaging("5.1","5.2");\'>��-��, ������?</A><BR>&nbsp;2. <A HREF=\'#\' OnClick=\'Messaging("1.1","1.2");\'>����, ��� �� ��� ����!</A>';
		
		
		st_text[5.1] = '������� �� �������� ����� �� ����, �� ������ ���� �������������� - ����, ��������, ����� � ������������. ��� ������ �� ��, ��� �� ������ ��������� �� ��������� ����� ����.<br><br><B>����</B> - ����� ������ ��������; ��� ������ ���� ����, ��� ������ ����� �� ������ ������ � ����� �������, � ��� ������� ����� ���� ����� � ���.<br><br><B>��������</B> - ������ �� ��, ��� ����� �� ������� ������������� �� ������ ����������, � ����� ��������� ����� �� ������ �������� �� ����..<br><br><B>�����</B> - ����������� ���� ������� ����������� ����, ��������� ����� ������ �����, � ����� ����������� ���� �������� ��� �� ������� ����������.<br><br><B>������������</B> - ���� �� ����� ������� �������������; ��� ������ ������������, ��� ��� ������ � ���� ��������� ����.<br><br>���������, ��� ���� ���������� ������� - ��� ������������ ��������� �������� � ��������� ���� ��������������. �� �����, ���������� �������, ����� �������������� ����� ���������.<br><br>���� ������� ���� ��� � ���� ���� ����������� ��������� ��� ������� ������������:<br><b>���� ����</b> - ��� �� ��� � ����, ������ �� ���� ����� � ���;<br><br><b>�������� �����</b> - �����������, ����������� ����� ��������.������ �� ���� ������� � ���;<br><br><b>����� ��������</b> - ����������� ����������� ����� �����. ������ �� ���� ������������ �����;<br><br><b>������������ �����</b> - ����������� ���� ��������;';
		st_text[5.2] = '1. <A HREF=\'#\' OnClick=\'Messaging("6.1","6.2");\'>� ����� � ������� � ������?!</A><BR>&nbsp;2. <A HREF=\'#\' OnClick=\'Messaging("1.1","1.2");\'>������, �������</A>';
		
		
		st_text[6.1] = '���� ���� �� ������� ��������� ����� � �������, �� ����� ���������� ������� ������ �� ������� ������������ �������������� ����� � ���� ������. ������ 10 �������� ���������� ���������, � ����������, ��� ���� ������� � ������ �������������, ��� ������ ���� ��������� �����������������';
		st_text[6.2] = '1. <A HREF=\'#\' OnClick=\'Messaging("5.1","5.2");\'>� �����</A>';		
		

		st_text[7.1] = '��� � ���� ���� ������?';
		st_text[7.2] = '1. <A HREF=\'#\' OnClick=\'Messaging("5.1","5.2");\'>������ ���������� � ���������������?</A><BR>&nbsp;2. <A HREF=\'#\' OnClick=\'Messaging("10.3","7.2");\'>� ��� ��� ���������� ��� ���������?</A><BR>&nbsp;3. <A HREF=\'#\' OnClick=\'Messaging("10.4","7.2");\'>��� ����������/������������ ������?</A><BR>&nbsp;4. <A HREF=\'#\' OnClick=\'Messaging("10.5","7.2");\'>��� � � ��� ������ ��������?</A><BR>&nbsp;4. <A HREF=\'#\' OnClick=\'Messaging("8.1","8.2");\'>��� ���������� ������?</A><BR>&nbsp;5. <A HREF=\'#\' OnClick=\'Messaging("10.1","10.2");\'>��� � ���� ������ ���������?</A><BR>&nbsp;6. <A HREF=\'#\' OnClick=\'Messaging("10.6","7.2");\'>��� ����� � �����?</A><BR>&nbsp;7. <A HREF=\'#\' OnClick=\'Messaging("1.1","1.2");\'>���, �������</A>';		
				
				
				

		st_text[8.1] = '� ����� ������ ����� �������� ����������, � �������� ���� � �������. ������ ������ ���������� - ��� ���� �� ����������� �������� �� � �����������,������� � ����, ������ - �� ������ ������������ ��� ������ ������ �������, ����������� �� ����� ���������, ������ ������ � ������� � ���� �������� - ��� ��������� ��� ������ ������� � ��������. � ��� ���� ����� ����������?';
		st_text[8.2] = '1. <A HREF=\'#\' OnClick=\'Messaging("9.1","8.2");\'>� ��������� �����</A><BR>&nbsp;2. <A HREF=\'#\' OnClick=\'Messaging("9.2","8.2");\'>� ��������� � ������� ���������</A><BR>&nbsp;3. <A HREF=\'#\' OnClick=\'Messaging("9.3","8.2");\'>� ��������� � ������� �������</A><BR>&nbsp;4. <A HREF=\'#\' OnClick=\'Messaging("9.4","8.2");\'>�� � ������ ������� ����������?!</A><BR>&nbsp;5. <A HREF=\'#\' OnClick=\'Messaging("1.1","1.2");\'>�������, � ��������!</A>';		
				

		st_text[9.1] = '�������� � ���� �� ��������� �� ������ ���� �� ���, �� � ��� ���������� ������������ �������� �� ��������� ��������� ����� ����� � ������. ������� ����� �� ������ ���������� � ������������ ��� <A HREF=\'encicl.php?otdel=20\' target=_blank>������� �� ���� ������</A> ';
		st_text[9.2] = '��� ������ ��������� �� ������ ���������� ������� �����, �������� ������ ������ ������� ������.';
		st_text[9.3] = '�� ������ ���������� ����� ���������� � ��� ����� ����� ������. ��������� �� ������ ������ <A HREF=\'main.php?set=work\'>���</A>';
		st_text[9.4] = '�������� ��� ����� ��!';
			
				
		st_text[10.1] = '� ����� ������ ������������� 2 ����������� ��������: ��������������� � ������������.� 1 ��������� ����� ����, � �� 2 � ������� �� 1 ����� ��������� ���� ������ �������, �������������� ���� �� ��� ����� ���� ���� ��� � ���������������.';
		st_text[10.2] = '1. <A HREF=\'#\' OnClick=\'Messaging("10.6","7.2");\'>� ��� ����� � �����?!</A><BR>&nbsp;2. <A HREF=\'#\' OnClick=\'Messaging("1.1","1.2");\'>�������, � ����� ����</A>';
		st_text[10.3] = '����������� ���� ���������, � ��� �� ����� �������� ���������� � ���� �� ������ ����� �� ������ ���������/���������, � ������� �������� ���������, <center><IMG SRC=\'index/inf.gif\'></center>';
		st_text[10.4] = '���������� ������ ������ ��������� �� ������ ����� �� ������ ������, �� ������ ���������, ��� ��������� ����';
		st_text[10.5] = '� ����� ������ �������� 2 ���� ����: � ������ � � ������. � ���� ������� ��� � ������ ������� �� ����������(1x1), ���������(������ �� ������), ���������(2 ������ � ��������� ������� ������� � ���������).������� � ����� �� ������  ����� �� ������ ��������, � ������� �������� ���������, <center><IMG SRC=\'index/poed.gif\'></center>';			
		st_text[10.6] = '��� ������ � ����� ���� ����� ������ �� ������ ����� ������, � ������� �������� ���������, <center><IMG SRC=\'index/city.gif\'></center>';			

		
		st_text[11.1] = '<? 
		if ($stat[kwest] == 1)  echo '��� 1 ������� - ��� �������� �� ����������������� � �����������. � ������ ���� 3 ��������� ��������������� � �������. ���� ����� �������������� ������������ ��. �� ������ ���������� �� ����� ������� � ���������� � ����������, ��������� ��� �������.�� �� �� ������� � ���� ������ ���������.<br><i>������ ������: �� ��������</i>'; 		 
		if ($stat[kwest] == 2)  echo '�� ������� ��������� � ���� 1 ��������, � ��� ���� <b>��� ���������</b>. ������ ���� ���� ����� ���. ��� � ���� ��� ��������� �������. �� ������ ���������� �� ����� ������� � ���������� � ����������, ��������� ��� �������.�� �� �� ������� � ���� ������ ���������.<br><i>������ ������: �� ��������</i>'; 
		if ($stat[kwest] == 3)  echo '���������, �� ������� ��������� � � ���� ��������.<br>������ ����� ����� ���������� � ����� 1 �������, �����, ���� ����� ������ ������ ��� �����������!!! <br>������� �� ���������� ��� �������...�����!  <br>�� ������ ���������� �� ����� ������� � ���������� � ����������, ��������� ��� �������.�� �� �� ������� � ���� ������ ���������.<br><i>������ ������: �� ��������</i>'; 
		if ($stat[kwest] == 4)  echo '���������� � ����� �������, �� ��� � � ���� �����.<br>�� ���� ��� ����� ���� � ���� ����� ���������� ����������. ������ ���� ���� - ������� 20 ������ �����. �����!  <br>�� ������ ���������� �� ����� ������� � ���������� � ����������, ��������� ��� �������.�� �� �� ������� � ���� ������ ���������.<br><i>������ ������: �� ��������</i>'; 
		if ($stat[kwest] == 5)  echo '�������, �������� ��� ����� ������� ����, ������ � ������������ ����, ���������� � �������� ���������� ������ ������� �� ����� ���� � �����! �������, � ������ ���� ������� ��������� ���������� ��������������..�� �� ��������!<br>� ��������� ��� ���� ���������� � �������� ������ �������� ������ ������, � �� � ��� ����� ��������� �� 1 ������, � �������� ���������� ���, � ���� ������� ���� ��������� �������������� � ������ ��������� ���������� ������.�������� ����� ������ �� 1 ������...<br><i>������ ������: �� ��������</i>';
		if ($stat[kwest] == 6)  echo '�� ��� ������� ��������� �������. ������ �������� �� ���� ��������������, � ������ ���� +3 � ���������� ��������������� � +1 � ������������<br>������, �� ����� ������� ���� � �� ������ �������� �� ����...<br> � ���� ���� ���� ����� �������.���� ����� ����� ������ ���� ���� - ��������.������ ��� �� ������ � ����� ��������, ��, ���� �������...���� ��� ��� 1 ������ �������������� ������� - �������������� 20 MP, � �� � ��� ����������� ��� ���� ������<br><i>������ ������: �� ��������</i>';
		if ($stat[kwest] == 7)  echo '������� ��� ����� ����, � ���� �������, ��� � ��������� � ���� ������.��� ��������� � ���������. ����� �� ���, � ���� ���� ��� ���� �������';
		?>';
		st_text[11.2] = '1. <A HREF=\'?act=vipolnil\'>� �������� ���� �������</A><BR>&nbsp;2. <A HREF=\'#\' OnClick=\'Messaging("1.1","1.2");\'>� �������� ���������!</A>';
		
		
		st_text[12.1] = '<? if ($stat[updates]< 1) { echo "���"; } echo "���"; ?>';
		st_text[12.2] = '1. <A HREF=\'#\' OnClick=\'Messaging("11.1","11.2");\'> �������, � ���� ��� �������?</A>';		

		


		
		
		
		st_text[122.1] = '� ����� ���� ��������� ����, � ������� ������ ��� ������ ����������, � �� ��� ������ �����. ������� ��������� �� �������� ��� ��������, �� ����������. � ������, ��� ������ � <B>�����</B> ������� <B>������</B>, ������� ����� ������ <B>������������ �����</B>, ������������� �������� ����. �� ����, ��� � ����� ������� ����� �������, ������� ����� �������� ���� ��������� ���������� � �������.';
		st_text[122.2] = '1. <A HREF=\'#\' OnClick=\'top.nav("taverna.php?GQuest4=1");\'>� ������</A><BR>&nbsp;2. <A HREF=\'#\' OnClick=\'Messaging("1.1","1.2");\'>� �� ��������</A>';
		Messaging(1.1,1.2);
		//-->
		</SCRIPT> <?


		if ($act=="vipolnil") {
			if ($stat[kwest]==1) {
				if ($stat[updates]<1) {
					mysql_query("UPDATE players set kwest=2 where id=$stat[id]");

					$ItTake = "knife1";
					$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));
					$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|������� � ����, ��������|0|$buyitem[art]|0|$buyitem[iznos]";
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
				$shlem = mysql_query("SELECT * FROM objects WHERE objects.user='".$stat['user']."' AND objects.inf='helmet27|��������|7|0|0|0|0|20' AND objects.tip='8'");
				$svitok = mysql_query("SELECT * FROM objects WHERE objects.user='".$stat['user']."' AND objects.tip=12 AND objects.inf='addenergy20|�������������� 20 MP|2|0|0|0|0|1'");

				if (mysql_num_rows ($shlem)) {
					if (mysql_num_rows ($svitok)) {
						mysql_query("UPDATE players set kwest=7 where id=$stat[id]");
						mysql_query("UPDATE players SET credits=credits + 5 WHERE user='".$stat['user']."'");
						mysql_query("DELETE FROM objects WHERE objects.user='".$stat['user']."' AND objects.tip=12 AND objects.inf='addenergy20|�������������� 20 MP|2|0|0|0|0|1'");
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
<input class=lbut type=button value='���������' onClick=top.main.location.href=\"main.php?set=edit&tmp=\"+Math.random();\"\">
<input class=lbut type=button value='������' onClick=top.main.location.href=\"druzja.php?tmp=\"+Math.random();\"\">

<input class=lbut type=button value='������' onClick=top.main.location.href=\"main.php?set=updates&tmp=\"+Math.random();\"\">


<input class=lbut type=button value='������' onClick=top.main.location.href=\"main.php?set=anketa&step=1&tmp=\"+Math.random();\"\">

<input class=lbut type=button value='������������' onClick=top.main.location.href=\"main.php?set=security&tmp=\"+Math.random();\"\">
<hr>
<input class=lbut type=button value='������' onClick=top.main.location.href=\"main.php?set=otchets&tmp=\"+Math.random();\"\">
<input class=lbut type=button value='�����������' onClick=top.main.location.href=\"molitva.php\">
<input class=lbut type=button value='����� ���������' onClick=top.main.location.href=\"setimg.php\"><input class=lbut type=button value='������' onClick=top.main.location.href=\"uslugi.php\"></center>
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