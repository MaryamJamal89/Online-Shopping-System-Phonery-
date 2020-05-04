<!DOCTYPE html>
<?php
session_start();
	$status="";
if (isset($_SESSION['shopping_cart'])){
	$coupon=array('10','15','20');
	$total_price=0;
	$total_price2=0;
	$code=0;

	if (isset(($_POST['action'])) && ($_POST['action']=="update")){
		if (preg_match("/\b[1-2][0-9]\b/",$_POST['enter_coupon'])){
		$code = $_POST['enter_coupon'];
		settype($code,"double");
		}else{
			$status = "<div style='color:red;'>
			Not valid coupon!</div>";
			$code=0;
		}
	}
}
?>

<html>
<head>
	<meta charset = "utf-8">
	<title>Checkout</title>
	 <link rel="stylesheet" type="text/css" href="design.css">   

</head>

<body>
	<!--header-->
	<header>
	<div class="topnav">
         <ul>
           <li><a  href="index.html">HOME</a></li>
           <li> <a href="login.php">LOG IN</a></li>
           <li> <a href="Products.php">PRODUCT</a></li>
           <li> <a class="active" href="Checkout.php">CHECKOUT</a></li>
           <li> <a href="Admin Main.html">ADMIN</a></li>
           <li> <a href="Contact us.html">CONTACT US</a></li>
            <li class="cart_div"><a href="cart.php"><img src="cart-icon.png"> <span></span></a></li>
         </ul>
       </div>
     </header>
	<!--enter a coupon-->
	<div class="container2">
		<h2>CHECKOUT</h2>
		<section>
			<p class="box">
			<form method='post' action='' >
				<label>HAVE A COUPON?</label>
				<input type="text" name="enter_coupon" placeholder="Enter the coupon"/>
				<input type='hidden' name='action' value="update" />
				<button type="submit">Apply Coupon</button>
				<?php echo $status; ?>
			</form>
			</P>

			<p class="box">
				<label>CLIENT LOGIN</label>
			</p>

			<p class="box">
				<label>BILLING DETAILS</label>
			</p>

			<p class="box">
				<label class="hover">SHIPPING ADDRESS </label>
			</p>
		</section>
	</div>
		<!--view shopping cart to pay-->
	<div>
		<aside>
		<?php
if(isset($_SESSION["shopping_cart"])){
?>	

		<table class="table" border="1">
		<tbody>
		<tr>
		<td></td>
		<td><strong>ITEM NAME</strong></td>
		<td><strong>QUANTITY</strong></td>
		<td><strong>UNIT PRICE</strong></td>
		<td><strong>ITEMS TOTAL</strong></td>
		</tr>	
		<?php		
		foreach ($_SESSION["shopping_cart"] as $product){
		?>
		<tr>
		<td><img src='<?php echo $product["image"]; ?>' width="50" height="40" /></td>
		<td><?php echo $product["name"]; ?><br />
		</td>
		<td>
		<?php echo $product["quantity"]?>
		</td>
		<td><?php echo "$".$product["price"]; ?></td>
		<td><?php echo "$".$product["price"]*$product["quantity"]; ?></td>
		</tr>
		<?php
		$total_price += ($product["price"]*$product["quantity"]);
		$total_price2 = ( (1-($code/100))* $total_price );
		}
		?>
		
		<tr>
		<td colspan="5" align="right"> <strong>Coupon: <?php echo $code;?> %<strong>
		</td>
		</tr>
		<tr>
		<td colspan="5" align="right">
		<strong>PRICE: <?php echo "$".$total_price;?></strong>
		</td>
		</tr>
		<tr>
		<td colspan="5" align="right">
		<strong>TOTAL: <?php echo "$".$total_price2; ?></strong>
		</td>
		</tr>
		</tbody>
		</table>
	
  <?php
}else{
	echo "<h3>Your cart is empty!</h3>";
	}
?>
			<p>
				<!--pay-->
				<label  style="margin-top:6px;">PAYMENT METHOD</label>
					<label>
						<input name="PAYMENT" type="radio" value="Cash on Delivery" checked>Cash on Delivery</label>
						<label>
							<input name="PAYMENT" type="radio" value="Via Paypal">Via Paypal</label>
							<p>
								<img src="imgs/601545.png" width="100%" height="100%">
						
			</p>			
				<button id="b2" onclick="window.location.href = 'destroy.php'">Continue</button>			
			<p>
		</aside>
	</div>
	<footer>
			</p>
			</p>
         <h6>&copy; 2020 by Phonery 
            All Rights Reserved.<h6>
         <address>
            Contact us at <a href = "mailto:phonery@gmail.com">
            phonery@gmail.com</a>
         </address>
    </footer> 
	</body>
</html>
