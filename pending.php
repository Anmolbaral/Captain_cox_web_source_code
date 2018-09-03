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
}

mysqli_query($conn, 'SET CHARACTER SET utf8');
mysqli_query($conn, "SET SESSION collation_connection = 'utf8_general_ci'");



 $sql = 'SELECT `order_details`.`book_order_id`,  `user_name`,`user_address`,`user_mobile`,`payment_method`,`status`,`total_price`,`created_at`, `order_details`.`book_name` ,`order_details`.`book_quantity` ,`order_details`.`book_price` FROM `order_details` INNER JOIN `book_order` ON order_details.book_order_id= book_order.id WHERE status="P" ';
		


$query = mysqli_query($conn, $sql);

if (!$query) {
	die ('SQL Error: ' . mysqli_error($conn));

}
?>
<html>
<head>
	<title></title>

	<meta charset="UTF-8"/>
<meta http-equiv="refresh" content="30"> 
<script type="text/javascript">
function goBack() {
    window.history.back();
}

	</script>
	<style type="text/css">
		body {
			padding: 30px;
			font-size: 15px;
			color: #343d44;
			font-family: "segoe-ui", "open-sans", tahoma, arial;
			padding: 0;
			margin: 0;
		}
		.header{margin: 0 auto;padding: 0;text-align: center;margin-top: 10px;height: 50px}
		.header h2,h4,h4{margin: 0;padding: 0}
		h1 {
			margin: 25px auto 0;text-align: center;text-transform: uppercase;font-size: 17px;}
		
		.data-table {border-collapse: collapse;font-size: 14px;min-width: 100%;}

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
		.menu{
	padding:0px;margin:0px;width:100%;height:0px;background-color:gray;margin-top: 50px;margin-left: 110px}

	.menu ul{padding:0px;margin:0px;}

	.menu ul li{list-style:none;float:left;padding:0;margin:0;position:relative;}

	.menu ul li a{text-decoration:none;padding:0 70px;background-color:#23787C;color:white;line-height:40px;display:block;border-right:1px solid white;}
	
	.menu ul li:last-child a{
	border:0;}
	.menu ul li a:hover,.menu ul li a.active{background:#2D9BA7;}
.menu ul li ul{visibility:hidden;position:absolute;}
.menu ul li:hover ul{visibility:visible;}
.menu ul li ul li{width:50px;}
.menu ul li ul li ul{visibility:hidden;}
.menu ul li ul li {width:1000px;}
		
	</style>
</head>
<body style="margin-left: 30px;margin-right: 30px;margin-bottom: 30px">
<div class="header">
		<h2 style="color: #2D9BA7" >CAPTAIN COX LIBRARY</h2>
		<label style="size: 12px"> Link Road,Cox's Bazar,4700</label>
		<h2 style="color: #23787C">Pending Order Data Sheet</h2>
	</div>

<!--<button onclick="goBack()" style="background:#2D9BA7;color: #fff;font-weight: bold;margin-left: 50px ">Home</button>-->
<input type="button" value="Home"style="background:#2D9BA7;color: #fff;font-weight: bold;margin-left: 50px " onclick="window.location.href='http://coxtunes.com/captain_cox/home.php'" />
<br><br>
	<div class="menu" style="margin-top: 15px;">
<ul>
	<li>
	    <a href="http://coxtunes.com/client_mobile_app_project/onlineorder/captaincox/web/allOrder/allorderdata.php" >সকল অর্ডার সমূহ </a>
	</li>
	<li>
	    <a href="http://coxtunes.com/client_mobile_app_project/onlineorder/captaincox/web/confirm_order/confirm.php">কনফার্ম অর্ডার সমূহ </a>
	 </li>
	    
	 <li>
	    <a href="http://coxtunes.com/client_mobile_app_project/onlineorder/captaincox/web/pending_order/pending.php" class="active" >পেনডিং অর্ডার সমুূহ </a>
	   </li>
	
	 <li>
	    <a href="http://coxtunes.com/client_mobile_app_project/onlineorder/captaincox/web/cancel_order/cancel.php">বাতিল অর্ডার সমূহ </a>
	  </li>
	
</ul>
</div><br><br>
	<table class="data-table" style="margin-top:15px">
	
		<thead>
			<tr>
				<th>Book Order Id</th>
				<th>UserName</th>
				<th>Address</th>
				<th>User Mobile</th>
				<th>Category</th>
				<th>Payment Method</th>
				<th>Status</th>
				<th>Created At</th>
				<th>Book Name</th>
				<th>Book Quantity</th>
				<th>Book Price</th>
				<th>Total Price</th>
				
			</tr>

		</thead>
		<tbody>
		<?php
		while ($row = mysqli_fetch_array($query))
		{

			echo '<tr>
					<td>'.$row['book_order_id'].'</td>
					<td>'.$row['user_name'].'</td>
					<td>'.$row['user_address'].'</td>
					<td>'.$row['user_mobile'].'</td>
					<td>'.$row['category_title'].'</td>
					<td>'.$row['payment_method'].'</td>
					<td>'.$row['status'].'</td>
					<td>'.$row['created_at'].'</td>
					<td>'.$row['book_name'].'</td>
					<td>'.$row['book_quantity'].'</td>
					<td>'.$row['book_price'].'</td>
					<td>'.$row['total_price'].'</td>
				</tr>';
		}?>
		</tbody>
	</table>

</body>
</html>