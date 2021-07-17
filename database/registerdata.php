<?php
include('connect.php');
date_default_timezone_set("Asia/Kathmandu");

function getData($datatype, $conn){
    $id = 0;    
    $sql = "Select * from $datatype";
    $result = mysqli_query($conn, $sql);
    $id = mysqli_num_rows($result);
    $id++;
    return $id;
}

if(isset($_FILES['image_upload_file'])){
    $_SESSION['uniquekey'] = null;
    $_SESSION['imagename'] = null;
    $userUniqueKey = rand(100, 500).time();
    $_SESSION['uniquekey'] = $userUniqueKey;
    include('../imageUpload/imageUpload.php');    
}
if(isset($_POST['submit'])){    
$newUserID = getData("customer", $conn);
$newCartID = getData("cart",$conn);

if(isset($_SESSION['uniquekey'])){
    $userUniqueKey = $_SESSION['uniquekey'];
}


//get current date from system
$date = date('Y-m-d');

//validations
if(isset($_POST['name'])){
$name = trim($_POST['name']);
}

//set username automatically based on firstname and random number;
if(count(explode(' ', $name)) != 0){
    $fname = explode(' ',$name);    
}
else{
    $fname = $name;
}
$username = strtolower($fname[0].rand(0,10000));

if(isset($_SESSION['imagename'])){
    $imageLink = $_SESSION['imagename'];
}
else{
    $imageLink = "notset";
}

$verificationkey = md5(time());
$age = $_POST['age'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$password = md5($_POST['password']);
    $email = strtolower(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $exists = false;
    $email_query = "Select email from customer";
    $email_result = mysqli_query($conn, $email_query);
    while($row=mysqli_fetch_assoc($email_result)){
        if($email == $row['email']){
            $exists = true;
        }
    }

    if($exists){
        $output['statusCode'] = 200;        
    }

    $password = mysqli_real_escape_string($conn, $password);

    if(!$exists){
        $sql = "Insert into customer values('$newUserID',$userUniqueKey,'$username','$name','$password','$email','$phone','$age','$gender','$date','$imageLink','NO','NO', '$verificationkey')";
        $result = mysqli_query($conn, $sql);
        if($result){
            $sql1 = "Insert into cart values ('$newCartID','$newUserID')";
            $result1 = mysqli_query($conn, $sql1);
            include('sendmail.php');        
            $output['statusCode'] = 201;                        
        }    
    }
    echo json_encode($output);    
}

?>
