<?php
include("database/connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Product Queries</title>
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
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Product Queries</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <div class="container-fluid">
                <div class="row">
                    <?php                    
                     $getProductQuestions = "Select distinct (product_code) from product_queries";
                    $executegetProductQuestions = mysqli_query($conn, $getProductQuestions);
                    if(mysqli_num_rows($executegetProductQuestions) > 0){
                        while($row = mysqli_fetch_assoc($executegetProductQuestions)){
                            $code = $row['product_code'];
                            echo'<div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                    <div class="col-lg-3 col-md-3 col-12">';
                                    $getProduct = "Select p.name, p.code, p.sold_by, p.image_name, p.image_folder_key from product p where p.code = '$code'";
                                    $executegetProduct = mysqli_query($conn, $getProduct);                    
                                    while($row1 = mysqli_fetch_assoc($executegetProduct)){            
                                        echo'<img class="autoimageSize" src="images/products/' . $row1['sold_by'] . '/' . $row1['image_folder_key'] . '/' . $row1['image_name'] . '" alt="product image">
                                        <h5>'.$row1['name'].'</h5>';

                                    }                                        
                                    echo'</div>
                                    <div class="col-lg-9 col-md-9 col-12">';
                                    $getQuestions = "Select question, id, adminreply from product_queries where product_code = '$code' order by added_date desc";
                                    $executegetProductQueries = mysqli_query($conn, $getQuestions);
                                    if(mysqli_num_rows($executegetProductQueries) > 0){
                                        while($row2 = mysqli_fetch_assoc($executegetProductQueries)){                                            
                                            echo'<div class="row mb-2">                                            
                                            <div class="col-lg-10">
                                            <div class="question">
                                            <h5>'.$row2['question'].'</h5>
                                            </div>                                            
                                            </div>
                                            <div class="col-lg-2">
                                            <div class="reply">
                                            <a id="toggleanswer'.$row2['id'].'" data-toggle="collapse" href="#question'.$row2['id'].'" role="button" aria-expanded="false" aria-controls="question'.$row2['id'].'">';
                                            if($row2['adminreply']!="-"){
                                                echo "See answer";
                                            } 
                                            else{
                                                echo "Answer now";
                                            }
                                            echo'</a>
                                            </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-12">
                                            <div class="collapse" id="question'.$row2['id'].'">
                                            <div class="card card-body">     
                                            <div id="queryresult'.$row2['id'].'" class="alert hide-element">
                                            
                                            </div>                                       
                                                <textarea id="reply'.$row2['id'].'" style="max-width: 100%;" cols="80">';
                                                if($row2['adminreply']!="-"){
                                                    echo $row2['adminreply'];
                                                }
                                                echo'</textarea>  
                                                <button id="savereply'.$row2['id'].'" class="btn btn-info mt-2 answerproductquery">';
                                                if($row2['adminreply']!="-"){
                                                    echo "Update";
                                                }
                                                else{
                                                    echo "Reply";
                                                }
                                                echo'</button>                                              
                                            </div>
                                            
                                            </div>
                                            </div>
                                            
                                            </div>';
                                        }
                                    }                                              
                                    echo'</div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        }
                    }                                                                    
                    ?>                    
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
    <script src="js/productdetail.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>

</body>

</html>