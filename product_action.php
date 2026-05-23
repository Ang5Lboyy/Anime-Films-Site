<?php 
include 'products.php';
$user = new Products();
if(isset($_GET['update'])){
	$user->update($_GET['update'], [
		'title'=>$_POST['title'],
		'description'=>$_POST['description'],
		'price'=>$_POST['price'],
		'image'=>$_POST['image'],

]);}
elseif(isset($_GET['id'])){
	$user->delete($_GET['id']);

}else{
$user->insert([
	'title'=>$_POST['title'],
	'description'=>$_POST['description'],
	'price'=>$_POST['price'],
	'image'=>$_POST['image'],

]);
}


 ?>