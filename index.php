<?php
require ('database/connect.php');
$show_collection = "homepage";
$active = "home";
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
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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
	<!-- Slider Area -->
	<section class="hero-slider">
		<!-- Single Slider -->
<!-- 

		<?php		
		$sql = "Select * from homepage_image where placing='heading'";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result)){
			$image = "img//homepage_image//".$row['image_name']."";
		}
		echo'style:"background-image: url('.$image.')"'; ?>  -->
		<div class="single-slider">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-lg-9 offset-lg-3 col-12">
						<div class="text-inner">
							<div class="row">
								<div class="col-lg-7 col-12">
									<div class="hero-text">
										<h1><span>UP TO 15% OFF </span>Home appliances</h1>
										<p>Get high quality branded products <br> Delivered at your door</p>
										<div class="button">
											<a href="products.php" class="btn">Shop Now!</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Single Slider -->
	</section>
	<!--/ End Slider Area -->
	
	<!-- Start Small Banner  -->
	<section class="small-banner section">
		<div class="container-fluid">
			<div class="row">
				<!-- Single Banner  -->
				<div class="col-lg-4 col-md-6 col-sm-6 col-12" id="holdBanner1" data-aos="fade-right" data-aos-duration="500">
					<div class="single-banner">
						<img style="transform:scaleX(-1);" src="img/Fridge.jpg" alt="#">
						<div class="content">
							<p>Summer Season Appliances</p>
							<h3>Refrigerators, <br> Air Conditioner</h3>							
							<a href="products.php?qc=summer">Discover Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
				<!-- Single Banner  -->
				<div class="col-lg-4 col-md-6 col-sm-6 col-12" id="holdBanner2" data-aos="fade-up" data-aos-duration="500">
					<div class="single-banner">
						<img src="https://cdn1.expertreviews.co.uk/sites/expertreviews/files/2020/09/best_electric_heater_-_delonghi_hsx2320.jpg?itok=aga5wPR3" alt="#">
						<div class="content">
							<p>Winter Season Appliances</p>
							<h3>Electric Heater, <br> Water geysers</h3>
							<a href="products.php?qc=winter">Shop Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
				<!-- Single Banner  -->
				<div class="col-lg-4 col-md-12 col-sm-12 col-12" id="holdBanner3" data-aos="flip-right" data-aos-duration="500">
					<div class="single-banner tab-height">
						<img src="https://hitek.fr/img/up_o/1751376525/hitek_35e9070c204335552ddadac47f540e87_1613239643.jpeg" alt="#">
						<div class="content">
							<p>Flash Sale</p>
							<h3>Discounted <br> Products</h3>
							<a href="products.php?qc=discount">Discover Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
			</div>
		</div>
	</section>
	<!-- End Small Banner -->
	
	<!-- Start Product Area -->
    <div class="product-area section">
            <div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h2>PRODUCT BRANDS</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="product-info">
							<div class="nav-main">
								<!-- Tab Nav -->
								<ul class="nav nav-tabs" id="myTab" role="tablist">
									<?php
										$sql = "Select distinct brand from product";
										$brandQuery = mysqli_query($conn, $sql);
										$i = 0;
										while($row = mysqli_fetch_assoc($brandQuery)){
											$i++;
											if($i==1){
												echo'<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#'.$row['brand'].'" role="tab">'.$row['brand'].'</a></li>';
											}
											else{
												echo'<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#'.$row['brand'].'" role="tab">'.$row['brand'].'</a></li>';
											}
											
										}
									?>									
								</ul>
								<!--/ End Tab Nav -->
							</div>
							<div class="tab-content" id="myTabContent">
								<!-- Start Single Tab -->
								<?php
								$sql = "Select distinct brand from product LIMIT 7";
								$brandQuery = mysqli_query($conn, $sql);
								$i = 0;
								while($row = mysqli_fetch_assoc($brandQuery)){
									$i++;
									if($i==1){
										echo'<div class="tab-pane fade show active" id="'.$row['brand'].'" role="tabpanel">';
									}
									else{
										echo'<div class="tab-pane fade" id="'.$row['brand'].'" role="tabpanel">';
									}
									
									echo'<div class="tab-single">
										<div class="row">';
										$brand = $row['brand'];
										$sql1 = "Select * from product where brand = '$brand'";
										$getBrand = mysqli_query($conn, $sql1);
										while($row1 = mysqli_fetch_assoc($getBrand)){
											if($row1['quantity_stock'] > 0){
												$outOfStock = false;					
											}
											else{
												$outOfStock = true;
											}
											if($row1['discount']!=0){
												$updatedPrice = $row1['price'] - $row1['discount'];								
											}
											else{
												$updatedPrice = $row1['price'];								
											}											
											$discount = 0;
											echo'<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 holdProductBrand">
											<div class="single-product">
											<p class="hide-element" style="font-size:16px;" id="result'.$row1['code'].'">Result</p>
												<div class="product-img">
													<a href="singleproduct.php?i='.$row1['code'].'">
														<img class="default-img" src="admin/images/products/'.$row1['sold_by'].'/'.$row1['image_folder_key'].'/'.$row1['image_name'].'" alt="#">
														<img class="hover-img" src="admin/images/products/'.$row1['sold_by'].'/'.$row1['image_folder_key'].'/'.$row1['image_name'].'" alt="#">
													</a>
													<div class="button-head">
														<div class="product-action">
															<p data-bs-toggle="modal" id="modalboxdata'.$row1['code'].'" data-bs-target="#modalbox'.$row1['code'].'" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></p>
															<p title="Favourite" id="favourite'.$row1['code'].'" href="#"><i class="ti-heart"></i><span id="toFavourite'.$row1['code'].'">Add to Favourite</span></p>
															<p title="Compare" id="compare'.$row1['code'].'" href="#"><i class="ti-bar-chart-alt"></i><span id="toCompare'.$row1['code'].'">Add to Compare</span></p>
														</div>
														<div class="product-action-2">';
												if(!$outOfStock){	
												echo'<span title="Add to cart" id="cart'.$row1['code'].'">Add to cart</span>';
												}
												else{
													echo'<span style="color: #ed1c24 !important;"><i style="color: #ed1c24 !important;" class="far fa-times-circle"></i> OUT OF STOCK</span>';
												}
												echo'</div>
													</div>
												</div>
												<div class="product-content">
													<h3><a href="singleproduct.php?i='.$row1['code'].'">'.$row1['name'].'</a></h3>
													<div class="product-price">';
													echo'<span style="margin-right:4px;">Rs</span>';
													if($row1['discount']!=0){
															$discount = $row1['discount'];
															echo'<span style="text-decoration: line-through; color:#ef271b;">'.$row1['price'].'</span>';
													}
														echo'<span> '.($row1['price']-$discount).'</span>
													</div>
												</div>
											</div>
											</div>';																					
										}											
										echo'</div>
									</div>
								</div>';	
								}
								?>								
							</div>
						</div>
					</div>
				</div>
            </div>
    </div>
	<!-- End Product Area -->
	
	<!-- Start Midium Banner  -->
	<section class="midium-banner">
		<div class="container">
			<div class="row">
				<!-- Single Banner  -->
				<div class="col-lg-6 col-md-6 col-sm-6 col-12" data-aos="fade-right" data-aos-duration="500">
					<div class="single-banner">
						<img src="https://i.ytimg.com/vi/tddValqLAfI/maxresdefault.jpg" alt="#">
						<div class="content">
							<p>Cleaning Appliances</p>
							<h3>Vacuum Cleaner</h3>
							<a href="products.php?qc=cleaning">Shop Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
				<!-- Single Banner  -->
				<div class="col-lg-6 col-md-6 col-sm-6 col-12" data-aos="fade-left" data-aos-duration="500">
					<div class="single-banner">
						<img src="img/Speaker.png" alt="#">
						<div class="content">
							<p>Sound Appliances</p>
							<h3>Multimedia Speaker</h3>
							<a href="products.php?qc=speaker" class="btn">Shop Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
			</div>
		</div>
	</section>
	<!-- End Midium Banner -->
	
	<!-- Start Most Popular -->
	<div class="product-area most-popular section">
        <div class="container">
            <div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>EXPLORE MORE</h2>
					</div>
				</div>
            </div>
            <div class="row" data-aos="flip-up" data-aos-duration="500">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
					<?php
							$sql = "Select * from product";
							$result = mysqli_query($conn, $sql);
							while($row=mysqli_fetch_assoc($result)){
								if($row['discount']!=0){
									$updatedPrice = $row['price'] - $row['discount'];								
								}
								else{
									$updatedPrice = $row['price'];								
								}
								
								$discount = 0;
								echo'
								<div class="single-product">
									<div class="product-img">
										<a href="singleproduct.php?i='.$row['code'].'">
											<img class="default-img" src="admin/images/products/'.$row['sold_by'].'/'.$row['image_folder_key'].'/'.$row['image_name'].'" alt="#">
											<img class="hover-img" src="admin/images/products/'.$row['sold_by'].'/'.$row['image_folder_key'].'/'.$row['image_name'].'" alt="#">
										</a>
										
									</div>
									<div class="product-content">
										<h3><a href="singleproduct.php?i='.$row['code'].'">'.$row['name'].'</a></h3>
										<div class="product-price">';
										echo'<span style="margin-right:4px;">Rs</span>';
										if($row['discount']!=0){
												$discount = $row['discount'];
												echo'<span style="text-decoration: line-through; color:#ef271b;">'.$row['price'].'</span>';
										}
											echo'<span> '.($row['price']-$discount).'</span>
										</div>
									</div>							
							</div>';
							}
							?> 		
						<!-- Start Single Product -->					
                    </div>
                </div>
				<?php
$sql = "Select * from product";
$result = mysqli_query($conn, $sql);
while($row=mysqli_fetch_assoc($result)){
	if($row['discount']!=0){
		$updatedPrice = $row['price'] - $row['discount'];								
	}
	else{
		$updatedPrice = $row['price'];								
	}	
	$discount = 0;
echo'<!-- Modal -->
<div class="modal fade" id="modalbox'.$row['code'].'" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
			</div>
			<div class="modal-body">
				<div class="row no-gutters">
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<!-- Product Slider -->
							<div class="product-gallery">
								<div class="quickview-slider-active">
									<div class="single-slider">
										<img src="admin/images/products/'.$row['sold_by'].'/'.$row['image_folder_key'].'/'.$row['image_name'].'" alt="#">
									</div>
									<div class="single-slider">
										<img src="admin/images/products/'.$row['sold_by'].'/'.$row['image_folder_key'].'/'.$row['image_name'].'" alt="#">
									</div>
									<div class="single-slider">
										<img src="admin/images/products/'.$row['sold_by'].'/'.$row['image_folder_key'].'/'.$row['image_name'].'" alt="#">
									</div>
									<div class="single-slider">
										<img src="admin/images/products/'.$row['sold_by'].'/'.$row['image_folder_key'].'/'.$row['image_name'].'" alt="#">
									</div>
								</div>
							</div>
						<!-- End Product slider -->
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<div class="quickview-content">
							<h2>'.$row['name'].'</h2>
							<div class="quickview-ratting-review">
								<div class="quickview-ratting-wrap">
									<div class="quickview-ratting">';
									$product_code = $row['code'];
									$getRating = "SELECT COUNT(rating) as totalratingsgiven, ROUND(AVG(rating), 1) as rating from reviews where product_code = '$product_code'";
									$executegetRating = mysqli_query($conn, $getRating);									
									$getRatingDetail =  mysqli_fetch_assoc($executegetRating);
									$totalRating =  $getRatingDetail['rating'];								
									$totalUsers = $getRatingDetail['totalratingsgiven'];
									if($totalRating!=0)	{
										$whole = (int) $totalRating;
										$frac  = $totalRating - (int) $totalRating;
										for($i=1;$i<6;$i++){
											if($i<=$whole){										
												echo'<i class="yellow fa fa-star"></i>';																														
											}									
											else{		
												if($i==($whole+1)){
													if($frac!=0){
														echo'<i class="yellow fa fa-star-half-alt"></i>';
													}
													else{
														echo'<i class="fa fa-star"></i>';
													}	
												}
												else{
													echo'<i class="fa fa-star"></i>';
												}																																																																																								
											}
										}	
									}															
									echo'</div>';
									if($totalRating!=0){
										echo '<a href="#"> ('.$totalUsers.' customer review)</a>';
									}
									else{
										echo 'No reviews yet';
									}									
								echo'</div>
								<div class="quickview-stock">';									
									if($row['quantity_stock'] > 0){
										$outOfStock = false;
										echo'<span><i class="far fa-check-circle"></i>in stock ('.$row['quantity_stock'].')';
									}
									else{

										$outOfStock = true;
										echo'<span style="color: #ed1c24 !important;"><i style="color: #ed1c24 !important;" class="far fa-times-circle"></i> OUT OF STOCK';
									}
									echo'</span>
								</div>
							</div>';
							if($row['discount']!=0){
								$updatedPrice = $row['price'] - $row['discount'];
								echo'<h3>Rs <span style="color:#ed1c24; text-decoration: line-through;">'.$row['price'].'</span> '.$updatedPrice.'</h3>';								
							}
							else{
								$updatedPrice = $row['price'];	
								echo'<h3>Rs'.$updatedPrice.'</h3>';							
							}																														
							echo'<div class="quickview-peragraph">';															
							$description = explode('.', $row['description']);								
							foreach($description as $var){
							echo '<li>'.$var.'</li>';
							}	
							
							echo'</div>
							<div class="size">
								<div class="row">
									<div class="col-lg-4 col-12">
										<a href="#" class="title">Category: '.$row['category'].'</a>										
									</div>
									<div class="col-lg-4 col-12">
										<a class="title">Code: '.$row['code'].'</a>																		
									</div>
								</div>
							</div>
							<div class="quantity">
								<!-- Input Order -->
								<div class="input-group">
									<div class="button minus">
										<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
											<i class="ti-minus"></i>
										</button>
									</div>
									<input type="text" hidden id="quanitymaxofproduct'.$row['code'].'" value="'.$row['quantity_stock'].'">
									<input type="text" id="amountOfproduct'.$row['code'].'" name="quant[1]" class="input-number" data-min="1" data-max="'.$row['quantity_stock'].'" value="1">
									<div class="button plus">
										<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
											<i class="ti-plus"></i>
										</button>
									</div>
								</div>
								<!--/ End Input Order -->
							</div>
							<div class="add-to-cart">';
								if(!$outOfStock){
									echo'<a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add to cart" id="fromModalcart'.$row['code'].'" class="btn"><i class="fas fa-cart-plus"></i></a>';
								}								
								echo'<a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add to favourite" id="fromModalwishlist'.$row['code'].'" class="btn min"><i class="ti-heart"></i></a>
								<a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add to compare list" id="fromModalcompare'.$row['code'].'" class="btn min"><i class="ti-bar-chart-alt"></i></a>
							</div>
							<div class="default-social">
								<h4 class="share-now">Share:</h4>
								<ul>
								<li><a class="facebook" href="#"><i class="fab fa-facebook"></i></a></li>
								<li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
								<li><a class="youtube" href="#"><i class="fab fa-pinterest-p"></i></a></li>
								<li><a class="dribbble" href="#"><i class="fab fa-google-plus"></i></a></li>				
								</ul>
								<div  style="visibility:hidden;" id="fromModalResult'.$row['code'].'" class="alert" role="alert">
  								
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal end -->';
						}
				?>
            </div>
        </div>
    </div>
	<!-- End Most Popular Area -->
	
	<!-- Start Cowndown Area -->
	<section class="cown-down">
		<div class="section-inner ">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-6 col-12 padding-right">
						<div class="image">
							<img src="https://image-us.samsung.com/SamsungUS/home/televisions-and-home-theater/tvs/all-tvs/04272021/Q90A-GalleryImage-1600x1200.jpg?$product-details-jpg$" alt="#">
						</div>	
					</div>	
					<div class="col-lg-6 col-12 padding-left">
						<div class="content">
							<div class="heading-block">
								<p class="small-title">Upcoming Special Deal</p>
								<h3 class="title">Neo QLED Samsung Tv</h3>
								<p class="text">Suspendisse massa leo, vestibulum cursus nulla sit amet, frungilla placerat lorem. Cars fermentum, sapien. </p>
								<h1 class="price">Rs 70000 <s>Rs 100000</s></h1>
								<div class="coming-time">
									<div class="clearfix" data-countdown="2021/09/30"></div>
								</div>
							</div>
						</div>	
					</div>	
				</div>
			</div>
		</div>
	</section>
	<!-- /End Cowndown Area -->
	
	
	<!-- Start Shop Services Area -->
	<section class="shop-services section home">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-rocket"></i>
						<h4>Free shiping</h4>
						<p>Orders over Rs 100k</p>
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
	<!-- End Shop Services Area -->
	
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

	include("layouts/footer.php");
?>
	<!-- /End Footer Area -->
 
	<!-- Jquery -->
    <script src="assets/js/jquery.min.js"></script>

    <script src="assets/js/jquery-migrate-3.0.0.js"></script>

	<script src="assets/js/jquery-ui.min.js"></script>	
	<!-- Popper JS -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
	
	<!-- Color JS -->
	
	<!-- Slicknav JS -->
	<script src="assets/js/slicknav.min.js"></script>
	<!-- Owl Carousel JS -->
	<script src="assets/js/owl-carousel.js"></script>
	<!-- Magnific Popup JS -->
	<script src="assets/js/magnific-popup.js"></script>
	<!-- Waypoints JS -->
	<script src="assets/js/waypoints.min.js"></script>
	<!-- Countdown JS -->
	<script src="assets/js/finalcountdown.min.js"></script>
	<!-- Nice Select JS -->
	<script src="assets/js/nicesellect.js"></script>
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
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script>
    AOS.init();
  </script>
</body>
</html>