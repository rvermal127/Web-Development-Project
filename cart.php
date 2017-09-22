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
	 <img src="banner11.jpg">
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
		 <span>- Total Items:- <?php items() ?> Total Price:<?php total_price() ?> - <a href="index.php" style="color:#5E0F00">Back to Shopping</a>
		 
		 <?php
			
			if(!isset($_SESSION['customer_email'])){
			
			echo "<a href='checkout.php' style='color:#BF2F05;'>login</a>";
			
			}
			else{
				echo "<a href='logout.php' style='color:#BF2F05;'>logout</a>";
			}
			?>
		 
		 </span>
		 </div>
		</div>
		
		<?php
		getUserIP();
		?>
		
		<div class="product_box">
		 <form action="cart.php" method="post" enctype="multipart/form-data">
		 <table width="740" align="center" bgcolor="#7B68EE">
		 
		 <tr align="center">
		 <td><b>Remove</b></td>
		 <td><b>Products(s)</b></td>
		 <td><b>Quantity</b></td>
		 <td><b>Total Price</b></td>
		 </tr>
		 
		<?php
		  $ip_add=getUserIP();
		  $total=0;
		  
		  $sel_price="select * from cart where ip_add='$ip_add'";
		  $run_price=mysqli_query($db,$sel_price);
		  while($record=mysqli_fetch_array($run_price)){
			  $pro_id=$record['p_id'];
			  $pro_price="select * from products where product_id='$pro_id'";
			  $run_pro_price=mysqli_query($con,$pro_price);
			  while($p_price=mysqli_fetch_array($run_pro_price)){
				  
				  $product_price=array($p_price['product_price']);
				  $product_title=$p_price['product_title'];
				  $product_image=$p_price['product_img1'];
				  $only_price=$p_price['product_price'];
			      
				  $values=array_sum($product_price);
				  $total +=$values;
			  
		  
	    ?>
		 
		 <tr>
		 <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id?>"></td>
		 <td><?php echo $product_title;?><br><img src="admin_area/product_images/<?php echo $product_image; ?>" heigh="80" width="80"></td>
		 <td><input type="text" name="qty" value="" size="3"></td>
		 <?php 
		    if(isset($_POST['update']))
			{
				
				$qty=$_POST['qty'];
				$insert_qty="update cart set qty='$qty' where ip_add='$ip_add'";
				$run_qty=mysqli_query($con,$insert_qty);
				$total=$total*$qty;
			}	 
		 
		 ?>
		 
		 <td><?php echo $only_price;?></td>
		 </tr>
		 <?php }}?>
		 
		 <tr>
		 
		 <td colspan="3" align="right"><b>Sub Total:</td>
		 <td><b><?php echo $total; ?></b></td>
		 </tr>
		 <tr></tr>
		 <tr>
		 <td colspan="2"><input type="submit" name="update" value="Update Cart"/></td>
		 <td><input type="submit" name="continue" value="Continue Shopping"/></td>
		 <td><button><a href="checkout.php">Checkout</a></button></td>
		 </tr>
		 
		 </table>
		</form>
		<?php 
		function updatecart(){
			global $con;
		if(isset($_POST['update']))
		 {
			 foreach($_POST['remove'] as $remove_id)
      		 {
		    	 $delete_products="delete from cart where p_id='$remove_id'";
				 $run_delete=mysqli_query($con, $delete_products);
				 if($run_delete)
				 {
					 echo "<script>window.open('cart.php','_self')</script>";
				 }
	
		     }
			
			
			
		 }
		 if(isset($_POST['continue']))
				 {
					 echo "<script>window.open('index.php','_self')</script>";
				 }
		
		
		}
		echo @$up_cart=updatecart();//@ use for active and inactive
		
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