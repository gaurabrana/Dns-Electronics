<?php

if(isset($_GET['r'])){
    if($_GET['r']=="su"){
        // 
        $returnorderid = (string) $_GET['oid'];
        $totalAmount = (int) $_GET['amt'];
        $transactionid = $_GET['refId'];        
        $url = "https://uat.esewa.com.np/epay/transrec";
        $data =[
        'amt'=> $totalAmount,
        'rid'=> $transactionid,
        'pid'=> $returnorderid,
        'scd'=> 'EPAYTEST'
        ];

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    echo $response;
    if(str_contains($response, "Success")){    
        // insert payment into database
        include('database/connect.php');  
        $date = date("l d M Y - h:m A");
        $paymentid = RandomString();      
        $sql = "Select sum(total_price) as total from order_item where order_id = '$returnorderid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);    
        $total = $row['total'];
         echo $total;
        $remainingtotal = $total - $totalAmount;
        if($remainingtotal == 0){
            $status = "Full Paid";
        }
        else{
            $status = "Half Paid";
        }
        $paymentQuery = "Insert into payment values ('$paymentid', '$returnorderid', (Select payment_type from orders where id='$returnorderid'), '$transactionid', '$total', '$totalAmount', '$remainingtotal', '$date','$status')";
        $paymentQueryresult = mysqli_query($conn, $paymentQuery);
        if($paymentQueryresult){
            echo "ok";
            //header("Location: orderdetail.php?i=$returnorderid&r=su");
        }
        else{
            echo "not ok";
           // header("Location: orderdetail.php?i=$returnorderid&r=fu");
        }        
    }
                          
    }
    else{
   echo'     <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>';
    }
}
function RandomString($length = 10) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>