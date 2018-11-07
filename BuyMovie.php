<?php include 'Config.php';?>




<?php              if(isset($_SESSION['username'],$_SESSION['password'],$_SESSION['usertype'])){                ?>



<?php include 'UserNavBar.php';?>


<!DOCTYPE html>
<html>
<head>
	<title>MOVIES.COM</title>
</head>
<body>



<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

	<br/><br/><br/>

	<table align="center" border="1" width="700">

		<tr align="center">

			<td colspan="2">
				<h3><u>Buy Movie</u></h3>
			</td>

		</tr>

		<tr align="center">

			<td width="230">
			<img src="movieicon.png" width="225" height="225">
			</td>
			<td>
			Movie Details <br/>
			</td>

		</tr>

		<tr align="center">

			<td colspan="2">
				<br/>
				<label>Quantity : </label>
				<input type="number" name="quantity" id="quantity"  min="1" max="9999" align="center" required="required" />
				<br/><br/>

				<input type="submit" name="addtocart" value="Add To Cart">
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







<?php
	
	$sts=0;
	
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if(isset($_POST["addmovie"])){
		

		if((int)$_POST["quantity"]<1)
		{
			echo "Quantity should at least be 1!<br/>";
			$sts=1;
		}
  		
		if ($sts==0) {
			echo "Movie Purchased!<br/>";
		}
	}

}
		
		function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		  }
	?>

