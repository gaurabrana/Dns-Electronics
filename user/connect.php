<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
$host="localhost";
$db="ecommerceproject";
$u = "root";
$p="";
$conn = mysqli_connect($host,$u,$p,$db) or die("Error while connecting database");
?>