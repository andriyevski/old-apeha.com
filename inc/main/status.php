<?
include('inc/header.php');
$now=time();

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
            <table border='0' width='100%' height='100%' cellspacing='0' cellpadding='0' style='border-collapse: collapse; border-style: solid; padding: 3'>
              <tr>
                <td width='100%' align='center' valign='top'>";

echo"<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>Действие</b></td><td align='center'><b>Время</b></td></tr>";

if ($stat['m_time']>$now) echo"<tr><td align='center'>Запрет на общение в чате</td><td align='center'><div id=mol></div><script>ShowTime('mol',",$stat['m_time']-$now,");</script></td></tr>";
if ($stat['f_time']>$now) echo"<tr><td align='center'>Запрет на общение на форуме</td><td align='center'><div id=forum></div><script>ShowTime('forum',",$stat['f_time']-$now,");</script></td></tr>";
if ($stat['k_time']>$now) echo"<tr><td>Вы на обучении</td><td align='center'><div id=know></div><script>ShowTime('know',",$stat['k_time']-$now,");</script></td></tr>";
if ($stat['sign']>$now) echo"<tr><td align='center'>Получение опыта увеличено в 5 раз</td><td align='center'><div id=sign></div><script>ShowTime('sign',",$stat['sign']-$now,");</script></td></tr>";
if ($stat['abonement']>$now) echo"<tr><td align='center'>Игровой абонемент на 30 дней</td><td align='center'><div id=sign></div><script>ShowTime('sign',",$stat['abonement']-$now,");</script></td></tr>";
if ($stat['travma']>$now) echo"<tr><td align='center'>Вы травмированы</td><td align='center'><div id=travma></div><script>ShowTime('travma',",$stat['travma']-$now,");</script></td></tr>";
if ($stat['elik_sila']>$now) echo"<tr><td align='center'>На вас действует зелье силы</td><td align='center'><div id=elik_sila></div><script>ShowTime('elik_sila',",$stat['elik_sila']-$now,");</script></td></tr>";
if ($stat['elik_lovkost']>$now) echo"<tr align='center'><td>На вас действует зелье ловкости</td><td align='center'><div id=elik_lovkost></div><script>ShowTime('elik_lovkost',",$stat['elik_lovkost']-$now,");</script></td></tr>";
if ($stat['elik_inta']>$now) echo"<tr><td align='center'>На вас действует зелье удачи</td><td align='center'><div id=elik_inta></div><script>ShowTime('elik_inta',",$stat['elik_inta']-$now,");</script></td></tr>";
if ($stat['elik_vinosl']>$now) echo"<tr><td align='center'>На вас действует зелье выносливости</td><td align='center'><div id=elik_vinosl></div><script>ShowTime('elik_vinosl',",$stat['elik_vinosl']-$now,");</script></td></tr>";
if ($stat['elik_razum']>$now) echo"<tr><td align='center'>На вас действует зелье разума</td><td align='center'><div id=elik_razum></div><script>ShowTime('elik_razum',",$stat['elik_razum']-$now,");</script></td></tr>";
if ($stat['le4']>$now) echo"<tr><td align='center'>Ускоренное лечение в 2 раза</td><td align='center'><div id=le4></div><script>ShowTime('le4',",$stat['le4']-$now,");</script></td></tr>";
if ($stat['immun']>$now) echo"<tr><td align='center'>Иммунитет к нападениям</td><td align='center'><div id=le4></div><script>ShowTime('immun',",$stat['immun']-$now,");</script></td></tr>";

if ($stat['m_time']<$now && $stat['f_time']<$now && $stat['k_time']<$now && $stat['sign']<$now && $stat['travma']<$now && $stat['elik_sila']<$now && $stat['elik_lovkost']<$now && $stat['elik_inta']<$now && $stat['elik_vinosl']<$now && $stat['elik_razum']<$now && $stat['immun']<$now)
echo "<tr><td align='center' colspan='2'>На вас не действую никакие бонусы.</td></tr>";

echo "</table>
</div>";


echo"                </td>
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
?>