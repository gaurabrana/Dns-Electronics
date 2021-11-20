<?php
include('database/connect.php');
$getIDCount = "Select id from product";
$newID = mysqli_num_rows(mysqli_query($conn, $getIDCount));
$newID++;

$imagekey = "-";
$mainImage = "mainimage.jpg";
    
$date = date("Y-m-d h:i:s A");
for($i=0;$i<50;$i++){    
$price = rand(10, 150000);
$discount = rand(10, 150000);
$stock = rand(10, 150);
$category = getCat();
$brand = getBrand();
$name = getName();
$description = getDesc();
$code = strtoupper(substr($name,0,3)).rand(100,10000);
    echo"Insert into product values ('$newID','$name', '$price', '$discount', '$description', '$code', 'DNS ELECTRONICS','$brand','0','$stock','Electronics','$category','$mainImage','$imagekey','$date')".";<br>";        
    $newID++;
}


function getName(){
    //PHP array containing forenames.
$names = array(
'Beth Moore',
'Maui Arthoughts Company',
'Symbolic Systems',
'Grover Oliver',
'Impact Network Solutions',
'Syracuse Casket Direct',
'All Pro Spas',
'Enlable Inc',
'The Craighead Co.',
'Impact Imaging',
'Aerial Marketing Group',
'WOODEN DEIDRA',
'Wreath Farm',
'Rast Marketing Research',
'Web Marketing Group',
'Teleshuttle Corp',
'Wholesale Appliance Ctr',
'Stewart Appliances',
'Meyer Appliance Service',
'Mars Inc'
);

//Combine them together and print out the result.
return $names[mt_rand(0, sizeof($names) - 1)];
}

function getDesc(){
    $des = array(
        'Latico Environmental Services',
'Killean Audiology & Hearing',
'Cinema Marketing Group',
'Logistics Market Place',
'Lorelei Enterprises',
'THE NEW MARKETEER',
'Golden Country Inc.',
'Kevin Loveless',
'Misurell Marketing Consulting',
'Kayvan Hakim',
'Mobile RDO Communications Svc',
'Tyco Electronics',
'Jacobsson',
'Heather Mcglynn',
'Mon Bien Aime Inc',
'Scanner Master Police Scanners',
'STERLING MARKETING INTERNATIONAL',
'Animal House Pet Supplies',
'Classic Awards & Engraving',
'Adams Memorials'
    );
    return $des[mt_rand(0, sizeof($des) - 1)];
}

function getBrand(){
    $brand = array(
        'notzi',
        'hatello',
        'sony',
        'panasonic',
        'Havells',
        'Samsung',
        'Huawei',
        'LG',
        'gozzby',
        'Call', 'ControlCambridge', 'SoundworksCandace', 'Cameron', 'Canon','Capcom'
    );
    return $brand[mt_rand(0, sizeof($brand) - 1)];
}
function getCat(){
    $cat = array(
      'TV',
      'Fridge',
      'Heater',
      'Headphone',  
        'Speaker',
        'Smartphone',
        'AC',
        'Fan',        
    );
    return $cat[mt_rand(0, sizeof($cat) - 1)];
}
?>