<?php
include('../database/connect.php');
if(isset($_POST['login'])){
    $userinfo = strtolower($_POST['user_info']);
    $password = $_POST['password'];

    //check for customer data in database using email or username
    $sql = "Select * from trader where email = '$userinfo' OR username = '$userinfo'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){   //if result is found, collect user data
        while($row = mysqli_fetch_assoc($result)){
            $login_username = $row['username'];
            $login_email = $row['email'];
            $login_password = $row['password'];
            $login_id = $row['shop_id'];
            $login_shopname = $row['shop_name'];
        }

        //match password entered by user and password stored in database (in md5 format)
        if(md5($password) == $login_password){
            $_SESSION['username'] = $login_username;
            $_SESSION['email'] = $login_email;
            $_SESSION['password'] = $login_password;
            $_SESSION['shop_id'] = $login_id;
            $_SESSION['shop_name'] = $login_shopname;
            header("Location: dashboard.php");
        }
        else{
            header("Location: login.php?login_error=n2"); 
        }
    }
    else{
        header("Location: login.php?login_error=n1");
    } 
}
?>