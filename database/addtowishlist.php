<?php
include('connect.php');
if(isset($_SESSION['email'])){
    $exist = true;
    $id = null;
    $customer_id = $_SESSION['id'];        
    while($exist){        
        $id = generateRandomString();
        $checkid = "Select id from wishlist where id = '$id'";
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
        $checkProductCode = "Select product_code from wishlist where product_code = '$code' and customer_id = '$customer_id'";
        $checkProductCodeResult = mysqli_query($conn, $checkProductCode);
        if(mysqli_num_rows($checkProductCodeResult)==0){
    $customer_id = $_SESSION['id'];
    $sql = "Insert into wishlist values ('$id','$customer_id', '$code')";
    $result = mysqli_query($conn, $sql);
    if($result){
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
function generateRandomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
