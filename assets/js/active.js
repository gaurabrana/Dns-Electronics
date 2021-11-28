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

    $('#categorySearch').niceSelect();
    $("#genderFromRegister").niceSelect();
    $("#sortType").niceSelect();
    $("#itemsPerPage").niceSelect();
    $("#billingcountry").niceSelect();
    $("#shippingcountry").niceSelect();

    $(".star-rating").css("display", "none");
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
    $('.preloader').delay(500).fadeOut('slow');
    setTimeout(function() {
        //After 2s, the no-scroll class of the body will be removed
        $('body').removeClass('no-scroll');
    }, 500); //Here you can change preloader time

    /* Product Sorting Queries */



    function getItemInCart() {
        $.ajax({
            type: "POST",
            url: 'database/getcartdata.php',
            data: { action: "getData" },
            success: function(result) {
                $("#holdshoppingcart").html(result);
            }
        });
    }

    getItemInCart();

    $(document).on("click", ".product-action-2 span", function(e) {
        var a = $(this).attr("id");
        if (a == undefined) {
            return;
        }
        var b = a.split("cart")[1];
        var c = null;
        var d = false;
        if (a.indexOf("list") >= 0) {
            c = "#liststyleResult" + b;
            d = true;
        } else {
            c = "#result" + b;
            d = false;
        }

        $.ajax({
            url: "database/addtocart.php",
            type: "POST",
            data: { action: b },
            cache: false,
            success: function(result) {
                var data = JSON.parse(result);
                if (data.statusCode == 200) {
                    getItemInCart();
                    $(c).html("Added to cart");
                    if (d) {
                        addResultColor("list", c, "alert-success");
                    } else {
                        addResultColor("grid", c, "green");
                    }
                } else if (data.statusCode == 201) {
                    $(c).html("Failed to add");
                    if (d) {
                        addResultColor("list", c, "alert-danger");
                    } else {
                        addResultColor("grid", c, "#ed1c24");
                    }
                } else if (data.statusCode == 202) {
                    $(c).html("Product not found");
                    if (d) {
                        addResultColor("list", c, "alert-danger");
                    } else {
                        addResultColor("grid", c, "#ed1c24");
                    }
                } else if (data.statusCode == 203) {
                    $(c).html("Login first");
                    if (d) {
                        addResultColor("list", c, "alert-danger");
                    } else {
                        addResultColor("grid", c, "#ed1c24");
                    }
                } else if (data.statusCode == 204) {
                    $(c).html("Already in cart");
                    if (d) {
                        addResultColor("list", c, "alert-danger");
                    } else {
                        addResultColor("grid", c, "#ed1c24");
                    }
                }
            }
        });
    });


    $(document).on("click", ".product-action p", function(e) {
        e.preventDefault;
        var a = $(this).attr("id");
        var b = null;
        var c = null;
        var f = null;
        var d = false;
        if (a.indexOf("favourite") >= 0 || a.indexOf("compare") >= 0) {
            if (a.indexOf("favourite") >= 0) {
                f = "database/addtowishlist.php";
                b = a.split("favourite")[1];
            } else if (a.indexOf("compare") >= 0) {
                f = "database/addtocompare.php";
                b = a.split("compare")[1];
            }
            if (a.indexOf("list") >= 0) {
                c = "#liststyleResult" + b;
                d = true;
            } else {
                c = "#result" + b;
                d = false;
            }
            $.ajax({
                url: f,
                type: "POST",
                data: { action: b },
                cache: false,
                success: function(result) {
                    var data = JSON.parse(result);
                    if (a.indexOf("favourite") >= 0) {
                        if (data.statusCode == 200) {
                            $(c).html("Added to favourite");
                            if (d) {
                                addResultColor("list", c, "alert-success");
                            } else {
                                addResultColor("grid", c, "green");
                            }

                        } else if (data.statusCode == 201) {
                            $(c).html("Failed to add");
                            if (d) {
                                addResultColor("list", c, "alert-danger");
                            } else {
                                addResultColor("grid", c, "#ed1c24");
                            }
                        } else if (data.statusCode == 202) {
                            $(c).html("Product not found");
                            if (d) {
                                addResultColor("list", c, "alert-danger");
                            } else {
                                addResultColor("grid", c, "#ed1c24");
                            }
                        } else if (data.statusCode == 203) {
                            $(c).html("Login first");
                            if (d) {
                                addResultColor("list", c, "alert-danger");
                            } else {
                                addResultColor("grid", c, "#ed1c24");
                            }
                        } else if (data.statusCode == 204) {
                            $(c).html("Already in favourite");
                            if (d) {
                                addResultColor("list", c, "alert-danger");
                            } else {
                                addResultColor("grid", c, "#ed1c24");
                            }
                        }

                    } else if (a.indexOf("compare") >= 0) {
                        if (data.statusCode == 200) {
                            $(c).html("Added to compare list");
                            if (d) {
                                addResultColor("list", c, "alert-success");
                            } else {
                                addResultColor("grid", c, "green");
                            }
                        } else if (data.statusCode == 201) {
                            $(c).html("Failed to add");
                            if (d) {
                                addResultColor("list", c, "alert-danger");
                            } else {
                                addResultColor("grid", c, "#ed1c24");
                            }
                        } else if (data.statusCode == 202) {
                            $(c).html("Product not found");
                            if (d) {
                                addResultColor("list", c, "alert-danger");
                            } else {
                                addResultColor("grid", c, "#ed1c24");
                            }
                        } else if (data.statusCode == 203) {
                            $(c).html("Login first");
                            if (d) {
                                addResultColor("list", c, "alert-danger");
                            } else {
                                addResultColor("grid", c, "#ed1c24");
                            }
                        } else if (data.statusCode == 204) {
                            $(c).html("Already in compare list");
                            if (d) {
                                addResultColor("list", c, "alert-danger");
                            } else {
                                addResultColor("grid", c, "#ed1c24");
                            }
                        }

                    }
                }
            });
        }
    });

    function addResultColor(a, b, c) {
        $(b).removeClass("hide-element");
        if (a == "list") {
            $(b).addClass(c);
        } else if (a == "grid") {
            $(b).css("color", c);
        }
        $(b)
            .delay(3000)
            .queue(function(next) {
                if (a == "list") {
                    $(b).removeClass(c);
                }
                $(b).addClass("hide-element");
                next();
            });
    }

    $(document).on("click", ".add-to-cart a", function(e) {
        e.preventDefault();

        let getClickedButtonID = $(this).attr("id");
        let selectedAction = getClickedButtonID.split("fromModal")[1];
        var pID;
        if (selectedAction.indexOf("cart") >= 0) {
            pID = selectedAction.split("cart")[1];
            toCart(pID);
        } else if (selectedAction.indexOf("wishlist") >= 0) {
            pID = selectedAction.split("wishlist")[1];
            toWishlist(pID);
        } else if (selectedAction.indexOf("compare") >= 0) {
            pID = selectedAction.split("compare")[1];
            toCompare(pID);
        }
    });

    function toCart(a) {
        var resultID = "#fromModalResult" + a;
        var productquantity = $("#amountOfproduct" + a).val();
        let color;
        $.ajax({
            url: "database/addtocart.php",
            type: "POST",
            data: { action: a, quantityofproduct: productquantity },
            cache: false,
            success: function(result) {
                var data = JSON.parse(result);
                $(resultID).css("visibility", "visible");
                if (data.statusCode == 200) {
                    color = "alert-success";
                    getItemInCart();
                    $(resultID).html("Added to cart");
                } else if (data.statusCode == 201) {
                    color = "alert-danger";
                    $(resultID).html("Failed to add");
                } else if (data.statusCode == 202) {
                    color = "alert-danger";
                    $(resultID).html("Product not found");
                } else if (data.statusCode == 203) {
                    color = "alert-danger";
                    $(resultID).html("Login first");
                } else if (data.statusCode == 204) {
                    color = "alert-danger";
                    $(resultID).html("Already in cart");
                }
                $(resultID).addClass(color);
                $(resultID)
                    .delay(3000)
                    .queue(function(next) {
                        $(this).css('visibility', 'hidden');
                        $(this).removeClass(color)
                        next();
                    });


            }
        });
    }

    function toWishlist(a) {
        var resultID = "#fromModalResult" + a;
        let color;
        $.ajax({
            url: "database/addtowishlist.php",
            type: "POST",
            data: { action: a },
            cache: false,
            success: function(result) {
                var data = JSON.parse(result);
                $(resultID).css("visibility", "visible");
                if (data.statusCode == 200) {
                    color = "alert-success";
                    $(resultID).html("Added to favourite");
                } else if (data.statusCode == 201) {
                    color = "alert-danger";
                    $(resultID).html("Failed to add");
                } else if (data.statusCode == 202) {
                    color = "alert-danger";
                    $(resultID).html("Product not found");
                } else if (data.statusCode == 203) {
                    color = "alert-danger";
                    $(resultID).html("Login first");
                } else if (data.statusCode == 204) {
                    color = "alert-danger";
                    $(resultID).html("Already in favourite");
                }
                $(resultID).addClass(color);
                $(resultID)
                    .delay(3000)
                    .queue(function(next) {
                        $(this).css('visibility', 'hidden');
                        $(this).removeClass(color);
                        next();
                    });
            }
        });
    }

    function toCompare(a) {
        var resultID = "#fromModalResult" + a;
        let color;
        $.ajax({
            url: "database/addtocompare.php",
            type: "POST",
            data: { action: a },
            cache: false,
            success: function(result) {
                var data = JSON.parse(result);
                $(resultID).css("visibility", "visible");
                if (data.statusCode == 200) {
                    color = "alert-success";
                    $(resultID).html("Added to compare list");
                } else if (data.statusCode == 201) {
                    color = "alert-danger";
                    $(resultID).html("Failed to add");
                } else if (data.statusCode == 202) {
                    color = "alert-danger";
                    $(resultID).html("Product not found");
                } else if (data.statusCode == 203) {
                    color = "alert-danger";
                    $(resultID).html("Login first");
                } else if (data.statusCode == 204) {
                    color = "alert-danger";
                    $(resultID).html("Already in compare list");
                }
                $(resultID).addClass(color);
                $(resultID)
                    .delay(3000)
                    .queue(function(next) {
                        $(this).css('visibility', 'hidden');
                        $(this).removeClass(color);
                        next();
                    });
            }
        });
    }



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

    $('#myTab a').on('click', function(e) {
        e.preventDefault()
        $(this).tab('show');
    })

    $("#searchProduct").on("keyup", function(e) {
        var searchKeyword = $(this).val();
        var category = $("#categorySearch").val();
        if (searchKeyword.length > 0) {
            $(".search-bar-popup").css("display", "block");
        } else {
            $(".search-bar-popup").css("display", "none");
        }

        $.ajax({
            url: "database/searchProduct.php",
            type: "POST",
            data: { search: searchKeyword, category: category },
            success: function(data) {
                $(".search-list").html(data);
            }
        });
    });

    $(".fav-del").on("click", function(e) {
        var id = $(this).attr("id");
        var productCode = id.split("removeFav")[1];

        $.ajax({
            url: "database/addtowishlist.php",
            type: "POST",
            data: { code: productCode, action: "remove" },
            success: function(data) {
                var result = JSON.parse(data);
                if (result.statusCode == "200") {
                    var item = "favItem" + productCode;
                    $("#" + item).remove();
                } else if (result.statusCode == "201") {

                }
            }
        });

    });

    // $(window).on('resize', function() {
    //     var win = $(this); //this = window
    //     //if (win.height() >= 820) { /* ... */ }
    //     if (win.width() <= 375) {
    //         $(".holdProductBrand").removeClass("col-6");
    //         $(".holdProductBrand").addClass("col-12");
    //     } else if (win.width() <= 555) {
    //         $("#holdBanner1").removeClass("col-6");
    //         $("#holdBanner1").addClass("col-12");
    //         $("#holdBanner2").removeClass("col-6");
    //         $("#holdBanner2").addClass("col-12");
    //         $(".holdProductBrand").removeClass("col-12");
    //         $(".holdProductBrand").removeClass("col-4");
    //         $(".holdProductBrand").addClass("col-6");
    //     } else if (win.width() <= 767) {
    //         $("#holdBanner1").addClass("col-6");
    //         $("#holdBanner1").removeClass("col-12");
    //         $("#holdBanner2").addClass("col-6");
    //         $("#holdBanner2").removeClass("col-12");
    //         $(".holdProductBrand").addClass("col-4");
    //         $(".holdProductBrand").removeClass("col-6");
    //     }
    // });

    // focusProducts();

    // function focusProducts() {
    //     let width = $(window).width();
    //     if (window.matchMedia("(max-width: 375px)").matches) {
    //         $(".holdProductBrand").removeClass("col-4");
    //         $(".holdProductBrand").addClass("col-12");
    //     } else if (window.matchMedia("(max-width: 555px)").matches) {
    //         $("#holdBanner1").removeClass("col-6");
    //         $("#holdBanner1").addClass("col-12");
    //         $("#holdBanner2").removeClass("col-6");
    //         $("#holdBanner2").addClass("col-12");
    //         $(".holdProductBrand").removeClass("col-4");
    //         $(".holdProductBrand").addClass("col-6");
    //     }
    // }

})(jQuery);