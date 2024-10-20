<?php
include 'db.php';

// Get form data
$full_name = $conn->real_escape_string($_POST['name']);
$email = $conn->real_escape_string($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing the password
$office_id = (int)$_POST['office_id'];
$accesstype_id = (int)$_POST['accesstype_id'];

// Check if the email already exists
$emailCheckQuery = "SELECT id FROM users WHERE email = '$email'";
$emailCheckResult = $conn->query($emailCheckQuery);

if ($emailCheckResult->num_rows > 0) {
    $message = "Error: Email already exists.";
    $alertType = "error";
} else {
    // Insert query
    $query = "INSERT INTO users (full_name, email, password, office_id, accesstype_id) VALUES ('$full_name', '$email', '$password', $office_id, $accesstype_id)";

    if ($conn->query($query) === TRUE) {
        $message = "New user added successfully";
        $alertType = "success";
    } else {
        $message = "Error: " . $conn->error;
        $alertType = "error";
    }
}

// Close connection
$conn->close();

// Output HTML with JavaScript alert
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Response</title>
</head>
<body>
    <script>
        alert('$message');
        window.location.href = '../frontend/user.php'; // Redirect to user.php after alert
    </script>
</body>
</html>";
?>
