<?php session_start()?>
<?php require_once('inc/conn.php');?>
<?php require_once('inc/function.php');?>
<?php
//checking if a user is logged in
if(!isset($_SESSION['idadmin'])){
	header('location:login.php');
}
?>
<?php
if (isset($_POST['submit'])){
	
	$errors = array();
			$eMail=$_POST['email'];
			$password=$_POST['password'];

			//checking required fields
			$required_field=array('email','password');
			$errors=array_merge($errors,check_req_fields($required_field));

			//checking max length
			$max_length=array('email'=>150,'password'=>150);
			$errors=array_merge($errors,check_max_length($max_length));
			//checking email address
			if(!is_email($_POST['email'])){
				$errors[] = 'invalid email address';
			}
			//checking if email address already exists
			$email=mysqli_real_escape_string($conn,$_POST['email']);
			$sql="SELECT * FROM admin_user WHERE email_address='{$email}' LIMIT 1";
			$result_set=mysqli_query($conn,$sql);
			if($result_set){
				if(mysqli_num_rows($result_set)==1){
					$errors[]='email address already exists';
				}
			}
			 //Add to database
			 if(empty($errors)) {
				
				$eMail = mysqli_real_escape_string($conn, $_POST['email']);
				$hashedpassword = mysqli_real_escape_string($conn, $_POST['password']);
				$password = md5($hashedpassword);
		
				$result = mysqli_query($conn, "INSERT INTO admin_user (`email_address`, `password`) VALUES('{$eMail}','{$password}')");
		
				if ($result) {
					header('location:index.php?msg=successfuly');
				} else {
					$errors[]='Failed to add the new recode';
				}
			}
		

}else{

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>

	<script type="text/javascript" src="assets/js/core/app.js"></script>
	<script type="text/javascript" src="assets/js/pages/login.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/validation/validate.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="assets/js/pages/login_validation.js"></script>
	<!-- /theme JS files -->

</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.html"><img src="assets/images/logo_light.png" alt=""></a>

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="#">
						<i class="icon-display4"></i> <span class="visible-xs-inline-block position-right"> Go to website</span>
					</a>
				</li>

				<li>
					<a href="#">
						<i class="icon-user-tie"></i> <span class="visible-xs-inline-block position-right"> Contact admin</span>
					</a>
				</li>

				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-cog3"></i>
						<span class="visible-xs-inline-block position-right"> Options</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container login-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Advanced login -->
					<form action="login_registration.php" class="form-validate"  method="post" >
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div class="icon-object border-success text-success"><i class="icon-plus3"></i></div>
								<h5 class="content-group">Create account <small class="display-block">All fields are required</small></h5>
							</div>

							<div class="content-divider text-muted form-group"><span>User credentials</span></div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="text" class="form-control" name="email" placeholder="Email" required="required">
								<div class="form-control-feedback">
									<i class="icon-user-check text-muted"></i>
								</div>
							<?php
								if(!empty($errors)){
									display_error($errors);
								}
							?> 
		
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="text" class="form-control" placeholder="password" name="password" required="required">
								<div class="form-control-feedback">
									<i class="icon-user-lock text-muted"></i>
								</div>
							</div>

							
							<button type="submit" class="btn bg-teal btn-block btn-lg" name="submit">Register <i class="icon-circle-right2 position-right"></i></button>
						</div>
					</form>
					<!-- /advanced login -->


					<!-- Footer -->
					<div class="footer text-muted">
						&copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>
