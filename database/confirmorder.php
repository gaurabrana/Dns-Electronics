<?php
include('connect.php');
if(isset($_POST['info'])){
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
    $added_date = date("Y-m-d h:i:s A");
if($info == "includeshipping"){
    
    $shippingname = mysqli_escape_string($conn,$shippingname);
    $shippingphone = mysqli_escape_string($conn,$shippingphone);
    $shippingemail = mysqli_escape_string($conn,$shippingemail);
    $shippingcountry = mysqli_escape_string($conn,$shippingcountry);
    $shippingaddressone = mysqli_escape_string($conn,$shippingaddressone);
    $shippingaddresstwo = mysqli_escape_string($conn,$shippingaddresstwo);
    $shippingpostalcode = mysqli_escape_string($conn,$shippingpostalcode);    
    $shipping_info_id = RandomString();   
    //insert shipping address    
    
        //insert billing address
        $shippingSql = "Insert into order_shipping_info values ('$shipping_info_id','$user_id','$shippingname','$shippingemail','$shippingphone','$shippingcountry','$shippingaddressone','$shippingaddresstwo','$shippingpostalcode')";
        $resultShipping = mysqli_query($conn, $shippingSql);
        $billingSql = "Insert into order_billing_info values ( '$infoid','$billingfname','$billinglname', '$billingemail','$billingphone','$country','$billingaddressone','$billingaddresstwo','$billingpostalcode')";
        $resultbilling = mysqli_query($conn, $billingSql);
    
        if($resultbilling && $resultShipping){
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
                    echo json_encode(array("statusCode" => 200));
                }
            }
            else{
                echo json_encode(array("statusCode" => 201));
            }            
        } 
        else{
            echo json_encode(array("statusCode" => 202));
        }       
}
else if($info == "onlybilling"){   
    $billingSql = "Insert into order_billing_info values ( '$infoid','$billingfname','$billinglname', '$billingemail','$billingphone','$country','$billingaddressone','$billingaddresstwo','$billingpostalcode')";    
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
                    echo json_encode(array("statusCode" => 200));
                }
            }  
            else{
                echo json_encode(array("statusCode" => 201));
            }          
        }        
        else{
            echo json_encode(array("statusCode" => 202));
        }
}
}

if(isset($_POST['defaultaddress'])){
            $userid = $_SESSION['id'];
            $paymentType = $_POST['payment'];
            $added_date = date("Y-m-d h:i:s A");
            $cartid = $_SESSION['cartid'];    
            //copy billing
            $newOrderBillingId = RandomString();
            echo $newOrderBillingId;
            $copyBillingDetail  = "Insert into order_billing_info (info_id, firstname, lastname, email_address, phone_number, country, address_one, address_two, postal_code) Select '$newOrderBillingId', firstname, lastname, email_address, phone_number, country, address_one, address_two, postal_code from billing_info where user_id = '$userid' and active='Yes'";
            $executecopyBillingDetail = mysqli_query($conn, $copyBillingDetail);  
            
            //copy shipping            
            $newOrderShippingDetail = RandomString();
            $getShippingDetail = "Insert into order_shipping_info (shipping_info_id, fullname, email_address, phone_number, country, address_one, address_two, postal_code) Select '$newOrderShippingDetail', fullname, email_address, phone_number, country, address_one, address_two, postal_code from shipping_info where shipping_info_id = (Select shipping_info from billing_info where user_id = '$userid' and active = 'Yes')";
            $executecopyShippingDetail = mysqli_query($conn, $getShippingDetail);

            if($executecopyBillingDetail && $executecopyShippingDetail){
                $orderid = RandomString();            
                $orderSql = "Insert into orders values ('$orderid',
                '$userid',
                '$added_date',
                '$paymentType',
                'pending',
                '$newOrderBillingId',
                '$newOrderShippingDetail')";
                $resultOrder = mysqli_query($conn,$orderSql);
                if($resultOrder){
                    // insert product ids of the order
                    $orderitemSql = "Select p.code, p.quantity_stock, p.price, p.discount, c.quantity from product p, product_in_cart c where c.cart_id = '$cartid' and p.code = c.product_code";
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
                            $productcode = $row['code'];
                            $InsertProductInOrder = "Insert into order_item values ('$orderItemid','$productcode','$orderid','$updatePrice','$quantity','$total')";
                            $resultAddProductItem = mysqli_query($conn ,$InsertProductInOrder);                        
                        }                    
                    }                                  
                    //
                    $paymentId = RandomString();                
                    $paymentSql = "Insert into payment values ('$paymentId','$userid','$orderid',null,'$paymentType','unpaid')";
                    $paymentresult = mysqli_query($conn, $paymentSql);
                    if($paymentresult){   
                        echo json_encode(array("statusCode" => 200));
                    }
                }
                else{
                    echo json_encode(array("statusCode" => 201));
                }
            }
            else{
                echo json_encode(array("statusCode" => 202));
            } 
}

function RandomString($length = 10) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>