<?php session_start()?>
<?php require_once('inc/conn.php');?>
<?php require_once('inc/function.php');?>
<?php
	if(isset($_POST['submit'])){
		//check if the user name and password has  been entered
				$errors =array();
				if(!isset($_POST['username']) || strlen(trim($_POST['username'])) < 1){
					$errors[]='User name is incorrect';
		
				}
				if(!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1){
					$errors[]='Password  is incorrect ';
				}
				if(empty($errors)){
					
					//save user name and password into variables
					$username =mysqli_real_escape_string($conn,$_POST['username']);
					$hashedpassword =mysqli_real_escape_string($conn,$_POST['password']);
					$password = md5($hashedpassword);
					//prepare database query
					$rst=mysqli_query($conn,"select * from admin_user where email_address='$username' && password='$password' LIMIT 1");
					if($rst){
						
						//query successfuly
						if(mysqli_num_rows($rst) == 1){
							$row=mysqli_fetch_assoc($rst);
										
											//set up cookie
											setcookie("useradmin", $row['email_address'], time() + (86400 * 30));
											setcookie("passadmin", $row['password'], time() + (86400 * 30));
										
										
							$_SESSION["loginUseradmin"] = $row['email_address'];
							$_SESSION['idadmin']=$row['id'];
							header('location:index.php?msg=successfuly');
	
						}
	
					}else{
						$errors[]="Invalied Username and Password !";
					}
				}
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
	<script type="text/javascript" src="assets/js/plugins/forms/validation/validate.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>

	<script type="text/javascript" src="assets/js/core/app.js"></script>
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

					<!-- Simple login form -->
					<form action="login.php" method="post" class="form-validate">
						
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
								<h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
							</div>
							<div>
							<?php
								if(isset($errors) && !empty($errors)){
								echo '<p class="text-danger">Invalued user name and password</p>';
								}
							?>
						</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="text" class="form-control" name="username" placeholder="Username" required="required">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" class="form-control" placeholder="Password" name="password" required="required">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" name="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button>
							</div>

			
						</div>
					</form>
					<!-- /simple login form -->


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
