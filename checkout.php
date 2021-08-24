<?php
include('database/connect.php');
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
		
		<!-- Header -->
		<?php
	include"layouts/navbar.php";
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
								<li class="active"><a href="checkout.php">Checkout</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
				
		<!-- Start Checkout -->
		<section class="shop checkout section">
			<div class="container">
				<div class="row"> 
					<div class="col-lg-8 col-12">
						<div class="checkout-form">
							<h2>Make Your Checkout Here</h2>
							<p>Add Billing and Shipping Details</p>
							<!-- Form -->
							<form class="form" name="defaultaddress" method="post">
								<div class="row">									
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>First Name<span>*</span></label>
											<input type="text" id="billingfname" name="fname" placeholder="" required="required">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Last Name<span>*</span></label>
											<input type="text" id="billinglname" name="lname" placeholder="" required="required">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Email Address<span>*</span></label>
											<input type="email" id="billingemail" name="email" placeholder="" required="required">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Phone Number<span>*</span></label>
											<input type="number" id="billingphone" name="number" placeholder="" required="required">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Country<span>&#160</span></label>
											<img id="billingcountryflag" src="img/flags/np.png">
											<select name="country_name" id="country">
											<?php
												$getCountries = "Select countries_iso_code, countries_name from countries";
                                                $getCountriesQuery = mysqli_query($conn, $getCountries);
                                                while($getCountriesRows = mysqli_fetch_assoc($getCountriesQuery)){                                                                                                   
                                                        echo '<option'; if($getCountriesRows['countries_iso_code'] == "NP"){echo " selected";} echo' value='.$getCountriesRows['countries_iso_code'].'>'.$getCountriesRows['countries_name'].'</option>';                                                    
                                                }
												?>
											</select>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Address Line 1<span>*</span></label>
											<input type="text" id="billingaddressone" name="address" placeholder="" required="required">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Address Line 2<span>*</span></label>
											<input type="text" id="billingaddresstwo" name="address" placeholder="" required="required">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Postal Code<span>*</span></label>
											<input type="text" id="billingpostalcode" name="post" placeholder="" required="required">
										</div>
									</div>									
									<div class="col-12">
										<div class="form-group create-account">
											<input id="cbox" type="checkbox">
											<label>Different Shipping Details ?</label>
										</div>
									</div>		
								</div>														
								<div id="shippingInfo"  class="row">
									<div style="margin:8px 0px;" class="col-lg-12 col-md-12 col-12">										
											<h4>Add Shipping Details</h4>										
									</div>	
									<div class="col-lg-12 col-md-12 col-12">
										<div class="form-group">
											<label>Full Name<span>*</span></label>
											<input type="text" id="shippingname" name="shippingname" placeholder="" required="required">
										</div>
									</div>				
									<div class="col-lg-6 col-md-6 col-12">			
									<div class="form-group">							
									<label>Email Address<span>*</span></label>
											<input type="text"id="shippingemail" name="shippingemail" placeholder="" required="required">			
									</div>							
									</div>															
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Phone Number<span>*</span></label>
											<input type="number"id="shippingphone" name="shippingnumber" placeholder="" required="required">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Country<span>&#160</span></label>
											<img id="shippingcountryflag" src="img/flags/np.png">
											<select name="shippingcountry_name" id="shippingcountry">
												<?php
												$getCountries = "Select countries_iso_code, countries_name from countries";
                                                $getCountriesQuery = mysqli_query($conn, $getCountries);
                                                while($getCountriesRows = mysqli_fetch_assoc($getCountriesQuery)){                                                                                                   
                                                        echo '<option'; if($getCountriesRows['countries_iso_code'] == "NP"){echo " selected";} echo' value='.$getCountriesRows['countries_iso_code'].'>'.$getCountriesRows['countries_name'].'</option>';                                                    
                                                }
												?>
											</select>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Address Line 1<span>*</span></label>
											<input type="text" id="shippingaddressone" name="shippingaddressone" placeholder="" required="required">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Address Line 2<span>*</span></label>
											<input type="text" id="shippingaddresstwo" name="shippingaddresstwo" placeholder="" required="required">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Postal Code<span>*</span></label>
											<input type="text" id="shippingpostalcode" name="shippingpostalcode" placeholder="" required="required">
										</div>
									</div>																	
								</div>								
								<input type="submit" hidden name="submitDetail" id="submitButton">	
							</form>
							<!--/ End Form -->
						</div>
					</div>
					<div class="col-lg-4 col-12">
						<div class="order-details">
							<!-- Order Widget -->
							<div class="single-widget">
								<h2>CART  TOTALS</h2>
								<div class="content">
									<ul>
										<?php
										$no_item = false;
										if(isset($_SESSION['cartid'])){
											$cart_id = $_SESSION['cartid'];
											$sql = "Select p.price, p.discount,c.quantity from product p, product_in_cart c where c.cart_id = '$cart_id' and p.code = c.product_code";
										$result = mysqli_query($conn, $sql);
										$total = 0;
										$shippingfee = 0;
										if(mysqli_num_rows($result)>0){
										$no_item = false;
										while($row=mysqli_fetch_assoc($result)){											
											if($row['discount']!=0){
												$updatedPrice = $row['price'] - $row['discount'];								
											}
											else{
												$updatedPrice = $row['price'];								
											}							
											$subtotal = $row['quantity'] * $updatedPrice;							
											$total = $total + $subtotal;		
										}
										echo'<li>Sub Total<span id="subTotalCheckout">Rs '.$total.'</span></li>
										<li>(+) Shipping<span id="shippingCheckoutFee">Rs '.$shippingfee.'</span></li>
										<li class="last">Total<span id="TotalCheckout">Rs '.($total+$shippingfee).'</span></li>';
										}
										else{
											$no_item = true;
											echo'<li>No items in cart</li>';
										}																														
									}
									else{
										$no_item = true;
										echo'<li>Login to view cart products.</li>';
									}
										?>										
									</ul>
								</div>
							</div>
							<!--/ End Order Widget -->
							<!-- Order Widget -->
							<div class="single-widget">
								<h2>Payments</h2>
								<div class="content">									
									<div class="checkbox">
									<p style="color: #ed1c24;" id="paymenterror"></p>
										<li style="list-style-type: none;"><input name="payment" id="1" type="radio" value="Esewa"> Esewa</li>										
										<li style="list-style-type: none;"><input name="payment" id="2" type="radio" value="COD"> Cash On Delivery</li>
										<li style="list-style-type: none;"><input name="payment" id="3" type="radio" value="Paypal"> PayPal</li>
									</div>
								</div>
							</div>
							<!--/ End Order Widget -->
							<!-- Payment Method Widget -->
							<div class="single-widget payement">
								<div class="content">
									<img src="images/payment-method.png" alt="#">
								</div>
							</div>
							<!--/ End Payment Method Widget -->
							<!-- Button Widget -->
							<?php
							if(!$no_item){
								echo'<div class="single-widget get-button">
								<div class="content">
									<div class="button">
										<p style="cursor:default;" id="placeorder" class="btn">place order</p>
									</div>
								</div>
							</div>';
							}
							?>							
							<!--/ End Button Widget -->
						</div>
					</div>
				</div>
				
			</div>
		</section>
		<!--/ End Checkout -->
		
		<!-- Start Shop Services Area  -->
		<section class="shop-services section home">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Start Single Service -->
						<div class="single-service">
							<i class="ti-rocket"></i>
							<h4>Free shiping</h4>
							<p>Orders over $100</p>
						</div>
						<!-- End Single Service -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Start Single Service -->
						<div class="single-service">
							<i class="ti-reload"></i>
							<h4>Free Return</h4>
							<p>Within 30 days returns</p>
						</div>
						<!-- End Single Service -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Start Single Service -->
						<div class="single-service">
							<i class="ti-lock"></i>
							<h4>Sucure Payment</h4>
							<p>100% secure payment</p>
						</div>
						<!-- End Single Service -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Start Single Service -->
						<div class="single-service">
							<i class="ti-tag"></i>
							<h4>Best Peice</h4>
							<p>Guaranteed price</p>
						</div>
						<!-- End Single Service -->
					</div>
				</div>
			</div>
		</section>
		<!-- End Shop Services -->
		<!-- Button trigger modal -->
<!-- Button trigger modal -->
<button type="button" id="triggerConfirmation" style="display:none;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Launch static backdrop modal
</button>

<!-- Modal -->
<div  class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div style="padding:0px; margin:0px;" class="modal-header">
        <h5 class="modal-title" style="" id="staticBackdropLabel">Please confirm product and their quantity for your order.</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		  <div class="cart-data-in-checkout">
	  <table class="table shopping-summery">
						<thead>
							<tr class="main-hading">
								<th>PRODUCT</th>
								<th>NAME</th>
								<th class="text-center">UNIT PRICE</th>
								<th class="text-center">QUANTITY</th>
								<th class="text-center">TOTAL</th> 
								<th class="text-center"><i class="ti-trash remove-icon"></i></th>
							</tr>
						</thead>
						<tbody>
						<?php
						if(isset($_SESSION['cartid'])){
							$cart_id = 	$_SESSION['cartid'];							
						}						
						$sql = "Select p.id, c.id as productcartid, p.quantity_stock, p.code, p.name,p.sold_by, p.image_name, p.price, p.discount, p.description, c.quantity from product p, product_in_cart c where c.cart_id = '$cart_id' and p.code = c.product_code";
						$result = mysqli_query($conn, $sql);
						$total = 0;
						$totalDiscount = 0;
						$totalWithoutDiscount = 0;
						while($row=mysqli_fetch_assoc($result)){							
							$subtotal = 0;
							$description = substr($row['description'],0,50)."....";							
							$totalDiscount = $totalDiscount + ($row['discount']*$row['quantity']);
							$totalWithoutDiscount = $totalWithoutDiscount + ($row['quantity'] * $row['price']);
							if($row['discount']!=0){
								$updatedPrice = $row['price'] - $row['discount'];								
							}
							else{
								$updatedPrice = $row['price'];								
							}							
							$subtotal = $row['quantity'] * $updatedPrice;							
							$total = $total + $subtotal;							
							echo'<tr id="tablerow'.$row['productcartid'].'">
							<td class="image" data-title="No"><img src="admin/images/products/'.$row['sold_by'].'/'.$row['image_name'].'" alt="#"></td>
							<td class="product-des" data-title="Description">
								<p class="product-name"><a href="singleproduct.php?id='.$row['id'].'">'.$row['name'].'</a></p>
								<p class="product-des">'.$description.'</p>
							</td>
							<td class="price" data-title="Price"><span>Rs </span>';
							if($row['discount']!=0){								
								echo'<span style="color:red;text-decoration: line-through;">'.$row['price'].'</span>';
							}							
							echo'<br><span>'.$updatedPrice.'</span></td>
							<td class="price" hidden data-title="Price"><span>'.$updatedPrice.'</span></td>
							<td class="qty" data-title="Qty"><!-- Input Order -->
								<div class="input-group">
									<div class="button minus" id="minus'.$row['productcartid'].'">
										<button style="background:transparent !important;color:black;" type="button" class="btn btn-number" data-type="minus" data-field="quant['.$row['productcartid'].']">
											<i class="ti-minus"></i>
										</button>
									</div>
									<input type="text" value="'.$row['quantity_stock'].'" hidden id="stock'.$row['productcartid'].'">
									<input type="text" id="quantity'.$row['productcartid'].'" name="quant['.$row['productcartid'].']" class="input-number"  data-min="1" data-max="'.$row['quantity_stock'].'" value="'.$row['quantity'].'">
									<div class="button plus" id="plus'.$row['productcartid'].'">
										<button style="background:transparent !important;color:black;" type="button" class="btn btn-number" data-type="plus" data-field="quant['.$row['productcartid'].']">
											<i class="ti-plus"></i>
										</button>
									</div>
									<p style="margin-top:4px; display:none;" id="cartError'.$row['productcartid'].'">Error</p>
								</div>
								<!--/ End Input Order -->
							</td>
							<td class="total-amount" data-title="Total"><span id="subtotal'.$row['productcartid'].'">Rs '.$subtotal.'</span></td>
							<td class="action" data-title="Remove"><p style="cursor:pointer;" id="remove'.$row['productcartid'].'"><i class="ti-trash remove-icon"></i></p></td>
							<td>
							</td>
						</tr>';
						}
						?>												
						</tbody>
					</table>
	  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Wait</button>
        <button type="button" id="confirmOrder" class="btn btn-primary">Looks good</button>
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