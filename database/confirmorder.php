<?php
if(isset($_POST['info'])){
include('connect.php');
extract($_POST);
$info = $_POST['info'];
    $billingfname = mysqli_escape_string($conn,$billingfname);
    $billinglname = mysqli_escape_string($conn,$billinglname);
    $billingemail = mysqli_escape_string($conn,$billingemail);
    $billingphone = mysqli_escape_string($conn,$billingphone);
    $country = mysqli_escape_string($conn,$country);    
    $billingaddressone = mysqli_escape_string($conn,$billingaddressone);
    $billingaddresstwo = mysqli_escape_string($conn,$billingaddresstwo);
    $billingpostalcode = mysqli_escape_string($conn,$billingpostalcode);
    $paymentType = mysqli_escape_string($conn, $payment);
    $infoid = RandomString();
    $cartid = $_SESSION['cartid'];    
    $user_id = $_SESSION['id'];
    $added_date = date("Y-m-d H:i:s A");
if($info == "includeshipping"){
    
    $shippingname = mysqli_escape_string($conn,$shippingname);
    $shippingphone = mysqli_escape_string($conn,$shippingphone);
    $shippingcountry = mysqli_escape_string($conn,$shippingcountry);
    $shippingaddressone = mysqli_escape_string($conn,$shippingaddressone);
    $shippingaddresstwo = mysqli_escape_string($conn,$shippingaddresstwo);
    $shippingpostalcode = mysqli_escape_string($conn,$shippingpostalcode);    
    $shipping_info_id = RandomString();   
    //insert shipping address    
    
        //insert billing address
        $shippingSql = "Insert into shipping_info values ('$shipping_info_id','$user_id','$shippingname','$shippingphone','$shippingcountry','$shippingaddressone','$shippingaddresstwo','$shippingpostalcode','$added_date')";
        $resultShipping = mysqli_query($conn, $shippingSql);
        $billingSql = "Insert into billing_info values ('$billingfname','$billinglname', '$billingemail','$billingphone','$country','$billingaddressone','$billingaddresstwo','$billingpostalcode','$user_id','$shipping_info_id','$added_date', '$infoid')";
        $resultbilling = mysqli_query($conn, $billingSql);
    
        if($resultbilling){
            // insert order
            $orderid = RandomString();            
            $orderSql = "Insert into orders values ('$orderid',
            '$user_id',
            '$added_date',
            '$paymentType',
            'pending',
            '$infoid',
            '$shipping_info_id')";
            $resultOrder = mysqli_query($conn,$orderSql);
            if($resultOrder){
                // insert product ids of the order
                $orderitemSql = "Select p.id, p.quantity_stock, p.price, p.discount, c.quantity from product p, product_in_cart c where c.cart_id = '$cartid' and p.code = c.product_code";
                $resultOrderItem = mysqli_query($conn, $orderitemSql);                
                if(mysqli_num_rows($resultOrderItem)>0){
                    while($row = mysqli_fetch_assoc($resultOrderItem)){
                        $orderItemid = RandomString();
                        $discount = $row['discount'];
                        if($discount!=0){
                            $updatePrice = $row['price']-$row['discount'];                            
                        }
                        else{
                            $updatePrice = $row['price'];
                        }
                        $quantity = $row['quantity'];
                        $total = $updatePrice * $quantity;
                        $productid = $row['id'];
                        $InsertProductInOrder = "Insert into order_item values ('$orderItemid','$productid','$orderid','$updatePrice','$quantity','$total')";
                        $resultAddProductItem = mysqli_query($conn ,$InsertProductInOrder);                        
                    }                    
                }              
                
                //
                $paymentId = RandomString();                
                $paymentSql = "Insert into payment values ('$paymentId','$user_id','$orderid',null,'$paymentType','unpaid')";
                $paymentresult = mysqli_query($conn, $paymentSql);
                if($paymentresult){                    
                }
            }            
        }        
}
else if($info == "onlybilling"){   
    $billingSql = "Insert into billing_info values ('$billingfname','$billinglname', '$billingemail','$billingphone','$country','$billingaddressone','$billingaddresstwo','$billingpostalcode','$user_id','$shipping_info_id','$added_date', '$infoid')";
        $resultbilling = mysqli_query($conn, $billingSql);
    
        if($resultbilling){
            // insert order
            $orderid = RandomString();
            $orderSql = "Insert into orders values ('$orderid','$user_id','$added_date','$paymentType','pending','$infoid','-')";
            $resultOrder = mysqli_query($conn, $orderSql);
            if($resultOrder){
                // insert product ids of the order
                $orderitemSql = "Select p.id, p.quantity_stock, p.price, p.discount, c.quantity from product p, product_in_cart c where c.cart_id = '$cartid' and p.code = c.product_code";
                $resultOrderItem = mysqli_query($conn, $orderitemSql);                
                if(mysqli_num_rows($resultOrderItem)>0){
                    while($row = mysqli_fetch_assoc($resultOrderItem)){
                        $orderItemid = RandomString();
                        $discount = $row['discount'];
                        if($discount!=0){
                            $updatePrice = $row['price']-$row['discount'];                            
                        }
                        else{
                            $updatePrice = $row['price'];
                        }
                        $quantity = $row['quantity'];
                        $total = $updatePrice * $quantity;
                        $productid = $row['id'];
                        $InsertProductInOrder = "Insert into order_item values ('$orderItemid','$productid','$orderid','$updatePrice','$quantity','$total')";
                        $resultAddProductItem = mysqli_query($conn ,$InsertProductInOrder);                        
                    }                    
                }              
                
                //
                $paymentId = RandomString();                
                $paymentSql = "Insert into payment values ('$paymentId','$user_id','$orderid',null,'$paymentType','unpaid')";
                $paymentresult = mysqli_query($conn, $paymentSql);
                if($paymentresult){   
                    echo json_encode("sad");
                }
            }            
        }        
}
}
function RandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>