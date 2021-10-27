<?php
if(isset($_POST['action'])){
    include("connect.php");
    if($_POST['action']=="deletereview"){
        $id = $_POST['id'];
        $sql = "Delete from reviews where review_id = '$id'";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo json_encode(array("statusCode" => 200));
        }
        else{
            echo json_encode(array("statusCode" => 201));
        }
    }
}
?>