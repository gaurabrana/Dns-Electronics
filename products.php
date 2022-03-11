<?php

use function PHPSTORM_META\elementType;

require ('database/connect.php');
$active = "products";
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
	<!-- Jquery Ui -->
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
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
								<li class="active"><a href="products.php">Shop Products</a></li>
								<input type="text" hidden value='{"filter":"all"}' id="currentQuery">								
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
					<div class="col-lg-3 col-md-4 col-12 mb-4">						
							<div class="row">
								<div class="col-md-12 col-sm-6">
									<!-- Single Widget -->
									<div class="mt-0 single-widget category">
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
								</div>
								<div class="col-md-12 col-sm-6">									
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
								</div>
							</div>
									<div class="row">
									<div class="col-md-12 col-sm-6">
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
									<div class="col-md-12 col-sm-6">
										<!-- Single Widget -->
								<div class="single-widget pb-30">
									<h3 class="title">Recently Added</h3>
									<ul class="recent-post">
										

										</li>									
									<?php
										$getRecentlyAddedProduct = "Select * from product order by STR_TO_DATE(added_date, '%Y-%m-%d') DESC LIMIT 3";
										$getRecentlyAddedProductQuery = mysqli_query($conn, $getRecentlyAddedProduct);
										while($row = mysqli_fetch_assoc($getRecentlyAddedProductQuery)){	
													 
											 echo'<li><div class="single-post first">
										<div class="image">
											<img src="admin/images/products/'.$row['sold_by'].'/'.$row['image_folder_key'].'/'.$row['image_name'].'" alt="#">
										</div>
										<div class="content">
											<h5><a href="singleproduct.php?i='.$row['code'].'">'.$row['name'].'</a></h5>';

											if(isset($_SESSION['isRetail'])){
												if($_SESSION['isRetail']){
													$discount = $row['discount'];
											}
											else{
												$discount = $row['wholesale_discount'];
											}
											}
											else{
												$discount = $row['discount'];
											}
											if($discount > 0){										
												$updatedPrice = $row['price'] - $discount;												
											}
											else{
												$updatedPrice = $row['price'];																				
											}								
											echo'<p class="price">Rs '.$updatedPrice.'</p>';													
											echo'<ul class="reviews">';
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
																								
											echo'</ul>
										</div>
									</div></li>';
										}
									?>
							</ul>
								</div>
								<!--/ End Single Widget -->
									</div>
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
												<option value="12" selected="selected">12</option>
												<option value="24">24</option>
												<option value="48">48</option>
												<option value="72">72</option>
											</select>
										</div>
										<div class="single-shorter">
											<label>Sort By :</label>
											<select id="sortType">
												<option value="none" disabled="disabled" selected="selected">Sort Here</option>
												<option value="name:ASC">Name (A-Z)</option>												
												<option value="name:DESC">Name (Z-A)</option>
												<option value="price:ASC">Price (Low to High)</option>
												<option value="price:DESC">Price (High to Low)</option>												
											</select>
										</div>
									</div>
									<ul class="view-mode">
										<li id="toggle-card-style" class="active"><a href="shop-grid.php"><i class="fa fa-th-large"></i></a></li>
										<li id="toggle-list-style" ><a href="#"><i class="fa fa-th-list"></i></a></li>
									</ul>
								</div>
								<!--/ End Shop Top -->
							</div>
						</div>						
						<div id="loadProducts" class="row">
							<?php
							if(isset($_GET['type'])){
								$keyword = $_GET['type'];								
									$sql = "Select * from product where type = '$keyword'";
																						
							}							
							else if(isset($_GET['qc'])){
								$keyword = $_GET['qc'];
								if($keyword=="summer"){
									$sql = "Select * from product where category = 'Fridge' or category='Air Conditioner' or category='Fan'";
								}
								else if($keyword == "winter"){
									$sql = "Select * from product where category = 'Heater' or category='Geysers' or category='Fan'";
								}
								else{
									$sql = "Select * from product where category = '$keyword'";
								}		
							}
							else{
								$sql = "Select * from product order by id asc LIMIT 12 ";
							}

							//get total Products
							$getTotal =  "Select count(id) as total from product";
							$getTotalResult = mysqli_query($conn, $getTotal);
							$r = mysqli_fetch_assoc($getTotalResult);
							$totalproducts = $r['total'];
							$result = mysqli_query($conn, $sql);
							$result1 = mysqli_query($conn, $sql);							
							if(mysqli_num_rows($result) > 0){								
								while($row=mysqli_fetch_assoc($result)){
									if(isset($_SESSION['isRetail'])){
										if($_SESSION['isRetail']){
											$discount = $row['discount'];
									}
									else{
										$discount = $row['wholesale_discount'];
									}
									}
									else{
										$discount = $row['discount'];
									}									
									if($discount!=0){										
										$updatedPrice = $row['price'] - $discount;
										$percentage = round(($discount * 100)/$row['price']);
									}
									else{
										$updatedPrice = $row['price'];	
										$percentage = 0;							
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
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
																</div>
																<div class="row">
																 <div class="col-md-12 d-flex justify-content-between">';																 
																 if($discount!=0){																	
																	echo'<span>Rs <span style="color:#ed1c24; text-decoration: line-through;">'.$row['price'].'</span> '.$updatedPrice.'</span>
																	<span style="color:#ef271b;">'.$percentage.'% off</span>';
																}
																else{																	
																	echo'<span>Rs'.$updatedPrice.'</span>';							
																}
																echo '
																<span class="tags"></span>
																</div>
																</div>																																																														
																<div class="quickview-peragraph">';															
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
									echo'<div class="col-lg-4 col-md-6 col-sm-4 col-6 isProduct">								
									<div class="single-product">
									<p class="hide-element" style="font-size:16px;" id="result'.$row['code'].'">Result</p>
										<div class="product-img">
											<a href="singleproduct.php?i='.$row['code'].'">
												<img class="default-img" src="admin/images/products/'.$row['sold_by'].'/'.$row['image_folder_key'].'/'.$row['image_name'].'" alt="#">
												<img class="hover-img" src="admin/images/products/'.$row['sold_by'].'/'.$row['image_folder_key'].'/'.$row['image_name'].'" alt="#">
											</a>
											<div class="button-head">
												<div class="product-action">
													<p data-bs-toggle="modal" id="modalboxdata'.$row['code'].'" data-bs-target="#modalbox'.$row['code'].'" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></p>																			
													<p title="Favourite" id="favourite'.$row['code'].'" href="#"><i class="ti-heart"></i><span id="toFavourite'.$row['code'].'">Add to Favourite</span></p>
													<p title="Compare" id="compare'.$row['code'].'" href="#"><i class="ti-bar-chart-alt"></i><span id="toCompare'.$row['code'].'">Add to Compare</span></p>
												</div>
												<div class="product-action-2">';
												if(!$outOfStock){	
												echo'<span title="Add to cart" id="cart'.$row['code'].'">Add to cart</span>';
												}
												else{
													echo'<span style="color: #ed1c24 !important;"><i style="color: #ed1c24 !important;" class="far fa-times-circle"></i> NO STOCK</span>';
												}
												echo'</div>
											</div>
										</div>
										<div class="product-content">
											<h3><a href="singleproduct.php?i='.$row['code'].'">'.$row['name'].'</a></h3>
											<div class="product-price">											
											<div class="row">
											<div class="col-md-8">
											<span style="margin-right:4px;">Rs</span>';
											if($discount!=0){			
													echo'
													<span style="text-decoration: line-through; color:#ef271b;">'.$row['price'].'</span>
													<span> '.$updatedPrice.'</span>																							
													';
											}
											else{
												echo'<span> '.$updatedPrice.'</span>';
											}
												echo'
												</div>
												<div class="col-md-4">';
												if($percentage>0){
													echo'<span style="; color:#ef271b;">'.$percentage.'% Off</span>';
												}												
											echo'</div>
											</div>
											</div>
										</div>
									</div>
								</div>';
								}
							}
							else{
								echo"<h5>No Products Found.</h5>";
							}							
							?> 																				
						</div>
						<div class="row" id="list-style-product-display">														
								<?php
								while($row=mysqli_fetch_assoc($result1)){
									if(isset($_SESSION['isRetail'])){
										if($_SESSION['isRetail']){
											$discount = $row['discount'];
									}
									else{
										$discount = $row['wholesale_discount'];
									}
									}
									else{
										$discount = $row['discount'];
									}									
									if($discount!=0){										
										$updatedPrice = $row['price'] - $discount;
										$percentage = round(($discount * 100)/$row['price']);
									}
									else{
										$updatedPrice = $row['price'];	
										$percentage = 0;							
									}		
									if($row['quantity_stock'] > 0){
										$outOfStockGrid = false;
									}
									else{
										$outOfStockGrid = true;
									}
									echo'<!-- Start Single List -->
									<div class="col-12">
									<div class="row">
										<div class="col-lg-4 col-md-6 col-sm-6 col-12 ">
											<div class="single-product">
												<div class="product-img">
													<a href="singleproduct.php?i='.$row['code'].'">
														<img class="default-img" src="admin/images/products/'.$row['sold_by'].'/'.$row['image_folder_key'].'/'.$row['image_name'].'" alt="#">
														<img class="hover-img" src="admin/images/products/'.$row['sold_by'].'/'.$row['image_folder_key'].'/'.$row['image_name'].'" alt="#">
													</a>
													<div class="button-head">
														<div class="product-action">
														<p data-bs-toggle="modal" id="listmodalboxdata'.$row['code'].'" data-bs-target="#modalbox'.$row['code'].'" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></p>
														<p title="Favourite" id="listfavourite'.$row['code'].'" href="#"><i class="ti-heart"></i><span id="listtoFavourite'.$row['code'].'">Add to Favourite</span></p>
														<p title="Compare" id="listcompare'.$row['code'].'" href="#"><i class="ti-bar-chart-alt"></i><span id="listtoCompare'.$row['code'].'">Add to Compare</span></p>
														</div>
														<div class="product-action-2">';
														if(!$outOfStockGrid){	
															echo'<span title="Add to cart" id="listcart'.$row['code'].'">Add to cart</span>';
															}
															else{
																echo'<span style="color: #ed1c24 !important;"><i style="color: #ed1c24 !important;" class="far fa-times-circle"></i>NO STOCK</span>';
															}
														echo'</div>
													</div>
												</div>												
												<hr>
												<div class="list-display-product-price">';
											echo'<span style="margin-right:4px;">Rs</span>';
											if($discount!=0){			
												echo'
												<span style="text-decoration: line-through; color:#ef271b;">'.$row['price'].'</span>
												<span> '.$updatedPrice.'</span>																							
												<span style="color:#ef271b;">'.$percentage.'% off</span>';
										}
										else{
											echo'<span> '.$updatedPrice.'</span>';
										}						
												echo'</div>	
												<div id="liststyleResult'.$row['code'].'" class="alert hide-element">				
																				
												</div>	
											</div>
										</div>
										<div class="col-lg-8 col-md-6 col-sm-6 col-12">
											<div class="list-content">
												<div class="product-content">													
													<h4 class="title"><a href="singleproduct.php?i='.$row['code'].'">'.$row['name'].'</a></h4>
													<div class="review-inner">
														<div class="ratings">';
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
														if($totalRating!=0){
															echo '<a href="#"> ('.$totalUsers.' customer review)</a>';
														}
														else{
															echo 'No reviews yet';
														}																																					
														echo'</div>
													</div>
												</div>';
												$descriptions = explode('.', $row['description']);
												foreach($descriptions as $var){
													echo '<li>'.$var.'</li>';
													}													
												echo'																
												<a style="color:white; margin-top:10px;" href="singleproduct.php?i='.$row['code'].'" class="btn">View more</a>																	
											</div>
										</div>
									</div>
								</div>
								<!-- End Single List -->';
								}									
									?>																							
							</div>
							<div class="row" id="holdPaginationButtons">
								<div class="col-md-12 mt-6 pagination d-flex justify-content-center">								
								<ul>
								<li><a id="previousPage" href="#">&lt;</a></li>							
								<?php
								$rowsperpage  = 12;
								$totalpages = ceil($totalproducts/$rowsperpage );								
								$currentpage = 1;	
								echo'<input hidden id="totalPages" value="'.$totalpages.'">';
								echo'<input hidden id="currentPage" value="'.$currentpage.'">';			
								for($i=1;$i<=$totalpages;$i++){
									if($i == $currentpage){										
										echo'<li class="active"><a id="paginationValue'.$i.'" href="#">'.$i.'</a></li>';
									}							
									else{
										echo'<li><a id="paginationValue'.$i.'" href="#">'.$i.'</a></li>';
									}	
								}								
								?>														
								<li><a id="nextPage" href="#">&gt;</a></li>
								</ul>
								</div>							
							</div>
					</div>
				</div>
			</div>
			
		</section>
		<!--/ End Product Style 1  -->		
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
	<script src="assets/js/product.js"></script>
</body>
</html>