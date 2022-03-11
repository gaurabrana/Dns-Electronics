
<?php
if(isset($_POST['q'])){
    $orderid = $_POST['q'];
    include('database/connect.php');
    $transaction_details =  json_decode($_POST['i'], true);
    
   // get transaction id
    $transactionId = $transaction_details['id'];
    //get payment status
    $status = $transaction_details['status'] == "COMPLETED" ? "Paid" : "Unpaid";
    
    // fetch details from array
    $paymentDetails = $transaction_details['purchase_units'][0];    
    
    $totalamt = $_POST['d']; 

    // get paid amount
    $paidamt = doubleval($paymentDetails['payments']['captures'][0]['amount']['value']);

    echo $totalamt." ::: ".$paidamt;

    if($totalamt != $paidamt){
        echo json_encode(array("statusCode" => 202));
        exit();
    }

    //get paid amount currency type
    $curreny = $paymentDetails['payments']['captures'][0]['amount']['currency_code'];

    //get paid date
    $utcDate = $paymentDetails['payments']['captures'][0]['update_time'];        

    //sanitize date to proper format
    $sanitized_date = str_replace("T"," ", str_replace("Z"," ", $utcDate));    

    $type = "Paypal";

    //convert string to date in utc timezone
    $local_date = new DateTime($sanitized_date, new DateTimeZone('UTC'));     

    //convert date to local timezone
    $local_date->setTimezone(new DateTimeZone('Asia/Kathmandu'));
    //save date to string
    
    $paydate = $local_date->format('l d M Y - h:m A');
 
    include('database/getnextid.php');
    $paymentid = getNextId("payment");
    // save payment details
    $sql = "Insert into payment values ('$paymentid', '$orderid', '$type', '$transactionId', '$totalamt', '$paidamt', '$paydate','$status')";
    $paymentresult = mysqli_query($conn, $sql);
    if($paymentresult){
        echo json_encode(array("statusCode" => 200));
    }
    else{
        echo json_encode(array("statusCode" => 201));
    }

}
else{
    echo "not working";
}
?>