<?php
include("connect.php");
if(isset($_POST['action'])){
    $ukey = $_POST['ukey'];
    if($_POST['action']=="disable"){
        $sql = "Update customer set access = 'DISABLED' where uniquekey = '$ukey'";
    }
    else if($_POST['action']=="enable"){
        $sql = "Update customer set access = 'ENABLED' where uniquekey = '$ukey'";
    }    
    $executesql = mysqli_query($conn, $sql);
    if($executesql){
        echo json_encode(array("statusCode" => 200));
    }
    else{
        echo json_encode(array("statusCode" => 201));
    }    
}
?>