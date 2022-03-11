<?php
include('database/connect.php');
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
    <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
	<!-- Magnific Popup -->
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
	<!-- Font Awesome -->
    
	<!-- Fancybox -->
	<link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
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
							<li class="active"><a href="profile.php">My Payment</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>	
	<!-- User Profile -->
	<div class="section">
  <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-dark">
                                    <h4 class="card-title ">Payments</h4>
                                    <p class="card-category"> Your payment details</p>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class=" text-danger">                                                
                                                <th>
                                                    OrderID
                                                </th>
                                                <th>
                                                    Type
                                                </th>
                                                <th>
                                                    TransactionID
                                                </th>
                                                <th>
                                                    Due Total (Rs)
                                                </th>
                                                <th>
                                                    Paid (Rs)
                                                </th>                                               
                                                <th>
                                                    Paid Date
                                                </th>
                                                <th>
                                                    Status
                                                </th>
                                            </thead>
                                            <tbody>
                                                
                                                    <?php
                                                    $userid = $_SESSION['id'];
                                                    $getPaymentDetails = "Select p.id, p.payment_type, p.transaction_id, p.order_id, p.due_amount, p.paid_amount, p.paid_date, p.status from payment p,orders o where o.user_id = '$userid' and o.id = p.order_id order by p.paid_date ASC";
                                                    $getPaymentDetailsResult = mysqli_query($conn, $getPaymentDetails);
                                                    if(mysqli_num_rows($getPaymentDetailsResult) > 0){
                                                        while($row = mysqli_fetch_assoc($getPaymentDetailsResult)){
                                                            $transaction_id = ($row['transaction_id'] == 0 ? '-' : $row['transaction_id']);
                                                            echo'<tr>                                                            
                                                            <td title="Click to see order details"><a class="text-success" target="_blank" href="orderdetail.php?i='.$row['order_id'].'">'.$row['order_id'].'</a></td>
                                                            <td>'.$row['payment_type'].'</td>
                                                            <td>'.$transaction_id.'</td>
                                                            <td>'.$row['due_amount'].'</td>
                                                            <td>'.$row['paid_amount'].'</td>                                                            
                                                            <td>'.$row['paid_date'].'</td>
                                                            <td>'.$row['status'].'</td>
                                                            </tr>';
                                                        }
                                                    }
                                                    else{
                                                        echo'<tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>';
                                                    }
                                                    ?>                                                                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
  </div>
  <!--/ End User Profile -->
	
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
  <script src="assets/plugin/toastr/js/toastr.min.js"></script>
  <script src="assets/plugin/toastr/js/toastr.init.js"></script>
	<!--custom page js -->	
</body>
</html>