<?php 
if(isset($_POST['action'])){
    include("connect.php");
    include("encryption.php");    
    if($_POST['action']==="verifydetails"){
        $userid = $_SESSION['id'];
        $currentpass = $_POST['currentpass'];
        

        //checkpassword
        $sql = "Select password from customer where id = '$userid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $pass = $row['password'];
        if(encrypt_text(md5($currentpass)) == $pass){
            $email = filter_var($_POST['newemail'], FILTER_SANITIZE_EMAIL);
            $oldemail = $_SESSION['email'];        

            //check if email associated with other users
            $checkEmailAssociation = "Select count(id) from customer where id <> '$userid' and email = '$email'";
            $checkEmailAssociationResult = mysqli_query($conn, $checkEmailAssociation);
            $getMailCheckRow = mysqli_fetch_assoc($checkEmailAssociationResult);
            $totalRetailcount = $getMailCheckRow['retailTotal'];
            $totalWholesalecount = $getMailCheckRow['wholesaleTotal'];
            if(!($totalRetailcount==0 && $totalWholesalecount==0)){            
                echo json_encode(array("statusCode" => 205));
                exit();
            }  

        //send code                
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)){        
            echo json_encode(array("statusCode" => 204));
           exit();
        }
        if($oldemail == $email){
            echo json_encode(array("statusCode" => 203, "email" => $email));
            exit();
        }
        $name = $_SESSION['name'];
        $isUpdateProfile =true;
        $code = RandomString();
        $message = '<table width="100%" style="background-color:#f1f1f1;min-width:600px" bgcolor="#f1f1f1">
        <tbody>
            <tr>
                <td align="center" valign="top" width="100%" style="min-width:600px">
                    <center>
                        <table width="100%" style="min-width:500px" border="0" cellpadding="0" cellspacing="0" bgcolor="#f1f1f1">
                            <tbody>
                                <tr>
                                    <td align="center">
                                        <table width="100%" style="min-width:500px" border="0" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr height="50">
                                                    <td width="100%" height="50" style="line-height:1px;font-size:1px">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        <table border="0" cellpadding="0" cellspacing="0" style="min-width:500px">
                                                            <tbody>
                                                                <tr>
                                                                    <td valign="middle" align="center">
                                                                        <div style="max-height:40px">
                                                                            <div>
                                                                                <h1>Dns Electronics</h1>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td align="center" style="font-family:arial,helvetica,sans-serif;font-size:26px;color:#313131;line-height:32px">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="center">&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table width="100%" style="min-width:500px" border="0" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td align="center">
                                                        <table width="500" border="0" cellpadding="0" cellspacing="0" style="min-width:500px">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="100%" height="50" style="line-height:1px;font-size:1px">
                                                                        <div style="font-family:sans-serif;color:#202020;text-align:center;font-size:26px;line-height:32px;line-height:100%;letter-spacing:2px">
                                                                            OTP code for email address change
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="100%" height="50" style="line-height:1px;font-size:1px">
                                                                        <div style="font-family:sans-serif;color:#202020;text-align:center;font-size:26px;line-height:32px;line-height:100%;letter-spacing:2px">
                                                                            '.$code.'
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <table width="100%" style="min-width:500px" border="0" cellpadding="0" cellspacing="0">
                                                            <tbody>
                                                                <tr height="40">
                                                                    <td align="center">&nbsp;</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
        
        
                        <table width="500" border="0" cellpadding="0" cellspacing="0" style="background-color:#fff;margin:0 auto">
                            <tbody>
                                <tr height="50">
                                    <td width="50">&nbsp;</td>
                                    <td height="50" style="line-height:1px;font-size:1px">&nbsp;</td>
                                    <td width="50">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="50">&nbsp;</td>
                                    <td align="left" style="font-family:arial,helvetica,sans-serif;font-size:14px;color:#202020;line-height:19px;line-height:134%;letter-spacing:.5px">
        
        
                                        Hello '.explode(" ", $name)[0].',
        
                                        <br><br>
        
                                    </td>
                                    <td width="50">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="50">&nbsp;</td>
                                    <td align="left" style="font-family:arial,helvetica,sans-serif;font-size:14px;color:#202020;line-height:19px;line-height:134%;letter-spacing:.5px">
                                        You recently requested to change account for DNS electronics to this address. In order to complete the change, please use the above <span class="il">code</span>.
                                        <br><br>
                                    </td>
                                    <td width="50">&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
        
                        <table width="500" border="0" cellpadding="0" cellspacing="0" style="min-width:400px;background-color:#fff">
                            <tbody>
                                <tr>
                                    <td width="50">&nbsp;</td>
                                    <td align="left" style="font-family:arial,helvetica,sans-serif;font-size:14px;color:#202020;line-height:19px;line-height:134%">
                                        <div style="font-family:arial,helvetica,sans-serif;font-size:14px;color:#202020;line-height:19px;letter-spacing:.5px">
                                            Thank you,<br>Dns Electronics Team
                                        </div>
                                    </td>
                                    <td width="50">&nbsp;</td>
                                </tr>
                                <tr height="50">
                                    <td width="50">&nbsp;</td>
                                    <td height="50" style="line-height:1px;font-size:1px">&nbsp;</td>
                                    <td width="50">&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
        
                        <table width="100%" style="min-width:500px" border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td align="center">
                                        <table width="500" border="0" cellpadding="0" cellspacing="0" style="min-width:500px">
                                            <tbody>
                                                <tr height="50">
                                                    <td width="100%" height="20" style="line-height:1px;font-size:1px">&nbsp;</td>
                                                </tr>
                                                <tr height="30">
                                                    <td width="100%" height="20" style="line-height:1px;font-size:1px">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        <div style="font-family:arial,helvetica,sans-serif;font-size:10px;color:#202020;text-align:center;line-height:12px">
        
                                                            <p>
                                                                © 2021, Dns Electronics, Ltd. All rights reserved. Dns Electronics, the Dns Electronics logo are trademarks or registered trademarks of Dns Electronics, Ltd. in the Nepal and elsewhere. All other trademarks are the property of their respective owners.
                                                            </p>
        
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr height="30">
                                                    <td width="100%" height="30" style="line-height:1px;font-size:1px">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        <div style="font-family:arial,helvetica,sans-serif;font-size:10px;color:#202020;text-align:center;line-height:12px">
        
        
                                                            <a href="" style="color:#037aee" target="_blank">Terms of Service</a> |
        
        
                                                            <a href="" style="color:#037aee" target="_blank">Privacy Policy</a>
        
        
        
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr height="20">
                                                    <td width="100%" height="20" style="line-height:1px;font-size:1px">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                </tr>
                                                <tr height="20">
                                                    <td width="100%" height="20" align="center" style="font-family:arial,helvetica,sans-serif;font-size:10px;color:#858585;text-align:center;line-height:12px">6th State, Surkhet, 21700, Nepal</td>
                                                </tr>
                                                <tr>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
        
        
        
                    </center>
                </td>
            </tr>
        </tbody>
        </table>';
        $subject = "One time password code";        
        include('sendmail.php');        
        if($emailSent){
            $start = date('Y-m-d h:i:s A');
            $valid_date =  date('Y-m-d h:i:s A', strtotime('+5 minutes',strtotime($start)));
            $old_email = $_SESSION['email'];
            $updateActionEmailUpdate = "Insert into email_update values('','$userid', '$old_email' ,'$email', '$code', '$valid_date' ,'ongoing')";
            $executeupdateActionEmailUpdate = mysqli_query($conn, $updateActionEmailUpdate);
            if($executeupdateActionEmailUpdate){
                echo json_encode(array("statusCode" => 200, "email" => $email, "valid_date" => $valid_date));
            }            
        }
        else{
            echo json_encode(array("statusCode" => 202));
        }
        }
        else{
            //incorrect password
            echo json_encode(array("statusCode" => 201));
        }
        
    }
    if($_POST['action'] == "verifyOTP"){          
            $otpcode = $_POST['otpcode'];
            $userid = $_SESSION['id'];
            $getOTPcode = "Select id, code, old_email, new_email from email_update where user_id = '$userid' and status = 'ongoing'";
            $result = mysqli_query($conn, $getOTPcode);
            $row = mysqli_fetch_assoc($result);
            $finalcode = $row['code'];
            $requestid = $row['id'];
            $old_email = $row['old_email'];
            $new_email = $row['new_email'];
            if($otpcode == $finalcode){
                //match
                //change email
                $updateemail = "Update customer set email = '$new_email' where id = '$userid'";
                $resemailupdate = mysqli_query($conn, $updateemail);
                if($resemailupdate){
                    $updatestatusofrequest = "Update email_update set status ='completed' where id='$requestid'";
                    $resultupdatestatusofrequest = mysqli_query($conn, $updatestatusofrequest);                   
                        $_SESSION['email'] = $new_email;
                        echo json_encode(array("statusCode" => 200, "email" => $new_email));                   
                }
                else{
                    echo json_encode(array("statusCode" => 202));
                }
                
            }
            else{
                //does not match
                echo json_encode(array("statusCode" => 201));
            }        
    }
    if($_POST['action']=="changeStatus"){
        $userid = $_SESSION['id'];
        $sql = "Update email_update set status = 'expired' where user_id = '$userid' and status = 'ongoing'";
        $result  = mysqli_query($conn, $sql);
        if($result){
            echo json_encode(array("statusCode" => 200));
        }
        else{
            echo json_encode(array("statusCode" => 201));
        }
    }
    if($_POST['action']=="changePassword"){
        $userid = $_SESSION['id'];
        $oldPass = $_POST['oldPass'];
        $newPass = $_POST['newPass'];        
        if(strlen($newPass) < 8 && strlen($newPass) > 20){
            echo json_encode(array("statusCode" => 203));            
        }
        else{
         $newPass = encrypt_text(md5($newPass));
        $sql = "Select password from customer where id = '$userid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $pass = $row['password'];
        if(encrypt_text(md5($oldPass)) == $pass){
            //update password
            $updatePass = "Update customer set password = '$newPass' where id = '$userid'";
            $executeUpdatePass = mysqli_query($conn, $updatePass);
            if($executeUpdatePass){
                echo json_encode(array("statusCode" => 200));
            }
            else{
                echo json_encode(array("statusCode" => 202));
            }
        }
        else{
            echo json_encode(array("statusCode" => 201));
        }            
        }
    }
    if($_POST['action']=="resetRequest"){
        $userid = $_SESSION['id'];
        $sql = "Update email_update set status = 'expired' where user_id = '$userid' and status<>'expired'";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo json_encode(array("statusCode" => 200));
        }
        else{
            echo json_encode(array("statusCode" => 201));
        }
    }

}

function RandomString($length = 6) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>