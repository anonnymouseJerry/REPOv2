<?php
// db.php - Make sure to include your database connection here
include 'db.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify that 'repo_id' is set in the POST request
    if (isset($_POST['repo_id']) && is_numeric($_POST['repo_id'])) {
        $repo_id = (int)$_POST['repo_id']; // Get the folder ID

        // Prepare the SQL DELETE statement
        $sql = "DELETE FROM repo_folder WHERE repo_id = ?";
        
        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind the parameter
            $stmt->bind_param('i', $repo_id);

            // Execute the statement
            if ($stmt->execute()) {
                $message = "Folder deleted successfully.";
            } else {
                $message = "Error deleting folder: " . htmlspecialchars($stmt->error);
            }
            // Close the statement
            $stmt->close();
        } else {
            $message = "Error preparing statement: " . htmlspecialchars($conn->error);
        }
    } else {
        $message = "Invalid folder ID.";
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
            window.location.href = '../frontend/repository.php'; // Redirect after alert
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
