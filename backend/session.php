<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // If not logged in, redirect to the login page
    header("Location: ../index.php"); // Change to your login page
    exit();
}

// var_dump($_SESSION);

?>