<?php include 'Config.php';?>




<?php              if(isset($_SESSION['username'],$_SESSION['password'],$_SESSION['usertype']) && $_SESSION['usertype']=='User' ){                ?>



<?php include 'UserNavBar.php';?>


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
			
			<td align="center" height="200" width="1200">
			

				<table border="1">
					<tr>
						<td align="center"><b>Payment ID</b></td>
						<!--<td align="center"><b>Username</b></td>-->
						<td align="center"><b>Movie ID</b></td>
						<td align="center"><b>Movie Name</b></td>
						<td align="center"><b>Quantity</b></td>
						<td align="center"><b>Unit Price</b></td>
						<td align="center"><b>Total Price</b></td>
						<td align="center"><b>Payment Type</b></td>
						<td align="center"><b>Date</b></td>
					</tr>


					<?php
						$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("Could not connect to mysql"); 

		mysqli_select_db($con, "my_database") or die ("no database");


			$qr1='select * from payment_details where U_ID="'.$_SESSION['username'].'"';
			$rs1=mysqli_query($con,$qr1);


			while($dnn = mysqli_fetch_array($rs1))
			{	
					?>
					<tr>
						<td align="center"> <?php echo $dnn['Payment_ID']?> </td>
						<!--<td align="center"> <?php //echo $dnn['U_ID']?> </td>-->
						<td align="center"> <?php echo $dnn['M_ID']?> </td>
						<td align="center"> <?php echo $dnn['Movie_Name']?> </td>
						<td align="center"> <?php echo $dnn['Quantity']?> </td>
						<td align="center"> <?php echo $dnn['Unit_Price']?> </td>
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
