<?php
include('database/connect.php');
$active = "order";
if(!isset($_SESSION['id'])){
header("Location: index.php");
}
if(isset($_GET['i'])){
    if($_GET['i']==""){
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
    $sql = "Select * from orders where id = '$orderid' and user_id = '$userid'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $exist = true;
    }
    while($row = mysqli_fetch_assoc($result)){
        $billingid = $row['billing_address_id'];
        $orderdate = $row['order_date'];
        $payment_type = $row['payment_type'];
        $status = $row['status'];
        if($row['shipping_address_id'] != "-"){
            $shippingid = $row['shipping_address_id'];
        }

    }
}
else{
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
                        <div class="row justify-content-start ">
                            <div class="col">                                                 
                            <h4>Order No: <?php if($exist){echo $orderid;} ?></h4>
                        </div>
                        </div>
                    </div>
                    <div class="col-auto"> <img class="irc_mi img-fluid bell" src="https://i.imgur.com/uSHMClk.jpg" width="30" height="30"> </div>
                </div>                
                <div class="row justify-content-around">
                    <div class="col-md-5 col-12">
                        <div class="card border-0">
                            <div class="card-header card-header-dark pb-0">                                
                                <p class="card-text mt-2 space">ORDER DETAILS</p>
                                <hr class="my-0">
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <div class="col-12 mt-0">
                                        <table class="table table-hover table-responsive">
                                            <tr><th><i class="fas fa-calendar-alt"></i> Order Date</th><td>
                                                <?php 
                                                require('formatdate.php'); 
                                                echo formatDate($orderdate).' at '.formatTime($orderdate); 
                                                ?>
                                            </td></tr>
                                            <tr><th><i class="fas fa-money-check-alt"></i> Payment Type</th><td><?php echo $payment_type; ?></td></tr>
                                            <tr><th><i class="fas fa-info-circle"></i> Order Status</th><td><?php echo $status; ?></td></tr>
                                        </table>                                        
                                    </div>                                   
                                </div>
                                <div class="row mt-4">
                                    <div class="col">
                                        <p class="text-muted mb-2">
                                        <?php
                                        if($shippingid!=null){
                                            echo'BILLING DETAILS';
                                        }
                                        else{
                                            echo'BILLING & SHIPPING DETAILS';
                                        }
                                        ?>
                                        </p>
                                        <hr class="mt-0">
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-12 mt-0">                                                                                                                                   
                                            <?php  
                                            $getBillingDetails = "Select * from order_billing_info where info_id = '$billingid'";
                                            $getBillingDetailsQuery = mysqli_query($conn, $getBillingDetails);
                                            while($row = mysqli_fetch_assoc($getBillingDetailsQuery)){
                                                echo'<table class="table table-responsive table-hover">
                                                <tr><th><i class="fas fa-user"></i> Name </th><td>'.$row['firstname'].' '.$row['lastname'].'</td></tr>
                                                <tr><th><i class="fas fa-envelope"></i> Email Address </th><td>'.$row['email_address'].'</td></tr>
                                                <tr><th><i class="fas fa-phone-alt"></i> Contact </th><td>'.$row['phone_number'].'</td></tr>
                                                <tr><th><i class="fas fa-street-view"></i> Address </th><td>'.$row['address_one'].', '.$row['address_two'].', '.$row['postal_code'].'</td></tr>
                                                <tr><th><i class="fas fa-flag"></i> Country </th><td>'.$row['country'].'&#160&#160<img src="img/flags/'.strtolower($row['country']).'.png"</td></tr>								                                                                                                  
                                                </table>';
                                            }
                                            ?>                                                                                                                    
                                    </div>                                   
                                </div>
                                <?php 
                                // <div class="form-group"> <label for="NAME" class="small text-muted mb-1">NAME ON CARD</label> <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="BBBootstrap Team"> </div>
                                // <div class="form-group"> <label for="NAME" class="small text-muted mb-1">CARD NUMBER</label> <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="4534 5555 5555 5555"> </div>
                                // <div class="row no-gutters">
                                //     <div class="col-sm-6 pr-sm-2">
                                //         <div class="form-group"> <label for="NAME" class="small text-muted mb-1">VALID THROUGH</label> <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="06/21"> </div>
                                //     </div>
                                //     <div class="col-sm-6">
                                //         <div class="form-group"> <label for="NAME" class="small text-muted mb-1">CVC CODE</label> <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="183"> </div>
                                //     </div>
                                // </div>
                                // <div class="row mb-md-5">
                                //     <div class="col"> <button type="button" name="" id="" class="btn btn-lg btn-block ">PURCHASE $37 SEK</button> </div>
                                // </div>
                                if($shippingid!=null){
                                    echo'<div class="row mt-4">
                                    <div class="col">
                                        <p class="text-muted mb-2">SHIPPING DETAILS</p>
                                        <hr class="mt-0">
                                    </div>
                                </div>';  
                                echo'<div class="row justify-content-between">
                                    <div class="col-12 mt-0">
                                        <ul>';                                                                                    
                                            $getShippingInfo= "Select * from order_shipping_info where shipping_info_id = '$shippingid'";
                                            $getShippingInfoQuery = mysqli_query($conn, $getShippingInfo);
                                            while($row = mysqli_fetch_assoc($getShippingInfoQuery)){
                                                echo'<table class="table table-responsive table-hover">
                                                <tr><th><i class="fas fa-user"></i> Name </th><td>'.$row['fullname'].'</td></tr>
                                                <tr><th><i class="fas fa-envelope"></i> Email Address </th><td>'.$row['email_address'].'</td></tr>
                                                <tr><th><i class="fas fa-phone-alt"></i> Contact </th><td>'.$row['phone_number'].'</td></tr>
                                                <tr><th><i class="fas fa-street-view"></i> Address </th><td>'.$row['address_one'].', '.$row['address_two'].', '.$row['postal_code'].'</td></tr>
                                                <tr><th><i class="fas fa-flag"></i> Country </th><td>'.$row['country'].'&#160&#160<img src="img/flags/'.strtolower($row['country']).'.png"</td></tr>								                                                                                                  
                                                </table>';                                          
                                            }                                                                                                                                                                    
                                        echo'</ul>
                                    </div>                                   
                                </div>';                        
                                }
                                ?>                                                                
                            </div>

                        </div>
                    </div>
                    <div class="col-md-5 col-12">
                        <div class="card border-0 ">
                        <div class="card-header card-header-dark mb-2 pb-0">                                
                                <p class="card-text mt-2 space">ORDERED PRODUCTS</p>
                                <hr class="my-0">
                            </div>                    
                            <div class="card-body pt-1">
                            <?php
                    $getOrderProducts = "Select p.name,p.image_name,p.image_folder_key,p.sold_by, p.code, p.category, o.price, o.quantity, o.total_price FROM order_item o, product p where o.order_id = '$orderid' and o.product_code = p.code";                            
                    $getOrderProductsResult = mysqli_query($conn, $getOrderProducts);
                    $subtotal = 0;
                    while($row = mysqli_fetch_assoc($getOrderProductsResult)){
                        $subtotal = $subtotal + $row['total_price'];
                        echo'<div class="row justify-content-between">
                        <div class="col-auto col-md-7">
                            <div class="media flex-column flex-sm-row"> <img class=" img-fluid" src="admin/images/products/'.$row['sold_by'].'/'.$row['image_folder_key'].'/'.$row['image_name'].'" width="62" height="62">
                                <div class="media-body my-auto">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <p class="ml-2"><b>'.$row['name'].'</b></p><small class="text-muted">Category: '.$row['category'].'</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" pl-0 flex-sm-col col-auto my-auto">
                            <p class="boxed-1">x'.$row['quantity'].'</p>
                        </div>
                        <div class=" pl-0 flex-sm-col col-auto my-auto ">
                            <p><b>Rs '.$row['total_price'].'</b></p>
                        </div>
                    </div>
                    <hr class="my-2">';
                    }?>                                                          
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
                                <div class="row mb-5 mt-4 ">
                                    <div class="col-md-7 col-lg-6 mx-auto"><button type="button" class="btn btn-block btn-outline-primary btn-lg">SHOP MORE</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
	<!-- Start Footer Area -->
	<?php
	include"layouts/footer.php";
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
	
    <script src="assets/js/orderdetail.js"></script>	
</body>
</html>