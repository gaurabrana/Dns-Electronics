<?php
include('sidebar.php');
echo"<a  class='btn btn-warning' href='products.php'>Back to products.</a>";
include('../database/connect.php');
if(isset($_POST['submit'])){
    extract($_POST);
    if($_SESSION['product_name'] != $name){
        $code = strtoupper(substr($name,0,3)).rand(100,10000);
    }
    
    if(isset($image_has_changed) && $image_has_changed=='on'){
        unlink("../img/products/$image");        
        $target_dir = "../img/products/";
        include('imageupload.php');
    }
    else{
        $imagename = $image;
    }    
    //validate
    $sql = "Update product set name='$name', price='$price',discount='$discount', brand='$brand', description='$description', 
    code='$code',quantity_stock='$quantity_stock',type='$type',category='$category',
    gender_preference='$gender_preference',image_name='$imagename' where id = $productid";
    $result = mysqli_query($conn, $sql);
    if($result){
       echo"<script>window.location='updateproduct.php?update=true&id=$productid'</script>";
    }
    else{
       echo "<script>alert('Failed to update product. Please try again.');</script>";
    }
}
//code generator
?>
<?php
if(!empty($_GET['update'])=='true'){
    echo"<h4>Product updated successfully.</h4>";
}
if(!empty($_GET['id'])){
    $update_id = $_GET['id'];
    $sql = "Select * from product where id = $update_id";
    $result = mysqli_query ($conn, $sql);
    while($row = $result->fetch_assoc()){
        $_SESSION['product_name'] = $row['name'];
        echo'<form action="updateproduct.php" method="POST" enctype="multipart/form-data">                        
        <input type="text" name="productid" value="'.$row['id'].'" required hidden>
        <input type="text" name="code" value="'.$row['code'].'" required hidden>
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="'.$row['name'].'" required><br>
        <label for="price">Price:</label><br>
        <input type="text" id="price" name="price" value="'.$row['price'].'" required><br>
        <label for="discount">Discount:</label><br>
        <input type="text" id="discount" name="discount" value="'.$row['discount'].'" required><br>
        <label for="description">Description:</label><br>
        <textarea name="description" rows="4" cols="50" >'.$row['description'].'</textarea><br>
        <label for="quantity_stock">Stock Available:</label><br>
        <input type="text" id="quantity_stock" min="1" name="quantity_stock" value="'.$row['quantity_stock'].'" required><br>
        <label for="type">Type:</label><br>
        <select id="type" name="type" required>        
        <option value="Clothes"'.($row['type'] == "Clothes" ? 'selected="selected"':"").'>Clothes</option>
            <option value="Digital"'.($row['type'] == "Digital" ? 'selected="selected"':"").'>Digital</option>
            <option value="Furniture"'.($row['type'] == "Furniture" ? 'selected="selected"':"").'>Furniture</option>
        </select><br>
        <label for="category">Category:</label><br>
        <input type="text" id="category" name="category" value="'.$row['category'].'" required><br>
        <label for="brand">Brand:</label><br>
        <input type="text" id="brand" name="brand" value="'.$row['brand'].'" required><br>
        <label for="gender_preference">Gender preference:</label><br>
        <select id="gender_preference" name="gender_preference" required>
        <option value="None"'.($row['gender_preference'] == "None" ? 'selected="selected"':"").'>None</option>    
        <option value="Unisex"'.($row['gender_preference'] == "Unisex" ? 'selected="selected"':"").'>Unisex</option>
            <option value="Male"'.($row['gender_preference'] == "Male" ? 'selected="selected"':"").'>Male</option>
            <option value="Female"'.($row['gender_preference'] == "Female" ? 'selected="selected"':"").'>Female</option>
        </select><br>
        <label for="image">Product image:</label><br>
        <input type="text" name="image" value="'.$row['image_name'].'" hidden>
        <img id="thumbnail" src="../img/products/'.$row['image_name'].'" width="150px"><br>
        <label>Change product image?</label>
        <input type="checkbox" name="changeimage" id="changeimage" onclick="imagechange();"><br>
        <div id="image_change" hidden>
        <label for="image">Choose Image:</label><br>
        <input  style="color:transparent;" type="file" name="fileToUpload" id="fileToUpload" onchange="preview()"><br>        
        </div>       
        <input type="checkbox" id="image_changed" name="image_has_changed" hidden> 
        <br><br>
        <input type="submit" value="Submit" name="submit">
      </form>'; 
    }
}
?>
</div>
</div>
<script>
    function preview() {        
        thumbnail.src=URL.createObjectURL(event.target.files[0]);
        document.getElementById("changeimage").disabled = true;
        if(document.getElementById("image_changed").checked==false){
            document.getElementById("image_changed").click();
        }       
}
function imagechange(){
    if(document.getElementById("changeimage").checked == true){
        document.getElementById("image_change").hidden = false;
    }
    else{
        document.getElementById("image_change").hidden = true;        
    }
}
</script>