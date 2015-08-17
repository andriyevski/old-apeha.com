<?php
$hourdiff = "0";
$timeadjust = ($hourdiff * 60 * 60);
$this_time = date("d.m.y H:i",time() + $timeadjust);
$times = date("H:i",time() + $timeadjust);
?>