<?
include('inc/db_connect.php');
$title = 'Падшие Ангелы - [ Энциклопедия ]';
include('inc/html_header.php');
echo"<body bgcolor=ebedec>";


if ($view=="tribes") {

	if (!empty($name)) {
		$klan=mysql_fetch_array(mysql_query("SELECT * FROM top where clan='$name'"));
		echo"
<b>Клан:</b> <IMG SRC=\"i/klan/$klan[clan].gif\" BORDER=0 ALT=\"$klan[clan]\" width=12 height=12>$klan[clan]
<br>
<b>Домашняя страница:</b> <a href='$klan[url]' target=_blank>$klan[url]</a>
<br>
<b>История:</b> $klan[about]"; }
		else {


			$tribe=mysql_query("SELECT * FROM top");

			for ($i=0; $i<mysql_numrows($tribe); $i++) {
				$tribes=mysql_fetch_array($tribe);
				echo "<b>$tribes[clan]</b><br>";
			}

		}

}
?>



