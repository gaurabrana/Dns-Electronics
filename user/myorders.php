<?php
include('connect.php');
$active = "orders";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Material Dashboard by Creative Tim
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- CSS Files -->
    <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
    <div class="wrapper ">
        <?php
        include('sidebar.php');
        ?>
        <div class="main-panel">
            <!-- Navbar -->
            <?php
            include('topnavbar.php');
            ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <?php
                        $userid = $_SESSION['id'];
                        $getUserOrders = "Select * from orders where user_id = '$userid'";
                        $getUserOrdersExecute = mysqli_query($conn, $getUserOrders);
                        while($row = mysqli_fetch_assoc($getUserOrdersExecute)){
                            $orderid = $row['id'];
                            $billingid = $row['billing_address_id'];
                            if($row['shipping_address_id'] == "-"){
                                $sameshipping = true;
                            }
                            else{
                                $shippingid = $row['shipping_address_id'];
                                $sameshipping = false;
                            }
                            //shipping address
                            //billing address                            
                            //products
                            
                            echo'<div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title "><i class="fas fa-paper-plane"></i> Order Id : '.$row['id'].'</h4>
                                    <p class="card-category"><i class="fas fa-calendar-alt"></i> Date : '.$row['order_date'].'</p>
                                </div>
                                <div class="card-body">
                                <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary">
                                        <th>
                                        <i class="fas fa-shopping-basket"></i> Products
                                        </th>
                                        <th>
                                        <i class="fas fa-wallet"></i> Payment Type
                                        </th>
                                        <th>
                                        <i class="fas fa-tasks"></i> Status
                                        </th>
                                        <th>
                                        <i class="fas fa-money-check-alt"></i> Billing Details 
                                        </th>
                                        <th>
                                        <i class="fas fa-shipping-fast"></i> Shipping Details
                                        </th>
                                        <th>
                                        <i class="fas fa-cash-register"></i> Total
                                        </th>
                                        <th>
                                        <i class="fas fa-file-invoice"></i> Invoice
                                        </th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a data-toggle="collapse" href="#getorderproducts" role="button" aria-expanded="false" aria-controls="getorderproducts">
                                            Expand more..
                                          </a></td>
                                            <td>
                                                '.$row['payment_type'].'
                                            </td>
                                            <td>
                                            '.$row['status'].'
                                            </td>
                                            <td>
                                            <a data-toggle="collapse" href="#getorderbillingaddress" role="button" aria-expanded="false" aria-controls="getorderbillingaddress">
                                            Expand more..
                                          </a>                                         
                                            </td>
                                            <td>';
                                            if($sameshipping){
                                                echo'Same as billing address';
                                            }
                                            else{
                                                echo'<a data-toggle="collapse" href="#getordershippingaddress" role="button" aria-expanded="false" aria-controls="getordershippingaddress">
                                                Expand more..
                                              </a>';
                                            }                                            
                                            echo'</td>
                                            <td class="text">';
                                            $getTotalPrice = "Select sum(total_price) as total from order_item where order_id = '$orderid'";
                                            $getTotalPriceExecute = mysqli_query($conn, $getTotalPrice);
                                            $getTotalOrdered = mysqli_fetch_assoc($getTotalPriceExecute);
                                            $total = $getTotalOrdered['total'];
                                            echo "Rs ".$total;
                                            echo'</td>
                                            <td class="invoice" id="viewinvoice'.$orderid.'">View invoice</td>
                                        </tr>                                        
                                    </tbody>
                                </table>                                
                                <!---collapsibles start--->
                              <div class="collapse" id="getorderproducts">
                                <div class="card card-body table-responsive table-products">
                                <h4 class="text-warning">Ordered Products</h4>                                                   
                                <table class="table table-hover">
                                    <thead class="text-warning">
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    </thead>
                                    <tbody>';                      
                                    $getOrderedProducts = "Select oi.price, p.code, p.sold_by, oi.quantity, p.name, p.image_name from orders o, order_item oi, product p where o.id = oi.order_id and oi.product_id = p.id and o.id = '$orderid' LIMIT 4";
                                    $getOrderedProductsResult = mysqli_query($conn, $getOrderedProducts);
                                    if(mysqli_num_rows($getOrderedProductsResult) > 0){
                                        while($orderedProduct = mysqli_fetch_assoc($getOrderedProductsResult)){
                                        echo'<tr>
                                        <td width="120px" class="small-size"><img src="../admin/images/products/'.$orderedProduct['sold_by'].'/'.$orderedProduct['image_name'].'" alt="#"></td>
                                        <td><a href="singleproduct.php?i='.$orderedProduct['code'].'">'.$orderedProduct['name'].'</a></td>
                                        <td>Rs '.$orderedProduct['price'].'</td>
                                        <td>'.$orderedProduct['quantity'].'</td>
                                        </tr>';
                                        }
                                    }                      
                                                                        
                                    echo'</tbody>
                                </table>
                                </div>                                
                              </div>
                              <div class="collapse" id="getorderbillingaddress">
                                <div class="card card-body table-responsive table-products">
                                <h4 class="text-success">Billing Details</h4>                                 
                                <table class="table table-hover">
                                    <thead class="text-success">
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
                                </div>
                              </div>';
                              if(!$sameshipping){
                                echo'<div class="collapse" id="getordershippingaddress">
                                <div class="card card-body table-responsive table-products">
                                <h4 class="text-info">Shipping Details</h4>                                                   
                                <table class="table table-hover">
                                    <thead class="text-info">
                                    <th>Name</th>                                    
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
                                        <td>'.$orderShippingAddress['phone_number'].'</td>
                                        <td>'.$orderShippingAddress['address_one'].', '.$orderShippingAddress['address_two'].', '.$orderShippingAddress['postal_code'].'</td>                                        
                                        <td>'.$orderShippingAddress['country'].'</td>
                                        </tr>';
                                        }
                                    }                                                                                          
                                    echo'</tbody>
                                </table>
                                </div>
                              </div>';
                              }                              
                        echo'<!------collapsible end ----->
                            </div>
                                </div>
                            </div>
                        </div>  ';
                        }
                        ?>                                              
                    </div>
                </div>
            </div>
            <footer class="footer">
        <div class="container-fluid">          
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, Dns Electronics <i class="material-icons">favorite</i>            
          </div>
        </div>
      </footer>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="assets/js/core/jquery.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap-material-design.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Plugin for the momentJs  -->
    <script src="assets/js/plugins/moment.min.js"></script>
    <!--  Plugin for Sweet Alert -->
    <script src="assets/js/plugins/sweetalert2.js"></script>
    <!-- Forms Validations Plugin -->
    <script src="assets/js/plugins/jquery.validate.min.js"></script>
    <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="assets/js/plugins/jquery.bootstrap-wizard.js"></script>
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="assets/js/plugins/bootstrap-selectpicker.js"></script>
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script src="assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
    <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
    <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script src="assets/js/plugins/bootstrap-tagsinput.js"></script>
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
    <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
    <script src="assets/js/plugins/fullcalendar.min.js"></script>
    <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
    <script src="assets/js/plugins/jquery-jvectormap.js"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="assets/js/plugins/nouislider.min.js"></script>
    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <!-- Library for adding dinamically elements -->
    <script src="assets/js/plugins/arrive.min.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chartist JS -->
    <script src="assets/js/plugins/chartist.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="assets/demo/demo.js"></script>
</body>

</html>