<?php
error_reporting(0);
include 'src/gol.php';
$gol = new GoL(json_decode($_POST["arrData"]));
$res = $gol->iterate();
echo json_encode($res);
exit;
