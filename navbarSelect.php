<?php

function isMobile() {
  return preg_match('/(Android|iPhone|iPad|iPod|Windows Phone)/i', $_SERVER['HTTP_USER_AGENT']);
}

if  (isMobile()) {
  include('navbarTel.php');
} else {
  include('navbar.php');
}

?>
