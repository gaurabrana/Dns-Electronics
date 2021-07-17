<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Trader Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/registration.css"/>
</head>

<body class="form-v10">
	<div class="page-content">
		<div class="form-v10-content">
			<form class="form-detail" action="data_reg.php" method="POST" id="myform">
				<div class="form-left">
					<h2>General Infomation</h2>
					<div class="form-row">
						<select name="title">
						<option selected value="Trader">Trader</option>
						</select>
						<span class="select-btn">
                        <i class="fa fa-angle-down"></i>
						</span>
					</div>
					<div class="form-group">
						<div class="form-row form-row-1">
							<input type="text" name="first_name" id="first_name"  placeholder="First Name" required>
						</div>
						<div class="form-row form-row-2">
							<input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
						</div>
					</div>
					<div class="form-row">
						<input type="email" name="email" id = "email" placeholder="Email Address">
					</div>
					<div class="form-row">
						<input type="password" name="password" id="password" placeholder="New Password" required>
					</div>
					<div class="form-group">
						<div class="form-row form-row-1">
							<input type="text" name="code" id="code" placeholder="Code +" required>
						</div>
						<div class="form-row form-row-2">
							<input type="text" name="phone" id="phone" placeholder="Phone Number" required>
						</div>
					</div>
				</div>
				<div class="form-right">
					<h2>Shop Details</h2>
					<div class="form-row">
						<input type="text" name="shop_name" class="shop_name" id="shop_name" placeholder="Shop Name" required>
					</div>
					<div class="form-row">
						<input type="text" name="address" id="location" placeholder="Address" required>
					</div>
					<div class="form-row form-row-2">
							<select name="category">
							<option value="" disabled selected >Category</option>
							    <option value="Clothes">Clothes</option>
							    <option value="Furniture">Furniture</option>
							    <option value="Food">Food</option>
							</select>
							<span class="select-btn">
							  	<i class="fa fa-angle-down"></i>
							</span>
						</div>
					<div class="form-row">
						<input type="text" name="additional" id="additional" placeholder="Additional Information" required>
					</div>					
					
					<div class="form-checkbox">
						<label class="container"><p>I do accept the <a href="#" class="text">Terms and Conditions</a>.</p>
						  	<input type="checkbox" name="checkbox">
						  	<span class="checkmark"></span>
						</label>
					</div>
					<div class="form-row-last">
						<input type="submit" name="register" class="register" value="Register">
					</div>
				</div>
			</form>
		</div>
	</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</body>
</html>