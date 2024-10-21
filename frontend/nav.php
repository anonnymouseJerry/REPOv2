<?php

$current_page = basename($_SERVER['PHP_SELF']); // Get the current page name

if (isset($_SESSION['id'])) { // Assuming the session variable is 'id'
    // Retrieve user data from the database
    $user_id = $_SESSION['id'];
    $query = "SELECT * FROM users WHERE id = '$user_id'"; // Use 'id' for the query
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user_data = $result->fetch_assoc();

        // Get the access type ID
        $accesstype_id = $user_data['accesstype_id'];

            if ($accesstype_id == 1) {
                echo '
                <nav id="sidebar" class="sidebar js-sidebar">
                    <div class="sidebar-content js-simplebar">
                        <a class="sidebar-brand" href="index.html">
                            <span class="align-middle">
                                <img src="../src/img/logo/eRepo_logo.png" class="img-fluid" style="max-width: 100px; height: auto;">
                            </span>
                        </a>
                        <ul class="sidebar-nav">
                            <li class="sidebar-header">Pages</li>
                            
                            <li class="sidebar-item ' . ($current_page == 'home.php' ? 'active' : '') . '">
                                <a class="sidebar-link" href="home.php">
                                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                                </a>
                            </li>
                            
                            <li class="sidebar-item ' . ($current_page == 'repository.php' ? 'active' : '') . '">
                                <a class="sidebar-link" href="repository.php">
                                    <i class="align-middle" data-feather="folder"></i> <span class="align-middle">Repositories</span>
                                </a>
                            </li>
                            
                            <li class="sidebar-item ' . ($current_page == 'user.php' ? 'active' : '') . '">
                                <a class="sidebar-link" href="user.php">
                                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Users</span>
                                </a>
                            </li>
                            
                            <li class="sidebar-item ' . ($current_page == 'archived.php' ? 'active' : '') . '">
                                <a class="sidebar-link" href="archived.php">
                                    <i class="align-middle" data-feather="file"></i> <span class="align-middle">Archived</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>';
            }
            else {
                echo '
                    <nav id="sidebar" class="sidebar js-sidebar">
                        <div class="sidebar-content js-simplebar">
                            <a class="sidebar-brand" href="index.html">
                                <span class="align-middle">
                                    <img src="../src/img/logo/eRepo_logo.png" class="img-fluid" style="max-width: 100px; height: auto;">
                                </span>
                            </a>
                            <ul class="sidebar-nav">
                                <li class="sidebar-header">Pages</li>
                                
                                <li class="sidebar-item ' . ($current_page == 'home.php' ? 'active' : '') . '">
                                    <a class="sidebar-link" href="home.php">
                                        <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                                    </a>
                                </li>
                                
                                <li class="sidebar-item ' . ($current_page == 'repository.php' ? 'active' : '') . '">
                                    <a class="sidebar-link" href="repository.php">
                                        <i class="align-middle" data-feather="folder"></i> <span class="align-middle">Repositories</span>
                                    </a>
                                </li>
                                
                                <li class="sidebar-item ' . ($current_page == 'archived.php' ? 'active' : '') . '">
                                    <a class="sidebar-link" href="archived.php">
                                        <i class="align-middle" data-feather="file"></i> <span class="align-middle">Archived</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>';
            }
        } else {
            // Logic for other access types
        }

        // If you need to get office details
        // $office_id = OfficeName($user_data['offices']);
    }
?>
