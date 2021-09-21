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
							<?php
							if(isset($_SESSION['id'])){
								$userid = $_SESSION['id'];
							}
							else{
								$userid = "notloggedin";
							}
							
							$hasDefaultAddresses = "Select * from billing_info where user_id = '$userid' and active = 'Yes'";
							$ExecutehasDefaultAddresses = mysqli_query($conn, $hasDefaultAddresses);
							if(mysqli_num_rows($ExecutehasDefaultAddresses) > 0){
								$getAddressDetails = mysqli_fetch_assoc($ExecutehasDefaultAddresses);
								$hasAddresses = true;
								echo'<p hidden id="newaddressbook">false</p>';
								$sameShipping = $getAddressDetails['shipping_info'] == "Same" ? true : false;
								echo '<p>You have set default billing and shipping details. See <a href="user/addressbook.php"><strong>Address Book</strong></a>.</p>';								
								echo'<table class="table table-responsive table-hover">
								<tr><th><i class="fas fa-user"></i> Name </th><td>'.$getAddressDetails['firstname'].' '.$getAddressDetails['lastname'].'</td></tr>
								<tr><th><i class="fas fa-envelope"></i> Email Address </th><td>'.$getAddressDetails['email_address'].'</td></tr>
								<tr><th><i class="fas fa-phone-alt"></i> Contact </th><td>'.$getAddressDetails['phone_number'].'</td></tr>
								<tr><th><i class="fas fa-street-view"></i> Address </th><td>'.$getAddressDetails['address_one'].', '.$getAddressDetails['address_two'].', '.$getAddressDetails['postal_code'].'</td></tr>
								<tr><th><i class="fas fa-flag"></i> Country </th><td>'.$getAddressDetails['country'].'&#160&#160<img src="img/flags/'.strtolower($getAddressDetails['country']).'.png"</td></tr>								                              
								<tr><th><i class="fas fa-shipping-fast"></i> Shipping Detail </th><td>';
								if($sameShipping){
								  echo "Same as billing detail";
							  }
							  else{
								  echo '<a data-bs-toggle="collapse" href="#showShipping'.$getAddressDetails['shipping_info'].'" role="button" aria-expanded="false" aria-controls="showShipping'.$getAddressDetails['shipping_info'].'" id="showShipping'.$getAddressDetails['info_id'].'" ><b>Expand more..</b></a>';
							  }     							   
								echo'</td></tr>                              
								</table>';
								if(!$sameShipping){
									echo'<div class="collapse" id="showShipping'.$getAddressDetails['shipping_info'].'"> 
									<table class="table table-responsive table-hover">';
								  $shippingid = $getAddressDetails['shipping_info'];
								  $getShippingDetail = "Select * from shipping_info where shipping_info_id = '$shippingid'";
								  $getShippingDetailQuery = mysqli_query($conn, $getShippingDetail);
								  while($getShippingDetailRows = mysqli_fetch_assoc($getShippingDetailQuery)){
								  $shippingfullname = $getShippingDetailRows['fullname'];
								  $shippingemail = $getShippingDetailRows['email_address'];
								  $shippingphone = $getShippingDetailRows['phone_number'];
								  $shippingcountry = $getShippingDetailRows['country'];
								  $shippingaddressone = $getShippingDetailRows['address_one'];
								  $shippingaddresstwo = $getShippingDetailRows['address_two'];
								  $shippingpostalcode = $getShippingDetailRows['postal_code'];								  
								}
								  echo'<tr><th><i class="fas fa-user"></i> Name </th><td>'.$shippingfullname.'</td></tr>
								  <tr><th><i class="fas fa-envelope"></i> Email Address </th><td>'.$shippingemail.'</td></tr>
								  <tr><th><i class="fas fa-phone-alt"></i> Contact </th><td>'.$shippingphone.'</td></tr>
								  <tr><th><i class="fas fa-street-view"></i> Address </th><td>'.$shippingaddressone.', '.$shippingaddresstwo.', '.$shippingpostalcode.'</td></tr>
								  <tr><th><i class="fas fa-flag"></i> Country </th><td>'.$shippingcountry.'&#160&#160<img src="img/flags/'.strtolower($shippingcountry).'.png"</td></tr>								                                                                              
								  </table>
									</div>
									';
								}								
							}
							else{
								$hasAddresses = false;
								echo'<p hidden id="newaddressbook">true</p>';
								if($userid != "notloggedin"){
									echo '<p>You have not set default billing and shipping details. </br></br><label>Set these detail default for all orders ??</label>
									<input type="checkbox" name="setdefault"> </p>';
								}
								else{
									echo"<p>Add billing and shipping details.</p>";
								}								
								echo'	<!-- Form -->												
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
												<select name="country_name" id="country">';
												
													$getCountries = "Select countries_iso_code, countries_name from countries";
													$getCountriesQuery = mysqli_query($conn, $getCountries);
													while($getCountriesRows = mysqli_fetch_assoc($getCountriesQuery)){                                                                                                   
															echo '<option'; if($getCountriesRows['countries_iso_code'] == "NP"){echo " selected";} echo' value='.$getCountriesRows['countries_iso_code'].'>'.$getCountriesRows['countries_name'].'</option>';                                                    
													}
													
												echo'</select>
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
											<label>Different Shipping Details ?</label>
											<input data-bs-toggle="collapse" href="#shippingInfo" role="button" aria-expanded="false" aria-controls="shippingInfo" id="cbox" type="checkbox">
												
											</div>
										</div>		
									</div>														
									
									<div id="shippingInfo" class="collapse">
									<div class="row">
									<div class="col-lg-12 col-md-12 col-12">
									<h5 style="text-align:center";>Add Shipping Details</h5>
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
												<select name="shippingcountry_name" id="shippingcountry">';
													
													$getCountries = "Select countries_iso_code, countries_name from countries";
													$getCountriesQuery = mysqli_query($conn, $getCountries);
													while($getCountriesRows = mysqli_fetch_assoc($getCountriesQuery)){                                                                                                   
															echo '<option'; if($getCountriesRows['countries_iso_code'] == "NP"){echo " selected";} echo' value='.$getCountriesRows['countries_iso_code'].'>'.$getCountriesRows['countries_name'].'</option>';                                                    
													}
													
												echo'</select>
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
									</div> 														
									<input type="submit" hidden name="submitDetail" id="submitButton">	
								</form>							
								<!--/ End Form -->';						
							}
							?>																							
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
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">     
      <div class="modal-body shopping-cart">
		  <div class="cart-data-in-checkout">
			  <h5 class="modal-title">Please confirm product and their quantity for your order.</h5>
	  <table class="table table-responsive shopping-summery">
						<thead>
							<tr class="main-hading">
								<th>PRODUCT</th>
								<th>NAME</th>
								<th class="text-center">UNIT PRICE</th>
								<th class="text-center">QUANTITY</th>
								<th class="text-center">TOTAL</th> 
								<th class="text-center">REMOVE</i></th>
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
								</div>
								<p style="margin-top:4px; display:none;" id="cartError'.$row['productcartid'].'">Error</p>
								<!--/ End Input Order -->
							</td>
							<td class="total-amount" data-title="Total"><span id="subtotal'.$row['productcartid'].'">Rs '.$subtotal.'</span></td>
							<td class="action" data-title="Remove"><p style="cursor:pointer;" id="remove'.$row['productcartid'].'"><i class="ti-trash remove-icon"></i></p></td>							
						</tr>';
						}
						?>												
						</tbody>
					</table>
	  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeModalBox">Wait</button>
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
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
	<!-- Color JS -->
	
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
	<!--custom page js -->
	<script src="js/cart.js"></script>	
	<script src="js/checkout.js"></script>
						
</body>
</html>