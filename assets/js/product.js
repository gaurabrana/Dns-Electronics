$(document).on('ready', function() {
    function readyProductFilter(data) {
        // get limit                  
        let limit = $("select#itemsPerPage option").filter(":selected").val();
        // get sorting used
        let sortType = $("select#sortType option").filter(":selected").val();
        Object.assign(data, { "limit": limit, "sortType": sortType });
        $.ajax({
            url: "database/sortProducts.php",
            type: "POST",
            data: data,
            cache: false,
            success: function(result) {
                loadData(result);
                $("#currentQuery").val(JSON.stringify(data));
                if ('pageno' in data) {
                    $(".pagination li").removeClass("active");
                    $("#paginationValue" + data.pageno).closest('li').addClass("active");
                }
                if ('filter' in data) {
                    if (data.filter != "priceSlider") {
                        focusProducts();
                    }
                }
            }
        });
    }

    function ResetFilters() {
        $(".brand-list li a").removeClass("active-filter");
        $(".categor-list li a").removeClass("active-filter");
        let limit = $("select#itemsPerPage option").filter(":selected").val();
        let sortType = $("select#sortType option").filter(":selected").val();
        if (sortType != "none") {
            $('#sortType option[value="none"]').prop("selected", "selected");
            $("#sortType").niceSelect('update');
        }
        if (limit != 12) {
            $('#itemsPerPage option[value="12"]').prop("selected", "selected");
            $("#itemsPerPage").niceSelect('update');
        }
    }

    $(function() {
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 100000,
            values: [0, 100000],
            slide: function(event, ui) {
                $("#amount").val("Rs " + ui.values[0] + " - Rs " + ui.values[1]);
                let data = { "filter": "priceSlider", minPrice: ui.values[0], maxPrice: ui.values[1] };
                ResetFilters();
                readyProductFilter(data);
            }
        });
        $("#amount").val("Rs " + $("#slider-range").slider("values", 0) +
            " - Rs " + $("#slider-range").slider("values", 1));
    });

    $(".check-box-list").on('change', function(e) {
        ResetFilters();
        var value = $("input[name='ranges']:checked").val();
        let data = { "filter": "priceRanges", range: value };
        readyProductFilter(data);
    });

    $(".brand-list li a").on("click", function(e) {
        e.preventDefault();
        ResetFilters();
        var brand = $(this).attr('id');
        $("#" + brand).addClass("active-filter");
        let data = { "filter": "brand", brandName: brand };
        readyProductFilter(data);
    });

    $(".categor-list li a").on("click", function(e) {
        e.preventDefault();
        ResetFilters();
        var category = $(this).attr('id');
        $("#" + category).addClass("active-filter");
        let data = { "filter": "category", categoryName: category };
        readyProductFilter(data);
    });

    $("#sortType").on('change', function(e) {
        let data = JSON.parse($("#currentQuery").val());
        if ('pageno' in data) {
            delete data.pageno;
        }
        readyProductFilter(data);
    });

    $("#itemsPerPage").on('change', function(e) {
        let data = JSON.parse($("#currentQuery").val());
        if ('pageno' in data) {
            delete data.pageno;
        }
        readyProductFilter(data);
    });


    function reInitializeCarousel() {
        $('.quickview-slider-active').owlCarousel({
            items: 1,
            autoplay: true,
            autoplayTimeout: 5000,
            smartSpeed: 400,
            autoplayHoverPause: true,
            nav: true,
            loop: true,
            merge: true,
            dots: false,
            navText: ['<i class=" ti-arrow-left"></i>', '<i class=" ti-arrow-right"></i>'],
        });
    };

    function loadData(a) {
        var paginationData = a.split("<!--EndPagination-->")[0];
        $("#holdPaginationButtons ul").html(paginationData);
        var pData = a.split("<!--EndPagination-->")[1];
        var b = pData.split("<!--EndGridSection-->")[0];
        var c = pData.split("<!--EndGridSection-->")[1];
        $("#loadProducts").html(b);
        $("#loadProducts").fadeIn('normal');
        if ($("#toggle-list-style").hasClass("active")) {
            $("#loadProducts .single-product").css("display", "none");
        }
        $("#list-style-product-display").html(c);
        reInitializeCarousel();
    }

    $("#toggle-list-style").on("click", function(e) {
        e.preventDefault();
        $(this).addClass("active");
        $("#toggle-card-style").removeClass("active");
        $("#list-style-product-display").css("display", "flex");
        $("#loadProducts .single-product").css("display", "none");
    });

    $("#toggle-card-style").on("click", function(e) {
        e.preventDefault();
        $(this).addClass("active");
        $("#toggle-list-style").removeClass("active");
        $("#list-style-product-display").css("display", "none");
        $("#loadProducts .single-product").css("display", "block");
    });

    $(document).on("click", ".pagination li a", function(e) {
        e.preventDefault();
        let elementid = $(this).attr("id");
        let pageNumber;
        let currentpage = $("#currentPage").val();
        if (elementid == "nextPage" || elementid == "previousPage") {
            if (elementid == "nextPage") {
                pageNumber = parseInt(currentpage) + 1;
            } else {
                pageNumber = parseInt(currentpage) - 1;
            }
        } else {
            pageNumber = elementid.split("paginationValue")[1];
        }


        if (pageNumber > totalPages || pageNumber < 1) {
            return;
        } else {
            let data = JSON.parse($("#currentQuery").val());
            Object.assign(data, { "pageno": pageNumber });
            readyProductFilter(data);
        }

    });
    if (window.matchMedia("(max-width: 425px)").matches) {
        $(".product-action-2 span").html('<i class="fas fa-cart-plus"></i>');
    }
    if (window.matchMedia("(max-width: 767.5px)").matches) {
        $(".single-widget.category").removeClass("mt-0");
    }
    $(window).on('resize', function() {
        var win = $(this);
        if (win.width() <= 767.5) {
            $(".single-widget.category").removeClass("mt-0");
        } else {
            $(".single-widget.category").addClass("mt-0");
        }
    });

    focusProducts();

    function focusProducts() {
        let isMobileDevice = false;

        if (window.matchMedia("(max-width: 767.5px)").matches) {
            $('html, body').animate({
                scrollTop: $(".focusFilterProduct").offset().top
            }, 1000);
        } else {
            $('html, body').animate({
                scrollTop: $(".product-area").offset().top
            }, 1000);
        }
    }



});