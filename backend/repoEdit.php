<?php
include 'db.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data and sanitize it
    $repo_id = (int)$_POST['repo_id'];
    $title = $conn->real_escape_string(trim($_POST['title'])); // Sanitize title

    // Prepare the update query
    $query = "UPDATE repo_folder SET title = '$title' WHERE repo_id = $repo_id";

    // Execute the query and check for success
    if ($conn->query($query) === TRUE) {
        $message = "Title updated successfully.";
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
