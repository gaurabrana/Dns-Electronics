<?php
include('database/connect.php');
if(!isset($_SESSION['email'])){
header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='copyright' content=''>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Tag  -->
    <title>DnsElectronics</title>
    <!-- Favicon -->
    <!---<link rel="icon" type="image/png" href="images/favicon.png">-->
    <!-- Web Font -->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">

    <!-- StyleSheet -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <!-- Font Awesome -->



    <!-- Themify Icons -->
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="assets/css/niceselect.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- Flex Slider CSS -->
    <link rel="stylesheet" href="assets/css/flex-slider.min.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="assets/css/owl-carousel.css">
    <!-- Slicknav -->
    <link rel="stylesheet" href="assets/css/slicknav.min.css">

    <!-- custom StyleSheet -->
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/compare.css">



</head>

<body class="js">

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

    <?php
		include("layouts/navbar.php");
		?>
    <!--/ End Header -->

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="index.php">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="compare.php">Compare</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="fav-title">
                        <h4>Compare Items</h4>
                    </div>
                </div>
                <div class="row">
                    <?php

$userid = $_SESSION['id'];
$products = [];

$sql = "SELECT product.* FROM compare 
        INNER JOIN product ON compare.product_code = product.code 
        WHERE compare.customer_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $price = $row['price'];
        $discount = $row['discount'];
        $updatedPrice = ($discount != 0) ? $price - $discount : $price;

        $products[] = [
    'name' => $row['name'],
    'brand' => $row['brand'],
    'price' => $price,
    'discount' => $discount,
    'updatedPrice' => $updatedPrice,
    'stock' => $row['quantity_stock'],
    'image' => 'admin/images/products/' . $row['sold_by'] . '/' . $row['image_folder_key'] . '/' . $row['image_name'],
    'description' => $row['description'],
    'code'=> $row['code']
    ];
    }
}
$stmt->close();
?>
                    <div class="compare-table">
                        <div class="compare-row header">
                            <div class="compare-cell">Feature</div>
                            <?php foreach ($products as $product): ?>
                            <div class="compare-cell">
                                <?php echo htmlspecialchars($product['name']); ?>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="compare-row">
                            <div class="compare-cell">Image</div>
                            <?php foreach ($products as $product): ?>
                            <div class="compare-cell">
                                <a href="singleproduct.php?i=<?php echo urlencode($product['code']); ?>">
                                    <img class="default-img compare-img"
                                        src="<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image">
                                </a>
                            </div>

                            <?php endforeach; ?>
                        </div>

                        <div class="compare-row">
                            <div class="compare-cell">Brand</div>
                            <?php foreach ($products as $product): ?>
                            <div class="compare-cell">
                                <?php echo htmlspecialchars($product['brand']); ?>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="compare-row">
                            <div class="compare-cell">Price</div>
                            <?php foreach ($products as $product): ?>
                            <div class="compare-cell">
                                <del>$
                                    <?php echo number_format($product['price'], 2); ?>
                                </del><br>
                                <strong>$
                                    <?php echo number_format($product['updatedPrice'], 2); ?>
                                </strong>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="compare-row">
                            <div class="compare-cell">Stock</div>
                            <?php foreach ($products as $product): ?>
                            <div class="compare-cell">
                                <?php echo $product['stock']; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="compare-row">
                            <div class="compare-cell">Description</div>
                            <?php foreach ($products as $product): ?>
                            <div class="compare-cell">
                                <?php echo nl2br(htmlspecialchars($product['description'])); ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Start Shop Services Area  -->
    <section class="shop-services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-rocket"></i>
                        <h4>Free shiping</h4>
                        <p>Orders over $100</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-reload"></i>
                        <h4>Free Return</h4>
                        <p>Within 30 days returns</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-lock"></i>
                        <h4>Sucure Payment</h4>
                        <p>100% secure payment</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-tag"></i>
                        <h4>Best Peice</h4>
                        <p>Guaranteed price</p>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Newsletter -->

    <!-- Start Shop Newsletter  -->
    <section class="shop-newsletter section">
        <div class="container">
            <div class="inner-top">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 col-12">
                        <!-- Start Newsletter Inner -->
                        <div class="inner">
                            <h4>Newsletter</h4>
                            <p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
                            <form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
                                <input name="EMAIL" placeholder="Your email address" required="" type="email">
                                <button class="btn">Subscribe</button>
                            </form>
                        </div>
                        <!-- End Newsletter Inner -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Newsletter -->



    <!-- Start Footer Area -->
    <?php
	include"layouts/footer.php";
	?>
    <!-- /End Footer Area -->

    <!-- Jquery -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery-migrate-3.0.0.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js"
        integrity="sha512-pBoUgBw+mK85IYWlMTSeBQ0Djx3u23anXFNQfBiIm2D8MbVT9lr+IxUccP8AMMQ6LCvgnlhUCK3ZCThaBCr8Ng=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/js/bootstrap-show-notification.js"></script>
    <!-- Color JS -->

    <!-- Slicknav JS -->
    <script src="assets/js/slicknav.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="assets/js/owl-carousel.js"></script>
    <!-- Magnific Popup JS -->
    <script src="assets/js/magnific-popup.js"></script>
    <!-- Fancybox JS -->
    <script src="assets/js/facnybox.min.js"></script>
    <!-- Waypoints JS -->
    <script src="assets/js/waypoints.min.js"></script>
    <!-- Countdown JS -->
    <script src="assets/js/finalcountdown.min.js"></script>
    <!-- Nice Select JS -->
    <script src="assets/js/nicesellect.js"></script>
    <!-- Ytplayer JS -->
    <script src="assets/js/ytplayer.min.js"></script>
    <!-- Flex Slider JS -->
    <script src="assets/js/flex-slider.js"></script>
    <!-- ScrollUp JS -->
    <script src="assets/js/scrollup.js"></script>
    <!-- Onepage Nav JS -->
    <script src="assets/js/onepage-nav.min.js"></script>
    <!-- Easing JS -->
    <script src="assets/js/easing.js"></script>
    <!-- Active JS -->
    <script src="assets/js/active.js"></script>

</body>

</html>