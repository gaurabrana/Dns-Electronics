/* =====================================
[Start Activation Code]
=========================================
	01. Mobile Menu JS
	02. Sticky Header JS
	03. Search JS
	04. Slider Range JS
	05. Home Slider JS
	06. Popular Slider JS
	07. Quick View Slider JS
	08. Home Slider 4 JS
	09. CountDown
	10. Flex Slider JS
	11. Cart Plus Minus Button
	12. Checkbox JS
	13. Extra Scroll JS
	14. Product page Quantity Counter
	15. Video Popup JS
	16. Scroll UP JS
	17. Nice Select JS
	18. Others JS
	19. Preloader JS
=========================================
[End Activation Code]
=========================================*/


(function($) {
    "use strict";
    $(document).on('ready', function() {

        /*====================================
        	Mobile Menu
        ======================================*/
        $('.menu').slicknav({
            prependTo: ".mobile-nav",
            duration: 300,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            closeOnClick: true,
        });

        /*====================================
        03. Sticky Header JS
        ======================================*/
        jQuery(window).on('scroll', function() {
            if ($(this).scrollTop() > 200) {
                $('.header').addClass("sticky");
            } else {
                $('.header').removeClass("sticky");
            }
        });

        /*=======================
          Search JS JS
        =========================*/
        $('.top-search a').on("click", function() {
            $('.search-top').toggleClass('active');
        });

        /*=======================
          Slider Range JS
        =========================*/
        $(function() {
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 100000,
                values: [0, 100000],
                slide: function(event, ui) {
                    $("#amount").val("Rs " + ui.values[0] + " - Rs " + ui.values[1]);
                    loadProductsPriceSlider(ui.values[0], ui.values[1]);
                }
            });
            $("#amount").val("Rs " + $("#slider-range").slider("values", 0) +
                " - Rs " + $("#slider-range").slider("values", 1));
        });

        /*=======================
          Home Slider JS
        =========================*/
        $('.home-slider').owlCarousel({
            items: 1,
            autoplay: true,
            autoplayTimeout: 5000,
            smartSpeed: 400,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            autoplayHoverPause: true,
            loop: true,
            nav: true,
            merge: true,
            dots: false,
            navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
            responsive: {
                0: {
                    items: 1,
                },
                300: {
                    items: 1,
                },
                480: {
                    items: 2,
                },
                768: {
                    items: 3,
                },
                1170: {
                    items: 4,
                },
            }
        });

        /*=======================
          Popular Slider JS
        =========================*/
        $('.popular-slider').owlCarousel({
            items: 1,
            autoplay: true,
            autoplayTimeout: 5000,
            smartSpeed: 400,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            autoplayHoverPause: true,
            loop: true,
            nav: true,
            merge: true,
            dots: false,
            navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
            responsive: {
                0: {
                    items: 1,
                },
                300: {
                    items: 1,
                },
                480: {
                    items: 2,
                },
                768: {
                    items: 3,
                },
                1170: {
                    items: 4,
                },
            }
        });

        /*===========================
          Quick View Slider JS
        =============================*/
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

        /*===========================
          Home Slider 4 JS
        =============================*/
        $('.home-slider-4').owlCarousel({
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

        /*====================================
        14. CountDown
        ======================================*/
        $('[data-countdown]').each(function() {
            var $this = $(this),
                finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
                $this.html(event.strftime(
                    '<div class="cdown"><span class="days"><strong>%-D</strong><p>Days.</p></span></div><div class="cdown"><span class="hour"><strong> %-H</strong><p>Hours.</p></span></div> <div class="cdown"><span class="minutes"><strong>%M</strong> <p>MINUTES.</p></span></div><div class="cdown"><span class="second"><strong> %S</strong><p>SECONDS.</p></span></div>'
                ));
            });
        });

        /*====================================
        16. Flex Slider JS
        ======================================*/
        (function($) {
            'use strict';
            $('.flexslider-thumbnails').flexslider({
                animation: "slide",
                controlNav: "thumbnails",
            });
        })(jQuery);

        /*====================================
          Cart Plus Minus Button
        ======================================*/

        var CartPlusMinus = $('.cart-plus-minus');
        CartPlusMinus.prepend('<div class="dec qtybutton">-</div>');
        CartPlusMinus.append('<div class="inc qtybutton">+</div>');
        $(".qtybutton").on("click", function() {
            var $button = $(this);
            var oldValue = $button.parent().find("input").val();
            if ($button.text() === "+") {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                // Don't allow decrementing below zero
                if (oldValue > 0) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 1;
                }
            }
            $button.parent().find("input").val(newVal);
        });

        /*=======================
          Extra Scroll JS
        =========================*/
        $('.scroll').on("click", function(e) {
            var anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $(anchor.attr('href')).offset().top - 0
            }, 900);
            e.preventDefault();
        });

        /*===============================
        10. Checkbox JS
        =================================*/
        $('input[type="checkbox"]').change(function() {
            if ($(this).is(':checked')) {
                $(this).parent("label").addClass("checked");
            } else {
                $(this).parent("label").removeClass("checked");
            }
        });

        /*==================================
         12. Product page Quantity Counter
         ===================================*/
        $('.qty-box .quantity-right-plus').on('click', function() {
            var $qty = $('.qty-box .input-number');
            var currentVal = parseInt($qty.val(), 10);
            if (!isNaN(currentVal)) {
                $qty.val(currentVal + 1);
            }
        });
        $('.qty-box .quantity-left-minus').on('click', function() {
            var $qty = $('.qty-box .input-number');
            var currentVal = parseInt($qty.val(), 10);
            if (!isNaN(currentVal) && currentVal > 1) {
                $qty.val(currentVal - 1);
            }
        });

        /*=====================================
        15.  Video Popup JS
        ======================================*/
        $('.video-popup').magnificPopup({
            type: 'iframe',
            removalDelay: 300,
            mainClass: 'mfp-fade'
        });

        /*====================================
        	Scroll Up JS
        ======================================*/
        $.scrollUp({
            scrollText: '<span><i class="fa fa-angle-up"></i></span>',
            easingType: 'easeInOutExpo',
            scrollSpeed: 900,
            animation: 'fade'
        });

    });

    /*====================================
    18. Nice Select JS
    ======================================*/
    $('select').niceSelect();

    /*=====================================
     Others JS
    ======================================*/
    $(function() {
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 100000,
            values: [0, 100000],
            slide: function(event, ui) {
                $("#amount").val("Rs" + ui.values[0] + " - Rs" + ui.values[1]);
            }
        });
        $("#amount").val("Rs" + $("#slider-range").slider("values", 0) +
            " - Rs" + $("#slider-range").slider("values", 1));
    });

    /*=====================================
      Preloader JS
    ======================================*/
    //After 2s preloader is fadeOut
    $('.preloader').delay(2000).fadeOut('slow');
    setTimeout(function() {
        //After 2s, the no-scroll class of the body will be removed
        $('body').removeClass('no-scroll');
    }, 2000); //Here you can change preloader time

    /* Product Sorting Queries */
    function loadProductsPriceSlider(range1, range2) {
        $.ajax({
            url: "database/sortProducts.php",
            type: "POST",
            data: { minPrice: range1, maxPrice: range2 },
            cache: false,
            success: function(result) {
                $("#loadProducts").html(result);
                $("#currentQuery").val("priceSlider");
                reInitializeCarousel();
            }
        });
    }

    $(".check-box-list").on('change', function(e) {
        var value = $("input[name='ranges']:checked").val();
        $.ajax({
            url: "database/sortProducts.php",
            type: "POST",
            data: { range: value },
            cache: false,
            success: function(result) {
                $("#loadProducts").html(result);
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
                $("#loadProducts").html(result);
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
                $("#loadProducts").html(result);
                $("#currentQuery").val("category:" + category);
                reInitializeCarousel();
            }
        });
    });

    $("#sortType").on('change', function(e) {
        var currentQuery = $("#currentQuery").val();
        var sortType = this.value;
        if (currentQuery.toLowerCase().indexOf("brand") >= 0 || currentQuery.toLowerCase().indexOf("category") >= 0 || currentQuery.indexOf("all") >= 0) {
            $.ajax({
                url: "database/sortProducts.php",
                type: "POST",
                data: { sortType: sortType, currentQuery: currentQuery },
                cache: false,
                success: function(result) {
                    $("#loadProducts").html(result);
                    reInitializeCarousel();
                }
            });
        }
    });

    $(document).on("click", ".product-action p", function(e) {
        e.preventDefault;
        var id = $(this).attr("id");
        var productID = null;
        var resultID = null;
        var url = null;
        if (id.indexOf("favourite") >= 0 || id.indexOf("compare") >= 0) {
            if (id.indexOf("favourite") >= 0) {
                url = "database/addtowishlist.php";
                var productID = id.split("favourite")[1];
                var resultID = "#result" + productID;
            } else if (id.indexOf("compare") >= 0) {
                url = "database/addtocompare.php";
                var productID = id.split("compare")[1];
                var resultID = "#result" + productID;
            }
            $.ajax({
                url: url,
                type: "POST",
                data: { action: productID },
                cache: false,
                success: function(result) {
                    var data = JSON.parse(result);
                    $(resultID).css("visibility", "visible");
                    if (id.indexOf("favourite") >= 0) {
                        if (data.statusCode == 200) {
                            $(resultID).html("Added to favourite");
                            $(resultID).css("color", "green");
                        } else if (data.statusCode == 201) {
                            $(resultID).html("Failed to add");
                            $(resultID).css("color", "#ed1c24");
                        } else if (data.statusCode == 202) {
                            $(resultID).html("Product not found");
                            $(resultID).css("color", "#ed1c24");
                        } else if (data.statusCode == 203) {
                            $(resultID).html("Login first");
                        } else if (data.statusCode == 204) {
                            $(resultID).html("Already in favourite");
                            $(resultID).css("color", "#ed1c24");
                        }

                    } else if (id.indexOf("compare") >= 0) {
                        if (data.statusCode == 200) {
                            $(resultID).html("Added to compare list");
                            $(resultID).css("color", "green");
                        } else if (data.statusCode == 201) {
                            $(resultID).html("Failed to add");
                            $(resultID).css("color", "#ed1c24");
                        } else if (data.statusCode == 202) {
                            $(resultID).html("Product not found");
                            $(resultID).css("color", "#ed1c24");
                        } else if (data.statusCode == 203) {
                            $(resultID).html("Login first");
                        } else if (data.statusCode == 204) {
                            $(resultID).html("Already in compare list");
                            $(resultID).css("color", "#ed1c24");
                        }

                    }
                    $(resultID)
                        .delay(3000)
                        .queue(function(next) {
                            $(this).css('visibility', 'hidden');
                            next();
                        });
                    reInitializeCarousel();
                }
            });
        }
    });

    $(document).on("click", ".product-action-2 p", function(e) {
        var id = $(this).attr("id");
        var productID = id.split("cart")[1];
        var resultID = "#result" + productID;
        $.ajax({
            url: "database/addtocart.php",
            type: "POST",
            data: { action: productID },
            cache: false,
            success: function(result) {
                var data = JSON.parse(result);
                $(resultID).css("visibility", "visible");
                if (data.statusCode == 200) {
                    $(resultID).html("Added to cart");
                    $(resultID).css("color", "green");
                } else if (data.statusCode == 201) {
                    $(resultID).html("Failed to add");
                    $(resultID).css("color", "#ed1c24");
                } else if (data.statusCode == 202) {
                    $(resultID).html("Product not found");
                    $(resultID).css("color", "#ed1c24");
                } else if (data.statusCode == 203) {
                    $(resultID).html("Login first");
                } else if (data.statusCode == 204) {
                    $(resultID).html("Already in cart");
                    $(resultID).css("color", "#ed1c24");
                }

                $(resultID)
                    .delay(3000)
                    .queue(function(next) {
                        $(this).css('visibility', 'hidden');
                        next();
                    });


            }
        });
    });


    $(".input-group .minus").on("click", function(e) {
        var id = $(this).attr("id");
        var productID = id.split("minus")[1];
        var quantity = parseInt($("#quantity" + productID).val(), 10);
        updatecartquantity("minus", productID, quantity);
    });

    function updatecartquantity(j, k, l) {
        var m = $("#stock" + k).val();
        var l_a = parseInt(l, 10);
        var m_a = parseInt(m, 10);
        var isCheckout = $("#placeorder").val();
        if (l_a >= 1 && l_a <= m_a) {
            $.ajax({
                url: "database/updatecartquantity.php",
                type: "POST",
                data: { b: k, a: j, c: l },
                cache: false,
                success: function(result) {
                    var data = JSON.parse(result);
                    var total = data.total;
                    $("#totalpayment").html("Rs " + total);
                    var totalWithoutDiscount = data.totalWithoutDiscount;
                    $("#totalWithoutDiscount").html("Rs " + totalWithoutDiscount);
                    var subtotal = data.subtotal;
                    $("#subtotal" + k).html("Rs " + subtotal);
                    var totalDiscount = data.totalDiscount;
                    $("#totalDiscount").html("Rs " + totalDiscount);
                    if (isCheckout != null) {
                        $("#subTotalCheckout").html("Rs " + total);
                        $("#TotalCheckout").html("Rs " + total);
                    }
                }
            });
        } else {
            $("#cartError" + k).html("Quantity available for this product is 1 - " + m + ".");
            $("#cartError" + k).css('display', 'block');
            $("#cartError" + k)
                .delay(3000)
                .queue(function(next) {
                    $(this).css('display', 'none');
                    next();
                });
            // $.bootstrapGrowl("Quantity available for this product is 1 - " + m + ".", {
            //     type: "info",
            //     offset: { from: "top", amount: parseInt(n, 10) },
            //     align: "right",
            //     delay: 6000,
            //     allow_dismiss: true,
            //     stackup_spacing: 10
            // });

        }

    };

    $(".action p").on("click", function(e) {
        var id = $(this).attr("id");
        var productID = id.split("remove")[1];
        $.ajax({
            url: "database/updatecartquantity.php",
            type: "POST",
            data: { a: "delete", b: productID },
            cache: false,
            success: function(result) {
                var data = JSON.parse(result);
                var total = data.total;
                $("#tablerow" + productID).remove();
                $("#totalpayment").html("Rs " + total);
                var totalWithoutDiscount = data.totalWithoutDiscount;
                $("#totalWithoutDiscount").html("Rs " + totalWithoutDiscount);
                var totalDiscount = data.totalDiscount;
                $("#totalDiscount").html("Rs " + totalDiscount);
            }
        });
    });


    $('.input-group input').keypress(function(event) {
        if (event.keyCode == 13) {
            var id = $(this).attr("id");
            var productID = id.split("quantity")[1];
            var quantity = $("#quantity" + productID).val();
            updatecartquantity("middle", productID, quantity);
        }
    });


    $(".input-group .plus").on("click", function(e) {
        var id = $(this).attr("id");
        var productID = id.split("plus")[1];
        var quantity = parseInt($("#quantity" + productID).val(), 10);
        updatecartquantity("plus", productID, quantity);
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

    /*
CHECKOUT PAGE
    */

    $("#cbox").on("click", function(e) {
        if ($(this).prop("checked") == true) {
            $("#shippingInfo").css("display", "flex");
            $("#shippingInfo input").prop("disabled", false);
        } else {
            $("#shippingInfo").css("display", "none");
            $("#shippingInfo input").prop("disabled", true);
        }
    });

    $(document).on("submit", "form", function(e) {
        e.preventDefault();
        //billing info
        var radios = document.querySelectorAll('input[type="radio"]:checked');
        var value = radios.length > 0 ? radios[0].value : null;
        if (value == null) {
            $("#paymenterror").html("Payment method not selected.");
            $("#paymenterror").css("display", "block");
            $("#paymenterror")
                .delay(3000)
                .queue(function(next) {
                    $(this).css('display', 'none');
                    next();
                });
            return;
        } else {
            $("#triggerConfirmation").click();
            return false;
        }
    });

    $("#placeorder").on("click", function(e) {
        $("#submitButton").click();
    });


    $("#confirmOrder").on("click", function(e) {
        var billingfname = $("#billingfname").val();
        var billinglname = $("#billinglname").val();
        var billingemail = $("#billingemail").val();
        var billingphone = $("#billingphone").val();
        var country = $("#country").val();
        var billingaddressone = $("#billingaddressone").val();
        var billingaddresstwo = $("#billingaddresstwo").val();
        var billingpostalcode = $("#billingpostalcode").val();
        var payment = $('input[type="radio"]:checked').val();
        if ($(this).prop("checked") == true) {
            var shippingname = $("#shippingname").val();
            var shippingphone = $("#shippingphone").val();
            var shippingcountry = $("#shippingcountry").val();
            var shippingaddressone = $("#shippingaddressone").val();
            var shippingaddresstwo = $("#shippingaddresstwo").val();
            var shippingpostalcode = $("#shippingpostalcode").val();
            $.ajax({
                url: "database/confirmorder.php",
                type: "POST",
                data: {
                    info: "includeshipping",
                    billingfname: billingfname,
                    billinglname: billinglname,
                    billingemail: billingemail,
                    billingphone: billingphone,
                    country: country,
                    billingaddressone: billingaddressone,
                    billingaddresstwo: billingaddresstwo,
                    billingpostalcode: billingpostalcode,
                    shippingname: shippingname,
                    shippingphone: shippingphone,
                    shippingcountry: shippingcountry,
                    shippingaddressone: shippingaddressone,
                    shippingaddresstwo: shippingaddresstwo,
                    shippingpostalcode: shippingpostalcode,
                    payment: payment
                },
                cache: false,
                success: function(result) {
                    // var data = JSON.parse(result);
                    // var total = data.total;
                    // $("#tablerow" + productID).remove();
                    // $("#totalpayment").html("Rs " + total);
                    // var totalWithoutDiscount = data.totalWithoutDiscount;
                    // $("#totalWithoutDiscount").html("Rs " + totalWithoutDiscount);
                    // var totalDiscount = data.totalDiscount;
                    // $("#totalDiscount").html("Rs " + totalDiscount);
                }
            });
        } else {
            alert("working");
            $.ajax({
                url: "database/confirmorder.php",
                type: "POST",
                data: {
                    info: "onlybilling",
                    billingfname: billingfname,
                    billinglname: billinglname,
                    billingemail: billingemail,
                    billingphone: billingphone,
                    country: country,
                    billingaddressone: billingaddressone,
                    billingaddresstwo: billingaddresstwo,
                    billingpostalcode: billingpostalcode,
                    payment: payment
                },
                cache: false,
                success: function(result) {
                    // var data = JSON.parse(result);
                    // var total = data.total;
                    // $("#tablerow" + productID).remove();
                    // $("#totalpayment").html("Rs " + total);
                    // var totalWithoutDiscount = data.totalWithoutDiscount;
                    // $("#totalWithoutDiscount").html("Rs " + totalWithoutDiscount);
                    // var totalDiscount = data.totalDiscount;
                    // $("#totalDiscount").html("Rs " + totalDiscount);
                }
            });
        }

    });


})(jQuery);