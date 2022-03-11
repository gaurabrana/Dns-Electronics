<?php
include("connect.php");

     if(isset($_POST['datafor'])){
      $charttype = $_POST['datafor'];

// NUMBER OF PRODUCTS ORDERED      
      if($charttype == "LineChart")
      {
        $sortdata = $_POST['sortby'];
        $getOrders = "Select id, order_date from orders";
      $getOrdersResult = mysqli_query($conn, $getOrders);
      $DatesOfOrders = array();
      while($getOrdersRow = mysqli_fetch_assoc($getOrdersResult))
      {
          $orderid = $getOrdersRow['id'];
          $order_date = $getOrdersRow['order_date'];
          $getNumberOfProductsOrdered = "Select sum(quantity) as total from order_item where order_id = '$orderid'";
          $getNumberOfProductsOrderedResult = mysqli_query($conn, $getNumberOfProductsOrdered);
          $getNumberOfProductsOrderedRow = mysqli_fetch_assoc($getNumberOfProductsOrderedResult);
          $totalProducts =  $getNumberOfProductsOrderedRow['total'];
          //echo $orderid." :: ".$order_date." :: ".$getNumberOfProductsOrderedRow['total']."<br>";
          $date =  DateTime::createFromFormat("Y-m-d h:i:s A", $order_date);
          $DatesOfOrders[$orderid] = array($date, $totalProducts);        
      }        
      $data = breakdownDate($DatesOfOrders, $sortdata);       
      }
      // HIGHEST ORDERED PRODUCTS
      else if($charttype == "PieChart")
      {
      
        // get highest ordered products
        $getOrderedProduct  = "Select name, product_code, sum(quantity) as total from order_item, product where product.code = order_item.product_code group by product_code order by total desc limit 5";
        $getOrderedProductResult = mysqli_query($conn, $getOrderedProduct);
        $data = array();
        while($row = mysqli_fetch_assoc($getOrderedProductResult)){
          $data[$row['product_code']] = array($row['name'], $row['total']);
        }        
      }
      // HIGHEST RATED PRODUCTS
      else if($charttype == "PieChart1")
      {
       // get highest rated products
       $getOrderedProduct  = "Select name, product_code, sum(rating) as total from reviews, product where product.code = reviews.product_code group by product_code order by total desc limit 5";
       $getOrderedProductResult = mysqli_query($conn, $getOrderedProduct);
       $data = array();
       while($row = mysqli_fetch_assoc($getOrderedProductResult)){
         $data[$row['product_code']] = array($row['name'], $row['total']);
       }      
      }
      echo json_encode($data);      
                
    } 
                 
    function breakdownDate($dataFromDatabase, $sortdata){  
      if($sortdata == "Week"){
        
        return getWeekDataForChart($dataFromDatabase);
    }
    else if($sortdata == "Month"){
        return getMonthDataForChart($dataFromDatabase);
  
    }
    else if($sortdata == "Year"){
      return getYearDataForChart($dataFromDatabase);
  
    }    
  }
  
    function getMonthDataForChart($dataFromDatabase){
      $values = array("January" => array(0,0), "February" => array(0,0), "March" => array(0,0), "April" => array(0,0),"May" => array(0,0), "June" => array(0,0), "July" => array(0,0), "August" => array(0,0),"September" => array(0,0), "October" => array(0,0), "November" => array(0,0), "December" => array(0,0) );        
      foreach($dataFromDatabase as $key => $data){
        $date = $data[0];
        $totalOrderedProducts = $data[1];     
        $month = $date->format('F');   
        foreach($values as $idkey => $orderdata){
          $totalOrders = $orderdata[0];
          $totalProducts = $orderdata[1];
          if($month == $idkey){
            $totalOrders++;
            $totalProducts = $totalProducts + $totalOrderedProducts;
            $values[$idkey] = array($totalOrders, $totalProducts);
          }
        }
      }
      return $values;
    }
  
  
  function getWeekDataForChart($dataFromDatabase){           
    //current date week
    $date = new DateTime('now');        
    $getRange = rangeWeek($date -> format("Y-m-d"));
              
    // store data in associative array
    $ordersInEachWeeks = array();          
  
    // Last 6 Weeks
    for($i=8; $i>=0; $i--){
        $weekRangeForBack = DateTime::createFromFormat("Y-m-d", $getRange['start']);           
        $backweek = $weekRangeForBack -> sub(new DateInterval('P'.$i.'W'));       
        // get range of this week                         
        $getRangeBackWeek = rangeWeek($backweek->format("Y-m-d"));
        $ordersInEachWeeks[$getRangeBackWeek['start'].":".$getRangeBackWeek['end']] = array(0,0,"");
    }        
  
    // // Current week and next 5 weeks
    // for($i=0; $i<6; $i++){            
    //     $weekRangeForNext = DateTime::createFromFormat("Y-m-d", $getRange['start']);                      
    //     $nextweek = $weekRangeForNext -> add(new DateInterval('P'.$i.'W'));               
    //     $getRangenextWeek = rangeWeek($nextweek->format("Y-m-d"));                         
    //     $ordersInEachWeeks[$getRangenextWeek['start'].":".$getRangenextWeek['end']] = array(0,0,"");     
    // }                        
  
  
    foreach($dataFromDatabase as $orderid => $data){    
      $dateFromDatabase = $data[0];
      $date = $dateFromDatabase -> format("Y-m-d");    
      $totalProducts = $data[1];
      foreach($ordersInEachWeeks as $key => $values){                    
        $startdate = explode(":", $key)[0];
        $enddate = explode(":", $key)[1];              
        
        // order ++
        $totalOrders = $values[0];
        // product ++ 
        $totalProduct = $values[1];
  
        if($values[2] == ""){
          $ordersid = $orderid;
        }
        else{
          $ordersid = $values[2]."::".$orderid;
        }
      
        if(check_in_range($startdate, $enddate, $date)){
          $ordersInEachWeeks[$key] = array($totalOrders+1, ($totalProduct + $totalProducts),($ordersid));        
        }
    }
    } 
    // check where order date is placed on week unit and increase values.
     
  
    //refine data for easy reading of data
    $refinedArrayForOrder = array();
    foreach($ordersInEachWeeks as $key => $values)
    {                    
      $startdate = explode(":", $key)[0];
      $enddate = explode(":", $key)[1];              
      $refinedStartDate = DateTime::createFromFormat("Y-m-d", explode(":", $key)[0]);
      $refinedStartDate = $refinedStartDate -> format("M d");
      $refinedEndDate = DateTime::createFromFormat("Y-m-d", explode(":", $key)[1]);
      $refinedEndDate = $refinedEndDate -> format("M d");
      $refinedArrayForOrder[$refinedStartDate." - ".$refinedEndDate] = $values;
    } 
    return $refinedArrayForOrder;
  }
  
  function getYearDataForChart($dataFromDatabase){
    $date = new DateTime('now');  
    $year = $date -> format("Y");  
    $years = array();
    for($i=5; $i>=0; $i--){
      $years[$year-$i] = array(0,0);    
    }
    foreach($years as $key => $holdYear){
      $totalOrders = $holdYear[0];
      $totalProduct = $holdYear[1];    
      foreach($dataFromDatabase as $orderid => $data){          
        $orderDate = $data[0];
        $orderyear = $orderDate -> format("Y");
        $totalOrderedProducts = $data[1];       
        if($key == $orderyear){        
          $totalProduct = $totalProduct + $totalOrderedProducts;
          $totalOrders++;
          $years[$orderyear] = array($totalOrders, $totalProduct);
        }   
      }    
    }  
    return $years;
  }
  
  function rangeMonth ($datestr) {                                        
      $dt = strtotime ($datestr);
      return array (
        "start" => date ('Y-m-d', strtotime ('first day of this month', $dt)),
        "end" => date ('Y-m-d', strtotime ('last day of this month', $dt))
      );
    }
   
    function rangeWeek ($datestr) {                                        
      $dt = strtotime ($datestr);
      
        return array (
          "start" => date ('N', $dt) == 7 ? date ('Y-m-d', $dt) : date ('Y-m-d', strtotime ('last sunday', $dt)),
          "end" => date('N', $dt) == 6 ? date ('Y-m-d', $dt) : date ('Y-m-d', strtotime ('next saturday', $dt))
        );
    }
  
    function check_in_range($start_date, $end_date, $date_from_user) {
      // Convert to timestamp
      $start = strtotime($start_date);
      $end = strtotime($end_date);
      $check = strtotime($date_from_user);
    
      // Check that user date is between start & end
      return (($start <= $check ) && ($check <= $end));
    }
?>