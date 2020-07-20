<?php 
session_start();

if(!isset($_SESSION['company']['id'])){
	header("Location: index.php");
}

include_once('database.php');

if(!isset($_GET['v_id'])){
	header("Location: company_list.php");
}

$id = intval($_GET['v_id']);
$query = "SELECT * FROM `vacancies` WHERE id = {$id}";

$results = mysqli_fetch_assoc(mysqli_query($link, $query));

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>კომპანიების ჩამონათვალი</title>
 	<style type="text/css">
 		td, th{
 			padding: 10px;
 		}
 	</style>
 </head>
 <body>
 	
 	<h1><?=$results['name']?></h1>
 	<p><?=$results['descr']?></p>

 	<div>Added on : <?=$results['date_added']?></div>

 </body>
 </html>