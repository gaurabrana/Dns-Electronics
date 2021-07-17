<?php
if(isset($_POST['register'])){
    include('../base/connect.php');
    date_default_timezone_set("Asia/Kathmandu");

    $id = 0;
    $sql = "Select * from trader";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $id++;
    }
    $id++;
    mysqli_free_result($result);
   if(isset($_POST['first_name']) || isset($_POST['last_Name'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $name = trim($first_name)." ".trim($last_name);
    $username = strtolower($first_name.rand(0,10000));   
   }
   else{
    header("Location: ../registration.php?error=n1");  
   }
    //email address sanitization
    if(isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $email = strtolower(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
        }
        else{
            header("Location: ../registration.php?error=e1");  
        }

        //password
        if(isset($_POST['password'])){
            if (strlen($_POST['password']) >= '8') {
               
                if(!preg_match("#[0-9]+#",$_POST['password'])) 
                    {
                        header("Location: ../registration.php?error=p2");             
                    }
                    if(!preg_match("#[A-Z]+#",$_POST['password'])) 
                    {
                        header("Location: ../registration.php?error=p3");   
                    }  
                    if(strpbrk("'", $_POST['password']) || strpbrk(";", $_POST['password'])){
                        header("Location: ../registration.php?error=p4");
                    }          
                        $password= md5($_POST['password']);
            }
            else{
                header("Location: ../registration.php?error=p1");
            }    
            }

        //address
        $address = trim($_POST['address']);
        //phone number
        $phone_number = $_POST['code'].$_POST['phone'];
        //shop name
        $shop_name = trim($_POST['shop_name']);
        //shop category
        $category = $_POST['category'];
        //shop description
        $shop_info = trim(str_replace("'","''",htmlspecialchars($_POST['additional'])));
        //joined_date is today's date
        $joined_date = date('Y-m-d');

        $sql = "Insert into trader values('$id','$name','$username','$password','$shop_name','$category','$shop_info','$email','$phone_number','$address','$joined_date','NO','NO')";
        $result = mysqli_query($conn, $sql);   
        if($result){
        header("Location: login.php");
        }
    }
?>