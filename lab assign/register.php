<?php
include_once("db_connect.php");
session_start();
if(isset($_SESSION['user_id'])) {
	header("Location: index.php");
}
$error = false;
if (isset($_POST['signup'])) {
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);	
	if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
		$error = true;
		$uname_error = "Name must contain only alphabets and space";
	}
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$email_error = "Please Enter Valid Email ID";
	}
	if(strlen($password) < 6) {
		$error = true;
		$password_error = "Password must be minimum of 6 characters";
	}
	if($password != $cpassword) {
		$error = true;
		$cpassword_error = "Password and Confirm Password doesn't match";
	}
	if (!$error) {
		if(mysqli_query($conn, "INSERT INTO users(user, email, pass) VALUES('" . $name . "', '" . $email . "', '" . md5($password) . "')")) {
			$success_message = "Successfully Registered! <a href='login.php'>Click here to Login</a>";
		} else {
			$error_message = "Error in registering...Please try again later!";
		}
	}
}
?>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<title>Login and Registration System with mySQL and PHP</title>
<script type="text/javascript" src="checkPass.js"></script>


<script>
						var state= false;
						function toggle(){
							if(state){
									document.getElementById(
									"pass1").
									setAttribute("type","password");
									document.getElementById("eye").style.color="#7a797e";
									state = false;
								
							}
							else {
								document.getElementById(
									"pass1").
									setAttribute("type","text");
									document.getElementById("eye").style.color="#5887ef";
									state = true;
							}
						}
						
						var state1=false;
						function toggle1(){
							
							if(state1){
									document.getElementById(
									"pass2").
									setAttribute("type","password");
									document.getElementById("eye1").style.color="#7a797e";
									state1 = false;
								
							}
							else {
								document.getElementById(
									"pass2").
									setAttribute("type","text");
									document.getElementById("eye1").style.color="#5887ef";
									state1 = true;
							}
						}
						
					</script>
					
<div class="container">
<h2>Example: Login and Registration Script with PHP, MySQL</h2>	
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
				<fieldset>
					<legend>Sign Up</legend>
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" placeholder="Enter Full Name" required value="<?php if($error) echo $name; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($uname_error)) echo $uname_error; ?></span>
					</div>					
					<div class="form-group">
						<label for="name">Email</label>
						<input type="text" name="email" placeholder="Email" required value="<?php if($error) echo $email; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
					</div>
					<div class="form-group">
						<label for="name">Password</label>
						<input type="password"  id="pass1" name="password" placeholder="Password" required class="form-control" />
						<span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
						<!--question a-->
						<span class="eyeBtn">
							<i class="fa fa-eye"
							aria-hidden="true" id="eye"
							onclick="toggle()"></i>
						</span>
						<div id="passCheck"></div>
					</div>
					<div class="form-group">
						<label for="name">Confirm Password</label>
						<input type="password" id="pass2" name="cpassword" placeholder="Confirm Password" required class="form-control" />
						<span class="eyeBtn1">
							<i class="fa fa-eye"
							aria-hidden="true" id="eye1"
							onclick="toggle1()"></i>
						</span>
						<span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
					</div>
					<div class="form-group">
						<input type="submit" name="signup" value="Sign Up" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
			<span class="text-success"><?php if (isset($success_message)) { echo $success_message; } ?></span>
			<span class="text-danger"><?php if (isset($error_message)) { echo $error_message; } ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		Already Registered? <a href="login.php">Login Here</a>
		</div>
	</div>	
</div>