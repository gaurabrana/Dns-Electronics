<?php
include('sidebar.php');
include('../database/connect.php');
$shop_id = $_SESSION['shop_id'];
if(!empty($_GET['process'])=="delete"){
    $product_id = $_GET['id'];
    $sql = "DELETE FROM PRODUCT WHERE ID=$product_id";
    $result = mysqli_query($conn, $sql);
    if($result){
        header("Location: products.php?deleted=true&id=$product_id");
    }
    else{
        header("Location: products.php?deleted=false&id=$product_id");
    }
}
?>

</div>
</div>