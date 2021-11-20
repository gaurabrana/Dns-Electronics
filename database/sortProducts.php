<?php
include('connect.php');
// first load 
// number of products
// clicked pagination
//user clicks on samsung
// show 12 samsung product
// next pagination shows 12-24 products

if(isset($_POST['filter'])){	
	//get filter type
	$filter = $_POST['filter'];
	// get limit
	$limit = $_POST['limit'];
	// get sort type
	$sortType = $_POST['sortType'];
	$isSortActive = false;
	if($sortType!="none"){
		$isSortActive = true;
		$sortField = explode(':', $sortType)[0];
        $sortOrder = explode(':', $sortType)[1];
	}
	else{
		$isSortActive = false;
		$sortField = "-";
        $sortOrder = "-";
	}
	
	$pageno = isset($_POST['pageno']) ? $_POST['pageno'] : 1;	
	$totalPages = 0;
	$currentpage = $pageno;
	//price slider
	if($filter == "priceSlider"){		
		if(isset($_POST['minPrice']) && isset($_POST['maxPrice'])){    
			$minPrice = mysqli_real_escape_string($conn,$_POST['minPrice']);
			$maxPrice = mysqli_real_escape_string($conn,$_POST['maxPrice']);
			$OldQuery = "SELECT * from product where price BETWEEN {$minPrice} AND {$maxPrice}";			
		}
	}

	//price ranges
	else if($filter == "priceRanges"){
		if(isset($_POST['range'])){
			$rangeArea = mysqli_real_escape_string($conn,$_POST['range']);
			if($rangeArea!="priceRange5"){        
				if($rangeArea=="priceRange1"){
					$minPrice = 0;
					$maxPrice = 10000;        
				}
				else if($rangeArea=="priceRange2"){
					$minPrice = 10000;
					$maxPrice = 30000;        
				}
				else if($rangeArea=="priceRange3"){
					$minPrice = 30000;
					$maxPrice = 70000;        
				}
				else if($rangeArea=="priceRange4"){
					$minPrice = 70000;
					$maxPrice = 100000;        
				}
				$OldQuery = "SELECT * FROM product where price BETWEEN {$minPrice} AND {$maxPrice}";				
			}
			else{
				$minPrice = 100000;
				$OldQuery = "SELECT * FROM product where price > {$minPrice}";				
			}            	
		}
	}
	//brand type
	else if($filter == "brand"){
		if(isset($_POST['brandName'])){
			$brandName = mysqli_real_escape_string($conn,$_POST['brandName']);
			$OldQuery  = "SELECT * FROM product where brand = '$brandName'";
		}
	}
	//category type
	else if($filter == "category"){
		if(isset($_POST['categoryName'])){
			$categoryName = mysqli_real_escape_string($conn,$_POST['categoryName']);
			$OldQuery  = "SELECT * FROM product where category = '$categoryName'";
		}
	}
	else{
			$OldQuery  = "SELECT * FROM product";
	}
	$getQueryDetail = getDetails($limit,$OldQuery,$conn,$pageno, $isSortActive, $sortField, $sortOrder);
	$totalPages = $getQueryDetail[0];
	$query = $getQueryDetail[1];
}
else{	
	exit();
}

function getDetails($limit,$query,$conn, $pageno, $sortActive, $sortField, $sortOrder){
$totalrows = mysqli_num_rows(mysqli_query($conn, $query));
$totalpages = ceil($totalrows/$limit);	
// the offset of the list, based on current page 
$offset = ($pageno - 1) * $limit;
if($sortActive){
	if($sortField == "price"){
		$query .= " order by (price - discount) $sortOrder";
	}
	else{
		$query .= " order by $sortField $sortOrder";
	}	
}
$newQuery = $query." LIMIT $offset, $limit";
$value = array($totalpages, $newQuery);
return $value;
}

if(isset($_POST['pageno']) && isset($_POST['totalpages'])){
	$rowsperpage  = 12;	
    $totalpages = $_POST['totalpages'];    
    $pageno = $_POST['pageno'];	
     // the offset of the list, based on current page 
     $offset = ($pageno - 1) * $rowsperpage;
     
     // get the info from the db 
     $query = "SELECT * FROM product LIMIT $offset, $rowsperpage";
}


$result = mysqli_query($conn, $query);
$result1 = mysqli_query($conn, $query);
if(mysqli_num_rows($result)>0){
	$data = "";
	if($totalPages > 1){
		$data .= '<!--StartPagination--><li><a id="previousPage" href="#">&lt;</a></li>';	
		for($i=1;$i<=$totalPages;$i++){
			if($i == $currentpage){								
				$data .= '<input hidden id="totalPages" value="'.$totalPages.'">
				<input hidden id="currentPage" value="'.$currentpage.'">
				<li class="active"><a id="paginationValue'.$i.'" href="#">'.$i.'</a></li>';
			}							
			else{
				$data .= '<li><a id="paginationValue'.$i.'" href="#">'.$i.'</a></li>';
			}	
		}
		$data .= '<li><a id="nextPage" href="#">&gt;</a></li>
		<!--EndPagination-->';	
	}	 
	else{
		$data .= "<!--EndPagination-->";
	}   
    while($row = mysqli_fetch_assoc($result)){    		
        $data .= '<!-- Modal for '.$row['code'].'-->
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
														$data .='<i class="yellow fa fa-star"></i>';																														
													}									
													else{		
														if($i==($whole+1)){
															if($frac!=0){
																$data .='<i class="yellow fa fa-star-half-alt"></i>';
															}
															else{
																$data .='<i class="fa fa-star"></i>';
															}	
														}
														else{
															$data .='<i class="fa fa-star"></i>';
														}																																																																																								
													}
												}	
											}															
											$data .='</div>';
											if($totalRating!=0){
												$data .= '<a href="#"> ('.$totalUsers.' customer review)</a>';
											}
											else{
												$data .= 'No reviews yet';
											}									
										$data .='</div>
										<div class="quickview-stock">';									
											if($row['quantity_stock'] > 0){
												$outOfStock = false;
												$data .='<span><i class="far fa-check-circle"></i>in stock ('.$row['quantity_stock'].')';
											}
											else{
		
												$outOfStock = true;
												$data .='<span style="color: #ed1c24 !important;"><i style="color: #ed1c24 !important;" class="far fa-times-circle"></i> OUT OF STOCK';
											}
											$data .='</span>
										</div>
									</div>';
									if($row['discount']!=0){
										$updatedPrice = $row['price'] - $row['discount'];
										$data .='<h3>Rs <span style="color:#ed1c24; text-decoration: line-through;">'.$row['price'].'</span> '.$updatedPrice.'</h3>';								
									}
									else{
										$updatedPrice = $row['price'];	
										$data .='<h3>Rs'.$updatedPrice.'</h3>';							
									}																														
									$data .='<div class="quickview-peragraph">';															
									$description = explode('.', $row['description']);								
									foreach($description as $var){
									$data .= '<li>'.$var.'</li>';
									}	
									
									$data .='</div>
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
											$data .='<a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add to cart" id="fromModalcart'.$row['code'].'" class="btn"><i class="fas fa-cart-plus"></i></a>';
										}								
										$data .='<a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add to favourite" id="fromModalwishlist'.$row['code'].'" class="btn min"><i class="ti-heart"></i></a>
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
								$discount = 0;
								$data.='<div class="col-lg-4 col-md-6 col-4">
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
										$data.='<p title="Add to cart" id="cart'.$row['code'].'">Add to cart</p>';
										}
										else{
											$data.='<span style="color: #ed1c24 !important;"><i style="color: #ed1c24 !important;" class="far fa-times-circle"></i> OUT OF STOCK</span>';
										}
										$data.='</div>
										</div>
									</div>
									<div class="product-content">
										<h3><a href="singleproduct.php?i='.$row['code'].'">'.$row['name'].'</a></h3>
										<div class="product-price">';
										$data.='<span style="margin-right:4px;">Rs</span>';
										if($row['discount']!=0){
												$discount = $row['discount'];
												$data .= '<span style="text-decoration: line-through; color:#ef271b;">'.$row['price'].'</span>';
										}
											$data .= '<span> '.($row['price']-$discount).'</span>
										</div>
									</div>
								</div>
							</div>';							
    }
	$data .= "<!--EndGridSection-->";
	while($row = mysqli_fetch_assoc($result1)){		
		if($row['quantity_stock'] > 0){
			$outOfStockGrid = false;
		}
		else{
			$outOfStockGrid = true;
		}
		$data .= '<!-- Start Single List -->
							<div class="col-12">
							<div class="row">
								<div class="col-lg-4 col-md-6 col-sm-6 col-12">
									<div class="single-product">
										<div class="product-img">
											<a href="singleproduct.php?i='.$row['code'].'">
												<img class="default-img" src="admin/images/products/'.$row['sold_by'].'/'.$row['image_folder_key'].'/'.$row['image_name'].'" alt="#">
												<img class="hover-img" src="admin/images/products/'.$row['sold_by'].'/'.$row['image_folder_key'].'/'.$row['image_name'].'" alt="#">
											</a>
											<div class="button-head">
												<div class="product-action">
												<p data-bs-toggle="modal" id="listmodalboxdata'.$row['code'].'" data-bs-target="#modalbox'.$row['code'].'" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></p>
												<p title="Favourite" id="listfavourite'.$row['code'].'" href="#"><i class="ti-heart"></i><span id="toFavourite'.$row['code'].'">Add to Favourite</span></p>
												<p title="Compare" id="listcompare'.$row['code'].'" href="#"><i class="ti-bar-chart-alt"></i><span id="toCompare'.$row['code'].'">Add to Compare</span></p>
												</div>
												<div class="product-action-2">';
												if(!$outOfStockGrid){	
												$data .= '<p title="Add to cart" id="listcart'.$row['code'].'">Add to cart</p>';
												}
												else{
													$data .= '<span style="color: #ed1c24 !important;"><i style="color: #ed1c24 !important;" class="far fa-times-circle"></i> OUT OF STOCK</span>';
												}
												$data .= '</div>
											</div>
										</div>												
										<hr>
										<div class="list-display-product-price">';
										$data .= '<span style="margin-right:4px;">Rs</span>';
									if($row['discount']!=0){
											$discount = $row['discount'];
											$data .='<span style="text-decoration: line-through; color:#ef271b;">'.$row['price'].'</span>';
									}
										$data .='<span style="font-size:large;"> '.($row['price']-$discount).'</span>
										</div>	
										<div id="liststyleResult'.$row['code'].'" class="alert hide-element">				
										sad								
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
															$data .='<i class="yellow fa fa-star"></i>';																														
														}									
														else{		
															if($i==($whole+1)){
																if($frac!=0){
																	$data .='<i class="yellow fa fa-star-half-alt"></i>';
																}
																else{
																	$data .='<i class="fa fa-star"></i>';
																}	
															}
															else{
																$data .='<i class="fa fa-star"></i>';
															}																																																																																								
														}
													}	
												}																													
												if($totalRating!=0){
													$data .= '<a href="#"> ('.$totalUsers.' customer review)</a>';
												}
												else{
													$data .= 'No reviews yet';
												}																																					
												$data .='</div>
											</div>
										</div>';
										$descriptions = explode('.', $row['description']);
										foreach($descriptions as $var){
											$data .= '<li>'.$var.'</li>';
											}													
										$data .='																
										<a style="color:white; margin-top:10px;" href="singleproduct.php?i='.$row['code'].'" class="btn">View more</a>																	
									</div>
								</div>
							</div>
						</div>
						<!-- End Single List -->';
	}
			echo $data;
}
else{
echo "<div class='single-product'><h4 class='title'>No products found with this filters</h4></div><!--EndGridSection--><div class='single-product'><h4 class='title'>No products found with this filters</h4></div>";
}
