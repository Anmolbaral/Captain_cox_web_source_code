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

if (!$conn) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());	
}

mysqli_query($conn, 'SET CHARACTER SET utf8');
mysqli_query($conn, "SET SESSION collation_connection = 'utf8_general_ci'");

 $sql = 'SELECT * FROM complain order by id DESC' ;
		
$query = mysqli_query($conn, $sql);

if (!$query) {
	die ('SQL Error: ' . mysqli_error($conn));
}

?>
<html>
<head>
	<title></title>
	<meta http-equiv="refresh" content="30"> 
<link rel="stylesheet" type="text/css" href="complain.css">
	<script type="text/javascript">
function goBack() {
    window.history.back();
}

	</script>
</head>
<body style="margin-left: 30px;margin-right: 30px;margin-top: 20px">
	
<div class="header">
		<h2 style="color: #2D9BA7" >CAPTAIN COX LIBRARY</h2>
		<label style="size: 12px"> Link Road,Cox's Bazar,4700</label>
		<h2 style="color: #23787C">Complain / Suggestion</h2>
	</div>
<input type="button" value="Home"style="background:#2D9BA7;color: #fff;font-weight: bold;margin-left: 50px " onclick="window.location.href='http://coxtunes.com/captain_cox/home.php'" /><br><br>
	<table class="data-table">	
		<thead>
			<tr>
				<th>SL</th>
				<th>Name</th>
				<th>Address</th>
				<th>Phone</th>
				<th>Email</th>
				<th>Type</th>
				<th>Details</th>
				
			</tr>
		</thead>
		<tbody>
		<?php
		while ($row = mysqli_fetch_array($query))
		{

			echo '<tr>
					<td>'.$row['id'].'</td>
					<td>'.$row['name'].'</td>
					<td>'.$row['address'].'</td>
					<td>'.$row['phone'].'</td>
					<td>'.$row['email'].'</td>
					<td>'.$row['type'].'</td>
					<td>'.$row['details'].'</td>
				</tr>';
		}?>
		</tbody>
	</table>
</body>
</html>