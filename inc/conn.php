<?php
/**
 * Created by IntelliJ IDEA.
 * User: sandunDilhan
 * Date: 11/14/2019
 * Time: 4:21 PM
 */
//live
//$conn=mysqli_connect("localhost","cdcsiima_root","{ve(.OPkk@YR","cdcsiima_art_print","3306");
//local
 $conn=mysqli_connect("localhost","root","12345678","cdcsiima_art_print","3306");

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}else{
    //echo "ok";
}