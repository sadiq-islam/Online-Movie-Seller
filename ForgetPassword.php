<?php include 'Config.php';?>




<?php              if(!isset($_SESSION['username'],$_SESSION['password'],$_SESSION['usertype']))  {                ?>



<!DOCTYPE html>
<html>
<head>
	<title>MOVIES.COM</title>
</head>
<body>
	<?php include 'HomeNavBar.php';?>


	<?php
	
	$emailErr="";
	
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{

		function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		  }


		if(isset($_POST["sendpassword"])){
		
		if(filter_var( test_input($_POST["email"]) ,  FILTER_VALIDATE_EMAIL ))
		{	

			$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("Could not connect to mysql"); 

		mysqli_select_db($con, "my_database") or die ("no database");

			$qr1='select * from person where Email="'.$_POST['email'].'"';
			$rs1=mysqli_query($con,$qr1);
			$dn=mysqli_fetch_array($rs1);

			if(mysqli_num_rows($rs1) ==1)
			{
				$username = $dn['U_ID'];
				$password = $dn['Password'];
				$to = $dn['Email'];
				$subject = 'Your Recovered Password!';
				$msg='Please, use this username and password to login! < Username : ' .$username. ' > & < Password : ' . $password . ' >';
				$header="From : me@example.com";

				if(mail($to,$subject,$msg,$header))
				{
					$emailErr= "Password Sent!";
				}
				else
				{
					$emailErr= "Failed to recover your password!!";
				}
					
			}

			else
			{
				$emailErr= "Email is not registered!";
			}
			
		}
		else
		{
			$emailErr= "Invalid email format!";
		}
	}
}
		
	?>



	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		
		

		<br/><br/><br/><br/><br/><br/><br/>


			<!--             Sign In Panel               -->	
			<table align="center" width="250"><tr><td>
			
		<fieldset>
			<legend align="center"><h3><u>Forget Password</u></h3></legend>
		<table align="center">
			<!--<tr align="center">
				<td><h4><u>LOG IN</u></h4></td>
			</tr>-->

			<tr align="center">
				<td>
					Email<br/>
					<input type="text" name="email" required = "required" placeholder="Enter Your Email!" >
				</td>	
			</tr>

			<tr align="center">
				<td>
					<span>* <?php echo $emailErr;?></span>
				</td>
			</tr>

			<tr align="center">
				<td>
					
					<input type="submit" name="sendpassword" value="Send Password">
					<br/>
				</td>
			</tr>


		</table>
		

		</fieldset>

		</td></tr></table>

	</form>

</body>
</html>


	
<?php   } 

else
{
	echo "<h2>You must logout to watch this page!!!<h2>";
}



?>
