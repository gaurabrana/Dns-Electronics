<link rel="stylesheet" href="assets/css/login.css">
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="./css/style.css">
  <title>Admin Login</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

  <div class="login-box">
    <h2>Admin Login</h2>
    <form action="" class="form" autocomplete="off">
      <div class="user-box">
        <input class="input" type="text" id="email" required autocomplete="off">
        <label class="label" for="">Username</label>
      </div>
      <!-- /.user-box -->
      <div class="user-box">
        <input class="input" type="password" id="password" required autocomplete="off"> 
        <label class="label" for="">Password</label>
      </div>
      <p id="error"></p>
      <!-- /.user-box -->
      <a id="login">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Submit
      </a>
    </form>
    <!-- /form -->
  </div>
  <!-- /.login-box -->
  
</body>
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
                                $("#error").css("color", "white");
							}
						}
						if (dataResult.statusCode == 200) {
							$('#error').html('Admin not found.');							
							//$("#error").slideUp(300).delay(8000).fadeOut(400);
							$(".navbarlogin").removeAttr('disabled');
						} else if (dataResult.statusCode == 201) {
							$('#error').html('Invalid Password !');
							$("#error").fadeOut(4300);
							//$("#error").slideUp(300).delay(8000).fadeOut(400);	
							$(".navbarlogin").removeAttr('disabled');
						} else if (dataResult.statusCode == 202) {
							location.href = "dashboard.php";
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
</html>





