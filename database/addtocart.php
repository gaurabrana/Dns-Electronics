<?php
include('connect.php');
if(isset($_SESSION['email'])){
    $exist = true;
    $id = null;           
    $cart_id = $_SESSION['cartid'];        
    while($exist){        
        $id = generateRandomString();
        $checkid = "Select id from product_in_cart where id = '$id'";
        $result = mysqli_query($conn, $checkid);
        if(mysqli_num_rows($result)>0){
        $exist = true;
        }
        else{
            $exist = false;
        }
    }
    if(isset($_POST['action'])){
        $code = mysqli_real_escape_string($conn,$_POST['action']);
        $checkProductCode = "Select product_code from product_in_cart where product_code = '$code' and cart_id = '$cart_id'";
        $checkProductCodeResult = mysqli_query($conn, $checkProductCode);
        if(mysqli_num_rows($checkProductCodeResult)==0){
            if(isset($_POST['quantityofproduct'])){
                $productquantity = $_POST['quantityofproduct'];
            }
            else{
                if($_SESSION['isRetail']){
                    $productquantity = 1;
                }
                else{
                    // get minimum order unit
                    $getMinLimit = "Select minimum_unit from product where code = '$code'";
                    $getMinLimitResult = mysqli_query($conn, $getMinLimit);
                    $minUnit = mysqli_fetch_assoc($getMinLimitResult);
                    $productquantity = $minUnit['minimum_unit'] != 0 ? $minUnit['minimum_unit'] : 1;
                }                
            }
            $sql = "Insert into product_in_cart values ('$id', $cart_id, '$code', '$productquantity')";
            $cartResult = mysqli_query($conn, $sql);
            if($cartResult){
                echo json_encode(array("statusCode"=>200));
            }
            else{
                echo json_encode(array("statusCode"=>201));
            }
        }
        else{
            echo json_encode(array("statusCode"=>204));
        }        
    }
    else{
        echo json_encode(array("statusCode"=>202));
    }

}
else{
    echo json_encode(array("statusCode"=>203));
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>