<?php
include("database/connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Orders</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="./plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="plugins/toastr/css/toastr.min.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?php

        include("layouts.php");
        ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Orders</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Tracking</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Track Orders</h4>
                                <h6>For each order, there are four stages: Packing, Delivery Start, Mid, Delivery End</h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>User ID</th>                                                
                                                <th>Date</th>
                                                <th>Delivery Status</th>
                                                <th>Order Status</th>
                                                <th>Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include("./formatdate.php");
                                            $getAllCustomers = "Select * from orders where status = 'Ongoing'";
                                            $executegetAllCustomers = mysqli_query($conn, $getAllCustomers);
                                            $forModal = mysqli_query($conn, $getAllCustomers);
                                            while ($row = mysqli_fetch_assoc($executegetAllCustomers)) {
                                                $date = formatDate($row['order_date']) . " " . formatTime($row['order_date']);
                                                $orderid = $row['id'];
                                                $getTotalPrice = "Select sum(total_price) as total from order_item where order_id = '$orderid'";
                                                $getTotalPriceExecute = mysqli_query($conn, $getTotalPrice);
                                                $getTotalOrdered = mysqli_fetch_assoc($getTotalPriceExecute);
                                                $total = $getTotalOrdered['total'];
                                                    echo '<tr>
                                                    <td>' . $orderid . '</td>
                                                    <td>' . $row['user_id'] . '</td>                                                    
                                                    <td>' . $date . '</td>                                                     
                                                    <td>
                                                   
                                                    <select id="orderStages'.$orderid.'" class="orderStatus">';
                                                    //get tracker
                                                    $getOrderTrack = "Select * from order_tracking where orderid = '$orderid'";
                                                    $getOrderTrackResult = mysqli_query($conn, $getOrderTrack);
                                                    $totalRows = mysqli_num_rows($getOrderTrackResult);                                                                                                         
                                                    if($totalRows>0){
                                                        $data = array();
                                                        if($totalRows > 1){
                                                            while($row1 = mysqli_fetch_assoc($getOrderTrackResult)){
                                                                $stage = $row1['status'] == "" ? "" : $row1['status'];                                                            
                                                                
                                                                    array_push($data, $stage);
                                                                }                                                            
                                                            $max = 0;
                                                            foreach($data as $value){
                                                                $stagenumber = (int) explode("stage", $value)[1];
                                                                if($stagenumber > $max){
                                                                    $max = $stagenumber;
                                                                }                                                            
                                                            }
                                                        }
                                                        else{
                                                                $max = 0;
                                                                $row1 = mysqli_fetch_assoc($getOrderTrackResult);
                                                                $stage = $row1['status'] == "" ? "" : $row1['status']; 
                                                        }                                                        
                                                        $message = array("","Product not ready for packaging","Product ready for packaging","Product sent for delivery", "Product is being delivered to customer","Product is delivered to customer");
                                                        for($i=1 ;$i <= 5; $i++){                                                            
                                                            $messageAdd = $message[$i];
                                                            echo'<option value="stage'.$i.'"'; if($stage == "stage'.$i.'"){echo " selected";} if($max!=0 && $i<$max){
                                                                echo" disabled class='disabledStage'";
                                                            } echo'>'.$messageAdd.'</option>';
                                                        }                                                                                                        
                                                    }
                                                    else{
                                                        echo'<option disabled selected>Choose status</option>
                                                    <option value="stage1">Product not ready for packaging</option>
                                                    <option value="stage2">Product ready for packaging</option>
                                                    <option value="stage3">Product sent for delivery</option>
                                                    <option value="stage4">Product is being delivered to customer</option>
                                                    <option value="stage5">Product is delivered to customer</option>';                                                    
                                                    }                                                    
                                                    echo'</select>                                                                                                   
                                                    </td>
                                                    <td>' . $row['status'] . '</td>                                                                                          
                                                    <td><button class="btn btn-info" data-target="#moredetails' . $orderid . '" data-toggle="modal">See more</button></td>
                                                    </tr>';
                                                                                                
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>User ID</th>                                                
                                                <th>Date</th>     
                                                <th>Delivery Status</th>                                           
                                                <th>Order Status</th>
                                                <th>Details</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                while ($row = mysqli_fetch_assoc($forModal)) {
                    $orderid = $row['id'];
                    $billingid =$row['billing_address_id'];
                    if($row['shipping_address_id'] == "-"){
                        $sameshipping = true;
                    }
                    else{
                        $shippingid = $row['shipping_address_id'];
                        $sameshipping = false;
                    }
                    echo '<div class="modal fade" id="moredetails' . $orderid . '" tabindex="-1" role="dialog" aria-labelledby="editUser' . $orderid . 'label" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Order Details</h5>                              
                    </div>
                    <div class="modal-body">                                        
                       <div class="row">
                       <div class="col-lg-12">
                       <h4 style="text-align:center;" class="text-info">USER DETAILS</h4>';
                       $userid = $row['user_id'];                       
                       $getAllCustomers = "Select * from customer where id='$userid'";
                        $executegetAllCustomers = mysqli_query($conn, $getAllCustomers);
                        $userinfo = mysqli_fetch_assoc($executegetAllCustomers);
                       if($userinfo['profile_picture']=="notset"){
                        if($userinfo['gender']=="Male"){
                            $imagesrc =  '../img/maleuser.png';
                        }
                        else{
                            $imagesrc =  '../img/femaleuser.png';
                        }     
                       }
                       else{
                        if(file_exists('../img/UserProfile/'.$userinfo['uniquekey'].'/'.$userinfo['profile_picture'].'')){
                            $imagesrc =  '../img/UserProfile/'.$userinfo['uniquekey'].'/'.$userinfo['profile_picture'].'';   
                        }
                        else{
                            if($userinfo['gender']=="Male"){
                                $imagesrc =  '../img/maleuser.png';
                            }
                            else{
                                $imagesrc =  '../img/femaleuser.png';
                            }     
                        }
                        
                       }   
                       echo'<div class="row"><div class="col-lg-4 col-md-3 col-6">
                       <img class="modalUserImage" src="'.$imagesrc.'" alt="User profile picture">
                       </div>    
                       <div class="col-lg-8 col-md-8 col-6">
                       <table class="table table-responsive table-hover">
								<tr><th><i class="fas fa-user"></i> Name </th><td>'.$userinfo['name'].'</td></tr>
								<tr><th><i class="fas fa-envelope"></i> Email Address </th><td>'.$userinfo['email'].'</td></tr>
								<tr><th><i class="fas fa-phone-alt"></i> Contact </th><td>'.$userinfo['phone_no'].'</td></tr>
								<tr><th><i class="fas fa-street-view"></i> Age </th><td>'.$userinfo['age'].'</td></tr>
								<tr><th><i class="fas fa-flag"></i> Gender </th><td>'.$userinfo['gender'].'</td></tr>								                              								                            
								</table>
                       </div>                     
                       </div>
                       <div class="col-lg-12">
                       <hr>
                       <h4 style="text-align:center;" class="text-warning">ORDERED PRODUCTS</h4>                                                   
                    <table class="table table-hover">
                    <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    </thead>
                    <tbody>';                      
                    $getOrderedProducts = "Select oi.price, p.code, p.sold_by, oi.quantity, p.name,p.image_folder_key, p.image_name from orders o, order_item oi, product p where o.id = oi.order_id and oi.product_code = p.code and o.id = '$orderid'";
                    $getOrderedProductsResult = mysqli_query($conn, $getOrderedProducts);
                    if(mysqli_num_rows($getOrderedProductsResult) > 0){
                        while($orderedProduct = mysqli_fetch_assoc($getOrderedProductsResult)){
                        echo'<tr>
                        <td width="120px" class="small-size"><img src="../admin/images/products/'.$orderedProduct['sold_by'].'/'.$orderedProduct['image_folder_key'].'/'.$orderedProduct['image_name'].'" alt="#"></td>
                        <td><a href="../singleproduct.php?i='.$orderedProduct['code'].'">'.$orderedProduct['name'].'</a></td>
                        <td>Rs '.$orderedProduct['price'].'</td>
                        <td>'.$orderedProduct['quantity'].'</td>
                        </tr>';
                        }
                    }                      
                                                        
                    echo'</tbody>
                </table>
                       </div> 
                       </div>                      
                       <div class="col-lg-12">
                       <hr>
                       <h4 style="text-align:center;" class="text-success">BILLING DETAILS</h4>
                       <table class="table table-hover">
                    <thead>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>Phone Number</th>
                    <th>Address</th>                                                                        
                    <th>Country</th>
                    </thead>
                    <tbody>';                      
                    $getOrderBillingAddress = "Select * from order_billing_info where info_id = '$billingid'";
                    $getOrderBillingAddressResult = mysqli_query($conn, $getOrderBillingAddress);
                    if(mysqli_num_rows($getOrderBillingAddressResult) > 0){
                        while($orderBillingAddress = mysqli_fetch_assoc($getOrderBillingAddressResult)){
                        echo'<tr>
                        <td>'.$orderBillingAddress['firstname'].' '.$orderBillingAddress['lastname'].'</td>
                        <td>'.$orderBillingAddress['email_address'].'</td>
                        <td>'.$orderBillingAddress['phone_number'].'</td>
                        <td>'.$orderBillingAddress['address_one'].', '.$orderBillingAddress['address_two'].', '.$orderBillingAddress['postal_code'].'</td>                                                                                
                        <td>'.$orderBillingAddress['country'].'</td>
                        </tr>';
                        }
                    }                                                                                              
                    echo'</tbody>
                </table>
                       </div>';
                       if(!$sameshipping){
                        echo'<div class="col-lg-12">
                        <hr>
                        <h4 style="text-align:center;" class="text-danger">SHIPPING DETAILS</h4>                                                   
                        <table class="table table-hover">
                            <thead>
                            <th>Name</th>           
                            <th>Email Address</th>                         
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Country</th>
                            </thead>
                            <tbody>';                      
                            $getOrderShippingAddress = "Select * from order_shipping_info where shipping_info_id = '$shippingid'";
                            $getOrderShippingAddressResult = mysqli_query($conn, $getOrderShippingAddress);
                            if(mysqli_num_rows($getOrderShippingAddressResult) > 0){
                                while($orderShippingAddress = mysqli_fetch_assoc($getOrderShippingAddressResult)){
                                echo'<tr>
                                <td>'.$orderShippingAddress['fullname'].'</td>     
                                <td>'.$orderShippingAddress['email_address'].'</td>                                   
                                <td>'.$orderShippingAddress['phone_number'].'</td>
                                <td>'.$orderShippingAddress['address_one'].', '.$orderShippingAddress['address_two'].', '.$orderShippingAddress['postal_code'].'</td>                                        
                                <td>'.$orderShippingAddress['country'].'</td>
                                </tr>';
                                }
                            }                                                                                          
                            echo'</tbody>
                        </table>
                        </div>';                        
                      }                       
                       echo'</div>
                    </div>
                    <div class="modal-footer">                                    
                    </div>
                    </div>
                    </div>
                    </div>';
                }
                ?>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="#">Gaurab Rana</a> 2021</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
    <script src="./plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="./plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="./plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
    <script src="plugins/toastr/js/toastr.min.js"></script>
  <script src="plugins/toastr/js/toastr.init.js"></script>
</body>

</html>