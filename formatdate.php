<?php
date_default_timezone_set("Asia/Kathmandu");
function formatDate($value){
    $createDate = date_create($value);    
    try{
        $formattedDate = date_format($createDate, "M d, Y");
        return $formattedDate;
    }
    catch(Exception $e){
        return ($e -> getMessage());
    }
    
}
function formatTime($value){
    $createTime = date_create($value);
    try{
        $formattedTime = date_format($createTime, "h:i A");
        return $formattedTime;
    }
    catch(Exception $e){
        return ($e -> getMessage());
    }
}

function checkDateTime($value){
    if ( strtotime($value) > strtotime(date("Y-m-d h:i:s A")) ) {
        $isValid = true;                             
      }
      else{
        $isValid = false;
      }
      return $isValid;
}
?>