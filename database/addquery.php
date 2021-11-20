<?php
include('connect.php');
if(isset($_POST['query'])){    
    include('../formatdate.php');
    if(isset($_SESSION['id'])){
        $userid = $_SESSION['id'];
        $productcode = $_POST['code'];
        $query = $_POST['query'];
        $date = date("Y-m-d h:i:s A");
        $formatteddate = formatDate($date);
		$formattedtime = formatTime($date);
        $queryid = generateRandomId();
        $addquery = "Insert into product_queries values ('$queryid','$productcode','$userid','$query','-','-','$date')";
        $executeaddquery = mysqli_query($conn, $addquery);
        if($executeaddquery){
            $result['statusCode'] = 200;
            $getProfilePicture = "Select profile_picture, gender, uniquekey from customer where id = '$userid'";            
            $ExecutegetProfilePicture = mysqli_query($conn, $getProfilePicture);
            while($row = mysqli_fetch_assoc($ExecutegetProfilePicture)){
                if($row['profile_picture']=="notset"){
                    if($row['gender']=="Male"){
                        $imagesrc =  'img/maleuser.png';
                    }
                    else{
                        $imagesrc =  'img/femaleuser.png';
                    }  
                   }
                   else{
                    if(file_exists('../img/UserProfile/'.$row['uniquekey'].'/'.$row['profile_picture'].'')){
                        $imagesrc =  'img/UserProfile/'.$row['uniquekey'].'/'.$row['profile_picture'].'';   
                    }
                    else{
                        if($row['gender']=="Male"){
                            $imagesrc =  'img/maleuser.png';
                        }
                        else{
                            $imagesrc =  'img/femaleuser.png';
                        }                                                    
                    }
                }
                $name = ucwords(strtolower($_SESSION['name']));
                $result['queries'] = '<div class="single-comment" id="holdQueryOfCustomers'.$queryid.'">
                <img src="'.$imagesrc.'" alt="userimage">
                <div class="content">                    
                    <h4>'.$name.'<span>'.$formatteddate.' at '.$formattedtime.'</span></h4>
                    <p>'.$query.'
                    <span data-bs-toggle="collapse" href="#deleteQuestionDiv'.$queryid.'" role="button" aria-expanded="false" aria-controls="deleteQuestionDiv'.$queryid.'" id="deleteQuestion'.$queryid.'" title="Delete Question" style="cursor:pointer;">&nbsp&nbsp<i class="fa fa-trash"></i></span>
                    </p>  
                    <div class="collapse querybutton" id="deleteQuestionDiv'.$queryid.'">												
												Are you sure you want to delete this question??
												<br>
												<button id="deleteQuestionButton'.$queryid.'" class="btn btn-danger">Delete</button>
												<button id="hideDeleteQuestionDiv'.$queryid.'" class="btn btn-dark">Cancel</button>
												</div>                     
                </div>
            </div>';            
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
if(isset($_POST['action'])){
    $queryid = $_POST['id'];
    $sql = "Delete from product_queries where id = '$queryid'";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo json_encode(array("statusCode" => 200));
    }
    else{
        echo json_encode(array("statusCode" => 201));
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