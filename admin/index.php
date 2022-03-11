<?php
include("database/connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dns Electronics Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">    
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="./plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">

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

                <div class="container-fluid mt-3">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <div class="card gradient-1">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Products Sold</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white"><?php 
                                           $getProductsSold = "Select sum(quantity) as productsold from order_item, orders where status = 'completed' and order_item.order_id = orders.id";
                                           $executegetProductsSold = mysqli_query($conn, $getProductsSold);
                                           $getProductsSoldRow = mysqli_fetch_assoc($executegetProductsSold);
                                           $getProductsSoldvalue = ($getProductsSoldRow['productsold']==0)? 0 : $getProductsSoldRow['productsold'];
                                           echo $getProductsSoldvalue;
                                           ?></h2>
                                        <p class="text-white mb-0">Jan - March 2019</p>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card gradient-2">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Total Sales</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white">
                                        <?php 
                                           $getTotalSales = "Select sum(total_price) as totalsales from order_item, orders where status = 'completed' and order_item.order_id = orders.id";
                                           $executegetTotalSales = mysqli_query($conn, $getTotalSales);
                                           $getTotalSalesRow = mysqli_fetch_assoc($executegetTotalSales);
                                           $getTotalSalesvalue = ($getTotalSalesRow['totalsales']==0)? 0 : $getTotalSalesRow['totalsales'];
                                           echo "Rs ".$getTotalSalesvalue;
                                           ?>
                                        </h2>
                                        <p class="text-white mb-0">Jan - March 2019</p>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card gradient-3">
                                <div class="card-body">
                                    <h3 class="card-title text-white">New Customers</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white">
                                        <?php
                                        $getCustomers = "Select count(id) as newCustomer from customer where joined_date <= (SELECT DATE_SUB(SYSDATE(), INTERVAL 7 DAY))";
                                        $executegetCustomers = mysqli_query($conn, $getCustomers);
                                        $getCustomersRow = mysqli_fetch_assoc($executegetCustomers);
                                        $getCustomers = ($getCustomersRow['newCustomer']==0) ? 0 : $getCustomersRow['newCustomer'];
                                        echo $getCustomers;
                                        ?>
                                        </h2>
                                        <p class="text-white mb-0">Jan - March 2019</p>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card gradient-4">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Product Ratings</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white">
                                            <?php
                                            $getRating = "Select sum(rating) as totalRating, count(rating) as totalRatingCount, count(DISTINCT customer_id) as numberofUsers from reviews";
                                            $executegetRating = mysqli_query($conn, $getRating);
                                            $row = mysqli_fetch_assoc($executegetRating);
                                            $ratingInpercentage = ($row['totalRating']/(5*$row['totalRatingCount']))*100;
                                            echo $ratingInpercentage."%";
                                            ?>
                                        </h2>                                        
                                        <p class="text-white mb-0"><?php echo "Rated by ".$row['numberofUsers']." users"; ?></p>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                    <!-- Line Chart -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between" >
                                <h4 class="card-title">Orders and Products</h4>
                                <div class="date-cards">                                
                                <span class="ml-2 btn active" id="orderProductWeek">Weeks</span>                                                                                                                  
                                <span class="ml-2 btn" id="orderProductMonth">Months</span>                                
                                <span class="ml-2 btn" id="orderProductYear">Year</span>
                                </div>
                                </div>                                
                                <span>                                
                                <!-- <?php
                                    $week_number  = date("W", strtotime('now'));
                                    echo $week_number;
                                ?> <input id="week" type="week" name="week" value="2017-W<?php echo $week_number;?>">-->
                                
                                </span>
                                <canvas id="lineChart" width="500" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- Pie Chart -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Highest Ordered Products</h4>
                                <canvas id="pieChart" width="500" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Highest Rated Products</h4>
                                <canvas id="pieChart1" width="500" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>                

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                <h4 class="card-title">Today's Orders</h4>
                                    <div class="active-member">
                                        <div class="table-responsive">
                                            <table class="table table-xs mb-0 table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Customer</th>
                                                        <th>Product</th>
                                                        <th>Country</th>
                                                        <th>Date</th>
                                                        <th>Order Status</th>
                                                        <th>Order Details</th>                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    function check_Todays_DateMatch($a, $b) {
                                                        // Convert to timestamp

                                                        // from database a
                                                        $FromDatabase = strtotime($a);
                                                        // Current date b
                                                        $Current = strtotime($b);      
                                                        
                                                        // Check that user date is between start & end
                                                        return (($Current == $FromDatabase ));
                                                    }
                                                    $getRecentCustomerOrder  = "Select * from orders order by order_date DESC";
                                                    $executegetRecentCustomerOrder = mysqli_query($conn, $getRecentCustomerOrder);
                                                    $forModal = mysqli_query($conn, $getRecentCustomerOrder);
                                                    while($row = mysqli_fetch_assoc($executegetRecentCustomerOrder)){
                                                        $orderid = $row['id'];
                                                        $orderDate = $row['order_date'];
                                                        $newDate =  DateTime::createFromFormat("Y-m-d h:i:s A", $orderDate);       
                                                        $nextDate =  $newDate -> format("Y-m-d"); 
                                                        $date = new DateTime('now');  
                                                        $dateTodays = $date->format('Y-m-d');
                                                        $isToday = check_Todays_DateMatch($nextDate, $dateTodays) == true ? "Today" : "False";
                                                        if($isToday=="Today"){
                                                             //get user detail
                                                        $userid = $row['user_id'];
                                                        $getUserDetail = "Select name, uniquekey, gender, profile_picture from customer where id= '$userid' ";
                                                        $executegetUserDetail = mysqli_query($conn, $getUserDetail);
                                                        $row1 = mysqli_fetch_assoc($executegetUserDetail);                                                        
                                                        if($row1['profile_picture']=="notset"){
                                                                if($row1['gender']=="Male"){
                                                                    $imagesrc =  '../img/maleuser.png';
                                                                }
                                                                else{
                                                                    $imagesrc =  '../img/femaleuser.png';
                                                                }  
                                                               }
                                                               else{
                                                                if(file_exists('../img/UserProfile/'.$row1['uniquekey'].'/'.$row1['profile_picture'].'')){
                                                                    $imagesrc =  '../img/UserProfile/'.$row1['uniquekey'].'/'.$row1['profile_picture'].'';   
                                                                }
                                                                else{
                                                                    if($row1['gender']=="Male"){
                                                                        $imagesrc =  '../img/maleuser.png';
                                                                    }
                                                                    else{
                                                                        $imagesrc =  '../img/femaleuser.png';
                                                                    }                                                    
                                                                }
                                                                
                                                               } 
                                                        echo'<td><img src="'.$imagesrc.'" class=" rounded-circle mr-3" alt="">'.$row1['name'].'</td>';                                                        
                                                        //get product detail
                                                        $getOrderedProducts = "Select oi.price, p.code, p.sold_by, oi.quantity, p.name,p.image_folder_key, p.image_name from orders o, order_item oi, product p where o.id = oi.order_id and oi.product_code = p.code and o.id = '$orderid'";
                                                        $getOrderedProductsResult = mysqli_query($conn, $getOrderedProducts);
                                                        if(mysqli_num_rows($getOrderedProductsResult) > 0){
                                                            if(mysqli_num_rows($getOrderedProductsResult) > 1){
                                                                echo'<td style="cursor:pointer;" data-toggle="modal" data-target="#orderedproduct'.$orderid.'" role="button">View Products                                                                                                                              
                                                                <div class="modal fade" id="orderedproduct'.$orderid.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg" role="document">
                                                                    <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Ordered Products by '.$row1['name'].' on '.$orderDate.'</h5>         
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                          <span aria-hidden="true">&times;</span>        
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                    <table class="table table-hover">
                                                                    <thead>
                                                                    <th>Image</th>
                                                                    <th>Name</th>
                                                                    <th>Price</th>                                                                    
                                                                    <th>Quantity</th>
                                                                    </thead>
                                                                    <tbody>';                                          
                                                                        while($orderedProduct = mysqli_fetch_assoc($getOrderedProductsResult)){
                                                                        echo'<tr>
                                                                        <td width="120px" class="small-size"><img src="../admin/images/products/'.$orderedProduct['sold_by'].'/'.$orderedProduct['image_folder_key'].'/'.$orderedProduct['image_name'].'" alt="#"></td>
                                                                        <td><a target="_blank" href="../singleproduct.php?i='.$orderedProduct['code'].'">'.$orderedProduct['name'].'</a></td>
                                                                        <td>Rs '.$orderedProduct['price'].'</td>
                                                                        <td>'.$orderedProduct['quantity'].'</td>
                                                                        </tr>';
                                                                        }                                                                                                 
                                                                    echo'</tbody>
                                                                </table>                                                                   
                                                                    </div>                                                                    
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                </td>';
                                                            }
                                                            else{
                                                                while($orderedProduct = mysqli_fetch_assoc($getOrderedProductsResult)){                                                                   
                                                                        echo'<td><a target="_blank" href="../singleproduct.php?i='.$orderedProduct['code'].'">'.$orderedProduct['name'].'</a></td>';                                                                    
                                                                }
                                                            }                                                            
                                                        }             
                                                        echo'<td>Nepal</td>
                                                        <td>'.$orderDate.'</td>
                                                        <td>
                                                            <div>
                                                                <div class="progress" style="height: 6px">';
                                                                if($row['status'] == "completed"){
                                                                    echo'<div class="progress-bar bg-success" style="width: 100%"></div>';
                                                                }
                                                                else{
                                                                    echo'<div class="progress-bar bg-warning" style="width: 50%"></div>';
                                                                }
                                                                    
                                                                echo'</div>
                                                            </div>
                                                        </td>
                                                        <td><button class="btn btn-light" data-target="#moredetails' . $orderid . '" data-toggle="modal">See more</button></td>
                                                        ';
                                                        echo'</tr>';
                                                        }                                                                                                                                                                   
                                                        
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <?php
                                             while ($row1 = mysqli_fetch_assoc($forModal)) {                                                
                                                $orderDate = $row1['order_date'];
                                                $newDate =  DateTime::createFromFormat("Y-m-d h:i:s A", $orderDate);       
                                                $nextDate =  $newDate -> format("Y-m-d"); 
                                                $date = new DateTime('now');  
                                                $dateTodays = $date->format('Y-m-d');
                                                $isToday = check_Todays_DateMatch($nextDate, $dateTodays) == true ? "Today" : "False";
                                                if($isToday=="Today"){
                                                    $getORders = "Select * from orders where id = '$orderid'";
                                                    $getORdersResult = mysqli_query($conn, $getORders);
                                                    $row = mysqli_fetch_assoc($getORdersResult);
                                                    $orderid = $row['id'];
                                                    $billingid =$row['billing_address_id'];
                                                    if($row['shipping_address_id'] == "-"){
                                                        $sameshipping = true;
                                                    }
                                                    else{
                                                        $shippingid = $row['shipping_address_id'];
                                                        $sameshipping = false;
                                                    }
                                                    echo '<div class="modal fade" id="moredetails' . $orderid . '" tabindex="-1" role="dialog" aria-labelledby="moredetails' . $orderid . 'label" aria-hidden="true">
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
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                   
                    </div>
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
    <script src="./plugins/moment/moment.js"></script>    
    <!-- Chartjs -->
    <script src="./plugins/chart.js/Chart.bundle.min.js"></script>
    <!-- Circle progress -->
    <script src="js/charts.js"></script>
    <script src="./plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>    
    <script>

    </script>

</body>

</html>