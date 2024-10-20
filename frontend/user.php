<?php include'../backend/session.php'; 
include '../backend/db.php';
include "../backEnd/function.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="../static/img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

	<title>eRepository System</title>

	<link href="../static/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>

<?php include'modal/userModal.php';?>

	<div class="wrapper">
		
    <?php include'nav.php';?>

		<div class="main">

        <?php include'header-nav.php';?>

			<main class="content">
				<div class="container-fluid p-0">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<div class="row">
										<div class="col-6">
										<h1 class="h3 mt-2"><strong>Users</strong> |
										<?php

										if (isset($_SESSION['id'])) { // Assuming the session variable is 'id'
										// Retrieve user data from the database
										$user_id = $_SESSION['id'];
										$query = "SELECT * FROM users WHERE id = '$user_id'"; // Use 'id' for the query
										$result = $conn->query($query);
										
										if ($result->num_rows == 1) {
										$user_data = $result->fetch_assoc();
										
										// Get the access type ID
										$office_id = $user_data['office_id'];
										
										if ($office_id == 0) {
											echo "All Offices";
										} else{
											echo officeName($user_data['office_id']);
										}
										}
										}
										?> 
										</h1> 

										</div>
										<div class="col-6">

										<?php include'modal/addUserModal.php';?>

											<button type="button" class="btn btn-primary float-end"
											data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
									</div>
									</div>
								</div>
								<div class="card-body">
								<div class="table-responsive">
								<table id="usersTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Date Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
			// Fetch data
			$sql = "SELECT * FROM users";
			$result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<tr>
        <td>' . htmlspecialchars($row['id']) . '</td>
        <td>' . htmlspecialchars($row['full_name']) . '</td>
        <td>' . htmlspecialchars($row['email']) . '</td>
        <td>' . htmlspecialchars($row['dateCreated']) . '</td>
        <td>
            <i class="align-middle" type="button" data-bs-toggle="modal" 
               data-bs-target="#editModal" 
               onclick="setEditUserData(' . $row['id'] . ', \'' . addslashes($row['full_name']) . '\', \'' . addslashes($row['email']) . '\', ' . $row['office_id'] . ', ' . $row['accesstype_id'] . ')" 
               data-feather="edit"></i>
            <i class="align-middle" type="button" data-bs-toggle="modal" 
               data-bs-target="#deleteUserModal" 
               onclick="setDeleteUserId(' . htmlspecialchars($row['id']) . ')" 
               data-feather="delete"></i>
        </td>
      </tr>';

                }
            }
			?>
        </tbody>
    </table>
	</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>AdminKit</strong></a> - <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>Bootstrap Admin Template</strong></a>								&copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="../static/js/app.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable();
        });
    </script>


</body>

</html>

<?php include'swal/confirmation.php'; ?>