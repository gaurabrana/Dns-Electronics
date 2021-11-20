<?php
if(isset($_POST['pageno']) && isset($_POST['currentpage'])){
    $rowsperpage  = 12;
    $totalpages = $_POST['pageno'];
    
    $currentpage = $_POST['currentpage'];
    if ($currentpage > $totalpages) {
        // set current page to last page
        $currentpage = $totalpages;
     } // end if
     // if current page is less than first page...
     if ($currentpage < 1) {
        // set current page to first page
        $currentpage = 1;
     } // end if
     
     // the offset of the list, based on current page 
     $offset = ($currentpage - 1) * $rowsperpage;
     
     // get the info from the db 
     $info = "SELECT id FROM product LIMIT $offset, $rowsperpage";
     $getinforesult = mysqli_query($conn, $info) or trigger_error("SQL", E_USER_ERROR);
     
     // while there are rows to be fetched...
     while ($list = mysqli_fetch_assoc($getinforesult)) {
        // echo data
        if($list['id'] == 1){
            echo'<li class="active"><a href="#">1</a></li></li>';
        }							
        else{
            echo'<li><a id="pagination1" href="#">1</a></li></li>';
        }									
        echo $list['id'] . " : " . $list['id'] . "<br />";
     } // end while
     
     /******  build the pagination links ******/
     // range of num links to show
     $range = 3;
     
     // if not on page 1, don't show back links
     if ($currentpage > 1) {
        // show << link to go back to page 1
        echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> ";
        // get previous page num
        $prevpage = $currentpage - 1;
        // show < link to go back to 1 page
        echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a> ";
     } // end if 
     
     // loop to show links to range of pages around current page
     for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
        // if it's a valid page number...
        if (($x > 0) && ($x <= $totalpages)) {
           // if we're on current page...
           if ($x == $currentpage) {
              // 'highlight' it but don't make a link
              echo " [<b>$x</b>] ";
           // if not current page...
           } else {
              // make it a link
              echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a> ";
           } // end else
        } // end if 
     } // end for
     
     // if not on last page, show forward and last page links        
     if ($currentpage != $totalpages) {
        // get next page
        $nextpage = $currentpage + 1;
         // echo forward link for next page 
        echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a> ";
        // echo forward link for lastpage
        echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a> ";
     } // end if
}
else{

}
								
								?>