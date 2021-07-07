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
if(isset($_GET['frameid'])){
        $frameid=mysqli_real_escape_string($conn,$_GET['frameid']);
        //deleting the user
        $sql="DELETE FROM frame WHERE id={$frameid}";
        $rst=mysqli_query($conn,$sql);
        if($rst){
            //delete successful
            header('Location:view_frame.php?msg=deleted_frame');
        }else{
            header('Location:view_frame?error=delete_failed');
        }
    

}

?>