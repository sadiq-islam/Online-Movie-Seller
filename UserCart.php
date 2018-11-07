<?php include 'Config.php';?>




<?php              if(isset($_SESSION['username'],$_SESSION['password'],$_SESSION['usertype']) && $_SESSION['usertype']=='User' ){                ?>



<?php include 'UserNavBar.php';?>


<!DOCTYPE html>
<html>
<head>
	<title>MOVIES.COM</title>

	<script type="text/javascript">
		function a()
		{
			window.location.href= "generate_pdf.php";
		}
	</script>


</head>
<body>


<!--"<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"-->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >

	<br/><br/><br/>

	<table align="center" border="0" >


		<tr>
			<td align="center" width="1100" colspan="2">
				<h2><u>Movies On Cart</u></h2>
			</td>
			
		</tr>

		<?php
		$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("Could not connect to mysql"); 

		mysqli_select_db($con, "my_database") or die ("no database"); 

		$query = 'select * from cart_info where u_id="'.$_SESSION['username'].'"';
		$req = mysqli_query($con,$query);


		while($dnn1 = mysqli_fetch_array($req))
		{
		?>		

		<tr>
			<?php

			$query1 = 'select * from movie_info where m_id="'.$dnn1['M_ID'].'"';
			$req1 = mysqli_query($con,$query1);
			$dnn=mysqli_fetch_array($req1);

			?>
			<td align="center"  width="600">
			<img src="<?php echo $dnn['Picture']; ?>" width="225" height="225" onerror="if (this.src != 'icons/movie.gif') this.src = 'icons/movie.gif';">
			</td>
			<td align="center"  width="600">
			<b>Movie ID :</b> <?php echo " ".$dnn['M_ID']; ?><br/>
			<b>Name :</b> <?php echo " ".$dnn['Name']; ?><br/>
			<b>Language : </b><?php echo " ".$dnn['Language']; ?><br/>
			<b>Genre : </b><?php echo " ".$dnn['Genre']; ?><br/>
			<b>Year : </b><?php echo " ".$dnn['Year']; ?><br/>
			<b>Unit Price : </b><?php echo " ".$dnn['Unitprice']." TK"; ?><br/>
			<b>Required Quantity : </b><?php echo " ".$dnn1['Quantity']; ?><br/>
			<b>Total Price : </b><?php echo " ".$dnn1['Total_Price']." TK"; ?><br/>
			
			<a href="UserAddToCart.php?mid=<?php echo $dnn['M_ID']?>"><h4><i>Update Quantity!</i></h4></a>
			<a href="UserDeleteFromCart.php?mid=<?php echo $dnn['M_ID']?>"><h4><i>Delete From Cart!</i></h4></a>
		</td>

		

		</tr>

		<?php } 

		mysqli_close($con); 

		?>
		<tr align="center">
			<td colspan="8">

				<br/><br/>
				<input type="radio" name="paymentmethod" value="CashOnDelivery" required="required">Cash On Delivery
				
			</td>
		</tr>

		<tr align="center">
			<td colspan="8">

				<br/>

				<button onclick=" a() " >Generate Receipt</button>
				<input type="submit" name="purchasemovies" id="purchasemovies"  value="Purchase All" >

				<br/><br/> 
				
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




<?php      //validation is in generate_pdf.php

		if($_SERVER["REQUEST_METHOD"]=="POST")
		{

			if(isset($_POST['purchasemovies']))
			{

			$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("Could not connect to mysql"); 

		mysqli_select_db($con, "my_database") or die ("no database");


			$qr1='select * from cart_info where U_ID="'.$_SESSION['username'].'"';
			$rs1=mysqli_query($con,$qr1);


			while($dnn = mysqli_fetch_array($rs1))
			{	

				$qr3='SELECT `Name`,`Unitprice`,`WholesalePrice`,`Quantity` from `movie_info` WHERE `M_ID`="'.$dnn['M_ID'].'"';
				$rs3=mysqli_query($con,$qr3);
				$dn= mysqli_fetch_array($rs3);


				$wholesaleTotalPrice = $dnn['Quantity'] * $dn['WholesalePrice'];

				$qr2='INSERT INTO `payment_details`( `U_ID`, `M_ID`,`Movie_Name`, `Quantity`,`Unit_Price`,`Wholesale_Price`,`Total_Price`,`Wholesale_Total_Price`, `Payment_type`, `Date`) VALUES ("'.$dnn['U_ID'].'","'.$dnn['M_ID'].'","'.$dn['Name'].'","'.$dnn['Quantity'].'","'.$dn['Unitprice'].'","'.$dn['WholesalePrice'].'","'.$dnn['Total_Price'].'","'.$wholesaleTotalPrice.'","'.$_POST['paymentmethod'].'","'.date("Y/m/d").'")';
				$rs2=mysqli_query($con,$qr2);

				

				//echo "".$dn['Quantity']." -----   ".$dnn['Quantity'];

				$currquantity=$dn['Quantity'] - $dnn['Quantity'];
				$qr4='UPDATE `movie_info` SET `Quantity`="'.$currquantity.'" WHERE `M_ID`="'.$dnn['M_ID'].'"';
				$rs4=mysqli_query($con,$qr4);


				$qr5='SELECT * from `cart_info` WHERE `M_ID`="'.$dnn['M_ID'].'" AND U_ID<>"'.$_SESSION['username'].'" ';
				$rs5=mysqli_query($con,$qr5);

				while($dm = mysqli_fetch_array($rs5))
				{	

					if ($currquantity <= $dm['Quantity'] && $currquantity >0)
					{

						$qr7='SELECT `Unitprice` from `movie_info` WHERE `M_ID`="'.$dm['M_ID'].'"';
						$rs7=mysqli_query($con,$qr7);
						$dm1= mysqli_fetch_array($rs7);

						$new_total_price = $currquantity * $dm1['Unitprice'];

						$qr6='UPDATE `cart_info` SET `Quantity`="'.$currquantity.'",`Total_Price`="'.$new_total_price.'" WHERE `U_ID`="'.$dm['U_ID'].'"';
						$rs6=mysqli_query($con,$qr6);


					}


					if ($currquantity <= 0)
					{
						$qr8='UPDATE `cart_info` SET `Quantity`="'.$currquantity.'" WHERE `U_ID`="'.$dm['U_ID'].'"';
						$rs8=mysqli_query($con,$qr8);

						$qr10='SELECT `No.` from `cart_info` WHERE `M_ID`="'.$dm['M_ID'].'"';
						$rs10=mysqli_query($con,$qr10);


						while ($dx = mysqli_fetch_array($rs10))
						{
							$qr9='DELETE FROM `cart_info` WHERE `No.`="'.$dx['No.'].'"';
							$rs9=mysqli_query($con,$qr9);
						}
						

					}

				}


			}






			$qr='delete from cart_info where U_ID="'.$_SESSION['username'].'"';
				$rs=mysqli_query($con,$qr);

				if($rs)
				{
					echo 'Movies Are Successfully Purchesed!';
					mysqli_close($con);

					header("Location:UserPurchaseDetails.php");
				}

				else {
					echo 'Error!';
				}

			}

		}  
		?>


