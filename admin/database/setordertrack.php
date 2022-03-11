<?php
include("connect.php");
if(isset($_POST['action'])){
$orderid = $_POST['orderid'];
$stage = $_POST['stage'];
$date = date("Y-m-d h:i:s A");
    $sql = "Insert into order_tracking values('','$orderid', '$date', '$stage')";
    $executesql = mysqli_query($conn, $sql);
    if($executesql > 0){
      echo  json_encode(array("statusCode" => 200));
    }
    else{
        echo  json_encode(array("statusCode" => 201));
    }    
    
}
?>