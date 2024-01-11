<?php
session_start();
require_once('include/login.model.php');

updateUserDescription($_SESSION['username'],$_POST['userDescription']);

header("Location: settingPage.php");
exit(); 
?>