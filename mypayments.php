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
							<li class="active"><a href="profile.php">My Profile</a></li>
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
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Edit Profile</h4>
                  <p class="card-category">Complete your profile</p>
                </div>
                <div class="card-body">
                  <form>
                    <?php
                    $userid = $_SESSION['id'];
                    $sql = "Select * from customer where id = '$userid'";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                      while($row = mysqli_fetch_assoc($result)){
                        $username = $row['username'];
                        $fname = explode(' ',$row['name'])[0];
                        $lname = explode(' ',$row['name'])[1];
                        $email = $row['email'];
                        $phone = $row['phone_no'];
                        $age = $row['age'];
                        $gender = $row['gender'];
                        $pp = $row['profile_picture'];
                        $joined = $row['joined_date'];
                        $uniquekey = $row['uniquekey'];
                        if($row['approved'] == "YES"){
                          $approved = "Verified";
                        }
                        else{
                          $approved = "Not Verified";
                        }
                        if($row['active'] == "YES"){
                          $active = "Active";
                        }
                        else{
                          $active = "Inactive";
                        }
                        
                      }
                    }
                    ?>
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="bmd-label-floating">Country (disabled)</label>
                          <input type="text" class="form-control" value="Nepal" disabled>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Username</label>
                          <input type="text" class="form-control" disabled value="<?php echo $username; ?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email address</label>
                          <input type="email" class="form-control" disabled value="<?php echo $email; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">First Name</label>
                          <input type="text" class="form-control" value="<?php echo $fname; ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Last Name</label>
                          <input type="text" class="form-control" value="<?php echo $lname; ?>">
                        </div>
                      </div>
                    </div>                    
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Age</label>
                          <input type="text" class="form-control" value="<?php echo $age; ?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Phone Number</label>
                          <input type="text" class="form-control" value="<?php echo $phone; ?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                        <label class="bmd-label-floating">Password</label>
                          <input type="password" class="form-control" value="-----------">           
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                        <label class="bmd-label-floating">Gender</label>
                          <select style="padding: 5px;" class="form-control">
                            <option>Male</option>
                            <option>Female</option>
                            <option>Not Specified</option>
                          </select>       
                        </div>
                      </div>                    
                    </div>         
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Account Details</label>
                          <div class="row">
                          <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Joined Date</label>
                          <input type="text" class="form-control" disabled value="<?php echo $joined; ?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Account Verification</label>
                          <input type="text" class="form-control" disabled value="<?php echo $approved; ?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Status</label>
                          <input type="text" class="form-control" disabled value="<?php echo $active; ?>">
                        </div>
                      </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 d-flex justify-content-center">
                      <button type="submit" class="btn btn-dark">Update Profile</button>
                      </div>
                    </div>
                    
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-profile">
                <div class="card-avatar">
                  <a href="javascript:;">
                    <?php
                    echo'<img class="img" src="img/UserProfile/'.$uniquekey.'/'.$pp.'" />';
                    ?>
                    
                  </a>
                </div>
                <div class="card-body">
                  <h6 class="card-category text-gray">Verified Customer</h6>
                  <h4 class="card-title">
                    <?php
                    if(isset($_SESSION['name'])){
                      echo $_SESSION['name'];
                    }
                    ?>
                  </h4>
                 
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