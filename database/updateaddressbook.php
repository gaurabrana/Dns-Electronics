<?php
include('connect.php');
if(isset($_POST['submit'])){
   extract($_POST);   
   $userid = $_SESSION['id'];   
   $date = date("Y-m-d h:i:s A");
   $shippingupdateerror = 0;
   if(isset($_POST['sameshipping'])){
    $sameshipping = true;
}
else{
    $sameshipping = false;    
}

//update billing details
$updatebilling = "Update billing_info set firstname='$billingfname', lastname = '$billinglname', email_address = '$billingemail', phone_number = '$billingphone',country = '$country_name', address_one='$billingaddressone', address_two='$billingaddresstwo', postal_code = '$billingpostalcode', added_date='$date' where info_id = '$billingid'";
$Executeupdatebilling = mysqli_query($conn, $updatebilling);

//if update successful, update shipping
if($Executeupdatebilling){

// shipping detail paile xa vane 
if($shippingid != "Same"){

    // shipping detail lai update garda
    if(!$sameshipping){
        $updateShipping = "Update shipping_info set fullname='$shippingfullname', billing_info = '$billingid', email_address='$shippingemail', phone_number='$shippingphone', country='$shipping_country_name', address_one='$shippingaddressone', address_two='$shippingaddresstwo', postal_code='$shippingpostalcode', added_date = '$date' where shipping_info_id = '$shippingid'";
        $ExecuteupdateShipping = mysqli_query($conn, $updateShipping);
        if(!$ExecuteupdateShipping){
            $shippingupdateerror++;
        }
    }

    // shipping detail lai same as billing garda
    else{
        $updateShippinginBilling = "Update billing_info set shipping_info = 'Same' where info_id = '$billingid'";
        $ExecuteupdateShippinginBilling = mysqli_query($conn, $updateShippinginBilling);
        if(!$ExecuteupdateShippinginBilling){
            $shippingupdateerror++;
        }
    }   
   }

   // shipping detail ra billing paile same xa vane
   else{

       // shipping detail lai add garda
       if(!$sameshipping){
           $newshippingid = GenerateRandomString();
           $newShippingDetail = "Insert into shipping_info values ('$newshippingid','$userid', '$billingid', '$shippingfullname', '$shippingemail','$shippingphone','$shipping_country_name','$shippingaddressone','$shippingaddresstwo','$shippingpostalcode', '$date')";
           $ExecutenewShippingDetail = mysqli_query($conn, $newShippingDetail);
           if($ExecutenewShippingDetail){
            $shippingupdateerror++;
           }
           $updateShippingINBilling = "Update billing_info set shipping_info = '$newshippingid' where info_id = '$billingid'";
           $ExecuteupdateShippingINBilling = mysqli_query($conn, $updateShippingINBilling);
           if($ExecuteupdateShippingINBilling){
            $shippingupdateerror++;
           }
       }       
   }   
   if($shippingupdateerror == 0){
    echo json_encode(array("statusCode"=>200));
    header("Location: ../addressbook.php?success=i");
   }
   else{
    echo json_encode(array("statusCode"=>201));
    header("Location: ../addressbook.php?shiperror=i");
   }
}
else{
    echo json_encode(array("statusCode"=>202));
    header("Location: ../addressbook.php?billerror=i");
}
}

if(isset($_POST['deleteaddress'])){
$billingid = $_POST['deleteaddress'];
$deleteInfo = "Delete from billing_info where info_id = '$billingid'";
$ExecutedeleteInfo = mysqli_query($conn, $deleteInfo);
$deleteShipping = "Delete from shipping_info where billing_info = '$billingid'";
$ExecutedeleteShipping = mysqli_query($conn, $deleteShipping);
if($ExecutedeleteInfo && $ExecutedeleteShipping){
    echo json_encode(array("statusCode"=>200));
}
else{
    echo json_encode(array("statusCode"=>201));
}
}

if(isset($_POST['setactive'])){
    $billingid = $_POST['setactive'];
    $setinactive = "Update billing_info set active = 'No' where active='Yes'";
    $executesetinactive = mysqli_query($conn, $setinactive);
    if($executesetinactive){
        $setNewActive = "Update billing_info set active = 'Yes' where info_id='$billingid'";
        $executesetNewActive = mysqli_query($conn, $setNewActive);
        if($executesetNewActive){
            echo json_encode(array("statusCode"=>200));
        }
        else{
            echo json_encode(array("statusCode"=>201));
        }
    }
    else{
        echo json_encode(array("statusCode"=>202));
    }
}

function GenerateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>