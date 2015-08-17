<?
$all_ip=mysql_query("select * from security where user='$info[user]'");

$lus='';

for($i=0; $i<mysql_numrows($all_ip); $i++) {
	$ips=mysql_fetch_array($all_ip);

	// Смотрим, нет ли повтора юзера
	if ($lus!=$ips['user']) {

		$mult=mysql_query("select distinct(user) from security where ip='$ips[ip]' and user!='$info[user]' order by user");


		// Поиск мультов по всем IP
		for($i=0; $i<mysql_numrows($mult); $i++) {

			$mults=mysql_fetch_array($mult);

			echo"<i><a href=\"javascript:inf('$mults[user]');\">$mults[user]</a></i>";

			if ($i+1<mysql_num_rows($mult)) echo" <i>l</i> ";

		}

		// Конец цикла

		$lus="$ips[user]";
	}}

	?>