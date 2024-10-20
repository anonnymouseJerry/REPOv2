<?php
include 'db.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data and sanitize it
    $id = (int)$_POST['id'];
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $office_id = (int)$_POST['office_id'];
    $accesstype_id = (int)$_POST['accesstype_id'];

    // Prepare the update query
    $query = "UPDATE users SET full_name = '$full_name', email = '$email', office_id = $office_id, accesstype_id = $accesstype_id WHERE id = $id";

    // Execute the query and check for success
    if ($conn->query($query) === TRUE) {
        $message = "User updated successfully.";
        $alertType = "success";
    } else {
        $message = "Error: " . $conn->error;
        $alertType = "error";
    }

    // Close connection
    $conn->close();

    // Output response
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
}
?>
