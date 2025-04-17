<?php
	$res = ierg4210_fetchcat();
	$category  =	'<ul class = "nav">';
	$category .=	'<li><a class="active" href="./index.php">index</a></li>';
  $category .=	'<li><a href="./index.php?Category=news">News</a></li>';
	foreach ($res as $value){
		$category .= '<li><a href = "./index.php?Category='.$value["name"].'"> '.$value["name"].'</a></li>';
	}
	$category .=	'<li><a href="./index.php?Category=info">More Info.</a></li>';
	$category .= '</ul>';

	echo $category;

	$res2 = ierg4210_cat_fetchproduct();
	$product = '<ul class = "product">';
	foreach ($res2 as $value){
    		$product .= '<li><a href = "./index.php?Category='.$value["pid"].'"><img src="medias/'.$value["pid"].'.jpg"> '.$value["name"].'</a>';
    		$product .= '</br><button onclick = "addtocart('.$value["pid"].')" class="styled">Add to cart</button></li>';

	}
	echo $product;
?>