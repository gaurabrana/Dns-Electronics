(function($) {

    $(".updateSubImages").on("click", function() {
        let id = $(this).attr("id");
        let PID = id.split("subimagefor")[1];
        $("#imageSub" + PID).click();
    });

    $(".holdImageForSubProduct").on("change", function() {
        let id = $(this).attr("id");
        let PID = id.split("imageSub")[1];
        ajaxup.add("sub", PID);
    });

    $(".changeMainProductImage").on("click", function() {
        let id = $(this).attr("id");
        let PID = id.split("mainImage")[1];
        $("#imageMain" + PID).click();
    });

    $(".holdImageForMainProduct").on("change", function() {
        let id = $(this).attr("id");
        let PID = id.split("imageMain")[1];
        ajaxup.add("main", PID);
    });

    //save product details
    $(".updateproduct").on("click", function() {
        let id = $(this).attr("id");
        let pid = id.split("saveproductdetails")[1];
        let no_of_errors = 0;
        let resultHolder = $("#hold-image-result" + pid);
        resultHolder.text("");
        resultHolder.append("OOPS!! Please fix these errors. <br> ======================== <br>");
        let pName = $("#val-productname" + pid).val();
        let pPrice = $("#val-price" + pid).val();
        let pType = $("#val-type" + pid).val();
        let pDiscountprice = $("#val-discountprice" + pid).val();
        let pWholesalediscountprice = $("#val-wholesalediscountprice" + pid).val();
        let pMinimumunit = $("#val-minimumunit" + pid).val();
        let pDescription = $("#val-description" + pid).val();
        let pBrand = $("#val-brand" + pid).val();
        let pBrandName;
        let pMoreImages = $("#val-hasMoreImages" + pid).prop("checked") == true ? true : false;
        let isBrandNew = false;
        if (pBrand == "new") {
            isBrandNew = true;
            pBrandName = $("#val-brandname" + pid).val();
        } else {
            pBrandName = pBrand;
        }
        let pStock = $("#val-stockquantity" + pid).val();
        let pCategory = $("#val-category" + pid).val();
        let pCategoryName;
        let isCategoryNew = false;
        if (pCategory == "new") {
            isCategoryNew = true;
            pCategoryName = $("#val-categoryname" + pid).val();
        } else {
            pCategoryName = pCategory;
        }
        let pMainImage = $("#holdMainImageName" + pid).val();
        var imageSrc = [];
        if (pMoreImages) {
            var pSubImages = $("#upstat" + pid + " :input");
            var no_of_sub_images = 0;
            for (let i of pSubImages) {
                no_of_sub_images++;
                imageSrc.push(i.value);
            }
            if (no_of_sub_images <= 0) {
                no_of_errors++;
                showInfo("Empty product sub images.<br>", "alert-danger");
            }
        } else {
            imageSrc.push("noimages");
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
            if (pDiscountprice < 0) {
                no_of_errors++;
                showInfo("Invalid product discount price.<br>", "alert-danger");
            }
        } else {
            pDiscountprice = 0;
        }
        if (pWholesalediscountprice.length = 0) {
            no_of_errors++;
            showInfo("Invalid product wholesale discount price.<br>", "alert-danger");
        } else {
            if (pWholesalediscountprice < 0) {
                no_of_errors++;
                showInfo("Invalid product wholesale discount price.<br>", "alert-danger");
            }
        }
        if (pMinimumunit.length = 0) {
            no_of_errors++;
            showInfo("Invalid product minumum order unit.<br>", "alert-danger");
        } else {
            if (pMinimumunit < 1) {
                no_of_errors++;
                showInfo("Invalid product minumum order unit.<br>", "alert-danger");
            }
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
        }
        if (pMainImage.length == 0) {
            no_of_errors++;
            showInfo("Empty product main image.<br>", "alert-danger");
        }

        if (no_of_errors == 0) {
            let imageKey = $("#productimagekey" + pid).val();
            //prepare to send product details
            let pdata = { "updateProduct": "ready", code: pid, name: pName, price: pPrice, description: pDescription, discount: pDiscountprice, wholesale: pWholesalediscountprice, minimumunit: pMinimumunit, stock: pStock, mainImage: pMainImage, subImage: imageSrc, brand: pBrandName, category: pCategoryName, imagekey: imageKey };
            $.ajax({
                url: "database/updateproduct.php",
                method: "POST",
                data: pdata,
                cache: false,
                success: function(response) {
                    var result = JSON.parse(response);

                    if (result.statusCode == 200) {
                        //add successful
                        showInfo("Product updated successfully", "alert-success");
                        let imageShow = '<img class="image-in-table" src="' + $("#mainImage" + pid).attr("src") + '" alt="#"></img>';
                        let row = $("#rowforproduct" + pid).get(0);
                        let button = '<a data-toggle="modal" data-target="#modalforproduct' + pid + '" title="Update Product"><i class="ti-pencil-alt2"></i></a>&nbsp;&nbsp;&nbsp;' +
                            '<a data-toggle = "modal" data-target = "#modalforproductdelete' + pid + '" title = "Delete Product"><i class = "ti-trash"> </i></a>';
                        var table = $("#listproducts").DataTable();
                        let data = [imageShow, pName, pPrice, pDiscountprice, pWholesalediscountprice, pMinimumunit, (pDescription.slice(0, 100) + "..."), pid, pBrandName, pStock, pType, pCategoryName, button];
                        table.row(row).data(data).draw();

                    } else if (result.statusCode == 201) {

                        //sub image add failed
                        showInfo("Failed to update product sub images", "alert-danger");
                    } else if (result.statusCode == 202) {
                        //add failed
                        showInfo("Failed to update product details.", "alert-danger");
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

    $(".deletebuttonforproduct").on("click", function() {
        let id = $(this).attr("id");
        let pcode = id.split("deleteproceed")[1];
        $.ajax({
            url: "database/deleteproduct.php",
            method: "POST",
            data: { "delete": pcode },
            cache: false,
            success: function(response) {
                let result = JSON.parse(response);
                let resultholder = $("#showdeleteresult" + pcode);
                resultholder.removeClass("hide-element");
                let color;
                if (result.statusCode == 200) {
                    color = "alert-success";
                    resultholder.text("Product deleted successfully.");
                    let row = $("#rowforproduct" + pcode).get(0);
                    var table = $(".zero-configuration").dataTable();
                    table.fnDeleteRow(table.fnGetPosition(row));
                    $("#modalforproductdelete" + pcode).modal('hide');
                    $("#rowforproduct" + pcode).remove();
                } else if (result.statusCode == 201) {
                    color = "alert-danger";
                    resultholder.text("Failed to delete product.");
                } else if (result.statusCode == 202) {
                    color = "alert-danger";
                    resultholder.text("Error deleting this product. Product data exist in " + result.existance + " tables.");
                }
                resultholder.addClass(color);
                resultholder
                    .delay(3000)
                    .queue(function(next) {
                        resultholder.removeClass(color);
                        resultholder.addClass("hide-element");
                        next();
                    });

            }
        });
    });

    var ajaxup = {
        // (A) ADD TO UPLOAD QUEUE
        queue: [], // upload queue
        add: function(a, b) {
            var element;
            if (a == "main") {
                element = "imageMain" + b;
            } else if (a == "sub") {
                element = "imageSub" + b;
            }
            for (let f of document.getElementById(element).files) {
                ajaxup.queue.push(f);
            }
            $("#" + element).val("");
            if (!ajaxup.uploading) { ajaxup.go(a, b); }
            return false;
        },
        // (B) AJAX UPLOAD
        uploading: false, // upload in progress
        go: function(a, c) {
            // (B1) UPLOAD ALREADY IN PROGRESS
            ajaxup.uploading = true;
            // (B2) FILE TO UPLOAD
            var data = new FormData();
            if (a == "main") {
                data.append("type", "main");
            }
            let imageFolderKey = $("#productimagekey" + c).val();
            data.append("code", imageFolderKey);
            data.append("imageSub", ajaxup.queue[0]);
            // APPEND MORE VARIABLES IF YOU WANT
            // data.append("KEY", "VALUE");
            // (B3) AJAX REQUEST
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "database/imageupload.php");
            xhr.onload = function() {
                var path = JSON.parse(this.response);
                if (path.code == 200) {
                    if (a == "main") {
                        $("#holdMainImageName" + c).val(path.imagename);
                        $("#mainImage" + c).attr("src", path.imagePath + "?" + new Date().getTime());
                    } else if (a == "sub") {
                        document.getElementById("upstat" + c).innerHTML += '<div id="imageIdentifier' + path.name + '" class="col-lg-3 col-md-4 col-sm-6 mb-2 uploaded-images">' +
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
                if (ajaxup.queue.length != 0) { ajaxup.go(a, c); } else { ajaxup.uploading = false; }
            };

            // (B6) GO!
            xhr.send(data);
        }
    };

})(jQuery);