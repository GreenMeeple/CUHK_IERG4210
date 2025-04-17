<?php

	$res = ierg4210_fetchcat();
	$category  =	'<ul class = "nav">';
	$category .=	'<li><a href="./index.php">index</a></li>';
  $category .=	'<li><a href="./index.php?Category=news">News</a></li>';
	foreach ($res as $value){
		$category .= '<li><a href = "./index.php?Category='.$value["name"].'"> '.$value["name"].'</a></li>';
	}
	$category .=	'<li><a class="active" href="./index.php?Category=info">More Info.</a></li>';
	$category .= '</ul>';

	echo $category;
$Info = <<<EOD
<ul class="info">
	<li><a href = "https://greenmeeple.github.io/"><img src="medias/5.jpg" height=320px width=320px></a>
	<li><a href = "https://play.google.com/store/apps/details?id=com.czechgames.tta&hl=en&gl=US"><img src="medias/tta.png" </a>
	<li><a href = "https://www.instagram.com/cuhk_board_game/"><img src="medias/bgsoc.png"></a>
</ul>

<div>
  <article>
		<div>
		<h2>About this Shop</h2>
		<p>This shop is created by Li Chun Ngai, Alex.(SID: 1155110647)</p>
		<p>This shop is only for IERG4210, any features and functions here are only for testing.</p>

		<h2>Uber diesen Shop</h2>
		<p>Dieser Shop wurde von Li Chun Ngai, Alex, erstellt. (SID: 1155110647)</p>
		<p>Dieser Shop ist nur fur IERG4210, alle Features und Funktionen hier dienen nur zum Testen.</p>
		</div>

		<h2>What is Boardgame?</h2>
		<p>A modern board game often has a board, tokens, rules of the game, and most importantly, a story. But some games have no tiles or a board. 
				For example the werewolves, they have no game board and they are a typical American board game.</p>
		<p>Almost every board game we've played are American games. For example Dixit and Monopoly, these games need communication. 
				And these games are fun even if you lose. On the other hand, the German game is more strategic. It has complicated rules of the game. 
				So it takes more time. But it's wonderful when you win.</p>

    <h2>Was ist ein Brettspiel?</h2>
    <p>Ein modernes Brettspiel hat oft ein Spielbrett, Spielsteine, eine Spielregel, 
				und am wichtigsten eine Geschichte. Aber einige Spiele haben keine Spielsteine oder kein Spielbrett. 
				Zum beispiel die Werwoelfe, sie hat kein Spielbrett und sie ist ein Typisch amerikanisches Brettspiel.</p>
    <p>Fast jedes Brettspiele, das wir gespielt haben, sind amerikanische Spiele. Zum Beispiel Dixit und Monopoly, 
				diese Spiele brauchen Kommunikation. Und diese Spiele machen Spass, auch wenn du verlierst. Deutsches Spiel ist dagegan strategischer. 
				Es hat kompliziert Spielregel. Deshalb braucht es mehr Zeit. Aber es ist wunderbar, wenn man gewinnt.</p>
  </article>
</div>
EOD;
	echo $Info;
?>