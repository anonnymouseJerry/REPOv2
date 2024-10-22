<?php
include 'db.php'; // Include your database connection

if (isset($_GET['file_id'])) {
    $file_id = (int)$_GET['file_id'];

    // Fetch file details
    $query = "SELECT * FROM repo_file WHERE file_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $file_id);
    $stmt->execute();
    $result = $stmt->get_result();

    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>File View</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container mt-5">
            <div class="d-flex justify-content-center">';

    if ($result && $result->num_rows > 0) {
        $file_data = $result->fetch_assoc();
        $savedFileName = $file_data['saved_file_name'];
        $fileType = $file_data['file_type'];
        $uploadDir = 'uploads/'; // Directory where files are stored

        // Check file type and display accordingly
        $filePath = $uploadDir . $savedFileName;
        if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            echo '<img src="' . htmlspecialchars($filePath) . '" alt="Image" class="img-fluid" style="max-width: 100%; height: auto;">';
        } elseif (in_array($fileType, ['pdf'])) {
            echo '<iframe src="' . htmlspecialchars($filePath) . '" class="img-fluid" width="100%" height="500"></iframe>';
        }elseif (in_array($fileType, ['doc', 'docx'])) {
            echo '<iframe src="https://www.scribd.com/embeds/' . urlencode($filePath) . '/content" width="100%" height="500" class="img-fluid"></iframe>';
        }
         elseif (in_array($fileType, ['mp4', 'mov', 'avi'])) {
            echo '<video controls class="w-100">
                    <source src="' . htmlspecialchars($filePath) . '" type="video/' . htmlspecialchars($fileType) . '">
                    Your browser does not support the video tag.
                  </video>';
        } elseif (in_array($fileType, ['zip'])) {
            echo '<a href="' . htmlspecialchars($filePath) . '" class="btn btn-primary" download>Download ZIP</a>';
        } elseif (in_array($fileType, ['txt'])) {
            echo '<pre>' . htmlspecialchars(file_get_contents($filePath)) . '</pre>';
        } else {
            // Removed the text output for unsupported types
        }
    } else {
        // Removed the text output for no file found
    }

    echo '        </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>';

    $stmt->close();
    $conn->close();
} else {
    // Removed the text output for invalid file ID
}
?>
