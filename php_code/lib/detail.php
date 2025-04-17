<?php
		$res = ierg4210_fetchcat();
	$category  =	'<ul class = "nav">';
	$category .=	'<li><a href="./index.php">index</a></li>';
  $category .=	'<li><a href="./index.php?Category=news">News</a></li>';
	foreach ($res as $value){
		$category .= '<li><a href = "./index.php?Category='.$value["name"].'"> '.$value["name"].'</a></li>';
	}
	$category .=	'<li><a href="./index.php?Category=info">More Info.</a></li>';
	$category .= '</ul>';
	echo $category;

	$product = '<div class="productArea">';
	foreach ($det as $val){
	$product .= '<img src="medias/'.$val["pid"].'.jpg" alt="'.$val["name"].'" height="500px"></br>';
	$product .= '<h2>'.$val["name"].'</h2></br>';
	$product .= '<p>'.$val["description"].'</p></br>';
	$product .= '<p> price: '.$val["price"].'$</p>';
  	$product .= '</br><button onclick = "addtocart('.$val["pid"].')" class="styled">Add to cart</button></li></div>';
	}
	echo $product;


	
?>

