<?php

	$res = ierg4210_fetchcat();
	$category  =	'<ul class = "nav">';
	$category .=	'<li><a href="./index.php">index</a></li>';
  $category .=	'<li><a class="active" href="./index.php?Category=news">News</a></li>';
	foreach ($res as $value){
		$category .= '<li><a href = "./index.php?Category='.$value["name"].'"> '.$value["name"].'</a></li>';
	}
	$category .=	'<li><a href="./index.php?Category=info">More Info.</a></li>';
	$category .= '</ul>';

	echo $category;

$News = <<<EOD
<div>
  <article>
	<h2>Recent News</h2>
	<a href = "https://boardgamegeek.com/boardgame/329591/ultimate-railroads"><img height=500px src="medias/ultimaterailroads.jpg"></a>
		<h2>Behold, the Ultimate Railroads!</h2>
		<p>Almost 8 years after the publication of Russian Railroads, Ultimate Railroads will be published in 2021.</p>
		<p>The expert Game Russian Railroads takes us back to the late Tsardom, where we build our tracks through Siberia, to Saint Petersburg or Kiev. At the same time, however we have to bring forth the industrialization and improve our engineers&rsquo; skills.</p>
		<p>Ultimate Railroads allows an all-encompassing access to this worker placement game.
			<br>The base game, Russian Railroads, won the Deutscher Spiele Preis of 2014.
			<br>Also fans will get their money&rsquo;s worth through the considerable content, which includes all expansions (also mini- and promo-expansions).
		<br>&nbsp;</p>
		<p><strong>The Big Box includes:</strong></p><p>Russian Railroads</p>
		<p><strong>Expansions:</strong><br>German Railroads, American Railroads, Asian Railroads</p>
		<p><strong>Mini-Expansions:</strong><br>New Engineers (DSP), Juri Dreigleisky, Manufactory Train, Solo-variant<br>&nbsp;</p>
		<p><strong>Designer</strong>: Helmut Ohley &amp; Leonhard Orgler<br><strong>Illustration</strong>: Martin Hoffmann &amp; Claus Stephan</p>  
	</article>
</div>
EOD;
	echo $News;
?>