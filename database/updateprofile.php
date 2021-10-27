<?php 
include("connect.php");
if(isset($_POST['action'])){
$userid = $_SESSION['id'];
extract($_POST);
$_SESSION['name'] = strtoupper($userfname);
$updatesql = "Update customer set name='$userfname', age = '$userage', phone_no = '$userphone', gender='$usergender' where id = '$userid'";
$executeupdateusersql = mysqli_query($conn, $updatesql);
if($executeupdateusersql){
    echo json_encode(array("statusCode" => 200));
}
else{
    echo json_encode(array("statusCode" => 201));
}
}
if(isset($_FILES['image_upload_file'])){
    $userUniqueKey = $_SESSION['uniquekey']; 
    $sql = "Select profile_picture from customer where uniquekey = '$userUniqueKey'";
    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    $Mediumprofilepicname = $row['profile_picture'];
    $Smallprofilepicname = "small".explode("medium",$Mediumprofilepicname)[1];
    $isUpdate = true;
    include('imageupload.php');    
}
?>