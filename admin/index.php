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
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Order Summary</h4>
                                    <div id="morris-bar-chart"></div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card card-widget">
                                <div class="card-body">
                                    <h5 class="text-muted">Order Overview </h5>
                                    <h2 class="mt-4">5680</h2>
                                    <span>Total Revenue</span>
                                    <div class="mt-4">
                                        <h4>30</h4>
                                        <h6>Online Order <span class="pull-right">30%</span></h6>
                                        <div class="progress mb-3" style="height: 7px">
                                            <div class="progress-bar bg-primary" style="width: 30%;" role="progressbar"><span class="sr-only">30% Order</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <h4>50</h4>
                                        <h6 class="m-t-10 text-muted">Offline Order <span class="pull-right">50%</span></h6>
                                        <div class="progress mb-3" style="height: 7px">
                                            <div class="progress-bar bg-success" style="width: 50%;" role="progressbar"><span class="sr-only">50% Order</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <h4>20</h4>
                                        <h6 class="m-t-10 text-muted">Cash On Develery <span class="pull-right">20%</span></h6>
                                        <div class="progress mb-3" style="height: 7px">
                                            <div class="progress-bar bg-warning" style="width: 20%;" role="progressbar"><span class="sr-only">20% Order</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-0">
                                    <h4 class="card-title px-4 mb-3">Todo</h4>
                                    <div class="todo-list">
                                        <div class="tdl-holder">
                                            <div class="tdl-content">
                                                <ul id="todo_list">
                                                    <li><label><input type="checkbox"><i></i><span>Get up</span><a href='#' class="ti-trash"></a></label></li>
                                                    <li><label><input type="checkbox" checked><i></i><span>Stand up</span><a href='#' class="ti-trash"></a></label></li>
                                                    <li><label><input type="checkbox"><i></i><span>Don't give up the fight.</span><a href='#' class="ti-trash"></a></label></li>
                                                    <li><label><input type="checkbox" checked><i></i><span>Do something else</span><a href='#' class="ti-trash"></a></label></li>
                                                </ul>
                                            </div>
                                            <div class="px-4">
                                                <input type="text" class="tdl-new form-control" placeholder="Write new item and hit 'Enter'...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
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
                                                        <th>Payment Status</th>                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $getRecentCustomerOrder  = "Select * from orders order by order_date ASC";
                                                    $executegetRecentCustomerOrder = mysqli_query($conn, $getRecentCustomerOrder);
                                                    while($row = mysqli_fetch_assoc($executegetRecentCustomerOrder)){
                                                        $orderid = $row['id'];
                                                        echo' <tr>';
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
                                                                        <h5 class="modal-title" id="exampleModalLabel">Ordered Products by '.$row1['name'].' on '.$row['order_date'].'</h5>         
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
                                                        <td>'.$row['order_date'].'</td>
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
                                                        </td>';
                                                        echo'</tr>';
                                                        
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <?php
                                            
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