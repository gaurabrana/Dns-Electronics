<?php
include('connect.php');
if(isset($_POST['review'])){
    if(isset($_SESSION['id'])){
        $userid = $_SESSION['id'];
        $productcode = $_POST['code'];
        $review = $_POST['review'];
        $rating = $_POST['rating'];
        $result['reviews'] = "";
        $date = date("Y-m-d h:i:s A");
        if(isset($_POST['update'])){   
            $isupdate = true;     
            $addreview = "Update reviews set rating = '$rating', comment = '$review', added_date='$date' where customer_id = '$userid' and product_code = '$productcode'";
        }
        else{
            $isupdate = false;
            $reviewid = generateRandomId().md5($date);
            $addreview = "Insert into reviews values ('$reviewid','$userid','$productcode','$rating','$review','$date')";
        }            
        $executeaddreview = mysqli_query($conn, $addreview);
        if($executeaddreview){
            $result['statusCode'] = 200;
            $getAllReviews = "Select c.name,c.profile_picture,c.uniquekey, r.added_date, r.rating, r.comment,r.customer_id from reviews r, customer c where product_code = '$productcode' and c.id = r.customer_id and r.customer_id = '$userid'";
            $ExecutegetUserReviews = mysqli_query($conn, $getAllReviews);                  
            while($row = mysqli_fetch_assoc($ExecutegetUserReviews)){
                if(!$isupdate){
                    $result["reviews"] .= '<div class="testimonial-box" id="reviewOfCurrentUser">';
                }
                                         $datefromdatabase = date_create($row['added_date']);
										$formatteddate = date_format($datefromdatabase, "M d, Y");
										$formattedtime = date_format($datefromdatabase, "h:i A");										
										$result["reviews"] .= '<div class="box-top">									
											<div class="profile">										
												<div class="profile-img">
													<img src="img/UserProfile/'.$row['uniquekey'].'/'.$row['profile_picture'].'" alt="userimage" />
												</div>										
												<div class="name-user">
													<strong>'.$row['name'].'</strong>
													<span>'.$formatteddate.' at '.$formattedtime.'</span>
												</div>
											</div>									
											<div class="reviews">';
											$rating = $row['rating'];
											for($i = 1 ; $i<6; $i++){
												if($i <= $rating){
													$result["reviews"] .='<i class="yellow fa fa-star"></i>';
												}
												else{
													$result["reviews"] .='<i class="fa fa-star"></i>';
												}												
											}																																	
											$result["reviews"] .='</div>											
										</div>								
										<div class="client-comment">
											<p>'.$row['comment'].'</p>
										</div>																												
									</div>';
                                    if(!$isupdate){
                                        $result["reviews"] .= '</div>';
                                    }
            }
            $result["count"] = getReviewCount($conn, $productcode);
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
    $productcode = $_POST['code'];
    $userid = $_SESSION['id'];
    $sql = "Delete from reviews where product_code = '$productcode' and customer_id = '$userid'";
    $result = mysqli_query($conn, $sql);
    $count = getReviewCount($conn, $productcode);
    if($result){
        echo json_encode(array("statusCode" => 200, "count" => $count));
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

function getReviewCount($conn, $productcode){
$reviewCount = 0;
$sql = "Select count(review_id) as count from reviews where product_code = '$productcode'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$reviewCount = $row['count'];
return $reviewCount;
}