<?include("../inc/db_connect.php");

$stat = mysql_fetch_array(mysql_query("SELECT * FROM players WHERE user='".addslashes($user)."' AND pass='".addslashes($pass)."' LIMIT 1"));
mysql_query("SET CHARSET cp1251");
if (empty($stat['id']) || $stat['bloked'] || $stat['admin']!=1) {
	echo"<script>top.window.location = '../index.php?action=logout';</script>";
	exit;
}


?>
<html>
<head>
<title>�����������������</title>
<link rel=stylesheet href=../i/main.css>
</head>
<body bgcolor=#EBEDEC>
<table border=0 width=100% height=100% cellspacing=0 cellpadding=0>
	<tr>
		<td align=center valign=middle>
		<center><?php if($stat['user']!=''){?><a href=?act=modify_users><b><u>���������
		<small>(��������������)</small></u></b></a> |<?php }?> <a
			href=?act=enc><b><u>������������ �����</u></b></a> | <a
			href=?act=shop><b><u>�������</u></b></a> | <a href=?act=><b><u>�����</u></b></a>
		| <a target='_blank' href='/add.php'><b><u>�������� � �������</u></b></a>
		| <a target='_blank' href='/clan_admin.php'><b><u>�����</u></b></a> |
		<a target='_blank' href='/news_admin.php'><b><u>�������</u></b></a> |
		<a target='_blank' href='/addbot.php'><b><u>�������� ����</u></b></a>
		| <a href=?act=moneys><b><u>������</u></b></a> |</center>
		<br>
		<br>
		<br>
		<table border=0 cellspacing=1 cellpadding=5 width=80% height=80%>
			<tr>
				<td bgcolor=#EBEDEC valign=top><br>
				<br>

				<?

				switch($act){
					// ������������
					case"modify_users":

						switch($do)
						{
							default:
								echo"<li> <a href=index.php?act=modify_users&do=list><b>������ �������������</b></a>";
								break;
							case"list":
								echo"
           
<B>������ �������������</B>";
								$rt=mysql_query("SELECT user,id,level,credits,f_credits,valute,rank,tribe FROM players");
								echo"<tr>
<td bgcolor=white Align=center width=5><br><b><u>ID</u></b></td>
<td bgcolor=white Align=center width=100><b><u>��� �����</u></b</td>
<td bgcolor=white Align=center width=5><b>���</b></td>
<td bgcolor=white Align=center width=5><b>�������</b></td>
<td bgcolor=white Align=center width=5><b>������</b></td>
<td bgcolor=white Align=center width=5><b>������</b></td></tr>";
								while ($reit = mysql_fetch_array($rt)) { $n+=1;
								echo"

<tr><td bgcolor=white Align=center width=5><br><b><u>$n.</u></b></td>
<td bgcolor=white Align=center width=100><a href=index.php?act=modify_users&login_p=$reit[user]>$reit[user]</a></td>
<td bgcolor=white Align=center width=5><b>$reit[level]</b></td>
<td bgcolor=white Align=center width=5><b>$reit[credits]</b></td>
<td bgcolor=white Align=center width=5><b>$reit[f_credits]</b></td>
<td bgcolor=white Align=center width=5><b>$reit[valute]</b></td></tr>"; }

								unset($rt,$reit,$n);
						}

						echo"
<form action='index.php' method=post>
<input type=hidden name=act value=modify_users>
���: <input type=text name=login_p value='$login_p'> <input type=submit value='�����'>
</form><hr size=1 color=#000000> ";

						if($login_p)
						{
							$query = "select * from players where user='$login_p'";
							$result = mysql_query($query);
							$num=mysql_num_rows($result);
							if($num==0)
							{
								echo"<b><i>�������� �� ������!</i></b>";
							}
							else
							{
								$row = mysql_fetch_array($result);
								if($do=="��������� ������")
								{
									$user=$_GET['user'];
									$result = mysql_query("update players set user='$user', pass='$passwd',	email='$email', rank='$rank', admin='$admin', level='$level', exp='$exp', credits='$credits', f_credits='$f_credits', strength='$strength', dex='$dex', agility='$agility', vitality='$vitality', power='$power', razum='$razum', hp_now='$hp_now', energy_now='$energy_now', wins='$wins', losses='$losses', room='$room', tribe='$tribe', tribe_rank='$tribe_rank', b_tribe='$b_tribe', rase='$rase', name='$name', about='$about', birth='$birth', birthdate='$birthdate', icq='$icq', real_city='$real_city', sex='$sex', obraz='$obraz', deviz='$deviz', url='$url', proff='$proff', valute='$valute', ip='$ip' where user='$user'");
									if($result)echo"<b>������ ���������</b>";
									else echo"<b><i>��������� ������������� ������!</i></b><br><br>";
									$row = mysql_fetch_array(mysql_query("select * from players where user='$login_p'"));

								}
								elseif($do=="������� ���������")
								{
									mysql_query("delete from players where id='$id_player'");
									if($result)echo"<b>�������� ������</b>";
								}

								echo"<form action='index.php' methdo=post>
<input type=hidden name=act value=modify_users>
<input type=hidden name=login_p value='$login_p'>
<input type=hidden name=id_player value='$row[id]'>
<table border=0>
<tr><td>id ���������:</td><td>$row[id] <a href=/inf.php?$row[id] target=_blank><small><u>�������� ����������</u></small></a></td></tr>
<tr><td>�����:</td><td><input type=text size=30 name=user value='$row[user]'></td></tr>
<tr><td>���:</td><td><input type=text size=30 maxlength=15 name=login_player value='$row[name]'></td></tr>
<tr><td>������ (MD5):</td><td><input type=text size=30 name=passwd value='$row[pass]'></td></tr>
<tr><td>���:</td><td><input type=radio name=sex value='1' ";if($row[sex]=="1")echo"checked"; echo"> <small>�������</small> <input type=radio name=sex value='2' ";if($row[sex]=="2")echo"checked";echo"> <small>�������</small></td></tr>
<tr><td>e-mail:</td><td><input type=text size=40 name=email value='$row[email]'></td></tr>
<tr><td>����:</td><td><input type=text size=40 name=rank value='$row[rank]'></td></tr>
<tr><td>����� ������:</td><td><input type=radio name=admin value='1' ";if($row[admin]=="1")echo"checked"; echo"> <small>��</small> <input type=radio name=admin value='0' ";if($row[admin]=="0")echo"checked";echo"> <small>���</small></td></tr>
<tr><td>�������:</td><td><input type=text size=8 name=level value='$row[level]'></td></tr>
<tr><td>����</td><td><input type=text size=20 name=exp value='$row[exp]'></td></tr>
<tr><td>������:</td><td><input type=text size=8 name=credits value='$row[credits]'></td></tr>
<tr><td>������:</td><td><input type=text size=8 name=f_credits value='$row[f_credits]'></td></tr>
<tr><td>������:</td><td><input type=text size=8 name=valute value='$row[valute]'></td></tr>
<tr><td>����:</td><td><input type=text size=8 name=strength value='$row[strength]'></td></tr>
<tr><td>�����:</td><td><input type=text size=8 name=dex value='$row[dex]'></td></tr>
<tr><td>��������:</td><td><input type=text size=8 name=agility value='$row[agility]'></td></tr>
<tr><td>������������:</td><td><input type=text size=8 name=vitality value='$row[vitality]'></td></tr>
<tr><td>�������:</td><td><input type=text size=8 name=power value='$row[power]'></td></tr>
<tr><td>�����:</td><td><input type=text size=8 name=razum value='$row[razum]'></td></tr>
<tr><td>��������:</td><td><input type=text size=8 name=hp_now value='$row[hp_now]'></td></tr>
<tr><td>����:</td><td><input type=text size=8 name=energy_now value='$row[energy_now]'></td></tr>
<tr><td>�����:</td><td><input type=text size=8 name=wins value='$row[wins]'></td></tr>
<tr><td>���������:</td><td><input type=text size=8 name=losses value='$row[losses]'></td></tr>
<tr><td>�������:</td><td><input type=radio name=room value='0' ";if($row[room]=="0")echo"checked"; echo"> <small>������� �������</small><input type=radio name=room value='1' ";if($row[room]=="1")echo"checked"; echo"> <small>������� ������� �1</small> <input type=radio name=room value='2' ";if($row[room]=="2")echo"checked";echo"> <small>������� ������� �2</small><input type=radio name=room value='3' ";if($row[room]=="3")echo"checked";echo"> <small>��� ������</small><input type=radio name=room value='4' ";if($row[room]=="4")echo"checked";echo"> <small>��� ��������</small><br><input type=radio name=room value='7' ";if($row[room]=="7")echo"checked";echo"> <small>�������</small><input type=radio name=room value='8' ";if($row[room]=="8")echo"checked";echo"> <small>��������</small><input type=radio name=room value='9' ";if($row[room]=="9")echo"checked";echo"> <small>��������</small><input type=radio name=room value='10' ";if($row[room]=="10")echo"checked";echo"> <small>������� \"������\"</small><input type=radio name=room value='11' ";if($row[room]=="11")echo"checked";echo"> <small>�������</small><input type=radio name=room value='12' ";if($row[room]=="12")echo"checked";echo"> <small>������� ���</small><br><input type=radio name=room value='13' ";if($row[room]=="13")echo"checked";echo"> <small>������� ��������</small><input type=radio name=room value='14' ";if($row[room]=="14")echo"checked";echo"> <small>������� \"��� ������\"</small><input type=radio name=room value='15' ";if($row[room]=="15")echo"checked";echo"> <small>���������� ���</small><input type=radio name=room value='' ";if($row[room]>="200" && $row[room]<="211")echo"checked";echo"> <small>����������</small><input type=radio name=room value='666' ";if($row[room]=="666")echo"checked";echo"> <small>������</small></td></tr>
<tr><td>����:</td><td><input type=text size=40 name=tribe value='$row[tribe]'></td></tr>
<tr><td>���� � �����:</td><td><input type=text size=40 name=tribe_rank value='$row[tribe_rank]'></td></tr>
<tr><td>����� �����:</td><td><input type=radio name=b_tribe value='1' ";if($row[b_tribe]=="1")echo"checked"; echo"> <small>��</small> <input type=radio name=b_tribe value='0' ";if($row[b_tribe]=="0")echo"checked";echo"> <small>���</small></td></tr>
<tr><td>����:</td><td><input type=text size=20 name=rase value='$row[rase]'></td></tr>
<tr><td>�����</td><td><input type=text size=20 name=obraz value='$row[obraz]'><small>.gif  | � ��������� \"icons\" ����� \"img\"</small></td></tr>
<tr><td>�����:</td><td><input type=text size=40 name=real_city value='$row[real_city]'></td></tr>
<tr><td>�������� ��������:</td><td><input type=text size=60 name=url value='$row[url]'></td></tr>
<tr><td>���� ��������: </td><td><input type=text size=20 name=birth value='$row[birth]'></td></tr>
<tr><td>���� �����������: </td><td><input type=text size=20 name=birthdate value='$row[birthdate]'></td></tr>
<tr><td>icq uin #</td><td><input type=text size=20 name=icq value='$row[icq]'></td></tr>";



								echo"<tr><td valign=top><small>��������� IP</small></td><td>'$row[ip]'</td></tr></table>
<input type=submit name=do value='��������� ������'> <input type=submit name=do value='������� ���������'></form>";

							}
						}
						break;
						break;
						//����


					case"enc":

						switch($do)
						{
							default:
								echo"<b>������������ �����:</b><br><br>
<li><a href=index.php?act=enc&do=add><b>�������� �������</b></a><br>
<li><a href=index.php?act=enc&do=edit><b>������������� �������</b></a><br>
<li><a href=index.php?act=enc&do=list><b>������ ���������</b></a><br>";
								break;
							case"add":
								echo"<a href=index.php?act=enc><b><u>�� �������</u></b></a><br><br>";

								if($_GET[name])
								{
									$result_items = mysql_query("select name from items where name='".$_GET[name]."'");
									$num_items = mysql_num_rows($result_items);
									if($num_items>0)
									{
										echo"<b><i>������� \"".$_GET[name]."\" ��� ���������� � ������������!</i></b>";
									}
									else
									{
										//$result_item = mysql_query("insert into items (name,title,price,tip,min_level,min_str,min_dex,min_ag,min_vit,min_razum,min_rase,min_proff,min,max) values('".$_GET[name]."','".$_GET[title]."','".$_GET[price]."','".$_GET[tip]."','".$_GET[min_level]."','".$_GET[min_str]."','".$_GET[min_dex]."','".$_GET[min_ag]."','".$_GET[min_vit]."','".$_GET[min_razum]."','".$_GET[min_rase]."','".$_GET[min_proff]."','".$_GET[min]."','".$_GET[max]."')");
										$result_item = mysql_query("insert into items (name,title,price,tip,min_level,min_str,min_dex,min_ag,min_vit,min_razum,min_rase,min_proff,min,max,hp,energy,br1,br2,br3,br4,br5,strength,dex,agility,vitality,razum,krit,unkrit,uv,unuv,iznos,about,art) values('".$_GET[name]."','".$_GET[title]."','".$_GET[price]."','".$_GET[tip]."','".$_GET[min_level]."','".$_GET[min_str]."','".$_GET[min_dex]."','".$_GET[min_ag]."','".$_GET[min_vit]."','".$_GET[min_razum]."','".$_GET[min_rase]."','".$_GET[min_proff]."','".$_GET[min]."','".$_GET[max]."','".$_GET[hp]."','".$_GET[energy]."','".$_GET[br1]."','".$_GET[br2]."','".$_GET[br3]."','".$_GET[br4]."','".$_GET[br5]."','".$_GET[strength]."','".$_GET[dex]."','".$_GET[agility]."','".$_GET[vitality]."','".$_GET[razum]."','".$_GET[krit]."','".$_GET[unkrit]."','".$_GET[uv]."','".$_GET[unuv]."','".$_GET[iznos]."','".$_GET[about]."','".$_GET[art]."')");
										if($result_item)echo"<b><i>������� \"".$_GET[name]."\" ������ �������� � ������������!</i></b>";
										else echo"<b><i>��������� ������������� ������!</i></b><br>"
										;
										echo mysql_error();
									}
									echo"<br><br>";
								}
								echo"<b>���������� ��������:</b><br><br>";
								echo"<form action=index.php method=get>
<input type=hidden name=act value=enc>
<input type=hidden name=do value=add>
<br><br>

";
								echo"
<input type=text name=title value='".$row_items[title]."'> : �������� ��������<br>
<input type=text name=price value='".$row_items[price]."' size=8> : ����<br>
<input type=text name=iznos value='".$row_items[iznos]."' size=8> : �����<br>
<input type=text name=tip value='".$row_items[tip]."' size=8> : ���<br>
<input type=text name=min_level value='".$row_items[min_level]."' size=8> : ����������� �������<br>
<input type=text name=min_str value='".$row_items[min_str]."' size=8> : ��� ����<br>
<input type=text name=min_ag value='".$row_items[min_ag]."' size=8> : ��� ��������<br>
<input type=text name=min_dex value='".$row_items[min_dex]."' size=8> : ��� �����<br>
<input type=text name=min_vit value='".$row_items[min_vit]."' size=8> : ��� ������������<br>
<input type=text name=min value='".$row_items[min]."' size=8> : ����������� ����<br>
<input type=text name=max value='".$row_items[max]."' size=8> : ������������ ����<br>
<input type=text name=hp value='".$row_items[hp]."' size=8> : ��������� ��<br>
<input type=text name=br1 value='".$row_items[br1]."' size=8> : ����� ������<br>
<input type=text name=br2 value='".$row_items[br2]."' size=8> : ����� ������<br>
<input type=text name=br3 value='".$row_items[br3]."' size=8> : ����� �����<br>
<input type=text name=br4 value='".$row_items[br4]."' size=8> : ����� ���<br>
<input type=text name=br5 value='".$row_items[br5]."' size=8> : ����� ���<br>
<input type=text name=strength value='".$row_items[strength]."' size=8> : + � ����<br>
<input type=text name=dex value='".$row_items[dex]."' size=8> : + � �����<br>
<input type=text name=agility value='".$row_items[agility]."' size=8> : + � ��������<br>
<input type=text name=vitality value='".$row_items[vitality]."' size=8> : + � ������������<br>
<input type=text name=razum value='".$row_items[razum]."' size=8> : + � ������<br>
<input type=text name=krit value='".$row_items[krit]."' size=8> : ����<br>
<input type=text name=unkrit value='".$row_items[unkrit]."' size=8> : ��������<br>
<input type=text name=uv value='".$row_items[uv]."' size=8> : ������<br>
<input type=text name=unuv value='".$row_items[unuv]."' size=8> : ����������<br>
<input type=text name=name value='".$row_items[name]."'> : ��� ��������<br>
<input type=text name=about value='".$row_items[about]."'> : ��������<br>
<input type=text name=min_razum value='".$row_items[min_razum]."' size=8> : ��� ������<br>
<input type=text name=min_rase value='".$row_items[min_rase]."' size=8> : ����<br>
<input type=text name=min_proff value='".$row_items[min_proff]."' size=8> : �����<br>
<input type=text name=energy value='".$row_items[energy]."' size=8> : ��������� ����<br>
<input type=text name=art value='".$row_items[art]."' size=8> : ��������<br>
<input type=submit value='�������� �������'></form><br><br>
";
								echo <<<HTML
<table>
<form enctype="multipart/form-data" action="upl.php" method="POST">
�����������:
<input size="48" name="file" type="file"><input size="48" type="hidden" value="" name="path" type="text"><input type="submit" value="�������"><br>

HTML;



								break;

							case"edit":
								echo"<a href=index.php?act=enc><b><u>�� �������</u></b></a><br><br>";
								if($_GET[del]=="������� �������" and $_GET[name])
								{
									$result_item = mysql_query("delete from items where name='".$_GET[name]."'");
									if($result_item)echo"<b><i>������� \"".$_GET[name]."\" ������ �����!</i></b><br><br>";
									else echo"<b><i>��������� ������������� ������!</i></b><br><br>";
								}
								elseif($_GET[save]=="��������� �������" and $_GET[name])
								{
									$result_item = mysql_query("update items set name='$name',title='$title',price='$price',tip='$tip',min_level='$min_level',min_str='$min_str',min_dex='$min_dex',min_ag='$min_ag',min_vit='$min_vit',min_razum='$min_razum',min_rase='$min_rase',min_proff='$min_proff',min='$min',max='$max',hp='$hp',energy='$energy',br1='$br1',br2='$br2', br3='$br3',br4='$br4',br5='$br5',strength='$strength',dex='$dex',agility='$agility',vitality='$vitality',razum='$razum$',krit='$krit',unkrit='$unkrit',uv='$uv',unuv='$unuv',iznos='$iznos',about='$about' where name='$name'");
									if($result_item)echo"<b><i>������� \"".$_GET[name]."\" ������ �������!</i></b><br><br>";
									else echo"<b><i>��������� ������������� ������!</i></b><br><br>";
								}
								echo"<b>�������������� ��������:</b><br><br>
<form action=index.php method=get>
<input type=hidden name=act value=enc>
<input type=hidden name=do value=edit>
����. �������� �������: <input type=text name=name value='".$_GET[name]."'> <input type=submit value='�����'></form>
<hr size=1 color=#000000>";

								if($_GET[name])
								{
									$result_items = mysql_query("select * from items where name='".$_GET[name]."'");
									$num_items = mysql_num_rows($result_items);
								}
								if($_GET[name] and $num_items==0)
								{
									echo"<b><i>������� �� ������ � ������������!</i></b>";
								}
								elseif($num_items>0)
								{
									$row_items = mysql_fetch_array($result_items);

									echo"<form action=index.php method=get>
<input type=hidden name=act value=enc>
<input type=hidden name=do value=edit>
<input type=hidden name=name value=".$row_items[name].">
<b>".$row_items[name]."</b> : ����. �������� ��������, ��� ��������, ������ ���� ����������<br>
<img src='../i/items/".$row_items[name].".gif'><br>
";


									echo"
<input type=text name=title value='".$row_items[title]."'> : �������� ��������<br>
<input type=text name=price value='".$row_items[price]."' size=8> : ����<br>
<input type=text name=iznos value='".$row_items[iznos]."' size=8> : �����<br>
<input type=text name=tip value='".$row_items[tip]."' size=8> : ���<br>
<input type=text name=min_level value='".$row_items[min_level]."' size=8> : ����������� �������<br>
<input type=text name=min_str value='".$row_items[min_str]."' size=8> : ��� ����<br>
<input type=text name=min_ag value='".$row_items[min_ag]."' size=8> : ��� ��������<br>
<input type=text name=min_dex value='".$row_items[min_dex]."' size=8> : ��� �����<br>
<input type=text name=min_vit value='".$row_items[min_vit]."' size=8> : ��� ������������<br>
<input type=text name=min value='".$row_items[min]."' size=8> : ����������� ����<br>
<input type=text name=max value='".$row_items[max]."' size=8> : ������������ ����<br>
<input type=text name=hp value='".$row_items[hp]."' size=8> : ��������� ��<br>
<input type=text name=br1 value='".$row_items[br1]."' size=8> : ����� ������<br>
<input type=text name=br2 value='".$row_items[br2]."' size=8> : ����� ������<br>
<input type=text name=br3 value='".$row_items[br3]."' size=8> : ����� �����<br>
<input type=text name=br4 value='".$row_items[br4]."' size=8> : ����� ���<br>
<input type=text name=br5 value='".$row_items[br5]."' size=8> : ����� ���<br>
<input type=text name=strength value='".$row_items[strength]."' size=8> : + � ����<br>
<input type=text name=dex value='".$row_items[dex]."' size=8> : + � �����<br>
<input type=text name=agility value='".$row_items[agility]."' size=8> : + � ��������<br>
<input type=text name=vitality value='".$row_items[vitality]."' size=8> : + � ������������<br>
<input type=text name=razum value='".$row_items[razum]."' size=8> : + � ������<br>
<input type=text name=krit value='".$row_items[krit]."' size=8> : ����<br>
<input type=text name=unkrit value='".$row_items[unkrit]."' size=8> : ��������<br>
<input type=text name=uv value='".$row_items[uv]."' size=8> : ������<br>
<input type=text name=unuv value='".$row_items[unuv]."' size=8> : ����������<br>
<input type=text name=name value='".$row_items[name]."'> : ��� ��������<br>
<input type=text name=about value='".$row_items[about]."'> : ��������<br>
<input type=text name=min_razum value='".$row_items[min_razum]."' size=8> : ��� ������<br>
<input type=text name=min_rase value='".$row_items[min_rase]."' size=8> : ����<br>
<input type=text name=min_proff value='".$row_items[min_proff]."' size=8> : �����<br>
<input type=text name=energy value='".$row_items[energy]."' size=8> : ��������� ����<br>
<input type=text name=art value='".$row_items[art]."' size=8> : ��������<br>
<input type=submit value='��������� �������' name=save><input type=submit value='������� �������' name=del></form><br><br>
";
								}

								break;

							case"list":
								echo "<a href=index.php?act=enc><b><u>�� �������</u></b></a><br><br>
<b>������ ���������:</b><br>
<ul><form action=index.php>
<input type=hidden name=act value=enc>
<input type=hidden name=do value=list>";
								$rt=mysql_query("SELECT name,title,price,tip,min_level,min_str,min_dex,min_ag,min_vit,min_razum,min_rase,min_proff,min,max,hp,energy,br1,br2,br3,br4,br5,strength,dex,agility,vitality,razum,krit,unkrit,uv,unuv,iznos,about, art FROM items");
								echo"
<tr>
<td bgcolor=white Align=center width=5><br><b><u>�����</u></b></td>
<td bgcolor=white Align=center width=5><br><b><u>���</u></b></td>
<td bgcolor=white Align=center width=5><b><u>��� � ����</u></b</td>
<td bgcolor=white Align=center width=5><b>����</b></td>
<td bgcolor=white Align=center width=5><b>���</b></td>
<td bgcolor=white Align=center width=5><b>��� �������</b></td>
<td bgcolor=white Align=center width=5><b>��� ����</b></td>
<td bgcolor=white Align=center width=5><b>��� �����</b></td>
<td bgcolor=white Align=center width=5><b>��� ��������</b></td>
<td bgcolor=white Align=center width=5><b>��� ������������</b></td>
<td bgcolor=white Align=center width=5><b>��� ������</b></td>
<td bgcolor=white Align=center width=5><b>����</b></td>
<td bgcolor=white Align=center width=5><b>�����</b></td>
<td bgcolor=white Align=center width=5><b>��� ����</b></td>
<td bgcolor=white Align=center width=5><b>���� ����</b></td>
<td bgcolor=white Align=center width=5><b>��������� ��</b></td>
<td bgcolor=white Align=center width=5><b>��������� ����</b></td>
<td bgcolor=white Align=center width=5><b>����� ������</b></td>
<td bgcolor=white Align=center width=5><b>����� ������</b></td>
<td bgcolor=white Align=center width=5><b>����� ���</b></td>
<td bgcolor=white Align=center width=5><b>����� ���</b></td>
<td bgcolor=white Align=center width=5><b>����� �����</b></td>
<td bgcolor=white Align=center width=5><b>��������� ����</b></td>
<td bgcolor=white Align=center width=5><b>��������� �����</b></td>
<td bgcolor=white Align=center width=5><b>��������� ��������</b></td>
<td bgcolor=white Align=center width=5><b>��������� ������������</b></td>
<td bgcolor=white Align=center width=5><b>��������� ������</b></td>
<td bgcolor=white Align=center width=5><b>����</b></td>
<td bgcolor=white Align=center width=5><b>��������</b></td>
<td bgcolor=white Align=center width=5><b>������</b></td>
<td bgcolor=white Align=center width=5><b>����������</b></td>
<td bgcolor=white Align=center width=5><b>�����</b></td>
<td bgcolor=white Align=center width=5><b>��������</b></td>
<td bgcolor=white Align=center width=5><b>��������</b></td>
</tr>
";

								while ($reit = mysql_fetch_array($rt)) { $n+=1;
								echo"
<tr><td bgcolor=white Align=center width=5><br><b><u>$n.</u></b></td>
<td bgcolor=white Align=center width=5><b><a href=index.php?act=enc&do=edit&name=$reit[name]>$reit[name]</a><b></td>
<td bgcolor=white Align=center width=5><b>$reit[title]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[price]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[tip]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[min_level]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[min_str]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[min_dex]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[min_ag]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[min_vit]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[min_razum]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[min_rase]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[min_proff]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[min]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[max]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[hp]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[energy]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[br1]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[br2]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[br3]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[br4]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[br5]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[strength]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[dex]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[agility]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[vitality]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[razum]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[krit]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[unkrit]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[uv]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[unuv]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[iznos]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[about]<b></td>
<td bgcolor=white Align=center width=5><b>$reit[art]<b>
</tr>
";}

								unset($rt,$reit,$n);
						}


						break;
						break;
						//�������


					case"shop":

						switch($do)
						{
							default:
								echo"<li><a href=index.php?act=shop&do=add><b>�������� ������� � �������</b></a>
<li><a href=index.php?act=shop&do=edit><b>������������� ������� � ��������</b></a>
<li><a href=index.php?act=shop&do=list><b>������ ��������� � ��������</b></a>
";
								break;
							case"add":
								echo"<a href=index.php?act=shop><b><u>�� �������</u></b></a><br><br>";
								if($_GET[name])
								{
									$result_shop = mysql_query("select name from shop where name='".$_GET[name]."'");
									$num_shop = mysql_num_rows($result_shop);

									$result_items = mysql_query("select name from items where name='".$_GET[name]."'");
									$num_items = mysql_num_rows($result_items);

									if($num_shop>0)
									echo"<b><i>������� � ������ ".$_GET[name]." ��� ���������� � ��������!</i></b><br><br>";
									elseif($num_items==0)
									echo"<b><i>������� � ������ ".$_GET[name]." �� ���������� � ������������!</i></b><br><br>";
									else
									{
										$result_shop = mysql_query("insert into `shop` (otdel,name,kol,city) values('".$_GET[otdel]."','".$_GET[name]."','".$_GET[kol]."','0')");echo mysql_error();
										if($result_shop)echo"<b><i>������� � ID # ".$_GET[name]." ������ �������� � �������!</i></b><br><br>";
										else echo"<b><i>��������� ������������� ������!</i></b><br><br>";
									}
								}
								echo"<form action=index.php method=get>
<input type=hidden name=act value=shop>
<input type=hidden name=do value=add>

<b>���������� �������� � �������:</b><br><br>
<input type=text name=otdel value='".$_GET[otdel]."' size=8> : �����<br>
<input type=text name=name value='".$_GET[name]."' size=8> : ��� ��������<br>
<input type=text name=kol value='".$_GET[kol]."' size=8> : ����������<br>
<input type=submit value='�������� �������'></form>
";
								break;
							case"edit":
								echo"<a href=index.php?act=shop><b><u>�� �������</u></b></a><br><br>";

								if($_GET[name] and $_GET[delete]=="������� �������")
								{
									$result_shop = mysql_query("delete from shop where name='".$_GET[name]."'");
									if($result_shop)echo"<b><i>������� � ������ ".$_GET[name]." ������ �����!</i></b><br><br>";
									else echo"<b><i>��������� ������������� ������!</i></b><br><br>";
								}
								elseif($_GET[name] and $_GET[save]=="��������� �������")
								{
									$result_shop = mysql_query("update shop set otdel='".$_GET[otdel]."',name='".$_GET[name]."', kol='".$_GET[kol]."' where name='".$_GET[name]."'");
									if($result_shop)echo"<b><i>������� � ������ ".$_GET[name]." ������ �������!</i></b><br><br>";
									else echo"<b><i>��������� ������������� ������!</i></b><br><br>";
								}
								echo"<b>�������������� �������� � ��������:</b><br><br>
<form action=index.php method=get>
<input type=hidden name=act value=shop>
<input type=hidden name=do value=edit>
��� ��������: <input type=text name=name value='".$_GET[name]."'> <input type=submit value='�����'>
<hr size=1 color=#000000></form>";
								if($_GET[name])
								{
									$result_shop = mysql_query("select * from shop where name like '%".$_GET[name]."%'");
									$num_shop = mysql_num_rows($result_shop);
								}
								if($_GET[name] and $num_shop==0)
								echo"<b><i>������� � ������ ".$_GET[name]." �� ������ � ��������!</i></b>";
								elseif($_GET[name])
								{
									$row_shop = mysql_fetch_array($result_shop);
									echo "
<form action=index.php method=get>
<input type=hidden name=act value=shop>
<input type=hidden name=do value=edit>
<input type=hidden name=name value=".$_GET[name].">
<b>".$row_shop[name]."</b> : ��� ��������<br>
";

									echo"

<input type=text name=otdel value='".$row_shop[otdel]."' size=8> : �����<br>
<input type=text name=name value='".$row_shop[name]."' size=8> : ���<br>
<input type=text name=kol value='".$row_shop[kol]."' size=8> : ����������<br>

<input type=submit value='��������� �������' name=save> <input type=submit value='������� �������' name=delete></form>";
								}
									
								break;
							case"list":
								echo "<a href=index.php?act=shop><b><u>�� �������</u></b></a><br><br>
<b>������ ���������:</b><br>
<ul><form action=index.php>
<input type=hidden name=act value=shop>
<input type=hidden name=do value=list>";
								$rt=mysql_query("SELECT otdel, name, kol FROM shop");
								echo"
<tr>
<td bgcolor=white Align=center width=5><br><b><u>#</u></b></td>
<td bgcolor=white Align=center width=5><br><b><u>�����</u></b></td>
<td bgcolor=white Align=center width=5><br><b><u>���</u></b></td>
<td bgcolor=white Align=center width=5><b><u>����������</u></b</td>
</tr>
";

								while ($reit = mysql_fetch_array($rt)) { $n+=1;
								echo"
<tr><td bgcolor=white Align=center width=5><br><b><u>$n.</u></b></td>
<td bgcolor=white Align=center width=5><b>$reit[otdel]<b></td>
<td bgcolor=white Align=center width=5><b><a href=index.php?act=shop&do=edit&name=$reit[name]>$reit[name]</a><b></td>
<td bgcolor=white Align=center width=5><b>$reit[kol]<b></td>
</tr>
";}

								unset($rt,$reit,$n);
						}


						break;
						break;

						//�����


					case"":

						switch($do)
						{
							default:
								echo"<li><a href=index.php?act=&do=add><b>�������� ������� � �����</b></a>
<li><a href=index.php?act=&do=edit><b>������������� ������� � �����</b></a>
<li><a href=index.php?act=&do=list><b>������ ��������� � �����</b></a>
";
								break;
							case"add":
								echo"<a href=index.php?act=><b><u>�� �������</u></b></a><br><br>";
								if($_GET[name])
								{
									$result_ = mysql_query("select name from  where name='".$_GET[name]."'");
									$num_ = mysql_num_rows($result_shop);

									$result_items = mysql_query("select name from items where name='".$_GET[name]."'");
									$num_items = mysql_num_rows($result_items);

									if($num_>0)
									echo"<b><i>������� � ������ ".$_GET[name]." ��� ���������� � ��������!</i></b><br><br>";
									elseif($num_items==0)
									echo"<b><i>������� � ������ ".$_GET[name]." �� ���������� � ������������!</i></b><br><br>";
									else
									{
										$result_ = mysql_query("insert into `ashop` (otdel,name,kol) values('".$_GET[otdel]."','".$_GET[name]."','".$_GET[kol]."')");
										if($result_)echo"<b><i>������� � ID # ".$_GET[name]." ������ �������� � �����!</i></b><br><br>";
										else echo"<b><i>��������� ������������� ������!</i></b><br><br>";
									}
								}
								echo"<form action=index.php method=get>
<input type=hidden name=act value=>
<input type=hidden name=do value=add>

<b>���������� �������� � �����:</b><br><br>
<input type=text name=otdel value='".$_GET[otdel]."' size=8> : �����<br>
<input type=text name=name value='".$_GET[name]."' size=8> : ��� ��������<br>
<input type=text name=kol value='".$_GET[kol]."' size=8> : ����������<br>
<input type=submit value='�������� �������'></form>
";
								break;
							case"edit":
								echo"<a href=index.php?act=><b><u>�� �������</u></b></a><br><br>";

								if($_GET[name] and $_GET[delete]=="������� �������")
								{
									$result_ = mysql_query("delete from ashop where name='".$_GET[name]."'");
									if($result_butik)echo"<b><i>������� � ������ ".$_GET[name]." ������ �����!</i></b><br><br>";
									else echo"<b><i>��������� ������������� ������!</i></b><br><br>";
								}
								elseif($_GET[name] and $_GET[save]=="��������� �������")
								{
									$result_butik = mysql_query("update ashop set otdel='".$_GET[otdel]."',name='".$_GET[name]."', kol='".$_GET[kol]."' where name='".$_GET[name]."'");
									if($result_butik)echo"<b><i>������� � ������ ".$_GET[name]." ������ �������!</i></b><br><br>";
									else echo"<b><i>��������� ������������� ������!</i></b><br><br>";
								}
								echo"<b>�������������� �������� � ��������:</b><br><br>
<form action=index.php method=get>
<input type=hidden name=act value=butik>
<input type=hidden name=do value=edit>
��� ��������: <input type=text name=name value='".$_GET[name]."'> <input type=submit value='�����'>
<hr size=1 color=#000000></form>";
								if($_GET[name])
								{
									$result_butik = mysql_query("select * from ashop where name='".$_GET[name]."'");
									$num_butik = mysql_num_rows($result_shop);
								}
								if($_GET[name] and $num_butik==0)
								echo"<b><i>������� � ������ ".$_GET[name]." �� ������ � ��������!</i></b>";
								elseif($_GET[name])
								{
									$row_butik = mysql_fetch_array($result_butik);
									echo "
<form action=index.php method=get>
<input type=hidden name=act value=butik>
<input type=hidden name=do value=edit>
<input type=hidden name=name value=".$_GET[name].">
<b>".$row_shop[name]."</b> : ��� ��������<br>
";

									echo"

<input type=text name=otdel value='".$row_butik[otdel]."' size=8> : �����<br>
<input type=text name=name value='".$row_butikp[name]."' size=8> : ���<br>
<input type=text name=kol value='".$row_butik[kol]."' size=8> : ����������<br>

<input type=submit value='��������� �������' name=save> <input type=submit value='������� �������' name=delete></form>";
								}
									
								break;
							case"list":
								echo "<a href=index.php?act=butik><b><u>�� �������</u></b></a><br><br>
<b>������ ���������:</b><br>
<ul><form action=index.php>
<input type=hidden name=act value=butik>
<input type=hidden name=do value=list>";
								$rt=mysql_query("SELECT otdel, name, kol FROM ashop");
								echo"
<tr>
<td bgcolor=white Align=center width=5><br><b><u>#</u></b></td>
<td bgcolor=white Align=center width=5><br><b><u>�����</u></b></td>
<td bgcolor=white Align=center width=5><br><b><u>���</u></b></td>
<td bgcolor=white Align=center width=5><b><u>����������</u></b</td>
</tr>
";

								while ($reit = mysql_fetch_array($rt)) { $n+=1;
								echo"
<tr><td bgcolor=white Align=center width=5><br><b><u>$n.</u></b></td>
<td bgcolor=white Align=center width=5><b>$reit[otdel]<b></td>
<td bgcolor=white Align=center width=5><b><a href=index.php?act=butik&do=edit&name=$reit[name]>$reit[name]</a><b></td>
<td bgcolor=white Align=center width=5><b>$reit[kol]<b></td>
</tr>
";}

								unset($rt,$reit,$n);
						}


						break;
						break;

						//�����
					case"moneys":
						echo"<TABLE WIDTH=100% cellpadding=3 cellspacing=0>
<tr>
<td NOWRAP align=center>
<b>��� ����� ������ <font color=green>�����!</font></b>
</td>
</tr>
<tr>
<td NOWRAP>";

						$m=mysql_query("SELECT * FROM diller order by id");


						for ($i=0; $i<mysql_num_rows($m); $i++) {
							$diller=mysql_fetch_array($m);
							echo "<B>".$diller['user']."</B> ����� ������ <b>".$diller['money']."</b> ��.<BR>";
						}

						echo"</td>
</tr>
</table>





";

						break;
				}

				?></td>
			</tr>
			<tr>
				<td height=20 bgcolor=#EBEDEC></td>
			</tr>
		</table>

		</td>
	</tr>
</table>

</body>
</html>
