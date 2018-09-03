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

mysqli_query($conn, 'SET CHARACTER SET utf8');
mysqli_query($conn, "SET SESSION collation_connection = 'utf8_general_ci'");

$order_id = $_POST['id'];
$confirm_order_id = $_POST['idno'];

if(!empty($order_id)){
    
$queryToLoadSpecificOrder="SELECT 
order_details. book_order_id,
book_order. user_name,
book_order. user_address,
book_order. user_mobile,
book_order. payment_method,
book_order. created_at,
order_details. book_name,
book_list. book_author,
order_details. book_quantity,
order_details. book_price,
order_details. book_id,
book_order. total_price,
book_order. status

FROM (order_details INNER JOIN book_order ON order_details.book_order_id = book_order.id) INNER JOIN book_list ON order_details.book_name = book_list.book_name  WHERE order_details.book_order_id='$order_id' ";
    
    //updating
}elseif(!empty($confirm_order_id)){
   
    $queryToLoadSpecificOrder="SELECT 
order_details. book_order_id,
book_order. user_name,
book_order. user_address,
book_order. user_mobile,
book_order. payment_method,
book_order. created_at,
order_details. book_name,
book_list. book_author,
order_details. book_quantity,
order_details. book_price,
order_details. book_id,
book_order. total_price,
book_order. status

FROM (order_details INNER JOIN book_order ON order_details.book_order_id = book_order.id) INNER JOIN book_list ON order_details.book_name = book_list.book_name  WHERE order_details.book_order_id='$confirm_order_id' ";
}

$result= mysqli_query($conn,$queryToLoadSpecificOrder);
        $bookIDs=array();
         $bookQuantity=array();
		while($row = mysqli_fetch_assoc($result))
		{
			
				$order_status = $row['status'];
				$book_order_id  = $row['book_order_id'];
				$payment_method=$row['payment_method'];
				$created_at=$row['created_at'];

				$user_name  = $row['user_name'];
				$user_address  = $row['user_address'];
				$user_mobile  = $row['user_mobile'];
				$book_price  = $row['book_price'];
                $bookIDs[]= $row['book_id'];
                $bookQuantity[]= $row['book_quantity'];
                  
				$book_quantity = $row['book_quantity'];
				$sub_total = $book_quantity * $book_price;

				$book_name  = $row['book_name'];
				$total_price  = $row['total_price'];
				
		}

        
        if($order_status == "S"){
            $status = "Order Confirmed";
        }else if($order_status == "C"){
            $status = "Order Cancel";
        }else{
            echo "----";
        }          
          
			//status updating
		
			$confirm_cs = $_POST['cs'];
			$updateInfo = $_POST['update'];
			 
			if($updateInfo=="Confirm" && $confirm_cs=="S"){
			$order_confirm_query = "UPDATE book_order SET status='$confirm_cs' WHERE id= '$confirm_order_id'";
			mysqli_query($conn,$order_confirm_query);			    
			}elseif($updateInfo=="Confirm" && $confirm_cs=="C"){
			    			$order_confirm_query = "UPDATE book_order SET status='$confirm_cs' WHERE id= '$confirm_order_id'";
			    				mysqli_query($conn,$order_confirm_query);	
			    			$bookListUpdateQuery="";
			    			$i= 0;
			    			
			    			foreach($bookIDs as $eachBookID){
			    			    $bookListUpdateQuery.="UPDATE `book_list` SET `book_stock` = `book_stock` + ".intval($bookQuantity[$i])." WHERE `book_list`.`id`=".$eachBookID.";";
			    			   
			    			    $i++;
			    			}
			    		 var_dump($bookListUpdateQuery);
			    		
			    		if(mysqli_multi_query($conn,$bookListUpdateQuery)){
			    		    echo "success";
			    		}	else{
			    		    echo mysqli_error($conn);
			    		}
		
			}

			
			

?>


<script type="text/javascript">
	
	function printDiv(print_content) {

	 var printContents = document.getElementById(print_content).innerHTML;
	 w=window.open();
	 w.document.write(printContents);
	 w.print();
	 w.close();
	}

</script>



<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="invoice.css">
	
</head>
<body >
	<div class="button" style="margin-top: 30px">
	
	    <form action="" method="POST">
	        <input type="number" name="id" />
	        <input type="submit" value="Search" />

	        <input type="number" name="idno" />
	        <select name="cs">
				     <option>----</option>
					 <option value="C">Cancel</option>
					 <option value="S">Delivered</option>
			</select>
			<input type="submit" name="update" value="Confirm">


			<input type="button" value="Print this page" onClick="window.print()">
	    </form>	
	</div>
	
	
	<div style="margin-top: 20px;font-weight: bold;">
	<label><?php echo $status?></label>

	<div id="print_content">
		<div class="main" style="height: 842px">
		<div class="admin" style="margin-bottom: 100px;margin-top: 50px">
			<table border="2" bodercolor="black" align="center" cellspacing="0" cellpadding="0" >
			<thead>
			    <th>Status</th>
				<th>Order Id</th>
				<th>Name</th>
				<th>Created at</th>
				<th>Payment Method</th>
				<th>Total Amount</th>
			</thead>

			<tr>
			    <td><?php echo $order_status?></td>
				<td><?php echo $book_order_id?></td>
				<td><?php echo $user_name?></td>
				<td><?php echo $created_at?></td>
				<td><?php echo $payment_method?></td>
				<td><?php echo $total_price?></td>
			</tr>
			
	</table>
	<div class="autho" style="float: right;"><lebel style="margin-top: 20px;font-size: 18px;font-weight: bold;margin-left: 40px "><u>Customer Signature</u></lebel></div>
</div>
<hr>


		<div class="from" style="margin-top: 100px">

		<div class="confirm">
		<table border="2" bodercolor="black" align="center" cellspacing="0" cellpadding="0" style="margin-top: 50px;width: 590px;height: 280px;text-align: center;text-decoration: bold ">
			<thead>
				<th colspan="2" height="40px" style="text-align:center;width: 100% ">
					<form action="" method="post">
						<label style="margin-left: 20px"><b>Order Id:&nbsp;&nbsp;</b></label><label><?php echo $book_order_id?></label>
					</form>
				</th>
				<th></th>
			</thead>
			<tr>
				<td width="50%" height="20px">From</td>
				<td>To</td>
			</tr>
			<tr>
				<td height="200px">
					ক্যাপ্টেন কক্স লাইব্রেরি<br>
					মোবাইলঃ ০১৯৭৯৯৪৫১০০<br>
					লিংক রোড,কক্সবাজার, ৪৭০১ বাংলাদেশ।<br>
					info.captaincoxonline@gmail.com
				</td>
				<td height="200px">
					<?php echo $user_name?><br>
					<?php echo $user_address?><br>
					<?php echo $user_mobile?>
				</td>
			</tr>
			<tr>
				<td colspan="2" height="30px" style="text-align:left;">

					<form action="invoice.php" method="post">
						<label style="margin-left: 20px;text-align: center;"><b>Net Payable = &nbsp;&nbsp;</b></label><label><?php echo "$total_price/-"?><label style="margin-left: 80px"><?php echo "<b>Date:&nbsp;</b>".date("d/m/Y") . "<br>";?></label>
</label>
					</form>
				</td>		
			</tr>
		</table>
		</div>
	</div>
</div>
</div>

<div class="header" style="margin-top: 280px">

		<h2>CAPTAIN COX LIBRARY</h2>
		<h5> Link Road,Cox's Bazar,4700</h5>
		<h4>Phone: 01813672344</h4>
		<h2>INVOICE</h2>
</div>

<div class="user_info">
	<form action="" method="">
		<b>Order Id :&nbsp;&nbsp;</b><label><?php echo $book_order_id?></label><br>
		<b>Name 	:&nbsp;&nbsp;</b><label><?php echo $user_name?></label><br>
		<b>Address 	:&nbsp;&nbsp;</b><label><?php echo $user_address?></label><br>
		<b>Payment Method :&nbsp;&nbsp;</b><label><?php echo $payment_method?></label><br>
		<b>Shipping Method :&nbsp;&nbsp;</b><label>Bike</label><br>
		<b>Phone 	:&nbsp;&nbsp;</b><label><?php echo $user_mobile?></label><br>
		<b>Date  :&nbsp;<?php echo date("d/m/Y") . "<br>";?>
	</form>
</div>

<div class="order_table">
	<table border="2" bodercolor="black" align="center" cellspacing="0" cellpadding="0" >
			<thead>
			    <th>Book ID</th>
				<th>Book Name</th>
				<th>Author</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Sub Total</th>
			</thead>

<?php
		$result= mysqli_query($conn,$queryToLoadSpecificOrder);


				while($row = mysqli_fetch_assoc($result))
				{
					$book_quantity = $row['book_quantity'];
						$book_price  = $row['book_price'];
						$sub_total = $book_quantity * $book_price;
					
						echo '<tr>
								<td>'.$row['book_id'].'</td>
								<td>'.$row['book_name'].'</td>
								<td>'.$row['book_author'].'</td>
								<td>'.$row['book_quantity'].'</td>
								<td>'.$row['book_price'].'</td>
								<td>'.$sub_total.'</td>
								
							</tr>';		
				}
?>
			
	</table>

	<div class="total">
		<lebel style="margin-left: 450px"><b>Total:</b> <?php echo "$total_price/-"?></lebel>
	</div>

	</div>
	<div class="signature" style="margin-bottom: 20px">
			
			<lebel style="float: right;margin: 0 auto;font-size: 18px;font-weight:bold;"><u>Authority Signature</u></lebel><br><br><br><br><br><br>
			<h5 style="background: black;color: white;text-align: center;": >Developed by: Coxtunes Software Limited, Follow us: facebook.com/coxtunes</h5>
	</div>
	
</div>

	

</body>
</html>