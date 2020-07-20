<?php session_start();

if(!isset($_SESSION['company']['id'])){
	header("Location: index.php");
}

include_once('database.php');


if(isset($_POST['submit_vacan'])){
	$name = trim($_POST['name']);
	$desc = trim($_POST['desc']);


	$errors = [];

	if(empty($name)){
		$errors['name'] = 'მიუთითეთ დასახელება';
	}

	if(empty($desc)){
		$errors['desc'] = 'ჩაწერეთ მოკლე აღწერა';
	}



	if(empty($errors)){
		$name = mysqli_real_escape_string($link, $name);
		$desc = mysqli_real_escape_string($link, $desc);


		$query = 'INSERT INTO `vacancies` (name, descr, date_added) VALUES ("'.$name.'", "'.$desc.'", now())';
		
		if(mysqli_query($link, $query)){
			echo '<h2>Saved</h2>';
		}
		else{
			echo '<h2>There was an error</h2>';
		}


	}
}


 ?>



<!DOCTYPE html>
<html>
<head>
	<title>კომპანიის დამატება</title>
	<style type="text/css">
		form div{
			padding: 20px;
		}

		.red{
			color: red;
		}
	</style>
</head>
<body>

	<form method="POST">
		
		<div>
			<label>ვაკანსიის დასახელება</label>
			<input type="text" name="name" value="<?=(isset($_POST['name']) ? $_POST['name'] : "")?>"><br>
			<span class="red"><?=(!empty($errors['name']) ? $errors['name']: "")?></span>
		</div>

		<div>
			<label>ვაკანსიის მოკლე აღწერა</label>
			<input type="text" name="desc" value="<?=(isset($_POST['desc']) ? $_POST['desc'] : "")?>"><br>
			<span class="red"><?=(!empty($errors['desc']) ? $errors['desc']: "")?></span>
		</div>


		<div>
			<input type="submit" name="submit_vacan" value="დამატება">
		</div>

	</form>

</body>
</html>