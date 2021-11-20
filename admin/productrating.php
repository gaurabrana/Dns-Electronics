<?php
include("database/connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Product Rating</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="plugins/toastr/css/toastr.min.css" rel="stylesheet">
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
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Product Rating</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">                                    
                                    <?php                                                                                                                          
                                    $getProductsRating = "Select DISTINCT (r.product_code), p.name, p.sold_by, p.image_name, p.image_folder_key from reviews r, product p where r.product_code = p.code";
                                    $executegetRating = mysqli_query($conn, $getProductsRating);
                                    if(mysqli_num_rows($executegetRating) > 0){
                                        while($prod = mysqli_fetch_assoc($executegetRating)){
                                            echo'<div class="col-lg-12 mb-2 col-md-12 col-12">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-6">
                                                <img class="autoimageSize" src="images/products/' . $prod['sold_by'] . '/' . $prod['image_folder_key'] . '/' . $prod['image_name'] . '" alt="product image">
                                                 <h5>'.$prod['name'].'</h5>
                                                 </div>';
                                            $product_code = $prod['product_code'];
                                            $sql = "Select c.uniquekey,c.name,c.gender, c.profile_picture, r.review_id, r.added_date, r.rating, r.comment from reviews r, customer c where r.product_code = '$product_code' and r.customer_id = c.id order by r.added_date DESC";
                                             $result = mysqli_query($conn, $sql);
                                             if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                            $datefromdatabase = date_create($row['added_date']);
										$formatteddate = date_format($datefromdatabase, "M d, Y");
										$formattedtime = date_format($datefromdatabase, "h:i A");
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
                                        echo'<div class="col-lg-9 col-md-9 col-6">
                                            <table class="table table-bordered table-hover">
                                            <thead>
                                            <th>User</th>
                                            <th>Name</th>
                                            <th>Rating</th>
                                            <th>Review</th>   
                                            <th>Date</th>   
                                            <th>Action</th>                                         
                                            </thead>
                                            <tbody>
                                            <tr id="holdReview'.$row['review_id'].'">
                                                <td><img class="image-in-table" src="'.$imagesrc.'" alt="userimage" /></td>
                                                <td>'.$row['name'].'</td>
                                                <td>'.$row['rating'].'</td>
                                                <td>'.$row['comment'].'</td>
                                                <td>'.$formatteddate.' '.$formattedtime.'</td>
                                                <td><span id="deleteReview'.$row['review_id'].'" class=" actionforeview btn btn-danger">Delete</span>
                                                
                                                </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>';
                                           
                                        }
                                    }
                                    echo'</div>
                                    <hr>
                                </div>'; 
                                        }                                                                                
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
    <script src="js/productrating.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
    <script src="plugins/toastr/js/toastr.min.js"></script>
  <script src="plugins/toastr/js/toastr.init.js"></script>

</body>

</html>