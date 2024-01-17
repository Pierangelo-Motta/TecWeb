<?php
// if you're seeing the raw JSON output on the page, it means that the PHP file is being executed directly. To prevent this, you should ensure that the PHP file is only accessed through AJAX requests and not directly in the browser.

// In your data.php file, check whether the request is an AJAX request. If it is not, you can terminate the script.

// senza questo vedo il json se richiamo direttamente la pagina
//if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER//['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
//    exit; // Terminate if not an AJAX request
//}

require_once('login.model.php');

$userList = getListaElencoUtenti();
echo json_encode($userList);
?>