<?php
if(isset($_POST['reply'])){
    include("connect.php");
    $id = $_POST['qid'];
    $reply = $_POST['reply'];    
    $date = date("Y-m-d h:i:s A");
    $sql = "Update product_queries set adminreply = '$reply', replied_date = '$date' where id = '$id'";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo json_encode(array("statusCode" => 200));        
    }
    else{
       echo json_encode(array("statusCode" => 201));
    }
}
?>