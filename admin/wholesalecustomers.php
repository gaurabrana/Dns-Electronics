<?php
include("database/connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Wholesale Customers</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="./plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

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


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?php

        include("layouts.php");
        ?>

            <!--**********************************
            Content body start
        ***********************************-->
            <div class="content-body">

                <div class="row page-titles mx-0">
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Wholesale Customers</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-body">
                        <input hidden id="customertype" value="wholesale">
                                <h4 class="card-title">Wholesale Customers</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>User</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Age</th>
                                                <th>Gender</th>
                                                <th>Contact</th>                                                
                                                <th>Citizenship number</th>                                                
                                                <th>Current Address</th>
                                                <th>Permanent Address</th>
                                                <th>Business Name</th>
                                                <th>Pan Number</th>
                                                <th>Citizenship Img</th>
                                                <th>Joined</th>
                                                <th>Status</th>
                                                <th>Last Active</th>                                                
                                                <th>Access</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getAllCustomers = "Select * from customer, wholesale_detail where type='wholesale' and customer.id = wholesale_detail.user_id";
                                            $executegetAllCustomers = mysqli_query($conn, $getAllCustomers);
                                            $forModalExecution = mysqli_query($conn, $getAllCustomers);
                                            while($row = mysqli_fetch_assoc($executegetAllCustomers)){ 
                                               $status  = $row['approved'] == "YES" ? "Verified" : "Unverified";      
                                               $userid = $row['id'];
                                               if($row['profile_picture']=="notset"){
                                                if($row['gender']=="Male"){
                                                    $imagesrc =  '../img/maleuser.png';
                                                }
                                                else{
                                                    $imagesrc =  '../img/femaleuser.png';
                                                }  
                                               }
                                               else{
                                                if(file_exists('../img/UserProfile/'.$row['uniquekey'].'/'.$row['profile_picture'].'')){
                                                    $imagesrc =  '../img/UserProfile/'.$row['uniquekey'].'/'.$row['profile_picture'].'';   
                                                }
                                                else{
                                                    if($row['gender']=="Male"){
                                                        $imagesrc =  '../img/maleuser.png';
                                                    }
                                                    else{
                                                        $imagesrc =  '../img/femaleuser.png';
                                                    }                                                    
                                                }                                                
                                                
                                               }                                                                       
                                                echo'<tr>
                                                <td><img class="image-in-table" src="'.$imagesrc.'" alt="User profile picture"></td>
                                                <td>'.$row['name'].'</td>
                                                <td>'.$row['email'].'</td>
                                                <td>'.$row['age'].'</td>
                                                <td>'.$row['gender'].'</td>
                                                <td>'.$row['phone_no'].'</td>
                                                <td>'.$row['citizenship_number'].'</td>                                                
                                                <td>'.$row['current_address'].'</td>
                                                <td>'.$row['permanent_address'].'</td>
                                                <td>'.$row['business_name'].'</td>
                                                <td>'.$row['pan_number'].'</td>     
                                                <td><span title="click to view documents uploaded by this customer." style="cursor:pointer;" data-toggle="modal" data-target="#viewDocuments'.$userid.'">View Documents</span></td>            
                                                <td>'.$row['joined_date'].'</td>
                                                <td class="approve-action-for-users">';
                                                if($status == "Verified"){
                                                    echo'<span class="badge badge-pill badge-success">Verified</span>';
                                                }
                                                else{
                                                    echo'<span style="cursor:pointer;" data-toggle="modal" data-target="#approveUser'.$userid.'" class="badge badge-pill badge-danger">Unverified</span>';                                                     
                                                }                                                                                                                                                                                                 
                                                echo'</td>
                                                <td>'.$row['active'].'</td>                                                
                                                <td class="action-for-users">';     
                                                if($row['access']=="ENABLED"){
                                                    echo' <span style="cursor:pointer;" id="showmodalaccess'.$row['uniquekey'].'" class="badge badge-pill badge-danger" data-toggle="modal" data-target="#editUser'.$row['uniquekey'].'">Disable</span>';
                                                }          
                                                else{ 
                                                    echo' <span style="cursor:pointer;" id="showmodalaccess'.$row['uniquekey'].'" class="badge badge-pill badge-success" data-toggle="modal" data-target="#editUser'.$row['uniquekey'].'">Enable</span>';
                                                }                                              
                                               echo'
                                                </td>                                                
                                                </tr>';                                                
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>User</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Age</th>
                                                <th>Gender</th>
                                                <th>Contact</th>                                                
                                                <th>Citizenship number</th>                                                
                                                <th>Current Address</th>
                                                <th>Permanent Address</th>
                                                <th>Business Name</th>
                                                <th>Pan Number</th>
                                                <th>Citizenship Img</th>
                                                <th>Joined</th>
                                                <th>Status</th>
                                                <th>Last Active</th>                                                
                                                <th>Access</th>                                                                                                                                                 
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <?php
                                    while($row = mysqli_fetch_assoc($forModalExecution)){                                         
                                        if(file_exists('../img/UserProfile/'.$row['uniquekey'].'/'.$row['citizenship_front'].'')){
                                            $citizenship_front =  '../img/UserProfile/'.$row['uniquekey'].'/'.$row['citizenship_front'].'';   
                                        }
                                        if(file_exists('../img/UserProfile/'.$row['uniquekey'].'/'.$row['citizenship_back'].'')){
                                            $citizenship_back =  '../img/UserProfile/'.$row['uniquekey'].'/'.$row['citizenship_back'].'';   
                                        }
                                    // document images
                                    echo'<div class="modal fade" id="viewDocuments'.$userid.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title">'.$row['name'].'</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <div class="container">
                                          <div class="row">
                                          <div class="col-12">
                                          <h5 class="documentTitle">Citizenship Front Image</h5>
                                          <div class="uploaded-images">
                                          <img src="'.$citizenship_front.'" alt="Citizenship Front Image">
                                          </div>
                                          </div>
                                          <div class="col-12">
                                          <h5 class="documentTitle">Citizenship Back Image</h5>
                                          <div class="uploaded-images">
                                          <img src="'.$citizenship_back.'" alt="Citizenship Back Image">
                                          </div>
                                          </div>                                          
                                          </div>
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>                                          
                                        </div>
                                      </div>
                                    </div>
                                  </div>';


                                        //approve user one and only one time
                                  echo'<div class="modal fade" id="approveUser'.$userid.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title">Wholesale Customer '.$row['name'].' ?</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <h5>Are you sure to approve this wholesale customer ?</h5>   
                                          <div class="alert hide-element mt-2" id="approvalResult'.$row['uniquekey'].'"></div>                                       
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-success wholesaleApprovalButton" id="approveButtonWholesale'.$row['uniquekey'].'" >Approve User</button>
                                          <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>                                          
                                        </div>
                                      </div>
                                    </div>
                                  </div>';
                                        
                                        // change user access
                                    echo'<div class="modal fade" id="editUser'.$row['uniquekey'].'" tabindex="-1" role="dialog" aria-labelledby="editUser'.$row['uniquekey'].'label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="settingTitle'.$row['uniquekey'].'"><i class="fas fa-user-cog"></i>'; 
                                        if($row['access']=="ENABLED"){
                                            echo" Disable";
                                        } 
                                        else{
                                            echo" Enable";
                                        }
                                        echo' this account ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">                                        
                                        <div class="row">
                                        <div class="col-lg-4">
                                        <h5><i class="fas fa-user"></i> '.$row['name'].'</h5>';
                                        if($row['profile_picture']=="notset"){
                                            if($row['gender']=="Male"){
                                                $imagesrc =  '../img/maleuser.png';
                                            }
                                            else{
                                                $imagesrc =  '../img/femaleuser.png';
                                            }     
                                           }
                                           else{
                                            if(file_exists('../img/UserProfile/'.$row['uniquekey'].'/'.$row['profile_picture'].'')){
                                                $imagesrc =  '../img/UserProfile/'.$row['uniquekey'].'/'.$row['profile_picture'].'';   
                                            }
                                            else{
                                                if($row['gender']=="Male"){
                                                    $imagesrc =  '../img/maleuser.png';
                                                }
                                                else{
                                                    $imagesrc =  '../img/femaleuser.png';
                                                }     
                                            }
                                            
                                           }       
                                        echo'<img class="modalUserImage" src="'.$imagesrc.'" alt="User profile picture">                                        
                                        </div>                                                                                
                                        </div>
                                        <div class="row">
                                        <div class="col-lg-12">
                                        <div class="alert hide-element mt-2" id="actionResult'.$row['uniquekey'].'"></div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">';
                                    if($row['access']=="ENABLED"){
                                        echo'<button type="button" class="btn btn-danger manageuser" id="disableUser'.$row['uniquekey'].'"><i class="fas fa-user-lock"></i> <span id="actiontitle'.$row['uniquekey'].'">Disable Account</span></button>';
                                    }          
                                    else{ 
                                        echo'<button type="button" class="btn btn-success manageuser" id="enableUser'.$row['uniquekey'].'"><i class="fas fa-user-check"></i> <span id="actiontitle'.$row['uniquekey'].'">Enable Account</span></button>';
                                    }                                                                      
                                        echo'<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                                    </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                                                                                                                                                       
                </div>
                <!-- #/ container -->
            </div>
            <!--**********************************
            Content body end
        ***********************************-->


            <!--**********************************
            Footer start
        ***********************************-->
            <div class="footer">
                <div class="copyright">
                    <p>Copyright &copy; Designed & Developed by <a href="#">Gaurab Rana</a> 2021</p>
                </div>
            </div>
            <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
    <script src="./plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="./plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="./plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
</body>

</html>