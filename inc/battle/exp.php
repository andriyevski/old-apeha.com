<?
// Расчёт экспы

if ($w_img['3']!='w3') $a[1]=1; else $a[1]=0;
if ($w_img['5']!='w5') $a[]=1; else $a[]=0;
if ($w_img['4']!='w4') $a[]=1; else $a[]=0;
if ($w_img['1']!='w1') $a[]=1; else $a[]=0;

for ($i=1; $i<count($a)+1; $i++) { if ($a[$i]==1) $count['a']+=1; }

//

if ($w_img['14']!='w14') $b[1]=1; else $b[1]=0;
if ($w_img['15']!='w15') $b[]=1; else $b[]=0;
if ($w_img['9']!='w9') $b[]=1; else $b[]=0;
if ($w_img['13']!='w13') $b[]=1; else $b[]=0;

for ($i=1; $i<count($b)+1; $i++) { if ($b[$i]==1) $count['b']+=1; }

//

if ($w_img['2']!='w2') $c[1]=1; else $c[1]=0;
if ($w_img['16']!='w16') $c[]=1; else $c[]=0;
if ($w_img['19']!='w19') $c[]=1; else $c[]=0;

for ($i=1; $i<count($c)+1; $i++) { if ($c[$i]==1) $count['c']+=1; }

//

if ($w_img['6']!='w6') $d[1]=1; else $d[1]=0;
if ($w_img['7']!='w7') $d[1]=1; else $d[1]=0;
if ($w_img['8']!='w8') $d[1]=1; else $d[1]=0;
if ($w_img['10']!='w10') $d[1]=1; else $d[1]=0;
if ($w_img['11']!='w11') $d[1]=1; else $d[1]=0;
if ($w_img['12']!='w12') $d[1]=1; else $d[1]=0;

for ($i=1; $i<count($d)+1; $i++) { if ($d[$i]==1) $count['d']+=1; }

//


$r=4*$count['a']+0.765*$count['b']+0.64*$count['c']+0.17*$count['d'];

$base_defender = mysql_fetch_array(mysql_query("SELECT SUM(base) AS `base` FROM participants WHERE time='".$stat['battle']."' AND side!='".$participant['side']."'"));

$base_defender = round($base_defender['base']/mysql_num_rows(mysql_query("SELECT * FROM participants WHERE time='".$stat['battle']."' AND side!='".$stat['side']."'")));

if ($r == 0) $addexp = 0.1*$base_defender;
else $addexp = ($r*0.1*$base_defender)*($participant['damage']/($stat['vitality']*5+$stat['hp']));

$addexp=ceil($addexp);
//
?>