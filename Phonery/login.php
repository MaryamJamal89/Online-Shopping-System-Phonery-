<!DOCTYPE html>

<?php

session_start();
if ($_SERVER['REQUEST_METHOD']=='POST'){
	if (isset($_SESSION['FullName']))
		{
		$_SESSION = array(); // 
	session_destroy(); // 
	setcookie ('PHPSESSID', '', time()-3600, '/', '', 0, 0);
	}
$msg='';
    if (isset($_POST["submitBtn"])) {
		
        $id = $_POST["ID"];
        $pass = $_POST['pass'];
        $query = "SELECT userid FROM admin WHERE userid='$id' AND password='$pass'";
        // Connect to MySQL open members database
        if (!( $database = mysqli_connect("localhost:3307", "root", "", "phonery") ))
            die("<p>Could not connect to database</p>");
        // insert query in students database
        if (!( $result = mysqli_query($database, $query) )) {
            print( "<p>Could not execute query!</p>");
            die(mysqli_error($database));
        } // end if
        if (mysqli_num_rows($result) == 1) {
            // Fetch the record:
            $row = mysqli_fetch_row($result);
            //$name = $row[0];
           
			//session_start();
			$_SESSION['FullName']=$row[1]; 
			$name=$_SESSION['FullName'];
			$msg = "<p>Thank you ..'$name'   !</p>";
			header('location: Admin Main.html');
			exit;
        } 
        else {
            $msg = "<p>Thank you.. No Information was found  !</p>";
        }
        mysqli_close($database);
    } else
	{  $msg = "<p>No Data is submitted  !</p>";
print("<h4 class='modal-content'>$msg</h4>");}}
    ?>

<html>
   <head>
      <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Log in</title>
      <script src = "members.js"></script>
  <link rel="stylesheet" type="text/css" href="design.css">   
  </head>
   
     
</head>

<body>
   <header>
	<div class="topnav">
         <ul>
           <li><a  href="index.html">HOME</a></li>
           <li> <a class="active" href="login.php">LOG IN</a></li>
           <li> <a href="Products.php">PRODUCT</a></li>
           <li> <a href="Checkout.php">CHECKOUT</a></li>
           <li> <a href="Admin Main.html">ADMIN</a></li>
           <li> <a href="Contact us.html">CONTACT US</a></li>
            <li class="cart_div"><a href="cart.php"><img src="cart-icon.png"> <span></span></a></li>
         </ul>
       </div>
     </header>

  
      <form id = "myForm" method="post" action = "login.php">
         <p ><label>ID:</label>
            <input type = "text" id =  "userid" name="ID" 
               placeholder = "Enter your ID"></p>
         <p><label>Password:</label>
            <input type = "password" id = "userpass" name = "pass"
               placeholder = "Enter your password"></p>
        
         <p><button name = "submitBtn" id = "submitID" type = "submit">submit</button> 
            <button id = "reset" type = "reset" value="cancel">cancel</button>
			</p>


			
      </form>
      <div id = "helpText"></div>
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


