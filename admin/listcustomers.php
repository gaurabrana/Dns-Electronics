<?php
include("connect.php");
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
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-body">
                                <h4 class="card-title">All Products</h4>
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
                                                <th>Joined On</th>
                                                <th>Status</th>
                                                <th>Last Active</th>                                                
                                                <th>Action</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getAllCustomers = "Select * from customer";
                                            $executegetAllCustomers = mysqli_query($conn, $getAllCustomers);
                                            $forModalExecution = mysqli_query($conn, $getAllCustomers);
                                            while($row = mysqli_fetch_assoc($executegetAllCustomers)){ 
                                               $status  = $row['approved'] == "YES" ? "Verified" : "Not verified";                                  
                                                echo'<tr>
                                                <td><img class="image-in-table" src="../img/UserProfile/'.$row['uniquekey'].'/'.$row['profile_picture'].'" alt="User profile picture"></td>
                                                <td>'.$row['name'].'</td>
                                                <td>'.$row['email'].'</td>
                                                <td>'.$row['age'].'</td>
                                                <td>'.$row['gender'].'</td>
                                                <td>'.$row['phone_no'].'</td>                                                
                                                <td>'.$row['joined_date'].'</td>
                                                <td>'.$status.'</td>
                                                <td>'.$row['active'].'</td>                                                
                                                <td class="action-for-users">                                                
                                                Disable
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
                                                <th>Action</th>                                                                                                                                            
                                            </tr>
                                        </tfoot>
                                    </table>
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
                    <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a> 2018</p>
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