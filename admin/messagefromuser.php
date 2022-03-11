<?php
include('database/connect.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Quixlab - Bootstrap Admin Dashboard Template by Themefisher.com</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
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
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Messages</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <div class="container-fluid">
                    <div class="row">                        
                        <div class="card">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card-head">
                                <h3>Message From User</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-responsive table-hover">
                                    <thead>
                                        <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>                                
                                <tbody>
                            <?php
                            $getMessages = "Select * from contactmessage";
                            $getMessagesResult = mysqli_query($conn, $getMessages);
                            $forModal = mysqli_query($conn, $getMessages);
                            while($row = mysqli_fetch_assoc($getMessagesResult)){
                                $messageid = $row['id'];
                                echo'<tr>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['email'].'</td>
                                <td>'.$row['message'].'</td>
                                <td><button class="btn btn-info" data-target="#replymessage' . $messageid . '" data-toggle="modal">Reply Now</button></td>
                                </tr>';
                            }
                            ?>
                            </tbody>
                            </table>
                            <?php
                            while($row = mysqli_fetch_assoc($getMessagesResult)){
                                $messageid = $row['id'];
                                echo '<div class="modal fade" id="replymessage' . $messageid . '" tabindex="-1" role="dialog" aria-labelledby="replymessage' . $messageid . 'label" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Message Details</h5>                              
                    </div>
                    <div class="modal-body">                                        
                       
                    </div>
                    <div class="modal-footer">                                    
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

</body>

</html>