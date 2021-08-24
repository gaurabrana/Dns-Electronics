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
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="css/magnific-popup.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Fancybox -->
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="css/niceselect.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Flex Slider CSS -->
    <link rel="stylesheet" href="css/flex-slider.min.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="css/owl-carousel.css">
    <!-- Slicknav -->
    <link rel="stylesheet" href="css/slicknav.min.css">

    <!-- custom StyleSheet -->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/intlTelInput.css">



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
                            <li class="active"><a href="login.php">Login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
    <section class="shop login section">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
                    <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
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
                                    <!-- <label class="fieldlabels">Confirm Password: *</label> 
                                    <p id="errorconfirmpass"></p>
                                    <input type="password" oninput="checkConfirmPassword()" id="confirm_password_register" name="cpwd" placeholder="Confirm Password" /> -->
                                </div>
                                <input type="button" id="step1" name="next" class="next action-button" value="Next" />
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
                                    <select name="gender" id="gender" aria-placeholder="Choose gender" required>
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
                                                <input id="finalsubmit" hidden type="submit" name="sumbit" value="submit" />
                                            </div>
                                        </div>

                                        <p style="color:black;margin:8px 0px; font-size:medium;cursor:pointer;" id="reset" onclick="resetUpload()">Reset</p>                                                                                
                                    </div>                                                                        
                                </div><button type="button" hidden id="nextstep"  name="skipped" class="next action-button">Next Step</button> <input id="submitForm" type="button" name="change" class="action-button" value="Submit" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />                                                    
                                <br/> <br/>
                                <div class="imageLoading">
                               
                                </div>
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
        </div>
    </section>
    <?php
    include("layouts/footer.php");
    ?>

    <!-- Jquery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <!-- Slicknav JS -->
    <script src="js/slicknav.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="js/owl-carousel.js"></script>
    <!-- Magnific Popup JS -->
    <script src="js/magnific-popup.js"></script>
    <!-- Fancybox JS -->
    <script src="js/facnybox.min.js"></script>
    <!-- Waypoints JS -->
    <script src="js/waypoints.min.js"></script>
    <!-- Countdown JS -->
    <script src="js/finalcountdown.min.js"></script>
    <!-- Nice Select JS -->
    <script src="js/nicesellect.js"></script>
    <!-- Ytplayer JS -->
    <script src="js/ytplayer.min.js"></script>
    <!-- Flex Slider JS -->
    <script src="js/flex-slider.js"></script>
    <!-- ScrollUp JS -->
    <script src="js/scrollup.js"></script>
    <!-- Onepage Nav JS -->
    <script src="js/onepage-nav.min.js"></script>
    <!-- Easing JS -->
    <script src="js/easing.js"></script>
    <!-- Active JS -->
    <script src="js/active.js"></script>

    <script src="register.js"></script>
    <script src="js/intlTelInput.min.js"></script>
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
                $("#submitForm").prop('disabled', true);
                var email = $('#email_register').val();
                var password = $('#password_register').val();
                var fullname = $('#fullname').val();
                var age = $('#age').val();
                var gender = $('#gender').val();
                var full_number = intl.getNumber(intlTelInputUtils.numberFormat.E164);
                var phone_number = $('#phone').val();
                        
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
                            gender: gender
                        },
                        cache: false,
                        success: function(dataResult) {
                            var dataResult = JSON.parse(dataResult);                           
                           if (dataResult.statusCode == 201) {           
                               $("#nextstep").click();                                                                         
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
                        }
                    });
                } else {
                    console.log("eror");
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
                var progressBar = $('.progressBar'),
                bar = $('.progressBar .bar'),
                percent = $('.progressBar .percent');

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
            utilsScript: "js/utils.js"
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
                if (val.match(regEx)) {
                    document.getElementById("errorname").innerHTML = "Valid Name";
                    document.getElementById("errorname").style.color = "#27AE60";
                } else {
                    document.getElementById("errorname").innerHTML = "Please enter letters and space only";
                    document.getElementById("errorname").style.color = "#ed1c24";
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
                if (val.length > 7 && val.length < 20) {
                    document.getElementById("errorpass").innerHTML = "Valid Password";
                    document.getElementById("errorpass").style.color = "#27AE60";
                } else {
                    document.getElementById("errorpass").innerHTML = "Invalid Password (8-20 characters.)";
                    document.getElementById("errorpass").style.color = "#ed1c24";
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
                if (validateEmail(val)) {
                    $("#errormail").text("Valid email address.");
                    $("#errormail").css("color", "#27AE60");
                } else {
                    $("#errormail").text("Invalid email address");
                    $("#errormail").css("color", "#ed1c24");
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
                if (val > 15 && val < 99) {
                    document.getElementById("errorage").innerHTML = "Valid age.";
                    document.getElementById("errorage").style.color = "#27AE60";
                } else {
                    //show error
                    document.getElementById("errorage").innerHTML = "Between 16 and 99.";
                    document.getElementById("errorage").style.color = "#ed1c24";
                }
            } else {
                document.getElementById("errorage").innerHTML = "Between 16 and 99.";
                document.getElementById("errorage").style.color = "#ed1c24";
            }
        };
  
    </script>

</body>

</html>