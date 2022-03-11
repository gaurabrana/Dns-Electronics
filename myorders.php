<?php
include('database/connect.php');
if(!isset($_SESSION['email'])){
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
    
	<!-- Fancybox -->
	<link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
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
							<li class="active"><a href="myorders.php">My Orders</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>	
	<!-- Shopping Cart -->
	<div class="section">
		<div class="container">
        <div class="row">
                        <?php

                        function getOrderTotalAmountById($conn, $order_id){
                            $getTotalPrice = "Select sum(total_price) as total from order_item where order_id = '$order_id'";
                            $getTotalPriceExecute = mysqli_query($conn, $getTotalPrice);
                            $getTotalOrdered = mysqli_fetch_assoc($getTotalPriceExecute);
                            return $getTotalOrdered['total'];
                        }                        

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
                            
                            echo'<div class="col-md-12 orderLog">
                            <div class="card">
                                <div class="card-header">
                                <div class="row">                                
                                <div class="col-md-4 col-sm-4 col-6"><p class="card-category"><i class="fas fa-calendar-alt"></i> Date : '.$row['order_date'].'</p></div>
                                <div class="col-md-4 col-sm-4 col-6"><p style="font-weight:bold;"><i class="fas fa-paper-plane"></i> ORDER ID : '.$row['id'].'</p> </div>
                                <div class="col-md-4 col-sm-4 col-6"><a class="fullscreenmode" target="_blank" href="orderdetail.php?i='.$row['id'].'"><i class="fas fa-expand-arrows-alt"></i> Click to single page view</a></div>                                                            
                                </div>
                                </div>
                                <div class="card-body">        
                                <div class="row">
                                <div class="col-md-12">
                                <div class="table-responsive">
                                <table class="table table-hover ">
                                    <thead class="text-rose">
                                        <th>
                                        <i class="fas fa-shopping-basket"></i> Products
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
                                        <i class="fas fa-wallet"></i> Payment Type
                                        </th>
                                        <th>
                                        <i class="fas fa-file-invoice"></i> Invoice
                                        </th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a class="toggleData buttonData" data-bs-toggle="collapse" href="#getorderproducts'.$billingid.'" role="button" aria-expanded="false" aria-controls="getorderproducts'.$billingid.'">
                                            Expand more..
                                          </a></td>                                            
                                            <td>
                                            '.$row['status'].'
                                            </td>
                                            <td>
                                            <a class="toggleData buttonData" data-bs-toggle="collapse" href="#getorderbillingaddress'.$billingid.'" role="button" aria-expanded="false" aria-controls="getorderbillingaddress'.$billingid.'">
                                            Expand more..
                                          </a>                                         
                                            </td>
                                            <td>';
                                            if($sameshipping){
                                                echo'Same as billing address';
                                            }
                                            else{
                                                echo'<a class="toggleData buttonData" data-bs-toggle="collapse" href="#getordershippingaddress'.$billingid.'" role="button" aria-expanded="false" aria-controls="getordershippingaddress'.$billingid.'">
                                                Expand more..
                                              </a>';
                                            }                                            
                                            echo'</td>
                                            <td class="text">';                                                                                        
                                            echo "Rs ".getOrderTotalAmountById($conn, $order_id);
                                            echo'</td>
                                            <td>
                                                '.$row['payment_type'].'
                                            </td>
                                            <td class="invoice" id="viewinvoice'.$orderid.'">View invoice</td>
                                        </tr>                                        
                                    </tbody>
                                </table> 
                                </div>                                 
                                </div>
                                <div class="col-md-12">
                                        <div class="collapse" id="getorderproducts'.$billingid.'">
                                        <div class="card card-body table-responsive table-products">
                                        <p style = "font-size: 15px; font-weight:bold; text-align:center;">Ordered Products</p>                                                   
                                        <table class="table table-hover ">
                                            <thead class="text-danger">
                                            <th>Product</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            </thead>
                                            <tbody>';                      
                                            $getOrderedProducts = "Select oi.price, p.code, p.sold_by, oi.quantity, p.name, p.image_folder_key, p.image_name from orders o, order_item oi, product p where o.id = oi.order_id and oi.product_code = p.code and o.id = '$orderid'";
                                            $getOrderedProductsResult = mysqli_query($conn, $getOrderedProducts);
                                            if(mysqli_num_rows($getOrderedProductsResult) > 0){
                                                while($orderedProduct = mysqli_fetch_assoc($getOrderedProductsResult)){
                                                echo'<tr>
                                                <td width="120px" class="small-size"><img src="admin/images/products/'.$orderedProduct['sold_by'].'/'.$orderedProduct['image_folder_key'].'/'.$orderedProduct['image_name'].'" alt="#"></td>
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
                                </div>
                                <div class="col-md-12">
                                    <!---collapsibles start--->                              
                                    <div class="collapse" id="getorderbillingaddress'.$billingid.'">
                                    <div class="card card-body table-responsive table-products">
                                    <p style = "font-size: 15px; font-weight:bold; text-align:center;">Billing Details</p>                                 
                                    <table class="table  table-hover">
                                        <thead class="text-danger">
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
                                    </div>
                                </div>
                                <div class="col-md-12">';
                                if(!$sameshipping){
                                    echo'<div class="collapse" id="getordershippingaddress'.$billingid.'">
                                    <div class="card card-body table-responsive table-products">
                                    <p style = "font-size: 15px; font-weight:bold; text-align:center;">Shipping Details</pclass=>                                                   
                                    <table class="table  table-hover">
                                        <thead class="text-danger">
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
                                    </div>
                                  </div>';
                                  }                                                               
                        echo' </div>
                                </div>                                                  
                                </div>
                            </div>
                        </div>  ';
                        }
                        ?>                                              
                    </div>
		</div>
	</div>
	<!--/ End Shopping Cart -->
	
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
    <script src="assets/js/myorders.js"></script>	
	<!--custom page js -->	
</body>
</html>