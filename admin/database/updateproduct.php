<?php
if(isset($_POST['updateProduct'])){
    include("connect.php");
    extract($_POST);            
    $sql = "Update product set name='$name', price='$price', discount='$discount', wholesale_discount = '$wholesale', minimum_unit = '$minimumunit' ,description='$description', brand='$brand', quantity_stock='$stock',category='$category',image_name='$mainImage' where code='$code'";
    $executeUpdateProduct = mysqli_query($conn, $sql);
    if($executeUpdateProduct){        
        $error = 0;
        foreach($subImage as $imageName){  
            if($imageName != "noimages"){
                $checkdata = "Select folder_key from product_images where folder_key='$imagekey' and image_name='$imageName'";            
                if(mysqli_num_rows(mysqli_query($conn, $checkdata))==0){
                    $insertimagename = "Insert into product_images values('$imagekey','$imageName')";       
                    $executeinsertimagename = mysqli_query($conn, $insertimagename);
                    if(!$executeinsertimagename){
                        $error++;
                    }
                }                                       
            }            
        }
        if($error==0){
            echo json_encode(array("statusCode" => 200, "error" => mysqli_error($conn)));
        }
        else{
            echo json_encode(array("statusCode" => 201));
        }

    }
    else{                
        echo json_encode(array("statusCode" => 202));
    }
}
?>