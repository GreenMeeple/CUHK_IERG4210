<?php
	$res = ierg4210_fetchcat();
	$category  =	'<ul class = "nav">';
	$category .=	'<li><a href="index.php">index</a></li>';
  $category .=	'<li><a href="/index.php?Category=news">News</a></li>';
	foreach ($res as $value){
		if($value["name"] == $Cat)
			$category .= '<li><a class="active" href = "/index.php?Category='.$value["name"].'"> '.$value["name"].'</a></li>';
		else 		$category .= '<li><a href = "/index.php?Category='.$value["name"].'"> '.$value["name"].'</a></li>';
	}
	$category .=	'<li><a href="/index.php?Category=info">More Info.</a></li>';
	$category .= '</ul>';

	echo $category;


	$product = '<ul class = "product">';
	foreach ($item as $val){
    		$product .= '<li><a href = "/index.php?Category='.$val["pid"].'"><img src="medias/'.$val["name"].'.jpg"> '.$val["name"].'</a>';
    		$product .= '</br><button onclick = "addtocart('.$val["pid"].')" class="styled">Add to cart</button></li>';
	}
	$product .= '</ul>';
	echo $product;
?>