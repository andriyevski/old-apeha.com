<?

$onset=$_GET['onset'];
$unset=$_GET['unset'];
$item_type=$_GET['item_type'];
$drop=$_GET['drop'];


if (!empty($onset) || !empty($unset) || !empty($drop)) include("inc/main/functions.php");

if (!empty($onset)) { on_set("$onset"); }
if (!empty($unset) && $unset!="all") { un_set("$unset"); }
elseif ($unset=="all") { un_set_all(); }
if (!empty($drop)) { drop("$drop"); }

include('inc/header.php');

if ($item_type && ($item_type != $stat['item_type'])) {
	switch ($item_type) {
		case 1: $ITType = 1; break;
		case 2: $ITType = 2; break;
		case 3: $ITType = 3; break;
		case 4: $ITType = 4; break;
		case 5: $ITType = 5; break;
		case 6: $ITType = 6; break;
		case 7: $ITType = 7; break;
		case 8: $ITType = 8; break;
		case 9: $ITType = 9; break;
		case 10: $ITType = 10; break;
		default: $ITType = 1; break;
	}
	mysql_query("UPDATE players SET item_type=".$ITType." WHERE user='".$stat['user']."'");
	$stat['item_type'] = $ITType;
}

// Спрашиваем, действительно ли нужно выбросить предмет
print"
<script>
function drop (title, id) {
if (confirm('Вы действительно хотите выбросить предмет \"'+title+'\"?')) window.location='main.php?set=edit&drop='+id+'' }
</script>";

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
                <td width='100%' align='center'>";
echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='100%'>
    <tr>";
echo"<td align=center width=20%><b><a ";  if ($stat[item_type]==1 || !isset($stat[item_type]) || empty($stat[item_type])) echo" disabled";
else echo"href='main.php?set=edit&item_type=1'"; echo">Амуниция</b></td>";

echo"<td align=center width=20%><b><a ";  if ($stat[item_type]==2) echo" disabled";
else echo"href='main.php?set=edit&item_type=2'"; echo">Магия</b></td>";

echo"<td align=center width=20%><b><a ";  if ($stat[item_type]==3) echo" disabled";
else echo"href='main.php?set=edit&item_type=3'"; echo">Прочее</b></td>";

echo"<td align=center width=20%><b><a ";  if ($stat[item_type]==4) echo" disabled";
else echo"href='main.php?set=edit&item_type=4'"; echo">Инструменты</b></td>";


echo "<td width='20%' align='center'><input class=input type=button value='Снять все' onClick=top.main.location.href=\"main.php?set=edit&unset=all\"></td>
    </tr>";

echo"<tr><td align=center width=20%><b><a ";  if ($stat[item_type]==8) echo" disabled";
else echo"href='main.php?set=edit&item_type=8'"; echo">Зелья</b></td>";

echo"<td align=center width=20%><b><a ";  if ($stat[item_type]==6) echo" disabled";
else echo"href='main.php?set=edit&item_type=6'"; echo">Подарки</b></td>";

echo"<td align=center width=20%><b><a ";  if ($stat[item_type]==5) echo" disabled";
else echo"href='main.php?set=edit&item_type=5'"; echo">Камни</b></td>";

echo"<td align=center width=20%><b><a ";  if ($stat[item_type]==9) echo" disabled";
else echo"href='main.php?set=edit&item_type=9'"; echo">Ресурсы</b></td>";

echo"
      <td width='20%' align='center'><input class=input type=button value='Назад' onClick=top.main.location.href=\"main.php\"></td>
    </tr>";

echo"<tr><td align=center width=20%><b><a ";  if ($stat[item_type]==10) echo" disabled";
else echo"href='main.php?set=edit&item_type=10'"; echo">Рецепты</b></td>";

echo"<td align=center width=20%> </td>";

echo"<td align=center width=20%> </td>";

echo"<td align=center width=20%> </td>";

echo"
      <td width='20%' align='center'><input class=input type=button value='Статусы' onClick=top.main.location.href=\"main.php?set=status\"></td>
    </tr>
  </table>
</div>";
echo"
</td>
              </tr>
              <tr>
                <td colspan='2' width='100%' height='100%'>";

if ($stat['item_type']==9)
include('inc/main/ing.php');
else
include('inc/main/invent.php');

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