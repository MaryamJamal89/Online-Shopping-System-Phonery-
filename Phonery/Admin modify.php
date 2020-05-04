<?php
session_start();
include('mysqli_connection.php');

$name ="";
$code = "";
$price = "";
$image = "";
$quantity = "";   
$descreption="";
$id=0;	 

function getId(){
global $id;
return $id;
}
function setId(){
$GLOBALS['id']=$_POST["searchID"];
}



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset = "utf-8">
	<title>Admin Page</title>
	<link rel="stylesheet" type="text/css" href="design.css"> 
	<script type="text/javascript" src = "admin modify.js"></script>  
</head>
<body>
	<header>
		<div class="topnav">
			<ul>
				<li><a href="index.html">HOME</a></li>
				<li> <a  href="login.php">LOG IN</a></li>
				<li> <a  href="Products.php">PRODUCT</a></li>
				<li> <a href="Checkout.php">CHECKOUT</a></li>
				<li><a class="active" href="Admin Main.html">ADMIN</a></li>
           <li> <a href="Contact us.html">CONTACT US</a></li>
            <li class="active" class="cart_div"><a href="cart.php"><img src="cart-icon.png"> <span></span></a></li>
			</ul>
		</div>
	</header>
	<div class="container">
		<h2>MANAGER MODIFY PRODUCT</h2>
		<p>Please enter the product ID to search it</p>
		<form method = "post" action = "ADMIN MODIFY.php" id = "searchForm">
			<label>ID:</label>
			<input type="text" id = "searchID" name = "searchID" /> 
			<input type="submit" id = "searchBtn" name = "searchBtn" value = "SEARCH PRODUCT" float right>
			<br>

</form>

<div>
	<?php
	if (isset($_POST['searchBtn'])){
		
		$id =$_POST['searchID'];
		$_SESSION['id'] = $id;
		//$id = $_POST['searchID'];
		//echo $id;
		$searchQuery = "SELECT * FROM products WHERE id = $id";

		if ( !( $result = mysqli_query($dbc, $searchQuery) ) ) 
		{
			print( "<p>Could not execute query!</p>" );
			die( mysqli_error($dbc) . "</body></html>" );
		}

		$row = mysqli_fetch_assoc($result);
		if($result) {
			$name = $row["name"];
			$code = $row["code"];
			$price = $row["price"];
			$image = $row["image"];
			$quantity = $row['quantity'];   
			$descreption=$row['descreption'];
		}
	}			
	?>
	<!--display content on the form-->
	<form method = "post" id = "productForm"> 
		<label>Name: </label>
		<input type="text" name = "name" id = "name" value = "<?php echo $name; ?>">
		<label>Code:</label>
		<input  type="text" name = "code" id = "code"  value="<?php echo $code; ?>">
		<label>Price:</label>
		<input  type="text" name = "price" id = "price"  value="<?php echo $price; ?>">
		<label>Quantity:</label>
		<input  type="text" name = "quantity" id = "quantity" value = "<?php echo $quantity; ?>">
		<label>Descriptin:</label>
		<input  type="text" name = "descreption" id = "descreption" value = "<?php echo $descreption; ?>">
		<label>Product Image:</label>
		<input class = "add" type="file" id = "chooseFile" name="imgFile">
		<div class = "image-preview" id = "imagePreview">
			<img src = "<?php echo $image; ?>" name = "image" alt = "Product's image" class = "image-preview__image" >
			<span class="image-preview__default-text">Product</span>
			<!---loading the product image from file-->
			<script>
				const inpFile = document.getElementById("chooseFile");
				const previewCon = document.getElementById("imagePreview");
				const previewImg = previewCon.querySelector(".image-preview__image");
				const previewDefTxt = previewCon.querySelector(".image-preview__default-text");

				inpFile.addEventListener("change", function() {
					const file = this.files[0];

					if (file){
						const reader = new FileReader();

						previewDefTxt.style.display = "none";
						previewImg.style.display = "block";

						reader.addEventListener("load", function(){
							previewImg.setAttribute("src", this.result);
						});

						reader.readAsDataURL(file);
					}
					else{
						previewDefTxt.style.display = null;
						previewImg.style.display = null;
                //if searched, display image from db
            }
        });

    </script>
</div>
<input type="submit" id = "deleteBtn" name = "deleteBtn" value = "DELETE PRODUCT">  
<input type="submit" id = "modifyBtn" name = "modifyBtn" value = "MODIFY PRODUCT">
</form>


<?php

//$id = $_POST['searchID'];

					//if user clicked modify.. the values in the text fields will be modifying
if (isset($_POST['modifyBtn'])){
	//echo $_SESSION['id'];
	$id=$_SESSION['id'];
print("test".$id);
	$name = $_POST["name"];
	$code = $_POST["code"];
	$price = $_POST["price"];
	$image = $_POST["imgFile"];
	$quantity = $_POST["quantity"];   
	$descreption=$_POST["descreption"];


/*$updateQuery ="UPDATE products SET" .
                "(id,name,code,price,image,quantity,descreption) " . "VALUES ('$id','$name', '$code', ' $price', ' $image ','$quantity', '$descreption')";*/
	$updateQuery = "UPDATE products
	SET name=".$name.", 
	code=".$code.",
	price=".$price.",
	quantity=".$quantity.",
	descreption=".$descreption.",
	WHERE id= $id";

	if (mysqli_query($dbc, $updateQuery)) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . mysqli_error($dbc);
	}
}

//$id = $_POST['searchID'];

if (isset($_POST['deleteBtn'])){
	//$id=getId();
//	$id = $_POST['searchID'];
	echo $_SESSION['id'];
	$id=$_SESSION['id'];
	$dltQuery = "DELETE FROM products WHERE id = $id";
	if (mysqli_query($dbc, $dltQuery)) {
		
		echo "Record deleted successfully";
	} else {
		echo "Error deleting record: " . mysqli_error($dbc);
	}

}
mysqli_close($dbc);
?>

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