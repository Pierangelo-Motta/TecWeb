<?php

require_once("../config.php");


global $conn;
$tmp = $_GET["pTit"];



$sql = "SELECT titolo FROM libro WHERE titolo LIKE \"%" . $tmp . "%\";";
$stmt = $conn->prepare($sql);
$stmt->execute();


$result = $stmt->get_result();
echo json_encode($result->fetch_all(MYSQLI_ASSOC));


// global $conn;
//     $sql = "SELECT id,username,isAdmin,stato FROM utente where username != 'admin'";
//     // $sql = "SELECT id,username,isAdmin,stato FROM utente";
//     $stmt = $conn->prepare($sql);
//     //$stmt->bind_param("s", $username);

//     $stmt->execute();

//     $result = $stmt->get_result();
//     return $result->fetch_all(MYSQLI_ASSOC);
?>