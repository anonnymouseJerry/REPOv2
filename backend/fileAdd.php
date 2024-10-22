<?php
session_start();
include 'db.php'; // Start the session

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if repo_id is in the session
if (!isset($_SESSION['repo_id'])) {
    die("Repository ID is not defined.");
}

// Initialize message variable
$message = "";

// Ensure file upload is handled
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $originalFileName = $_POST['file_name']; // The name given by the user
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $savedFileName = basename($_FILES['file']['name']); // The file name to save on the server
    $fileType = pathinfo($savedFileName, PATHINFO_EXTENSION); // Get file type

    // Specify the directory to save the uploaded file
    $uploadDir = 'uploads/'; // Make sure this directory exists and is writable
    $uploadFilePath = $uploadDir . $savedFileName;

    // Validate file type (you can expand this list)
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'mp4', 'mov', 'avi', 'zip', 'txt'];
    
    if (!in_array($fileType, $allowedTypes)) {
        $message = "Invalid file type. Allowed types: " . implode(", ", $allowedTypes);
    } else {
        // Move the uploaded file
        if (move_uploaded_file($fileTmpPath, $uploadFilePath)) {
            // Insert into database
            $stmt = $conn->prepare("INSERT INTO repo_file (original_file_name, saved_file_name, file_type, dateUploaded, user_id, repo_id) VALUES (?, ?, ?, NOW(), ?, ?)");
            $userId = $_SESSION['id']; // Assuming you're storing the user ID in session
            $repoId = $_SESSION['repo_id']; // Get repo_id from session
            $stmt->bind_param("sssis", $originalFileName, $savedFileName, $fileType, $userId, $repoId);
            
            if ($stmt->execute()) {
                $message = "File uploaded and record added successfully.";
            } else {
                $message = "Database insertion failed: " . htmlspecialchars($stmt->error);
            }
            $stmt->close();
        } else {
            $message = "File upload failed.";
        }
    }
}

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
?>
