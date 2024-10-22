<?php
// db.php - Ensure you include your database connection here
include 'db.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify that 'file_id' is set in the POST request
    if (isset($_POST['file_id']) && is_numeric($_POST['file_id'])) {
        $file_id = (int)$_POST['file_id']; // Get the file ID

        // Prepare the SQL DELETE statement
        $sql = "DELETE FROM repo_file WHERE file_id = ?";
        
        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind the parameter
            $stmt->bind_param('i', $file_id);

            // Execute the statement
            if ($stmt->execute()) {
                $message = "File deleted successfully.";
            } else {
                $message = "Error deleting file: " . htmlspecialchars($stmt->error);
            }
            // Close the statement
            $stmt->close();
        } else {
            $message = "Error preparing statement: " . htmlspecialchars($conn->error);
        }
    } else {
        $message = "Invalid file ID.";
    }

    // Close the connection
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
            alert('" . htmlspecialchars($message, ENT_QUOTES) . "');
            window.location.href = '../frontend/repository_file.php'; // Redirect after alert
        </script>
    </body>
    </html>";
    exit();
} else {
    // Redirect if the request method is not POST
    header("Location: ../frontend/repository.php");
    exit();
}
?>
