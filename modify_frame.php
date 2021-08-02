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
    $rst =mysqli_query($conn,"SELECT id,name FROM fcategory");
    
while ($row =mysqli_fetch_assoc($rst)) {
    $new_array[$row['id']]['id'] = $row['id'];
    $new_array[$row['id']]['name'] = $row['name'];
}

?>
<?php
    $image="";
	$name = "";
    $price = "";
    $cat = "";
    $code ="";
    $ft = "";
    $size ="";
   
//getting the user infromation
if(isset($_GET['frameid'])){
    $frameid=mysqli_real_escape_string($conn,$_GET['frameid']);
    $edite_sql="SELECT * FROM frame WHERE id='{$frameid}' LIMIT 1";
    $edite_query=mysqli_query($conn,$edite_sql);
            if($edite_query){
                if(mysqli_num_rows($edite_query)==1){
                    //user found
                    $frame=mysqli_fetch_assoc($edite_query);
                    $name =$frame['name'];
                    $price = $frame['price'];
                    $cat =  $frame['cat'];
                    $code =  $frame['code'];
                    $ft =  $frame['ft'];
                    $size = $frame['frame_size'];
					$pic=$frame['pic'];
					$thumb=$frame['thumb'];


                }else{
                    //user not found
                    header('Location:modify_frame.php?err=user_not_found');
                }
            }else{
                //query unsuccessful
               header('Location:modify_frame.php?err=query_failed');
            }
}

	if(isset($_POST['submit'])){
		$errors = array();
		$path='uploads/category/';
		
					//checking max length
			$max_length=array('name'=>150,'price'=>15,'cat'=>10,'code'=>100,'ft'=>70,'size'=>11);
			$errors=array_merge($errors,check_max_length($max_length));

			//Add to database
			if(empty($errors)) {
                $id = mysqli_real_escape_string($conn, $_POST['frame_id']);
				$name = mysqli_real_escape_string($conn, $_POST['name']);
				$price = mysqli_real_escape_string($conn, $_POST['price']);
				$cat = mysqli_real_escape_string($conn, $_POST['cat']);
				$code = mysqli_real_escape_string($conn, $_POST['code']);
				$ft = mysqli_real_escape_string($conn, $_POST['ft']);
				$size = mysqli_real_escape_string($conn, $_POST['size']);
				$template=$_FILES['template']['name'];
				$img=$_FILES['img']['name'];
				$uptime=date('Y-m-d H:i:s');
				if(empty($template) && empty($img)){
                $addsql="UPDATE frame SET name='{$name}',price='{$price}',code='{$code}',ft='{$ft}',cat='{$cat}',update_date='{$uptime}',frame_size='{$size}' WHERE id='{$id}' LIMIT 1";
				}elseif(empty($template)){
					$addsql="UPDATE frame SET name='{$name}',price='{$price}',code='{$code}',ft='{$ft}',cat='{$cat}',thumb='{$img}',update_date='{$uptime}',frame_size='{$size}' WHERE id='{$id}' LIMIT 1";
				}else{
					$addsql="UPDATE frame SET name='{$name}',price='{$price}',code='{$code}',ft='{$ft}',cat='{$cat}',pic='{$template}',update_date='{$uptime}',frame_size='{$size}' WHERE id='{$id}' LIMIT 1";
				}
				$result_update = mysqli_query($conn,$addsql);
				if($result_update){
					move_uploaded_file($_FILES['img']['tmp_name'],$path.$img);
					move_uploaded_file($_FILES['template']['tmp_name'],$path.$template);
					header('location:view_frame.php?update=successfuly');
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
	<script type="text/javascript" src="assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/inputs/touchspin.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/styling/switch.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>

	<script type="text/javascript" src="assets/js/core/app.js"></script>
	<script type="text/javascript" src="assets/js/pages/form_validation.js"></script>
	<!-- /theme JS files -->

</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-default header-highlight">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.html"><img src="assets/images/logo_light.png" alt=""></a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-git-compare"></i>
						<span class="visible-xs-inline-block position-right">Git updates</span>
						<span class="badge bg-warning-400">9</span>
					</a>
					
					<div class="dropdown-menu dropdown-content">
						<div class="dropdown-content-heading">
							Git updates
							<ul class="icons-list">
								<li><a href="#"><i class="icon-sync"></i></a></li>
							</ul>
						</div>

						<ul class="media-list dropdown-content-body width-350">
							<li class="media">
								<div class="media-left">
									<a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
								</div>

								<div class="media-body">
									Drop the IE <a href="#">specific hacks</a> for temporal inputs
									<div class="media-annotation">4 minutes ago</div>
								</div>
							</li>

							<li class="media">
								<div class="media-left">
									<a href="#" class="btn border-warning text-warning btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-commit"></i></a>
								</div>
								
								<div class="media-body">
									Add full font overrides for popovers and tooltips
									<div class="media-annotation">36 minutes ago</div>
								</div>
							</li>

							<li class="media">
								<div class="media-left">
									<a href="#" class="btn border-info text-info btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-branch"></i></a>
								</div>
								
								<div class="media-body">
									<a href="#">Chris Arney</a> created a new <span class="text-semibold">Design</span> branch
									<div class="media-annotation">2 hours ago</div>
								</div>
							</li>

							<li class="media">
								<div class="media-left">
									<a href="#" class="btn border-success text-success btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-merge"></i></a>
								</div>
								
								<div class="media-body">
									<a href="#">Eugene Kopyov</a> merged <span class="text-semibold">Master</span> and <span class="text-semibold">Dev</span> branches
									<div class="media-annotation">Dec 18, 18:36</div>
								</div>
							</li>

							<li class="media">
								<div class="media-left">
									<a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
								</div>
								
								<div class="media-body">
									Have Carousel ignore keyboard events
									<div class="media-annotation">Dec 12, 05:46</div>
								</div>
							</li>
						</ul>

						<div class="dropdown-content-footer">
							<a href="#" data-popup="tooltip" title="All activity"><i class="icon-menu display-block"></i></a>
						</div>
					</div>
				</li>
			</ul>

			<p class="navbar-text"><span class="label bg-success">Online</span></p>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown language-switch">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="assets/images/flags/gb.png" class="position-left" alt="">
						English
						<span class="caret"></span>
					</a>

					<ul class="dropdown-menu">
						<li><a class="deutsch"><img src="assets/images/flags/de.png" alt=""> Deutsch</a></li>
						<li><a class="ukrainian"><img src="assets/images/flags/ua.png" alt=""> Українська</a></li>
						<li><a class="english"><img src="assets/images/flags/gb.png" alt=""> English</a></li>
						<li><a class="espana"><img src="assets/images/flags/es.png" alt=""> España</a></li>
						<li><a class="russian"><img src="assets/images/flags/ru.png" alt=""> Русский</a></li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-bubbles4"></i>
						<span class="visible-xs-inline-block position-right">Messages</span>
						<span class="badge bg-warning-400">2</span>
					</a>
					
					<div class="dropdown-menu dropdown-content width-350">
						<div class="dropdown-content-heading">
							Messages
							<ul class="icons-list">
								<li><a href="#"><i class="icon-compose"></i></a></li>
							</ul>
						</div>

						<ul class="media-list dropdown-content-body">
							<li class="media">
								<div class="media-left">
									<img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
									<span class="badge bg-danger-400 media-badge">5</span>
								</div>

								<div class="media-body">
									<a href="#" class="media-heading">
										<span class="text-semibold">James Alexander</span>
										<span class="media-annotation pull-right">04:58</span>
									</a>

									<span class="text-muted">who knows, maybe that would be the best thing for me...</span>
								</div>
							</li>

							<li class="media">
								<div class="media-left">
									<img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
									<span class="badge bg-danger-400 media-badge">4</span>
								</div>

								<div class="media-body">
									<a href="#" class="media-heading">
										<span class="text-semibold">Margo Baker</span>
										<span class="media-annotation pull-right">12:16</span>
									</a>

									<span class="text-muted">That was something he was unable to do because...</span>
								</div>
							</li>

							<li class="media">
								<div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
								<div class="media-body">
									<a href="#" class="media-heading">
										<span class="text-semibold">Jeremy Victorino</span>
										<span class="media-annotation pull-right">22:48</span>
									</a>

									<span class="text-muted">But that would be extremely strained and suspicious...</span>
								</div>
							</li>

							<li class="media">
								<div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
								<div class="media-body">
									<a href="#" class="media-heading">
										<span class="text-semibold">Beatrix Diaz</span>
										<span class="media-annotation pull-right">Tue</span>
									</a>

									<span class="text-muted">What a strenuous career it is that I've chosen...</span>
								</div>
							</li>

							<li class="media">
								<div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
								<div class="media-body">
									<a href="#" class="media-heading">
										<span class="text-semibold">Richard Vango</span>
										<span class="media-annotation pull-right">Mon</span>
									</a>
									
									<span class="text-muted">Other travelling salesmen live a life of luxury...</span>
								</div>
							</li>
						</ul>

						<div class="dropdown-content-footer">
							<a href="#" data-popup="tooltip" title="All messages"><i class="icon-menu display-block"></i></a>
						</div>
					</div>
				</li>

				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="assets/images/placeholder.jpg" alt="">
						<span><?php echo $_SESSION["loginUseradmin"]?></span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
						<li><a href="#"><i class="icon-coins"></i> My balance</a></li>
						<li><a href="#"><span class="badge bg-teal-400 pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li>
						<li class="divider"></li>
						<li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
						<li><a href="logout.php"><i class="icon-switch2"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<a href="#" class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></a>
								<div class="media-body">
									<span class="media-heading text-semibold">Victoria Baker</span>
									<div class="text-size-mini text-muted">
										<i class="icon-pin text-size-small"></i> &nbsp;Santa Ana, CA
									</div>
								</div>

								<div class="media-right media-middle">
									<ul class="icons-list">
										<li>
											<a href="#"><i class="icon-cog3"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- /user menu -->
					<!-- Main navigation -->
					<?php include('inc/navigation.php');?>
					<!-- /main navigation -->

					

				</div>
			</div>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

				


				<!-- Content area -->
				<div class="content">

					<!-- Form validation -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title"><legend class="text-bold">Update Freame</legend>
</h5>
							<div class="heading-elements">
								<ul class="icons-list">
			                		
			                		<li><a data-action="reload"></a></li>
			                		
			                	</ul>
		                	</div>
						</div>

						<div class="panel-body">
							
							<form class="form-horizontal form-validate-jquery" action="modify_frame.php" method="POST" enctype="multipart/form-data">
								<fieldset class="content-group">
									
                                <input type="hidden" name="frame_id" value="<?php echo $frameid?>">
									<!-- Basic text input -->
									<div class="form-group">
										<label class="control-label col-lg-3"><b>Frame Name</b></label>
										<div class="col-lg-9">
											<input type="text" name="name" class="form-control" required="required" <?php echo 'value="'.$name.'"'; ?>>
										</div>
									</div>
									<!-- /basic text input -->

									<!-- Numbers only -->
									<div class="form-group">
										<label class="control-label col-lg-3"><b>Price($)</b></label>
										<div class="col-lg-9">
											<input type="text" name="price" class="form-control" required="required" <?php echo 'value="'.$price.'"'; ?>>
										</div>
									</div>
									<!-- /numbers only -->
									<!-- Basic select -->
									<div class="form-group">
										<label class="control-label col-lg-3"><b>Category</b></label>
										<div class="col-lg-9">
											<select name="cat" class="form-control" required="required">
                                            <?php
                                           foreach($new_array as $array)
                                           {       
                                            if ($array['id'] == $cat) {
                                              echo '<option selected="selected" value="'.$array['id'].'">'.'<b>'.$array['name'].'</b>'.'</option>';
                                           }else{
                                            echo '<option value="'.$array['id'].'">'.'<b>'.$array['name'].'</b>'.'</option>'; 
                                           }
                                        }
                                        ?>
											</select>
										</div>
									</div>
									<!-- /basic select -->
									<!-- Styled file uploader -->
									<div class="form-group">
										<label class="control-label col-lg-3"><b>Template</b></label>
										<div class="col-lg-9">
											<input type="file" name="template" class="file-styled"  <?php echo 'value="'.$frame['pic'].'"'; ?>  accept=".jpg, .jpeg, .png" multiple>
											<b class="text-primary"><?php echo $frame['pic']; ?></b>
										</div>
									</div>
									<!-- Basic text input -->
									<div class="form-group">
										<label class="control-label col-lg-3"><b>Item Code</b></label>
										<div class="col-lg-9">
											<input type="text" name="code" class="form-control" required="required" <?php echo 'value="'.$code.'"'; ?>>
										</div>
									</div>
									<!-- /basic text input -->
										<!-- Digits only -->
										<div class="form-group">
										<label class="control-label col-lg-3"><b>Ft</b></span></label>
										<div class="col-lg-9">
											<input type="text" name="ft" class="form-control" required="required" <?php echo 'value="'.$ft.'"'; ?>>
										</div>
									</div>
									<!-- /digits only -->	
									<!-- Styled file uploader -->
									<div class="form-group">
										<label class="control-label col-lg-3"><b>Thumbnail</b></label>
										<div class="col-lg-9">
											<input type="file" name="img" class="file-styled"  accept=".jpg, .jpeg, .png" multiple>
											<b class="text-primary"><?php echo $frame['thumb']; ?></b>
										</div>
									</div>
									<!-- Basic text input -->	
									<!-- Digits only -->
									<div class="form-group">
										<label class="control-label col-lg-3"><b>Frame Size</b></span></label>
										<div class="col-lg-9">
											<input type="text" name="size" class="form-control" required="required" <?php echo 'value="'.$size.'"'; ?>>
										</div>
									</div>
									<!-- /digits only -->	
											
									</fieldset>

							

								<div class="text-right">
									
									<button type="submit" name="submit" class="btn btn-primary">Update <i class="icon-arrow-right14 position-right"></i></button>
								</div>
							</form>

                            <?php
                                    
                                $image.="<div><p><b>Template </b>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<b>Thumbnail</b></p><img src='uploads/category/{$frame['pic']}' 1- style='width:20%; height:20%;'>&nbsp &nbsp &nbsp &nbsp";
								$image.="<img src='uploads/category/{$frame['thumb']}' 1- style='width:20%; height:20%;'>&nbsp</div>";
                                echo $image;
                
                
                            
                            ?>
							
							
						</div>
					</div>
					<!-- /form validation -->


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
