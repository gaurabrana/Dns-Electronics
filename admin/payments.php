<?php
include("database/connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Payments</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="./plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">

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
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Payments</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <div class="container-fluid">
                <div class="row">
                <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">All Payments</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>     
                                                <th>Payment Type</th>                                                
                                                <th>Due Total (Rs)</th>
                                                <th>Paid Amount (Rs)</th>                                                 
                                                <th>Payment Date</th>     
                                                <th>Status</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include("./formatdate.php");
                                            $getOngoingOrders = "Select * from orders";
                                            $executegetAllOngoingOrders = mysqli_query($conn, $getOngoingOrders);
                                            $forModal = mysqli_query($conn, $getOngoingOrders);
                                            while ($row = mysqli_fetch_assoc($executegetAllOngoingOrders)) {
                                                $orderid = $row['id'];
                                                $date = formatDate($row['order_date']) . " " . formatTime($row['order_date']);

                                                $getTotalPrice = "Select sum(total_price) as total from order_item where order_id = '$orderid'";
                                                $getTotalPriceExecute = mysqli_query($conn, $getTotalPrice);
                                                $getTotalOrdered = mysqli_fetch_assoc($getTotalPriceExecute);
                                                $total = $getTotalOrdered['total']; 


                                                $getPaymentDetail = "Select * from payment where order_id = '$orderid'";
                                                $getPaymentDetailResult  = mysqli_query($conn, $getPaymentDetail);
                                                if(mysqli_num_rows($getPaymentDetailResult) > 0){
                                                    // has payment details
                                                    $paid = true;                                                    
                                                    $row1 = mysqli_fetch_assoc($getPaymentDetailResult);
                                                    $paymentid = $row1['id'];
                                                    $due_amount = $row1['due_amount'];
                                                    $paid_amount = $row1['paid_amount'];                                                    
                                                    $paid_date = $row1['paid_date'];
                                                    $status = $row1['status'];     
                                                    echo '<tr>
                                                    <td>' . $orderid . '</td>       
                                                    <td>' . $row['payment_type'] . '</td>                                                                                                                                                                                                                                             
                                                    <td>' . $total . '</td>
                                                    <td>' . $paid_amount . '</td>                                                                                                                     
                                                    <td>' . $paid_date . '</td>            
                                                    <td>'.$status.'</td>                                                                                                                                                                                                                                
                                                    </tr>';                                               
                                                }                                                                                  
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Order ID</th>   
                                                <th>Payment Type</th>                                                                                                                                     
                                                <th>Due Total (Rs)</th>
                                                <th>Paid Amount (Rs)</th>                                                
                                                <th>Payment Date</th>
                                                <th>Status</th>                                                
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