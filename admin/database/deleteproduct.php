<?php
include("connect.php");
if(isset($_POST['delete'])){
    $code = $_POST['delete'];
    $exist = 0;
    $checkcart = "Select count(product_code) as total from product p, product_in_cart c where c.product_code = '$code' and p.code = c.product_code";        
    $checkinorder = "Select count(id) as total from order_item where product_code = '$code'";
    if(checkproductexistance($conn, $checkcart)){
        $exist++;
    }    

    if(checkproductexistance($conn, $checkinorder)){
        $exist++;
    }    
    
    if($exist == 0){      
            $sql  = "Delete from product where code = '$code'";
            $executesql = mysqli_query($conn, $sql);
            if($executesql){
                echo json_encode(array("statusCode" => 200));
            }
            else{
                echo json_encode(array("statusCode" => 201));
            }                
    }
    else{
        echo json_encode(array("statusCode" => 202, "existance" => $exist));
    }        
}
function checkproductexistance($conn, $sql){
    $executecheck = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($executecheck);
    if($row['total']==0){
        return false;
    }
    else{
        return true;
    }        

}
?>