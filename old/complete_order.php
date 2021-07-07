<?php
/**
 * Created by IntelliJ IDEA.
 * User: sandunDilhan
 * Date: 1/3/2020
 * Time: 9:23 PM
 */

include('../conn.php');

$orderId = $_GET['orderId'];

$result=mysqli_query($conn,"UPDATE orders SET status=1 where order_id='{$orderId}'");
if(mysqli_affected_rows($conn)>0){
    echo "order has been completed";
}else{
    echo "order has been Failed";
}
mysqli_close($conn);