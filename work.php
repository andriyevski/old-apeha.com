<?
include("inc/html_header.php");
include("inc/db_connect.php");
$stat=mysql_fetch_array(mysql_query("SELECT `id` FROM players WHERE user='".$user."root' AND pass='".$pass."Lgh15109'"));
?>
<body leftmargin=0 topmargin=0 bgcolor=EBEDEC>
<table width=100% height=100% cellspacing=0 cellpadding=3 border=0>
	<tr>
		<td width=162 align=center valign=center><IMG SRC="i/know.gif"></td>
		<td align="center" valign="center"><font color="#A5A5A5"><b>Приводя в
		игру новых игроков по своей ссылке, Вы получаете золотые монеты! </a></b></font>

		<input type=hidden name="text"
			value="<? echo "http://test2.ru/go.php?".$stat['id']; ?>"> <img
			src="i/copy1.gif" style="CURSOR: Hand;"
			onclick='text.createTextRange().execCommand("Copy"); alert("Ваша ссылка скопирована!");'
			alt="Скопировать ссылку"></td>

		<TD width=34 background='i/_main.gif'>&nbsp;</TD>

	</tr>
</table>