<?php
session_start();

// unset all session variables
$_SESSION = array();

// destroy the session
session_destroy();

// redirect user to login page
header("Location: loginformw.php");
exit();
?>
