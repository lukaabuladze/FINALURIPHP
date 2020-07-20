<?php 
session_start();
include_once('database.php');

if(isset($_SESSION['company']['id'])){
	header("Location: company_page.php");
}

if(isset($_POST['submit_comp'])){
	$name = trim($_POST['name']);
	$password = trim($_POST['password']);

	$errors = [];

	if(empty($name)){
		$errors['name'] = 'შეიყვანეთ სახელი';
	}

	if(empty($password)){
		$errors['password'] = 'შეიყვანეთ პაროლი';
	}

	if(empty($errors)){
		$name = mysqli_real_escape_string($link, $name);
		$password = mysqli_real_escape_string($link, $password);

		$query = "SELECT * FROM `companies` WHERE `name` = '{$name}' AND `password` = '{$password}' LIMIT 1";
		$company = mysqli_fetch_assoc(mysqli_query($link, $query));

		if($company){
			
			$_SESSION['company']['id'] = $company['id'];
			$_SESSION['company']['name'] = $company['name'];
			$_SESSION['company']['ident_code'] = $company['ident_code'];
			$_SESSION['company']['date_added'] = $company['date_added'];
			header("Location: company_page.php");
		}
		else{
			$errors['login_error'] = "მსგავსი მომხმარებელი ვერ მოიძებნა";
		}
	}
}


 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Companies</title>
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
			<label>კომპანიის სახელი</label>
			<input type="text" name="name" value="<?=(isset($_POST['name']) ? $_POST['name'] : "")?>"><br>
			<span class="red"><?=(!empty($errors['name']) ? $errors['name']: "")?></span>
		</div>

		<div>
			<label>პაროლი</label>
			<input type="password" name="password"><br>
			<span class="red"><?=(!empty($errors['password']) ? $errors['password']: "")?></span>
		</div>

		<div>
			<input type="submit" name="submit_comp" value="შესვლა">
		</div>

		<h3 class="red"><?=isset($errors['login_error']) ? $errors['login_error'] : ""?></h3>

 	</form>

 </body>
 </html>