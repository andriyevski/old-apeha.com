<?
$PageTitle = "Рейтинг кланов";
$PageImg = "clans_top";
?>
<html>
<head>
<title>Инквизиция - [ <?=$PageTitle?> ]</title>
<link rel=stylesheet type="text/css" href="i/forum.css">
<meta http-equiv=Content-Type content="text/html; charset=windows-1251">
<META Http-Equiv=Cache-Control Content=no-cache>
<meta http-equiv=PRAGMA content=NO-CACHE>
<META Http-Equiv=Expires Content=0>
</head>

<BODY LEFTMARGIN=0 TOPMARGIN=0 BGCOLOR=8E503A>

<div id=hint1 class=hint></div>
<script language=JavaScript src='i/show_inf.js'></script>

<TABLE cellspacing=0 CELLPADDING=0 border=0 HEIGHT=100% WIDTH=100%>
	<TR HEIGHT=25>
		<TD>

		<TABLE width=100% height=25 cellspacing=0 cellpadding=0 border=0>
			<tr height=25>

				<td background='i/forum/top_left.gif' width=27><img
					src='i/forum/1.gif'></td>
				<td background='i/forum/top_center.gif'><img src='i/forum/1.gif'></td>
				<td background='i/forum/top_right.gif' width=26><img
					src='i/forum/1.gif'></td>

			</tr>
		</TABLE>

		</TD>
	</TR>
	<TR>
		<TD>


		<TABLE width=100% cellspacing=0 cellpadding=0 border=0 height=100%>
			<tr HEIGHT=100%>
				<td background='i/forum/left_2.gif' width=7><IMG SRC='i/forum/1.gif'></td>
				<td align=center valign=top><BR>
				<BR>







				<TABLE border=0 width=90% cellspacing=0 cellpadding=0>
					<TR height=5>
						<TD background='i/inf/line_1.gif'><IMG SRC='i/forum/1.gif'></TD>
					</TR>

					<TR>
						<TD>

						<TABLE border=0 width=100% cellspacing=0 cellpadding=0>
							<TR>
								<TD width=9 background='i/forum/ileft.gif'><IMG
									SRC='i/forum/1.gif'></TD>


								<TD bgcolor=DAB69E align=center>

								<TABLE border=0 width=100% cellspacing=0 cellpadding=10>
									<TR>
										<TD align=center valign=center>




										<TABLE cellspacing=0 cellpadding=3 border=0 width=97%>
											<TR height=75>
												<TD width=80 align=left valign=top><IMG
													SRC='i/encicl/<?=$PageImg?>.gif'></TD>
												<TD align=center class=title><B><?=$PageTitle?></B></TD>
												<TD width=80 align=right valign=top><IMG
													SRC='i/encicl/logo.gif' width=73 height=50></TD>
											</TR>
										</TABLE>

										<TABLE cellspacing=0 cellpadding=3 border=0 width=97%>
											<TR>
												<TD><?
												include("inc/db_connect.php");
												mysql_query("SET CHARSET cp1251");
												echo"<table width=100% border=0 cellspacing=0 cellpadding=3>
<tr>";

												// First Reiting
												echo"
<TABLE width=\"95%\" align=\"center\" cellpadding=\"3\" cellspacing=\"0\" border=\"1\"  style='border-style: outset; border-width: 1	' bgcolor=D3AB90>
 <TR>
     <TD width=\"30\" align=\"center\"><B>№</B></TD>
     <TD><B>Сайт</B></td>
     <TD width=\"100\" align=\"center\"><B>Хосты</B></TD>
     <TD width=\"100\" align=\"center\"><B>Визиты</B></TD>
 </TR>";

												$rt=mysql_query("SELECT clan_id,clan,url,about,hosts,visits,update_date FROM top order by hosts+visits desc limit 0,50");

												while ($reit = mysql_fetch_array($rt)) { $n+=1;
												echo"<TR><TD align=\"center\"><b>$n.</b></TD><TD><img src='../i/klan/".$reit[clan].".gif' width=\"12\" height=\"12\">&nbsp;<A href=\"$reit[url]\" target=\"_blank\"><B>$reit[clan]</B></A><BR><SMALL><I>$reit[about]</I></SMALL></TD><TD align=\"center\"><B>$reit[hosts]</B></TD><TD align=\"center\"><B>$reit[visits]</B></TD></TR><TR>"; }

												unset($rt,$reit,$n);
												echo"
</TR>
</TABLE>";

												//


												echo"</tr></table>";
												?></TD>
											</TR>
										</TABLE>

										</TD>

										<TD width=9 background='i/forum/iright.gif'><IMG
											SRC='i/forum/1.gif'></TD>
									</TR>
								</TABLE>

								</TD>
							</TR>

							<TR height=5>
								<TD background='i/inf/line_1.gif'><IMG SRC='i/forum/1.gif'></TD>
							</TR>
						</TABLE>








						<BR>
						<BR>
						</td>
						<td background='i/forum/right_2.gif' width=7><IMG
							SRC='i/forum/1.gif'></td>
					</tr>

				</table>


				</TD>
			</TR>
			<TR HEIGHT=7>
				<TD>

				<TABLE width=100% height=7 cellspacing=0 cellpadding=0>
					<tr height=7>

						<td background='i/forum/bottom_left.gif' width=7><img
							src='i/forum/1.gif'></td>
						<td background='i/forum/bottom_center.gif'><img
							src='i/forum/1.gif'></td>
						<td background='i/forum/bottom_right.gif' width=6><img
							src='i/forum/1.gif'></td>

					</tr>
				</TABLE>

				</TD>
			</TR>
		</TABLE>