<?php
if(isset($_POST['action'])){
    include("connect.php");
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $sql = "Insert into contactmessage values ('','$name','$email','$message')";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo json_encode(array("statusCode" => 200));
    }
    else{
        echo json_encode(array("statusCode" => 201));
    }
}
?>