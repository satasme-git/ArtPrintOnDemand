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
        //getting the user infromation
if(isset($_GET['cid'])){
        $cid=mysqli_real_escape_string($conn,$_GET['cid']);
        //deleting the user
        $sql="DELETE FROM  customer  WHERE cid={$cid}";
        $rst=mysqli_query($conn,$sql);
        if($rst){
            //delete successful
            header('Location:view_customer.php?msg=deleted_customer');
        }else{
            header('Location:view_customer.php?error=delete_failed');
        }
    

}

?>