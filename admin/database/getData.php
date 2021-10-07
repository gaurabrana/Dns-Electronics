<?php
include("connect.php");
if(isset($_POST['datatype'])){
$datatype = $_POST['datatype'];
if($datatype=="CategoryBrand"){    
    $categoryname = $_POST['category'];
    $sql = "Select distinct brand from product where category = '$categoryname'";
    $executesql = mysqli_query($conn, $sql);
    if(mysqli_num_rows($executesql) > 0){
        $output['code'] = 200;
        $output['result'] = '<option value="new">Choose New Brand</option>';
        while($row = mysqli_fetch_assoc($executesql)){
            $output['result'] .= '<option value="'.$row['brand'].'">'.$row['brand'].'</option>';
        }
    }
    else{
        $output['code'] = 201;
    }    
    echo json_encode($output);
}
}
?>