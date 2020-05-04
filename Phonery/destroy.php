<!DOCTYPE html>
<?php 

 $count=1;
 $total=0; 
 $order=0;
 $index=0;
$totalArray= array();
$orderArray= array();

session_start();

if(isset($_SESSION["shopping_cart"])){
	
	require ('mysqli_connection.php');
	$_SESSION['count'] = 1;
	$flag=false;
	if(isset($_SESSION["shopping_cart"])){
		foreach ($_SESSION["shopping_cart"] as $product){
		$q=$product["quantity"];
		$name=$product["name"];
		$query= "UPDATE products set quantity= quantity - '".$q."' WHERE name ='".$name."' ";
		if($result=mysqli_query($dbc,$query)){
			$flag=true;
			}else{
				header('location: Checkout.php?problem=Querycouldntbeexecuted');
				$flag=false;
				die(mysqli_error($dbc));
				}					
								
		}	
	}
	if ($flag)
	{
		echo 'Your Purchase has been added successfully .. Thank you :)';
	}else{
		echo 'Uncessfull purchase';
	}
							
	
	echo '<table border="1" align="center"> <caption> Order#'.$count.'</caption>';
    echo '<tr><th> </th><th>Product Name</th><th>Quantity</th><th>Price</th></tr>';

	foreach ($_SESSION["shopping_cart"] as $product){
		
	$quantity=$product["quantity"];	
	$proprice=$product["price"]*$quantity;
	$total+=$proprice;
	
$orderArray[$index][$order]= array("name"=>$product["name"],
						"image"=>$product["image"],
						"price"=>$proprice,
						"quantity"=>$product["quantity"]);
	
	$_COOKIE["shopping_cart"]= $orderArray[$index][$order];
	

echo '<tr><td><img src='.$_COOKIE["shopping_cart"]["image"].' width="50" height="70"></td><td>'.$_COOKIE["shopping_cart"]["name"].'</td><td>'.$_COOKIE["shopping_cart"]["quantity"].'</td><td>'.$_COOKIE["shopping_cart"]["price"].'$</td></tr>';




/*
setcookie('proname', serialize($nameArray), time()+3600, '/', '', 0, 0);
setcookie('quantity', serialize($quantityArray), time()+3600, '/', '', 0, 0);	
setcookie('proprice', serialize($priceArray), time()+3600, '/', '', 0, 0);
setcookie('proimg', serialize($imageArray), time()+3600, '/', '', 0, 0);
setcookie('count', $count, time()+3600, '/', '', 0, 0);
*/

++$index;
}
    	echo '<tr><td colspan=4>Total price = '.$total.'$</td></tr></table>';

if(empty($_COOKIE["shopping_cart"])) 
$_COOKIE["shopping_cart"] = $orderArray[$index];
    
$totalArray[$index]= array($total);
setcookie('total', serialize($totalArray), time()+3600, '/', '', 0, 0);	
setcookie('order', serialize($orderArray), time()+3600, '/', '', 0, 0);

$_SESSION = array();
}




/*
$i=0;
	for ($j=1; $j<= count($_COOKIE) ; $j++){
	echo '<table border="1" align="center"> <caption> Order#'.$j.'</caption>';
	echo '<tr><th> </th><th>Product Name</th><th>Quantity</th><th>Price</th></tr>';
			for ($i; $i<$index ; ++$i){
                
                echo '<tr><td><img src='.$_COOKIE["shopping_cart"]["image"].' width="50" height="70"></td><td>'.$_COOKIE["shopping_cart"]["name"].'</td><td>'.$_COOKIE["shopping_cart"]["quantity"].'</td><td>'.$_COOKIE["shopping_cart"]["price"].'$</td></tr>';
                
			/*echo '<tr><td><img src='.$_COOKIE[["order"][$i]["image"]].' width="50" height="70"></td><td>'.$_COOKIE[["order"][$i]['name']].'</td><td>'.$_COOKIE[["order"][$i]['quantity']].'</td><td>'.$_COOKIE[["order"][$i]['price']].'$</td></tr>';
			}

}

*/

?>
	
</tbody>
</table>
<html>
<head>
	<meta charset = "utf-8">
	<title>Purchase History</title>
	<link rel="stylesheet" type="text/css" href="design.css"> 
</head>
<body>

	<!--header-->
	<header>

		<div class="topnav">
			<ul>
				<li><a href="index.html">HOME</a></li>
           <li> <a href="login.php">LOG IN</a></li>
           <li> <a href="Products.php">PRODUCT</a></li>
           <li> <a href="Checkout.php">CHECKOUT</a></li>
           <li> <a href="Admin Main.php">ADMIN</a></li>
           <li> <a href="Contact us.html">CONTACT US</a></li>
            <li class="cart_div"><a href="cart.php"><img src="cart-icon.png"> <span></span></a></li>
			</ul>
		</div>
	</header>
</body>
    <footer>
 <h6>&copy; 2020 by Phonery 
  All Rights Reserved.<h6>
   <address>
    Contact us at <a href = "mailto:phonery@gmail.com">
    phonery@gmail.com</a>
  </address>
</footer>  
</html>