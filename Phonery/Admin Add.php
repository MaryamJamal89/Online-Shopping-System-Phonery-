<!DOCTYPE html>

<html>
<head>
 <title>Admin Page</title>
 <link rel="stylesheet" type="text/css" href="design.css">   
</head>

<body>
    

    
    <script>
        

        
      function validateForm()
        {
   var x = document.forms["myForm"]["ID"].value;
   var y = document.forms["myForm"]["Name"].value;
   var z = document.forms["myForm"]["Price"].value;
   var d = document.forms["myForm"]["Descriptin"].value;
   var f = document.forms["myForm"]["code"].value;
            var i = 100;
            
  if (x == ""||y == ""||z == ""||d == ""||f == ""||g == "") {
    alert("All fields must be filled out");
  
}
  if(typeof x !== i){
	 alert("ID should contain only numbers");
  }
            if(typeof z !== i){
	 alert("price should contain only numbers");
  }
    //                if(typeof f !== i){
	// alert("code should contain only numbers");
 // }
            
            
    return false;
      }
      </script>
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
<form  name="myForm" method= "post"  action ="tryt.php" > 
  <h2>MANAGER ADD PRODUCT</h2>
  <p>Please fill following information<br>
      
 
   <label>ID</label> <input type="text" required pattern='[0-9]' maxlength="200" name = "ID"  autofocus/>
	  <label>Name</label> <input type="text" required pattern='[a-z]+' name = "Name"  autofocus/>
      <label>Price</label> <input type="text" required pattern='[0-9]+' name = "Price"  autofocus/>
	 
	 
		  <label>Descriptin</label> <input type="text" required name = "Descriptin"  autofocus/>
      	  <label>code</label> <input type="text" required  name = "code" autofocus/>
       <label>quantity</label> <input type="text" required pattern='[0-9]+' name = "quantity"   autofocus/>

 </p>
    
    
   <input  type="file" name="fileToUpload" id="fileToUpload">
        
   
 
 
   
 <button  type="submit"  name="subm"  onclick="validateForm()"class="button" >continue </button>
 

</form>
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
    
    
 