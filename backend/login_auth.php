<?php
session_start(); // Start the session

include 'db.php';

// Redirect to home if user is already logged in
if (isset($_SESSION['id'])) {
    header("Location: ../frontend/home.php");
    exit();
}

// Output SweetAlert library
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT id, password, full_name FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password, $full_name); // Bind ID, password, and full name
        $stmt->fetch();
    
        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, start a session
            $_SESSION['id'] = $user_id; // Store user ID in session
            // $_SESSION['full_name'] = $full_name; // Store full name in session
            // $_SESSION['email'] = $email;
            
            // Show success message with SweetAlert and redirect
            echo "<script>
                    window.onload = function() {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Login successful!',
                            timer: 1000,
                            icon: 'success',
                            timerProgressBar: true,
                        }).then(() => {
                            window.location.href = '../frontend/home.php';
                        });
                    };
                  </script>";
            exit();
        } else {
            echo "<script>
                    window.onload = function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Invalid password.',
                            icon: 'error'
                        }).then(() => {
                            window.location.href = '../index.php'; // Redirect to index.php
                        });
                    };
                  </script>";
        }
    } else {
        echo "<script>
                window.onload = function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'No user found with that email.',
                        icon: 'error'
                    }).then(() => {
                        window.location.href = '../index.php'; // Redirect to index.php
                    });
                };
              </script>";
    }

    $stmt->close();
}

$conn->close();
?>
