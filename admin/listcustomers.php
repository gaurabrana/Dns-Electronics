<?php
include("database/connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Customers</title>
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
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Customers</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-body">
                                <h4 class="card-title">Customers</h4>
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
                                                <th>Joined</th>
                                                <th>Status</th>
                                                <th>Last Active</th>                                                
                                                <th>Access</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getAllCustomers = "Select * from customer";
                                            $executegetAllCustomers = mysqli_query($conn, $getAllCustomers);
                                            $forModalExecution = mysqli_query($conn, $getAllCustomers);
                                            while($row = mysqli_fetch_assoc($executegetAllCustomers)){ 
                                               $status  = $row['approved'] == "YES" ? "Verified" : "Unverified";      
                                               
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
                                                <td>'.$row['joined_date'].'</td>
                                                <td><span class="badge badge-pill '; if($status=="Verified"){echo "badge-success";} else{ echo "badge-danger";} echo'">'.$status.'</span></td>
                                                <td>'.$row['active'].'</td>                                                
                                                <td class="action-for-users">';     
                                                if($row['access']=="ENABLED"){
                                                    echo' <button id="showmodalaccess'.$row['uniquekey'].'" class="btn btn-danger" data-toggle="modal" data-target="#editUser'.$row['uniquekey'].'">Disable</button>';
                                                }          
                                                else{ 
                                                    echo' <button id="showmodalaccess'.$row['uniquekey'].'" class="btn btn-success" data-toggle="modal" data-target="#editUser'.$row['uniquekey'].'">Enable</button>';
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
                                                <th>Joined On</th>
                                                <th>Status</th>
                                                <th>Last Active</th>                                                
                                                <th>Access</th>                                                                                                                                            
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <?php
                                    while($row = mysqli_fetch_assoc($forModalExecution)){ 
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