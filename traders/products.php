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
<a href="addproduct.php" class="btn btn-danger">Add Product</a>
<a href="report.php" style="float:right" class="btn btn-success">Download Details</a>
<?php
if(!empty($_GET['deleted'])=="true"){
    $product = $_GET['id'];
echo"<h4>Product id ".$product." deleted successfully.</h4>";
}
else if(!empty($_GET['deleted'])=="false"){
    echo"<h4>Failed to delete product id ".$product."</h4>";
}
//fetch products
$sql = "select * from product where shop_id = $shop_id";
$result = mysqli_query($conn, $sql);
echo"<table class='table table-bordered table-striped'>
<tr>
<th>product</th>
<th>name</th>
<th>description</th>
<th>price</th>
<th>discount</th>
<th>code</th>
<th>sold_by</th>
<th>brand</th>
<th>stock</th>
<th>type</th>
<th>category</th>
<th>gender_pref</th>
<th>Change</th>
</tr>
";
while($row = mysqli_fetch_assoc($result)){
echo"<tr>
<td><img height='100px' width='100px' src='../img/products/".$row['image_name']."'></td>
<td>".$row['name']."</td>
<td>".substr($row['description'],0,100)."</td>
<td>$".$row['price']."</td>
<td>";
if($row['discount']>0){
    echo "$".$row['discount'];
}
else{
    echo"-";
}
echo"</td>
<td>".$row['code']."</td>
<td>".$row['sold_by']."</td>
<td>".$row['brand']."</td>
<td>".$row['quantity_stock']."</td>
<td>".$row['type']."</td>
<td>".$row['category']."</td>
<td>".$row['gender_preference']."</td>
<td><a href='updateproduct.php?id=".$row['id']."'>Update</a>/";
?>
<a href='javascript:void(0)' onclick="location.href='products.php?process=delete&id=<?php echo $row['id'] ?>'">Delete</a></td>
<?php
echo"</tr>";
}
echo"</table>";
?>
</div>
</div>