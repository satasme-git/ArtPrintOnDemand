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
if(isset($_POST['submit'])) {
    $errors = array();
        $userid=mysqli_real_escape_string($conn,$_SESSION['idadmin']);
        $edite_sql="SELECT * FROM admin_user WHERE id='{$userid}' LIMIT 1";
        $edite_query=mysqli_query($conn,$edite_sql);
                if($edite_query){
                    if(mysqli_num_rows($edite_query)==1){
                        //user found
                        $user=mysqli_fetch_assoc($edite_query);
                        $password=$user['password'];
                                    //Form validation parts
                                   $oldpss= mysqli_real_escape_string($conn, $_POST['oldpass']);
                                   $newpss= mysqli_real_escape_string($conn, $_POST['newpass']);
                                   $oldpassword = md5($oldpss);
                                            //checking password
                                                if($password==$oldpassword){
													//checking max length
															$max_length=array('newpass'=>150);
															$errors=array_merge($errors,check_max_length($max_length));
																	//Add to database
																	if(empty($errors)){
																		$newpassword = md5($newpss);
																		$addsql="UPDATE admin_user SET password='{$newpassword}' WHERE id='{$userid}' LIMIT 1";
																		$add_query=mysqli_query($conn,$addsql);
																		if($add_query){
																			//query successfuly
																			header('Location:index.php?msg=successfuly');
																		}else{
																			$errors[]='Failed to Change password';
																		}
																	}else{
																		$errors[]="Failed!";	
																	}

                                                }else{
                                                    $errors[]="Unmatched Password!";
                                                }
                                   


    
                    }else{
                        //user not found
                        header('Location:change_password.php?err=user_not_found');
                    }
                }else{
                    //query unsuccessful
                   header('Location:change_password.php?err=query_failed');
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

					<!-- Password recovery -->
					<form action="change_password.php" class="form-validate"  method="post">
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
								<h5 class="content-group"> Change Password <small class="display-block"></small></h5>
							</div>

							<div class="form-group has-feedback">
								<input type="password" id="password" name="oldpass" class="form-control" placeholder="Your Password" required="required">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
                                <?php
								if(!empty($errors)){
									display_error($errors);
								}
							    ?> 
            
							</div>
                            <div class="form-group">
                                <label for="username" class="text-info"> <i>Show Password:</i></label> &nbsp;
                                <input type="checkbox" name="showpassword" id="showpassword" style="width: 15px;height: 15px">
                            </div>
                            <div class="form-group has-feedback">
								<input type="text" class="form-control" name="newpass" placeholder="Your New Password" onkeyup="pwConfirmation()" id="inputPassword" required="required">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>
                            <div class="form-group has-feedback">
								<input type="text" class="form-control" placeholder="Confirm Password" id="inputConfirmPassword" onkeyup="pwConfirmation()"required="required" >
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<button type="submit"  disabled id="confirmBtn" name="submit" class="btn bg-blue btn-block">Reset password <i class="icon-arrow-right14 position-right"></i></button>
						</div>
					</form>
					<!-- /password recovery -->


					<!-- Footer -->
					<div class="footer text-muted">
						Copyright &copy; 2014. <a href="#">Limitless admin template</a> by <a href="http://interface.club">Eugene Kopyov</a>
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
    <script>
        $(document).ready(function () {
            $('#showpassword').click(function () {
                if($('#showpassword').is(':checked')){
                    $('#password').attr('type','text');
                }else{
                    $('#password').attr('type','password');
                }
            });
        });
</script>
<script>
    function pwConfirmation() {
        if(document.getElementById("inputPassword").value == document.getElementById("inputConfirmPassword").value){
            document.getElementById("confirmBtn").disabled = false;
        }else{
            document.getElementById("confirmBtn").disabled = true;
        }
    }
</script>

</body>
</html>
