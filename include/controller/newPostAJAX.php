<?php


$tmp = __DIR__;
$tmp .= DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "..";
$remain = DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . "post" . DIRECTORY_SEPARATOR . "tmp" . DIRECTORY_SEPARATOR;
$myDir = $tmp . $remain;
// echo $myDir;
$who = $_POST["uName"];
// $complete = $myDir . 
foreach (glob($myDir . $who . "*.*") as $nomefile) {
    unlink($nomefile);
    // echo $nomefile;
    // echo "Dimensione " . $nomefile . ": " . filesize($nomefile) . "\n";
}

// $result = array("A" => $tmp, "B" => $remain, "AB" => $myDir, "C" => $who);

// echo json_encode($result);


?>
