<?php
include('database/connect.php');
$active = "cart";
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
							<li class="active"><a href="cart.php">Cart</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>	
	<!-- Shopping Cart -->
	<div class="shopping-cart section">
		<div class="container">
			<div class="row">
				<div class="col-12">			
					<!-- Shopping Summery -->
					<table class="table shopping-summery">
						<thead>
							<tr class="main-hading">
								<th>PRODUCT</th>
								<th>NAME</th>
								<th class="text-center">UNIT PRICE</th>
								<th class="text-center">QUANTITY</th>
								<th class="text-center">TOTAL</th> 
								<th class="text-center">REMOVE</th>
							</tr>
						</thead>
						<tbody>
						<?php
						if(isset($_SESSION['cartid'])){
							$cart_id = 	$_SESSION['cartid'];							
						}						
						$sql = "Select p.id,p.image_folder_key, c.id as productcartid, p.quantity_stock, p.code, p.name,p.sold_by, p.image_name, p.price, p.discount, p.description, c.quantity from product p, product_in_cart c where c.cart_id = '$cart_id' and p.code = c.product_code";
						$result = mysqli_query($conn, $sql);
						$total = 0;
						$totalDiscount = 0;
						$totalWithoutDiscount = 0;
						if(mysqli_num_rows($result)>0){
							$hasItems = true;
							while($row=mysqli_fetch_assoc($result)){							
								$subtotal = 0;
								$description = substr($row['description'],0,100)."....";							
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
								<td class="image" data-title="No"><img src="admin/images/products/'.$row['sold_by'].'/'.$row['image_folder_key'].'/'.$row['image_name'].'" alt="#"></td>
								<td class="product-des" data-title="Description">
									<p class="product-name"><a href="singleproduct.php?id='.$row['code'].'">'.$row['name'].'</a></p>
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
											<button type="button" class="btn btn-primary btn-number" data-type="minus" data-field="quant['.$row['productcartid'].']">
												<i class="ti-minus"></i>
											</button>
										</div>
										<input type="text" value="'.$row['quantity_stock'].'" hidden id="stock'.$row['productcartid'].'">
										<input type="text" id="quantity'.$row['productcartid'].'" name="quant['.$row['productcartid'].']" class="input-number"  data-min="1" data-max="'.$row['quantity_stock'].'" value="'.$row['quantity'].'">
										<div class="button plus" id="plus'.$row['productcartid'].'">
											<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant['.$row['productcartid'].']">
												<i class="ti-plus"></i>
											</button>
										</div>
										<p style="margin-top:4px; display:none;" id="cartError'.$row['productcartid'].'">Error</p>
									</div>
									<!--/ End Input Order -->
								</td>
								<td class="total-amount" data-title="Total"><span id="subtotal'.$row['productcartid'].'">Rs '.$subtotal.'</span></td>
								<td class="action" data-title="Remove"><p style="cursor:pointer;" id="remove'.$row['productcartid'].'"><i class="ti-trash remove-icon"></i></p></td>								
							</tr>';
							}
						}
						else{
							$hasItems = false;
							echo'<tr>
							<td>No Product</td>
							<td>No Product</td>
							<td>No Product</td>
							<td>No Product</td>
							<td>No Product</td>
							<td>-</td>
							</tr>';
						}						
						?>												
						</tbody>
					</table>
					<!--/ End Shopping Summery -->
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<!-- Total Amount -->
					<div class="total-amount">
						<div class="row">
							<div class="col-lg-8 col-md-5 col-12">
								<div class="left">
									<div class="coupon">
										<form action="#" target="_blank">
											<input name="Coupon" placeholder="Enter Your Coupon">
											<button class="btn">Apply</button>
										</form>
									</div>
									<div class="checkbox">
										<label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox"> Shipping (+10$)</label>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-7 col-12">
								<div class="right">
									<ul>
										<li>Cart Subtotal<span id="totalWithoutDiscount">Rs <?php echo $totalWithoutDiscount; ?></span></li>
										<li>Shipping<span>--</span></li>
										<li>You Save<span id="totalDiscount">Rs <?php echo $totalDiscount; ?></span></li>
										<li class="last">You Pay<span id="totalpayment">Rs <?php echo $total; ?></span></li>
									</ul>
									<div class="button5">
										<?php
											if($hasItems){
												echo'<a href="checkout.php" class="btn">Checkout</a>';
											}
										?>										
										<a href="products.php" class="btn">Continue shopping</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--/ End Total Amount -->
				</div>
			</div>
		</div>
	</div>
	<!--/ End Shopping Cart -->
			
	<!-- Start Shop Services Area  -->
	<section class="shop-services section">
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
	<!-- End Shop Newsletter -->
	
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
	<!--custom page js -->
	<script src="assets/js/cart.js"></script>
</body>
</html>