<?php
include 'db.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data and sanitize it
    $file_id = (int)$_POST['file_id'];
    $original_file_name = $conn->real_escape_string(trim($_POST['original_file_name'])); // Sanitize file name

    // Debugging: Log POST data
    error_log("POST Data: " . print_r($_POST, true));

    // Prepare the update query
    $query = "UPDATE repo_file SET original_file_name = '$original_file_name' WHERE file_id = $file_id";

    // Debugging: Log the query
    error_log("Update Query: " . $query);

    // Execute the query and check for success
    if ($conn->query($query) === TRUE) {
        $message = "File name updated successfully.";
    } else {
        error_log("Database error: " . $conn->error); // Log error to server logs
        $message = "Error: " . $conn->error;
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
            window.location.href = '../frontend/repository_file.php'; // Redirect to repository_file.php after alert
        </script>
    </body>
    </html>";
}
?>
