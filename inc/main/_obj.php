<?
if (!isset($get)) { $getinfo=$stat[user]; }
elseif ($get==1) { $getinfo=$info[user]; }
elseif ($get==2) { $getinfo=$second[user]; }
else{$getinfo='';}
$obj1=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w1' and player='$getinfo'"));
if ($obj1[name]=="") $obj[1]="w1"; else $obj[1]="$obj1[name]";

$obj2=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w2' and player='$getinfo'"));
if ($obj2[name]=="") $obj[2]="w2"; else $obj[2]="$obj2[name]";

$obj3=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w3' and player='$getinfo'"));
if ($obj3[name]=="") $obj[3]="w3"; else $obj[3]="$obj3[name]";

$obj4=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w4' and player='$getinfo'"));
if ($obj4[name]=="") $obj[4]="w4"; else $obj[4]="$obj4[name]";

$obj5=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w5' and player='$getinfo'"));
if ($obj5[name]=="") $obj[5]="w5"; else $obj[5]="$obj5[name]";

$obj6=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w6' and player='$getinfo'"));
if ($obj6[name]=="") $obj[6]="w6"; else $obj[6]="$obj6[name]";

$obj7=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w7' and player='$getinfo'"));
if ($obj7[name]=="") $obj[7]="w7"; else $obj[7]="$obj7[name]";

$obj8=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w8' and player='$getinfo'"));
if ($obj8[name]=="") $obj[8]="w8"; else $obj[8]="$obj8[name]";

$obj9=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w9' and player='$getinfo'"));
if ($obj9[name]=="") $obj[9]="w9"; else $obj[9]="$obj9[name]";

$obj10=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w10' and player='$getinfo'"));
if ($obj10[name]=="") $obj[10]="w10"; else $obj[10]="$obj10[name]";

$obj11=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w11' and player='$getinfo'"));
if ($obj11[name]=="") $obj[11]="w11"; else $obj[11]="$obj11[name]";

$obj12=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w12' and player='$getinfo'"));
if ($obj12[name]=="") $obj[12]="w12"; else $obj[12]="$obj12[name]";

$obj13=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w13' and player='$getinfo'"));
if ($obj13[name]=="") $obj[13]="w13"; else $obj[13]="$obj13[name]";

$obj14=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w14' and player='$getinfo'"));
if ($obj14[name]=="") $obj[14]="w14"; else $obj[14]="$obj14[name]";

$obj15=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w15' and player='$getinfo'"));
if ($obj15[name]=="") $obj[15]="w15"; else $obj[15]="$obj15[name]";

$obj16=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w16' and player='$getinfo'"));
if ($obj16[name]=="") $obj[16]="w16"; else $obj[16]="$obj16[name]";

$obj17=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w17' and player='$getinfo'"));
if ($obj17[name]=="") $obj[17]="w17"; else $obj[17]="$obj17[name]";

$obj18=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w18' and player='$getinfo'"));
if ($obj18[name]=="") $obj[18]="w18"; else $obj[18]="$obj18[name]";

$obj19=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w19' and player='$getinfo'"));
if ($obj19[name]=="") $obj[19]="w19"; else $obj[19]="$obj19[name]";


for ($f=1; $f<20; $f++) { if ($set=="edit" and $obj[$f]!="w$f") $un[$f]="<a href='main.php?set=edit&unset=w$f'>"; }

// Слоты магии
$uri=GetEnv("SCRIPT_NAME");

if ($set=="edit" and $obj[17]!="w17") $un[17]="<a href='main.php?set=edit&unset=w17'>";
elseif (($set=="" and $uri=="/main.php" or $set=="map" and $uri=="/main.php" or $uri=="/battle.php") and $obj[17]!="w17") { $un[17]="<a href=\"javascript:ShowForm('".$w[17][title]."','','','','1','$obj17[name]','$obj17[id]','$obj17[onset]'";
if ($obj17[name]=="addhp10" or $obj17[name]=="addhp30" or $obj17[name]=="addhp60" or $obj17[name]=="mutation" or $obj17[name]=="addenergy10") $un[17].=",'$stat[user]'";
$un[17].=");\">"; }


if ($set=="edit" and $obj[18]!="w18") $un[18]="<a href='main.php?set=edit&unset=w18'>";
elseif (($set=="" and $uri=="/main.php" or $set=="map" and $uri=="/main.php" or $uri=="/battle.php") and $obj[18]!="w18") { $un[18]="<a href=\"javascript:ShowForm('$w18[title]','','','','1','$obj18[name]','$obj18[id]','$obj18[onset]'";
if ($obj18[name]=="addhp10" or $obj18[name]=="addhp30" or $obj18[name]=="addhp60" or $obj18[name]=="mutation" or $obj18[name]=="addenergy10") $un[18].=",'$stat[user]'";
$un[18].=");\">"; }

?>