<?php
/**
 * Created by IntelliJ IDEA.
 * User: sandunDilhan
 * Date: 1/2/2020
 * Time: 11:43 AM
 */

include('../conn.php');

$orderId = $_GET['orderId'];

$return_arr = array();

$query = "select * from item where order_id = '{$orderId}'";

$result = mysqli_query($conn,$query);

while($row = mysqli_fetch_array($result)){

    $return_arr[] = $row;

}

// Encoding array in JSON format
echo json_encode($return_arr);