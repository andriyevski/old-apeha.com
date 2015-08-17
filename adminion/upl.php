<?include("../inc/db_connect.php");

$stat = mysql_fetch_array(mysql_query("SELECT * FROM players WHERE user='".addslashes($user)."' AND pass='".addslashes($pass)."' LIMIT 1"));
mysql_query("SET CHARSET cp1251");
if (empty($stat['id']) || $stat['bloked'] || $stat['admin']!=1) {
	echo"<script>top.window.location = '../index.php?action=logout';</script>";
	exit;
}


?><?php
if (isset($_POST['path'])){

	$uploadfile = $_POST['path'].$_FILES['file']['name'];
	if ($_POST['path']==""){$uploadfile = $_FILES['file']['name'];}
	echo $uploadfile;
	if (copy($_FILES['file']['tmp_name'],"../i/items/".$uploadfile)) {
		echo "Файл успешно загружен в папку $uploadfile\n";
		echo "Имя:" .$_FILES['file']['name']. "\n";
		echo "Размер:" .$_FILES['file']['size']. "\n";

	} else {
		print "Не удаётся загрузить файл. Инфа:\n";
		print_r($_FILES);
	}
}
$host=GetEnv("HTTP_HOST");
//Header("Location: http://$host");
?>