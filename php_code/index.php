<?php
require __DIR__.'/src/db.inc.php';

if(isset($_GET['Category']) AND !empty($_GET['Category'])){
	$Cat = $_GET['Category'];
}else{
	$Cat = "main";}

include('lib/header.php');
if(intval($Cat)!=0){
	$item = intval($Cat);
	$det = ierg4210_fetch_item($item);
	include('lib/detail.php');
}
else{
switch($Cat){
	case 'main':
		include('lib/main.php');
		break;
	case 'info':
		include('lib/info.php');
		break;
	case 'news':
		include('lib/news.php');
		break;
	case 'Boardgames':
		$item = ierg4210_cat_fetchitems(1);
		include('lib/item.php');
		break;
	case 'Accessories':
		$item = ierg4210_cat_fetchitems(2);
		include('lib/item.php');
		break;
	default:
		include('lib/notFound.php');
		break;
}
}

include('lib/footer.php');
?>