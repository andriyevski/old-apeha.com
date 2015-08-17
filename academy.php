
<noscript></noscript>
<?
include("inc/db_connect.php");
include("inc/html_header.php");
$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));
$now=time();
if ($stat[bloked]) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat['t_time']>$now) {  print"<script>location.href='prison.php'</script>"; exit; }
elseif ($stat['o_time']>time()) {  print"<script>location.href='juvelir.php'</script>"; exit; }
//elseif ($stat['k_time']>$now) {  print"<script>location.href='academy.php'</script>"; exit; }
elseif ($stat['lov_time']>$now) {  print"<script>location.href='more.php'</script>"; exit; }
elseif ($stat['mol_bog_swet']>$now) {  print"<script>location.href='bog_hram.php'</script>"; exit; }
elseif ($stat['mol_bog_tima']>$now) {  print"<script>location.href='bog_hram.php'</script>"; exit; }
elseif ($stat['battle']) {  print"<script>location.href='battle.php'</script>"; exit; }
//elseif ($stat[room]!="9") {  print"<script>location.href='main.php'</script>"; exit; }
else {

	if ($getproff!="" && $getm=="") {
		$ch=mysql_fetch_array(mysql_query("SELECT * FROM academy where id=".addslashes($getproff)." and type=0"));

		if (!empty($ch[id])) { // Существует
			if ($stat[k_time]<time()) { // Свободен
				if ($stat[credits]>=$ch[price]) { // Хватает бабок
					if ($stat[level]>=$ch[level]) { // Хватает левела
$stat['k_time']=$now+$ch[srok];
						mysql_query("UPDATE players set proff=$ch[id], k_time=$now+$ch[srok], credits=credits-$ch[price] where id=$stat[id]");
						$msg="Процесс обучения начат! По окончанию обучения Вы станете высококвалицицированным специалистом!";

					} else $msg="Вы не можете получить эту профессию, уровень маловат!";
				} else $msg="Недостаточно золота!";
			} else $msg="Вы не можете заниматься сразу двумя делами!";
		} else $msg="Академия не предоставляет таких услуг!";
	}

	echo"<script language=JavaScript src=i/time.js></script>";
	echo"
<body background='/i/bg.gif' leftmargin=0 topmargin=0>
<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
        <td><b>У Вас на счету:</b> <u>".$stat[credits]."</u> <b>зм.</b>
        </td>
<td align=right valign=top>
<INPUT class=input type=button value='Помощь' onclick='window.open(\"help/academy.php\",\"\",\"\");'>
<input class=input type=button value='Обновить' onclick='window.location.href=\"academy.php?tmp=\"+Math.random();\"\"'>
<input class=input type=button value='Вернуться' onclick='window.location.href=\"world.php?room=25&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";


	if ($stat['k_time']>$now) {
		echo"<center><table cellspacing=0 cellpadding=3>
<tr>
<td><font color=red><b>Оставшееся время обучения:</b></font></td>
<td><b id='know' style='color: red'></b><script>ShowTime('know',",$stat['k_time']-$now,");</script></td>
</tr>
</table>"; }
	//	else if ($stat['k_time']<time()){mysql_query("update players set k_time='' where id='".$stat['id']."'");}
		if ($msg!="") echo"<center><font color=red><b>$msg</b></font></center>";


		echo "<table border='0' width='100%' cellspacing='0' cellpadding='0'>
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
            <table border='0' width='100%' height='100%' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 3'>
<tr><td width='100%' valign='top'>";

		echo"

<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr><td align='center'>

<b>В нашем заведении Вы можете стать высококвалифицированным специалистом. Ниже приведён список предлагаемых Вам профессий:</b>

</td></tr>
</table>
</div>


<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
<tr>
<td width=18 align=center><b>№</b></td>
<td><b>Наименование</b></td>
<td width=150 align=center><b>Срок обучения</b></td>
<td width=160 align=center><b>Стоимость обучения</b></td>
<td align=center width=120><b>Роспись</b></td>
</tr>";
		$ac=mysql_query("SELECT * FROM academy where type=0 order by srok");
		for ($i=0; $i<mysql_numrows($ac); $i++) {
			$acs=mysql_fetch_array($ac);
			echo"
<tr>
<td align=center>".($i+1)."</td>
<td>$acs[title]</td>
<td align=center>".(round($acs[srok]/60,1))." мин.</td>
<td align=center>$acs[price] зм</td>
<td align=center><input type=button class=input value='Обучаться'";
			if ($stat['k_time']<$now){echo" onclick=\"if (confirm('Вы действительно хотите получить данную профессию?')) window.location='academy.php?getproff=$acs[id]&'+Math.random();''\"";} else echo" disabled";
			echo"></td></tr>"; }
			echo"</table></div>";

			echo"
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