<?php
require_once 'config.php';
require_once 'login.model.php';

session_start();

// Assuming 'books' is an array of books with 'id' and 'titolo' keys
$json_data = file_get_contents('php://input');
// echo $json_data;
$data = json_decode($json_data, true);
// echo $data;

// Check if 'books' key exists in the decoded data
if (isset($data['books'])) {
    $books = $data['books'];

    // Log message
    // $logMessage = "This is a log message.";
    $logMessage = "Books variable content: " . var_export($data, true);
    // Log file path
    $logFilePath = "./insertLibriInMedagliere.txt";
    // Write to the log file
    file_put_contents($logFilePath, $logMessage . PHP_EOL, FILE_APPEND);
    
    // salva i libri su DB
    saveBooks($books);
    
    // Output a message to indicate the log has been written
    // echo "Log written successfully.";

    // Return a response (adjust as needed)
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Books saved successfully']);
} else {
    // Handle case where 'books' key is not present in the decoded data
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Invalid data format']);
}


?>
