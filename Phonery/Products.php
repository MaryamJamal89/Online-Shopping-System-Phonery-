<?php
session_start();
include('mysqli_connection.php');
$status="";
global $cart_count;

if (isset($_POST['code']) && $_POST['code']!=""){
$code = $_POST['code'];
$result = mysqli_query($dbc,"SELECT * FROM `products` WHERE `code`='$code'");
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$code = $row['code'];
$price = $row['price'];
$image = $row['image'];
$quantity = $row['quantity'];   
$descreption=$row['descreption'];

$cartArray = array(
	$code=>array(
	'name'=>$name,
	'code'=>$code,
	'price'=>$price,
	'quantity'=>1,
	'image'=>$image,
    'descreption'=>$descreption)
);

if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"] = $cartArray;
	$status = "<div class='box'>Product is added to your cart!</div>";
}else{
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(in_array($code,$array_keys)) {
		$status = "<div class='box' style='color:red;'>
		Product is already added to your cart!</div>";	
	} else {
	$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
	$status = "<div class='box'>Product is added to your cart!</div>";
	}

	}
}
?>
<!DOCTYPE html>


<html>
<head>
  <meta charset="utf-8">
    
  <title>Products</title>

  <link rel="stylesheet" type="text/css" href="design.css">   

    </head>
    
    <body>

      <header>
	<div class="topnav">
         <ul>
           <li><a  href="index.html">HOME</a></li>
           <li> <a href="login.php">LOG IN</a></li>
           <li> <a class="active" href="Products.php">PRODUCT</a></li>
           <li> <a href="Checkout.php">CHECKOUT</a></li>
           <li> <a href="Admin Main.html">ADMIN</a></li>
           <li> <a href="Contact us.html">CONTACT US</a></li>
            <li class="cart_div"><a href="cart.php"><img src="cart-icon.png"> <span></span></a></li>
         </ul>
       </div>
     </header>
         
     <h1>Products</h1>
<?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>
<div class="cart_div">
<a href="cart.php"><img src="cart-icon.png" /> Cart<span><?php echo $cart_count; ?></span></a>
</div> 
<?php
}

$result = mysqli_query($dbc,"SELECT * FROM `products`");
while($row = mysqli_fetch_assoc($result)){
    $pro_id=$row['id'];
		echo "<div class='card'>
         <form method='post' action=''>
			  <input type='hidden' name='code' value=".$row['code']." />
              <a href='details.php?pro_id= $pro_id'>
                   <img src='".$row['image']."' width='35%'></a>
			  <div class='name'>".$row['name']."</div>
		   	  <div class='price'>$".$row['price']."</div>
              <p>".$row['descreption']."</p>
			  <button type='submit' class='buy'>Buy Now</button>
			  </form>
    
           </div>
        ";
        }
mysqli_close($dbc);
?>

        </form>
        
      </body>

  <footer>
   <h6>&copy; 2020 by Phonery 
       All Rights Reserved.</h6>
     <address>
      Contact us at <a href = "mailto:phonery@gmail.com">
      phonery@gmail.com</a>
    </address>
  </footer> 

  </html>