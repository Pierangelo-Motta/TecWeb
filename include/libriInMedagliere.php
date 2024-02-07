<?php 
session_start();

require_once("config.php");
require_once ("medaglieri.php");

$result = $medaglieri->getLibriMedaglieri($_GET['idLibro']);

// Convert the result to a JSON response
$rows = array();
while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}
echo json_encode($rows);

?>
