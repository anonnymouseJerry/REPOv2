<?php
session_start()
include 'db.php'; // Ensure your database connection is included

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
        echo "Invalid file type. Allowed types: " . implode(", ", $allowedTypes);
        exit();
    }

    // Move the uploaded file
    if (move_uploaded_file($fileTmpPath, $uploadFilePath)) {
        // Insert into database
        $stmt = $conn->prepare("INSERT INTO repo_file (original_file_name, saved_file_name, file_type, dateUploaded, user_id) VALUES (?, ?, ?, NOW(), ?)");
        $userId = $_SESSION['id']; // Assuming you're storing the user ID in session
        $stmt->bind_param("sssi", $originalFileName, $savedFileName, $fileType, $userId);
        
        if ($stmt->execute()) {
            echo "File uploaded and record added successfully.";
        } else {
            echo "Database insertion failed: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "File upload failed.";
    }
}

$conn->close();
?>
