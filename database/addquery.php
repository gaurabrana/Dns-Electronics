<?php
include('connect.php');
if(isset($_POST['query'])){
    if(isset($_SESSION['id'])){
        $userid = $_SESSION['id'];
        $productcode = $_POST['code'];
        $query = $_POST['query'];
        $date = date("Y-m-d h:i:s A");
        $queryid = generateRandomId();
        $addquery = "Insert into product_queries values ('$queryid','$productcode','$userid','$query','-','-','$date')";
        $executeaddquery = mysqli_query($conn, $addquery);
        if($executeaddquery){
            $result['statusCode'] = 200;
            $getAllQueries = "Select * from product_queries where customer_id = '$userid' and product_code = '$productcode'";            
            $ExecutegetAllQueries = mysqli_query($conn, $getAllQueries);
            while($row = mysqli_fetch_assoc($ExecutegetAllQueries)){
                $result['queries'] = '<div class="single-comment">
                <img src="https://via.placeholder.com/80x80" alt="#">
                <div class="content">
                    <h4>john deo <span>'.$row['added_date'].'</span></h4>
                    <p>'.$row['question'].'</p>   
                </div>
            </div>';
            if($row['adminreply']!="-"){
                $result['queries'] .= '<div class="single-comment left">
                <img src="https://via.placeholder.com/80x80" alt="#">
                <div class="content">
                    <h4>Dns Electronicsx<span>'.$row['replied_date'].'</span></h4>
                    <p>'.$row['adminreply'].'</p>                    
                </div>
            </div>';
            }
            }
            echo json_encode($result);
        }
        else{
            $result['statusCode'] = 201;
            echo json_encode($result);
        }
    }
    else{
        $result['statusCode'] = 202;
        echo json_encode($result);
    }    
}
function generateRandomId($length = 10) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>