<?php 
	session_start();
	if (!isset($_SESSION['user_array'])) {
		header('location:login.php');
	}
	else{
		if ($_SESSION['user_array']['role'] != 'user') {
			header('location:admin_dashboard.php');
		}
	}
	require_once('db.php');
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>User Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<style type="text/css">
		body{
			padding: 50px;
		}
	</style>
</head>
<?php 
	//Read Autheticate User Data
	$auth_user_id=$_SESSION['user_array']['id'];
	$auth_select="SELECT * FROM users WHERE id=$auth_user_id";
	$auth_result=mysqli_query($con,$auth_select);
	if ($auth_result) {
		$auth_user_array=mysqli_fetch_assoc($auth_result);
	}else{
		die("Error");
	}
	//Edit
	$user_edit_id = false;
	if (isset($_GET['user_edit_id'])) {
		$user_edit_id = true;
		$user_edit_id=$_GET['user_edit_id'];
		$select="SELECT * FROM users WHERE id=$user_edit_id";
		$result=mysqli_query($con,$select);
		if ($result) {
			$user=mysqli_fetch_assoc($result);
		}
		else{
			die("Error!");
		}
	}
	//Update

 ?>
<body>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header bg-info">
						<div class="row">
							<div class="col-md-6">
								<div class="card-title"><h4><font color="white">User Dashboard</font></h4></div>
							</div>
							<div class="col-md-6">
								<form action="logout.php" method="get">
									<button type="submit" class="btn btn-danger float-right" onclick="return confirm('Are you sure to logout?')">Logout</button>
								</form>
								
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-8 mt-3">
							
								<table class="table table-bordered table-hover">
									<thead class="thead-dark">
										<tr>
											<th>ID</th>
											<th>Name</th>
											<th>Email</th>
											<th>Address</th>
											<th>Role</th>

										</tr>
									</thead>
									<tbody>
										<?php 
											$select="SELECT * FROM users";
											$result=mysqli_query($con,$select);
											foreach ($result as $user) {?>
											<tr>
												<td><?php echo $user['id']; ?></td>
												<td><?php echo $user['name']; ?></td>
												<td><?php echo $user['email']; ?></td>
												<td><?php echo $user['address']; ?></td>
												<td><?php echo $user['role']; ?></td>
												
											</tr>
										<?php	
											}
										 ?>
										
									</tbody>
								</table>
						</div>
						<div class="col-md-4 mt-3">
							<div class="card">
								<div class="card-body">
									<h5>User Info</h5>
										<div>
											Role:<span class="badge badge-success badge-pill"><?php echo $auth_user_array['role']; ?>
												
											</span>
										</div>
										<div>Name:<?php echo $auth_user_array['name']; ?>
										</div>
										<div>Email:<?php echo $auth_user_array['email']; ?>
										</div>
										<div>Address:<?php echo $auth_user_array['address']; ?>
										</div>
										<div>Address:<?php echo $auth_user_array['password']; ?>
										</div>
								</div>	
							</div>
						
							
						</div>

					</div>
					
				</div>
			</div>
		</div>
	</div>


</body>
</html>