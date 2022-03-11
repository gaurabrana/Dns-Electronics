<?php
include('connect.php');
include('encryption.php');
date_default_timezone_set("Asia/Kathmandu");

if(isset($_POST['register'])){
    //extract($_POST);
    $userUniqueKey = rand(100, 500).time();    
    $error = 0;
    $errorMessage = "";
    $user = "retail";
    // check is wholesale or retail
    if($_POST['iswholesale'] == "true"){    
        $user = "wholesale";
        if(isset($_FILES['citizenship_front_image'])){        
            $data = imageUpload('citizenship_front_image', $userUniqueKey);
            if($data[1]){
                $citizenship_front_image = $data[0];
                }
                else{
                    $error++;
                    $errorMessage .= "Failed to upload citizenship front photo.";
                }
            }
            else{
                $error++;
                $errorMessage .= "Citizenship front photo not selected.";
            }
        if(isset($_FILES['citizenship_back_image'])){        
            $data = imageUpload('citizenship_back_image', $userUniqueKey);
            if($data[1]){
                $citizenship_back_image = $data[0];
                }
                else{
                    $error++;
                    $errorMessage .= "Failed to upload citizenship back photo.";
                }
            }
            else{
                $error++;
                $errorMessage .= "Citizenship back photo not selected.";
            }

            if(isset($_POST['currentAddress'])){
                if($_POST['currentAddress'] != ""){
                    $current_address =  mysqli_real_escape_string($conn, $_POST['currentAddress']);
                }      
            else{
                $error++;
                $errorMessage .= "Empty current address field.";
            }
            }    
            else{
                $error++;
                $errorMessage .= "Empty current address field.";
            } 
            
            
            if(isset($_POST['permanentAddress'])){
                if($_POST['permanentAddress'] != ""){
                $permanent_address = mysqli_real_escape_string($conn, $_POST['permanentAddress']);
                }
                else{
                    $error++;
                    $errorMessage .= "Empty permanent address field.";
                } 
            }
            else{
                $error++;
                $errorMessage .= "Empty permanent address field.";
            } 

            
        if(isset($_POST['citizenshipNumber'])){
            if($_POST['citizenshipNumber'] != ""){
                $citizenship_number = mysqli_real_escape_string($conn, $_POST['citizenshipNumber']);    
                }
                else{
                    $error++;
                    $errorMessage .= "Empty citizenship number field.";
                }     
        }
        else{
            $error++;
            $errorMessage .= "Empty citizenship number field.";
        } 
        if(isset($_POST['businessname'])){
            if($_POST['businessname'] != ""){
            $business_name = mysqli_real_escape_string($conn, $_POST['businessname']);
            }
            else{
            $error++;
            $errorMessage .= "Empty business name field.";
            }
        }
        else{
            $error++;
            $errorMessage .= "Empty business name field.";
        } 

        if(isset($_POST['businessPan'])){
            if($_POST['businessPan'] != ""){
                $business_pan_no = mysqli_real_escape_string($conn, $_POST['businessPan']);
                }
                else{
                $error++;
                $errorMessage .= "Empty business pan number field.";
                }
        }
        else{
            $error++;
            $errorMessage .= "Empty business pan number field.";
        } 
    }    
    $newUserID = getData("customer", $conn);
    $newCartID = getData("cart",$conn);

    if(isset($_FILES['profilePicture'])){        
        $data = imageUpload('profilePicture', $userUniqueKey);
        if($data[1]){
        $imageLink = $data[0];
        }
        else{
            $error++;
            $errorMessage .= "Failed to upload user photo.";
        }
    }
    else{
        if($_POST['iswholesale'] == "true"){
        $error++;
        $errorMessage .= "User photo not selected.";
        }
        else{
            $imageLink = "notset";
        }        
    }
$date = date('Y-m-d');
if($_POST['name'] != ""){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $name = trim($name);
    //set username automatically based on firstname and random number;
    if(count(explode(' ', $name)) != 0){
        $fname = explode(' ',$name);    
    }
    else{
        $fname = $name;
    }
    $username = strtolower($fname[0].rand(0,10000)); 
}
else{
    $error++;
    $errorMessage .= "Empty fullname field.";
}       

if($_POST['phone'] != ""){
        $phone = $_POST['phone'];        
}
else{
    $error++;
    $errorMessage .= "Empty contact number field.";
} 

if(isset($_POST['email'])){
    if($_POST['email'] != ""){
        $email = strtolower(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));    
        $email = mysqli_real_escape_string($conn, $email);    
        }
        else{
        $error++;
        $errorMessage .= "Empty email address field.";
        }    
}
else{
    $error++;
    $errorMessage .= "Empty email address field.";
} 

if(isset($_POST['password'])){
    if(strlen($_POST['password']) > 7 && strlen($_POST['password']) < 20){
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $password = encrypt_text(md5($password));
    }
    else{
    $error++;
    $errorMessage .= "Password should be 8-20 characters.";
    }        
}
else{
    $error++;
    $errorMessage .= "Empty password field.";
} 

    $verificationkey = md5(time());

    if(isset($_POST['age'])){       
        if($_POST['age']!="") {
            if($_POST['age'] < 16){
                $error++;
                $errorMessage .= "Age should be greater than 15.";
            }
            else{
                $age = $_POST['age'];
            }
        }
        else{
        $error++;
        $errorMessage .= "Empty age field.";
        }        
    }
    else{
        $error++;
        $errorMessage .= "Empty age field.";
    }   
    
    if($_POST['gender']!="notselected"){
        $gender = $_POST['gender'];
    }
    else{
        $error++;
        $errorMessage .= "Gender field not selected.";
    }    

    if($error==0){        
    $email_query = "Select id from customer where email = '$email'";    
    $email_result = mysqli_query($conn, $email_query);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password = encrypt_text(md5($password));
    if(mysqli_num_rows($email_result) == 0){
        $sql = "Insert into customer values('$newUserID','$user',$userUniqueKey,'$username','$name','$password','$email','$phone','$age','$gender','$date','$imageLink','NO','NO','DISABLED','$verificationkey')";
        $result = mysqli_query($conn, $sql);
        if($result){
            $sql1 = "Insert into cart values ('$newCartID','$newUserID')";
            $result1 = mysqli_query($conn, $sql1);

            if($_POST['iswholesale'] == "true"){            
            $sql2 = "Insert into wholesale_detail values('','$newUserID','$current_address', '$permanent_address', '$citizenship_number', '$citizenship_front_image', '$citizenship_back_image','$business_name', '$business_pan_no')";
            $result2 = mysqli_query($conn, $sql2);
            $output['statusCode'] = 200;
            }
            else{
                $message = "
                <h2>Thank you for Registering With Dns Electronics.</h2>    
                <p>Please click the link below to activate your account.</p>
                <a href='http://localhost/ecommerceproject/database/verifyemail.php?vkey=$verificationkey'>Activate Account!</a>
            ";
                $subject = "Registered Successfully.";
                include('sendmail.php');
                if($emailSent){                
                    $output['statusCode'] = 200;                                               
                }
                else{
                    //error in email so revert data
                    $deletesql = "Delete from customer where id = '$newUserID'";
                    $deletecartsql = "Delete from cart where customer_id = '$newUserID'";
                    $executedeletesql = mysqli_query($conn, $deletesql);
                    $executedeletecartsql = mysqli_query($conn, $deletecartsql);
                    if($executedeletecartsql && $executedeletesql){
                        $output['statusCode'] = 205; 
                    }
                    else{
                        $output['statusCode'] = 204; 
                    }    
                } 
            }                                              
        }
        else{
            $output['statusCode'] = 202; 
        }
    }            
    else{
        $output['statusCode'] = 201;   
    }
                                      
    }
    else{
        $output['statusCode'] = 203;   
        $output['errors'] = $errorMessage;
    }               
    echo json_encode($output);
}

function getData($datatype, $conn){
    $id = 0;    
    $sql = "Select * from $datatype";
    $result = mysqli_query($conn, $sql);
    $id = mysqli_num_rows($result);
    $id++;
    return $id;
}

function createDir($path){
    if (!file_exists($path)) {
    $old_mask = umask(0);
    mkdir($path, 0777, TRUE);
    umask($old_mask);
    return true;
    }
    else{
      return false;
    }
    
    }


function imageUpload($a, $b){    
// (A) FILE CHECK
if (!isset($_FILES[''.$a.'']['tmp_name'])) {        
    return array("No file uploaded.", false); 
}

// (B) IS THIS A VALID IMAGE?
  $allowed = ["bmp", "gif", "jpg", "jpeg", "png", "webp"];
  $ext = strtolower(pathinfo($_FILES["$a"]["name"], PATHINFO_EXTENSION));
  if (!in_array($ext, $allowed)) {    
    return array("$ext file type not allowed - " . $_FILES["$a"]["name"], false);     
  }

// (C) MOVE UPLOADED FILE OUT OF TEMP FOLDER

  $directorypath = "../img/UserProfile/".$b;
  createDir($directorypath);  
  $source = $_FILES["$a"]["tmp_name"];

  if($a == "profilePicture"){
    $name = "user.".$ext;
  }  
  else if($a == "citizenship_front_image"){
    $name = "front.".$ext;
  }
  else if($a == "citizenship_back_image"){
    $name = "back.".$ext;
}
    $destination = $directorypath."/".$name;  
  if(file_exists($destination)){
    unlink($destination);
  }
  if(move_uploaded_file($source, $destination)){
    return array($name, true);
  }
  else{
    return array("Error uploading", false);     
  }  

}
