<?php 
session_start();
require_once('db.php'); 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Beach blog</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<style type="text/css">
		body{
			padding: 50px;
		}
	</style>
</head>


<?php  
	$error="";
	if (isset($_POST['login_button'])) {
		$email=trim($_POST['email']);
		$password=md5(trim($_POST['password']));
		$select="SELECT * FROM users WHERE email='$email' AND password='$password'";
		$user_result=mysqli_query($con,$select);
		$user_count=mysqli_num_rows($user_result);
		if ($user_count === 1) {
    		$user_array = mysqli_fetch_assoc($user_result);
    		

    		$_SESSION['user_array']=$user_array;

    		if ($user_array['role'] == 'admin') {
    			header('location:admin_dashboard.php');
    		}
    		else{
    			header('location:user_dashboard.php');
    		}
    			
    			
    	}
    	else{
    		$error = "Invalid Email or Password!";
    	}
    
	}
?>
<body>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-md-6">
								<div class="card-title"><h5>Login Form</h5></div>
							</div>
							<div class="col-md-6">
								<a href="index.php" class="float-right btn btn-primary ml-2"> << Back</a>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-6">
								<div class="card">
							<form action="login.php" method="post">	
								<div class="card-body">
									<?php if ($error != ""): ?>
										<div class="alert alert-danger alert-dismissible fade show" role="alert">
										  <strong><?php echo $error; ?></strong>
										  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										    <span aria-hidden="true">&times;</span>
										  </button>
										</div>
									<?php endif ?>
									<div class="form-group">

										<label>Email</label>
										<input type="email" name="email" class="form-control">
									</div>
									
									<div class="form-group">
										<label>Password</label>
										<input type="password" name="password" class="form-control">
									</div>
								</div>
								<div class="card-footer">
									<button type="submit" name="login_button" class="btn btn-primary">Login</button><br>
									<span>If you don't have account,<a href="register.php">register here.</a></span>
								</div>
							</form>
							

						</div>
							</div>
							<div class="col-md-3"></div>
						</div>
						
					</div>
				</div>
				
			</div>
		</div>   	
    </div>
    

</body>
</html>