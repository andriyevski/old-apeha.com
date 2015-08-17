<?
require_once("inc/module.php");

if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat['t_time']>$now) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']>$now) { header("Location: academy.php"); exit; }
elseif ($stat['o_time']>$now) { header("Location: juvelir.php"); exit; }
elseif ($stat['r_time']>$now) { header("Location: podzem.php"); exit; }
elseif ($stat['lov_time']>$now) { header("Location: more.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat['room'] != 40) { header("Location: main.php"); exit; }


else {

	$otdel=isset($otdel)?intval($otdel):1;

	if (!empty($buy))
	include("inc/komis/buy.php");
	if (!empty($sale))
	include("inc/komis/sale_fnc.php");
	if (!empty($unsale)) {
		$unsale = addslashes($unsale);

		mysql_query("UPDATE objects SET komis = '0' WHERE id=".addslashes($unsale)."");
		mysql_query("DELETE FROM komis WHERE id=".addslashes($unsale)."");
	}

	include("inc/komis/otdels.php");

	echo"<link rel=stylesheet type='text/css' href='i/shop_new.css'>
        <body background='/i/bg.gif'>

<table border='0' width='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='100%' align='center'>
      
      <table border='0' width='95%' height='28' cellspacing='0' cellpadding='0'>
  <tr>
    <td align='center'>
      <table border='0' height='28' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='83' height='4'><img src='i/inman_t11.gif' width='83' height='4' alt=''></td>
    <td height='4' background='i/inman_t12.gif'></td>
    <td width='80' height='4'><img src='i/inman_t13.gif' width='80' height='4' alt=''></td>
  </tr>
  <tr>
    <td width='83'>
<img src='i/inman_t20.gif' width='83' height='20' alt=''></td>
    <td background='i/inman_t21.gif' align='center'><a href='komis.php?otdel=100'><img src='i/shop/link_sale.gif'></a></td>
    <td width='80'><img src='i/inman_t22.gif' width='80' height='20' alt=''></td>
  </tr>
  <tr>
    <td width='83' height='4'><img src='i/inman_t29.gif' width='83' height='4' alt=''></td>
    <td height='4' background='i/inman_t30.gif'></td>
    <td width='80' height='4'><img src='i/inman_t31.gif' width='80' height='4' alt=''></td>
  </tr>
</table>
      
      </td>
    <td width='100%' align='center'>
      <table border='0' height='28' cellspacing='0' cellpadding='0' width='100%'>
  <tr>
    <td height='4' background='i/inman_t14.gif' width='100%'></td>
  </tr>
  <tr>
    <td background='i/inman_t23.gif' width='100%' align='center'>
<font face='Verdana'>
<b>Рынок</b></font>
    </td>
  </tr>
  <tr>
    <td height='4' background='i/inman_t32.gif' width='100%'></td>
  </tr>
</table>

      </td>
    <td align='center'>
           <table border='0' height='28' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='80' height='4'><img src='i/inman_t15.gif' width='80' height='4' alt=''></td>
    <td height='4' background='i/inman_t16.gif'></td>
    <td width='81' height='4'><img src='i/inman_t15_1.gif' width='81' height='4' alt=''></td>
     <td width='80' height='4'><img src='i/inman_t15.gif' width='80' height='4' alt=''></td>
    <td height='4' background='i/inman_t16.gif'></td>
    <td width='81' height='4'><img src='i/inman_t17.gif' width='81' height='4' alt=''></td>

  </tr>
  <tr>
    <td width='80'><img src='i/inman_t24.gif' width='80' height='20' alt=''></td>
    <td background='i/inman_t25.gif' align='center'><a href='komis.php?otdel=".$otdel."'><img src='i/shop/link_refresh.gif'></a></td>
    <td width='81'><img src='i/inman_t26_1.gif' width='81' height='20' alt=''></td>
    <td width='80'><img src='i/inman_t24.gif' width='80' height='20' alt=''></td>
    <td background='i/inman_t25.gif' align='center'><a href='world.php?room=0'><img src='i/shop/link_back.gif'></a></td>
    <td width='81'><img src='i/inman_t26.gif' width='81' height='20' alt=''></td>

  </tr>
  <tr>
    <td width='80' height='4'><img src='i/inman_t33.gif' width='80' height='4' alt=''></td>
    <td height='4' background='i/inman_t34.gif'></td>
    <td width='81' height='4'><img src='i/inman_t35.gif' width='81' height='4' alt=''></td>
    <td width='80' height='4'><img src='i/inman_t33.gif' width='80' height='4' alt=''></td>
    <td height='4' background='i/inman_t34.gif'></td>
    <td width='81' height='4'><img src='i/inman_t35.gif' width='81' height='4' alt=''></td>
  </tr>
</table>

      
      </td>
  </tr>
</table>
      
      
      </td>
  </tr>
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
<td width='10' height='22'>&nbsp;</td>

    <td width='43' height='22'><img border='0' src='i/inman_rb01.gif' width='43' height='22'></td>
    <td background='i/inman_rb02.gif' height='22' valign='middle'>
    <font color='#FFFFFF' face='Verdana' size='2'>У вас на счету: <u>".$stat['credits']." зм.</u></font></td>
    <td width='43' height='22'><img border='0' src='i/inman_rb03.gif' width='43' height='22'></td>
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
                <td width='80%' height='100%' align='center' valign='top'>";

	if (!empty($msg)) echo"<center><FONT COLOR=RED><b>$msg</b></font></center><BR>";

	if ($otdel == 100) include('inc/komis/sale.php');
	else include('inc/komis/_otdels.php');

	echo"
</td>
                <td width='20%' height='100%' valign='top'>
                
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='98%'>
    <tr>
      <td width='100%' colspan='2' align='center'><u>Оружие:</u></td>
    </tr>
    <tr>
      <td colspan='2' align='center'><a href='?otdel=1'>Оружие</a></td>
    </tr>
  </table>
</div>
<br>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='98%'>
    <tr>
      <td width='100%' colspan='2' align='center'><u>Амуниция:</u></td>
    </tr>
    <tr>
      <td width='50%' align='center'><a href='?otdel=8'>Шлемы</a></td>
      <td width='50%' align='center'><a href='?otdel=2'>Доспехи</a></td>
    </tr>
    <tr>
      <td width='50%' align='center'><a href='?otdel=11'>Браслеты</a></td>
      <td width='50%' align='center'><a href='?otdel=10'>Нарукавники</a></td>
    </tr>
    <tr>
      <td width='50%' align='center'><a href='?otdel=9'>Перчатки</a></td>
      <td width='50%' align='center'><a href='?otdel=5'>Щиты</a></td>
    </tr>
    <tr>
      <td width='50%' align='center'><a href='?otdel=7'>Пояса</a></td>
      <td width='50%' align='center'><a href='?otdel=6'>Обувь</a></td>
    </tr>
  </table>
</div>
<br>
    <div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='98%'>
<tr>
      <td width='100%' colspan='2' align='center'><u>Ювелирные украшения:</u></td>
    </tr>
    <tr>
      <td width='33%' align='center'><a href='?otdel=4'>Ожерелья</a></td>
      <td width='33%' align='center'><a href='?otdel=3'>Кольца</a></td>
    </tr>
  </table>
</div>
<br>
    <div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='98%'>
<tr>
      <td width='100%' colspan='2' align='center'><u>Магия:</u></td>
    </tr>
    <tr>
      <td width='33%' align='center'><a href='?otdel=12'>Свитки</a></td>
      <td width='33%' align='center'><a href='?otdel=16'>Зелья</a></td>
    </tr>
  </table>
</div>
<br>
    <div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 2' bordercolor='#D8C792' width='98%'>
<tr>
      <td width='100%' colspan='2' align='center'><u>Работа:</u></td>
    </tr>
    <tr>
      <td width='50%' align='center'><a href='?otdel=17'>Инструмент</a></td>
<td width='50%' align='center'><a href='?otdel=18'>Ресурс</a></td>
    </tr>
<tr>
      <td width='100%' colspan='2' align='center'><a href='?otdel=19'>Драгоценный камень</a></td>
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
</table>

</body>";
}
?>