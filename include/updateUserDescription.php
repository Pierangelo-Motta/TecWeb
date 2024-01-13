<?php
session_start();
require_once('login.model.php');

updateUserDescription($_SESSION['username'],$_POST['userDescription']);

header("Location: ../settingPage.php");
exit(); 
?>