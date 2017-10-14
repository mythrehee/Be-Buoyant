<!DOCTYPE html>
<html>
<head>
<!-- link to external cascading style sheet ------>
	<link type="text/css" rel="stylesheet" href="Bebuoyant.css"/>
	<title>Be Buoyant-products List</title>
</head>

<body>
<header>
<!--ribbon at the top of the page ------>
	<div></div>
	<br/><br/>
	 <!--Company name "BBuoyant" ------>
	<img id="title" src="http://zenit.senecac.on.ca/~uli705_171a12/assign4/images/title.png" alt="title"/> 
	<h1>Product List &nbsp;</h1> 
</header>

	<nav class="tabs">
	<!--link to home and contact pages ------>
		<h3><a href="http://zenit.senecac.on.ca/~uli705_171a12/assign4/assign4.html"> Home </a> ||
		<a href="http://zenit.senecac.on.ca/~uli705_171a12/assign4/products.html">Products </a> ||
		<a href="http://zenit.senecac.on.ca/~uli705_171a12/assign4/contact.html">Contact Us </a></h3> 		
	</nav>
	<br/>
	<form class="tabs" action=displayprod.php method="POST"><br />
    <input type="submit" name="products" value="Display Products Table"/>
	<input type = "button" name="Add" value = "Add Product" onclick="location.href='http://zenit.senecac.on.ca/~uli705_171a12/assign4/add.php'"/>
	<input type = "button" value = "Delete Product" onclick="location.href='http://zenit.senecac.on.ca/~uli705_171a12/assign4/delete.php'"/>
    </form>
	<br />
	<form class="tabs" action=addproduct.php method="POST" onsubmit="return validate()" ><br/>
	<label for="name">Product Name :</label>
	<input type="text" name="name" id="name"  />&nbsp; 
	<label for="code">Product Code :</label>
	<input type="text" name="code" id="code" placeholder="6 digit number"/>&nbsp; 
	<label for="price">Price :</label>
	<input type="text" name="price" id="price" placeholder="Float upto 2 decimal places" />&nbsp; 
	<label for="qty">Quantity :</label>
	<input type="text" name="quantity" id="quantity" placeholder="Cannot be a float value" />
	<br /><br />
	 <input type="submit" name="add" value="Add Product" />
	 <input type="reset" name="reset" value="Reset"/>
	 <form/><br /><br />
	 <script type="text/javascript">
	 function validate(){
		 var n = name();
		 var c = validate();
		 var p = price();
		 var q = qty();
		
		 if (n== true && c == true && p  == true && q==true ){
			 return true;
		 }
		 else 
			 return false;
		 
	 function name(){
		 var pname = document.getElementById("name").value;	
         if(  pname.length == 0||pname==null || pname=="" ){
			 alert("You have not entered anything.Please enter valid Product name."); 
			 return false;
		 }	
		 else 
			if(/^[0-9]+/.test(pname)){
		 alert("The product name cannot start with a digit."); 
		 return false;
		 }
		 return true;
	 }
		 
 function validate(){
		 var pcode = document.getElementById("code").value;
		 if(  pcode.length == 0||pcode==null || pcode==""){
			 alert("You have not entered anything.Please enter valid Product code."); 
			 return false;
		 }	
		 else
			 if(!/^[0-9]{6}$/.test(pcode)){
					alert("Entered product code is invalid.It Should be a 6 digit number!");
					return false;
				} 
		else if(/^[0]{6}$/.test(pcode)){
			alert("Entered product code is invalid.It cannot be 000000!");
					return false;
			
		}
		return true;
		 }
	
	
	function price(){
		 var pprice = document.getElementById("price").value;
		  if(  pprice.length == 0||pprice ==null || pprice == "" ){
			 alert("You have not entered anything.Please enter valid Product price."); 
			 return false;
		 }	
		 else
			if(!/^[0-9]+([.][0-9])?[0-9]?$/.test(pprice)){
			alert("Invalid.Price should be float with 2 decimals!");
			return false;
			} 
			return true;
	 }
	 function qty(){
		 var qty = document.getElementById("quantity").value;
		  if(  qty.length == 0||qty ==null || qty == "" ){
			 alert("You have not entered anything.Please enter valid Product quantity."); 
			 return false;
		 }	
		 else if(!/^[0-9]+$/.test(qty)){
			  alert("You have not entered a valid Product quantity.It should be an integer"); 
			 return false;
		 }
		 return true;
	 }
	 }
	</script>
<?php
    $name=$_POST['name'];
	$pic="\"http://zenit.senecac.on.ca/~uli705_171a12/assign4/images/products/soon.JPG\"";
	$code=$_POST['code'];
	$price=$_POST['price'];
	$quantity=$_POST['quantity'];
	$host="db-mysql.zenit";
	$db_user="uli705_171a12";
	$db_password="hcGX4864"; 
	$database="uli705_171a12";
	$dbh=mysql_connect($host,$db_user,$db_password);
	mysql_select_db($database);
	$result = mysql_query("INSERT INTO BBproducts(name ,pathname ,code ,price ,quantity) VALUES ('$name','$pic', '$code','$price','$quantity')");
	if ($result == 1)
	echo "<h2>The product was added successfully!</h2>";
	else
		echo "<h2>The product code already exists!</h2>";
?>
<?php
 $host="db-mysql.zenit";
 $db_user="uli705_171a12";
 $db_password="hcGX4864"; 
 $database="uli705_171a12";
 $query="select * from BBproducts"; 

 $dbh=mysql_connect($host,$db_user,$db_password);

 mysql_select_db($database);

 $result=mysql_query($query, $dbh);
 echo "<table border=\"3\" cellpadding=\"3\" cellspacing=\"0\">";

 $result = mysql_query($query, $dbh);
 if ($myrow = mysql_fetch_array($result))
 {
  echo "<tr><th>S No.</th><th>Product Name</th><th>Product Code</th><th>Price</th><th>Quantity</th> </tr>\n";
 do
 {
 printf("<tr><td>%s</td><td>%s <br /><img src=%s/></td><td>%s</td><td>$%s</td><td>%s</td></tr>\n",$myrow[0],$myrow[1],$myrow[2],$myrow[3],$myrow[4],$myrow[5]);
 }
 while ($myrow = mysql_fetch_array($result));
 }
 else
 echo "The table is empty";
 echo "</table>";
?>
	<!--Product List ------>
<br />
<footer>
<!--Company Address ------>
    <img id="footertitle" src="http://zenit.senecac.on.ca/~uli705_171a12/assign4/images/title.png" alt="title"/>
    <h3 >Company Address:</h3>	
	<p class="contact">
	Be Buoyant Canada,<br/>
	81 Gerry Fitzgerald Drive, <br/>
	North York,<br/>
	M3J 3N4.<br/>
	Telephone:+(647)-554-1318.
	</p><br/>
	<!--Copyright info ------>
	<p class="contact">&nbsp;Copyright&copy;2017, Mythrehee Himachalapathy</p>
</footer>
</body>
</html>