<?
include("inc/db_connect.php");

$stat = mysql_fetch_array(mysql_query("SELECT * FROM players WHERE user='".addslashes($user)."' AND pass='".addslashes($pass)."'"));

if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat['t_time']) { header("Location: prison.php"); exit; }

elseif ($stat['k_time']) { header("Location: academy.php"); exit; }
elseif ($stat['w_time']) { header("Location: works.php"); exit; }
elseif ($stat['r_time']) { header("Location: vault.php"); exit; }
elseif ($stat['forest_time']) { header("Location: forest.php"); exit; }
elseif ($stat['o_time']) { header("Location: repair.php"); exit; }
elseif ($stat['battle']) { header("Location: battle.php"); exit; }
elseif ($stat['room'] != 30) { header("Location: main.php"); exit; }

else {

	$otdel=isset($otdel)?intval($otdel):20;

	if (!empty($buy))
	include("inc/shop/buy.php");
	if (!empty($sale))
	include("inc/shop/sale_fnc.php");

	$title = 'Склад';

	include("inc/html_header.php");
	include("inc/shop/otdels.php");




	echo"<table width=100% cellspacing=0 cellpadding=3 border=0>
        <tr>
        <td align=right>
        <center><font class=title>Склады</font></center><br>";

	if (!empty($msg)) echo"<center><FONT COLOR=RED><b>$msg</b></font></center><BR>";

	echo"<table width=100% cellspacing=0 cellpadding=3 border=0>
        <tr>


        <FIELDSET><LEGEND><a class=ch>";
	if ($otdel != 100) echo"Ассортимент ресурсов на складе \"".$otdels[$otdel]."\"&nbsp;";
	else echo"Ассортимент Ваших предметов&nbsp;";

	echo"</a></LEGEND>

        <table width=100% cellspacing=0 cellpadding=5 border=0>
        <tr>
        <td>

        <table width=100% cellspacing=0 border=0 cellpadding=5 style='border-style: outset; border-width: 2'>
        <tr>
        <td>
        ";

	if ($otdel == 100) include('inc/shop/sale.php');
	else include('inc/shop/_otdels.php');

	echo"
        </td>
        </tr>
        </table>

        </td>
        </tr>
        </table>

        </FIELDSET>



        </td>
        </tr>
        </table>
        ";

	echo"
        </td>
        </tr>
        </table>";
}
?>
<BODY bgcolor=EBEDEC leftmargin=0 topmargin=0
	background='i/backgrounds/shop.jpg'
	style='background-attachment: fixed;'>