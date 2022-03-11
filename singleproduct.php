<?php
include('database/connect.php');
include('formatdate.php');
if(isset($_SESSION['id'])){
	$user_id = $_SESSION['id'];	
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
	<link href="assets/plugin/toastr/css/toastr.min.css" rel="stylesheet">
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
	<link rel="stylesheet" href="assets/css/singleproduct.css">
	<link rel="stylesheet" href="assets/css/responsive.css">

	<link href="assets/css/star-rating.css" rel="stylesheet" />

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

	<?php
			if (isset($_GET['i'])) {				
				$product_code = $_GET['i'];
				$sql = "Select * from product where code = '$product_code'";
				$result = mysqli_query($conn, $sql);
				$result1 = mysqli_query($conn, $sql);
				if(mysqli_num_rows($result) == 0){
					echo"<script>window.location.href='products.php'</script>";			
				}				
				$getProductDetail = mysqli_fetch_array($result1);			
			}
			else{
				echo"<script>window.location.href='products.php'</script>";				
			}
				?>
	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="index.php">Home<i class="ti-arrow-right"></i></a></li>
							<li><a href="products.php">Products<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a id="inSingleProducts" href="singleproduct.php?i=<?php echo $product_code; ?>"><?php echo $getProductDetail['name']; ?></a></li>							
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<?php
			if (isset($_GET['i'])) {
				if (mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_assoc($result)) {						
						$category = $row['category'];
						echo '<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
			<!-- Product Slider -->
				<div class="product-gallery">
					<div class="quickview-slider-active">
						<div class="single-slider">
							<img src="admin/images/products/' . $row['sold_by'] .'/'.$row['image_folder_key'].'/'.$row['image_name'] . '" alt="#">
						</div>
						<div class="single-slider">
							<img src="admin/images/products/' . $row['sold_by'] .'/'.$row['image_folder_key'].'/'.$row['image_name'] . '" alt="#">
						</div>
						<div class="single-slider">
							<img src="admin/images/products/' . $row['sold_by'] .'/'.$row['image_folder_key'].'/'.$row['image_name'] . '" alt="#">
						</div>
						<div class="single-slider">
							<img src="admin/images/products/' . $row['sold_by'] .'/'.$row['image_folder_key'].'/'.$row['image_name'] . '" alt="#">
						</div>
					</div>
				</div>
			<!-- End Product slider -->
		</div>
		<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
			<div class="quickview-content">
				<h2>' . $row['name'] . '</h2>
				<div class="quickview-ratting-review">
					<div class="quickview-ratting-wrap">
						<div class="quickview-ratting">';
								$getRating = "SELECT COUNT(rating) as totalratingsgiven, ROUND(AVG(rating), 1) as rating from reviews where product_code = '$product_code'";
								$executegetRating = mysqli_query($conn, $getRating);
								$getRatingDetail =  mysqli_fetch_assoc($executegetRating);
								$totalRating =  $getRatingDetail['rating'];								
								$totalUsers = $getRatingDetail['totalratingsgiven'];	
								$whole = (int) $totalRating;
								$frac  = $totalRating - (int) $totalRating;
								if($totalRating!=0)	{
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
				if($_SESSION['isRetail']){
					$discount = $row['discount'];
			}
			else{
				$discount = $row['wholesale_discount'];
			}
				if($discount > 0){										
					$updatedPrice = $row['price'] - $discount;
					$percentage = round(($discount * 100)/$row['price']);												
				}
				else{
					$updatedPrice = $row['price'];			
					$percentage = 0;																	
				}
				echo'<div class="row">
				<div class="col-md-12 d-flex justify-content-between">';																 
				if($discount!=0){																	
				   echo'<span>Rs <span style="color:#ed1c24; text-decoration: line-through;">'.$row['price'].'</span><span style="font-size:large; font-weight:bold;"> '.$updatedPrice.'</span> </span>
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
						foreach ($description as $var) {
							echo '<li>' . $var . '</li>';
						}

						echo '</div>
				<div class="size">
					<div class="row">
						<div class="col-lg-4 col-12">
							<a href="#" class="title">Category: ' . $row['category'] . '</a>							
						</div>
						<div class="col-lg-4 col-12">
							<a class="title">Code: ' . $row['code'] . '</a>																		
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
		</div>';
					}
				} else {
				}
			}
			?>

		</div>
		<div class="row navigateTabs">
			<div class="col-12">
				<div class="tabs">
					<input type="radio" name="tabs" id="tabone" checked="checked">
					<label class="btn" for="tabone">Reviews</label>
					<div class="tab">	
						<?php
						if(isset($user_id)){

							$ReviewToThisProduct = "Select * from reviews where customer_id = '$user_id' and product_code = '$product_code'";
							$executeReviewToThisProduct = mysqli_query($conn, $ReviewToThisProduct);
							if(mysqli_num_rows($executeReviewToThisProduct) > 0){
								$hasreview = true;
								$getReviewDetails = mysqli_fetch_assoc($executeReviewToThisProduct);
							}
							else{
								$hasreview = false;
							}
						}
						?>
						<div class="row">
							<div class="col-md-12 d-flex justify-content-center">							
							<button data-bs-toggle="collapse" href="#addReview" id="actionTitle" aria-expanded="false" aria-controls="addReview" class="btn"><?php if(isset($hasreview) && $hasreview){echo'Update your review';}else{echo'Leave a review';}?></button>
							</div>
						</div>					
							<!--testimonials-box-container------>
							<div class="row">
								<div class="col-md-12 collapse mt-2" id="addReview">
									<div class="card">
										<div class="card-body">
										<div class="reply-head">											
											<h7 id="resultreview"></h7>
											<!-- Comment Form -->
											
												<div class="row">													
													<div class="col-12 mt-2">
														<div class="form-group">															
														<select class="star-rating">
														<option value="">Select a rating</option>
														<option value="5" <?php if(isset($getReviewDetails) && $getReviewDetails['rating']=="5"){echo " selected ";} ?>>Excellent</option>
														<option value="4" <?php if(isset($getReviewDetails) && $getReviewDetails['rating']=="4"){echo " selected ";} ?>>Very Good</option>
														<option value="3" <?php if(isset($getReviewDetails) && $getReviewDetails['rating']=="3"){echo " selected ";} ?>>Average</option>
														<option value="2" <?php if(isset($getReviewDetails) && $getReviewDetails['rating']=="2"){echo " selected ";} ?>>Poor</option>
														<option value="1" <?php if(isset($getReviewDetails) && $getReviewDetails['rating']=="1"){echo " selected ";} ?>>Terrible</option>
													</select>
  
														</div>
														<div class="form-group">
															<h6>Your Review</h6>
															<input hidden type="text" id="productidforreview" value="<?php echo $product_code ?>">
															<textarea id="review" name="message" placeholder=""><?php if(isset($getReviewDetails)){echo $getReviewDetails['comment'];}?></textarea>
														</div>
													</div>
													<div class="col-12">
														<div class="form-group button">
															<?php
															if(isset($hasreview) && $hasreview){
																echo'<button id="updatereview" class="btn">Update</button>
																	<button id="deletereview" class="btn">Delete</button>
																';
															}
															else{
																echo'<button id="submitreview" class="btn">Post</button>
																<button style="display: none;" id="deletereview" class="btn">Delete</button>';
															}
															?>															
														</div>
														
													</div>
												</div>
											
											<!-- End Comment Form -->
										</div>
										</div>
									</div>
								</div>
							</div>	
							<?php				
							$getReviews = "Select c.name,c.profile_picture,c.uniquekey, r.added_date, r.rating, r.comment,r.customer_id from reviews r, customer c where product_code = '$product_code' and c.id = r.customer_id";
							$executegetReviews = mysqli_query($conn, $getReviews);				
								if(mysqli_num_rows($executegetReviews) > 0){
									
									$no_of_reviews = mysqli_num_rows($executegetReviews);
									echo'<h3 class="review-title mt-2">Reviews ('.$no_of_reviews.')</h3>
									<p hidden id="noOfReviews">'.$no_of_reviews.'</p>';	
									echo'<section id="testimonials">						
									<div class="testimonial-box-container">';																
									while($row = mysqli_fetch_assoc($executegetReviews)){																				
										$formatteddate = formatDate($row['added_date']);
										$formattedtime = formatTime($row['added_date']);
										echo'<div class="testimonial-box"';
										if(isset($user_id) && $user_id == $row['customer_id']){
											echo "id=\"reviewOfCurrentUser\"";
										}
										echo'>							
										<div class="box-top">									
											<div class="profile">										
												<div class="profile-img">
													<img src="img/UserProfile/'.$row['uniquekey'].'/'.$row['profile_picture'].'" alt="userimage" />
												</div>										
												<div class="name-user">
													<strong>'.$row['name'].'</strong>
													<span>'.$formatteddate.' at '.$formattedtime.'</span>
												</div>
											</div>									
											<div class="reviews">';
											$rating = $row['rating'];
											for($i = 1 ; $i<6; $i++){
												if($i <= $rating){
													echo'<i class="yellow fa fa-star"></i>';
												}
												else{
													echo'<i class="fa fa-star"></i>';
												}												
											}																																	
											echo'</div>											
										</div>								
										<div class="client-comment">
											<p>'.$row['comment'].'</p>
										</div>																												
									</div>';
									}												
									echo'</div>
								</section>';										
								}
								else{
									echo'<h3 class="review-title mt-2">No Reviews Yet</h3>
									<p hidden id="noOfReviews">0</p>
									<section id="testimonials" >						
									<div class="testimonial-box-container">
									
									</div>
									</section>';					
								}
							?>
							
						
					</div>
					<input type="radio" name="tabs" id="tabtwo">
					<label class="btn"  for="tabtwo">Queries</label>
					<div class="tab">
					<section class="blog-single section">
					<div class="container">
					<div class="row">
					<div class="col-lg-12 col-12">
						<div class="blog-single-main">
							<div class="row">	
							<div class="col-12">			
									<div class="reply">
										<div class="reply-head">
											<h2 style="cursor:pointer;" class="reply-title" data-bs-toggle="collapse" href="#leaveaquestion" role="button" aria-expanded="false" aria-controls="leaveaquestion">Click To Leave a Question</h2>											
											<!-- Comment Form -->
											<h7 id="resultmsg"></h7>
											<div class="collapse" id="leaveaquestion">											
											<div class="row">													
													<div class="col-12">
														<div class="form-group">
															<h6>Your Question</h6>
															<input hidden type="text" id="productidforquery" value="<?php echo $product_code ?>">
															<textarea id="query" name="message" placeholder=""></textarea>
														</div>
													</div>
													<div class="col-12">
														<div class="form-group button">
															<button type="submit" id="submitquery" class="btn">Post</button>
														</div>
														
													</div>
												</div>
													</div>																							
											<!-- End Comment Form -->
										</div>
									</div>			
								</div>							
								<div class="col-12">
									<div class="comments">
										<?php
										$getQuestions = "Select c.name, c.gender, c.profile_picture,c.uniquekey,p.id, p.customer_id, p.added_date, p.replied_date, p.question, p.adminreply from product_queries p, customer c where p.product_code = '$product_code' and p.customer_id = c.id";
										$executegetQuestions = mysqli_query($conn, $getQuestions);
										if(mysqli_num_rows($executegetQuestions) > 0){
											$no_of_questions = mysqli_num_rows($executegetQuestions);
											echo'<h3 class="comment-title">Questions (<span id="holdNumberOfQueries">'.$no_of_questions.'</span>)</h3>';
											while($row = mysqli_fetch_assoc($executegetQuestions)){																	
												$formatteddate1 = formatDate($row['added_date']);
												$formattedtime1 = formatTime($row['added_date']);
												if($row['profile_picture']=="notset"){
													if($row['gender']=="Male"){
														$imagesrc =  'img/maleuser.png';
													}
													else{
														$imagesrc =  'img/femaleuser.png';
													}  
												   }
												   else{
													if(file_exists('img/UserProfile/'.$row['uniquekey'].'/'.$row['profile_picture'].'')){
														$imagesrc =  'img/UserProfile/'.$row['uniquekey'].'/'.$row['profile_picture'].'';   
													}
													else{
														if($row['gender']=="Male"){
															$imagesrc =  'img/maleuser.png';
														}
														else{
															$imagesrc =  'img/femaleuser.png';
														}                                                    
													}
													
												   } 												
												echo'<div class="single-comment" id="holdQueryOfCustomers'.$row['id'].'">
												<img src="'.$imagesrc.'" alt="userimage">
												<div class="content">
												<h4>'.$row['name'].'<span>'.$formatteddate1.' at '.$formattedtime1.'</span></h4>
												<p>'.$row['question'];
												if(isset($_SESSION['id'])){
													if($row['customer_id']==$user_id){
														echo'<span data-bs-toggle="collapse" href="#deleteQuestionDiv'.$row['id'].'" role="button" aria-expanded="false" aria-controls="deleteQuestionDiv'.$row['id'].'" id="deleteQuestion'.$row['id'].'" title="Delete Question" style="cursor:pointer;">&nbsp&nbsp<i class="fa fa-trash"></i></span>';
													}
												}																										
												echo'</p>   	
												<div class="collapse querybutton" id="deleteQuestionDiv'.$row['id'].'">												
												Are you sure you want to delete this question??
												<br>
												<button id="deleteQuestionButton'.$row['id'].'" class="btn btn-danger">Delete</button>
												<button id="hideDeleteQuestionDiv'.$row['id'].'" class="btn btn-dark">Cancel</button>
												</div>										    
												</div>
											</div>';
											if($row['adminreply']!="-"){
												$formatteddate2 = formatDate($row['replied_date']);
												$formattedtime2 = formatTime($row['replied_date']);
												echo'<div class="single-comment left">
												<img src="img/logored.png" alt="adminimage">
												<div class="content">
													<h4>Dns Electronics<span>'.$formatteddate2.' at '.$formattedtime2.'</span></h4>
													<p>'.$row['adminreply'].'</p>      													         
												</div>
											</div>';
											}
											}
										}
										else{
											echo'<h3 class="comment-title">Questions (0)</h3>
											<div class="single-comment">
											
											<h7>No questions for this product yet.</h7>
											</div>
											';
										}
										?>																			
									</div>									
								</div>											
											
							</div>
						</div>
					</div>					
				</div>
			</div>
		</section>
					</div>

					<input type="radio" name="tabs" id="tabthree">
					<label class="btn"  for="tabthree">Seller Info</label>
					<div class="tab card">
					<table class="table table-responsive table-hover">
								<tr><th><i class="fas fa-user"></i> Sold by </th><td>Dns Electronics</td></tr>								
								<tr><th><i class="fas fa-phone-alt"></i> Contact Number </th><td>+9771234567890</td></tr>
								<tr><th><i class="fas fa-shipping-fast"></i> Delivery Time </th><td>3-5 Working Days</td></tr>								
					</table>
					</div>
				</div>

			</div>

		</div>
		<!-- Left Column / Headphones Image -->
	</div>
	<div class="product-area most-popular section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Similar Products</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="owl-carousel popular-slider">
						<!-- Start Single Product -->
						<?php
						$similarProduct = "Select * from product where category = '$category' and code <> '$product_code'";
						$similarProductQuery = mysqli_query($conn, $similarProduct);
						while ($row = mysqli_fetch_assoc($similarProductQuery)) {
							
							echo '					
								<div class="single-product">
								<p style="visibility: hidden; font-size:16px;" id="result' . $row['code'] . '">Result</p>
									<div class="product-img">
										<a href="singleproduct.php?i=' . $row['code'] . '">
											<img class="default-img" src="admin/images/products/' . $row['sold_by'] .'/'.$row['image_folder_key'].'/'.$row['image_name'] . '" alt="#">
											<img class="hover-img" src="admin/images/products/' . $row['sold_by'] .'/'.$row['image_folder_key'].'/'.$row['image_name'] . '" alt="#">
										</a>
										<div class="button-head">
											<div class="product-action">
												<p data-bs-toggle="modal" data-bs-target="#modalbox' . $row['code'] . '" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></p>
												<p title="Favourite" id="favourite' . $row['code'] . '" href="#"><i class="ti-heart"></i><span id="toFavourite' . $row['code'] . '">Add to Favourite</span></p>
												<p title="Compare" id="compare' . $row['code'] . '" href="#"><i class="ti-bar-chart-alt"></i><span id="toCompare' . $row['code'] . '">Add to Compare</span></p>
											</div>
											<div class="product-action-2">
												<p title="Add to cart" id="cart' . $row['code'] . '">Add to cart</p>																								
											</div>
										</div>
									</div>
									<div class="product-content">
										<h3><a href="singleproduct.php?i=' . $row['code'] . '">' . $row['name'] . '</a></h3>
										<div class="product-price">';
							echo '<span style="margin-right:4px;">Rs</span>';
							if ($row['discount'] != 0) {
								$discount = $row['discount'];
								echo '<span style="text-decoration: line-through; color:#ef271b;">' . $row['price'] . '</span>';
								echo '<span> ' . ($row['price'] - $discount) . '</span>';
							}
							else{
								echo '<span>' . $row['price'] . '</span>';
							}
							
										echo'</div>
									</div>
								</div>';
						}
						?>

						<!-- End Single Product -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
						$similarProduct = "Select * from product where category = '$category' and code <> '$product_code'";
						$similarProductQuery = mysqli_query($conn, $similarProduct);
						while ($row = mysqli_fetch_assoc($similarProductQuery)) {						
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
						}
						?>
	<?php
	include "layouts/footer.php";
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
	<script src="assets/js/singleproduct.js"></script>
	<script src="assets/js/star-rating.js"></script>
	<script src="assets/plugin/toastr/js/toastr.min.js"></script>
  <script src="assets/plugin/toastr/js/toastr.init.js"></script>
	<script>
		var starRatingControl = new StarRating('.star-rating', {
        maxStars: 5,        
        clearable: false,
        stars: function(el, item, index) {
            el.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect class="gl-star-full" width="19" height="19" x="2.5" y="2.5"/><polygon fill="#FFF" points="12 5.375 13.646 10.417 19 10.417 14.665 13.556 16.313 18.625 11.995 15.476 7.688 18.583 9.333 13.542 5 10.417 10.354 10.417"/></svg>';
        },        		
        classNames: {
            active: 'gl-active',
            base: 'gl-star-rating',
            selected: 'gl-selected',
        },

    });    
	</script>

</body>

</html>