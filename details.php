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
	 <img src="banner11.jpg">
	<!-- <img src="logo1.jpg">-->
	</div>
    <div class="navbar">
	  <ul class="menu">
		<li><a href="index.php">Home</a></li>
		<li><a href="all_products.php">All product</a></li>
		<li><a href="my_account.php">My Account</a></li>
		<li><a href="user_register.php">Sign Up</a></li>
		<li><a href="cart.php">Shoping Cart</a></li>
		<li><a href="contact.php">Contact Us</a></li>
	  </ul>
	    <form method="get" action="results.php" enctype="multipart/form-data">
	      <input type="text" name="user_query" placeholder="Search a product"/>
		  <input type="submit" name="search" value="Search">
		</form>
	</div>
	<!--
 <div class="slideshow-container">

 <div class="mySlides fade">
    <div class="numbertext">1 / 3</div>
    <img src="img1.jpg" style="width:100%">
    <div class="text">Caption Text</div>
 </div>

 <div class="mySlides fade">
    <div class="numbertext">2 / 3</div>
    <img src="img2.jpg" style="width:100%">
    <div class="text">Caption Two</div>
 </div>

 <div class="mySlides fade">
    <div class="numbertext">3 / 3</div>
    <img src="img3.jpg" style="width:100%">
    <div class="text">Caption Three</div>
 </div>

  </div>
  <br>

 <div style="text-align:center">
   <span class="dot"></span> 
   <span class="dot"></span> 
   <span class="dot"></span> 
 </div>

 <script>
   var slideIndex = 0;
   showSlides();

 function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
       slides[i].style.display = "none";  
    }
     slideIndex++;
    if (slideIndex> slides.length) {slideIndex = 1}    
     for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
    setTimeout(showSlides, 3000); // Change image every 3 seconds
 }
 </script>  
 -->
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
		 
		 if(isset($_GET['pro_id'])){
			 $product_id=$_GET['pro_id'];
		 $get_products="select * from products where product_id='$product_id'";
		 
		  $run_products=mysqli_query($db,$get_products);
		  
		  while($row_products=mysqli_fetch_array($run_products)){
			  
			  $pro_id=$row_products['product_id'];
			  $pro_title=$row_products['product_title'];
			  $pro_cat=$row_products['cat_id'];
			  $pro_brand=$row_products['brand_id'];
			  $pro_desc=$row_products['product_desc'];
			  $pro_price=$row_products['product_price'];
			  $pro_image1=$row_products['product_img1'];
			  $pro_image2=$row_products['product_img2'];
			  $pro_image3=$row_products['product_img3'];
			  
			  echo "
			  <div id='single_product'>
			  <h3>$pro_title</h3>
			  
			  <!--<img src='admin_area/product_images/$pro_image1' width='180' height='180' />-->
			  <img src='admin_area/product_images/$pro_image1' width='250' height='250' /> 
			 <!-- <img src='admin_area/product_images/$pro_image1' width='250' height='250' /><br> -->
			  
			  <p><b>price:$pro_price </b></p>
			  
			  <p>$pro_desc</p>
			  
			  <a href='index.php' style='float:left;'>Go Back</a>
			  
			  <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to Cart</botton></a>
			  </div>
			  ";
		   }
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