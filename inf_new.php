<?
# include('inc/noflood.php');

include('inc/db_connect.php');

mysql_query("SET CHARSET cp1251");
$now=time();

$error = "<title>������!</title><link rel=stylesheet type='text/css' href='i/main.css'>
   <body bgColor=#d2d2d2>
 <font color=red><b>������:</b></font><br>�������� � ����� ������� ��� ID �� ������!";

if (isset($_GET['login']) && !empty($_GET['login'])){
	$login = mysql_escape_string($_GET['login']);
	$where = " where players.user='".addslashes($login)."'";
}
elseif (is_numeric($_SERVER['QUERY_STRING']))
{
	$id = mysql_escape_string($_SERVER['QUERY_STRING']);
	$where = " where players.id=".addslashes($id);
}
else
{
	die($error);
}
$query = mysql_query("select * from players".$where."");


// ���� �� ����������, ��������� �������� �� ������ �������.


if (mysql_num_rows($query)==0) { die($error); }
else {
	$info = mysql_fetch_array($query);

	$stat = mysql_fetch_array(mysql_query("select rank, admin, id from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));
	$clan = mysql_fetch_array(mysql_query("select * from tribes where name='".$info[tribe]."'"));


	if ($info['rase']==1) $rase="���";
	elseif ($info['rase']==2) $rase="����";
	elseif ($info['rase']==3) $rase="�������";
	elseif ($info['rase']==4) $rase="����";
	elseif ($info['rase']==100) $rase="�����";

	$block = '';
	if ($info['bloked']){
		$block = "<br><font class=bloked>�������� ������������!</font><br><b>������� ����������:</b> <font color=red class=ch><b>".$info['bloked']."</b></font>";
	}

	$ctime = time();

	$motto = '';
	if (!empty($info['deviz'])){
		$motto = "<b>�����</b>: <a class=ch>".$info['deviz']."</a><br>";
	}
	$icq = '';
	if ($info['icq']!=0){
		$icq = "<b>ICQ</b>: <a class=ch>".$info['icq']."</a><br>";
	}
	$homepage = '';
	if (!empty($info['url'])){
		$homepage = "<b>�������� ��������</b>: <a href='".$info['url']."' target=_blank><font class=ch>".$info['url']."</font></a><br>";
	}

	?>

<html>
<head>
<title>��������� ����� - [ ���������� � ��������� ] - <?=$info['user']?></title>
<link rel=stylesheet type='text/css' href='i/inf/main.css'>
<meta http-equiv=Content-Type content='text/html; charset=windows-1251'>
<META Http-Equiv=Cache-Control Content=no-cache>
<meta http-equiv=PRAGMA content=NO-CACHE>
<META Http-Equiv=Expires Content=0>
</head>

<BODY LEFTMARGIN=0 TOPMARGIN=0 bgColor=#d2d2d2>

<div id=hint1 class=hint></div>
<script src='i/inf.js'></script>
<script src='i/show_inf.js'></script>
<script src='i/time.js'></script>




<TABLE width=100% height=25 cellspacing=0 cellpadding=0>
	<tr height=25>

		<td background='i/forum/top_left.gif' width=27><img
			src='i/forum/1.gif'></td>
		<td background='i/forum/top_center.gif'><img src='i/forum/1.gif'></td>
		<td background='i/forum/top_right.gif' width=26><img
			src='i/forum/1.gif'></td>

	</tr>
</TABLE>


<TABLE width=100% cellspacing=0 cellpadding=0>
	<tr>
		<td background='i/forum/left_2.gif' width=7></td>
		<td align=center background='i/inf/line.gif'><? include('inc/inf/stats.php'); ?>




		<!-- �������, �������, ����� � ������ ������ --> <BR>
		<TABLE WIDTH=100% cellspacing=0 cellpadding=0
			style='padding-left: 10;' border=0>
			<TR>
				<TD><?
				if ($info['m_time'] > $now) echo "<img src=''>&nbsp;������� ������ �� ������� ����<br>";
				if ($info['sign'] > $now) echo "<img src=''>&nbsp;��������� ������� ������� �� ����� � ����<br>";
				if ($info['invisible'] > $now) echo "<img src=''>&nbsp;��������� �������� ����<br>";
				if ($info['travma'] > $now) echo "<img src='i/travma.gif'>&nbsp;��������� �����������<br>";
				?></TD>
			</TR>
		</TABLE>
		<!-- ����� ������ --> <?
		//
		if ((($stat['rank']>=10 && $stat['rank']<=14) || $stat['rank']>=98) || $stat['admin'] == 1) {
			?> <BR>

		<TABLE cellspacing=0 cellpadding=0 width=97% bgColor=#d2d2d2>
			<TR HEIGHT=5>
				<TD width=5><IMG SRC='i/inf/i_1.gif'></TD>
				<TD><IMG SRC='i/forum/1.gif'></TD>
				<TD width=5><IMG SRC='i/inf/i_2.gif'></TD>
			</TR>
			<TR>
				<TD><IMG SRC='i/forum/1.gif'></TD>
				<TD>




				<center><font face=Verdana size=2pt><u>������ ���� ��������� <b><?=$info['user']?></b></u></font></center>
				<table width=100% cellspacing=0 cellpadding=0 border=0>
					<tr>
						<td width=100%><? include('inc/inf/transfers.php'); ?> <? include('inc/inf/ld.php'); ?>

						<?
						$otchet=mysql_query("SELECT ip, result FROM `security` WHERE user='$info[user]'");
						$otchets=mysql_fetch_array($otchet);
						if ($otchets['result']==1) $result="&nbsp;<img src='i/fixed_on.gif' alt='���� � ������� ��������'>";
						elseif ($otchets['result']==2) $result="&nbsp;<img src='i/fixed_off.gif' alt='�������� ������!'>";
						else  $result="��� ������ � ��!&nbsp;<img src='i/clock.gif' alt='������ ����� ������������ ��� �� ���� �� �������!'>";
						?>
						<table width=100% cellspacing=0 cellpadding=3 border=0>

							<tr>
								<td width=26%><b>IP ��� �����������:</b></td>
								<td><b><i><?=$info['ip']?></i></b></td>
							</tr>

							<tr>
								<td width=26%><b>IP ���������:</b></td>
								<td><b><i><?=$otchets['ip']?><?=$result?></i></b></td>
							</tr>

							<tr>
								<td><b>E-Mail �����:</b></td>
								<td><a href='mailto:<?=$info['email']?>'><i><?=$info['email']?></i></a></td>
							</tr>

							<tr>
								<td><b>���� ��������:</b></td>
								<td><i><?=$info['birth']?></i></td>
							</tr>

							<tr>
								<td><b>����������:</b></td>
								<td><? if ($info['user']!="root" && $info['user']!="��� �" && $info['user']!="Insider") include('inc/inf/mults.php'); ?>

								</td>
							</tr>
							<tr>
								<td><b>�������:</b></td>
								<td><i><?=$info['browser']?></i></b></td>
							</tr>
							<tr>
								<td><b>����:</b></td>
								<td><i><?=$info['exp']?></i></b></td>
							</tr>
							<tr>
								<td><b>������� ������:</b></td>
								<td><i><?=$info['credits']?></i></b></td>
							</tr>
							<tr>
								<td><b>���� �������:</b></td>
								<td><i><?=$info['f_credits']?></i></b></td>
							</tr>
							<tr>
								<td><b>������ ����������:</b></td>
								<td><i><?=$info['valute']?></i></b></td>
							</tr>
							<tr>
								<td><b>��������������� UP-��:</b></td>
								<td><i><?=$info['s_updates']?></i></b></td>
							</tr>
							<? echo" <tr><td><b><a href=inc/inf/view_logs.php?login=$info[user]>���� ����</a></b></td></tr>"; ?>

						</table>
						</td>
					</tr>
				</table>




				</TD>
				<TD><IMG SRC='i/forum/1.gif'></TD>
			</TR>
			<TR HEIGHT=5>
				<TD width=5><IMG SRC='i/inf/i_3.gif'></TD>
				<TD><IMG SRC='i/forum/1.gif'></TD>
				<TD width=5><IMG SRC='i/inf/i_4.gif'></TD>
			</TR>
		</TABLE>

		<?
		}
		?></td>
		<td background='i/forum/right_2.gif' width=6></td>
	</tr>

</table>


<TABLE width=100% height=7 cellspacing=0 cellpadding=0>
	<tr height=7>

		<td background='i/forum/bottom_left.gif' width=7><img
			src='i/forum/1.gif'></td>
		<td background='i/forum/bottom_center.gif'><img src='i/forum/1.gif'></td>
		<td background='i/forum/bottom_right.gif' width=6><img
			src='i/forum/1.gif'></td>

	</tr>
</TABLE>

<?
 }
?>