$(document).on('ready', function() {
    $(".check-box-list").on('change', function(e) {
        var value = $("input[name='ranges']:checked").val();
        $.ajax({
            url: "database/sortProducts.php",
            type: "POST",
            data: { range: value },
            cache: false,
            success: function(result) {
                loadData(result);
                $("#currentQuery").val("priceSlider");
                reInitializeCarousel();
            }
        });
    });

    $(".brand-list li a").on("click", function(e) {
        e.preventDefault();
        var brand = $(this).attr('id');
        $.ajax({
            url: "database/sortProducts.php",
            type: "POST",
            data: { brandName: brand },
            cache: false,
            success: function(result) {
                loadData(result);
                $("#currentQuery").val("brand:" + brand);
                $('html, body').animate({
                    scrollTop: $(".bread-inner").offset().top
                }, 500);
                reInitializeCarousel();
            }
        });
    });

    $(".categor-list li a").on("click", function(e) {
        e.preventDefault();
        var category = $(this).attr('id');
        $.ajax({
            url: "database/sortProducts.php",
            type: "POST",
            data: { categoryName: category },
            cache: false,
            success: function(result) {
                loadData(result);
                $("#currentQuery").val("category:" + category);
                reInitializeCarousel();
            }
        });
    });

    $("#sortType").on('change', function(e) {
        var currentQuery = $("#currentQuery").val();
        alert(currentQuery);
        var sortType = this.value;
        if (currentQuery.toLowerCase().indexOf("brand") >= 0 || currentQuery.toLowerCase().indexOf("category") >= 0 || currentQuery.indexOf("all") >= 0) {
            $.ajax({
                url: "database/sortProducts.php",
                type: "POST",
                data: { sortType: sortType, currentQuery: currentQuery },
                cache: false,
                success: function(result) {
                    loadData(result);
                    reInitializeCarousel();
                }
            });
        }
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
        var b = a.split("<!--EndGridSection-->")[0];
        var c = a.split("<!--EndGridSection-->")[1];
        $("#loadProducts").html(b);
        if ($("#toggle-list-style").hasClass("active")) {
            $("#loadProducts .single-product").css("display", "none");
        }
        $("#list-style-product-display").html(c);
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

});