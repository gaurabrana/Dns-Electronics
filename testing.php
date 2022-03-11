<?php include('database/connect.php'); ?>
<!-- <!-- <?php
$getIDCount = "Select id from product";
$newID = mysqli_num_rows(mysqli_query($conn, $getIDCount));
$newID++;

$imagekey = "-";
$mainImage = "mainimage.jpg";
    
$date = date("Y-m-d h:i:s A");
for($i=0;$i<50;$i++){    
$price = rand(10000, 150000);
$discount = rand(1000, 5000);
$stock = rand(10, 150);
$category = getCat();
$brand = getBrand();
$name = getName();
$description = getDesc();
$code = strtoupper(substr($name,0,3)).rand(100,10000);
    echo"Insert into product values ('$newID','$name', '$price', '$discount', '$description', '$code', 'DNS ELECTRONICS','$brand','0','$stock','Electronics','$category','$mainImage','$imagekey','$date')".";<br>";        
    $newID++;
}


function getName(){
    //PHP array containing forenames.
$names = array(
'Beth Moore',
'Maui Arthoughts Company',
'Symbolic Systems',
'Grover Oliver',
'Impact Network Solutions',
'Syracuse Casket Direct',
'All Pro Spas',
'Enlable Inc',
'The Craighead Co.',
'Impact Imaging',
'Aerial Marketing Group',
'WOODEN DEIDRA',
'Wreath Farm',
'Rast Marketing Research',
'Web Marketing Group',
'Teleshuttle Corp',
'Wholesale Appliance Ctr',
'Stewart Appliances',
'Meyer Appliance Service',
'Mars Inc'
);

//Combine them together and print out the result.
return $names[mt_rand(0, sizeof($names) - 1)];
}

function getDesc(){
    $des = array(
        'Latico Environmental Services',
'Killean Audiology & Hearing',
'Cinema Marketing Group',
'Logistics Market Place',
'Lorelei Enterprises',
'THE NEW MARKETEER',
'Golden Country Inc.',
'Kevin Loveless',
'Misurell Marketing Consulting',
'Kayvan Hakim',
'Mobile RDO Communications Svc',
'Tyco Electronics',
'Jacobsson',
'Heather Mcglynn',
'Mon Bien Aime Inc',
'Scanner Master Police Scanners',
'Animal House Pet Supplies',
'Classic Awards & Engraving',
'Adams Memorials'
    );
    return $des[mt_rand(0, sizeof($des) - 1)];
}

function getBrand(){
    $brand = array(
        'notzi',
        'hatello',
        'sony',
        'panasonic',
        'Havells',
        'Samsung',
        'Huawei',
        'LG',
        'gozzby',
        'Call', 'ControlCambridge', 'SoundworksCandace', 'Cameron', 'Canon','Capcom'
    );
    return $brand[mt_rand(0, sizeof($brand) - 1)];
}
function getCat(){
    $cat = array(
      'TV',
      'Fridge',
      'Heater',
      'Headphone',  
        'Speaker',
        'Smartphone',
        'AC',
        'Fan',        
    );
    return $cat[mt_rand(0, sizeof($cat) - 1)];
}
?> -->


// get the brand products in each category 

<?php
// for the chart get data from database

$getProducts = "Select * from product";
$getProductsResult = mysqli_query($conn, $sql);
$main_data = array();
while($row = mysqli_fetch_assoc($getProductsResult)){
    $productCode = $row['code'];
    $brand = $row['brand'];
    $category = $row['category'];
    $getOrderItem = "Select * from order_item where product_code = '$productCode'";
    $getOrderItemResult = mysqli_query($conn, $getOrderItem);
    $total = mysqli_num_rows($getOrderItemResult);
    while($row1 = mysqli_fetch_assoc($getOrderItemResult)){
        
    }

}

?>


<?php
if(!isset($_SESSION)){
session_start();
if(isset($_SESSION['email'])){
header("Location: index.php");
}
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
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/css/font-awesome.css">    
    
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
    <link rel="stylesheet" href="assets/css/register.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/intlTelInput.css">



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

    <!--Header start -->
    <?php
    include "layouts/navbar.php";
    ?>
    <!--Header end -->

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="index.php">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="register.php">Register</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
    <section class="shop login section" id="retailCustomer">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
                    <div class="card px-0 pt-4 pb-0 mt-3 mb-3 registration-card">
                        <h2 id="heading">Sign Up Your User Account</h2>
                        <p>Fill all form field to go to next step</p>
                        <form id="msform" method="POST" enctype="multipart/form-data" action="database/registerdata.php" autocomplete="off">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="account"><strong>Account</strong></li>
                                <li id="personal"><strong>Personal</strong></li>
                                <li id="payment"><strong>Profile Image</strong></li>
                                <li id="confirm"><strong>Finish</strong></li>
                            </ul>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div> <br> <!-- fieldsets -->                                      
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Account Information:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 1 - 4</h2>
                                        </div>
                                    </div>
                                    <label class="fieldlabels">Email: *</label>
                                    <p id="errormail"></p>
                                    <input type="email" oninput="checkEmail()" id="email_register" required name="email" placeholder="Email Id" autocomplete="off" />
                                    <label class="fieldlabels">Password: *</label>
                                    <p id="errorpass"></p>
                                    <input type="password" oninput="checkPassword()" id="password_register" required name="password" placeholder="Password" autocomplete="off" />
                                    <p><i class="fas fa-store-alt"></i> FOR WHOLESALE CUSTOMERS</p><p>Fill the form <a href="./registerwholesale.php" class="wholesale-title"><u title="Wholesale Customer Registration Form" class="registerWholesale">HERE</u></a>
                                        </p>                                                                                                                                                    
                                        <input type="button" id="step1" name="next" class="next action-button" value="Next" />
                                </div>                                
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Personal Information:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 2 - 4</h2>
                                        </div>
                                    </div> <label class="fieldlabels">Full Name: *</label>
                                    <p id="errorname"></p>
                                    <input type="text" id="fullname" oninput="checkName()" name="name" placeholder="Full Name" required autocomplete="off" />
                                    <label class="fieldlabels">Age: *</label>
                                    <p id="errorage"></p>
                                    <input type="number" oninput="validateAge()" id="age" name="age" placeholder="Age" required autocomplete="off" />
                                    <label class="fieldlabels">Contact No: *</label> <br />
                                    <span id="valid-msg" class="hide">✓ Valid</span>
                                    <span id="error-msg" class="hide"></span>
                                    <input type="tel" name="phone_number[main]" id="phone" required autocomplete="off" />
                                    <label style="margin-top: 25px;" class="fieldlabels">Gender: *</label> <br>
                                    <select name="gender" id="genderFromRegister" aria-placeholder="Choose gender" required>
                                        <option value="notselected" disabled="" selected="">Choose Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="private">Rather not say.</option>
                                    </select>
                                    <br><br>
                                    <!-- <input type="text" maxlength="10" id="phone" name="phno" placeholder="Contact No." />                                      -->
                                </div> <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Image Upload:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 3 - 4</h2>
                                        </div>
                                    </div>
                                    <p style="color:black; margin-bottom:8px; font-size:medium;" id="msg">Add profile picture for your account. This step can be skipped.</p>
                                    <div id="imgContainer">                                    
                                        <div id="imgArea"><img id="usericon" src="./img/register_usericon.png">
                                            <div class="progressBarImageUpload">
                                                <div class="bar"></div>
                                                <div class="percent">0%</div>
                                            </div>
                                            <div id="imgChange"><span>Change Photo</span>
                                                <input type="file" accept="image/*" name="image_upload_file" id="image_upload_file">      
                                                <input id="profileimage" type="text" hidden name="imagename">
                                                <input id="finalsubmit" hidden type="submit" name="sumbit" value="submit" />
                                            </div>
                                        </div>

                                        <p style="color:black;margin:8px 0px; font-size:medium;cursor:pointer;" id="reset" onclick="resetUpload()">Reset</p>                                                                                
                                    </div>                                                                        
                                </div>
                                <button type="button" style="display:none;" id="proceedtofinal"  name="skipped" class="next action-button">Next Step</button> <input id="submitForm" type="button" name="change" class="action-button" value="Submit" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />                                                    
                                <br/> <br/>
                                
                                                    <div class="alert alert-danger alert-dismissible" id="errormessage" style="display: none; margin-top:20px;">
                                                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                                    <span id="errormsg"></span>                                                                                                
                                                    <hr>
                                                    <span id="errordetail" class="mb-0"></span>        
													<a href="#" id="closemsg" class="close" aria-label="danger">×</a>
												</div>                                                
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Finish:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 4 - 4</h2>
                                        </div>
                                    </div> <br><br>
                                    <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                                    <div class="row justify-content-center">
                                        <div class="col-3"> <img src="img/success.png"></div>
                                    </div> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-7 text-center">
                                            <h5 class="purple-text text-center">An email verification link has been sent to your email. Please verify before logging in.</h5>
                                            <h5 class="purple-text text-center">Redirecting to homepage...</h5>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        
                </div>
            </div>
        </div>        
    </section>                 
    <?php
    include("layouts/footer.php");
    ?>

    <!-- Jquery -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery-migrate-3.0.0.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
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

    <script src="assets/js/register.js"></script>
    <script src="assets/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.js" integrity="sha512-RTxmGPtGtFBja+6BCvELEfuUdzlPcgf5TZ7qOVRmDfI9fDdX2f1IwBq+ChiELfWt72WY34n0Ti1oo2Q3cWn+kw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        function resetUpload() {
            $("#imgArea>img").prop('src', "./img/register_usericon.png");
            $("#image_upload_file").val("");
        }
    </script>

    <script>
        $(document).ready(function() {
            $("#submitForm").click(function() {                
                var email = $('#email_register').val();
                var password = $('#password_register').val();
                var fullname = $('#fullname').val();
                var age = $('#age').val();
                var gender = $('#genderFromRegister').val();
                var full_number = intl.getNumber(intlTelInputUtils.numberFormat.E164);
                var phone_number = $('#phone').val();
                var imageName = $('#imageName').val();
                        
                if (email != "" && password != "" && age != "" && phone_number != "" && fullname != "" && gender!="notselected") {
                    $.ajax({
                        url: "database/registerdata.php",
                        type: "POST",
                        data: {
                            email: email,
                            password: password,
                            name: fullname,
                            submit: "submit",
                            age: age,
                            phone: full_number,
                            gender: gender,
                            imageName: imageName
                        },
                        cache: false,
                        success: function(dataResult) {
                            var dataResult = JSON.parse(dataResult);    
                            console.log(dataResult);
                           if (dataResult.statusCode == 201) {           
                               $("#proceedtofinal").click();                                                                         
                                var delay = 3000; 
                            setTimeout(function(){ window.location = "index.php"; }, delay);
                            }
                            else if (dataResult.statusCode == 200) {
                                $("#errormsg").html("Email already exist!");
                                $("#errordetail").html("An account already exist with the email address " + email);
                                //$("#errormessage").fadeOut(4300);
                                //$("#error").slideUp(300).delay(8000).fadeOut(400);	
                                $("#errormessage").css("display", "block");
                                $("#submitForm").removeAttr("disabled");                                
                            }
                            else if(dataResult.statusCode == 203){
                                $("#errormsg").html("Email verification link");
                                $("#errordetail").html("We failed to send an email verification link to the " + email + ". Are you sure you entered the correct email??");
                                $("#errormessage").css("display", "block");
                                $("#submitForm").removeAttr("disabled");        
                            }
                            else if(dataResult.statusCode == 204){
                                $("#errormsg").html("Error Occured.");
                                $("#errordetail").html("We ran into an unknown problem. We request you to refresh the page and try again. Sorry for the inconvenience.");
                                $("#errormessage").css("display", "block");
                                $("#submitForm").removeAttr("disabled");  
                            }
                        }
                    });
                } else {                    
                    $("#errormsg").html('Empty fields found.');
                    $("#errormessage").css("display", "block");
                    $("#errordetail").html("Please make sure the details are entered correctly.");
                    $("#submitForm").removeAttr("disabled");
                }
            });
            
            $("#closemsg").click(function(e){
         e.preventDefault();
         $("#errormessage").css("display", "none");         
         // your statements;
     });        
        });
    </script>


    <script>
        $(document).on('change', '#image_upload_file', function() {            
                var progressBar = $('.progressBarImageUpload'),
                bar = $('.progressBarImageUpload .bar'),
                percent = $('.progressBarImageUpload .percent');

            $('#image_upload_file').ajaxForm({
                beforeSend: function() {
                    progressBar.css("display", "block");
                    var percentVal = '0%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                uploadProgress: function(event, position, total, percentComplete) {                    
                    var percentVal = percentComplete + '%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                success: function(html, statusText, xhr, $form) {
                    obj = $.parseJSON(html);                    
                    if (obj.status) {
                        var percentVal = '100%';
                        bar.width(percentVal)                        
                        percent.html(percentVal);
                        $("#imgArea>img").prop('src', obj.image_medium);
                        $("#profileimage").val(obj.imageName);
                    } else {
                        alert(obj.error);
                    }
                },
                complete: function(xhr) {
                    progressBar.css("display", "none");
                }
            }).submit();            
        });
    </script>

    <script>
        var input = document.querySelector("#phone"),
            errorMsg = document.querySelector("#error-msg"),
            validMsg = document.querySelector("#valid-msg");

        // Error messages based on the code returned from getValidationError
        var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

        // Initialise plugin
        var intl = window.intlTelInput(input, {
            separateDialCode: true,
            initialCountry: "np",
            hiddenInput: "full",
            utilsScript: "assets/js/utils.js"
        });

        var reset = function() {
            input.classList.remove("error");
            errorMsg.innerHTML = "";
            errorMsg.classList.add("hide");
            validMsg.classList.add("hide");
        };

        // Validate on blur event
        input.addEventListener('blur', function() {
            reset();
            if (input.value.trim()) {
                if (intl.isValidNumber()) {
                    validMsg.classList.remove("hide");
                } else {
                    input.classList.add("error");
                    var errorCode = intl.getValidationError();
                    errorMsg.innerHTML = errorMap[errorCode];
                    errorMsg.classList.remove("hide");
                }
            }

        });
    </script>

    <script>
        function checkName() {
            var elements = document.getElementById("fullname").value;
            var values = [];
            values.push(elements);
            var val = values.toString();
            if (val.length > 0) {
                var regEx = /^[A-Za-z\s]+$/;
                if (!val.match(regEx)) {
                    document.getElementById("errorname").innerHTML = "Please enter letters and space only";
                    document.getElementById("errorname").style.color = "#ed1c24";
                }
                else{
                    document.getElementById("errorname").innerHTML = "";
                }
            } else {
                document.getElementById("errorname").innerHTML = "Empty field.";
                document.getElementById("errorname").style.color = "#ed1c24";
            }
            return val;
        };

        function checkPassword() {
            var elements = document.getElementById("password_register").value;
            var values = [];
            values.push(elements);
            var val = values.toString();
            if (val.length > 0) {
                if (!(val.length > 7 && val.length < 20)) {
                    document.getElementById("errorpass").innerHTML = "Invalid Password (8-20 characters.)";
                    document.getElementById("errorpass").style.color = "#ed1c24";
                } 
                else{
                    document.getElementById("errorpass").innerHTML = "";
                }
            }
            return val;
        };

        function checkEmail() {
            var data = document.getElementById("email_register").value;
            var values = [];
            values.push(data);
            var val = values.toString();
            if (val.length > 0) {
                if (!validateEmail(val)) {
                    $("#errormail").text("Invalid email address");
                    $("#errormail").css("color", "#ed1c24");
                } 
                else{
                    $("#errormail").text("");
                }
            } else {
                $("#errormail").text("Empty email address");
                $("#errormail").css("color", "#ed1c24");
            }
        };

        function validateEmail(email) {
            const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        };

        function validateAge() {
            var data = document.getElementById("age").value;
            var values = [];
            values.push(data);
            var val = values.toString();
            if (val.length != 0 && val.length == 2) {
                if (!(val > 15 && val < 99)) {
                    //show error
                    document.getElementById("errorage").innerHTML = "Between 16 and 99.";
                    document.getElementById("errorage").style.color = "#ed1c24";
                } 
                else{
                    document.getElementById("errorage").innerHTML = "";
                }
            } else {
                document.getElementById("errorage").innerHTML = "Between 16 and 99.";
                document.getElementById("errorage").style.color = "#ed1c24";
            }
        };
  
    </script>

</body>

</html>