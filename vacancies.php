<?php 
session_start();

if(!isset($_SESSION['company']['id'])){
	header("Location: index.php");
}

include_once('database.php');

$query = "SELECT * FROM `vacancies` ORDER BY `date_added` DESC";

$resutls = mysqli_query($link, $query);

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
 	<h2>კომპანიების ჩამონათვალი</h2>
 	<table border="1">
 		<thead>
 			<tr>
 				<th>#</th>
 				<th>სახელი</th>
 				<th>საიდენტიფიკაციო კოდი</th>
 				<th>დამატების თარიღი</th>
 				<th>მოქმედება</th>
 			</tr>
 		</thead>
 		<tbody>
 			<?php 

 			while($row = mysqli_fetch_assoc($resutls)){
 				echo '<tr>';
 				echo '<td>'.$row['id'].'</td>';
 				echo '<td>'.$row['name'].'</td>';
 				echo '<td>'.$row['descr'].'</td>';
 				echo '<td>'.$row['date_added'].'</td>';
 				echo '<td><a href="edit_vacan.php?action=edit&v_id='.$row['id'].'">რედაქირება</a>&nbsp;<a href="edit_vacan.php?action=delete&v_id='.$row['id'].'">წაშლა</a>&nbsp;<a href="view_vacan.php?v_id='.$row['id'].'">ჩვენება</a></td>';
 				echo '</tr>';
 			}

 			 ?>
 		</tbody>
 	</table>


 </body>
 </html>