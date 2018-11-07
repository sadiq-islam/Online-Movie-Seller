<?php include 'Config.php';?>




<?php include 'UserNavBar.php'; ?>



<!DOCTYPE html>
<html>
<head>
	<title>MOVIES.COM</title>
</head>
<body>


<form>

	<br/><br/>
	
	<table align="center" border="1" width="800">
		<tr align="center"><td colspan="2"><h3><u>Profile Information</u></h3></td></tr>

		<?php
		$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("could not connect to mysql"); 

		mysqli_select_db($con, "my_database") or die ("no database");

		$query = 'select * from person where U_ID="'.$_SESSION['username'].'" ';

		$req = mysqli_query($con,$query);


		$dnn = mysqli_fetch_array($req);
		?>		
		


		<tr align="center">
			<td width="300" height="400">
			<img src= "<?php echo $dnn['Picture']; ?>" width="225" height="225"  onerror="if (this.src != 'icons/profilepicture.gif') this.src = 'icons/profilepicture.gif';">
			</td>
			<td width="500" height="400">
			<b>Name :</b> <?php echo " ".$dnn['Name']; ?><br/>
			<b>Username : </b><?php echo " ".$dnn['U_ID']; ?><br/>
			<b>Email: </b><?php echo " ".$dnn['Email']; ?><br/>
			<b>DOB : </b><?php echo " ".$dnn['DOB']; ?><br/>
			<b>Gender : </b><?php echo " ".$dnn['Gender']; ?><br/>
			<b>Contact No. : </b><?php echo " ".$dnn['ContactNo']; ?><br/>
			<b>Address : </b><?php echo " ".$dnn['Address']; ?><br/>
			<!--<b>Point : </b><//?php echo " ".$dnn['Point']; ?><br/>-->

			<a href="UserEditProfile.php"> <h4>Edit Profile</h4> </a>
			</td>
			<?php mysqli_close($con); ?>

		</tr>


	</table>
</form>


</body>
</html>



<?php              if(isset($_SESSION['username'],$_SESSION['password'],$_SESSION['usertype']) && $_SESSION['usertype']=='User' ){       } 

else
{
	header("Location: Sign In.php");
}



?>


