<?php
 
 include("include/db.php");
 include("function/functions.php");
 ?>
<html>
<title>myshop</title>
 <head>
  <link rel="stylesheet" href="styles/style.css" media="all" />
 </head>
  <body>
  <!--main content start-->
   <div class="main_wrapper">
    <div class="header_wrapper">
	 <a href="index.php"><img src="banner11.jpg"></a>
	<!-- <img src="logo1.jpg">-->
	</div>
    <div class="navbar">
	  <ul class="menu">
		<li><a href="index.php">Home</a></li>
		<li><a href="all_products.php">All product</a></li>
		<li><a href="customer/my_account.php">My Account</a></li>
		<li><a href="customer_register.php">Sign Up</a></li>
		<li><a href="cart.php">Shoping Cart</a></li>
		<li><a href="#">Contact Us</a></li>
	  </ul>
	    <form method="get" action="result.php" enctype="multipart/form-data">
	      <input type="text" name="user_query" placeholder="Search a product"/>
		  <input type="submit" name="search" value="Search">
		</form>
	</div>

	<!--<div style="text-align:center">
      <span class="dot"></span> 
      <span class="dot"></span> 
      <span class="dot"></span> 
    </div>-->
    <!--content area start-->
    <div class="content_wrapper">
	<!--right content area start-->
	<div class="right">
		<div class="headline">
		 <div class="headline_content">
		 <b>Welcome Guest!</b>
		 <b style="color:red ;">Shopping Cart</b>
		 <span>- Items:- Price:</span>
		 </div>
		</div>
		
		<div class="product_box">
		 <?php 
		 
		  $get_products="select * from products";
		 
		  $run_products=mysqli_query($con,$get_products);
		  
		  while($row_products=mysqli_fetch_array($run_products)){
			  
			  $pro_id=$row_products['product_id'];
			  $pro_title=$row_products['product_title'];
			  $pro_cat=$row_products['cat_id'];
			  $pro_brand=$row_products['brand_id'];
			  $pro_desc=$row_products['product_desc'];
			  $pro_price=$row_products['product_price'];
			  $pro_image=$row_products['product_img1'];
			  
			  echo "
			  <div id='single_product'>
			  <h3>$pro_title</h3>
			  
			  <img src='admin_area/product_images/$pro_image' width='180' height='180' /><br>
			  <p><b>price: $pro_price </b></p>
			  <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
			  <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to Cart</botton></a>
			  </div>
			  ";
		   }
		 
		 		
		 ?>
		</div>
		
	</div>
	<!--right content area end-->
	<!--left content area start-->
	<div class="left">
	<div class="sidebar_title"> Categories</div>
	   <ul class="cats">
	      
		  <?php getcats();?>
		  
	   </ul>
	   <div class="sidebar_title"> Brand</div>
	     <ul class="cats">
	        <?php getbrands();?>
	   </ul>
	</div>
	<!--left content area end-->
	
	</div>
	<!-- content area end-->
    <div class="botom">bottom area</div>
   </div>
   
  </body>


</html>