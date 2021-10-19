<?php
// Initialize the session

session_start();

// unset all the session variables

$_SESSION = array();

// destroy the session
session_destroy();

// Redirect to landing page

header("location: index.php");
exit;
?>