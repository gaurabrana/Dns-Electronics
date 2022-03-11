<?php

function getNextId($tablename){
include('connect.php');
    $id = 0;    
    $sql = "Select count(id) as totalrows from $tablename";
    $result = mysqli_query($conn, $sql);
    $id = (int) mysqli_fetch_assoc($result)['totalrows'];
    $id++;
    return $id;
}

?>