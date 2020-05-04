<?php
session_start();
$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
	foreach($_SESSION["shopping_cart"] as $key => $value) {
		if($_POST["code"] == $key){
		unset($_SESSION["shopping_cart"][$key]);
		$status = "<div class='box' style='color:red;'>
		Product is removed from your cart!</div>";
		}
		if(empty($_SESSION["shopping_cart"]))
		unset($_SESSION["shopping_cart"]);
			}		
		}
}
//siham
if (isset($_POST['action']) && $_POST['action']=="delete"){
if(!empty($_SESSION["shopping_cart"])) {
	foreach($_SESSION["shopping_cart"] as $key => $value) {
		unset($_SESSION["shopping_cart"][$key]);
		$status = "<div class='box' style='color:red;'>
		All items are removed from your cart!</div>";
			}
    if(empty($_SESSION["shopping_cart"]))
		unset($_SESSION["shopping_cart"]);
		}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as &$value){
    if($value['code'] === $_POST["code"]){
        $value['quantity'] = $_POST["quantity"];
        break; // Stop the loop after we've found the product
    }
}
  	
}



?>
<html>
<head>
<title>Shopping Cart</title>
<link rel='stylesheet' href='design.css' type='text/css'/>
<style type='text/css'>
    .product_wrapper {
	float:left;
	padding: 10px;
	text-align: center;
	}
.product_wrapper:hover {
	box-shadow: 0 0 0 2px #e5e5e5;
	cursor:pointer;
	}
.product_wrapper .name {
	font-weight:bold;
	}
.product_wrapper .buy {
	text-transform: uppercase;
    background: #F68B1E;
    border: 1px solid #F68B1E;
    cursor: pointer;
    color: #fff;
    padding: 8px 40px;
    margin-top: 10px;
}
.product_wrapper .buy:hover {
	background: #f17e0a;
    border-color: #f17e0a;
}
.message_box .box{
	margin: 10px 0px;
    border: 1px solid #2b772e;
    text-align: center;
    font-weight: bold;
    color: #2b772e;
	}
.table td {
	border-bottom: #F0F0F0 1px solid;
	padding: 10px;
    background-color: white;
	}
.cart_div {
	float:right;
	font-weight:bold;
	position:relative;
   
    
	}
.cart_div a {
	color:#000;
	}	
.cart_div span {
	font-size: 12px;
    line-height: 14px;
    background: #F68B1E;
    padding: 2px;
    border: 2px solid #fff;
    border-radius: 50%;
    position: absolute;
    top: -1px;
    left: 13px;
    color: #fff;
    width: 14px;
    height: 13px;
    text-align: center;
	}
.cart .remove {
    background: none;
    border: none;
    color: #0067ab;
    cursor: pointer;
    padding: 0px;
	}
    
.cart .remove:hover {
	text-decoration:underline;
	}</style>

</head>
<body>
   <header>
	<div class="topnav">
         <ul>
           <li><a  href="index.html">HOME</a></li>
           <li> <a href="login.php">LOG IN</a></li>
           <li> <a href="Products.php">PRODUCT</a></li>
           <li> <a href="Checkout.php">CHECKOUT</a></li>
           <li> <a href="Admin Main.html">ADMIN</a></li>
           <li> <a href="Contact us.html">CONTACT US</a></li>
            <li class="active" class="cart_div"><a href="cart.php"><img src="cart-icon.png"> <span></span></a></li>
         </ul>
       </div>
     </header>
    
<div style="width:700px; margin:50 auto;">
<br><br>
<h2>Welcome to the Shopping Cart</h2>   

<?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>
<div class="cart_div">
<a href="cart.php">
<img src="cart-icon.png" /> Cart
<span><?php echo $cart_count; ?></span></a>
</div>
<?php
}
?>

<div class="cart">
<?php
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
?>

<table class="table" border="1" id="tableID">
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
<form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="remove" />
<button type='submit' class='remove'>Remove Item</button>
</form>
</td>
<td>
<form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="change" />
<select name='quantity' class='quantity' onchange="this.form.submit()">
<option <?php if($product["quantity"]==1) echo "selected";?> value="1">1</option>
<option <?php if($product["quantity"]==2) echo "selected";?> value="2">2</option>
<option <?php if($product["quantity"]==3) echo "selected";?> value="3">3</option>
<option <?php if($product["quantity"]==4) echo "selected";?> value="4">4</option>
<option <?php if($product["quantity"]==5) echo "selected";?> value="5">5</option>
</select>
</form>
</td>
<td><?php echo "$".$product["price"]; ?></td>
<td><?php echo "$".$product["price"]*$product["quantity"]; ?></td>
</tr>
<?php
$total_price += ($product["price"]*$product["quantity"]);
}
?>
<tr>
<td colspan="5" align="right">
<strong>TOTAL: <?php echo "$".$total_price; ?></strong>
</td>
</tr>
</tbody>
</table>
    
 <form method='post' action='Checkout.php'>
<button onclick="myFunction()">Checkout</button>
    </form>
    
    <form method='post' action=''>
<input type='hidden' name='action' value="delete" />
<button type="submit" name="remove_btn">Remove all</button>
    </form>
    
    <script>
function myFunction() {
    var time = new Date().getTime();
  var x = document.getElementById("tableID");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
    alert("Thank you for shopping with Phonery!");
}
</script>
    
  <?php
}else{
	echo "<h3>Your cart is empty!</h3>";
	}
?>

</div>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>



</div>
</body>
    <br><br>
    <br><br>
     <footer>
   <h6>&copy; 2020 by Phonery 
       All Rights Reserved.</h6>
     <address>
      Contact us at <a href = "mailto:phonery@gmail.com">
      phonery@gmail.com</a>
    </address>
  </footer> 
</html>