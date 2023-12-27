<?php
session_start();
require 'include/config.php';
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}
if (isset($_COOKIE['username'])) {
    unset($_COOKIE['username']); 
//    setcookie('username', '', -1, '/'); 
//return true;
} //else {
//return false;
//}
$user_id = $_SESSION['id'];
$user_name = $_SESSION['username'];
// Add your application logic here.
?> 

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to the Dashboard</h1>
   
    <p>You are logged in as <?php echo $user_name . " (id: " . $user_id.")"; ?></p>
    
    <!-- Add your application interface here. -->
    <?php



        print "</br>";
        echo "\$_SESSION: ";
        var_dump($_SESSION);
        print "</br>";
        echo "\$_SESSION['username']: ";
        var_dump($_SESSION['username']);
        print "</br>";
        echo "\$_COOKIE: ";
        var_dump($_COOKIE);
        print "</br>";
        echo "\$GLOBALS: ";
        var_dump($GLOBALS);
        // if(!isset($_COOKIE[$cookie_name])) {
        //     echo "Cookie named '" . $cookie_name . "' is not set!";
        // } else {
        //     echo "Cookie '" . $cookie_name . "' is set!<br>";
        //     echo  "Value is: " . $_COOKIE[$cookie_name];
        // }
    ?>
    <div id="timeLoggedIn"></div>
    <!-- First JS script! -->
    <script>
        // Set the starting time
        var startTime = new Date().getTime();
        
        function fmtMSS(s){return(s-(s%=60))/60+(9<s?':':':0')+s}
        
        // Update the time displayed every second
        setInterval(function() {
            var currentTime = new Date().getTime();
            var secondsLoggedIn = Math.floor((currentTime - startTime) / 1000);
            
            
            document.getElementById("timeLoggedIn").innerHTML = "You are on page for " + fmtMSS(secondsLoggedIn) + " seconds.";
          
        }, 1000);
    </script>
    <section><a href="other.php">Other sample page</a></section>
    <footer><a href="logout.php">Logout</a></footer>
</body>
</html>