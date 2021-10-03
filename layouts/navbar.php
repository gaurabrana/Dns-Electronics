<?php
include("database/connect.php");
?>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<!-- Header -->
<header class="header shop">
	<!-- Topbar -->
	<div class="topbar">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-12 col-12">
					<!-- Top Left -->
					<div class="top-left">
						<ul class="list-main">
							<li><i class="ti-headphone-alt"></i> +9770123456789</li>
							<li><i class="ti-email"></i> mail@dnselectronics</li>
						</ul>
					</div>
					<!--/ End Top Left -->
				</div>
				<div class="col-lg-8 col-md-12 col-12">
					<!-- Top Right -->
					<div class="right-content">
						<ul class="list-main">
							<li><i class="ti-location-pin"></i> Nepal</li>							
							<li><i class="ti-user"></i>
								<?php
								if (isset($_SESSION['name'])) {
									echo '<div class="btn-group"><a style="cursor:pointer;" id="loginbutton" class="dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" data-bs-auto-close="false" aria-expanded="false">
										' . $_SESSION['name'] . '</a>
										<ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="dropdownMenuLink">
												<li class="userProfile"><i class="fa fa-user-circle"></i><a class="dropdown-item" href="user/user.php">UserProfile</a></li>
												<li class="userProfile"><i class="fa fa-list-alt" aria-hidden="true"></i>
												<a class="dropdown-item" href="user/myorders.php">Orders</a></li>
												<li class="userProfile"><i class="fa fa-credit-card" aria-hidden="true"></i><a class="dropdown-item" href="user/mypayments.php">Payments</a></li>
												<li class="userProfile"><i class="fa fa-shopping-cart"></i><a class="dropdown-item" href="cart.php">Cart</a></li>
												<li class="userProfile"><div><i class="far fa-heart" aria-hidden="true"></i><a class="dropdown-item" href="favourite.php">Favourites</a></li>
												<li class="userProfile"><i class="ti-power-off"></i><a class="dropdown-item" href="database/logout.php">Logout</a></li>
											</ul>';
								} else {
									echo '<div class="btn-group"><a style="cursor:pointer;" id="loginbutton" class="dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" data-bs-auto-close="false" aria-expanded="false">
										Login
									</a>
									<ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="loginbutton">
										<div class="form-fields">
											<div class="loginform">										
												
													<i class="ti-power-off"></i><label for="email">Email Address</label>
													<input type="email" id="email_log" name="email" required>
													<i class="ti-power-off"></i><label for="password">Password</label>
													<input type="password" id="password_log" name="password" required>
												
												<div class="form-group login-btn">
													<button class="btn navbarlogin">Login</button>
													<button class="btn navbarregister">Register</button>
												</div>
												<div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
													<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
												</div>
											</div>
											<div class="checkbox">
												<label class="check" for="2"><input name="rememberme" id="rememberme" type="checkbox">Remember me</label>
											</div>
											
											<a href="#" class="lost-pass">Lost your password?</a>
										</div>';
								}
								?>
								</a>



							</li>

					</div>
					</ul>
				</div>
				</li>
				</ul>
				<!-- End Top Right -->
			</div>
		</div>
	</div>
	</div>
	<!-- End Topbar -->
	<div class="middle-inner">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-md-2 col-12">
					<!-- Logo -->
					<div class="logo">
						<a href="index.php"><img src="img/logored.png" alt="logo"></a>
					</div>
					<!--/ End Logo -->
					<!-- Search Form -->
					<div class="search-top">
						<div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
						<!-- Search Form -->
						<div class="search-top">
							<form class="search-form" id="searchProductSmall" action="shop-grid.php" method="POST">
								<input type="text" placeholder="Search here..." name="search">
								<button value="search" type="submit"><i class="ti-search"></i></button>
							</form>
						</div>
						<!--/ End Search Form -->
					</div>
					<!--/ End Search Form -->
					<div class="mobile-nav"></div>
				</div>
				<div class="col-lg-8 col-md-7 col-12">					
					<div class="search-bar-top">
						<div class="search-bar">
							<select id="categorySearch">
								<option selected="selected" value="all">All Category</option>
								<?php
								$sql = "Select distinct category from product";
								$result = mysqli_query($conn, $sql);
								while($row = mysqli_fetch_assoc($result)){
									echo'<option value="'.$row['category'].'">'.$row['category'].'</option>';
								}
								?>

							</select>		
							<form id="searchProductShow" action="shop-grid.php" method="POST">
								<input id="searchProduct" name="search" placeholder="Search Products Here....." type="search">
								<button class="btnn" name="searchbtn" id="SearchProductPage"><i class="ti-search"></i></button>
							</form>							
						</div>											
					</div>
					<div class="search-bar-popup">
						<div class="search-list">
							<a class="suggest-list" href="#"></a>
						</div>
					</div>																					
				</div>
				<div class="col-lg-2 col-md-3 col-12">
					<div class="right-bar">
						<!-- Search Form -->											
						<?php
						if (isset($_SESSION['name'])) {
							$cartid = $_SESSION['cartid'];
							$getcartitem = "Select p.id, c.id as productcartid, p.quantity_stock, p.code, p.name,p.sold_by, p.image_name, p.price, p.discount, p.description, c.quantity from product p, product_in_cart c where c.cart_id = '$cartid' and p.code = c.product_code";
							$cartquery = mysqli_query($conn, $getcartitem);
							$totalItems = mysqli_num_rows($cartquery);
							echo '<div class="sinlge-bar">
							<a href="favourite.php" class="single-icon"><i class="fal fa-heart fa-lg" aria-hidden="true"></i></a>
						</div><div class="sinlge-bar shopping">
								<a href="#" class="single-icon"><i class="fal fa-bags-shopping fa-lg"></i> <span class="total-count">' . $totalItems . '</span></a>
								<!-- Shopping Item -->
								<div class="shopping-item">
									<div class="dropdown-cart-header">
										<span>' . $totalItems . ' Items</span>
										<a href="cart.php">View Cart</a>
									</div>
									<ul class="shopping-list">';
							$total = 0;
							while ($row = mysqli_fetch_assoc($cartquery)) {
								$subtotal = 0;
								if ($row['discount'] != 0) {
									$updatedPrice = $row['price'] - $row['discount'];
								} else {
									$updatedPrice = $row['price'];
								}
								$subtotal = $row['quantity'] * $updatedPrice;
								$total = $total + $subtotal;
								echo '<li>
										
										<a class="cart-img" href="singleproduct.php?i=' . $row['code'] . '"><img src="admin/images/products/' . $row['sold_by'] . '/' . $row['image_name'] . '" alt="#"></a>
										<h4><a href="singleproduct.php?i=' . $row['code'] . '">' . $row['name'] . '</a></h4>
										<p class="quantity">' . $row['quantity'] . 'x - <span class="amount">Rs ' . $subtotal . '</span></p>
									</li>';
							}
							echo '</ul>
									<div class="bottom">
										<div class="total">
											<span>Total</span>
											<span class="total-amount">Rs '.$total.'</span>
										</div>
										<a href="checkout.php" class="btn animate">Checkout</a>
									</div>
								</div>
								<!--/ End Shopping Item -->
							</div>';
						}
						?>

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Header Inner -->

	<div class="header-inner">
		<div class="container">
			<div class="cat-nav-head">
				<div class="row">
					<?php
					if (isset($show_collection)) {
						if ($show_collection == "homepage") {
							echo '<div class="col-lg-3">
							<div class="all-category">
								<h3 class="cat-heading"><i class="fa fa-bars" aria-hidden="true"></i>CATEGORIES</h3>
								<ul class="main-category">
									<li>
										<a href="#">New Arrivals <i class="fa fa-angle-right" aria-hidden="true"></i></a>
										<ul class="sub-category">';
							$sql = "select name,code from product order by added_date desc LIMIT 5";
							$result = mysqli_query($conn, $sql);
							while ($row = mysqli_fetch_assoc($result)) {
								echo '<li><a href="singleproduct.php?i='.$row['code'].'">' . $row['name'] . '</a></li>';
							}
							echo '</ul>
									</li>
									<li class="main-mega">
										<a href="#">best selling <i class="fa fa-angle-right" aria-hidden="true"></i></a>
										<ul class="mega-menu">';
							$sql = "Select name, code, image_name, sold_by from product p , order_item o where o.product_code = p.code order by count(product_code) DESC";
							$result = mysqli_query($conn, $sql);
							while ($row = mysqli_fetch_assoc($result)) {
								echo '<li class="single-menu">
												
											<div class="image">
												<img src="admin/images/products/' . $row['sold_by'] . '/' . $row['image_name'] . '" alt="#">
											</div>
											<div class="inner-link">
												<a href="singleproduct.php?i='.$row['code'].'">' . $row['name'] . '</a>
											</div>
										</li>';
							}
							echo '											
										</ul>
									</li>
									<li class="main-mega">
										<a href="#">Brands <i class="fa fa-angle-right" aria-hidden="true"></i></a>
										<ul class="sub-category">';
							$sql = "select distinct brand from product ";
							$result = mysqli_query($conn, $sql);
							while ($row = mysqli_fetch_assoc($result)) {
								echo '<li><a href="shop-grid.php?qb='.$row['brand'].'">' . $row['brand'] . '</a></li>';
							}
							echo '</ul>
									</li>';
							$sql = "select distinct category from product";
							$result = mysqli_query($conn, $sql);
							while ($row = mysqli_fetch_assoc($result)) {
								echo '<li><a href="shop-grid.php?qc='.$row['category'].'">' . $row['category'] . '</a></li>';
							}
							echo '</ul>
							</div>
						</div>';
						}
					}
					?>
					<div class="col-lg-9 col-12">
						<div class="menu-area">
							<!-- Main Menu -->
							<nav class="navbar navbar-expand-lg">
								<div class="navbar-collapse">
									<div class="nav-inner">
										<ul class="nav main-menu menu navbar-nav">
											<li class="active"><a href="index.php">Home</a></li>
											<li><a href="shop-grid.php">Product</a></li>
											<li><a href="#">Service</a></li>
											<li>
												<a href="#">Shop<i class="ti-angle-down"></i><span class="new">New</span></a>
												<ul class="dropdown">

													<li><a href="shop-grid.php">Shop Grid</a></li>

													<li><a href="cart.php">Cart</a></li>
													<li><a href="checkout.php">Checkout</a></li>
												</ul>
											</li>
											<li><a href="#">Pages<i class="ti-angle-down"></i></a>
												<ul class="dropdown">
													<li><a href="traders/login.php">Sell my products</a></li>
												</ul>
											</li>
											<li>
												<a href="#">Blog<i class="ti-angle-down"></i></a>
												<ul class="dropdown">
													<li><a href="blog-single-sidebar.php">Blog Single Sidebar</a></li>
												</ul>
											</li>
											<li><a href="contact.php">Contact Us</a></li>
										</ul>
									</div>
								</div>
							</nav>
							<!--/ End Main Menu -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/ End Header Inner -->
</header>
<script src="js/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		$(".navbarregister").click(function() {
			alert("ok");
			window.location.href = "./register.php";
		});
		$(".navbarlogin").click(function() {
			$(".navbarlogin").prop('disabled', true);

			var email = $('#email_log').val();
			var password = $('#password_log').val();
			var rememberme = false;
			var currentLocation = window.location.href;			
			if($("#rememeberme").prop('checked')){
				rememberme = true;
			}
			else{
				rememberme = false;
			}

			if (email != "" && password != "") {
				$.ajax({
					url: "database/logindata.php",
					type: "POST",
					data: {
						type: "login",
						email: email,						
						password: password,
						rememberuser: rememberme
					},
					cache: false,
					success: function(dataResult) {
						var dataResult = JSON.parse(dataResult);
						if (dataResult.statusCode != null) {							
							if (dataResult.statusCode != 202) {
								$("#error").show();
							}
						}
						if (dataResult.statusCode == 200) {
							$('#error').html('User not found.');
							$("#error").fadeOut(4300);
							//$("#error").slideUp(300).delay(8000).fadeOut(400);
							$(".navbarlogin").removeAttr('disabled');
						} else if (dataResult.statusCode == 201) {
							$('#error').html('Invalid Password !');
							$("#error").fadeOut(4300);
							//$("#error").slideUp(300).delay(8000).fadeOut(400);	
							$(".navbarlogin").removeAttr('disabled');
						} else if (dataResult.statusCode == 202) {
							location.href = currentLocation;
						}
					}
				});
			} else {
				$('#error').html('Please fill all fields.');
				$("#error").show();
				$("#error").fadeOut(4300);
				$(".navbarlogin").removeAttr('disabled');
			}
		});

	});
</script>