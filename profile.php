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
    <link href="assets/plugin/toastr/css/toastr.min.css" rel="stylesheet">
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
                  <h4 class="card-title">User Profile</h4>
                  <p class="card-category">Edit your profile</p>
                </div>
                <div class="card-body">
                  <form id="userprofile">
                    <?php
                    $userid = $_SESSION['id'];
                    $sql = "Select * from customer where id = '$userid'";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                      while($row = mysqli_fetch_assoc($result)){
                        $username = $row['username'];
                        $fname = $row['name'];                        
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
                          <input type="text" class="form-control" value="Nepal" disabled required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Username (disabled)</label>
                          <input type="text" class="form-control" disabled value="<?php echo $username; ?>" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email address</label>
                          <input type="email" id="usercurrentemail" class="form-control" disabled value="<?php echo $email; ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Full Name</label>
                          <input type="text" class="form-control" id="fullusername" name="userfname" value="<?php echo $fname; ?>" required>
                        </div>
                      </div>  
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Age</label>
                          <input type="number" class="form-control" min="16" max="99" name="userage" value="<?php echo $age; ?>" required>
                        </div>
                      </div>    
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Phone Number</label>
                          <input type="text" class="form-control" name="userphone" value="<?php echo $phone; ?>" required>
                        </div>
                      </div>               
                    </div>                                        
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                        <label class="bmd-label-floating">Gender</label>
                          <select style="padding: 5px;" name="usergender" class="form-control" required>
                          <?php                          
                            echo'<option value="Male"'; if($gender=="Male"){echo " selected "; }echo'>Male</option>
                            <option value="Female"'; if($gender=="Female"){echo " selected "; }echo'>Female</option>
                            <option value="private"'; if($gender=="private"){echo " selected "; }echo'>Rather not say</option>';
                          ?>
                            
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
                          <input type="text" class="form-control" disabled value="<?php echo $joined; ?>" required >
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Account Verification</label>
                          <input type="text" class="form-control" disabled value="<?php echo $approved; ?>" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Status</label>
                          <input type="text" class="form-control" disabled value="<?php echo $active; ?>" required>
                        </div>
                      </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 d-flex justify-content-center">
                      <button type="submit" id="updateUserProfileButton" class="btn btn-dark">Update Profile</button>
                      </div>
                    </div>
                    
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="row">
              <div class="card card-profile">
                <div class="card-avatar">
                <form id="msform" method="POST" enctype="multipart/form-data" action="database/updateprofile.php" autocomplete="off">                
                <div id="imgContainer">                                    
                                        <div id="imgArea"><img id="usericon" title="Click to change" <?php echo' src="img/UserProfile/'.$uniquekey.'/'.$pp.'"'; ?>>
                                            <div class="progressBarImageUpload">
                                                <div class="bar"></div>
                                                <div class="percent">0%</div>
                                            </div>
                                            <div id="imgChange"><span>Change Photo</span>
                                                <input type="file" accept="image/*" name="image_upload_file" id="image_upload_file">                                                                                                      
                                            </div>
                                        </div>

                                        <p style="color:black;margin:8px 0px; font-size:medium;cursor:pointer;" id="reset" onclick="resetUpload()">Reset</p>                                                                                
                                    </div>       
                                    </form>                   
                </div>
                <div class="card-body">
                  <h6 class="card-category text-gray">Verified Customer</h6>
                  <h4 class="card-title" id="customername">
                    <?php
                    if(isset($_SESSION['name'])){
                      echo $_SESSION['name'];
                    }
                    ?>
                  </h4>
                  <ul>
                    <li data-bs-toggle="collapse" href="#useremailchange" id="emailChange" aria-expanded="false" aria-controls="useremailchange" class="btn btn-dark">Change Email Addresss</li>
                    <li data-bs-toggle="collapse" href="#userpasswordchange" id="passwordChange" aria-expanded="false" aria-controls="userpasswordchange" class="btn btn-dark">Change Account Password</li>
                    </ul>
                </div>
              </div>
              </div>
              <div class="row collapse" id="useremailchange">
                    <div class="card">
                    <div class="card-header card-header-primary">
                    <h4 class="card-title">Change Email Address</h4>                  
                    </div>
                      <div class="card-body" id="holdemailupdateform">
                        <?php
                        $userid = $_SESSION['id'];
                        $checkExistingRequest = "Select * from email_update where user_id = '$userid' and status = 'ongoing' ";
                        $checkExistingRequestresult = mysqli_query($conn, $checkExistingRequest);
                        $email;
                        if(mysqli_num_rows($checkExistingRequestresult) > 0){
                          $hasRequest = true;
                          $requestid;                          
                          include("formatdate.php");
                          while($row = mysqli_fetch_assoc($checkExistingRequestresult) ){
                            $validity_date = $row['validity_date'];
                            $to_time = strtotime($validity_date);
                            $from_time = strtotime(date("Y-m-d h:i:s A"));
                            $time_left =  round(abs($to_time - $from_time)). " seconds";
                            $email = $row['new_email'];
                            $requestid = $row['id'];
                            $isValid = checkDateTime($validity_date);                                  
                          }
                          if(!$isValid){
                            //delete request
                            $expirerequest = "Update email_update set status = 'expired' where id = '$requestid'";
                            $expirerequestresult = mysqli_query($conn, $expirerequest);                            
                          }                           
                        }
                        else{
                          $hasRequest = false;
                          $isValid = false;
                        }                                              
                        ?>
                      <form id="<?php if($hasRequest && $isValid){echo"accountEmailChangeOTPcodeForm";}else{echo"accountEmailChangeForm";} ?>" autocomplete="off">
                      <div class="row">                                            
                      <?php
                      if($hasRequest && $isValid){                                          
                        echo'<div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email Change in process: <br/>Expires after <span id="timeleft">'.$validity_date.'</span></label>                          
                          <br>
                          Code has been sent to <i><b>'.$email.'</b></i>
                        </div>
                      </div>       
                        <div class="col-md-12" id="OtpCode">
                        <div class="form-group">
                          <label class="bmd-label-floating">One Time Code</label>
                          <input type="text" maxlength="6" class="form-control" name="otpcode" placeholder="Enter OTP code to verify new email address" required>
                        </div>
                      </div>
                      <div class="progress-bar bg-info progress-bar-striped" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;" role="progressbar"><span class="sr-only">85% Complete (success)</span>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">                          
                          <button type="submit" class="form-control btn btn-dark" name="Submit">Verify Code</button>                         
                        </div>
                      </div>
                      <div class="col-md-6">
                      <div class="form-group">                                                  
                        <button class="form-control btn btn-dark" name="Submit">Reset</button>
                      </div>
                    </div>';
                      }
                      else{
                        echo'
                        <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email address</label>
                          <input type="email" class="form-control" id="newEmailAddressChange" name="newemail" placeholder="Enter your new email address" required autocomplete="off">
                        </div>
                      </div>                      
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Password</label>
                          <input type="password" class="form-control" name="currentpass" placeholder="Enter your current password" required autocomplete="off">
                        </div>
                      </div>
                        <div class="col-md-12 hide-element" id="OtpCode">
                        <div class="form-group">
                          <label class="bmd-label-floating">One Time Code</label>
                          <input type="text" maxlength="6" class="form-control" disabled name="otpcode" placeholder="Enter OTP code to verify new email address" required>
                        </div>
                      </div>
                      <div class="col-md-12">
                      <div class="form-group">
                      <div class="progress mb-3" style="height: 11px">
                                    <div id="emailaddressprogressbar" class="progress-bar active progress-bar-striped bg-danger" style="width: 0%;" role="progressbar">
                                    </div>
                                </div>
                      </div>
                      
                      <div class="col-md-12">
                        <div class="form-group">                          
                          <button type="submit" class="form-control btn btn-dark" name="Submit">Send OTP code</button>
                        </div>
                      </div>';
                      }                      
                      ?>                                            
                      </form>                         
                    </div> 
                      </div>
                    </div>
              </div>  
              <div class="row collapse" id="userpasswordchange">
                    <div class="card">
                    <div class="card-header card-header-primary">
                    <h4 class="card-title">Change Account Password</h4>                  
                    </div>
                      <div class="card-body">
                      <form id="accountPasswordChangeForm">
                      <div class="row">
                       
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Old Password</label>
                          <input type="password" class="form-control" placeholder="Enter your current password" required autocomplete="off">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                        <label class="bmd-label-floating">New Password</label>
                          <input type="password" class="form-control" placeholder="Enter new password" required autocomplete="off">
                        </div>
                      </div> 
                      <div class="col-md-12">
                        <div class="form-group">                          
                          <button type="submit" class="form-control btn" name="Submit">Change Password</button>
                        </div>
                      </div>
                      </form>                        
                    </div> 
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
  <script src="assets/js/profile.js"></script>	
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.js" integrity="sha512-RTxmGPtGtFBja+6BCvELEfuUdzlPcgf5TZ7qOVRmDfI9fDdX2f1IwBq+ChiELfWt72WY34n0Ti1oo2Q3cWn+kw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<!--custom page js -->	
</body>
</html>