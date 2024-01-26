<?php
$servername = "127.0.0.1";
$dbusername = "root";
$dbpassword = "";
$dbname = "letturepremiate";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$linkForMoreInfos = "infoPoint.php";

?>