<?include("inc/module.php");
$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."' LIMIT 1"));
$result = mysql_query($stat);
$d = @mysql_fetch_array($result);

if ($stat['t_time']>$now) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']>$now) { header("Location: academy.php"); exit; }
elseif ($stat['o_time']>$now) { header("Location: juvelir.php"); exit; }
elseif ($stat[r_time]>$now) { header("Location: podzem.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
else {
	?>
<HTML>
<HEAD>


<body bgcolor=#F5FFD9>
<meta content='text/html; charset=windows-1251' http-equiv=Content-type>


</HEAD>
<table width=100% cellspacing=0 cellpadding=5 border=0>
	<tr>
		<td align=right><input class=lbut type=button value='��������'
			onclick='window.location.href="druzja.php"'> <input class=lbut
			type=button value='�����' onClick=top.main.location.href=
			"main.php?set=&tmp="+Math.random();""></td>
	</tr>
</table>
<center><font class=title>������ ������/�����</font></center>
<br>
<table border="0" cellspacing="0" style="border-collapse: collapse"
	width="70%" align="center">
	<tr>
		<td width="50%">
		<form method="POST" action=druzja.php?act=add>
		<fieldset style='WIDTH: 98.6%'><legend>�������� �����/�����</legend>
		������� ���: <input type="text" class=lbut name="name_n" size="30"> <br>
		��� ����� ��������: <select size=1 name=dr class=lbut>
			<option value="1">����</option>
			<option value="2">����</option>
		</select> <br>
		<input type="submit" value="��������" name="action" class=lbut></fieldset>
		</form>
		</td>
		<td width="50%">
		<form method="POST" action=druzja.php?act=del1>
		<fieldset style='WIDTH: 98.6%'><legend>������� �����/�����</legend>
		������� ���: <input type="text" class=lbut name="name_n_del" size="30">
		<br>
		<input type="submit" value="�������" name="action" class=lbut></fieldset>
		</form>
		</td>
	</tr>
</table>

<table border="0" cellspacing="0" style="border-collapse: collapse"
	width="70%" align="center">
	<tr>
		<td width="100%">
		<table cellpadding=3 width=100% cellspacing=1 border=0>
			<tr>
				<td bgcolor=#eaeaea width=100% align=center colspan=4><b>������
				����� ������/������</b></td>
			</tr>
			<tr>
				<td bgcolor=#FCFAF3 width=25% align=center><b>���</b></td>
				<td bgcolor=#FCFAF3 width=30% align=center><b>�������</b></td>
				<td bgcolor=#FCFAF3 width=22% align=center><b>��� ��������</b></td>
				<td bgcolor=#FCFAF3 width=23% align=center><b>������</b></td>
			</tr>
		</table>
		</td>
	</tr>
</table>

	<?
	$mamuka=addslashes($user);
	$vivod = mysql_query("SELECT * FROM Friends WHERE users='".addslashes($user)."'");
	while($vi = mysql_fetch_array($vivod)){
		$total+=1;
		$vi_nik=$vi["nik"];
		$vi_status=$vi["status"];
		$pro4=mysql_fetch_array(mysql_query("SELECT users FROM Friends WHERE users='".addslashes($user)."'"));
		$pro5=mysql_fetch_array(mysql_query("SELECT level, tribe, rank, room, lpv FROM players WHERE user='".$vi_nik."'"));
		$level_nik=$pro5["level"];
		$klan=$pro5["tribe"];
		$align=$pro5["rank"];
		$cur_rum = $pro5['room'];
		include ('inc/rooms.php');
		if($pro4['users']==addslashes($user)){
			if($vi_nik!='����' && $align!=0) {
				echo"
<table border=0 cellspacing=0 style='border-collapse: collapse' width=70% align=center>
  <tr>
    <td width=100%>
<table cellpadding=3 width=100% cellspacing=1 border=0>
<tr>
<td bgcolor=#FCFAF3 width=25% align='left'><b><IMG SRC='i/align$align.gif' BORDER=0 ALT='$align_alt' width=12 height=12>&nbsp;<IMG SRC=i/klan/".$pro5["tribe"].".gif WIDTH=12 HEIGHT=12 BORDER=0>&nbsp;$vi_nik</b>&nbsp;[$level_nik]&nbsp;<a href=\"inf.php?login=$vi_nik\" target=_blank><IMG SRC='i/inf.gif' BORDER=0 ALT=\"���������� � $vi_nik\" width=11 height=11></td>
<td bgcolor=#FCFAF3 width=30% align='center'>".$roomname[$cur_rum]."</td>
";
			}else{
				echo"
<table border=0 cellspacing=0 style='border-collapse: collapse' width=70% align=center>
  <tr>
    <td width=100%>
<table cellpadding=3 width=100% cellspacing=1 border=0>
<tr>
<td bgcolor=#FCFAF3 width=25% align='left'><b><IMG SRC='i/align$align.gif' BORDER=0 ALT='$align_alt' width=12 height=12>&nbsp;<IMG SRC=i/klan/".$pro5["tribe"].".gif WIDTH=12 HEIGHT=12 BORDER=0>&nbsp;$vi_nik</b>&nbsp;[$level_nik]&nbsp;<a href=\"inf.php?login=$vi_nik\" target=_blank><IMG SRC='i/inf.gif' BORDER=0 ALT=\"���������� � $vi_nik\" width=11 height=11></td>
<td bgcolor=#FCFAF3 width=30% align='center'>".$roomname[$cur_rum]."</td>
";
			}
			?>
			<?
			if($vi['status']==1)
			echo"<td bgcolor=#FCFAF3 width=22% align='center'><b><font color='green'>����</font></b></td>";
			elseif($vi['status']==2)
			echo"<td bgcolor=#FCFAF3 width=22% align='center'><b><font color='red'>����</font></b></td>";
			else{
			}
			?>
			<?
			if (time() - $pro5['lpv'] <= 180 || $pro5['rank'] == 60)
			echo"<td bgcolor=#FCFAF3 width=23% align='center'><b><font color='green'>OnLine</font></b></td>
</tr>
</table>
</td>
  </tr>
</table>";
			else
			echo"<td bgcolor=#FCFAF3 width=23% align='center'><b><font color='red'>OffLine</font></b></td>
</tr>
</table>
</td>
  </tr>
</table>";
			?>
			<?
		}else{
			echo"<td bgcolor=#FCFAF3 width=100% align='center'><b>� ��� ���� ������ � ������</b></td>";
		}
	}

	?>
	<?
	##########���������� ����� ��� �����###############
	if ($act==add){
		AddSlashes($name_n);
		if (preg_match('/[^(\w)|(\x7F-\xFF)|(\s)]/',$name_n)) {
			echo '<script>alert("��� ����� ����������� �������")</script>';
			echo "<meta http-equiv='refresh' content='0; url=druzja.php'>";
			exit;
		}
		$pro=mysql_fetch_array(mysql_query("SELECT * FROM players WHERE user='$name_n'"));
		if(!$pro){
			echo '<script>alert("�������� �� ����������")</script>';
			echo "<meta http-equiv='refresh' content='0; url=druzja.php'>";
			die();
		}
		$pro2=mysql_fetch_array(mysql_query("SELECT * FROM Friends WHERE users='".addslashes($user)."'"));
		if($pro2['nik']==$name_n){
			echo '<script>alert("�������� ��� ������� � ��� ������")</script>';
			echo "<meta http-equiv='refresh' content='0; url=druzja.php'>";
			die();
		}
		if($name_n==addslashes($user)){
			echo '<script>alert("�� �������� �������� ���� � ���� ������")</script>';
			echo "<meta http-equiv='refresh' content='0; url=druzja.php'>";
			die();
		}
		if($pro2['nik']!=$name_n){
			$dob=mysql_query("INSERT INTO `Friends` (users,nik,status) VALUES ('".addslashes($user)."','".$name_n."','".$dr."')");
			echo '<script>alert("�������� �������� � ��� ������")</script>';
			echo "<meta http-equiv='refresh' content='0; url=druzja.php'>";
		}else{
			echo '<script>alert("������! ���������� � �������������")</script>';
			echo "<meta http-equiv='refresh' content='0; url=druzja.php'>";
		}
	}

	##########�������� ����� ��� �����###############
	if($act==del1){
		AddSlashes($name_n_del);##########�������� ����� ��� �����#########################�������� ����� ��� �����#########################�������� ����� ��� �����#########################�������� ����� ��� �����#########################�������� ����� ��� �����###############
		if (preg_match('/[^(\w)|(\x7F-\xFF)|(\s)]/',$name_n)) {##########�������� ����� ��� �����#########################�������� ����� ��� �����#########################�������� ����� ��� �����#########################�������� ����� ��� �����#########################�������� ����� ��� �����#########################�������� ����� ��� �����#########################�������� ����� ��� �����#########################�������� ����� ��� �����#########################�������� ����� ��� �����#########################�������� ����� ��� �����#########################�������� ����� ��� �����#########################�������� ����� ��� �����#########################�������� ����� ��� �����#########################�������� ����� ��� �����#########################�������� ����� ��� �����#########################�������� ����� ��� �����#########################�������� ����� ��� �����#########################�������� ����� ��� �����#########################�������� ����� ��� �����###############
			echo '<script>alert("��� ����� ����������� �������")</script>';
			echo "<meta http-equiv='refresh' content='0; url=druzja.php'>";
			exit;
		}

		$pro6=mysql_fetch_array(mysql_query("SELECT * FROM Friends WHERE users='".addslashes($user)."' AND nik='$name_n_del'"));
		$isession=$pro6['users'];
		$nikes=$pro6['nik'];
		if($pro6['nik']==$name_n_del && $pro6['users']==addslashes($user)){
			$udalit=mysql_query("delete  FROM Friends WHERE  users='".addslashes($user)."' AND nik='$name_n_del'");
			echo '<script>alert("�������� '.htmlspecialchars($name_n_del).' ������ �� ������ ������")</script>';
			echo "<meta http-equiv='refresh' content='0; url=druzja.php'>";
}else{
echo '<script>alert("�������� '.htmlspecialchars($name_n_del).' �� ������ �� ������ ������")</script>';
echo "<meta http-equiv='refresh' content='0; url=druzja.php'>";
}
}

}
?>