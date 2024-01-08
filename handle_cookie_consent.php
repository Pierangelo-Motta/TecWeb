<!-- handle_cookie_consent.php -->
<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the 'consent' field is set in the form submission
    if (isset($_POST["consent"])) {
        // Get the value of the 'consent' field (accept or decline)
        $consentValue = $_POST["consent"];

        // Set the 'cookie_consent' cookie with the user's choice
        setcookie("cookie_consent", $consentValue, time() + 86400 * 30, "/");
    }
}

// Redirect back to the main page or another relevant location
header("Location: index.html");
exit;

?>
