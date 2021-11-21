<?php 
session_start();
	if (!isset($_SESSION['user_array'])) {
		header('location:login.php');
	}
	else{
		if ($_SESSION['user_array']['role'] != 'admin') {
			header('location:user_dashboard.php');
		}
	}
	
require_once('db.php');

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
		//Select Edit
		$user_edition_form_status = false;
		if (isset($_GET['edit_id'])) {
			$user_edition_form_status = true;
			$edit_id=$_GET['edit_id'];
			$select="SELECT * FROM users WHERE id=$edit_id";
			$result=mysqli_query($con,$select);
			if ($result) {
				$user=mysqli_fetch_assoc($result);
			}
		}

		//User Update

		if (isset($_POST['update_button'])) {
			$user_id=$_POST['user_id'];
			$name=$_POST['name'];
			$email=$_POST['email'];
			$address=$_POST['address'];
			$role=$_POST['role'];
			//password fix start
			$select = "SELECT * FROM users WHERE id=$user_id";
			$pass_result=mysqli_query($con,$select);
			$pass_array=mysqli_fetch_assoc($pass_result);
			$old_password=$pass_array['password'];
			$input_password=$_POST['password'];

			$new_password = $old_password != $input_password ? md5($input_password) : $input_password;

			// if ($old_password == $input_password) {
			// 	$new_password = $input_password;
			// }
			// else{
			// 	$new_password = md5($input_password);
			// }

			// password fix end


			$update="UPDATE users SET name='$name',email='$email',address='$address',password='$new_password',role='$role' WHERE id=$user_id";
			$result=mysqli_query($con,$update);
			if ($result) {
				echo "<script>alert('Successfully Update!')</script>";
			}
			else{
				echo "<script>alert('Something Wrong!')</script>";
			}
		}
	


		//User Delete

		if (isset($_GET['delete_id'])) {
			$delete_id=$_GET['delete_id'];
			$delete="DELETE FROM users WHERE id=$delete_id";
			$result=mysqli_query($con,$delete);
			if ($result) {
				echo "<script>alert('Successfully Deleted!')</script>";
				header('location:admin_dashboard.php');
			}
			else{
				die("Error");
			}
		}
	 ?>
<body>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header bg-danger">
						<div class="row">
							<div class="col-md-6">
								<div class="card-title"><h4>Admin Dashboard</h4></div>
							</div>
							<div class="col-md-6">
								<form action="logout.php" method="get">
									<button type="submit" class="btn btn-primary float-right" onclick="return confirm('Are you sure to logout?')">Logout</button>
								</form>
								
							</div>
						</div>
					</div>
					<div class="card-body">
						
						<div class="row">
							<div class="col-md-4">
								<div class="card">
									<div class="card-body">
										<h5>Admin Info</h5>

										<div>Role:
											<span class="badge badge-success badge-pill"><?php echo $_SESSION['user_array']['role']; ?>
												
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
							<?php if($user_edition_form_status == true): ?>
								<div class="card mt-3">
									<div class="card-header">
										<div class="card-heading">User Edition Form</div>
									</div>
									<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> <!-- current file ko pyan nyuu -->
										<div class="card-body">
											<div class="form-group">
												<h3><span name="user_id" class="badge badge-danger" >ID : <?php echo $user['id']; ?></span></h3>
												<!-- <input type="text" name="user_id" class="form-control" value="<?php echo $user['id']; ?>"> -->
											</div>
											<div class="form-group">
												<label>Name</label>
												<input type="text" name="name" class="form-control" value="<?php echo $user['name']; ?>">
											</div>
											<div class="form-group">
												<label>Email</label>
												<input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>">
											</div>
											<div class="form-group">
												<label>Address</label>
												<textarea name="address" class="form-control"><?php echo $user['address']; ?></textarea>
											</div>
											<div class="form-group">
												<label>Password</label>
												<input type="text" name="password" class="form-control" value="<?php echo $user['password']; ?>">
											</div>
											<div class="form-group">
												<label>Role</label>
												<select name="role" class="form-control">
													<option value="">Select Role</option>
													<option value="admin"
													<?php if ($user['role'] == 'admin') { ?> selected <?php } ?>
													>
													Admin
													</option>
													<option value="user"
													<?php if($user['role']== 'user'): ?> selected <?php endif; ?>
													>User</option>
												</select>
											</div>
										</div>
										<div class="card-footer">
											<button name="update_button" class="btn btn-success">Update</button>
										</div>
									</form>
									
								</div>
							<?php endif; ?>
							</div>
							<div class="col-md-8">
							
								<table class="table table-bordered table-hover">
									<thead class="thead-dark">
										<tr>
											<th>ID</th>
											<th>Name</th>
											<th>Email</th>
											<th>Address</th>
											<th>Role</th>
											<th>Action</th>
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
												<td>
													<a href="admin_dashboard.php?edit_id=<?php echo $user['id']; ?>" class="btn btn-primary btn-sm">Edit</a> 

													<a href="admin_dashboard.php?delete_id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?')">Delete</a>
												</td>
											</tr>
										<?php	
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
    </div>



</body>
</html>