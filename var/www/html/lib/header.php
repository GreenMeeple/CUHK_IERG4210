<?php	

$header  =	<<<EOD
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="/src/StyleSheet.css">
		<script src="/src/cart.js"></script>
	</head>
	<body onload = "refreshcart();">
	<header>
		<div class="flex">
			<div class="flexbanner">
				<a href="index.php"><img src="medias/Banner.jpg" alt="banner"></a>
			</div>
			<div>
				<h1>Welcome!</h1>
			</div>
			<div class="dropdown">
				<button class="dropbtn">Shopping cart</button>
				<div class="dropdown-content">
					<p id="ajax" class = "carttext"></p>
					<button id=checkout class="checkout" onclick="alert('No, you cannot pay me!')"></button>
				</div>
			</div>
		</div>
	</header>
EOD;
echo $header;

?>
