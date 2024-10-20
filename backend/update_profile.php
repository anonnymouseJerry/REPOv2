<?php
session_start();
include 'db.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if it's an image upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
        // Handle profile picture upload
        $uploadFileDir = 'uploads/';
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0755, true);
        }

        $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
        $fileName = uniqid() . '_' . basename($_FILES['profile_picture']['name']);
        $fileSize = $_FILES['profile_picture']['size'];
        $fileType = $_FILES['profile_picture']['type'];
        
        $dest_path = $uploadFileDir . $fileName;

        // Check file type and size
        $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($fileType, $allowedFileTypes) || $fileSize > 5000000) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid file type or size too large.']);
            exit();
        }

        // Move the file to the upload directory
        if (!move_uploaded_file($fileTmpPath, $dest_path)) {
            echo json_encode(['status' => 'error', 'message' => 'Error moving the uploaded file.']);
            exit();
        }

        // Store the file path in the database
        $stmt = $conn->prepare("UPDATE users SET profile_picture = ? WHERE id = ?");
        $stmt->bind_param("si", $dest_path, $_SESSION['id']);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Profile picture updated successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unable to update profile picture.']);
        }
        $stmt->close();
        exit(); // Exit after handling image upload
    }

    // Handle user details update
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $error_message = "";

    if (empty($name) || empty($email)) {
        $error_message = "Please fill in all fields.";
    } elseif ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
    }

    if (!empty($error_message)) {
        echo json_encode(['status' => 'error', 'message' => $error_message]);
        exit();
    }

    // Update user details
    $stmt = $conn->prepare("UPDATE users SET full_name = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $name, $email, $_SESSION['id']);

    if ($stmt->execute()) {
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->bind_param("si", $hashed_password, $_SESSION['id']);
            $stmt->execute();
        }
        echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Unable to update profile.']);
    }

    $stmt->close();
}
$conn->close();
?>
