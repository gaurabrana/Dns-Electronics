<?php
include('connect.php');
//for price range slider
if(isset($_POST['minPrice']) && isset($_POST['maxPrice'])){    
    $minPrice = mysqli_real_escape_string($conn,$_POST['minPrice']);
    $maxPrice = mysqli_real_escape_string($conn,$_POST['maxPrice']);

    $query = "SELECT * FROM product where price BETWEEN {$minPrice} AND {$maxPrice}";
}
// for price radio buttons
if(isset($_POST['range'])){
    $rangeArea = mysqli_real_escape_string($conn,$_POST['range']);
    if($rangeArea=="priceRange1"){
        $minPrice = 0;
        $maxPrice = 10000;
        $query = "SELECT * FROM product where price BETWEEN {$minPrice} AND {$maxPrice}";
    }
    else if($rangeArea=="priceRange2"){
        $minPrice = 10000;
        $maxPrice = 30000;
        $query = "SELECT * FROM product where price BETWEEN {$minPrice} AND {$maxPrice}";
    }
    else if($rangeArea=="priceRange3"){
        $minPrice = 30000;
        $maxPrice = 100000;
        $query = "SELECT * FROM product where price BETWEEN {$minPrice} AND {$maxPrice}";
    }
    else if($rangeArea=="priceRange4"){
        $minPrice = 70000;
        $maxPrice = 100000;
        $query = "SELECT * FROM product where price BETWEEN {$minPrice} AND {$maxPrice}";
    }
    else if($rangeArea=="priceRange5"){        
        $minPrice = 100000;
        $query = "SELECT * FROM product where price > {$minPrice}";
    }
}
//for brands
if(isset($_POST['brandName'])){
    $brandName = mysqli_real_escape_string($conn,$_POST['brandName']);
    $query  = "SELECT * FROM product where brand = '$brandName'";
}
//for category
if(isset($_POST['categoryName'])){
    $categoryName = mysqli_real_escape_string($conn,$_POST['categoryName']);
    $query  = "SELECT * FROM product where category = '$categoryName'";
}
if(isset($_POST['sortType']) && isset($_POST['currentQuery'])){
    $sortType = mysqli_real_escape_string($conn,$_POST['sortType']);
    $currentQuery = mysqli_real_escape_string($conn,$_POST['currentQuery']);
    if($currentQuery!="all"){
        $sortField = explode(':', $currentQuery)[0];
        $sortValue = explode(':', $currentQuery)[1];    
        if($sortType!="stock"){
            $query= "SELECT * FROM PRODUCT WHERE $sortField = '$sortValue' order by $sortType asc";
        }
        else{
            $query= "SELECT * FROM PRODUCT WHERE $sortField = '$sortValue' AND quantity_stock > 0 order by name asc";
        }    
    }
    else{
        if($sortType!="stock"){
            $query= "SELECT * FROM PRODUCT order by $sortType asc";
        }
        else{
            $query= "SELECT * FROM PRODUCT WHERE quantity_stock > 0 order by name asc";
        }    
    }
    
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result)>0){
    $output = "";
    while($row = mysqli_fetch_assoc($result)){        		
        $output .= '<!-- Modal -->
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
														<div class="quickview-slider-active owl-carousel owl-theme owl-loaded">
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
																$output.='<h3>Rs <span style="color:#ed1c24; text-decoration: line-through;">'.$row['price'].'</span> '.$updatedPrice.'</h3>';								
															}
															else{
																$updatedPrice = $row['price'];	
																$output.='<h3>Rs'.$updatedPrice.'</h3>';							
															}																														
															$output .= '<div class="quickview-peragraph">';
															$description = explode('.', $row['description']);								
															foreach($description as $var){
															$output .= '<li>'.$var.'</li>';
															}	
															$output .= '</div>
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
								$output.='<div class="col-lg-4 col-md-6 col-12">
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
										$output.='<span style="margin-right:4px;">Rs</span>';
										if($row['discount']!=0){
												$discount = $row['discount'];
												$output .= '<span style="text-decoration: line-through; color:#ef271b;">'.$row['price'].'</span>';
										}
											$output .= '<span> '.($row['price']-$discount).'</span>
										</div>
									</div>
								</div>
							</div>';
    }
    echo $output;
}
else{

}
