<?php
/**
 * Created by IntelliJ IDEA.
 * User: sandunDilhan
 * Date: 1/8/2020
 * Time: 9:49 AM
 */
session_start();

unset($_SESSION["loginUseradmin"]);
if(empty($_SESSION["loginUseradmin"])){
    header('location:admin_login.php');
}