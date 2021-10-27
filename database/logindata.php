<?php
require("connect.php");

if(isset($_POST['type'])){
$email = strtolower($_POST['email']);
$password = $_POST['password'];
$rememberuser = $_POST['rememberuser'];

//check if user exists
$sql = "Select * from customer where email = '$email'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0){ 
    //if result is found, collect user data
    while($row = mysqli_fetch_assoc($result)){    
        $login_name = $row['name'];    
        $login_email = $row['email'];
        $login_password = $row['password'];
        $login_id = $row['id'];
        $uniquekey  = $row['uniquekey'];
    }
    if(md5($password) == $login_password){          
        
        $_SESSION['name'] = strtoupper($login_name);
        $_SESSION['email'] = $login_email;        
        $_SESSION['id'] = $login_id;
        $_SESSION['uniquekey'] = $uniquekey;
        $sql1 = "Select cart_id from cart where customer_id = '$login_id'";
        $result1 = mysqli_query($conn, $sql1);
        while($row = mysqli_fetch_assoc($result1)){
            $_SESSION['cartid'] = $row['cart_id'];
        }
        echo json_encode(array("statusCode"=>202));
    }
    else{
        echo json_encode(array("statusCode"=>201));
    }
}
else{
    echo json_encode(array("statusCode"=>200));
}
}
mysqli_close($conn);
