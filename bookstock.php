<?php
session_start();
if (!$_SESSION) {
	header('location:http://coxtunes.com/captain_cox/index.php');
}
	$serverName = "localhost";
	$userName = "coxtunes";
	$password = "gdv0SY87r2";
	$dbname = "coxtunes_captaincox";

	

	$conn = mysqli_connect($serverName,$userName,$password,$dbname);

$conn = mysqli_connect($serverName,$userName,$password,$dbname);
if (!$conn) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());	
}

mysqli_query($conn, 'SET CHARACTER SET utf8');
mysqli_query($conn, "SET SESSION collation_connection = 'utf8_general_ci'");


$id = $_POST['id'];
$stock_number = $_POST['book_stock'];

$stock_update_query = "UPDATE book_list SET book_stock=book_stock+'$stock_number' WHERE id='$id' ";

mysqli_query($conn, $stock_update_query);

$sql = "SELECT id,book_name,category_title,book_stock,book_author FROM book_list WHERE  book_stock<=5 ";
		
$query = mysqli_query($conn, $sql);

if (!$query) {
	die ('SQL Error: ' . mysqli_error($conn));
}
?>
<html lang="bn">
<head>
	<title></title>
<link rel="stylesheet" type="text/css" href="bookstock.css">
<meta charset="UTF-8"/>
<meta http-equiv="refresh" content="30"> 
<script type="text/javascript">
function goBack() {
    window.history.back();
}

	</script>
</head>
<body style="margin-left: 30px;margin-right: 30px;margin-bottom: 30px;">

<div class="header">
		<h2 style="color: #2D9BA7">CAPTAIN COX LIBRARY</h2>
		<label style="size: 12px"> Link Road,Cox's Bazar,4700</label>
		<h2 style="color: #23787C">Book Stock</h2>
	</div>
<br><br><br>
<!--<button onclick="goBack()" style="background:#2D9BA7;color: #fff;font-weight: bold;margin-left: 50px ">Home</button>-->
<input type="button" value="Home"style="background:#2D9BA7;color: #fff;font-weight: bold;margin-left: 50px " onclick="window.location.href='http://coxtunes.com/captain_cox/home.php'" />
<br><br>
<div class="update">
    
	<a href="http://coxtunes.com/client_mobile_app_project/onlineorder/captaincox/web/new_book_insert/">
		<input type="button" value="New Book Insert">
	</a>
	<br>
	
	
	
	<form action="bookstock.php" method="POST">

		<h4>Enter id...</h4><input type="number" name="id"><br>
		<h4>Enter Stock number...</h4><input type="number" name="book_stock"><br>
			<input type="submit" name="stock_update" value="Stock Update">
	</form>

</div>
	<table class="data-table">
	
		<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Author</th>
				<th>Category</th>
				<th>Stock</th>
                
			</tr>

		</thead>
		<tbody>
		<?php
		while ($row = mysqli_fetch_array($query))
		{
           
            
			echo '<tr>
					<td>'.$row['id'].'</td>
					<td>'.$row['book_name'].'</td>
					<td>'.$row['book_author'].'</td>
					<td>'.$row['category_title'].'</td>
					<td>'.$row['book_stock'].'</td>
					
				</tr>';
		}?>
		</tbody>
	</table>
</body>
</html>