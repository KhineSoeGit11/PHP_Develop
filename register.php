<?php 

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
	$nameError = "";
	$emailError = "";
	$addressError = "";
	$passwordError = "";
	$CpassError = "";

	if (isset($_POST['register_button'])) {
		$name=$_POST['name'];
		$email=$_POST['email'];
		$address=$_POST['address'];
		$password=$_POST['password'];
		$confirm_password=$_POST['confirm_password'];

		if (empty($name)) {
			$nameError="Name Required!";
		}
		if (empty($email)) {
			$emailError ="Email Required!";
		}
		if (empty($address)) {
			$addressError ="Address Required!";
		}
		if (empty($password)) {
			$addressError ="Password Required!";
		}
		if (empty($confirm_password)) {
			$passwordError ="Confirm password Required!";
		}
		if ($password != $confirm_password) {
			$CpassError ="Passwords are not match";
		}

		if (!empty($name) && !empty($email) && !empty($address) && !empty($password) && !empty($confirm_password) && $password == $confirm_password) {
			
			$encrypt_password=md5($password);
			$insert="INSERT INTO users(name, email, address, password) VALUES ('$name','$email','$address','$encrypt_password')";
			$result=mysqli_query($con,$insert);
			if ($result == 1) {
				echo "<script>alert('Successfully Registered!')</script>";
			}
			else{
				echo "<script>alert('Suomething Wrong!')</script>";
			}
		}
	}

 ?>
<link rel="stylesheet" type="text/css" href="beach_blog.css">

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
								<div class="card-title"><h5>Registration Form</h5></div>
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
								<form action="register.php" method="post">
									<div class="card-body">
										<div class="form-group">
											<label>Name</label>
											<input type="text" name="name" class="form-control <?php if($nameError != ""): ?> is-invalid <?php endif ?>">
											<i class="text-danger"><?php echo $nameError ?></i>
										</div>
										<div class="form-group">
											<label>Email</label>
											<input type="email" name="email" class="form-control <?php if($emailError != ""): ?> is-invalid <?php endif ?>" >
											<i class="text-danger"><?php echo $emailError ?></i>
										</div>
										<div class="form-group">
											<label>Address</label>
											<textarea name="address" class="form-control <?php if($addressError != ""): ?> is-invalid <?php endif ?>" rows="3"></textarea>
											<i class="text-danger"><?php echo $addressError ?></i>
										</div>
										<div class="form-group">
											<label>Password</label>
											<input type="password" name="password" class="form-control <?php if($passwordError != ""): ?> is-invalid <?php endif ?>" >
											<i class="text-danger"><?php echo $passwordError ?></i>
										</div>
										<div class="form-group">
											<label>Confirm Password</label>
											<input type="password" name="confirm_password" class="form-control <?php if($CpassError != ""): ?> is-invalid <?php endif ?>" >
											<i class="text-danger"><?php echo $CpassError ?></i>
										</div>
									</div>
									<div class="card-footer">
										<button type="submit" name="register_button" class="btn btn-primary">Register</button><br>
										<span>If you have account,<a href="login.php">Login here.</a></span>
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