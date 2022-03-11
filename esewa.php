<?php
include('database/connect.php');
if(isset($_POST['payment'])){
    if($_POST['payment'] == "Esewa"){
        // get total amount

    $sql = "Select sum(total_price) as total from order_item where order_id = (Select id from orders where user_id ='$userid' and status = 'Ongoing')";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);    
    $total = $row['total'];


    // parameters
    $productAmount = 0;
    $taxamount = 0;
    $service_charge = 0;
    $delivery_charge = 0;
    $totalAmount = $productAmount + $taxamount + $service_charge + $delivery_charge;
    $uniqueid = $orderid;
    $merchantid = "";
    $onSuccessUrl = "http://merchant.com.np/page/esewa_payment_success?q=su";
    $onFailureUrl = "http://merchant.com.np/page/esewa_payment_failed?q=fu";


        $url = "https://uat.esewa.com.np/epay/main";        
        $data =[
            'amt'=> $productAmount,
            'pdc'=> $delivery_charge,
            'psc'=> $service_charge,
            'txAmt'=> $taxamount,
            'tAmt'=> $totalAmount,
            'pid'=>$uniqueid,
            'scd'=> 'EPAYTEST',
            'su'=>$onSuccessUrl,
            'fu'=>$onFailureUrl
        ];        
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);
    }
    else if($_POST['payment'] == "PayPal"){

    }
}
?>