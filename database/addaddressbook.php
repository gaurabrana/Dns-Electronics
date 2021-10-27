<?php
include('connect.php');
if(isset($_POST['newaddressbook'])){
    extract($_POST);
    if(isset($_POST['newAddressSameShipping'])){
        $info = "includeshipping";
    }
    else{
        $info = "onlybilling";
    }    
    $billingfname = mysqli_escape_string($conn,$billingfname);
    $billinglname = mysqli_escape_string($conn,$billinglname);
    $billingemail = mysqli_escape_string($conn,$billingemail);
    $billingphone = mysqli_escape_string($conn,$billingphone);
    $country = mysqli_escape_string($conn,$country_name);    
    $billingaddressone = mysqli_escape_string($conn,$billingaddressone);
    $billingaddresstwo = mysqli_escape_string($conn,$billingaddresstwo);
    $billingpostalcode = mysqli_escape_string($conn,$billingpostalcode);    
    $infoid = RandomString();
    $cartid = $_SESSION['cartid'];    
    $user_id = $_SESSION['id'];
    $added_date = date("Y-m-d h:i:s A");
if($info == "includeshipping"){    
    $shippingname = mysqli_escape_string($conn,$shippingfullname);
    $shippingphone = mysqli_escape_string($conn,$shippingphone);
    $shippingemail = mysqli_escape_string($conn,$shippingemail);
    $shippingcountry = mysqli_escape_string($conn,$shipping_country_name);
    $shippingaddressone = mysqli_escape_string($conn,$shippingaddressone);
    $shippingaddresstwo = mysqli_escape_string($conn,$shippingaddresstwo);
    $shippingpostalcode = mysqli_escape_string($conn,$shippingpostalcode);    
    $shipping_info_id = RandomString();
    //insert shipping address    
    
        //insert billing address
        $shippingSql = "Insert into shipping_info values ('$shipping_info_id','$user_id','-','$shippingname','$shippingemail','$shippingphone','$shippingcountry','$shippingaddressone','$shippingaddresstwo','$shippingpostalcode','$added_date')";
        $resultShipping = mysqli_query($conn, $shippingSql);
        $billingSql = "Insert into billing_info values ('$infoid','$user_id','$billingfname','$billinglname', '$billingemail','$billingphone','$country','$billingaddressone','$billingaddresstwo','$billingpostalcode','$shipping_info_id','$added_date','No')";
        $resultbilling = mysqli_query($conn, $billingSql);
    
        if($resultbilling && $resultShipping){
                    //update billing id in shipping

                        $updateshipping = "Update shipping_info set billing_info  = '$infoid' where shipping_info_id = '$shipping_info_id'";
                        $executeupdateshipping = mysqli_query($conn, $updateshipping);
                        if($executeupdateshipping){
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
else if($info == "onlybilling"){   
    $billingSql = "Insert into billing_info values ('$infoid','$user_id','$billingfname','$billinglname', '$billingemail','$billingphone','$country','$billingaddressone','$billingaddresstwo','$billingpostalcode','Same','$added_date','No')";
        $resultbilling = mysqli_query($conn, $billingSql);

        if($resultbilling){           
                    echo json_encode(array("statusCode" => 200));                
            }  
            else{
                echo json_encode(array("statusCode" => 201));
            }                  
}
}


function RandomString($length = 10) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>