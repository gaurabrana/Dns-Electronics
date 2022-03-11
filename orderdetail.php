<?php
include('database/connect.php');
$active = "order";
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
}
if (isset($_GET['i'])) {
    if ($_GET['i'] == "") {
        header("Location: index.php");
    }
    $orderid = $_GET['i'];

    $exist = false;
    $userid = $_SESSION['id'];
    $billingid = null;
    $shippingid = null;
    $orderdate = null;
    $status = null;
    $payment_type = null;


    // get order by id
    $sql = "Select * from orders where id = '$orderid' and user_id = '$userid'";
    $result = mysqli_query($conn, $sql);

    // get ordered products
    $getOrderProducts = "Select p.name,p.image_name,p.image_folder_key,p.sold_by, p.code, p.category, o.price, o.quantity, o.total_price FROM order_item o, product p where o.order_id = '$orderid' and o.product_code = p.code";
    $getOrderProductsResult = mysqli_query($conn, $getOrderProducts);

    //get total 
    $getTotal = "Select sum(total_price) as total from order_item where order_id = '$orderid'";
    $getTotalresult = mysqli_query($conn, $getTotal);
    $getTotalrow = mysqli_fetch_assoc($getTotalresult);
    $total = (int) $getTotalrow['total'];


    // if order exist
    if (mysqli_num_rows($result) > 0) {
        $exist = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $billingid = $row['billing_address_id'];
            $orderdate = $row['order_date'];
            $payment_type = $row['payment_type'];
            $status = $row['status'];
            if ($row['shipping_address_id'] != "-") {
                $shippingid = $row['shipping_address_id'];
            }
        }
    }
}
// return to home
else {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='copyright' content=''>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Tag  -->
    <title>DnsElectronics</title>
    <!-- Favicon -->
    <!---<link rel="icon" type="image/png" href="images/favicon.png">-->
    <!-- Web Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <!-- StyleSheet -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <!-- Font Awesome -->



    <!-- Themify Icons -->
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="assets/css/niceselect.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- Flex Slider CSS -->
    <link rel="stylesheet" href="assets/css/flex-slider.min.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="assets/css/owl-carousel.css">
    <!-- Slicknav -->
    <link rel="stylesheet" href="assets/css/slicknav.min.css">

    <!-- custom StyleSheet -->
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">



</head>

<body class="js">

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

    <?php
    include("layouts/navbar.php");
    ?>
    <!--/ End Header -->

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="index.php">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="orderdetail.php">Order Detail</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shopping Cart -->
    <div class=" container-fluid my-5 ">
        <div class="row justify-content-center ">
            <div class="col-xl-10">
                <div class="card shadow-lg ">
                    <div class="row p-2 mt-3 justify-content-between mx-sm-2">
                        <div class="col">
                            <p class="text-muted space mb-0 shop"> Shop Name: Dns Electronics</p>
                            <p class="text-muted space mb-0 shop">Mail: support@dnselectronics.com</p>
                        </div>
                        <div class="col">
                            <div class="row justify-content-start">
                                <div class="col">
                                    <h4>Order No: <?php if ($exist) {
                                                        echo $orderid;
                                                    } ?></h4>
                                    <input type="hidden" value="<?php if ($exist) {
                                                                    echo $orderid;
                                                                } ?>" id="holdOrderId">
                                    <input type="hidden" value="<?php if ($exist) {
                                                                    echo $payment_type;
                                                                } ?>" id="holdPaymentType">
                                </div>
                            </div>
                        </div>
                        <div cl ass="col-auto"> <img class="irc_mi img-fluid bell" src="https://i.imgur.com/uSHMClk.jpg" width="30" height="30"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-sm-5 col-12">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <p class="card-text text-center mt-2 space">ORDER DETAILS</p>
                                    <hr class="my-0">
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 mt-0">
                                            <table class="table table-hover table-responsive">
                                                <tr>
                                                    <th><i class="fas fa-calendar-alt"></i> Order Date</th>
                                                    <td>                                                        
                                                        <?php
                                                        require('formatdate.php');
                                                        echo formatDate($orderdate) . ' at ' . formatTime($orderdate);
                                                        $paymentpartner = "images\payment-partners\\";
                                                        $location = $paymentpartner;
                                                        if($payment_type == "Esewa"){
                                                            $paymentpartner .= "esewa.png";
                                                        }
                                                        else if($payment_type == "Paypal"){
                                                            $paymentpartner .= "paypal.png";
                                                        }
                                                        else if($payment_type == "Khalti"){
                                                            $paymentpartner .= "khalti.png";
                                                        }
                                                        
                                                        ?>                                                        
                                                    </td>
                                                </tr>                                                
                                                <tr>
                                                    <th><i class="fas fa-info-circle"></i> Order Status</th>
                                                    <td><?php echo $status; ?></td>
                                                </tr>
                                                <tr>
                                                    <th><i class="fas fa-info"></i> Payment Status</th>
                                                    <td>
                                                        <?php
                                                        $getOrderPayment = "Select status from payment where order_id = '$orderid'";
                                                        $getOrderPaymentResult = mysqli_query($conn, $getOrderPayment);
                                                        if (mysqli_num_rows($getOrderPaymentResult) > 0) {                                                            
                                                            $status = "Paid";
                                                        } else {
                                                            $status = "Unpaid";
                                                        }
                                                        echo $status;
                                                        ?>
                                                    </td>
                                                </tr>
                                                        <?php
                                                        if($status=="Unpaid"){                                                        
                                                        echo'<tr>
                                                        <th><i class="fas fa-handshake"></i> Pay via</th>
                                                        <td>';                                                        
                                                       
                                                            $productAmount = $total;
                                                            $taxamount = 10;
                                                            $service_charge = 20;
                                                            $delivery_charge = 30;
                                                            $totalAmount = $productAmount + $taxamount + $service_charge + $delivery_charge;
                                                            $uniqueid = $orderid;
                                                            $merchantid = "EPAYTEST";
                                                            $onSuccessUrl = "http://localhost/ecommerceproject/verifypayment.php?r=su";
                                                            $onFailureUrl = "http://localhost/ecommerceproject/verifypayment.php?r=fu";
                                                            $visibility = $payment_type == "Esewa" ? "" : "hide-element";
                                                            echo '<form id="esewaPayment" class="'.$visibility.'" action="https://uat.esewa.com.np/epay/main" method="POST">
                                                    <input value="' . $totalAmount . '" name="tAmt" type="hidden">
                                                    <input value="' . $productAmount . '" name="amt" type="hidden">
                                                    <input value="' . $taxamount . '" name="txAmt" type="hidden">
                                                    <input value="' . $service_charge . '" name="psc" type="hidden">
                                                    <input value="' . $delivery_charge . '" name="pdc" type="hidden">
                                                    <input value="' . $merchantid . '" name="scd" type="hidden">
                                                    <input value="' . $uniqueid . '" name="pid" type="hidden">
                                                    <input value="' . $onSuccessUrl . '" type="hidden" name="su">
                                                    <input value="' . $onFailureUrl . '" type="hidden" name="fu">
                                                    <button class="silver-btn" title="Pay via eSewa" type="submit"><img src="'.$paymentpartner.'"></button>
                                                    </form>';
                                                        if ($payment_type == "Paypal") {                                                       
                                                echo'<div style="width:99%;" id="paypal-button-container"></div> 
                                                <script src="https://www.paypal.com/sdk/js?client-id=AewYHDSh-Vue_sRKeDe4kY7L7eK24L91m-WPqggZUcZtoCXYE9fs-QEUL-ndGql21tvXKUIeD3nurkbX&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>                                                                                               
                                                <script src="paypal.js"></script>
                                                ';                                                
                                                        }
                                                        else if ($payment_type == "COD"){
                                                            echo "Cash On Delivery";
                                                        }
                                                        else if($payment_type == "Khalti"){
                                                            echo'
                                                            <button class="silver-btn viaKhalti" title="Pay via Khalti"><img src="'.$paymentpartner.'"></button>
                                                            ';
                                                        }
                                                        
                                                   echo' </td>
                                                </tr>                                                  
                                                <tr>
                                                    <th><i class="fas fa-handshake"></i> Other options:</th>
                                                    <td>
                                                    <div class="holdpaymentpartners">                                                        
                                                        <div class="row">';                                                           
                                                        if ($payment_type != "Paypal") {
                                                            echo'<div class="col-md-4 paymentpartners paypal">
                                                                <img src="'.$location.'paypal.png" alt="payment partners">
                                                            </div>';
                                                        } 
                                                         if ($payment_type != "Esewa") {
                                                            echo'<div class="col-md-4 paymentpartners esewa">
                                                                <img src="'.$location.'esewa.png" alt="payment partners">
                                                            </div>';
                                                        }
                                                          if ($payment_type != "Khalti") {
                                                             echo'<div class="col-md-4 paymentpartners khalti">
                                                            <img src="'.$location.'khalti.png" alt="payment partners">
                                                            </div>';
                                                         }
                                                            echo'
                                                        </div>
                                                    </div>
                                                    </td>
                                                </tr>';  
                                            }
                                            ?>                                              
                                            </table>                                                                                                                                             
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-7 col-12">
                            <div class="card">
                                <div class="card-header mb-2 pb-0">
                                    <p class="card-text text-center mt-2 space">ORDERED PRODUCTS</p>
                                    <hr class="my-0">
                                </div>
                                <div class="card-body pt-1">
                                    <?php

                                    $subtotal = 0;
                                    while ($row = mysqli_fetch_assoc($getOrderProductsResult)) {
                                        $subtotal = $subtotal + $row['total_price'];
                                        echo '<div class="row justify-content-between">
                                <div class="col-auto col-md-7">
                                    <div class="media flex-column flex-sm-row"> <img class=" img-fluid" src="admin/images/products/' . $row['sold_by'] . '/' . $row['image_folder_key'] . '/' . $row['image_name'] . '" width="62" height="62">
                                        <div class="media-body my-auto">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <p class="ml-2"><b>' . $row['name'] . '</b></p><small class="text-muted">Category: ' . $row['category'] . '</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" pl-0 flex-sm-col col-auto my-auto">
                                    <p class="boxed-1">x' . $row['quantity'] . '</p>
                                </div>
                                <div class=" pl-0 flex-sm-col col-auto my-auto ">
                                    <p><b>Rs ' . $row['total_price'] . '</b></p>
                                </div>
                                </div>
                                <hr class="my-2">';
                                    } ?>
                                    <div class="row ">
                                        <div class="col">
                                            <div class="row justify-content-between">
                                                <div class="col-4">
                                                    <p class="mb-1"><b>Subtotal</b></p>
                                                </div>
                                                <div class="flex-sm-col col-auto">
                                                    <p class="mb-1"><b>Rs <?php echo $subtotal; ?></b></p>
                                                </div>
                                            </div>
                                            <div class="row justify-content-between">
                                                <div class="col">
                                                    <p class="mb-1"><b>Shipping</b></p>
                                                </div>
                                                <div class="flex-sm-col col-auto">
                                                    <p class="mb-1"><b>0</b></p>
                                                </div>
                                            </div>
                                            <div class="row justify-content-between">
                                                <div class="col-4">
                                                    <p><b>Total</b></p>
                                                </div>
                                                <div class="flex-sm-col col-auto">
                                                    <p class="mb-1"><b>Rs <?php echo $subtotal; ?></b></p>
                                                </div>
                                            </div>
                                            <hr class="my-0">
                                        </div>
                                    </div>
                                    <div class="row my-4 justify-content-center">
                                        <div class="col-md-8"><button type="button" class="btn silver-btn">SHOP MORE</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 justify-content-center">
                        <div class="col-md-11">
                            <div class="card">
                            <div class="card-header pb-0">
                            <p class="card-text text-center mt-2 space">
                                <?php
                                if ($shippingid != null) {
                                    echo 'BILLING DETAILS';
                                } else {
                                    echo 'BILLING & SHIPPING DETAILS';
                                }
                                ?>
                            </p>         
                            <hr class="my-0">                           
                            </div>
                            <div class="card-body">                                                        
                            <?php
                            $getBillingDetails = "Select * from order_billing_info where info_id = '$billingid'";
                            $getBillingDetailsQuery = mysqli_query($conn, $getBillingDetails);
                            while ($row = mysqli_fetch_assoc($getBillingDetailsQuery)) {
                                echo '<table class="table table-responsive table-hover">
                                                <tr><th><i class="fas fa-user"></i> Name </th><td>' . $row['firstname'] . ' ' . $row['lastname'] . '</td></tr>
                                                <tr><th><i class="fas fa-envelope"></i> Email Address </th><td>' . $row['email_address'] . '</td></tr>
                                                <tr><th><i class="fas fa-phone-alt"></i> Contact </th><td>' . $row['phone_number'] . '</td></tr>
                                                <tr><th><i class="fas fa-street-view"></i> Address </th><td>' . $row['address_one'] . ', ' . $row['address_two'] . ', ' . $row['postal_code'] . '</td></tr>
                                                <tr><th><i class="fas fa-flag"></i> Country </th><td>' . $row['country'] . '&#160&#160<img src="img/flags/' . strtolower($row['country']) . '.png"</td></tr>								                                                                                                  
                                                </table>';
                            }
                            ?>                            
                            </div>     
                            </div>                       
                        </div>
                    </div>                   
                    <?php
                    if ($shippingid != null) {
                        echo '<div class="row mt-4 justify-content-center">
                                    <div class="col-md-11">
                                    <div class="card">
                                    <div class="card-header pb-0">
                                    <p class="card-text text-center mt-2 space">
                                    SHIPPING DETAILS                  
                                    </p>
                                    <hr class="my-0">
                                    </div>                            
                                    <div class="card-body">';                                        
                                        $getShippingInfo = "Select * from order_shipping_info where shipping_info_id = '$shippingid'";
                                        $getShippingInfoQuery = mysqli_query($conn, $getShippingInfo);
                                        while ($row = mysqli_fetch_assoc($getShippingInfoQuery)) {
                                            echo '<table class="table table-responsive table-hover">
                                                                <tr><th><i class="fas fa-user"></i> Name </th><td>' . $row['fullname'] . '</td></tr>
                                                                <tr><th><i class="fas fa-envelope"></i> Email Address </th><td>' . $row['email_address'] . '</td></tr>
                                                                <tr><th><i class="fas fa-phone-alt"></i> Contact </th><td>' . $row['phone_number'] . '</td></tr>
                                                                <tr><th><i class="fas fa-street-view"></i> Address </th><td>' . $row['address_one'] . ', ' . $row['address_two'] . ', ' . $row['postal_code'] . '</td></tr>
                                                                <tr><th><i class="fas fa-flag"></i> Country </th><td>' . $row['country'] . '&#160&#160<img src="img/flags/' . strtolower($row['country']) . '.png"</td></tr>                                                                
                                                                </table>';
                                        }                                        
                                echo '                                
                                </div>
                                </div>
                                </div>
                                </div>';                        
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Footer Area -->
    <?php
    include "layouts/footer.php";
    ?>
    <!-- /End Footer Area -->

    <!-- Jquery -->
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery-migrate-3.0.0.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js" integrity="sha512-pBoUgBw+mK85IYWlMTSeBQ0Djx3u23anXFNQfBiIm2D8MbVT9lr+IxUccP8AMMQ6LCvgnlhUCK3ZCThaBCr8Ng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/js/bootstrap-show-notification.js"></script>
    <!-- Color JS -->
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>    
    <!-- Slicknav JS -->
    <script src="assets/js/slicknav.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="assets/js/owl-carousel.js"></script>
    <!-- Magnific Popup JS -->
    <script src="assets/js/magnific-popup.js"></script>
    <!-- Fancybox JS -->
    <script src="assets/js/facnybox.min.js"></script>
    <!-- Waypoints JS -->
    <script src="assets/js/waypoints.min.js"></script>
    <!-- Countdown JS -->
    <script src="assets/js/finalcountdown.min.js"></script>
    <!-- Nice Select JS -->
    <script src="assets/js/nicesellect.js"></script>
    <!-- Ytplayer JS -->
    <script src="assets/js/ytplayer.min.js"></script>
    <!-- Flex Slider JS -->
    <script src="assets/js/flex-slider.js"></script>
    <!-- ScrollUp JS -->
    <script src="assets/js/scrollup.js"></script>
    <!-- Onepage Nav JS -->
    <script src="assets/js/onepage-nav.min.js"></script>
    <!-- Easing JS -->
    <script src="assets/js/easing.js"></script>
    <!-- Active JS -->
    <script src="assets/js/active.js"></script>
    <script src="payment.js"></script>
    <script src="assets/js/orderdetail.js"></script>
</body>

</html>