<?php
include('database/connect.php');
$showPackages = false;
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
	<link href="assets/plugin/toastr/css/toastr.min.css" rel="stylesheet">
	<!-- Themify Icons -->
	<link rel="stylesheet" href="assets/css/themify-icons.css">
	<!-- Nice Select CSS -->
	<link rel="stylesheet" href="assets/css/niceselect.css">
	<!-- Animate CSS -->
	<link rel="stylesheet" href="assets/css/animate.css">
	<!-- Flex Slider CSS -->
	<!-- Slicknav -->
	<link rel="stylesheet" href="assets/css/slicknav.min.css">

	<!-- custom StyleSheet -->
	<link rel="stylesheet" href="assets/css/reset.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/membership.css">
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
	include "layouts/navbar.php";
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
							<li class="active"><a href="membership.php">Membership</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

	<section id="membership" class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php
					// check if user has membership or not
					if (isset($_SESSION['id'])) {
						$userid = $_SESSION['id'];
						$userhaspackagechecksql = "Select package_id from membership where user_id = '$userid' and membership.active = 'Yes'";
						$userhaspackagechecksqlResult = mysqli_query($conn, $userhaspackagechecksql);
						$hasMembership = mysqli_num_rows($userhaspackagechecksqlResult) == 0 ? false : true;						
						if ($hasMembership) {
							echo '<h3 style="text-align:center;">You are our premium member.</h3>
										<h5 style="text-align:center;">Enjoy the benefits we offer with our memberships.</h5>        
										';
						} else {
							echo '<h3 style="text-align:center;">GET STARTED WITH US</h3>
										<h5 style="text-align:center;">Enjoy the benefits we offer with our memberships.</h5>        
										';
						}				
						echo'<div class="pricing-table holdPackages">';						
						$activePackage = "Select *, ($userhaspackagechecksql) as activeid  from membership_packages";
						packages($conn, $activePackage, false);
					} else {
						echo '<h3 style="text-align:center;">GET STARTED WITH US</h3>
										<h5 style="text-align:center;">Enjoy the benefits we offer with our memberships.</h5>       
										<div class="pricing-table holdPackages"> 
										';
						$getMembership = "Select * from membership_packages";
						packages($conn, $getMembership, true);
					}						
					function packages($conn, $sql, $showPackages)
					{
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_assoc($result)) {
								$packageid = $row['id'];
								$coupons = $row['coupons'] == "Yes" ? "Available" : "Not available";
								$giveaway = $row['giveaway'] == "Yes" ? "Available" : "Not available";
								if ($row['duration'] == "Weekly") {
									$durationTag = "W";
								} else if ($row['duration'] == "Monthly") {
									$durationTag = "M";
								} else if ($row['duration'] == "Yearly") {
									$durationTag = "Y";
								}
								if ($showPackages) {
									$featured = $row['featured_item'] == "Yes" ? "featured-item" : "";
								} else {
									if ($row['id'] == $row['activeid']) {
										$featured = "featured-item";
									} else {
										$featured = "";
									}
								}
								echo '
								<div class="ptable-item ' . $featured . '">
								<div class="ptable-single">
									<div class="ptable-header">
										<div class="ptable-title">
											<h2>' . $row['type'] . '</h2>
										</div>
										<div class="ptable-price">
											<h2><small>Rs</small>' . $row['price'] . '<span>/ ' . $durationTag . '</span></h2>
										</div>
									</div>
									<div class="ptable-body">
										<div class="ptable-description">
											<ul>
												<li>Product Discount: ' . $row['discount'] . '% off</li>
												<li>Delivery Charge: ' . $row['delivery_charge'] . '% off</li>
												<li>Discount Coupons: ' . $coupons . '</li>
												<li>Giftaway Participation: ' . $giveaway . '</li>
											</ul>
										</div>
									</div>
									<div class="ptable-footer">
										<div class="ptable-action">';
											if(!$showPackages){
												if ($row['id'] == $row['activeid']) {
													echo'<h5 style="color:#fff;" class="mt-1" id="packageid' . $row['id'] . '">Activated</h5>';
												} else {
													echo'<button class="chooseMembership" id="packageid' . $row['id'] . '"><i class="fa fa-shopping-cart"></i> &nbsp Choose</button>';
												}
											}
											else{
												echo'<button class="chooseMembership" id="packageid' . $row['id'] . '"><i class="fa fa-shopping-cart"></i> &nbsp Choose</button>';
											}
											
										echo'</div>
									</div>
								</div>
							</div>
							';
							}
						} else {
						}
					}
					?>
				</div>
			</div>
		</div>
		</div>
	</section>

	<!-- Start Footer Area -->
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
	<!-- Color JS -->

	<!-- Slicknav JS -->
	<script src="assets/js/slicknav.min.js"></script>
	<!-- Owl Carousel JS -->
	<!-- Magnific Popup JS -->
	<script src="assets/js/magnific-popup.js"></script>
	<!-- Fancybox JS -->
	<script src="assets/js/facnybox.min.js"></script>
	<!-- Waypoints JS -->
	<script src="assets/js/waypoints.min.js"></script>
	<!-- Countdown JS -->
	<!-- Nice Select JS -->
	<script src="assets/js/nicesellect.js"></script>
	<!-- Ytplayer JS -->
	<!-- Flex Slider JS -->
	<!-- ScrollUp JS -->
	<script src="assets/js/scrollup.js"></script>
	<!-- Onepage Nav JS -->
	<script src="assets/js/onepage-nav.min.js"></script>
	<!-- Easing JS -->
	<script src="assets/js/easing.js"></script>
	<!-- Active JS -->
	<script src="assets/js/active.js"></script>
	<script src="assets/js/membership.js"></script>
	<script src="assets/plugin/toastr/js/toastr.min.js"></script>
	<script src="assets/plugin/toastr/js/toastr.init.js"></script>
	<script>
		$('html, body').animate({
			scrollTop: $(".bread-list").offset().top
		}, 1000);
	</script>
</body>

</html>