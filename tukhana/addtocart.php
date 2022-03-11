<?php
include('connect.php'); 
    if(isset($_POST['action'])){
        $id = mysqli_real_escape_string($conn,$_POST['id']);        

        // // hard coded (use session variable)
        // $customerid = 1;

        // //check if item exist in cart or not
        // $itemExist = "Select count(id) as id from cart_item where item_type_id = '$id' and customer_id='$customerid'";
        // $itemExistResult = mysqli_query($conn, $itemExist);
        // $itemExistRow = mysqli_fetch_assoc($itemExistResult);
        // $isPresent = $itemExistRow['id'] > 0 ? true : false;
        // if($isPresent){
        //     echo json_encode(array("statusCode"=>204));
        // }
        // else{
        //     $sql = "Insert into cart_item values ('','1','$id','1', '1000')";
        //     $cartResult = mysqli_query($conn, $sql);
        //     if($cartResult){                                            
        //         echo json_encode(array("statusCode"=>200));
        //     }    
        //     else{
        //         echo json_encode(array("statusCode"=>201));
        //     }
        // }          
    }
    else{
        echo json_encode(array("statusCode"=>202));
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