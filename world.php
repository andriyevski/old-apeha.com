<?

require_once("inc/module.php");
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat['t_time']>$now) { print"<SCRIPT>location.href='prison.php'</SCRIPT>"; exit; }
elseif ($stat['k_time']>$now) { print"<SCRIPT>location.href='academy.php'</SCRIPT>"; exit; }
elseif ($stat['o_time']>$now) { print"<SCRIPT>location.href='juvelir.php'</SCRIPT>"; exit; }
elseif ($stat['r_time']>$now) { print"<SCRIPT>location.href='podzem.php'</SCRIPT>"; exit; } 
elseif ($stat['lov_time']>$now) { print"<SCRIPT>location.href='more.php'</SCRIPT>"; exit; } 
elseif ($stat['mol_bog_swet']>$now) { /*header("Location: bog_hram.php")*/print"<SCRIPT>location.href='bog_hram.php'</SCRIPT>"; exit; }
elseif ($stat['mol_bog_tima']>$now) { /*header("Location: bog_hram.php")*/print"<SCRIPT>location.href='bog_hram.php'</SCRIPT>"; exit; } 
elseif ($stat[battle]) { print"<SCRIPT>location.href='battle.php'</SCRIPT>"; exit; }
else {

if ($stat['room']>=301 && $stat['room']<=317) {
        header("Location: podzem.php");
        exit;
}

include("inc/main/changed.php");














###�������
if ($room=="7") {

mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");

echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"shop.php\";
top.frames['online'].location = top.frames['online'].location;

//-->
</SCRIPT>
";

exit();

}
###


###�����
if ($room=="40") {

mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");

echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"komis.php\";
top.frames['online'].location = top.frames['online'].location;

//-->
</SCRIPT>
";

exit();

}
###

### ����� ������
if ($room == "496"  or $room == "497"  or $room == "498"  or $room == "499" or $room=="500" or $room == "501" or $room == "502" or $room == "503" or $room == "504") {


mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");


echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"bs_smert.php\";
top.frames['online'].location = top.frames['online'].location;
//-->
</SCRIPT>
";

exit();


}
###

###��������� �����
if ($room=="27") {
mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");
echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"kwest.php\";
top.frames['online'].location = top.frames['online'].location;
//-->
</SCRIPT>
";
exit();
}
###


###��
if ($room=="48") {

mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");

echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"tower.php\";
top.frames['online'].location = top.frames['online'].location;

//-->
</SCRIPT>
";

exit();

}
###

### ������� ��������
if ($room=="13") {
mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");
echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"gshop.php\";
top.frames['online'].location = top.frames['online'].location;

//-->
</SCRIPT>
";
exit();
}
###

###����. �������
if ($room == "0" || empty($room)) {
$room = 0;
mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");
echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['online'].location = top.frames['online'].location;

//-->
</SCRIPT>
";
}
###


### ����� �1
if ($room=="25") {
mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");
echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"world2.php\";
top.frames['online'].location = top.frames['online'].location;

//-->
</SCRIPT>
";
exit();
}
###


### ������ ������
if ($room=="32") {
mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");
echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"stella.php\";
top.frames['online'].location = top.frames['online'].location;

//-->
</SCRIPT>
";
exit();
}
###

### �������������
if ($room=="36") {
mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");
echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"clan_holl.php\";
top.frames['online'].location = top.frames['online'].location;
//-->
</SCRIPT>
";
exit();
}
###

### ����� �2
if ($room=="26") {
mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");
echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"world3.php\";
top.frames['online'].location = top.frames['online'].location;

//-->
</SCRIPT>
";
exit();
}
###

### ����� �1
if ($room=="15") {
mysql_query("UPDATE players SET room=".$room.", lpv=".$now." WHERE user='".$stat['user']."'");
echo"
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
top.frames['main'].location = \"newyear.php\";
top.frames['online'].location = top.frames['online'].location;

//-->
</SCRIPT>
";
exit();
}
###

echo "<body bgcolor='#F5FFDA'>";

include('inc/html_header.php');

echo"
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/login_form.js\"></SCRIPT>

<body leftmargin=0 topmargin=0 background='/i/bg.gif'>

<script language=\"javascript\" type=\"text/javascript\">
function imover(im)
{
  im.filters.Glow.Enabled=true;
}
function imout(im)
{
  im.filters.Glow.Enabled=false;
}
function m1()
{
  alert('���� �������������!');

}

function hideHelp()
{
document.getElementById('help').style.display = 'none';
return false;
}
</script>

<style type=\"text/css\">
img.aFilter {
  filter:Glow(color=#FFFFFF,Strength=4,Enabled=0);
  cursor:hand
}
hr {
  height: 1px;
                  }

#help {
Z-INDEX: 66; WIDTH: 100%; POSITION: absolute
}

TD.Form {
BORDER-RIGHT: black 1px solid; BORDER-TOP: #666666 1px solid;  BORDER-LEFT: #666666 1px solid; BORDER-BOTTOM: black 1px solid; BACKGROUND-COLOR: #f4eade
}
</style>
<div id=mainform style='position:absolute; left:650px; top:30px'></div>";

if ($stat['exp']==0) {
echo"
<DIV id=help align=center style=\"DISPLAY: block;\">
<TABLE cellSpacing=0 cellPadding=0 width=400 align=center border=0>
  <TBODY>
  <TR>
    <TD style=\"PADDING-RIGHT: 10px; PADDING-LEFT: 10px; PADDING-BOTTOM: 10px; PADDING-TOP: 10px\" class=Form>
<FORM name=active action=world.php method=post><small><CENTER><b>����� ���������� �� ����� �������!</b><br><br>
���������� � ����� <b>Acres Of The Hope</b> ����� ����� ������ � <b>������</b>, � ������� ��������� �������� ������� �������.<br>  
������ �� ���������� �� <b>������� �������</b> ����� ������ �� <b>�����</b>. �������� 
������� �� ������ <b>�����</b>, � ��������� �� ���� ���� - � ����� ���������� ��������� ���������. <br>
������ �� <b>������� �������</b> ����������� <b>����� �1</b> - �� ���� ����� �� ������� �������� � 
<b>������� ����</b>, �������� � <b>��������</b>, �������� ���� ���� � <b>�������</b> � ��� �� ����� � <b>����</b> � 
��������� ���� ����. ����� �� <b>������� �������</b> ����������� <b>����� �2</b>, � ����� 
������� <b>������������</b>, �.�. �� ��� ����������� ������ ��� �� ������� ���������� 
������� ������, �������� ��������� ������� ��� �� ���������� ���������, � ��� �� 
�� ������ ����� � ���� � ��������� ������ ����.<br>
<br>
��� ����������� �� �������� ���� ����������� <b>����� �������</b> ����, ������� �� 
������ ��� ��� <b>������</b>.<br>
�� ��������� � ������� ���� - <b>��� �������</b> � <b>10 ��</b>. ��� ����, ����� ���������� <b>��������</b>, ����� ����� 
� ������ <b>���������</b> �� ������� ������. ��� �� ����� <b>������������ ���������</b> ������ ��������� � 
<b>�����������</b> ����� ���. ������� ��� ������...<br><br>
<INPUT class=input onclick=hideHelp() type=button  value=�������></CENTER></FORM></small></TD></TR></TBODY></TABLE></DIV>
";
}






echo "
<table border='0' width='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='100%' align='center'>
     <table border='0' width='100%' height='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='22' height='100%'>
    <table border='0' width='22' height='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='22' height='25'>
<img src='i/inman_b11.gif' width='22' height='25' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='69'><img src='i/inman_b12.gif' width='22' height='69' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='100%' background='i/inman_b13.gif'>&nbsp;</td>
  </tr>
  <tr>
    <td width='22' height='69'><img src='i/inman_b14.gif' width='22' height='69' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='25'><img src='i/inman_b15.gif' width='22' height='25' alt=''></td>
  </tr>
</table>
    </td>
    <td height='100%'>
      <table border='0' width='100%' height='100%' cellspacing='0' cellpadding='0'>
        <tr>
          <td width='100%' height='25'>
          <table border='0' width='100%' height='25' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='51' height='25'>
<img src='i/inman_b211.gif' width='51' height='25' alt=''></td>
    <td background='i/inman_b212.gif' valign='middle'>
    <table border='0' height='22' cellspacing='0' cellpadding='0'>
  <tr>
<td width='96' height='22'>&nbsp;</td>

  </tr>
</table>
   
    </td>
    <td width='51' height='25'>
<img src='i/inman_b213.gif' width='51' height='25' alt=''></td>
  </tr>
</table>
          </td>
        </tr>
        <tr>
          <td width='100%' height='100%' background='i/inman_fon.gif'>
            <table border='0' width='100%' height='100%' cellspacing='0' cellpadding='0' style='padding: 5'>
              <tr>
                <td width='50%' align='center'><img src=i/mir2_world/gl/logo.jpg alt='' border=1 galleryimg=no width=500 height=300></td>
<td width='50%' valign='top' align='center'>";

$CurrentTime = date("H");
//if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";
echo"<center><font color=red><b>$msg</b></font></center><br>";






echo "<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='98%'>
    <tr>
      <td width='100%' align='center'>
�� ���������� �� <b>������� �������</b> ������ <b>������� �����</b>, ����� �� ������ �������� <b>�������</b>, ��������� �� <b>�����</b> ���������� ��� ��� ������� �� ����... ��� �� �� ������ �������� <b>������� ��������</b>, � ��������� � ������ � <b>��������� �����</b>.
</td>
    </tr>
  </table>
</div><br>";

echo "<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='98%'>
    <tr>
      <td width='100%' colspan='2' align='center'><b>������� �������:</b></td>
    </tr>
    <tr>
      <td width='50%' align='center'><input type=button class=input value='�����' onclick='top.frames[\"main\"].location = \"main.php?set=map&room=1\"'></td>
      <td width='50%' align='center'><input type=button class=input value='���. �������' onclick='top.frames[\"main\"].location = \"world.php?room=7\"'></td>
    </tr>
    <tr>
      <td width='50%' align='center'><input type=button class=input value='�����' onclick='top.frames[\"main\"].location = \"world.php?room=40\"'></td>
      <td width='50%' align='center'><input type=button class=input value='���. ��������' onclick='top.frames[\"main\"].location = \"world.php?room=13\"'></td>
    </tr>
    <tr>
      <td width='50%' align='center'><input type=button class=input value='��������� �����' onclick='top.frames[\"main\"].location = \"world.php?room=48\"'></td>
      <td width='50%' align='center'><input type=button class=input value='���� ����' onclick='top.frames[\"main\"].location = \"world.php?room=36\"'></td>
	  
    </tr>
	  
	  <tr>
      <td width='50%' align='center'><input type=button class=input value='������ �����������' onclick='top.frames[\"main\"].location = \"world.php?room=32\"'></td>
      <td width='50%' align='center'><input type=button class=input value='��������� �����' onclick='top.frames[\"main\"].location = \"world.php?room=27\"'></td>
    </tr>
      <tr>
<td width='50%' align='center'><input type=button class=input value='<- ����� �2' onclick='top.frames[\"main\"].location = \"world.php?room=26\"'></td>
      <td width='50%' align='center'><input type=button class=input value='����� �1 ->' onclick='top.frames[\"main\"].location = \"world.php?room=25\"'></td>
      </tr>
	  
  </table>
</div>

</td>


                </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td width='100%' height='25'>
          <table border='0' width='100%' height='25' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='51' height='25'>
<img src='i/inman_b231.gif' width='51' height='25' alt=''></td>
    <td background='i/inman_b232.gif'>&nbsp;</td>
    <td width='51' height='25'>
<img src='i/inman_b233.gif' width='51' height='25' alt=''></td>
  </tr>
</table>

          </td>
        </tr>
      </table>
    </td>
    <td width='22' height='100%'>
    <table border='0' width='22' height='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='22' height='25'>
<img src='i/inman_b21.gif' width='22' height='25' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='69'><img src='i/inman_b22.gif' width='22' height='69' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='100%' background='i/inman_b23.gif'>&nbsp;</td>
  </tr>
  <tr>
    <td width='22' height='69'><img src='i/inman_b24.gif' width='22' height='69' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='25'><img src='i/inman_b25.gif' width='22' height='25' alt=''></td>
  </tr>
</table>
   </td>
  </tr>
</table>
      
      </td>
  </tr>
</table>";





}

?>