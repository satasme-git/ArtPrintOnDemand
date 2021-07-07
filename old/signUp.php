<?php
/**
 * Created by IntelliJ IDEA.
 * User: sandunDilhan
 * Date: 12/9/2019
 * Time: 11:03 AM
 */
//Developed by Thisara
include('conn.php');
require_once('inc/function.php');
if (isset($_POST['submit'])){
    $errors = array();
                //Form validation parts
                $fName=$_POST['firstName'];
                $lName=$_POST['lastName'];
                $eMail=$_POST['mail'];
                $address=$_POST['address'];
                $mobileNo=$_POST['mobile'];
                $password=$_POST['password'];

    //checking required fields
    $required_field=array('firstName','lastName','mail','address','mobile','password');
    $errors=array_merge($errors,check_req_fields($required_field));

    //checking max length
    $max_length=array('firstName'=>150,'lastName'=>150,'mail'=>150,'address'=>150,'mobile'=>20,'password'=>150);
    $errors=array_merge($errors,check_max_length($max_length));

    //checking email address
    if(!is_email($_POST['mail'])){
        $errors[] = 'invalid email address';
    }

    //checking if email address already exists
    $email=mysqli_real_escape_string($conn,$_POST['mail']);
    $sql="SELECT * FROM customer WHERE email_address='{$eMail}' LIMIT 1";
    $result_set=mysqli_query($conn,$sql);
    if($result_set){
        if(mysqli_num_rows($result_set)==1){
            $errors[]='email address already exists';
        }
    }
    //Add to database
    if(empty($errors)) {
        $fName = mysqli_real_escape_string($conn, $_POST['firstName']);
        $lName = mysqli_real_escape_string($conn, $_POST['lastName']);
        $eMail = mysqli_real_escape_string($conn, $_POST['mail']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $mobileNo = mysqli_real_escape_string($conn, $_POST['mobile']);
        $hashedpassword = mysqli_real_escape_string($conn, $_POST['password']);
        $password = md5($hashedpassword);

        $result = mysqli_query($conn, "INSERT INTO admin_user VALUES(0,'{$fName}','{$lName}','{$eMail}','{$address}','{$mobileNo}','{$password}')");

        if ($result) {

            echo '<script>confirm("Registration has been Success"); window.location.href="logingForm.php"</script>';


        } else {
            $errors[]='Failed to add the new recode';
        }
    }

}

mysqli_close($conn);