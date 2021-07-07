<?php
session_start();
//print_r($_SESSION["loginUseradmin"]);
// if(empty($_SESSION["loginUseradmin"])){
// ?>
//     <script>
//         window.location.href='admin_login.php';
//     </script>
// <?php
// }
include('../conn.php');
?>
<!DOCTYPE html>
<html class="">
<head>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <title>Admin - Art, Prints and Posters</title>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <script src="https://code.jquery.com/jquery-3.1.1.min.js">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/admin.css">
    
    <link rel="shortcut icon" href="../../../images/logos/art_print_on_demand.png" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="../../../images/logos/art_print_on_demand.png">

</head>
<body onload="myFunction()">
<div id="wrapper" class="animate">
    <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#" style="color: #4FC1B7;"><img src="../../../images/logos/art_print_on_demand.png" style="width: 31%;" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                aria-controls="navbarText"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav animate side-nav" style="display: none">
                <li class="nav-item" id="btnDashbordColor">
                    <a class="nav-link" href="#" title="Dashboard" onclick="btnDashbord()"><i
                            class="fa fa-cog fa-spin fa-3x fa-cube"></i>Dashboard
                        <i class="fa fa-cog fa-spin fa-3x fa-cube shortmenu animate"></i></a>
                </li>
<!--                <li class="nav-item" id="btnSettingColor">-->
<!--                    <a class="nav-link" href="#" title="Cart" onclick="btnSetting()"><i-->
<!--                            class="fa fa-cog fa-spin fa-3x fa-fw" id="setting"></i> Settings-->
<!--                        <i class="fa fa-cog fa-spin fa-3x fa-fw shortmenu animate"></i></a>-->
<!--                </li>-->
            </ul>
            <ul class="navbar-nav ml-md-auto d-md-flex">
                <!--<li class="nav-item">-->
                <!--<a class="nav-link" href="#"><i class="fas fa-user"></i> Profile</a>-->
                <!--</li>-->
                <li class="nav-item" onclick="">
                    <a class="nav-link" href="../admin-log" style="color: #28A55F;"><i class="fas fa-key"></i> BACK</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid" id="tblCustomer">
        <table id="table">
            <tr style="background-color: #4FC1B7">
                <th style="text-align: center">Order_Id</th>
                <th style="text-align: center">Total_Amount ( AU )</th>
                <th style="text-align: center">Order_Date</th>
                <th style="text-align: center">Pickup_Store</th>
                <th style="text-align: center">Order_Complete</th>
                <th style="text-align: center">Action</th>
            </tr>
            <?php
                $resultSet=mysqli_query($conn,"select * from orders order by order_id desc");
                $result=mysqli_fetch_all($resultSet);
                foreach ($result as $item) {
                    ?>
                    <tr>
                        <td style="text-align: center"><?=$item[0]?></td>
                        <td style="text-align: center"><?=$item[2]?></td>
                        <td style="text-align: center"><?=$item[4]?></td>
                        <?php
                        if($item[5] === '1'){
                            ?>
                            <td align="centre"
                                style="font-family: wingdings; font-size:150%;font-weight:bold; color:limegreen;text-align: center">
                                &#10004;
                            </td>
                            <?php
                        }else{
                            ?>
                            <td style="text-align: center"><span style='font-size:25px;color: red'>&#10006;</span></td>
                        <?php
                        }
                        ?>
                        <td style="text-align: center">
                            <?php
                            if($item[3] === '1'){
                                ?>
                                <input type="checkbox" class="checkbox" checked disabled id="remember_me">
                            <?php
                            }else{
                                ?>
                                <input type="checkbox" class="checkbox" disabled id="remember_me">
                            <?php
                            }
                            ?>

                        </td>
                        <td style="text-align: center"><input type="button" class="btn btn-primary ok" data-toggle="modal"
                                                              data-target=".bd-example-modal-lg" value="more detail">

                            <?php
                            if($item[3] === '1'){
                                ?>
                                <input type="button" class="btn btn-warning complete" disabled value="completed">
                                <?php
                            }else{
                                ?>
                                <input type="button" class="btn btn-success complete" value="complete">
                                <?php
                            }
                            ?>

                        </td>
                    </tr>
                    <?php
                }
            ?>
        </table>
        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Item Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table" id="itemDetailTable">
                            <thead>
                            <tr>
                                <th scope="col">Item_Code</th>
                                <th scope="col">Description</th>
                                <th scope="col">Special note</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Price</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                            </thead>
                            <tbody id="itemDetailTableBody">

                            </tbody>
                        </table>

                        <br>
                        <br>
                        <br>
                        <h5>Shipping Detail</h5>
                        <table class="table" id="shippingTable">
                            <tbody id="shippingTableBody">

                            </tbody>
                        </table>
                        <br>
                        <br>
                        <br>
                        <h5>Billing Detail</h5>
                        <table class="table" id="billingTable">
                            <tbody id="billingTableBody">

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<!--                        <button type="button" class="btn btn-primary">Save changes</button>-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid hide" id="settingForm">
        <main class="my-form">
            <div class="cotainer">
                <div class="card">
                    <div class="card-header" style="background-color: #4FC1B7">Change Passwords</div>
                    <div class="card-body">
                        <form name="my-form" action="#" method="">
                            <div class="form-group row">
                                <label for="full_name" class="col-md-4 col-form-label">Full
                                    Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="full_name" class="form-control" name="full-name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_name" class="col-md-4 col-form-label">User
                                    Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="user_name" class="form-control" name="username">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_number" class="col-md-4 col-form-label">Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="phone_number" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="present_address" class="col-md-4 col-form-label">Confirm
                                    Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="present_address" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Confirm
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    function btnSetting() {
        document.getElementById("tblCustomer").style.display = "none";
        document.getElementById("settingForm").style.display = "block";

        document.getElementById("btnDashbordColor").style.backgroundColor = "none";
        document.getElementById("btnDashbordColor").style.backgroundColor = "#585f66";
        document.getElementById("btnSettingColor").style.backgroundColor = "#28A55F";
    }

    function btnDashbord() {
        document.getElementById("tblCustomer").style.display = "block";
        document.getElementById("settingForm").style.display = "none";

        document.getElementById("btnDashbordColor").style.backgroundColor = "#28A55F";
        document.getElementById("btnSettingColor").style.backgroundColor = "none";
        document.getElementById("btnSettingColor").style.backgroundColor = "#585f66";
    }

    function myFunction() {
        document.getElementById("tblCustomer").style.display = "block";
        document.getElementById("settingForm").style.display = "none";
        document.getElementById("btnDashbordColor").style.backgroundColor = "#28A55F";
    }

    $('.ok').on('click', function(e){
        var orderId;
        var table = document.getElementById('table');

        $("#itemDetailTableBody").empty();
        $("#shippingTableBody").empty();
        $("#billingTableBody").empty();

        for(var i = 1; i < table.rows.length; i++)
        {
            table.rows[i].onclick = function()
            {
                orderId = this.cells[0].innerHTML;

                $.ajax({
                    url: 'load_order_detail.php?orderId='+orderId,
                    type: 'get',
                    dataType: 'JSON',
                    success: function(response){
                        var len = response.length;
                        for(var i=0; i<len; i++){

                            var id = response[i].item_id;
                            var desc = response[i].description;
                            var specialNote = response[i].special_note;
                            var qty = response[i].qty;
                            var price = response[i].price;
                            var subtotal = response[i].subtotal;

                            var tr_str = "<tr>" +
                                "<td align='center'>" + id + "</td>" +
                                "<td align='center'>" + desc + "</td>" +
                                "<td align='center'>" + specialNote + "</td>" +
                                "<td align='center'>" + qty + "</td>" +
                                "<td align='center'>" + price + "</td>" +
                                "<td align='center'>" + subtotal + "</td>" +
                                "</tr>";

                            $("#itemDetailTable tbody").append(tr_str);
                        }

                    }
                });

                $.ajax({
                    url: 'load_shipping_detail.php?orderId='+orderId,
                    type: 'get',
                    dataType: 'JSON',
                    success: function(response){
                        var len = response.length;
                        for(var i=0; i<len; i++){

                            var table = document.getElementById("shippingTable");
                            var row = table.insertRow(0);
                            var row1 = table.insertRow(1);
                            var row2 = table.insertRow(2);
                            var row3 = table.insertRow(3);
                            var row4 = table.insertRow(4);
                            var row5 = table.insertRow(5);
                            var row6 = table.insertRow(6);

                            var cell1 = row.insertCell(0);
                            var cell2 = row.insertCell(1);
                            cell1.innerHTML = "Name";
                            cell2.innerHTML = response[i].shipping_first_name +" "+ response[i].shipping_last_name;

                            var cell3 = row1.insertCell(0);
                            var cell4 = row1.insertCell(1);
                            cell3.innerHTML = "Email";
                            cell4.innerHTML = response[i].shipping_email_address;

                            var cell5 = row2.insertCell(0);
                            var cell6 = row2.insertCell(1);
                            cell5.innerHTML = "Contact No.";
                            cell6.innerHTML = response[i].shipping_contact_no;

                            var cell7 = row3.insertCell(0);
                            var cell8 = row3.insertCell(1);
                            cell7.innerHTML = "Address";
                            cell8.innerHTML = response[i].shipping_addres;

                            var cell9 = row4.insertCell(0);
                            var cell10 = row4.insertCell(1);
                            cell9.innerHTML = "States";
                            cell10.innerHTML = response[i].shipping_states;

                            var cell11 = row5.insertCell(0);
                            var cell12 = row5.insertCell(1);
                            cell11.innerHTML = "Suburb";
                            cell12.innerHTML = response[i].shipping_suburb;

                            var cell13 = row6.insertCell(0);
                            var cell14 = row6.insertCell(1);
                            cell13.innerHTML = "Postcode";
                            cell14.innerHTML = response[i].shipping_postcode;



                            var billingtable = document.getElementById("billingTable");
                            var billingrow = billingtable.insertRow(0);
                            var billingrow1 = billingtable.insertRow(1);
                            var billingrow2 = billingtable.insertRow(2);
                            var billingrow3 = billingtable.insertRow(3);
                            var billingrow4 = billingtable.insertRow(4);
                            var billingrow5 = billingtable.insertRow(5);
                            var billingrow6 = billingtable.insertRow(6);

                            var billingcell1 = billingrow.insertCell(0);
                            var billingcell2 = billingrow.insertCell(1);
                            billingcell1.innerHTML = "Name";
                            billingcell2.innerHTML = response[i].billing_first_name +" "+ response[i].billing_last_name;

                            var billingcell3 = billingrow1.insertCell(0);
                            var billingcell4 = billingrow1.insertCell(1);
                            billingcell3.innerHTML = "Email";
                            billingcell4.innerHTML = response[i].billing_email_address;

                            var billingcell5 = billingrow2.insertCell(0);
                            var billingcell6 = billingrow2.insertCell(1);
                            billingcell5.innerHTML = "Contact No.";
                            billingcell6.innerHTML = response[i].billing_contact_no;

                            var billingcell7 = billingrow3.insertCell(0);
                            var billingcell8 = billingrow3.insertCell(1);
                            billingcell7.innerHTML = "Address";
                            billingcell8.innerHTML = response[i].billing_addres;

                            var billingcell9 = billingrow4.insertCell(0);
                            var billingcell10 = billingrow4.insertCell(1);
                            billingcell9.innerHTML = "States";
                            billingcell10.innerHTML = response[i].billing_states;

                            var billingcell11 = billingrow5.insertCell(0);
                            var billingcell12 = billingrow5.insertCell(1);
                            billingcell11.innerHTML = "Suburb";
                            billingcell12.innerHTML = response[i].billing_suburb;

                            var billingcell13 = billingrow6.insertCell(0);
                            var billingcell14 = billingrow6.insertCell(1);
                            billingcell13.innerHTML = "Postcode";
                            billingcell14.innerHTML = response[i].billing_postcode;
                        }

                    }
                });
            };
        }
    });


    $('.complete').on('click', function(e){
        var conf = confirm("are ypu sure, you want to complete this order!");
        if(conf == true){
            var orderId;
            var table = document.getElementById('table');

            for(var i = 1; i < table.rows.length; i++)
            {
                table.rows[i].onclick = function()
                {
                    orderId = this.cells[0].innerHTML;

                    $.ajax({
                        url: 'complete_order.php?orderId='+orderId,
                        type: 'get',
                        dataType: 'JSON',
                        success: function(response){
                            alert(response);
                            window.location.href = "admin_forms/admin_form.php";
                        }
                    });

                };
            }
        }

        window.location.href = "admin_form.php";
    });


    function logout() {
        $.ajax({
            url: 'admin_logout.php',
            type: 'get',
            dataType: 'JSON',
            success: function(response){
                alert(response);
                window.location.href = "admin_forms/admin_form.php";
            }
        });
    }
</script>

<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

</body>
</html>