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
	<!--	<li><a href="customer/my_account.php">My Account</a></li>-->
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
		 <b>Welcome Guest!</b>
		 <b style="color:red ;">Shopping Cart</b>
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
		<div>
		
		<form action="customer_register.php" method="post" enctype="multipart/form-data">
		
		<table width="750" align="center" bgcolor="BC8F8F">
		
		<tr align="center">
			<td colspan="5"><h2>Create an Account</h2></td>
		</tr>
		
		<tr>
			<td align="right"><b>Customer Name</b></td>
			<td><input type="text" name="c_name" required/></td>
		</tr>
		
		<tr>
			<td align="right"><b>Customer Email</b></td>
			<td><input type="email" name="c_email" required/></td>
		</tr>
		
		<tr>
			<td align="right"><b>Customer Password</b></td>
			<td><input type="password" name="c_pass" required/></td>
		</tr>
		
		<tr>
			<td align="right"><b>Customer Country</b></td>
			
			<td>
			
			<select name="c_country">
			
			<option>Select a Country</option>
				<option>India</option>
				<option>United state</option>
				<option>United kindom</option>
				<option>China</option>
				<option>Pakistan</option>
				<option>Afganistan</option>
				<option>Saudi Arab</option>
				<option>Japan</option>
				<option>Iran</option>
			
			</select>
			
			</td>
		</tr>
		
		<tr>
			<td align="right"><b>Customer City</b></td>
			<td><input type="text" name="c_city" required/></td>
		</tr>
		
		<tr>
			<td align="right"><b>Customer Mobile no</b></td>
			<td><input type="text" name="c_contact" required/></td>
		</tr>
		
		<tr>
			<td align="right"><b>Customer Address</b></td>
			<td><input type="text" name="c_address" required/></td>
		</tr>
		
		<tr>
			<td align="right"><b>Customer Image</b></td>
			<td><input type="file" name="c_image" required/></td>
		</tr>
		
		
		<tr align="center">
		
		<td colspan="5"><input type="submit" name="register" value="Submit"/></td>
		
		</tr>
		
		</table>
		
		</form>
		
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
   
   <!-- email validation-->
   
   <?php

	if(isset($_POST['c_email'])==true && empty($_POST['c_email'])==false){
  if(!filter_var($c_email, FILTER_VALIDATE_EMAIL) == false) {
    echo("$email is a valid email address");
    } 
 else {
    echo("$email is not a valid email address");
     }
	}
?>
   
   
  </body>


</html>

<?php 
if(isset($_POST['register'])){
	
	$c_name=$_POST['c_name'];
	$c_email=$_POST['c_email'];
	$c_pass=$_POST['c_pass']; 
	$c_country=$_POST['c_country'];
	$c_city=$_POST['c_city'];
	$c_contact=$_POST['c_contact'];
	$c_address=$_POST['c_address'];
	$c_image=$_POST['c_image']['name'];
	$c_image_tmp = $_FILE['c_image']['tmp_name'];
	
	$c_ip=getUserIP();
	
	$insert_customer = "insert into customers (customer_name,customer_email,customer_pass,customer_country,customer_city,
	customer_contact,customer_address,customer_image,customer_ip) values('$c_name','$c_email','$c_pass','$c_country','$c_city',
	'$c_contact','$c_address','$c_image','$c_ip')";
	
	$run_customer=mysqli_query($con,$insert_customer);
	move_uploaded_file($c_image_tmp,"customer/customer_photos/$c_image");
	//move_uploaded_file($c_image_tmp,"C:\xampp\htdocs\myshop\customer\customer_photos\$c_image");
	
	$sel_cart="select * from cart where ip_add='$c_ip'";
	$run_cart=mysqli_query($con, $sel_cart);
	$check_cart=mysqli_num_rows($run_cart);
	
	if($check_cart>0){
	
		$_SESSION['customer_email']=$c_email;
		
		echo"<script>alert('Account created successfully, Thank you!')</script>";
		echo "<script>window.open('checkout.php','_self')</script>";
		
		}
		else{
		$_SESSION['customer_email']=$c_email;
		
        echo"<script>alert('Account created successfully, Thank you!')</script>";		
		echo "<script>window.open('index.php','_self')</script>";
	
	    } 

  }

?>

