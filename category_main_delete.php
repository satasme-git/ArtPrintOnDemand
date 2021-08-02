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
if(isset($_GET['id'])){
        $id=mysqli_real_escape_string($conn,$_GET['id']);
        //deleting the user
        $sql="DELETE FROM category WHERE id={$id}";
        $rst=mysqli_query($conn,$sql);
        if($rst){
            //delete successful
            header('Location:category_main_add.php?msg=deleted_category');
        }else{
            header('Location:category_main_delete.php?error=delete_category');
        }
    

}

?>