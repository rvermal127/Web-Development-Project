<!DOCTYPE html>
<html>
    <head>
	  <title>Payment option</title>
	</head>
<body>
<?php
include("include/db.php");
 

?>
<div align="center" style="padding:20px;">
<h2> Payment Option for You</h2>
<?php
$ip=getUserIP();
$get_customer="select * from customers where customer_ip='$ip'";
$run_customer=mysqli_query($con,$get_customer);

$customer=mysqli_fetch_array($run_customer);

$customer_id=$customer['customer_id'];

?>
<b>Pay with online</b><img src="paypal.jpg" width="200" height=""300><b> or <a href="order.php?c_id=<?php echo $customer_id;?>">Pay Offline</a></b><br><br>

<b> if you selected "pay offline" option then plesae check your email or find out the invoice No for your order</b>


</div>
</body>
</html>