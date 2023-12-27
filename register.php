<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form action="process_registration.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="confirm_password">Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            
            <input type="submit" value="Register">
        </form>
        <a href="index.html">Back to Login</a>
    </div>
</body>