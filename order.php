<?php
include('database/connect.php');
if(!isset($_SESSION['email'])){
header("Location: index.php");
}
if(isset($_GET['i'])){
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
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Magnific Popup -->
    <link rel="stylesheet" href="css/magnific-popup.min.css">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.css">
	<!-- Fancybox -->
	<link rel="stylesheet" href="css/jquery.fancybox.min.css">
	<!-- Themify Icons -->
    <link rel="stylesheet" href="css/themify-icons.css">
	<!-- Nice Select CSS -->
    <link rel="stylesheet" href="css/niceselect.css">
	<!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
	<!-- Flex Slider CSS -->
    <link rel="stylesheet" href="css/flex-slider.min.css">
	<!-- Owl Carousel -->
    <link rel="stylesheet" href="css/owl-carousel.css">
	<!-- Slicknav -->
    <link rel="stylesheet" href="css/slicknav.min.css">
	
	<!-- custom StyleSheet -->
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="order.css">
    <link rel="stylesheet" href="css/responsive.css">


	
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
							<li class="active"><a href="order.php">Order</a></li>
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
                            <h2>Order id: <?php if($exist){echo $orderid;} ?></h2>
                        </div>
                        </div>
                    </div>
                    <div class="col-auto"> <img class="irc_mi img-fluid bell" src="https://i.imgur.com/uSHMClk.jpg" width="30" height="30"> </div>
                </div>                
                <div class="row justify-content-around">
                    <div class="col-md-5">
                        <div class="card border-0">
                            <div class="card-header pb-0">
                                <h2 class="card-title space ">Order placed</h2>
                                <p class="card-text text-muted mt-4 space">ORDER DETAILS</p>
                                <hr class="my-0">
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <div class="col-auto mt-0">
                                        <ul>
                                        <li>Order Date: <?php echo $orderdate; ?></li>
                                        <li>Payment Type: <?php echo $payment_type; ?></li>
                                        <li>Order Payment: <?php echo $status; ?></li>
                                        </ul>
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
                                    <div class="col-auto mt-0">
                                        <ul>
                                            <?php  
                                            $getBillingDetails = "Select * from billing_info where info_id = '$billingid' and user_id = '$userid'";
                                            $getBillingDetailsQuery = mysqli_query($conn, $getBillingDetails);
                                            while($row = mysqli_fetch_assoc($getBillingDetailsQuery)){
                                                echo'<li>Customer Name: '.$row['firstname'].' '.$row['lastname'].'</li>';        
                                                echo'<li>Phone Number: '.$row['phone_number'].'</li>';
                                                echo'<li>Country: '.$row['country'].'</li>';
                                                echo'<li>Address One: '.$row['address_one'].'</li>';
                                                echo'<li>Address Two: '.$row['address_two'].'</li>';
                                                echo'<li>Postal Code: '.$row['postal_code'].'</li>';
                                            }
                                            ?>
                                                                                
                                        </ul>
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
                                    <div class="col-auto mt-0">
                                        <ul>';                                                                                    
                                            $getShippingInfo= "Select * from shipping_info where shipping_info_id = '$shippingid'";
                                            $getShippingInfoQuery = mysqli_query($conn, $getShippingInfo);
                                            while($row = mysqli_fetch_assoc($getShippingInfoQuery)){
                                                echo'<li>Customer Name: '.$row['fullname'].'</li>';        
                                                echo'<li>Phone Number: '.$row['phone_number'].'</li>';
                                                echo'<li>Country: '.$row['country'].'</li>';
                                                echo'<li>Address One: '.$row['address_one'].'</li>';
                                                echo'<li>Address Two: '.$row['address_two'].'</li>';
                                                echo'<li>Postal Code: '.$row['postal_code'].'</li>';                                               
                                            }                                                                                                                                                                    
                                        echo'</ul>
                                    </div>                                   
                                </div>';                        
                                }
                                ?>                                
                                <div class="row mt-4">
                                    <div class="col">
                                        <p class="text-muted mb-2">PAYMENT DETAILS</p>
                                        <hr class="mt-0">
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-auto mt-0">
                                        <ul>
                                            <?php                                           
                                            $getPayment = "Select * from payment where order_id = '$orderid' and user_id = '$userid'";
                                            $getPaymentQuery = mysqli_query($conn, $getPayment);
                                            while($row = mysqli_fetch_assoc($getPaymentQuery)){
                                                echo'<li>Payment Status: '.$row['status'].'</li>';                                                
                                            }                                                                                                                        
                                            ?>
                                        </ul>
                                    </div>                                   
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card border-0 ">
                            <div class="card-header card-2">
                                <p class="card-text text-muted mt-md-4 mb-2 space">YOUR ORDER <span class=" small text-muted ml-2 cursor-pointer"></span> </p>
                                <hr class="my-2">
                            </div>                      
                            <div class="card-body pt-0">
                            <?php
                    $getOrderProducts = "Select p.name,p.image_name,p.sold_by, p.code, p.category, o.price, o.quantity, o.total_price FROM order_item o, product p where o.order_id = '$orderid' and o.product_id = p.id";                            
                    $getOrderProductsResult = mysqli_query($conn, $getOrderProducts);
                    $subtotal = 0;
                    while($row = mysqli_fetch_assoc($getOrderProductsResult)){
                        $subtotal = $subtotal + $row['total_price'];
                        echo'<div class="row justify-content-between">
                        <div class="col-auto col-md-7">
                            <div class="media flex-column flex-sm-row"> <img class=" img-fluid" src="admin/images/products/'.$row['sold_by'].'/'.$row['image_name'].'" width="62" height="62">
                                <div class="media-body my-auto">
                                    <div class="row ">
                                        <div class="col-auto">
                                            <p class="mb-0"><b>'.$row['name'].'</b></p><small class="text-muted">Category: '.$row['category'].'</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" pl-0 flex-sm-col col-auto my-auto">
                            <p class="boxed-1">'.$row['quantity'].'</p>
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
	<!-- Start Shop Newsletter  -->
	<section class="shop-newsletter section">
		<div class="container">
			<div class="inner-top">
				<div class="row">
					<div class="col-lg-8 offset-lg-2 col-12">
						<!-- Start Newsletter Inner -->
						<div class="inner">
							<h4>Newsletter</h4>
							<p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
							<form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
								<input name="EMAIL" placeholder="Your email address" required="" type="email">
								<button class="btn">Subscribe</button>
							</form>
						</div>
						<!-- End Newsletter Inner -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Newsletter -->
	
	
	
	
	<!-- Start Footer Area -->
	<?php
	include"layouts/footer.php";
	?>
	<!-- /End Footer Area -->
	
	<!-- Jquery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<!-- Popper JS -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js" integrity="sha512-pBoUgBw+mK85IYWlMTSeBQ0Djx3u23anXFNQfBiIm2D8MbVT9lr+IxUccP8AMMQ6LCvgnlhUCK3ZCThaBCr8Ng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js/bootstrap-show-notification.js"></script>
	<!-- Color JS -->
	<script src="js/colors.js"></script>
	<!-- Slicknav JS -->
	<script src="js/slicknav.min.js"></script>
	<!-- Owl Carousel JS -->
	<script src="js/owl-carousel.js"></script>
	<!-- Magnific Popup JS -->
	<script src="js/magnific-popup.js"></script>
	<!-- Fancybox JS -->
	<script src="js/facnybox.min.js"></script>
	<!-- Waypoints JS -->
	<script src="js/waypoints.min.js"></script>
	<!-- Countdown JS -->
	<script src="js/finalcountdown.min.js"></script>
	<!-- Nice Select JS -->
	<script src="js/nicesellect.js"></script>
	<!-- Ytplayer JS -->
	<script src="js/ytplayer.min.js"></script>
	<!-- Flex Slider JS -->
	<script src="js/flex-slider.js"></script>
	<!-- ScrollUp JS -->
	<script src="js/scrollup.js"></script>
	<!-- Onepage Nav JS -->
	<script src="js/onepage-nav.min.js"></script>
	<!-- Easing JS -->
	<script src="js/easing.js"></script>
	<!-- Active JS -->
	<script src="js/active.js"></script>	
	
</body>
</html>