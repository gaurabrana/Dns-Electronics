(function($) {
    "use strict";

    $(".select-brand").on("change", function() {
        let value = $(this).val();
        let id = $(this).attr("id");
        let pID = id.split("val-brand")[1];
        if (value == "new") {
            $("#new-brand" + pID).removeClass("hide-element");
            $("#new-brand" + pID + " input").prop("disabled", false);
        } else {
            $("#new-brand" + pID).addClass("hide-element");
            $("#new-brand" + pID + " input").prop("disabled", true);
        }
    });

    $(".select-category").on("change", function() {
        let value = $(this).val();
        let id = $(this).attr("id");
        let pID = id.split("val-category")[1];
        if (value == "new") {
            $("#val-brand").text("");
            $("#val-brand").append("<option value='new'>Choose New Brand</option>");
            $("#new-category" + pID).removeClass("hide-element");
            $("#new-category" + pID + " input").prop("disabled", false);
        } else {
            $.ajax({
                url: "database/getData.php",
                method: "POST",
                data: { "datatype": "CategoryBrand", "category": value },
                cache: false,
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.code == 200) {
                        $("#val-brand").text("");
                        $("#val-brand").append(data.result);
                    }
                }
            });
            $("#new-brand" + pID).removeClass("hide-element");
            $("#new-brand" + pID + " input").prop("disabled", false);
            $("#new-category" + pID).addClass("hide-element");
            $("#new-category" + pID + " input").prop("disabled", true);
        }
    });

    $(".addSubImages").on('click', function() {
        $("#imageSub").click();
    });

    $("#imageSub").change(function() {
        ajaxup.add("sub");
    });

    $("#mainImage").on("click", function() {
        $("#imageMain").click();
    });

    $("#imageMain").change(function() {
        ajaxup.add("main");
    });

    $(document).on("click", ".deleteImage i", function(e) {
        let getID = $(this).attr("id");
        let imageHolderID = getID.split("SameimageIdentifier")[1];
        let imagePath = $("#imageIdentifier" + imageHolderID + " img").attr("src");
        let resultHolder = $("#hold-image-result");
        $.ajax({
            url: "deletefile.php",
            method: "POST",
            data: { filepath: imagePath },
            cache: false,
            success: function(result) {
                var resultcode = JSON.parse(result);
                var resultcolor;
                $(resultHolder).css("display", "block");
                if (resultcode.statusCode == 200) {
                    $("#imageIdentifier" + imageHolderID).remove();
                    $(resultHolder).text("Image deleted successfully.");
                    resultcolor = "alert-success";
                } else if (resultcode.statusCode == 201) {
                    $(resultHolder).text("Failed to delete image. Please try again");
                    resultcolor = "alert-danger";
                }
                $(resultHolder).addClass(resultcolor);
                $(resultHolder)
                    .delay(3000)
                    .queue(function(next) {
                        $(resultHolder).removeClass(resultcolor);
                        $(this).css('display', 'none');
                        next();
                    });
            }
        });
    });
    var ajaxup = {
        // (A) ADD TO UPLOAD QUEUE
        queue: [], // upload queue
        add: function(a) {
            var element;
            if (a == "main") {
                element = "imageMain";
            } else if (a == "sub") {
                element = "imageSub";
            }
            for (let f of document.getElementById(element).files) {
                ajaxup.queue.push(f);
            }
            $("#" + element).val("");
            if (!ajaxup.uploading) { ajaxup.go(a); }
            return false;
        },
        // (B) AJAX UPLOAD
        uploading: false, // upload in progress
        go: function(a) {
            // (B1) UPLOAD ALREADY IN PROGRESS
            ajaxup.uploading = true;
            // (B2) FILE TO UPLOAD
            var data = new FormData();
            if (a == "main") {
                data.append("type", "main");
            }
            let imageFolderKey = $("#productImageFolderKey").val();
            data.append("code", imageFolderKey);
            data.append("imageSub", ajaxup.queue[0]);
            // APPEND MORE VARIABLES IF YOU WANT
            // data.append("KEY", "VALUE");
            // (B3) AJAX REQUEST
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "imageupload.php");
            xhr.onload = function() {
                var path = JSON.parse(this.response);
                if (path.code == 200) {
                    if (a == "main") {
                        $("#holdMainImageName").val(path.imagename);
                        $("#mainImage").attr("src", path.imagePath + "?" + new Date().getTime());
                        $("#mainImage").css({ "height": "auto", "width": "100%" });
                    } else if (a == "sub") {
                        document.getElementById("upstat").innerHTML += '<div id="imageIdentifier' + path.name + '" class="col-lg-3 col-md-4 col-sm-6 mb-2 uploaded-images">' +
                            '<img src = "' + path.imagePath + '" alt = "uploaded product image"><div class="deleteImage"><input type="hidden" value="' + path.imagename + '">' +
                            '<i id="SameimageIdentifier' + path.name + '" class="fas fa-minus-circle fa-2x"></i></div></div>';
                    }
                } else if (path.code == 201) {
                    if (a == "main") {

                    } else if (a == "sub") {
                        document.getElementById("upstat").innerHTML += '<div class="col-lg-3 mb-2 uploaded-images"><span>' + path.error + '</span></div>';
                    }
                }
                // (B5) NEXT FILE
                ajaxup.queue.shift();
                if (ajaxup.queue.length != 0) { ajaxup.go(a); } else { ajaxup.uploading = false; }
            };

            // (B6) GO!
            xhr.send(data);
        }
    };



    $("#resetFields").on("click", function() {
        resetFields();
    });
    $("#proceedToProductAdd").on("click", function() {
        //get all form datas        
        let no_of_errors = 0;
        let resultHolder = $("#hold-image-result");
        resultHolder.text("");
        resultHolder.append("OOPS!! Please fix these errors. <br> ======================== <br>");
        let pName = $("#val-productname").val();
        let pPrice = $("#val-price").val();
        let pDiscountprice = $("#val-discountprice").val();
        let pDescription = $("#val-description").val();
        let pBrand = $("#val-brand").val();
        let pBrandName;
        let isBrandNew = false;
        if (pBrand == "new") {
            isBrandNew = true;
            pBrandName = $("#val-brandname").val();
        } else {
            pBrandName = pBrand;
        }
        let pStock = $("#val-stockquantity").val();
        let pCategory = $("#val-category").val();
        let pCategoryName;
        let isCategoryNew = false;
        if (pCategory == "new") {
            isCategoryNew = true;
            pCategoryName = $("#val-categoryname").val();
        } else {
            pCategoryName = pCategory;
        }
        let pMainImage = $("#holdMainImageName").val();
        let pSubImages = $("#upstat :input");
        var imageSrc = [];
        var no_of_sub_images = 0;
        for (let i of pSubImages) {
            no_of_sub_images++;
            imageSrc.push(i.value);
        }
        //validate fields
        if (pName.length == 0) {
            no_of_errors++;
            showInfo("Empty product name.<br>", "alert-danger");
        }
        if (pPrice.length == 0) {
            no_of_errors++;
            showInfo("Empty product price.<br>", "alert-danger");
        } else {
            if (pPrice <= 0) {
                no_of_errors++;
                showInfo("Invalid product price.<br>", "alert-danger");
            }
        }
        if (pDiscountprice.length > 0) {
            if (pDiscountprice <= 0) {
                no_of_errors++;
                showInfo("Invalid product discount price.<br>", "alert-danger");
            }
        } else {
            pDiscountprice = 0;
        }
        if (pDescription.length == 0) {
            no_of_errors++;
            showInfo("Empty product description.<br>", "alert-danger");
        }
        if (isCategoryNew) {
            if (pCategoryName.length == 0) {
                no_of_errors++;
                showInfo("Empty product category type.<br>", "alert-danger");
            }
        }
        if (isBrandNew) {
            if (pBrandName.length == 0) {
                no_of_errors++;
                showInfo("Empty product brand name.<br>", "alert-danger");
            }
        }
        if (pStock.length == 0) {
            no_of_errors++;
            showInfo("Empty product stock quantity.<br>", "alert-danger");
        } else {
            if (pStock <= 0) {
                no_of_errors++;
                showInfo("Invalid product stock quantity.<br>", "alert-danger");
            }
        }
        if (pMainImage.length == 0) {
            no_of_errors++;
            showInfo("Empty product main image.<br>", "alert-danger");
        }
        if (no_of_sub_images <= 0) {
            imageSrc.push("noimages");
            // no_of_errors++;
            // showInfo("Empty product sub images.<br>", "alert-danger");
        }

        if (no_of_errors == 0) {
            let imageKey = $("#productImageFolderKey").val();
            //prepare to send product details
            let pdata = { "addProduct": "ready", name: pName, price: pPrice, description: pDescription, discount: pDiscountprice, stock: pStock, mainImage: pMainImage, subImage: imageSrc, brand: pBrandName, category: pCategoryName, imagekey: imageKey };
            $.ajax({
                url: "database/addproduct.php",
                method: "POST",
                data: pdata,
                cache: false,
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.statusCode == 200) {
                        //add successful
                        showInfo("Product added successfully", "alert-success");
                        resetFields();
                        if (isCategoryNew) {
                            $("#val-brand").append("<option value='" + pCategoryName + "'>" + pCategoryName + "</option>");
                        }
                        //remove all values

                    } else if (result.statusCode == 201) {
                        //sub image add failed
                        showInfo("Failed to add product sub images", "alert-danger");
                    } else if (result.statusCode == 202) {
                        //add failed
                        showInfo("Failed to add product details.", "alert-danger");
                    }
                }
            });

        }

        function showInfo(a, b) {
            if (b == "alert-success") {
                $(resultHolder).text("");
            }
            $(resultHolder).append(a);
            $(resultHolder).addClass(b);
            $(resultHolder).css("display", "block");
            $(resultHolder)
                .delay(5000)
                .queue(function(next) {
                    $(resultHolder).removeClass(b);
                    $(this).css('display', 'none');
                    next();
                });
        }

    });

    function resetFields() {
        $("#val-productname").val("");
        $("#val-price").val("");
        $("#val-discountprice").val("");
        $("#val-description").val("");
        $("#val-brand").text("");
        $("#val-brand").append("<option value='new'>Choose New Brand</option>");
        $("#val-brand").val("new");
        $("#val-brandname").val("");
        $("#val-categoryname").val("");
        $("#val-category").val("new");
        $("#val-stockquantity").val("");
        $("#holdMainImageName").val("");
        $("#new-category").removeClass("hide-element");
        $("#new-category input").prop("disabled", false);
        $("#new-brand").removeClass("hide-element");
        $("#new-brand input").prop("disabled", false);
        $("#mainImage").css({ "height": "50px", "width": "50px" });
        $("#mainImage").attr("src", "images/addimages.png");
        $(".addSubImages").attr("src", "images/addimages.png");
        $("#upstat").empty();
    }
})(jQuery);