<?php
/**
 * Created by IntelliJ IDEA.
 * User: sandunDilhan
 * Date: 1/3/2020
 * Time: 8:46 AM
 */

include('../conn.php');

$orderId = $_GET['orderId'];

$return_arr = array();

$query = "select * from billing_detail where order_id = '{$orderId}'";

$result = mysqli_query($conn,$query);

while($row = mysqli_fetch_array($result)){

    $return_arr[] = $row;

}

// Encoding array in JSON format
echo json_encode($return_arr);