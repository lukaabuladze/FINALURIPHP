<?php session_start();

if(!isset($_SESSION['company']['id'])){
	header("Location: index.php");
}

include_once('database.php');

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>კომპანიის გვერდი</title>
</head>
<body>

	<h3>
		<a href="add_vacancy.php">ვაკანსიის დამატება</a>
		<a href="vacancies.php">ვაკანსიის რედაქტირება</a>
		<a href="vacancies.php">ვაკანსიის წაშლა</a>
		<a href="vacancies.php">ვაკანსიის ჩვენება</a>
	</h3>

</body>
</html>