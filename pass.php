<?

$a[1]="a";
$a[2]="b";
$a[3]="c";
$a[4]="d";
$a[5]="e";
$a[6]="f";
$a[7]="g";
$a[8]="h";
$a[9]="i";
$a[10]="j";
$a[11]="k";
$a[12]="l";
$a[13]="m";
$a[14]="n";
$a[15]="o";
$a[16]="p";
$a[17]="q";
$a[18]="r";
$a[19]="s";
$a[20]="t";
$a[21]="u";
$a[22]="v";
$a[23]="w";
$a[24]="x";
$a[25]="y";
$a[26]="z";

$b=$a[rand(1,26)];
$b.=$a[rand(1,26)];
$b.=$a[rand(1,26)];
$b.=$a[rand(1,26)];
$b.=$a[rand(1,26)];
$b.=$a[rand(1,26)];


mysql_query("INSERT INTO bank (id,pass,user,credits,platinum,book) values ('$max[id]','".addslashes($b)."','$stat[user]','0','0','')");
mysql_query("UPDATE players SET credits=credits-100 WHERE user='".$stat['user']."'");



// �-�� �������� �����

$email="Bank@Instincts.Ru";
$mailto=$stat['email'];

$subject="�������� ������ � �����!";
$body="������� ������� ����� ���!
���� ���� ������� ������ � �����!
��������� ��� ����� ������: $b";

$body=convert_cyr_string (stripslashes($body),w,k);
$subject=convert_cyr_string (stripslashes($subject),w,k);

$sucess = mail($mailto, $subject, $body,
"From: $email
X-Mailer: PHP/" . phpversion());

if (!$sucess) { echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
alert('��������! �� �������������� ������� �� ������� ��������� ��������� �� ��� E-Mail!');
//-->
</SCRIPT>"; }

//

?>