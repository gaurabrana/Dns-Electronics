<?php     
      include('../database/connect.php');
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('ID', 'Name', 'Price', 'Description', 'Code', 'Sold_By','Stock'));  
      $query = "SELECT id,name,price,description,code,sold_by,quantity_stock from product ORDER BY id ASC";  
      $result = mysqli_query($conn, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 ?>  