<?php
if(!isset($_SESSION)){
    session_start();
}
include('function.php');
/*defined settings - start*/ini_set("memory_limit", "99M");
ini_set('post_max_size', '20M');
ini_set('max_execution_time', 600);
define('IMAGE_SMALL_DIR', '../img/UserProfile/'.$userUniqueKey.'/');
define('IMAGE_SMALL_DIR_TO_DISPLAY', './img/UserProfile/'.$userUniqueKey.'/');
define('IMAGE_SMALL_SIZE', 50);
define('IMAGE_MEDIUM_DIR', '../img/UserProfile/'.$userUniqueKey.'/');
define('IMAGE_MEDIUM_DIR_TO_DISPLAY', './img/UserProfile/'.$userUniqueKey.'/');
define('IMAGE_MEDIUM_SIZE', 300);
/*defined settings - end*/
if(isset($_FILES['image_upload_file'])){
$output['status']=FALSE;
set_time_limit(0);
$allowedImageType = array("image/gif",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );

if ($_FILES['image_upload_file']["error"] > 0) {
$output['error']= "Error in File";
}
elseif (!in_array($_FILES['image_upload_file']["type"], $allowedImageType)) {
$output['error']= "You can only upload JPG, PNG and GIF file";
}
elseif (round($_FILES['image_upload_file']["size"] / 1024) > 4096) {
$output['error']= "You can upload file size up to 4 MB";
} else {
/*create directory with 777 permission if not exist - start*/createDir(IMAGE_SMALL_DIR);
createDir(IMAGE_MEDIUM_DIR);
/*create directory with 777 permission if not exist - end*/$path[0] = $_FILES['image_upload_file']['tmp_name'];
$file = pathinfo($_FILES['image_upload_file']['name']);
$fileType = $file["extension"];
$desiredExt = $fileType;
$value = rand(333, 555) . time();
$fileNameSmallFile = "small".$value . ".$desiredExt";
$fileNameMediumFile = "medium".$value . ".$desiredExt";
$path[1] = IMAGE_MEDIUM_DIR . $fileNameMediumFile;
$path[2] = IMAGE_SMALL_DIR . $fileNameSmallFile;
$pathmedium = IMAGE_MEDIUM_DIR_TO_DISPLAY . $fileNameMediumFile;
$pathsmall = IMAGE_SMALL_DIR_TO_DISPLAY . $fileNameSmallFile;

if (createThumb($path[0], $path[1], $fileType, IMAGE_MEDIUM_SIZE, IMAGE_MEDIUM_SIZE,IMAGE_MEDIUM_SIZE)) {

if (createThumb($path[1], $path[2],"$desiredExt", IMAGE_SMALL_SIZE, IMAGE_SMALL_SIZE,IMAGE_SMALL_SIZE)) {
 if(isset($isUpdate))   {      
    $updatesql = "Update customer set profile_picture  = '$fileNameMediumFile' where uniquekey = '$userUniqueKey'";
    $executeupdatesql = mysqli_query($conn, $updatesql);
    if($executeupdatesql){
        $output['status']=TRUE;        
        if(file_exists("../img/UserProfile/$userUniqueKey/".$Mediumprofilepicname)){
            unlink("../img/UserProfile/$userUniqueKey/".$Mediumprofilepicname);        
         }
         if(file_exists("../img/UserProfile/$userUniqueKey/".$Smallprofilepicname)){
            unlink("../img/UserProfile/$userUniqueKey/".$Smallprofilepicname);
         }   
         $output['image_medium']= $pathmedium;
    }
    else{        
        $output['status']=FALSE;        
    }    
 }
 else{
    $output['status']=TRUE;
    $output['image_medium']= $pathmedium;
    $output['imageName'] = $fileNameMediumFile;
 }

}
}
}
echo json_encode($output);
}
?>