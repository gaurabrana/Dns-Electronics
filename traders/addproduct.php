<?php
include('sidebar.php');
?>
<button><a href="products.php">Back to products</a></button>
<?php
if(isset($_POST['submit'])){
    extract($_POST);
    $code = strtoupper(substr($name,0,3)).rand(100,10000);
    $shop_id = $_SESSION['shop_id'];
    $sold_by = $_SESSION['shop_name'];
    $added_date = date('Y-m-d');

    $target_dir = "../img/products/";
    include('imageupload.php');
    //validate
    $sql = "Insert into product (name,price,discount,description,code,sold_by,brand,shop_id,quantity_stock,type,category,gender_preference,image_name,added_date) values ('$name','$price','$discount','$description','$code','$sold_by','$brand','$shop_id','$quantity_stock','$type','$category','$gender_preference','$imagename','$added_date')";
    $result = mysqli_query($conn, $sql);
    if($result){
        //echo"<script>window.location='addproduct.php?added=true'</script>";
    }
    else{
        echo "<script>alert('Failed to add product. Please try again.');</script>";
    }
}
//code generator
?>
<?php
if(!empty($_GET['added'])=='true'){
    echo"<h4>Product added successfully.</h4>";
}
?>
<form action="addproduct.php" method="POST" enctype="multipart/form-data">
  <label for="name">Name:</label><br>
  <input type="text" id="name" name="name" required><br>
  <label for="price">Price:</label><br>
  <input type="text" id="price" name="price" required><br>
  <label for="discount">Discount:</label><br>
  <input type="text" id="discount" name="discount" value="0" required><br>
  <label for="description">Description:</label><br>
  <textarea name="description" rows="4" cols="50"></textarea><br>
  <label for="quantity_stock">Stock Available:</label><br>
  <input type="text" min="1" id="quantity_stock" name="quantity_stock" required><br>
  <label for="type">Type:</label><br>
  <select name="type" id="type" required>
  <option value="Clothes" selected>Clothes</option>
  <option value="Digital">Digital</option>
  <option value="Furniture">Furniture</option>  
  </select></br>
  <label for="category">Category:</label><br>
  <input type="text" id="category" name="category" required><br>
  <label for="brand">Brand:</label><br>
  <input type="text" id="brand" name="brand" required><br>
  <label for="gender_preference">Gender preference:</label><br>
  <select id="gender_preference" name="gender_preference" required>
  <option value="None">None</option>    
  <option value="Unisex">Unisex</option>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
  </select><br>
  <label for="image">Choose Image:</label><br>
  <input  style="color:transparent;" type="file" name="fileToUpload" id="fileToUpload" onchange="preview()" required><br>
  <img id="thumbnail" src="" width="150px" hidden>
  <br><br>
  <input type="submit" value="Submit" name="submit">
</form>
</div>
</div> 
<script>
    function preview() {
        thumbnail.hidden = false;
        thumbnail.src=URL.createObjectURL(event.target.files[0]);
}
</script>