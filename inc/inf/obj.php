<?
$obj1=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w1' and player='$info[user]'"));
if (empty($obj1['name'])) $obj[1]="w1"; else $obj[1]="$obj1[name]";

$obj2=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w2' and player='$info[user]'"));
if (empty($obj2['name'])) $obj[2]="w2"; else $obj[2]="$obj2[name]";

$obj3=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w3' and player='$info[user]'"));
if (empty($obj3['name'])) $obj[3]="w3"; else $obj[3]="$obj3[name]";

$obj4=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w4' and player='$info[user]'"));
if (empty($obj4['name'])) $obj[4]="w4"; else $obj[4]="$obj4[name]";

$obj5=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w5' and player='$info[user]'"));
if (empty($obj5['name'])) $obj[5]="w5"; else $obj[5]="$obj5[name]";

$obj6=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w6' and player='$info[user]'"));
if (empty($obj6['name'])) $obj[6]="w6"; else $obj[6]="$obj6[name]";

$obj7=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w7' and player='$info[user]'"));
if (empty($obj7['name'])) $obj[7]="w7"; else $obj[7]="$obj7[name]";

$obj8=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w8' and player='$info[user]'"));
if (empty($obj8['name'])) $obj[8]="w8"; else $obj[8]="$obj8[name]";

$obj9=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w9' and player='$info[user]'"));
if (empty($obj9['name'])) $obj[9]="w9"; else $obj[9]="$obj9[name]";

$obj10=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w10' and player='$info[user]'"));
if (empty($obj10['name'])) $obj[10]="w10"; else $obj[10]="$obj10[name]";

$obj11=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w11' and player='$info[user]'"));
if (empty($obj11['name'])) $obj[11]="w11"; else $obj[11]="$obj11[name]";

$obj12=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w12' and player='$info[user]'"));
if (empty($obj12['name'])) $obj[12]="w12"; else $obj[12]="$obj12[name]";

$obj13=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w13' and player='$info[user]'"));
if (empty($obj13['name'])) $obj[13]="w13"; else $obj[13]="$obj13[name]";

$obj14=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w14' and player='$info[user]'"));
if (empty($obj14['name'])) $obj[14]="w14"; else $obj[14]="$obj14[name]";

$obj15=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w15' and player='$info[user]'"));
if (empty($obj15['name'])) $obj[15]="w15"; else $obj[15]="$obj15[name]";

$obj16=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w16' and player='$info[user]'"));
if (empty($obj16['name'])) $obj[16]="w16"; else $obj[16]="$obj16[name]";

$obj19=mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE onset='w19' and player='$info[user]'"));
if (empty($obj19['name'])) $obj[19]="w19"; else $obj[19]="$obj19[name]";
?>