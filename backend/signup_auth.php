<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php'; // Database connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate fields and set error messages
    $error_redirect = false;

    if (empty($name)) {
        $error_redirect = true;
        $error_message = "Please fill in all fields.";
        header("Location: ../signup.php?name_error=" . urlencode($error_message) . "&name=" . urlencode($name) . "&email=" . urlencode($email));
        exit();
    }

    if ($password !== $confirm_password) {
        $error_redirect = true;
        $error_message = "Passwords do not match.";
        header("Location: ../signup.php?confirm_password_error=" . urlencode($error_message) . "&name=" . urlencode($name) . "&email=" . urlencode($email));
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error_redirect = true;
        $error_message = "Email already exists. Please use a different email.";
        header("Location: ../signup.php?email_error=" . urlencode($error_message) . "&name=" . urlencode($name) . "&email=" . urlencode($email));
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);
    
    if ($stmt->execute()) {
        echo "<script>window.onload = function() { Swal.fire('Success!', 'Registration successful!', 'success').then(() => { window.location.href = '../index.php'; }); };</script>";
    } else {
        error_log("SQL Error: " . $stmt->error);
        $error_message = "Error: " . $stmt->error;
        header("Location: ../signup.php?error=" . urlencode($error_message));
    }

    $stmt->close();
}

$conn->close();
?>
