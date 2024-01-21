<?php
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Read the JSON data from the request body
    $requestData = json_decode(file_get_contents('php://input'), true);

    // Check if the 'action' key is present in the data
    if (isset($requestData['action'])) {
        
        // Assuming a database connection is established here
        // Replace this with your actual database connection code

        // Perform actions based on the 'action' parameter
        if ($requestData['action'] === 'update') {
            // Update the database with the provided data
            // Access the books data as $requestData['books']
            
            // Example: Update a table named 'medagliere' with book data
            // Replace this with your actual database update code
            // Example assumes 'remainingBooks' is an array with book data
            // and 'updateMedagliere' is a hypothetical function to update the database
            
            // da adattare
            //$updateResult = updateMedagliere($requestData['books']);
            $temp = $requestData['books'];
            
            $updateResult = "";
            // Return a response
            if ($updateResult) {
                $response = ['success' => true, 'message' => 'Update successfull'];
            } else {
                $response = ['success' => false, 'message' => 'Update failed'];
            }

            // Send the response as JSON
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            // Invalid action
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['error' => 'Invalid action']);
        }
    } else {
        // 'action' parameter not present
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['error' => 'Action parameter missing']);
    }
} else {
    // Invalid request method
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(['error' => 'Invalid request method']);
}
?>
