<?php
if(isset($_POST['addProduct'])){
    include("connect.php");
    extract($_POST);
    $getIDCount = "Select id from product";
    $newID = mysqli_num_rows(mysqli_query($conn, $getIDCount));
    $newID++;
    $code = strtoupper(substr($name,0,3)).rand(100,10000);    
    $date = date("Y-m-d h:i:s A");
    $sql = "Insert into product values ('$newID','$name', '$price', '$discount', '$description', '$code', 'DNS ELECTRONICS','$brand','0','$stock','Electronics','$category','$mainImage','$imagekey','$date')";
    $executeAddProduct = mysqli_query($conn, $sql);
    if($executeAddProduct){        
        $error = 0;
        foreach($subImage as $imageName){  
            if($imageName != "noimages"){
                $getIDCount = "Select id from product_images";
                $newID = mysqli_num_rows(mysqli_query($conn, $getIDCount));
                $newID++;          
                $sql1 = "Insert into product_images values('$newID','$code', '$imageName')";            
                $executeAddProductImages = mysqli_query($conn, $sql1);
                if(!$executeAddProductImages){
                    $error++;                
                }      
            }                  
        }
        if($error==0){
            echo json_encode(array("statusCode" => 200));
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