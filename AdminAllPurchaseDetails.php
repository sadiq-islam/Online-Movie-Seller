<?php include 'Config.php';?>




<?php              if(isset($_SESSION['username'],$_SESSION['password'],$_SESSION['usertype']) && $_SESSION['usertype']=='Admin' ){                ?>



<?php include 'AdminNavBar.php';?>


<!DOCTYPE html>
<html>
<head>
	<title>MOVIES.COM</title>
</head>
<body>



<form>

	<br/><br/>

	<table align="center" border="0" >
		<tr align="center"><td colspan="2"><h3><u>Movie Purchase Details</u></h3></td></tr>



		<tr align="center">
			
			<td align="center"  height="200" width="1200">
			

				<table border="1" align="center">
					<tr align="center">
					<td align="center" colspan="11">

							<?php
						$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("Could not connect to mysql"); 

		mysqli_select_db($con, "my_database") or die ("no database");


			$q1='SELECT SUM(Total_Price) FROM payment_details';
			$r1=mysqli_query($con,$q1);
			$gts= mysqli_fetch_array($r1);
			$grand_total_sale = $gts['SUM(Total_Price)'];

			$q2='SELECT SUM(Wholesale_Total_Price) FROM payment_details';
			$r2=mysqli_query($con,$q2);
			$gtc= mysqli_fetch_array($r2);
			$grand_total_cost = $gtc['SUM(Wholesale_Total_Price)'];

			$grand_total_profit = $grand_total_sale - $grand_total_cost;
			?>


						<table>
							<tr>
								<td><b>Grand Total Cost: <?php echo $grand_total_cost; ?> Taka </b></td>
							<tr>

							<tr>
								<td><b>Grand Total Sale: <?php echo $grand_total_sale; ?> Taka </b></td>
							<tr>

							<tr>
								<td><b>Grand Total Profit: <?php echo $grand_total_profit; ?> Taka </b></td>
							<tr>
						</table>



					<?php  
					mysqli_close($con);
					?>
						
					</td>
					</tr>


					<tr>
						<td align="center"><b>Payment ID</b></td>
						<td align="center"><b>Username</b></td>
						<td align="center"><b>Movie ID</b></td>
						<td align="center"><b>Movie Name</b></td>
						<td align="center"><b>Quantity</b></td>
						<td align="center"><b>Wholesale Price</b></td>
						<td align="center"><b>Unit Price</b></td>
						<td align="center"><b>Total Cost</b></td>
						<td align="center"><b>Total Sale</b></td>
						
						<td align="center"><b>Payment Type</b></td>
						<td align="center"><b>Date</b></td>
					</tr>


					<?php
						$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("Could not connect to mysql"); 

		mysqli_select_db($con, "my_database") or die ("no database");


			$qr1='select * from payment_details';
			$rs1=mysqli_query($con,$qr1);


			while($dnn = mysqli_fetch_array($rs1))
			{	
					?>
					<tr>
						<td align="center"> <?php echo $dnn['Payment_ID']?> </td>
						<td align="center"> <?php echo $dnn['U_ID']?> </td>
						<td align="center"> <?php echo $dnn['M_ID']?> </td>
						<td align="center"> <?php echo $dnn['Movie_Name']?> </td>
						<td align="center"> <?php echo $dnn['Quantity']?> </td>
						<td align="center"> <?php echo $dnn['Wholesale_Price']?> </td>
						<td align="center"> <?php echo $dnn['Unit_Price']?> </td>
						<td align="center"> <?php echo $dnn['Wholesale_Total_Price']?> </td>
						
						<td align="center"> <?php echo $dnn['Total_Price']?> </td>
						<td align="center"> <?php echo $dnn['Payment_type']?> </td>
						<td align="center"> <?php echo $dnn['Date']?> </td>
					</tr>

					<?php } 
					mysqli_close($con);
					?>

				</table>


			
			</td>

		</tr>

	</table>
</form>



</body>
</html>


<?php   } 

else
{
	header("Location: Sign In.php");
}



?>
