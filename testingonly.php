<?php
include('database/connect.php');
$asd = "1234567890qwertyuiopsdfghjkl;zxcvbnm,.1234!@#$%^&*()_)*&^%^YUIKL:?><M<>''{P{}{:}{P:LP{:>}</br>";
echo $asd;
echo mysqli_real_escape_string($conn, $asd);
?>