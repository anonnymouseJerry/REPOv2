<?php
include 'db.php';
session_start(); // Ensure you start the session to access user data

// Get the ID of the logged-in user
$user_id = $_SESSION['id']; // Assuming you store the user ID in the session

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data and sanitize it
    $title = $conn->real_escape_string(trim($_POST['title'])); // Sanitize title

    // Prepare the insert query
    $query = "INSERT INTO repo_folder (title, user_id) VALUES ('$title', $user_id)";

    // Execute the query and check for success
    if ($conn->query($query) === TRUE) {
        $message = "New folder added successfully.";
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
            window.location.href = '../frontend/repository.php'; // Redirect to repository.php after alert
        </script>
    </body>
    </html>";
}
?>
