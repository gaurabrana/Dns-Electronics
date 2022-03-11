<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- Web Font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	
	<!-- StyleSheet -->	
	<!-- Bootstrap -->
  <title>Order Products</title>
  <style>
    #desktop-nav{
      border: 1px solid silver;
      background: #fff;
      
    } 
    #shopping-cart{
        position: sticky !important;
        top:0;
    }
    .food-image{
        max-width: 100%;        
        border-radius: 50%;
    }    
    .dish-card{
        width: 100px;
        float:right;
    }
    .nav-link{
      display: flex;
      color: #000;
      font-weight: bold;     
    }    
    .nav-link:hover{
        color: #e66114;
        text-decoration: underline;
        text-decoration-color: #e66114;
        text-underline-offset: 4px;
    }
    .active{
        color: #e66114;
        text-decoration: underline;
        text-decoration-color: #e66114;
        text-underline-offset: 4px;
    }
  </style>

</head>

<body>

  <div class="container">
    <!-- navbar -->
    <div class="row">
      <div class="col-md-12">
          
      </div>
    </div>
    <?php
    // initialize an arraylist to store cart items

    if(isset($_COOKIE['asd'])){
     $itemlist[]  = $_COOKIE['asd'];
    }
    // $_SESSION
    
    include('connect.php');
    // // insert products
    // $getProductId = "Select count(id) as total from food_items";
    // $getProductIdResult = mysqli_query($conn, $getProductId);
    // $getRow = mysqli_fetch_assoc($getProductIdResult);
    // $getProductNextId = (int)($getRow['total'] + 1);
    

    // // $sql = "INSERT INTO food_category ('id', 'name', 'description', 'total_items') VALUES (NULL, 'MO : MO', '', '0'), (NULL, 'Chicken Lovers', 'Our Special', '0')";
    // // $result = mysqli_query($conn, $sql);        

    //      // add product
    //     $foodItem = "Insert into food_items values('$getProductNextId','Steam Momo', 'Steam Momo', 'Full', 1)";        
    //     $foodItemResult = mysqli_query($conn, $foodItem);
        
    //     $foodItem = "Insert into food_items values('$getProductNextId','Fried Momo', 'Fried Momo', 'Full', 1)";        
    //     $foodItemResult = mysqli_query($conn, $foodItem);

    //     $foodItem = "Insert into food_items values('$getProductNextId','Kothay Momo', 'Kothay Momo', 'Full', 1)";        
    //     $foodItemResult = mysqli_query($conn, $foodItem);

    //     $foodItem = "Insert into food_items values('$getProductNextId','Kothay Momo', 'Kothay Momo', 'Full', 1)";        
    //     $foodItemResult = mysqli_query($conn, $foodItem);

    //     $foodType = "Insert into food_type values(,'$getProductNextId','150','Chicken')";
    //     $foodTypeQuery=  mysqli_query($conn, $foodType);

    //     $foodType = "Insert into food_type values(,'$getProductNextId','115','Veg')";
    //     $foodTypeQuery=  mysqli_query($conn, $foodType);
        

        ?>
    <!-- Product categories -->
    <div class="row mb-4 sticky-top">
      <div class="col-md-12">
      <nav class="navbar navbar-expand-lg web-navigation" id="desktop-nav">
        <button class="nav-prev arrow" style=""><i class="fa fa-chevron-left"></i></button>
        <ul class="navbar-nav" id="menu-list" style="margin: 0px 10px; width: 73%;">
        <?php
        //get category
        $getCategory = "Select * from food_category";
        $getCategoryResult = mysqli_query($conn, $getCategory);        
        $getCategoryResultForProducts = mysqli_query($conn, $getCategory);
        while($row = mysqli_fetch_assoc($getCategoryResult)){   
                
            echo'<li class="nav-item"><a class="nav-link';
            if($row['id'] == 1){
             echo " active";
            }
            echo'" href="#'.$row['name'].'">'.$row['name'].'</a></li>';  
        }        
        ?>          
        </ul>
        <button class="nav-next arrow"><i class="fa fa-chevron-right"></i></button>
      </nav>
      </div>      
    </div>

    <div class="row">
        <div class="col-md-9">        
            <?php            
            while($detailrow = mysqli_fetch_assoc($getCategoryResultForProducts)){      
                $categoryId = $detailrow['id'];
                $totalItems = $detailrow['total_items'];                                
                echo'<section class="row my-4" id="'.$detailrow['name'].'">                
                <div class="col-md-12">
                <h3 class="category-title">'.$detailrow['name'].'</h3>
                <p class="no-of-items">'.$totalItems.' items</p>                                 
                </div>';
                 //get products
                $getProducts = "Select * from food_items where category_id = '$categoryId'";
                $getProductsResult = mysqli_query($conn, $getProducts);            
                 while($productrow = mysqli_fetch_assoc($getProductsResult)){
                     $itemId = $productrow['id'];
                    echo'<div class="col-md-5 mb-4"><li class="card">
                    <div class="card-body menu-item-list-no-image">
                        <div class="product-description-no-image">
                            <div class="product-text-part">
                                <div class="ptt">
                                    <p>'.$productrow['name'].'</p>
                                    <p class="small">'.$productrow['description'].'</p>
                                </div>
                                <div class="dish-card">
                                
                                <img class="food-image" src="https://img.sndimg.com/food/image/upload/q_92,fl_progressive,w_1200,c_scale/v1/img/recipes/86/66/6/pic6EgRr7.jpg">
                                 
                                </div>  
                            </div>
                                <div class="sub-cat">
                                <div class="price-product">';
                                    $getProductTypes = "Select * from food_type where item_id = '$itemId'";
                                    $getProductTypesResult = mysqli_query($conn, $getProductTypes);
                                    $types = "";
                                    while($getTypesRow = mysqli_fetch_assoc($getProductTypesResult)){                                         
                                        echo'<span>'.$getTypesRow['type'].'</span>
                                        <span class="new-price">Rs '.$getTypesRow['price'].'</span></br>';                                                                                                                
                                    }                                                                                                       
                                echo'</div>
                                <div class="add-price">                                                                     
                            <button type="button" class="btn btn-success toCart" id="toCart'.$itemId.'">
                                    To Cart
                                </button>                                                                                                     
                               </div>                                                         
                            </div>                                                                                              
                            </div>   
                            </div>        
                </li></div>';
                 }                                                                                
            echo'
            </section>';               
            }
            ?>                                                                                                                        
        </div>
        <div id="side-bar" class="col-md-3">       
                   <div class="card" id="shopping-cart">   
                       <div class="card-body">                           
                           <h2 class="cart-title">Your Cart</h2>
                           <p class="required" id="cart-count">0 items</p>
                           <hr>                                                       
                           <div class="card cart-items" id="cart-div">
                               <ul class="list-group list-group-flush" id="cart-items-list">   
                                   <?php
                                  

                                   ?>
                               </ul>
                           </div>    
                           <hr class="card-hr">                                                      
                          
                           <br>
                           <hr class="total-price-hr">
                              
                                   <!-- <div id="myDIV">
                                     <form class="form-inline promo-form" action="POST" id="apply-coupon" onsubmit="applyCoupon();return false;">
                                           <input type="hidden" name="csrfmiddlewaretoken" value="PVfNf7RX6My1NsU5MSmSsShYtlRgMGCWwXJoYMEzB0fGc6xlkTmHAYxHerricOsJ">
                                           <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="coupon-field" placeholder="Enter code" name="coupon" required="required">
                                               <div class="input-group-append">
                                                 <button class="btn promo-btn" type="submit">Apply</button>
                                               </div>
                                             </div>
                             
                                           </form>
                                  </div> -->
   
                           
                           <div class="code-display">
   
                               
                               <span style="width: 37%;" id="applied-code"> </span>
                               <span class="perct-code" id="discount-coupon"></span>
                              
                               
                           </div> 
                           
   
                            <hr>
                                <div class="check_email">
                                   <span>Enter your email to receive order updates.</span>
                                   <form>
                                       <input type="email" class="form-control" id="example_InputEmail" aria-describedby="emailHelp" placeholder="Enter email">
                                   </form>
                               </div>
                        <!-- Button to Open the Modal -->                                                                                    
                               <button class="btn btn-success mt-4" type="button" > Create Order &nbsp;&nbsp;<ion-icon name="arrow-forward-circle-outline" role="img" class="md hydrated" aria-label="arrow forward circle outline"></ion-icon></button> 
                               <p id="error-msg-min"></p>
                           
                               <p class="orderintext">
                                Send us
                               </p>
                       <!--                             
                           <button class="btn btn-success" type="button" onclick="messageError('1000.0');" id="proceed_to_order3" style="display:none;">Proceed to Order&nbsp;&nbsp;<ion-icon name="arrow-forward-circle-outline"></ion-icon></button> 
                           <button class="btn btn-success" type="button" data-toggle="modal" data-target="#checkoutModal" onclick="procced();" id="proceed_to_order4" style="display: none;">Proceed to Order&nbsp;&nbsp;<ion-icon name="arrow-forward-circle-outline"></ion-icon></button> 
                           -->
                       </div>
                   </div>                            
        </div>
    </div>       
    </div>


  <!-- Optional JavaScript; choose one of the two! -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <script>
    //   $(document).ready(function(){
    //     $(".nav-link").on("click", function(){
    //         $(".nav-item .nav-link").removeClass("active");
    //         $(this).addClass("active");
    //     });
    //   });
    $(document).ready(function(){

    $(".toCart").on("click", function(){
        //
        let elementid = $(this).attr("id");
        let itemid = elementid.split("toCart")[1];
        console.log(itemid);
        $.ajax({
           url: "addtocart.php",
           data: {"action":"add", "id": itemid},
           cache:false,
           method:"POST",
           success: function(result){
               let response = JSON.parse(result);
               console.log(response);
               if(response.statusCode == 200){
                console.log("added to cart");
                <?php
                // getCartItems($conn);
                ?>
               }
               else{

               }
           }
        });
    });

    getCartItems(){
      $.ajax({
        url:"getcartitem.php",
        action:{"getItems": "currentUser"},
        method:"POST",
        success: function(response){

        }
      });
    }

      scrollSection();

      function scrollSection(){
        const sections = document.querySelectorAll("section");
        const navLi = document.querySelectorAll("#menu-list li");

        window.onscroll = () => {
        var current = "";

        sections.forEach((section) => {
            
            const sectionTop = section.offsetTop;            
            if (pageYOffset >= sectionTop ) {
            current = section.getAttribute("id");      
            console.log("from section");
            console.log(current);
        }
        });

        navLi.forEach((li) => {    
           
            var getLink = $(li).children('.nav-link'); 
            var uniqueLink = ($(getLink).attr("href")).split("#")[1];            
            if (uniqueLink === current) {
                // remove all
                console.log("from li");
                console.log(uniqueLink);
                $(".nav-item .nav-link").removeClass("active");
                $(getLink).addClass("active");
            }           
        });
        };

      }

    });

  </script>


  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>