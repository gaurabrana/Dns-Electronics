<?php
include('database/connect.php');

$directory = "admin/images/products/DNS ELECTRONICS/e13d43c8094f5804c8b72f4884ac6e23/";

// Returns array of files
$files = scandir($directory);
foreach($files as $images){
    if(str_contains($images, "subimage")){
        echo $images."<br>";
    }
    
}
// Count number of files and store them to variable..
$num_files = count($files)-2;

echo $num_files;
?>