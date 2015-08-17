<?
include("../db_connect.php");
$sql = mysql_fetch_array(mysql_query("SELECT * FROM players WHERE user='".addslashes($user)."'"));
$result = mysql_query($sql);
$d = @mysql_fetch_array($result);
$tribe= htmlspecialchars($d["tribe"]);
$credits= htmlspecialchars($d["credits"]);
$ic= htmlspecialchars($d["ic"]);
?>
<HTML>
<BODY topmargin=0 marginheight=0 leftmargin=0 rightmargin=0
	bottomMargin=0 bgcolor=#EBEDEC>
<?
print"
        <html><table width=100% cellspacing=0 cellpadding=5 border=0>
        <tr>
        <td>&nbsp;&nbsp;<font face=Verdana size=2><b>У Вас на счету:</b> <u>".$sql['credits']."</u> <b>зм.</b></font>
        </td>
        <td align=right valign=top>
<img src='i/back.gif' style='CURSOR: Hand' alt='Вернуться' onclick='window.location.href=\"klandom.php?set=&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table><BR></html>";

?>
<center>
<fieldset style='WIDTH: 70%'><font face="Verdana" size="2"><legend>Ошибка</legend></font>
<?
######Создание Клана##########
if($act==reg){
	include("../db_connect.php");
	AddSlashes($names);
	if (preg_match("/[^(a-zA-Z)|]/",$names)) {
		echo "<font face=Verdana size=2>Название имеет запрещенные символы, вернитесь назад и попробуйте еще раз.</font>";
		exit;
	}
	AddSlashes($sites);
	if (preg_match("/[^(a-zA-Z)|(0-9)|(.)|]/",$sites)) {
		echo "<font face=Verdana size=2>Сайт имеет запрещенные символы, вернитесь назад и попробуйте еще раз.</font>";
		exit;
	}
	AddSlashes($history);
	if (preg_match("/[^(а-яА-Я)|(a-zA-Z)|(0-9)|(.)|]/",$history)) {
		echo "<font face=Verdana size=2>История имеет запрещенные символы, вернитесь назад и попробуйте еще раз.</font>";
		exit;
	}
	$Na = mysql_fetch_array(mysql_query("SELECT * FROM tribes WHERE name='$names'"));
	$FGH = mysql_fetch_array(mysql_query("SELECT * FROM players WHERE user='".$sql['user']."'"));
	if($Na){
		print "<font color=RED face=Verdana size=2>Такой Клан уже зарегистрирован, вернитесь назад и выберите другое имя.</font>.";
		die();
	}
	if($FGH["ic"]=="0"){
		print "<font color=RED face=Verdana size=2>Вы не прошли проверку на чистоту у Инквизиторов, обратитесь за помощью к любому Инквизитору.</font>.";
		die();
	}
	if($FGH["level"]<="7"){
		print "<font color=RED face=Verdana size=2>У вас слишком маленький уровень, попробуйте когда подрастёте...</font>";
		die();
	}
	$deneg_n=2000;
	if($FGH["credits"]>=$deneg_n){
		$QQQQ = mysql_query("INSERT INTO `tribes`(name,bloked,url,about,obraz) VALUES('".$names."','0','".$sites."','".$history."','0')");
		$OTN = mysql_query("UPDATE `players` SET tribe='$names',b_tribe='1',credits=credits-$deneg_n WHERE user='".$sql['user']."'");
		$insert = mysql_query("INSERT INTO `top` (`clan`,`url`,`about`,`hosts`,`visits`,`update_date`) VALUES ('".$names."','".$sites."','".$history."','0','0','0')");
		print "<font face=Verdana size=2>Клан зарегистрирован и добавлен в рейтинг кланов, спасибо за пользование нашими услугами.</font>";
	}
	else{
		print "<font face=Verdana size=2>У вас недостаточно денег для регистрации клана.</font>";
	}
}
?></fieldset>
</center>
</font>