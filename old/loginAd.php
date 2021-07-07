<?php
/**
 * Created by Thisara Randimal.
 */
session_start();
include('inc/conn.php');
if(isset($_POST['submit'])){
    //check if the user name and password has  been entered
			$errors =array();
            if(!isset($_POST['username']) || strlen(trim($_POST['username'])) < 1){
                header('location:admin_login.php?err=cannot_login');
                $_SESSION['message']='User name is incorrect';
    
            }
            if(!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1){
                header('location:admin_login.php?err=cannot_login');
                $_SESSION['message'].='Password  is incorrect ';
            }
            if(empty($errors)){
                //save user name and password into variables
                $username =mysqli_real_escape_string($conn,$_POST['username']);
                $password =mysqli_real_escape_string($conn,$_POST['password']);
                //prepare database query
                $query=mysqli_query($conn,"select * from admin_user where email_address='$username' && password='$password' LIMIT 1");
                if($query){
                    //query successfuly
                    if(mysqli_num_rows($query) == 1){
                                    if (isset($_POST['remember'])){
                                        //set up cookie
                                        setcookie("useradmin", $row['email_address'], time() + (86400 * 30));
                                        setcookie("passadmin", $row['password'], time() + (86400 * 30));
                                    }
                        $_SESSION["loginUseradmin"] = $row['email_address'];
                        $_SESSION['idadmin']=$row['id'];
                        header('location:admin_form.php?logged');

                    }

                }
            }
}
else{
    header('location:admin_login.php?err=cannot_login');
    $_SESSION['message']="Please Login!";
}