

<?php
session_start();
include('mysqli_connection.php');
$status="";
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
	'quantity'=>$quantity,
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
 <title>Product Details</title>
 
    <link rel="stylesheet" type="text/css" href="design.css">  
    <style type="text/css">
html, body {
  height: 100%;
  width: 100%;
  margin: 0;
  font-family: 'Roboto', sans-serif;
    
}
    html {
  font-family: Arial, Helvetica, sans-serif;
}
        

.container {
  max-width: 1100px;
  margin: 8000;
  padding: 50px;
  display: flex;
  margin-left: 200px;
}

/* Columns */
.left-column {
  width: 100%;
  position: relative;
}

.right-column {
  width: 150%;
  margin-top: 70px;
}

.right-col {
  width: 70%;
  margin-top: 10px;
}



/* Left Column */
.left-column img {
  width: 10%;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
  transition: all 0.3s ease;
}

.left-column img.active {
  opacity: 1;
}


/* Right Column */

/* Product Description */
.product-description {
  border-bottom: 1px solid #E1E8EE;
  margin-bottom: 20px;
}
.product-description span {
  font-size: 12px;
  color: #358ED7;
  letter-spacing: 1px;
  text-transform: uppercase;
  text-decoration: none;
}
.product-description h1 {
  font-weight: 300;
  font-size: 52px;
  color: #43484D;
  letter-spacing: -2px;
}
.product-description p {
  font-size: 16px;
  font-weight: 300;
  color: #86939E;
  line-height: 24px;
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}
/* Product Configuration */
.product-color span,
.cable-config span {
  font-size: 14px;
  font-weight: 400;
  color: #86939E;
  margin-bottom: 20px;
  margin-left: 100px;
  display: inline-block;
}

/* Product Color */
.product-color {
  margin-bottom: 30px;
}

.color-choose div {
  display: inline-block;
}

.color-choose input[type="radio"] {
  display: none;
}

.color-choose input[type="radio"] + label span {
  display: inline-block;
  width: 40px;
  height: 40px;
  margin: -1px 4px 0 0;
  vertical-align: middle;
  cursor: pointer;
  border-radius: 50%;
}

.color-choose input[type="radio"] + label span {
  border: 2px solid #FFFFFF;
  box-shadow: 0 1px 3px 0 rgba(0,0,0,0.33);
}

.color-choose input[type="radio"]#red + label span {
  background-color: #C91524;
}
.color-choose input[type="radio"]#blue + label span {
  background-color: #314780;
}
.color-choose input[type="radio"]#black + label span {
  background-color: #323232;
}

.color-choose input[type="radio"]:checked + label span {
  background-image: url(images/check-icn.svg);
  background-repeat: no-repeat;
  background-position: center;
}

/* Cable Configuration */
.cable-choose {
  margin-bottom: 20px;
}

.cable-choose button {
  border: 2px solid #E1E8EE;
  border-radius: 6px;
  padding: 13px 20px;
  font-size: 14px;
  color: #5E6977;
  background-color: #fff;
  cursor: pointer;
  transition: all .5s;
}

.cable-choose button:hover,
.cable-choose button:active,
.cable-choose button:focus {
  border: 2px solid #86939E;
  outline: none;
}

.cable-config {
  border-bottom: 1px solid #E1E8EE;
  margin-bottom: 20px;
}

.cable-config a {
  color: #358ED7;
  text-decoration: none;
  font-size: 12px;
  position: relative;
  margin: 10px 0;
  display: inline-block;
}
.cable-config a:before {
  content: "?";
  height: 15px;
  width: 15px;
  border-radius: 50%;
  border: 2px solid rgba(53, 142, 215, 0.5);
  display: inline-block;
  text-align: center;
  line-height: 16px;
  opacity: 0.5;
  margin-right: 5px;
}

/* Product Price */
.product-price {
  display: flex;
  align-items: center;
    
}
   .topnav {
          top:0px;
          left:0px:
          position: relative;
          overflow: hidden;
          background-color:  #45b39d;
          position: fixed;
          width:100%;
          z-index: 1;
        } 
    

.product-price span {
  font-size: 26px;
  font-weight: 300;
  color: #43474D;
  margin-right: 20px;
}
.product-prices{
  font-size: 26px;
  font-weight: 300;
  color: #43474D;
  margin-right: 4px;
margin-left: 50px;
    right: -100px;
}

.product-pricesss{
  font-size: 26px;
  font-weight: 300;
  color: burlywood;
  margin-right: 4px;
     margin-left: 78px;
     margin-top: 10px;
}

.cart-btn {
  display: inline-block;
  background-color: #7DC855;
  border-radius: 6px;
  font-size: 16px;
  color: #FFFFFF;
  text-decoration: none;
  padding: 12px 30px;
  transition: all .5s;
    margin-left: 43.5% ;
}

.topnav {
          top:0px;
          left:0px:
          position: relative;
          overflow: hidden;
          background-color:  #45b39d;
          position: fixed;
          width:100%;
          z-index: 1;
        }

.cart-btnrr {
  display: inline-block;
  background-color: darkgrey;
  border-radius: 6px;
  font-size: 16px;
  color: #FFFFFF;
  text-decoration: none;
  padding: 12px 30px;
  transition: all .5s;
  margin-left: -50px;
 
}

.cart-btnrrr {
  display: inline-block;
  background-color: darkkhaki;
  border-radius: 6px;
  font-size: 16px;
  color: #FFFFFF;
  text-decoration: none;
  padding: 12px 30px;
  transition: all .5s;
    margin-left: 10% ;
}
.cart-btn:hover {
  background-color: #64af3d;
    
}
       span img{
        position: absolute;
            
            left: 400px;
            top: 330px;
            
        }
        .numberFormat{position: static;
            right: 100px;
            bottom: 7px;
        }

/* Responsive */
@media (max-width: 940px) {
  .container {
    flex-direction: column;
    margin-top: 60px;
  }

  .left-column,
  .right-column {
    width: 100%;
  }

  .left-column img {
    width: 300px;
    right: 0;
    top: -65px;
    left: initial;
  }
    
}

@media (max-width: 535px) {
  .left-column img {
    width: 220px;
    top: -85px;
  }
}
        .buy{
            position: relative;
            left:150px;
        }

</style>
    <script>
    function help(){alert("Design Guide: All products displayed are in iphone 11 PRO size only. ");}
    function addToCart(){alert("Items have been added to your cart. Thanks for shopping with Phonery.")}
    </script>
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
 <form method="post" action="" >
      <?php
              if(isset($_GET['pro_id'])){
                  $product_id= $_GET['pro_id'];
                  $get_product = "select * from products where id=$product_id";
                  $run_product = mysqli_query($dbc,$get_product);
                  $row_product = mysqli_fetch_array($run_product);
                  
                  $pro_img= $row_product['image'];
                   $pro_name = $row_product['name'];
                   $pro_price = $row_product['price'];
                   $pro_desc = $row_product['descreption'];
                   $pro_quantity= $row_product['quantity'];
                    $pro_code=$row_product['code'];
            
              }
      echo "
    <main class='container'>

   
      <div >
     
        <img data-image='red' class='active' src='$pro_img' style=width:300px;height:500px;margin-top=100px;>
                <div class=product-prices>
         
            <a href='Products.php' class='cart-btnrr'>Go BACK SHOPPING</a>
              
        </div>
      </div>
   


      <!-- Right Column -->
      <div class='right-column'>

        <!-- Product Description -->
        <div class='product-description'>
             <div class='cable-config'>
          <span><strong><h2>$pro_name<h2><strong></span>
                 </div>
         
          <p>$pro_desc</p>
          
        </div>

        <!-- Product Configuration -->
        <div class='product-configuration'>

          <!-- Product Color -->
   

          <!-- Cable Configuration -->
          <div class='cable-config'>
           
              <label > <span ><strong>$pro_price</strong></span></label>
              
              <div id='field1'><span><strong>quantity</strong> </span>
              <input type='hidden' id='transferQuantity' value=''>
    <input class='numberFormat' type='number' id='id1' value='1' min='1' max='$pro_quantity' onchange='myFunction()' required />
    <p id='demo'></p>
    <br>
    <span><img src='imgs/info.png' class='btn btn-primary' data-toggle='modal' data-target='#myModal' style='background-color:white; border-color:white' onclick=''></span>
          <br>   


  <!-- The Modal -->
  <div class='modal' id='myModal'>
    <div class='modal-dialog'>
      <div class='modal-content'>
      
        <!-- Modal Header -->
        <div class='modal-header'>
          <h4 class='modal-title'> Desgin Info</h4>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class='modal-body'>
        All products displayed are in iphone 11 PRO size only.
        <img src='imgs/help.png' style='width:400px'>
        </div>
        
        <!-- Modal footer -->
        <div class='modal-footer'>
        </div>
        
      </div>
    </div>
  </div>

<script>
function myFunction() {
  var inpObj = document.getElementById('id1');
  if (!inpObj.checkValidity()) {
    document.getElementById('demo').innerHTML = inpObj.validationMessage;
  } else {
    document.getElementById('demo').innerHTML = '';
  } 
} 
</script>
    
   
</div>

  
                  
        
          </div>
        </div>
        
        <div class='product-price'>
           <input type='hidden' name='code' value='$pro_code' />
			  <button type='submit' class='buy' onclick='addToCart()'> Add to cart</button>
              
        </div>

          
      
           <div class='product-pricesss'>
         
           
              
        </div>
           
    
      </div>
        
    </main>

    <!-- Scripts -->

  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'>
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js'></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'></script>
         ";
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
 