<?php
include 'db.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user ID from the POST request
    $user_id = (int)$_POST['id'];

    // Prepare the SQL DELETE statement
    $sql = "DELETE FROM users WHERE id = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Bind the parameter
        $stmt->bind_param('i', $user_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Successful deletion
            $message = "User deleted successfully.";
            $alertType = "success";
        } else {
            // Error in execution
            $message = "Error deleting user: " . $stmt->error;
            $alertType = "error";
        }
        // Close the statement
        $stmt->close();
    } else {
        // Error in preparing the statement
        $message = "Error preparing statement: " . $conn->error;
        $alertType = "error";
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
            alert('$message');
            window.location.href = '../frontend/user.php'; // Redirect back to user.php after alert
        </script>
    </body>
    </html>";
} else {
    // Handle the case where the request method is not POST
    header("Location: ../frontend/user.php");
    exit();
}
?>
