<?php
    include('connect.php');
    if(isset($_POST['action'])){
        $cartid = $_SESSION['cartid'];
        $getcartitem = "Select p.id,p.image_folder_key, c.id as productcartid, p.quantity_stock, p.code, p.name,p.sold_by, p.image_name, p.price, p.discount, p.description, c.quantity from product p, product_in_cart c where c.cart_id = '$cartid' and p.code = c.product_code";
        $cartquery = mysqli_query($conn, $getcartitem);
        $totalItems = mysqli_num_rows($cartquery);
        echo'<div class="sinlge-bar shopping" id="holdshoppingcart">
        <a href="#" class="single-icon"><i class="fal fa-bags-shopping fa-lg"></i> <span class="total-count">' . $totalItems . '</span></a>
        <!-- Shopping Item -->
        <div class="shopping-item">
            <div class="dropdown-cart-header">
                <span class="itemsincart">' . $totalItems . ' Items</span>
                <a href="cart.php">View Cart</a>
            </div>
            <ul class="shopping-list">';
    $total = 0;
    while ($row = mysqli_fetch_assoc($cartquery)) {
        $subtotal = 0;
        if ($row['discount'] != 0) {
            $updatedPrice = $row['price'] - $row['discount'];
        } else {
            $updatedPrice = $row['price'];
        }
        $subtotal = $row['quantity'] * $updatedPrice;
        $total = $total + $subtotal;
        echo '<li>
                
                <a class="cart-img" href="singleproduct.php?i=' . $row['code'] . '"><img src="admin/images/products/' . $row['sold_by'] . '/'.$row['image_folder_key'].'/' . $row['image_name'] . '" alt="#"></a>
                <h4><a href="singleproduct.php?i=' . $row['code'] . '">' . $row['name'] . '</a></h4>
                <p class="quantity">' . $row['quantity'] . 'x - <span class="amount">Rs ' . $subtotal . '</span></p>
            </li>';
    }
    echo '</ul>
            <div class="bottom">
                <div class="total">
                    <span>Total</span>
                    <span class="total-amount">Rs '.$total.'</span>
                </div>
                <a href="checkout.php" class="btn animate">Checkout</a>
            </div>
        </div>
        <!--/ End Shopping Item -->
    </div>';
    }
    

?>