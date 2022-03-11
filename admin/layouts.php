 <!--**********************************
            Nav header start
        ***********************************-->
        <?php
        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION['adminemail'])){
            echo'<script>window.location.href="login.php"</script>';
        }
        ?>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <div class="nav-header">
            <div class="brand-logo">
                <a href="index.php">
                    <b class="logo-abbr"><img src="images/logored.png" alt=""> </b>
                    <span class="logo-compact"><img src="images/logored.png" alt=""></span>
                    <span class="brand-title">
                        <img width="150px" height="80px"src="images/logored.png" alt="">
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>                
                <div class="header-right">
                    <ul class="clearfix">                        
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="images/user/1.png" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile   dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>                                                                              
                                        <li><a href="./logout.php"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                    <li>
                        <a href="./" aria-expanded="false">                        
                            <i class="far fa-analytics menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>                        
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">                        
                            <i class="fas fa-store-alt menu-icon"></i><span class="nav-text">Products</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./listproducts.php"><i class="fas fa-stream"></i>All Products</a></li>
                            <li><a href="./addproducts.php"><i class="fas fa-plus"></i>Add Product</a></li>                                                                                                            
                        </ul>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">                        
                            <i class="fas fa-users menu-icon"></i><span class="nav-text">Customers</span>
                        </a>
                        <ul aria-expanded="false">
                        <li><a href="./retailcustomers.php"><i class="fas fa-users-cog"></i>Retail Customers</a></li>
                            <li><a href="./wholesalecustomers.php"><i class="fas fa-store"></i>Wholesale Customers</a></li>
                            <li><a href="./membership.php"><i class="fas fa-store"></i>Membership Packages</a></li>
                        </ul>
                    </li>  
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">                        
                        <i class="fas fa-clipboard-list"></i><span class="nav-text">Orders</span>
                        </a>
                        <ul aria-expanded="false">                            
                            <li><a href="./listorders.php"><i class="fas fa-stream"></i>All Orders</a></li>
                            <li><a href="./ongoingorders.php"><i class="fas fa-person-carry"></i>Ongoing Orders</a></li>
                            <li><a href="./completedorders.php"><i class="fal fa-clipboard-check"></i>Completed Orders</a></li>
                            <li><a href="#"><i class="fas fa-times-circle"></i>Failed Orders</a></li>
                            <li><a href="#"><i class="fas fa-undo-alt"></i>Returns</a></li>
                            <li><a href="./trackorder.php"><i class="fas fa-times-circle"></i>Track Orders</a></li>
                        </ul>
                    </li> 
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">                        
                        <i class="fas fa-money-check menu-icon"></i><span class="nav-text">Payments</span>
                        </a>
                        <ul aria-expanded="false">                            
                            <li><a href="./payments.php"><i class="fas fa-money"></i>All Payments</a></li>
                            <li><a href="./updatepayment.php"><i class="fas fa-money-check-edit-alt"></i>Update Payment</a></li>                            
                        </ul>
                    </li>   
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">                        
                        <i class="fas fa-star"></i><span class="nav-text">Ratings/Queries</span>
                        </a>
                        <ul aria-expanded="false">                            
                            <li><a href="./productrating.php"><i class="fas fa-star-exclamation"></i>Product Rating</a></li>
                            <li><a href="./productqueries.php"><i class="fas fa-question-square"></i>Product Queries</a></li>                            
                        </ul>
                    </li> 
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">                        
                            <i class="fas fa-envelope menu-icon"></i><span class="nav-text">Messages from users</span>
                        </a>
                        <ul aria-expanded="false">                            
                            <li><a href="./messagefromuser.php"><i class="fas fa-users-cog"></i>Contact Us Page</a></li>                                                        
                        </ul>
                    </li>                              
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->