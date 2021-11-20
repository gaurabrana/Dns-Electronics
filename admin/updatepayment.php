<?php
include("database/connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Update Payment</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="./plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="./plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    

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
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Payment</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <div class="container-fluid">
                <div class="row">
                <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Update Order Payments</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>     
                                                <th>Payment Type</th>                                                
                                                <th>Due Total (Rs)</th>
                                                <th>Paid Amount (Rs)</th>
                                                <th>Remaining Amount (Rs)</th> 
                                                <th>Payment Date</th>     
                                                <th>Status</th>
                                                <th>Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include("./formatdate.php");
                                            $getOngoingOrders = "Select * from orders where status <> 'completed'";
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
                                                    $remaining_amount = $row1['remaining_amount'];
                                                    $paid_date = $row1['paid_date'];
                                                    $status = $row1['status'];                          
                                                                                                        
                                                    if($status=="Half Paid"){
                                                        $paymentcompleted = false;
                                                    }
                                                    else if($status == "Full Paid"){
                                                        $paymentcompleted = true;
                                                    }
                                                }
                                                else{
                                                    // no payment details
                                                    $paymentid = "-";
                                                    $paid = false;
                                                    $due_amount = $total;
                                                    $paid_amount = "-";
                                                    $remaining_amount = "-";
                                                    $paid_date = "-";                                                    
                                                    $status = "Unpaid";
                                                }                                                                                                                                              
                                                    echo '<tr>
                                                    <td>' . $orderid . '</td>       
                                                    <td>' . $row['payment_type'] . '</td>                                                                                                                                                                                                                                             
                                                    <td>' . $total . '</td>
                                                    <td>' . $paid_amount . '</td>         
                                                    <td>' . $remaining_amount . '</td>                                                          
                                                    <td>' . $paid_date . '</td>            
                                                    <td>'.$status.'</td>                                                                                                                                                                            
                                                    <td><button class="btn btn-danger" data-target="#moredetails' . $orderid . '" data-toggle="modal">Update</button></td>
                                                    </tr>';
                                                                                                
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Order ID</th>   
                                                <th>Payment Type</th>                                                                                                                                     
                                                <th>Due Total (Rs)</th>
                                                <th>Paid Amount (Rs)</th>
                                                <th>Remaining Amount (Rs)</th>
                                                <th>Payment Date</th>
                                                <th>Status</th>
                                                <th>Details</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <?php
                                    while($row = mysqli_fetch_assoc($forModal)){
                                        $order_id = $row['id'];
                                        $getTotalPrice = "Select sum(total_price) as total from order_item where order_id = '$order_id'";
                                                $getTotalPriceExecute = mysqli_query($conn, $getTotalPrice);
                                                $getTotalOrdered = mysqli_fetch_assoc($getTotalPriceExecute);
                                                $total = $getTotalOrdered['total'];
                                        echo'<div class="modal fade" id="moredetails' . $row['id'] . '" tabindex="-1" role="dialog" aria-labelledby="moredetails' . $row['id'] . '" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">ORDER ID: '.$order_id.' <br> <span>Due Amount: Rs ' .$total. '</span>  </h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                            <form class="form-validation" action="#" method="post">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-paymenttype">Payment Type <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">        
                                                    <select name="paymenttype" id="holdpaymenttype'.$order_id.'" class="form-control">
                                                    <option value="COD" selected>Cash On Delivery</option>
                                                    <option value="Esewa">Esewa</option>
                                                    <option value="PayPal">PayPal</option>
                                                    </select>                                                                                            
                                                </div>
                                            </div>                                                                           
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-payamount">Paid Amount (Rs)<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="number" min="1" max="'.$total.'" oninput="checkAmount(' . $order_id . ','.$total.')" class="form-control" required id="val-payamount' . $order_id . '" name="val-payamount" placeholder="Enter paid amount..">
                                                </div>
                                            </div>   
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-remainingamount">Remaining Amt (Rs)<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" readonly class="form-control" id="val-remainingamount' . $order_id . '" name="val-remainingamount" placeholder="" >
                                                </div>
                                            </div>  
                                            <div class="form-group row form-material" id="holdCalendar'.$order_id.'">
                                            <div class="col-md-12">
                                            <label class="m-t-40">Payment Date&Time <span class="text-danger">*</span></label>
                                            <input type="text" id="date-format" class="form-control" placeholder="Select payment date and time">
                                        </div>  
                                        </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
                                            <div id="hold-payment-result' . $order_id . '" class="alert hide-element" role="alert">                                            
                                            </div>                                                                   
                                            <div class="form-group row">                                                
                                                <div class="col-lg-12 d-flex justify-content-center">
                                                <button type="submit" id="updatepayment'.$order_id.'" class="btn btn-success paymentupdate">Save changes</button>                                                       
                                                </div>
                                            </div>                               
                                                                                                                                                                                                             
                                             </form>
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
    <script src="js/updatepayment.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
    <script src="./plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="./plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="./plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
    <script src="./plugins/moment/moment.js"></script>
    <script src="./plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script>
 $('#date-format').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY - HH:mm A'        
    });

    </script>
</body>

</html>