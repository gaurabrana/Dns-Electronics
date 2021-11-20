<?php
include("connect.php");
if(isset($_POST['action'])){
    extract($_POST);
    //sql
    $paymentid = RandomString();
    $getTotalPrice = "Select sum(total_price) as total from order_item where order_id = '$orderid'";
    $getTotalPriceExecute = mysqli_query($conn, $getTotalPrice);
    $getTotalOrdered = mysqli_fetch_assoc($getTotalPriceExecute);
    $total = $getTotalOrdered['total'];
    //remaining amount 
    if($payamount > $total){
        echo json_encode(array("statusCode" => 202));
        exit();
    }    
    $remainingtotal = $total - $payamount;
    if($remainingtotal == 0){
        $status = "Full Paid";
    }
    else{
        $status = "Half Paid";
    }
    $sql = "Insert into payment values ('$paymentid', '$orderid', '$type', '-', '$total', '$payamount', '$remainingtotal', '$paydate','$status')";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo json_encode(array("statusCode" => 200));
    }
    else{
        echo json_encode(array("statusCode" => 201));
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