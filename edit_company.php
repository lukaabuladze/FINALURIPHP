<?php 
include_once('database.php');

if(!isset($_GET['company_id'])){
	header("Location: company_list.php");
}
else{
	$id = intval($_GET['company_id']);
	$query = "SELECT * FROM `companies` WHERE `id` = {$id}";
	$res = mysqli_fetch_assoc(mysqli_query($link, $query));
}



if(isset($_POST['submit_comp'])){
	$name = trim($_POST['name']);
	$code = trim($_POST['ident_code']);
	$password = trim($_POST['password']);
	$conf_password = trim($_POST['conf_password']);

	$errors = [];

	if(empty($name)){
		$errors['name'] = 'მიუთითეთ სახელი';
	}

	if(empty($code)){
		$errors['code'] = 'მიუთითეთ საიდენტიფიკაციო კოდი';
	}



	if(empty($password)){
		$errors['password'] = 'ჩაწერეთ პაროლი';
	}

	else if(strlen($password) < 3){
		$errors['password'] = 'პაროლი ძალიან მოკლეა';
	}

	else if(empty($conf_password)){
		$errors['conf_password'] = 'ჩაწერეთ პაროლი';
	}
	else{
		if($password !== $conf_password){
			$errors['conf_password'] = 'პაროლები არ ემთხვევა';
		}
	}


	if(empty($errors)){
		$name = mysqli_real_escape_string($link, $name);
		$code = mysqli_real_escape_string($link, $code);
		$password = mysqli_real_escape_string($link, $password);


		$query = 'UPDATE `companies` SET name = "'.$name.'", ident_code = "'.$code.'", password = "'.$password.'" WHERE id = '.$id;
		
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
			<label>კომპანიის სახელი</label>
			<input type="text" name="name" value="<?=$res['name']?>"><br>
			<span class="red"><?=(!empty($errors['name']) ? $errors['name']: "")?></span>
		</div>

		<div>
			<label>კომპანიის საიდენტიფიკაციო კოდი</label>
			<input type="text" name="ident_code" value="<?=$res['ident_code']?>"><br>
			<span class="red"><?=(!empty($errors['code']) ? $errors['code']: "")?></span>
		</div>

		<div>
			<label>პაროლი</label>
			<input type="password" name="password"><br>
			<span class="red"><?=(!empty($errors['password']) ? $errors['password']: "")?></span>
		</div>

		<div>
			<label>გაიმეორეთ პაროლი</label>
			<input type="password" name="conf_password"><br>
			<span class="red"><?=(!empty($errors['conf_password']) ? $errors['conf_password']: "")?></span>
		</div>

		<div>
			<input type="submit" name="submit_comp" value="დამატება">
		</div>

	</form>

</body>
</html>