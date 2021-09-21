<?php
include('connect.php');

    $userid = $_SESSION['id'];
    $sql = "Select sum(total_price) as total from order_item where order_id = (Select id from orders where user_id ='$userid' and status = 'pending')";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);    
    $total = $row['total'];


    $url = 'https://api.exchangerate-api.com/v4/latest/USD'; // path to your JSON file
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // Store the data:
    $json = curl_exec($ch);
    curl_close($ch);
    
    // Decode JSON response:
    $rates = json_decode($json, true);
    
    // Access the exchange rate values, e.g. GBP:
    $fromRate =  $rates['rates']['NPR'];            
    $toRate =    $rates['rates']['USD'];
    
    $value = ($toRate / $fromRate) * $total;
    $convertedamount =  number_format($value,2,".","");
    
    echo $convertedamount;

?>