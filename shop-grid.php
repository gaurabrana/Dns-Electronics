<?php
require ('database/connect.php');
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
	<!-- Jquery Ui -->
    <link rel="stylesheet" href="css/jquery-ui.css">
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
								<li class="active"><a href="blog-single.html">Shop Grid</a></li>
								<input type="text" hidden value="all" id="currentQuery">								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
		
		<!-- Product Style -->
		<section class="product-area shop-sidebar shop section">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-4 col-12">
						<div class="shop-sidebar">
								<!-- Single Widget -->
								<div class="single-widget category">
									<h3 class="title">Categories</h3>
									<ul class="categor-list">
									<?php									
										$sql = "Select distinct category from product limit 7";
										$result = mysqli_query($conn, $sql);
										while($row=mysqli_fetch_assoc($result)){
											echo"<li><a id=".$row['category']." href='#'>".$row['category']."</a></li>";
										}
									?>									
									</ul>
								</div>
								<!--/ End Single Widget -->
								<!-- Shop By Price -->
									<div class="single-widget range">
										<h3 class="title">Shop by Price</h3>
										<div class="price-filter">
											<div class="price-filter-inner">
												<div id="slider-range"></div>
													<div class="price_slider_amount">													
													<div class="label-input">
														<span>Range:</span><input type="text" id="amount" readonly name="price" placeholder="Add Your Price"/>
													</div>
												</div>
											</div>
										</div>
										<ul class="check-box-list">
											<?php
											$sql = "Select price from product";									
											$result = mysqli_query($conn, $sql);
											$range1 = 0; $range2 = 0; $range3 = 0; $range4 = 0; $range5  = 0;
											while($row=mysqli_fetch_assoc($result)){
												$price = $row['price'];

												if($price > 0 && $price <= 10000){
													$range1++;													
												}
												else if($price > 10000 && $price <= 30000){
													$range2++;
													
												}
												else if( $price > 30000 && $price <= 70000){
													$range3++;
													
												}
												else if($price > 70000 && $price <= 100000){
													$range4++;
													
												}
												else if($price > 100000){
													$range5++;
													
												}																					
											}
											if($range1>0){
												echo'<li>
												<label class="checkbox-inline" for="priceRange1"><input name="ranges" id="priceRange1" value="priceRange1" type="radio">0 - 10k<span class="count">('.$range1.')</span></label>
											</li>';		
											
											}
											if($range2>0){
												echo'<li>
												<label class="checkbox-inline" for="priceRange2"><input name="ranges" id="priceRange2" value="priceRange2" type="radio">10k - 30k<span class="count">('.$range2.')</span></label>
											</li>';		
											
											}
											if($range3>0){
												echo'<li>
												<label class="checkbox-inline" for="priceRange3"><input name="ranges" id="priceRange3" value="priceRange3" type="radio">30k - 70k<span class="count">('.$range3.')</span></label>
											</li>';	
											
											}
											if($range4>0){
												echo'<li>
												<label class="checkbox-inline" for="priceRange4"><input name="ranges" id="priceRange4" value = "priceRange4" type="radio">70 - 100k<span class="count">('.$range4.')</span></label>
											</li>';		
												
											}
											if($range5>0){
												echo'<li>
												<label class="checkbox-inline" for="priceRange5"><input name="ranges" id="priceRange5" value="priceRange5" type="radio">100k+<span class="count">('.$range5.')</span></label>
											</li>';		
											}											
													
											?>
										</ul>
									</div>
									<!--/ End Shop By Price -->
								<!-- Single Widget -->
								<div class="single-widget recent-post">
									<h3 class="title">Recent post</h3>
									<!-- Single Post -->
									<div class="single-post first">
										<div class="image">
											<img src="https://via.placeholder.com/75x75" alt="#">
										</div>
										<div class="content">
											<h5><a href="#">Girls Dress</a></h5>
											<p class="price">$99.50</p>
											<ul class="reviews">
												<li class="yellow"><i class="ti-star"></i></li>
												<li class="yellow"><i class="ti-star"></i></li>
												<li class="yellow"><i class="ti-star"></i></li>
												<li><i class="ti-star"></i></li>
												<li><i class="ti-star"></i></li>
											</ul>
										</div>
									</div>
									<!-- End Single Post -->
									<!-- Single Post -->
									<div class="single-post first">
										<div class="image">
											<img src="https://via.placeholder.com/75x75" alt="#">
										</div>
										<div class="content">
											<h5><a href="#">Women Clothings</a></h5>
											<p class="price">$99.50</p>
											<ul class="reviews">
												<li class="yellow"><i class="ti-star"></i></li>
												<li class="yellow"><i class="ti-star"></i></li>
												<li class="yellow"><i class="ti-star"></i></li>
												<li class="yellow"><i class="ti-star"></i></li>
												<li><i class="ti-star"></i></li>
											</ul>
										</div>
									</div>
									<!-- End Single Post -->
									<!-- Single Post -->
									<div class="single-post first">
										<div class="image">
											<img src="https://via.placeholder.com/75x75" alt="#">
										</div>
										<div class="content">
											<h5><a href="#">Man Tshirt</a></h5>
											<p class="price">$99.50</p>
											<ul class="reviews">
												<li class="yellow"><i class="ti-star"></i></li>
												<li class="yellow"><i class="ti-star"></i></li>
												<li class="yellow"><i class="ti-star"></i></li>
												<li class="yellow"><i class="ti-star"></i></li>
												<li class="yellow"><i class="ti-star"></i></li>
											</ul>
										</div>
									</div>
									<!-- End Single Post -->
								</div>
								<!--/ End Single Widget -->
								<!-- Single Widget -->
								<div class="single-widget brand">
									<h3 class="title">Manufacturers</h3>													
									<ul class="brand-list">
										<?php
										$getbrands = "Select distinct brand from product";
										$result = mysqli_query($conn, $getbrands);
										while($row=mysqli_fetch_assoc($result)){
											echo'<li><a href="#" id="'.$row['brand'].'">'.$row['brand'].'</a></li>';										}
										?>										
									</ul>									
								</div>
								<!--/ End Single Widget -->
						</div>
					</div>
					<div class="col-lg-9 col-md-8 col-12">
						<div class="row focusFilterProduct">
							<div class="col-12">
								<!-- Shop Top -->
								<div class="shop-top">
									<div class="shop-shorter">
										<div class="single-shorter">
											<label>Show :</label>
											<select id="itemsPerPage">
												<option selected="selected">09</option>
												<option>15</option>
												<option>25</option>
												<option>30</option>
											</select>
										</div>
										<div class="single-shorter">
											<label>Sort By :</label>
											<select id="sortType">
												<option value="name" selected="selected">Name</option>
												<option value="price">Price</option>
												<option value="stock">In Stock</option>
											</select>
										</div>
									</div>
									<ul class="view-mode">
										<li class="active"><a href="shop-grid.html"><i class="fa fa-th-large"></i></a></li>
										<li><a href="shop-list.html"><i class="fa fa-th-list"></i></a></li>
									</ul>
								</div>
								<!--/ End Shop Top -->
							</div>
						</div>
						<div id="loadProducts" class="row">
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
																		<img src="admin/images/products/'.$row['sold_by'].'/'.$row['image_name'].'" alt="#">
																	</div>
																	<div class="single-slider">
																		<img src="admin/images/products/'.$row['sold_by'].'/'.$row['image_name'].'" alt="#">
																	</div>
																	<div class="single-slider">
																		<img src="admin/images/products/'.$row['sold_by'].'/'.$row['image_name'].'" alt="#">
																	</div>
																	<div class="single-slider">
																		<img src="admin/images/products/'.$row['sold_by'].'/'.$row['image_name'].'" alt="#">
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
																	<div class="quickview-ratting">
																		<i class="yellow fa fa-star"></i>
																		<i class="yellow fa fa-star"></i>
																		<i class="yellow fa fa-star"></i>
																		<i class="yellow fa fa-star"></i>
																		<i class="fa fa-star"></i>
																	</div>
																	<a href="#"> (1 customer review)</a>
																</div>
																<div class="quickview-stock">
																	<span><i class="fa fa-check-circle-o"></i> in stock</span>
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
																		<!------<select>
																			<option selected="selected">s</option>
																			<option>m</option>
																			<option>l</option>
																			<option>xl</option>
																		</select>----!>
																	</div>
																	<div class="col-lg-4 col-12">
																		<a href="#" class="title">Brand: '.$row['brand'].'</a>
																		<!---	<select>
																			<option selected="selected">orange</option>
																			<option>purple</option>
																			<option>black</option>
																			<option>pink</option>
																		</select>----!>
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
																	<input type="text" name="quant[1]" class="input-number"  data-min="1" data-max="1000" value="1">
																	<div class="button plus">
																		<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
																			<i class="ti-plus"></i>
																		</button>
																	</div>
																</div>
																<!--/ End Input Order -->
															</div>
															<div class="add-to-cart">
																<a href="#" id="cart'.$row['code'].'" class="btn">Add to cart</a>
																<a href="#" id="wishlist'.$row['code'].'" class="btn min"><i class="ti-heart"></i></a>
																<a href="#" id="compare'.$row['code'].'" class="btn min"><i class="fa fa-compress"></i></a>
															</div>
															<div class="default-social">
																<h4 class="share-now">Share:</h4>
																<ul>
																	<li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
																	<li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
																	<li><a class="youtube" href="#"><i class="fa fa-pinterest-p"></i></a></li>
																	<li><a class="dribbble" href="#"><i class="fa fa-google-plus"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- Modal end -->';
								$discount = 0;
								echo'<div class="col-lg-4 col-md-6 col-12">								
								<div class="single-product">
								<p style="visibility: hidden; font-size:16px;" id="result'.$row['code'].'">Result</p>
									<div class="product-img">
										<a href="product-details.html">
											<img class="default-img" src="admin/images/products/'.$row['sold_by'].'/'.$row['image_name'].'" alt="#">
											<img class="hover-img" src="admin/images/products/'.$row['sold_by'].'/'.$row['image_name'].'" alt="#">
										</a>
										<div class="button-head">
											<div class="product-action">
												<p data-bs-toggle="modal" data-bs-target="#modalbox'.$row['code'].'" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></p>
												<p title="Favourite" id="favourite'.$row['code'].'" href="#"><i class="ti-heart"></i><span id="toFavourite'.$row['code'].'">Add to Favourite</span></p>
												<p title="Compare" id="compare'.$row['code'].'" href="#"><i class="ti-bar-chart-alt"></i><span id="toCompare'.$row['code'].'">Add to Compare</span></p>
											</div>
											<div class="product-action-2">
												<p title="Add to cart" id="cart'.$row['code'].'">Add to cart</p>																								
											</div>
										</div>
									</div>
									<div class="product-content">
										<h3><a href="product-details.html">'.$row['name'].'</a></h3>
										<div class="product-price">';
										echo'<span style="margin-right:4px;">Rs</span>';
										if($row['discount']!=0){
												$discount = $row['discount'];
												echo'<span style="text-decoration: line-through; color:#ef271b;">'.$row['price'].'</span>';
										}
											echo'<span> '.($row['price']-$discount).'</span>
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
		</section>
		<!--/ End Product Style 1  -->	

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