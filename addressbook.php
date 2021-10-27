<?php

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
  <link rel="stylesheet" href="assets/css/intlTelInput.css">
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
              <li class="active"><a href="cart.php">My Address Book</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>   
  <div class="section">
    <div class="container">
      <div class="row holdnewaddress">
        <div class="col-md-2">
          <button data-bs-toggle="collapse" href="#newAddress" role="button" aria-expanded="false" aria-controls="newAddress" class='btn btn-dark'><i class="fas fa-plus"></i> New Address Book
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="collapse" id="newAddress">
            <div class="card">
              <form id="newBook">
                <div class="row">
                  <div class="col-md-6">
                    <div class="card-header card-header-primary">
                      <h4 class="card-title">Fill Billing Detail</h4>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="bmd-label-floating">First Name</label>
                            <input type="text" name="billingfname" class="form-control" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="bmd-label-floating">Last Name</label>
                            <input type="text" name="billinglname" class="form-control" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="bmd-label-floating">Email Address</label>
                            <input type="email" name="billingemail" class="form-control" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="bmd-label-floating">Phone Number</label>
                            <input type="text" name="billingphone" class="form-control" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">Address One</label>
                            <input type="text" name="billingaddressone" class="form-control" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="bmd-label-floating">Address Two</label>
                            <input type="text" name="billingaddresstwo" class="form-control" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="bmd-label-floating">Postal Code</label>
                            <input type="number" min="0" name="billingpostalcode" class="form-control" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="bmd-label-floating">Country</label>
                            <img id="countryflagNewAddress" src="img/flags/np.png">
                            <select name="country_name" class="form-control billingcountry" id="countryNewAddress">';
                              <?php
                              $getCountries = "Select countries_iso_code, countries_name from countries";
                              $getCountriesQuery = mysqli_query($conn, $getCountries);
                              while ($getCountriesRows = mysqli_fetch_assoc($getCountriesQuery)) {

                                if ($getCountriesRows['countries_iso_code'] == "NP") {

                                  echo '<option selected value=' . $getCountriesRows['countries_iso_code'] . '>&#160&#160' . $getCountriesRows['countries_name'] . '</option>';
                                } else {
                                  echo '<option value=' . $getCountriesRows['countries_iso_code'] . '>&#160&#160' . $getCountriesRows['countries_name'] . '</option>';
                                }
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">Same Shipping Detail ??</label>
                            <input type="checkbox" id="newAddressSameShipping">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="card-header card-header-dark">
                      <h4 class="card-title">Fill Shipping Detail</h4>
                    </div>
                    <div class="card-body new-shipping-address">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="bmd-label-floating">Fullname</label>
                            <input type="text" name="shippingid" hidden class="form-control">
                            <input type="text" name="shippingfullname" class="form-control" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="bmd-label-floating">Email Address</label>
                            <input type="email" name="shippingemail" class="form-control" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="bmd-label-floating">Phone Number</label>
                            <input type="text" name="shippingphone" class="form-control" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="bmd-label-floating">Address One</label>
                            <input type="text" name="shippingaddressone" class="form-control" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="bmd-label-floating">Address Two</label>
                            <input type="text" name="shippingaddresstwo" class="form-control" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="bmd-label-floating">Postal Code</label>
                            <input type="number" min="0" name="shippingpostalcode" class="form-control" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">Country</label>
                            <img id="shippingcountryflagNewAddress" src="img/flags/np.png">
                            <select name="shipping_country_name" class="form-control shippingcountry" id="shippingcountryNewAddress">';
                              <?php
                              $getCountries = "Select countries_iso_code, countries_name from countries";
                              $getCountriesQuery = mysqli_query($conn, $getCountries);
                              while ($getCountriesRows = mysqli_fetch_assoc($getCountriesQuery)) {
                                if ($getCountriesRows['countries_iso_code'] == "NP") {

                                  echo '<option selected value=' . $getCountriesRows['countries_iso_code'] . '>&#160&#160' . $getCountriesRows['countries_name'] . '</option>';
                                } else {
                                  echo '<option value=' . $getCountriesRows['countries_iso_code'] . '>&#160&#160' . $getCountriesRows['countries_name'] . '</option>';
                                }
                              }


                              ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>                                                     
                <div class="row">
                  <div class="col-md-12 p-4">
                  <div class="alert hide-element" id="newAddressBookResult">
                    </div>   
                  </div>
                        <div class="col-md-12">                                            
                          <div class="form-group d-flex justify-content-center">                          
                          <div class="p-2">
                          <input type="submit" class="btn btn-dark" value="Add Address Book" name="newaddressbook">
                          </div>  
                                             
                          </div>
                        </div>
                </div>                
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-6"></div>
      </div>
      <?php
      $userid = $_SESSION['id'];
      $sql = "Select * from billing_info where user_id = '$userid' order by active desc";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $sameShipping = $row['shipping_info'] == "Same" ? true : false;
          $isActive = $row['active'] == "Yes" ? true : false;
          $billingid = $row['info_id'];
          echo '<div class="row collectionofaddressbook" id="holdingaddressbook'.$row['info_id'].'">
                          <div class="col-md-6">
                            <div class="card">
                            <div ';
          if ($isActive) {
            echo 'class="card-header card-header-primary"><h4 class="card-title">Active Address Book';
          } else {
            echo 'class="card-header card-header-dark"><h4 class="card-title">Address Book';
          }
          echo '</h4>
          <p class="card-category"></p>
                              </div>
                              <div class="card-body">
                              <div class="row">  
                              <div class="col-md-12">
                              <table class="table table-responsive table-hover">
                              <tr><th><i class="fas fa-user"></i> Name </th><td>' . $row['firstname'] . ' ' . $row['lastname'] . '</td></tr>
                              <tr><th><i class="fas fa-envelope"></i> Email Address </th><td>' . $row['email_address'] . '</td></tr>
                              <tr><th><i class="fas fa-phone-alt"></i> Contact </th><td>' . $row['phone_number'] . '</td></tr>
                              <tr><th><i class="fas fa-street-view"></i> Address </th><td>' . $row['address_one'] . ', ' . $row['address_two'] . ', ' . $row['postal_code'] . '</td></tr>
                              <tr><th><i class="fas fa-flag"></i> Country </th><td>' . $row['country'] . '&#160&#160<img src="img/flags/' . strtolower($row['country']) . '.png"</td></tr>
                              <tr><th><i class="fas fa-calendar-alt"></i> Updated Date </th><td>' . $row['added_date'] . '</td></tr>                              
                              <tr><th><i class="fas fa-shipping-fast"></i> Shipping Detail </th><td>';
          if ($sameShipping) {
            echo "Same as billing detail";
          } else {
            echo '<a data-bs-toggle="collapse" href="#showShipping' . $row['shipping_info'] . '" role="button" aria-expanded="false" aria-controls="showShipping' . $row['shipping_info'] . '" id="showShipping' . $row['info_id'] . '" >Expand more..</a>';
          }

          echo '</td></tr>                              
                              </table>                              
                              </div>';
          if (!$sameShipping) {
            echo '<div class="col-md-12">  
                                  <div class="collapse" id="showShipping' . $row['shipping_info'] . '"> 
                                  <h5>Shipping Details</h5>
                                  <table class="table table-responsive table-hover">';
            $shippingid = $row['shipping_info'];
            $getShippingDetail = "Select * from shipping_info where shipping_info_id = '$shippingid'";
            $getShippingDetailQuery = mysqli_query($conn, $getShippingDetail);
            while ($getShippingDetailRows = mysqli_fetch_assoc($getShippingDetailQuery)) {
              $shippingfullname = $getShippingDetailRows['fullname'];
              $shippingemail = $getShippingDetailRows['email_address'];
              $shippingphone = $getShippingDetailRows['phone_number'];
              $shippingcountry = $getShippingDetailRows['country'];
              $shippingaddressone = $getShippingDetailRows['address_one'];
              $shippingaddresstwo = $getShippingDetailRows['address_two'];
              $shippingpostalcode = $getShippingDetailRows['postal_code'];
              $shippingdate = $getShippingDetailRows['added_date'];
            }
            echo '<tr><th><i class="fas fa-user"></i> Name </th><td>' . $shippingfullname . '</td></tr>
                                  <tr><th><i class="fas fa-envelope"></i> Email Address </th><td>' . $shippingemail . '</td></tr>
                                  <tr><th><i class="fas fa-phone-alt"></i> Contact </th><td>' . $shippingphone . '</td></tr>
                                  <tr><th><i class="fas fa-street-view"></i> Address </th><td>' . $shippingaddressone . ', ' . $shippingaddresstwo . ', ' . $shippingpostalcode . '</td></tr>
                                  <tr><th><i class="fas fa-flag"></i> Country </th><td>' . $shippingcountry . '&#160&#160<img src="img/flags/' . strtolower($shippingcountry) . '.png"</td></tr>
                                  <tr><th><i class="fas fa-calendar-alt"></i> Updated Date </th><td>' . $shippingdate . '</td></tr>                                                                                   
                                  </table>
                                  </div>
                                  </div>';
          } else {
            $shippingid = "-";
          }

          echo '<div class="col-md-12">                                                    
                              <a data-bs-toggle="collapse" href="#changeDetails' . $row['info_id'] . '" role="button" aria-expanded="false" aria-controls="changeDetails' . $row['info_id'] . '" id="updatebillingdetail' . $row['info_id'] . '" class="btn btn-dark text-light">Update</a>                            
                              <a id="deletebillingdetail' . $row['info_id'] . '" class="btn btn-danger deletebutton text-light deletebilling">Delete</a>';
          if (!$isActive) {
            echo '<a id="statusbillingdetail' . $row['info_id'] . '" class="ml-2 btn btn-inverse activechange text-light">Set Active</a>';
          }
          echo '</div>                              
                              </div>                    
                              </div>
                            </div>
                          </div>                                                                 
                          <div class="col-md-6">
                          <div class="collapse" id="changeDetails' . $row['info_id'] . '"> 
                          <div class="card">
                          <div class="card-header';
          if ($isActive) {
            echo ' card-header-primary">';
          } else {
            echo ' card-header-dark">';
          }
          echo '<h4 class="card-title">Update Billing Detail</h4>
                                  <p class="card-category"></p>
                              </div>
                              <div class="card-body">
                                  <form action="database/updateaddressbook.php" method="POST">
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="bmd-label-floating">First Name</label>
                                                  <input type="text" name="billingid" hidden class="form-control" value="' . $billingid . '">
                                                  <input type="text" name="billingfname" class="form-control" required value="' . $row['firstname'] . '">
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="bmd-label-floating">Last Name</label>
                                                  <input type="text" name="billinglname" class="form-control" required value="' . $row['lastname'] . '">
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="bmd-label-floating">Email Address</label>
                                                  <input type="text" name="billingemail" class="form-control" required value="' . $row['email_address'] . '">
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="bmd-label-floating">Phone Number</label>
                                                  <input type="text" name="billingphone" class="form-control" required value="' . $row['phone_number'] . '">
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <label class="bmd-label-floating">Address One</label>
                                                  <input type="text" name="billingaddressone" class="form-control" required value="' . $row['address_one'] . '">
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="bmd-label-floating">Address Two</label>
                                                  <input type="text" name="billingaddresstwo" class="form-control" required value="' . $row['address_two'] . '">
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="bmd-label-floating">Postal Code</label>
                                                  <input type="number" min="0" name="billingpostalcode" class="form-control" required value="' . $row['postal_code'] . '">
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="bmd-label-floating">Country</label>
                                                  <img id="countryflag' . $billingid . '" src="img/flags/' . strtolower($row['country']) . '.png">
                                                  <select name="country_name" class="form-control billingcountry" id="country' . $billingid . '">';
          $getCountries = "Select countries_iso_code, countries_name from countries";
          $getCountriesQuery = mysqli_query($conn, $getCountries);
          while ($getCountriesRows = mysqli_fetch_assoc($getCountriesQuery)) {

            if ($row['country'] == $getCountriesRows['countries_iso_code']) {

              echo '<option selected value=' . $getCountriesRows['countries_iso_code'] . '>&#160&#160' . $getCountriesRows['countries_name'] . '</option>';
            } else {
              echo '<option value=' . $getCountriesRows['countries_iso_code'] . '>&#160&#160' . $getCountriesRows['countries_name'] . '</option>';
            }
          }
          echo '</select>
                                              </div>
                                          </div>
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <label class="bmd-label-floating">Same Shipping Detail ??</label>
                                                  <input data-bs-toggle="collapse" href="#showShippingDetail' . $row['info_id'] . '" role="button" class="checksameshipping" aria-expanded="';
                                                              if (!$sameShipping) {
                                                                echo " true";
                                                              } else {
                                                                echo "false";
                                                              }
                                                              echo '" aria-controls="showShippingDetail' . $row['info_id'] . '" type="checkbox" id="sameshipping' . $billingid . '"';
                                                              if ($sameShipping) {
                                                                echo "checked ";
                                                              }
                                                              echo ' name="sameshipping" value="same">
                                                                                                  </div>
                                                                                              </div>
                                                                                          </div>
                                                                                          <div class="collapse';
                                                              if (!$sameShipping) {
                                                                echo " show";
                                                              }
                                                              echo '" id="showShippingDetail' . $row['info_id'] . '">
                                                                                              <div id="containsShippingDetail' . $billingid . '">';
                                                              echo '<div class="row">
                                                                                                      <div class="col-md-6">
                                                                                                          <div class="form-group">
                                                                                                              <label class="bmd-label-floating">Fullname</label>
                                                                                                              <input type="text" name="shippingid" hidden class="form-control" value="' . $shippingid . '">
                                                                                                              <input type="text" name="shippingfullname" class="form-control" required ';
                                                              if (!$sameShipping) {
                                                                echo "value=\"$shippingfullname\"";
                                                              } else {
                                                                echo "value=\"\"";
                                                              }
                                                              echo '>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label class="bmd-label-floating">Email Address</label>
                                                          <input type="text" name="shippingemail" class="form-control" required ';
                                                          if (!$sameShipping) {
                                                            echo "value=\"$shippingemail\"";
                                                          } else {
                                                            echo "value=\"\"";
                                                          }
                                                          echo '>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="row">
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label class="bmd-label-floating">Phone Number</label>
                                                          <input type="text" name="shippingphone" class="form-control" required ';
                                                              if (!$sameShipping) {
                                                                echo "value=\"$shippingphone\"";
                                                              } else {
                                                                echo "value=\"\"";
                                                              }
                                                              echo '>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label class="bmd-label-floating">Address One</label>
                                                          <input type="text" name="shippingaddressone" class="form-control" required ';
          if (!$sameShipping) {
            echo "value=\"$shippingaddressone\"";
          } else {
            echo "value=\"\"";
          }
          echo '>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="row">
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label class="bmd-label-floating">Address Two</label>
                                                          <input type="text" name="shippingaddresstwo" class="form-control" required ';
          if (!$sameShipping) {
            echo "value=\"$shippingaddresstwo\"";
          } else {
            echo "value=\"\"";
          }
          echo '>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label class="bmd-label-floating">Postal Code</label>
                                                          <input type="number" min="0" name="shippingpostalcode" class="form-control" required ';
          if (!$sameShipping) {
            echo "value=\"$shippingpostalcode\"";
          } else {
            echo "value=\"\"";
          }
          echo '>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="row">
                                                  <div class="col-md-12">
                                                      <div class="form-group">
                                                          <label class="bmd-label-floating">Country</label>
                                                          <img id="shippingcountryflag' . $billingid . '"';
          if ($sameShipping) {
            echo ' src="img/flags/' . strtolower($row['country']) . '.png"';
          } else {
            echo ' src="img/flags/' . strtolower($shippingcountry) . '.png"';
          }
          echo '>
                                                          <select name="shipping_country_name" class="form-control shippingcountry" id="shippingcountry' . $billingid . '">';
          $getCountries = "Select countries_iso_code, countries_name from countries";
          $getCountriesQuery = mysqli_query($conn, $getCountries);
          while ($getCountriesRows = mysqli_fetch_assoc($getCountriesQuery)) {
            if ($sameShipping) {
              if ($row['country'] == $getCountriesRows['countries_iso_code']) {

                echo '<option selected value=' . $getCountriesRows['countries_iso_code'] . '>&#160&#160' . $getCountriesRows['countries_name'] . '</option>';
              } else {
                echo '<option value=' . $getCountriesRows['countries_iso_code'] . '>&#160&#160' . $getCountriesRows['countries_name'] . '</option>';
              }
            } else {
              if ($shippingcountry == $getCountriesRows['countries_iso_code']) {

                echo '<option selected value=' . $getCountriesRows['countries_iso_code'] . '>&#160&#160' . $getCountriesRows['countries_name'] . '</option>';
              } else {
                echo '<option value=' . $getCountriesRows['countries_iso_code'] . '>&#160&#160' . $getCountriesRows['countries_name'] . '</option>';
              }
            }
          }
          echo '</select>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <button type="submit" name="submit" class="btn btn-success pull-right">Update</button>
                                      <div class="clearfix"></div>
                                  </form>
                              </div>
                          </div>                      
                          </div>
                              </div>
                              </div>';
        }
      }

      ?>

    </div>
  </div>

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
  <!--custom page js -->
  <script src="assets/js/custom_function.js"></script>
  <script src="assets/plugin/toastr/js/toastr.min.js"></script>
  <script src="assets/plugin/toastr/js/toastr.init.js"></script>
  <?php
  if(isset($_GET['success'])){
    echo"<script>toastr.success('Address Book Updated.', 'Address Book!');</script>";
  }
  else if(isset($_GET['shiperror'])){
    echo"<script>toastr.error('Error Updating Shipping Address.', 'Address Book!');</script>";
  }
  else if(isset($_GET['billerror'])){
    echo"<script>toastr.error('Error Updating Billing Address.', 'Address Book!');</script>";
  }
  ?>
</body>

</html>