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

		<?php

if (isset($_SESSION['id'])) { // Assuming the session variable is 'id'
    // Retrieve user data from the database
    $user_id = $_SESSION['id'];
    $query = "SELECT * FROM users WHERE id = '$user_id'"; // Use 'id' for the query
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user_data = $result->fetch_assoc();

        // Get the access type ID
        $accesstype_id = $user_data['accesstype_id'];

            if ($accesstype_id == 1) { ?>

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
											<h1 class="h3 mt-2"><strong>Repository</strong> |
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

											<?php include'modal/repoModal.php';?>

												<button type="button" class="btn btn-primary float-end"
												data-bs-toggle="modal" data-bs-target="#addUserModal">Create Folder</button>
										</div>
										</div>
									</div>
									<div class="card-body">
									<div class="table-responsive">
									<table id="usersTable" class="display">
			<thead>
				<tr>
					<th>Title</th>
					<th>Date Created</th>
					<th>Uploader Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				// Fetch data
				$sql = "SELECT * FROM repo_folder";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					// Output data of each row
					while($row = $result->fetch_assoc()) {
						echo '<tr onclick="handleRowClick(' . htmlspecialchars($row['repo_id'], ENT_QUOTES) . ')" style="cursor: pointer;">
			<td> <i class="align-middle mr-2" data-feather="folder"></i> ' . htmlspecialchars($row['title']) . '</td>
			<td>' . htmlspecialchars($row['dateCreated']) . '</td>
			<td>' . htmlspecialchars(UploaderName($row['user_id'])) . '</td>
			<td>
				<i class="align-middle" type="button" data-bs-toggle="modal" 
				data-bs-target="#editModal" 
				onclick="event.stopPropagation(); setEditUserData(' . $row['repo_id'] . ', \'' . addslashes($row['title']) . '\')" 
				data-feather="edit"></i>
				<i class="align-middle" type="button" data-bs-toggle="modal" 
				data-bs-target="#deleteUserModal" 
				onclick="event.stopPropagation(); setDeleteFolderId(' . htmlspecialchars($row['repo_id'], ENT_QUOTES) . ')" 
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
				<?php
			}
			else{ ?>

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
												<h1 class="h3 mt-2"><strong>Repository</strong> |
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
	
												<?php include'modal/repoModal.php';?>
	
													<button type="button" class="btn btn-primary float-end"
													data-bs-toggle="modal" data-bs-target="#addUserModal">Create Folder</button>
											</div>
											</div>
										</div>
										<div class="card-body">
										<div class="table-responsive">
										<table id="usersTable" class="display">
				<thead>
					<tr>
						<th>Title</th>
						<th>Date Created</th>
						<th>Uploader Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					// Fetch data
					$sql = "SELECT * FROM repo_folder WHERE user_id = '$user_id'";
					$result = $conn->query($sql);
	
					if ($result->num_rows > 0) {
						// Output data of each row
						while($row = $result->fetch_assoc()) {
							echo '<tr onclick="handleRowClick(' . htmlspecialchars($row['repo_id'], ENT_QUOTES) . ')" style="cursor: pointer;">
				<td> <i class="align-middle mr-2" data-feather="folder"></i> ' . htmlspecialchars($row['title']) . '</td>
				<td>' . htmlspecialchars($row['dateCreated']) . '</td>
				<td>' . htmlspecialchars(UploaderName($row['user_id'])) . '</td>
				<td>
					<i class="align-middle" type="button" data-bs-toggle="modal" 
					data-bs-target="#editModal" 
					onclick="event.stopPropagation(); setEditUserData(' . $row['repo_id'] . ', \'' . addslashes($row['title']) . '\')" 
					data-feather="edit"></i>
					<i class="align-middle" type="button" data-bs-toggle="modal" 
					data-bs-target="#deleteUserModal" 
					onclick="event.stopPropagation(); setDeleteFolderId(' . htmlspecialchars($row['repo_id'], ENT_QUOTES) . ')" 
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
					<?php
				}
		}
	}
				?>

				<?php include'footer.php'; ?>
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

	<script>
			function handleRowClick(repoId) {
		// You can open a modal, redirect, or perform any action here
		console.log("Row clicked with repo ID:", repoId);
		// Example: Redirect to a details page
		window.location.href = 'repository_file.php?repo_id=' + repoId;
	}
		</script>


	</body>

	</html>

	<?php include'swal/confirmation.php'; ?>