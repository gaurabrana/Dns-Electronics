<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dns Electronics</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    
</head>

<body class="h-100">
    
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href="index.html"> <h4>Admin Dashboard Login</h4></a>
        
                                <form class="mt-5 mb-5 login-input">
                                    <div class="form-group">
                                        <input type="email" id="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="password" class="form-control" placeholder="Password">
                                    </div>
                                    <button id="login" class="btn login-form__btn submit w-100">Sign In</button>
                                </form>
								<div id="error" class="alert alert-danger" role="alert">  								
								</div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
	<script>
	$(document).ready(function() {			
		$("#login").click(function() {
			$("#login").prop('disabled', true);

			var email = $('#email').val();

			var password = $('#password').val();
			console.log(email + "//" + password);

			if (email != "" && password != "") {
				$.ajax({
					url: "logindata.php",
					type: "POST",
					data: {
						type: "login",
						email: email,
						password: password
					},
					cache: false,
					success: function(dataResult) {
						var dataResult = JSON.parse(dataResult);
						if (dataResult.statusCode != null) {
							console.log(dataResult.statusCode);
							if (dataResult.statusCode != 202) {
								$("#error").show();                                
							}
						}
						if (dataResult.statusCode == 200) {
							$('#error').text('Admin not found.');							
							//$("#error").slideUp(300).delay(8000).fadeOut(400);
							$(".navbarlogin").removeAttr('disabled');
						} else if (dataResult.statusCode == 201) {
							$('#error').text('Invalid Password !');
							$("#error").fadeOut(4300);
							//$("#error").slideUp(300).delay(8000).fadeOut(400);	
							$(".navbarlogin").removeAttr('disabled');
						} else if (dataResult.statusCode == 202) {
							location.href = "index.php";
						}
					}
				});
			} else {
				$('#error').text('Please fill all fields.');
				$("#error").show();
				$("#error").fadeOut(4300);
				$(".navbarlogin").removeAttr('disabled');
			}
		});

	});
</script>
</body>

</html>










