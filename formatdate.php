<?php
date_default_timezone_set("Asia/Kathmandu");

function formatDate($value){
    $createDate = date_create($value);
    return date_format($createDate, "M d, Y");
}
function formatTime($value){
    $createDate = date_create($value);
    return date_format($createDate, "h:i A");
}
?>