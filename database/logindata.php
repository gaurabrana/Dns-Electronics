<?php
require("connect.php");
include("encryption.php");
if(isset($_POST['type'])){
$email = strtolower($_POST['email']);
$password = $_POST['password'];
$rememberuser = $_POST['rememberuser'];

//check if user exists
$sql = "Select * from customer where email = '$email'";
$result = mysqli_query($conn, $sql);
$userExist = mysqli_num_rows($result) > 0 ? true : false;

if($userExist){ 
    //if result is found, collect user data      
        $row = mysqli_fetch_assoc($result);            
        $login_name = $row['name'];    
        $login_email = $row['email'];
        $loginUserType = $row['type'];
        $login_password = $row['password'];
        $login_id = $row['id'];
        $uniquekey  = $row['uniquekey'];
        $approved = $row['approved'] == "YES" ? true : false;
        $access = $row['access'] == "ENABLED" ? true : false;   
        $active = $row['active'] == "YES" ? true : false;   

    if(encrypt_text(md5($password)) == $login_password){          
        
        if($approved){

            if($access){
                $date = date("Y-m-d h:s:i A");               
                $_SESSION['isRetail'] = $loginUserType == "retail" ? true :false;
                $setLoginData = "Update customer set active = '$date' where id = '$login_id'";                
                $setLoginDataResult = mysqli_query($conn, $setLoginData);
                if($setLoginDataResult){
                $_SESSION['name'] = strtoupper($login_name);
                $_SESSION['email'] = $login_email;        
                $_SESSION['id'] = $login_id;
                $_SESSION['uniquekey'] = $uniquekey;
                $sql1 = "Select cart_id from cart where customer_id = '$login_id'";                
                $result1 = mysqli_query($conn, $sql1);
                $row = mysqli_fetch_assoc($result1);
                $_SESSION['cartid'] = $row['cart_id'];                
                echo json_encode(array("statusCode"=>200));
                }
                else{
                    echo json_encode(array("statusCode"=>203));
                }                                   
            }
            else{
                echo json_encode(array("statusCode"=>204));
            }            
        }
        else{
            echo json_encode(array("statusCode"=>205));
        }
        
    }
    else{
        echo json_encode(array("statusCode"=>201));
    }
}
else{
    echo json_encode(array("statusCode"=>202));
}
}
mysqli_close($conn);
