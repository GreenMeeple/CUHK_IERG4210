<?php
require __DIR__.'/db.inc.php';

$Cat = $_GET['pid'];

$item = intval($Cat);
$det = ierg4210_fetch_item($item);

foreach ($det as $array){
echo json_encode($array);
}

?>

