<?
include("inc/html_header.php");
?>
<body leftmargin=0 topmargin=0 bgcolor=EBEDEC>
<?
include("inc/db_connect.php");

$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));

$login=$stat["user"];

?>


<table cellspacing=0 cellpadding=7 border=1 bordercolor=CCCCCC
	height=155>
	<tr>
		<td valign=top bgcolor=e2e0e0>


		<form name=add action=?set=friends&do=3 method="POST">Добавить друга:
		<br>
		<input type=text name=target class=new size=30><br>
		(Щелкните на логин в чате)<br>
		<input type=submit value="Создать" class=new></form>
		</td>
		<?
		if($do == 3){

			$q=mysql_query("select * from players where user='$target'");
			$res=mysql_fetch_array($q);
			if(!$res){
				print "<td valign=top>Персонаж <B>$target</B> не найден в базе данных.";
				die();
			}

			$f=mysql_query("select * from friends where user='$login' and friend='$target'");
			$ref=mysql_fetch_array($f);
			if(!$ref){
				$sql ="INSERT INTO friends(user,friend) VALUES ('$login','$target')";
				$result = mysql_query($sql);
				print "<td valign=top>Персонаж $target успешно добавлен.";
			}
			else {
				print "<td valign=top>Персонаж $target и так в списке.";
				die();
			}
			die();


		}

		print "<td valign=top>

<table cellspacing=0 cellpadding=7 border=1 bordercolor=CCCCCC>
<tr>
<td bgcolor=e2e0e0 align=center height=30 valign=center><b>Логин</td>
<td bgcolor=e2e0e0 align=center height=30 valign=center><b>Локация</td>
<td bgcolor=e2e0e0 align=center height=30 valign=center><b>Удаление</td>
</tr>
";

		include ('inc/rooms.php');
		include ('inf.php');
		$S = mysql_query("SELECT * FROM `friends` WHERE user='".$user."' ");
		while($DAT = mysql_fetch_array($S)){
			$friend=$DAT["friend"];
			$dt = mysql_fetch_array(mysql_query("SELECT * FROM players WHERE user='$friend'"));
			if ($dt[lpv] > time()-180) {
				$room = $dt["room"];
				$rm = "<font color=green><b>$roomname[$room]</b></font>";
			}
			else {$rm="<font color=red><b>OffLine</b></font>";}
			echo "
    <tr>
<td valign=center class=und>
$friend
</td>
<td valign=center class=und>
$rm
</td>
<td valign=center>
<a href='?set=friends&act=del&target=$friend'><img src=i/del.gif border=0></a>
</td>
</tr>
";

		}





		if ($act=="del") {

			$qq=mysql_query("DELETE FROM friends WHERE friend='$target' && user='$login'");
			print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=main.php?set=friends\">";
		}
		?>
	</tr>
</table>
</td>