<?php
session_start();
if (!$_SESSION) {
	header('location:http://coxtunes.com/captain_cox/index.php');
}
header("Content-Type: text/html;charset=utf-8");

$serverName = "localhost";
	$userName = "coxtunes";
	$password = "gdv0SY87r2";
	$dbname = "coxtunes_captaincox";

	

	$conn = mysqli_connect($serverName,$userName,$password,$dbname);

if (!$conn) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());	
}mysqli_query($conn, 'SET CHARACTER SET utf8');
mysqli_query($conn, "SET SESSION collation_connection = 'utf8_general_ci'");


 $sql = 'SELECT * FROM book_list' ;
		
$query = mysqli_query($conn, $sql);

if (!$query) {
	die ('SQL Error: ' . mysqli_error($conn));
}


?>
<!DOCTYPE html>
<head>
	<title></title>
<meta charset="UTF-8"/>
	<style type="text/css">
	.header{margin: 0 auto;padding: 0;text-align: center;margin-top:20px;}
		.header h2{margin: 0;padding: 0}
		
		body {
			font-size: 15px;
			color: #343d44;
			font-family: "segoe-ui", "open-sans", tahoma, arial;
			padding: 0;
			margin: 0;}
		h1 {
			margin: 25px auto 0;text-align: center;text-transform: uppercase;font-size: 17px;}
		
		.data-table {border-collapse: collapse;font-size: 14px;min-width: 1300px;margin-top:20px;margin-left:30px;margin-right:50px;}
		
		.data-table th, 
		.data-table td {text-align: center;border: 1px solid black;padding:  0;}
		.data-table caption {margin: 7px;}

		/* Table Header */
		.data-table thead th {
		background-color: #508abb;color: #FFFFFF;border-color: #6ea1cc !important;text-transform: uppercase;
		}

		/* Table Body */
		.data-table tbody td {
			color: #353535;
		}
		
	</style>
</head>
<body>
	<div class="header">
		<h2 style="color: #2D9BA7" >CAPTAIN COX LIBRARY</h2>
		<label style="size: 12px"> Link Road,Cox's Bazar,4700</label>
		<h2 style="color: #23787C">All Books</h2>
	</div>
	<input type="button" value="Home"style="background:#2D9BA7;color: #fff;font-weight: bold;margin-left: 50px " onclick="window.location.href='http://coxtunes.com/captain_cox/home.php'" />
	
	<table class="data-table">	
		<thead>
			<tr>
				<th>Id</th>
				<th>Category Title</th>
				<th>Book Name</th>
				<th>Book Author</th>
				<th>Class</th>
				<th>Book Detais</th>
				<th>Main Price</th>
				<th>Selling Price</th>
				<th>Book Stock</th>
				<th>Book Sold</th>
				
			</tr>
		</thead>
		<tbody>
		<?php
		while ($row = mysqli_fetch_array($query))
		{

			echo '<tr>
					<td>'.$row['id'].'</td>
					<td>'.$row['category_title'].'</td>
					<td>'.$row['book_name'].'</td>
					<td>'.$row['book_author'].'</td>
					<td>'.$row['class'].'</td>
					<td>'.$row['book_details'].'</td>
					<td>'.$row['main_price'].'</td>
					<td>'.$row['selling_price'].'</td>
					<td>'.$row['book_stock'].'</td>
					<td>'.$row['book_sold'].'</td>
				</tr>';

		}?>
		</tbody>
	</table>
</body>
</html>

