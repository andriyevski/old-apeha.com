<?
if (!is_numeric($otdel)&&isset($otdel))
die ('������� ������, ������ �� ������!!');
require_once("inc/module.php");
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat['t_time']>$now) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']>$now) { header("Location: academy.php"); exit; }
elseif ($stat['o_time']>$now) { header("Location: juvelir.php"); exit; }
elseif ($stat['r_time']>$now) { header("Location: podzem.php"); exit; }
elseif ($stat['lov_time']>$now) { header("Location: more.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['battle']) { header("Location: battle.php"); exit; }
elseif ($stat['room'] != 14) { header("Location: main.php"); exit; }
else {

	if (!isset($otdel)) $otdel=1;

	if (!empty($buy))
	include("inc/ashop/buy.php");
	if (!empty($sale))
	include("inc/ashop/sale_fnc.php");

	$title = '������� ����������';

	include("inc/ashop/otdels.php");

	echo"<link rel=stylesheet type='text/css' href='i/main.css'>
        <BODY background='/i/bg.gif'leftmargin=0 topmargin=0>
        <style>
        .none                { display: none }
        </style>

        <table width=100% cellspacing=0 cellpadding=5 border=0>
        <tr>
        <td>&nbsp;&nbsp;<b>� ��� �� �����:</b> <u>".$stat['valute']."</u> <b>��.</b>
        </td>
        <td align=right valign=top>

        <input class=lbut type=button value='��������' onclick='window.location.href=\"ashop.php?otdel=".$otdel."&tmp=\"+Math.random();\"\"'>

        <input class=lbut type=button value='���������' onclick='window.location.href=\"world.php?room=25&tmp=\"+Math.random();\"\"'>&nbsp;

        </td>
        </tr>
        </table>";
	echo"<table width=100% cellspacing=0 cellpadding=3 border=0>
        <tr>
        <td align=right>
        <center><font class=title>������� ����������</font></center><br>";

	if (!empty($msg)) echo"<center><FONT COLOR=RED><b>$msg</b></font></center><BR>";

	echo"<table width=100% cellspacing=0 cellpadding=3 border=0 background='/i/bg2.gif'>
        <tr>
        <td width=230 valign=top>

        <FIELDSET><LEGEND><a class=ch>������ ��������</a></LEGEND>

        <table width=100% cellspacing=0 cellpadding=5 border=0>
        <tr>
        <td>

        <table width=100% cellspacing=0 border=0 cellpadding=5 style='border-style: outset; border-width: 2'>
        <tr>
        <td>
        &nbsp;&bull; <a href='?otdel=1'>������</a><BR>

        &nbsp;&bull; <a href='?otdel=2'>��������</a><BR>

        &nbsp;&bull; <a href='?otdel=3'>��������� �������</a><BR>

        &nbsp;&bull; <a href='?otdel=4'>���������� ��������</a><BR>

        &nbsp;&bull; <a href='?otdel=10'>��������</a><BR>
        </td>
        </tr>
        </table>

        </td>
        </tr>
        </table>

        </FIELDSET>


        </td>
        <td valign=top>

        <FIELDSET><LEGEND><a class=ch>";
	echo"����������� ������� ������ \"".$otdels[$otdel]."\"&nbsp;";

	echo"</a></LEGEND>

        <table width=100% cellspacing=0 cellpadding=5 border=0>
        <tr>
        <td>

        <table width=100% cellspacing=0 border=0 cellpadding=5 style='border-style: outset; border-width: 2'>
        <tr>
        <td>
        ";

	if ($otdel == 10) include('inc/ashop/razmen.php');
	else include('inc/ashop/_otdels_.php');

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