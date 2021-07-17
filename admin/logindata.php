<?php
require("connect.php");

if(isset($_POST['type'])){
$email = strtolower($_POST['email']);
$password = $_POST['password'];

//check if user exists
$sql = "Select * from admin where email = '$email'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0){ 
    //if result is found, collect user data
    while($row = mysqli_fetch_assoc($result)){            
        $login_email = $row['email'];
        $login_password = $row['password'];        
    }
    if(($password) == $login_password){        
        $_SESSION['email'] = $login_email;            
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
