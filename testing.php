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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/base/jquery-ui.css">
<script type="text/javascript">
$(function() {
    var startDate;
    var endDate;

    var selectCurrentWeek = function() {
        window.setTimeout(function () {
            $('.week-picker').find('.ui-datepicker-current-day a').addClass('ui-state-active')
        }, 1);
    }

    $('.week-picker').datepicker( {
        showOtherMonths: true,
        selectOtherMonths: true,
        onSelect: function(dateText, inst) { 
            var date = $(this).datepicker('getDate');
            startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
            endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
            var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
            $('#startDate').text($.datepicker.formatDate( dateFormat, startDate, inst.settings ));
            $('#endDate').text($.datepicker.formatDate( dateFormat, endDate, inst.settings ));

            selectCurrentWeek();
        },
        beforeShowDay: function(date) {
            var cssClass = '';
            if(date >= startDate && date <= endDate)
                cssClass = 'ui-datepicker-current-day';
            return [true, cssClass];
        },
        onChangeMonthYear: function(year, month, inst) {
            selectCurrentWeek();
        }
    });

    $('.week-picker .ui-datepicker-calendar tr').live('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
    $('.week-picker .ui-datepicker-calendar tr').live('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });
});
</script>
</head>
<body>
    <div class="week-picker"></div>
    <br /><br />
    <label>Week :</label> <span id="startDate"></span> - <span id="endDate"></span>
</body>
</html>