<?php


$tmp = __DIR__;
$tmp .= DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "..";
$remain = DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . "post" . DIRECTORY_SEPARATOR . "tmp" . DIRECTORY_SEPARATOR;
$myDir = $tmp . $remain;

$who = $_POST["uName"];

foreach (glob($myDir . $who . "*.*") as $nomefile) {
    unlink($nomefile);
}


?>
