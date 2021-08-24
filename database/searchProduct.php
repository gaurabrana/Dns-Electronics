<?php
include("connect.php");
if(isset($_POST['search'])){
    $searchKeyword = $_POST['search'];
    $category = $_POST['category'];
    if($category == "all"){
        $sql = "Select name,code from product where name like '$searchKeyword%' OR name like '%$searchKeyword%'";
    }
    else{
        $sql = "Select name,code from product where category = '$category' AND (name like '$searchKeyword%' OR name like '%$searchKeyword%')";
    }
    
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $name = $row['name'];
            $changed = str_replace($searchKeyword, '<b>'.$searchKeyword.'</b>', $name);
            echo'<a class="suggest-list" href="singleproduct.php?i='.$row['code'].'">'.$changed.'</a>';
        }
    }
    else{
        echo'<a class="No-Record" href="#">No Product Found.</a>';
    }
    
}
?>