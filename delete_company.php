<?php 
include_once('database.php');

if(isset($_GET['company_id'])){
	$id = mysqli_real_escape_string($link, $_GET['company_id']);
	$id = intval($id);

	if(mysqli_query($link, "DELETE FROM `companies` WHERE id = {$id}")){
		header("Location: company_list.php");
	}
}


 ?>