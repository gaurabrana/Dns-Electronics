<?php
include('database/connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add Product</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Products</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Product</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="form-validation">
                    <form class="form-valide" action="#" method="post" enctype="multipart/form-data">
                    <?php                    
                    $imageFolderKey = md5(time());
                    echo"<input type='hidden' value='$imageFolderKey' id='productImageFolderKey'>";
                    ?>        
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="val-productname">Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="val-productname" name="val-productname" placeholder="Enter product name..">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="val-price">Price (Rs)<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="number" class="form-control" id="val-price" name="val-price" placeholder="Enter Product price..">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="val-discountprice">Discount (Rs)<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="number" class="form-control" id="val-discountprice" name="val-discountprice" placeholder="Enter discount amount..">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="val-stockquantity">Stock<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="number" class="form-control" id="val-stockquantity" name="val-stockquantity" placeholder="Quantity available for sale">
                            </div>
                        </div>    
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="val-description">Description <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <textarea class="form-control" id="val-description" name="val-description" rows="5" placeholder="About the product"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">    
                            <label class="col-lg-2 col-form-label" for="val-category">Category<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-3">
                                <select class="form-control select-category" id="val-category" name="val-category">
                                    <option value="new">Choose New Category</option>';
                                    <?php
                                    $getallCategory = "Select DISTINCT category from product";
                                    $executegetAllCategory = mysqli_query($conn, $getallCategory);
                                    while ($row1 = mysqli_fetch_assoc($executegetAllCategory)) {
                                        echo '<option value="' . $row1['category'] . '">' . $row1['category'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-3" id="new-category">
                                <input type="text" class="form-control" id="val-categoryname" name="val-categoryname" placeholder="Enter new category">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="val-brand">Brand<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-3">
                                <select class="form-control select-brand" id="val-brand" name="val-brand">
                                    <option value="new">Choose New Brand</option>                                 
                                </select>
                            </div>
                            <div class="col-lg-3" id="new-brand">
                                <input type="text" class="form-control" id="val-brandname" name="val-brandname" placeholder="Enter new brand">
                            </div>
                        </div>                                            
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="val-image">Product Main Image<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <label for="image" title="Click to change">
                                    <input type="file" name="image" id="imageMain" style="display:none;" />
                                    <input type="hidden" id="holdMainImageName">
                                    <img id="mainImage" src="images/addimages.png" alt="#">
                                </label>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="val-image">Product Sub Images<span class="text-danger"></span>
                            </label>
                            <div class="col-lg-3" id="imageHold">                                
                                <input type="file" name="subimages[]" id="imageSub" multiple style="display:none;" />
                                <img class="addSubImages" src="images/addimages.png" alt="#">
                            </div>
                        </div>
                        <div class="row mb-3" id="upstat">
                        
                        </div>
                        <div style="display:none;" id="hold-image-result" class="alert" role="alert">
                         
                        </div>
                </div>
                <div class="progress mb-3 hide-element" style="height: 9px">
                    <div class="progress-bar active progress-bar-striped bg-danger" style="width: 90%;" role="progressbar"><span class="sr-only">60% Complete</span>
                    </div>
                </div>                
                </form>                
                <div class="row">
                    <div class="col-lg-6">
                    <div class="d-flex flex-row-reverse">
                 <div class="p-2">
                     <button id="proceedToProductAdd" class="btn btn-success">Add Product</button>
                </div>  <div class="p-2">
                     <button id="resetFields" class="btn btn-warning">Reset</button>
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
    <script src="js/addproduct.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>

</body>

</html>