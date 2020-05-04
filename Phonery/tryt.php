<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost:3307", "root", "", "phonery");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security



$ID = $_POST['ID'];
$Name= $_POST['Name'];
$Price =$_POST['Price'];
 $quantity = $_POST['quantity'];
$Descriptin =$_POST['Descriptin'];
$code  =$_POST['code'];

$im  =$_POST['fileToUpload'];

// Attempt insert query execution

 $sql = "INSERT INTO products " .
                "(name,id,code,price,image,quantity,descreption) " . "VALUES ('$Name','$ID', '$code', ' $Price', ' $im ','$quantity', '$Descriptin')";

if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
    exit;
    
} else{
 //  echo "ERROR: Could not able to execute please try again";  
}
 
// Close connection
//mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<head>
 <title>Admin Add</title>
 <link rel="stylesheet" type="text/css" href="design.css">   
</head>

<body>
  <header>
         
       <div class="topnav">
         <ul>
           <li><a href="index.html">HOME</a></li>
           <li> <a href="login.php">LOG IN</a></li>
           <li> <a href="Products.php">PRODUCT</a></li>
           <li> <a href="Checkout.php">CHECKOUT</a></li>
           <li> <a class="active" href="Admin Main.html">ADMIN</a></li>
           <li> <a href="Contact us.html">CONTACT US</a></li>
            <li class="cart_div"><a href="cart.php"><img src="cart-icon.png"> <span></span></a></li>
         </ul>
       </div>
     </header>
<div class="container">
<li> <a class="active" href="Admin Add.php">GO Back To Add page </a></li>
</div>

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
