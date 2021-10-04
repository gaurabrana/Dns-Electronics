<?php
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Products</title>
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
                                    <table id="listproducts" class="table table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Discount</th>
                                                <th>Description</th>
                                                <th>Code</th>
                                                <th>Brand</th>
                                                <th>Stock</th>
                                                <th>Type</th>
                                                <th>Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getAllProducts = "Select * from product";
                                            $executegetAllProducts = mysqli_query($conn, $getAllProducts);
                                            $forModalExecution = mysqli_query($conn, $getAllProducts);
                                            while ($row = mysqli_fetch_assoc($executegetAllProducts)) {
                                                $description = substr($row['description'], 0, 100) . "....";
                                                echo '<tr id="rowforproduct' . $row['code'] . '">
                                                <td><img class="image-in-table" src="images/products/' . $row['sold_by'] . '/' . $row['image_folder_key'] . '/' . $row['image_name'] . '" alt="#"></td>
                                                <td>' . $row['name'] . '</td>
                                                <td>' . $row['price'] . '</td>
                                                <td>' . $row['discount'] . '</td>
                                                <td>' . $description . '</td>
                                                <td>' . $row['code'] . '</td>                                                
                                                <td>' . $row['brand'] . '</td>
                                                <td>' . $row['quantity_stock'] . '</td>
                                                <td>' . $row['type'] . '</td>
                                                <td>' . $row['category'] . '</td>                                                
                                                <td class="action-for-products">                                                
                                                <a data-toggle="modal" data-target="#modalforproduct' . $row['code'] . '" title="Update Product"><i class="ti-pencil-alt2"></i></a>&nbsp;&nbsp;&nbsp;
                                                <a data-toggle="modal" data-target="#modalforproductdelete' . $row['code'] . '" title="Delete Product"><i class="ti-trash"></i></a>
                                                </td>                                                
                                                </tr>';
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Product</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Discount</th>
                                                <th>Description</th>
                                                <th>Code</th>
                                                <th>Brand</th>
                                                <th>Stock</th>
                                                <th>Type</th>
                                                <th>Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                while ($row = mysqli_fetch_assoc($forModalExecution)) {
                    echo '<div class="modal fade" id="modalforproduct' . $row['code'] . '">
                                            <div class="modal-dialog modal-lg" role="document" aria-hidden="true" tabindex="-1">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">' . $row['name'] . '</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="form-validation">
                                                    <form class="form-valide" action="#" method="post" enctype="multipart/form-data">
                                                        <div class="form-group row">
                                                            <label class="col-lg-4 col-form-label" for="val-productname">Name <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-6">
                                                            <input type="hidden" class="form-control" id="productimagekey' . $row['code'] . '" value="' . $row['image_folder_key'] . '">
                                                                <input type="text" class="form-control" id="val-productname' . $row['code'] . '" name="val-productname" value="' . $row['name'] . '" placeholder="Enter product name..">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-lg-4 col-form-label" for="val-price">Price (Rs)<span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-6">
                                                                <input type="text" class="form-control" id="val-price' . $row['code'] . '" name="val-price" value="' . $row['price'] . '" placeholder="Enter Product price..">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-lg-4 col-form-label" for="val-discountprice">Discount (Rs)<span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-6">
                                                                <input type="text" class="form-control" id="val-discountprice' . $row['code'] . '" name="val-discountprice" value="' . $row['discount'] . '" placeholder="Enter discount amount..">
                                                            </div>
                                                        </div>    
                                                        <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label" for="val-stockquantity">Stock<span class="text-danger">*</span>
                                                        </label>
                                                        <div class="col-lg-6">
                                                            <input type="number" class="form-control" id="val-stockquantity' . $row['code'] . '" name="val-stockquantity" value="' . $row['quantity_stock'] . '" placeholder="Quantity available for sale">
                                                        </div>
                                                    </div>                                                     
                                                        <div class="form-group row">
                                                            <label class="col-lg-4 col-form-label" for="val-description">Description <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-6">
                                                                <textarea class="form-control" id="val-description' . $row['code'] . '" name="val-description" rows="5" placeholder="About the product">' . $row['description'] . '</textarea>
                                                            </div>
                                                        </div>    
                                                        <div class="form-group row">
                                                            <label class="col-lg-4 col-form-label" for="val-category">Category<span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-3">
                                                                <input type="hidden" class="form-control" id="val-type' . $row['code'] . '" name="val-type" value="' . $row['type'] . '" readonly>
                                                                <select class="form-control select-category" id="val-category' . $row['code'] . '" name="val-category">
                                                                <option value="new">Choose New Category</option>';
                    $getallCategory = "Select DISTINCT category from product";
                    $selectedCategory;
                    $executegetAllCategory = mysqli_query($conn, $getallCategory);
                    while ($row1 = mysqli_fetch_assoc($executegetAllCategory)) {
                        echo '<option ';
                        if ($row1['category'] == $row['category']) {
                            $selectedCategory = $row['category'];
                            echo ' selected ';
                        }
                        echo 'value="' . $row1['category'] . '">' . $row1['category'] . '</option>';
                    }
                    echo '</select>
                                                            </div>                                                           
                                                            <div class="col-lg-3 hide-element" id="new-category' . $row['code'] . '">
                                                            <input type="text" disabled class="form-control" id="val-categoryname' . $row['code'] . '" name="val-categoryname" placeholder="Enter new category">
                                                        </div>
                                                        </div>                                                                                                            
                                                        <div class="form-group row">
                                                            <label class="col-lg-4 col-form-label" for="val-brand">Brand<span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-3">
                                                                <select class="form-control select-brand" id="val-brand' . $row['code'] . '" name="val-brand">
                                                                <option value="new">Choose New Brand</option>';
                    $getallBrands = "Select DISTINCT brand from product where category = '$selectedCategory'";
                    $executegetAllBrands = mysqli_query($conn, $getallBrands);
                    while ($row1 = mysqli_fetch_assoc($executegetAllBrands)) {
                        echo '<option ';
                        if ($row1['brand'] == $row['brand']) {
                            echo ' selected ';
                        }
                        echo 'value="' . $row1['brand'] . '">' . $row1['brand'] . '</option>';
                    }
                    echo '</select>
                                                            </div>                                                           
                                                            <div class="col-lg-3 hide-element" id="new-brand' . $row['code'] . '">
                                                            <input type="text" disabled class="form-control" id="val-brandname' . $row['code'] . '" name="val-brandname" placeholder="Enter new brand">
                                                        </div>
                                                        </div>                                                                                                                                                                       
                                                        <div class="form-group row">
                                                            <label class="col-lg-4 col-form-label" for="val-image">Product Image<span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-6">
                                                                <label for="image" title="Click to change">
                                                                <input type="hidden" id="holdMainImageName' . $row['code'] . '" value="'.$row['image_name'].'">
                                                                <input type="file" name="image" class="holdImageForMainProduct" id="imageMain' . $row['code'] . '" style="display:none;"/>';
                    if (file_exists("images/products/" . $row['sold_by'] . "/" . $row['image_folder_key'] . "/" . $row['image_name'] . "")) {
                        echo '<img id="mainImage' . $row['code'] . '" class="image-in-form changeMainProductImage" src="images/products/' . $row['sold_by'] . '/' . $row['image_folder_key'] . '/' . $row['image_name'] . '" alt="#">';
                    } else {
                        echo '<img id="mainImage' . $row['code'] . '" class="iconforchange changeMainProductImage" src="images/addimages.png" alt="#">';
                    }
                    echo '</label>                                                                                                                     
                                                            </div>                                                            
                                                        </div>
                                                        <div class="form-group row">';
                                                        $folderkey = $row['image_folder_key'];
                                                        $getSubImages = "Select image_name from product_images where folder_key='$folderkey'";
                                                        $executegetSubImages = mysqli_query($conn, $getSubImages);
                                                        $hasMoreImages = mysqli_num_rows($executegetSubImages) > 0 ? true : false;                                                        
                                                        echo'<label class="col-lg-4 col-form-label" for="val-image">More Product Images<span class="text-danger">*</span>
                                                            </label>
                                                            <label class="css-control css-control-primary css-checkbox" for="val-terms">
                                                            <input '; if($hasMoreImages){echo "checked";} echo' data-toggle="collapse" href="#MoreProductImage'.$row['code'].'" role="button" aria-expanded="'; if($hasMoreImages){echo "true";} else { echo "false";} echo'" aria-controls="MoreProductImage'.$row['code'].'" type="checkbox" class="css-control-input" id="val-hasMoreImages'.$row['code'].'" name="val-hasMoreImages"> <span class="css-control-indicator"></span>&nbsp; Add more ??</label>
                                                        </div>
                                                        <div class="collapse';if($hasMoreImages){echo " show";}echo'" id="MoreProductImage'.$row['code'].'">
                                                        <hr>                                                    
                                                        <div class="form-group row">
                                                            <label class="col-lg-12 col-form-label" for="val-image">More Images<span class="text-danger"></span>
                                                            </label>
                                                            <div class="col-lg-3" id="imageHold'.$row['code'].'">                                                          
                                                            <label for="image" title="Click to change">
                                                            <input type="file" class="holdImageForSubProduct" name="subimages[]" id="imageSub' . $row['code'] . '" multiple style="display:none;" />
                                                            <img class="updateSubImages" id="subimagefor' . $row['code'] . '" src="images/addimages.png" alt="#">                                                                                                                                                                                                                                                                                          
                                                            </label></div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                                                        </div> 
                                                        <div class="row mb-3" id="upstat' . $row['code'] . '">';                                                        
                                                        if ($hasMoreImages) {
                                                            while ($getImages = mysqli_fetch_assoc($executegetSubImages)) {
                                                                $imagename = $getImages['image_name'];
                                                                echo '<div id="imageIdentifier' . $imagename . '" class="col-lg-3 col-md-4 col-sm-6 mb-2 uploaded-images">
                                                                                                    <img src = "images/products/' . $row['sold_by'] . '/' . $row['image_folder_key'] . '/' . $getImages['image_name'] . '" alt = "uploaded product image">
                                                                                                    <div class="deleteImage"><input type="hidden" value="'.$getImages['image_name'].'">
                                                                                                    <i id="SameimageIdentifier' . $imagename . '" class="fas fa-minus-circle fa-2x"></i></div></div>';
                                                            }
                                                        }
                                                        echo '</div>                                                  
                                                        </div>                                                                                                                
                                                        <div style="display:none;" id="hold-image-result' . $row['code'] . '" class="alert" role="alert">
                                                        
                                                        </div>
                                                        </div>                                                                                                                                                                                                                             
                                                    </form>
                                                </div>                                                    
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-success updateproduct" id="saveproductdetails' . $row['code'] . '">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                    echo '<div class="modal fade" id="modalforproductdelete' . $row['code'] . '" tabindex="-1" aria-labelledby="modalforproductdelete' . $row['code'] . '" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">' . $row['name'] . '</h5>
                                              <button type="button" class="close" data-dismiss="modal"><span>&times;</span>                                              
                                            </div>
                                            <div class="modal-body">
                                            <h4>Delete this product ??</h4>
                                            <div class="product-image">                                            
                                            <img class="image-in-form" src="images/products/' . $row['sold_by'] . '/' . $row['image_folder_key'] . '/' . $row['image_name'] . '" alt="product_image">
                                            </div>                                             
                                            <div class="alert mt-2 hide-element" id="showdeleteresult' . $row['code'] . '">                                                                
                                            </div>
                                            </div>
                                            <div class="modal-footer">                                            
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                              <button type="button" id="deleteproceed' . $row['code'] . '" class="deletebuttonforproduct btn btn-danger">Delete</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>';
                }
                ?>
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
    <script src="js/productlist.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
    <script src="./plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="./plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="./plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
</body>

</html>