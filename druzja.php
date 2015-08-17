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
		<td align=right><input class=lbut type=button value='Обновить'
			onclick='window.location.href="druzja.php"'> <input class=lbut
			type=button value='Назад' onClick=top.main.location.href=
			"main.php?set=&tmp="+Math.random();""></td>
	</tr>
</table>
<center><font class=title>Раздел Друзья/Враги</font></center>
<br>
<table border="0" cellspacing="0" style="border-collapse: collapse"
	width="70%" align="center">
	<tr>
		<td width="50%">
		<form method="POST" action=druzja.php?act=add>
		<fieldset style='WIDTH: 98.6%'><legend>Добавить Друга/Врага</legend>
		Введите ник: <input type="text" class=lbut name="name_n" size="30"> <br>
		Кем будет являться: <select size=1 name=dr class=lbut>
			<option value="1">Друг</option>
			<option value="2">Враг</option>
		</select> <br>
		<input type="submit" value="Добавить" name="action" class=lbut></fieldset>
		</form>
		</td>
		<td width="50%">
		<form method="POST" action=druzja.php?act=del1>
		<fieldset style='WIDTH: 98.6%'><legend>Удалить Друга/Врага</legend>
		Введите ник: <input type="text" class=lbut name="name_n_del" size="30">
		<br>
		<input type="submit" value="Удалить" name="action" class=lbut></fieldset>
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
				<td bgcolor=#eaeaea width=100% align=center colspan=4><b>Список
				ваших Друзей/Врагов</b></td>
			</tr>
			<tr>
				<td bgcolor=#FCFAF3 width=25% align=center><b>Ник</b></td>
				<td bgcolor=#FCFAF3 width=30% align=center><b>Комната</b></td>
				<td bgcolor=#FCFAF3 width=22% align=center><b>Кем является</b></td>
				<td bgcolor=#FCFAF3 width=23% align=center><b>Статус</b></td>
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
			if($vi_nik!='Овец' && $align!=0) {
				echo"
<table border=0 cellspacing=0 style='border-collapse: collapse' width=70% align=center>
  <tr>
    <td width=100%>
<table cellpadding=3 width=100% cellspacing=1 border=0>
<tr>
<td bgcolor=#FCFAF3 width=25% align='left'><b><IMG SRC='i/align$align.gif' BORDER=0 ALT='$align_alt' width=12 height=12>&nbsp;<IMG SRC=i/klan/".$pro5["tribe"].".gif WIDTH=12 HEIGHT=12 BORDER=0>&nbsp;$vi_nik</b>&nbsp;[$level_nik]&nbsp;<a href=\"inf.php?login=$vi_nik\" target=_blank><IMG SRC='i/inf.gif' BORDER=0 ALT=\"Информация о $vi_nik\" width=11 height=11></td>
<td bgcolor=#FCFAF3 width=30% align='center'>".$roomname[$cur_rum]."</td>
";
			}else{
				echo"
<table border=0 cellspacing=0 style='border-collapse: collapse' width=70% align=center>
  <tr>
    <td width=100%>
<table cellpadding=3 width=100% cellspacing=1 border=0>
<tr>
<td bgcolor=#FCFAF3 width=25% align='left'><b><IMG SRC='i/align$align.gif' BORDER=0 ALT='$align_alt' width=12 height=12>&nbsp;<IMG SRC=i/klan/".$pro5["tribe"].".gif WIDTH=12 HEIGHT=12 BORDER=0>&nbsp;$vi_nik</b>&nbsp;[$level_nik]&nbsp;<a href=\"inf.php?login=$vi_nik\" target=_blank><IMG SRC='i/inf.gif' BORDER=0 ALT=\"Информация о $vi_nik\" width=11 height=11></td>
<td bgcolor=#FCFAF3 width=30% align='center'>".$roomname[$cur_rum]."</td>
";
			}
			?>
			<?
			if($vi['status']==1)
			echo"<td bgcolor=#FCFAF3 width=22% align='center'><b><font color='green'>Друг</font></b></td>";
			elseif($vi['status']==2)
			echo"<td bgcolor=#FCFAF3 width=22% align='center'><b><font color='red'>Враг</font></b></td>";
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
			echo"<td bgcolor=#FCFAF3 width=100% align='center'><b>У вас нету друзей и врагов</b></td>";
		}
	}

	?>
	<?
	##########Добавление друга или врага###############
	if ($act==add){
		AddSlashes($name_n);
		if (preg_match('/[^(\w)|(\x7F-\xFF)|(\s)]/',$name_n)) {
			echo '<script>alert("Ник имеет запрещенные символы")</script>';
			echo "<meta http-equiv='refresh' content='0; url=druzja.php'>";
			exit;
		}
		$pro=mysql_fetch_array(mysql_query("SELECT * FROM players WHERE user='$name_n'"));
		if(!$pro){
			echo '<script>alert("Персонаж не существует")</script>';
			echo "<meta http-equiv='refresh' content='0; url=druzja.php'>";
			die();
		}
		$pro2=mysql_fetch_array(mysql_query("SELECT * FROM Friends WHERE users='".addslashes($user)."'"));
		if($pro2['nik']==$name_n){
			echo '<script>alert("Персонаж уже записан в ваш список")</script>';
			echo "<meta http-equiv='refresh' content='0; url=druzja.php'>";
			die();
		}
		if($name_n==addslashes($user)){
			echo '<script>alert("Вы неможете добавить себя в свой список")</script>';
			echo "<meta http-equiv='refresh' content='0; url=druzja.php'>";
			die();
		}
		if($pro2['nik']!=$name_n){
			$dob=mysql_query("INSERT INTO `Friends` (users,nik,status) VALUES ('".addslashes($user)."','".$name_n."','".$dr."')");
			echo '<script>alert("Персонаж добавлен в ваш список")</script>';
			echo "<meta http-equiv='refresh' content='0; url=druzja.php'>";
		}else{
			echo '<script>alert("Ошибка! обратитесь к администрации")</script>';
			echo "<meta http-equiv='refresh' content='0; url=druzja.php'>";
		}
	}

	##########Удаление друга или врага###############
	if($act==del1){
		AddSlashes($name_n_del);##########Удаление друга или врага#########################Удаление друга или врага#########################Удаление друга или врага#########################Удаление друга или врага#########################Удаление друга или врага###############
		if (preg_match('/[^(\w)|(\x7F-\xFF)|(\s)]/',$name_n)) {##########Удаление друга или врага#########################Удаление друга или врага#########################Удаление друга или врага#########################Удаление друга или врага#########################Удаление друга или врага#########################Удаление друга или врага#########################Удаление друга или врага#########################Удаление друга или врага#########################Удаление друга или врага#########################Удаление друга или врага#########################Удаление друга или врага#########################Удаление друга или врага#########################Удаление друга или врага#########################Удаление друга или врага#########################Удаление друга или врага#########################Удаление друга или врага#########################Удаление друга или врага#########################Удаление друга или врага#########################Удаление друга или врага###############
			echo '<script>alert("Ник имеет запрещенные символы")</script>';
			echo "<meta http-equiv='refresh' content='0; url=druzja.php'>";
			exit;
		}

		$pro6=mysql_fetch_array(mysql_query("SELECT * FROM Friends WHERE users='".addslashes($user)."' AND nik='$name_n_del'"));
		$isession=$pro6['users'];
		$nikes=$pro6['nik'];
		if($pro6['nik']==$name_n_del && $pro6['users']==addslashes($user)){
			$udalit=mysql_query("delete  FROM Friends WHERE  users='".addslashes($user)."' AND nik='$name_n_del'");
			echo '<script>alert("Персонаж '.htmlspecialchars($name_n_del).' удален из вашего списка")</script>';
			echo "<meta http-equiv='refresh' content='0; url=druzja.php'>";
}else{
echo '<script>alert("Персонаж '.htmlspecialchars($name_n_del).' не удален из вашего списка")</script>';
echo "<meta http-equiv='refresh' content='0; url=druzja.php'>";
}
}

}
?>