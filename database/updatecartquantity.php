<?php
include('connect.php');
if(isset($_POST['a'])){
$action = $_POST['a'];
$id = $_POST['b'];
$cart_id = $_SESSION['cartid'];
$updatedQuantity = $_POST['c'];
$sql = "Update product_in_cart set quantity = '$updatedQuantity' where id = '$id'";
$result = mysqli_query($conn, $sql);
    if($result){
        $total = 0;
		$totalDiscount = 0;
        $subtotal = 0;
        $subtotalSpecific = 0;
		$totalWithoutDiscount = 0;
        $getTotalValue   = "Select p.id, c.id as productcartid, p.quantity_stock, p.code, p.name,p.sold_by, p.image_name, p.price, p.discount, p.description, c.quantity from product p, product_in_cart c where c.cart_id = '$cart_id' and p.code = c.product_code";
        $run_query = mysqli_query($conn, $getTotalValue);
        while($row = mysqli_fetch_assoc($run_query)){
            $totalDiscount = $totalDiscount + ($row['discount']*$row['quantity']);
							$totalWithoutDiscount = $totalWithoutDiscount + ($row['quantity'] * $row['price']);
							if($row['discount']!=0){
								$updatedPrice = $row['price'] - $row['discount'];								
							}
							else{
								$updatedPrice = $row['price'];								
							}			
                            $subtotal = $row['quantity'] * $updatedPrice;		                                                        
                            if($row['productcartid'] == $id){				
							$subtotalSpecific = $subtotal;
                            }
							$total = $total + $subtotal;					    
        }
        $dataUpdated = array('total' => $total, "totalWithoutDiscount" => $totalWithoutDiscount, "subtotal" => $subtotalSpecific, "totalDiscount" => $totalDiscount);
        echo json_encode($dataUpdated);
    }
}
?>