<?php
include('connect.php'); 

// $getCartItems = "Select name, quantity, total from guest_cart_item, food_type, food_items where guest_cart_item.item_type_id = food_type.id and food_type.item_id = food_items.id";
// $getCartItemsResult= mysqli_query($conn, $getCartItems);
while($row = mysqli_fetch_assoc($getCartItemsResult)){
    echo'<li class="list-group-item tile is-parent is-horizontal" id="wocart">
    <div class="qtySelector text-center">                                                
    </div>
    <div class="cart-products-section">
        <p class="item-title">'.$row['name'].'</p>                                                                                                           
    </div>                                
    <div class="cart-add-remove">
    <span class="item-quantity">x. '.$row['quantity'].'</span>
    <span class="item-price">Rs. '.$row['total'].'</span>
    </div> 
</li>';
}
?>