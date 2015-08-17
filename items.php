<?
include("inc/db_connect.php");

$query=mysql_query("SELECT * FROM objects order by id");
mysql_query("SET CHARSET cp1251");
for ($i=0; $i<1000; $i++) {
	$inf=mysql_fetch_array($query);

	$add=explode("|",$inf['add']);

	$mass[][id]=$inf[id];
	$mass[][user]=$inf[user];
	$mass[][onset]=0;
	$mass[][slot]=0;
	$mass[][inf]=$inf[inf];
	$mass[][min]=$inf[min];
	$mass[][bank]=0;
	$mass[][time]=0;

	$mass[][br1]=$add[0];
	$mass[][br2]=$add[0];
	$mass[][br3]=$add[0];
	$mass[][br4]=$add[0];
	$mass[][br5]=$add[0];
	$mass[][min]=$add[0];
	$mass[][max]=$add[0];
	$mass[][hp]=$add[0];
	$mass[][energy]=$add[0];
	$mass[][strength]=$add[0];
	$mass[][dex]=$add[0];
	$mass[][agility]=$add[0];
	$mass[][vitality]=$add[0];
	$mass[][razum]=$add[0];
	$mass[][krit]=$add[0];
	$mass[][unkrit]=$add[0];
	$mass[][uv]=$add[0];
	$mass[][unuv]=$add[0];

}


echo $mass[300][user];


?>