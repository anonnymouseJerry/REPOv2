<!-- ADMIN DASHBOARD -->

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

            if ($accesstype_id == 1) {

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
                        
                        				<div class="row">
                            <div class="col-xl-12 d-flex">
                                <div class="w-100">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col mt-0">
                        								<?php
                        								$query = "SELECT count(*) AS user_count FROM users";
                        								$result = $conn->query($query);
                        								$row = $result->fetch_assoc(); // Fetch the result as an associative array
                        								?>

                                                            <h5 class="card-title">Number of Users</h5>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="stat text-primary">
                                                                <i class="align-middle" data-feather="users"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h1 class="mt-1 mb-4" style="font-size:38px;"><?php echo $row['user_count']; ?></h1>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col mt-0">
                                                            <h5 class="card-title">Number of Repositories</h5>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="stat text-primary">
                                                                <i class="align-middle" data-feather="folder"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h1 class="mt-1 mb-4" style="font-size:38px;">14</h1>
                                                </div>
                                            </div>
                                        </div>
                        
                        
                        				<div class="col-sm-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col mt-0">
                                                            <h5 class="card-title">Notifications</h5>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="stat text-primary">
                                                                <i class="align-middle" data-feather="bell"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h1 class="mt-1 mb-4" style="font-size:38px;">14</h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                        
                        					<div class="row">
                        						<div class="col-12 col-lg-8 col-xxl-9 d-flex">
                        							<div class="card flex-fill">
                        								<div class="card-header">
                        
                        									<h5 class="card-title mb-0">Latest Upload</h5>
                        								</div>
                        								<table class="table table-hover my-0">
                        									<thead>
                        										<tr>
                        											<th>Repository Name</th>
                        											<th class="d-none d-xl-table-cell">Upload Date</th>
                        											<th>Status</th>
                        											<th class="d-none d-md-table-cell">Uploader Name</th>
                        											<th class="d-none d-md-table-cell">Days Idle</th>
                        										</tr>
                        									</thead>
                        									<tbody>
                        										<tr>
                        											<td>Project Apollo</td>
                        											<td class="d-none d-xl-table-cell">01/01/2023</td>
                        											<td class="d-none d-xl-table-cell">31/06/2023</td>
                        											<td class="d-none d-md-table-cell">Vanessa Tucker</td>
                        											<td><span class="badge bg-success">3 Day(s)</span></td>
                        										</tr>
                        
                        									</tbody>
                        								</table>
                        							</div>
                        						</div>
                        						<div class="col-12 col-lg-4 col-xxl-3 d-flex">
                                                <div class="card flex-fill w-100">
                        								<div class="card-header">
                        
                        									<h5 class="card-title mb-0">Department Uploads</h5>
                        								</div>
                        								<div class="card-body d-flex">
                        									<div class="align-self-center w-100">
                        										<div class="py-3">
                        											<div class="chart chart-xs">
                        												<canvas id="chartjs-dashboard-pie"></canvas>
                        											</div>
                        										</div>
                        
                        										<table class="table mb-0">
                        											<tbody>
                        												<tr>
                        													<td>CICT</td>
                        													<td class="text-end">20%</td>
                        												</tr>
                        												<tr>
                        													<td>COED</td>
                        													<td class="text-end">40%</td>
                        												</tr>
                        												<tr>
                        													<td>CMBT</td>
                        													<td class="text-end">40%</td>
                        												</tr>
                        											</tbody>
                        										</table>
                        									</div>
                        								</div>  
                        						</div>
                        					</div>


<!-- OTHER USER DASHBOARD -->


                    <?php } 
                    else{

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
                        
                        <div class="row">
            <div class="col-xl-12 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Number of Repositories</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="folder"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-4" style="font-size:38px;">14</h1>
                                </div>
                            </div>
                        </div>
        
        
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Notifications</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="bell"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-4" style="font-size:38px;">14</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
        
                            <div class="row">
                                <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                                    <div class="card flex-fill">
                                        <div class="card-header">
        
                                            <h5 class="card-title mb-0">Latest Upload</h5>
                                        </div>
                                        <table class="table table-hover my-0">
                                            <thead>
                                                <tr>
                                                    <th>Repository Name</th>
                                                    <th class="d-none d-xl-table-cell">Upload Date</th>
                                                    <th>Status</th>
                                                    <th class="d-none d-md-table-cell">Uploader Name</th>
                                                    <th class="d-none d-md-table-cell">Days Idle</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Project Apollo</td>
                                                    <td class="d-none d-xl-table-cell">01/01/2023</td>
                                                    <td class="d-none d-xl-table-cell">31/06/2023</td>
                                                    <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                                                    <td><span class="badge bg-success">3 Day(s)</span></td>
                                                </tr>
        
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 col-xxl-3 d-flex">
                                <div class="card flex-fill w-100">
                                        <div class="card-header">
        
                                            <h5 class="card-title mb-0">Department Uploads</h5>
                                        </div>
                                        <div class="card-body d-flex">
                                            <div class="align-self-center w-100">
                                                <div class="py-3">
                                                    <div class="chart chart-xs">
                                                        <canvas id="chartjs-dashboard-pie"></canvas>
                                                    </div>
                                                </div>
        
                                                <table class="table mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td>CICT</td>
                                                            <td class="text-end">20%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>COED</td>
                                                            <td class="text-end">40%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>CMBT</td>
                                                            <td class="text-end">40%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>  
                                </div>
                            </div>
                    <?php
                    }
                    }
                }?>