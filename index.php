<?php
 
 session_start();
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
		<li><a href="all_products.php">All 
		
		product</a></li>
		<!--<li><a href="customer/my_account.php">My Account</a></li>-->
		<li><a href="customer_register.php">Sign Up</a></li>
		<li><a href="cart.php">Shoping Cart</a></li>
		<li><a href="#">Contact Us</a></li>
	  </ul>
	    <form method="get" action="results.php" enctype="multipart/form-data">
	      <input type="text" name="user_query" placeholder="Search a product"/>
		  <input type="submit" name="search" value="Search">
		</form>
	</div>

	<!--content area start-->
    <div class="content_wrapper">
	<!--right content area start-->
	<div class="right">
	<?php cart(); ?>
		<div class="headline">
		 <div class="headline_content">
		 
		 <?php
		 if(!isset($_SESSION['customer_email'])){
			
				echo "<b>Welcome Guest!</b> <b style='color:red'>Shoping Cart</b>";
		 }
		 else{
			 
			 echo "<b>Welcome:". "<span style='color:skyblue'>" . $_SESSION['customer_email']. "</span>" ."</b>" . "<b style='color:green'>Your Shoping Cart- </b>";
		 }
		 
		 ?>
		 <span>- Total Items:- <?php items() ?> Total Price:<?php total_price() ?> - <a href="cart.php" style="color:red">Go to Cart</a>
			
			<?php
			
			if(!isset($_SESSION['customer_email'])){
			
			echo "<a href='checkout.php' style='color:#1A6708;'>login</a>";
			
			}
			else{
				echo "<a href='logout.php' style='color:#1A6708;'>logout</a>";
			}
			?>
			
		 </span>
		 </div>
		</div>
		
		<?php
		getUserIP();
		?>
		
		<div class="product_box">
		 <?php 
		 
		 getpro();
		 getCatpro();
		 getBrandpro();
		 		
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
    <div class="botom">
	
	<h1 style="color:#000;padding-top:30px;text-align:center;">&copy: 2017 - By www.IndoCraft.com</h1>
	
	</div>
   
   </div>
   
  </body>


</html>