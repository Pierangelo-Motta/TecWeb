<?php

require_once("../config.php");

global $conn;
$tmp = $_GET["pTit"];

$sql = "SELECT titolo FROM libro WHERE titolo LIKE \"%" . $tmp . "%\";";
$stmt = $conn->prepare($sql);
$stmt->execute();

$result = $stmt->get_result();
echo json_encode($result->fetch_all(MYSQLI_ASSOC));

?>