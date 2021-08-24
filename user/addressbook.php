<?php
include('connect.php');
$active = "address";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    <?php
  if(isset($_SESSION['name'])){
    echo $_SESSION['name'];
  }
  ?>
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <link rel="stylesheet" href="../css/intlTelInput.css">
  
</head>

<body class="">
  
  <?php
    include('sidebar.php');
    ?>
    <div class="main-panel">
      <!-- Navbar -->
      <?php
        include('topnavbar.php');
      ?>      
      <div class="content">
        <div class="container-fluid">
                    <?php
                    
                        $userid = $_SESSION['id'];
                    $sql = "Select * from billing_info where user_id = '$userid' order by active desc";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                      while($row = mysqli_fetch_assoc($result)){
                        $sameShipping = $row['shipping_info'] == "Same" ? true : false ;
                        $isActive = $row['active'] == "Yes" ? true : false ;
                        $billingid = $row['info_id'];     
                          echo'<div class="row">
                          <div class="col-md-6">
                            <div class="card">
                              <div class="card-header card-header-primary">';
                              if($isActive){
                                echo'<h4 class="card-title">Your Current Billing Detail</h4>';
                              }
                              else{
                                echo'<h4 class="card-title">Previous Billing Detail</h4>';
                              }
                                
                                echo'<p class="card-category"></p>
                              </div>
                              <div class="card-body">
                              <div class="row">  
                              <div class="col-md-8">
                              <ul style="list-style-type:none;">
                              <li><i class="fas fa-user"></i> Name: '.$row['firstname'].' '.$row['lastname'].'</li>
                              <li><i class="fas fa-envelope"></i> Email Address: '.$row['email_address'].'</li>
                              <li><i class="fas fa-phone-alt"></i> Contact: '.$row['phone_number'].'</li>
                              <li><i class="fas fa-street-view"></i> Address: '.$row['address_one'].', '.$row['address_two'].', '.$row['postal_code'].'</li>
                              <li><i class="fas fa-flag"></i> Country: '.$row['country'].'<img src="../img/flags/'.$row['country'].'.png"></li>
                              <li><i class="fas fa-calendar-alt"></i> Updated Date: '.$row['added_date'].'</li>';
                              if($sameShipping){
                                  echo'<li><i class="fas fa-shipping-fast"></i> Shipping Detail: Same as billing detail</li>';
                              }
                              else{
                                  echo'<li><i class="fas fa-shipping-fast"></i> Shipping Detail: '.$row['shipping_info'].'</li>';
                              }                        
                              echo'                                      
                              </ul>
                              </div>               
                              <div class="col-md-4">                                                    
                              <a data-toggle="collapse" href="#changeDetails'.$row['info_id'].'" role="button" aria-expanded="false" aria-controls="changeDetails'.$row['info_id'].'" id="updatebillingdetail'.$row['info_id'].'" class="btn btn-success text-light">Update</a>                            
                              <a id="deletebillingdetail'.$row['info_id'].'" class="btn btn-danger text-light">Delete</a>';
                              if(!$isActive){
                                echo'<a id="statusbillingdetail'.$row['info_id'].'" class="btn btn-inverse text-light">Set Active</a>';
                              }      
                              echo'</div>                              
                              </div>                    
                              </div>
                            </div>
                          </div>  
                                                   
                          <div class="col-md-6">
                          <div class="collapse" id="changeDetails'.$row['info_id'].'"> 
                            <div class="card">
                              <div class="card-header card-header-primary">
                                <h4 class="card-title">Update Billing Detail</h4>
                                <p class="card-category"></p>
                              </div>
                              <div class="card-body">
                                <form>                                                                                                              
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="bmd-label-floating">First Name</label>
                                        <input type="text" class="form-control" value="'.$row['firstname'].'">
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="bmd-label-floating">Last Name</label>
                                        <input type="text" class="form-control" value="'.$row['lastname'].'">
                                      </div>
                                    </div>
                                  </div>                    
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="bmd-label-floating">Email Address</label>                                        
                                        <input type="text" class="form-control" value="'.$row['email_address'].'">
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="bmd-label-floating">Phone Number</label>            
                                        <input type="text" class="form-control" value="'.$row['phone_number'].'">                            
                                      </div>
                                    </div>                            
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                      <label class="bmd-label-floating">Address One</label>
                                      <input type="text" class="form-control" value="'.$row['address_one'].'">
                                      </div>
                                    </div>          
                                    <div class="col-md-6">
                                    <div class="form-group">
                                    <label class="bmd-label-floating">Address Two</label>
                                    <input type="text" class="form-control" value="'.$row['address_two'].'">
                                    </div>
                                  </div>                    
                                  </div>         
                                  <div class="row">
                                  <div class="col-md-8">
                                <div class="form-group">
                                  <label class="bmd-label-floating">Country</label>
                                  <img id ="countryflag">                                  
                                  <select name="country_name" class="form-control" id="country">';
												$getCountries = "Select countries_iso_code, countries_name from countries";
                                                $getCountriesQuery = mysqli_query($conn, $getCountries);
                                                while($getCountriesRows = mysqli_fetch_assoc($getCountriesQuery)){
                                                   
                                                    if($row['country'] == $getCountriesRows['countries_iso_code']){
                                                        
                                                        echo '<option selected value='.$getCountriesRows['countries_iso_code'].'>&#160&#160'.$getCountriesRows['countries_name'].'</option>';
                                                    }
                                                    else{
                                                        echo '<option value='.$getCountriesRows['countries_iso_code'].'>&#160&#160'.$getCountriesRows['countries_name'].'</option>';
                                                    }
                                                }
											echo'</select>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">                                  
                                <label class="bmd-label-floating">Same Shipping Detail ??</label>
                                <input data-toggle="collapse" href="#showShippingDetail'.$row['info_id'].'" role="button" aria-expanded="'; if(!$sameShipping){echo "true";} else { echo "false";} echo'" aria-controls="showShippingDetail'.$row['info_id'].'" type="checkbox" id="sameshipping"'; if($sameShipping){echo "checked ";} echo'name="sameshipping" value="same">                                  
                                </div>
                              </div>                             
                                  </div>
                                  <div class="collapse';if(!$sameShipping){echo " show";}echo'" id="showShippingDetail'.$row['info_id'].'">
                                  <div id="containsShippingDetail">';                                  
                                  $shippingid = $row['shipping_info'];
                                  $getShippingDetail = "Select * from shipping_info where shipping_info_id = '$shippingid'";
                                  $getShippingDetailQuery = mysqli_query($conn, $getShippingDetail);
                                  while($getShippingDetailRows = mysqli_fetch_assoc($getShippingDetailQuery)){
                                  $shippingfullname = $getShippingDetailRows['fullname'];
                                  $shippingemail = $getShippingDetailRows['email_address'];
                                  $shippingphone = $getShippingDetailRows['phone_number'];
                                  $shippingcountry = $getShippingDetailRows['country'];
                                  $shippingaddressone = $getShippingDetailRows['address_one'];
                                  $shippingaddresstwo = $getShippingDetailRows['address_two'];
                                  $shippingpostalcode = $getShippingDetailRows['postal_code'];
                                  $shippingdate = $getShippingDetailRows['added_date'];
                                }
                                    echo'<div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                      <label class="bmd-label-floating">Fullname</label>
                                      <input type="text" class="form-control"';if(!$sameShipping){echo "value=\"$shippingfullname\"";} else{echo "value=\"\"";}
                                      echo'>
                                      </div>
                                    </div>  
                                    <div class="col-md-6">
                                    <div class="form-group">
                                    <label class="bmd-label-floating">Email Address</label>
                                    <input type="text" class="form-control"';if(!$sameShipping){echo "value=\"$shippingemail\"";} else{echo "value=\"\"";}
                                      echo'>
                                    </div>
                                  </div>                                                              
                                  </div>  
                                  <div class="row">                                 
                                    <div class="col-md-6">
                                      <div class="form-group">
                                      <label class="bmd-label-floating">Phone Number</label>
                                      <input type="text" class="form-control"';if(!$sameShipping){echo "value=\"$shippingphone\"";} else{echo "value=\"\"";}
                                      echo'>
                                      </div>
                                    </div>          
                                    <div class="col-md-6">
                                    <div class="form-group">
                                    <label class="bmd-label-floating">Address One</label>
                                    <input type="text" class="form-control"';if(!$sameShipping){echo "value=\"$shippingaddressone\"";} else{echo "value=\"\"";}
                                    echo'>
                                    </div>
                                  </div>           
                                  </div>      
                                  <div class="row">                                            
                                    <div class="col-md-6">
                                    <div class="form-group">
                                    <label class="bmd-label-floating">Address Two</label>
                                    <input type="text" class="form-control"';if(!$sameShipping){echo "value=\"$shippingaddresstwo\"";} else{echo "value=\"\"";}
                                      echo'>
                                    </div>
                                  </div>     
                                  <div class="col-md-6">
                                    <div class="form-group">
                                    <label class="bmd-label-floating">Postal Code</label>
                                    <input type="text" class="form-control"';if(!$sameShipping){echo "value=\"$shippingpostalcode\"";} else{echo "value=\"\"";}
                                      echo'>
                                    </div>
                                  </div>                
                                  </div> 
                                  <div class="row">                                                                        
                                  <div class="col-md-12">
                                  <div class="form-group">
                                  <label class="bmd-label-floating">Country</label>
                                  <img id ="countryflag">                                  
                              <select name="country_name" class="form-control" id="country">';
                                            $getCountries = "Select countries_iso_code, countries_name from countries";
                                            $getCountriesQuery = mysqli_query($conn, $getCountries);
                                            while($getCountriesRows = mysqli_fetch_assoc($getCountriesQuery)){
                                               
                                                if($row['country'] == $getCountriesRows['countries_iso_code']){
                                                    
                                                    echo '<option selected value='.$getCountriesRows['countries_iso_code'].'>&#160&#160'.$getCountriesRows['countries_name'].'</option>';
                                                }
                                                else{
                                                    echo '<option value='.$getCountriesRows['countries_iso_code'].'>&#160&#160'.$getCountriesRows['countries_name'].'</option>';
                                                }
                                            }
                                        echo'</select>
                                  </div>
                                </div>                            
                                  </div>                                                       
                                    </div>
                                    </div> 
                                  <button type="submit" class="btn btn-primary pull-right">Update</button>
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
      <footer class="footer">
        <div class="container-fluid">          
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, Dns Electronics <i class="material-icons">favorite</i>            
          </div>
        </div>
      </footer>
    </div>
  
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="assets/js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="assets/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="assets/js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="assets/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="assets/js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="assets/js/plugins/arrive.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/js/custom_function.js"></script>  
  <script src="../js/intlTelInput.min.js"></script>  
</body>

</html>