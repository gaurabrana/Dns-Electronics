<?php
include('database/connect.php');

?>
<div class="sidebar" data-color="purple" data-background-color="white" data-image="assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo"><a href="" class="simple-text logo-normal">
          My Account 
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          
          <li class="nav-item <?php if($active == "dashboard"){echo'active';}?>">
            <a class="nav-link" href="dashboard.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item <?php if($active == "profile"){echo'active';}?>">
            <a class="nav-link" href="user.php">
              <i class="material-icons">person</i>
              <p>User Profile</p>
            </a>
          </li>
          <li class="nav-item <?php if($active == "orders"){echo'active';}?>">
            <a class="nav-link" href="myorders.php">
              <i class="material-icons">archive</i>
              <p>Orders</p>
            </a>
          </li>
          <li class="nav-item <?php if($active == "payment"){echo'active';}?>">
            <a class="nav-link" href="mypayments.php">
              <i class="material-icons">paid</i>
              <p>Payments</p>
            </a>
          </li>
          <li class="nav-item <?php if($active == "address"){echo'active';}?>">
            <a class="nav-link" href="addressbook.php">
              <i class="material-icons">library_books</i>
              <p>Address Book</p>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="../products.php">
              <i class="material-icons">shop_two</i>
              <p>Back to shopping</p>
            </a>
          </li>                    
        </ul>
      </div>
    </div>
    <script>
      <?php

      ?>
    </script>